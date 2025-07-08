@extends('layout_landingpage')
@section('content')

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fasilitas Pesantren - Pondok Modern</title>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Amiri:wght@400;700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: #f1f3f6;
                color: #333;
                min-height: 100vh;
                margin: 0;
                padding: 0;
            }

            .fasilitas-container {
                max-width: 1200px;
                margin: 0 auto;
                padding: 2rem 1rem;
            }

            .fasilitas-header {
                text-align: center;
                margin-bottom: 3rem;
            }

            .fasilitas-title {
                font-family: 'Amiri', serif;
                font-size: 3rem;
                color: #2c3e50;
                font-weight: 700;
            }

            .fasilitas-subtitle {
                color: #7f8c8d;
                font-size: 1.2rem;
                max-width: 700px;
                margin: 0 auto;
            }

            /* Grid */
            .fasilitas-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 1.5rem;
            }

            /* Card */
            .fasilitas-card {
                background: #fff;
                border: 1px solid #e0e0e0;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                overflow: hidden;
                cursor: pointer;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .fasilitas-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
            }

            .fasilitas-img-wrapper {
                width: 100%;
                padding-top: 56.25%;
                /* 16:9 aspect ratio */
                position: relative;
                overflow: hidden;
            }

            .fasilitas-img-wrapper img {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .fasilitas-content {
                padding: 1rem;
            }

            .fasilitas-name {
                font-size: 1.2rem;
                font-weight: 600;
                color: #2c3e50;
            }

            .fasilitas-desc {
                color: #7f8c8d;
                font-size: 0.95rem;
                margin-top: 0.5rem;
            }

            .modal-backdrop.show {
                z-index: 9998 !important;
            }

            .modal.show {
                z-index: 9999 !important;
            }

            .modal-dialog {
                z-index: 10000 !important;
            }

            .modal.fasilitas-fullscreen .modal-content {
                height: 200%;
                border: none;
                border-radius: 0;
                background: #fff;
                display: flex;
                flex-direction: column;
            }

            .fasilitas-modal-image {
                flex: 1;
                position: relative;
                background-color: #f5f5f5;
                overflow: hidden;
            }

            .fasilitas-modal-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .fasilitas-modal-body {
                padding: 1.5rem;
                color: #2c3e50;
            }

            .fasilitas-modal-title {
                font-size: 2rem;
                font-weight: 700;
                margin-bottom: 1rem;
            }

            .fasilitas-modal-text {
                font-size: 1.05rem;
                line-height: 1.6;
                color: #7f8c8d;
            }

            .btn-close.fasilitas-close-btn {
                position: absolute;
                top: 1rem;
                right: 1rem;
                background: rgba(0, 0, 0, 0.5);
                border-radius: 50%;
                width: 35px;
                height: 35px;
                color: #fff;
                z-index: 10001;
            }

            .btn-close.fasilitas-close-btn:hover {
                background: rgba(0, 0, 0, 0.8);
            }

            @media (max-width: 768px) {
                .fasilitas-title {
                    font-size: 2.2rem;
                }

                .fasilitas-modal-title {
                    font-size: 1.5rem;
                }

                .fasilitas-modal-text {
                    font-size: 1rem;
                }
            }
        </style>
    </head>

    <body>
        <div class="fasilitas-container">
            <header class="fasilitas-header">
                <h1 class="fasilitas-title">Fasilitas Pesantren</h1>
                <p class="fasilitas-subtitle">Infrastruktur Modern & Pendukung Pendidikan Berbasis Islam</p>
            </header>

            <div class="fasilitas-grid">
                @foreach ($fasilitas as $item)
                    <div class="fasilitas-card" data-bs-toggle="modal" data-bs-target="#fasilitasModal{{ $item->id }}">
                        <div class="fasilitas-content">
                            <div class="fasilitas-name">{{ $item->nama_fasilitas }}</div>
                        </div>
                        <div class="fasilitas-img-wrapper">
                            <img src="{{ asset('storage/' . $item->foto_fasilitas) }}" alt="{{ $item->nama_fasilitas }}">
                        </div>
                    </div>

                    <!-- Modal Fullscreen -->
                    <div class="modal fade fasilitas-fullscreen" id="fasilitasModal{{ $item->id }}" tabindex="-1"
                        aria-labelledby="modalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="fasilitas-modal-image">
                                    <img src="{{ asset('storage/' . $item->foto_fasilitas) }}"
                                        alt="{{ $item->nama_fasilitas }}">
                                </div>
                                <div class="fasilitas-modal-body">
                                    <button type="button" class="btn-close fasilitas-close-btn" data-bs-dismiss="modal"
                                        aria-label="Tutup">X</button>
                                    <h2 class="fasilitas-modal-title">{{ $item->nama_fasilitas }}</h2>
                                    <p class="fasilitas-modal-text">{{ $item->keterangan }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
@endsection
