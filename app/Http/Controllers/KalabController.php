<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksibendahara;
use App\Jenistransaksi;

class KalabController extends Controller
{
    public function getSaldo()
    {
        $transaksibendahara = Transaksibendahara::get();
        $kredit = Transaksibendahara::select()
            ->where('jenistransaksi_id', '=', "1")
            ->sum('nominal');
        $debit = Transaksibendahara::select()
            ->where('jenistransaksi_id', '=', "2")
            ->sum('nominal');
        $saldo = $debit - $kredit;
        return $saldo;
    }
    public function verif($id)
    {

        $transaksibendahara = Transaksibendahara::find($id);
        $transaksibendahara->status = TRUE;
        $transaksibendahara->save();
        $transaksi = Transaksibendahara::select(
            'transaksibendaharas.id',
            'transaksibendaharas.tanggal',
            'transaksibendaharas.nominal',
            'transaksibendaharas.keterangan',
            'transaksibendaharas.status',
            'transaksibendaharas.gambar',
            'jenistransaksis.jenis as jenistransaksi'
        )
            ->join('jenistransaksis', 'jenistransaksis.id', '=', 'transaksibendaharas.jenistransaksi_id')->get();
        $jenistransaksi = Jenistransaksi::get();
        return view('transaksi.home', [
            'datatransaksibendahara' => $transaksi,
            'saldo' => $this->getSaldo(),
            'jenis' => $jenistransaksi
        ]);
    }
    public function unverif($id)
    {

        $transaksibendahara = Transaksibendahara::find($id);
        $transaksibendahara->status = false;
        $transaksibendahara->save();
        $transaksi = Transaksibendahara::select(
            'transaksibendaharas.id',
            'transaksibendaharas.tanggal',
            'transaksibendaharas.nominal',
            'transaksibendaharas.keterangan',
            'transaksibendaharas.status',
            'transaksibendaharas.gambar',
            'jenistransaksis.jenis as jenistransaksi'
        )
            ->join('jenistransaksis', 'jenistransaksis.id', '=', 'transaksibendaharas.jenistransaksi_id')->get();
        $jenistransaksi = Jenistransaksi::get();
        return view('transaksi.home', [
            'datatransaksibendahara' => $transaksi,
            'saldo' => $this->getSaldo(),
            'jenis' => $jenistransaksi
        ]);
    }
}
