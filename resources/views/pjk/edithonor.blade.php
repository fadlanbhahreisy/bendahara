        <div class="form-group">
            <input type="hidden" value="{{$honor->id}}" name="id" id="id_honor" class="form-control" >
        </div>

        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="{{$honor->nama}}" class="form-control">
        </div>

        <div class="form-group">
            <label>PJK</label>
            <select style="width:100%;" class="form-control" id="pjk" name="pjk">
                {{-- <option value="-">- Select -</option> --}}
                @foreach ($pjk as $row)
                <option value="{{$row->id}}" {{ $row->id == $honor->pjk_id ? 'selected' : ""}}>{{$row->judul}}</option>
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
            <input type="text" value="{{$honor->sks}}" name="sks" class="form-control">
        </div>

        <div class="form-group">
            <label>Biaya Khusus</label>
            <input type="text" value="{{$honor->biayakhusus}}" name="biayakhusus" class="form-control">
        </div>

        <div class="form-group">
            <label>HDR</label>
            <input type="text" value="{{$honor->hdr}}" name="hdr" class="form-control">
        </div>

        <div class="form-group">
            <label>Jumlah Bimbingan</label>
            <input type="text" value="{{$honor->jumlahbimb}}" name="jumlahbimb" class="form-control">
        </div>

        <div class="form-group">
            <label>Hr bimbingan</label>
            <input type="text" value="{{$honor->hrbimb}}" name="hrbimb" class="form-control">
        </div>

        <div class="form-group">
            <label>Total</label>
            <input type="text" value="{{$honor->total}}" name="total" class="form-control">
        </div>

        <div class="form-group">
            <label>Honor Praktikum</label>
            <input type="text" value="{{$honor->honorpraktikum}}" name="total" class="form-control">
        </div>