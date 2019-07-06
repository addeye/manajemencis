<?php

namespace App\Http\Controllers\Konsultan;

use App\Details_proker;
use App\Http\Controllers\Controller;
use App\Proker_konsultan;
use App\Repositories\DetailsProkersRepository;
use App\Repositories\ProkerKonsultanRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProkerKonsultanController extends Controller
{
    protected $proker;
    protected $detailproker;

    public function __construct(ProkerKonsultanRepository $proker, DetailsProkersRepository $detailproker)
    {
        $this->proker = $proker;
        $this->detailproker = $detailproker;
    }

    public function getAll()
    {
        $user = Auth::user();

		$proker_id = Input::get('proker_id');
		$tahun = Input::get('tahun');

        $content = Details_proker::query();

        $content->where('konsultan_id', $user->konsultans->id);

        if (Input::get('proker_id')) {
            $content->where('proker_id', $proker_id);
		}

		if($tahun){
			$content->whereHas('prokers', function($q)use($tahun){
				$q->where('tahun_kegiatan',$tahun);
			});
		}

        $content = $content->paginate();

        $data = [
            'title' => 'Data Program Kerja',
            'data' => $content,
            'proker' => $this->proker->getAllByLembagaIdLockYear($user->konsultans->lembaga_id,$tahun),
            'proker_id' => $proker_id,
        ];
        // return $data;
        return view('dashboard.konsultan.proker.list', $data);
    }

    public function addData()
    {
        $user = Auth::user();
        $data = [
            'title' => 'Tambah Program Kerja',
            'proker' => $this->proker->getAllByLembagaIdLock($user->konsultans->lembaga_id),
        ];
        // return $data;
        return view('dashboard.konsultan.proker.add', $data);
    }

    public function doAddData(Request $request)
    {
        $user = Auth::user();
        $rule = [
            'proker_id' => 'required',
            'kegiatan' => 'required',
            'tujuan' => 'required',
            'sasaran' => 'required',
            'jumlah_sasaran' => 'required|numeric',
            'output' => 'required',
            'jadwal_pelaksana' => 'required|array|min:1',
            'mitra_kerja' => 'required',
        ];

        $messages = [
            'proker_id.required' => 'Proker plut tidak boleh kosong',
            'kegiatan.required' => 'Kegiatan tidak boleh kosong',
            'tujuan.required' => 'Tujuan tidak boleh kosong',
            'sasaran' => 'Sasaran tidak boleh kosong',
            'jumlah_sasaran.required' => 'Jumlah sasaran tidak boleh kosong',
            'jumlah_sasaran.numeric' => 'Jumlah sasaran harus angka',
            'output.required' => 'Output tidak boleh kosong',
            'jadwal_pelaksana.required' => 'Jadawal tidak boleh kosong',
            'mitra_kerja.required' => 'Mitra kerja tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);
        if ($validator->fails()) {
            return redirect('k/proker/create')->withErrors($validator)->withInput();
        }

        $teks = implode(', ', $request->jadwal_pelaksana);
        $data['jadwal_pelaksana'] = $teks;
        $data['proker_id'] = $request->proker_id;
        $data['jenis_kegiatan'] = $request->kegiatan;
        $data['tujuan'] = $request->tujuan;
        $data['sasaran'] = $request->sasaran;
        $data['indikator'] = $request->indikator;
        $data['ket_output'] = $request->output;
        $data['jml_penerima'] = $request->jumlah_sasaran;
        $data['mitra_kerja'] = $request->mitra_kerja;
        $data['konsultan_id'] = $user->konsultans->id;

        // return $data;

        $result = $this->detailproker->create($data);

        if ($result) {
            return redirect('k/proker')->with('success', 'Data Program Kerja Berhasil Disimpan');
        }
    }

    public function editData($id)
    {
        $user = Auth::user();
        $data = [
            'title' => 'Edit Program Kerja',
            'data' => $this->detailproker->getById($id),
            'proker' => $this->proker->getAllByLembagaIdLock($user->konsultans->lembaga_id),
        ];
        // return $data;
        return view('dashboard.konsultan.proker.edit', $data);
    }

    public function doEditData(Request $request, $id)
    {
        $user = Auth::user();
        $rule = [
            'proker_id' => 'required',
            'kegiatan' => 'required',
            'tujuan' => 'required',
            'sasaran' => 'required',
            'jumlah_sasaran' => 'required|numeric',
            'output' => 'required',
            'jadwal_pelaksana' => 'required|array|min:1',
            'mitra_kerja' => 'required',
        ];

        $messages = [
            'proker_id.required' => 'Proker plut tidak boleh kosong',
            'kegiatan.required' => 'Kegiatan tidak boleh kosong',
            'tujuan.required' => 'Tujuan tidak boleh kosong',
            'sasaran' => 'Sasaran tidak boleh kosong',
            'jumlah_sasaran.required' => 'Jumlah sasaran tidak boleh kosong',
            'jumlah_sasaran.numeric' => 'Jumlah sasaran harus angka',
            'output.required' => 'Output tidak boleh kosong',
            'jadwal_pelaksana.required' => 'Jadawal tidak boleh kosong',
            'mitra_kerja.required' => 'Mitra kerja tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rule, $messages);
        if ($validator->fails()) {
            return redirect('k/proker/' . $id)->withErrors($validator)->withInput();
        }

        $teks = implode(', ', $request->jadwal_pelaksana);
        $data['jadwal_pelaksana'] = $teks;
        $data['proker_id'] = $request->proker_id;
        $data['jenis_kegiatan'] = $request->kegiatan;
        $data['tujuan'] = $request->tujuan;
        $data['sasaran'] = $request->sasaran;
        $data['indikator'] = $request->indikator;
        $data['ket_output'] = $request->output;
        $data['jml_penerima'] = $request->jumlah_sasaran;
        $data['mitra_kerja'] = $request->mitra_kerja;
        $data['konsultan_id'] = $user->konsultans->id;

        $result = $this->detailproker->update($id, $data);
        if ($result) {
            return redirect('k/proker')->with('info', 'Data Program Kerja Berhasil Diupdate');
        }
    }

    public function deleteData($id)
    {
        $result = $this->detailproker->delete($id);
        if ($result) {
            return redirect('k/proker')->with('info', 'Data Bidang Layanan Berhasil Dihapus');
        }
    }

    public function detailData($id)
    {
        $data = [
            'title' => 'Detail Program Kerja',
            'data' => $this->proker->getById($id),
        ];
        return view('dashboard.konsultan.proker.detail', $data);
    }

    public function getProkerById($id)
    {
        $result = $this->proker->getById($id);
        if ($result) {
            return $result;
        }
        return [];
    }

    public function prokerCis()
    {
        $user = Auth::user();
        $tahun = Input::get('tahun');

        $d = Proker_konsultan::query();
        if ($tahun) {
            $d->where('tahun_kegiatan', $tahun);
        }
        $d = $d->where('lembaga_id', $user->konsultans->lembaga_id)->get();

        $data = [
            'title' => 'PROGRAM KERJA PLUT KUMKM',
            'data' => $d,
        ];
        return view('dashboard.konsultan.proker_plut.list', $data);
    }
}
