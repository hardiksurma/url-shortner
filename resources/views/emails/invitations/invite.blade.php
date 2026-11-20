<x-mail::message>
# Hello {{ $invitation->name }}!

You have been invited to join **{{ $companyName }}**.

Your assigned role will be **{{ $roleName }}**.

Click the button below to accept your invitation and create your account.

<x-mail::button :url="$acceptUrl" color="primary">
Accept Invitation
</x-mail::button>

This invitation will expire in 7 days.

If you were not expecting this invitation, you can ignore this email.

Thanks,
{{ config('app.name') }}
</x-mail::message>
