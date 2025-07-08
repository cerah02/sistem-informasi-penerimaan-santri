@extends('layout_landingpage')

@section('title', 'Pakaian Putra')

@section('content')
    <style>
        .jenjang-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 40px 0 20px;
            border-bottom: 3px solid #3498db;
            display: inline-block;
        }

        .pakaian-card {
            width: 280px;
            height: 400px;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            display: flex;
            flex-direction: column;
        }

        .pakaian-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .pakaian-photo {
            width: 100%;
            height: 65%;
            overflow: hidden;
        }

        .pakaian-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .pakaian-card:hover .pakaian-photo img {
            transform: scale(1.1);
        }

        .pakaian-info {
            background: #f4f6f9;
            padding: 15px;
            text-align: center;
        }

        .pakaian-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 6px;
        }

        .pakaian-details {
            font-size: 0.95rem;
            color: #7f8c8d;
            margin-bottom: 4px;
        }

        /* Responsive Grid */
        @media (max-width: 992px) {
            .pakaian-card {
                width: 90%;
                height: 380px;
            }
        }

        @media (max-width: 576px) {
            .pakaian-card {
                width: 100%;
                height: 350px;
            }
        }
    </style>

    <div class="container">
        <h1 class="text-center my-5 fw-bold" style="color: #3498db;">Daftar Pakaian Santri Putri</h1>

        @foreach ($pakaian as $jenjang => $items)
            <h2 class="jenjang-title">{{ $jenjang }}</h2>
            <div class="row justify-content-center">
                @foreach ($items as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                        <div class="pakaian-card">
                            <div class="pakaian-photo">
                                <img src="{{ asset('storage/' . $item->foto_pakaian) }}" alt="{{ $item->nama_pakaian }}">
                            </div>
                            <div class="pakaian-info">
                                <div class="pakaian-name">{{ $item->nama_pakaian }}</div>
                                <div class="pakaian-details">
                                    📝 {{ $item->keterangan }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
