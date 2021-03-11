@extends('layouts.master')
@section('title','Bendahara Page')
@section('judul','Bendahara Page')

@section('section-header')
    <h1>bendahara</h1>
@endsection
@section('section-body')
<form>
    <div class="form-group row">
      <label class="col-sm-2 col-form-label">Nomor</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="nomor">
      </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nominal</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nominal">
        </div>
    </div>
    
</form>
@endsection
