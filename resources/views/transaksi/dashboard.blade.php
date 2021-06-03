@extends('layouts.master')
@section('title','Bendahara Page')
@if (auth()->user()->role_id == '2')
  @section('judul','Bendahara Page')

  @section('section-header')
      <h1>bendahara</h1>
  @endsection
@elseif(auth()->user()->role_id == '3')
  @section('judul','Koordinator Page')

  @section('section-header')
      <h1>Koordinator</h1>
  @endsection
@elseif(auth()->user()->role_id == '4')
  @section('judul','Ka Lab Page')

  @section('section-header')
      <h1>Ka Lab</h1>
  @endsection
@endif

@section('section-body')
<div class="row">
    <div class="card bg-danger ml-5" style="width: 18rem;">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-cash-register mr-3"></i>
          </div>
          <h5 class="card-title">Total Transaksi</h5>
          <div class="display-4">{{$jumlahtransaksi}}</div>
          <a href="{{route('bendaharaHome')}}"><p class="card-text text-white">detail<i class="fas fa-angle-double-right ml-2"></i></p></a>
        </div>
    </div>
    <div class="card bg-success ml-5" style="width: 18rem;">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-money-bill mr-3"></i>
          </div>
          <h5 class="card-title">Saldo</h5>
          <div class="display-4">{{$saldo}}</div>
        </div>
    </div>
    <div class="card bg-primary ml-5" style="width: 18rem;">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-money-bill mr-3"></i>
          </div>
          <h5 class="card-title">Total PJK</h5>
          <div class="display-4">{{$jumlahpjk}}</div>
          <a href="{{route('bendaharaPjk')}}"><p class="card-text text-white">detail<i class="fas fa-angle-double-right ml-2"></i></p></a>
        </div>
    </div>
</div>

@endsection