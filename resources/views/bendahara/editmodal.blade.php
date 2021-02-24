
  <div class="form-group">
      <input type="text" readonly value="{{$transaksibendahara->id}}" name="id" id="id_transaksi" class="form-control" >
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
      <label>Debit</label>
      <input type="text" value="{{$transaksibendahara->debit}}" id="debit" name="debit" class="form-control">
  </div>

    <div class="form-group">
      <label>Kredit</label>
      <input type="text" value="{{$transaksibendahara->kredit}}" id="kredit" name="kredit" class="form-control">
    </div>

  <div class="form-group">
    <label>File</label>
    <input type="file" value="{{$transaksibendahara->gambar}}" id ="img" name="files" class="form-control">
  </div>
