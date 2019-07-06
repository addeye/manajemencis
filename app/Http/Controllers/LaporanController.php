<?php

namespace App\Http\Controllers;

use App\Admin_lembaga;
use App\Cis_lembaga;
use App\Details_proker;
use App\ProdukUnggulan;
use App\Proker_konsultan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function getProduk()
    {
        $data = [
            'produk' => ProdukUnggulan::all(),
            'title' => 'Laporan Produk',
            'lembaga' => Cis_lembaga::all(),
        ];
        return view('laporan.laporan_produk', $data);
    }

    public function getProdukExcel()
    {
        $lembaga = \Request::input('lembaga');
        if ($lembaga != 'semua') {
            $datalembaga = Cis_lembaga::find($lembaga);
            $namefile = 'PRODUK_UNGGULAN_MANAJEMEN_CIS_' . $datalembaga->plut_name;
            $datarow = DB::table('produk_unggulan')
                ->leftJoin('cis_lembagas', 'produk_unggulan.lembaga_id', '=', 'cis_lembagas.id')
                ->leftJoin('provinces', 'produk_unggulan.provinces_id', '=', 'provinces.id')
                ->leftJoin('regencies', 'produk_unggulan.regency_id', '=', 'regencies.id')
                ->leftJoin('sentra_kumkms', 'produk_unggulan.sentra_id', '=', 'sentra_kumkms.id')
                ->leftJoin('bidang_usahas', 'produk_unggulan.bidang_usaha', '=', 'bidang_usahas.id')
                ->where('produk_unggulan.lembaga_id', '=', $lembaga)
                ->select(
                    'cis_lembagas.id_lembaga AS ID_lembaga',
                    'cis_lembagas.plut_name AS Lembaga',
                    'produk_unggulan.nama_produk AS Nama_produk',
                    'produk_unggulan.merek AS Merek',
                    'bidang_usahas.name AS Bidang_usaha',
                    'produk_unggulan.satuan AS Satuan',
                    'produk_unggulan.kapasitas_perbulan AS Kapasitas_perbulan',
                    'produk_unggulan.omset_perbulan AS Omset_perbulan',
                    'produk_unggulan.nama_pemilik AS Owner',
                    'produk_unggulan.nama_perusahaan AS Perusahaan',
                    'produk_unggulan.alamat AS Alamat',
                    'provinces.name AS Provinsi',
                    'regencies.name AS Kab/Kota',
                    'produk_unggulan.telp AS No_telp',
                    'produk_unggulan.email AS Email',
                    'produk_unggulan.sentra AS Sentra',
                    'sentra_kumkms.id_sentra AS Sentra_ID',
                    'sentra_kumkms.name AS Nama_sentra',
                    'produk_unggulan.legalitas AS Legalitas'
                )
                ->get();
        } else {
            $namefile = 'PRODUK_UNGGULAN_MANAJEMEN_CIS_SEMUA_LEMBAGA';
            $datarow = DB::table('produk_unggulan')
                ->leftJoin('cis_lembagas', 'produk_unggulan.lembaga_id', '=', 'cis_lembagas.id')
                ->leftJoin('provinces', 'produk_unggulan.provinces_id', '=', 'provinces.id')
                ->leftJoin('regencies', 'produk_unggulan.regency_id', '=', 'regencies.id')
                ->leftJoin('sentra_kumkms', 'produk_unggulan.sentra_id', '=', 'sentra_kumkms.id')
                ->leftJoin('bidang_usahas', 'produk_unggulan.bidang_usaha', '=', 'bidang_usahas.id')
                ->select(
                    'cis_lembagas.id_lembaga AS ID_lembaga',
                    'cis_lembagas.plut_name AS Lembaga',
                    'produk_unggulan.nama_produk AS Nama_produk',
                    'produk_unggulan.merek AS Merek',
                    'bidang_usahas.name AS Bidang_usaha',
                    'produk_unggulan.satuan AS Satuan',
                    'produk_unggulan.kapasitas_perbulan AS Kapasitas_perbulan',
                    'produk_unggulan.omset_perbulan AS Omset_perbulan',
                    'produk_unggulan.nama_pemilik AS Owner',
                    'produk_unggulan.nama_perusahaan AS Perusahaan',
                    'produk_unggulan.alamat AS Alamat',
                    'provinces.name AS Provinsi',
                    'regencies.name AS Kab/Kota',
                    'produk_unggulan.telp AS No_telp',
                    'produk_unggulan.email AS Email',
                    'produk_unggulan.sentra AS Sentra',
                    'sentra_kumkms.id_sentra AS Sentra_ID',
                    'sentra_kumkms.name AS Nama_sentra',
                    'produk_unggulan.legalitas AS Legalitas'
                )
                ->get();
        }

        foreach ($datarow as $object) {
            $data[] = (array) $object;
        }
        if (isset($data) && count($data)) {
            return Excel::create($namefile, function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xlsx');
        }

        return redirect('laporan-produk')->with('error', 'Maaf ! Data tidak ada');
    }

    public function getAdminLembaga()
    {
        $data = [
            'admin' => Admin_lembaga::all(),
            'title' => 'Laporan Admin Lembaga',
        ];
        return view('laporan.laporan_admin', $data);
    }

    public function getAdminLembagaExcel()
    {
    }

    public function getKegiatanKonsultan()
    {
        $tanggal_mulai = Input::get('tanggal_mulai');
        $tanggal_selesai = Input::get('tanggal_selesai');

        $tanggal_mulai_db = date('Y-m-d', strtotime($tanggal_mulai));
        $tanggal_selesai_db = date('Y-m-d', strtotime($tanggal_selesai));

        if ($tanggal_mulai && $tanggal_selesai) {
            $kegiatan = DB::table('kegiatan_konsultans')
            ->leftJoin('konsultans', 'kegiatan_konsultans.konsultan_id', '=', 'konsultans.id')
            ->leftJoin('bidang_layanans', 'konsultans.bidang_layanan_id', '=', 'bidang_layanans.id')
            ->leftJoin('cis_lembagas', 'konsultans.lembaga_id', '=', 'cis_lembagas.id')
            ->leftJoin('bidang_usahas', 'kegiatan_konsultans.bidang_usaha_id', '=', 'bidang_usahas.id')
            ->leftJoin('proker_konsultans', 'kegiatan_konsultans.proker_id', '=', 'proker_konsultans.id')
            ->leftJoin('details_prokers', 'kegiatan_konsultans.detail_proker_id', '=', 'details_prokers.id')
            ->select('kegiatan_konsultans.*', 'konsultans.nama_lengkap', 'cis_lembagas.plut_name', 'bidang_usahas.name', 'proker_konsultans.program', 'bidang_layanans.name AS bidang_layanan')
            ->whereBetween('tanggal_mulai', [$tanggal_mulai_db, $tanggal_selesai_db])
            ->paginate(10);
        } else {
            $kegiatan = DB::table('kegiatan_konsultans')
            ->leftJoin('konsultans', 'kegiatan_konsultans.konsultan_id', '=', 'konsultans.id')
            ->leftJoin('bidang_layanans', 'konsultans.bidang_layanan_id', '=', 'bidang_layanans.id')
            ->leftJoin('cis_lembagas', 'konsultans.lembaga_id', '=', 'cis_lembagas.id')
            ->leftJoin('bidang_usahas', 'kegiatan_konsultans.bidang_usaha_id', '=', 'bidang_usahas.id')
            ->leftJoin('proker_konsultans', 'kegiatan_konsultans.proker_id', '=', 'proker_konsultans.id')
            ->leftJoin('details_prokers', 'kegiatan_konsultans.detail_proker_id', '=', 'details_prokers.id')
            ->select('kegiatan_konsultans.*', 'konsultans.nama_lengkap', 'cis_lembagas.plut_name', 'bidang_usahas.name', 'proker_konsultans.program', 'bidang_layanans.name AS bidang_layanan')
            ->paginate(10);
        }

        $data = [
            'kegiatan' => $kegiatan,
            'title' => 'Laporan Kegiatan',
            'lembaga' => Cis_lembaga::all(),
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai
        ];
        // return $data;
        return view('laporan.laporan_kegiatan', $data);
    }

    public function getKegiatanKonsultanExcel()
    {
        $lembaga = \Request::input('lembaga');
        if ($lembaga != 'semua') {
            $datalembaga = Cis_lembaga::find($lembaga);
            $namefile = 'KEGIATAN_KONSULTAN_MANAJEMEN_CIS_' . $datalembaga->plut_name;
            $datarow = DB::table('kegiatan_konsultans')
                ->leftJoin('konsultans', 'kegiatan_konsultans.konsultan_id', '=', 'konsultans.id')
                ->leftJoin('bidang_layanans', 'konsultans.bidang_layanan_id', '=', 'bidang_layanans.id')
                ->leftJoin('cis_lembagas', 'konsultans.lembaga_id', '=', 'cis_lembagas.id')
                ->leftJoin('bidang_usahas', 'kegiatan_konsultans.bidang_usaha_id', '=', 'bidang_usahas.id')
                ->leftJoin('proker_konsultans', 'kegiatan_konsultans.proker_id', '=', 'proker_konsultans.id')
                ->leftJoin('details_prokers', 'kegiatan_konsultans.detail_proker_id', '=', 'details_prokers.id')
                ->where('konsultans.lembaga_id', '=', $lembaga)
                ->select(
                    'cis_lembagas.plut_name AS Lembaga',
                    'konsultans.nama_lengkap AS Nama_Konsultan',
                    'bidang_layanans.name AS Bidang_Pendampingan',
                    'kegiatan_konsultans.created_at AS Tanggal_Pelaporan',
                    'kegiatan_konsultans.tanggal_mulai AS Tanggal_Mulai',
                    'kegiatan_konsultans.tanggal_selesai AS Tanggal_Selesai',
                    'kegiatan_konsultans.judul_kegiatan AS Nama_Kegiatan',
                    'bidang_usahas.name AS Bidang_Usaha',
                    'kegiatan_konsultans.lokasi_kegiatan AS Lokasi_Kegiatan',
                    'kegiatan_konsultans.jumlah_peserta AS Jumlah_Peserta',
                    'kegiatan_konsultans.output AS Output',
                    'kegiatan_konsultans.ket_output AS Keterangan',
                    'kegiatan_konsultans.sumber_daya AS Sumber_Daya',
                    'kegiatan_konsultans.mitra_kegiatan AS Mitra_Kegiatan',
                    'kegiatan_konsultans.rencana_tindak_lanjut AS Rencana_Tindak_Lanjut'
                )
                ->get();
        } else {
            $namefile = 'KEGIATAN_KONSULTAN_MANAJEMEN_CIS_SEMUA_LEMBAGA';
            $datarow = DB::table('kegiatan_konsultans')
                ->leftJoin('konsultans', 'kegiatan_konsultans.konsultan_id', '=', 'konsultans.id')
                ->leftJoin('bidang_layanans', 'konsultans.bidang_layanan_id', '=', 'bidang_layanans.id')
                ->leftJoin('cis_lembagas', 'konsultans.lembaga_id', '=', 'cis_lembagas.id')
                ->leftJoin('bidang_usahas', 'kegiatan_konsultans.bidang_usaha_id', '=', 'bidang_usahas.id')
                ->leftJoin('proker_konsultans', 'kegiatan_konsultans.proker_id', '=', 'proker_konsultans.id')
                ->leftJoin('details_prokers', 'kegiatan_konsultans.detail_proker_id', '=', 'details_prokers.id')
                ->select(
                    'cis_lembagas.plut_name AS Lembaga',
                    'konsultans.nama_lengkap AS Nama_Konsultan',
                    'bidang_layanans.name AS Bidang_Pendampingan',
                    'kegiatan_konsultans.created_at AS Tanggal_Pelaporan',
                    'kegiatan_konsultans.tanggal_mulai AS Tanggal_Mulai',
                    'kegiatan_konsultans.tanggal_selesai AS Tanggal_Selesai',
                    'kegiatan_konsultans.judul_kegiatan AS Nama_Kegiatan',
                    'bidang_usahas.name AS Bidang_Usaha',
                    'kegiatan_konsultans.lokasi_kegiatan AS Lokasi_Kegiatan',
                    'kegiatan_konsultans.jumlah_peserta AS Jumlah_Peserta',
                    'kegiatan_konsultans.output AS Output',
                    'kegiatan_konsultans.ket_output AS Keterangan',
                    'kegiatan_konsultans.sumber_daya AS Sumber_Daya',
                    'kegiatan_konsultans.mitra_kegiatan AS Mitra_Kegiatan',
                    'kegiatan_konsultans.rencana_tindak_lanjut AS Rencana_Tindak_Lanjut'
                )
                ->get();
        }

        // return $datarow;

        foreach ($datarow as $object) {
            $data[] = (array) $object;
        }
        // $data[] = $datarow->toArray();
        // return $data;

        if (isset($data) && count($data)) {
            return Excel::create($namefile, function ($excel) use ($datarow) {
                $excel->sheet('mySheet', function ($sheet) use ($datarow) {
                    $sheet->row(1, [
                        'Lembaga', 'Nama Konsultan', 'Bidang Pendampingan', 'Tanggal Pelaporan', 'Tanggal Mulai', 'Tanggal Selesai', 'Nama Kegiatan', 'Bidang Usaha', 'Lokasi Kegiatan', 'Jumlah Peserta', 'Output', 'Keterangan', 'Sumber Daya', 'Mitra Kegiatan', 'Rencana Tindak Lanjut',
                    ]);

                    $start = 2;

                    foreach ($datarow as $key => $value) {
                        $sheet->row($start++, [
                            $value->Lembaga, $value->Nama_Konsultan, $value->Bidang_Pendampingan, date('d-m-Y', strtotime($value->Tanggal_Pelaporan)), date('d-m-Y', strtotime($value->Tanggal_Mulai)), date('d-m-Y', strtotime($value->Tanggal_Selesai)), $value->Nama_Kegiatan, $value->Bidang_Usaha, $value->Lokasi_Kegiatan, $value->Jumlah_Peserta, $value->Output, $value->Keterangan, $value->Sumber_Daya, $value->Mitra_Kegiatan, $value->Rencana_Tindak_Lanjut,
                        ]);
                    }
                });
            })->download('xlsx');
        }

        return redirect('laporan-kegiatan')->with('error', 'Maaf ! Data tidak ada');
    }

    public function getProgramKerja()
    {
        $proker = DB::table('proker_konsultans')
            ->leftJoin('konsultans', 'proker_konsultans.konsultan_id', '=', 'konsultans.id')
            ->leftJoin('cis_lembagas', 'konsultans.lembaga_id', '=', 'cis_lembagas.id')
            ->select('proker_konsultans.*', 'konsultans.nama_lengkap', 'cis_lembagas.plut_name')
            ->get();
        foreach ($proker as $key => $value) {
            $proker[$key]->details_prokers = Details_proker::where('proker_id', $value->id)->get();
        }

        $data = [
            'proker' => $proker,
            'title' => 'Laporan Program Kerja',
            'lembaga' => Cis_lembaga::all(),
        ];
        // return $data;

        // return Proker_konsultan::with('details_proker','konsultan')->get();
        return view('laporan.laporan_proker', $data);
    }

    public function getProgramKerjaExcel()
    {
        $lembaga = \Request::input('lembaga');
        if ($lembaga != 'semua') {
            $datalembaga = Cis_lembaga::find($lembaga);
            $namefile = 'PROGRAM_KERJA_MANAJEMEN_CIS_' . $datalembaga->plut_name;
            $datarow = DB::table('proker_konsultans')
                ->leftJoin('konsultans', 'proker_konsultans.konsultan_id', '=', 'konsultans.id')
                ->leftJoin('cis_lembagas', 'konsultans.lembaga_id', '=', 'cis_lembagas.id')
                ->where('konsultans.lembaga_id', '=', $lembaga)
                ->select(
                    'konsultans.no_registrasi AS Nomor_registrasi',
                    'konsultans.nama_lengkap AS Nama_konsultan',
                    'cis_lembagas.id_lembaga AS ID_lembaga',
                    'cis_lembagas.plut_name AS Nama_lembaga',
                    'proker_konsultans.tahun_kegiatan AS Tahun_kegiatan',
                    'proker_konsultans.program AS Program',
                    'proker_konsultans.tujuan AS Tujuan'
                )
                ->get();
        } else {
            $namefile = 'PROGRAM_KERJA_MANAJEMEN_CIS_SEMUA_LEMBAGA';
            $datarow = DB::table('proker_konsultans')
                ->leftJoin('konsultans', 'proker_konsultans.konsultan_id', '=', 'konsultans.id')
                ->leftJoin('cis_lembagas', 'konsultans.lembaga_id', '=', 'cis_lembagas.id')
                ->select(
                    'konsultans.no_registrasi AS Nomor_registrasi',
                    'konsultans.nama_lengkap AS Nama_konsultan',
                    'cis_lembagas.id_lembaga AS ID_lembaga',
                    'cis_lembagas.plut_name AS Nama_lembaga',
                    'proker_konsultans.tahun_kegiatan AS Tahun_kegiatan',
                    'proker_konsultans.program AS Program',
                    'proker_konsultans.tujuan AS Tujuan'
                )
                ->get();
        }

        foreach ($datarow as $object) {
            $data[] = (array) $object;
        }
        if (isset($data) && count($data)) {
            return Excel::create($namefile, function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xlsx');
        }

        return redirect('laporan-program')->with('error', 'Maaf ! Data tidak ada');
    }

    public function getSentra()
    {
        $sentra = DB::table('sentra_kumkms')
            ->leftJoin('cis_lembagas', 'sentra_kumkms.id_lembaga', '=', 'cis_lembagas.id')
            ->leftJoin('provinces', 'sentra_kumkms.provinces_id', '=', 'provinces.id')
            ->leftJoin('regencies', 'sentra_kumkms.regency_id', '=', 'regencies.id')
            ->leftJoin('districts', 'sentra_kumkms.district_id', '=', 'districts.id')
            ->leftJoin('villages', 'sentra_kumkms.village_id', '=', 'villages.id')
            ->leftJoin('bidang_usahas', 'sentra_kumkms.bidang_usaha_id', '=', 'bidang_usahas.id')
            ->select(
                'sentra_kumkms.*',
                'cis_lembagas.plut_name',
                'provinces.name AS provinsi',
                'regencies.name AS kab_kota',
                'districts.name AS kecamatan',
                'villages.name AS kelurahan',
                'bidang_usahas.name AS bidang_usaha'
            )
            ->get();
        $data = [
            'sentra' => $sentra,
            'title' => 'Laporan Sentra',
            'lembaga' => Cis_lembaga::all(),
        ];
        return view('laporan.laporan_sentra', $data);
    }

    public function getSentraExcel()
    {
        $lembaga = \Request::input('lembaga');
        if ($lembaga != 'semua') {
            $datalembaga = Cis_lembaga::find($lembaga);
            $namefile = 'SENTRA_UMKM_MANAJEMEN_CIS_' . $datalembaga->plut_name;
            $datarow = DB::table('sentra_kumkms')
                ->leftJoin('cis_lembagas', 'sentra_kumkms.id_lembaga', '=', 'cis_lembagas.id')
                ->leftJoin('provinces', 'sentra_kumkms.provinces_id', '=', 'provinces.id')
                ->leftJoin('regencies', 'sentra_kumkms.regency_id', '=', 'regencies.id')
                ->leftJoin('districts', 'sentra_kumkms.district_id', '=', 'districts.id')
                ->leftJoin('villages', 'sentra_kumkms.village_id', '=', 'villages.id')
                ->leftJoin('bidang_usahas', 'sentra_kumkms.bidang_usaha_id', '=', 'bidang_usahas.id')
                ->where('sentra_kumkms.id_lembaga', '=', $lembaga)
                ->select(
                    'cis_lembagas.plut_name AS Lembaga',
                    'sentra_kumkms.id_sentra AS ID_Sentra',
                    'sentra_kumkms.name AS Nama_sentra',
                    'sentra_kumkms.alamat AS Alamat',
                    'provinces.name AS Provinsi',
                    'regencies.name AS Kab/Kota',
                    'districts.name AS Kecamatan',
                    'villages.name AS Kelurahan',
                    'sentra_kumkms.tahun_berdiri AS Tahun_berdiri',
                    'bidang_usahas.name AS Bidang_usaha',
                    'sentra_kumkms.total_umkm AS Total_UMKM',
                    'sentra_kumkms.total_pegawai AS Total_pegawai',
                    'sentra_kumkms.omset_bulan AS Omset_perbulan',
                    'sentra_kumkms.teknologi AS Teknologi',
                    'sentra_kumkms.bahan_baku AS Bahan_baku',
                    'sentra_kumkms.pemasaran AS Pemasaran',
                    'sentra_kumkms.kemitraan AS Kemitraan',
                    'sentra_kumkms.nama_ketua AS Nama_ketua',
                    'sentra_kumkms.notelp_ketua AS Telp_ketua',
                    'sentra_kumkms.email_ketua AS Email_ketua',
                    'sentra_kumkms.name_cp AS Nama_CP',
                    'sentra_kumkms.no_cp AS Telp_CP',
                    'sentra_kumkms.email_cp AS Email_CP',
                    'sentra_kumkms.pembina_kementrian AS Pembina_kementrian',
                    'sentra_kumkms.pembina_bidang AS Pembina_bidang',
                    'sentra_kumkms.pembina_tenaga_pendamping AS Pembina_tenaga_pendamping',
                    'sentra_kumkms.masalah_kelembagaan AS Masalah_kelembagaan',
                    'sentra_kumkms.masalah_sdm AS Masalah_SDM',
                    'sentra_kumkms.masalah_produksi AS Masalah_produksi',
                    'sentra_kumkms.masalah_pembiayaan AS Masalah_pembiayaan',
                    'sentra_kumkms.masalah_pemasaran AS Masalah_pemasaran'
                )
                ->get();
        } else {
            $namefile = 'SENTRA_UMKM_MANAJEMEN_CIS_SEMUA_LEMBAGA';
            $datarow = DB::table('sentra_kumkms')
                ->leftJoin('cis_lembagas', 'sentra_kumkms.id_lembaga', '=', 'cis_lembagas.id')
                ->leftJoin('provinces', 'sentra_kumkms.provinces_id', '=', 'provinces.id')
                ->leftJoin('regencies', 'sentra_kumkms.regency_id', '=', 'regencies.id')
                ->leftJoin('districts', 'sentra_kumkms.district_id', '=', 'districts.id')
                ->leftJoin('villages', 'sentra_kumkms.village_id', '=', 'villages.id')
                ->leftJoin('bidang_usahas', 'sentra_kumkms.bidang_usaha_id', '=', 'bidang_usahas.id')
                ->select(
                    'cis_lembagas.plut_name AS Lembaga',
                    'sentra_kumkms.id_sentra AS ID_Sentra',
                    'sentra_kumkms.name AS Nama_sentra',
                    'sentra_kumkms.alamat AS Alamat',
                    'provinces.name AS Provinsi',
                    'regencies.name AS Kab/Kota',
                    'districts.name AS Kecamatan',
                    'villages.name AS Kelurahan',
                    'sentra_kumkms.tahun_berdiri AS Tahun_berdiri',
                    'bidang_usahas.name AS Bidang_usaha',
                    'sentra_kumkms.total_umkm AS Total_UMKM',
                    'sentra_kumkms.total_pegawai AS Total_pegawai',
                    'sentra_kumkms.omset_bulan AS Omset_perbulan',
                    'sentra_kumkms.teknologi AS Teknologi',
                    'sentra_kumkms.bahan_baku AS Bahan_baku',
                    'sentra_kumkms.pemasaran AS Pemasaran',
                    'sentra_kumkms.kemitraan AS Kemitraan',
                    'sentra_kumkms.nama_ketua AS Nama_ketua',
                    'sentra_kumkms.notelp_ketua AS Telp_ketua',
                    'sentra_kumkms.email_ketua AS Email_ketua',
                    'sentra_kumkms.name_cp AS Nama_CP',
                    'sentra_kumkms.no_cp AS Telp_CP',
                    'sentra_kumkms.email_cp AS Email_CP',
                    'sentra_kumkms.pembina_kementrian AS Pembina_kementrian',
                    'sentra_kumkms.pembina_bidang AS Pembina_bidang',
                    'sentra_kumkms.pembina_tenaga_pendamping AS Pembina_tenaga_pendamping',
                    'sentra_kumkms.masalah_kelembagaan AS Masalah_kelembagaan',
                    'sentra_kumkms.masalah_sdm AS Masalah_SDM',
                    'sentra_kumkms.masalah_produksi AS Masalah_produksi',
                    'sentra_kumkms.masalah_pembiayaan AS Masalah_pembiayaan',
                    'sentra_kumkms.masalah_pemasaran AS Masalah_pemasaran'
                )
                ->get();
        }

        foreach ($datarow as $object) {
            $data[] = (array) $object;
        }
        if (isset($data) && count($data)) {
            return Excel::create($namefile, function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xlsx');
        }

        return redirect('laporan-sentra')->with('error', 'Maaf ! Data tidak ada');
    }

    public function getKinerja()
    {
        $kinerja = DB::table('kinerja_master')
            ->leftJoin('cis_lembagas', 'kinerja_master.cis_lembaga_id', '=', 'cis_lembagas.id')
            ->leftJoin('standart_layanan', 'kinerja_master.standart_layanan_id', '=', 'standart_layanan.id')
            ->leftJoin('bidang_layanans', 'standart_layanan.bidang_layanan_id', '=', 'bidang_layanans.id')
            ->select(
                'kinerja_master.*',
                'cis_lembagas.plut_name AS lembaga',
                'standart_layanan.nama AS standart_layanan',
                'bidang_layanans.name AS bidang_layanan'
            )
            ->get();
        $data = [
            'kinerja' => $kinerja,
            'title' => 'Laporan Kinerja',
            'lembaga' => Cis_lembaga::all(),
        ];
        return view('laporan.laporan_kinerja', $data);
    }

    public function getKinerjaExcel()
    {
        $lembaga = \Request::input('lembaga');
        $tahun = \Request::input('tahun');
        if ($lembaga != 'semua') {
            $datalembaga = Cis_lembaga::find($lembaga);
            $namefile = 'KINERJA_TRIWULAN_CIS_SEMESCO_' . $datalembaga->plut_name . ' ' . $tahun;
            $datarow = DB::table('kinerja_master')
                ->leftJoin('cis_lembagas', 'kinerja_master.cis_lembaga_id', '=', 'cis_lembagas.id')
                ->leftJoin('standart_layanan', 'kinerja_master.standart_layanan_id', '=', 'standart_layanan.id')
                ->leftJoin('bidang_layanans', 'standart_layanan.bidang_layanan_id', '=', 'bidang_layanans.id')
                ->where('kinerja_master.cis_lembaga_id', '=', $lembaga)
                ->where('kinerja_master.tahun', '=', $tahun)
                ->orderBy('bidang_layanans.id', 'ASC')
                ->select(
                    'cis_lembagas.plut_name AS Lembaga',
                    'bidang_layanans.name AS Bidang_layanan',
                    'standart_layanan.nama AS Standart_layanan',
                    'kinerja_master.sasaran AS Sasaran',
                    'kinerja_master.target AS Target',
                    'kinerja_master.tahun AS Tahun',
                    'kinerja_master.triwulan1 AS Jan-Mar',
                    'kinerja_master.triwulan2 AS Apr-Jun',
                    'kinerja_master.triwulan3 AS Jul-Sept',
                    'kinerja_master.triwulan4 AS Okt-Des'
                )
                ->get();
        } else {
            $namefile = 'KINERJA_TRIWULAN_CIS_SEMESCO_SEMUA_' . $tahun;
            $datarow = DB::table('kinerja_master')
                ->leftJoin('cis_lembagas', 'kinerja_master.cis_lembaga_id', '=', 'cis_lembagas.id')
                ->leftJoin('standart_layanan', 'kinerja_master.standart_layanan_id', '=', 'standart_layanan.id')
                ->leftJoin('bidang_layanans', 'standart_layanan.bidang_layanan_id', '=', 'bidang_layanans.id')
                ->where('kinerja_master.tahun', '=', $tahun)
                ->orderBy('bidang_layanans.id', 'ASC')
                ->select(
                    'cis_lembagas.plut_name AS Lembaga',
                    'bidang_layanans.name AS Bidang_layanan',
                    'standart_layanan.nama AS Standart_layanan',
                    'kinerja_master.sasaran AS Sasaran',
                    'kinerja_master.target AS Target',
                    'kinerja_master.tahun AS Tahun',
                    'kinerja_master.triwulan1 AS Jan-Mar',
                    'kinerja_master.triwulan2 AS Apr-Jun',
                    'kinerja_master.triwulan3 AS Jul-Sept',
                    'kinerja_master.triwulan4 AS Okt-Des'
                )
                ->get();
        }

        foreach ($datarow as $object) {
            $data[] = (array) $object;
        }
        if (isset($data) && count($data)) {
            return Excel::create($namefile, function ($excel) use ($data) {
                $excel->sheet('mySheet', function ($sheet) use ($data) {
                    $sheet->fromArray($data);
                });
            })->download('xlsx');
        }

        return redirect('laporan-kinerja')->with('error', 'Maaf ! Data tidak ada');
    }

    public function getProkerPlut()
    {
        $lembaga_id = Input::get('lembaga_id');

        $content = Proker_konsultan::query();

        $content->where('lembaga_id', '!=', null)->where('tahun_kegiatan', '>', '2017');

        if (Input::get('lembaga_id')) {
            $content->where('lembaga_id', $lembaga_id);
        }

        $content = $content->paginate();

        $data = [
            'title' => 'Data Program Kerja PLUT KUMKM',
            'data' => $content,
            'lembaga' => Cis_lembaga::all(),
            'lembaga_id' => $lembaga_id,
        ];
        // return $data;
        return view('laporan.laporan_proker_plut', $data);
    }

    public function getProkerPlutExcel()
    {
        $lembaga_id = Input::get('lembaga_id');

        $content = Proker_konsultan::query();

        $content->where('lembaga_id', '!=', null)->where('tahun_kegiatan', '>', '2017');

        $namefile = 'PROGRAM KERJA PLUT KUMKM';

        if (Input::get('lembaga_id')) {
            $content->where('lembaga_id', $lembaga_id);
            $cis = Cis_lembaga::find($lembaga_id);
            $namefile = 'PROGRAM KERJA PLUT KUMKM ' . $cis->plut_name;
        }

        $content = $content->get();

        if (count($content) == 0) {
            return redirect('laporan-proker-plut')->with('info', $namefile . ' KOSONG');
        }

        $data = $content;
        return Excel::create($namefile, function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->cell('A1', function ($cell) {$cell->setValue('Tahun');});
                $sheet->cell('B1', function ($cell) {$cell->setValue('Lembaga');});
                $sheet->cell('C1', function ($cell) {$cell->setValue('Kegiatan');});
                $sheet->cell('D1', function ($cell) {$cell->setValue('Tujuan');});
                $sheet->cell('E1', function ($cell) {$cell->setValue('Sasaran');});
                $sheet->cell('F1', function ($cell) {$cell->setValue('Jumlah Sasaran');});
                $sheet->cell('G1', function ($cell) {$cell->setValue('Indikator');});
                $sheet->cell('H1', function ($cell) {$cell->setValue('Output');});
                $sheet->cell('I1', function ($cell) {$cell->setValue('Anggaran');});
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $anggaran = '';
                        foreach ($value->proker_anggaran as $angg) {
                            $anggaran .= $angg->anggaran->nama . ', ';
                        }

                        $i = $key + 2;
                        $sheet->cell('A' . $i, $value->tahun_kegiatan);
                        $sheet->cell('B' . $i, $value->lembagas->plut_name);
                        $sheet->cell('C' . $i, $value->program);
                        $sheet->cell('D' . $i, $value->tujuan);
                        $sheet->cell('E' . $i, $value->sasaran);
                        $sheet->cell('F' . $i, $value->jumlah_sasaran);
                        $sheet->cell('G' . $i, $value->indikator);
                        $sheet->cell('H' . $i, $value->output);
                        $sheet->cell('I' . $i, $anggaran);
                    }
                }
            });
        })->download('xlsx');
    }

    private function getProgresData($tahun)
    {
        $result = Cis_lembaga::withCount([
            'kumkm' => function ($q) use ($tahun) {$q->whereYear('created_at', $tahun);},
            'sentra_kumkm' => function ($q) use ($tahun) {$q->whereYear('created_at', $tahun);},
            'produk_unggulan' => function ($q) use ($tahun) {$q->whereYear('created_at', $tahun);},
            'pelaksanaan_pendampingan AS total_kegiatan' => function ($q) use ($tahun) {
                $q->whereHas('konsultans', function ($q) use ($tahun) {
                    $q->whereYear('tanggal', $tahun);
                });
            },
            'pelaksanaan_pendampingan AS kegiatan_by_kelembagaan' => function ($q) use ($tahun) {
                $q->whereHas('konsultans', function ($q) {
                    $q->where('bidang_layanan_id', 1);
                })->whereYear('tanggal', $tahun);
            }, 'pelaksanaan_pendampingan AS kegiatan_by_sdm' => function ($q) use ($tahun) {
                $q->whereHas('konsultans', function ($q) {
                    $q->where('bidang_layanan_id', 2);
                })->whereYear('tanggal', $tahun);
            }, 'pelaksanaan_pendampingan AS kegiatan_by_produksi' => function ($q) use ($tahun) {
                $q->whereHas('konsultans', function ($q) {
                    $q->where('bidang_layanan_id', 3);
                })->whereYear('tanggal', $tahun);
            }, 'pelaksanaan_pendampingan AS kegiatan_by_pembiayaan' => function ($q) use ($tahun) {
                $q->whereHas('konsultans', function ($q) {
                    $q->where('bidang_layanan_id', 4);
                })->whereYear('tanggal', $tahun);
            }, 'pelaksanaan_pendampingan AS kegiatan_by_pemasaran' => function ($q) use ($tahun) {
                $q->whereHas('konsultans', function ($q) {
                    $q->where('bidang_layanan_id', 5);
                })->whereYear('tanggal', $tahun);
            }, 'pelaksanaan_pendampingan AS kegiatan_by_it' => function ($q) use ($tahun) {
                $q->whereHas('konsultans', function ($q) {
                    $q->where('bidang_layanan_id', 6);
                })->whereYear('tanggal', $tahun);
            }, 'pelaksanaan_pendampingan AS kegiatan_by_kerjasama' => function ($q) use ($tahun) {
                $q->whereHas('konsultans', function ($q) {
                    $q->where('bidang_layanan_id', 7);
                })->whereYear('tanggal', $tahun);
            }])->orderBy('id_lembaga')->get();
        return $result;
    }

    public function progresData()
    {
        $tahun = Input::get('tahun');

        if ($tahun == null) {
            $tahun = date('Y');
        }

        $cis = $this->getProgresData($tahun);

        $data = [
            'title' => 'Progres Data PLUT',
            'data' => $cis,
            'tahun' => $tahun,
        ];
        return view('laporan.laporan_progres_plut', $data);
    }

    public function progresExcel()
    {
        $tahun = Input::get('tahun');
        $namefile = 'Progres Data PLUT';

        if ($tahun == null) {
            $tahun = date('Y');
        }

        $data = $this->getProgresData($tahun);

        return Excel::create($namefile, function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->setMergeColumn([
                    'columns' => ['A'],
                    'rows' => [
                        [1, 2],
                    ],
                ])->cell('A1', function ($cell) {$cell->setValue('Nama Plut')->setAlignment('center')->setValignment('center');});
                $sheet->mergeCells('B1:D1')->cell('B1', function ($cell) {$cell->setValue('Jumlah')->setAlignment('center')->setValignment('center');});
                $sheet->mergeCells('E1:K1')->cell('E1', function ($cell) {$cell->setValue('Laporan Per Bidang')->setAlignment('center')->setValignment('center');});
                $sheet->cell('L1', function ($cell) {$cell->setValue('Total')->setAlignment('center');});
                $sheet->cell('B2', function ($cell) {$cell->setValue('KUMKM')->setAlignment('center');});
                $sheet->cell('C2', function ($cell) {$cell->setValue('Sentra KUMKM')->setAlignment('center');});
                $sheet->cell('D2', function ($cell) {$cell->setValue('Produk Unggulan')->setAlignment('center');});
                $sheet->cell('E2', function ($cell) {$cell->setValue('Kelembagaan')->setAlignment('center');});
                $sheet->cell('F2', function ($cell) {$cell->setValue('SDM')->setAlignment('center');});
                $sheet->cell('G2', function ($cell) {$cell->setValue('Produksi')->setAlignment('center');});
                $sheet->cell('H2', function ($cell) {$cell->setValue('Pembiayaan')->setAlignment('center');});
                $sheet->cell('I2', function ($cell) {$cell->setValue('Pemasaran')->setAlignment('center');});
                $sheet->cell('J2', function ($cell) {$cell->setValue('IT')->setAlignment('center');});
                $sheet->cell('K2', function ($cell) {$cell->setValue('Kerjasama')->setAlignment('center');});
                $sheet->cell('L2', function ($cell) {$cell->setValue('Laporan Kegiatan')->setAlignment('center');});
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i = $key + 3;
                        $sheet->cell('A' . $i, $value->plut_name);
                        $sheet->cell('B' . $i, $value->kumkm_count);
                        $sheet->cell('C' . $i, $value->sentra_kumkm_count);
                        $sheet->cell('D' . $i, $value->produk_unggulan_count);
                        $sheet->cell('E' . $i, $value->kegiatan_by_kelembagaan_count);
                        $sheet->cell('F' . $i, $value->kegiatan_by_sdm_count);
                        $sheet->cell('G' . $i, $value->kegiatan_by_produksi_count);
                        $sheet->cell('H' . $i, $value->kegiatan_by_pembiayaan_count);
                        $sheet->cell('I' . $i, $value->kegiatan_by_pemasaran_count);
                        $sheet->cell('J' . $i, $value->kegiatan_by_it_count);
                        $sheet->cell('K' . $i, $value->kegiatan_by_kerjasama_count);
                        $sheet->cell('L' . $i, $value->total_kegiatan_count);
                    }
                }
            });
        })->download('xlsx');
    }

    public function progresPrint()
    {
        $tahun = Input::get('tahun');
        if ($tahun == null) {
            $tahun = date('Y');
        }
        $cis_lembagas = $this->getProgresData($tahun);
        $data = [
            'data' => $cis_lembagas,
        ];
        return view('laporan.laporan_progres_plut_print', $data);
    }

    public function getKegiatanOld()
    {
    }
}
