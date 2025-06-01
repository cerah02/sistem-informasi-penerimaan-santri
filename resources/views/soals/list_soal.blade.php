<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pilih Ujian</title>
    <style>
        .text-stroke-black {
            -webkit-text-stroke: 1px black;
            text-stroke: 1px black;
            /* untuk browser yang mendukung */
        }

        body {
            background-image: url('/landing_assets/img/ujian.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: rgba(0, 0, 0, 0.5);
            background-blend-mode: overlay;
        }

        .card-hover {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transform: perspective(1000px) rotateX(0deg);
            backface-visibility: hidden;
        }

        .card-hover:hover {
            transform: perspective(1000px) rotateX(5deg) translateY(-10px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.3);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .badge {
            transition: all 0.3s ease;
        }

        .badge:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }

        .btn-disabled {
            position: relative;
            overflow: hidden;
        }

        .btn-disabled::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.05) 100%);
        }

        /* Tambahkan di bagian style */
        .text-stroke {
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.3);
            text-stroke: 1px rgba(255, 255, 255, 0.3);
        }

        .glow-text {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5),
                0 0 20px rgba(255, 255, 255, 0.3);
        }

        /* Tambahkan font khusus jika ingin lebih eksklusif */
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@800;900&family=Poppins:wght@400;600&display=swap');
    </style>
</head>

<body class="min-h-screen p-6">
    <div class="max-w-7xl mx-auto">

        <!-- Tombol Kembali -->
        <div class="mb-6">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center px-5 py-2.5 text-white bg-gray-800 hover:bg-gray-700 font-medium rounded-lg shadow transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 -ml-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke Dashboard
            </a>
        </div>

        <!-- Header -->
        <div class="text-center mb-12 relative">
            <!-- Efek gradien di belakang teks -->
            <div
                class="absolute inset-0 bg-gradient-to-r from-purple-600/20 via-transparent to-blue-600/20 rounded-xl -z-10">
            </div>

            <!-- Judul Utama -->
            <h2 class="text-5xl font-extrabold mb-6 leading-tight">
                <span
                    class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-300 via-white to-blue-300 text-stroke-black">
                    Selamat Datang
                </span>
                <br>
                <span class="text-white text-stroke-black">Di Ujian Seleksi Penerimaan Santri</span>
            </h2>

            <!-- Deskripsi -->
            <div class="inline-block px-6 py-3 rounded-full backdrop-blur-sm bg-white/10 border border-white/20">
                <p class="text-xl font-medium text-white/90 leading-relaxed">
                    Silakan pilih ujian yang akan dikerjakan dengan kategori dan durasi yang tersedia.
                </p>
            </div>

            <!-- Dekorasi elemen -->
            <div
                class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-24 h-24 rounded-full bg-blue-500/20 blur-xl">
            </div>
            <div class="absolute bottom-0 right-20 w-16 h-16 rounded-full bg-purple-500/20 blur-xl"></div>
        </div>

        <!-- Grid Ujian -->
        @if ($ujians->isEmpty())
            <div class="glass-effect p-8 max-w-md mx-auto text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-purple-500 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum ada ujian yang tersedia</h3>
                <p class="text-gray-600">Silakan coba lagi nanti atau hubungi administrator</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($ujians as $ujian)
                    <div class="glass-effect rounded-2xl overflow-hidden card-hover">
                        <!-- Gradient Header -->
                        <div class="gradient-bg p-6 relative">
                            <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-white"></div>
                            <h3 class="text-2xl font-bold text-white relative z-10">{{ $ujian->nama_ujian }}</h3>
                            <div class="absolute bottom-4 right-4 bg-white bg-opacity-20 rounded-full p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                        </div>

                        <!-- Body Card -->
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-5">
                                <span
                                    class="badge bg-blue-100 text-blue-800 text-sm px-3 py-1.5 rounded-full flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Durasi: {{ $ujian->durasi / 60 }} menit
                                </span>
                                 <span
                                    class="badge bg-blue-100 text-blue-800 text-sm px-3 py-1.5 rounded-full flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Waktu Berakhir: {{ $ujian->tanggal_selesai}}
                                </span>
                                <span
                                    class="badge bg-green-100 text-green-800 text-sm px-3 py-1.5 rounded-full flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Soal: {{ $ujian->soals->count() }}
                                </span>
                            </div>

                            <div class="mb-5">
                                <p class="text-sm font-medium text-gray-500 mb-1">Kategori</p>
                                <p class="text-gray-700 font-semibold">{{ $ujian->kategori }}</p>
                            </div>

                            <div class="flex justify-between items-center pt-4 border-t border-gray-100">
                                @if ($ujian->user_already_submit)
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm font-medium text-gray-600">Sudah Dikerjakan</span>
                                    </div>
                                    <button
                                        class="btn-disabled bg-gray-200 text-gray-500 px-5 py-2.5 rounded-xl font-medium cursor-not-allowed"
                                        disabled>
                                        Selesai
                                    </button>
                                @else
                                    @if ($ujian->ujian_status === 'belum_dimulai')
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
                                            </svg>
                                            <span class="text-sm font-medium text-gray-600">Belum Dimulai</span>
                                        </div>
                                        <button
                                            class="btn-disabled bg-yellow-100 text-yellow-600 px-5 py-2.5 rounded-xl font-medium cursor-not-allowed"
                                            disabled>
                                            Belum Dimulai
                                        </button>
                                    @elseif ($ujian->ujian_status === 'waktu_habis')
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="text-sm font-medium text-gray-600">Waktu Habis</span>
                                        </div>
                                        <button
                                            class="btn-disabled bg-red-100 text-red-600 px-5 py-2.5 rounded-xl font-medium cursor-not-allowed"
                                            disabled>
                                            Waktu Habis
                                        </button>
                                    @else
                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                            <span class="text-sm font-medium text-gray-600">Tersedia</span>
                                        </div>
                                        <a href="{{ route('ujian', $ujian->id) }}"
                                            class="btn-primary text-white px-5 py-2.5 rounded-xl font-medium">
                                            Mulai Ujian
                                        </a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
