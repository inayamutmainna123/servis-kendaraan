<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoicesResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use App\Models\Invoice;


class InvoicesResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationGroup = 'Invoice';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('invoice_number')
                ->required()
                ->label('No Invoice')
                ->unique(ignoreRecord: true),
                
            DatePicker::make('invoice_date')
            ->label('Tanggal')
            ->required(),

            TextInput::make('customer_name')
            ->label('Nama Costumer')
            ->required(),
            TextInput::make('customer_email')
            ->label('Email Costumer')
            ->email(),

            Repeater::make('items')
                ->relationship( 'items') 
                ->label('Item')
                ->schema([
                    TextInput::make('dekripsi')
                    ->label('Deskripsi')
                    ->required(),
                    TextInput::make('quantity')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),
                    TextInput::make('harga')
                    ->label('Harga')
                    ->numeric()
                    ->required(),
                    TextInput::make('subtotal')
                        ->label('Subtotal')
                        ->disabled()
                        ->dehydrated()
                        ->numeric()
                        ->afterStateHydrated(function ($component, $state, $set, $get) {
                            $set('subtotal', (float)$get('quantity') * (float)$get('harga'));
                        }),
                ])
                ->columns(4),

            TextInput::make('total')
                ->disabled()
                ->dehydrated()
                ->label('Total')
                ->afterStateHydrated(function ($set, $get) {
                    $total = collect($get('items'))->sum(function ($item) {
                        return ($item['quantity'] ?? 0) * ($item['harga'] ?? 0);
                    });
                    $set('total', $total);
                }),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('invoice_number')
                ->label('No Invoice')
                ->sortable()
                ->searchable(),
                TextColumn::make('invoice_date')
                ->label('Tanggal')
                ->date(),
                TextColumn::make('customer_email')
                ->label('Email Costumer')
                ->sortable()
                ->searchable(),
                TextColumn::make('customer_name')
                ->label('Nama Costumer')
                ->sortable()
                ->searchable(),
                TextColumn::make('total')
                ->label('Total')
                ->money('idr'),
            ])
            ->filters([
                // Optional: add filters
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Optional: define relation managers
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoices::route('/create'),
            'view' => Pages\ViewInvoices::route('/{record}'),
            'edit' => Pages\EditInvoices::route('/{record}/edit'),
        ];
    }
}
