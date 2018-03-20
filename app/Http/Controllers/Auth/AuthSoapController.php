<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use Validator;
use App\Soap\LoanApplicationService;
use App\Soap\DealerApplicationService;
use App\Http\Controllers\Controller;
use App\Repositories\AplicationRepository;
use App\Repositories\AplicationFileRepository;
use File;
class AuthSoapController extends Controller
{
    /**
     * @var loanApp
     */
    protected $loanApp;

    protected $dealerApp;

    protected $appRepository;

    protected $appFileRepository;

    public function __construct(LoanApplicationService $loanApplicationService, DealerApplicationService $dealerApplicationService, AplicationRepository 
        $aplicationRepository,AplicationFileRepository $aplicationFileRepository)
    {
        $this->loanApp           = $loanApplicationService;
        $this->appRepository     = $aplicationRepository;
        $this->dealerApp         = $dealerApplicationService;
        //$this->appFileRepository = $aplicationFileRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function getLogin()
    {
        if (!session()->has('auth')) {
            return view('auth.login');
        }
        $redirect = $this->redirectUrl();
        return redirect($redirect);
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dealer'   => 'required|min:4|max:15',
            'password' => 'required|min:4|max:15'
        ]);
        if (!$validator->fails()){
            $user = $this->dealerApp->authorizeUser($request->get('dealer'),$request->get('password'));
            if (!empty($user['data'])) {
                $variant = $user['data']['applicationVariant'];
                session()->put('auth.dealer', $request->get('dealer'));
                session()->put('auth.pass', base64_encode($request->get('password')));
                session()->put('auth.status', true);
                session()->put('auth.applicationVariant', $variant);
                $redirect = $this->redirectUrl();
                return redirect($redirect);
            }else{
                 return back()->withErrors(trans('auth.failed'));
            }
        } else{
            return back()->withErrors($validator);
        }
    }
    public function logout()
    {
        if (session()->has('auth')) {
            $getOpenApp = $this->appRepository->getOpenApp();
            if ($getOpenApp) {
                if ($getOpenApp->aplicationFile) {
                    File::delete(array_pluck($getOpenApp->aplicationFile, 'full_path'));
                }
                $this->appRepository->delete($getOpenApp->id);
            }
            session()->remove('auth');
        }
        return redirect('/');
    }
    public function redirectUrl()
    {
        $variant =  session()->has('auth.applicationVariant') ? session()->get('auth.applicationVariant') : '1';
        if ($variant == '1') {
            $redirect = route('standart');
        } elseif ($variant == '2') {
            $redirect = route('business');                        
        } elseif ($variant == '3') {
           $redirect = route('credit_auto');                        
        } else{
			$redirect = route('online');
		}
        return $redirect;
    }
}
