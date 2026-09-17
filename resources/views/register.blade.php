@extends('layout.app')

@section('content')
    {{-- arahkan submit form ke route yang namanya register.store --}}
    <form action="{{ route('register.store') }}" method="POST" class="form-fieldset w-50 bg-white mx-auto mt-5">
        @csrf
        <div class="mb-3">
            <label class="form-label required">Nama Lengkap</label>
            <input name="name" type="text" class="form-control @error('name') is-invalid
            @enderror"
                autocomplete="off" value="{{ old('name') }}" />
            @error('name')
                {{-- memanggil err validasi @eror('nama_input') --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid
            @enderror"
                autocomplete="off" value="{{ old('email') }}" />
            @error('email')
                {{-- memanggil err validasi @eror('nama_input') --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror

        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control @error('password') is-invalid
            @enderror"
                autocomplete="off" value="{{ old('password') }}" />
            @error('password')
                {{-- memanggil err validasi @eror('nama_input') --}}
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input name="password_confirmation" type="password" class="form-control @error('password') is-invalid
            @enderror"
                autocomplete="off" value="{{ old('password') }}" />
        </div>
        {{-- <label class="form-check">
            <input type="checkbox" class="form-check-input" />
            <span class="form-check-label required">I agree to the Terms & Conditions</span>
        </label> --}}
        <button type="submit" class="btn btn-primary w-100">Buat Akun</button>
    </form>
@endsection
