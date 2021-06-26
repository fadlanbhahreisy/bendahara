<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksibendahara;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\Table;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Carbon\Carbon;
use function GuzzleHttp\Promise\all;
use App\pjk;
use App\Jenistransaksi;
use App\User;
use App\honor;
use Illuminate\Support\Facades\Validator;
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
            ->where(['jenistransaksi_id' => '1', 'status' => TRUE])
            ->sum('nominal');
        $debit = Transaksibendahara::select()
            ->where(['jenistransaksi_id' => '2', 'status' => TRUE])
            ->sum('nominal');
        $saldo = $debit - $kredit;
        return $saldo;
    }

    public function dashboard()
    {
        $transaksibendahara = Transaksibendahara::select()
            ->where(['status' => TRUE])
            ->get();
        $counttransaksi = count($transaksibendahara);
        $pjk = pjk::get();
        $countpjk = count($pjk);
        $user = User::get();
        $countuser = count($user);
        return view('transaksi.dashboard', [
            'jumlahtransaksi' => $counttransaksi,
            'saldo' => $this->getSaldo(),
            'jumlahpjk' => $countpjk,
            'jumlahuser' => $countuser
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
        $request->validate([
            'keterangan' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'jenistransaksi' => 'required'
        ]);
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
        return redirect()->route('bendaharaHome')->with('message', 'Data Berhasil Disimpan');
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
        $request->validate([
            'keterangan' => 'required',
            'tanggal' => 'required',
            'nominal' => 'required',
            'jenistransaksi' => 'required'
        ]);
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
        return redirect()->route('bendaharaHome')->with('message', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Transaksibendahara::destroy($id);
        // return redirect()->route('bendaharaHome');

        $transaksi = Transaksibendahara::find($id);

        $image_path = public_path('uploads/' . $transaksi->gambar);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $transaksi->delete();
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
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required',
            'lampiran' => 'required',
            'praktikum' => 'required',
            'periode' => 'required',
            'lulus' => 'required',
            'tidaklulus' => 'required',
            'gugur' => 'required',
            'jumlahpeserta' => 'required',
            'kelas' => 'required',
            'perkelas' => 'required',
            'jumlahmodul' => 'required',
            'lamapraktikum' => 'required',
            'sks' => 'required',
            'sertifikat' => 'required',
            'operasional' => 'required',
            'koordinator' => 'required',
            'administrator' => 'required',
            'kebersihan' => 'required',
            'bimbingan' => 'required',
            'honorarium' => 'required',
            'biayamodul' => 'required',
        ]);
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
        return redirect()->route('bendaharaPjk')->with('message', 'Data PJK Berhasil Ditambahkan');
    }
    public function detailpjk($id)
    {
        $pjk = pjk::select()
            ->where('id', '=', "{$id}")
            ->first();
        $honor = honor::select()
            ->where('pjk_id', '=', "{$id}")->get();
        return view('pjk.detailpjk', ['pjk' => $pjk, 'honor' => $honor]);
    }
    public function exportpjk(Request $request, $id)
    {
        $pjk = pjk::select()
            ->where('id', '=', "{$id}")
            ->first();
        $honor = honor::select()
            ->where('pjk_id', '=', "{$id}")->get();
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

            $table = new Table(array('borderSize' => 12, 'borderColor' => 'black', 'width' => 10000,));
            $table->addRow();
            $table->addCell(150)->addText('NO');
            $table->addCell(150)->addText('Nama');
            $table->addCell(150)->addText('Status');
            $table->addCell(150)->addText('SKS');
            $table->addCell(150)->addText('Biaya Khusus');
            $table->addCell(150)->addText('HDR');
            $table->addCell(150)->addText('Jumlah bimb');
            $table->addCell(150)->addText('Hr bimb');
            $table->addCell(150)->addText('Total');
            $table->addRow();
            $table->addCell(150)->addText('1');
            $table->addCell(150)->addText('2');
            $table->addCell(150)->addText('3');
            $table->addCell(150)->addText('4');
            $table->addCell(150)->addText('5');
            $table->addCell(150)->addText('6');
            $table->addCell(150)->addText('7');
            $table->addCell(150)->addText('8');
            $table->addCell(150)->addText('9=4+5+8');
            foreach ($honor as $no => $row) {
                $table->addRow();
                $table->addCell(150)->addText($no + 1);
                $table->addCell(150)->addText($row->nama);
                $table->addCell(150)->addText($row->status);
                $table->addCell(150)->addText($row->sks);
                $table->addCell(150)->addText($row->biayakhusus);
                $table->addCell(150)->addText($row->hdr);
                $table->addCell(150)->addText($row->jumlahbimb);
                $table->addCell(150)->addText($row->hrbimb);
                $table->addCell(150)->addText($row->total);
            }
            $templateProcessor->setComplexBlock('table', $table);
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

            $x = 6;
            foreach ($honor as $row) {
                $sheet->getSheetByName('CEK HONORIUM')->setCellValue('c' . $x, $row->status);
                $sheet->getSheetByName('CEK HONORIUM')->setCellValue('d' . $x, $row->honorpraktikum);
                $x = $x + 1;
            }
            $y = 5;
            foreach ($honor as $no => $row) {
                $sheet->getSheetByName('Honorarium')->setCellValue('a' . $y, $no + 1);
                $sheet->getSheetByName('Honorarium')->setCellValue('b' . $y, $row->nama);
                $sheet->getSheetByName('Honorarium')->setCellValue('c' . $y, $row->status);
                $sheet->getSheetByName('Honorarium')->setCellValue('d' . $y, $row->sks);
                $sheet->getSheetByName('Honorarium')->setCellValue('e' . $y, $row->biayakhusus);
                $sheet->getSheetByName('Honorarium')->setCellValue('f' . $y, $row->hdr);
                $sheet->getSheetByName('Honorarium')->setCellValue('g' . $y, $row->jumlahbimb);
                $sheet->getSheetByName('Honorarium')->setCellValue('h' . $y, $row->hrbimb);
                $sheet->getSheetByName('Honorarium')->setCellValue('i' . $y, $row->total);
                $y = $y + 1;
            }
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
        $request->validate([
            'judul' => 'required',
            'tanggal' => 'required',
            'lampiran' => 'required',
            'praktikum' => 'required',
            'periode' => 'required',
            'lulus' => 'required',
            'tidaklulus' => 'required',
            'gugur' => 'required',
            'jumlahpeserta' => 'required',
            'kelas' => 'required',
            'perkelas' => 'required',
            'jumlahmodul' => 'required',
            'lamapraktikum' => 'required',
            'sks' => 'required',
            'sertifikat' => 'required',
            'operasional' => 'required',
            'koordinator' => 'required',
            'administrator' => 'required',
            'kebersihan' => 'required',
            'bimbingan' => 'required',
            'honorarium' => 'required',
            'biayamodul' => 'required',
        ]);
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
        return redirect()->route('bendaharaPjk')->with('message', 'Berhasil Update PJK');
    }
    public function destroypjk($id)
    {
        pjk::destroy($id);
        return redirect()->route('bendaharaPjk');
    }
    public function honor()
    {
        $pjk = pjk::get();
        $honor = honor::select(
            'honors.id',
            'honors.nama',
            'honors.status',
            'honors.sks',
            'honors.biayakhusus',
            'honors.hdr',
            'honors.jumlahbimb',
            'honors.hrbimb',
            'honors.total',
            'honors.honorpraktikum',
            'pjks.judul'
        )->join('pjks', 'pjks.id', '=', 'honors.pjk_id')->get();
        return view('pjk.honor', ['pjk' => $pjk, 'honor' => $honor]);
    }
    function simpanhonor(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'total' => 'required',
            'honorpraktikum' => 'required'
        ]);
        // dd($request->all());
        $pjk = pjk::find($request->pjk);
        $honor = new honor();
        $honor->nama = $request->nama;
        $honor->status = $request->status;
        $honor->sks = $request->sks;
        $honor->biayakhusus = $request->biayakhusus;
        $honor->hdr = $request->hdr;
        $honor->jumlahbimb = $request->jumlahbimb;
        $honor->hrbimb = $request->hrbimb;
        $honor->total = $request->total;
        $honor->honorpraktikum = $request->honorpraktikum;
        $pjk->honors()->save($honor);
        return redirect()->route('honor')->with('message', 'Data Berhasil Disimpan');
    }
    function edithonor($id)
    {
        $pjk = pjk::get();
        $honor = honor::select(
            'honors.id',
            'honors.nama',
            'honors.status',
            'honors.sks',
            'honors.biayakhusus',
            'honors.hdr',
            'honors.jumlahbimb',
            'honors.hrbimb',
            'honors.total',
            'honors.pjk_id',
            'honors.honorpraktikum',
            'pjks.judul'
        )->join('pjks', 'pjks.id', '=', 'honors.pjk_id')
            ->where('honors.id', '=', "{$id}")
            ->first();

        return view('pjk.edithonor', ['pjk' => $pjk, 'honor' => $honor]);
    }
    function updatehonor(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required',
            'total' => 'required',
            'honor' => 'required'
        ]);
        $honor = honor::find($request->id);
        $honor->nama = $request->nama;
        $honor->status = $request->status;
        $honor->sks = $request->sks;
        $honor->biayakhusus = $request->biayakhusus;
        $honor->hdr = $request->hdr;
        $honor->jumlahbimb = $request->jumlahbimb;
        $honor->hrbimb = $request->hrbimb;
        $honor->total = $request->total;
        $honor->pjk_id = $request->pjk;
        $honor->honorpraktikum = $request->honorpraktikum;
        $honor->save();
        return redirect()->route('honor')->with('message', 'Data Berhasil Diupdate');
    }
    function deletehonor($id)
    {
        honor::destroy($id);
        return redirect()->route('honor');
    }
}
