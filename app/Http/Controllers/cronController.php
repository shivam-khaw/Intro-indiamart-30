<?php

namespace App\Http\Controllers;

use App\Models\Indiamart;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class cronController extends Controller
{
    public $client_id = 'app.65d87d166e9d26.16679595';
    public $client_secret = 'pvK3dpTmlwqN2yTgcEcE1OOdmSUCQMerFoKxv0o2LJgUk7rRvu';


    function bitrix24_api($access_token, $url = '', $fields = '')
    {
        $ch = curl_init();

        // Set cURL options for POST request
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $fields,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $access_token,
                'Content-Type: application/json'
            )
        ));

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for errors
        if ($response === false) {
            echo 'Error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        return $response;
    }
    
   function token_save()
{
    
    $tokenData = Indiamart::whereNotNull('metch_bitrix24_url')
                          ->whereNotNull('refresh_token')
                          ->get();

    foreach ($tokenData as $value) {
        $domain = $value['metch_bitrix24_url'];
        $refresh_token = $value['refresh_token'];
        $new_token = $this->refresh_token($domain, $this->client_id, $this->client_secret, $refresh_token);
         if(!empty($new_token)){
        $domainName = $new_token['domain'];
        $refreshNewToken = $new_token['refresh_token'];
        $newAccessToken = $new_token['access_token']; // Fixed variable name
        
        // Update the record in the database
        $data = DB::table('indiamarts')
                  ->where('metch_bitrix24_url', $domainName)
                  ->update([
                      'refresh_token' => $refreshNewToken,
                      'acess_token' => $newAccessToken
                  ]);
                   if($data){
                        echo json_encode($new_token);
                   }
         }
    }
}

private function refresh_token($domain="", $client_id, $client_secret, $refresh_token="")
{
    $url = "https://{$domain}/oauth/token/";
    $data = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'refresh_token' => $refresh_token,
        'grant_type' => 'refresh_token'
    );

    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-Type: application/x-www-form-urlencoded',
            'content' => http_build_query($data)
        )
    );

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    if ($response === FALSE) {
        // Handle error
        echo 'Error refreshing access token';
        return false;
    }

    $response_data = json_decode($response, true);
   
    return $response_data;
}
    function  indiamart_api($url = '')
    {


        $curl = curl_init();

        $data = array();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen(http_build_query($data)),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $indiamartData =  json_decode($response, true);
        return $indiamartData;
    }


