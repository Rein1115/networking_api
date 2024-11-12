<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Hello {{ $data['fullname'] }},
    Click the link below to reset your password. This link will expire in {{ $data['expiration'] }} minutes.
    <a href="www.nexsuz.com/reset-password/{{$data['token']}}" >Reset Password</a>
    Thanks,
</body>
</html>