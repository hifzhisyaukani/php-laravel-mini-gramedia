@extends('layout.app')

@section('content')
    <div class="container mt-3">

        @if (session('success'))
            <div class="alert alert-success my-3">{{ session('success') }}</div>
        @endif
        <div class="d-flex justify-content-between">
            <h3>Data Buku yang akan dipilih untuk paket langganan <b>{{ $subscriptionPackage->name }}</b></h3>

            <form action="{{ route('admin.subscription-packages.books.store', $subscriptionPackage->id) }}" id="addBookForm"
                method="POST">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Daftar Buku</span>
                        {{-- <input type="hidden" name="book_ids" id="booksIdsInput" value=""> --}}
                        <button type="submit" id="btnSubmitBooks" class="btn btn-primary d-none">
                            <i class="fas fa-plus me-1"></i> Tambah ke paket langganan (<span id="selectedCount">0</span>)
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered mt-3" id="data-buku">
                            <thead>
                                {{-- untuk checkbox --}}
                                <th></th>
                                <th>#</th>
                                <th>Sampul Buku</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                            </thead>

                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </form>
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
                ajax: "{{ route('admin.subscription-packages.books', $subscriptionPackage->id) }}",
                // isi td dari table nya
                columns: [{
                        data: 'id',
                        name: 'id',
                        searchable: false,
                        orderable: false,
                        render: function(data, type, row) {
                            if(row['checkAdded'] === 'Ya') {
                                return ''; //jika buku sudah di tambahkan tidak menampilkan checkbox
                            }
                            // tampilkan checkbox jika buku belum di tambahkan
                            return `<input type="checkbox" value="${row['id']}" name="books_ids[]" class="book-checkbox">`;
                        }
                    },
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

                    // data : dari mana field/addColumn/editColumn diambil, 
                    // name : bookCategory.name : untuk seacrh/sort carinya dari relasi 
                ]

            })
        })

        function updateButtonVisibility() {
            let checkedkCount = $('.book-checkbox:checked').length;
            $('#selectedCount').text(checkedkCount);

            if (checkedkCount > 0) {
                $('#btnSubmitBooks').removeClass('d-none');
            } else {
                $('#btnSubmitBooks').addClass('d-none');
            }

        }

        // event listener saat checkbox individu diubah
        $('#data-buku tbody').on('change', '.book-checkbox', function() {
            updateButtonVisibility();
        })
    </script>
@endpush
