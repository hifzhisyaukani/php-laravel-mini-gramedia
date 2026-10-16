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
            <table class="table table-bordered table-responsive bg-white" id="subscription-packages-table">
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
                    {{-- penggunaan foreach karena subscriptionPackages merupakan array multidimensi maka package akan
                    berupa array assosiatif. mengaksesnya dengan menggunakan -> --}}
                    {{-- @foreach ($SubscriptionPackageControllers as $package)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        {{-- loop iteration fungsinya untuk menampilkan nomor urut --}}
                    {{-- <td>{{ $package->name }}</td>
                        <td>{{ $package->description }}</td>
                        <td>{{ $package->color }}</td>
                        <td>Rp. {{ number_format($package->price, 0, ',', '.') }}</td>
                        <td>

                        </td>
                    </tr>
                    @endforeach --}}

                    <!-- ini dikosongin karena akan otomatis di isi oleh data tabel yajra -->
                </tbody>
            </table>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            // Memilih tabel berdasarkan ID-nya dan menginisialisasi DataTables
            $("#subscription-packages-table").DataTable({
                // Menampilkan indikator loading saat mengambil data
                processing: true,
                // Memproses data di sisi server/controller
                ServerSide: true,
                // URL route ke controller index yang mengirimkan data JSON Yajra
                ajax: "{{ route('admin.subscription-packages.index') }}",
                // Urutan kolom (sesuai urutan <th> di atas)
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'color',
                        name: 'color',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'price',
                        name: 'price',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
            });
        })
    </script>
@endpush
