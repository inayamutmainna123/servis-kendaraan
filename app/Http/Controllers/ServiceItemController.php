<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceItem;
use App\Models\Service;
use App\Models\Produk;


class ServiceItemController
{
    public function create()
    {
        // Ambil semua service dan produk untuk ditampilkan di form
        $allServices = Service::all();
        $allProduks = Produk::all();

        return view('service_item.create', compact('allServices', 'allProduks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'costumer_id' => 'required|exists:costumer,id',
            'tipe_kendaraan' => 'required',
            'merek_kendaraan' => 'required',
            'model_kendaraan' => 'required',
            'plat_no_kendaraan' => 'required',
            'service' => 'required|array',
            'service.*' => 'exists:service,id',
            'produk' => 'required|array',
            'produk.*' => 'exists:produk,id',
        ]);

        $item = ServiceItem::create([
            'costumer_id' => $validated['costumer_id'],
            'tipe_kendaraan' => $validated['tipe_kendaraan'],
            'merek_kendaraan' => $validated['merek_kendaraan'],
            'model_kendaraan' => $validated['model_kendaraan'],
            'plat_no_kendaraan' => $validated['plat_no_kendaraan'],
        ]);

        $item->services()->attach($validated['service']);
        $item->produks()->attach($validated['produk']);

        return redirect()->route('service-item.index')->with('success', 'Service item berhasil disimpan!');
    }
}

