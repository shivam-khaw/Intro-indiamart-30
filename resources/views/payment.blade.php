@extends('admin/layout')
@section('container')

<div class="row">
    <div class="col-12">
        <div class="top-text">Subscriptions</div>
        <div class="one">
            <a href="{{url('indiamart_price')}}"><button class="square-grad">Subscriptions</button></a>
            <a href="{{url('plan')}}"><button class="square-grad">Invoices and Payment</button></a>
            <a href="{{url('plan')}}"><button class="square-grad">Payment details</button></a>
        </div>
        <div class="card">
            <div class="card-headr">

            </div>
            <div class="card-body">
                
            <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Plan</th>
      <th scope="col">Custome Email</th>
      <th scope="col">Plan Activate Date</th>
      <th scope="col">Plan Expire Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach($paymentData as $key=>$val)
    <tr>
      <th scope="row">{{$val->id}}</th>
      <th scope="row">{{$val->plan}}</th>
      <td>{{$val->email}}</td>
      <td>{{$val->payment_date}}</td>
      <td>{{$val->plan_expire}}</td>
    </tr>
    
    @endforeach
    </tbody>
</table>
            </div>
        </div>
    </div>
</div>
@endsection