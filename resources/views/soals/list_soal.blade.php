<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Pilih Ujian</title>
    <style>
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
        }
    </style>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Pilih Ujian yang Akan Dikerjakan</h2>
            <p class="text-gray-600 mt-2">Silakan pilih ujian sesuai dengan kategori dan durasi yang tersedia.</p>
        </div>

        <!-- Grid Ujian -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($ujians as $ujian)
                <div class="bg-white rounded-xl overflow-hidden shadow-lg card-hover">
                    <!-- Gradient Header -->
                    <div class="gradient-bg p-4">
                        <h3 class="text-xl font-semibold text-white">{{ $ujian->nama_ujian }}</h3>
                    </div>


                    <!-- Body Card -->
                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded-full">Durasi:
                                {{ $ujian->durasi }} menit</span>
                            <span class="bg-green-100 text-green-800 text-sm px-2 py-1 rounded-full">Soal:
                                {{ $ujian->soal_count }}</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-4">Kategori: {{ $ujian->kategori }}</p>
                        <div class="flex justify-between items-center">
                            @if ($ujian->user_already_submit)
                                <span class="text-sm text-gray-500">Status: Sudah Di Kerjakan</span>
                            @else
                                <span class="text-sm text-gray-500">Status: Tersedia</span>
                                <a href="{{ route('ujian', $ujian->id) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Mulai
                                    Ujian</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-500">
            <p>&copy; 2024 CBT Platform. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
