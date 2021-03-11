
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
  <label>Nominal</label>
  <input type="text" name="nominal" value="{{$transaksikoordinator->nominal}}" class="form-control">
</div>

<div class="form-group">
  <label>Jenis Transaksi</label>
  <div class="col-sm-12">
    <select style="width:100%;" class="form-control" id="jenistransaksi" name="jenistransaksi">
        <option value="{{$transaksikoordinator->jenistransaksi}}">{{$transaksikoordinator->jenistransaksi}}</option>
        <option value="kredit">Kredit</option>
        <option value="debit">Debit</option>
    </select>
  </div>
</div>

<div class="form-group">
  <label>File</label>
  <input type="file" value="{{$transaksikoordinator->gambar}}" id ="img" name="files" class="form-control">
</div>
