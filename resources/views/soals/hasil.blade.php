<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6">📊 Hasil Ujian</h1>

        @php
            $totalSoal = count($results);
            $jawabanBenar = collect($results)->where('status', 'Benar')->count();
            $nilai = $totalSoal > 0 ? ($jawabanBenar / $totalSoal) * 100 : 0;
        @endphp

        @if($totalSoal > 0)
            @foreach($results as $result)
                <div class="mb-4 p-4 border-l-4 rounded-md 
                    {{ $result['status'] === 'Benar' ? 'border-green-500 bg-green-50' : 'border-red-500 bg-red-50' }}">
                    <p class="text-lg font-semibold text-gray-700">❓ <strong>Pertanyaan:</strong> {{ $result['pertanyaan'] }}</p>
                    <p class="text-gray-600">📝 <strong>Jawaban Anda:</strong> {{ $result['jawaban_dipilih'] ?? 'Tidak dijawab' }}</p>
                    <p class="text-gray-600">✅ <strong>Jawaban Benar:</strong> {{ $result['jawaban_benar'] }}</p>
                    <p class="font-semibold mt-2 {{ $result['status'] === 'Benar' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $result['status'] === 'Benar' ? '✔ Benar' : '✖ Salah' }}
                    </p>
                </div>
            @endforeach

            <!-- Nilai Ujian -->
            <div class="mt-6 text-center">
                <h2 class="text-2xl font-bold text-gray-800">🎯 Nilai Anda</h2>
                <div class="relative w-full bg-gray-200 h-6 rounded-full mt-2">
                    <div class="h-6 rounded-full 
                        {{ $nilai >= 60 ? 'bg-green-500' : 'bg-red-500' }}" 
                        style="width: {{ $nilai }}%; transition: width 0.5s;"></div>
                </div>
                <p class="mt-2 text-xl font-bold 
                    {{ $nilai >= 60 ? 'text-green-600' : 'text-red-600' }}">
                    {{ number_format($nilai, 2) }} / 100
                </p>
                <p class="mt-1 text-gray-700 text-lg font-medium">
                    {{ $nilai >= 60 ? '🎉 Selamat, Anda Lulus!' : '😢 Maaf, Anda Belum Lulus' }}
                </p>
            </div>

        @else
            <p class="text-center text-gray-600">Tidak ada hasil ujian yang tersedia.</p>
        @endif
    </div>
</body>
</html>
