@extends('layout')

@section('content')
    <div class="container mt-5">
        <h2>Edit Konten Beranda</h2>
        <form action="{{ route('beranda.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @foreach ($contents as $key => $content)
                <div class="mb-3">
                    <label class="form-label">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                    @if (str_contains($key, 'image'))
                        <input type="file" name="{{ $key }}" class="form-control">
                        <small>Current: {{ $content->value }}</small>
                    @else
                        <input type="text" name="{{ $key }}" class="form-control" value="{{ $content->value }}">
                    @endif
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
