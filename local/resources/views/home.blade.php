@extends('layouts.master')

@section('content')
        <!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{$jml_sentra}}</h3>
                <p>Sentra UMKM</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Detil Sentra <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{0}}</h3>
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
            <a href="#" class="small-box-footer">Detil Kegiatan <i class="fa fa-arrow-circle-right"></i></a>
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
            <a href="#" class="small-box-footer">Detil Penerima <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-xs-12 col-md-6">
        <!-- Chat box -->
        <div class="box box-success">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">Info Terbaru</h3>
                <div class="pull-right">
                    <a href="#" class="small-box-footer pull-right">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
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
                        {!! $row->keterangan !!}
                    </p>
                    <!-- /.attachment -->
                </div>
                <!-- /.item -->
                @endforeach
            </div>
            <!-- /.chat -->
        </div>
        <!-- /.box (chat box) -->
    </div>
    <div class="col-xs-12 col-md-6">
        <!-- Chat box -->
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>
                <h3 class="box-title">Konsultasi Online</h3>
                <div class="pull-right">
                    <a href="#" class="small-box-footer pull-right">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="box-body chat scroll" id="chat-box">
                @foreach($konsultasi as $row)
                        <!-- chat item -->
                <div class="item">
                    <span class="fa fa-user fa-3x"></span>
                    <p class="message">
                        <a href="{{url('konsultasi/'.$row->id.'/detail')}}" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{$row->dibuat}}</small>
                            {{$row->nama}} - {{$row->email}}
                        </a>
                        {!! $row->permasalahan_bisnis !!}
                    </p>
                    <small class="pull-right">
                        Respon : {{$row->lembaga_id?$row->lembaga->plut_name:'Belum ada'}}
                        <br>{{$row->user?$row->user->name:''}}
                    </small>
                    <!-- /.attachment -->
                </div>
                <!-- /.item -->
                @endforeach
            </div>
            <!-- /.chat -->
        </div>
        <!-- /.box (chat box) -->
    </div>

    <div class="col-xs-12 col-md-6">
        <!-- Chat box -->
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-globe"></i>
                <h3 class="box-title">Informasi Pasar</h3>
            </div>
            <div class="box-body chat scroll" id="chat-box">
                @foreach($informasi as $data)
                    <div class="col-md-12 box-footer box-comments">
                        <div class="box-comment">
                            <!-- User image -->
                            <img class="img-circle img-sm" src="{{url('images/default.png')}}" alt="User Image">
                            <div class="comment-text">
                              <span class="username"> {{$data->nama_lengkap}} - {{$data->email}}
                                  <span class="text-muted pull-right">{{$data->dibuat}}</span>
                              </span><!-- /.username -->
                                <span style="font-weight: bold">{{$data->nama_produk}}</span>
                                <p>{{$data->keterangan}}</p>
                            </div>
                            <!-- /.comment-text -->
                            <span class="pull-right text-muted">{{count($data->comment)}} Comment <a href="{{url('informasi/'.$data->id.'/detail')}}">Selengkapnya..</a></span>
                        </div>
                    </div>
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
        <!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ url('admin-lte/plugins/morris/morris.min.js')}}" type="text/javascript"></script>
<script>
    // LINE CHART
    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            {y: '2011 Q1', item1: 2666},
            {y: '2011 Q2', item1: 2778},
            {y: '2011 Q3', item1: 4912},
            {y: '2011 Q4', item1: 3767},
            {y: '2012 Q1', item1: 6810},
            {y: '2012 Q2', item1: 5670},
            {y: '2012 Q3', item1: 4820},
            {y: '2012 Q4', item1: 15073},
            {y: '2013 Q1', item1: 10687},
            {y: '2013 Q2', item1: 8432}
        ],
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Item 1'],
        lineColors: ['#3c8dbc'],
        hideHover: 'auto'
    });

    $(function(){
        $('.scroll').slimScroll({
            height: '250px'
        });
    });

</script>
@endsection