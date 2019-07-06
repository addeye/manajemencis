<form class="form-inline" style="padding-bottom: 10px;">
    <div class="form-group">
        <select class="form-control" id="tahun" name="tahun">
            <option value="">Pilih Tahun</option>
            <option value="2018" {{Request::get('tahun')=='2018'?'selected':''}}>2018</option>
            <option value="2017" {{Request::get('tahun')=='2017'?'selected':''}}>2017</option>
        </select>
    </div>
    <div class="form-group" id="konsultan-select">
        <select name="konsultan_id" id="conten-konsultan" class="form-control select2">
            <option value="">Pilih Konsultan</option>
        </select>
    </div>
    <button type="button" class="btn btn-primary" onclick="showTahunan()"><i class="fa fa-search"></i> Cari</button>
</form>