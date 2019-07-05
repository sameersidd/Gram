@component('mail::message')
# Welcome to Gram

This is a clone of Instagram

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
