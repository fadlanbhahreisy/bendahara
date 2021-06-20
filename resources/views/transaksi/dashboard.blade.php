@extends('layouts.master')
@section('title','Bendahara Page')
@if (auth()->user()->role_id == '1')
  @section('judul','Bendahara Page')

  @section('section-header')
      <h1>Dashboard</h1>
  @endsection
@elseif(auth()->user()->role_id == '2')
  @section('judul','Koordinator Page')

  @section('section-header')
      <h1>Koordinator</h1>
  @endsection
@elseif(auth()->user()->role_id == '3')
  @section('judul','Ka Lab Page')

  @section('section-header')
      <h1>Ka Lab</h1>
  @endsection
@endif

@section('section-body')
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-cash-register"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Transaksi</h4>
            </div>
            <div class="card-body">
              {{$jumlahtransaksi}}
            </div>
          </div>
          <div class="card-cta">
            <a href="{{route('bendaharaHome')}}"><p class="card-text text-black">More Info<i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-money-bill"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Saldo</h4>
            </div>
            <div class="card-body">
              {{$saldo}}
            </div>
          </div>
          <div class="card-cta">
            <a href="{{route('bendaharaHome')}}"><p class="card-text text-black">More Info<i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-book"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>PJK</h4>
            </div>
            <div class="card-body">
              {{$jumlahpjk}}
            </div>
          </div>
          <div class="card-cta">
            <a href="{{route('bendaharaPjk')}}"><p class="card-text text-black">More Info<i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>
      </div>
</div>  


@endsection