<?php
/* This page is part 2 of 2 in search by category function */

//Retrieve variable from POST
if($_POST['variable'])
{
	//Echo button for adding textboxes with selected variable 
	$code=$_POST['variable'];
	echo '<button type="button" class="btn btn-default" name="add_item" onClick="addMore(' . "'" . $code . "'" . ');" >Add to Search Box</button>';
}
?>