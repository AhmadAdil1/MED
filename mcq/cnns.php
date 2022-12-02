<?php

ob_start();
if (!isset($_SESSION)) {
  session_start();
}	
$conn = mysqli_connect("localhost", "root", "", "mcq");
// $conn = mysqli_connect("sql615.your-server.de", "ahmadadil", "Ahmad2000$$", "mcq_system");
     
	 // Check connection
	 if($conn === false){
		 die("ERROR: Could not connect. "
			 . mysqli_connect_error());
	 } 
	 
	 ?>