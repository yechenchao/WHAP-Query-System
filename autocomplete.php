<?php
//This page is created for autocomplete function

//Connect to database
function connect() {
    return new PDO('mysql:host=localhost;dbname=whap', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = connect();
$keyword = '%'.$_POST['keyword'].'%';

//Create SQL statement by input keyword
$sql = "SELECT * FROM questionCode_description WHERE description LIKE (:keyword) ORDER BY description ASC LIMIT 0, 10";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();

//retch all results
$list = $query->fetchAll();

//generate option list from reuslt list
foreach ($list as $rs) {
	//put text in bold
	$description = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['description']);
	//echo options
    echo '<li id="question_list_single" onclick= "set_item(\''.$rs['questionCode'].'\');addMore(' . "'" . $rs['questionCode'] . "'" .')" >'. $rs['category'] . " - " . $description . '</li>';
}
?>