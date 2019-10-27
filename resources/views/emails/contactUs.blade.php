@component('mail::message')
{{ $message }}

Thanks,<br>
{{ $name }}<br>
{{ $email }}
@endcomponent
