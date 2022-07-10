<x-guest-layout>
  <x-auth-card>
    <x-slot name="logo">
      <a href="/">
        <x-application-logo />
      </a>
    </x-slot>

    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <!-- Validation Errors -->
    <x-auth-validation-errors :errors="$errors" />

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <!-- Email Address -->
      <div>
        <x-label for="email" :value="__('Email')" />

        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus />
      </div>

      <!-- Password -->
      <div>
        <x-label for="password" :value="__('Password')" />

        <x-input id="password" type="password" name="password" required autocomplete="current-password" />
      </div>

      <!-- Remember Me -->
      <div>
        <label for="remember_me">
          <input id="remember_me" type="checkbox" name="remember">
          <span>{{ __('Remember me') }}</span>
        </label>
      </div>

      <div>
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">
          {{ __('Forgot your password?') }}
        </a>
        @endif

        <x-button>
          {{ __('Log in') }}
        </x-button>
      </div>
    </form>
  </x-auth-card>
</x-guest-layout>