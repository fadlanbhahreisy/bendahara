@extends('layouts.master')
@section('title','Bendahara Page')
@section('judul','Bendahara Page')

@section('section-header')
    <h1>Edit PJK</h1>
@endsection
@section('section-body')
<form action="{{route('updatepjk',$pjk->id)}}" method="GET">
  @csrf
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      @error('judul')
      {{$message}}
      @enderror
      <input type="text" class="form-control" value="{{$pjk->judul}}" name="judul">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal</label>
    <div class="col-sm-10">
      @error('tanggal')
      {{$message}}
      @enderror
      <input type="date" class="form-control" value="{{$pjk->tanggal}}" name="tanggal">
    </div>
  </div>
  <h1>Praktikum</h1>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lampiran</label>
      <div class="col-sm-10">
        @error('lampiran')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->lampiran}}" name="lampiran">
      </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Praktikum</label>
        <div class="col-sm-10">
          @error('praktikum')
          {{$message}}
          @enderror
          <select style="width:100%;" class="form-control" id="praktikum" name="praktikum">
              <option value="{{$pjk->praktikum}}">{{$pjk->praktikum}}</option>
              <option value="Pemrograman Berorientasi Objek">Pemrograman Berorientasi Objek</option>
              <option value="Basis Data">Basis Data</option>
          </select>
        </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Periode Praktikum</label>
      <div class="col-sm-10">
        @error('periode')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->periode}}" name="periode">
      </div>
  </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lulus</label>
      <div class="col-sm-10">
        @error('lulus')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->lulus}}" name="lulus">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Tidak Lulus</label>
      <div class="col-sm-10">
        @error('tidaklulus')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->tidaklulus}}" name="tidaklulus">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Gugur</label>
      <div class="col-sm-10">
        @error('gugur')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->gugur}}" name="gugur">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Peserta</label>
      <div class="col-sm-10">
        @error('jumlahpeserta')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->jumlahpeserta}}" name="jumlahpeserta">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Kelas</label>
      <div class="col-sm-10">
        @error('kelas')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->jumlahkelas}}" name="kelas">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Peserta Perkelas</label>
      <div class="col-sm-10">
        @error('perkelas')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->jumlahpesertaperkelas}}" name="perkelas">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Modul</label>
      <div class="col-sm-10">
        @error('jumlahmodul')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->jumlahmodul}}" name="jumlahmodul">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lama Praktikum</label>
      <div class="col-sm-10">
        @error('lamapraktikum')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->lamapraktikum}}" name="lamapraktikum">
      </div>
    </div>
    <h1>Biaya Praktikum</h1>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">SKS</label>
      <div class="col-sm-10">
        @error('sks')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->sks}}" name="sks">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Sertifikat</label>
      <div class="col-sm-10">
        @error('sertifikat')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->sertifikat}}" name="sertifikat">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Operasional</label>
      <div class="col-sm-10">
        @error('operasional')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->operasional}}" name="operasional">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Koordinator</label>
      <div class="col-sm-10">
        @error('koordinator')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->koordinator}}" name="koordinator">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Administrator</label>
      <div class="col-sm-10">
        @error('administrator')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->administrator}}" name="administrator">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Kebersihan</label>
      <div class="col-sm-10">
        @error('kebersihan')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->kebersihan}}" name="kebersihan">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Bimbingan</label>
      <div class="col-sm-10">
        @error('bimbingan')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->bimbingan}}" name="bimbingan">
      </div>
    </div>
    <h1>Kasbon</h1>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Honorarium</label>
      <div class="col-sm-10">
        @error('honorarium')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->honorarium}}" name="honorarium">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Biaya Modul</label>
      <div class="col-sm-10">
        @error('biayamodul')
        {{$message}}
        @enderror
        <input type="text" class="form-control" value="{{$pjk->biayamodul}}" name="biayamodul">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
