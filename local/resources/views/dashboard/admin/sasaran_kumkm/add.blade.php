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
                    <div class="pull-right">
                            <a href="{{ url('sasaran-kumkm') }}" class="btn btn-warning"><i class="fa fa-list"></i> UMKM Terdaftar</a>
                        </div>
                </div>
                <!-- / box Header -->
                <div class="box-body table-responsive">
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" name="nama" class="form-control" placeholder="Nama UMKM" value="{{$nama}}">
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
                        <a href="{{ url('sasaran-kumkm/create') }}" class="btn btn-info"><i class="fa fa-refresh"></i></a>
                    </form>
                    <br>
                    <form class="form-inline" method="post" action="{{ url('sasaran-kumkm') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> SEMUA</button>
                    <div>Showing {{($data->currentpage()-1)*$data->perpage()+1}} to {{$data->currentpage()*$data->perpage()}}
                        of  {{$data->total()}} entries
                    </div>
                    <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th rowspan="2"><i class="fa fa-plus"></i></th>
                                <th rowspan="2"><input id="checkAll" type="checkbox"></th>
                                <th rowspan="2">Nama UMKM</th>
                                <th rowspan="2">Alamat</th>
                                <th rowspan="2">Tahun<br>Mulai Usaha</th>
                                <th rowspan="2">Jenis Usaha</th>
                                <th rowspan="2">Legalitas</th>
                                <th rowspan="2">Tenaga<br>Kerja(orang)</th>
                                <th colspan="2">Permodalan</th>
                                <th rowspan="2">Asset</th>
                                <th rowspan="2">Omset</th>
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
                                            <a href="{{ url('sasaran-kumkm-daftar/'.$row->id) }}" onclick="return confirm('Anda yakin ?')" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i></a>
                                        </form>
                                        </td>
                                        <td align="center"><input type="checkbox" name="kumkm_id[]" class="checkUser" value="{{$row->id}}"></td>
                                        <td>{{$row->nama_usaha}}</td>
                                        <td>{{$row->alamat}}</td>
                                        <td>{{$row->tgl_mulai_usaha}}</td>
                                        <td>{{$row->bidangusaha?$row->bidangusaha->name:''}}</td>
                                        <td>{{$row->badan_usaha}}</td>
                                        <td>{{isset($row->kumkm_detail[0])?$row->kumkm_detail[0]->jml_tenaga_kerja:''}}</td>
                                        <td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_sendiri):''}}</td>
                                        <td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->modal_hutang):''}}</td>
                                        <td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->asset):''}}</td>
                                        <td>{{isset($row->kumkm_detail[0])?number_format($row->kumkm_detail[0]->omset):''}}</td>
                                        <td>{{isset($row->kumkm_detail[0])?$row->kumkm_detail[0]->kegiatan_usaha:''}}</td>
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
