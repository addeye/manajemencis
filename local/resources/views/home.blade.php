@extends('layouts.master')

@section('css')
    <style>
        /*Info*/
        .item .info {
            margin-left: 55px;
        }
    </style>
    @endsection

@section('content')
        <!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$jml_kumkm}}</h3>
                <p>UMKM</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('sentra_umkm')}}" class="small-box-footer">Detil UMKM <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{$jml_produk}}</h3>
                <p>Produk Unggulan</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Detil Produk<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{$jml_kegiatan}}</h3>

                <p>Jumlah Kegiatan</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('kegiatan')}}" class="small-box-footer">Detil Kegiatan <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3>{{$jml_penerima}}</h3>
                <p>Penerima Manfaat</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('penerima')}}" class="small-box-footer">Detil Penerima <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-xs-12 col-md-12">
        <!-- Chat box -->
        <div class="box box-success">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">Info Terkini</h3>
                <div class="pull-right">
                    <a href="{{url('info')}}" class="small-box-footer pull-right">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="box-body chat scroll" id="chat-box">
                @foreach($pengumuman as $row)
                        <!-- chat item -->
                <div class="item">
                    <img src="{{url('images/'.$row->user->path)}}" alt="user image" class="online">
                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$row->dibuat}}</small>
                            {{$row->user->name}} - {{$row->judul}}
                        </a>
                    </p>
                    <div class="info">{!! $row->keterangan !!}</div>
                    <!-- /.attachment -->
                </div>
                <!-- /.item -->
                @endforeach
            </div>
            <!-- /.chat -->
        </div>
        <!-- /.box (chat box) -->
    </div>

        <!-- ./col -->
    <div class="col-md-12" style="display: none">
            <!-- LINE CHART -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Line Chart</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body chart-responsive">
                    <div class="chart" id="line-chart" style="height: 300px;"></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

</div>
@endsection

@section('script')
    <script>
        $(function(){
            $('.scroll').slimScroll({
                height: '250px'
            });

            $('#myCarousel').addClass('active');
        });
    </script>
@endsection