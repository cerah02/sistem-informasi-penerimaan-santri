@extends('layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Data Ujian</h2>
            </div>
            @can('ujian-create')
                <div class="pull-right">
                </div>
            @endcan
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        @foreach ($jenjang as $j)
            <div class="col-md-4">
                <div class="card jenjang-card" data-url="{{ url('ujian/' . strtolower($j)) }}" style="cursor: pointer;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $j }}</h5>
                        <p class="card-text">Informasi terkait ujian jenjang {{ $j }}.</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.jenjang-card').click(function() {
                const url = $(this).data('url');
                window.location.href = url;
            });
        });
    </script>
@endsection
