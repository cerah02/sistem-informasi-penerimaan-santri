<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CBT : Computer Based Test</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .navbar-custom {
            background-color: #d9534f;
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
        }

        .question-box {
            background-color: #5bc0de;
            color: white;
        }

        .answer-box {
            background-color: #dff0d8;
        }

        .answer-box i {
            color: #3c763d;
        }

        .option-box {
            background-color: #f7f7f7;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .option-box:hover {
            background-color: #e7e7e7;
        }

        .option-box.selected {
            background-color: #5bc0de;
            color: white;
        }

        .option-box input[type="radio"] {
            margin-right: 10px;
        }

        .btn-custom {
            background-color: #5cb85c;
            color: white;
        }

        .btn-custom:hover {
            background-color: #4cae4c;
        }

        .btn-back {
            background-color: #f0ad4e;
            color: white;
        }

        .btn-back:hover {
            background-color: #ec971f;
        }

        .answer-grid .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .question-container {
            display: none;
        }

        .question-container.active {
            display: block;
        }
    </style>
</head>

<body>
    <!-- Navbar remains the same -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <!-- ... (previous navbar code) ... -->
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Ujian Bahasa Arab</li>
                            </ol>
                        </nav>

                        <form action="{{ route('submit.ujian') }}" method="POST">
                            @csrf
                            @foreach ($soals as $index => $soal)
                                <div class="question-container card mb-3 {{ $index === 0 ? 'active' : '' }}"
                                    id="soal-{{ $index + 1 }}">
                                    <div class="question-box p-4 rounded">
                                        <p>{{ $index + 1 }}. {!! $soal->pertanyaan !!}</p>
                                    </div>

                                    <div class="p-3">
                                        @foreach (['A', 'B', 'C', 'D', 'E'] as $option)
                                            @if (!empty($soal->{'jawaban_' . strtolower($option)}))
                                                <div class="option-box p-4 rounded mb-2">
                                                    <label class="d-flex align-items-center mb-0">
                                                        <input type="radio" name="jawaban[{{ $soal->id }}]"
                                                            value="{{ $option }}" class="answer-radio">
                                                        <span class="ml-2">
                                                            {{ $option }}.
                                                            {{ $soal->{'jawaban_' . strtolower($option)} }}
                                                        </span>
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-back" id="prev-btn">Mundur</button>
                                <button type="button" class="btn btn-custom" id="next-btn">Lanjut >>></button>
                                <button type="submit" class="btn btn-danger" id="finish-btn"
                                    style="display: none;">Selesai!</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Daftar Soal</h5>
                        <div class="row answer-grid">
                            @foreach ($soals as $index => $soal)
                                <div class="col-6 mb-2">
                                    <button class="btn btn-secondary question-number-btn"
                                        data-soal="{{ $index + 1 }}">
                                        {{ $index + 1 }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-4 text-muted">
        <p>2024 .</p>
        <p>Version 1.0</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentQuestion = 1;

            // Fungsi untuk menyimpan jawaban ke localStorage
            function saveAnswer(questionId, answer) {
                const answers = JSON.parse(localStorage.getItem('answers')) || {};
                answers[questionId] = answer;
                localStorage.setItem('answers', JSON.stringify(answers));
            }

            // Fungsi untuk memuat jawaban dari localStorage
            function loadAnswer(questionId) {
                const answers = JSON.parse(localStorage.getItem('answers')) || {};
                return answers[questionId] || null;
            }

            // Handle radio button selection
            $('.option-box').click(function() {
                const radio = $(this).find('input[type="radio"]');
                radio.prop('checked', true);

                // Remove selected class from all options in the same question
                $(this).closest('.question-container').find('.option-box').removeClass('selected');
                // Add selected class to clicked option
                $(this).addClass('selected');

                // Simpan jawaban ke localStorage
                const questionId = $(this).closest('.question-container').find('input[type="radio"]').attr(
                    'name').match(/\[(\d+)\]/)[1];
                const answer = radio.val();
                saveAnswer(questionId, answer);

                // Update the question number button state
                const questionNumber = $(this).closest('.question-container').attr('id').replace('soal-',
                    '');
                $(`.question-number-btn[data-soal="${questionNumber}"]`).removeClass('btn-secondary')
                    .addClass('btn-success');
            });

            function showQuestion(questionNumber) {
                $('.question-container').removeClass('active');
                $(`#soal-${questionNumber}`).addClass('active');
                currentQuestion = questionNumber;

                $('#prev-btn').prop('disabled', questionNumber === 1);
                $('#next-btn').toggle(questionNumber !== {{ count($soals) }});
                $('#finish-btn').toggle(questionNumber === {{ count($soals) }});

                // Muat jawaban yang sudah dipilih (jika ada)
                const questionId = $(`#soal-${questionNumber}`).find('input[type="radio"]').attr('name').match(
                    /\[(\d+)\]/)[1];
                const selectedAnswer = loadAnswer(questionId);
                if (selectedAnswer) {
                    $(`#soal-${questionNumber}`).find(`input[type="radio"][value="${selectedAnswer}"]`).prop(
                        'checked', true);
                    $(`#soal-${questionNumber}`).find(`input[type="radio"][value="${selectedAnswer}"]`).closest(
                        '.option-box').addClass('selected');
                }
            }

            $('.question-number-btn').click(function() {
                const soalNumber = $(this).data('soal');
                showQuestion(soalNumber);
            });

            $('#prev-btn').click(function() {
                if (currentQuestion > 1) {
                    showQuestion(currentQuestion - 1);
                }
            });

            $('#next-btn').click(function() {
                if (currentQuestion < {{ count($soals) }}) {
                    showQuestion(currentQuestion + 1);
                }
            });

            // Muat jawaban yang sudah dipilih saat halaman dimuat
            showQuestion(1);

            // Handle form submission
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('#finish-btn').click(function(e) {
                e.preventDefault();

                if (confirm('Apakah Anda yakin ingin menyelesaikan ujian?')) {
                    // Ambil jawaban dari localStorage
                    const answers = JSON.parse(localStorage.getItem('answers')) || {};

                    // Tambahkan jawaban ke form
                    $('form').find('input[type="hidden"]').remove(); // Hapus input hidden sebelumnya
                    for (const [questionId, answer] of Object.entries(answers)) {
                        $(`<input type="hidden" name="jawaban[${questionId}]" value="${answer}">`).appendTo(
                            $('form'));
                    }

                    // Tambahkan CSRF token jika belum ada
                    if (!$('form').find('input[name="_token"]').length) {
                        $(`<input type="hidden" name="_token" value="${csrfToken}">`).appendTo($('form'));
                    }

                    // Submit form
                    $('form').submit();
                }
            });

            // Membersihkan localStorage saat halaman di-refresh
            window.addEventListener('beforeunload', function() {
                localStorage.removeItem('answers'); // Hapus data jawaban dari localStorage
            });
        });
    </script>
</body>

</html>
