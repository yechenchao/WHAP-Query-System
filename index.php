<?php
/* This is the main page of WHAP web system, which contains all main functions */

// Check login session, if failed, redirect to login page
session_start();
if($_SESSION['logged_in']==false){
header("location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>WHAP Query System</title>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="bootstrap-3.3.5/css/bootstrap.min.css">
    <link href="bootstrap-3.3.5/css/bootstrap-theme.min.css" rel="stylesheet">
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.js"></script>
	<script type="text/javascript" src="bootstrap-3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>
	<script type="text/javascript" src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	<script type="text/javascript">


		//Tabs function from jquery UI
		$(function() {
		    $( "#tabs" ).tabs();
		});

		//Resizable function from jquery UI
		$(function() {
			$( "#resizable" ).resizable();
		});

		//Adding textbox
		function addMore(str) {
			$("<div>").load("input.php?questionCode="+ str, function() {
				//Append textbox
				$("#varialbeBox").append($(this).html());
			});	
		}

		//Deleting textbox
		function deleteRow() {
			$('div.item').each(function(index, item){
				jQuery(':checkbox', this).each(function () {
					//Delete checked textboxes
		            if ($(this).is(':checked')) {
						$(item).remove();
		            }
		        });
			});
		}

		//Clear textbox
		function clearRow() {
			$('div.item').each(function(index, item){
				//Delete all textboxes
				jQuery(':checkbox', this).each(function () {
					$(item).remove();
		        });
			});
		}

		//Save cookie
		function setCookie(){
			//Save variable search box as cookies
			var variableBox = $("#varialbeBox").html();
			$.cookie("variableBox", variableBox, { 
				expires : 3,
				path: '/' 
			});

		};

		// autocomplete : this function will be executed every time we change the text
		function autocomplet() {
			var keyword = $('#variable_code').val();
			if (keyword != ''){
				$.ajax({
					url: 'autocomplete.php',
					type: 'POST',
					data: {keyword:keyword},
					success:function(data){
						$('#question_list').show();
						$('#question_list').html(data);
					}
				});
			} else {
				$('#question_list').hide();
			}
		}

		// set_item : this function will be executed when we select an item
		function set_item(item) {
			// change input value
			$('#variable_code').val('');
			// hide proposition list
			$('#question_list').hide();
		}

		//Load js functions when the page finishes download
		$(document).ready(function()
		{
			//Load saved textboxes in cookies
			var variableBox = $.cookie("variableBox");
			$("#varialbeBox").html(variableBox);

			//When the category is clicked
			$("#cat-select1").change(function()
			{
				//Assign selected value to variable
				var category=$(this).val();
				var dataString = 'category='+ category;

				//post selected category to varRetrieve.php
				$.ajax({
					type: "POST",
					url: "varRetrieve.php",
					data: dataString,
					cache: false,
					//If success, update select list varSelect
					success: function(html)
						{
							$("#cat-select2").html(html);
						} 
				});
			});

			//When the variable list is clicked
			$("#cat-select2").change(function()
			{
				//Assign selected value to variable
				var varSelect=$(this).val();
				var dataString = 'variable='+ varSelect;

				//post selected category to varAdd.php
				$.ajax
				({
					type: "POST",
					url: "varAdd.php",
					data: dataString,
					cache: false,
					//If success, update div result
					success: function(html)
						{
							$(".result").html(html);
						} 
				});
			});
		});
	</script>
</head>

<body>
	<!-- Upper container -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-cpntrols="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href='#'>WHAP Query System</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<!-- Logout button -->
				<div class="navbar-form navbar-right">
					<div class="form-group">
						<form action="logout.php">
							<button class="btn btn-primary">Sign Out</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<div class="jumbotron">
		<div id="tab-container" class="container">
		  <!-- Nav tabs -->
		  <ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#english" aria-controls="english" role="tab" data-toggle="tab">Search by description</a></li>
		    <li role="presentation"><a href="#category" aria-controls="profile" role="tab" data-toggle="tab">Select by category</a></li>
		  </ul>
		  <!-- Tab panes -->
		  <div class="tab-content">
		    <div role="tabpanel" class="tab-pane active" id="english">
			    <div class="input_container">
			    	<div class="input-group input-group-lg">
			    		<span class="input-group-addon"></span> 
				        <input type="text" class="form-control" placeholder="Enter your question" id="variable_code" onkeyup="autocomplet()">
				        <ul class="list-group" id="question_list"></ul>
			        </div>
			    </div>
		    </div>
		    <div role="tabpanel" class="tab-pane" id="category">
			  	<div class="form-inline" id="selector_container">
			  		<!-- Select list for category list  -->
					<select multiple class="form-control" id="cat-select1" name="category">
					<?php
						$con=mysqli_connect('localhost',"root","root","whap");
						$cateResults = mysqli_query($con,"select category from variableCategory");
						while($row=mysqli_fetch_array($cateResults))
							{
								$category=$row['category'];
								echo '<option value="'.$category.'">'.$category.'</option>';
					 		} 
				 	?>
					</select>
					<!-- Select list for variables  -->
					<select multiple class="form-control" id="cat-select2" name="varSelect">
					</select>
					<!-- Div for displaying button of adding variables -->
					<div name="result" class="result"></div>
				</div>
		    </div>
		  </div>
	  	</div>
	  	<div class="container">
		  	<!-- Form for posting variable list  -->
			<form method="post">
				<div class="container">
					<div class="row col">
						<!--  Function buttons -->
						<input class="btn btn-default" type="button" name="add_item" value="Add a Blank Search Box" onClick="addMore('');"/>
						<input class="btn btn-default" type="button" name="del_item" value="Delete Search Box" onClick="deleteRow();"/>
						<input class="btn btn-default" type="button" name="clear_item" value="Clear Search Box" onClick="clearRow();"/>
					</div>
					<div class="row col">
						<input class="btn btn-primary" type="submit" name="time_series" onclick="setCookie()" value="Time Series Query"/>
						<input class="btn btn-primary" type="submit" name="patient_trajectory" onclick="setCookie()" value="Patient Trajectory Query"/>
						<?php
						//Set current timezone
						date_default_timezone_set("Australia/Melbourne");

						//Save cureent timestamp to name files(e.g. csv, tsv)
						$timestamp = date('d-m-Y_H-i-s');
						$csvName = 'csv/'. $timestamp . '.csv';
						$tsvName = 'tsv/'. $timestamp . '.tsv';

						//Generate button html codes for download csv and histogram with dynamic filenames
						$downloadButton = '<input class="btn btn-primary" type="button" value="Download CSV File" onclick="window.open(' . "'" . $csvName . "'" . ')" /> ';
						$histogram = '<input class="btn btn-primary" type="button" value="View Histogram" onclick="window.open(' . "'histogram.php?tsv=" . $timestamp . "'" . ')" />';

						//Echo buttons
						echo $downloadButton;
						echo $histogram;
						?>
					</div>
					<div class="row" id="SearchBoxSet">
						<div id = "textbox_header" class="item float-clear">
							<span>Variables Search Box: </span>
						</div>
						<!-- Div for appending textboxes  -->
						<div id = "varialbeBox">
						</div>
					</div>
				</div>
			</form>
	  	</div>
	</div>

	<div>
		<div class="container">
			<?php
				//If time series button is clicked	
				if(!empty($_POST["time_series"])) {

					//Database configuration
					$con = mysqli_connect('localhost',"root","root","whap");
					//Count varialbe number
					$itemCount = count($_POST["item_name"]);
					$varCount = 0;
					$queryValue = "";

					//Count varialbes in the list
					for($i=0; $i<$itemCount; $i++) {
						if(!empty($_POST["item_name"][$i])){
							$varCount++;
							if($queryValue!="") {
								$queryValue .= ",";
							}
							//Create variable sentence for counting
							$queryValue .= "'" . $_POST["item_name"][$i] . "'";
						}
					}

					//Generate tsv file for histogram
					$tsv = fopen($tsvName, "w");
					//Write histogram header to tsv file
					fwrite($tsv, "layer	number\n");

					//Count results of each layer and write results to tsv file for histogram
					$countQuery = "SELECT count(*) FROM layerData WHERE questionCode IN (";
					$countLayers = mysqli_query($con,"select layer from layer_year order by id asc");
					while($layer = mysqli_fetch_array($countLayers)){
						$countSql = $countQuery . $queryValue .") AND layer = '" . $layer['layer'] . "'";
						$variableCount = mysqli_query($con,"$countSql");
						$countResult = mysqli_fetch_array($variableCount);
						$count = $countResult[0];
						fwrite($tsv, $layer['layer'] . "	" . $count . "\n");
					}
					fclose($tsvName);

					//If textboxes are not empty
					if($varCount != 0){
						//Create csv file
						$csv = fopen($csvName, "w");
						
						//Start creating result table
						echo '<div class="ResultTable"><table class="table table-hover"><tr><td>Serial</td><td>Layer</td>';

						//Start writing data to csv file
						fwrite($csv, "Serial,Layer");

						//Start generating SQL statement for time series query
						$SQL_Header = "SELECT T1.serial, T1.layer";
						$SQL_Body = "(SELECT serial,layer";
						$SQL_Footer = '';
						
						//Using loop to add each varialbe to SQL statement
						for($i=0; $i<$itemCount; $i++) {

							$variable = $_POST["item_name"][$i];
							$dataTypeSql = "SELECT valueType FROM questionCode_description WHERE questionCode = '" . $variable . "'";
							$dataTypeResult = mysqli_fetch_array(mysqli_query($con,"$dataTypeSql"));

							$SQL_Header .= ", ";
							$SQL_Body .= ", ";
							//When data type is date
							if($dataTypeResult[0] == 1){
								echo "<td>" . $variable . "</td>";
								fwrite($csv, ",".$variable);
								$SQL_Header .= 'T1.' . $variable;
								$SQL_Body .= "GROUP_CONCAT(IF(questionCode='" . $variable . "',DATE_FORMAT(answerDate,'%d-%m-%Y'),NULL)) AS " . $variable;
							}
							//When data type is MCQ
							else if($dataTypeResult[0] == 2){
								//MCQ value would take 2 columns because it has answer code and answer value
								$varCount++;
								echo "<td>" . $variable . "</td>";
								echo "<td>" . $variable . "_Value" . "</td>";
								fwrite($csv, ",".$variable);
								fwrite($csv, ",".$variable."_Value");
								$SQL_Header .= 'T1.' . $variable . ', ';
								$SQL_Header .= $variable . '.value';
								$SQL_Body .= "SUM(IF(questionCode='" . $variable . "',answerNumeric,NULL)) AS " . $variable;
								$SQL_Footer .= 'INNER JOIN questionCode_value ' . $variable . ' ON (T1.' . $variable . '='. $variable . '.valueCode AND ' . $variable . ".questionCode = '" . $variable . "') ";
							
							}
							//When data type is numberic
							else if($dataTypeResult[0] == 3){
								echo "<td>" . $variable . "</td>";
								fwrite($csv, ",".$variable);
								$SQL_Header .= 'T1.' . $variable;
								$SQL_Body .= "SUM(IF(questionCode='" . $variable . "',answerNumeric,NULL)) AS " . $variable;
							}
							//When data type is string
							else{
								echo "<td>" . $variable . "</td>";
								fwrite($csv, ",".$variable);
								$SQL_Header .= 'T1.' . $variable;
								$SQL_Body .= "GROUP_CONCAT(IF(questionCode='" . $variable . "',answerString,NULL)) AS " . $variable;
							}
						}
						//The whole line finishes, add new line to csv
						fwrite($csv, "\n");

						$SQL_Header .= ' FROM';
						$SQL_Body .= ' FROM layerData GROUP BY serial, layer) as T1 ';
						
						//Finalise SQL statement
						$SQL = $SQL_Header . $SQL_Body . $SQL_Footer;

						//Query database
						$queryResult = mysqli_query($con,"$SQL");
						//Echo response from database into table
						while($dataResult = mysqli_fetch_array($queryResult)){
							echo '<tr>';
							for($i=0; $i<$varCount+2; $i++) {
								$column = "<td>".$dataResult[$i]. "</td>";
								fwrite($csv, $dataResult[$i].",");
								echo $column;
							}
							echo '</tr>';
							fwrite($csv, "\n");
						}
						echo "</table></div>";
						fclose($csvName);
						mysql_close($con);
					}
				}
				//When Patient Trajectory button is clicked
				else if(!empty($_POST["patient_trajectory"])) {
					//Database configuration
					$con=mysqli_connect('localhost',"root","root","whap");
					
					//Count variables in the list
					$itemCount = count($_POST["item_name"]);

					//Create variable sentence for counting
					$queryValue = "";
					for($i=0; $i<$itemCount; $i++) {
						if(!empty($_POST["item_name"][$i])) {
							$itemValues++;
							if($queryValue!="") {
								$queryValue .= ",";
							}
							$queryValue .= "'" . $_POST["item_name"][$i] . "'";
						}
					}
					//Create tsv file for histogram
					$tsv = fopen($tsvName, "w");
					fwrite($tsv, "layer	number\n");
					//Count results of each layers and write to tsv file for histogram
					$countQuery = "SELECT count(*) FROM layerData WHERE questionCode IN (";
					$countLayers = mysqli_query($con,"select layer from layer_year order by id asc");
					while($layer = mysqli_fetch_array($countLayers)){
						$countSql = $countQuery . $queryValue . ") AND layer = '" . $layer['layer'] . "'";
						$variableCount = mysqli_query($con,"$countSql");
						$countResult = mysqli_fetch_array($variableCount);
						$count = $countResult[0];
						fwrite($tsv, $layer['layer'] . "	" . $count . "\n");
					}
					fclose($tsvName);

					//If variable list is not empty
					if($itemCount != null){
						$varCount = 0;
						$csv = fopen($csvName, "w");
						echo '<div class="ResultTable"><table class="table table-hover"><tr><td>Serial</td>';
						fwrite($csv, "Serial,");

						//Start creating SQL statement
						$SQL_Header = "SELECT T1.serial";
						$SQL_Body = "(SELECT serial";
						$SQL_Footer = '';

						//Using loop to add each varialbe to SQL statement, echo table header, write header to csv
						for($i=0; $i<$itemCount; $i++) {

							$variable = $_POST["item_name"][$i];

							//Fetch data type of variable
							$dataTypeSql = "SELECT valueType FROM questionCode_description WHERE questionCode = '" . $variable . "'";
							$dataTypeResult = mysqli_fetch_array(mysqli_query($con,"$dataTypeSql"));

							//Fetch all layers
							$layers = mysqli_query($con,"select layer from layer_year order by id asc");
							
							//When data type is date
							if($dataTypeResult[0] =='1'){
								//Display date of birth once only
								if($variable == 'ADMdob'){
									$varCount++;
									echo "<td>" . $variable . "</td>";
									fwrite($csv, $variable . ",");
									$SQL_Header .= ',T1.' . $variable;
									$SQL_Body .= ",MIN(IF(questionCode='" . $variable . "',DATE_FORMAT(answerDate,'%d-%m-%Y'),NULL)) AS " . $variable;
								}
								else{
									while($layer = mysqli_fetch_array($layers)){
										$varCount++;
										echo "<td>" . $layer['layer'] . "_" . $variable . "</td>";
										fwrite($csv, $layer['layer'] . "_" . $variable . ",");
										$SQL_Header .= ',T1.' . $layer['layer'] . '_' . $variable;
										$SQL_Body .= ",GROUP_CONCAT(IF(questionCode='" . $variable . "' AND layer = '" . $layer['layer'] . "',DATE_FORMAT(answerDate,'%d-%m-%Y'),NULL)) AS " . $layer['layer'] . '_' . $variable;
									}
								}
							}
							//when data type is MCQ
							else if($dataTypeResult[0] =='2'){

								while($layer = mysqli_fetch_array($layers)){
									//MCQ value would take 2 columns because it has answer code and answer value
									$varCount = $varCount + 2;
									echo "<td>" . $layer['layer'] . "_" . $variable . "</td>";
									fwrite($csv, $layer['layer'] . "_" . $variable . ",");
									echo "<td>" . $layer['layer'] . "_" . $variable . "_Value</td>";
									fwrite($csv, $layer['layer'] . "_" . $variable . "_Value" . ",");

									$SQL_Header .= ',T1.' . $layer['layer'] . '_' . $variable;
									$SQL_Header .= ',' . $layer['layer'] . '_' . $variable . '.value';
									$SQL_Body .= ",SUM(IF(questionCode='" . $variable . "' AND layer = '" . $layer['layer'] . "',answerNumeric,NULL)) AS " . $layer['layer'] . '_' . $variable;
									$newLayerVar = $layer['layer'] . '_' . $variable;
									$SQL_Footer .= "LEFT OUTER JOIN questionCode_value " . $newLayerVar . " ON (T1." . $newLayerVar . "=" . $newLayerVar . ".valueCode AND " . $newLayerVar . ".questionCode = '" . $variable . "') ";
								
								}
							}
							//when data type is numeric
							else if($dataTypeResult[0] =='3'){
								while($layer = mysqli_fetch_array($layers)){
									$varCount++;
									echo "<td>" . $layer['layer'] . "_" . $variable . "</td>";
									fwrite($csv,$layer['layer'] . "_" . $variable . ',');
									$SQL_Header .= ',T1.' . $layer['layer'] . '_' . $variable;
									$SQL_Body .= ",SUM(IF(questionCode='" . $variable . "' AND layer = '" . $layer['layer'] . "',answerNumeric,NULL)) AS " . $layer['layer'] . '_' . $variable;
								}
							}
							//when data type is string
							else{
								while($layer = mysqli_fetch_array($layers)){
									$varCount++;
									echo "<td>" . $layer['layer'] . "_" . $variable . "</td>";
									fwrite($csv,$layer['layer'] . "_" . $variable . ',');
									$SQL_Header .= ',T1.' . $layer['layer'] . '_' . $variable;
									$SQL_Body .= ",GROUP_CONCAT(IF(questionCode='" . $variable . "' AND layer = '" . $layer['layer'] . "',answerString,NULL)) AS " . $layer['layer'] . '_' . $variable;
								}
							}
						}
						echo "</tr>";
						fwrite($csv,"\n");

						$SQL_Header .= ' FROM';
						$SQL_Body .= ' FROM layerData GROUP BY serial) as T1 ';
						
						//Finalise SQL statement
						$SQL = $SQL_Header . $SQL_Body . $SQL_Footer;
						$queryResult = mysqli_query($con,"$SQL");

						//Create table with database response and write data to csv
						while ($dataResult = mysqli_fetch_array($queryResult)) {
							echo '<tr>';
							for($i=0; $i<$varCount+1; $i++) {
								$column = "<td>".$dataResult[$i]. "</td>";
								echo $column;
								fwrite($csv, $dataResult[$i].",");
							}
							echo '</tr>';
							fwrite($csv, "\n");
						}
						echo "</table></div>";
						fclose($csvName);
						mysql_close($con);
					}
				}
			?>
		</div>
	</div>

	<div class="container">
		<hr>
		<footer>
			Created by Peter Yeah under <a href="#" target="_blank">The MIT License</a>
		</footer>
	</div>
</body>
</html>