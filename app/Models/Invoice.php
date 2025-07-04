<?php

namespace App\Models;

use Filament\Notifications\Concerns\HasTitle;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasUlids;

    protected $table = 'invoices';

    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'pembyaran_id',
        'customer_name',
        'customer_email',
        'total',
    ];

   
    public function pembayaran()
    {
        return $this->belongsToMany(Pembayaran::class, 'id_pembayaran');
    }
}
