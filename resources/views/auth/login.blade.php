@extends('admin/auth-layouts')
@section('container')
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Login </h2>
        <div class="card my-5">
        <x-auth-session-status class="mb-4" :status="session('status')" />

          <form class="card-body cardbody-color p-lg-5" method="POST" action="{{ route('login') }}">
        @csrf


            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>

            <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />

              <input type="text" class="form-control" id="" type="email" name="email" :value="old('email')" aria-describedby="emailHelp"
                placeholder="User Name">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />

              <input type="password" class="form-control" id="password"  name="password" placeholder="password">
              <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>
            <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

            <div id="emailHelp" class="form-text text-center mb-5 text-dark">
            @if (Route::has('password.request'))
             <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
          <button type="submit" class="btn btn-success">{{ __('Log in') }}</button>
          @endif
            </div>
          
          </form>
        </div>

      </div>
    </div>
  
  @endsection
