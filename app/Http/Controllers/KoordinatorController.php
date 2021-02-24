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
        return view('koordinator.home', ['datatransaksikoordinator' => $transaksikoordinator]);
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
            $transaksikoordinator->debit = $request->debit;
            $transaksikoordinator->kredit = $request->kredit;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
