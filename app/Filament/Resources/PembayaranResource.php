<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\CheckboxList;
use App\Models\Produk;
use App\Models\Service;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;



class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
{
    return $form->schema([
        CheckboxList::make('produk_id')
            ->label('Pilih Produk')
            ->options(Produk::pluck('nama_produk', 'id'))
            ->reactive()
            ->afterStateUpdated(function (callable $get, callable $set) {
                $produkId = $get('produk_id') ?? [];
                $totalProduk = Produk::whereIn('id', $produkId)->sum('harga_barang');
                $totalService = Service::whereIn('id', $get('service_id') ?? [])->sum('harga_service');
                $set('total_harga', $totalProduk + $totalService);
            }),

        CheckboxList::make('service_id')
            ->label('Pilih Service')
            ->options(Service::pluck('nama_service', 'id')) // ✅ ini benar
            ->reactive()
            ->afterStateUpdated(function (callable $get, callable $set) {
                $serviceIds = $get('service_id') ?? [];
                $totalService = Service::whereIn('id', $serviceIds)->sum('harga_service');
                $totalProduk = Produk::whereIn('id', $get('produk_id') ?? [])->sum('harga_barang');
                $set('total_harga', $totalProduk + $totalService);
            }),

        TextInput::make('total_harga')
            ->label('Total Harga')
            ->numeric()
            ->disabled()
            ->dehydrated()
            ->required()
            ->default(0),

        TextInput::make('total_bayar')
            ->numeric()
            ->reactive()
            ->afterStateUpdated(function (callable $get, callable $set) {
                $total = (float) $get('total_harga');
                $bayar = (float) $get('total_bayar');
                $set('kembalian', $bayar - $total);
            }),

        TextInput::make('kembalian')
            ->numeric()
            ->disabled()
            ->dehydrated(),

        TextInput::make('status')
            ->required(),

        TextInput::make('metode_pembayaran')
            ->required(),

        DateTimePicker::make('tanggal_pembayaran')
            ->required(),
    ]);
}


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('total_bayar')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kembalian')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pembayaran')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('metode_pembayaran'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
               
                Tables\Columns\TextColumn::make('total_harga')
                    ->numeric()
                    ->label('Total Harga')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('jumlah_barang')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_service')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('harga_barang')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
