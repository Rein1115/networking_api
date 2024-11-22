<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset Request</title>
    <!-- Add Bootstrap CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h4>Hi {{ $data['fname'] }},</h4>
        <p>To activate your Nexsuz account, simply click the button below:</p>
        <!-- Activate Account Button -->
        <a href="https://www.nexsuz.com/signInUI/{{$data['email']}}" class="btn btn-success btn-lg">Activate Your Account</a>
        <br><br>
        <p>If you have any questions or need assistance, feel free to visit our support page at <a href="https://support.nexsuz.com">support.nexsuz.com</a>. We’re here to help!</p>
    </div>
    <!-- Optional Bootstrap JS and Popper.js (for full functionality if needed) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
