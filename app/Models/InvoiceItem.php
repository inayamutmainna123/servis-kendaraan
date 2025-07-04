<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasUlids;

    protected $table = 'invoice_items';

    protected $fillable = [
        'invoice_id',
        'dekripsi',
        'quantity',
        'harga',
        'subtotal',
    ];

    public function invoice()
{
    return $this->belongsTo(Invoice::class);
}

}
