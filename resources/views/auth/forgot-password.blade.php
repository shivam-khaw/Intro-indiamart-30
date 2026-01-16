@extends('admin/auth-layouts')
@section('container')
<style>
    .form-center{
        width: 30rem;
        margin-left: 30%;
    margin-top: 5%;
    }
</style>
<div class="row">
    <div class="form-center">
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
              <input type="text" class="form-control" id="" type="email" name="email" :value="old('email')" aria-describedby="emailHelp"
                placeholder="User Name">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            
        <div class="flex items-center justify-end mt-4">
            <button class="btn btn-dark">
                {{ __('Email Password Reset Link') }}
</button>
        </div>
    </form>
    </div>
</div>
@endsection