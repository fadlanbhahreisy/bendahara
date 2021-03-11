@extends('layouts.master')
@section('title','Koordinator Page')
@section('judul','Koordinator Page')
@section('section-header')
    <h1>Koordinator</h1>
@endsection
@section('section-body')
    <div class="row">
      <div class="col-md-8">
          <a href="" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#addmodal"><i class="fa fa-plus"></i>Add</a>
      </div>
      <div class="col-md-4">
        <label for="">Saldo</label>
        <input type="text" readonly value="{{$saldo}}">
      </div>
    </div>
    <div class="mt-5">
      <table class="table table-striped display" id="tabel_koordinator">
        <thead>
          <tr>
            <th>No</th>
            <th>Keterangan</th>
            <th>Tanggal</th>
            <th>Nominal</th>
            <th>Jenis Transaksi</th>
            <th>Bukti</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($datatransaksikoordinator as $no => $data)
          <tr>
            <td>{{$no+1}}</td>
              <td>{{$data->keterangan}}</td>
              <td>{{$data->tanggal}}</td>
              <td>{{$data->nominal}}</td>
              <td>{{$data->jenistransaksi}}</td>
              <td><img src="{{asset('uploads/'.$data->gambar)}}" alt="" width="200px"></td>
              <td>
                <a href="#" data-id="{{$data->id}}" class="btn btn-primary btn-edit" title="edit"><i class="fa fa-edit"></i></a>
                <a href="#" data-id="{{$data->id}}" class="btn btn-danger swal-confirm" title="hapus"><i class="fa fa-trash "></i>
                  <form action="{{route('deletekoordinator',$data->id)}}" id="delete{{$data->id}}" method="post">
                    @csrf
                    @method('delete')
                  </form>
                </a>
                <a href="{{route('detailkoordinator',$data->id)}}" class="btn btn-primary" title="detail"><i class="fa fa-play"></i></a>
              </td>
          </tr>
          @endforeach
        </tbody>  
    </table>
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
        <form action="{{route('simpankoordinator')}}" method="post" enctype="multipart/form-data">
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
                  <option value="kredit">Kredit</option>
                  <option value="debit">Debit</option>
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
        <form action="{{route('updatekoordinator')}}" method="POST" id="form-edit" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            
          </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-update">Save changes</button>
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
$(".btn-edit").on('click',function(){
  //console.log($(this).data('id'))
  var id = $(this).data('id')
  $.ajax({
    url:"/koordinator/edit/"+id,
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
$(document).ready( function () {
    $('#tabel_koordinator').DataTable();
  } );
</script>
@endpush