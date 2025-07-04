<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class ServiceServiceItem extends Model
{
    use HasUlids;
    
    protected $table = "service_service_item";
    
    protected $fillable =[
        'service_id',
        'produk_id',
        'service_item_id',

    ];

    public function service()
{
    return $this->belongsToMany(Service::class , 'service_id');
}
public function produk()
{
    return $this->belongsToMany(Produk::class ,'produk_id');
}
    public function serviceItem()
    {
        return $this->belongsTo(ServiceItem::class ,'service_item_id');
        
    }
    
public function getServisItemNamaAttribute()
{
    $barang = service::find($this->servis_item_id);
    if ($barang) {
        return 'Barang - ' . $barang->nama_barang;
    }
    $servis = service::find($this->servis_item_id);
    if ($servis) {
        return 'Servis - ' . $servis->nama_servis;
    }
    return '-';
}
}
