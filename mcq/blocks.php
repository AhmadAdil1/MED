<?php
include "cnns.php";

$statement = "SELECT id,`block` FROM blockperstage";
        $dt = mysqli_query($conn, $statement);
        $results2 = [];
        while ($result = mysqli_fetch_array($dt)) {
            $results2[]=$result; 
            // echo $result1 = "<option value=" . $result['id'] . ">" . $result['block'] . "</option>";
            }
        echo json_encode($results2);
        
        ?>