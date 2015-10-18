<!-- This page is created for user login-->
<html>
	<head>
	  	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	 	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	  	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
	  	<link rel="stylesheet" href="/resources/demos/style.css">

	  	<!-- Bootstrap core CSS -->
	    <link href="bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet">
	    <!-- Bootstrap theme -->
	    <link href="bootstrap-3.3.5/css/bootstrap-theme.min.css" rel="stylesheet">
	    <link href="css/theme.css" rel"stylesheet">


	  <script>
	  $(function() {
	    $( "#dialog" ).dialog({
	    	width:1000
	    });
	    
	  });
	  </script>
	</head>
	<body>
		<table width="350" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
			<tr>
				<form name="form1" method="post" action="login_authentication.php">
					<td>
					<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
						<tr>
							<td colspan="3"><strong>Welcome, please login to WHAP Query System</strong></td>
						</tr>
						<tr>
							<td width="78">Username</td>
							<td width="6">:</td>
							<td width="294"><input name="username" type="text" id="username"></td>
						</tr>
						<tr>
							<td>Password</td>
							<td>:</td>
							<td><input name="password" type="password" id="password"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><input type="submit" name="Submit" class="btn btn-primary" value="Login"></td>
						</tr>
						<td>
					</table>
					</td>
				</form>
			</tr>
		</table>

		<div id="dialog" title="Basic dialog">
  			<p>This website was created for the Women Health Aging Project(WHAP) of the University of Melbourne, Medical Department. It provides a convinient interface for researchers to access and retrieve thousands of research data records.</p>
			<p>You could enter admin/admin to login to this sample site.</p>
		</div>

	</body>
</html>
<?php 
	//Pop out alert when username or password is wrong
	if($_GET['info'] == '1'){
		echo "<script type='text/javascript'>alert('Wrong username or password, please try again');</script>";
	}
?>