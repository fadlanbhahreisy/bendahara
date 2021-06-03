
  <div class="form-group">
      <input type="hidden" value="{{$transaksibendahara->id}}" name="id" id="id_transaksi" class="form-control" >
    </div>
  <div class="form-group">
      <label>Keterangan</label>
      <input type="text" value="{{$transaksibendahara->keterangan}}" id="keterangan" name="keterangan" class="form-control" >
    </div>

  <div class="form-group">
    <label>Date</label>
    <input type="date" value="{{$transaksibendahara->tanggal}}" id="tanggal" name="tanggal" class="form-control">
  </div>

  <div class="form-group">
    <label>Nominal</label>
    <input type="text" name="nominal" value="{{$transaksibendahara->nominal}}" class="form-control">
</div>

<div class="form-group">
  <label>Jenis Transaksi</label>
  <div class="col-sm-12">
    <select style="width:100%;" class="form-control" id="jenistransaksi" name="jenistransaksi">
        <option value="{{$transaksibendahara->jenistransaksi_id}}">{{$transaksibendahara->jenistransaksi}}</option>
        @foreach ($jenis as $row)
          <option value="{{$row->id}}">{{$row->jenis}}</option>
        @endforeach
    </select>
  </div>
</div>

  <div class="form-group">
    <label>File</label>
    <input type="file" value="{{$transaksibendahara->gambar}}" id ="img" name="files" class="form-control">
  </div>
