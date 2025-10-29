<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" style="width:100%; display: flex; flex-direction: column; justify-content: center; align-items: center; justify-content: space-between;">
                <img src="{{ getDefaultLogo() }}" alt="Alumni Portal Logo" style="opacity: .8; height: 100px;">
                <span class="text-gray-700" style="font-size: 2rem;font-weight: bold;">{{ config('app.name', 'UITS Alumni Portal') }}</span>
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')"/>

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                         autofocus/>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')"/>

                <x-input id="password" class="block mt-1 w-full"
                         type="password"
                         name="password"
                         autocomplete="current-password"/>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
                <a style="background: #666; color: #fff; padding: 5px 8px; border-radius: 3px;" href="{{ url('/register') }}" class="ml-3">Register</a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
