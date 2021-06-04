@extends('layouts.master')
@section('title','Bendahara Page')
@if (auth()->user()->role_id == '2')
  @section('judul','Bendahara Page')
@elseif(auth()->user()->role_id == '3')
  @section('judul','Koordinator Page')
@elseif(auth()->user()->role_id == '4')
  @section('judul','Ka Lab Page')
@endif

@section('section-header')
    <h1>PJK</h1>
@endsection
@section('section-body')
@if (session('message'))
<div class="alert alert-success alert-dismissible show fade">
  <div class="alert-body">
    <button class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
    {{session('message')}}
  </div>
</div>
@endif
<div class="container">
  @if (auth()->user()->role_id == '2')
  <div class="row">
    <div class="col-md-2">
        <a href="{{route('addpjk')}}" class="btn btn-icon icon-left btn-primary"><i class="fa fa-plus"></i>Add</a>
    </div>
  </div>
  @endif
<div class="mt-5">

  <table class="table table-striped display" id="tabel_bendahara">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Action</th>

      </tr>
    </thead>
      
      <tbody>
        @foreach ($pjk as $no => $data)
        <tr>
          <td>{{$no+1}}</td>
          <td>{{$data->judul}}</td>
          <td>
            @if (auth()->user()->role_id == '2')
            <a href="{{route('editpjk',$data->id)}}" data-id="{{$data->id}}" class="btn btn-primary btn-edit" title="edit"><i class="fa fa-edit"></i></a>
            <a href="#" data-id="{{$data->id}}" class="btn btn-danger swal-confirm" title="hapus"><i class="fa fa-trash "></i>
              <form action="{{route('deletepjk',$data->id)}}" id="delete{{$data->id}}" method="post">
                @csrf
                @method('delete')
              </form>
            </a>
            @endif
            <a href="{{route('detailpjk',$data->id)}}" class="btn btn-primary" title="detail"><i class="fa fa-play"></i></a>
          </td>
        </tr>
        @endforeach
      </tbody>
        
  </table>
</div>
</div>

@endsection
@push('page-scripts')
<script src="{{asset('node_modules/sweetalert/dist/sweetalert.min.js')}}"></script>
@endpush
@push('after-scripts')
<script>
$(".swal-confirm").click(function(e) {
  id = e.target.dataset.id;
  swal({
      title: 'Are you sure?',
      text: 'Once deleted, you will not be able to recover this imaginary file!',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        swal('file has been deleted!', {
          icon: 'success',
        });
        $('#delete'+id).submit();
      } else {
      swal('Your file is safe!');
      }
    });
});    
$(document).ready( function () {
    $('#tabel_bendahara').DataTable();
  } );
</script>


@endpush