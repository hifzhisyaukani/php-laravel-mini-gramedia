@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Daftar Paket Langganan</h2>
            <a href="{{ route('admin.subscription-packages.create') }}"
                class="justify-content-end ms-auto btn btn-primary">Tambah
                Paket Langganan</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
    <div class="card container">
        <div class="card-body">
            <table class="table table-bordered table-responsive bg- ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Deskripsi</th>
                        <th>Warna</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- penggunaan foreach karena subscriptionPackages merupakan array multidimensi maka package akan berupa array assosiatif. mengaksesnya dengan menggunakan -> --}}
                    @foreach ($SubscriptionPackageControllers as $package)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- loop iteration fungsinya untuk menampilkan nomor urut --}}
                            <td>{{ $package->name }}</td>
                            <td>{{ $package->description }}</td>
                            <td>{{ $package->color }}</td>
                            <td>Rp. {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.subscription-packages.edit', $package->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>

                                <form action="{{ route('admin.subscription-packages.destroy', $package->id) }}"
                                    method="POST" class="d-inline"> @csrf

                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus paket ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
