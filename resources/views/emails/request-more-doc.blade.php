<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>More document request</title>
</head>
<body>
    <b>Hi {{ $user['first_name']." ".$user['last_name']}}</b>, 
    <p>You got a request for More Documents from FinancePartner({{$finance_partner->name}}) on Enquiry_ID: {{$apply_loan->enquiry_id ?? ""}}</p>
    <p>Please check details on your dashboard.</p>
    Thanks
</body>
</html>