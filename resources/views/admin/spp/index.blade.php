@extends('layout.dashboard')
@section('content')



<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('SPP') }}</div>    
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah</button>
                
                    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 id="staticBackdropLabel" class="modal-title">Tambah</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('spp.store')}}" method="POST">
                                        @csrf 
                
                                        <div class="form-group">
                                            <label for="">Tahun</label>
                                            <input type="text" name="tahun" class="form-control" required>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">Nominal</label>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text prefix">Rp</span>
                                                <input type="number" name="nominal" class="form-control" min="0" required>
                                            </div>
                                        </div>
                
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="data" class="row-border striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun</th>
                                    <th>Nominal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $i = 1; 
                                @endphp
                                @foreach($spps as $spp)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{substr($spp->tahun,0,4)}} - {{substr($spp->tahun,-4,4)}}</td>
                                    <td>Rp {{number_format($spp->nominal,'0','.','.')}}</td>
                                    <td>
                                        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{$spp->id}}"><ion-icon name="pencil-outline"></ion-icon></a>
                                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$spp->id}}"><ion-icon name="trash-outline"></ion-icon></a>
                                    </td>

                                    <div class="modal fade" id="modalEdit{{$spp->id}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="staticBackdropLabel" class="modal-title">Tambah</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('spp.update',$spp->id)}}" method="POST">
                                                        @csrf 
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="">Tahun</label>
                                                            <input type="text" name="tahun" class="form-control" value="{{substr($spp->tahun,0,4)}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Nominal</label>
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text prefix">Rp</span>
                                                                <input type="number" name="nominal" class="form-control" min="0" value="{{$spp->nominal}}" required>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal fade" id="modalDelete{{$spp->id}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="staticBackdropLabel" class="modal-title">Delete</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('spp.destroy',$spp->id)}}" method="POST">
                                                        @csrf 
                                                        @method('DELETE')

                                                    <p>Yakin Hapus Data SPP Tahun <b>{{substr($spp->tahun,0,4)}}?</b></p>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

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