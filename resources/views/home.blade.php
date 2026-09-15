    {{-- ambil konten dari folder layout file app --}}
    @extends('layout.app')

    @push('style')
        <style>
            .slick-prev::before,
            .slick-next::before {
                color: #333;
                font-size: 30px;
            }
        </style>
    @endpush

    @section('content')
        <div class="container py-4">
            @if (Session::get('success'))
                <div class="alert alert-important alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>{{ Session::get('success') }}</div>
                    </div>
                    <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif


            @if (Session::get('error'))
                <div class="alert alert-important alert-danger alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>{{ Session::get('error') }}</div>
                    </div>
                    <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

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
                            src="https://static.vecteezy.com/system/resources/previews/023/107/441/non_2x/promo-banner-with-with-reading-stack-of-books-lantern-with-candle-plant-school-books-pile-world-book-day-bookstore-bookshop-library-book-lover-bibliophile-education-for-poster-cover-vector.jpg" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" alt=""
                            src="https://static.vecteezy.com/system/resources/previews/023/107/439/non_2x/promo-banner-with-stack-of-books-globe-inkwell-quill-plant-lantern-ebook-world-book-day-bookstore-bookshop-library-book-lover-bibliophile-education-for-poster-cover-advertising-vector.jpg" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" alt=""
                            src="https://previews.123rf.com/images/leoedition/leoedition1708/leoedition170800389/84001982-banner-book-store-book-shelf-or-bookcase-on-the-background.jpg" />
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" alt=""
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0nrgi3z38YaMkPnCRpJH1wQoZjbjEdvQzKcryjARpSvQDi-T9r8TT5ZQ&s=10" />
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

            <div class="mt-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-yellow text-yellow-fg p-2"><i class="fa-solid fa-crown fs-3"></i></span>
                    <h2 class="mt-3 text-dark">Paket Langganan</h2>
                </div>

                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="card h-100" style="background: linear-gradient(135deg, #FF9A9E 0%, #FFFFFF 100%)">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-dark">
                                <h2 class="fw-bold">FICTION</h2>
                                <p class="text-secondary fw-bold mb-0">PACKAGE</p>
                                <div class="text-center mt-2">
                                    Rp. <span class="fs-2 fw-bold text-danger">49.000</span>
                                    <br>
                                    <span class="fw-bold text-secondary">/30 Days</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100" style="background: linear-gradient(135deg, #A1C4FD 0%, #FFFFFF 100%)">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-dark">
                                <h2 class="fw-bold">NON-FICTION</h2>
                                <p class="text-secondary fw-bold mb-0">PACKAGE</p>
                                <div class="text-center mt-2">
                                    Rp. <span class="fs-2 fw-bold text-primary">59.000</span>
                                    <br>
                                    <span class="fw-bold text-secondary">/30 Days</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card h-100" style="background: linear-gradient(135deg, #FFE259 0%, #FFFFFF 100%)">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center text-dark">
                                <h2 class="fw-bold">PREMIUM</h2>
                                <p class="text-secondary fw-bold mb-0">PACKAGE</p>
                                <div class="text-center mt-2">
                                    Rp. <span class="fs-2 fw-bold text-warning"
                                        style="color: #D4AF37 !important;">150.000</span>
                                    <br>
                                    <span class="fw-bold text-secondary">/30 Days</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <span class="badge bg-yellow text-yellow-fg p-2"><i class="fa-solid fa-crown fs-3"></i></span>
                    <h2 class="mt-3 text-dark">Buku Baru Di Rilis</h2>
                </div>
                <div id="wrapper-slider">
                    <div class="px-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="d-block mx-auto w-75 h-50" alt=""
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrIOXSvfL5koKwcHABDhlMw6YW6wiA13Cb78Iksr8VgQ&s=10" />
                            </div>
                            <div class="d-flex gap-2 mt-2 ms-3">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">3+</p>
                            </div>
                            <div class="ms-3 mb-3">
                                <h5><span style="font-size: 0.8rem;" class="text-secondary">James clear</span>
                                    <br><span style="font-size: 1rem;">Atomic Habits</span>
                                </h5 #>
                                <h4 style="font-size: 1.2rem; font-weight: bold;">Rp. 105.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="d-block mx-auto w-75 h-50" alt=""
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRw1N5WpvxVOAyu-2oVsiD0h1RKs4MxLm9Mj7VncvgXRpbaGXbq-helPQ4x&s=10" />
                            </div>
                            <div class="d-flex gap-2 mt-2 ms-3">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">5+</p>
                            </div>
                            <div class="ms-3 mb-3">
                                <h5><span style="font-size: 0.8rem;" class="text-secondary">Tere Liye</span>
                                    <br><span style="font-size: 1rem;">Pulang</span>
                                </h5 #>
                                <h4 style="font-size: 1.2rem; font-weight: bold;">Rp. 79.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="d-block mx-auto w-75 h-50" alt=""
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYPZ_3TD4nWM2H6Jg8N3Qsfyjaz98Q0iqLey5clwEBMQ&s=10" />
                            </div>
                            <div class="d-flex gap-2 mt-2 ms-3">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">2+</p>
                            </div>
                            <div class="ms-3 mb-3">
                                <h5><span style="font-size: 0.8rem;" class="text-secondary">Henry Manampiring</span>
                                    <br><span style="font-size: 1rem;">Filosofi Teras</span>
                                </h5 #>
                                <h4 style="font-size: 1.2rem; font-weight: bold;">Rp. 89.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="d-block mx-auto w-75 h-50" alt=""
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaSOC3vqh1j-qmD7mL7M4iE1B6E-1NhcC_9LsAMjhN1Q&s=10" />
                            </div>
                            <div class="d-flex gap-2 mt-2 ms-3">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">7+</p>
                            </div>
                            <div class="ms-3 mb-3">
                                <h5><span style="font-size: 0.8rem;" class="text-secondary">Farhan</span>
                                    <br><span style="font-size: 1rem;">Seni Merayakan Salah Langkah</span>
                                </h5 #>
                                <h4 style="font-size: 1.2rem; font-weight: bold;">Rp. 99.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="d-block mx-auto w-75 h-50" alt=""
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaSOC3vqh1j-qmD7mL7M4iE1B6E-1NhcC_9LsAMjhN1Q&s=10" />
                            </div>
                            <div class="d-flex gap-2 mt-2 ms-3">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">7+</p>
                            </div>
                            <div class="ms-3 mb-3">
                                <h5><span style="font-size: 0.8rem;" class="text-secondary">Farhan</span>
                                    <br><span style="font-size: 1rem;">Seni Merayakan Salah Langkah</span>
                                </h5 #>
                                <h4 style="font-size: 1.2rem; font-weight: bold;">Rp. 99.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="d-block mx-auto w-75 h-50" alt=""
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaSOC3vqh1j-qmD7mL7M4iE1B6E-1NhcC_9LsAMjhN1Q&s=10" />
                            </div>
                            <div class="d-flex gap-2 mt-2 ms-3">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">7+</p>
                            </div>
                            <div class="ms-3 mb-3">
                                <h5><span style="font-size: 0.8rem;" class="text-secondary">Farhan</span>
                                    <br><span style="font-size: 1rem;">Seni Merayakan Salah Langkah</span>
                                </h5 #>
                                <h4 style="font-size: 1.2rem; font-weight: bold;">Rp. 99.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="d-block mx-auto w-75 h-50" alt=""
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaSOC3vqh1j-qmD7mL7M4iE1B6E-1NhcC_9LsAMjhN1Q&s=10" />
                            </div>
                            <div class="d-flex gap-2 mt-2 ms-3">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">7+</p>
                            </div>
                            <div class="ms-3 mb-3">
                                <h5><span style="font-size: 0.8rem;" class="text-secondary">Farhan</span>
                                    <br><span style="font-size: 1rem;">Seni Merayakan Salah Langkah</span>
                                </h5 #>
                                <h4 style="font-size: 1.2rem; font-weight: bold;">Rp. 99.000</h4>
                            </div>
                        </div>
                    </div>
                    <div class="px-2">
                        <div class="card">
                            <div class="card-body text-center">
                                <img class="d-block mx-auto w-75 h-50" alt=""
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaSOC3vqh1j-qmD7mL7M4iE1B6E-1NhcC_9LsAMjhN1Q&s=10" />
                            </div>
                            <div class="d-flex gap-2 mt-2 ms-3">
                                <p class="badge"><i class="fa-solid fa-mobile"></i>PDF</p>
                                <p class="badge">7+</p>
                            </div>
                            <div class="ms-3 mb-3">
                                <h5><span style="font-size: 0.8rem;" class="text-secondary">Farhan</span>
                                    <br><span style="font-size: 1rem;">Seni Merayakan Salah Langkah</span>
                                </h5 #>
                                <h4 style="font-size: 1.2rem; font-weight: bold;">Rp. 99.000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="d-flex align-items-center gap-2 mb-4">
                    <h2 class="mt-3 text-dark" style="font-weight: bold">Buku Gratis</h2>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card d-flex flex-column">
                            <div class="row row-0 flex-fill">
                                <div class="col-md-3">
                                    <a href="#">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTaSOC3vqh1j-qmD7mL7M4iE1B6E-1NhcC_9LsAMjhN1Q&s=10"
                                            alt="Card side image" class="w-100 h-100 object-cover">
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="card-body h-full d-flex flex-column">
                                        <h3 class="card-title">
                                            <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                        </h3>
                                        <div class="text-secondary">
                                            Penulis
                                            <br><span class="text-dark">Judul BUku</span>
                                        </div>
                                        <div class="d-flex align-items-center pt-5 mt-auto">
                                            <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                            </h3>
                                            <span class="text-dark">Rp 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card d-flex flex-column">
                            <div class="row row-0 flex-fill">
                                <div class="col-md-3">
                                    <a href="#">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRw1N5WpvxVOAyu-2oVsiD0h1RKs4MxLm9Mj7VncvgXRpbaGXbq-helPQ4x&s=10"
                                            alt="Card side image" class="w-100 h-100 object-cover">
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="card-body h-full d-flex flex-column">
                                        <h3 class="card-title">
                                            <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                        </h3>
                                        <div class="text-secondary">
                                            Penulis
                                            <br><span class="text-dark">Judul BUku</span>
                                        </div>
                                        <div class="d-flex align-items-center pt-5 mt-auto">
                                            <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                            </h3>
                                            <span class="text-dark">Rp 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="card d-flex flex-column">
                            <div class="row row-0 flex-fill">
                                <div class="col-md-3">
                                    <a href="#">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQYPZ_3TD4nWM2H6Jg8N3Qsfyjaz98Q0iqLey5clwEBMQ&s=10"
                                            alt="Card side image" class="w-100 h-100 object-cover">
                                    </a>
                                </div>
                                <div class="col">
                                    <div class="card-body h-full d-flex flex-column">
                                        <h3 class="card-title">
                                            <div class="badge"><i class="fa-solid fa-mobile"></i>PDF</div>
                                        </h3>
                                        <div class="text-secondary">
                                            Penulis
                                            <br><span class="text-dark">Judul BUku</span>
                                        </div>
                                        <div class="d-flex align-items-center pt-5 mt-auto">
                                            <h3><span class="text-decoration-line-through text-secondary">Rp 50.000</span>
                                            </h3>
                                            <span class="text-dark">Rp 0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2"></div>
            </div>
        </div>
    @endsection



    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#wrapper-slider').slick({
                    arrow: true,
                    dots: true,
                    infinite: false,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    responsive: [{
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 3,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                        // You can unslick at a given breakpoint now by adding:
                        // settings: "unslick"
                        // instead of a settings object
                    ]
                });
            })
        </script>
    @endpush
