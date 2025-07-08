@extends('layout_landingpage')

@section('title', 'Daftar Tenaga Pengajar')

@section('content')

    <style>
        body {
            background: linear-gradient(135deg, #f0f4f8, #d9e4f5);
            font-family: 'Poppins', sans-serif;
        }

        .guru-card {
            width: 320px;
            height: 460px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            overflow: hidden;
            position: relative;
            display: flex;
            flex-direction: column;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .guru-card:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.3);
        }

        .guru-mail {
            position: absolute;
            right: 18px;
            top: 18px;
            background: rgba(255, 255, 255, 0.25);
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: background 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .guru-mail:hover {
            background: #1abc9c;
            transform: scale(1.15);
        }

        .guru-mail svg {
            stroke: #1abc9c;
            stroke-width: 2px;
            transition: stroke 0.3s ease;
        }

        .guru-mail:hover svg {
            stroke: #fff;
        }

        .guru-profile-pic {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #6dd5fa, #2980b9);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .guru-profile-pic img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 6px solid #fff;
            object-fit: cover;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .guru-card:hover .guru-profile-pic img {
            transform: scale(1.08);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        .guru-info {
            padding: 20px 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            background: rgba(255, 255, 255, 0.5);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
        }

        .guru-name {
            font-size: 1.6rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
            transition: color 0.3s ease;
        }

        .guru-card:hover .guru-name {
            color: #1abc9c;
        }

        .guru-details {
            font-size: 1rem;
            color: #34495e;
            margin: 5px 0;
        }

        .guru-details i {
            margin-right: 6px;
            color: #1abc9c;
        }

        /* Responsive Grid */
        @media (max-width: 992px) {
            .guru-card {
                width: 280px;
                height: 420px;
            }
        }

        @media (max-width: 768px) {
            .guru-card {
                width: 90%;
                height: 400px;
            }
        }

        @media (max-width: 480px) {
            .guru-card {
                width: 100%;
                height: 380px;
            }
        }
    </style>

    <div class="container">
        <h1 class="text-center my-5" style="font-weight: 800; color: #000000;">Daftar Tenaga Pengajar</h1>
        <div class="row justify-content-center">
            @foreach ($gurus as $guru)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex justify-content-center">
                    <div class="guru-card">
                        
                        <div class="guru-profile-pic">
                            <img src="{{ $guru->foto ? asset('storage/' . $guru->foto) : asset('images/default-guru.png') }}"
                                alt="Foto Guru">
                        </div>
                        <div class="guru-info">
                            <div class="guru-name">{{ $guru->nama }}</div>
                            <div class="guru-details"><i class="fas fa-id-card"></i> NIP: {{ $guru->nip }}</div>
                            <div class="guru-details"><i class="fas fa-envelope"></i> {{ $guru->email }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
