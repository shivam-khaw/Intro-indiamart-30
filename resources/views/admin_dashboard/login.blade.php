<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <link rel="stylesheet" href="{{asset('admin_assets/admin_css_js/app.css')}}">
  <link rel="stylesheet" href="{{asset('admin_assets/admin_css_js/style.css')}}">

  
  <title>Login Form</title>
  <style>
  
    </style>
</head>
<body>
   <!-- for header part -->
   <header>

<div class="logosec">
    <div class="logo">
    <img src="{{asset('admin_assets/admin_css_js/img/hub-logo.png')}}" class="icn menuicn" id="menuicn" alt="menu-icon">
</div>
</div>
</header>
  <div class="container1">
    <div class="column">
    <form class="form"  action="{{url('admin/login1') }}" method="post">
      @csrf
      <h2 class="h2_class">User Login</h2>
      
      <div class="input-wrapper">
        <label for="login-username">Username</label>
        <div class="input-group">
          <span class="icon">
            <i class="fas fa-user"></i>
          </span>
          <input type="email" name="email" id="email" value="{{ old('email') }}" data-lpignore="true" required>
        </div>
      </div>
      
      <div class="input-wrapper">
        <label for="password">Password</label>
        <div class="input-group">
          <span class="icon">
            <i class="fas fa-lock"></i>
          </span>
          <input type="password" id="login-password" name="password" data-lpignore="true">
        </div>
      </div>

      <div class="btn-group">
        <button class="btn btn--primary" type="submit">Sign in</button>
        <a class="btn--text" href="#0">Forgot password?</a>
      </div>
    </form>
     </div>
</div>
   
</body>
</html>