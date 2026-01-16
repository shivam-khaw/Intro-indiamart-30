<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        <!-- CSRF Token -->
        @csrf

        <!-- HTTP Method Spoofing -->
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
            <!-- Validation Error Message -->
            @if ($errors->updatePassword->has('current_password'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->first('current_password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
            <!-- Validation Error Message -->
            @if ($errors->updatePassword->has('password'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->first('password') }}
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
            <!-- Validation Error Message -->
            @if ($errors->updatePassword->has('password_confirmation'))
                <div class="text-danger mt-2">
                    {{ $errors->updatePassword->first('password_confirmation') }}
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Save</button>

            <!-- Session Status Message -->
            @if (session('status') === 'password-updated')
                <p class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
            @endif
        </div>
    </form>
</section>
