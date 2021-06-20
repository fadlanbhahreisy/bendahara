@extends('layouts.master')
@section('title','Bendahara Page')
@section('judul','Bendahara Page')

@section('section-header')
    <h1>PJK</h1>
@endsection
@section('section-body')
<form action="{{route('insertpjk')}}" method="POST">
  @csrf
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Judul </label>
    <div class="col-sm-10">
      @error('judul')
      {{$message}}
      @enderror
      <input type="text" class="form-control" name="judul">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal</label>
    <div class="col-sm-10">
      @error('tanggal')
      {{$message}}
      @enderror
      <input type="date" class="form-control" name="tanggal">
    </div>
  </div>
  <h3>Praktikum</h3>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lampiran</label>
      <div class="col-sm-10">
        @error('lampiran')
      {{$message}}
      @enderror
        <input type="text" class="form-control" name="lampiran">
      </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Praktikum</label>
        <div class="col-sm-10">
        @error('praktikum')
        {{$message}}
        @enderror
          <select style="width:100%;" class="form-control" id="praktikum" name="praktikum">
              <option value="-">-- Select Praktikum -</option>
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
        <input type="text" class="form-control" name="periode">
      </div>
  </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lulus</label>
      <div class="col-sm-10">
        @error('lulus')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="lulus">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Tidak Lulus</label>
      <div class="col-sm-10">
        @error('tidaklulus')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="tidaklulus">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Gugur</label>
      <div class="col-sm-10">
        @error('gugur')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="gugur">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Peserta</label>
      <div class="col-sm-10">
        @error('jumlahpeserta')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="jumlahpeserta">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Kelas</label>
      <div class="col-sm-10">
        @error('kelas')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="kelas">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Peserta Perkelas</label>
      <div class="col-sm-10">
        @error('perkelas')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="perkelas">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Modul</label>
      <div class="col-sm-10">
        @error('jumlahmodul')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="jumlahmodul">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lama Praktikum</label>
      <div class="col-sm-10">
        @error('lamapraktikum')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="lamapraktikum">
      </div>
    </div>
    <h3>Biaya Praktikum</h3>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">SKS</label>
      <div class="col-sm-10">
        @error('sks')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="sks">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Sertifikat</label>
      <div class="col-sm-10">
        @error('sertifikat')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="sertifikat">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Operasional</label>
      <div class="col-sm-10">
        @error('operasional')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="operasional">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Koordinator</label>
      <div class="col-sm-10">
        @error('koordinator')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="koordinator">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Administrator</label>
      <div class="col-sm-10">
        @error('administrator')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="administrator">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Kebersihan</label>
      <div class="col-sm-10">
        @error('kebersihan')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="kebersihan">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Bimbingan</label>
      <div class="col-sm-10">
        @error('bimbingan')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="bimbingan">
      </div>
    </div>
    <h3>Kasbon</h3>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Honorarium</label>
      <div class="col-sm-10">
        @error('honorarium')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="honorarium">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Biaya Modul</label>
      <div class="col-sm-10">
        @error('biayamodul')
        {{$message}}
        @enderror
        <input type="text" class="form-control" name="biayamodul">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
