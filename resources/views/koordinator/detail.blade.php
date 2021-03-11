@extends('layouts.master')
@section('title','Koordinator Page')
@section('judul','Koordinator Page')
@section('section-header')
    <h1>Detail Transaksi Koordinator</h1>
@endsection
@section('section-body')
<table>
    <tr>
        <td class="text-left">Keterangan</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$datatransaksikoordinator->keterangan}}</td>
    </tr>
    <tr>
        <td class="text-left">tanggal</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$datatransaksikoordinator->tanggal}}</td>
    </tr>
    <tr>
        <td class="text-left">Nominal</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$datatransaksikoordinator->nominal}}</td>
    </tr>
    <tr>
        <td class="text-left">Jenis Transaksi</td>
        <td class="text-center">:</td>
        <td class="text-left">{{$datatransaksikoordinator->jenistransaksi}}</td>
    </tr>
    <tr>
        <td class="text-left">Bukti</td>
        <td class="text-center">:</td>
        <td class="text-left">
            <img src="{{asset('uploads/'.$datatransaksikoordinator->gambar)}}" alt="Foto Profile" width="400px" height="auto">
        </td>
    </tr>
</table>

@endsection
