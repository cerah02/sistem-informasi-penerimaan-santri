@extends('santris.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2> Data Pendaftaran Santri</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('santris.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Id Santri :</strong>
                {{ $dokumen->santri_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <th>Ijazah</th>
            <td>
                <a href="{{ asset('storage/' . $dokumen->ijazah) }}" target="_blank">Lihat Dokumen</a>
            </td>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <th>Nilai Raport</th>
                <td>
                    <a href="{{ asset('storage/' . $dokumen->nilai_raport) }}" target="_blank">Lihat Dokumen</a>
                </td>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <th>SKHUN</th>
            <td>
                <a href="{{ asset('storage/' . $dokumen->skhun) }}" target="_blank">Lihat Dokumen</a>
            </td>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <th>Foto</th>
            <td>
                <a href="{{ asset('storage/' . $dokumen->foto) }}" target="_blank">Lihat Dokumen</a>
            </td>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <th>Kartu Keluarga (KK)</th>
            <td>
                <a href="{{ asset('storage/' . $dokumen->kk) }}" target="_blank">Lihat Dokumen</a>
            </td>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <th>KTP Ayah</th>
            <td>
                <a href="{{ asset('storage/' . $dokumen->ktp_ayah) }}" target="_blank">Lihat Dokumen</a>
            </td>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <th>KTP Ibu</th>
                <td>
                    <a href="{{ asset('storage/' . $dokumen->ktp_ibu) }}" target="_blank">Lihat Dokumen</a>
                </td>
            </div>
        </div>
    </div>
@endsection
