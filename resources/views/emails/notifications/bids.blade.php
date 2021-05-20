@component('mail::message')
# Hello {{$name}}

There's a new bid of {{$amount ?? ''}} for your load {{$load ?? ''}} by {{$driver ?? ''}}, login to check the details of the bid and the drivers profile <br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
