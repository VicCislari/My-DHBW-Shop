<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>User Registration with Email Verification in PHP</title>
<!-- CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
<div class="card">
<div class="card-header text-center">
User Registration with Email Verification in PHP
</div>
<div class="card-body">
<form action="store-registration-send-email.php" method="post">
<div class="form-group">
<label for="exampleInputEmail1">Name</label>
<input type="text" name="name" class="form-control" id="name" required="">
</div>                                
<div class="form-group">
<label for="exampleInputEmail1">Email address</label>
<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" required="">
<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>
<div class="form-group">
<label for="exampleInputEmail1">Password</label>
<input type="password" name="password" class="form-control" id="password" required="">
</div>                   
<div class="form-group">
<label for="exampleInputEmail1">Confirm Password</label>
<input type="password" name="cpassword" class="form-control" id="cpassword" required="">
</div>   
<input type="submit" name="password-reset-token" class="btn btn-primary">
</form>
</div>
</div>
</div>
</body>
</html>

<?php
if(isset($_POST['password-reset-token']) && $_POST['email'])
{
include "db.php";
$result = mysqli_query($conn,"SELECT * FROM users WHERE email='" . $_POST['email'] . "'");
$row= mysqli_num_rows($result);
if($row < 1)
{
$token = md5($_POST['email']).rand(10,9999);
mysqli_query($conn, "INSERT INTO users(name, email, email_verification_link ,password) VALUES('" . $_POST['name'] . "', '" . $_POST['email'] . "', '" . $token . "', '" . md5($_POST['password']) . "')");
$link = "<a href='localhost/email-verification/verify-email.php?key=".$_POST['email']."&token=".$token."'>Click and Verify Email</a>";
require_once('phpmail/PHPMailerAutoload.php');
$mail = new PHPMailer();
$mail->CharSet =  "utf-8";
$mail->IsSMTP();
// enable SMTP authentication
$mail->SMTPAuth = true;                  
// GMAIL username
$mail->Username = "your_email_id@gmail.com";
// GMAIL password
$mail->Password = "your_gmail_password";
$mail->SMTPSecure = "ssl";  
// sets GMAIL as the SMTP server
$mail->Host = "smtp.gmail.com";
// set the SMTP port for the GMAIL server
$mail->Port = "465";
$mail->From='your_gmail_id@gmail.com';
$mail->FromName='your_name';
$mail->AddAddress('reciever_email_id', 'reciever_name');
$mail->Subject  =  'Reset Password';
$mail->IsHTML(true);
$mail->Body    = 'Click On This Link to Verify Email '.$link.'';
if($mail->Send())
{
echo "Check Your Email box and Click on the email verification link.";
}
else
{
echo "Mail Error - >".$mail->ErrorInfo;
}
}
else
{
echo "You have already registered with us. Check Your email box and verify email.";
}
}
?>