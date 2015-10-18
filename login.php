<!-- This page is created for user login-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <title>WHAP Query System</title>

	  	<!-- Bootstrap core CSS -->
	    <link href="bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
	    <!-- Bootstrap theme -->
	    <link href="bootstrap-3.3.5/css/bootstrap-theme.min.css" rel="stylesheet">
	    <link href="css/theme.css" rel="stylesheet">
	</head>
	<body>

		<div class="alert alert-success" role="alert">
			<p>Login username and password are both 'admin'<p>
		</div>
		<div class="container">
			<form class="form-signin" name="form1" method="post" action="login_authentication.php">
			<h2 class="form-signin-heading">Welcome, please sign in</h2>
				<label for="username" class="sr-only">Username</label>
				<input name="username" type="text" id="username" class="form-control" placeholder="Username" required autofocus>
				<input name="password" type="password" id="password" class="form-control" placeholder="Password" required>
				<button type="submit" class="btn btn-lg btn-block btn-primary">Sign in</button>
			</form>
		</div>

	</body>
</html>
<?php 
	//Pop out alert when username or password is wrong
	if($_GET['info'] == '1'){
		echo "<script type='text/javascript'>alert('Wrong username or password, please try again');</script>";
	}
?>