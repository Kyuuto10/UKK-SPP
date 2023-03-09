<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Spp</title>
    <!-- <link rel="stylesheet" href="{{asset('assets/css2.css')}}"> -->
    <link rel="stylesheet" href="{{asset('assets/bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('assets/fontawesome-free-5.15.3-web/css/all.min.css')}}"> -->

    <script src="{{asset('assets/jquery-3.6.0.slim.min.js')}}"></script>
    <script src="{{asset('assets/popper.min.js')}}"></script>
    <script src="{{asset('assets/bootstrap.min.js')}}"></script>

    <script src="{{asset('assets/jquery.min.js')}}"></script>

    <!-- Button datatable -->
    
    <link rel="stylesheet" href="{{asset('assets/jquery.dataTables.css')}}">
    <script src="{{asset('assets/jquery.dataTables.js')}}"></script>
    
    <link rel="stylesheet" href="{{asset('assets/select2.min.css')}}">
    <script src="{{asset('assets/select2.min.js')}}"></script>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <!-- Bootstraps -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Ionicons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    
    <!-- jika menggunakan bootstrap4 gunakan css ini  -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <!-- cdn bootstrap4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha512-a9NgEEK7tsCvABL7KqtUTQjl69z7091EVPpw5KxPlZ93T141ffe1woLtbXTX+r2/8TtTvRX/v4zTL2UlMUPgwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.min.js" integrity="sha512-P0bOMePRS378NwmPDVPU455C/TuxDS+8QwJozdc7PGgN8kLqR4ems0U/3DeJkmiE31749vYWHvBOtR+37qDCZQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>        
    </head>
<body>
    @include('sweetalert::alert')
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @if(auth()->user()->type == 'admin')
                    <a class="nav-link active" href="{{route('kelas.index')}}">Kelas</a>
                    <a class="nav-link active" href="{{route('siswa.index')}}">Siswa</a>
                    <a class="nav-link active" href="{{route('spp.index')}}">SPP</a>                    
                    <a class="nav-link active" href="{{route('pembayaran.index')}}">Pembayaran</a>  
                    <a class="nav-link active" href="{{route('history.index')}}">History</a>  
                    <a class="nav-link active" href="{{route('petugas.index')}}">Petugas</a>  
                    @elseif(auth()->user()->type == 'petugas')
                    <a class="nav-link active" href="{{route('kelas.index')}}">Kelas</a>
                    <a class="nav-link active" href="{{route('siswa.index')}}">Siswa</a>
                    <a class="nav-link active" href="{{route('spp.index')}}">SPP</a>                    
                    <a class="nav-link active" href="{{route('pembayaran.index')}}">Pembayaran</a>  
                    <a class="nav-link active" href="{{route('history.index')}}">History</a>  
                    @else
                    <a class="nav-link active" href="{{route('history')}}">History</a>  
                    @endif
                    
                </div>

            </div>
        </div>
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
        
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        
    </nav>
    @yield('content')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#data').DataTable();
        });
    </script>
</body>
</html>