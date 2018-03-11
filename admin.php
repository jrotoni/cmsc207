<?php
session_start();

if (isset($_SESSION['login_user'])) {
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		<div class="container">
			<h1 align="center">Hello Admin!</h1>
		
			<h3>Welcome <?php echo ucfirst($_SESSION['login_user']); ?></h3>	
		</div>
		
	</body>
	
</html>

<?php } else {
	header('location: index.php');
}?>