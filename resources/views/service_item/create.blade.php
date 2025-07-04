@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Tambah Service Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('service-items.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="costumer_id" class="form-label">Costumer ID</label>
            <input type="number" name="costumer_id" id="costumer_id" class="form-control" value="{{ old('costumer_id') }}" required>
        </div>

        <div class="mb-3">
            <label for="tipe_kendaraan" class="form-label">Tipe Kendaraan</label>
            <input type="text" name="tipe_kendaraan" id="tipe_kendaraan" class="form-control" value="{{ old('tipe_kendaraan') }}" required>
        </div>

        <div class="mb-3">
            <label for="merek_kendaraan" class="form-label">Merek Kendaraan</label>
            <input type="text" name="merek_kendaraan" id="merek_kendaraan" class="form-control" value="{{ old('merek_kendaraan') }}" required>
        </div>

        <div class="mb-3">
            <label for="model_kendaraan" class="form-label">Model Kendaraan</label>
            <input type="text" name="model_kendaraan" id="model_kendaraan" class="form-control" value="{{ old('model_kendaraan') }}" required>
        </div>

        <div class="mb-3">
            <label for="plat_no_kendaraan" class="form-label">Plat No Kendaraan</label>
            <input type="text" name="plat_no_kendaraan" id="plat_no_kendaraan" class="form-control" value="{{ old('plat_no_kendaraan') }}" required>
        </div>

        <div class="mb-3">
            <label for="service" class="form-label">Pilih Services (bisa banyak)</label>
            <select name="service[]" id="service" class="form-select" multiple required>
                @foreach ($allServices as $service)
                    <option value="{{ $service->id }}" {{ (collect(old('service'))->contains($service->id)) ? 'selected':'' }}>
                        {{ $service->nama_service }}
                    </option>
                @endforeach
            </select>
        </div>
       
        <div class="mb-3">
            <label for="produk" class="form-label">Pilih Produk (bisa banyak)</label>
            <select name="produk[]" id="produk" class="form-select" multiple required>
                @foreach ($allProduks as $produk)
                    <option value="{{ $produk->id }}" {{ (collect(old('produk'))->contains($produk->id)) ? 'selected':'' }}>
                        {{ $produk->nama_produk }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
