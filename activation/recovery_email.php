<?php

require "../connect.php";

$message = '*';
$message2 = '';
$code = $_GET['recovery_code'];
$usermail = $_GET['user'];

if(empty($_POST["update-password"]) && $message = '*') {
	if(isset($_GET['recovery_code'])) {
		$query = "
			SELECT * FROM user_register 
			WHERE token = '$code'
		";
		$result = mysqli_query($conn, $query);
		if (mysqli_num_rows($result) > 0) {
			$user = mysqli_fetch_assoc($result);
			extract($user);
			if($email_status != "verified") {
				$message = "Email not verified";
				header("Location: ../verify.php");
			} else {
				$message = 'Please update your password for ' . $usermail;
			}

		}
		 else {
		$message = "Invalid email link! Please register here!";
		header("Location: ../register.php?msg=$message");
		}
	}
} else {
	$pass = md5($_POST['confirmPassword']);
	$newToken = md5(rand());

	$sql   = "UPDATE user_register SET password = '$pass', token = '$newToken' WHERE username = '$usermail'";

	/*Iexecute ang query sa database*/
	$result = mysqli_query($conn, $sql);
	$message = "Your password has successfully updated!";
	$message2 = '<a href="../index.php">Login here!</a>';
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Recovery Email</title>		
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
		function password_validation() {
			if(document.getElementById("newPassword").value != document.getElementById("confirmPassword").value) {
				alert('Mismatch password!');
				return false;
			} else {
				return true;
			}
		}
		</script>
	</head>
	<body>
		
			<div class="container container-table">
				<div class="row vertical-center-row">
				    <div class="col-md-4 col-md-offset-4">
				    	<div id="validation-message">
				    		<?php
				    			echo '<p>'.$message.'</p>';
				    			echo '<p>'.$message2.'</p>';
				    		 ?>
				    	</div>
				<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Input your new password</h3>
				  </div>
				  <div class="panel-body">
				<form name="frmForgot" id="frmForgot" method="POST" onSubmit="return password_validation();">
					<fieldset>
						<div class="form-group">
						  	<p>New password</p>
						  	<div><input type="password" name="newPassword" id="newPassword" class="form-control" required></div>
					  	</div>
						<div class="form-group">
						    <p>Confirm password</p>
				    		<div><input type="password" name="confirmPassword" id="confirmPassword" class="form-control" required></div>
						</div>
						  <input type="submit"  name="update-password" id="update-password" class="btn btn-lg btn-success btn-block" value="Submit">
				  </fieldset>
				</form>	
				  </div>
				</div>
				</div>
			</div>
			</div>
	
	</body>
	
</html>