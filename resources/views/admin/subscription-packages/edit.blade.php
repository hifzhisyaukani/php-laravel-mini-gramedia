@extends('layout.app')
@section('content')
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-header">
            <h1>Edit Paket Langganan</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.subscription-packages.update', $subscriptionPackage->id) }}" method="POST">
                @csrf

                {{-- override method: mengganti method="POST" menjadi PUT sesuai dengan HTTP method yang ada di routenya --}}
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nama Paket</label>
                    {{-- old('name', $subscriptionPackage->name) : jika ada error validasi, tampilkan nilai nilai sebelumnya pada inputan ini, jika tidak ada, tampilkan nilai dari $subscriptionPackage->name --}}
                    <input type="text" name="name" id="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $subscriptionPackage->name) }}" required>

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi</label>
                    {{-- old('description', $subscriptionPackage->description) : jika ada error validasi, tampilkan nilai nilai sebelumnya pada inputan ini, jika tidak ada, tampilkan nilai dari $subscriptionPackage->description --}}
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $subscriptionPackage->description) }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="color" class="form-label">Warna</label>
                    {{-- old('color', $subscriptionPackage->color) : jika ada error validasi, tampilkan nilai nilai sebelumnya pada inputan ini, jika tidak ada, tampilkan nilai dari $subscriptionPackage->color --}}
                    <input type="text" name="color" id="color"
                        class="form-control @error('color') is-invalid @enderror"
                        value="{{ old('color', $subscriptionPackage->color) }}" placeholder="#FFFFFF" required>

                    @error('color')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    {{-- old('price', $subscriptionPackage->price) : jika ada error validasi, tampilkan nilai nilai sebelumnya pada inputan ini, jika tidak ada, tampilkan nilai dari $subscriptionPackage->price --}}
                    <input type="text" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror"
                        value="{{ old('price', $subscriptionPackage->price) }}" placeholder="0.00" required>

                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
