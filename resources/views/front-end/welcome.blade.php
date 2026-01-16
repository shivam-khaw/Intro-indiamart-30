@extends('front-end/master-layout')

@section('container')

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    <div class="carousel-inner" role="listbox">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img src="{{asset('admin_assets/front-end/img/slide/s1.jpeg') }}" width="100%" height="100%">
        <div class="carousel-container">
          <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Welcome to <span>Mahaabala</span></h2>
            <p class="animate__animated animate__fadeInUp">"Mahaabala CRM Integration" is a cutting-edge application designed to seamlessly integrate with various Customer Relationship Management (CRM) platforms, enhancing efficiency and productivity for businesses. By facilitating smooth data synchronization and communication between Mahaabala and popular CRM systems, this innovative solution empowers organizations to streamline their processes, optimize customer interactions, and drive growth.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item"><img src="{{asset('admin_assets/front-end/img/slide/s4.jpg')}}"width="100%" height="100%">
        <div class="carousel-container">
          <div class="container">
            <h2 class="animate__animated animate__fadeInDown"> Intro Indiamart</h2>
            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item"><img src="{{asset('admin_assets/front-end//img/slide/s2.jpg')}}"width="100%" height="100%">
        <div class="carousel-container">
          <div class="container">
            <h2 class="animate__animated animate__fadeInDown">Razorpay Intigration</h2>
            <p class="animate__animated animate__fadeInUp">Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
            <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Read More</a>
          </div>
        </div>
      </div>

    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
    </a>

  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">
      <div class="row content">
        <div class="col-lg-6">
          <h2>Development Begins Here</h2>
          <h3>A platform for initiating and advancing projects with a succinct </h3>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <p>
          Unlock the full potential of your business processes with seamless integration of Bitrix24 with leading third-party applications like IndiaMart and Razorpay. Empower your team to streamline operations, manage customer relations efficiently, and drive growth with enhanced collaboration and productivity.
          </p>
          <ul>
            <li><i class="ri-check-double-line"></i>Streamlined Operations</li>
            <li><i class="ri-check-double-line"></i> Enhanced Customer Relations</li>
            <li><i class="ri-check-double-line"></i> Scalability and Growth</li>
          </ul>
          <p class="fst-italic">
          Introducing seamless integration: IndiaMart to Bitrix24. Empower your business with a streamlined workflow as IndiaMart, the leading B2B marketplace, integrates seamlessly with Bitrix24, your all-in-one business management solution. Effortlessly manage leads, inquiries, and transactions from IndiaMart directly within Bitrix24, enhancing efficiency and productivity for your team.
          </p>
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services section">
    <div class="container">
    <h2 class="py-3">Services</h2>

      <div class="row">
        <div class="col-md-6">
          <div class="icon-box">
            <i class="bi bi-briefcase"></i>
            <h4><a href="#">Intro IndiaMart</a></h4>
            <p>Effortlessly integrate IndiaMart with Bitrix24 for streamlined business operations. Seamlessly manage leads, inquiries, and transactions from IndiaMart directly within Bitrix24, enhancing efficiency and productivity.</p>
          </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
          <div class="icon-box">
            <i class="bi bi-card-checklist"></i>
            <h4><a href="#">Razorpay Intigration</a></h4>
            <p>Unlock seamless integration between Razorpay and Bitrix24 for streamlined payment processing. Simplify transactions, manage invoices, and track payments effortlessly within your Bitrix24 environment, empowering your business with efficient financial management</p>
          </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
          <div class="icon-box">
            <i class="bi bi-bar-chart"></i>
            <h4><a href="#">Tally Intigration</a></h4>
            <p>"Effortlessly integrate Tally with Bitrix24 for streamlined accounting and financial management. Seamlessly synchronize data, manage invoices, and track financial transactions within your Bitrix24 platform, ensuring accurate and efficient accounting processes.</p>
          </div>
        </div>
              </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="portfolio" class="portfolio">
    <div class="container section"id="pricing">

      <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
          <ul id="portfolio-flters">
            <li data-filter=".filter-app" class="filter-active ">Intro IndiaMart</li>
            <li data-filter=".filter-card">Razorpay Intigration</li>
            <li data-filter=".filter-web">Tally Intigration</li>
          </ul>
        </div>
      </div>

      <div class="row portfolio-container">
        <section id="pricing" class="pricing portfolio-item filter-app ">
          <div class="container">

            <div class="row">

              <div class="col-lg-3 col-md-6">
                <div class="box featured">
                  <h3>Free</h3>
                  <h4><sup>$</sup>0<span> /3 days</span></h4>
                  <ul>
                  <li>Indiamart Data Synchronisation every 10 minutes</li>
                  <li>Synchronisation 3 days</li>
                  </ul>
                  <div class="btn-wrap">
              @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                <div class="box featured">
                  <h3>Silver</h3>
                  <h4><sup>$</sup>6<span> / month</span></h4>
                  <ul>
                  <li>Indiamart Data Synchronisation every 2hrs</li>
                    <li>Total Synchronisation 360</li>
                  </ul>
                  <div class="btn-wrap">
                       @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif

                    
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="box featured">
                  <h3>Gold</h3>
                  <h4><sup>$</sup>9<span> / month</span></h4>
                  <ul>
                  <li>Indiamart Data Synchronisation every 30 minutes</li>
                    <li>Total Synchronisation 1440</li>
                  </ul>
                  <div class="btn-wrap">
                 @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="box featured">
                  <span class="advanced">Advanced</span>
                  <h3>Platinum</h3>
                  <h4><sup>$</sup>12<span> / month</span></h4>
                  <ul>
                  <li>Indiamart Data Synchronisation every 10 minutes</li>
                    <li>Total Synchronisation 4320</li>
                  </ul>
                  <div class="btn-wrap">
                  @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

            </div>

          </div>
        </section>
        
        <section id="pricing" class="pricing  portfolio-item filter-web">
          <div class="container">

            <div class="row">

              <div class="col-lg-3 col-md-6">
                <div class="box featured">
                  <h3>Free</h3>
                  <h4><sup>$</sup>0<span> /1 days</span></h4>
                  <ul>
                  <li>Share Payment Links via Email</li>
                  <li>Copy Payment Links for Easy Sharing</li>
                  <li>Automate Payment Link Sharing in CRM</li>
                  </ul>
                  <div class="btn-wrap">
              @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                <div class="box featured">
                  <h3>Silver</h3>
                  <h4><sup>$</sup>6<span> / month</span></h4>
                  <ul>
                   <li>Share Payment Links via Email</li>
                  <li>Copy Payment Links for Easy Sharing</li>
                  <li>Automate Payment Link Sharing in CRM</li>
                  </ul>
                  <div class="btn-wrap">
                       @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif

                    
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="box featured">
                  <h3>Gold</h3>
                  <h4><sup>$</sup>9<span> / month</span></h4>
                  <ul>
                   <li>Share Payment Links via Email</li>
                  <li>Copy Payment Links for Easy Sharing</li>
                  <li>Automate Payment Link Sharing in CRM</li>
                  </ul>
                  <div class="btn-wrap">
  @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="box featured">
                  <span class="advanced">Advanced</span>
                  <h3>Platinum</h3>
                  <h4><sup>$</sup>12<span> / years</span></h4>
                  <ul>
                  <li>Share Payment Links via Email</li>
                  <li>Copy Payment Links for Easy Sharing</li>
                  <li>Automate Payment Link Sharing in CRM</li>
                  </ul>
                  <div class="btn-wrap">
  @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

            </div>

          </div>
        </section>

        <section id="pricing" class="pricing portfolio-item filter-card">
          <div class="container">

           <div class="row">

              <div class="col-lg-3 col-md-6">
                <div class="box featured">
                  <h3>Free</h3>
                  <h4><sup>$</sup>0<span> /3 days</span></h4>
                  <ul>
                  <li>Share Payment Links via Email</li>
                  <li>Copy Payment Links for Easy Sharing</li>
                  <li>Automate Payment Link Sharing in CRM</li>
                  </ul>
                  <div class="btn-wrap">
              @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
                <div class="box featured">
                  <h3>Silver</h3>
                  <h4><sup>$</sup>9<span> / month</span></h4>
                  <ul>
                  <li>Share Payment Links via Email</li>
                  <li>Copy Payment Links for Easy Sharing</li>
                  <li>Automate Payment Link Sharing in CRM</li>
                  </ul>
                  <div class="btn-wrap">
                       @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif

                    
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="box featured">
                <span class="advanced">10% OFF</span>

                  <h3>Gold</h3>
                  <h4><sup>$</sup>24<span>/<strong>3</strong>month</span></h4>
                  <ul>
                  <li>Share Payment Links via Email</li>
                  <li>Copy Payment Links for Easy Sharing</li>
                  <li>Automate Payment Link Sharing in CRM</li>
                  </ul>
                  <div class="btn-wrap">
  @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="box featured">
                  <span class="advanced">20% OFF</span>
                  <h3>Platinum</h3>
                  <h4><sup>$</sup>86<span> /Year</span></h4>
                  <ul>
                  <li>Share Payment Links via Email</li>
                  <li>Copy Payment Links for Easy Sharing</li>
                  <li>Automate Payment Link Sharing in CRM</li>
                  </ul>
                  <div class="btn-wrap">
  @if (Route::has('login'))
                      @auth
                    <a href="{{url('/indiamart_price')}}" class="btn-buy">Sign Up</a>
                    @else
                    <a href="{{url('login')}}" class="btn-buy">Sign Up</a>
                     @endauth
                     @endif
                  </div>
                </div>
              </div>

            </div>

          </div>
        </section>



      </div>

    </div>

    </div>
  </section><!-- End Portfolio Section -->

</main>
<!-- End #main -->
<style>
    .advanced {
  background: #d4edda!important; /* Light green background */
  color: #155724!important;      /* Dark green text for better contrast */
  padding: 5px 10px;   /* Optional padding for better appearance */
  font-weight: bold;   /* Bold text for emphasis */
  border-radius: 5px;  /* Rounded corners for a polished look */
}
</style>
<script>
  // Smooth scroll behavior for navigation links
  document.querySelectorAll('a[href^="#price"], a[href^="#services"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (targetElement) {
            targetElement.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>


@endsection