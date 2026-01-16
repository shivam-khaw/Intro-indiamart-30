@extends('admin/layout')
@section('container')
<style>
  .free {
    display: none;
  }

  .activated2 {
    display: none;
  }

  .activated3 {
    display: none;
  }

  .activated4 {
    display: none;
  }

  .activated5 {
    display: none;
  }


  /*.free_activate5{
    display: none;
  }
  .free_activate4{
    display: none;
  }
  .free_activate3{
    display: none;
  }
  .free_activate2{
    display: none;
  }
  .free_activate1{
    display: none;
  }*/
</style>
<div class="row">
  <div class="col-12">
    <div class="top-text">Subscriptions</div>
    <div class="one">
      <a href="{{url('indiamart_price')}}"><button class="square-grad">Subscriptions</button></a>
      <a href=""><button class="square-grad">Invoices and Payment</button></a>
      <a href="{{url('plan')}}"><button class="square-grad">Payment details</button></a>
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
          <p class="py-3">Select a tariff (prices are per 1 channel per month)</p>
          <div class="row price-card">
            <div class="col-lg-4 col-md-12 mb-4">
              <div class="card card1 h-100">
                <div class="card-header cardheader1 car4">
                  <h4><i class="fa-solid fa-square-check"></i>&nbsp;&nbsp;&nbsp;<span class="ac">Activate</span></h4>
                  <h6 class="ex"> Expire:-<span class="date"></span></h6>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Trial</h5>
                  <span class="h2"><span class="h2" id="card4"></span></span>3/dyas
                  <br>
                  <div class="d-grid my-3">
                    <div id="loader" class="loader"></div>

                    <button class="btn btn-outline-dark btn-block free_activate2 btn-free" id="btn-free" value="trial">Subscription</button>
                    <button class="btn btn-success btn-block activated2"> Trial mode</button>
                    <button class="btn btn-success btn-block free">Free</button>

                  </div>
                  <ul>
                    <li>Indiamart Data Synchronisation every 10 minutes</li>
                  </ul>
                </div>


              </div>
            </div>

            <div class="col-lg-4 col-md-12 mb-4">
              <div class="card card1 h-100">
                <div class="card-header cardheader1 car1">
                  <h4><i class="fa-solid fa-square-check"></i>&nbsp;&nbsp;&nbsp;<span class="ac">Activate</span></h4>
                  <h6 class="ex"> Expire:-<span class="date"></span></h6>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Silver</h5>
                  <span class="h2">INR<span class="h2" id="card1">500</span></span>/month
                  <br>
                  <div class="d-grid my-3">
                    <button class="btn btn-outline-dark btn-block checkoutButton free_activate3" id="checkoutButton" data-card="card1">Subscription</button>
                    <button class="btn btn-success btn-block activated3"> Plan Activated</button>

                  </div>
                  <ul>
                    <li>Indiamart Data Synchronisation every 2hrs</li>
                    <li>Total Synchronisation 360</li>
                  </ul>
                </div>


              </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-4 ">
              <div class="card card2 h-100">
                <div class="card-header cardheader1 car2">
                  <h4><i class="fa-solid fa-square-check"></i>&nbsp;&nbsp;&nbsp;<span class="ac">Activate</span></h4>
                  <h6 class="ex"> Expire:-<span class="date"></span></h6>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Gold</h5>
                  <span class="h2">INR<span class="h2" id="card2">750</span></span>/month
                  <br>
                  <div class="d-grid my-3">
                    <button class="btn btn-outline-dark btn-block checkoutButton free_activate4" id="checkoutButton" data-card="card2">Subscription</button>
                    <button class="btn btn-success btn-block activated4"> Plan Activated</button>

                  </div>
                  <ul>
                    <li>Indiamart Data Synchronisation every 30 minutes</li>
                    <li>Total Synchronisation 1440</li>
                  </ul>
                </div>

              </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
              <div class="card card3 h-100">
                <div class="card-header cardheader1 car3">
                  <h4><i class="fa-solid fa-square-check"></i>&nbsp;&nbsp;&nbsp;<span class="ac">Activate</span></h4>
                  <h6 class="ex"> Expire:-<span class="date"></span></h6>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Platinum</h5>
                  <span class="h2">INR<span class="h2 " id="card3">1000</span></span>/month
                  <br>
                  <div class="d-grid my-3">
                    <button class="btn btn-outline-dark btn-block checkoutButton free_activate5" id="checkoutButton" data-card="card3">Subscription</button>
                    <button class="btn btn-success btn-block activated5"> Plan Activated</button>

                  </div>
                  <ul>
                    <li>Indiamart Data Synchronisation every 10 minutes</li>
                    <li>Total Synchronisation 4320</li>
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
  <script>
    /* $(document).ready(function() {
        $(".btn-block").click(function() {
            var cardId = $(this).data("card");
            var cardValue = $("#" + cardId).text();
            //var currentTime = new Date().toLocaleTimeString();

            console.log("Button clicked: " + $(this).text());
            console.log("Card value: " + cardValue);
            console.log("Current time: " + currentTime);
        });
    });
*/

    $(document).ready(function() {
      $('.activated2').click(function() {
        alert('Your trial plan is already active!');
      })
      $('.free').click(function() {
        alert('Your plan is already active!');
      })
      $('#btn-free').click(function() {
        let freeCard = $('#btn-free').val(); // Corrected from va() to val()
        $('#btn-free').text('Wait...')
        $('#btn-free').prop('disabled', true);

        // alert(freeCard);
        $.ajax({
          type: "POST",
          url: "{{url('free_plan')}}",
          data: {
            freeCard: freeCard,
            _token: '{{ csrf_token() }}',
          },
          success: function(response) {
            // Handle the success response
            console.log(response);
            $('.activated2').show();
            $('#btn-free').hide();
          },
          error: function(error) {
            // Handle the error response
            console.error("Error:", error);
          }
        });
      });
      $('.checkoutButton').click(function() {
        let userName= '{{ Auth::user()->name }}';
        var cardId = $(this).data("card");

        var cardValue = $("#" + cardId).text();
        //alert(cardId);
        let cardAmount = cardValue * 100;
        let planValue = "";
        if (cardId == "card1") {
          planValue = 'silver';
        } else if (cardId == "card2") {
          planValue = 'gold';
        } else if (cardId == "card3") {
          planValue = 'platinum';
        }
        $.ajax({
          url: '{{url("payment")}}',
          type: 'POST',
          contentType: 'application/json',
          data: JSON.stringify({
            amount: cardAmount, // Amount in paise (e.g., 1000 for INR)
            currency: 'INR',
            payment_capture: 1,
            _token: '{{ csrf_token() }}',
            // Automatically capture payment after creation
          }),
          success: function(data) {
            //console.log(data.amount);
             if(data==5){
                 alert('Please set API key first!');
             }
            var data = JSON.parse(data);
            var customer_id = data.customer_id;
            // Step 2: Initialize Razorpay Checkout with the obtained order ID
            var options = {
              key: 'rzp_test_zyjNysn1YLT3wm',
              amount: data.amount,
              currency: data.currency,
              name:'',
              description: 'Purchase Description',
              order_id: data.order_id,
              handler: function(response) {
                // Step 3: Handle the payment response (optional)
                // var response = JSON.parse(response);
                console.log('Payment successful!', response);
                var payment_id = response.razorpay_payment_id;
                var order_id = response.razorpay_order_id;
                $.ajax({
                  url: '{{url("/payment/status")}}',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    payment_id: payment_id,
                    order_id: order_id,
                    customer_id: customer_id,
                    planValue: planValue,
                    _token: '{{ csrf_token() }}'
                  },
                  success: function(response) {
                    //console.log('Payment Status:', response.status);
                  },
                  error: function(error) {
                    console.error('Error:', error);
                  }
                });
              },
              theme: {
                color: '#F37254',
              },
            };

            var rzp = new Razorpay(options);
            rzp.open();
          },
          error: function(error) {
            console.error('Error creating order:', error);
          }
        });
      });
      $.ajax({
        url: '{{url("plan_status")}}',
        type: 'GET',
        //dataType: 'json', // Change this based on your response type
        success: function(response) {
          console.log(response.data.plan_name);
          console.log(response.data.expire);
          // Handle the response data here
          if (response.data.plan_name == 'silver') {
            $('.car1').show();
            $('.date').text(response.data.expire);
            $('.free_activate3').hide();
            $('.activated3').show();
            $('.free').show();
            $('.activated2').hide();
            $('.free_activate2').hide();
          } else if (response.data.plan_name == 'gold') {
            $('.car2').show();
            $('.date').text(response.data.expire);
            $('.free_activate4').hide();
            $('.activated4').show();
            $('.free').show();
            $('.activated2').hide();
            $('.free_activate2').hide();
          } else if (response.data.plan_name == 'platinum') {
            $('.car3').show();
            $('.date').text(response.data.expire);
            $('.free_activate5').hide();
            $('.activated5').show();
            $('.free').show();
            $('.activated2').hide();
            $('.free_activate2').hide();
          } else if (response.data.plan_name == 'trial') {
            $('.car4').show();
            $('.date').text(response.data.expire);
            $('.free_activate2').hide();
            $('.activated2').show();
            $('.free').hide();
          } else if (response.data.plan_name == 'free') {
            $('.car4').show();
            $('.date').text(response.data.expire);
            $('.free_activate2').hide();
            $('.activated2').hide();
            $('.free').show();


          } else {
            $('.activated2').hide();
            $('.activated4').hide();
            $('.activated3').hide();
            $('.activated5').hide();


          }

        },
        error: function(error) {
          console.error('Error:', error);
        }
      })
    });
  </script>