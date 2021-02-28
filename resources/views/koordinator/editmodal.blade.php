
  <div class="form-group">
    <input type="text" readonly value="{{$transaksikoordinator->id}}" name="id" id="id_transaksi" class="form-control" >
  </div>
<div class="form-group">
    <label>Keterangan</label>
    <input type="text" value="{{$transaksikoordinator->keterangan}}" id="keterangan" name="keterangan" class="form-control" >
  </div>

<div class="form-group">
  <label>Date</label>
  <input type="date" value="{{$transaksikoordinator->tanggal}}" id="tanggal" name="tanggal" class="form-control">
</div>

<div class="form-group">
    <label>Debit</label>
    <input type="text" value="{{$transaksikoordinator->debit}}" id="debit" name="debit" class="form-control">
</div>

  <div class="form-group">
    <label>Kredit</label>
    <input type="text" value="{{$transaksikoordinator->kredit}}" id="kredit" name="kredit" class="form-control">
  </div>

<div class="form-group">
  <label>File</label>
  <input type="file" value="{{$transaksikoordinator->gambar}}" id ="img" name="files" class="form-control">
</div>
