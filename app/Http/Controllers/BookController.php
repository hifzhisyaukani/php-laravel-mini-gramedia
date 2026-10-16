<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookCategory;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;
use Yajra\DataTables\Facades\DataTables;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $model = Book::query();

            return DataTables::eloquent($model)
                ->addIndexColumn()
                // asset : mengambil alamat file dari storage/public/covers/namafile.jpg
                ->addColumn('coverImg', function ($data) {
                    return '<img src="' . asset($data->cover) . '" alt="Cover" width="100" class="d-block mx-auto">';
                })
                // ->
                ->editColumn('price', function ($row) {
                    return 'Rp ' . number_format($row->price, 0, ',', '.');
                })
                ->editColumn('book_category_id', function ($row) {
                    // book category diambil dari func relasi yang ada di model book 
                    return $row->bookCategory->name;
                })
                ->addColumn('action', function ($row) {
                    $btnEdit = '<a href="' . route('admin.books.edit', $row->id) . '" class="btn btn-primary me-2">Edit</a>';
                    $btnDelete = ' 
                            <form action="' . route('admin.books.destroy', $row->id) . '"
                                method="POST" class="d-inline"> 
                                ' . csrf_field() . method_field('DELETE') . '
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>';
                    $btnDetail = '<button type="button"
                 class="btn btn-primary" id="btn-detail"
                  data-cover="' . asset($row->cover) . '" 
                  data-title="' . $row->title . '" 
                  data-category="' . $row->bookCategory->name . '" 
                  data-writer="' . $row->writer . '"
                  data-publisher="' . $row->publisher . '"  
                  data-language="' . $row->language . '"
                  data-price="' . 'Rp ' . number_format($row->price, 0, ',', '.') . '" 
                  data-page-of-book="' . $row->page_of_book . '"
                  data-description="' . htmlspecialchars($row->description) . '"
                  data-release-date="' . date('d M Y', strtotime($row->release_date)) . '"
                  >
                  Detail
                  </button>';

                    return $btnDetail . $btnEdit . $btnDelete;
                })
                ->rawColumns(['coverImg', 'action'])
                ->toJson();
        };
        return view('admin.books.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $bookCategories = BookCategory::all();
        return view('admin.books.create', compact('bookCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'cover' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg'],
            'title' => ['required'],
            'writer' => ['required'],
            'publisher' => ['required'],
            'price' => ['required', 'numeric'],
            'language' => ['required'],
            'description' => ['nullable'],
            // exists: table, field = data harus udah ada di table book_categories field id
            'book_category_id' => ['required', 'exists:book_categories,id'],

            'page_of_book' => ['required', 'numeric'],
            'release_date' => ['required', 'date'],
        ]);

        if ($request->file('cover')) {
            $cover = $request->file('cover');
            // bikin nama file dari waktu gambah upload di sambungkan "." ekstensi file : 123456.jpg (contoh hasil nama file)
            $namaFile = time() . "." . $cover->getClientOriginalExtension();
            // disk : penyimpanan storage  ( nanti di ganti ke layanan cloud setelah di hosting)
            // putFileAs : ('namaFolder', file_yang_disimpan, 'namaFile')
            Storage::disk('public')->putFileAs('covers', $cover, $namaFile);
            // ambil alamat gambar untuk disimpan di database, timpa data coveer di validasi dengan alamat gambah yang udah di uploud
            $validateData['cover'] = Storage::url('covers/' . $namaFile);
        }

        // Simpan data ke model book, data yang disimpan data data dari hasil validasi 
        Book::create($validateData);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil membuat data buku baru!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
        $bookCategories = BookCategory::all();
        return view('admin.books.edit', compact('bookCategories', 'book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
        // $book = Book::findOrFail($book->id);

        $validateData = $request->validate([
            'cover' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp,avif', "max:2048"],
            'title' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
            'language' => ['required', 'string', 'max:255'],
            'writer' => ['required', 'string', 'max:255'],
            'release_date' => ['required', 'date'],
            'page_of_book' => ['required', 'integer'],
            'book_category_id' => ['required', 'exists:book_categories,id'],
        ]);

        //    handle file upload for cover image
        // handle file upload for cover image
        if ($request->hasFile('cover')) {
            if ($book->cover) {
                // ambil nama file asli dari URL contoh : "/storage/covers/123456.jpg -> 123456.jpg" -> "cover/123.jpg"
                $oldImagePath = str_replace('/storage/', '', $book->cover);
                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->delete($oldImagePath);
                }
            }

            // PERBAIKAN: Gunakan file(), bukan hasFile()
            $cover = $request->file('cover');

            $coverImageName = time() . '.' . $cover->getClientOriginalExtension();

            Storage::disk('public')->putFileAs('covers', $cover, $coverImageName);
            // set path URL cover baru ke array data yang di validasi agar bisa di update ke database
            $validateData['cover'] = Storage::url('covers/' . $coverImageName);
        }

        $book->update($validateData);
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
        if ($book->cover) {
            $oldImagePath = str_replace('/storage/', '', $book->cover);

            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->delete($oldImagePath);
            }
        }

        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
