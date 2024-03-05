<section>
    <header>
        <h2 class="text-lg font-medium">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-300">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <x-alert/>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label class="form-label" for="name">Name</label>
            <input id="name" name="name" type="text" class="form-control" value="{{$user->name}}" required autofocus autocomplete="name" />
        </div>

        <div class="mb-3">
            <label class="form-label" for="email">Email</label>
            <input id="email" name="email" type="email" class="form-control" value="{{$user->email}}" required autocomplete="username" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-primary" >Save</button>
        </div>
    </form>
</section>
