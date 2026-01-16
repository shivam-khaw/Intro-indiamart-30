<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mahaabala</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('admin_assets/front-end/img/slide/company-logo.png')}}" rel="icon">
  <link href="{{asset('admin_assets/front-end/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('admin_assets/front-end/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin_assets/front-end/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin_assets/front-end/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('admin_assets/front-end/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin_assets/front-end/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('admin_assets/front-end/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('admin_assets/front-end/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('admin_assets/front-end/css/style.css')}}" rel="stylesheet">
  </head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{url('/')}}"><img src="{{asset('admin_assets/front-end/img/slide/company-logo.png')}}"></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{url('/')}}" class="active">Home</a></li>
          <li><a href="{{url('about')}}" >About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#pricing">Pricing</a></li> 
          <li><a href="{{url('contact')}}">Contact</a></li>
          @if (Route::has('login'))
          @auth

          <li><a href="{{ url('/dashboard') }}" class="getstarted">Dashboard</a></li>

                @else

          <li><a href="{{ route('login') }}" class="getstarted">Login</a></li>
          @if (Route::has('register'))

          <li><a href="{{ route('register') }}" class="getstarted">Register</a></li>
          @endif
                    @endauth
        </ul>
        @endif
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->
  @section('container')
 @show
<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6">
            <div class="footer-info">
              <h3>Mahaabala</h3>
              <p>
              Lodha Supremus - II, Phase - II, Unit No. A. 533,
5th Floor<br> Road No. 22, Wagle Estate<br> Gokul Nagar, Thane(W), <br>Thane West - 400604 india <br><br>
                <strong>Phone:</strong> +91 8355892955<br>
                <strong>Email:</strong> info@mahaabala.org<br>
              </p>
              <div class="social-links mt-3">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Intro Indiamart</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Tally Intigration</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Razorpay Intigration</a></li>
            </ul>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Our Newsletter</h4>
            <p>Bitrix24 provides a complete suite of CRM, social collaboration, communication and management tools for your team.It offers a full range of teamwork and social...</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Mahaabala</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by <a href="#">Mahaabala</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('admin_assets/front-end/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('admin_assets/front-end/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('admin_assets/front-end/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('admin_assets/front-end/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('admin_assets/front-end/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('admin_assets/front-end/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('admin_assets/front-end/js/main.js')}}"></script>

</body>

</html>
