@extends('layout_landingpage')

@section('title', 'Brosur Pendaftaran')

@section('content')
    <!-- Lightbox CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

    <style>
        .brosur-section {
            padding: 50px 0;
            background-color: #f8f9fa;
        }

        .brosur-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #343a40;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .brosur-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            justify-items: center;
        }

        .brosur-card {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            max-width: 500px;
        }

        .brosur-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.25);
        }

        .brosur-img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            cursor: pointer;
        }

        .brosur-info {
            padding: 20px;
            text-align: center;
        }

        .brosur-info h5 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 10px;
            color: #495057;
        }

        .brosur-info p {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 0;
        }

        @media (max-width: 576px) {
            .brosur-title {
                font-size: 2rem;
            }

            .brosur-img {
                height: 300px;
            }
        }
    </style>

    <div class="brosur-section">
        <h1 class="brosur-title">Brosur Pendaftaran Santri</h1>
        <div class="brosur-grid">
            @foreach ($brosur as $item)
                <div class="brosur-card">
                    <!-- Wrap image in lightbox link -->
                    <a href="{{ asset('storage/' . $item->foto_brosur) }}" data-lightbox="brosur-group"
                        data-title="Brosur {{ $item->jenjang_pendidikan }}">
                        <img src="{{ asset('storage/' . $item->foto_brosur) }}" alt="Brosur {{ $item->jenjang_pendidikan }}"
                            class="brosur-img">
                    </a>
                    <div class="brosur-info">
                        <h5>{{ $item->jenjang_pendidikan }}</h5>
                        <p>Brosur Pendaftaran untuk jenjang {{ $item->jenjang_pendidikan }} Pondok Pesantren.</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
@endsection
