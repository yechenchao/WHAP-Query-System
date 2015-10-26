<!--This page creates textboxes for variable list-->
<div class="item">
	<div class="col-md-4 col">
		<div class="input-group">
			<span class="input-group-addon">
				<input type="checkbox" name="item_index[]" />
			</span>
			<?php 
			//Query description data
			$con=mysqli_connect('localhost',"root","root","whap");
			$results = mysqli_query($con,"select description from questionCode_description where questionCode = '" . $_GET['questionCode'] . "'");
			$result = mysqli_fetch_array($results);
			//Fill description and variable code in
			echo "<input type='text' class='form-control' name='item_name[]' value ='" . htmlspecialchars($_GET['questionCode']). "'/>"
			?>
		</div>
	</div>
</div>