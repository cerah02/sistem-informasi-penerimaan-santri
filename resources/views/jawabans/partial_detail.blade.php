<div>
    @foreach ($jawabans as $jawaban)
        <div class="mb-3 border-bottom pb-2">
            <strong>Pertanyaan:</strong> {{ $jawaban->soal->pertanyaan }} <br>
            <strong>Jawaban Santri:</strong>
            {{ $jawaban->jawaban }}
            @switch($jawaban->jawaban)
                @case('A')
                    ({{ $jawaban->soal->jawaban_a }})
                @break

                @case('B')
                    ({{ $jawaban->soal->jawaban_b }})
                @break

                @case('C')
                    ({{ $jawaban->soal->jawaban_c }})
                @break

                @case('D')
                    ({{ $jawaban->soal->jawaban_d }})
                @break

                @case('E')
                    ({{ $jawaban->soal->jawaban_e }})
                @break
            @endswitch
            <br>
            <strong>Status:</strong>
            <span class="{{ $jawaban->status_jawaban === 'benar' ? 'text-success' : 'text-danger' }}">
                {{ ucfirst($jawaban->status_jawaban) }}
            </span>
        </div>
    @endforeach
</div>
