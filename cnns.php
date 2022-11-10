<?php

ob_start();
if (!isset($_SESSION)) {
  session_start();
}	
$conn = mysqli_connect("localhost", "root", "", "mcq");
     
	 // Check connection
	 if($conn === false){
		 die("ERROR: Could not connect. "
			 . mysqli_connect_error());
	 }  
	 ?>