@component('mail::message')
# New Contact Form

Name: {{$data['name']}}

Email: {{$data['email']}}

Message:
{{$data['message']}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
