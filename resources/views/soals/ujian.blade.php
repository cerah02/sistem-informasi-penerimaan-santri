<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CBT : Computer Based Test</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .navbar-custom {
            background: linear-gradient(135deg, #d9534f, #c9302c);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand,
        .navbar-custom .nav-link {
            color: white;
            font-weight: 600;
        }

        .question-box {
            background: linear-gradient(135deg, #5bc0de, #31b0d5);
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .answer-box {
            background-color: #dff0d8;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .answer-box i {
            color: #3c763d;
        }

        .option-box {
            background-color: #f7f7f7;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .option-box:hover {
            background-color: #e7e7e7;
            transform: translateY(-2px);
        }

        .option-box.selected {
            background: linear-gradient(135deg, #5bc0de, #31b0d5);
            color: white;
        }

        .option-box input[type="radio"] {
            margin-right: 10px;
        }

        .btn-custom {
            background: linear-gradient(135deg, #5cb85c, #4cae4c);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #4cae4c, #449d44);
            transform: translateY(-2px);
        }

        .btn-back {
            background: linear-gradient(135deg, #f0ad4e, #ec971f);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #ec971f, #d58512);
            transform: translateY(-2px);
        }

        .answer-grid .btn {
            width: 100%;
            margin-bottom: 10px;
            border-radius: 25px;
            font-weight: 600;
        }

        .question-container {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        .question-container.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item.active {
            color: #5bc0de;
            font-weight: 600;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            margin-top: 40px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .navbar-custom .navbar-brand {
                font-size: 1.2rem;
            }

            .btn-custom,
            .btn-back {
                width: 100%;
                margin-bottom: 10px;
            }

            .answer-grid .btn {
                width: 100%;
            }
        }

        #timer {
            font-size: 50px;
            /* Sesuaikan ukuran */
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom">
        <a class="navbar-brand" href="#">Ujian Seleksi Penerimaan Santri Pondok Pesantren Darul Muttaqien</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Timer Countdown -->
                        <div class="text-center mb-4">
                            <h4>Waktu Tersisa:</h4>
                            <div id="timer" class="display-2 font-weight-bold text-danger">00:00</div>
                        </div>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">{{ $ujian->nama_ujian }}</li>
                            </ol>
                        </nav>
                        <form action="{{ route('submit.ujian') }}" method="POST">
                            @csrf
                            @foreach ($soals as $index => $soal)
                                <input type="text" value="{{ $soal->ujian_id }}" name="ujian_id" hidden>
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
        {{-- <p>2024 .</p>
        <p>Version 1.0</p> --}}
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let currentQuestion = 1;

            // Durasi ujian dalam detik (contoh: 1 jam = 3600 detik)
            let durasiUjian =
                {{ $ujian->durasi }}; // Ambil durasi dari database (dalam menit) dan konversi ke detik

            // Fungsi untuk mengirim jawaban otomatis
            function submitJawabanOtomatis() {
                alert("Waktu ujian telah habis. Jawaban akan dikirim secara otomatis.");

                // Ambil jawaban dari localStorage
                const answers = JSON.parse(localStorage.getItem('answers')) || {};

                // Tambahkan jawaban ke form
                // Tambahkan jawaban ke form
                $('form').find('input[type="hidden"]').remove(); // Hapus input hidden sebelumnya

                // Tambahkan CSRF token ke form
                $(`<input type="hidden" name="_token" value="${$('meta[name="csrf-token"]').attr('content')}">`)
                    .appendTo($('form'));

                // Tambahkan semua jawaban
                for (const [questionId, answer] of Object.entries(answers)) {
                    $(`<input type="hidden" name="jawaban[${questionId}]" value="${answer}">`).appendTo($('form'));
                }

                // Submit form
                $('form').submit();

            }

            // const durasiUjian = 120 * 60; // 120 menit dalam detik

            function setCookie(name, value, minutes) {
                const expires = new Date(Date.now() + minutes * 60 * 1000).toUTCString();
                document.cookie = `${name}=${value}; expires=${expires}; path=/`;
            }

            function getCookie(name) {
                const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
                return match ? match[2] : null;
            }

            function startTimer(durationInSeconds, display) {
                let endTime = getCookie("ujianEndTime");

                if (!endTime) {
                    const now = Date.now();
                    endTime = now + durationInSeconds * 1000;
                    setCookie("ujianEndTime", endTime, durationInSeconds / 60);
                } else {
                    endTime = parseInt(endTime);
                }

                const interval = setInterval(function() {
                    const now = Date.now();
                    let sisaWaktu = Math.floor((endTime - now) / 1000);

                    if (sisaWaktu <= 0) {
                        clearInterval(interval);
                        display.textContent = "00:00";
                        document.cookie = "ujianEndTime=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                        submitJawabanOtomatis();
                        return;
                    }

                    const minutes = String(Math.floor(sisaWaktu / 60)).padStart(2, "0");
                    const seconds = String(sisaWaktu % 60).padStart(2, "0");
                    display.textContent = `${minutes}:${seconds}`;
                }, 1000);
            }


            const display = document.querySelector('#timer');
            startTimer(durasiUjian, display);



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

        // ========== CEGAH KEMBALI ==========
        history.pushState(null, null, window.location.href);
        window.addEventListener('popstate', function(event) {
            history.pushState(null, null, window.location.href);
            alert("Anda tidak boleh kembali saat ujian berlangsung.");
        });

        document.addEventListener('keydown', function(e) {
            if ((e.altKey && e.key === 'ArrowLeft') || e.key === 'Backspace') {
                e.preventDefault();
                alert("Aksi kembali dinonaktifkan saat ujian.");
            }
        });

        // ========== DETEKSI TAB BARU / PINDAH FOKUS ==========
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                alert("Terjadi aktivitas mencurigakan: membuka tab lain. Ujian akan dikirim!");
                document.getElementById('ujianForm').submit();
            }
        });
    </script>
</body>

</html>
