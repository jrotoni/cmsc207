<?php

if (isset($_GET['msg'])) {
	$msg = $_GET['msg'];
	//echo $msg;
	//exit;
} else {
	$msg = '';
	//echo $msg;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="cmsc-207 Project">

    <title>CMSC - 207</title>

    <!-- Bootstrap Core CSS -->
    <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    
    <div class="container container-table">
	<div class="row vertical-center-row">
            <div class="col-md-4 col-md-offset-4">
              <p align="center"><?php echo $msg; ?></p>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register New Admin Account</h3>
                    </div>
                <div class="panel-body">
        <form action="registration.php" method="post" enctype="multipart/form-data" name="frmSaveStudent" id="frmSaveStudent">
          <div class="form-group">
                <label for="exampleInputName">First Name</label>
                <input class="form-control" id="txtFN" name="txtFN" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
          </div>
		  <div class="form-group">
                <label for="exampleInputName">Last Name</label>
                <input class="form-control" id="txtLN" name="txtLN" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
          </div>
		  
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
			<input class="form-control" id="txtEmail" name="txtEmail" type="email" aria-describedby="emailHelp" placeholder="Enter email" required>
          </div>
          <div class="form-group">

                <label for="exampleInputPassword1">Password</label>
                <input class="form-control" id="password" name="password"  type="password" placeholder="Password" required>

			</div>
          <div class="form-group">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input class="form-control" id="confirm_password" name="confirm_password" type="password" placeholder="Confirm password" required>

          </div>
		  <button type="submit" class="btn btn-lg btn-success btn-block" onClick="validatePassword();">Register New Admin</button>
        </form>
        <div class="panel-heading">
              <p>Forgot your password? <a href="forgot_password.php">Click here</a></p>
              <p>Existing user? <a href="register.php">Login here</a></p>
            </div>
      </div>
    </div>
  </div>
</div>
</div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
 <script>

function validatePassword(){
var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");

  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

// password.onchange = validatePassword;
// confirm_password.onkeyup = validatePassword;
</script>