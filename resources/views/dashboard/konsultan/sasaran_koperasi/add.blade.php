@extends('layouts.master')

@section('css')
<style type="text/css">
    tr th {
        text-align: center;
    }
</style>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            @include('layouts.alert')
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Pendaftaran {{date('Y')}}</h3>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" placeholder="Nama Koperasi" value="{{$nama}}">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                        <a href="{{ url('sasaran-koperasi/create') }}" class="btn btn-info"><i class="fa fa-refresh"></i></a>
                    </form>
                    <br>
                    <form class="form-inline" method="post" action="{{ url('sasaran-koperasi') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Tambah Semua</button>
                        <div class="pull-right">
                            <a href="{{ url('sasaran-koperasi') }}" class="btn btn-warning btn-xs"><i class="fa fa-list"></i> Kembali ke sebelumnya</a>
                        </div>
                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                        of  {{$data->total()}} entries
                    </div>
                    <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th rowspan="2"><i class="fa fa-plus"></i></th>
                                <th rowspan="2">Centang Semua<br><input id="checkAll" type="checkbox"></th>
                                <th rowspan="2">Nama Koperasi</th>
                                <th rowspan="2">Alamat</th>
                                <th rowspan="2">Nomor dan Tanggal Badan Hukum</th>
                                <th rowspan="2">Jenis Koperasi</th>
                                <th rowspan="2">Tanggal RAT Tahun Buku</th>
                                <th rowspan="2">Anggota</th>
                                <th rowspan="2">Karyawan</th>
                                <th rowspan="2">Asset</th>
                                <th colspan="2">Permodalan</th>
                                <th rowspan="2">Volume Usaha</th>
                                <th rowspan="2">Sisa Hasil Usaha</th>
                                <th rowspan="2">Kegiatan Usaha</th>
                            </tr>
                            <tr>
                                <th>Modal Sendiri</th>
                                <th>Modal Luar</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $no = ($data->currentpage() - 1) * $data->perpage() + 1;?>
                                @foreach ($data as $row)
                                    <tr>
                                        <td align="center">
                                            <a href="{{ url('sasaran-koperasi-daftar/'.$row->id) }}" onclick="return confirm('Anda yakin ?')" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
                                        </form>
                                        </td>
                                        <td align="center"><input type="checkbox" name="koperasi_id[]" class="checkUser" value="{{$row->id}}"></td>
                                        <td>{{$row->nama_koperasi}}</td>
                                        <td>{{$row->alamat}}</td>
                                        <td>{{$row->nomor_badan_hukum}} & {{$row->tgl_badan_hukum}}</td>
                                        <td>{{$row->jenis_koperasi}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?$row->koperasi_detail[0]->tgl_rat_tahun_buku:''}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?$row->koperasi_detail[0]->jml_anggota:''}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?$row->koperasi_detail[0]->jml_karyawan:''}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_asset):''}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_modal_sendiri):''}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->jml_modal_luar):''}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->valume_usaha):''}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?number_format($row->koperasi_detail[0]->sisa_hasil):''}}</td>
                                        <td>{{isset($row->koperasi_detail[0])?$row->koperasi_detail[0]->kegiatan_usaha:''}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                    </table>
                    <div class="text-center">
                {{$data->appends($_GET)->links()}}
            </div>
            </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{url('js/jquery.printPage.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.btn-print').printPage();

        $("#checkAll").change(function() {
            if(this.checked) {
                $('.checkUser').prop('checked',true);
            }
            else
            {
              $('.checkUser').prop('checked',false);
            }
        });
    });
</script>
@endsection
