@component('mail::message')
{{ __('mail.Hello') }} {{ $user->name }}

{{ __('mail.Welcome to ') }} {{ config('app.name') }}.

{{ __('mail.Thanks') }},<br>
{{ config('app.name') }}
@endcomponent
