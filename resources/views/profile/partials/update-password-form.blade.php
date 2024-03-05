<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label" for="update_password_current_password">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" required autocomplete="current-password" />
        </div>

        <div class="mb-3">
            <label class="form-label" for="update_password_password">New Password</label>
            <input id="update_password_password" name="password" type="password" class="form-control" required autocomplete="new-password" />
        </div>

        <div class="mb-3">
            <label class="form-label" for="update_password_password_confirmation">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" required autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-4">
            <button class="btn btn-primary" type="submit">Save</button>
        </div>
    </form>
</section>
