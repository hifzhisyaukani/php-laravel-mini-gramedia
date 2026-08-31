@extends('layout.app')

@section('content')
    <header class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- BEGIN NAVBAR LOGO -->
            <a href="../../.." aria-label="Tabler" class="navbar-brand navbar-brand-autodark me-3">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOCvNa3r_hszq7pPtvOQKKYOepdqMsD5tJapqoyZoiAA&s=10"
                    class="navbar-brand-image"> Ebooks
            </a>
            <!-- END NAVBAR LOGO -->
            <ul class="navbar-nav mx-auto w-50">
                {{-- DROPDOWN --}}
                <div class="dropdown mt-2">
                    <a href="#" class="btn btn-light dropdown-toggle pt-2 me-2" data-bs-toggle="dropdown">Kategori</a>
                    <div class="dropdown-menu dropdown-menu-card" style="min-width: 600px">
                        <div class="p-3">
                            <div class="row g-2">
                                <div class="col-3">
                                    <div class="card py-2">
                                        <div class="card-body p-2 text-center">Kategori</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card py-2">
                                        <div class="card-body p-2 text-center">Kategori</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card py-2">
                                        <div class="card-body p-2 text-center">Kategori</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card py-2">
                                        <div class="card-body p-2 text-center">Kategori</div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card py-2">
                                        <div class="card-body p-2 text-center">Kategori</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- SEARCH BAR --}}
                <div class="input-icon w-100 py-2">
                    <input type="text" class="form-control form-control-rounded"
                        placeholder="Cari Judul, Produk, Buku, Penulis...">
                    <div class="col-auto">
                        <span class="input-icon-addon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="10" cy="10" r="7" />
                                <line x1="21" y1="21" x2="15" y2="15" />
                            </svg>
                        </span>
                    </div>
                </div>
                {{-- ICON KERANJANG --}}
                <div class="mt-3 ms-2">
                    <i class="fa-solid fa-cart-arrow-down fs-3 text-dark"></i>
                </div>
            </ul>
            <div class="flex-row order-md-last ms-auto">
                <a href="#" class="btn btn-primary">Masuk</a>
                <a href="#" class="btn btn-light">Daftar</a>

            </div>
        </div>
    </header>

    <div class="container py-4">
        <div id="carousel-sample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="2"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="3"></button>
                <button type="button" data-bs-target="#carousel-sample" data-bs-slide-to="4"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" alt=""
                        src="https://img.magnific.com/free-vector/hand-drawn-literature-twitter-header_23-2149721049.jpg?semt=ais_hybrid&w=740&q=80" />
                </div>
            </div>
            <a class="carousel-control-prev" data-bs-target="#carousel-sample" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" data-bs-target="#carousel-sample" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <div class="mt-4">
      <div class="d-flex align-items-center gap-2">
        <span class="badge bg-yellow text-yellow-fg p-2"><i class="fa-solid fa-crown fs-3"></i></span>
        <h2 class="mt-3 text-dark">Paket Langganan</h2>
      </div>

      <div class="row g-4">
        <div class="col-md-4">
          <div class="card h-100" style="background: linear-gradient(135deg, #ffffff 0%, #a7f1c6 100%)">\
            <div class="card-body row">
              <div class="col-4">
                <div class="col-6 text-center text-dark">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
