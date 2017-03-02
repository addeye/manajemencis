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
                    <form method="post" action="{{ url('adm/lembaga/profil/'.$data->id.'/update') }}"
                          class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" name="_method" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">ID Lembaga</label>

                            <div class="col-sm-5">
                                <input type="text" name="id_lembaga" class="form-control" value="{{$data->id_lembaga}}"
                                       placeholder="ID Lembaga.." readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">SKPD Penanggungjawab</label>

                            <div class="col-sm-5">
                                <input type="text" name="skpd_name" value="{{$data->skpd_name}}" class="form-control"
                                       placeholder="Nama SKPD.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-5">
                                <textarea class="form-control" name="skpd_alamat" placeholder="Alamat SKPD.." rows="4"
                                          required>{{$data->skpd_alamat}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-5">
                                <input type="text" name="skpd_telp" value="{{$data->skpd_telp}}" class="form-control"
                                       placeholder="No Telepon SKPD.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-3">
                                <input type="text" name="skpd_email" value="{{$data->skpd_email}}" class="form-control"
                                       placeholder="Email SKPD.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-3">
                                <input type="text" name="skpd_whatsapp" value="{{$data->skpd_whatsapp}}"
                                       class="form-control" placeholder="Whatsapp SKPD.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Nama PLUT-KUMKM</label>

                            <div class="col-sm-5">
                                <input type="text" name="plut_name" class="form-control" value="{{$data->plut_name}}"
                                       placeholder="Nama PLUT-KUMKM.." readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-5">
                                <input type="text" name="plut_bentuk_kelembagaan"
                                       value="{{$data->plut_bentuk_kelembagaan}}" class="form-control"
                                       placeholder="Bentuk Kelembagaan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Provinsi</label>

                            <div class="col-sm-5">
                                <select name="provinces_id" id="provinces" class="form-control select2" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinces as $row)
                                        <option value="{{ $row->id }}" {{ $data->provinces_id==$row->id?'selected':'' }}>{{ $row->id }} {{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="ajaxRegencies"></div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-5">
                                <textarea class="form-control" name="plut_alamat" placeholder="Alamat PLUT.."
                                          required>{{$data->plut_alamat}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-5">
                                <input type="text" name="plut_telp" class="form-control" value="{{$data->plut_telp}}"
                                       placeholder="No Telp PLUT.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-3">
                                <input type="text" name="plut_email" class="form-control" value="{{$data->plut_email}}"
                                       placeholder="Email PLUT.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-3">
                                <input type="text" name="plut_whatsapp" class="form-control"
                                       value="{{$data->plut_whatsapp}}" placeholder="Whatsapp PLUT.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-3">
                                <input type="text" name="plut_website" class="form-control"
                                       value="{{$data->plut_website}}" placeholder="Website PLUT.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-3">
                                <input type="text" name="plut_facebook" class="form-control"
                                       value="{{$data->plut_facebook}}" placeholder="Url Facebook PLUT.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tahun Perolehan</label>

                            <div class="col-xs-4">
                                <input value="{{$data->tahun_perolehan}}" type="text" name="tahun_perolehan"
                                       class="form-control" placeholder="Tahun Perolehan.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mulai Opersional</label>

                            <div class="col-xs-10 col-sm-4 col-md-4">
                                <input value="{{$data->mulai_operasional}}" type="text" name="mulai_operasional"
                                       class="form-control" placeholder="Mulai Operasional.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Peresmian</label>

                            <div class="col-sm-3">
                                <input type="date" value="{{$data->tgl_peresmian}}" name="tgl_peresmian"
                                       class="form-control" placeholder="Tanggal Peresmian..">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Diresmikan Oleh</label>

                            <div class="col-sm-5">
                                <input type="text" name="diresmikan_oleh" value="{{$data->diresmikan_oleh}}"
                                       class="form-control" placeholder="Diresmikan oleh.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Hibah Tahun</label>

                            <div class="col-sm-1">
                                <input value="{{$data->hibah_tahun}}" type="text" name="hibah_tahun"
                                       class="form-control" placeholder="Url Facebook PLUT.." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Telah bersinergi dengan pihak</label>

                            <div class="col-sm-5">
                                <textarea class="form-control" name="ket_bersinergi"
                                          placeholder="Sebutkan Program dan Kegiatannya"
                                          required>{{$data->ket_bersinergi}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Produk Unggulan Daerah</label>

                            <div class="col-sm-5">
                                <textarea name="produk_unggulan" class="form-control"
                                          placeholder="Produk unggulan daerah.." rows="4"
                                          required>{{$data->produk_unggulan}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Masuk Pasar Lokal/Nasional/Ekspor</label>

                            <div class="col-sm-5">
                                <input type="text" name="pemasaran" class="form-control" value="{{$data->pemasaran}}"
                                       placeholder="Yang sudah branding dan masuk pasar Lokal/Nasional/Ekspor.."
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Produk Lain Potensial</label>

                            <div class="col-sm-5">
                                <textarea name="produk_potensial" class="form-control"
                                          placeholder="Produk lain yang potensial.."
                                          required>{{$data->produk_potensial}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-3">
                                <input type="number" name="jml_umkm_ecommarce" value="{{$data->jml_umkm_ecommarce}}"
                                       class="form-control" placeholder="Jumlah UMKM e-commarce" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>

                            <div class="col-sm-3">
                                <input type="number" name="jml_produk_online" class="form-control"
                                       value="{{$data->jml_produk_online}}" placeholder="Jumlah produk secara on-line">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Photo Gedung CIS PLUT-KUMKM</label>

                            <div class="col-sm-5">
                                <img class="img-responsive" src="{{url('images/'.$data->photo_gedung)}}">
                                <input type="file" name="photo_gedung" class="form-control"
                                       placeholder="Tampak dari luar secara utuh dan terbar">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">Update</button>
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
            <!-- InputMask -->
    <script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ url('admin-lte/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $(".datemaskyear").inputmask("9999", {"placeholder": "yyyy"});
            urlregencies = $('#urlregencies').val();
            $('#provinces').change(function () {
                $.ajax({
                    url: urlregencies + '/' + this.value,
                    type: 'GET',
                    cache: false,
                    dataType: 'html'
                })
                        .success(function (response) {
                            $('#ajaxRegencies').html(response);
                            $(".select2").select2({
                                theme: "bootstrap"
                            });
                        })
            });
        });
    </script>
@endsection