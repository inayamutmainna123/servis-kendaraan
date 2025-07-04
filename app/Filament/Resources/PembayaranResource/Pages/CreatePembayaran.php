<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePembayaran extends CreateRecord
{
    protected static string $resource = PembayaranResource::class;

    protected function afterCreate(): void
    {
        $this->record->produk()->sync(
            collect($this->form->getState()['produk_ids'])->mapWithKeys(function ($id) {
                return [$id => ['jumlah_barang' => 1]]; // Bisa ubah jumlah di sini
            })
        );

        $this->record->service()->sync($this->form->getState()['service_ids']);
    }
}
