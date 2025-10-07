<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
</head>
<body>
    <h2>Welcome to Our Platform!</h2>
    
    <p>Dear {{ $name }},</p>
    
    <p>Your registration was successful! Here are your account details:</p>
    
    <ul>
        <li><strong>Name:</strong> {{ $name }}</li>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Account Number:</strong> {{ $account_number }}</li>
    </ul>
    
    <p>You can now login to your account and start using our services.</p>
    
    <p>Thank you for joining us!</p>
    
    <p>Best regards,<br>Support Team</p>
</body>
</html>