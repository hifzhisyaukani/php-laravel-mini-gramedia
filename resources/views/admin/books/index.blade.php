@extends('layout.app')

@section('content')
    <div class="container mt-3">

        @if (session('success'))
            <div class="alert alert-succsess my-3">{{ session('success') }}</div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Data Buku</h3>
            <a href="{{ route('admin.books.create') }}" class="btn btn-success">Tambah Data Buku</a>

        </div>

        <table class="table table-bordered mt-3" id="data-buku">
            <thead>
                <th>#</th>
                <th>Sampul Buku</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Aksi</th>
            </thead>

            <tbody></tbody>
        </table>
    </div>

    {{-- modal detail buku --}}
    <div class="modal modal-blur fade " id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" {{-- modal-lg = untuk mengatur ukuran --}} role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <img src="" id="data-cover" width="180" alt="">
                        </div>
                        <div class="col-4">
                            <div style="height: 50px">
                                <h3 class="text-primary" id="data-title"></h3>
                                <p class="badge badge-primary" id="data-category"></p>
                            </div>
                            <div>
                                <p>Harga <br> <span id="data-price" class="text-success"></span></p>
                                <p>Penerbit <br> <span id="data-publisher"></span></p>
                                <p>Tanggal Rilis <br> <span id="data-release-date"></span></p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div style="height: 50px"></div>
                            <div>
                                <p>Penulis <br> <span id="data-writer"></span></p>
                                <p>Bahasa <br> <span id="data-language"></span></p>
                                <p>Jumlah Halaman <br> <span id="data-page-of-book"></span> halaman</p>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <!-- Judul Bagian -->
                            <h6 class="text-secondary fw-bold text-uppercase mb-2" style="letter-spacing: 1px;">Deskripsi
                                Buku</h6>

                            <!-- Kotak Deskripsi dengan Scrollbar -->
                            <div class="border rounded bg-light p-3" style="max-height: 200px; overflow-y: auto;">
                                <span id="data-description"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#data-buku").DataTable({
                //menampilkan ikon loading
                processing: true,
                // menggunakan server side (data diproses di controller)
                serverSide: true,
                // routing yang memproses datatables
                ajax: "{{ route('admin.books.index') }}",
                // isi td dari table nya
                columns: [
                    // data dan name : nama kolom, seacrhable : bisa di seacrh ga datanya, orderable: bisa di urutin ga datanya
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'coverImg',
                        name: 'coverImg',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'title',
                        name: 'title',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'book_category_id',
                        name: 'bookCategory.name',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'price',
                        name: 'price',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    // data : dari mana field/addColumn/editColumn diambil, 
                    // name : bookCategory.name : untuk seacrh/sort carinya dari relasi 
                ]
            })
        })

        // proses memunculkan modal ketika btn-detail di klik
        $(document).on('click', '#btn-detail', function() {
            const btn = $(this);
            // ambil data attribute data-title="" yang dikirim di datatable controller
            let title = btn.data('title');
            let category = btn.data('category');
            let writer = btn.data('writer');
            let publisher = btn.data('publisher');
            let language = btn.data('language');
            let price = btn.data('price');
            let releaseDate = btn.data('release-date');
            let pageofBook = btn.data('page-of-book');
            let description = btn.data('description');

            // simpan data ke span yang di kosongkan
            $('#data-title').text(title);
            $('#data-category').text(category);
            $('#data-writer').text(writer);
            $('#data-publisher').text(publisher);
            $('#data-language').text(language);
            $('#data-price').text(price);
            $('#data-release-date').text(releaseDate);
            $('#data-page-of-book').text(pageofBook);
            $("#data-description").html(description || '-');

            // isi src gambar di    modal dengan data cover yang dikirim dari di data tabel controller
            let cover = btn.data('cover');
            $('#data-cover').attr('src', cover);

            // panggil modal, memunculkan
            $('#modal-detail').modal('show');
        });
    </script>
@endpush
