<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Activate Your Account</title>
</head>
<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 8px; border: 1px solid #ddd;">
        
        <!-- Nexsuz Logo -->
        <div style="margin-bottom: 20px;">
            <img src=".../nexsuzlogo.png" alt="Nexsuz Logo" style="max-width: 150px; height: auto;">
        </div>
        
        
        <!-- Greeting -->
        <h4 style="font-size: 24px; color: #333; margin-bottom: 20px;">
            Hi {{ $data['fname'] }},
        </h4>
        
        <!-- Introduction Message -->
        <p style="font-size: 16px; color: #333; line-height: 1.6; margin-bottom: 20px;">
            Thank you for registering with Nexsuz. To activate your account, simply click the button below:
        </p>
        
        <!-- Activation Button -->
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="https://www.nexsuz.com/signInUI/{{$data['email']}}" 
               style="background-color: #28a745; color: white; padding: 12px 24px; text-decoration: none; font-size: 16px; border-radius: 5px; font-weight: bold; display: inline-block;">
               Activate My Account
            </a>
        </div>

        <!-- Support Message -->
        <p style="font-size: 16px; color: #333; margin-bottom: 20px;">
            If you have any questions or need assistance, feel free to visit our support page at 
            <a href="https://support.nexsuz.com" style="color: #007bff; text-decoration: none;">support.nexsuz.com</a>. We’re here to help!
        </p>

    </div>
</body>
</html>