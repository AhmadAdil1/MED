<?php
include "cnns.php";
// echo "<pre>"; print_r($_SESSION); echo "</pre>";

$stage= $_SESSION['stage'];
$college= $_SESSION["college"];
$block = 0;
$sub = 0;
$lecname = 0;  
  

if(isset($_REQUEST['block'])) $block=$_REQUEST['block'];
if(isset($_REQUEST['sub'])) $sub=$_REQUEST['sub'];
if(isset($_REQUEST['lecname'])) $lecname=$_REQUEST['lecname'];
if($block){	
  if($block){ $sql="SELECT * FROM questions WHERE college='$college' AND stage='$stage' AND block='$block'";}
  if($block && $sub){$sql="SELECT * FROM questions WHERE college='$college' AND stage='$stage' AND block='$block' AND subject='$sub'";}
  if($block && $sub && $lecname){ $sql="SELECT * FROM questions WHERE college='$college' AND stage='$stage' AND block='$block' AND subject='$sub' AND lec_name='$lecname'";}
    // echo $sql;
    $result = mysqli_query($conn, $sql);
  }else if(isset($_GET['search'])){
     $filtervalues = $_GET['search'];
     $sql = "SELECT * FROM questions WHERE college='$college'AND stage='$stage' AND CONCAT(question, ans_a, ans_b, ans_c, ans_d, ans_e) LIKE '%$filtervalues%' ";
     $result = mysqli_query($conn, $sql);
    }
    else{
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);}
// echo $sql;






        $results2 = [];
        while ($resultrow = mysqli_fetch_array($result)) {
            $results2[]=$resultrow; 
            // echo $result1 = "<option value=" . $result['id'] . ">" . $result['block'] . "</option>";
            }
        echo json_encode($results2);
        
        ?>