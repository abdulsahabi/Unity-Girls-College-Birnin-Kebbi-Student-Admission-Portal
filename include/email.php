<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verification Code</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background: #F9F2FC;
      color: #6A696B;
    }
    
    .template {
      max-width: 320px;
      margin: 50px auto;
      padding: 30px 10px;
      background: #FFFFFF;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .head-title {
      font-size: 20px;
      color: #9010BF;
      font-weight: bold;
      text-align: center;
    }
    
    .firstname {
      font-size: 15px;
      margin: 25px 0;
    }
    
    .message {
      font-size: 14px;
      margin-bottom: 20px;
    }
    
    .code {
      max-width: 270px;
      padding: 11px;
      font-size: 20px;
      border: 1px solid #9010BF;
      margin: 20px auto;
      text-align: center;
      background: #9010BF;
      border-radius: 6px;
      color: #FFFFFF;
    }
    
    .footer {
      max-width: 250px;
      padding: 15px 12px;
      font-size: 10px;
      margin: 20px auto;
      text-align: center;
      background: #FEFEFE;
      color: #000000;
    }
    
    .attention {
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="template">
    <div class="head-title">UNITY COLLEGE</div>
    <div class="firstname">Hi <?php echo $username; ?>,</div>
    <div class="message">
      Welcome to <span class="college">Government Girls Unity College!</span> We're excited to have you on board. To complete your account setup, please enter the verification code below:
    </div>
    <div class="code"><?php echo $verifyCode; ?></div>
    <div class="message">
      This code will expire in <span class="attention">10 minutes.</span> If you have any issues, feel free to contact us at tcstudio6542@gmail.com.
    </div>
    <div class="message">
      Remember, if you didn't attempt to create an account, please disregard this email.
    </div>
    <div class="message">Best regards,</div>
    <div class="message">The Unity College Team</div>
    <div class="footer">&copy; 2024 CutiePie</div>
  </div>
</body>
</html>
