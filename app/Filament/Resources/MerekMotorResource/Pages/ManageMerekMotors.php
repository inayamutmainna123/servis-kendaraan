<?php

namespace App\Filament\Resources\MerekMotorResource\Pages;

use App\Filament\Resources\MerekMotorResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMerekMotors extends ManageRecords
{
    protected static string $resource = MerekMotorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
