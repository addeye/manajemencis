<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prores Data PLUT</title>
    <style type="text/css">
        body{
            margin: auto;
        }

        table {
            border: 1px solid;
            border-collapse: collapse;
            width: 100%;
            margin: 0 auto;
            text-align: left;
        }

        tr th {
            background: grey;
            border: 1px solid;
            text-align: center;
        }
        tr td {
            border: 1px solid;
        }
        caption {
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
        <caption><h1>Progres Data PLUT</h1></caption>
    <thead>
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2" width="500">Nama PLUT</th>
            <th colspan="3">Jumlah</th>
            <th colspan="7">Laporan Per Bidang</th>
            <th>Total</th>
        </tr>
        <tr>
            <th>KUMKM</th>
            <th>Sentra KUMKM</th>
            <th>Produk Unggulan</th>
            <th>Kelem<br>bagaan</th>
            <th>SDM</th>
            <th>Pro<br>duksi</th>
            <th>Pembi<br>ayaan</th>
            <th>Pema<br>saran</th>
            <th>IT</th>
            <th>Kerja<br>sama</th>
            <th>Laporan Kegiatan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;?>
        @foreach ($data as $row)
            <tr>
                <td align="center">{{$no++}}</td>
                <td>{{$row->plut_name}}</td>
                <td align="center">{{$row->kumkm_count}}</td>
                <td align="center">{{$row->sentra_kumkm_count}}</td>
                <td align="center">{{$row->produk_unggulan_count}}</td>
                <td align="center">{{$row->kegiatan_by_kelembagaan_count}}</td>
                <td align="center">{{$row->kegiatan_by_sdm_count}}</td>
                <td align="center">{{$row->kegiatan_by_produksi_count}}</td>
                <td align="center">{{$row->kegiatan_by_pembiayaan_count}}</td>
                <td align="center">{{$row->kegiatan_by_pemasaran_count}}</td>
                <td align="center">{{$row->kegiatan_by_it_count}}</td>
                <td align="center">{{$row->kegiatan_by_kerjasama_count}}</td>
                <td align="center">{{$row->total_kegiatan_count}}</td>
            </tr>
        @endforeach
    </tbody>

</table>
</body>
</html>