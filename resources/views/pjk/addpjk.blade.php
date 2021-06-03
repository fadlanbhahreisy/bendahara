@extends('layouts.master')
@section('title','Bendahara Page')
@section('judul','Bendahara Page')

@section('section-header')
    <h1>bendahara</h1>
@endsection
@section('section-body')
<form action="{{route('insertpjk')}}" method="POST">
  @csrf
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="judul">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Tanggal</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" name="tanggal">
    </div>
  </div>
  <h1>Praktikum</h1>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lampiran</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="lampiran">
      </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Praktikum</label>
        <div class="col-sm-10">
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
        <input type="text" class="form-control" name="periode">
      </div>
  </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lulus</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="lulus">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Tidak Lulus</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="tidaklulus">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Gugur</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="gugur">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Peserta</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="jumlahpeserta">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Kelas</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="kelas">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Peserta Perkelas</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="perkelas">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Jumlah Modul</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="jumlahmodul">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Lama Praktikum</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="lamapraktikum">
      </div>
    </div>
    <h1>Biaya Praktikum</h1>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">SKS</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="sks">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Sertifikat</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="sertifikat">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Operasional</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="operasional">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Koordinator</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="koordinator">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Administrator</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="administrator">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Kebersihan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="kebersihan">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Bimbingan</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="bimbingan">
      </div>
    </div>
    <h1>Kasbon</h1>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Honorarium</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="honorarium">
      </div>
    </div>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Biaya Modul</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="biayamodul">
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
