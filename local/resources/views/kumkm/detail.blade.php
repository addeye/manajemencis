<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 22/03/2017
 * Time: 12:14
 */
?>

@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body">
                    <form method="post" action="{{ url('kumkm/detail/'.$data->id) }}" class="" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <p class="box-title">HARGA / ASET</p>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('kas_tunai')?'has-error':''}}">
                                    <label>KAS TUNAI + KAS BANK</label>
                                    <input type="text" name="kas_tunai" class="form-control" placeholder="" value="{{$data->kas_tunai}}">
                                    <span class="help-block">{{$errors->first('kas_tunai')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('persediaan')?'has-error':''}}">
                                    <label>PERSEDIAAN (BAHAN BKAU + PRODUK)</label>
                                    <input type="text" name="persediaan" class="form-control" placeholder="" value="{{$data->persediaan}}">
                                    <span class="help-block">{{$errors->first('persediaan')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('harga_tetap')?'has-error':''}}">
                                    <label>HARGA TETAP (TANAH, BANGUNAN, MESIN, dan KENDARAAN)</label>
                                    <input type="text" name="harga_tetap" class="form-control" placeholder="" value="{{$data->harga_tetap}}">
                                    <span class="help-block">{{$errors->first('harga_tetap')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">KEWAJIBAN / PINJAMAN</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('kw_bank')?'has-error':''}}">
                                    <label>BANK</label>
                                    <input type="text" name="kw_bank" class="form-control" placeholder="" value="{{$data->kw_bank}}">
                                    <span class="help-block">{{$errors->first('kw_bank')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('kw_koperasi')?'has-error':''}}">
                                    <label>KOPERASI</label>
                                    <input type="text" name="kw_koperasi" class="form-control" placeholder="" value="{{$data->kw_koperasi}}">
                                    <span class="help-block">{{$errors->first('kw_koperasi')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('kw_lainnya')?'has-error':''}}">
                                    <label>LAINNYA</label>
                                    <input type="text" name="kw_lainnya" class="form-control" placeholder="" value="{{$data->kw_lainnya}}">
                                    <span class="help-block">{{$errors->first('kw_lainnya')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">KEPEMILIKAN TANAH</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('kp_sertifikat')?'has-error':''}}">
                                    <label>SERTIFIKAT (SHM)</label>
                                    <input type="text" name="kp_sertifikat" class="form-control" placeholder="" value="{{$data->kp_sertifikat}}">
                                    <span class="help-block">{{$errors->first('kp_sertifikat')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('kp_tidak_sertifikat')?'has-error':''}}">
                                    <label>TIDAK SHM</label>
                                    <input type="text" name="kp_tidak_sertifikat" class="form-control" placeholder="" value="{{$data->kp_tidak_sertifikat}}">
                                    <span class="help-block">{{$errors->first('kp_tidak_sertifikat')}}</span>
                                </div>

                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">OMSET / PENDAPATAN PENJUALAN DALAM 1 TAHUN</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('om_1thn_lalu')?'has-error':''}}">
                                    <label>1 TAHUN YANG LALU</label>
                                    <input type="text" name="om_1thn_lalu" class="form-control" placeholder="" value="{{$data->om_1thn_lalu}}">
                                    <span class="help-block">{{$errors->first('om_1thn_lalu')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('om_2thn_lalu')?'has-error':''}}">
                                    <label>2 TAHUN YANG LALU</label>
                                    <input type="text" name="om_2thn_lalu" class="form-control" placeholder="" value="{{$data->om_2thn_lalu}}">
                                    <span class="help-block">{{$errors->first('om_2thn_lalu')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">LABA / KEUNTUNGAN DALAM 1 TAHUN</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('lb_1thn_lalu')?'has-error':''}}">
                                    <label>1 TAHUN YANG LALU</label>
                                    <input type="text" name="lb_1thn_lalu" class="form-control" placeholder="" value="{{$data->lb_1thn_lalu}}">
                                    <span class="help-block">{{$errors->first('lb_1thn_lalu')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('lb_2thn_lalu')?'has-error':''}}">
                                    <label>2 TAHUN YANG LALU</label>
                                    <input type="text" name="lb_2thn_lalu" class="form-control" placeholder="" value="{{$data->lb_2thn_lalu}}">
                                    <span class="help-block">{{$errors->first('lb_2thn_lalu')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('laporan_regular')?'has-error':''}}">
                                    <label>LAPORAN KEUANGAN SECARA REGULER (YA/TIDAK)</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="laporan_regular" class="minimal" value="1" {{$data->laporan_regular==1?'checked':''}}> Ya
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="laporan_regular" class="minimal" value="0" {{$data->laporan_regular==0?'checked':''}}> Tidak
                                    </label>
                                    <span class="help-block">{{$errors->first('laporan_regular')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">PENDAMPINGAN</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('terima_pendampingan')?'has-error':''}}">
                                    <label>PENDAMPINGAN YANG PERNAH DITERIMA</label>
                                    <input type="text" name="terima_pendampingan" class="form-control" placeholder="" value="{{$data->terima_pendampingan}}">
                                    <span class="help-block">{{$errors->first('terima_pendampingan')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">PERMASALAHAN YANG DIHADAPI SAAT INI</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('masalah_lembaga')?'has-error':''}}">
                                    <label>KELEMBAGAAN USAHA</label>
                                    <textarea class="form-control" name="masalah_lembaga" rows="3"></textarea>
                                    <span class="help-block">{{$errors->first('masalah_lembaga')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('masalah_sdm')?'has-error':''}}">
                                    <label>SDM</label>
                                    <textarea class="form-control" name="masalah_sdm" rows="3"></textarea>
                                    <span class="help-block">{{$errors->first('masalah_sdm')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('masalah_produksi')?'has-error':''}}">
                                    <label>PRODUKSI</label>
                                    <textarea class="form-control" name="masalah_produksi" rows="3"></textarea>
                                    <span class="help-block">{{$errors->first('masalah_produksi')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('masalah_pembiayaan')?'has-error':''}}">
                                    <label>PEMBIAYAAN</label>
                                    <textarea class="form-control" name="masalah_pembiayaan" rows="3"></textarea>
                                    <span class="help-block">{{$errors->first('masalah_pembiayaan')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('masalah_pemasaran')?'has-error':''}}">
                                    <label>PEMASARAN</label>
                                    <textarea class="form-control" name="masalah_pemasaran" rows="3"></textarea>
                                    <span class="help-block">{{$errors->first('masalah_pemasaran')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('masalah_lainnya')?'has-error':''}}">
                                    <label>LAINNYA</label>
                                    <textarea class="form-control" name="masalah_lainnya" rows="3"></textarea>
                                    <span class="help-block">{{$errors->first('masalah_lainnya')}}</span>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">PRODUK 1</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('p1_nama_produk')?'has-error':''}}">
                                    <label>NAMA PRODUK</label>
                                    <input type="text" name="p1_nama_produk" class="form-control" placeholder="" value="{{$data->p1_nama_produk}}">
                                    <span class="help-block">{{$errors->first('p1_nama_produk')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('p1_deskripsi')?'has-error':''}}">
                                    <label>DESKRIPSI</label>
                                    <textarea class="form-control" name="p1_deskripsi" rows="4">{{$data->p1_deskripsi}}</textarea>
                                    <span class="help-block">{{$errors->first('p1_deskripsi')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('p1_harga')?'has-error':''}}">
                                    <label>HARGA</label>
                                    <input type="text" name="p1_harga" class="form-control" placeholder="" value="{{$data->p1_harga}}">
                                    <span class="help-block">{{$errors->first('p1_harga')}}</span>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group {{$errors->has('p1_foto_produk')?'has-error':''}}">
                                    <label>FOTO PRODUK</label>
                                    <img width="100" src="{{url('produk/'.$data->p1_foto_produk)}}" class="img-responsive thumbnail" alt="Responsive image">
                                    <input type="file" name="p1_foto_produk" class="" placeholder="">
                                    <span class="help-block">{{$errors->first('p1_foto_produk')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">PRODUK 2</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('p2_nama_produk')?'has-error':''}}">
                                    <label>NAMA PRODUK</label>
                                    <input type="text" name="p2_nama_produk" class="form-control" placeholder="Jumlah tenaga kerja ..." value="{{$data->p2_nama_produk}}">
                                    <span class="help-block">{{$errors->first('p2_nama_produk')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('p2_deskripsi')?'has-error':''}}">
                                    <label>DESKRIPSI</label>
                                    <textarea class="form-control" name="p2_deskripsi" rows="4">{{$data->p2_deskripsi}}</textarea>
                                    <span class="help-block">{{$errors->first('p2_deskripsi')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('p2_harga')?'has-error':''}}">
                                    <label>HARGA</label>
                                    <input type="text" name="p2_harga" class="form-control" placeholder="Alamat email.." value="{{$data->p2_harga}}" readonly>
                                    <span class="help-block">{{$errors->first('p2_harga')}}</span>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group {{$errors->has('p2_foto_produk')?'has-error':''}}">
                                    <label>FOTO PRODUK</label>
                                    <img width="100" src="{{url('produk/'.$data->p2_foto_produk)}}" class="img-responsive thumbnail" alt="Responsive image">
                                    <input type="file" name="p2_foto_produk" class="" placeholder="" value="{{$data->p2_foto_produk}}">
                                    <span class="help-block">{{$errors->first('	p2_foto_produk')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">PRODUK 3</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('p3_nama_produk')?'has-error':''}}">
                                    <label>NAMA PRODUK</label>
                                    <input type="text" name="p3_nama_produk" class="form-control" placeholder="" value="{{$data->p3_nama_produk}}">
                                    <span class="help-block">{{$errors->first('p3_nama_produk')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('p3_deskripsi')?'has-error':''}}">
                                    <label>DESKRIPSI</label>
                                    <textarea type="text" name="p3_deskripsi" class="form-control" placeholder="">{{$data->p3_deskripsi}}</textarea>
                                    <span class="help-block">{{$errors->first('p3_deskripsi')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('p3_harga')?'has-error':''}}">
                                    <label>HARGA</label>
                                    <input type="text" name="p3_harga" class="form-control" placeholder="   " value="{{$data->p3_harga}}">
                                    <span class="help-block">{{$errors->first('p3_harga')}}</span>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group {{$errors->has('p3_foto')?'has-error':''}}">
                                    <label>FOTO PRODUK</label>
                                    <img width="100" src="{{url('produk/'.$data->p3_foto)}}" class="img-responsive thumbnail" alt="Responsive image">
                                    <input type="file" name="p3_foto" class="" placeholder="">
                                    <span class="help-block">{{$errors->first('p3_foto')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('izin_produk')?'has-error':''}}">
                                    <label>PERIZINAN/STANDAR PRODUK</label>
                                    <select name="izin_produk" class="form-control">
                                        <option value="" {{$data->izin_produk==''?'selected':''}} >Pilih </option>
                                        <option value="Sertifikasi" {{$data->izin_produk=='Sertifikasi'?'selected':''}}>Sertifikasi </option>
                                        <option value="Halal" {{$data->izin_produk=='Halal'?'selected':''}}>Halal </option>
                                        <option value="PIRT" {{$data->izin_produk=='PIRT'?'selected':''}}>PIRT </option>
                                        <option value="BPOM" {{$data->izin_produk=='BPOM'?'selected':''}}>BPOM </option>
                                        <option value="SNI" {{$data->izin_produk=='SNI'?'selected':''}}>SNI </option>
                                        <option value="ISO" {{$data->izin_produk=='ISO'?'selected':''}}>ISO </option>
                                    </select>
                                    <span class="help-block">{{$errors->first('izin_produk')}}</span>
                                </div>
                                <div class="form-group">
                                    <div class="box-header with-border bg-info">
                                        <h3 class="box-title">PERIZINAN USAHA</h3>
                                    </div>
                                </div>
                                <div class="form-group {{$errors->has('izin_usaha_iumk')?'has-error':''}}">
                                    <label>IUMK</label>
                                    <input type="text" name="izin_usaha_iumk" class="form-control" placeholder="" value="{{$data->izin_usaha_iumk}}">
                                    <span class="help-block">{{$errors->first('izin_usaha_iumk')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('izin_usaha_siui')?'has-error':''}}">
                                    <label>SIUI</label>
                                    <input type="text" name="izin_usaha_siui" class="form-control" placeholder="" value="{{$data->izin_usaha_siui}}">
                                    <span class="help-block">{{$errors->first('izin_usaha_siui')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('izin_usaha_siup')?'has-error':''}}">
                                    <label>SIUP</label>
                                    <input type="text" name="izin_usaha_siup" class="form-control" placeholder="" value="{{$data->izin_usaha_siup}}">
                                    <span class="help-block">{{$errors->first('izin_usaha_siup')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('legalitas_lokasi')?'has-error':''}}">
                                    <label>LEGALITAS LOKASI USAHA</label>
                                    <input type="text" name="legalitas_lokasi" class="form-control" placeholder="" value="{{$data->legalitas_lokasi}}">
                                    <span class="help-block">{{$errors->first('legalitas_lokasi')}}</span>
                                </div>
                                <div class="form-group {{$errors->has('jangkauan_pasar')?'has-error':''}}">
                                    <label>JANGKAUAN PEMASARAN </label>
                                    <select name="jangkauan_pasar" class="form-control">
                                        <option value="">Pilih</option>
                                        <option value="Lokal Provinsi" {{$data->jangkauan_pasar=='Lokal Provinsi'?'selected':''}}>Lokal Provinsi</option>
                                        <option value="Nasional" {{$data->jangkauan_pasar=='Nasional'?'selected':''}}>Nasional</option>
                                        <option value="Ekspor" {{$data->jangkauan_pasar=='Ekspor'?'selected':''}}>Ekspor</option>
                                    </select>
                                    <span class="help-block">{{$errors->first('jangkauan_pasar')}}</span>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fa fa-save"></i> Update
                                    </button>
                                    <a href="{{url('kumkm')}}" class="btn btn-default">
                                        <i class="fa fa-reply"></i> Kembali
                                    </a>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

