@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Edit Visi & Misi Pesantren</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('visi_misi.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Visi</label>
                        <textarea name="visi" class="form-control" rows="2">{{ $contents['visi']->value }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quote</label>
                        <textarea name="quote" class="form-control" rows="2">{{ $contents['quote']->value }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Misi (pisahkan dengan baris baru)</label>
                        <textarea name="misi[]" class="form-control" rows="4">{{ implode("\n", json_decode($contents['misi']->value, true)) }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nilai-nilai Pesantren</label>
                        @foreach (json_decode($contents['nilai']->value, true) as $index => $card)
                            <div class="border rounded p-3 mb-2">
                                <input type="text" name="nilai[{{ $index }}][icon]" class="form-control mb-2"
                                    placeholder="Icon" value="{{ $card['icon'] }}">
                                <input type="text" name="nilai[{{ $index }}][title]" class="form-control mb-2"
                                    placeholder="Title" value="{{ $card['title'] }}">
                                <textarea name="nilai[{{ $index }}][desc]" class="form-control" placeholder="Deskripsi">{{ $card['desc'] }}</textarea>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
