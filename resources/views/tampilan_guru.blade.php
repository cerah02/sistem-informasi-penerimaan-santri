@extends('layout_landingpage')

@section('title', 'Daftar Tenaga Pengajar')

@section('content')

    <style>
        .guru-card {
            width: 280px;
            height: 320px;
            background: white;
            border-radius: 20px;
            padding: 3px;
            position: relative;
            box-shadow: rgba(96, 75, 74, 0.3) 0px 10px 30px -10px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            overflow: hidden;
        }

        .guru-card:hover {
            transform: translateY(-10px);
            box-shadow: rgba(96, 75, 74, 0.5) 0px 15px 40px -10px;
        }

        .guru-mail {
            position: absolute;
            right: 1rem;
            top: 1rem;
            background: transparent;
            border: none;
            z-index: 2;
        }

        .guru-mail svg {
            stroke: #ff6666;
            stroke-width: 2px;
            transition: transform 0.3s ease-in-out;
        }

        .guru-mail svg:hover {
            stroke: #cc0000;
            transform: scale(1.2);
        }

        .guru-profile-pic {
            position: relative;
            width: 100%;
            height: 75%;
            border-radius: 20px 20px 0 0;
            overflow: hidden;
        }

        .guru-profile-pic img {
            object-fit: cover;
            width: 100%;
            height: 100%;
            transition: transform 0.5s ease-in-out;
        }

        .guru-card:hover .guru-profile-pic img {
            transform: scale(1.1);
        }

        .guru-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ff6666;
            padding: 15px;
            border-radius: 0 0 20px 20px;
            transition: background 0.3s ease-in-out;
            color: white;
        }

        .guru-card:hover .guru-info {
            background: #cc0000;
        }

        .guru-name {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .guru-details {
            font-size: 0.9rem;
            display: block;
            margin-top: 5px;
        }
    </style>

    <div class="container">
        <h1 class="text-center my-4">Daftar Tenaga Pengajar</h1>
        <div class="row justify-content-center">
            @foreach ($gurus as $guru)
                <div class="col-md-4 mb-4 d-flex justify-content-center">
                    <div class="guru-card">
                        <button class="guru-mail">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 8L12 13L21 8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <rect x="3" y="5" width="18" height="14" rx="2" stroke-width="2" />
                            </svg>
                        </button>
                        <div class="guru-profile-pic">
                            <img src="{{ asset($guru->foto) }}" alt="Foto Guru">
                        </div>
                        <div class="guru-info text-center">
                            <span class="guru-name">{{ $guru->nama }}</span>
                            <span class="guru-details">NIP: {{ $guru->nip }}</span>
                            <span class="guru-details">Email: {{ $guru->email }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
