<form class="form-inline" style="padding-bottom: 10px;">
    <div class="form-group">
        <select class="form-control" id="tahun" name="tahun">
            <option value="">Pilih Tahun</option>
            <option value="2020" {{Request::get('tahun')=='2020'?'selected':''}}>2020</option>
            <option value="2019" {{Request::get('tahun')=='2019'?'selected':''}}>2019</option>
            <option value="2018" {{Request::get('tahun')=='2018'?'selected':''}}>2018</option>
            <option value="2017" {{Request::get('tahun')=='2017'?'selected':''}}>2017</option>
        </select>
    </div>
    <div class="form-group">
        <select class="form-control" id="triwulan" name="triwulan">
            <option value="">Pilih</option>
            <option value="tw1">Triwulan 1</option>
            <option value="tw2">Triwulan 2</option>
            <option value="tw3">Triwulan 3</option>
            <option value="tw4">Triwulan 4</option>
        </select>
    </div>
    <div class="form-group" id="konsultan-select">
        <select name="konsultan_id" id="conten-konsultan" class="form-control select2">
            <option value="">Pilih Konsultan</option>
        </select>
    </div>
    <button type="button" class="btn btn-primary" onclick="showTriwulan()"><i class="fa fa-search"></i> Cari</button>
</form>