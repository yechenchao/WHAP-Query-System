<?php
/* This page is part 1 of 2 in search by category function */
	//Datebase configuration
	$con=mysqli_connect('localhost',"root","root","whap");
	//Get selected category value from POST
	if($_POST['category'])
	{
		//Fetch variable list using selected category from database
		$category=$_POST['category'];
		$sql=mysqli_query($con,"select * from questionCode_description where category ='$category'");
		while($row=mysqli_fetch_array($sql))
		{
			$questionCode = $row['questionCode'];
			$questionDescription = $row['description'];
			//Echo option list of variables
			echo '<option value="' . $questionCode . '">' . $questionCode . ' - ' . $questionDescription . '</option>';
		}
	}

?>