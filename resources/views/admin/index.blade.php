@extends('layouts.master')
@section('title','Ka Lab Page')
@section('judul','Ka Lab Page')
@section('section-header')
    <h1>Manajemen User</h1>
@endsection
@section('section-body')
    <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
            <a href="" class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#addmodal"><i class="fa fa-plus"></i>Add</a>
           
          </div>
       
          <table class="table table-striped">
            <tr>
              <th>No</th>
              <th>email</th>
              <th>Name</th>
              <th>Role</th>
              <th>Action</th>

            </tr>
            
              @foreach ($data_user as $no => $user)
              <tr>
                <td>{{$no+1}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->role}}</td>
                  <td>
                    <a href="#" data-id="{{$user->id}}" class="btn btn-primary btn-edit"><i class="fa fa-edit"></i>edit</a>
                    <a href="#" data-id="{{$user->id}}" class="btn btn-danger swal-confirm"><i class="fa fa-trash "></i>delete
                      <form action="{{route('delete',$user->id)}}" id="delete{{$user->id}}" method="post">
                        @csrf
                        @method('delete')
                      </form>
                    </a>
                  </td>
              </tr>
              
              @endforeach
        </table>
    </div>
@endsection
@section('modal')
<div class="modal fade" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('simpan')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>nama</label>
            <input type="text" name="name" class="form-control">
          </div>

          <div class="form-group">
            <label>email</label>
            <input type="text" name="email" class="form-control">
          </div>
         
          <div class="form-group">
            <label>password</label>
            <input type="password" name="password" class="form-control">
          </div>

          <div class="form-group">
            <label>role</label>
            <div class="col-sm-12">
              <select style="width:100%;" class="form-control" id="role" name="role">
                  <option value="-">- Select Role -</option>
                  <option value="1">Admin</option>
                  <option value="2">Bendahara</option>
                  <option value="3">Koordinator</option>
                  <option value="4">Ka Lab</option>
              </select>
          </div>
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
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" id="form-edit">
        @csrf
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary btn-update">Save changes</button>
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
    url:"/crud/edit/"+id,
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
$(".btn-update").on('click',function(){
  //console.log($(this).data('id'))
  var id = $('#form-edit').find('#id_user').val()
  var form = $('#form-edit').serialize()
  console.log(form)
  $.ajax({
    url:"/crud/update/"+id,
    method:"PATCH",
    data:form,
    success: function(data){
      //console.log(data)
      $('#editmodal').modal('hide')
      // $('#editmodal').find('.modal-body').html(data)
      window.location.assign('/crud')
    },
    error: function(error){
      console.log(error)
    }
  })
});
</script>

@endpush

  {{-- <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label>Id Transaksi</label>
              <input type="text" readonly name="id_transaksi" class="form-control">
            </div>

            <div class="form-group">
              <label>Date</label>
              <input type="date" name="tanggal" class="form-control">
            </div>

            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" name="keterangan" class="form-control">
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
  </div> --}}