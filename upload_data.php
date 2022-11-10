    <?php   
include "cnns.php";

        $college = $_REQUEST['college'];
        $stage =  $_REQUEST['stage'];
        $block = $_REQUEST['block'];
        $subject = $_REQUEST['subject'];
        $lec_name = $_REQUEST['lname'];
        $lec_type = $_REQUEST['method'];
        $question = $_REQUEST['qname'];
        $ans_a = $_REQUEST['ans_aname'];
        $ans_b = $_REQUEST['ans_bname'];
        $ans_c = $_REQUEST['ans_cname'];
        $ans_d = $_REQUEST['ans_dname'];
        $ans_e = $_REQUEST['ans_ename'];
        $qnote = $_REQUEST['qnote'];
        $question_level = $_REQUEST['level'];
        $user_id = $_SESSION['id'];
        $right_ans = $_REQUEST['cor_ans'];  
        $right_ans_cor = "";    
            if($right_ans == "on1"){
                $right_ans_cor = $ans_a;
            }else if ($right_ans == "on2"){
                $right_ans_cor = $ans_b;
            }else if ($right_ans == "on3"){
                $right_ans_cor = $ans_c;
            }else if ($right_ans == "on4"){
                $right_ans_cor = $ans_d;
            }else if ($right_ans == "on5"){
                $right_ans_cor = $ans_e;
            }
        $sql = "INSERT INTO questions (uploader_id, college, stage, `block`, `subject`, lec_name, lec_type, question, ans_a, ans_b, ans_c, ans_d, ans_e, right_ans, question_level, qnote) VALUES ('$user_id',
        '$college','$stage','$block','$subject', '$lec_name', '$lec_type', '$question', '$ans_a', '$ans_b', '$ans_c', '$ans_d', '$ans_e', '$right_ans_cor', '$question_level', '$qnote')";
         
        if(mysqli_query($conn, $sql)){
            echo "<h3>data stored in a database successfully.</h3> <META HTTP-EQUIV='Refresh' Content='10; URL=index.php'>";
            echo $right_ans;
//   header("Location: index.php");

        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
         
        // Close connection
        mysqli_close($conn);
        ?>
        