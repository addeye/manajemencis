<?php
/**
 * Created by Sublime
 * User: Dio Putra
 * Date: 29/01/2017
 * Time: 23:54
 */

?>

@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3> <small>Konsultan</small>
                    <div class="box-tools pull-right">
                        <a href="javascript:void(0)" onclick="loadOtherPage()" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Print {{$data->plut_name}}"><i
                                    class="fa fa-print"></i></a>
                        <a href="{{ url('k/lembaga/export/word/'.$data->id) }}" class="btn btn-info" data-toggle="tooltip" data-placement="left" title="Export Word {{$data->plut_name}}"><i
                                    class="fa fa-file-word-o"></i></a>
                    </div>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <img class="img-responsive" src="{{url('images/'.$data->photo_gedung)}}">
                    <dl>
                        <dt>ID Lembaga</dt>
                        <dd>{{$data->id_lembaga}}</dd>
                        <dt>SKPD Penanggungjawab</dt>
                        <dd>{{$data->skpd_name}}</dd>
                        <dt>Alamat</dt>
                        <dd>{{$data->skpd_alamat}}</dd>
                        <dt>Telepon</dt>
                        <dd>{{$data->skpd_telp}}</dd>
                        <dt>E-mail</dt>
                        <dd>{{$data->skpd_email}}</dd>
                        <dt>Whatsapp</dt>
                        <dd>{{$data->skpd_whatsapp}}</dd>
                    </dl>
                    <hr>
                    <dl>
                        <dt>Nama PLUT-KUMKM</dt>
                        <dd>{{$data->plut_name}}</dd>
                        <dt>Bentuk Kelembagaan</dt>
                        <dd>{{$data->plut_bentuk_kelembagaan}}</dd>
                        <dt>Provinsi</dt>
                        <dd>{{$data->provinces?$data->provinces->name:'--'}}</dd>
                        <dt>Kabupaten/Kota</dt>
                        <dd>{{$data->regencies?$data->regencies->name:'--'}}</dd>
                        <dt>Alamat</dt>
                        <dd>{{$data->plut_alamat}}</dd>
                        <dt>Telepon</dt>
                        <dd>{{$data->plut_telp}}</dd>
                        <dt>E-mail</dt>
                        <dd>{{$data->plut_email}}</dd>
                        <dt>Whatsapp</dt>
                        <dd>{{$data->plut_whatsapp}}</dd>
                        <dt>Website</dt>
                        <dd>{{$data->plut_website}}</dd>
                        <dt>Facebook</dt>
                        <dd>{{$data->plut_facebook}}</dd>
                    </dl>
                    <hr>
                    <dl>
                        <dt>Tahun Perolehan</dt>
                        <dd>{{$data->tahun_perolehan}}</dd>
                        <dt>Mulai Operasional</dt>
                        <dd>{{$data->mulai_operasional}}</dd>
                        <dt>Tanggal Peresmian</dt>
                        <dd>{{$data->tgl_peresmian}}</dd>
                        <dt>Diresmikan Oleh</dt>
                        <dd>{{$data->diresmikan_oleh}}</dd>
                        <dt>Hibah Tahun</dt>
                        <dd>{{$data->hibah_tahun}}</dd>
                        <dt>Telah bersinergi dengan pihak</dt>
                        <dd>{{$data->ket_bersinergi}}</dd>
                        <dt>Produk Unggulan Daerah</dt>
                        <dd>{{$data->produk_unggulan}}</dd>
                        <dt>Yang sudah branding dan masuk pasar Lokal/Nasional/Ekspor</dt>
                        <dd>{{$data->pemasaran}}</dd>
                        <dt>Produk lain yang potensial</dt>
                        <dd>{{$data->produk_potensial}}</dd>
                        <dt>Jumlah UMKM yang telah memanfaatkan e-commarce</dt>
                        <dd>{{$data->jml_umkm_ecommarce}}</dd>
                        <dt>Jumlah produk yang di pasarkan secara on-line</dt>
                        <dd>{{$data->jml_produk_online}}</dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            @include('layouts.alert')
            <div class="box box-success collapsed-box" style="display: none;">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Sentra Binaan</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{url('sentra_binaan/k')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="cis_lembaga_id" value="{{$data->id}}">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Sentra</label>
                            <input type="text" name="nama_sentra" class="form-control" placeholder="Nama Sentra"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Jumlah UMKM</label>
                            <input type="number" name="jml_ukmk_sentra" class="form-control" placeholder="Jumlah UMKM"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Produk/Bidang Usaha</label>
                            <input type="text" name="bidang_usaha_sentra" class="form-control"
                                   placeholder="Produk/Bidang Usaha.. " required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Wilayah Pemasaran</label>
                            <input type="text" name="wilayah_pemasaran" class="form-control"
                                   placeholder="Wilayah Pemasaran" required>
                        </div>
                        <button type="submit" class="btn btn-default">Simpan</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <div class="box box-success" style="">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Sentra Binaan</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">ID</th>
                            <th>Nama Sentra</th>
                            <th>Jumlah UMKM</th>
                            <th>Bidang Usaha</th>
                            <th>Wilayah Pemasaran</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sentra as $row)
                            <tr>
                                <td>{{$row->id_sentra}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->total_umkm}}</td>
                                <td>{{$row->bidang_usaha_id}}</td>
                                <td>{{$row->pemasaran}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            {{----}}
            <div class="box box-success collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Photo</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="{{url('k/cisfile')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="cis_lembaga_id" value="{{$data->id}}">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Photo</label>
                            <input type="file" name="photo[]" class="form-control" multiple required>

                            <p class="help-block">Bisa upload foto lebih dari satu </p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            <select class="form-control" name="tipe" required>
                                <option value="">Pilih..</option>
                                <option value="Konsultan">Konsultan</option>
                                <option value="Aktifitas">Aktifitas</option>
                            </select>

                            <p class="help-block">Photo Konsultan Pendamping PLUT-KUMKM (tujuh foto)</p>

                            <p class="help-block">Photo Aktifitas (max 5 foto)</p>
                        </div>
                        <button type="submit" class="btn btn-default">Simpan</button>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            {{----}}
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Daftar Foto</h3>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">ID</th>
                            <th>Keterangan</th>
                            <th>Photo</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data->cis_filemanager as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->tipe}}</td>
                                <td><a href="{{url('image/'.$row->photo)}}"><img width="30" class="img-responsive"
                                                                                 src="{{url('image/'.$row->photo)}}"></a>
                                </td>
                                <td>
                                    <a href="{{ url('k/cisfile/'.$row->id.'/delete') }}"
                                       onclick="return ConfirmDelete()" class="btn btn-danger btn-xs"><i
                                                class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <input id="urlcetak" value="{{ url('k/lembaga/'.$data->id.'/print') }}">
@endsection

@section('script')
    <script>
        function loadOtherPage() {
            var urlcetak = $("#urlcetak").val();

            var fullurl = urlcetak;

            $("<iframe>")                             // create a new iframe element
                    .hide()                               // make it invisible
                    .attr("src", fullurl) // point the iframe to the page you want to print
                    .appendTo("body");                    // add iframe to the DOM to cause it to load the page
        }
    </script>
@endsection