<?php
include "cnns.php";


    // $servername='localhost';
    // $username='root';
    // $password='';
    // $dbname = "mcq";
    // $conn=mysqli_connect($servername,$username,$password,"$dbname");
    //   if(!$conn){
    //       die('Could not Connect MySql Server:' .mysql_error());
    //     }


$collegeId = isset($_POST['collegeId']) ? $_POST['collegeId'] : 0;
$stageId = isset($_POST['stageId']) ? $_POST['stageId'] : 0;
$blockId = isset($_POST['blockId']) ? $_POST['blockId'] : 0;
$subjectId = isset($_POST['subjectId']) ? $_POST['subjectId'] : 0;
$command = isset($_POST['get']) ? $_POST['get'] : "";

switch ($command) {
    case "college":
        $statement = "SELECT id,college_name FROM colleges";
        $dt = mysqli_query($conn, $statement);
        while ($result = mysqli_fetch_array($dt)) {
            echo $result1 = "<option value=" . $result['id'] . ">" . $result['college_name'] . "</option>";
        }
        break;

    case "stage":
        $result1 = "<option>Select stage</option>";
        $statement = "SELECT id,stage FROM stagespercollege WHERE college_id=" . $collegeId;
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['id'] . ">" . $result['stage'] . "</option>";
        }
        echo $result1;
        break;

    case "block":
        $result1 = "<option>Select block</option>";
        $statement = "SELECT id, `block` FROM blockperstage WHERE stage_id=" . $stageId;
        $dt = mysqli_query($conn, $statement);

        while ($result = mysqli_fetch_array($dt)) {
            $result1 .= "<option value=" . $result['id'] . ">" . $result['block'] . "</option>";
        }
        echo $result1;
        break;

        case "subject":
            $result1 = "<option>Select subject</option>";
            $statement = "SELECT id, `subject_name` FROM subjectsperblock WHERE block_id=" . $blockId;
            $dt = mysqli_query($conn, $statement);
    
            while ($result = mysqli_fetch_array($dt)) {
                $result1 .= "<option value=" . $result['id'] . ">" . $result['subject_name'] . "</option>";
            }
            echo $result1;
            break;

            case "lecname":
                $result1 = "<option>Select lecture name</option>";
                $statement = "SELECT id, `lecture_name` FROM lecnamepersubject WHERE subject_id=" . $subjectId;
                $dt = mysqli_query($conn, $statement);
        
                while ($result = mysqli_fetch_array($dt)) {
                    $result1 .= "<option value=" . $result['id'] . ">" . $result['lecture_name'] . "</option>";
                }
                echo $result1;
                break;
}

exit();
?>