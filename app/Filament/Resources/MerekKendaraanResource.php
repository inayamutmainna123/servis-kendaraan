<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MerekKendaraanResource\Pages;
use App\Filament\Resources\MerekKendaraanResource\RelationManagers;
use App\Models\MerekKendaraan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MerekKendaraanResource extends Resource
{
    protected static ?string $model = MerekKendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $pluralLabel = 'Merek Kendaraan';


    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode_merek')
                    ->label('Kode')
                    ->required(),
                    
                Forms\Components\TextInput::make('nama_merek')
                    ->label('Merek')
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
                Tables\Columns\TextColumn::make('kode_merek')
                    ->label('Kode'),     
                Tables\Columns\TextColumn::make('nama_merek')
                    ->label('Merek '),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMerekKendaraans::route('/'),
        ];
    }
}
