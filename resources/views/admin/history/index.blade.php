@extends('layout.dashboard')
@section('content')

<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pembayaran') }}</div>                
                
                <a href="{{url('history/export')}}" class="btn btn-secondary">Export</a>
                <div class="card-body">
                    <table id="data" class="row-border striped"> 
                        <thead>
                            <tr>                            
                            <th>Petugas</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Alamat</th>
                            <th>No Telp</th>                            
                            <th>Tahun Masuk</th>
                            <th>Tgl Bayar</th>
                            <th>Bulan Bayar</th>
                            <th>Tahun Bayar</th>
                            <th>Tahun Masuk</th>
                            <th>Jumlah Bayar</th>                            
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $i = 1;
                            @endphp
                            @foreach($trans as $v)
                            <tr>
                            <td>{{$v->name}}</td>
                            <td>{{$v->nisn}}</td>
                            <td>{{$v->nama}}</td>
                            <td>{{$v->nama_kelas}}</td>
                            <td>{{$v->alamat}}</td>
                            <td>{{$v->no_telp}}</td>
                            <td>{{$v->tahun}}</td>
                            <td>{{$v->tgl_bayar}}</td>
                            <td>{{$v->bulan_dibayar}}</td>
                            <td>{{$v->tahun_dibayar}}</td>
                            <td>{{substr($v->tahun,0,4)}} - {{substr($v->tahun,-4,4)}}</td>
                            <td>{{$v->jumlah_bayar}}</td>                                 
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection