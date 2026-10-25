<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\SubscriptionPackageBook;


class SubscriptionPackageBookController extends Controller
{
    public function show($subscriptionPackageId, Request $request)
    {
        $subscriptionPackage = SubscriptionPackage::findOrFail($subscriptionPackageId);

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
                ->addColumn('checkAdded', function ($row) use ($subscriptionPackage) {
                    // pluck : ambil semua dari book_id dari subscriptionPackageBook, lalu ubah menjadi array
                    $subscriptionPackageBook = $subscriptionPackage->subscriptionPackageBooks()
                        ->pluck('book_id')
                        ->toArray();
                    // cek apakah book_id dari row ada dalam array subscriptionPackageBook, jika ada maka buku sudah tertaut dengan paket langganan ini (checkbox dihilangkan)
                    return in_array($row->id, $subscriptionPackageBook) ? 'Ya' : 'Tidak';
                })
                ->rawColumns(['coverImg'])
                ->toJson();
        }
        return view('admin.subscription-packages.books', compact('subscriptionPackage'));
    }

    public function store(Request $request, $id)
    {
        $bookIds = $request->books_ids;
        foreach ($bookIds as $bookId) {
            SubscriptionPackageBook::create([
                'subscription_package_id' => $id,
                'book_id' => $bookId,
            ]);
        }

        return redirect()->back()->with('success', 'Buku berhasil di tambahkan ke paket langganan');
    }


}
