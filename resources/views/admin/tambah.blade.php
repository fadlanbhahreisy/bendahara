@extends('layouts.master')
@section('title','Crud')
@section('section-header')
    <h1>Crud</h1>
@endsection
@section('section-body')
<div class="card-body">
  
    <div class="form-group">
      <label>Text</label>
      <input type="text" class="form-control">
    </div>
    
   
    <div class="form-group">
      <label>Date</label>
      <input type="date" class="form-control">
    </div>
   
    <div class="form-group">
      <label>File</label>
      <input type="file" class="form-control">
    </div>
    
  </div>
@endsection