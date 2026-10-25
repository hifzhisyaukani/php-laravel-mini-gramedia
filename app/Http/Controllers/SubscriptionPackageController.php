<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackage;
use App\Models\SubscriptionPackageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Yajra\DataTables\Facades\DataTables;

class SubscriptionPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // INI GA PAKE DATATABLES YAJRA
    // public function index()
    // {
    //     //
    //     // all : mengambil semua data dari model BookCategory dan menyimpannya ke dalam variable $bookcategorys
    //     $SubscriptionPackageControllers = SubscriptionPackage::all();

    //     return view('admin.subscription-packages.index', compact('SubscriptionPackageControllers'));
    // }

    public function index(Request $request)
    {
        //
        // all : mengambil semua data dari model BookCategory dan menyimpannya ke dalam variable $bookcategorys
        // $SubscriptionPackageControllers = SubscriptionPackage::all();

        if ($request->ajax()) {
            $model = SubscriptionPackage::query();
            // dd($model); buat mengecek format data sebelum di rubah dan juga untuk menghentikan proses jalannya program
            return DataTables::eloquent($model)
                // buat nambah nomor otomatis
                ->addIndexColumn()
                ->editColumn('color', function ($data) {
                    // Membuat elemen badge dengan background warna dari database ($data->color)
                    return '<span class="badge text-white px-3 py-2" style="background-color: ' . $data->color . '; border: 1px solid #ccc;">
                            ' . $data->color . '    
                        </span>';
                })
                // Mengedit Tampilan Kolom Price
                ->editColumn('price', function ($data) {
                    return '<strong class="text-success">Rp ' . number_format($data->price, 0, ',', '.') . '</strong>';
                })
                ->addColumn('action', function ($data) {
                    $editUrl = route('admin.subscription-packages.edit', $data->id);
                    $deleteUrl = route('admin.subscription-packages.destroy', $data->id);
                    $books = route('admin.subscription-packages.books', $data->id);

                    $csrf = csrf_field();
                    $method = method_field('DELETE');

                    $btnEdit = '<a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>';
                    $btnDelete = ' 
                                <form action="' . $deleteUrl . '"
                                    method="POST" class="d-inline"> 
                                    ' . $csrf . $method . '
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm(\'Apakah anda yakin ingin menghapus paket ini?\')">
                                        Hapus
                                    </button>
                                </form>                 
                                ';
                    $btnBooks = '
                                <a href= "' . $books . ' " class= "btn btn-sm btn-info">Books</a>';
                    return $btnEdit . $btnDelete . $btnBooks;
                })
                // menyimpan dari addColumn yang ada di html di dalamnya
                ->rawColumns(['action', 'color', 'price'])
                ->toJson();
        }

        return view('admin.subscription-packages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.subscription-packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'color' => ['required', 'string', 'max:7'],
        ]);

        SubscriptionPackage::create($validateData);

        return redirect()->route('admin.subscription-packages.index')->with('success', 'Paket langganan berhasil ditambahkan.');
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
        //
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        return view('admin.subscription-packages.edit', compact('subscriptionPackage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        $validateData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'color' => ['required', 'string', 'max:7'],
        ]);

        $subscriptionPackage->update($validateData);

        // update digunakan pada model untuk mengubah data, namun penggunaannya harus setelah proses pencarian data yang akan diubahnya
        return redirect()->route('admin.subscription-packages.index')->with('success', 'Paket Langganan telah berhasil di perbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        $subscriptionPackage->delete();
        // delete digunakan pada model untuk menghapus data, namun penggunaannya harus setelah proses pencarian data yang akan diubahnya
        return redirect()->route('admin.subscription-packages.index')->with('success', 'Paket Langganan telah berhasil di hapus');
    }

    public function checkoutPage($id)
    {
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);
        return view('user.subscription-packages.checkout', compact('subscriptionPackage'));
    }

    public function checkout(Request $request, $id) {
        $subscriptionPackage = SubscriptionPackage::findOrFail($id);

        SubscriptionPackageUser::create([
            'subscription_package_id' => $subscriptionPackage->id,
            'user_id' =>Auth::id(), //ambil id orang yang login, mendeteksi siapa user yang belinnya
            // 30 hari dari sekarang, format tahun-bulan-tanggal
            'expired_date' => now()->addDays(30)->format('Y-m-d'),
        ]);

        return redirect()->route('home')->with('success', 'Pembayaran berhasil. Terimakasih telah berlangganan!');

    }
}
