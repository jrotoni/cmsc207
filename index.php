<?php
if (isset($_GET['msg'])) {
	$message = $_GET['msg'];

} else {
	$message = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="CMSC217 Project">

    <title>CMSC207 - Team C</title>

   <link href="admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="admin/dist/css/sb-admin-2.css" rel="stylesheet">
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
            <div class="page-header" style="font-family: Cambria; font-style: bold">
                <h1 align="center">CMSC207 | Team C</h1>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div id="validation-message">
                    <?php
                        echo '<p>'.$message.'</p>';
                     ?>
                </div>
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="authenticate.php">
                            <fieldset>
                                <div class="form-group">
									<input class="form-control" type="text" name="txtUsername" placeholder="Email" required />
                                </div>
                                <div class="form-group">
									<input class="form-control" type="password" name="txtPassword" placeholder="Password" required />
                                </div>
                               <div id="testCenter" class="form-group"> 
    							  <button type="submit" class="btn btn-success btn-lg btn-block">Login</button>
                                </div>
                            </fieldset>
							
                        </form>
                    </div>
					<div class="panel-heading">
								<p>Forgot your password? <a href="forgot_password.php">Click here</a></p>
								<p>New user? <a href="register.php">Create new account</a></p>
							</div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="admin/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="admin/dist/js/sb-admin-2.js"></script>

</body>

</html>
