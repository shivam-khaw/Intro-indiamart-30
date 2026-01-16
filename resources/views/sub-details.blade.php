@extends('admin/layout')
@section('container')

<div class="row">
  <div class="col-12">
    <div class="top-text">Subscriptions</div>
    <div class="one">
      <a href="sub-details"><button class="square-grad">Subscriptions</button></a>
      <a href="#"><button class="square-grad">Invoices and Payment</button></a>
      <a href="#"><button class="square-grad">Payment details</button></a>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="row py-5">
        <div class="col-2"></div>
        <div class="col-8 py-3">
          <h4 class="text-center">Possible subscriptions and tariffs
          </h4>
          <p class="min-text">To add a subscription, first add channels</p>
          <div class="two text-center">
            <a href="{{url('indiamart_price')}}"><button class="square-grad">INDIAMART</button></a>
            <a href="#"><button class="square-grad">TALLY</button></a>
            <a href="#"><button class="square-grad">SIGNREQUEST</button></a>
          </div>
          <p class="py-3">Select a tariff (prices are per 1 channel )</p>
                        
        </div>
      </div>
    </div>
  </div>

  @endsection