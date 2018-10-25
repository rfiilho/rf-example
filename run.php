<?php
    header("Content-type: text/html; charset=utf-8");
	
	include("connect.php");
	
	$nome = $_POST["nome"];
	$sobrenome = $_POST["sobrenome"];
	$cpf = $_POST["cpf"];
	
	$query = mysqli_query($link, "INSERT INTO `people` VALUES(NULL, '".$nome."', '".$sobrenome."', '".$cpf."')");
	if($query == true){
		//printf ("New Record has id %d.\n", mysqli_insert_id($link));
		echo json_encode("inserido");
	}
	
	mysqli_close($link);
    
?>