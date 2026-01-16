<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IndiamartController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\IntigrationCrm;
use App\Http\Controllers\cronController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BitrixController;
use App\Http\Controllers\AdminDashboard\AdminController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 /*
  admin Dashboard route

  */
  Route::get('admin/login', [AdminController::class, 'showLoginForm'])->name('admin/login');
  Route::post('admin/login1', [AdminController::class, 'login']);
  Route::middleware('test')->group(function () {
    Route::prefix('admin')->group(function () {
  Route::get('register', [AdminController::class, 'showRegistrationForm'])->name('admin/register');
  Route::post('register', [AdminController::class, 'register']);
  Route::get('dashboard/{app_type}', [AdminController::class, 'count_user'])->name('dashboard');
  Route::get('statusupdate/{id}/{status}', [AdminController::class, 'staus_update']);
  Route::get('payment-done', [AdminController::class, 'paymentDoneView']);
  Route::get('/payment-failed', [AdminController::class, 'paymentFailedView'])->name('payment.failed');
  Route::get('/payment-free',[AdminController::class, 'paymentFreeView'])->name('payment.free');
  Route::get('/user_delete/{id}',[AdminController::class, 'user_delete']);


  Route::get('app-list',function(){
    return view('admin_dashboard/all-app');
  });
 
  Route::get('logout',function(){
    session()->forget('ADMIN_LOGIN');      
    session()->forget('ADMIN_Id');
   
    return redirect('admin/login');
  });
 
  /*Route::get('dashboard',function(){
    return view('admin_dashboard/dashboard');
  });*/
});
});



  /*
  admin Dashboard route
  
  */
Route::get('/', function () {
    return view('front-end/welcome');
});
Route::get('contact', function () {
  return view('front-end/contact');
});
Route::get('about', function () {
  return view('front-end/about');
});

Route::get('/dashboard',[IndiamartController::class,'index'
   // return view('dashboard');
])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('sub', function () {
        return view('subscriptions');
    });
     // razorpay route//
    Route::post('razorpay',[IndiamartController::class,'razorpay_url_save']);
    Route::get('razorpay-bitrix24-url',[IndiamartController::class,'razorpay_get_url']);
    //razorpay route end//

  //  Route::get('/dashboard',[IndiamartController::class,'index']);
    Route::post('/ajax.post',[IndiamartController::class,'save_data']);
    Route::post('/url.post',[IndiamartController::class,'url_add']);
    Route::get('url-get', [IndiamartController::class,'url_get']);

    Route::get('/show_data',[IndiamartController::class,'show_data']);
    Route::get('/deal_fields',[IntigrationCrm::class,'deal_field']);
    Route::get('/lead_fields',[IntigrationCrm::class,'lead_field']);
    Route::post("/add_fields_deal",[IntigrationCrm::class,"deal_fields_add"]);
    Route::post("/add_fields_lead",[IntigrationCrm::class,"lead_fields_add"]);
    Route::post('/status-update/{id}/{status}',[IntigrationCrm::class,"status_update_deal"])->name('statusUpdate');
    Route::post('/status-update1/{id}/{status}',[IntigrationCrm::class,"status_update_lead"])->name('statusUpdate1');
    Route::post('payment',[PaymentsController::class,'index']);
    Route::post('payment.add',[PaymentsController::class,'payment']);
    Route::post('/payment/status', [PaymentsController::class, 'getPaymentStatus']);
    Route::get('plan', [PaymentsController::class, 'plan']);
    Route::get('plan_status', [PaymentsController::class,'plan_activate']);
    Route::post('/free_plan', [PaymentsController::class,'free_plan']);
    //Route::post("/add_fields_lead",[IntigrationCrm::class,"lead_fields_add"]);
    Route::get('sub-details', function () {
        return view('sub-details');
    });
    Route::get('indiamart_price', function () {
        return view('indiamart_price');
    });
  
    Route::get('invoice', function () {
        return view('invoice');
    });
    Route::get('intigration',function(){
         return view('crm_intigration');
    });
    });
   Route::get('/bitrix', [BitrixController::class, 'index']);
   //cron job run route
   Route::get('cron_run_30',[cronController::class,'gold']);
   Route::get('cron_run_10',[cronController::class,'platinum']);
   Route::get('cron_run_2',[cronController::class,'silvar']);
   Route::get('plan_cron',[cronController::class,'plan_status_change']);
   Route::get('token-genrate',[cronController::class,'token_save']);
  /* Route::get('token-genrate',function(){
        echo "welcome";
   });*/


require __DIR__.'/auth.php';
