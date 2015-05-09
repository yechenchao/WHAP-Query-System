<?php
ob_start();

//Database configuration
$con = mysqli_connect('localhost',"root","root","whap");


//Get username and password from user input 
$username=$_POST['username']; 
$password=$_POST['password']; 

//Query database using username and password
$sql = "SELECT * FROM users WHERE username='$username' and password='$password'";
$result=mysqli_query($con,"$sql");
$result1 = mysqli_fetch_array($result);


// If result matched 
if($result1['identifier'] == '1'){
	echo "login success";
	session_start();
	//Register session
	$_SESSION['logged_in'] = true;
	//Redirect user to index page
	header("location:index.php");

}
//if username and password do not match, echo notification
else {
	header("location:login.php?info=1");
}
ob_end_flush();
?>