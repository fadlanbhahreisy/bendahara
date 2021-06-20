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
    <h1>Detail Transaksi Bendahara</h1>
@endsection

@section('section-body')
<table class="table">
    <tr>
        <td class="text-left">Keterangan</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$datatransaksibendahara->keterangan}}</td>
    </tr>
    <tr>
        <td class="text-left">tanggal</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$datatransaksibendahara->tanggal}}</td>
    </tr>
    <tr>
        <td class="text-left">Nominal</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$datatransaksibendahara->nominal}}</td>
    </tr>
    <tr>
        <td class="text-left">Jenis Transaksi</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$datatransaksibendahara->jenistransaksi}}</td>
    </tr>
    <tr>
        <td class="text-left">Bukti</td>
        <td class="text-center">:</td>
        <td class="text-left">
            <img src="{{asset('uploads/'.$datatransaksibendahara->gambar)}}" alt="Foto Profile" width="400px" height="auto">
        </td>
    </tr>
    @if(auth()->user()->role_id == '3')
    <tr>
        <td class="text-left"></td>
        <td class="text-center"></td>
        <td class="text-left">
            <?php if ($datatransaksibendahara->status == 0) : ?>
                <span class="text-primary h3 font-weight-bold">Belum diverifikasi</span>
                <br />
                <a href="{{route('verif',$datatransaksibendahara->id)}}" class="btn btn-success">Verif</a>
            <?php else : ?>
                <span class="text-primary h3 font-weight-bold">Sudah diverifikasi</span>
                <br />
                <a href="{{route('unverif',$datatransaksibendahara->id)}}" class="btn btn-danger">Un-Verif</a>
            <?php endif; ?>
        </td>
    </tr>
    @endif
</table>

@endsection
