<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; //hash
use Illuminate\Support\Facades\Auth; //auth
use Illuminate\Validation\Rules\Password;

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
            'email' => ['required', 'email', 'unique:users,email', 'email:rfc,dns', 'max:255'],
            // confirmed : di form ada inputan "konfirmasi password"
            // uncompromised : mengecek pw yang di buat apakah sudah pernah di bobol
            'password' => ['required', 'min:8', 'max:10', 'confirmed', Password::min(8)->max(10)->uncompromised()],
            
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
            'password.confirmed' => 'Konfirmasi Password tidak sesuai dengan password yang di berikan'
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

        // // untuk proses auth ambil data selain _token (email & password aja)
        $auth = $request->except(['_token']);

        // // Auth:atempt :
        // // 1. cek pasangan email-pw benar atau salah
        // // 2. kalau bener, simpan data di session/cookies web
        // // 3. kalah salah, tentukan aksi yang akan dilakukan

        // $checkAuth = Auth::attempt($auth);
        // if($checkAuth) {
        //     // bikin ulang ID session
        //     $request->session()->regenerate();
        //     return redirect()->route('home')->with('success', 'Berhasil Login');
        // } else {
        //     return redirect()->route('login')->with('error', 'Email dan password salah. Coba lagi!')->withInput();
        // }

        if(Auth::attempt($validateData)) {
            $request->session()->regenerateToken();

            if(Auth::user()->role == "admin") {
                return redirect()->route('admin.dashboard')->with('succsess', 'Berhasil Login');
            } else {
                return redirect()->route('home')->with('succsess', 'Berhasil Login');
            }
        } else {
            return redirect()->route('login')->with('erorr', 'Email dan password salah. Coba lagi!')->withInput();
        }

    }

    public function logout(Request $request) {
        Auth::logout();
        // MEMASTIKAN SEMUA SESSION YANG ADA DIBUAT INVALID / EXPIRED
        $request->session()->invalidate();
        // bikin ulang token session baru, contoh tokennya token csrf
        $request->session()->regenerateToken();


        return redirect()->route('home')->with('success','Berhasil Logout!');
    }
};