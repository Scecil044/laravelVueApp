@component('mail::message') <div class="text-center"> <img src="https://laravel.com/img/logomark.min.svg"
            alt="{{ config('app.name') }}" class="mx-auto mb-4 w-16 h-16"> </div> # Reset Your Password <p
        class="text-gray-700 text-base leading-relaxed mb-4"> Hello,<br> You are receiving this email because we received a
        password reset request for your account. </p> @component('mail::button', ['url' => $url, 'color' => 'blue'])
        Reset Password
    @endcomponent <p class="text-gray-600 text-sm mt-6"> This password reset link will expire in 60 minutes.<br> If you did
        not request a password reset, no further action is required. </p> --- <p
        class="text-center text-xs text-gray-400 mt-8"> &copy; {{ date('Y') }} {{ config('app.name') }}. All rights
    reserved. </p> @endcomponent
