@extends('layouts.master')
@section('title','Bendahara Page')
@if (auth()->user()->role_id == '1')
  @section('judul','Bendahara Page')
@elseif(auth()->user()->role_id == '2')
  @section('judul','Koordinator Page')
@elseif(auth()->user()->role_id == '3')
  @section('judul','Ka Lab Page')
@endif

@section('section-header')
    <h1>Honor</h1>
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
  <div class="mt-5">
    <table class="table table-striped display" id="tabel_honor">
      <thead>
        <tr>
          <th>No</th>
          <th>pjk</th>
          <th>Nama</th>
          <th>Status</th>
          <th>SKS</th>
          <th>Biaya Khusus</th>
          <th>HDR</th>
          <th>Jumlah Bimbingan</th>
          <th>Hr Bimbingan</th>
          <th>Total</th>
          <th>Honor Praktikum</th>
          <th>Action</th>
    
    
        </tr>
      </thead>
        
        <tbody>
          @foreach ($honor as $no => $data)
          <tr>
            <td>{{$no+1}}</td>
            <td>{{$data->judul}}</td>
              <td>{{$data->nama}}</td>
              <td>{{$data->status}}</td>
              <td>{{$data->sks}}</td>
              <td>{{$data->biayakhusus}}</td>
              <td>{{$data->hdr}}</td>
              <td>{{$data->jumlahbimb}}</td>
              <td>{{$data->hrbimb}}</td>
              <td>{{$data->total}}</td>
              <td>{{$data->honorpraktikum}}</td>
              <td>
                @if (auth()->user()->role_id == '1')
                  <a href="#" data-id="{{$data->id}}" class="btn btn-primary btn-edit" title="edit"><i class="fa fa-edit"></i></a>
                  <a href="#" data-id="{{$data->id}}" class="btn btn-danger swal-confirm" title="hapus"><i class="fa fa-trash "></i>
                    <form action="{{route('deletehonor',$data->id)}}" id="delete{{$data->id}}" method="post">
                      @csrf
                      @method('delete')
                    </form>
                  </a>
                @endif
              </td>
          </tr>
          @endforeach
        </tbody>
          
    </table>
  </div>
</div>


@endsection
@section('modal')
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add honor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('simpanhonor')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">

          <div class="form-group">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" >
          </div>

          <div class="form-group">
            <label>PJK</label>
            <select style="width:100%;" class="form-control" id="pjk" name="pjk">
              {{-- <option value="-">- Select -</option> --}}
              @foreach ($pjk as $row)
              <option value="{{$row->id}}">{{$row->judul}}</option>
              @endforeach
          </select>
          </div>

          <div class="form-group">
            <label>Status</label>
            <select style="width:100%;" class="form-control" id="status" name="status">
                <option value="Koordinator">Koordinator</option>
                <option value="Dosen/Pemb.">Dosen/Pemb.</option>
                <option value="Asisten/Pemb.">Asisten/Pemb.</option>
                <option value="Adm+Juru Lab.">Adm+Juru Lab.</option>
                <option value="Kebersihan">Kebersihan</option>
          </select>
        </div>

          <div class="form-group">
              <label>SKS</label>
              <input type="text" name="sks" class="form-control">
          </div>

        <div class="form-group">
            <label>Biaya Khusus</label>
            <input type="text" name="biayakhusus" class="form-control">
        </div>

        <div class="form-group">
          <label>HDR</label>
          <input type="text" name="hdr" class="form-control">
        </div>

        <div class="form-group">
          <label>Jumlah Bimbingan</label>
          <input type="text" name="jumlahbimb" class="form-control">
        </div>

        <div class="form-group">
          <label>Hr bimbingan</label>
          <input type="text" name="hrbimb" class="form-control">
        </div>

        <div class="form-group">
          <label>Total</label>
          <input type="text" name="total" class="form-control">
        </div>

        <div class="form-group">
          <label>Honor Praktikum</label>
          <input type="text" name="honorpraktikum" class="form-control">
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Honor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('updatehonor')}}" method="post" id="form-edit" enctype="multipart/form-data">
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
    url:"/bendahara/edithonor/"+id,
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
// // $(".btn-update").on('click',function(){
// //   $.ajaxSetup({
// //     headers: {
// //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// //     }
// //   });
// //   //console.log($(this).data('id'))
// //   var id = $('#form-edit').find('#id_transaksi').val()
// //   var form = $('#form-edit').serialize()
// //   console.log(form)
// //   var fd = new FormData()
// //   fd.append('id',id)
// //   $.ajax({
// //     url:"/bendahara/update/"+id,
// //     method:"post",
// //     processData: false,
// //     contentType: false,
// //     data:fd,
// //     success: function(data){
// //       //console.log(data)
// //       $('#editmodal').modal('hide')
// //       //$('#editmodal').find('.modal-body').html(data)
// //       window.location.assign('/bendahara/home')
// //     },
// //     error: function(error){
// //       console.log(error)
// //     }
// //   })
// // });
$(document).ready( function () {
    $('#tabel_honor').DataTable();
  } );
</script>
@endpush