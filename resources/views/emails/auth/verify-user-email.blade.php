@component('mail::message')
{{ __('mail.Hello') }} {{ $user->name }}

{{ __('mail.Welcome to ') }} {{ config('app.name') }}. {{ __('mail.Please verify your mail id by clicking the button.') }}

@component('mail::button', ['url' => route('auth.verifyEmail', $user->unique_code)])
{{ __('mail.Click Here') }}
@endcomponent

{{ __('mail.Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
