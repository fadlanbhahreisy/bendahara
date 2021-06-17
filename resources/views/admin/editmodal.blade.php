<div class="form-group">
    <input type="hidden" value="{{$pilih_user->id}}" name="id" id="id_user" class="form-control">
  </div>
 <div class="form-group">
    <label>nama</label>
    <input type="text" value="{{$pilih_user->name}}" name="name" class="form-control">
  </div>

  <div class="form-group">
    <label>email</label>
    <input type="text" value="{{$pilih_user->email}}" name="email" class="form-control">
  </div>
 
  <div class="form-group">
    <label>password</label>
    <input type="password" name="password" class="form-control" placeholder="Enter Password">
  </div>

  <div class="form-group">
    <label>role</label>
    <div class="col-sm-12">
      <select style="width:100%;" class="form-control" id="role" name="role">
        @foreach ($role as $row)
        <option value="{{$row->id}}" {{ $row->id == $pilih_user->role_id ? 'selected' : ""}}>{{$row->role}}</option>
      @endforeach
      </select>
  </div>