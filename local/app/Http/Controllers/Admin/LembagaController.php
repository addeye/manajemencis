<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 07/02/2017
 * Time: 13:40
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Traits\UploadTrait;
use App\Repositories\CisLembagaRepository;
use App\Repositories\LembagaRepository;
use App\Repositories\ProvincesRepository;
use App\Repositories\RegenciesRepository;
use App\Repositories\TingkatsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Html;

class LembagaController extends Controller
{
    use UploadTrait;

    protected $lembaga;
    protected $provinces;
    protected $tingkat;
    protected $regencies;
    protected $cislembaga;

    public function __construct(LembagaRepository $lembaga,
                                ProvincesRepository $provinces,
                                TingkatsRepository $tingkat,
                                RegenciesRepository $regencies, CisLembagaRepository $cisLembagaRepository)
    {
        $this->lembaga = $lembaga;
        $this->provinces = $provinces;
        $this->tingkat = $tingkat;
        $this->regencies = $regencies;
        $this->cislembaga = $cisLembagaRepository;
    }

    public function profile()
    {
        $data = array(
            'head_title' => 'Lembaga',
            'title' => 'Profil Lembaga',
            'data' => $this->cislembaga->getLembagaForAdmin()
        );

        return view('dashboard.admin.lembaga.profil',$data);
    }

    public function editProfile()
    {
        $data = array(
            'head_title' => 'Lembaga',
            'title' => 'Edit Lembaga',
            'tingkat' => $this->tingkat->getAll(),
            'provinces' => $this->provinces->getAll(),
            'regencies' => $this->regencies->getAll(),
            'data' => $this->cislembaga->getLembagaForAdmin()
        );

        return view('dashboard.admin.lembaga.edit',$data);
    }

    public function doUpdate(Request $request, $id)
    {
        $data = $request->all();
        $cislembaga = $this->cislembaga->getById($id);
        $oldfile = $cislembaga->photo_gedung;

        if($request->hasFile('photo_gedung'))
        {
            $file = Input::file('photo_gedung');
            $name = $this->upload_image($file,'images',$oldfile);
            $data['photo_gedung'] = $name;
        }
        $result = $this->cislembaga->update($id,$data);
        if($result)
        {
            return redirect('adm/lembaga/profil')->with('info','Data Lembaga Berhasil Diupdate');
        }
    }

    public function exportWord($id)
    {
        $lembaga = $this->cislembaga->getById($id);
        $name = $lembaga->plut_name;
        $dir = 'document/'.$name.'.docx';

        $phpWord = new PhpWord();

        $data['data'] = $lembaga;
        $section = $phpWord->addSection();
        $html = view('dashboard.admin.lembaga.exportword',$data)->render();

// Adding Text element to the Section having font styled by default...
        Html::addHtml($section,$html);

// Saving the document as HTML file...
        $objWriter = IOFactory::createWriter($phpWord);
        $objWriter->save($dir);
        return response()->download($dir);
    }

}