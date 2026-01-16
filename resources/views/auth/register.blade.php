@extends('admin/auth-layouts')
@section('container')
<div class="row">
      <div class="col-md-6 offset-md-3">
        <h2 class="text-center text-dark mt-5">Register </h2>
        <div class="card my-5">
        <x-auth-session-status class="mb-4" :status="session('status')" />

          <form class="card-body cardbody-color p-lg-5" method="POST" action="{{ route('register') }}">
        @csrf



            <div class="text-center">
              <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3"
                width="200px" alt="profile">
            </div>

            <div class="mb-3">
            <x-input-label for="name" :value="__('Name')" />

              <input type="text" class="form-control"id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
              <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />

              <input type="text" class="form-control" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="mb-3">
            <x-input-label for="phone" :value="__('Phone')" />

              <input type="text" class="form-control" id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
            
            <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />

              <input type="password" class="form-control" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>
            <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

              <input type="password" class="form-control" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

            </div>
           <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button class="ml-4 btn-primary">
                {{ __('Register') }}
            </button>
        </div>          
          </form>
        </div>

      </div>
    </div>
  


@endsection
