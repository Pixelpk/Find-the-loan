<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Incomplete Signup reminder</title>
</head>
<body>
    Hi {{ $first_name." ".$last_name}}, 
     
    Kindly complete your registration by verifying the provided link.
    <a href="{{ url('/verify?email=') }}{{ $email }}&id={{$id}}">Verify</a>

</body>
</html>