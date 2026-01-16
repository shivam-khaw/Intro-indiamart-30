<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class Bitrixapp extends Controller
{

   function index()
   {
       echo "<pre>";
       print_r($_REQUEST);
       echo '<h1>Thank you for installing our application!</h1>';
        
   }
   function bitrix_api()
   {
      $authId = $_REQUEST['AUTH_ID'];
      $refreshId = $_REQUEST['REFRESH_ID'];
      $domainName = $_REQUEST['DOMAIN'];
      $result = DB::table('indiamarts')
      ->where('bitrix_url', '!=', null)
      ->get();      
      $mainUrl1='';
      //dd($result);
       if(!empty($result)){
      // echo $result->bitrix_url;
      foreach ($result as $key => $val) {
         $mainUrl =  $val->bitrix_url;
         $explodUrl = explode('/', $mainUrl);
         $mainUrlExpload = $explodUrl[2];
         if ($domainName == $mainUrlExpload) {
            $mainUrl1 =  $val->bitrix_url;
           // echo $domainName;
            DB::table('indiamarts')
               ->where('bitrix_url', '=', $mainUrl)
               ->update([
                  'metch_bitrix24_url' => $domainName
               ]);
         }
      }
        return view('indiamart-app/app',compact('mainUrl1'));

   }else{
//$msg='First setup indiamarthub and enter your inbound webhook URL on crm integration menu of indiamarthub.';
return view('indiamart-app/app',compact('mainUrl1'));
   }
   
        }
      
}
