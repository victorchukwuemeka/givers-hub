@component('mail::message')
# Contact Message Received

You have received a new contact message from the website.

@component('mail::panel')
Name: {{ $contactMessage->name }} <br> 
Email: {{ $contactMessage->email }} <br>
Subject: {{ $contactMessage->subject }} <br>
Message: {{ $contactMessage->message }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
