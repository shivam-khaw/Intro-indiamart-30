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
            <a href="#"><button class="square-grad">INDIAMART</button></a>
            <a href="#"><button class="square-grad">TALLY</button></a>
            <a href="#"><button class="square-grad">SIGNREQUEST</button></a>
            </div>
            <p class="py-3">Select a tariff (prices are per 1 channel per month)</p>
            <div class="row price-card">
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card card1 h-100">
            <div class="card-body">
             
              <h5 class="card-title">Basic</h5>
              <small class='text-muted'>Individual</small>
              <br><br>
              <span class="h2">$8</span>/month
              <br><br>
              <div class="d-grid my-3">
                <button class="btn btn-outline-dark btn-block">Select</button>
              </div>
              <ul>
                <li>Cras justo odio</li>
                <li>Dapibus ac facilisis in</li>
                <li>Vestibulum at eros</li>
                
              </ul>
            </div>

            
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-4 ">
          <div class="card card2 h-100">
            <div class="card-body">
              <h5 class="card-title">Standard</h5>
              <small class='text-muted'>Small Business</small>
              <br><br>
              <span class="h2">$20</span>/month
              <br><br>
              <div class="d-grid my-3">
                <button class="btn btn-outline-dark btn-block">Select</button>
              </div>
              <ul>
                <li>Cras justo odio</li>
                <li>Dapibus ac facilisis in</li>
                <li>Vestibulum at eros</li>
                
              </ul>
            </div>

            
          </div>
        </div>
        <div class="col-lg-4 col-md-12 mb-4">
          <div class="card card3 h-100">
            <div class="card-body">
             
              <h5 class="card-title">Premium</h5>
              <small class='text-muted'>Large Company</small>
              <br><br>
              <span class="h2">$40</span>/month
              <br><br>
              <div class="d-grid my-3">
                <button class="btn btn-outline-dark btn-block">Select</button>
              </div>
              <ul>
                <li>Cras justo odio</li>
                <li>Dapibus ac facilisis in</li>
                <li>Vestibulum at eros</li>
                
              </ul>
            </div>

            
          </div>
        </div>

        </div>
    </div>
    </div>
</div>
</div>

@endsection