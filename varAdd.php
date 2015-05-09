<?php
/* This page is part 2 of 2 in search by category function */

//Retrieve variable from POST
if($_POST['variable'])
{
	//Echo button for adding textboxes with selected variable 
	$code=$_POST['variable'];
	echo '<a>You have selected the variable, click Add to Search Box to continue</a><br />';
	echo '<input type="button" name="add_item" value="Add to Search Box" onClick="addMore(' . "'" . $code . "'" . ');" />';
}
?>