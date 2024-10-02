<!DOCTYPE html>
<html>
<head>
    <title>Reservation Endorsement Notification</title>
</head>
<body>
    <h1>Reservation Endorsement Notification</h1>
    <p>Dear {{ $endorsedBy }},</p>
    <p>You have been requested to endorse a reservation.</p>
    <p><strong>Reservee Name:</strong> {{ $reserveeName }}</p>
    <p><strong>Event Name:</strong> {{ $eventName }}</p>
    <p><strong>Event Start Date:</strong> {{ $eventStartDate }}</p>
    <p><strong>Chosen Facilities:</strong> {{ $chosenFacilityList }}</p>
    <p>Please confirm your endorsement by clicking the link below:</p>
    <p><a href="{{ route('confirm.endorsement', ['token' => $confirmationToken]) }}">Confirm Endorsement</a></p>

    <p>Thank you!</p>
</body>
</html>
