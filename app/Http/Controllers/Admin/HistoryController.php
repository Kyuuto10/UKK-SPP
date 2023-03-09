<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Pembayaran,User,Siswa,Kelas,SPP, History};
use App\Exports\PembayaranExport;
use Illuminate\Http\Request;
use Excel;

class HistoryController extends Controller
{
    public function index() 
    {
        $view = History::all();
        $trans = Pembayaran::join('siswa','pembayaran.nisn','=','siswa.nisn')
                            ->join('kelas','siswa.id_kelas','=','kelas.id')
                            ->join('spp','pembayaran.id_spp','=','spp.id')
                            ->join('users','pembayaran.id_petugas','=','users.id')
                            ->get();
        $spps = SPP::all();
        $users = User::all();
        $siswa = Siswa::all();        

        return view('admin.history.index',compact('view','trans','spps','users','siswa'));
    }

    public function export()
    {
        return Excel::download(new PembayaranExport, 'Transactions.pdf');
    }

    public function show()
    {

    }
}
