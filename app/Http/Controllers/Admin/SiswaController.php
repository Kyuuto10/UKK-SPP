<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Siswa,SPP,Kelas,User};
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::join('kelas','siswa.id_kelas','=','kelas.id')
                        ->join('spp','siswa.id_spp','=','spp.id')
                        ->get();
        $spps = SPP::all();
        $kelas = Kelas::all();

        return view('admin.siswa.index',compact('siswas','spps','kelas'));
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
        $request->validate([
            'nisn' => 'required|max:10|unique:siswa,nisn',
            'nis' => 'required|max:8',
            'nama' => 'required|match:/[a-zA-Z]*/',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|max:13',
            'id_spp' => 'required',
        ]);

       $siswa = Siswa::create([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_spp' => $request->id_spp
        ]);

        User::create([
            'name' => $request->nama,
            'username' => $request->nis,
            'password' => Hash::make($request->nis),
            'type' => 0,
        ]);

        toast('Berhasil tambah data','success');
        return redirect()->route('siswa.index');
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
    public function update(Request $request, $nisn)
    {
        $request->validate([
            'nisn' => 'required|unique:siswa,nisn',
            'nis' => 'required',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required',
        ]);

        Siswa::where('nisn',$nisn)->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'id_spp' => $request->id_spp
        ]);

        toast('Berhasil Update','success');
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($nisn)
    {
        Siswa::where('nisn',$nisn)->delete();

        toast('Berhasil Hapus','success');
        return redirect()->route('siswa.index');
    }
}
