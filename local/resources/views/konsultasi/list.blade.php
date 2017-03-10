<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 09/03/2017
 * Time: 16:16
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
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                        <tbody>
                        @foreach($konsultasi as $row)
                            <tr>
                                <td>
                                    <p>{{$row->nama}}</p>
                                    <p>{{$row->alamat}}</p>
                                    <p>{{$row->alamat}}</p>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
