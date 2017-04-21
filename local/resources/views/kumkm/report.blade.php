<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 22/03/2017
 * Time: 15:50
 */
?>
@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="col-xs-1">No</th>
                            <th class="col-xs-2">ID KUMKM</th>
                            <th>Nama Usaha</th>
                            <th>Nama Pemilik</th>
                            <th>Nomor Telepon</th>
                            <th>No. KTP</th>
                            <th>NPWP</th>
                            <th>Email</th>
                            <th>Badan Usaha</th>
                            <th>No Badan Usaha</th>
                            <th>Tahun Mulai Usaha</th>
                            <th>Bidang Usaha</th>
                            <th>Skala Usaha</th>
                            <th>Usaha Utama/Pokok</th>
                            <th>Produk Yang Dihasilkan</th>
                            <th>Sentra</th>
                            <th>ID Sentra</th>
                            <th>Tenaga Kerja Tetap</th>
                            <th>Tenaga Kerja Tidak Tetap</th>
                            <th>Alamat</th>
                            <th>Provinsi</th>
                            <th>Kabupaten</th>
                            <th>Kecamatan</th>
                            <th>Kelurahan</th>
                            <th>KAS TUNAI + KAS BANK</th>
                            <th>PERSEDIAAN (BAHAN BKAU + PRODUK)</th>
                            <th>HARGA TETAP</th>
                            <th>Pinjaman Bank</th>
                            <th>Pinjaman Koperasi</th>
                            <th>Pinjaman Lainnya</th>
                            <th>Sertifikat SHM</th>
                            <th>Tidak SHM</th>
                            <th>Omset 1 Tahun Lalu</th>
                            <th>Omset 2 Tahun Lalu</th>
                            <th>Laba 1 Tahun Lalu</th>
                            <th>Laba 2 Tahun Lalu</th>
                            <th>Laporan Reguler</th>
                            <th>Nama Produk 1</th>
                            <th>Deskripsi Produk 1</th>
                            <th>Harga Produk 1</th>
                            <th>Nama Produk 2</th>
                            <th>Deskripsi Produk 2</th>
                            <th>Harga Produk 2</th>
                            <th>Nama Produk 3</th>
                            <th>Deskripsi Produk 3</th>
                            <th>Harga Produk 3</th>
                            <th>Perizinan Produk</th>
                            <th>Perizinan Usaha IUMK</th>
                            <th>Perizinan Usaha SIUI</th>
                            <th>Perizinan Usaha SIUP</th>
                            <th>Legalitas Lokasi</th>
                            <th>Jangkauan Pemasaran</th>
                            <th>Pendampingan</th>
                            <th>Masalah Kelembagaan Usaha</th>
                            <th>Masalah SDM</th>
                            <th>Masalah Produksi</th>
                            <th>Masalah Pembiayaan</th>
                            <th>Masalah Pemasaran</th>
                            <th>Masalah Lainnya</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; ?>
                        @foreach($kumkm as $row)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{$row->id_kumkm}}</td>
                                <td>{{$row->nama_usaha}}</td>
                                <td>{{$row->nama_pemilik}}</td>
                                <td>{{$row->telp}}</td>
                                <td>{{$row->no_ktp}}</td>
                                <td>{{$row->npwp}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->badan_usaha}}</td>
                                <td>{{$row->ket_badan_usaha}}</td>
                                <td>{{$row->tgl_mulai_usaha}}</td>
                                <td>{{$row->bidangusaha?$row->bidangusaha->name:''}}</td>
                                <td>{{$row->skala_usaha}}</td>
                                <td>{{$row->usaha_utama}}</td>
                                <td>{{$row->hasil_produk}}</td>
                                <td>{{$row->sentra?'Ya':'Tidak'}}</td>
                                <td>{{$row->sentra_id}}</td>
                                <td>{{$row->tk_tetap}}</td>
                                <td>{{$row->tk_tidak_tetap}}</td>
                                <td>{{$row->alamat}}</td>
                                <td>{{$row->provinces->name}}</td>
                                <td>{{$row->regencies->name}}</td>
                                <td>{{$row->districts->name}}</td>
                                <td>{{$row->villages->name}}</td>
                                <td>{{$row->kas_tunai}}</td>
                                <td>{{$row->persediaan}}</td>
                                <td>{{$row->harga_tetap}}</td>
                                <td>{{$row->kw_bank}}</td>
                                <td>{{$row->kw_koperasi}}</td>
                                <td>{{$row->kw_lainnya}}</td>
                                <td>{{$row->kp_sertifikat}}</td>
                                <td>{{$row->kp_tidak_sertifikat}}</td>
                                <td>{{$row->om_1thn_lalu}}</td>
                                <td>{{$row->om_2thn_lalu}}</td>
                                <td>{{$row->lb_1thn_lalu}}</td>
                                <td>{{$row->lb_2thn_lalu}}</td>
                                <td>{{$row->laporan_regular?'Ya':'Tidak'}}</td>
                                <td>{{$row->p1_nama_produk}}</td>
                                <td>{{$row->p1_deskripsi}}</td>
                                <td>{{$row->p1_harga}}</td>
                                <td>{{$row->p2_nama_produk}}</td>
                                <td>{{$row->p2_deskripsi}}</td>
                                <td>{{$row->p2_harga}}</td>
                                <td>{{$row->p3_nama_produk}}</td>
                                <td>{{$row->p3_deskripsi}}</td>
                                <td>{{$row->p3_harga}}</td>
                                <td>{{$row->izin_produk}}</td>
                                <td>{{$row->izin_usaha_iumk}}</td>
                                <td>{{$row->izin_usaha_siui}}</td>
                                <td>{{$row->izin_usaha_siup}}</td>
                                <td>{{$row->legalitas_lokasi}}</td>
                                <td>{{$row->jangkauan_pasar}}</td>
                                <td>{{$row->terima_pendampingan}}</td>
                                <td>{{$row->masalah_lembaga}}</td>
                                <td>{{$row->masalah_sdm}}</td>
                                <td>{{$row->masalah_produksi}}</td>
                                <td>{{$row->masalah_pembiayaan}}</td>
                                <td>{{$row->masalah_pemasaran}}</td>
                                <td>{{$row->masalah_lainnya}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

