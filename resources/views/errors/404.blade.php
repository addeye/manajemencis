<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 02/03/2017
 * Time: 13:48
 */
?>
@extends('layouts.beranda.master')
@section('content')
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Maaf Halaman Tidak Ditemukan.</h3>
            <p>
                Kami tidak bisa menemukan halaman yang dicari.
                Silahkan, Anda Bisa <a href='{{url('/')}}'>Kembali Ke Halaman Utama</a>.
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
    @endsection
