<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesController;

Route::get('/cek-nama-barang-kosong', [TesController::class, 'cekBarangKosong']);
use App\Http\Controllers\ServiceItemController;

Route::get('/service-item/create', [ServiceItemController::class, 'create'])->name('service-item.create');
Route::post('/service-item', [ServiceItemController::class, 'store'])->name('service-item.store');


 
    

