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
                <h3>{{$jml_sentra}}</h3>
                <p>Sentra UMKM</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('sentra_umkm')}}" class="small-box-footer">Detil Sentra <i class="fa fa-arrow-circle-right"></i></a>
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
    <div class="col-xs-12 col-md-6">
        <!-- Chat box -->
        <div class="box box-success">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">Info Terbaru</h3>
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
    <div class="col-xs-12 col-md-6">
        <!-- Chat box -->
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-comments-o"></i>
                <h3 class="box-title">Konsultasi Online</h3>
                <div class="pull-right">
                    <a href="{{url('konsultasi/all')}}" class="small-box-footer pull-right">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
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
                    <p style="font-weight: bold">{{$row->alamat}}</p>
                    <small class="pull-right">
                        Respon : {{$row->user?$row->lembaga->plut_name:'Belum ada'}}
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
                            <img class="img-circle img-sm" src="{{url('images/market.png')}}" alt="User Image">
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
    <script>
        $(function(){
            $('.scroll').slimScroll({
                height: '250px'
            });

            $('#myCarousel').addClass('active');
        });
    </script>
@endsection