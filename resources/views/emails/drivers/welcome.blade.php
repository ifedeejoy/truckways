@component('mail::message')
# Hello {{$user}}

Thank you for signing up to truckways, we've listed the next steps for you to fully enjoy our amazing service.
<ul>
    <li>Go to my manage account</li>
    <li>Click on the edit icon (looks like a pencil)</li>
    <li>Update your profile information</li>
    <li>Click submit</li>
</ul>
Now you can request for your account to be verified allowing you to get notified & bid on premium loads

Thanks,<br>
{{ config('app.name') }}
@endcomponent
