<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SPP;
use Illuminate\Http\Request;

class SPPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spps = SPP::all();

        return view('admin.spp.index',compact('spps'));
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
            'tahun' => 'required',
            'nominal' => 'required',
        ]);

        $next = $request->tahun + 2;

        SPP::create([
            'tahun' => $request->tahun . $next,
            'nominal' => $request->nominal
        ]);

        toast('Berhasil tambah data','success');
        return redirect()->route('spp.index');
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
            'tahun' => 'required',
            'nominal' => 'required',
        ]);

        $next = $request->tahun + 2;

        SPP::where('id',$id)->update([
            'tahun' => $request->tahun . $next,
            'nominal' => $request->nominal
        ]);

        toast('Berhasil Update','success');
        return redirect()->route('spp.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SPP::where('id',$id)->delete();

        toast('Berhasil Hapus','success');
        return redirect()->route('spp.index');
    }
}
