@extends('layout.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-center mb-2">Hasil Pencarian</h2>
        <p class="text-center text-secondary">Kata kunci: "{{ $query }}"</p>

        @if ($books->isEmpty())
            <p class="text-center">Tidak ada buku yang cocok dengan pencarian "{{ $query }}".</p>
        @else
            <div class="row g-3 mt-3">
                @foreach ($books as $book)
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="card h-100" style="padding: 0.75rem; border-radius: 16px;">
                            <div class="card-body d-flex flex-column">
                                <img class="d-block mx-auto w-40 h-50" alt="Sampul {{ $book->title }}"
                                    src="{{ asset($book->cover) }}" />
                                <div class="d-flex gap-2 mt-2">
                                    <span class="badge"><i class="fa-solid fa-mobile"></i> PDF</span>
                                </div>
                                <div class="mt-2">
                                    <p class="small text-secondary mb-1">{{ $book->writer }}</p>
                                    <h3 class="h4">{{ $book->title }}</h3>
                                    <p class="h4 fw-bold mt-auto mb-0">
                                        Rp {{ number_format($book->price, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
