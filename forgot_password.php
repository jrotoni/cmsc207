<?php
$message = "";

	if(!empty($_POST["forgot-password"])){
	require "connect.php";
	
	$email = $_POST["user-email"];

	$sql = "SELECT *
	        FROM user_register
	        WHERE email = '$email'";

	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
		$user = mysqli_fetch_assoc($result);
		extract($user);

	if($email_status != "verified") {
			$message = "Email not verified";
			header("Location: ../verify.php");
		}

	if(!class_exists('PHPMailer')) {
	    require('phpmailer/class.phpmailer.php');
		require('phpmailer/class.smtp.php');
	}

	require_once("mail_configuration.php");

	/*Setup PHPMailer*/
	$mail = new PHPMailer();

	/*Love letter ganern*/
	$emailBody = "<div>" . $first_name . ",<br><br><p>Click this link to recover your account<br><a href='" . PROJECT_HOME . "activation/recovery_email.php?user=".$username."&activation_code=" . $token . "'>" . PROJECT_HOME . "activation/recovery_email.php?user=".$username."&activation_code=" . $token . "</a><br><br></p>Regards,<br> Team C.</div>";

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
	$mail->Subject = "Password Recovery Email";		
	$mail->MsgHTML($emailBody);
	$mail->IsHTML(true);

	/*Conditional statement kung success ang pag-email*/
	if(!$mail->Send()) {
		$message = 'Problem in Sending Email. Please do the transaction later.';
	} else {
		$message = 'Please check your email for password recovery.';
	}

	/*Sarado natin ang database*/
	mysqli_close($conn);
	
	} else {
		$message = 'Thre is no such email in our database! Please <a href="register.php">register here</a>';
	}

	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<style>
			 html, body, .container-table {
			    height: 100%;
			}
			.container-table {
			    display: table;
			}
			.vertical-center-row {
			    display: table-cell;
			    vertical-align: middle;
			}
		</style>
		<script>
		function validate_forgot() {
			if(document.getElementById("user-email").value == "") {
				alert('Please input valid email address!');
				return false;
			}
			return true;
		}
		</script>
	</head>
	<body>
		<?php if(!empty($success_message)) { ?>
		<div class="success_message"><?php echo $success_message; ?></div>
		<?php } ?>

		<div class="container container-table">
			<div class="row vertical-center-row">
			    <div class="col-md-4 col-md-offset-4">
			    	<div id="validation-message">
			    		<?php
			    			echo '<p>'.$message.'</p>';
			    		 ?>
			    	</div>
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Forgot Password?</h3>
			  </div>
			  <div class="panel-body">
			<form name="frmForgot" id="frmForgot" method="POST" onSubmit="return validate_forgot();">
				<fieldset>
					<div class="form-group">
					  	<p>Please input your email address</p>
					  	<div><input type="email" name="user-email" id="user-email" class="form-control"></div>
					  </div>
					  <input type="submit"  name="forgot-password" id="forgot-password" class="btn btn-lg btn-success btn-block" value="Submit">
					<div class="panel-heading">
						<p>Remembered your password? <a href="index.php">Sign In</a></p>
					</div>
			  </fieldset>
			</form>	
			  </div>
			</div>
			</div>
		</div>
		</div>
		
	</body>
	
</html>