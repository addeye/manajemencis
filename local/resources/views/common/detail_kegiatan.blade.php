<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 17/02/2017
 * Time: 13:25
 */
?>

@if($data)
<div class="form-group">
    <label class="col-sm-2 control-label">Jenis Kegiatan :</label>
    <div class="col-sm-10">
        <p class="form-control-static">{{$data->jenis_kegiatan}}</p>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Indikator Kinerja Utama :</label>
    <div class="col-sm-10">
        <p class="form-control-static">{{$data->jenis_layanans->name}}</p>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Target Output:</label>
    <div class="col-sm-10">
        <p class="form-control-static">{{$data->output}} - {{$data->ket_output}}</p>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Jumlah Penerima:</label>
    <div class="col-sm-10">
        <p class="form-control-static">{{$data->jml_penerima}}</p>
    </div>
</div>
@endif