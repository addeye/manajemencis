<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 21/02/2017
 * Time: 11:52
 */
?>
<div class="form-group">
    <label class="col-sm-2 control-label">Kategori IKU</label>
    <div class="col-sm-10">
        <p class="form-control-static">{{strtoupper($kategori_iku)}}</p>
    </div>
</div>
<div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Target / Keterangan</label>
    <div class="col-sm-2">
        <input type="{{$type}}" name="output" class="form-control" placeholder="{{$placeholder}}" required>
    </div>
    <div class="col-sm-3">
        <input type="text" name="ket_output" class="form-control" placeholder="Keterangan.." required>
    </div>
</div>
