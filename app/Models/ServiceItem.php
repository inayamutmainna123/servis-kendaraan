<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasUlids;

    protected $table = "service_item";

    protected $fillable = [
        'costumer_id',
        'produk_id',
        'service_id',
        'produk_service_item_id',
        'nama_produk',
        'tipe_kendaraan',
        'merek_kendaraan',
        'model_kendaraan',
        'plat_no_kendaraan',
        'catatan',
        'status',
        'tangggal_service',
        'tangggal_selesai',
    ];

    public function costumer()
    {
        return $this->belongsTo(Costumer::class, 'costumer_id', 'id');
    }
    
    public function service_service_item()
    {
        return $this->belongsToMany(ServiceServiceItem::class, 'service_service_item_id', 'id');
    }
    public function produk_service_item()
    {
    return $this->belongsToMany(Produk::class, 'produk_service_item', 'service_item_id', 'produk_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
    
    public function service()
    {
        return $this->belongsToMany(Service::class);
    }
    
    
}
