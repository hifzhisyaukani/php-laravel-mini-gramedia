@extends('layout.app')

@section('content')
<form action="{{ route('admin.books.update', $book->id) }}" method="POST" class="card w-75 d-block mx-auto" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- @if ($errors->any())
            @foreach ($errors->all() as $item)
                <li>{{ $item }}</li>
            @endforeach
        @endif --}}
        <div class="card-header">
            <h3>Edit Buku</h3>
        </div>

        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <label for="book_category_id" class="form-label">Kategori Buku</label>
                    <select name="book_category_id" id="category_id" class="form-select">
                        <option disabled hideen selected value="{{ old('book_category_id') }}">--pilih---</option>
                        {{-- opsi kategori buku sesuai dengan data yang dari controller(db) --}}
                        @foreach ($bookCategories as $category)
                            <option value= "{{ $category->id }}"
                                {{ old('book_category_id', $book->book_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category['name'] }}</option>
                        @endforeach
                    </select>

                    @error('book_category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="title" class="form-label">Judul</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $book->title) }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" name="writer" id="writer" class="form-control"
                        value="{{ old('writer', $book->writer) }}">
                    @error('author')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" name="publisher" id="publisher" class="form-control"
                        value="{{ old('publisher', $book->publisher) }}">
                    @error('publisher')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="price" id="price" class="form-control"
                        value="{{ old('price', $book->price) }}">
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="bahasa" class="form-label">Bahasa</label>
                    {{-- <input type="text" name="language" id="language" class="form-control"> --}}
                    @php
                        $language = [
                            'Indonesia' => 'Indonesia',
                            'English' => 'English',
                            'Japan' => 'Japan',
                            'Arabic' => 'Arabic',
                        ];
                    @endphp
                    <select name="language" id="language" class="form-select">
                        <option disabled hidden selected value="{{ old('language', $book->language) }}">--pilih---</option>
                        @foreach ($language as $lang)
                            <option value="{{ $lang }}"
                                {{ old('language', $book->language) == $lang ? 'selected' : '' }}>{{ $lang }}
                            </option>
                        @endforeach
                        @error('language')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="release_date" class="form-label">Tanggal terbit</label>
                    <input type="date" name="release_date" id="release_date" class="form-control"
                        value="{{ old('release_date', $book->release_date) }}">
                    @error('release_date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-6">
                    <label for="page_of_book" class="form-label">Jumlah halaman</label>
                    <input type="text" name="page_of_book" id="page_of_book" class="form-control"
                        value="{{ old('page_of_book', $book->page_of_book) }}">
                    @error('page_of_book')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 mb-3">
                    <label for="cover" class="form-label">Sampul Buku</label>
                    {{-- preview sampul lama --}}
                    @if ($book->cover)
                        <div class="mb-2">
                            <img src="{{ asset($book->cover) }}" alt ="Cover {{ $book->title }}" class="img-thumbnail"
                                style="max-width: 120px;">
                            <small class="text-muted d-block mt-1">Biarkan Kosong jika tidak ingin mengubah sampul</small>
                        </div>
                    @endif
                        <div class="col-12">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <div id="description">

                            </div>
                            <input type="hidden" name="description" id="description-input"
                                value="{{ old('description', $book->description) }}">
                            {{-- <textarea name="description" id="description" rows="5" class="form-control"></textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror --}}
                        </div>
                </div>
                <div class="row" style="margin-top: 8%">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>

            </div>
    </form>

    {{-- modal detail --}}
    <div class="modal modal-blur fade" id="modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-4">
                            <img src="" id="data-cover" alt="">
                        </div>

                        <div class="col-4">
                            <div style="height: 50px"></div>
                            <h3 class="text-primary" id="data-title"></h3>
                            <p id="data-category" class="badge badge-primary "></p>
                        </div>
                        <div>
                            <p>Harga <br><span id="data-price" class="text-success"></span></p>
                            <p>Penulis <br><span id="data-publisher"></span></p>
                            <p>Tanggal rilis <br><span id="data-release-date"></span></span></p>
                        </div>
                    </div>

                    <div class="col-4">
                        <div style="height: 50px"></div>
                        <div>
                            <p>Penulis <br><span id="data-writer"></span></p>
                            <p>Bahasa <br><span id="data-language"></span></p>
                            <p>Jumlah Halaman <br><span id="data-page-of-book"></span>halaman</p>
                        </div>
                    </div>

                </div>
                {{-- Button kirim --}}
                <div class="modal-footer">
                    <a href="{{ route('admin.books.index') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Ubah Data</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
{{-- library DOMpurify untuk sanitasi XSS agar aman --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dompurify/3.0.8/purify.min.js"></script>
    <script>
        
        const quill = new Quill('#description', {
            theme: 'snow'
        });

        const description = document.getElementById('description-input');

        // document.querySelector("description-input").value = ".";

        if(description.value) {
            // quill.clipboard.dangerouslyPasteHTML(descriptionInput.value);
            quill.clipboard.dangerouslyPasteHTML(description.value);
        }
        // isi nilai awal ke input hidden deskripsi
        document.querySelector("#description-input").value = "-";
        // ketika rich text editornya isi teks nya diubah, maka update value hidden
        quill.on('text-change', function() {
            // isi nilai input hidden dengan dta di rich text editornya
            document.querySelector("#description-input").value = quill.root.innerHTML;
        })
    </script>
@endpush
