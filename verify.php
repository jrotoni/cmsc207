<!DOCTYPE html>
<html>
	<head>
		<title>Your Email is not yet verified!</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<div class="container">
			<h1 align="center">Your Email is not yet verified!</h1>
			<form role="form" method="post" action="send_email.php">
			<div class="form-group">
				<input class="form-control" type="email" name="resendLink" placeholder="Input your email here to resend the link!" required />
				<button type="submit" class="btn btn-lg btn-success btn-block">Submit</button>
	        </div>
			</form>
		</div>
	
	</body>
	
</html>