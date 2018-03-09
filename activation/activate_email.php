<?php

require "../connect.php";

$message = '';

if(isset($_GET['activation_code']))
{
	$code = $_GET['activation_code'];
	$query = "
		SELECT * FROM user_register 
		WHERE activation_code = '$code'
	";
	$result = mysqli_query($conn, $query);

	if (mysqli_num_rows($result) > 0) {
		$message = "verified";

		$user = mysqli_fetch_assoc($result);
		if($code==$user['activation_code']) {
			if($user['email_status'] == 'not verified') {
				$update_query = "
				UPDATE user_register 
				SET email_status = 'verified' 
				WHERE id = '".$user['id']."'
				";
				$result = mysqli_query($conn, $update_query);
				$message = '<label class="text-success">Your Email Address Successfully Verified <br />You can login here - <a href="../index.php">Login</a></label>';
			} else {
				$message = '<label class="text-info">Your Email Address Already Verified!</label>';
			}
		} else
			{
				$message = '<label class="text-danger">Invalid Link</label>';
			}

	}

	 else {
		$message = "Error";
	}
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PHP Register Login Script with Email Verification</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<div class="container">
			<h1 align="center">Email Verification</h1>
		
			<h3><?php echo $message; ?></h3>
			
		</div>
	
	</body>
	
</html>