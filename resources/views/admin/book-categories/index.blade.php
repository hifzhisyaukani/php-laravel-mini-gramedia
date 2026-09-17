@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-content-between align-items-center mb-3">
            <h2>Tambah Kategori Buku</h2>
            <a href="{{ route('admin.book-categories.create') }}" class="justify-content-end ms-auto btn btn-primary">Tambah
                Kategori Buku</a>
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
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- penggunaan foreach karena bookCategories merupakan array multidimensi maka bookCategory akan berupa array assosiatif. mengaksesnya dengan menggunakan -> --}}
                    @foreach ($bookCategorys as $bookCategory)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            {{-- loop iteration fungsinya untuk menampilkan nomor urut --}}
                            <td>{{ $bookCategory->name }}</td>
                            <td>
                                <a href="{{ route('admin.book-categories.edit', $bookCategory->id) }}"
                                    class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.book-categories.destroy', $bookCategory->id) }}"
                                    method="POST" class="d-inline"> @csrf

                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Apakah anda yakin ingin menghapus kategori ini?')">
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