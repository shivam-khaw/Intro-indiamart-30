@include('admin_dashboard/nav')

<div class="page-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="infographic-cards">
                    <li class="color-1">

                        <h5>Intro Indiamart</h5>
                        <a href="{{ url('admin/dashboard', ['app_type' => 'indiamart'])}}">
                            <img class="zoom-in-zoom-out" src="{{asset('admin_assets/admin_css_js/img/ind.png')}}">
                        </a>
                        <div class="number-box">
                        <a href="{{ url('admin/dashboard', ['app_type' => 'indiamart']) }}">
                                Read more</a>
                        </div>
                    </li>
                    <li class="color-2">

                        <h5>Razorpay</h5>
                        <a href="{{url('admin/dashboard',['app_type' => 'razorpay'])}}"> <img class="zoom-in-zoom-out" src="{{asset('admin_assets/admin_css_js/img/rz.png')}}"></a>

                        <div class="number-box">
                            <a href="{{url('admin/dashboard',['app_type' => 'razorpay'])}}">Read more</a>

                        </div>
                    </li>
                    <li class="color-3">
                        <h5>Tally</h5>
                        <a href="{{url('admin/dashboard',['app_type' => 'tally'])}}"> <img class="zoom-in-zoom-out" src="{{asset('admin_assets/admin_css_js/img/tl.jpg')}}"></a>

                        <div class="number-box">
                            <a href="{{url('admin/dashboard',['app_type' => 'tally'])}}">Read more</a>

                        </div>
                    </li>
                    <li class="color-4">
                        <h5>Other</h5>
                        <a href="{{url('admin/dashboard',['app_type' => 'Other'])}}"> <img class="zoom-in-zoom-out" src="{{asset('admin_assets/admin_css_js/img/ca.png')}}"></a>

                        <div class="number-box">
                            <a href="{{url('admin/dashboard',['app_type' => 'Other'])}}">Read more</a>

                        </div>
                    </li>

                </ul>

            </div>
        </div>
    </div>
</div>