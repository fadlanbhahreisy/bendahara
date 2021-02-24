@extends('layouts.master')
@section('title','Koordinator Page')
@section('judul','Koordinator Page')
@section('section-header')
    <h1>Report Bendahara</h1>
@endsection
@section('section-body')
<div class="row">
    <table class="table table-striped">
        <tr>
          <th>No</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
          <th>Kredit</th>
          <th>Debit</th>
          <th>Bukti</th>

        </tr>
        @php
            $totaldebit = 0;
            $totalkredit = 0;
        @endphp
          @foreach ($datatransaksibendahara as $no => $data)
          <tr>
            <td>{{$no+1}}</td>
              <td>{{$data->keterangan}}</td>
              <td>{{$data->tanggal}}</td>
              <td>{{$data->kredit}}</td>
              <td>{{$data->debit}}</td>
              <td><img src="{{asset('uploads/'.$data->gambar)}}" alt="" width="200px"></td>
          </tr>
          @php
              $totaldebit = $totaldebit+$data->debit;
              $totalkredit = $totalkredit+$data->kredit;
          @endphp
          
          @endforeach
          
          
    </table>
    @php
        echo $totaldebit-$totalkredit;
    @endphp
</div>
@endsection