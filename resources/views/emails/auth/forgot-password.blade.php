@component('mail::message')
{{ __('mail.Hello') }} {{ $user->name }}

{{ __('mail.Please reset your password by clicking the button.') }}

@component('mail::button', ['url' => route('auth.resetPassword', $user->unique_code)])
{{ __('mail.Click Here') }}
@endcomponent

{{ __('mail.Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
