<?php


use Illuminate\Database\Seeder;
use App\User;
use App\role;
use App\Jenistransaksi;
use App\Transaksibendahara;
use App\pjk;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = new role();
        $role->role = "admin";
        $role->save();

        $role = new role();
        $role->role = "bendahara";
        $role->save();

        $role = new role();
        $role->role = "koordinator";
        $role->save();

        $role = new role();
        $role->role = "kalab";
        $role->save();

        $roles = role::find(1);
        $user = new User;
        $user->name = "admin";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make("admin");
        $roles->users()->save($user);

        $roles = role::find(2);
        $user = new User;
        $user->name = "bendahara";
        $user->email = "bendahara@gmail.com";
        $user->password = Hash::make("bendahara");
        $roles->users()->save($user);

        $roles = role::find(3);
        $user = new User;
        $user->name = "koor";
        $user->email = "koor@gmail.com";
        $user->password = Hash::make("koor");
        $roles->users()->save($user);

        $roles = role::find(4);
        $user = new User;
        $user->name = "kalab";
        $user->email = "kalab@gmail.com";
        $user->password = Hash::make("kalab");
        $roles->users()->save($user);

        $jenistransaksi = new Jenistransaksi();
        $jenistransaksi->jenis = "kredit";
        $jenistransaksi->save();

        $jenistransaksi = new Jenistransaksi();
        $jenistransaksi->jenis = "debit";
        $jenistransaksi->save();


        $transaksibendahara = new Transaksibendahara();
        $transaksibendahara->tanggal = "2021-06-02";
        $transaksibendahara->keterangan = "keterangan";
        $transaksibendahara->nominal = 20000;
        $transaksibendahara->gambar = null;
        $transaksibendahara->status = false;
        $transaksibendahara->jenistransaksi_id = 2;
        $transaksibendahara->user_id = 2;
        $transaksibendahara->save();

        $user = User::find(2);
        $pjk = new pjk();
        $pjk->judul = "Praktikum PBO 2021";
        $pjk->tanggal = "2021-06-02";
        $pjk->lampiran = 4;
        $pjk->praktikum = "Pemrograman Berorientasi Objek";
        $pjk->periode = "V";
        $pjk->lulus = 92;
        $pjk->tidaklulus = 1;
        $pjk->gugur = 24;
        $pjk->jumlahpeserta = 116;
        $pjk->jumlahkelas = 5;
        $pjk->jumlahpesertaperkelas = 29;
        $pjk->jumlahmodul = 4;
        $pjk->lamapraktikum = 5;

        //biaya
        $pjk->sks = 10000;
        $pjk->sertifikat = 2000;
        $pjk->operasional = 1225000;
        $pjk->koordinator = 70000;
        $pjk->administrator = 80000;
        $pjk->kebersihan = 25000;
        $pjk->bimbingan = 33500;

        //kasbon
        $pjk->honorarium = 3120500;
        $pjk->biayamodul = 2447500;
        $user->pjks()->save($pjk);
    }
}
