<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; //hash
use Illuminate\Support\Facades\Auth; //auth

class UserController extends Controller
{
    // $request -> mengambil value data: bisa dari input atau url
    public function register(Request $request)
    {
        // validasi
        // argumen wajib
        $validate = $request->validate([
            // 'nama_input' => ['jenis_validasi']
            'name' => ['required', 'min:3'], // 'name' harus sama dengan name=''
            // unique:table,email = data email tidak boleh duplikat
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'max:10']
        ], [
            // teks err yang bakal muncul kalau validasi gagal
            // 'nama_input.jenis_validasi' => 'pesan
            
            // argumen 2
            'name.required' => 'Nama lengkap harus diisi',
            'name.min' => 'Nama lengkap harus diisi minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email harus diisi dengan data yang belum terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password harus diisi minimal 8 karakter',
            'password.max' => 'Password harus diisi hanya sampai 10 karakter',
        ]);

        // simpan data ke database model
        // ELOQUENT
        $createAccount = User::create([
            // nama field => isi data
            'name' => $validate['name'],
            'email' => $validate['email'],

            // hash::make => mengubah pw plain text menjadi acak yang tidak bisa dibaca/dikembalikan ke text aslinya
            'password' => Hash::make($validate['password']),
        ]);

        // menentukan jika berhasil sidimpan akan siarahkan ke halaman mana : return redirect()=>route()
        // mengirikan session untuk notifikasi/info berhasil : with('nama', 'pesan')

        return redirect()->route('login')->with('success', 'Berhasil membuat akun! silahkan login.');
    }

    public function login(Request $request)
    {
        $validateData  = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
        ]);

        // untuk proses auth ambil data selain _token (email & password aja)
        $auth = $request->except(['_token']);

        // Auth:atempt :
        // 1. cek pasangan email-pw benar atau salah
        // 2. kalau bener, simpan data di session/cookies web
        // 3. kalah salah, tentukan aksi yang akan dilakukan

        $checkAuth = Auth::attempt($auth);
        if($checkAuth) {
            return redirect()->route('home')->with('success', 'Berhasil Login');
        } else {
            return redirect()->route('login')->with('error', 'Email dan password salah. Coba lagi!')->withInput();
        }
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('home')->with('success','Berhasil Logout!');
    }
};