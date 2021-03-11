<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksibendahara;

class BendaharaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksibendahara = Transaksibendahara::get();
        $kredit = Transaksibendahara::select()
            ->where('jenistransaksi', '=', "kredit")
            ->sum('nominal');
        $debit = Transaksibendahara::select()
            ->where('jenistransaksi', '=', "debit")
            ->sum('nominal');
        $saldo = $debit - $kredit;
        if (auth()->user()->role == 'bendahara') {
            return view('bendahara.home', [
                'datatransaksibendahara' => $transaksibendahara,
                'saldo' => $saldo
            ]);
        } else if (auth()->user()->role == 'koordinator') {
            return view('koordinator.reportbendahara', [
                'datatransaksibendahara' => $transaksibendahara,
                'saldo' => $saldo
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $transaksibendahara = new Transaksibendahara();
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $ekstensi = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ekstensi;
            $file->move('uploads', $filename);
            echo $filename;
            $transaksibendahara->keterangan = $request->keterangan;
            $transaksibendahara->tanggal = $request->tanggal;
            $transaksibendahara->nominal = $request->nominal;
            $transaksibendahara->jenistransaksi = $request->jenistransaksi;
            $transaksibendahara->gambar = $filename;
            $transaksibendahara->save();
        } else {
            echo "file belum ada";
        }
        return redirect()->route('bendaharaHome');
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
        $transaksibendahara = Transaksibendahara::find($id);
        return view('bendahara.editmodal', ['transaksibendahara' => $transaksibendahara]);
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
        // dd($request->all());
        $transaksibendahara = Transaksibendahara::find($request->id);
        $transaksibendahara->keterangan = $request->keterangan;
        $transaksibendahara->tanggal = $request->tanggal;
        $transaksibendahara->nominal = $request->nominal;
        $transaksibendahara->jenistransaksi = $request->jenistransaksi;
        if ($request->hasFile('files')) {
            $file = $request->file('files');
            $ekstensi = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ekstensi;
            $file->move('uploads', $filename);
            $transaksibendahara->gambar = $filename;
        }
        $transaksibendahara->save();
        return redirect()->route('bendaharaHome');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaksibendahara::destroy($id);
        return redirect()->route('bendaharaHome');
    }

    public function search(Request $request)
    {
        $transaksibendahara = Transaksibendahara::select()
            ->where('keterangan', '=', "{$request->ket}")
            ->first();
        return view('bendahara.detail', ['datatransaksibendahara' => $transaksibendahara]);
    }
    public function detail($id)
    {
        $transaksibendahara = Transaksibendahara::select()
            ->where('id', '=', "{$id}")
            ->first();
        return view('bendahara.detail', ['datatransaksibendahara' => $transaksibendahara]);
    }
    public function pjk()
    {
        return view('bendahara.pjk');
    }
}
