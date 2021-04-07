@extends('layouts.master')
@section('title','Koordinator Page')
@section('judul','Koordinator Page')
@section('section-header')
    <h1>Report Bendahara</h1>
@endsection
@section('section-body')

    <table class="table table-striped" id="report_table">
      <thead>
        <tr>
          <th>No</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
          <th>Nominal</th>
          <th>jenis transaksi</th>
          <th>Bukti</th>

        </tr>
      </thead>
        <tbody>
          @foreach ($datatransaksibendahara as $no => $data)
          <tr>
            <td>{{$no+1}}</td>
              <td>{{$data->keterangan}}</td>
              <td>{{$data->tanggal}}</td>
              <td>{{$data->nominal}}</td>
              <td>{{$data->jenistransaksi}}</td>
              <td><img src="{{asset('uploads/'.$data->gambar)}}" alt="" width="200px"></td>
          </tr>
          @endforeach
        </tbody>
    </table>
{{$saldo}}

@endsection
@push('after-scripts')
    <script>
      $(document).ready( function () {
        $('#report_table').DataTable();
      } );
    </script>
@endpush