<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceItemResource\Pages;
use App\Models\ServiceItem;
use App\Models\Service;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use App\Models\Produk;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;

use function Laravel\Prompts\select;

class ServiceItemResource extends Resource
{
    protected static ?string $model = ServiceItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static ?string $pluralLabel = 'Service';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
                Select::make('costumer_id')
                    ->relationship('costumer', 'nama_costumer')
                    ->required()
                    ->label('Costumer'),

                Select::make('tipe_kendaraan') 
                    ->label('Tipe Kendaraan')
                    ->options([
                        'matic' => 'Matic',
                        'manual' => 'Manual',
                    ])
                    ->default('matic'),
                    

                Select::make('merek_kendaraan')
                    ->label('Merek Kendaraan')
                    ->options([
                        'yamaha'=> 'Yamaha',
                        'honda'=> 'Honda',
                        'kawasaki'=>'Kawasaki',
                    ]),
                
                TextInput::make('model_kendaraan')
                    ->label('Model Kendaraan')
                    ->required(),

                TextInput::make('plat_no_kendaraan')
                    ->label('Plat Kendaraan')
                    ->required(),
                
                    Select::make('produk_id')
                    ->relationship('produk', 'nama_produk')
                    ->label('Cek Stok')
                    //->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state) {
                        $produk = Produk::find($state);
                        if ($produk && $produk->stok <= 0) {
                            Notification::make()
                                ->title('Stok Habis!')
                                ->body("Stok produk \"{$produk->nama_produk}\" sudah habis.")
                                ->danger()
                                ->send();
                        }
                    }),
                
                CheckboxList::make('service')
                    ->relationship('service', 'nama_service')
                    ->label('Pilih Service')
                    ->required(),
                
                       
                Textarea::make('catatan')
                        ->label('Catatan')
                        ->required(),

                DatePicker::make('tangggal_service')
                        ->label('Tanggal Service')
                        ->required(),

                    DatePicker::make('tangggal_selesai')
                        ->label('Tanggal Selesai')
                        ->required(),
            ]);
        }

    public static function table(Table $table): Table
    {
        return $table->columns([
                Tables\Columns\TextColumn::make('index')
                        ->label('No')
                        ->rowIndex(),
                Tables\Columns\TextColumn::make('produk.nama_produk')
                        ->label('Nama Produk')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('costumer.nama_costumer')
                        ->label('Costumer')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('service.nama_service')
                        ->label('Nama Service')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('tipe_kendaraan')
                        ->label('Tipe Kendaraan')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('merek_kendaraan')
                        ->label('Merek Kendaraan')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('model_kendaraan')
                        ->label('Model Kendaraan')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('plat_no_kendaraan')
                        ->label('Plat Kendaraan')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('catatan')
                        ->label('Catatan')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('tangggal_service')
                        ->label('Tanggal Service')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('status')
                        ->label('Status')
                        ->limit(30)
                        ->wrap(),

                Tables\Columns\TextColumn::make('tangggal_selesai')
                        ->label('Tanggal Selesai')
                        ->limit(30)
                        ->wrap(),
                ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\DeleteBulkAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageServiceItems::route('/'),
        ];
    }
}
