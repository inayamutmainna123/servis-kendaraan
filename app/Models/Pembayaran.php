<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\ManageRecords;
use App\Models\Produk;
use Filament\Notifications\Notification;



class Pembayaran extends Model
{
    use HasUlids;

    protected $table = "pembayaran";

    protected $fillable = [
        'produk_id',
        'service_id',
        'harga_barang',
        'jumlah_barang', 
        'harga_service',
        'total_harga',
        'total_bayar',
        'kembalian',
        'tanggal_pembayaran',
        'status',
        'metode_pembayaran',
    ];
    
   
    protected $casts = [
        'produk_id' => 'array',
        'service_id' => 'array',
    ];
public function produk()
{
    return $this->belongsToMany(Produk::class, 'pembayaran_produk')->withPivot('jumlah_barang')->withTimestamps();
}

public function service()
{
    return $this->belongsToMany(Service::class, 'pembayaran_service')->withTimestamps();
}


    
    protected static function booted()
{
    static::creating(function ($pembayaran) {
        $pembayaran->kembalian = $pembayaran->total_bayar - $pembayaran->total_harga;
        
    });
    static::created(function ($pembayaran) {
        $produk = $pembayaran->produk;
        if ($produk) {
            $produk->stok -= $pembayaran->jumlah_barang;
            $produk->save();
        }
    });


    
}


public function hitungTotalHarga(): void
{
    $totalProduk = $this->produks->sum(function ($produk) {
        return $produk->pivot->jumlah_barang * $produk->harga_barang;
    });

    $totalService = $this->services->sum('harga_service');

    $this->total_harga = $totalProduk + $totalService;
}



    
    


}