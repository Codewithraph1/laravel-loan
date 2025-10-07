<!DOCTYPE html>
<html>
<head>
    <title>Login Notification</title>
</head>
<body>
    <h2>Login Notification</h2>
    
    <p>Dear {{ $name }},</p>
    
    <p>Your account was accessed recently:</p>
    
    <ul>
        <li><strong>Login Time:</strong> {{ $login_time }}</li>
        <li><strong>IP Address:</strong> {{ $ip_address }}</li>
    </ul>
    
    <p>If this was you, you can ignore this email. If you don't recognize this activity, please contact support immediately.</p>
    
    <p>Best regards,<br>Security Team</p>
</body>
</html>