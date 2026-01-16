@extends('admin/layout')
@section('container')

<div class="row">
    <div class="col-12">
    <div class="top-text">Subscriptions</div>
        <div class="one">
                    <a href="{{url('indiamart_price')}}"><button class="square-grad">Subscriptions</button></a>
                    <a href="invoice"><button class="square-grad">Invoices and Payment</button></a>
                    <a href="{{url('plan')}}"><button class="square-grad">Payment details</button></a>
                </div>
     </div>
</div>
<div class="row">
</div>

@endsection