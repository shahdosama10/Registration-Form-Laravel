@component('mail::message')
A new user {{ $userName }} is registered to the system.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
