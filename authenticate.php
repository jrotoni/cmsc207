<?php

session_start();

require 'connect.php';  // Create a database connection

$email = $_POST['txtUsername'];
$password = md5($_POST['txtPassword']);

$sql = "SELECT *
        FROM user_register
        WHERE email = '$email'";

$result = mysqli_query($conn, $sql);
$message = '';

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    if ($email == $user['email'] && $password == $user['password'] && $user['login_counter']<3) {
        if($user['active'] != 'active') {
            header('location: index.php?msg=Your account has been blocked by the admin. Please contact the administrator.');
        } else if($user['email_status']=='not verified'){
            header('location: verify.php');
        } else {
            $sql = "UPDATE user_register SET login_counter = 0 WHERE username = '$email'";
            mysqli_query($conn, $sql);
			if($user['roles'] == 'user'){
				$_SESSION['login_user'] = $user['first_name'];
				$_SESSION['email_id'] = $user['username'];
            	header('location: home.php'); 
			} else if($user['roles'] == 'admin'){
				$_SESSION['login_user'] = $user['id'];
				header('location: admin/pages/index.php');
			}
        }

    } else {
        $counter = $user['login_counter'] + 1;
        if($counter>=3){
            $newPassword = rand(1000,9999);
            $password = md5($newPassword);
            $sql = "UPDATE user_register SET password = '$password' WHERE username = '$email'";
            mysqli_query($conn, $sql);
            
            if(!class_exists('PHPMailer')) {
                require('phpmailer/class.phpmailer.php');
                require('phpmailer/class.smtp.php');
            }

            require_once("mail_configuration.php");

            $mail = new PHPMailer();

            $emailBody = "<div>Dear " . $user['first_name'] . ",<br><p>Here is your temporary password to unlock your account: ". $newPassword .". Kindly change your password once you have successfully logged-in.<br><br></p>Regards,<br> Team C of CMSC 207</div>";

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
            $mail->Subject = "Acount Recovery";        
            $mail->MsgHTML($emailBody);
            $mail->IsHTML(true);

            if(!$mail->Send()) {
                $message = 'Problem in sending to unlock your account';
            } else {
                $message = 'Your account has been blocked! See your email to unlock it.';
            }

            header('location: index.php?msg='.$message);   
        } else {
        $sql = "UPDATE user_register SET login_counter = '$counter' WHERE username = '$email'";
        mysqli_query($conn, $sql);
        header('location: index.php?msg=Wrong password! You only have '.(3-$counter).' attempt(s).'); 
        }
        
    }

} else {
    header('location: register.php?msg="Email not found! Please register."');
}

mysqli_close($conn);
