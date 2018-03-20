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
class AppOnlineController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $loanProduct = $this->paymentApp->getLoanProductSet(session()->get('auth.dealer'));       
        return view('aplication.online', compact('loanProduct'));
    }

    public function aplicationPost(Request $request)
    {
        $getOpenApp   = $this->appRepository->getOpenApp();

        $loanDataInit = $request->get('app');
        $contact      = $loanDataInit['contactFirst'].' '.$loanDataInit['contactLast'];
        // $date         = date("Y-m-d", strtotime((string)$loanDataInit['birthDate']));
        $loanData     = array_merge($loanDataInit,array(
                                "id"                            => uniqid(),
                                "dealerID"                      => $getOpenApp->dealer,
                                "contact"                       => $contact, 
                                "applicationVariant"            => '4',
                                "birthDate"                     => '0001-01-01',
                                "idSeries"                      => '',
                                "idNumber"                      => '',
                                "clientEducationType"           => '',
                                "clientLanguage"                => '', 
                                "sex"                           => '',
                                "socialStatus"                  => '',
                                "spouseName"                    => '',
                                "spouseSurname"                 => '',
                                "familyMembersOlder18"          => '',
                                "familyMembersYonger18"         => '',
                                "familyMembersWithoutIncome"    => '',
                                "residenceRegionID"             => '',
                                "residenceCityID"               => '',
                                "residenceRegionType"           => '',
                                "residenceStreet"               => '',
                                "residencePostalCode"           => '',
                                "residenceHouse"                => '',
                                "residenceApartment"            => '',
                                "residencePropertyType"         => '',
                                "officialResidenceRegionID"     => '',
                                "officialResidenceCityID"       => '',
                                "officialResidenceRegionType"   => '',
                                "officialResidenceStreet"       => '',
                                "officialResidencePostalCode"   => '',
                                "officialResidenceHouse"        => '',
                                "officialResidenceApartment"    => '',
                                "officialResidencePropertyType" => '',
                                "phoneHome"                     => '',
                                "phoneWork"                     => '',
                                "clientEmail"                   => '',
                                "employer"                      => '',
                                "employerFieldID"               => '',
                                "employerFieldDescription"      => '',
                                "employerAddress"               => '',
                                "employerClientPosition"        => '',
                                "employerStartDate"             => date("Y-m-d"),
                                "employerEmployees"             => '',
                                "employerCompanyTypeID"         => '',
                                "employerPhone"                 => '',
                                "incomeSalary"                  => '',
                                "incomePension"                 => '',
                                "incomeDividents"               => '',
                                "incomeInterest"                => '',
                                "incomeRent"                    => '',
                                "incomeMoneyTransfers"          => '',
                                "incomeOther"                   => '',
                                "incomeOtherMembers"            => '',
                                "contactEmployer"               => '',
                                "contactAddress"                => '',
                                "contactPhoneHome"              => '',
                                "paymentDay"                    => '',
                                "currency"                      => '',
                                // "branchID"                      => '',
                                "clientComment"                 => '',
                                "partnerOrganization"           => '',
                                "Patronymic"                    => '',
                                "contactPatronymic"             => '',
                                "Brand"                         => '',
                                "Model"                         => '',
                                "YearOfManufacture"             => '',
                                "financialObligationsRows"      => array (
                                    "financialInstitution" => '',
                                    "purpose"              => '',
                                    "totalDebt"            => '',
                                    "monthlyPayment"       => '',
                                    "currency"             => ''
                                ),
                                "movablePropertyRows"      => array (
                                    "description"        => '',
                                    "registrationNumber" => '',
                                    "propertyType"       => ''                
                                ),
                                "realEstateRows"          => array (
                                    "description"  => '',
                                    "propertyType" => ''              
                                )
                        ));
        unset($loanData['contactFirst'], $loanData['contactLast']);

        /*$validator = Validator::make($loanData, [
            'name'     => 'required|min:4|max:15',
            'password' => 'required|min:4|max:15'
        ]);*/
        $attach = array();
        $files = $getOpenApp->aplicationFile;
        foreach ($files as $key => $file) {
            //$extension = File::extension(public_path().$file->file);
            $fp = fopen(public_path().$file->file, 'r');
            if ($fp and $data = fread($fp, filesize(public_path().$file->file)))
            {
                fclose($fp);
                $attach[$key]['name'] = basename(public_path().$file->file);
                $attach[$key]['data'] = $data;
            }
        }
        $loanData['fileAttachmentSet'] = $attach;

        $soap = array (
            'user'                   => '',
            'password'               => '',
            'unifiedLoanApplication' => $loanData
        );
        // dd($soap);
        //$this->getOpenApp->save();
        
        $validateLoanApp = $this->loanApp->validateLoanApplication($soap);


        if ($validateLoanApp == true) {
            $email = array();
            if (isset($loanData['sendEmail'])) {
                if (isset($loanData['sendEmailTest'])) {
                    array_push($email, 'budeci.mihail@gmail.com');
                }else{
                    array_push($email, "serghei.ceban@microinvest.md", "olesea.cobzari@microinvest.md", "callcentru@microinvest.md", "cristina.ciobanu@microinvest.md");
                }
                $send = $this->sendAppToEmail($files, $soap, $email);
            }
        // $send_email = $this->sendAppToEmail($files, $loanData, array(base64_decode('YnVkZWNpLm1paGFpbEBnbWFpbC5jb20=')));    
        }

        if ($validateLoanApp == true) {
            $importLoanApp = $this->loanApp->importLoanApplication($soap);
            if ($importLoanApp) {
                $this->appRepository->save($getOpenApp, array('status'=>'close'));
                $this->appRepository->addApp();
                return back()->withSuccess('Success');
                // return redirect()->route('agreement')->withSuccess('Success');
            }
        }else{
            return back()->withErrors('Errors');
        }
        return 'FALSE';
    }

    public function sendAppToEmail($files, $app, $email) {
        $send = Mail::send('email.app', compact('app'), function ($message) use ($files, $app, $email) {
            $message->to($email)->subject("Microinvest cerere Online");
            foreach ($files as $file) {
               $message->attach(public_path().$file->file);

            }

        });
        // dd($send);
        return $send;
    } 
}
