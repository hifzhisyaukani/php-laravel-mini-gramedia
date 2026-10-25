<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;
use App\Models\BookCategory;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $subscriptionPackages = SubscriptionPackage::latest()->take(3)->get();
        $latestBooks = Book::orderBy('created_at', 'desc')->limit(10)->get();
        $freeBooks = Book::where('price', 0)->orderBy('created_at', 'desc')->limit(6)->get();

        return view('home', compact('subscriptionPackages', 'latestBooks', 'freeBooks'));
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $books = Book::where('title', 'like', '%' . $query . '%')
            ->orWhere('writer', 'like', '%' . $query . '%')
            ->get();

        return view('search_result', compact('books', 'query'));
    }

    public function categoryBooks(Request $request, $id)
    {
        $category = BookCategory::findOrFail($id);


        $booksQuery = Book::where('book_category_id', $id);

        // research
        if ($request->filled('q')) {
            $q = $request->q;
            $booksQuery->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('writer', 'like', "%{$q}%");
            });
        }

        // (Termurah, Termahal, Terbaru)
        if ($request->sort == 'cheapest') {
            $booksQuery->orderBy('price', 'asc');
        } elseif ($request->sort == 'expensive') {
            $booksQuery->orderBy('price', 'desc');
        } else {
            $booksQuery->orderBy('created_at', 'desc');
        }
        $books = $booksQuery->get();
        // dd($books);
        return view('category_books', compact('category', 'books'));
    }

    public function subscriptionBooks(Request $request, $id)
    {
        $package = SubscriptionPackage::findOrFail($id);

        // Ambil daftar ID buku yang terhubung ke paket ini
        $bookIds = $package->subscriptionPackageBooks->pluck('book_id');

        //Ambil data buku & filter otomatis jika user mengetik pencarian
        $books = Book::whereIn('id', $bookIds)
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('writer', 'like', "%{$search}%");
            })
            ->get();

        return view('user.subscription-packages.show', compact('package', 'books'));
    }


}
