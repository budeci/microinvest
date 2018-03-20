<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Plupload;
use File;
use Storage;
use Validator;
use App\Repositories\AplicationRepository;
use App\Repositories\AplicationFileRepository;
class AppUploadFiles extends Controller
{

    protected $appRepository;

    protected $appFileRepository;

    public function __construct(AplicationRepository $aplicationRepository,AplicationFileRepository $aplicationFileRepository)
    {
        $this->appRepository     = $aplicationRepository;
        $this->appFileRepository = $aplicationFileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function uploadFile(Request $request) {
        $getOpenApp   = $this->appRepository->getOpenApp();
        return Plupload::receive('file', function ($file) use ($getOpenApp, $request)
        {
            $file->move(public_path() . '/upload/aplication',$file->getClientOriginalName());
            $data = [
                'aplication_id' => $getOpenApp->id,
                'file'          => '/upload/aplication/'.$file->getClientOriginalName(),
                'id_file'       => $request->get('fileid')
            ];
            $this->appFileRepository->addAppFile($data);
            return 'ready';
        });
    }
    public function removeFile(Request $request) {
        $findFile = $this->appFileRepository->findFile($request->get('fileId'));
        $removeFile = false;
        if ($findFile) {
            File::delete($findFile->full_path);
            $removeFile = $this->appFileRepository->removeFile($request->get('fileId'));
        }
        $json = array(
            'result'  => $removeFile,
            'respons' => true
        );
        return response($json);
    }

    public function uploadFormFile(Request $request) {

        return Plupload::receive('file', function ($file)
        {
            $uniqid = substr(str_replace('.', '', uniqid(rand(), true)), 0, 5);
            if (!session()->has('folder')) {
                session()->put('folder', $uniqid);
            }
            if(!File::exists(public_path().'/upload/tmp/'.session()->get('folder'))) {
                 File::makeDirectory(public_path().'/upload/tmp/'.session()->get('folder'));
            }
            $file->move(public_path() . '/upload/tmp/'.session()->get('folder'),$file->getClientOriginalName());
            return 'ready';
        });
    }

    public function removeFormFile(Request $request) {
        $path = public_path().'/upload/tmp/'.session()->get('folder').'/'.$request->get('name');
        $respons = false;
        if (File::exists($path)) { File::delete($path); $respons = true; }
        return response(array('respons' => $respons));
    }
}
