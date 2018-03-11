<?php
session_start();

require 'connect.php';

$email = $_POST['resendLink'];

$sql = "SELECT *
        FROM user_register
        WHERE email = '$email'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$user = mysqli_fetch_assoc($result);

if(!class_exists('PHPMailer')) {
    require('phpmailer/class.phpmailer.php');
	require('phpmailer/class.smtp.php');
}

require_once("mail_configuration.php");

$mail = new PHPMailer();

$emailBody = "<div>" . $user['first_name'] . ",<br><p>Here is your activation code: ".$user['activation_code']."<br><br></p>Regards,<br> Team C of CMSC 207</div>";

$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port     = PORT;  
$mail->Username = MAIL_USERNAME;
$mail->Password = MAIL_PASSWORD;
$mail->Host     = MAIL_HOST;
$mail->Mailer   = MAILER;

$mail->SetFrom(SERDER_EMAIL, SENDER_NAME);
$mail->AddReplyTo(SERDER_EMAIL, SENDER_NAME);
$mail->ReturnPath=SERDER_EMAIL;	
$mail->AddAddress($email);
$mail->Subject = "Activation Email";		
$mail->MsgHTML($emailBody);
$mail->IsHTML(true);

if(!$mail->Send()) {
	$msg = 'Problem in Sending Activation Email';
} else {
	$msg = 'Please check your email to verify your account.';
}

header("Location: index.php?msg=$msg");
}

mysqli_close($conn);