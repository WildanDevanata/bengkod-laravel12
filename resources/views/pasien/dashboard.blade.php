@extends('components.layoutpasien')

@section('content')
<section class="content">
    <h1>Dashboard</h1>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
    
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $jumlahPeriksa }}</h3>



                        <p>Jumlah Riwayat Periksa</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            
        
    </div><!-- /.container-fluid -->
</section>

@endsection
