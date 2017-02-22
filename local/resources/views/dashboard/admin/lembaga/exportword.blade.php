<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 22/02/2017
 * Time: 16:40
 */
?>
        <!-- Bootstrap 3.3.2 -->
<link href="{{ url("admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
<div class="row">
    <div class="col-xs-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$data->plut_name}}</h3>

            </div>
            <!-- / box Header -->
            <div class="box-body">
                {{--<img class="img-responsive" src="{{url('images/'.$data->photo_gedung)}}">--}}
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
    <div class="col-xs-6">
                <!-- /.box -->
        <div class="box box-success">
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
                    @foreach($data->sentra_binaan as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->nama_sentra}}</td>
                            <td>{{$row->jml_ukmk_Sentra}}</td>
                            <td>{{$row->bidang_usaha_sentra}}</td>
                            <td>{{$row->wilayah_pemasaran}}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        {{----}}
        {{----}}
    </div>
</div>