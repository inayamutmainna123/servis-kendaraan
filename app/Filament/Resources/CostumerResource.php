<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CostumerResource\Pages;
use App\Filament\Resources\CostumerResource\RelationManagers;
use App\Models\Costumer;
use Filament\Forms;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Navigation\NavigationGroup;


class CostumerResource extends Resource
{
    protected static ?string $model = Costumer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
   
  
   
    protected static ?int $navigationSort = 0;
    
      
    public static function form(Form $form): Form
    {
        
    return $form
        ->schema([
            Forms\Components\TextInput::make('nama_costumer')
                ->label('Nama Costumer')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('no_telepon')
                ->label('No Telepon')
                ->required()
                ->maxLength(20),

            Forms\Components\Textarea::make('alamat')
                ->label('Alamat')
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
                Tables\Columns\TextColumn::make('nama_costumer')
                     ->label('Nama Costumer')
                     ->searchable(),

                Tables\Columns\TextColumn::make('email')
                     ->label('Email')
                     ->searchable(),

                Tables\Columns\TextColumn::make('no_telepon')
                     ->label('No Telepon')
                     ->searchable(),

                Tables\Columns\TextColumn::make('alamat')
                     ->label('Alamat')
                     ->searchable(),

                    
               
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
            'index' => Pages\ManageCostumers::route('/'),
        ];
    }
}
