@extends('layout.app')

@section('content')
    <div class="card mt-5 w-50 d-block mx-auto">
        <div class="card-header">
            <h1>Tambah Paket Langganan</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.subscription-packages.store') }}" method="POST">
                {{-- setiap form harus memiliki method POST/GET selain itu gunakan fungsi @method() --}}
                @csrf
                {{-- csrf digunakan untuk mencegah request yang tidak sah --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Paket</label>
                    {{-- old('name', $SubscriptionPackageControllers->name) : jika ada error validasi, tampilkan nilai nilai sebelumnya pada inputan ini, jika tidak ada, tampilkan nilai dari $SubscriptionPackageControllers->name --}}
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"required placeholder="Romance">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    {{-- old('description', $SubscriptionPackageControllers->description) : jika ada error validasi, tampilkan nilai nilai sebelumnya pada inputan ini, jika tidak ada, tampilkan nilai dari $SubscriptionPackageControllers->description --}}
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required placeholder="Deskripsi paket langganan"></textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Warna</label>
                    {{-- old('color', $SubscriptionPackageControllers->color) : jika ada error validasi, tampilkan nilai nilai sebelumnya pada inputan ini, jika tidak ada, tampilkan nilai dari $SubscriptionPackageControllers->color --}}
                    <input type="color" name="color" id="color"
                        class=" rounded @error('color') is-invalid @enderror"
                        placeholder="#FFFFFF" required>

                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    {{-- old('price', $SubscriptionPackageControllers->price) : jika ada error validasi, tampilkan nilai nilai sebelumnya pada inputan ini, jika tidak ada, tampilkan nilai dari $SubscriptionPackageControllers->price --}}
                    <input type="text" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror"
                        placeholder="40.000" required>
 
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
