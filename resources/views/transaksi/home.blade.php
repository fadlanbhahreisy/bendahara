@extends('layouts.master')
@section('title','Bendahara Page')
@if (auth()->user()->role_id == '1')
  @section('judul','Bendahara Page')

  @section('section-header')
      <h1>bendahara</h1>
  @endsection
@elseif(auth()->user()->role_id == '2')
  @section('judul','Koordinator Page')

  @section('section-header')
      <h1>Report Trasnsaksi Bendahara</h1>
  @endsection
@elseif(auth()->user()->role_id == '3')
  @section('judul','Ka Lab Page')

  @section('section-header')
      <h1>Report Trasnsaksi Bendahara</h1>
  @endsection
@endif

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
@if ($errors->any())
<div class="alert alert-danger alert-dismissible show fade">
  <div class="alert-body">
    <button class="close" data-dismiss="alert">
      <span>&times;</span>
    </button>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
  </div>
</div>
@endif
<div class="container">
  <div class="row">
    <div class="col-md-2">
      @if (auth()->user()->role_id == '1')
        <a href="" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#addmodal"><i class="fa fa-plus"></i>Add</a>
      @endif
    </div>
  </div>

<div class="mt-5">
  <form action="{{route('filterbendahara')}}" method="POST">
    @csrf
    <div class="container">
      <div class="row">
        <div class="container-fluid">
          <div class="form-group row">
            <label for="date" class="col-form-label col-sm-2">from</label>
            <div class="col-sm-3">
              <input type="date" class="form-control input-sm" id="from" name="from">
            </div>
            <label for="date" class="col-form-label col-sm-2">to</label>
            <div class="col-sm-3">
              <input type="date" class="form-control input-sm" id="to" name="to">
            </div>
            <div class="col-sm-2">
              <button type="submit" class="btn btn-success" name="search">Filter</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
 
   <div class="table-responsive">
    <table class="table table-striped display" id="tabel_bendahara">
      <thead>
        <tr>
          <th>No</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
          <th>Nominal</th>
          <th>Jenis Transaksi</th>
          <th>Status</th>
          <th>Action</th>
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
                <td>
                  <?= $data->status == 0 ? '<span class="badge badge-danger">Belum Di-Verif</span>' : '<span class="badge badge-success">Telah Di Verif</span>'; ?>
                </td>
              <td>
                @if (auth()->user()->role_id == '1')
                  <a href="#" data-id="{{$data->id}}" class="btn btn-primary btn-edit" title="edit"><i class="fa fa-edit"></i></a>
                  <a href="#" data-id="{{$data->id}}" class="btn btn-danger swal-confirm" title="hapus"><i class="fa fa-trash "></i>
                    <form action="{{route('deletebendahara',$data->id)}}" id="delete{{$data->id}}" method="post">
                      @csrf
                      @method('delete')
                    </form>
                  </a>
                @endif
                  <a href="{{route('detailbendahara',$data->id)}}" class="btn btn-primary" title="detail"><i class="fa fa-play"></i></a>
              </td>
          </tr>
          @endforeach
        </tbody>
          
    </table>
   </div>
    
  </div>
  </div>
@endsection
@section('modal')
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('simpanbendahara')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">

            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="keterangan" class="form-control" >
            </div>

            <div class="form-group">
              <label>Date</label>
              <input type="date" name="tanggal" class="form-control">
            </div>

            <div class="form-group">
                <label>Nominal</label>
                <input type="text" name="nominal" class="form-control">
            </div>

            <div class="form-group">
              <label>Jenis Transaksi</label>
              <div class="col-sm-12">
                <select style="width:100%;" class="form-control" id="jenistransaksi" name="jenistransaksi">
                    <option value="-">- Select -</option>
                    @foreach ($jenis as $row)
                      <option value="{{$row->id}}">{{$row->jenis}}</option>
                    @endforeach
                </select>
              </div>
            </div>
           
            <div class="form-group">
              <label>File</label>
              <input type="file" name="files" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('updatebendahara')}}" method="post" id="form-edit" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="sumbit" class="btn btn-primary btn-update">Save changes</button>
          </div>
        </form>
      </div>
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
      text: 'Once deleted, you will not be able to recover this file!',
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

$(".btn-edit").on('click',function(){
  //console.log($(this).data('id'))
  var id = $(this).data('id')
  $.ajax({
    url:"/bendahara/edit/"+id,
    method:"GET",
    success: function(data){
      //console.log(data)
      $('#editmodal').modal('show')
      $('#editmodal').find('.modal-body').html(data)
    },
    error: function(error){
      console.log(error)
    }
  })
});
// $(".btn-update").on('click',function(){
//   $.ajaxSetup({
//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//   });
//   //console.log($(this).data('id'))
//   var id = $('#form-edit').find('#id_transaksi').val()
//   var form = $('#form-edit').serialize()
//   console.log(form)
//   var fd = new FormData()
//   fd.append('id',id)
//   $.ajax({
//     url:"/bendahara/update/"+id,
//     method:"post",
//     processData: false,
//     contentType: false,
//     data:fd,
//     success: function(data){
//       //console.log(data)
//       $('#editmodal').modal('hide')
//       //$('#editmodal').find('.modal-body').html(data)
//       window.location.assign('/bendahara/home')
//     },
//     error: function(error){
//       console.log(error)
//     }
//   })
// });
$(document).ready( function () {
    $('#tabel_bendahara').DataTable();
  } );
</script>


@endpush