<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h1>Thank you for booking Pranjetto Hills Resort! We look forward to having you in our place!</h1>
    <p> To settle your payment, please follow the steps below:</p>
<p> Reservation Code: {{$details[0]['code']}} </p>
    <p>* Go to any of the following bank for the initial deposit of the amount due.</p>
    @for($x = 0; $x < count($details); $x++)
    <p>{{$details[$x]['bank_name']}}: {{$details[$x]['account_num']}}</p>
    @endfor
    <p>* Initial deposit must be 50% of {{$details[0]['total_price']}} </p>
    <p>* Have the copy of the receipt and send it to this email.  </p>
    <p>Please let us know if you have any questions through our contact page. </p>
<p> NOTE: PLEASE PAY THE DOWNPAYMENT IN FIXED AMOUNT AS WE DON'T ACCEPT MULTIPLE PAYMENTS. <p>
    <p>Thank you!</p>
</body>
</html>