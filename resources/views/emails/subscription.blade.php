@component('mail::message')
# Subscription Confirmation

Thank you for subscribing to our newsletter 😊 🎉!

@component('mail::button', ['url' => config('app.url')])
Visit Our Website
@endcomponent

We look forward to bringing you the latest news and updates.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
