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
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{$title}}</h3>
                    </div>
                    <!-- / box Header -->
                    <div class="box-body">
                        <form method="post" action="{{ url('adm/lembaga/profil/'.$data->id.'/update') }}" class="form-horizontal">
                            <input type="hidden" name="_method" value="PUT">
                            {{ csrf_field() }}
                            <div class="callout callout-success">
                                <h4>Data Umum</h4>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">ID Lembaga*</label>
                                <div class="col-sm-3">
                                    <input type="text" name="idlembaga" class="form-control" placeholder="ID Lembaga.." value="{{ $data->idlembaga }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nama Lembaga*</label>
                                <div class="col-sm-5">
                                    <input type="text" name="name" class="form-control" placeholder="Nama Lembaga.." value="{{ $data->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Tingkat*</label>
                                <div class="col-sm-3">
                                    <select name="tingkat_id" class="form-control" required>
                                        <option value="">Pilih Tingkat</option>
                                        @foreach($tingkat as $row)
                                            <option value="{{ $row->id }}" {{ $data->tingkat_id==$row->id?'selected':'' }} >{{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Provinsi*</label>
                                <div class="col-sm-3">
                                    <select name="provinces_id" id="provinces" class="form-control" required>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinces as $row)
                                            <option value="{{ $row->id }}" {{ $data->provinces_id==$row->id?'selected':'' }} >{{ $row->id }} {{ $row->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="ajaxRegencies">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Kabupaten/Kota</label>
                                    <div class="col-md-5">
                                        <select class="form-control" name="regency_id">
                                            <option value="">Pilih Kabupaten/Kota</option>
                                            @foreach($regencies as $row)
                                                <option value="{{ $row->id }}" {{ $data->regency_id==$row->id?'selected':'' }}>{{ $row->id }} {{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Alamat</label>
                                <div class="col-sm-5">
                                    <textarea rows="3" class="form-control" name="alamat" placeholder="Alamat lembaga...">{{$data->alamat}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Kode Pos</label>
                                <div class="col-sm-2">
                                    <input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos.." value="{{$data->kode_pos}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Bentuk Lembaga</label>
                                <div class="col-sm-5">
                                    <input type="text" name="bentuk_lembaga" class="form-control" placeholder="Bentuk Lembaga.." value="{{$data->bentuk_lembaga}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">SKPD Penanggungjawab</label>
                                <div class="col-sm-5">
                                    <input type="text" name="SKPD" class="form-control" placeholder="SKPD penanggungjawab.." value="{{$data->SKPD}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Tahun Berdiri*</label>
                                <div class="col-sm-2">
                                    <input type="text" name="tahun_berdiri" class="form-control" placeholder="Tahun.." value="{{$data->tahun_berdiri}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Telepon</label>
                                <div class="col-sm-3">
                                    <input type="text" name="telepon" class="form-control" placeholder="Telepon.." value="{{ $data->telepon }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email Address.." value="{{$data->email}}">
                                </div>
                            </div>
                            <div class="callout callout-info">
                                <h4>Data Pimpinan</h4>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nama Pimpinan</label>
                                <div class="col-sm-3">
                                    <input type="text" name="nama_pimpinan" class="form-control" placeholder="Nama Pimpinan.." value="{{ $data->nama_pimpinan }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Telepon Pimpinan</label>
                                <div class="col-sm-3">
                                    <input type="text" name="telepon_pimpinan" class="form-control" placeholder="Telepon Pimpinan.." value="{{ $data->telepon_pimpinan }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email Pimpinan</label>
                                <div class="col-sm-3">
                                    <input type="text" name="email_pimpinan" class="form-control" placeholder="Email Address.." value="{{ $data->email_pimpinan }}">
                                </div>
                            </div>
                            <div class="callout callout-warning">
                                <h4>Data Admin</h4>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nama Admin</label>
                                <div class="col-sm-3">
                                    <input type="text" name="nama_admin" class="form-control" placeholder="Nama Admin.." value="{{$data->nama_admin}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Telepon Pimpinan</label>
                                <div class="col-sm-3">
                                    <input type="text" name="telepon_admin" class="form-control" placeholder="Telepon Admin.." value="{{$data->telepon_admin}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email Admin</label>
                                <div class="col-sm-3">
                                    <input type="text" name="email_admin" class="form-control" placeholder="Email Address.." value="{{ $data->email_admin }}">
                                </div>
                            </div>
                            <div class="callout callout-warning">
                                <h4>Data Staff Galery</h4>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nama Staf Galery</label>
                                <div class="col-sm-3">
                                    <input type="text" name="nama_staffgalery" class="form-control" placeholder="Nama Staf Galery.." value="{{ $data->nama_staffgalery }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Telepon Staf Galery</label>
                                <div class="col-sm-3">
                                    <input type="text" name="telepon_staffgalery" class="form-control" placeholder="Telepon Staf Galery.." value="{{ $data->telepon_staffgalery }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email Staf Galery</label>
                                <div class="col-sm-3">
                                    <input type="text" name="email_staffgalery" class="form-control" placeholder="Email Address.." value="{{ $data->email_staffgalery }}">
                                </div>
                            </div>
                            <div class="callout callout-warning">
                                <h4>Data Staff Dukungan Layanan Teknis</h4>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Nama Staf Dukungan Teknis</label>
                                <div class="col-sm-3">
                                    <input type="text" name="nama_staffteknis" class="form-control" placeholder="Nama staf dukungan teknis.." value="{{ $data->nama_staffteknis }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Telepon Staff Galery</label>
                                <div class="col-sm-3">
                                    <input type="text" name="telepon_staffteknis" class="form-control" placeholder="Telepon staf teknis dukungan.." value="{{$data->telepon_staffteknis}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Email Staf Dukungan Teknis</label>
                                <div class="col-sm-3">
                                    <input type="text" name="email_staffteknis" class="form-control" placeholder="Email Address.." value="{{$data->email_staffteknis}}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-default">Simpan</button>
                                    <button type="button" onclick="history.go(-1);" class="btn btn-default">Kembali</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="urlregencies" value="{{ url('common/regencies') }}">
    @endsection

    @section('script')
        <script>
            urlregencies = $('#urlregencies').val();
            $('#provinces').change(function(){
                $.ajax({
                    url: urlregencies+'/'+this.value,
                    type : 'GET',
                    cache : false,
                    dataType : 'html'
                })
                        .success(function(response){
                            $('#ajaxRegencies').html(response);
                        })
            });
        </script>
    @endsection