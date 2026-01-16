@extends('front-end/master-layout')

@section('container')
<main id="main">
 <!-- ======= Breadcrumbs ======= -->
 <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>About</h2>
          <ol>
            <li><a href="{{url('/')}}">Home</a></li>
            <li>About</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row content">
          <div class="col-lg-6">
            <h2>Mahaabala</h2>
            <h3> Empowering businesses through expert Bitrix24 API integration and custom application development.</h3>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0">
            <p>
            Mahaabala specializes in Bitrix24 API integration and custom application development, empowering businesses to leverage the full potential of Bitrix24's extensive features. With a focus on innovation and efficiency, we provide tailored solutions that enhance productivity, streamline workflows, and drive growth.           
           </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Expert API Integration</li>
              <li><i class="ri-check-double-line"></i>Custom Application Development</li>
              <li><i class="ri-check-double-line"></i> Enhanced Efficiency</li>
              <li><i class="ri-check-double-line"></i> Continuous Support</li>
            </ul>
            <p class="fst-italic">
            Our commitment doesn't end with deployment. We provide ongoing support and maintenance to ensure your Bitrix24 ecosystem runs smoothly at all times.
          </p>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->
@endsection