@extends('layout.dashboard')
@section('content')

<br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Pembayaran') }}</div>

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreate" id="run">Tambah</button>

                <div class="modal fade" id="modalCreate" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="true" aria-hidden="true" aria-labelledby="staticBackdropLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 id="staticBackdropLabel" class="modal-title">Tambah</h5>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('pembayaran.store')}}" method="POST">
                                    @csrf 

                                    @if($message = Session::get('error'))
                                    <div class="alert alert-info alert-block" role="alert">
                                        <span>{{$message}}</span>
                                    </div>
                                    @endif

                                    <div class="row">
                                        @if($siswa->count() == 0)

                                        <div class="form-group">
                                            <span class="form-control bg-danger text-white" style="text-align:center;">Belum ada Siswa</span>
                                        </div>
                                        @else

                                        <div class="form-group">
                                            <label for="">NISN</label>
                                            <select name="nisn" id="nisn" class="form-select">
                                                    <option disabled selected option>--Pilih--</option>
                                                @foreach($siswa as $s)
                                                    <option value="{{$s->nisn}}">{{$s->nisn}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group d-none" id="name">
                                            <label for="">Nama</label>
                                            <input type="text" id="nama" class="form-control" readonly>
                                        </div>
                                        @endif

                                        <div class="col-3">
                                            <div class="form-group">
                                                <label for="">Bayar</label>
                                                <select name="bayar_berapa" id="berapa" class="form-select">                
                                                    <option value="1">x1</option>
                                                    <option value="2">x2</option>
                                                    <option value="3">x3</option>
                                                    <option value="4">x4</option>
                                                    <option value="5">x5</option>
                                                    <option value="6">x6</option>
                                                    <option value="7">x7</option>
                                                    <option value="8">x8</option>
                                                    <option value="9">x9</option>
                                                    <option value="10">x10</option>
                                                    <option value="11">x11</option>
                                                    <option value="12">x12</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-9">
                                            <div class="form-group">
                                                <label for="">Nominal</label>
                                                <input type="text" id="nominal" name="jumlah_bayar" class="form-control" readonly placeholder="Nominal Bayar">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="">SPP</label>
                                            <input type="text" id="spp" class="form-control" readonly placeholder="Nominal SPP">
                                        </div>


                                        <div class="form-group d-none" id="akhir">
                                            <label for="waktuTerakhir">Waktu Terakhir Bayar</label>
                                            <input type="text" id="waktuTerakhir" class="form-control" readonly placeholder="Waktu terakhir bayar">
                                        </div>

                                        <input type="hidden" id="nama" class="form-control" readonly placeholder="Waktu terakhir bayar">
                                        <input type="hidden" id="nis" class="form-control" readonly placeholder="Waktu terakhir bayar">
                                        <input type="hidden" id="id_rombels" class="form-control" readonly placeholder="Waktu terakhir bayar">
                                        <input type="hidden" id="alamat" class="form-control" readonly placeholder="Waktu terakhir bayar">
                                        <input type="hidden" id="no_telp" class="form-control" readonly placeholder="Waktu terakhir bayar">                    

                                        @if($siswa->count() == 0) 

                                        <div class="form-group">
                                            <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</a>
                                        </div>

                                        @else

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>           
                                        </div>

                                        @endif
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
                            <th>Petugas</th>
                            <th>NISN</th>
                            <th>Tgl Bayar</th>
                            <th>Bulan Bayar</th>
                            <th>Tahun Bayar</th>
                            <th>Tahun Masuk</th>
                            <th>Jumlah Bayar</th>
                            <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                            $i = 1;
                            @endphp
                            @foreach($pembayaran as $trans)
                            <tr>
                            <td>{{$i++}}</td>
                            <td>{{$trans->name}}</td>
                            <td>{{$trans->nama}} | {{$trans->nisn}}</td>
                            <td>{{$trans->tgl_bayar}}</td>
                            <td>{{$trans->bulan_dibayar}}</td>
                            <td>{{$trans->tahun_dibayar}}</td>
                            <td>{{substr($trans->tahun,0,4)}} - {{substr($trans->tahun,-4,4)}}</td>
                            <td>{{$trans->jumlah_bayar}}</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#modalShow{{$trans->id}}" class="btn btn-info"><ion-icon name="eye-outline"></ion-icon></a>
                                </td>                                
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(Session::get('error')) > 0)
    <script>
        $(document).ready(function(){
            $('#modalCreate').modal('show')
        });
    </script>
    @endif

    <script>
        $(document).ready(function(){
            $('#data').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel','pdf'
                ]
            });
        });

            $('#nisn').on('change', function(){
                var nisn = $('#nisn').val();
                var berapa = $('#berapa').val();
                $('#name').removeClass('d-none');
                $('#akhir').removeClass('d-none');
                $('#kembalian').removeClass('d-none');
            $.ajax({ 
                url: "{{url('pembayaran/getData/')}}" + "/" + nisn + "/" + berapa,
                type: "GET",
                dataType: "json",
                success: function(data){
                    console.log(data);
                    $('#nama').val(data['nama']);
                    $('#spp').val(data['nominal']);
                    $('#waktuTerakhir').val(data['bulan']);
                    $('#nis').val(data['nis']);
                    $('#id_rombels').val(data['id_rombels']);
                    $('#alamat').val(data['alamat']);
                    $('#no_telp').val(data['no_telp']);
                }
            });

            $('#berapa').on('change', function(){
                var spp = $('#spp').val();
                var bayar = $(this).val();
                var total = spp * bayar;
                $('#nominal').val(total);
            });

            $(document).ready(function(){
                $('#nominal, #jumlah_bayar').keyup(function(){
                    var nominal = $('#nominal').val();
                    var jumlah_bayar = $('#jumlah_bayar').val();
                    var total = parseInt(jumlah_bayar) - parseInt(nominal);
                    $('#kembalian').val(total);
                });
            });

            $('#jumlah_bayar').keyup(function(){
                var sanitized = $(this).val().replace(/[^0-9]/g, '');

                $(this).val(sanitized);
            });
        });
</script>

@endsection