<?php

namespace App\Http\Controllers\AdminDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


use App\Models\AdminUser;


class AdminController extends Controller
{
    function showLoginForm()
    {
        return view('admin_dashboard.login');
    }

    // Handle login
    public function login(Request $request)
{
    // Validate the form data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $email = $request->post('email');
    $password = $request->post('password');

    // Retrieve the user by email
    $user = AdminUser::where('email', $email)->first();
    // Check if the user exists
    if ($user) {  
        if (Hash::check($password, $user->password)) {
            $userId = $user->id;
            $name = $user->name;
            
            $request->session()->put('ADMIN_LOGIN',true);      
            $request->session()->put('ADMIN_Id',$userId);
            session()->put('ADMIN_NAME',$name);
            //dd($request->session()->has('ADMIN_LOGIN'));
           // return redirect('admin/app-list');
            return redirect('admin/app-list');


        } else {
           return back()->withInput($request->only('email'))->withErrors(['password' => 'Invalid password']);
        }
    } else {
        return back()->withInput($request->only('email'))->withErrors(['email' => 'User not found']);
    }
}// Show registration form
    public function showRegistrationForm()
    {
        return view('admin_dashboard.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin_users',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create a new AdminUser
        AdminUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Log in the new user
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        return view('admin_dashboard/all-app');
    }

    // Log out
    public function logout()
    {
        Auth::logout();

        return redirect('/admin_dashboard/login');
    }
    public function count_user($appName)
    {
        Session::put('app_type',$appName);
        $userCount = 0;
        $paymenDone = 0;
        $free = 0;
        $faild = 0;
        $result = '';
        $result = DB::table('indiamarts')
    ->join('users', 'indiamarts.user_id', '=', 'users.id')
    ->where('indiamarts.type', '=',$appName)
    ->select('indiamarts.*', 'users.*') // Select specific columns if needed
    ->get();

        if (Session::get('app_type') == 'indiamart') {
            $userCount = DB::table('users')->count();
            $paymenDone = DB::table('payments')->where('status', '=', 'captured')->count();
            $free = DB::table('payments')->where('status', '=', 'free')->count();
            $faild = DB::table('payments')->whereNotIn('status', ['free', 'captured'])->count();
            $data= ['userCount'=>$userCount,
            'paymenDone'=>$paymenDone,
            'free'=>$free,
            'faild'=>$faild,
        ];
            return view('admin_dashboard/dashboard ', compact('userCount', 'paymenDone', 'free', 'faild', 'result'));
            //return response()->json($data);
        } else {
            return view('admin_dashboard/dashboard', compact('userCount', 'paymenDone', 'free', 'faild','result'));
        }
    }
    function staus_update($id, $status)
    {
        $affectedRows = DB::table('indiamarts')
            ->where('user_id', $id)
            ->update(['status' => $status]);

        if ($affectedRows > 0) {
            return back()->with('success', 'Status updated successfully');
           // dd(session()->all()); // Dump all session data
            // return back()->withErrors(['msg' => 'The Message']);

        } else {
            return back()->with('error', 'Record not found');
        }
    }
    function paymentDoneView()
    {     
        $type  = Session::get('app_type');   
        $payments = DB::table('payments')
    ->join('users', 'payments.user_id', '=', 'users.id')
    ->join('indiamarts', 'indiamarts.customer_id', '=', 'payments.costomer_id')
    ->where('payments.status', '=', 'captured')
    ->where('indiamarts.type', '=',$type)
    ->get();
        if ($payments) {
          return view('admin_dashboard/payment-done',compact('payments'));
        } else {
            return view('admin.payment-done');
        }
    }
    public function paymentFailedView()
{
    $type = Session::get('app_type');   

    $failedPayments = DB::table('payments')
        ->join('users', 'payments.user_id', '=', 'users.id')
        ->join('indiamarts', 'indiamarts.customer_id', '=', 'payments.costomer_id')
        ->where('payments.status', '!=', 'free')
        ->where('payments.status', '!=', 'captured')
        ->where('indiamarts.type', '=', $type)
        ->get();

    return view('admin_dashboard/payment-failed', compact('failedPayments'));
}
public function paymentFreeView()
{
    $type = Session::get('app_type');   

    $freePayments = DB::table('payments')
        ->join('users', 'payments.user_id', '=', 'users.id')
        ->where('payments.status', '=', 'free')
        ->get();

    return view('admin_dashboard.payment-free', compact('freePayments'));
}

    public function user_delete($id)
    {
        $result = DB::table('indiamarts')
    ->join('users', 'indiamarts.user_id', '=', 'users.id')
    ->where('users.id', '=',$id)
    ->delete();
     if($result){
        return back()->with('success', 'Delete operation successful.');

     }

    }
}
