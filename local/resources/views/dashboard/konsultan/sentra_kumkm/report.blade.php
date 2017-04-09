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
								<th>Sentra ID</th>
								<th>Lembaga</th>
								<th>Nama</th>
								<th>Tahun Beridiri</th>
								<th>UMKM</th>
								<th>Pegawai</th>
								<th>Omset/bln</th>
								<th>Teknologi</th>
								<th>Bahan Baku</th>
								<th>Pemasaran</th>
								<th>Kemitraan</th>
								<th>Nama Ketua</th>
								<th>No Telp Ketua</th>
								<th>Email Ketua</th>
								<th>Kontak Person</th>
								<th>Telp Kontak Person</th>
								<th>Email Kontak Person</th>
								<th>Pembina Kementrian</th>
								<th>Pembina Bidang</th>
								<th>Tenaga Pendamping</th>
								<th>Masalah Kelembagaan</th>
								<th>Masalah SDM</th>
								<th>Masalah Produksi</th>
								<th>Masalah Pembiayaan</th>
								<th>Masalah Pemasaran</th>
							</tr>
						</thead>
						<tbody>
						<?php $no=1; ?>
							@foreach($data as $row)
							<tr>
								<td>{{$no++}}</td>
								<td>{{$row->id_sentra}}</td>
								<td>{{$row->lembagas->plut_name}}</td>
								<td>{{$row->name}}</td>
								<td>{{$row->tahun_berdiri}}</td>
								<td>{{$row->total_umkm}}</td>
								<td>{{$row->total_pegawai}}</td>
								<td>{{$row->omset_bulan}}</td>
								<td>{{$row->teknologi}}</td>
								<td>{{$row->bahan_baku}}</td>
								<td>{{$row->pemasaran}}</td>
								<td>{{$row->kemitraan}}</td>
								<td>{{$row->nama_ketua}}</td>
								<td>{{$row->notelp_ketua}}</td>
								<td>{{$row->email_ketua}}</td>
								<td>{{$row->name_cp}}</td>
								<td>{{$row->no_cp}}</td>
								<td>{{$row->email_cp}}</td>
								<td>{{$row->pembina_kementrian}}</td>
								<td>{{$row->pembina_bidang}}</td>
								<td>{{$row->pembina_tenaga_pendamping}}</td>
								<td>{{$row->masalah_kelembagaan}}</td>
								<td>{{$row->masalah_sdm}}</td>
								<td>{{$row->masalah_produksi}}</td>
								<td>{{$row->masalah_pembiayaan}}</td>
								<td>{{$row->masalah_pemasaran}}</td>
							</tr>
							 @endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection