<?php
include "cnns.php";
echo "<pre>"; print_r($_SESSION); echo "</pre>";

$gcollege = $_REQUEST['college'];
$gstage =  $_REQUEST['stage'];
echo "$gcollege, $gstage <br>";
$sql = "UPDATE mcq_users SET college='$gcollege', stage='$gstage' WHERE email='$_SESSION[email]'";
// echo $sql;
if(mysqli_query($conn, $sql)){
    echo "<h3>data stored in a database successfully.</h3> <META HTTP-EQUIV='Refresh' Content='0; URL=index.php'>";
    $_SESSION['college'] = $gcollege;
    $_SESSION['stage'] = $gstage;


} else{
echo "ERROR: Hush! Sorry $sql. "
    . mysqli_error($conn);
}
        ?>