public function gold()
{

    $getUserData = DB::table('payments')
        ->join('indiamarts', function ($join) {
            $join->on('payments.user_id', '=', 'indiamarts.user_id')
                ->where('payments.plan_status', '=', 1)
                ->where('payments.plan', '=', 'gold');
        })
        ->where('indiamarts.status', '=', 1)
        ->get();
    if ($getUserData->isEmpty()) {
        echo '<h1>Record Not found!</h1>';
    } else {

        // $getUserData = DB::table('indiamarts')->where('status', '=', '1')->get();
        $startDate = date("d-M-Y");
        $endDate = date("d-M-Y");


        foreach ($getUserData as $userValue) {
            $domainName = $userValue->metch_bitrix24_url;
            $token = $userValue->acess_token;
            $apiKey = $userValue->api_key;
            $userId = $userValue->user_id;
            $result = DB::table('bitrix24_fields')->where('status', '=', '1')->where('user_id', '=', $userId)->get();
            $urlData = 'https://mapi.indiamart.com/wservce/crm/crmListing/v2/?glusr_crm_key=' . $apiKey . '&start_time=' . $startDate . '&end_time=' . $endDate;
            $indiaMartData = $this->indiamart_api($urlData);
            // print_r($indiaMartData);
            // print_r($indiaMartData);


            if (isset($result[0]->entity_type) && $result[0]->entity_type == "deal") {
                $mcatName =  $result[0]->query_mcat_name;
                $queryMsg =   $result[0]->query_msg;
                $queryProduct = $result[0]->query_product;
                $queryIso = $result[0]->country_iso;
                $senderPin = $result[0]->sender_pin;
                $senderState = $result[0]->sender_state;
                $senderCity = $result[0]->sender_city;
                $senderAdd = $result[0]->sender_add;
                $senderCompany = $result[0]->sender_company;
                $subject = $result[0]->subject;
                $senderEmail = $result[0]->sender_email;
                $senderPhone = $result[0]->sender_phone;
                $senderName = $result[0]->sender_name;
                $queryTime = $result[0]->query_time;
                $queryType =  $result[0]->query_type;
                $queryId = $result[0]->query_id;
                $sorceId = $result[0]->sorce;

                foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                    $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                    $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                    $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                    // $phone = $valueIndiamart['SENDER_PHONE'];
                    $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                    $pincode =  $valueIndiamart['SENDER_PINCODE'];
                    $state = $valueIndiamart['SENDER_STATE'];
                    $city = $valueIndiamart['SENDER_CITY'];
                    $add = $valueIndiamart['SENDER_ADDRESS'];
                    $company = $valueIndiamart['SENDER_COMPANY'];
                    $subject1 = $valueIndiamart['SUBJECT'];
                    $email = $valueIndiamart['SENDER_EMAIL'];
                    $phone = $valueIndiamart['SENDER_MOBILE'];
                    $name = $valueIndiamart['SENDER_NAME'];
                    $time = $valueIndiamart['QUERY_TIME'];
                    $type = $valueIndiamart['QUERY_TYPE'];
                    $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                    $addData['fields'][$mcatName] = $mcat;
                    $addData['fields'][$queryMsg] = $msg;
                    $addData['fields'][$queryProduct] = $product;
                    $addData['fields'][$queryIso] = $country;
                    $addData['fields'][$senderPin] = $pincode;
                    $addData['fields'][$senderState] = $state;
                    $addData['fields'][$senderCity] = $city;
                    $addData['fields'][$senderAdd] = $add;
                    $addData['fields'][$subject] = $subject1;
                    $addData['fields'][$senderCompany] = $company;
                    $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                    $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                    $addData['fields'][$senderName] = $name;
                    $addData['fields'][$queryTime] = $time;
                    $addData['fields'][$queryType] = $type;
                    $addData['fields'][$queryId] = $id;
                    $addData['fields']['SOURCE_ID'] = $sorceId;
                    if ($id) {
                        $filterFields = array();
                        $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                        $endpoint = 'crm.deal.list';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                        $decodedResponse = json_decode($bitrixResponse, true);
                    }
                    if (!empty($decodedResponse['result'])) {
                        $entityId = $decodedResponse['result'][0]['ID'];
                        echo "deal alredy exist:- {$entityId}<br>";
                    } else {
                        $contactFields = array(
                            "fields" => array(
                                "NAME" => $name,
                                "ADDRESS" => $add,
                                "ADDRESS_POSTAL_CODE" => $pincode,
                                "ADDRESS_REGION" => $state,
                                "ADDRESS_CITY" => $city,
                                "PHONE" => array(
                                    array(
                                        "VALUE" => $phone,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                ),
                                "EMAIL" => array(
                                    array(
                                        "VALUE" => $email,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                )
                            )
                        );

                        $dealContact = json_encode($contactFields);
                        $endpoint = 'crm.contact.add';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                        $contactData =  $this->bitrix24_api($token, $url, json_encode($contactFields));
                        $contactDecode  =  json_decode($contactData, true);
                        if (isset($contactDecode['result'])) {
                             $contactId = $contactDecode['result'];
                            $addData['fields']['CONTACT_ID'] = $contactId;
                           $endpoint = 'crm.deal.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                             $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "deal created!<br>";
                            // echo json_encode($addData);
                        }
                    }
                }
            }
            if (isset($result[0]->entity_type) && $result[0]->entity_type == "Lead") {
                $mcatName =  $result[0]->query_mcat_name;
                $queryMsg =   $result[0]->query_msg;
                $queryProduct = $result[0]->query_product;
                $queryIso = $result[0]->country_iso;
                $senderPin = $result[0]->sender_pin;
                $senderState = $result[0]->sender_state;
                $senderCity = $result[0]->sender_city;
                $senderAdd = $result[0]->sender_add;
                $senderCompany = $result[0]->sender_company;
                $subject = $result[0]->subject;
                $senderEmail = $result[0]->sender_email;
                $senderPhone = $result[0]->sender_phone;
                $senderName = $result[0]->sender_name;
                $queryTime = $result[0]->query_time;
                $queryType =  $result[0]->query_type;
                $queryId = $result[0]->query_id;
                $sorceId = $result[0]->sorce;

                foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                    $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                    $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                    $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                    $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                    $pincode =  $valueIndiamart['SENDER_PINCODE'];
                    $state = $valueIndiamart['SENDER_STATE'];
                    $city = $valueIndiamart['SENDER_CITY'];
                    $add = $valueIndiamart['SENDER_ADDRESS'];
                    $company = $valueIndiamart['SENDER_COMPANY'];
                    $subject1 = $valueIndiamart['SUBJECT'];
                    $email = $valueIndiamart['SENDER_EMAIL'];
                    $phone = $valueIndiamart['SENDER_MOBILE'];
                    $name = $valueIndiamart['SENDER_NAME'];
                    $time = $valueIndiamart['QUERY_TIME'];
                    $type = $valueIndiamart['QUERY_TYPE'];
                    $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                    $addData['fields'][$mcatName] = $mcat;
                    $addData['fields'][$queryMsg] = $msg;
                    $addData['fields'][$queryProduct] = $product;
                    $addData['fields'][$queryIso] = $country;
                    $addData['fields'][$senderPin] = $pincode;
                    $addData['fields'][$senderState] = $state;
                    $addData['fields'][$senderCity] = $city;
                    $addData['fields'][$senderAdd] = $add;
                    $addData['fields'][$subject] = $subject1;
                    $addData['fields'][$senderCompany] = $company;
                    $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                    $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                    $addData['fields'][$senderName] = $name;
                    $addData['fields'][$queryTime] = $time;
                    $addData['fields'][$queryType] = $type;
                    $addData['fields'][$queryId] = $id;
                    $addData['fields']['SOURCE_ID'] = $sorceId;

                    // echo json_encode($addData);
                    if ($id) {
                        $filterFields = array();
                        $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                        $endpoint = 'crm.lead.list';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                        $decodedResponse = json_decode($bitrixResponse, true);
                    }
                    if (!empty($decodedResponse['result'])) {
                        $entityId = $decodedResponse['result'][0]['ID'];
                        echo "Lead alredy exist:- {$entityId}<br>";
                    } else {
                        //echo json_encode($addData);
                        $endpoint = 'crm.lead.add';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        echo  $this->bitrix24_api($token, $url, json_encode($addData));
                        echo "Lead created!<br>";
                    }
                }
            }
            if (isset($result[1]->entity_type) && $result[1]->entity_type == "deal") {
                $mcatName =  $result[1]->query_mcat_name;
                $queryMsg =   $result[1]->query_msg;
                $queryProduct = $result[1]->query_product;
                $queryIso = $result[1]->country_iso;
                $senderPin = $result[1]->sender_pin;
                $senderState = $result[1]->sender_state;
                $senderCity = $result[1]->sender_city;
                $senderAdd = $result[1]->sender_add;
                $senderCompany = $result[1]->sender_company;
                $subject = $result[1]->subject;
                $senderEmail = $result[1]->sender_email;
                $senderPhone = $result[1]->sender_phone;
                $senderName = $result[1]->sender_name;
                $queryTime = $result[1]->query_time;
                $queryType =  $result[1]->query_type;
                $queryId = $result[1]->query_id;
                $sorceId = $result[1]->sorce;

                foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                    $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                    $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                    $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                    $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                    $pincode =  $valueIndiamart['SENDER_PINCODE'];
                    $state = $valueIndiamart['SENDER_STATE'];
                    $city = $valueIndiamart['SENDER_CITY'];
                    $add = $valueIndiamart['SENDER_ADDRESS'];
                    $company = $valueIndiamart['SENDER_COMPANY'];
                    $subject1 = $valueIndiamart['SUBJECT'];
                    $email = $valueIndiamart['SENDER_EMAIL'];
                    $phone = $valueIndiamart['SENDER_MOBILE'];
                    $name = $valueIndiamart['SENDER_NAME'];
                    $time = $valueIndiamart['QUERY_TIME'];
                    $type = $valueIndiamart['QUERY_TYPE'];
                    $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                    $addData['fields'][$mcatName] = $mcat;
                    $addData['fields'][$queryMsg] = $msg;
                    $addData['fields'][$queryProduct] = $product;
                    $addData['fields'][$queryIso] = $country;
                    $addData['fields'][$senderPin] = $pincode;
                    $addData['fields'][$senderState] = $state;
                    $addData['fields'][$senderCity] = $city;
                    $addData['fields'][$senderAdd] = $add;
                    $addData['fields'][$subject] = $subject1;
                    $addData['fields'][$senderCompany] = $company;
                    $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                    $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                    $addData['fields'][$senderName] = $name;
                    $addData['fields'][$queryTime] = $time;
                    $addData['fields'][$queryType] = $type;
                    $addData['fields'][$queryId] = $id;
                    $addData['fields']['SOURCE_ID'] = $sorceId;

                    //echo json_encode($addData);
                   if ($id) {
                        $filterFields = array();
                        $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                        $endpoint = 'crm.deal.list';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                        $decodedResponse = json_decode($bitrixResponse, true);
                    }
                    if (!empty($decodedResponse['result'])) {
                        $entityId = $decodedResponse['result'][0]['ID'];
                        echo "deal alredy exist:- {$entityId}<br>";
                    } else {
                        $contactFields = array(
                            "fields" => array(
                                "NAME" => $name,
                                "ADDRESS" => $add,
                                "ADDRESS_POSTAL_CODE" => $pincode,
                                "ADDRESS_REGION" => $state,
                                "ADDRESS_CITY" => $city,
                                "PHONE" => array(
                                    array(
                                        "VALUE" => $phone,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                ),
                                "EMAIL" => array(
                                    array(
                                        "VALUE" => $email,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                )
                            )
                        );

                        $dealContact = json_encode($contactFields);
                        $endpoint = 'crm.contact.add';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                        $contactData =  $this->bitrix24_api($token, $url, json_encode($contactFields));
                        $contactDecode  =  json_decode($contactData, true);
                        if (isset($contactDecode['result'])) {
                             $contactId = $contactDecode['result'];
                            $addData['fields']['CONTACT_ID'] = $contactId;
                           $endpoint = 'crm.deal.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                             $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "deal created!<br>";
                            // echo json_encode($addData);
                        }
                    }
                }
            }
            if (isset($result[1]->entity_type) && $result[1]->entity_type == "Lead") {
                $mcatName =  $result[1]->query_mcat_name;
                $queryMsg =   $result[1]->query_msg;
                $queryProduct = $result[1]->query_product;
                $queryIso = $result[1]->country_iso;
                $senderPin = $result[1]->sender_pin;
                $senderState = $result[1]->sender_state;
                $senderCity = $result[1]->sender_city;
                $senderAdd = $result[1]->sender_add;
                $senderCompany = $result[1]->sender_company;
                $subject = $result[1]->subject;
                $senderEmail = $result[1]->sender_email;
                $senderPhone = $result[1]->sender_phone;
                $senderName = $result[1]->sender_name;
                $queryTime = $result[1]->query_time;
                $queryType =  $result[1]->query_type;
                $queryId = $result[1]->query_id;
                $sorceId = $result[1]->sorce;

                foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                    $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                    $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                    $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                    //$phone = $valueIndiamart['SENDER_PHONE'];
                    $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                    $pincode =  $valueIndiamart['SENDER_PINCODE'];
                    $state = $valueIndiamart['SENDER_STATE'];
                    $city = $valueIndiamart['SENDER_CITY'];
                    $add = $valueIndiamart['SENDER_ADDRESS'];
                    $company = $valueIndiamart['SENDER_COMPANY'];
                    $subject1 = $valueIndiamart['SUBJECT'];
                    $email = $valueIndiamart['SENDER_EMAIL'];
                    $phone = $valueIndiamart['SENDER_MOBILE'];
                    $name = $valueIndiamart['SENDER_NAME'];
                    $time = $valueIndiamart['QUERY_TIME'];
                    $type = $valueIndiamart['QUERY_TYPE'];
                    $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                    $addData['fields'][$mcatName] = $mcat;
                    $addData['fields'][$queryMsg] = $msg;
                    $addData['fields'][$queryProduct] = $product;
                    $addData['fields'][$queryIso] = $country;
                    $addData['fields'][$senderPin] = $pincode;
                    $addData['fields'][$senderState] = $state;
                    $addData['fields'][$senderCity] = $city;
                    $addData['fields'][$senderAdd] = $add;
                    $addData['fields'][$subject] = $subject1;
                    $addData['fields'][$senderCompany] = $company;
                    $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                    $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                    $addData['fields'][$senderName] = $name;
                    $addData['fields'][$queryTime] = $time;
                    $addData['fields'][$queryType] = $type;
                    $addData['fields'][$queryId] = $id;
                    $addData['fields']['SOURCE_ID'] = $sorceId;

                    //echo json_encode($addData);
                    if ($id) {
                        $filterFields = array();
                        $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                        $endpoint = 'crm.lead.list';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                        $decodedResponse = json_decode($bitrixResponse, true);
                    }
                    if (!empty($decodedResponse['result'])) {
                        $entityId = $decodedResponse['result'][0]['ID'];
                        echo "Lead alredy exist:- {$entityId}<br>";
                    } else {
                        $endpoint = 'crm.lead.add';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        echo $this->bitrix24_api($token, $url, json_encode($addData));
                        echo "Lead created!<br>";
                    }
                }
            }
        }
    }
}
  public function platinum()
    {
      
        $getUserData = DB::table('payments')
            ->join('indiamarts', function ($join) {
                $join->on('payments.user_id', '=', 'indiamarts.user_id')
                    ->where('payments.plan_status', '=', 1)
                    ->where(function ($query) {
                        $query->where('payments.plan', '=', 'platinum')
                            ->orWhere('payments.plan', '=', 'trial');
                    });
            })
            ->where('indiamarts.status', '=', 1)
            ->get();
        if ($getUserData->isEmpty()) {
            echo '<h1>Record Not found!</h1>';
        } else {
            $startDate = date("d-M-Y");
            $endDate = date("d-M-Y");


            foreach ($getUserData as $userValue) {
                 $domainName = $userValue->metch_bitrix24_url;
                $token = $userValue->acess_token;
                $apiKey = $userValue->api_key;
                $userId = $userValue->user_id;
                $result = DB::table('bitrix24_fields')->where('status', '=', '1')->where('user_id', '=', $userId)->get();
                $urlData = 'https://mapi.indiamart.com/wservce/crm/crmListing/v2/?glusr_crm_key=' . $apiKey . '&start_time=' . $startDate . '&end_time=' . $endDate;
                $indiaMartData = $this->indiamart_api($urlData);
                //print_r($result);
               // print_r($indiaMartData);


               if (isset($result[0]->entity_type) && $result[0]->entity_type == "deal") {
                    $mcatName =  $result[0]->query_mcat_name;
                    $queryMsg =   $result[0]->query_msg;
                    $queryProduct = $result[0]->query_product;
                    $queryIso = $result[0]->country_iso;
                    $senderPin = $result[0]->sender_pin;
                    $senderState = $result[0]->sender_state;
                    $senderCity = $result[0]->sender_city;
                    $senderAdd = $result[0]->sender_add;
                    $senderCompany = $result[0]->sender_company;
                    $subject = $result[0]->subject;
                    $senderEmail = $result[0]->sender_email;
                    $senderPhone = $result[0]->sender_phone;
                    $senderName = $result[0]->sender_name;
                    $queryTime = $result[0]->query_time;
                    $queryType =  $result[0]->query_type;
                    $queryId = $result[0]->query_id;
                    $sorceId = $result[0]->sorce;

                    foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                        $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                        $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                        $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                        // $phone = $valueIndiamart['SENDER_PHONE'];
                        $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                        $pincode =  $valueIndiamart['SENDER_PINCODE'];
                        $state = $valueIndiamart['SENDER_STATE'];
                        $city = $valueIndiamart['SENDER_CITY'];
                        $add = $valueIndiamart['SENDER_ADDRESS'];
                        $company = $valueIndiamart['SENDER_COMPANY'];
                        $subject1 = $valueIndiamart['SUBJECT'];
                        $email = $valueIndiamart['SENDER_EMAIL'];
                        $phone = $valueIndiamart['SENDER_MOBILE'];
                        $name = $valueIndiamart['SENDER_NAME'];
                        $time = $valueIndiamart['QUERY_TIME'];
                        $type = $valueIndiamart['QUERY_TYPE'];
                        $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                        $addData['fields'][$mcatName] = $mcat;
                        $addData['fields'][$queryMsg] = $msg;
                        $addData['fields'][$queryProduct] = $product;
                        $addData['fields'][$queryIso] = $country;
                        $addData['fields'][$senderPin] = $pincode;
                        $addData['fields'][$senderState] = $state;
                        $addData['fields'][$senderCity] = $city;
                        $addData['fields'][$senderAdd] = $add;
                        $addData['fields'][$subject] = $subject1;
                        $addData['fields'][$senderCompany] = $company;
                        $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderName] = $name;
                        $addData['fields'][$queryTime] = $time;
                        $addData['fields'][$queryType] = $type;
                        $addData['fields'][$queryId] = $id;
                        $addData['fields']['SOURCE_ID'] = $sorceId;
                        if ($id) {
                        $filterFields = array();
                        $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                        $endpoint = 'crm.deal.list';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                        $decodedResponse = json_decode($bitrixResponse, true);
                    }
                    if (!empty($decodedResponse['result'])) {
                        $entityId = $decodedResponse['result'][0]['ID'];
                        echo "deal alredy exist:- {$entityId}<br>";
                    } else {
                        $contactFields = array(
                            "fields" => array(
                                "NAME" => $name,
                                "ADDRESS" => $add,
                                "ADDRESS_POSTAL_CODE" => $pincode,
                                "ADDRESS_REGION" => $state,
                                "ADDRESS_CITY" => $city,
                                "PHONE" => array(
                                    array(
                                        "VALUE" => $phone,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                ),
                                "EMAIL" => array(
                                    array(
                                        "VALUE" => $email,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                )
                            )
                        );

                        $dealContact = json_encode($contactFields);
                        $endpoint = 'crm.contact.add';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                        $contactData =  $this->bitrix24_api($token, $url, json_encode($contactFields));
                        $contactDecode  =  json_decode($contactData, true);
                        if (isset($contactDecode['result'])) {
                             $contactId = $contactDecode['result'];
                            $addData['fields']['CONTACT_ID'] = $contactId;
                           $endpoint = 'crm.deal.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                             $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "deal created!<br>";
                            // echo json_encode($addData);
                        }
                    }
                    }
                }
                if (isset($result[0]->entity_type) && $result[0]->entity_type == "Lead") {
                    $mcatName =  $result[0]->query_mcat_name;
                    $queryMsg =   $result[0]->query_msg;
                    $queryProduct = $result[0]->query_product;
                    $queryIso = $result[0]->country_iso;
                    $senderPin = $result[0]->sender_pin;
                    $senderState = $result[0]->sender_state;
                    $senderCity = $result[0]->sender_city;
                    $senderAdd = $result[0]->sender_add;
                    $senderCompany = $result[0]->sender_company;
                    $subject = $result[0]->subject;
                    $senderEmail = $result[0]->sender_email;
                    $senderPhone = $result[0]->sender_phone;
                    $senderName = $result[0]->sender_name;
                    $queryTime = $result[0]->query_time;
                    $queryType =  $result[0]->query_type;
                    $queryId = $result[0]->query_id;
                    $sorceId = $result[0]->sorce;

                    foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                        $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                        $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                        $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                        $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                        $pincode =  $valueIndiamart['SENDER_PINCODE'];
                        $state = $valueIndiamart['SENDER_STATE'];
                        $city = $valueIndiamart['SENDER_CITY'];
                        $add = $valueIndiamart['SENDER_ADDRESS'];
                        $company = $valueIndiamart['SENDER_COMPANY'];
                        $subject1 = $valueIndiamart['SUBJECT'];
                        $email = $valueIndiamart['SENDER_EMAIL'];
                        $phone = $valueIndiamart['SENDER_MOBILE'];
                        $name = $valueIndiamart['SENDER_NAME'];
                        $time = $valueIndiamart['QUERY_TIME'];
                        $type = $valueIndiamart['QUERY_TYPE'];
                        $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                        $addData['fields'][$mcatName] = $mcat;
                        $addData['fields'][$queryMsg] = $msg;
                        $addData['fields'][$queryProduct] = $product;
                        $addData['fields'][$queryIso] = $country;
                        $addData['fields'][$senderPin] = $pincode;
                        $addData['fields'][$senderState] = $state;
                        $addData['fields'][$senderCity] = $city;
                        $addData['fields'][$senderAdd] = $add;
                        $addData['fields'][$subject] = $subject1;
                        $addData['fields'][$senderCompany] = $company;
                        $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderName] = $name;
                        $addData['fields'][$queryTime] = $time;
                        $addData['fields'][$queryType] = $type;
                        $addData['fields'][$queryId] = $id;
                        $addData['fields']['SOURCE_ID'] = $sorceId;

                        // echo json_encode($addData);
                        if ($id) {
                            $filterFields = array();
                            $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                            $endpoint = 'crm.lead.list';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                            $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                            $decodedResponse = json_decode($bitrixResponse, true);
                        }
                        if (!empty($decodedResponse['result'])) {
                            $entityId = $decodedResponse['result'][0]['ID'];
                            echo "Lead alredy exist:- {$entityId}<br>";
                        } else {
                            //echo json_encode($addData);
                            $endpoint = 'crm.lead.add';
                             $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                            echo  $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "Lead created!<br>";
                        }
                    }
                }
                if (isset($result[1]->entity_type) && $result[1]->entity_type == "deal") {
                    $mcatName =  $result[1]->query_mcat_name;
                    $queryMsg =   $result[1]->query_msg;
                    $queryProduct = $result[1]->query_product;
                    $queryIso = $result[1]->country_iso;
                    $senderPin = $result[1]->sender_pin;
                    $senderState = $result[1]->sender_state;
                    $senderCity = $result[1]->sender_city;
                    $senderAdd = $result[1]->sender_add;
                    $senderCompany = $result[1]->sender_company;
                    $subject = $result[1]->subject;
                    $senderEmail = $result[1]->sender_email;
                    $senderPhone = $result[1]->sender_phone;
                    $senderName = $result[1]->sender_name;
                    $queryTime = $result[1]->query_time;
                    $queryType =  $result[1]->query_type;
                    $queryId = $result[1]->query_id;
                    $sorceId = $result[1]->sorce;

                    foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                        $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                        $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                        $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                        $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                        $pincode =  $valueIndiamart['SENDER_PINCODE'];
                        $state = $valueIndiamart['SENDER_STATE'];
                        $city = $valueIndiamart['SENDER_CITY'];
                        $add = $valueIndiamart['SENDER_ADDRESS'];
                        $company = $valueIndiamart['SENDER_COMPANY'];
                        $subject1 = $valueIndiamart['SUBJECT'];
                        $email = $valueIndiamart['SENDER_EMAIL'];
                        $phone = $valueIndiamart['SENDER_MOBILE'];
                        $name = $valueIndiamart['SENDER_NAME'];
                        $time = $valueIndiamart['QUERY_TIME'];
                        $type = $valueIndiamart['QUERY_TYPE'];
                        $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                        $addData['fields'][$mcatName] = $mcat;
                        $addData['fields'][$queryMsg] = $msg;
                        $addData['fields'][$queryProduct] = $product;
                        $addData['fields'][$queryIso] = $country;
                        $addData['fields'][$senderPin] = $pincode;
                        $addData['fields'][$senderState] = $state;
                        $addData['fields'][$senderCity] = $city;
                        $addData['fields'][$senderAdd] = $add;
                        $addData['fields'][$subject] = $subject1;
                        $addData['fields'][$senderCompany] = $company;
                        $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderName] = $name;
                        $addData['fields'][$queryTime] = $time;
                        $addData['fields'][$queryType] = $type;
                        $addData['fields'][$queryId] = $id;
                        $addData['fields']['SOURCE_ID'] = $sorceId;

                        //echo json_encode($addData);
                       if ($id) {
                        $filterFields = array();
                        $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                        $endpoint = 'crm.deal.list';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                        $decodedResponse = json_decode($bitrixResponse, true);
                    }
                    if (!empty($decodedResponse['result'])) {
                        $entityId = $decodedResponse['result'][0]['ID'];
                        echo "deal alredy exist:- {$entityId}<br>";
                    } else {
                        $contactFields = array(
                            "fields" => array(
                                "NAME" => $name,
                                "ADDRESS" => $add,
                                "ADDRESS_POSTAL_CODE" => $pincode,
                                "ADDRESS_REGION" => $state,
                                "ADDRESS_CITY" => $city,
                                "PHONE" => array(
                                    array(
                                        "VALUE" => $phone,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                ),
                                "EMAIL" => array(
                                    array(
                                        "VALUE" => $email,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                )
                            )
                        );

                        $dealContact = json_encode($contactFields);
                        $endpoint = 'crm.contact.add';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                        $contactData =  $this->bitrix24_api($token, $url, json_encode($contactFields));
                        $contactDecode  =  json_decode($contactData, true);
                        if (isset($contactDecode['result'])) {
                             $contactId = $contactDecode['result'];
                            $addData['fields']['CONTACT_ID'] = $contactId;
                           $endpoint = 'crm.deal.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                             $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "deal created!<br>";
                            // echo json_encode($addData);
                        }
                    }
                    }
                }
                if (isset($result[1]->entity_type) && $result[1]->entity_type == "Lead") {
                    $mcatName =  $result[1]->query_mcat_name;
                    $queryMsg =   $result[1]->query_msg;
                    $queryProduct = $result[1]->query_product;
                    $queryIso = $result[1]->country_iso;
                    $senderPin = $result[1]->sender_pin;
                    $senderState = $result[1]->sender_state;
                    $senderCity = $result[1]->sender_city;
                    $senderAdd = $result[1]->sender_add;
                    $senderCompany = $result[1]->sender_company;
                    $subject = $result[1]->subject;
                    $senderEmail = $result[1]->sender_email;
                    $senderPhone = $result[1]->sender_phone;
                    $senderName = $result[1]->sender_name;
                    $queryTime = $result[1]->query_time;
                    $queryType =  $result[1]->query_type;
                    $queryId = $result[1]->query_id;
                    $sorceId = $result[1]->sorce;

                    foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                        $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                        $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                        $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                        //$phone = $valueIndiamart['SENDER_PHONE'];
                        $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                        $pincode =  $valueIndiamart['SENDER_PINCODE'];
                        $state = $valueIndiamart['SENDER_STATE'];
                        $city = $valueIndiamart['SENDER_CITY'];
                        $add = $valueIndiamart['SENDER_ADDRESS'];
                        $company = $valueIndiamart['SENDER_COMPANY'];
                        $subject1 = $valueIndiamart['SUBJECT'];
                        $email = $valueIndiamart['SENDER_EMAIL'];
                        $phone = $valueIndiamart['SENDER_MOBILE'];
                        $name = $valueIndiamart['SENDER_NAME'];
                        $time = $valueIndiamart['QUERY_TIME'];
                        $type = $valueIndiamart['QUERY_TYPE'];
                        $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                        $addData['fields'][$mcatName] = $mcat;
                        $addData['fields'][$queryMsg] = $msg;
                        $addData['fields'][$queryProduct] = $product;
                        $addData['fields'][$queryIso] = $country;
                        $addData['fields'][$senderPin] = $pincode;
                        $addData['fields'][$senderState] = $state;
                        $addData['fields'][$senderCity] = $city;
                        $addData['fields'][$senderAdd] = $add;
                        $addData['fields'][$subject] = $subject1;
                        $addData['fields'][$senderCompany] = $company;
                        $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderName] = $name;
                        $addData['fields'][$queryTime] = $time;
                        $addData['fields'][$queryType] = $type;
                        $addData['fields'][$queryId] = $id;
                        $addData['fields']['SOURCE_ID'] = $sorceId;

                        //echo json_encode($addData);
                        if ($id) {
                            $filterFields = array();
                            $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                            $endpoint = 'crm.lead.list';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                            $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                            $decodedResponse = json_decode($bitrixResponse, true);
                        }
                        if (!empty($decodedResponse['result'])) {
                            $entityId = $decodedResponse['result'][0]['ID'];
                            echo "Lead alredy exist:- {$entityId}<br>";
                        } else {
                            $endpoint = 'crm.lead.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                            echo $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "Lead created!<br>";
                        }
                    }
                }
            }
        }
    }
    public function silvar()
    {

        $getUserData = DB::table('payments')
            ->join('indiamarts', function ($join) {
                $join->on('payments.user_id', '=', 'indiamarts.user_id')
                    ->where('payments.plan_status', '=', 1)
                    ->where('payments.plan', '=', 'silver');
            })
            ->where('indiamarts.status', '=', 1)
            ->get();

        if ($getUserData->isEmpty()) {
            echo '<h1>Record Not found!</h1>';
        } else {

            $startDate = date("d-M-Y");
            $endDate = date("d-M-Y");


            foreach ($getUserData as $userValue) {
                $domainName = $userValue->metch_bitrix24_url;
                $token = $userValue->acess_token;
                $apiKey = $userValue->api_key;
                $userId = $userValue->user_id;
                $result = DB::table('bitrix24_fields')->where('status', '=', '1')->where('user_id', '=', $userId)->get();
                $urlData = 'https://mapi.indiamart.com/wservce/crm/crmListing/v2/?glusr_crm_key=' . $apiKey . '&start_time=' . $startDate . '&end_time=' . $endDate;
                $indiaMartData = $this->indiamart_api($urlData);
                //print_r($result);
                // print_r($indiaMartData);


                if (isset($result[0]->entity_type) && $result[0]->entity_type == "deal") {
                    $mcatName =  $result[0]->query_mcat_name;
                    $queryMsg =   $result[0]->query_msg;
                    $queryProduct = $result[0]->query_product;
                    $queryIso = $result[0]->country_iso;
                    $senderPin = $result[0]->sender_pin;
                    $senderState = $result[0]->sender_state;
                    $senderCity = $result[0]->sender_city;
                    $senderAdd = $result[0]->sender_add;
                    $senderCompany = $result[0]->sender_company;
                    $subject = $result[0]->subject;
                    $senderEmail = $result[0]->sender_email;
                    $senderPhone = $result[0]->sender_phone;
                    $senderName = $result[0]->sender_name;
                    $queryTime = $result[0]->query_time;
                    $queryType =  $result[0]->query_type;
                    $queryId = $result[0]->query_id;
                    $sorceId = $result[0]->sorce;

                    foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                        $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                        $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                        $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                        // $phone = $valueIndiamart['SENDER_PHONE'];
                        $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                        $pincode =  $valueIndiamart['SENDER_PINCODE'];
                        $state = $valueIndiamart['SENDER_STATE'];
                        $city = $valueIndiamart['SENDER_CITY'];
                        $add = $valueIndiamart['SENDER_ADDRESS'];
                        $company = $valueIndiamart['SENDER_COMPANY'];
                        $subject1 = $valueIndiamart['SUBJECT'];
                        $email = $valueIndiamart['SENDER_EMAIL'];
                        $phone = $valueIndiamart['SENDER_MOBILE'];
                        $name = $valueIndiamart['SENDER_NAME'];
                        $time = $valueIndiamart['QUERY_TIME'];
                        $type = $valueIndiamart['QUERY_TYPE'];
                        $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                        $addData['fields'][$mcatName] = $mcat;
                        $addData['fields'][$queryMsg] = $msg;
                        $addData['fields'][$queryProduct] = $product;
                        $addData['fields'][$queryIso] = $country;
                        $addData['fields'][$senderPin] = $pincode;
                        $addData['fields'][$senderState] = $state;
                        $addData['fields'][$senderCity] = $city;
                        $addData['fields'][$senderAdd] = $add;
                        $addData['fields'][$subject] = $subject1;
                        $addData['fields'][$senderCompany] = $company;
                        $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderName] = $name;
                        $addData['fields'][$queryTime] = $time;
                        $addData['fields'][$queryType] = $type;
                        $addData['fields'][$queryId] = $id;
                        $addData['fields']['SOURCE_ID'] = $sorceId;
                        if ($id) {
                        $filterFields = array();
                        $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                        $endpoint = 'crm.deal.list';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                        $decodedResponse = json_decode($bitrixResponse, true);
                    }
                    if (!empty($decodedResponse['result'])) {
                        $entityId = $decodedResponse['result'][0]['ID'];
                        echo "deal alredy exist:- {$entityId}<br>";
                    } else {
                        $contactFields = array(
                            "fields" => array(
                                "NAME" => $name,
                                "ADDRESS" => $add,
                                "ADDRESS_POSTAL_CODE" => $pincode,
                                "ADDRESS_REGION" => $state,
                                "ADDRESS_CITY" => $city,
                                "PHONE" => array(
                                    array(
                                        "VALUE" => $phone,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                ),
                                "EMAIL" => array(
                                    array(
                                        "VALUE" => $email,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                )
                            )
                        );

                        $dealContact = json_encode($contactFields);
                        $endpoint = 'crm.contact.add';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                        $contactData =  $this->bitrix24_api($token, $url, json_encode($contactFields));
                        $contactDecode  =  json_decode($contactData, true);
                        if (isset($contactDecode['result'])) {
                             $contactId = $contactDecode['result'];
                            $addData['fields']['CONTACT_ID'] = $contactId;
                           $endpoint = 'crm.deal.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                             $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "deal created!<br>";
                            // echo json_encode($addData);
                        }
                    }
                    }
                }
                if (isset($result[0]->entity_type) && $result[0]->entity_type == "Lead") {
                    $mcatName =  $result[0]->query_mcat_name;
                    $queryMsg =   $result[0]->query_msg;
                    $queryProduct = $result[0]->query_product;
                    $queryIso = $result[0]->country_iso;
                    $senderPin = $result[0]->sender_pin;
                    $senderState = $result[0]->sender_state;
                    $senderCity = $result[0]->sender_city;
                    $senderAdd = $result[0]->sender_add;
                    $senderCompany = $result[0]->sender_company;
                    $subject = $result[0]->subject;
                    $senderEmail = $result[0]->sender_email;
                    $senderPhone = $result[0]->sender_phone;
                    $senderName = $result[0]->sender_name;
                    $queryTime = $result[0]->query_time;
                    $queryType =  $result[0]->query_type;
                    $queryId = $result[0]->query_id;
                    $sorceId = $result[0]->sorce;

                    foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                        $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                        $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                        $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                        $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                        $pincode =  $valueIndiamart['SENDER_PINCODE'];
                        $state = $valueIndiamart['SENDER_STATE'];
                        $city = $valueIndiamart['SENDER_CITY'];
                        $add = $valueIndiamart['SENDER_ADDRESS'];
                        $company = $valueIndiamart['SENDER_COMPANY'];
                        $subject1 = $valueIndiamart['SUBJECT'];
                        $email = $valueIndiamart['SENDER_EMAIL'];
                        $phone = $valueIndiamart['SENDER_MOBILE'];
                        $name = $valueIndiamart['SENDER_NAME'];
                        $time = $valueIndiamart['QUERY_TIME'];
                        $type = $valueIndiamart['QUERY_TYPE'];
                        $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                        $addData['fields'][$mcatName] = $mcat;
                        $addData['fields'][$queryMsg] = $msg;
                        $addData['fields'][$queryProduct] = $product;
                        $addData['fields'][$queryIso] = $country;
                        $addData['fields'][$senderPin] = $pincode;
                        $addData['fields'][$senderState] = $state;
                        $addData['fields'][$senderCity] = $city;
                        $addData['fields'][$senderAdd] = $add;
                        $addData['fields'][$subject] = $subject1;
                        $addData['fields'][$senderCompany] = $company;
                        $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderName] = $name;
                        $addData['fields'][$queryTime] = $time;
                        $addData['fields'][$queryType] = $type;
                        $addData['fields'][$queryId] = $id;
                        $addData['fields']['SOURCE_ID'] = $sorceId;

                        // echo json_encode($addData);
                        if ($id) {
                            $filterFields = array();
                            $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                            $endpoint = 'crm.lead.list';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                            $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                            $decodedResponse = json_decode($bitrixResponse, true);
                        }
                        if (!empty($decodedResponse['result'])) {
                            $entityId = $decodedResponse['result'][0]['ID'];
                            echo "Lead alredy exist:- {$entityId}<br>";
                        } else {
                            //echo json_encode($addData);
                            $endpoint = 'crm.lead.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                            echo  $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "Lead created!<br>";
                        }
                    }
                }
                if (isset($result[1]->entity_type) && $result[1]->entity_type == "deal") {
                    $mcatName =  $result[1]->query_mcat_name;
                    $queryMsg =   $result[1]->query_msg;
                    $queryProduct = $result[1]->query_product;
                    $queryIso = $result[1]->country_iso;
                    $senderPin = $result[1]->sender_pin;
                    $senderState = $result[1]->sender_state;
                    $senderCity = $result[1]->sender_city;
                    $senderAdd = $result[1]->sender_add;
                    $senderCompany = $result[1]->sender_company;
                    $subject = $result[1]->subject;
                    $senderEmail = $result[1]->sender_email;
                    $senderPhone = $result[1]->sender_phone;
                    $senderName = $result[1]->sender_name;
                    $queryTime = $result[1]->query_time;
                    $queryType =  $result[1]->query_type;
                    $queryId = $result[1]->query_id;
                    $sorceId = $result[1]->sorce;

                    foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                        $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                        $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                        $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                        $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                        $pincode =  $valueIndiamart['SENDER_PINCODE'];
                        $state = $valueIndiamart['SENDER_STATE'];
                        $city = $valueIndiamart['SENDER_CITY'];
                        $add = $valueIndiamart['SENDER_ADDRESS'];
                        $company = $valueIndiamart['SENDER_COMPANY'];
                        $subject1 = $valueIndiamart['SUBJECT'];
                        $email = $valueIndiamart['SENDER_EMAIL'];
                        $phone = $valueIndiamart['SENDER_MOBILE'];
                        $name = $valueIndiamart['SENDER_NAME'];
                        $time = $valueIndiamart['QUERY_TIME'];
                        $type = $valueIndiamart['QUERY_TYPE'];
                        $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                        $addData['fields'][$mcatName] = $mcat;
                        $addData['fields'][$queryMsg] = $msg;
                        $addData['fields'][$queryProduct] = $product;
                        $addData['fields'][$queryIso] = $country;
                        $addData['fields'][$senderPin] = $pincode;
                        $addData['fields'][$senderState] = $state;
                        $addData['fields'][$senderCity] = $city;
                        $addData['fields'][$senderAdd] = $add;
                        $addData['fields'][$subject] = $subject1;
                        $addData['fields'][$senderCompany] = $company;
                        $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderName] = $name;
                        $addData['fields'][$queryTime] = $time;
                        $addData['fields'][$queryType] = $type;
                        $addData['fields'][$queryId] = $id;
                        $addData['fields']['SOURCE_ID'] = $sorceId;

                        //echo json_encode($addData);
                      if ($id) {
                        $filterFields = array();
                        $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                        $endpoint = 'crm.deal.list';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                        $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                        $decodedResponse = json_decode($bitrixResponse, true);
                    }
                    if (!empty($decodedResponse['result'])) {
                        $entityId = $decodedResponse['result'][0]['ID'];
                        echo "deal alredy exist:- {$entityId}<br>";
                    } else {
                        $contactFields = array(
                            "fields" => array(
                                "NAME" => $name,
                                "ADDRESS" => $add,
                                "ADDRESS_POSTAL_CODE" => $pincode,
                                "ADDRESS_REGION" => $state,
                                "ADDRESS_CITY" => $city,
                                "PHONE" => array(
                                    array(
                                        "VALUE" => $phone,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                ),
                                "EMAIL" => array(
                                    array(
                                        "VALUE" => $email,
                                        "VALUE_TYPE" => "WORK"
                                    )
                                )
                            )
                        );

                        $dealContact = json_encode($contactFields);
                        $endpoint = 'crm.contact.add';
                        $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                        $contactData =  $this->bitrix24_api($token, $url, json_encode($contactFields));
                        $contactDecode  =  json_decode($contactData, true);
                        if (isset($contactDecode['result'])) {
                             $contactId = $contactDecode['result'];
                            $addData['fields']['CONTACT_ID'] = $contactId;
                           $endpoint = 'crm.deal.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";
                             $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "deal created!<br>";
                            // echo json_encode($addData);
                        }
                    }
                    }
                }
                if (isset($result[1]->entity_type) && $result[1]->entity_type == "Lead") {
                    $mcatName =  $result[1]->query_mcat_name;
                    $queryMsg =   $result[1]->query_msg;
                    $queryProduct = $result[1]->query_product;
                    $queryIso = $result[1]->country_iso;
                    $senderPin = $result[1]->sender_pin;
                    $senderState = $result[1]->sender_state;
                    $senderCity = $result[1]->sender_city;
                    $senderAdd = $result[1]->sender_add;
                    $senderCompany = $result[1]->sender_company;
                    $subject = $result[1]->subject;
                    $senderEmail = $result[1]->sender_email;
                    $senderPhone = $result[1]->sender_phone;
                    $senderName = $result[1]->sender_name;
                    $queryTime = $result[1]->query_time;
                    $queryType =  $result[1]->query_type;
                    $queryId = $result[1]->query_id;
                    $sorceId = $result[1]->sorce;

                    foreach ($indiaMartData['RESPONSE'] as $key => $valueIndiamart) {
                        $mcat = $valueIndiamart['QUERY_MCAT_NAME'];
                        $msg  = preg_replace('/[^A-Za-z0-9 ]/', '', $valueIndiamart['QUERY_MESSAGE']);
                        $product =  $valueIndiamart['QUERY_PRODUCT_NAME'];
                        //$phone = $valueIndiamart['SENDER_PHONE'];
                        $country = $valueIndiamart['SENDER_COUNTRY_ISO'];
                        $pincode =  $valueIndiamart['SENDER_PINCODE'];
                        $state = $valueIndiamart['SENDER_STATE'];
                        $city = $valueIndiamart['SENDER_CITY'];
                        $add = $valueIndiamart['SENDER_ADDRESS'];
                        $company = $valueIndiamart['SENDER_COMPANY'];
                        $subject1 = $valueIndiamart['SUBJECT'];
                        $email = $valueIndiamart['SENDER_EMAIL'];
                        $phone = $valueIndiamart['SENDER_MOBILE'];
                        $name = $valueIndiamart['SENDER_NAME'];
                        $time = $valueIndiamart['QUERY_TIME'];
                        $type = $valueIndiamart['QUERY_TYPE'];
                        $id = $valueIndiamart['UNIQUE_QUERY_ID'];
                        $addData['fields'][$mcatName] = $mcat;
                        $addData['fields'][$queryMsg] = $msg;
                        $addData['fields'][$queryProduct] = $product;
                        $addData['fields'][$queryIso] = $country;
                        $addData['fields'][$senderPin] = $pincode;
                        $addData['fields'][$senderState] = $state;
                        $addData['fields'][$senderCity] = $city;
                        $addData['fields'][$senderAdd] = $add;
                        $addData['fields'][$subject] = $subject1;
                        $addData['fields'][$senderCompany] = $company;
                        $addData['fields'][$senderEmail] = [["VALUE" => $email, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderPhone] = [["VALUE" => $phone, "VALUE_TYPE" => "WORK"]];
                        $addData['fields'][$senderName] = $name;
                        $addData['fields'][$queryTime] = $time;
                        $addData['fields'][$queryType] = $type;
                        $addData['fields'][$queryId] = $id;
                        $addData['fields']['SOURCE_ID'] = $sorceId;

                        //echo json_encode($addData);
                        if ($id) {
                            $filterFields = array();
                            $filterFields['filter']["UF_CRM_QUERY_ID"] = $id;
                            $endpoint = 'crm.lead.list';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                            $bitrixResponse =  $this->bitrix24_api($token, $url, json_encode($filterFields));
                            $decodedResponse = json_decode($bitrixResponse, true);
                        }
                        if (!empty($decodedResponse['result'])) {
                            $entityId = $decodedResponse['result'][0]['ID'];
                            echo "Lead alredy exist:- {$entityId}<br>";
                        } else {
                            $endpoint = 'crm.lead.add';
                            $url = "https://{$domainName}/rest/{$endpoint}?auth={$token}";

                            echo $this->bitrix24_api($token, $url, json_encode($addData));
                            echo "Lead created!<br>";
                        }
                    }
                }
            }
        }
    }
     function plan_status_change()
    {
        echo "<pre>";
         $currentDateTime = new DateTime();;

        $getDataAfterUpdate = DB::table('payments')
            ->where('plan_status', '=', 1)
            ->get();

        foreach ($getDataAfterUpdate as $val) {
             
             $planExpire = new DateTime($val->plan_expire);
            
            if ($currentDateTime >= $planExpire) {
                
                $userId = $val->user_id;

                // Update plan_status to 0
                DB::table('payments')
                    ->where('user_id', '=', $userId)
                    ->update(['plan_status' => 0]);

                // If it's a trial plan, update it to free
                if ($val->plan == "trial") {
                    DB::table('payments')
                        ->where('user_id', '=', $userId)
                        ->where('status', '=', 'trial')
                        ->update(['plan' => 'free']);
                }

                // Update user status in another table
                DB::table('indiamarts')
                    ->where('user_id', $userId)
                    ->update(['status' => 0]);
            }
        }
    }
}