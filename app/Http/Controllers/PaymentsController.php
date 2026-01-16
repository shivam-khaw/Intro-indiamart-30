<?php

namespace App\Http\Controllers;

use App\Models\Indiamart;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    protected $api_key;
    protected $api_secret;

    public function __construct()
    {
        $this->api_key= 'rzp_test_zyjNysn1YLT3wm';
        $this->api_secret = 'RppdDvlF31WWn9bvEFdH0eFX';
    }

    public function index(Request $req)
    {

        $filteredData = Indiamart::where('user_id',auth()->user()->id)->get();
         if(isset($filteredData[0]->user_id)){
        $userData = User::where('id', auth()->user()->id)->get();
        
        $userName = $userData[0]->name;
        $userEmail = $userData[0]->email;
        $userPhone = $userData[0]->phone;
        $razorpay_url = 'https://api.razorpay.com/v1/customers';
        $customer_data = [
            'name' => $userName,
            'email' => $userEmail,
            'contact' => $userPhone,
        ];

        $ch = curl_init($razorpay_url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($customer_data));
        curl_setopt($ch, CURLOPT_USERPWD, $this->api_key . ':' . $this->api_secret); // Use $this-> to access class properties

        $response = curl_exec($ch);

        curl_close($ch);

        $customer = json_decode($response, true);

        if (isset($customer['id'])) {
            Indiamart::where('user_id', auth()->user()->id)->update([
                'customer_id' => $customer['id'],
            ]);
        }

        $userData = Indiamart::where('user_id', auth()->user()->id)->get();
        
        if (isset($userData[0]->customer_id)) {
            $customerId = $userData[0]->customer_id;
            $input_data = json_decode(file_get_contents('php://input'), true);
                $order_data = [
                    'amount' => $input_data['amount'],
                    'currency' => $input_data['currency'],
                    'receipt' => 'order_receipt',
                    'payment_capture' => 1,
                    'customer_id' => $customerId,
                ];

            $razorpay_url = 'https://api.razorpay.com/v1/orders';

            $ch = curl_init($razorpay_url);

            // Set cURL options
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($order_data));
            curl_setopt($ch, CURLOPT_USERPWD, $this->api_key . ':' . $this->api_secret);

            // Execute cURL session and get the response
            $response = curl_exec($ch);

            // Get HTTP status code
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            // Close cURL session
            curl_close($ch);

            // Check if the request was successful (HTTP status code 200 or 201)
            if ($http_status == 200 || $http_status == 201) {
                $order = json_decode($response, true);
                // return $response;
               return json_encode(['order_id' => $order['id'], 'amount' => $order['amount'], 'currency' => $order['currency'],'customer_id'=>$customerId]);
            } else {

                echo json_encode(['error' => 'Failed to create order']);
            }
        }
         }else{
             echo 5;
         }
    }
    function payment(Request $req)
    {

    } 
    public function getPaymentStatus(Request $request)
    {
        date_default_timezone_set("Asia/Calcutta");
        try {
            $paymentId = $request->input('payment_id');
            //$orderId = $request->input('order_id');
            $customerId= $request->input('customer_id');
            $planValue = $request->input('planValue');
            $activateDate = new DateTime();
            $currentDateFormatted = $activateDate->format('d-m-Y H:i:s');
            $endDate = $activateDate->modify('+ 1month')->format('d-m-Y H:i:s');
            $userId= auth()->user()->id;
            $ch = curl_init();

            $url = "https://api.razorpay.com/v1/payments/{$paymentId}";

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($this->api_key . ':' . $this->api_secret),
            ]);

            $response = curl_exec($ch);

            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($http_status == 200) {
                $payment = json_decode($response, true);               
                $paymentStatus = $payment['status'];
                 if($payment['status']=='captured'){
                    $planStatus=1;
                 }else{
                    $planStatus=0;
                 }
               $paymentId = $payment['id'];
                $amount = $payment['amount'];
                $currency = $payment['currency'];
                $orderId = $payment['order_id'];
                $description = $payment['description'];
                $email = $payment['email'];
                $method = $payment['method'];
                $newPayment = new Payment();

                // Set the attributes
                $newPayment->status = $paymentStatus;
                $newPayment->plan_status = $planStatus;
                $newPayment->payment_id = $paymentId;
                $newPayment->amount = $amount;
                $newPayment->currency = $currency;
                $newPayment->order_id = $orderId;
                $newPayment->costomer_id = $customerId;
                $newPayment->description = $description;
                $newPayment->email = $email;
                $newPayment->method = $method;
                $newPayment->payment_date =$currentDateFormatted;
                $newPayment->user_id = $userId;
                $newPayment->plan_expire=$endDate;
                $newPayment->plan=$planValue;
               $paymentAddData=  $newPayment->save();
                
            return response()->json(['status' => $paymentStatus]);
            } else {
                return response()->json(['error' => 'Failed to get payment status'], $http_status);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    } 
     function plan(){
        $paymentData="";
        $paymentData= Payment::where('user_id',auth()->user()->id)->get();
       if($paymentData){
         return view('payment',compact('paymentData'));
        }else{
            return view('payment',compact('paymentData'));  
        }
          }
          function plan_activate(){
            $paymentData = Payment::where('user_id', auth()->user()->id)
            ->where('plan_status', 1)
            ->whereColumn('payment_date', '<=', 'plan_expire')
            ->latest() // Order by the created_at column in descending order
            ->first(); // Retrieve the first record
                     
              if($paymentData->plan){
             $data=[
                'plan_name'=>$paymentData->plan,
                'expire'=>$paymentData->plan_expire,
             ];
            
            return ['data' => $data];
            }
         }
     function free_plan(Request $request){
          $request->input('freeCard');
         $activateDate = new DateTime();
         $currentDateFormatted = $activateDate->format('d-m-Y H:i:s');
         $endDate = $activateDate->modify('+ 3days')->format('d-m-Y H:i:s');
         $userId= auth()->user()->id;
        $existingPayment = Payment::where('user_id', $userId)->where('status','trial')->first();
         if ($existingPayment) {
              return "Your trial plan is already in use, please purchase a plan!";
         } else {
            $newPayment = new Payment();

            $newPayment->plan_status =1;
            $newPayment->status ="trial";
            $newPayment->user_id = $userId;
            $newPayment->plan_expire=$endDate;
            $newPayment->payment_date =$currentDateFormatted;
            $newPayment->plan="trial";
            $newPayment->save();

         }
       
     }
}
