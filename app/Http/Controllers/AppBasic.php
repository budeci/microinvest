<?php

namespace App\Http\Controllers;

class AppBasic extends Controller
{
    public function applicationNormalize($application) {
        $content = array();
        if(!empty($application)) {
            $fields = array (
                "id"                          	=> 'string',
                "applicationType"             	=> 'int',
                "applicationVariant"            => 'int',
                "loanProductID"                	=> 'string',
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
                "officialResidenceApartment"    => 'int',
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
                "creditTerm"                  	=> 'int',
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
                    "financialInstitution" => 'string',
                    "purpose"              => 'string',
                    "totalDebt"            => 'int',
                    "monthlyPayment"       => 'int',
                    "currency"             => 'string'
                ),
                "movablePropertyRows"           => array (
                    "description"         => 'string',
                    "registrationNumber"  => 'string',
                    "propertyType"        => 'int'                
                ),
                "realEstateRows"                => array (
                    "description"         => 'string',
                    "propertyType"        => 'int'              
                ),    
                "fileAttachmentSet"       => 'array',
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
                            $normalizedArray[$index] = $this->normalizeValue($field_type[$index], $array_values);
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
            $val = !empty($val) ? intval($val) : '';
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
