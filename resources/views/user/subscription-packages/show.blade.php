@extends('layout.app')

@section('content')
    <div class="container py-4">

        <div class="card border-0 shadow-sm mb-4"
            style="background: linear-gradient(135deg, {{ $package->color ?? '#f8f9fa' }} 0%, #FFFFFF 100%);">
            <div class="card-body p-5 text-dark">
                <h1 class="fw-bold">{{ strtoupper($package->name) }}</h1>
                <p class="lead fw-semibold">{{ $package->description }}</p>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        <span class="fs-4 fw-bold">Rp. {{ number_format($package->price, 0, ',', '.') }}</span>
                        <span class="text-muted ms-2">/30 Days</span>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('subscription-packages-checkout.page', $package->id) }}" class="btn btn-primary btn-lg px-4 fw-bold shadow-sm">
            <i class="bi bi-cart-check-fill me-2"></i> Langganan Sekarang
        </a>

        {{-- form search --}}
        <form action="{{ route('subscription.books', $package->id) }}" method="GET" class="mb-4">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="search" class="form-control border-start-0" placeholder="Cari dalam paket ini"
                    value="{{ request('search') }}">
                <button class="btn btn-outline-primary" type="submit">Cari</button>
            </div>
        </form>

        <div class="row">
            @forelse ($books as $book)
                <div class="col-md-2 col-sm-4 col-6 mb-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ asset($book->cover) }}" class="card-img-top" alt="{{ $book->title }}"
                            style="height: 200px; object-fit: cover;">

                        <div class="card-body p-2 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex gap-1 mb-1">
                                    <span class="badge bg-secondary text-uppercase" style="font-size: 10px;"></span>
                                    <span class="badge bg-dark text-uppercase" style="font-size: 10px;"></span>
                                </div>

                                <h6 class="card-title fw-bold text-dark mb-1" style="font-size: 14px;">
                                    {{ $book->title }}
                                </h6>
                            </div>

                            <small class="text-muted" style="font-size: 12px;">
                                {{ $book->writer }}
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Tidak ada buku yang ditemukan dalam paket ini.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
