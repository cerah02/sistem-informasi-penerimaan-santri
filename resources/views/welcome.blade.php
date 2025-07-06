@extends('layout_landingpage')
@section('content')
    <div class="container">
        <!-- Carousel Start -->
        <div class="container-fluid header-carousel px-0 mb-5">
            <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Carousel Item 1 -->
                    <div class="carousel-item active">
                        <img class="w-100" src="{{ asset(beranda('carousel_1_image')) }}" alt="Pondok Pesantren">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-start">
                                    <div class="col-lg-7 text-start">
                                        <h1 class="display-1 text-white animated slideInRight mb-3">
                                            {{ beranda('carousel_1_title') }}
                                        </h1>
                                        <p class="mb-5 animated slideInRight">
                                            {{ beranda('carousel_1_description') }}
                                        </p>
                                        <a href="#"
                                            class="btn btn-primary py-3 px-5 animated slideInRight">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Item 2 -->
                    <div class="carousel-item">
                        <img class="w-100" src="{{ asset(beranda('carousel_2_image')) }}" alt="Kegiatan Santri">
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row justify-content-end">
                                    <div class="col-lg-7 text-end">
                                        <h1 class="display-1 text-white animated slideInLeft mb-3">
                                            {{ beranda('carousel_2_title') }}
                                        </h1>
                                        <p class="mb-5 animated slideInLeft">
                                            {{ beranda('carousel_2_description') }}
                                        </p>
                                        <a href="#"
                                            class="btn btn-primary py-3 px-5 animated slideInLeft">Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- Carousel End -->
    </div>
@endsection
