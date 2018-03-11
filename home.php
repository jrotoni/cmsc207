<?php
session_start();

require "connect.php";
$message = '';

if (isset($_SESSION['login_user'])) {
$email = $_SESSION['email_id'];	

$sql = "SELECT *
        FROM user_register
        WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$url = "\"activation/recovery_email.php?user=". $user['username'] . "&recovery_code=". $user['token']."\"";
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
	</head>
	<body>
		
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
			    <h3 class="panel-title">Hello, <?php echo ucfirst($_SESSION['login_user'])?></h3>
			  </div>
			  <div class="panel-body">
				<fieldset>
					<div class="form-group">
					  	<p>First Name: <?php echo $user['first_name']?></p>
					  	<p>Last Name: <?php echo $user['last_name']?></p>
					  	<p>Status: <?php echo $user['active']?></p>
					  	<p>Role: <?php echo $user['roles']?></p>
				  </div>
			  </fieldset>	
			  </div>
					<div class="panel-heading">
						<p class="panel-title">Change password?<a href=<?php echo $url ?>> Click here</a></p>
						<p class="panel-title"><a href="logout.php">Log out</a></p>
					</div>
			</div>
			</div>
		</div>
		</div>
		
	</body>
	
</html>

<?php } else {
	header('location: index.php');
}?>