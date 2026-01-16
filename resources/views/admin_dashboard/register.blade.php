@extends('admin_dashboard/layouts')
@section('container')
<div class="container1">
    
        <div class="column">
            <form class="form" method="POST" action="{{ route('admin/register') }}">
        @csrf

                <h2 class="h2_class">Create new employee</h2>

                <div class="input-wrapper">
                    <label for="username1">Username</label>
                    <div class="input-group">
                        <span class="icon">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text"  name="name"  value="" required autocomplete="nope">
                    </div>
                </div>
                <div class="input-wrapper">
                    <label for="email">Email</label>
                    <div class="input-group">
                        <span class="icon">
                        <i class="fa fa-envelope"></i>
                        </span>
                        <input type="email" name="email" id="email" value="" required autocomplete="nope">
                    </div>
                </div>

                <div class="input-wrapper">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="icon">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password" id="password" required>
                    </div>
                </div>
                <div class="input-wrapper">
                    <label for="rep-password">Confirm Password:</label>
                    <div class="input-group">
                        <span class="icon">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                    </div>
                </div>
 
                <div class="btn-group">
                    <button class="btn btn--primary" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection