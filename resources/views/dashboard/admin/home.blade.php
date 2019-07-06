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
    <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$jml_koperasi}}</h3>
                    <p>Data Koperasi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{url('adm/koperasi')}}" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$jml_kumkm}}</h3>
                    <p>Data UMKM</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cube"></i>
                </div>
                <a href="{{url('adm/data-kumkm')}}" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$koperasi_dampingan}}</h3>

                    <p>Koperasi Dampingan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('adm/sasaran-koperasi')}}" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$umkm_dampingan}}</h3>
                    <p>UMKM Dampingan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('adm/sasaran-kumkm')}}" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-purple">
                <div class="inner">
                    <h3>{{$program}}</h3>
                    <p>Rencana Aksi</p>
                </div>
                <div class="icon">
                    <i class="ion ion-home"></i>
                </div>
                <a href="{{url('adm/program-kerja')}}" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>{{$pelaksanaan}}</h3>
                    <p>Pelaksanaan</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bookmark"></i>
                </div>
                <a href="{{url('adm/pelaksanaan-pendampingan')}}" class="small-box-footer"> Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-xs-12 col-md-12">
        <!-- Chat box -->
        <div class="box box-success">
            <div class="box-header">
                <i class="fa fa-info-circle"></i>
                <h3 class="box-title">AKTIVITAS USER</h3>
                <!-- <div class="pull-right">
                    <a href="{{url('info')}}" class="small-box-footer pull-right">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
                </div> -->
            </div>
            <div class="box-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Lembaga</th>
                            <th>Jenis Akun</th>
                            <th>Bidang</th>
                            <th>Info</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($activity as $key=>$row)
                        <tr>
                            <td>{{$row->user->name}}</td>
                            <td>
                                @if($row->user->role_id==2)
                                    {{$row->user->adminlembagas->lembagas->plut_name}}
                                @elseif($row->user->role_id==3)
                                    {{$row->user->konsultans->lembagas->plut_name}}
                                @elseif($row->user->role_id==4)
                                    -
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{$row->user->roles->name}}
                            </td>
                            <td>
                                @if($row->user->role_id==3)
                                    {{$row->user->konsultans->bidang_layanans->name}}
                                @endif
                            </td>
                            <th>{{$row->info}}</th>
                            <td>
                                {{$row->created_at->format('d-m-Y H:i:s')}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                {{ $activity->links() }}
                </div>
            </div>
            <!-- /.chat -->
        </div>
        <!-- /.box (chat box) -->
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