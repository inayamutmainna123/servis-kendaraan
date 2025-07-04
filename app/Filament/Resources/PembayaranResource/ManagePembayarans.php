<?php

namespace App\Filament\Resources\PembayaranResource\Pages;

use App\Filament\Resources\PembayaranResource;
use Filament\Resources\Pages\ManageRecords;
use App\Models\Produk;
use Filament\Notifications\Notification;
use Filament\Actions;

class ManagePembayarans extends ManageRecords
{
    protected static string $resource = PembayaranResource::class;

    protected function beforeCreate(): void
    {
        $data = $this->form->getState();
        $produk = Produk::find($data['produk_id']);

        if (!$produk || $data['jumlah_barang'] > $produk->stok) {
            Notification::make()
                ->title('Stok produk tidak cukup!')
                ->danger()
                ->send();

            $this->halt();
        }
    }

    protected function afterCreate(): void
    {
        $pembayaran = $this->record;

    $produk = $pembayaran->produk;
    if ($produk) {
        $produk->stok -= $pembayaran->jumlah_barang;
        $produk->save();
    }
}

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
