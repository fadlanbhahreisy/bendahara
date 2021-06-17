@extends('layouts.master')
@section('title','Bendahara Page')
@if (auth()->user()->role_id == '1')
  @section('judul','Bendahara Page')
@elseif(auth()->user()->role_id == '2')
  @section('judul','Koordinator Page')
@elseif(auth()->user()->role_id == '3')
  @section('judul','Ka Lab Page')
@endif
@section('section-header')
    <h1>Detail Pjk</h1>
@endsection
@section('section-body')
<table class="table">
    <tr>
        <td class="text-left">Judul</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->judul}}</td>
    </tr>
    <tr>
        <td class="text-left">Tanggal</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->tanggal}}</td>
    </tr>
    <tr>
        <td class="text-left">Lampiran</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->lampiran}}</td>
    </tr>
    <tr>
        <td class="text-left">Praktikum</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->praktikum}}</td>
    </tr>
    <tr>
        <td class="text-left">Periode Praktikum</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->periode}}</td>
    </tr>
    <tr>
        <td class="text-left">Lulus</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->lulus}}</td>
    </tr>
    <tr>
        <td class="text-left">Tidak Lulus</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->tidaklulus}}</td>
    </tr>
    <tr>
        <td class="text-left">Gugur</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->gugur}}</td>
    </tr>
    <tr>
        <td class="text-left">Jumlah peserta</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->jumlahpeserta}}</td>
    </tr>
    <tr>
        <td class="text-left">Jumlah Kelas</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->jumlahkelas}}</td>
    </tr>
    <tr>
        <td class="text-left">Jumlah peserta Perkelas</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->jumlahpesertaperkelas}}</td>
    </tr>
    <tr>
        <td class="text-left">Jumlah Modul</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->jumlahmodul}}</td>
    </tr>
    <tr>
        <td class="text-left">Lama Praktikum</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->lamapraktikum}}</td>
    </tr>
    <tr>
        <td class="text-left">SKS</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->sks}}</td>
    </tr><tr>
        <td class="text-left">Sertifikat</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->sertifikat}}</td>
    </tr>
    <tr>
        <td class="text-left">Operasional</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->operasional}}</td>
    </tr>
    <tr>
        <td class="text-left">Koordinator</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->koordinator}}</td>
    </tr>
    <tr>
        <td class="text-left">Administrasi</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->administrator}}</td>
    </tr>
    <tr>
        <td class="text-left">kebersihans</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->kebersihan}}</td>
    </tr>
    <tr>
        <td class="text-left">Bimbingan</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->bimbingan}}</td>
    </tr>
    <tr>
        <td class="text-left">Honorarium</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->honorarium}}</td>
    </tr>
    <tr>
        <td class="text-left">Biaya Modul</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$pjk->biayamodul}}</td>
    </tr>
</table>
<h1>Honor</h1>
<table class="table">
    <thead>
        <th>No</th>
          <th>Nama</th>
          <th>Status</th>
          <th>SKS</th>
          <th>Biaya Khusus</th>
          <th>HDR</th>
          <th>Jumlah Bimbingan</th>
          <th>Hr Bimbingan</th>
          <th>Total</th>
          <th>Honor Praktikum</th>
    </thead>
    <tbody>
        @foreach ($honor as $no => $data)
        <tr>
          <td>{{$no+1}}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->status}}</td>
            <td>{{$data->sks}}</td>
            <td>{{$data->biayakhusus}}</td>
            <td>{{$data->hdr}}</td>
            <td>{{$data->jumlahbimb}}</td>
            <td>{{$data->hrbimb}}</td>
            <td>{{$data->total}}</td>
            <td>{{$data->honorpraktikum}}</td>
        </tr>
        @endforeach
      </tbody>
</table>
<form action="{{route('exportpjk',$pjk->id)}}">
    <button type="submit" name="action" class="btn btn-primary" value="cetakDoc"><i class="fas fa-file-word"></i> cetak Doc</button>
    <button type="submit" name="action" class="btn btn-primary" value="cetakExcel"><i class="fas fa-file-excel"></i> cetak Excel</button>
</form>
@endsection
