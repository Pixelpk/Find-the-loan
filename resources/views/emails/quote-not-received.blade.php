<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>No quote received</title>
</head>
<body>
    <b>Hi {{ $user['first_name']." ".$user['last_name']}}</b>, 
    <p>It's been 3 days you applied for loan..But No one quoted due to credit score/litigation on Enquiry_ID: {{$apply_loan->enquiry_id ?? ""}}</p>
    Thanks
</body>
</html>