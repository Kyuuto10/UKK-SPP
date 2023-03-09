@extends('layout.dashboard')
@section('content')


<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Siswa') }}</div>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah</button>
                
                
                    <!-- Modal Create -->
                    <div class="modal fade" id="modalCreate" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 id="staticBackdropLabel" class="modal-title">Tambah</h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('siswa.store')}}" method="POST">
                                        @csrf 
                
                                        <div class="form-group">
                                            <label for="">NISN</label>
                                            <input type="text" name="nisn" class="form-control @error('nisn') is-invalid @enderror" onkeypress="validate(event)" value="{{old('nisn')}}" required>

                                            @error('nisn')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{$message}}</span>
                                            </div>
                                            @enderror
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">NIS</label>
                                            <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror" onkeypress="validate(event)" value="{{old('nis')}}" required>

                                            @error('nis')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{$message}}</span>
                                            </div>
                                            @enderror
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}" required>

                                            @error('nama')
                                            <div class="invalid-feedback" role="alert">
                                                <span>{{$message}}</span>
                                            </div>
                                            @enderror
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">Kelas</label>
                                            <select name="id_kelas" id="" class="form-select">
                                                <option disabled selected option>Pilih Kelas</option>
                                                @foreach($kelas as $k)
                                                <option value="{{$k->id}}">{{$k->nama_kelas}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">Alamat</label>
                                            <textarea name="alamat" id="" cols="30" rows="10" class="form-control" value="{{old('alamat')}}" required>{{old('alamat')}}</textarea>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">No Telp</label>
                                            <input type="text" name="no_telp" class="form-control" onkeypress="validate(event)" value="{{old('no_telp')}}" required>
                                        </div>
                
                                        <div class="form-group">
                                            <label for="">SPP</label>
                                            <select name="id_spp" id="" class="form-select">
                                                <option disabled selected option>Pilih SPP</option>
                                                @foreach($spps as $spp)
                                                <option value="{{$spp->id}}">{{substr($spp->tahun,0,4)}}</option>
                                                @endforeach
                                            </select>
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
                                    <th>NISN</th>
                                    <th>NIS</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Alamat</th>
                                    <th>No Telp</th>
                                    <th>Tahun Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $i = 1; 
                                @endphp
                                @foreach($siswas as $siswa)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$siswa->nisn}}</td>
                                    <td>{{$siswa->nis}}</td>
                                    <td>{{$siswa->nama}}</td>
                                    <td>{{$siswa->nama_kelas}}</td>
                                    <td>{{$siswa->alamat}}</td>
                                    <td>{{$siswa->no_telp}}</td>
                                    <td>{{substr($siswa->tahun,0,4)}} - {{substr($siswa->tahun,-4,4)}}</td>
                                    <td>
                                        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{$siswa->nisn}}"><ion-icon name="pencil-outline"></ion-icon></a>
                                        <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDelete{{$siswa->nisn}}"><ion-icon name="trash-outline"></ion-icon></a>
                                    </td>


                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="modalEdit{{$siswa->nisn}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="staticBackdropLabel" class="modal-title">Edit</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('siswa.update',$siswa->nisn)}}" method="POST">
                                                        @csrf 
                                                        @method('PUT')

                                                        <div class="form-group">
                                                            <label for="">NISN</label>
                                                            <input type="text" name="nisn" class="form-control" value="{{$siswa->nisn}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">NIS</label>
                                                            <input type="text" name="nis" class="form-control" value="{{$siswa->nis}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Nama</label>
                                                            <input type="text" name="nama" class="form-control" value="{{$siswa->nama}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Kelas</label>
                                                            <select name="id_kelas" id="" class="form-select">
                                                                <option value=""></option>
                                                                @foreach($kelas as $k)
                                                                <option value="{{$k->nama_kelas}}" {{($k->id == $siswa->id_kelas) ? 'selected' : ''}}>{{$k->nama_kelas}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">Alamat</label>
                                                            <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{$siswa->alamat}}</textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">No Telp</label>
                                                            <input type="text" name="no_telp" class="form-control" value="{{$siswa->no_telp}}" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="">SPP</label>
                                                            <select name="id_spp" id="" class="form-select">
                                                                <option value=""></option>
                                                                @foreach($spps as $spp)
                                                                <option value="{{$spp->tahun}}" {{($spp->id == $siswa->id_spp) ? 'selected' : ''}}>{{substr($spp->tahun,0,4)}}</option>
                                                                @endforeach
                                                            </select>
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
                                    <div class="modal fade" id="modalDelete{{$siswa->nisn}}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 id="staticBackdropLabel" class="modal-title">Hapus</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('siswa.destroy',$siswa->nisn)}}" method="POST">
                                                        @csrf 
                                                        @method('DELETE')

                                                        <p>Yakin Hapus data {{$siswa->nama}} - {{$siswa->nisn}}</p>

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


@if(count($errors) > 0)
<script>
    $(document).ready(function(){
        $('#modalCreate').modal('show')
    });
</script>
@endif

<script>    
        $('.select').select2({
            dropdownParent: $('#modalCreate'),
            theme: 'bootstrap4',
            placdeholder: 'Pilih Data'            
        });

    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>

@endsection