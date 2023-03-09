<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Petugas,User};
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::all();

        return view('admin.petugas.index',compact('petugas'));
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
            'name' =>  'required',
            'username' =>  'required|unique:petugas,username',
            'password' =>  'required|min:8',
            'type' =>  'required',
        ]);

       $p = Petugas::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'type' => $request->type
        ]);

        User::create([
            'id_petugas' => $p->id,
            'name' => $request->name,
            'username' =>  $request->username,
            'password' => Hash::make($request->password),
            'type' => $request->type
        ]);

        toast('Berhasil Tambah Data','success');
        return redirect()->route('petugas.index');
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
        $request->validate([
            'name' =>  'required',
            'username' =>  'required|unique:petugas,username',
            'password' =>  'required|min:8',
            'type' =>  'required',
        ]);

       $p = Petugas::where('id',$id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'password' => $request->password,
            'type' => $request->type
        ]);

        User::where('id',$id)->update([        
            'name' => $request->name,
            'username' =>  $request->username,
            'password' => Hash::make($request->password),
            'type' => $request->type
        ]);
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
