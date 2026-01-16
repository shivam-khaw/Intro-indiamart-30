<?php

namespace App\Http\Controllers;

use App\Models\Indiamart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;


class IndiamartController extends Controller
{

    function bitrix24_api($url = '')
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "fields": 
            {
                "FIELD_NAME": "QUERY_ID",
                "EDIT_FORM_LABEL": "QUERY Id",
                "LIST_COLUMN_LABEL": "QUERY Id",
                "USER_TYPE_ID": "string"
            }
    }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: qmb=0.'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
       // echo $response . "<br>";
    }
    public function index()
    {
        $u = Indiamart::where('user_id', auth()->user()->id)->first();
        if (!empty($u)) {
            $key = $u->api_key;
        } else {
            $key = '';
        }
        //return view('dashboard', compact('key'));
        return view('dashboard', compact('key'));


    }
    public function Url_get()
    {
        $u = Indiamart::where('user_id', auth()->user()->id)->first();
        if (!empty($u)) {
            $key = $u->bitrix_url;
        } else {
            $key = '';
        }
        
        $responseData = ['key' => $key];
        
        return response()->json($responseData);
    }        


    function  indiamart_api($url = '')
    {
        $curl = curl_init();

        $data = array(
            // Your POST data here
        );

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://mapi.indiamart.com/wservce/crm/crmListing/v2/?' . $url,
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
        //echo $response;
        return json_decode($response, true);
    }

   public function save_data(Request $request)
{
    $startDate = date("Y-m-d") . '00:00:00';
    $endDate = date("Y-m-d") . '23:59:59';
    $apiKey = $request->input('key');
    $urlData = 'glusr_crm_key=' . $apiKey . '&start_time=' . $startDate . '&end_time=' . $endDate;
    $indiaMartData = $this->indiamart_api($urlData);
    $apiVerify = $indiaMartData['STATUS'];
    
    if ($apiVerify != 'SUCCESS') {
        return 0;
    } else {
        $user_id = $request->input('id');
        $existingModel = Indiamart::where('user_id', $user_id)->first();
        
        if ($existingModel) {
            // Update existing entry
            $existingModel->api_key = $apiKey;
            $existingModel->save();
            return 2; // Indicates update
        } else {
            // Insert new entry
            $model = new Indiamart();
            $model->api_key = $apiKey;
            $model->user_id = $user_id;
            $model->type = "indiamart";
            $model->status = 1;
            $model->save();
            return 1; // Indicates insert
        }
    }
}

    function show_data()
    {

        $results = DB::table('dataapis')->get();
   // $filterQuery= $results[0]->query_id;
        //$query1="";
        $query1 = [];

        foreach ($results as $key => $queryid) {
            $query1[] = $queryid->query_id;
        }
        $valuesString = implode(PHP_EOL, $query1);


        $getApiKey = Indiamart::where('user_id', '=', auth()->user()->id)->first();
        $startDate =  date("d-M-Y");
        $endDate =  date("d-M-Y");
        $data1 = "API key not set check your api";
        if (isset($getApiKey->api_key)) {
            $apiKey = $getApiKey->api_key;

            $userId = $getApiKey->user_id;
            $urlData = 'glusr_crm_key=' . $apiKey . '&start_time=' . $startDate . '&end_time=' . $endDate;
            $indiaMartData = $this->indiamart_api($urlData);
if(isset($indiaMartData['RESPONSE'])){
            $result = array_merge($query1, $indiaMartData['RESPONSE']);
      
            foreach ($indiaMartData['RESPONSE'] as $value) {

                if (!in_array($value['UNIQUE_QUERY_ID'], $query1)) {
                    $valueToInsert = [
                        'user_id' => $userId,
                        'query_id' => $value['UNIQUE_QUERY_ID'],
                        'query_type' => $value['QUERY_TYPE'],
                        'query_time' => $value['QUERY_TIME'],
                        'sender_name' => $value['SENDER_NAME'],
                        'sender_phone' => $value['SENDER_MOBILE'],
                        'sender_email' => $value['SENDER_EMAIL'],
                        'subject' => $value['SUBJECT'],
                        'sender_company' => $value['SENDER_COMPANY'],
                        'sender_add' => $value['SENDER_ADDRESS'],
                        'sender_city' => $value['SENDER_CITY'],
                        'sender_state' => $value['SENDER_STATE'],
                        'sender_pin' => $value['SENDER_PINCODE'],
                        'country_iso' => $value['SENDER_COUNTRY_ISO'],
                        'query_product' => $value['QUERY_PRODUCT_NAME'],
                        'query_msg' => $value['QUERY_MESSAGE'],
                        'query_mcat_name' => $value['QUERY_MCAT_NAME'],
                        'recever_phone' => $value['RECEIVER_MOBILE'],
                        'sorce' => 'Indiamart',
                        'status' => 1,
                        'date_time' => 'null'
                    ];
                    DB::table('dataapis')->insert($valueToInsert);
                }
            }
}

           $data = DB::table('dataapis')
                ->where('user_id', $userId)
                ->paginate(10);
            return view('indiamartdata', compact('data'));
        } else {
            return view('indiamartdata', compact('data1'));
        }
    }
    public function store(Request $request)
    {
        //
    }


    function url_add(Request $req)
    {
       
        // Bitrix API Calls
        $bitrixUrl = $req->input('key');
        $this->bitrix24_api($bitrixUrl . 'crm.deal.userfield.add');
        $this->bitrix24_api($bitrixUrl . 'crm.lead.userfield.add');

        // Update Database: Set the new URL in the 'bitrix_url' column for the authenticated user
        $getApiKey = Indiamart::where('user_id', auth()->user()->id)->first();

        if ($getApiKey) {
            $getApiKey->bitrix_url = $req->input('key');
            $getApiKey->save();

            // Return success response
            return response()->json(['status' => 'success', 'message' => 'URL Added successfully.']);
        }

        // Return error response if updating the database fails
        return response()->json(['status' => 'error', 'message' => 'Failed URL.Plz set channes API key!']);
    }
  public function razorpay_url_save(Request $req)
    {
        $userId = $req->id;
        $bitrix24Url = $req->url;
        // Check if the record exists for the given user_id
        $user = DB::table('razorpay_users')->where('user_id', $userId)->first();
     
        // Check if the URL is in the expected format
        if (empty($bitrix24Url)) {
            // URL is not correct, return error message
            return response()->json(['error' => 'URL is not in the correct format. Please try again.'], 400);
        }else{
        if ($user) {
            DB::table('razorpay_users')
            ->where('user_id', $userId)
            ->update(['bitrix24_url' => $bitrix24Url]);
        // Return success response with flash message
        return response()->json(['success' => 'URL updated successfully.']);
        } else {
            // If the record does not exist, insert a new record
            DB::table('razorpay_users')->insert([
                'user_id' => $userId,
                'bitrix24_url' =>$bitrix24Url,
                'type' => 'razorpay',
            ]);
            return response()->json(['success' => 'URL saved successfully.'], 200);

        }
    
        // Return success response
    }
} 
     public function razorpay_get_url(){
        $user = DB::table('razorpay_users')->where('user_id', auth()->user()->id)->first();
        //return response()->json(['url' => $user ? $user->bitrix24_url : null]);
        return response()->json([
            'url' => $user ? $user->bitrix24_url : null,
            'razorpay_api' =>$user ? $user->razorpay_api_key : null
        ]);
     }
  
    
  /*  public function url_add(Request $req)
    {
        $bitrixUrl = $req->input('key');
        $this->bitrix24_api($bitrixUrl . 'crm.deal.userfield.add');
        $this->bitrix24_api($bitrixUrl . 'crm.lead.userfield.add');
        $getApiKey = Indiamart::where('user_id', auth()->user()->id)->first();
        if ($getApiKey) {
            $getApiKey->bitrix_url = $req->input('key');
            $getApiKey->save();
            return "Url Added ";
        }
    }
*/

    public function edit(Indiamart $indiamart)
    {
        //
    }

    public function update(Request $request, Indiamart $indiamart)
    {
        //
    }
    public function destroy(Indiamart $indiamart)
    {
        //
    }
}
