@extends('layouts.master')
@section('title','Bendahara Page')
@section('judul','Bendahara Page')
@section('section-header')
    <h1>Detail Transaksi Bendahara</h1>
@endsection
@section('section-body')
<table>
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
<form action="{{route('exportpjk',$pjk->id)}}">
    <button type="submit" name="action" class="btn btn-primary" value="cetakDoc">cetak Doc</button>
    <button type="submit" name="action" class="btn btn-primary" value="cetakExcel">cetak Excel</button>
</form>
@endsection
