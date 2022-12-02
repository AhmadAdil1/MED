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


$blockId = isset($_POST['blockId']) ? $_POST['blockId'] : 0;
$subjectId = isset($_POST['subjectId']) ? $_POST['subjectId'] : 0;
// $blockId = isset($_POST['blockId']) ? $_POST['blockId'] : 0;
// $subjectId = isset($_POST['subjectId']) ? $_POST['subjectId'] : 0;
$command = isset($_POST['get']) ? $_POST['get'] : "";


switch ($command) {
    case "block":
        $statement = "SELECT id,`block` FROM blockperstage";
        $dt = mysqli_query($conn, $statement);
        while ($result = mysqli_fetch_array($dt)) {
            echo $result1 = "<option value=" . $result['id'] . ">" . $result['block'] . "</option>";
        }
        break;

    // case "subject":
        // $result1 = "<option>Select subject</option>";
        // $statement = "SELECT id,subject_name FROM subjectsperblock WHERE block_id=" . $blockId;
        // $dt = mysqli_query($conn, $statement);

        // while ($result = mysqli_fetch_array($dt)) {
        //     $result1 .= "<option value=" . $result['id'] . ">" . $result['subject_name'] . "</option>";
        // }
        // echo $result1;
        // break;

    // case "block":
    //     $result1 = "<option>Select block</option>";
    //     $statement = "SELECT id, `block` FROM blockpersubject WHERE subject_id=" . $subjectId;
    //     $dt = mysqli_query($conn, $statement);

    //     while ($result = mysqli_fetch_array($dt)) {
    //         $result1 .= "<option value=" . $result['id'] . ">" . $result['block'] . "</option>";
    //     }
    //     echo $result1;
    //     break;

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