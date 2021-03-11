<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksikoordinator;

class KoordinatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksikoordinator = Transaksikoordinator::get();
        $kredit = Transaksikoordinator::select()
            ->where('jenistransaksi', '=', "kredit")
            ->sum('nominal');
        $debit = Transaksikoordinator::select()
            ->where('jenistransaksi', '=', "debit")
            ->sum('nominal');
        $saldo = $debit - $kredit;
        return view('koordinator.home', [
            'datatransaksikoordinator' => $transaksikoordinator,
            'saldo' => $saldo
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transaksikoordinator = new Transaksikoordinator();
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $ekstensi = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ekstensi;
            $file->move('uploads', $filename);
            echo $filename;
            $transaksikoordinator->keterangan = $request->keterangan;
            $transaksikoordinator->tanggal = $request->tanggal;
            $transaksikoordinator->nominal = $request->nominal;
            $transaksikoordinator->jenistransaksi = $request->jenistransaksi;
            $transaksikoordinator->gambar = $filename;
            $transaksikoordinator->save();
        } else {
            echo "file belum ada";
        }
        return redirect()->route('koordinatorHome');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transaksikoordinator = Transaksikoordinator::find($id);
        return view('koordinator.editmodal', ['transaksikoordinator' => $transaksikoordinator]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $transaksikoordinator = Transaksikoordinator::find($request->id);
        $transaksikoordinator->keterangan = $request->keterangan;
        $transaksikoordinator->tanggal = $request->tanggal;
        $transaksikoordinator->nominal = $request->nominal;
        $transaksikoordinator->jenistransaksi = $request->jenistransaksi;
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $ekstensi = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ekstensi;
            $file->move('uploads', $filename);
            $transaksikoordinator->gambar = $filename;
        }
        $transaksikoordinator->save();
        return redirect()->route('koordinatorHome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksikoordinator::destroy($id);
        return redirect()->route('koordinatorHome');
    }
    function detail($id)
    {
        $transaksikoordinator = Transaksikoordinator::select()
            ->where('id', '=', "{$id}")
            ->first();
        return view('koordinator.detail', ['datatransaksikoordinator' => $transaksikoordinator]);
    }
}
