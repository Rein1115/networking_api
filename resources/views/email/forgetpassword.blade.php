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
        <p>We’ve received a request to reset the password for your Nexsuz account associated with <strong>{{$data['email']}}</strong>.</p>
        <p>No changes have been made to your account yet.</p>
        
        <p>You can reset your password by clicking the button below:</p>
        <!-- Reset Password Button -->
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="https://www.nexsuz.com/reset-password/{{$data['email']}}/{{$data['token']}}"   style="background-color: #28a745; color: white; padding: 12px 24px; text-decoration: none; font-size: 16px; border-radius: 5px; font-weight: bold; display: inline-block;">Reset Password</a>
        </div>
        <br><br>
        <p style="font-size: 16px; color: #333; margin-bottom: 20px;">
            You can find answers to most questions and get in touch with us at <a href="https://support.nexsuz.com" style="color: #007bff; text-decoration: none;">support.nexsuz.com</a>, we're happy to assist you.
            -The Nexsuz team.
            
        </p>
    </div>

    <!-- Optional Bootstrap JS and Popper.js (for full functionality if needed) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
