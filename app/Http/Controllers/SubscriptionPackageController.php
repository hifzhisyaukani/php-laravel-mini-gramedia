<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPackage;
use Illuminate\Http\Request;

class SubscriptionPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // all : mengambil semua data dari model BookCategory dan menyimpannya ke dalam variable $bookcategorys
        $SubscriptionPackageControllers = SubscriptionPackage::all();

        return view('admin.subscription-packages.index', compact('SubscriptionPackageControllers'));
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
}
