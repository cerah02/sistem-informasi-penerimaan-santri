<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian</title>
    <style>
        /* CSS sama seperti sebelumnya */
    </style>
</head>
<body>
    <div class="container">
        <h1 class="judul-ujian">Ujian Bahasa Arab</h1>

        <form action="{{ route('submit.ujian') }}" method="POST">
            @csrf
            @foreach($soals as $index => $soal)
            <div class="soal-container">
                <div class="pertanyaan">
                    {{ $index + 1 }}. {!! $soal->pertanyaan !!}
                </div>

                <div class="pilihan">
                    @foreach(['A', 'B', 'C', 'D', 'E'] as $option)
                        @if(!empty($soal->{'jawaban_'.strtolower($option)}))
                        <div class="pilihan-option">
                            <input type="radio" 
                                   name="jawaban[{{ $soal->id }}]" 
                                   id="soal_{{ $soal->id }}_{{ $option }}"
                                   value="{{ $option }}">
                            <label for="soal_{{ $soal->id }}_{{ $option }}">
                                {{ $option }}. {{ $soal->{'jawaban_'.strtolower($option)} }}
                            </label>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
            @endforeach

            <button type="submit" class="btn-submit">Submit Jawaban</button>
        </form>
    </div>
</body>
</html>