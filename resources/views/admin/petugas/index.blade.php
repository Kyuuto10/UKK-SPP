@extends('layout.dashboard')
@section('content')

<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Petugas') }}</div>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate">Tambah</button>

                <div class="modal fade" id="modalCreate" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-hidden="true" aria-labelledby="staticBackdropLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="staticBackdropLabel" class="modal-title">Tambah</h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('petugas.store')}}" method="POST">
                                    @csrf 

                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required>

                                        @error('name')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" required>

                                        @error('username')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>

                                        @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <span>{{$message}}</span>
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <span for="">Role</span>
                                        <br>
                                        <input type="radio" name="type" value="1" id="type1" value="{{old('type')}}" required>
                                        <label for="type1">Admin</label><br>
                                        <input type="radio" name="type" value="2" id="type2" value="{{old('type')}}" required>                                      
                                        <label for="type2">Petugas</label>
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
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $i = 1;
                            @endphp
                            @foreach($petugas as $p)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$p->name}}</td>
                                <td>{{$p->username}}</td>
                                <td>{{$p->type}}</td>
                                <td>
                                    <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{$p->id}}"><ion-icon name="pencil-outline"></ion-icon></a>
                                </td>

                                <div class="modal fade" id="modalEdit{{$p->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-hidden="true" aria-labelledby="staticBackdropLabel">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 id="staticBackdropLabel" class="modal-title">Tambah</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('petugas.update',$p->id)}}" method="POST">
                                                    @csrf 
                                                    @method('PUT')

                                                    <div class="form-group">
                                                        <label for="">Nama</label>
                                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$p->name}}" required>

                                                        @error('name')
                                                        <div class="invalid-feedback" role="alert">
                                                            <span>{{$message}}</span>
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Username</label>
                                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{$p->username}}" required>

                                                        @error('username')
                                                        <div class="invalid-feedback" role="alert">
                                                            <span>{{$message}}</span>
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">Password</label>
                                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{$p->password}}" required>

                                                        @error('password')
                                                        <div class="invalid-feedback" role="alert">
                                                            <span>{{$message}}</span>
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <span for="">Role</span>
                                                        <br>
                                                        <input type="radio" name="type" value="1" id="type1" {{$p->type == 'admin' ? 'checked' : ''}}>
                                                        <label for="type1">Admin</label><br>
                                                        <input type="radio" name="type" value="2" id="type2" {{$p->type == 'petugas' ? 'checked' : ''}}>                                      
                                                        <label for="type2">Petugas</label>
                                                    </div>

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

    @if(count($errors) > 0)
    <script>
        $(document).ready(function(){
            $('#modalCreate').modal('show')
        });
    </script>
    @endif
    <!-- <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

            <div class="col-md-6">
                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>

            <div class="col-md-6">
                <select name="type" id="" class="form-select">
                    <option value="1">Admin</option>
                    <option value="2">Petugas</option>
                </select>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </form> -->

@endsection