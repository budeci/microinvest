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

    public function applicationNormalize($application) {
        $content = array();
        
        if(!empty($application)) {
            $fields = array (
                "id"                          	=> 'string',
                "applicationType"             	=> 'int',
                "name"                        	=> 'string',
                "surname"                     	=> 'string',
                "idno"                        	=> 'string',
                "birthDate"                   	=> 'date',
                "idSeries"                    	=> 'string',
                "idNumber"                    	=> 'string',
                "clientEducationType"         	=> 'int',
                "clientLanguage"              	=> 'int',
                "sex"                         	=> 'int',
                "socialStatus"                	=> 'int',
                "spouseName"                  	=> 'string',
                "spouseSurname"               	=> 'string',
                "familyMembersOlder18"        	=> 'int',
                "familyMembersYonger18"       	=> 'int',
                "familyMembersWithoutIncome"  	=> 'int',
                "residenceRegionID"           	=> 'string',
                "residenceCityID"             	=> 'string',
                "residenceRegionType"         	=> 'int',
                "residenceStreet"             	=> 'string',
                "residencePostalCode"         	=> 'string',
                "residenceHouse"              	=> 'string',
                "residenceApartment"          	=> 'int',
                "residencePropertyType"       	=> 'int',
                "officialResidenceRegionID"   	=> 'string',
                "officialResidenceCityID"     	=> 'string',
                "officialResidenceRegionType" 	=> 'int',
                "officialResidenceStreet"     	=> 'string',
                "officialResidencePostalCode" 	=> 'string',
                "officialResidenceHouse"      	=> 'string',
                "officialResidencePropertyType" => 'int',
                "clientEducationType"         	=> 'int',
                "phoneHome"                   	=> 'string',
                "phoneWork"                   	=> 'string',
                "phoneCell"                   	=> 'string',
                "clientEmail"                 	=> 'string',
                "clientComment"               	=> 'string',
                "employer"                    	=> 'string',
                "employerFieldID"             	=> 'string',
                "employerFieldDescription"    	=> 'string',
                "employerAddress"             	=> 'string',
                "employerClientPosition"    	=> 'string',
                "employerStartDate"           	=> 'date',
                "employerEmployees"           	=> 'int',
                "employerCompanyTypeID"       	=> 'string',
                "employerPhone"       	        => 'string',
                "incomeSalary"                	=> 'int',
                "incomePension"               	=> 'int',
                "incomeDividents"             	=> 'int',
                "incomeInterest"              	=> 'int',
                "incomeRent"                  	=> 'int',
                "incomeMoneyTransfers"        	=> 'int',
                "incomeOther"                 	=> 'int',
                "incomeOtherMembers"          	=> 'int',
                "contact"                     	=> 'string',
                "contactEmployer"             	=> 'string',
                "contactAddress"              	=> 'string',
                "contactPhoneCell"            	=> 'string',
                "contactPhoneHome"            	=> 'string',
                "paymentDay"                  	=> 'int',
                "currency"                    	=> 'string',
                "branchID"                    	=> 'string',
                "dealerID"                    	=> 'string',
                "clientComment"              	=> 'string',
                "partnerOrganization"         	=> 'string',
                "partnerComment"              	=> 'string',
                "agreementPDprocessing"        	=> 'bool',
                "agreementPDstorage"        	=> 'bool',
                "agreementCreditHistoryAccess"  => 'bool',
                "agreementCreditHistorySending" => 'bool',
                "Patronymic"                	=> 'string',
                "contactPatronymic"             => 'string',
                "Brand"             	        => 'string',
                "Model"             	        => 'string',
                "YearOfManufacture"             => 'string',
                "PEP"             	            => 'bool',
                "loanPurposeRows"               => array (
                    "loanPurpose"           => 'string',
                    "totalCost"             => 'int',
                    "clientContribution"    => 'int',
                    "modelSN"               => 'string',
                    
                ),
                "financialObligationsRows"      => array (
                    "financialInstitution" => '',
                    "purpose"              => '',
                    "totalDebt"            => '',
                    "monthlyPayment"       => '',
                    "currency"             => ''
                ),
                "movablePropertyRows"           => array (
                    "description"         => '',
                    "registrationNumber"  => '',
                    "propertyType"        => ''                
                ),
                "realEstateRows"                => array (
                    "description"         => '',
                    "propertyType"        => ''              
                ),    
                "fileAttachmentSet"             => 'array',
            );
            
                
            $application = (array)$application;
            
            foreach($fields as $field_name => $field_type)
            {
                //Normalize subarrays
                if (isset($application[$field_name])) {
                    if(is_array($field_type)) {
                        $content[$field_name] = $this->normalizeValue('array', $application[$field_name]);
                        $normalizedArray = array();
                        foreach ($content[$field_name] as $index => $array_values) { 
                            foreach($field_type as $array_field => $array_field_type) {
                                if(is_array($array_values)) {             
                                    $normalizedArray[$index][$array_field] = $this->normalizeValue($array_field_type, $array_values[$array_field]);
                                } else {
                                    $normalizedArray[$array_field] = $this->normalizeValue($array_field_type, $array_values);
                                }
                            }
                        }
                        $content[$field_name] = $normalizedArray;
                    } else {
                        $content[$field_name] = $this->normalizeValue($field_type, $application[$field_name]);
                    }
                }
            }
        }
        return $content;
    }
    
    public function normalizeValue($type, $val) {
        switch ($type) {
        case 'int':
            $val = intval($val);
            break;
        case 'bool':
            $val = (bool)$val;
            break;
        case 'date':
            $val = (!empty($val) and $val != "0000-00-00") ? date("Y-m-d",strtotime((string)$val)) : "0001-01-01";
            break;
        case 'datetime':
            $val = (!empty($val) and $val != "0000-00-00 00:00:00") ? date("Y-m-d",strtotime((string)$val)) : "0001-01-01";
            break;
        case 'array':
            if(empty($val)) $val = array();
            elseif(!is_array($val))  $val = array($val);
            break;
        default:
            $val = strval($val);
        }
        return $val;
    }
}
