@extends('layout_landingpage')

@section('title', 'Visi & Misi')

@section('content')
    @php
        $visiMisi = \App\Models\VisiMisi::all()->keyBy('key');
        $misiList = json_decode($visiMisi['misi']->value ?? '[]', true);
        $nilaiList = json_decode($visiMisi['nilai']->value ?? '[]', true);
    @endphp

    <div class="ppvm-container ppvm-root">
        <style>
            /* Prefix semua class dengan 'ppvm-' (Pondok Pesantren Visi Misi) */
            .ppvm-root {
                --ppvm-primary-color: #2c786c;
                --ppvm-secondary-color: #004445;
                --ppvm-accent-color: #f8b400;
                --ppvm-light-color: #faf5e4;
            }

            .ppvm-container {
                font-family: 'Poppins', sans-serif;
                color: #333;
            }

            .ppvm-header {
                background: linear-gradient(135deg, var(--ppvm-primary-color), var(--ppvm-secondary-color));
                color: white;
                text-align: center;
                padding: 2rem 0;
                position: relative;
                overflow: hidden;
            }

            .ppvm-header::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('islamic-pattern.png') repeat;
                opacity: 0.1;
            }

            .ppvm-header-content {
                position: relative;
                z-index: 1;
            }

            .ppvm-title {
                font-size: 2.5rem;
                margin-bottom: 0.5rem;
                font-weight: 700;
                color: white;
            }

            .ppvm-main-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 2rem;
                background-color: var(--ppvm-light-color);
            }

            .ppvm-section {
                margin-bottom: 3rem;
                background: white;
                border-radius: 10px;
                padding: 2rem;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .ppvm-section-title {
                color: var(--ppvm-primary-color);
                margin-bottom: 1.5rem;
                font-size: 2rem;
            }

            .ppvm-visi-content {
                font-size: 1.5rem;
                font-weight: 500;
                line-height: 1.8;
                color: var(--ppvm-secondary-color);
                text-align: center;
                padding: 1.5rem;
                border: 2px dashed var(--ppvm-primary-color);
                border-radius: 5px;
                margin: 1rem 0;
                background-color: rgba(44, 120, 108, 0.05);
            }

            .ppvm-misi-list {
                list-style: none;
            }

            .ppvm-misi-list li {
                padding: 1rem 1rem 1rem 3rem;
                margin-bottom: 1rem;
                background-color: rgba(44, 120, 108, 0.05);
                border-left: 3px solid var(--ppvm-accent-color);
                position: relative;
            }

            .ppvm-misi-list li::before {
                content: "✓";
                position: absolute;
                left: 1rem;
                top: 1rem;
                color: var(--ppvm-accent-color);
                font-weight: bold;
            }

            .ppvm-quote {
                font-style: italic;
                text-align: center;
                padding: 2rem;
                margin: 2rem 0;
                background: linear-gradient(135deg, rgba(44, 120, 108, 0.1), rgba(0, 68, 69, 0.1));
                border-radius: 10px;
            }

            .ppvm-value-card-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .ppvm-value-card {
                background: rgba(44, 120, 108, 0.1);
                padding: 1.5rem;
                border-radius: 8px;
                text-align: center;
                flex: 1 1 200px;
            }

            .ppvm-value-icon {
                font-size: 2rem;
                color: var(--ppvm-primary-color);
                margin-bottom: 1rem;
            }

            .ppvm-value-title {
                color: var(--ppvm-primary-color);
                margin-bottom: 0.5rem;
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

        <div class="ppvm-main-container">
            <!-- Visi Section -->
            <section class="ppvm-section">
                <h2 class="ppvm-section-title"><i class="fas fa-binoculars"></i> Visi Pesantren</h2>
                <div class="ppvm-visi-content">
                    {{ $visiMisi['visi']->value ?? 'Belum ada visi.' }}
                </div>
                <div class="ppvm-quote">
                    {!! $visiMisi['quote']->value ?? '' !!}
                </div>
            </section>

            <!-- Misi Section -->
            <section class="ppvm-section">
                <h2 class="ppvm-section-title"><i class="fas fa-bullseye"></i> Misi Pesantren</h2>
                <ul class="ppvm-misi-list">
                    @forelse ($misiList as $misi)
                        <li>{{ $misi }}</li>
                    @empty
                        <li>Belum ada misi yang ditambahkan.</li>
                    @endforelse
                </ul>
            </section>

            <!-- Nilai-nilai Section -->
            <section class="ppvm-section">
                <h2 class="ppvm-section-title"><i class="fas fa-star"></i> Nilai-nilai Pesantren</h2>
                <div class="ppvm-value-card-container">
                    @forelse ($nilaiList as $card)
                        <div class="ppvm-value-card">
                            <i class="{{ $card['icon'] ?? 'fas fa-star' }} ppvm-value-icon"></i>
                            <h3 class="ppvm-value-title">{{ $card['title'] ?? 'Judul Kosong' }}</h3>
                            <p>{{ $card['desc'] ?? 'Deskripsi belum diisi.' }}</p>
                        </div>
                    @empty
                        <p>Tidak ada nilai-nilai yang ditambahkan.</p>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
@endsection
