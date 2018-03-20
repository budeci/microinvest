<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Soap\LoanApplicationService;
use App\Soap\PaymentScheduleService;
use App\Soap\DealerApplicationService;
use Plupload;
use File;
use Storage;
use Validator;
use Mail;
use App\Repositories\AplicationRepository;
class AppBasic extends Controller
{
    /**
     * @var loanApp
     */
    protected $loanApp;

    protected $paymentApp;

    protected $dealerApp;

    protected $appRepository;


    public function __construct(LoanApplicationService $loanApplicationService,PaymentScheduleService $paymentScheduleService, DealerApplicationService $dealerApplicationService, AplicationRepository 
        $aplicationRepository)
    {
        $this->loanApp           = $loanApplicationService;
        $this->paymentApp        = $paymentScheduleService;
        $this->dealerApp         = $dealerApplicationService;
        $this->appRepository     = $aplicationRepository;
    }
    
    public function getAppFile($name=null, $id=null)
    {
        if (!empty($name) && !empty($id)) {
            $soap = array (
                'user'          => session()->get('auth.dealer'),
                'password'      => base64_decode(session()->get('auth.pass')),
                'applicationID' => $id,
                'fileName'      => $name
            );
            $file = $this->dealerApp->getAppFile($soap);

            $extension = pathinfo($name, PATHINFO_EXTENSION);
            header('Content-Type: application/'.$extension);
            header('Content-Disposition: attachment; filename="'.$name.'"');
            echo $file;
            exit;
        }
        return back();
        //return view('aplication.agreement', compact('apps'));
    }
    public function agreement()
    {
        $soap = array (
            'user'              => session()->get('auth.dealer'),
            'password'          => base64_decode(session()->get('auth.pass'))
        );
        $apps = $this->dealerApp->getApps($soap);
        return view('aplication.agreement', compact('apps'));
    }
    public function faq()
    {
        return view('faq');
    }
    public function getApplications()
    {
        $soap = array (
            'user'              => session()->get('auth.dealer'),
            'password'          => base64_decode(session()->get('auth.pass')),
            'loanApplicationID' => ''
        );
        $apps = $this->dealerApp->getApps($soap);
        $json = array(
            'result'    => $apps,
            'respons'   => true
        );
        return response($json);
    }
    public function getApplication(Request $request)
    {
        $soap = array (
            'user'              => session()->get('auth.dealer'),
            'password'          => base64_decode(session()->get('auth.pass')),
            'loanApplicationID' => $request->get('appId')
        );
        $app = $this->loanApp->getApp($soap);
        $color = '#f0ad4e';
        if ($app->applicationStateCode == '1') {
            $color = '#5cb85c';
        }
        elseif ($app->applicationStateCode == '2') {
             $color = '#c9302c';
        }
        $json = array(
            'stateCode' => $app->applicationStateCode,
            'result'    => view('aplication.partials.get-app', ['app' => $app])->render(),
            'color'     => $color,
            'respons'   => true
        );
        return response($json);
    }
    public function getPaymentSchedule(Request $request)
    {
        $calc = array_merge($request->get('calc'), array('partnerID' => session()->get('auth.dealer')));
        // $calc = $request->get('calc')->add('partnerID', session()->get('auth.dealer'));
        $paymentSchedule = $this->paymentApp->getPaymentSchedule($calc);
        $json = array(
            'result'  => $paymentSchedule,
            'respons' => !$paymentSchedule ? $paymentSchedule : true
        );
        return response($json);
    }
    public function getClientData(Request $request)
    {
        $soap = array (
            // 'user'     => session()->get('auth.dealer'),
            // 'password' => base64_decode(session()->get('auth.pass')),
            'IDNP'     => $request->get('idno'),
            'BirthDate' => '0001-01-01',
        );
        $clientData = $this->loanApp->getClientData($soap);
        $json = array(
            'result'      => $clientData,
            'success'     => $clientData ? true : false
        );
        return response($json);
    }
}
