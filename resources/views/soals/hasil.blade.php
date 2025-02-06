<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Ujian</title>
    <style>
        .result-container {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            background-color: #f8fafc;
        }
        .correct {
            color: #16a34a;
        }
        .incorrect {
            color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hasil Ujian</h1>

        @foreach($results as $result)
        <div class="result-container">
            <p><strong>Pertanyaan:</strong> {!! $result['pertanyaan'] !!}</p>
            <p><strong>Jawaban Anda:</strong> {{ $result['jawaban_dipilih'] ?? 'Tidak dijawab' }}</p>
            <p><strong>Jawaban Benar:</strong> {{ $result['jawaban_benar'] }}</p>
            <p class="{{ $result['status'] === 'Benar' ? 'correct' : 'incorrect' }}">
                <strong>Status:</strong> {{ $result['status'] }}
            </p>
        </div>
        @endforeach
    </div>
</body>
</html>