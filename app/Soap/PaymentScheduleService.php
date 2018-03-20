<?php

namespace App\Soap;
use SoapClient;
class PaymentScheduleService
{

    public function soap()
    {
        try
        {
            ini_set("soap.wsdl_cache_enabled", 0);
            $wsdl   = resource_path().'/soap/ws/PaymentScheduleService.1cws.xml';
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

    public function getLoanProductSet($partnerID='partener'){
        try 
        {
            $getLoanProduct = $this->soap()->getLoanProductSet(array('partnerID' => $partnerID));
        }
        catch (SoapFault $e)
        {
            $error = $e->getMessage();
        }    

        if (!isset($error) and !empty($getLoanProduct->return->loanProductSetItem))
        {
            $loanProduct = array();
            $loanProductSetItem = $getLoanProduct->return->loanProductSetItem;
            if (count($loanProductSetItem) == 1) {
                $loanProduct[$loanProductSetItem->id] = (array)$loanProductSetItem;
                if ($loanProductSetItem->LoanProductCurrencySet) {
                    if(count($loanProductSetItem->LoanProductCurrencySet->LoanProductCurrencySetItem) == 1){
                        $loanProduct[$loanProductSetItem->id]['limit'][$loanProductSetItem->LoanProductCurrencySet->LoanProductCurrencySetItem->Currency] = (array)$loanProductSetItem->LoanProductCurrencySet->LoanProductCurrencySetItem;
                    } else {
                        foreach ($loanProductSetItem->LoanProductCurrencySet->LoanProductCurrencySetItem as $key => $currency){
                            $loanProduct[$loanProductSetItem->id]['limit'][$currency->Currency] = (array)$currency; 
                        }
                    }
                    unset($loanProduct[$loanProductSetItem->id]['loanProductSetItem']['LoanProductCurrencySet']);
                }
            }else{
                foreach ($loanProductSetItem as $data){
                    $loanProduct[$data->id] = (array)$data;
                    if ($data->LoanProductCurrencySet) {
                        if(count($data->LoanProductCurrencySet->LoanProductCurrencySetItem) == 1){
                            $loanProduct[$data->id]['limit'][$data->LoanProductCurrencySet->LoanProductCurrencySetItem->Currency] = (array)$data->LoanProductCurrencySet->LoanProductCurrencySetItem;
                        } else {
                            foreach ($data->LoanProductCurrencySet->LoanProductCurrencySetItem as $key => $currency){
                               $loanProduct[$data->id]['limit'][$currency->Currency] = (array)$currency; 
                            }
                        }
                        unset($loanProduct[$data->id]['LoanProductCurrencySet']);
                    }
                }
            }
            return $loanProduct;
        }
        return [];
    }

    public function getPaymentSchedule($data=null){
        try 
        {
            $scheduleResponse = $this->soap()->getPaymentSchedule($data);
        }
        catch (SoapFault $e)
        {
            $error = $e->getMessage();
        }    
        if (!isset($error) and !empty((array)$scheduleResponse->return))
        {
            $monthlyPayment = $scheduleResponse->return->paymentSchedule;
            if (!empty((array)$scheduleResponse->return)){
                if (count($scheduleResponse->return->paymentSchedule) == 1){
                    return array($scheduleResponse->return->paymentSchedule);
                }
                return $scheduleResponse->return->paymentSchedule;
            }  
            return array();
            // $currentPayment = array_shift($monthlyPayment);
            // return $monthlyPayment;
        }
        return false;
    }
    
    public function file_get_contents_curl($url) {
        $ch = curl_init();
     
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, 'webuser:W3b11$er');
     
        curl_setopt($ch, CURLOPT_URL, $url);
     
        $data = curl_exec($ch);
        curl_close($ch);
     
        return $data;
    }
}