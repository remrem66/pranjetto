<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>Thank you for booking Pranjetto Hills Resort! We look forward to having you in our place!</h1>
    <p> To settle your payment, please follow the steps below:</p>
    <p>* Go to any of the following bank for the initial deposit of the amount due.</p>
    @for($x = 0; $x < count($details); $x++)
    <p>{{$details[$x]['bank_name']}}: {{$details[$x]['account_num']}}</p>
    @endfor
    <p>* Initial deposit must be 50% of {{$details[0]['total_price']}} </p>
    <p>* Have the copy of the receipt and send it to this email.  </p>
    <p> Rebooking Policy:
Pranjetto Kdosisjd allows one time reschedule only. We can adjust the booking without any charge only if the request is raised one week prior to the booking date. However, any rescheduling less than seven (7) days before the booking date is strictly prohibited.</p>
<p> Cancellation Policy:
Cancellation of bookings is allowed anytime but doesn't deem the customers to refund any initial deposit or payment. </p>
<p>For final reminders:
*Senior guests must present their senior ID to the receptionist upon arrival to the hotel.
*Standard check-in time is 2:00pm and check-out tine is 12:pm </p>
    <p>Please let us know if you have any questions through our contact page. </p>
    <p>Thank you!</p>
</body>
</html>