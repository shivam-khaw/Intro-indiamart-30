    @include('admin_dashboard/nav')

    <div class="main-container">

        <div class="navcontainer">
            <nav class="nav">
                <div class="nav-upper-options">
                <a href="{{ url('admin/dashboard/' . Session::get('app_type')) }}">
                    <div class="nav-option option1">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png" class="nav-img" alt="dashboard">
                        <h5> Dashboard</h5>
                    </div>
                    </a>
                    
                    <div class="option2 nav-option">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png" class="nav-img" alt="articles">
                        <a href="{{ url('admin/payment-done/')}}">
                        <h5>Payment success</h5>
                        </a>
                    </div>

                    <div class="nav-option option3">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/5.png" class="nav-img" alt="report">
                        <a href="{{ url('admin/payment-failed/')}}">
                        <h5>Payment failed</h5>
</a>
                    </div>

                    <div class="nav-option option4">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/6.png" class="nav-img" alt="institution">
                        <a href="{{ url('admin/payment-free')}}">
                        <h5>Free Users</h5>
                        </a>
                    </div>

                    <div class="nav-option option5">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png" class="nav-img" alt="blog">
                        <a href="{{ url('admin/dashboard/')}}">
                        <h5> Profile</h5>
                        </a>
                    </div>
                    
                    <div class="nav-option option6">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png" class="nav-img" alt="settings">
                        <a href="{{ url('admin/dashboard/')}}">
                        <h5> Settings</h5>
                        </a>
                    </div>
                    
                    <div class="nav-option logout">
                        <img src="https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png" class="nav-img" alt="logout">
                        <a href="{{url('admin/logout')}}">
                        <h5>Logout</h5>
                        </a>
                    </div>

                </div>
            </nav>
        </div>
        <div class="main">

            
            @section('container')
            @show
        </div>



    </div>
<script>
   
</script>
    </body>

    </html>