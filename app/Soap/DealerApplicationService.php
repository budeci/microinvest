<?php

namespace App\Soap;
use SoapClient;
class DealerApplicationService
{
    
    public function soap()
    {
        try 
        {
            ini_set("soap.wsdl_cache_enabled", 0);
            $wsdl   = resource_path().'/soap/ws/DealerApplicationService.1cws.xml';
            $options = array(
                        'login'          => 'webuser',
                        'password'       => 'W3b11$er',
                        'authentication' => 'SOAP_AUTHENTICATION_DIGEST',
                        'trace'          => true,
                        'exceptions'     => true,
                        'cache_wsdl'     => 'WSDL_CACHE_NONE',
                        'soap_version'   => 'SOAP_1_1'
                    );
            try
            {
                return new \SoapClient($wsdl, $options);
            }
            catch (Exception $e) 
            { 
                print"Ошибка создания объекта SOAP:<br>".$e->getMessage()."<br>".$e->getTraceAsString(); 
            }
        }
        catch (Exception $e)
        {
            print "Ошибка работы с SOAP:<br>".$e->getMessage()."<br>".$e->getTraceAsString();
        }
        return false;
    }

    public function authorizeUser($username=null,$password=null){
        try 
        {

            $isValidUser = $this->soap()->authorizeUser(array('user' => $username, 'password' => $password));
        }
        catch (SoapFault $e)
        {
            $error = $e->getMessage();
        }        

        if (!isset($error)) {
            $isValidUserObj = simplexml_load_string($isValidUser->return);
            $isValidUserObj = json_encode($isValidUserObj);
            $isValidUserObj = json_decode($isValidUserObj,TRUE);
            return $isValidUserObj;
        }
        return false;
    }

    public function getApps($data=null){
        $loanApps = $this->soap()->getDealerApplicationSet($data);
        if (!empty((array)$loanApps->return)){
            if (count($loanApps->return->dealerApplication) == 1){
                return array($loanApps->return->dealerApplication);
            }
            return $loanApps->return->dealerApplication;
        }  
        return array();
    }
    public function getApp($data=null){

        $loanApps = $this->soap()->getDealerApplicationSet($data);
        if (!empty((array)$loanApps->return)){
            return $loanApps->return->dealerApplication;
        }  
        return array();
    }
    public function getAppFile($data=null){

        try 
        {
            $file = $this->soap()->getLoanApplicationFile($data);
        }
        catch (SoapFault $e)
        {
            $error = $e->getMessage();
        }        
        if (!isset($error)) {
            return $file->return;
        }
        return false;
    }
    public function validateLoanApplication($data=null){

        $validateLoanApp = $this->soap()->validateLoanApplication($data);
        if (!is_soap_fault($validateLoanApp)) {
            $validateLoanAppObj = simplexml_load_string($validateLoanApp->return);
            $validateLoanAppObj = json_encode($validateLoanAppObj);
            $validateLoanAppObj = json_decode($validateLoanAppObj,TRUE);
            return $validateLoanAppObj['error']['errorCode'] == 0 ? TRUE : $validateLoanAppObj['data']['field'];
        }
        return false;
    }

    public function importLoanApplication($data=null){

        $importLoanApp = $this->soap()->importLoanApplication($data);
        if (!is_soap_fault($importLoanApp)) {
            return !empty($importLoanApp->return) ? true : false;
        }
        return false;
    }

    public function getClientData($data=null){
        try 
        {
            $clientData = $this->soap()->getClientData($data);
        }
        catch (SoapFault $e)
        {
            $error = $e->getMessage();
        }
        if (!isset($error) and !empty($clientData->return))
        {
            return $clientData->return;
        }
        return false;
    }
}