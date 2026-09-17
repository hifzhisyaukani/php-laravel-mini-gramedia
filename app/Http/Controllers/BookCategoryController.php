<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // all : mengambil semua data dari model BookCategory dan menyimpannya ke dalam variable $bookcategorys
        $bookCategorys = BookCategory::all();

        return view('admin.book-categories.index', compact('bookCategorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.book-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        BookCategory::create($validateData);

        return redirect()->route('admin.book-categories.index')->with('success', 'Kategori buku berhasil ditambahkan.');
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
    public function edit(string $id)
    {
        $bookCategory = BookCategory::findOrFail($id);

        return view('admin.book-categories.edit', compact('bookCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bookCategory = BookCategory::findOrFail($id);

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $bookCategory->update($validateData);

        // update digunakan pada model untuk mengubah data, namun penggunaannya harus setelah proses pencarian data yang akan diubahnya
        return redirect()->route('admin.book-categories.index')->with('success', 'Kategori buku telah berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookCategory = BookCategory::findOrFail($id);

        $bookCategory->delete();
        // delete digunakan pada model untuk menghapus data, namun penggunaannya harus setelah proses pencarian data yang akan diubahnya
        return redirect()->route('admin.book-categories.index')->with('success', 'Kategori buku telah berhasil di hapus');
    }
}