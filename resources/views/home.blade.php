@extends('layout.dashboard')

@section('content')

<style>
    p{
        text-align:center;
    }
</style>

<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="text-align:center;">{{ __('Data Pembayaran Anda') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->type == 'admin')
                    <p>Hai! Selamat Datang {{auth()->user()->name}}</p> 

                    @elseif(auth()->user()->type == 'petugas')
                    <p>Hai! Selamat Datang {{auth()->user()->name}}</p>

                    @else
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">                                             
                                  
                                    <a href="{{url('history/export')}}" class="btn btn-secondary">Export</a>
                                    <div class="card-body">
                                        <table id="data" class="row-border striped"> 
                                            <thead>
                                                <tr>
                                                <th>No</th>
                                                <th>Petugas</th>
                                                <th>NISN</th>
                                                <th>Tgl Bayar</th>
                                                <th>Bulan Bayar</th>
                                                <th>Tahun Bayar</th>
                                                <th>Tahun Masuk</th>
                                                <th>Jumlah Bayar</th>                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i = 1; @endphp
                                                @foreach($pembayaran as $v)
                                                <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$v->name}}</td>
                                                <td>{{$v->nama}} | {{$v->nisn}}</td>
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
