@extends('layout')
@section('content')
    <div class="container mt-4">
        {{-- Judul --}}
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center text-primary mb-4 section-title">
                    📊 Data Passing Grade
                </h2>
            </div>
        </div>

        {{-- Card Passing Grade --}}
        <div class="row">
            @foreach ($passingGrades as $passingGrade)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Jenjang {{ $passingGrade->jenjang }}</h5>
                            <div>
                                <a href="#" class="text-white edit-btn" data-id="{{ $passingGrade->id }}"
                                    data-jenjang="{{ $passingGrade->jenjang }}"
                                    data-grade="{{ $passingGrade->passing_grade }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="passing-grade-value" id="grade-{{ $passingGrade->id }}">
                                {{ $passingGrade->passing_grade }}
                            </div>
                            <p class="card-text text-center mb-0">Nilai Minimum Kelulusan</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Passing Grade</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editId">
                        <div class="mb-3">
                            <label for="editJenjang" class="form-label">Jenjang</label>
                            <input type="text" class="form-control" id="editJenjang" name="jenjang" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editGrade" class="form-label">Passing Grade</label>
                            <input type="number" class="form-control" id="editGrade" min="0" max="100"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editModal = new bootstrap.Modal(document.getElementById('editModal'));
                const editForm = document.getElementById('editForm');
                const editId = document.getElementById('editId');
                const editJenjang = document.getElementById('editJenjang');
                const editGrade = document.getElementById('editGrade');

                // Ketika icon edit diklik
                document.querySelectorAll('.edit-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        editId.value = this.dataset.id;
                        editJenjang.value = this.dataset.jenjang;
                        editGrade.value = this.dataset.grade;
                        editModal.show();
                    });
                });

                // Submit form edit
                editForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const id = editId.value;
                    const grade = editGrade.value;

                    fetch(`/passing-grades/${id}`, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                passing_grade: grade
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update nilai di kartu
                                document.getElementById(`grade-${id}`).textContent = grade;
                                editModal.hide();

                                // SweetAlert success
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Passing grade berhasil diperbarui.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Gagal menyimpan perubahan.',
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan!',
                                text: 'Server tidak merespon atau terjadi error.',
                            });
                        });
                });
            });
        </script>
    @endpush
@endsection

<style>
    .card {
        transition: all 0.3s ease;
        border-radius: 15px;
        overflow: hidden;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.12);
    }

    .card-header {
        font-size: 1.2rem;
        letter-spacing: 0.5px;
    }

    .section-title {
        font-weight: 700;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        position: relative;
        padding-bottom: 10px;
        margin-bottom: 30px;
    }

    .section-title::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: #007bff;
        margin: 10px auto 0;
    }

    .passing-grade-value {
        font-size: 2.5rem;
        font-weight: bold;
        color: #0d6efd;
        text-align: center;
        margin: 15px 0;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .card-header a {
        text-decoration: none;
        font-size: 1.2rem;
        transition: all 0.2s;
    }

    .card-header a:hover {
        opacity: 0.8;
        transform: scale(1.1);
    }
</style>
