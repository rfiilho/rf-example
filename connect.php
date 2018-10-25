<?php
$link = mysqli_connect("localhost", "root", "PASSWORD", "users");
    
	if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        }
		
	//print_r(mysqli_stat($link));
?>