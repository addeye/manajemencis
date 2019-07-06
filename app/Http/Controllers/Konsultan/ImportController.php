<?php
/**
 * Created by PhpStorm.
 * User: deyelovi
 * Date: 04/03/2017
 * Time: 13:30
 */

namespace App\Http\Controllers\Konsultan;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function importExcelKegiatan()
    {
        $data = array(
            'title' => 'Form Import Data'
        );
        return view('dashboard.konsultan.kegiatan.import_form',$data);
    }

    public function downloadExcelKegiatan()
    {
        return response()->download('');
    }

    public function doImportKegiatan(Request $request)
    {
        return $request->all();
    }
}