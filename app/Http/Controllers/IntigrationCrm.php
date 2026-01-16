<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IntigrationCrm extends Controller
{
   
  function deal_field()
  {
    //$this->bitrix24_api('crm.deal.userfield.add');
    $userId = auth()->user()->id;
    $dataStore = ['user_id' => $userId, 'entity_type' => 'deal', 'status' => 1,'query_id'=>'UF_CRM_QUERY_ID'];

    $result = DB::table('bitrix24_fields')
      ->where('user_id', '=', $userId)
      ->where('entity_type', '=', 'deal')
      ->get();

    if ($result->count() > 0) {
    } else {
      DB::table('bitrix24_fields')->insert($dataStore);
    }
    return view('deal_field', compact('result'));
  }
  function lead_field()
  {

    $userId = auth()->user()->id;
    $dataStore = ['user_id' => $userId, 'entity_type' => 'Lead', 'status' => 1,'query_id'=>'UF_CRM_QUERY_ID'];

    $result = DB::table('bitrix24_fields')
      ->where('user_id', '=', $userId)
      ->where('entity_type', '=', 'Lead')
      ->get();

    if ($result->count() > 0) {
    } else {
      DB::table('bitrix24_fields')->insert($dataStore);
    }
    return view('lead_fields', compact('result'));
  }
  function deal_fields_add(Request $req)
  {
    $userId = auth()->user()->id;
    $dataStore = [];

    if ($req->indiamart == "QUERY_TIME") {
      $dataStore['query_time'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_NAME") {
      $dataStore['sender_name'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_MOBILE") {
      $dataStore['sender_phone'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_EMAIL") {
      $dataStore['sender_email'] = $req->bitrix;
    } elseif ($req->indiamart == "SUBJECT") {
      $dataStore['subject'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_COMPANY") {
      $dataStore['sender_company'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_ADDRESS") {
      $dataStore['sender_add'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_CITY") {
      $dataStore['sender_city'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_STATE") {
      $dataStore['sender_state'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_PINCODE") {
      $dataStore['sender_pin'] = $req->bitrix;
    } elseif ($req->indiamart == "QUERY_PRODUCT_NAME") {
      $dataStore['query_product'] = $req->bitrix;
    } elseif ($req->indiamart == "QUERY_MESSAGE") {
      $dataStore['query_msg'] = $req->bitrix;
    } elseif ($req->indiamart == "QUERY_MCAT_NAME") {
      $dataStore['query_mcat_name'] = $req->bitrix;
  } elseif ($req->indiamart == "SORCE_ID") {
      $dataStore['sorce'] = $req->bitrix;
    }
    

    $result = DB::table('bitrix24_fields')
      ->where('user_id', '=', $userId)
      ->where('entity_type', '=', 'deal')
      ->update($dataStore);
    if ($result) {
      $dataUpdate = "Field added successfully!";
      return redirect(url('/deal_fields'))->with('dataUpdate',$dataStore);
    }
  }
  function lead_fields_add(Request $req)
  {
    $userId = auth()->user()->id;
    $dataStore = [];
     
    if ($req->indiamart == "QUERY_TIME") {
      $dataStore['query_time'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_NAME") {
      $dataStore['sender_name'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_MOBILE") {
      $dataStore['sender_phone'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_EMAIL") {
      $dataStore['sender_email'] = $req->bitrix;
    } elseif ($req->indiamart == "SUBJECT") {
      $dataStore['subject'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_COMPANY") {
      $dataStore['sender_company'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_ADDRESS") {
      $dataStore['sender_add'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_CITY") {
      $dataStore['sender_city'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_STATE") {
      $dataStore['sender_state'] = $req->bitrix;
    } elseif ($req->indiamart == "SENDER_PINCODE") {
      $dataStore['sender_pin'] = $req->bitrix;
    } elseif ($req->indiamart == "QUERY_PRODUCT_NAME") {
      $dataStore['query_product'] = $req->bitrix;
    } elseif ($req->indiamart == "QUERY_MESSAGE") {
      $dataStore['query_msg'] = $req->bitrix;
    } elseif ($req->indiamart == "QUERY_MCAT_NAME") {
      $dataStore['query_mcat_name'] = $req->bitrix;
  } elseif ($req->indiamart == "SORCE_ID") {
      $dataStore['sorce'] = $req->bitrix;
    }
     
 
    $result = DB::table('bitrix24_fields')
      ->where('user_id', '=', $userId)
      ->where('entity_type', '=', 'Lead')
      ->update($dataStore);
      
    if ($result) {
      $dataUpdate = "Field added successfully!";
    return redirect(url('/lead_fields'))->with('dataUpdate',$dataStore);
    }
  }
  function status_update_deal($id, $status)
  {
    $statusResult = DB::table('bitrix24_fields')->where('id', $id)->update(['status' => $status]);
    return redirect(url('/deal_fields'));
  }
  function status_update_lead($id, $status)
  {
    $statusResult = DB::table('bitrix24_fields')->where('id', $id)->update(['status' => $status]);
    return redirect(url('/lead_fields'));
  }
}
