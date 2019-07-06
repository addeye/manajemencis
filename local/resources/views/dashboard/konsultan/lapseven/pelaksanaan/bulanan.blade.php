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
        <select class="form-control" id="bulan" name="bulan">
            <option value="">Pilih Bulan</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
        </select>
    </div>
    <div class="form-group" id="konsultan-select">
        <select name="konsultan_id" id="conten-konsultan" class="form-control select2">
            <option value="">Pilih Konsultan</option>
        </select>
    </div>
    <button type="button" class="btn btn-primary" onclick="showBulanan()"><i class="fa fa-search"></i> Cari</button>
</form>