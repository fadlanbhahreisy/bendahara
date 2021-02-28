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
        <form action="{{route('searchkoordinator')}}">
          
          <div class="from-group">
            <input type="text" class="form-control typeahead" autocomplete="off" name="ket" id="ket" placeholder="Search..">
            <div class="dropdown" id="ketlist">
              
            </div>
          </div>
          {{ csrf_field() }}
        </form>
    </div>
    <table class="table table-striped mt-5">
        <tr>
          <th>No</th>
          <th>Keterangan</th>
          <th>Tanggal</th>
          <th>Kredit</th>
          <th>Debit</th>
          <th>Bukti</th>
          <th>Action</th>

        </tr>
        @php
            $totaldebit = 0;
            $totalkredit = 0;
        @endphp
          @foreach ($datatransaksikoordinator as $no => $data)
          <tr>
            <td>{{$no+1}}</td>
              <td>{{$data->keterangan}}</td>
              <td>{{$data->tanggal}}</td>
              <td>{{$data->kredit}}</td>
              <td>{{$data->debit}}</td>
              <td><img src="{{asset('uploads/'.$data->gambar)}}" alt="" width="200px"></td>
              <td>
                <a href="#" data-id="{{$data->id}}" class="btn btn-primary btn-edit"><i class="fa fa-edit"></i>edit</a>
                <a href="#" data-id="{{$data->id}}" class="btn btn-danger swal-confirm"><i class="fa fa-trash "></i>delete
                  <form action="{{route('deletekoordinator',$data->id)}}" id="delete{{$data->id}}" method="post">
                    @csrf
                    @method('delete')
                  </form>
                </a>
                <a href="{{route('detailkoordinator',$data->id)}}" class="btn btn-primary"><i class="fa fa-play"></i>Detail</a>
              </td>
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
                <label>Debit</label>
                <input type="text" name="debit" class="form-control">
            </div>

              <div class="form-group">
                <label>Kredit</label>
                <input type="text" name="kredit" class="form-control">
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
</script>
{{-- <script type="text/javascript">
  var path={{route('autocomplete')}};
  $('input.typeahead').typeahead({
    source:function(terms,process){
      return $.get(path,{terms:terms},function(data){
        return process(data);
      })
    }
  });

</script> --}}
<script>
  $(document).ready(function(){
  
   $('#ket').keyup(function(){ 
          var query = $(this).val();
          if(query != '')
          {
           var _token = $('input[name="_token"]').val();
           $.ajax({
            url:"{{ route('autocomplete.fetch') }}",
            method:"POST",
            data:{query:query, _token:_token},
            success:function(data){
             $('#ketlist').fadeIn();  
                      $('#ketlist').html(data);
            }
           });
          }
      });
  
      $(document).on('click', 'li', function(){  
          $('#ket').val($(this).text());  
          $('#ketlist').fadeOut();  
      });  
  
  });
  </script>

@endpush