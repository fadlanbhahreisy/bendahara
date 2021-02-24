<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;

class CrudController extends Controller
{
    public function index()
    {
        $data_transaksi = DB::table('transaksi')->paginate(1);
        return view('admin.index', ['data_transaksi' => $data_transaksi]);
    }
    public function tambah()
    {
        return view('crud.tambah');
    }
    public function simpan(Request $request)
    {
        $keterangan = $request->keterangan;
        $tanggal = $request->tanggal;

        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $ekstensi = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ekstensi;
            $file->move('uploads', $filename);
            echo $filename;
            DB::insert('insert into transaksi (keterangan, tanggal,file) values (?, ?,?)', [$keterangan, $tanggal, $filename]);
        } else {
            echo "file belum ada";
        }
        return redirect()->route('crud');
    }
}
