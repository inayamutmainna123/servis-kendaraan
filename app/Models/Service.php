<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasUlids;

    protected $table = "service";

    protected $fillable = [
        'produk_id',
        'pembayaran_id',
        'service_item_id',
        'service_service_item_id',
        'nama_service',
        'deskripsi',
        'harga_service',
    ];
    public function produk()
    {
    return $this->belongsTo(Produk::class, 'produk_id');
    }
    public function service_service_item()
    {
        return $this->belongsToMany(ServiceServiceItem::class,'service_service_item_id');
    }
    
    public function serviceItem()
    {
        return $this->belongsToMany(ServiceItem::class,' service_item_id');
    }
    public function pembayaran()
    {
    return $this->belongsToMany(Pembayaran::class, 'pembayaran_service')
        ->withTimestamps();
    }


}
