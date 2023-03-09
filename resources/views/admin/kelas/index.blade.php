@extends('layout.dashboard')
@section('content')

<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Kelas') }}</div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate"><ion-icon name="plus-outline"></ion-icon></button>
                
                
                    <!-- Modal Create -->
                    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 id="staticBackdropLabel" class="modal-title">Tambah</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('kelas.store')}}" method="POST">
                                        @csrf 
                
                                        <div class="form-group">
                                            <label for="">Nama Kelas</label>
                                            <input type="text" name="nama_kelas" class="form-control" required>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">Kompetensi Keahlian</label>
                                            <input type="text" name="kompetensi_keahlian" class="form-control" required>
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
                                    <th>Nama Kelas</th>
                                    <th>Kompetensi Keahlian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $i = 1; 
                                @endphp
                                @foreach($kelas as $k)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$k->nama_kelas}}</td>
                                    <td>{{$k->kompetensi_keahlian}}</td>
                                    <td>
                                        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{$k->id}}"><ion-icon name="pencil-outline"></ion-icon></a>
                                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$k->id}}"><ion-icon name="trash-outline"></ion-icon></a>
                                    </td>


                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modalEdit{{$k->id}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="staticBackdropLabel" class="modal-title">Edit</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('kelas.update',$k->id)}}" method="POST">
                                                        @csrf 
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="">Nama Kelas</label>
                                                            <input type="text" name="nama_kelas" class="form-control" value="{{$k->nama_kelas}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Kompetensi Keahlian</label>
                                                            <input type="text" name="kompetensi_keahlian" class="form-control" value="{{$k->kompetensi_keahlian}}" required>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="modalDelete{{$k->id}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="staticBackdropLabel" class="modal-title">Hapus</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('kelas.destroy',$k->id)}}" method="POST">
                                                        @csrf 
                                                        @method('DELETE')

                                                        <p>Yakin Hapus data {{$k->nama_kelas}}</p>

                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
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