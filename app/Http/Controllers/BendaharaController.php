<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksibendahara;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;
use App\pjk;
use App\Jenistransaksi;
use Illuminate\Support\Facades\DB;

class BendaharaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function dashboard()
    {
        $transaksibendahara = Transaksibendahara::get();
        $counttransaksi = count($transaksibendahara);
        $pjk = pjk::get();
        $countpjk = count($pjk);
        return view('transaksi.dashboard', [
            'jumlahtransaksi' => $counttransaksi,
            'saldo' => $this->getSaldo(),
            'jumlahpjk' => $countpjk
        ]);
    }
    public function index()
    {
        $transaksibendahara = Transaksibendahara::select(
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
            'datatransaksibendahara' => $transaksibendahara,
            'saldo' => $this->getSaldo(),
            'jenis' => $jenistransaksi
        ]);
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
            $transaksibendahara->jenistransaksi_id = $request->jenistransaksi;
            $transaksibendahara->user_id = auth()->user()->id;
            $transaksibendahara->gambar = $filename;
            $transaksibendahara->status = FALSE;
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
        $transaksibendahara = Transaksibendahara::select(
            'transaksibendaharas.id',
            'transaksibendaharas.tanggal',
            'transaksibendaharas.nominal',
            'transaksibendaharas.keterangan',
            'transaksibendaharas.status',
            'transaksibendaharas.gambar',
            'transaksibendaharas.jenistransaksi_id',
            'jenistransaksis.jenis as jenistransaksi'
        )
            ->join('jenistransaksis', 'jenistransaksis.id', '=', 'transaksibendaharas.jenistransaksi_id')
            ->where('transaksibendaharas.id', '=', "{$id}")
            ->first();
        $jenistransaksi = Jenistransaksi::get();
        return view('transaksi.editmodal', [
            'transaksibendahara' => $transaksibendahara,
            'jenis' => $jenistransaksi
        ]);
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
        $transaksibendahara->jenistransaksi_id = $request->jenistransaksi;
        $transaksibendahara->user_id = auth()->user()->id;
        $transaksibendahara->jenistransaksi_id = $request->jenistransaksi;
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
        return view('transaksi.detail', ['datatransaksibendahara' => $transaksibendahara]);
    }
    public function filter(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $filter = Transaksibendahara::select(
            'transaksibendaharas.id',
            'transaksibendaharas.tanggal',
            'transaksibendaharas.nominal',
            'transaksibendaharas.keterangan',
            'transaksibendaharas.status',
            'transaksibendaharas.gambar',
            'jenistransaksis.jenis as jenistransaksi'
        )
            ->join('jenistransaksis', 'jenistransaksis.id', '=', 'transaksibendaharas.jenistransaksi_id')
            ->where('transaksibendaharas.tanggal', '>=', $from)
            ->where('transaksibendaharas.tanggal', '<=', $to)
            ->get();
        $jenistransaksi = Jenistransaksi::get();
        return view('transaksi.home', [
            'datatransaksibendahara' => $filter,
            'saldo' => $this->getSaldo(),
            'jenis' => $jenistransaksi
        ]);
    }
    public function detail($id)
    {
        $transaksibendahara = Transaksibendahara::select(
            'transaksibendaharas.id',
            'transaksibendaharas.tanggal',
            'transaksibendaharas.nominal',
            'transaksibendaharas.keterangan',
            'transaksibendaharas.status',
            'transaksibendaharas.gambar',
            'jenistransaksis.jenis as jenistransaksi'
        )
            ->join('jenistransaksis', 'jenistransaksis.id', '=', 'transaksibendaharas.jenistransaksi_id')
            ->where('transaksibendaharas.id', '=', "{$id}")
            ->first();
        return view('transaksi.detail', ['datatransaksibendahara' => $transaksibendahara]);
    }
    public function pjk()
    {
        $pjk = pjk::get();
        return view('pjk.pjk', ['pjk' => $pjk]);
    }
    public function addpjk()
    {
        return view('pjk.addpjk');
    }
    public function insertpjk(Request $request)
    {
        //praktikum
        $pjk = new pjk();
        $pjk->judul = $request->judul;
        $pjk->tanggal = $request->tanggal;
        $pjk->lampiran = $request->lampiran;
        $pjk->praktikum = $request->praktikum;
        $pjk->periode = $request->periode;
        $pjk->lulus = $request->lulus;
        $pjk->tidaklulus = $request->tidaklulus;
        $pjk->gugur = $request->gugur;
        $pjk->jumlahpeserta = $request->jumlahpeserta;
        $pjk->jumlahkelas = $request->kelas;
        $pjk->jumlahpesertaperkelas = $request->perkelas;
        $pjk->jumlahmodul = $request->jumlahmodul;
        $pjk->lamapraktikum = $request->lamapraktikum;

        //biaya
        $pjk->sks = $request->sks;
        $pjk->sertifikat = $request->sertifikat;
        $pjk->operasional = $request->operasional;
        $pjk->koordinator = $request->koordinator;
        $pjk->administrator = $request->administrator;
        $pjk->kebersihan = $request->kebersihan;
        $pjk->bimbingan = $request->bimbingan;

        //kasbon
        $pjk->honorarium = $request->honorarium;
        $pjk->biayamodul = $request->biayamodul;
        $pjk->user_id = auth()->user()->id;
        $pjk->save();
        return redirect()->route('bendaharaPjk');
    }
    public function detailpjk($id)
    {
        $pjk = pjk::select()
            ->where('id', '=', "{$id}")
            ->first();
        return view('pjk.detailpjk', ['pjk' => $pjk]);
    }
    public function exportpjk(Request $request, $id)
    {
        $pjk = pjk::select()
            ->where('id', '=', "{$id}")
            ->first();
        $tanggal = Carbon::parse($pjk->tanggal)->isoFormat('D MMMM Y');
        $tanggal2 = Carbon::parse($pjk->tanggal)->isoFormat('D/M/Y');
        $tahun = Carbon::parse($pjk->tanggal)->isoFormat('Y');
        $danapraktikum = $pjk->sks + $pjk->sertifikat + $pjk->operasional + $pjk->koordinator + $pjk->administrator + $pjk->kebersihan + $pjk->bimbingan;
        $termin1 = $pjk->sertifikat + $pjk->operasional;
        $termin2 = $pjk->sks + $pjk->koordinator + $pjk->administrator + $pjk->kebersihan + $pjk->bimbingan;
        $dana = $pjk->honorarium + $pjk->biayamodul;
        $biayapendaftaran = $pjk->administrator + $pjk->jumlahpesertaperkelas;
        $presentasedana = ($danapraktikum / $biayapendaftaran) * 100;
        if ($request->input('action') == "cetakDoc") {
            $templateProcessor = new TemplateProcessor('pjk.docx');
            $templateProcessor->setValue('tanggal', $tanggal);
            $templateProcessor->setValue('tahun', $tahun);
            $templateProcessor->setValue('praktikum', $pjk->praktikum);
            $templateProcessor->setValue('periode', $pjk->periode);
            $templateProcessor->setValue('lulus', $pjk->lulus);
            $templateProcessor->setValue('tidaklulus', $pjk->tidaklulus);
            $templateProcessor->setValue('gugur', $pjk->gugur);
            //Biaya Praktikum
            $templateProcessor->setValue('jumlahpeserta', $pjk->jumlahpeserta);
            $templateProcessor->setValue('perkelas', $pjk->jumlahpesertaperkelas);
            $templateProcessor->setValue('jumlahmodul', $pjk->jumlahmodul);
            $templateProcessor->setValue('lamapraktikum', $pjk->lamapraktikum);
            $templateProcessor->setValue('sks', number_format($pjk->sks));
            $templateProcessor->setValue('sertifikat', number_format($pjk->sertifikat));
            $templateProcessor->setValue('operasional', number_format($pjk->operasional));
            $templateProcessor->setValue('koordinator', number_format($pjk->koordinator));
            $templateProcessor->setValue('administrator', number_format($pjk->administrator));
            $templateProcessor->setValue('kebersihan', number_format($pjk->kebersihan));
            $templateProcessor->setValue('bimbingan', number_format($pjk->bimbingan));
            $templateProcessor->setValue('danapraktikum', number_format($danapraktikum));
            $templateProcessor->setValue('termin1', number_format($termin1));
            $templateProcessor->setValue('termin2', number_format($termin2));
            $templateProcessor->setValue('biayapendaftaran', number_format($biayapendaftaran));
            $templateProcessor->setValue('sen', $presentasedana);
            //kasbom
            $templateProcessor->setValue('honorarium', number_format($pjk->honorarium));
            $templateProcessor->setValue('biayamodul', number_format($pjk->biayamodul));
            $templateProcessor->setValue('dana', number_format($dana));
            $fileName = "DataPJK";
            $templateProcessor->saveAs($fileName . '.docx');
            return response()->download($fileName . '.docx')->deleteFileAfterSend(true);
        } else if ($request->input('action') == "cetakExcel") {
            $reader = IOFactory::createReader('Xls');
            $sheet = $reader->load('pjkexcel.xls');
            //kasbon
            $sheet->getSheetByName('Kasbon')->setCellValue('c2', '/LJK/ITATS/II/' . $tahun);
            $sheet->getSheetByName('Kasbon')->setCellValue('f16', $pjk->honorarium);
            $sheet->getSheetByName('Kasbon')->setCellValue('f17', $pjk->biayamodul);
            $sheet->getSheetByName('Kasbon')->setCellValue('b16', $tanggal2);
            $sheet->getSheetByName('Kasbon')->setCellValue('e16', 'Honorarium Pelaksanaan Praktikum ' . $pjk->praktikum . ' Periode ' . $pjk->periode . ' T.A ' . $tahun);
            $sheet->getSheetByName('Kasbon')->setCellValue('e17', 'Penjilidan Soft Cover Modul ' . $pjk->praktikum);
            //rincian
            $sheet->getSheetByName('rincian')->setCellValue('e2', $pjk->operasional);
            $sheet->getSheetByName('rincian')->setCellValue('e4', $pjk->koordinator);
            $sheet->getSheetByName('rincian')->setCellValue('e5', $pjk->administrator);
            $sheet->getSheetByName('rincian')->setCellValue('e6', 0);
            $sheet->getSheetByName('rincian')->setCellValue('e7', $pjk->kebersihan);
            for ($i = 1; $i <= 7; $i++) {
                $sheet->getSheetByName('rincian')->setCellValue('g' . $i, $pjk->jumlahpeserta);
            }
            $sheet->getSheetByName('rincian')->setCellValue('j8', $pjk->bimbingan);
            $sheet->getSheetByName('rincian')->setCellValue('j9', $pjk->sertifikat);

            //termin1+2
            $sheet->getSheetByName('Termin I+II')->setCellValue('e6', $pjk->sks);
            $sheet->getSheetByName('Termin I+II')->setCellValue('g6', $pjk->jumlahkelas);

            $writer = new Xls($sheet);
            $writer->save("DataPJK.xls");
            return response()->download('DataPJK.xls')->deleteFileAfterSend(true);
        }
    }
    public function editpjk($id)
    {
        $pjk = pjk::select()
            ->where('id', '=', "{$id}")
            ->first();
        return view('pjk.editpjk', ['pjk' => $pjk]);
    }
    public function updatepjk(Request $request, $id)
    {
        $pjk = pjk::find($id);
        $pjk->judul = $request->judul;
        $pjk->tanggal = $request->tanggal;
        $pjk->lampiran = $request->lampiran;
        $pjk->praktikum = $request->praktikum;
        $pjk->periode = $request->periode;
        $pjk->lulus = $request->lulus;
        $pjk->tidaklulus = $request->tidaklulus;
        $pjk->gugur = $request->gugur;
        $pjk->jumlahpeserta = $request->jumlahpeserta;
        $pjk->jumlahkelas = $request->kelas;
        $pjk->jumlahpesertaperkelas = $request->perkelas;
        $pjk->jumlahmodul = $request->jumlahmodul;
        $pjk->lamapraktikum = $request->lamapraktikum;

        //biaya
        $pjk->sks = $request->sks;
        $pjk->sertifikat = $request->sertifikat;
        $pjk->operasional = $request->operasional;
        $pjk->koordinator = $request->koordinator;
        $pjk->administrator = $request->administrator;
        $pjk->kebersihan = $request->kebersihan;
        $pjk->bimbingan = $request->bimbingan;

        //kasbon
        $pjk->honorarium = $request->honorarium;
        $pjk->biayamodul = $request->biayamodul;
        $pjk->user_id = auth()->user()->id;
        $pjk->save();
        return redirect()->route('bendaharaPjk');
    }
    public function destroypjk($id)
    {
        pjk::destroy($id);
        return redirect()->route('bendaharaPjk');
    }
}
