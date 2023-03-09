<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Pembayaran,Siswa,SPP,User,History,Kelas};
use Carbon\Carbon;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::join('siswa','pembayaran.nisn','=','siswa.nisn')
                                ->join('spp','pembayaran.id_spp','=','spp.id')
                                ->join('users','pembayaran.id_petugas','=','users.id')
                                ->get();
        $siswa = Siswa::all();
        $spps = SPP::all();
        $users = User::all();

        return view('admin.pembayaran.index',compact('pembayaran','siswa','spps','users'));
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

    public function getData($nisn, $berapa)
    {        
        $siswa = Siswa::where('nisn','=', $nisn)->first();
        $kelas = Kelas::where('id','=', $siswa->id_kelas)->first();
        $spp = SPP::where('id',$siswa->id_spp)
                    ->first();

        $trans = Pembayaran::where('nisn','=', $nisn)
                            ->orderBy('id','DESC')
                            ->latest()
                            ->first();        
        if($trans == null){
                $data = [
                    'nama' => $siswa->nama,
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => 'Belum pernah bayar',
                    'tahun' => '',
                    'nama' => $siswa->nama,
                    'nis' => $siswa->nis,
                    'id_kelas' => $kelas->nama_kelas,
                    'alamat' => $siswa->alamat,
                    'no_telp' => $siswa->no_telp,
                ];
        }else{
            if($trans->tahun_dibayar == substr($spp->tahun, -4, 4) && $trans->bulan_dibayar == 'juni'){
                $data = [
                    'nama' => $siswa->nama,
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => 'sudah lunas',
                    'tahun' => '',                    
                    'nis' => $siswa->nis,
                    'id_kelas' => $kelas->nama_kelas,
                    'alamat' => $siswa->alamat,
                    'no_telp' => $siswa->no_telp,
                ];
            }else{
                $data = [
                    'nama' => $siswa->nama,
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => $trans->bulan_dibayar .', '. $trans->tahun_dibayar,
                    'tahun' => $trans->tahun_dibayar,
                    'nama' => $siswa->nama,
                    'nis' => $siswa->nis,
                    'id_kelas' => $kelas->nama_kelas,
                    'alamat' => $siswa->alamat,
                    'no_telp' => $siswa->no_telp,
                ];
            }
        }

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn' => 'required|numeric',
            'jumlah_bayar' => 'required|numeric',
        ]);
        
        // dd($request->bayar_berapa);
        for($i =0; $i < $request->bayar_berapa; $i++){
            $bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        // dd($request->all());
            $siswa = Siswa::where('nisn','=', $request->nisn)->first();
            $spp = SPP::where('id',$siswa->id_spp)->first();
            $trans = Pembayaran::where('nisn','=',$siswa->nisn)->get();
            
            if($trans->isEmpty()){
                $bln = 6;
                $tahun = substr($spp->tahun, 0, 4);
            }else{
                $trans = Pembayaran::where('nisn','=',$siswa->nisn)
                                    ->orderBy('id','DESC')
                                    ->latest()
                                    ->first();                
                
                $bln = array_search($trans->bulan_dibayar, $bulan);
                
                if($bln == 11){
                    $bln = 0;
                    $tahun = $trans->tahun_dibayar + 1;
                } else {
                    $bln = $bln + 1;
                    $tahun = $trans->tahun_dibayar;
                }
                
                if($trans->tahun_dibayar == substr($spp->tahun, -4, 4) && $trans->bulan_dibayar == 'Juni'){                    
                    return redirect()->route('pembayaran.index')->with('error','SPP Sudah Lunas');
                }
            }

                // dd($pembayaranSimpan);
                $pembayaranSimpan = Pembayaran::create([
                    'id_petugas' => auth()->user()->id,
                    'nisn' => $request->nisn,
                    'tgl_bayar' => Carbon::now()->timezone('asia/jakarta'),
                    'bulan_dibayar' => $bulan[$bln],
                    'tahun_dibayar' => $tahun,
                    'id_spp' => $spp->id,
                    'jumlah_bayar' => $spp->nominal
                ]);

                History::create([
                    'id_petugas' => auth()->user()->id,
                    'nisn' => $request->nisn,                    
                    'nama' => $siswa->nama,
                    'id_kelas' => $siswa->id_kelas,
                    'alamat' => $siswa->alamat,
                    'no_telp' => $siswa->no_telp,
                    'tgl_bayar' =>  Carbon::now()->timezone('asia/jakarta'),
                    'bulan_dibayar' => $bulan[$bln],
                    'tahun_dibayar' => $tahun,
                    'id_spp' => $spp->id,
                    'jumlah_bayar' => $spp->nominal
                ]);

                $bln++;
            }
            if($pembayaranSimpan) {
                toast('Data berhasil masuk','success');
                return redirect()->route('pembayaran.index');
            } else{
                toast('Data gagal masuk','error');
                return redirect()->route('pembayaran.index');
            }
    }

    public function history()
    {
        $siswa = Siswa::where('nis',auth()->user()->username)->first();
        $kelas = Kelas::where('id',$siswa->id_kelas)->first();
        $siswa = Siswa::where('nisn',$siswa->nisn)->first();
        $spp = SPP::where('id',$siswa->id_spp)->first();
        $pembayaran = Pembayaran::join('siswa','pembayaran.nisn','=','siswa.nisn')
                                ->join('kelas','siswa.id_kelas','=','kelas.id')
                                ->join('spp','pembayaran.id_spp','=','spp.id')
                                ->join('users','users.id','=','pembayaran.id_spp')
                                ->get();
        return view('home',compact('siswa','kelas','spp','pembayaran'));
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
        //
    }
}
