<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{Pembayaran,User,Siswa,Kelas,SPP, History};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function siswa()
    {
        $trans = Pembayaran::join('siswa','siswa.nisn','=','pembayaran.nisn')
                            ->join('kelas','siswa.id_kelas','=','kelas.id')
                            ->join('spp','pembayaran.id_spp','=','spp.id')
                            ->join('users','users.id','=','pembayaran.id_petugas')
                            ->get();
        return view('home',compact('trans'));
    }

    public function petugas()
    {     
        return view('home');
    }
}
