<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasUlids;

    protected $table = "produk";

    protected $fillable = [
        "service_item_id",
        "produk_id",
        'nama_produk',
        'attachment',
        'harga_barang',
        'deskripsi',
        'stok',
    ];

    public function serviceItems()
{
    return $this->belongsToMany(ServiceItem::class, 'product_service_item', 'produk_id', 'service_item_id');
}
public function pembayarans()
{
    return $this->belongsToMany(Pembayaran::class, 'pembayaran_produk')
        ->withPivot('jumlah_barang')
        ->withTimestamps();
}


}
