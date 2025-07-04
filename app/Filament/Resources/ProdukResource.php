<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Filament\Resources\ProdukResource\RelationManagers;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use PhpParser\Node\Stmt\Label;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Filament\Notifications\Notification;




class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $pluralLabel = 'Sparepart';

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationGroup = 'Data Master';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_produk')
                    ->label('Nama Produk')
                    ->required(),
                    

                Forms\Components\TextInput::make(name: 'harga_barang')
                    ->label('Harga Barang')
                    ->required(),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->required(),
                   
                Forms\Components\TextInput::make('stok')
                    ->label('Stok')
                    ->required(),
                Forms\Components\FileUpload::make('attachment') 
                    ->label('Foto Produk')
                    ->image() 
                    ->imagePreviewHeight('150') 
                    ->directory('produk-images') 
                    ->visibility('public') 
                    ->required(),
            ]);
                
    }

    // Tambahkan method ini di class ProdukResource
public static function afterSave($record): void
{
    if ($record->stok <= 0) {
        Notification::make()
            ->title('Stok barang kosong!')
            ->body("Stok untuk produk \"{$record->nama_barang}\" habis.")
            ->danger()
            ->send();
    };
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                    ->label('No')
                    ->rowIndex(),
                    Tables\Columns\ImageColumn::make('attachment')
                    ->label('Foto')
                    ->disk('public') 
                    ->width(60)
                    ->height(60)
                    ->circular(), 
               Tables\Columns\TextColumn::make('nama_produk')
                    ->label(' Nama Produk'),
               Tables\Columns\TextColumn::make('harga_barang')
                    ->label('Harga Barang'),

               Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi'),

               Tables\Columns\TextColumn::make('stok')
                    ->label('Stok'),
               
            ])

            
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ])
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
            'index' => Pages\ManageProduks::route('/'),
        ];
    }
}
