@extends('components.layout')

@section('nav-content')
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
        <li class="nav-item">
            <a href="{{ route('pasien.dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                    <span class="right badge bg-primary">Pasien</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pasien.janjiPeriksa') }}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Janji Periksa
                    <span class="right badge bg-primary">Pasien</span>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pasien.riwayat') }}" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                    Riwayat Periksa
                    <span class="right badge bg-primary">Pasien</span>
                </p>
            </a>
        </li>
    </ul>


    <!-- Brand Logo or Logout Section -->
    <div class="d-flex justify-content-center mt-4">
        <form action="{{ route('logout') }}" method="POST" class="w-75 text-center">
            @csrf
            <button type="submit" class="btn btn-danger btn-medium btn-block">
                Logout
            </button>
        </form>
    </div>

@endsection




@section('content')
    <section class="content">
        <h1>Dashboard</h1>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$totalPeriksa}}</h3>

                            <p>TOTAL PERIKSA</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    @if(session('welcome_message'))
        <p>{{ session('welcome_message') }}</p>
    @endif

    @if(Auth::check())
        <p>Welcome, {{ Auth::user()->name }}!</p>
    @endif
@endsection