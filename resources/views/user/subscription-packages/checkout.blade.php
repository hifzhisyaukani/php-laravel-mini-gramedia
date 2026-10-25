@extends('layout.app')

@section('content')
    <div class="container my-5">
        <h3>Pembayaran</h3>
        <div class="row mt-3">
            {{-- section untuk QRcode --}}
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="text-center">Scan QRCode</h3>
                        <p class="text-center text-secondary">
                            Gunakan aplikasi e-wallet atau m-banking Anda untuk memindai kode di bawah ini
                        </p>
                        <div class="d-flex justify-content-center">
                            {{-- Gambar QRCode --}}
                            <div class="col-3 ms-2">
                                {!! QrCode::size(250)->generate($subscriptionPackage->id) !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- section untuk detail Pembayaran --}}
            <div class="col-4 px-2">
                <div class="card">
                    <form method="POST" action="{{ route('subscription-packages.checkout', $subscriptionPackage->id) }}" class="card-body">
                        @csrf
                        <h4>Detail Pembelian</h4>
                        <div class="d-flex justify-content-between ps-2">
                            <p>Total item</p>
                            <p class="text-secondary">1</p>
                        </div>
                        <h4>Sub Total</h4>
                        <div class="d-flex justify-content-between ps-2">
                            <p>Total Harga</p>
                            <p class="text-secondary">Rp {{ number_format($subscriptionPackage->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="d-flex justify-content-between ps-2 text-danger">
                            <p>Total Diskon</p>
                            <p class="text-secondary">Rp {{ number_format($subscriptionPackage->price * 0.2, 0, ',', '.') }}
                            </p>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p>Total Bayar</p>
                            <h4 class="text-primary">Rp{{ number_format($subscriptionPackage->price, 0, ',', '.') }}</h4>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pil mt-2 w-100">Bayar sekarang</button>
                    </form>
                </div>
            </div>
        </div>



    </div>
@endsection
