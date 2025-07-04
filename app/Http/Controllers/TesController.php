<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class TesController
{
    
    public function cekProdukKosong()
    {
        $produkKosong = Produk::whereNull('nama_produk')->count();
        dd("Jumlah produk tanpa nama: " . $produkKosong);
    }
}


