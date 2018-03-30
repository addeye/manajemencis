<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 31/03/2017
 * Time: 15:27
 */
?>
@extends('layouts.master')

@section('content')

    <div class="row">
    <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <select name="lembaga_id" class="form-control select2">
                                <option value="semua">Pilih Semua Lembaga</option>
                                @foreach($lembaga as $row)
                                    <option value="{{$row->id}}" {{$lembaga_id==$row->id?'selected':''}}>{{$row->plut_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-info">Cari</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$title}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                        of  {{$data->total()}} entries
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Lock</th>
                                <th class="col-xs-1">No</th>
                                <th>Tahun</th>
                                <th>Lembaga</th>
                                <th>Kegiatan</th>
                                <th>Tujuan</th>
                                <th>Sasaran</th>
                                <th>Jumlah Sasaran</th>
                                <th>Indikator</th>
                                <th>Output</th>
                                <th>Anggaran</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
                            @foreach($data as $row)
                            <tr>
                                <td>
                                    <a href="{{ url('proker-plut-status/'.$row->id.'/'.$row->status_lock) }}" onclick="return confirm('Apakah anda yakin ?')" class="btn {{$row->status_lock=='Yes'?'btn-success':'btn-danger'}}">
                                        {{$row->status_lock}}
                                    </a>
                                </td>
                                <td>{{$no++}}</td>
                                <td>{{$row->tahun_kegiatan}}</td>
                                <td>{{$row->lembagas->plut_name}}</td>
                                <td>{{$row->program}}</td>
                                <td>{{$row->tujuan}}</td>
                                <td>{{$row->sasaran}}</td>
                                <td>{{$row->jumlah_sasaran}}</td>
                                <td>{{$row->indikator}}</td>
                                <td>{{$row->output}}</td>
                                <td>
                                    <ul>
                                    @foreach ($row->proker_anggaran as $angg)
                                        <li>{{$angg->anggaran->nama}}</li>
                                    @endforeach
                                    </ul>
                                </td>
                            </tr>
                             @endforeach
                        </tbody>

                    </table>
                    <div class="text-center">
                {{$data->appends($_GET)->links()}}
            </div>
                </div>
            </div>
        </div>
    </div>
@endsection
