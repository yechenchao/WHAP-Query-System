<!--This page creates textboxes for variable list-->
<DIV class="item float-clear" style="clear:both;">
<DIV class="float-left"><input type="checkbox" name="item_index[]" /></DIV>
<?php 
//Query description data
$con=mysqli_connect('localhost',"root","root","whap");
$results = mysqli_query($con,"select description from questionCode_description where questionCode = '" . $_GET['questionCode'] . "'");
$result = mysqli_fetch_array($results);
//Fill description and variable code in
echo "<DIV class='float-left'><input type='text' name='item_name[]'  value ='" . htmlspecialchars($_GET['questionCode']). "'/>" . $result[0] ."</DIV>" 
?>
</DIV>

