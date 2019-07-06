<?php

namespace App\Http\Controllers\Konsultan;

use App\Bidang_layanan;
use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\KegiatanKonsultanBidang;
use App\Kegiatan_konsultan;
use App\Repositories\BidangUsahaRepository;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\JenisLayananRepository;
use App\Repositories\KegiatanKonsultanRepository;
use App\Repositories\ProkerKonsultanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class KegiatanKonsultanController extends Controller
{
    use UploadTrait;

    protected $kegiatankonsultan;
    protected $jenislayanan;
    protected $bidangusaha;
    protected $proker;
    protected $dproker;

    public function __construct(
        KegiatanKonsultanRepository $kegiatankonsultan,
        JenisLayananRepository $jenislayanan,
        BidangUsahaRepository $bidangusaha,
        ProkerKonsultanRepository $proker,
        DetailsProkersRepository $detailsProkersRepository
    ) {
        $this->kegiatankonsultan = $kegiatankonsultan;
        $this->jenislayanan = $jenislayanan;
        $this->bidangusaha = $bidangusaha;
        $this->proker = $proker;
        $this->dproker = $detailsProkersRepository;
    }

    public function getAll()
    {
        // return $data;
        $data = [
            'head_title' => 'Data Pelaporan Kegiatan Konsultan',
            'title' => 'Pelaporan Kegiatan Konsultan',
            'data' => $this->kegiatankonsultan->getAllByKonsultan(),
        ];
        // return $data;
        return view('dashboard.konsultan.kegiatan.list', $data);
    }

    public function addData()
    {
        $user = Auth::user();

        $data = [
            'title' => 'Tambah Pelaporan Kegiatan Konsultan',
            'bidang_usaha' => $this->bidangusaha->getAll(),
            'bidang_layanan' => Bidang_layanan::all(),
            'proker' => $this->dproker->getByKonsultanOrigin($user->konsultans->id),
        ];
        // return $data;
        return view('dashboard.konsultan.kegiatan.add', $data);
    }

    public function doAddData(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();

        $rules = [
            'tanggal_mulai' => 'required|date|date_format:d-m-Y',
            'tanggal_selesai' => 'required|date|date_format:d-m-Y',
            'judul_kegiatan' => 'required',
            'bidang_usaha_id' => 'required',
            'lokasi_kegiatan' => 'required',
            'jumlah_peserta' => 'required|numeric',
            'output' => 'required|numeric',
            'ket_output' => 'required|max:255',
            'mitra_kegiatan' => 'nullable|max:1000'
        ];

        $messages = [
            'tanggal_mulai.required' => 'Harus terisi',
            'tanggal_mulai.date' => 'Format harus tanggal',
            'tanggal_mulai.date_format' => 'Format tanggal DD-MM-YYYY',
            'tanggal_selesai.required' => 'Harus terisi',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal',
            'tanggal_selesai.date_format' => 'Format tanggal selesai DD-MM-YYYY',
            'judul_kegiatan.required' => 'Judul harus terisi',
            'bidang_usaha_id.required' => 'Bidang harus terisi',
            'lokasi_kegiatan.required' => 'Harus terisi lokasi nya',
            'jumlah_peserta.required' => 'Harus terisi jumlah pesertanya',
            'jumlah_peserta.numeric' => 'Jumlah peserta harus berupa angka',
            'output.required' => 'Output harus terisi',
            'output.numeric' => 'Output harus berupa angka',
            'ket_output.required' => 'Keterangan output harus terisi',
            'ket_output.max' => 'Maksimal kata hanya 255 karakter. pastikan pendek saja',
            'mitra_kegiatan.max' => 'Maksimal inputan hanya 1000 karakter, pastikan jangan terlalu panjang sekali'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect('k/kegiatan/create')
                ->withErrors($validator)
                ->withInput();
        }

        $cek = strtotime($request->tanggal_mulai) > strtotime($request->tanggal_selesai);

        if ($cek) {
            return redirect('k/kegiatan/create')->with('error', 'Tidak Boleh Tanggal Selesai lebih besar dari Tanggal Mulai')->withInput();
        }

        if ($request->hasFile('image')) {
            $files = Input::file('image');
            //getting timestamp
            $name = $this->upload_image($files, 'kegiatan');
            $data['image'] = $name;
        }

        $data['bidang_layanan_id'] = $user->konsultans->bidang_layanan_id;
        $result = $this->kegiatankonsultan->create($data);

        if ($result) {
            foreach ($request->bidang_layanan_id as $key => $value) {
                $bidang = new KegiatanKonsultanBidang();
                $bidang->kegiatan_konsultan_id = $result->id;
                $bidang->bidang_layanan_id = $value;
                $bidang->save();
            }

            return redirect('k/kegiatan')->with('success', 'Data Kegiatan Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $user = Auth::user();
        $rowkegiatan = $this->kegiatankonsultan->getById($id);
        $data = [
            'title' => 'Edit Pelaporan Kegiatan',
            'data' => $rowkegiatan,
            'bidang_usaha' => $this->bidangusaha->getAll(),
            'bidang_layanan' => Bidang_layanan::all(),
            'proker' => $this->dproker->getByKonsultanOrigin($user->konsultans->id),
        ];
        return view('dashboard.konsultan.kegiatan.edit', $data);
    }

    public function doEditData(Request $request, $id)
    {
        $user = Auth::user();
        $data = $request->all();

        $rules = [
            'tanggal_mulai' => 'required|date|date_format:d-m-Y',
            'tanggal_selesai' => 'required|date|date_format:d-m-Y',
            'judul_kegiatan' => 'required',
            'bidang_usaha_id' => 'required',
            'lokasi_kegiatan' => 'required',
            'jumlah_peserta' => 'required|numeric',
            'output' => 'required|numeric',
            'ket_output' => 'required|max:255',
        ];

        $messages = [
            'tanggal_mulai.required' => 'Harus terisi',
            'tanggal_mulai.date' => 'Format harus tanggal',
            'tanggal_mulai.date_format' => 'Format tanggal DD-MM-YYYY',
            'tanggal_selesai.required' => 'Harus terisi',
            'tanggal_selesai.date' => 'Tanggal selesai harus berupa tanggal',
            'tanggal_selesai.date_format' => 'Format tanggal selesai DD-MM-YYYY',
            'judul_kegiatan.required' => 'Judul harus terisi',
            'bidang_usaha_id.required' => 'Bidang harus terisi',
            'lokasi_kegiatan.required' => 'Harus terisi lokasi nya',
            'jumlah_peserta.required' => 'Harus terisi jumlah pesertanya',
            'jumlah_peserta.numeric' => 'Jumlah peserta harus berupa angka',
            'output.required' => 'Output harus terisi',
            'output.numeric' => 'Output harus berupa angka',
            'ket_output.required' => 'Keterangan output harus terisi',
            'ket_output.max' => 'Maksimal kata hanya 255 karakter. pastikan pendek saja',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect('k/kegiatan/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $cek = strtotime($request->tanggal_mulai) > strtotime($request->tanggal_selesai);

        if ($cek) {
            return redirect('k/kegiatan/' . $id)->with('error', 'Tidak Boleh Tanggal Selesai lebih besar dari Tanggal Mulai')->withInput();
        }

        if ($request->hasFile('image')) {
            $files = Input::file('image');
            //getting timestamp

            $oldkegiatan = $this->kegiatankonsultan->getById($id);

            $name = $this->upload_image($files, 'kegiatan', $oldkegiatan->image);

            $data['image'] = $name;
        }

        $data['bidang_layanan_id'] = $user->konsultans->bidang_layanan_id;

        $result = $this->kegiatankonsultan->update($id, $data);

        if ($result) {
            $keg = Kegiatan_konsultan::with('kegiatan_konsultan_bidang')->find($id);

            if ($keg->kegiatan_konsultan_bidang->count() > 0) {
                KegiatanKonsultanBidang::where('kegiatan_konsultan_id', $keg->id)->delete();
            }

            foreach ($request->bidang_layanan_id as $key => $value) {
                $bidang = new KegiatanKonsultanBidang();
                $bidang->kegiatan_konsultan_id = $keg->id;
                $bidang->bidang_layanan_id = $value;
                $bidang->save();
            }

            return redirect('k/kegiatan/' . $id)->with('info', 'Data Kegiatan Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        // return redirect('k/kegiatan')->with('error', 'Batas waktu input telah berakhir');
        $old = $this->kegiatankonsultan->getById($id);
        $this->delete_image('kegiatan', $old->image);

        $result = $this->kegiatankonsultan->delete($id);
        if ($result) {
            return redirect('k/kegiatan')->with('info', 'Data Kegiatan Berhasil Dihapus');
        }
    }

    public function report()
    {
        $tanggal_mulai = Input::get('tanggal_mulai');
        $tanggal_selesai = Input::get('tanggal_selesai');
        $lembaga_id = Auth::user()->konsultans->lembaga_id;

        $rules = [
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ];

        $content = Kegiatan_konsultan::query();

        $tanggal_mulai_db = date('Y-m-d', strtotime($tanggal_mulai));
        $tanggal_selesai_db = date('Y-m-d', strtotime($tanggal_selesai));

        $content->whereHas('konsultan', function ($q) use ($lembaga_id) {$q->where('lembaga_id', $lembaga_id);});
        if ($tanggal_mulai) {
            $content->where('tanggal_mulai', '>=', $tanggal_mulai_db);
        }

        if ($tanggal_selesai) {
            $content->where('tanggal_mulai', '<=', $tanggal_selesai_db);
        }

        $data = [
            'head_title' => 'Data Pelaporan Kegiatan Konsultan',
            'title' => 'Pelaporan Kegiatan Konsultan',
            'data' => $content->get(),
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai
        ];
        // return $data;
        return view('dashboard.konsultan.kegiatan.report', $data);
    }

    public function getKegiatanKonsultan()
    {
        $konsultan_id = Input::get('konsultan_id');
        $tahun = Input::get('tahun');

        $data = [
            'kegiatan' => Kegiatan_konsultan::where('konsultan_id', $konsultan_id)->whereYear('tanggal_mulai', $tahun)->get(),
        ];
        // return $data;

        return view('dashboard.konsultan.laporan_kegiatan_ajax', $data);
    }

    public function getDetailProkerById($id)
    {
        $result = $this->dproker->getById($id);
        if ($result) {
            return $result;
        }
        return [];
    }
}
