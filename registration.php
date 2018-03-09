<?php
/*Dito kinokonek ang database para makapagquery ganern*/
require 'connect.php';

/*Kunin natin ang data from register.php at ilagay sa variables*/
$fname   = $_POST['txtFN'];
$lname   = $_POST['txtLN'];
$email	 = $_POST['txtEmail'];
$uname   = $_POST['txtEmail'];
$pword   = $_POST['password'];

/*Query statement kung may mag-eexist bang email*/
$validation = "SELECT *
        FROM user_register
		WHERE email = '$uname'";

/*Execute natin ang query sa database*/
$email_val = mysqli_query($conn, $validation);

/*Kung successfull ang execution ng query, may nakaregister na ng email*/
if (mysqli_num_rows($email_val) > 0) {
$msg = "The email address has already taken!";

/*Babalik ulit sa register.php na may error message*/
header("Location: register.php?msg=$msg");
} else {
/*Kung wala pang nakaregister, iregister natin sa database*/  

/*Encrypt natin ang password sa md5*/
$pword = md5($pword);
/*Generate tayo ng random code, sana walang collission!*/
$activation_code = md5(rand());
/*Gamitin natin ito for forgot password*/
$token = md5($activation_code);


/*Gawa ulit ng SQL statement*/
$sql   = "INSERT INTO user_register (id, first_name, last_name,
			email, username, password, activation_code, token)
          VALUES (null, '$fname', '$lname', '$email', 
		   '$uname', '$pword', '$activation_code', '$token')";

/*Iexecute ang query sa database*/
$result = mysqli_query($conn, $sql);

/*Sulatan natin yung registered user para iactivate code */

/*Required files para sa PHPMailer*/
if(!class_exists('PHPMailer')) {
    require('phpmailer/class.phpmailer.php');
	require('phpmailer/class.smtp.php');
}

/*Ipasok natin email credentianls ng group*/
require_once("mail_configuration.php");

/*Setup PHPMailer*/
$mail = new PHPMailer();

/*Love letter ganern*/
$emailBody = "<div>" . $fname . ",<br><br><p>Click this link to activate your email<br><a href='" . PROJECT_HOME . "activation/activate_email.php?activation_code=" . $activation_code . "'>" . PROJECT_HOME . "activation/activate_email.php?activation_code=" . $activation_code . "</a><br><br></p>Regards,<br> Team C.</div>";

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

/*Conditional statement kung success ang pag-email*/
if(!$mail->Send()) {
	$msg = 'Problem in Sending Activation Email';
} else {
	$msg = 'Please check your email to verify your account.';
}

/*Sarado natin ang database*/
mysqli_close($conn);

/*Redirect natin ang user sa register.php*/
header("Location: register.php?msg=$msg");
}
