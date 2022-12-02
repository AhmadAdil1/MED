
<?php
include "cnns.php";
require_once 'not_loggedin.php';


// echo "<pre>"; print_r($_SESSION); echo "</pre>";
$without_login="WELCOME without login";
$with_login="Welcome with login";

/*checking whether the user is logged in or not*/
if(isset($_SESSION['email'])){ 
  //if login in session is set
  // echo $with_login;
  // echo " <a href=logout.php>logout</a> ";
}else{
  //if user isn't logged in
echo "<h2 id='wlc_header'>Welcome to Single best answer system</h2>";
echo "<h4 id='wlc_header'>Please login to contribute more</h4>";
echo "";
echo "<div class='flex-parent jc-center'>";
echo("<button class='button' class='btn btn-primary btn-block btn-lg' onclick=\"location.href='login.php'\">Login</button>");

// echo "<button class='button' class='btn btn-primary btn-block btn-lg' 
// onclick=location.href=login.php>Login</button>";

// echo "<button onclick=location.href=login.php>Google Login</button>";
// echo "<button class='button' onclick='location.href='login.php' type='button'>Login</button><br>";
echo "</div>";

  die();
}

if(empty($_SESSION['college'])) {
echo "<form action=upload_data_gmail.php  method= POST/GET>";
echo "<div class=fld id=fld_collect>";
echo "<div>College</div>";
echo "<select id=gcollege name=gcollege class=input onchange='update_stage()'>";
echo "<option></option>";
echo "<option value=hmu_medicine>Hawler Medical University- College of Medicine</option> ";
echo "<option value=hmu_dentistry>Hawler Medical University- College of Dentistry</option>";
echo "<option value=hmu_pharmacy>Hawler Medical University- College of Pharmacy</option> ";
echo "</select>";
echo "</div>";
echo "<br>";
echo "<div class=fld id=fld_stage>";
echo "<div>Stage</div>";
echo "<select id=gstage name=gstage class=input onchange='update_block()' required>";
echo "<option value=1>1</option>";
echo "<option value=2>2</option>";
echo "<option value=3>3</option>";
echo "<option value=4>4</option>";
echo "<option value=5>5</option>";
echo "<option value=6>6</option>";
echo "</select>";
echo "</div>";
echo "<br>";
echo "<input type='submit' name=gsubmit value='Submit'>";
echo "</form>";
die();
}else{
  echo "Welcome $_SESSION[name1], lets answer some quetions!";
}
$role_to=$_SESSION['role'];
$stage= $_SESSION['stage'];
$college= $_SESSION["college"];
if($role_to == 1){
  echo "<br><a href=upload_data_interface.php>Upload Data</a><br>";
}
// $block_sql='';
// $subject_sql='';
// if ($college == "hmu_medicine"){


// if(isset($_REQUEST['block'])){ $block_sql="block='$_REQUEST[block]' AND ";}
// echo "<br><a href='index.php'>All</a>";
// echo "<br><a href='index.php?block=GIT'>GIT</a>";
// echo "<br><a href='index.php?block=GUT'>GUT</a>";
// echo "<br><a href='index.php?block=CNS'>CNS</a>";
// echo "<br><a href='index.php?block=TRANS'>TRANS</a>";
// // if(isset($_REQUEST['subject'])) $subject_sql="subject='$_REQUEST[subject]' AND ";
// // echo "<br><a href='index.php?subject=medicine'>medicine</a>";
// if(isset($_REQUEST['block'], $_REQUEST['subject'])){ 
//   $block_sql="block='$_REQUEST[block]' AND";
//   $subject_sql="subject='$_REQUEST[subject]' AND";
// }
// echo "<br><a href='index.php?block=GUT&subject=medicine'>Medicine GUT</a>";
// // SELECT * FROM questions WHERE block='GUT' AND subject='medicine' AND college='hmu_medicine' AND stage=3;
// // if(isset($_REQUEST['block'])) $block_sql="block='$_REQUEST[block]' AND ";
// }



// $query = "SELECT id_main, id_sub, college FROM sys_st WHERE id_sub=0";
// $result = mysqli_query($conn, $query);
// // $result = mysqli_query($conn, $sql);
// echo "<select name=categories'>";
// echo "<option></option>";
// while ($row = mysqli_fetch_array($result))
// {
//     echo "<option value='".$row['id_main']."' onchange='get_block()'>".$row['college']."</option>";
//   }
//   echo "</select>";
// include "../city_test/index.php";
?>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <div class="container">
            <div class="row">
                <!--Course -->

                <form action="" name="frm" method="post">
                    <h3>college stage block Dropdown</h3>
                    <section class="courses-section">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="college">college</label>
                                <select type="text" name="college" id="college" class="form-control">
                                    <option>Select college</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="stage">stage</label>
                                <select type="text" id="stage" name="stage" class="form-control"></select>
                            </div>



                            <div class="col-md-4">
                                <label for="block">block</label>
                                <select name="block" id="block" class="form-control"></select>
                            </div>

                            <div class="col-md-4">
                                <label for="subject">subject</label>
                                <select name="subject" id="subject" class="form-control"></select>
                            </div>
                            <div class="col-md-4">
                                <label for="lecname">lecture name</label>
                                <select name="lecname" id="lecname" class="form-control"></select>
                            </div>

                        </div>

                        </div>
                    </section>
                </form>
            </div>
        </div>
<?php
// echo "<br><br><label for='blocks'>Choose a block:</label>
// <select name='block_options' id='block_options' onchange='get_block()' style='max-width:20px;border:0px;'><option value=''></option><option value='GIT'>GIT</option><option value='GUT'>GUT</option><option value='CNS'>CNS</option> </select>";

// echo "<br><label for='subjects'>Choose a subjects:</label><select name='subject_options' id='subject_options' onchange='get_subject()' style='max-width:20px;border:0px;'><option value=''></option><option value='medicine'>medicine</option><option value='histology'>histology</option><option value='Anatomy'>Anatomy</option> </select>";

// // echo "<br><label for='subjects'>Choose a subjects:</label><div>Subject</div><select name=subject_options id=subject_options onchange='get_subject()' style='max-width:20px;border:0px;'><option></option></select>";

// echo "<br><label for='lec_name'>Choose a lecture name:</label><select name='lec_name' id='lec_name' onchange='lec_name()' style='max-width:20px;border:0px;'><option value=''></option><option value='lg1'>lg1</option><option value='lg2'>lg2</option><option value='0'>draft</option> </select>";

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
$sql = "SELECT * FROM questions WHERE college='$college' AND stage=$stage";
$result = $conn->query($sql);}
// echo $sql;
$i=0;
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $i++;
    echo "<html>";
    echo "<head><title>SBA</title></head>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    echo "<div>";
    echo "<body style='padding-bottom: 20px;'>";
    echo "<ul style='padding:0; display: block;'class='quiz'>";
      echo  "<h4 style='background-color: #f2f2f2; margin:0px;  padding: 0; font-weight: bold;'>".$i.") ".$row["question"]."</h4>";
        echo "<ul class='choices' style='background-color: #f2f2f2;'>";
        $ansA = $row['ans_a'];
    echo "<div name='ans_a'>";
        echo "<input type='radio'  id='ans_a' name=".$row["id"]."  value=".$row["ans_a"]."  onclick='ansAA(\"$ansA\")'/>";
        echo "<h7> A) </h7>";
           echo "<span>".$row["ans_a"]."</span>";
           echo "</div>";
          //  echo "<br>";
    echo "<div name='ans_b'>";
           $ansB = $row['ans_b'];
           echo "<input type='radio' id='ans_b' name=".$row["id"]." value=".$row["ans_b"]." onclick='ansBB(\"$ansB\")'/>";
           echo "<h7> B) </h7>";
        echo "<span>".$row["ans_b"]."</span>";
        echo "</div>";
        // echo "<br>";
        echo "<div name='ans_c'>";
        $ansC = $row['ans_c'];
        echo "<input type='radio' id='ans_c' name=".$row["id"]." value=".$row["ans_c"]." onclick='ansCC(\"$ansC\")'/>";
        echo "<h7> C) </h7>";
        echo "<span>".$row["ans_c"]."</span>";
        echo "</div>";
    //  echo "<br>";
     $ansD = $row['ans_d'];
     echo "<input type='radio' id='ans_d' name=".$row["id"]." value=".$row["ans_d"]." onclick='ansDD(\"$ansD\")'/>";
     echo "<h7> D) </h7>";
  echo "<span>".$row["ans_d"]."</span>";
  echo "<br>";
  $ansE = $row['ans_e'];
  echo "<input type='radio' id='ans_e' name=".$row["id"]." value=".$row["ans_e"]." onclick='ansEE(\"$ansE\")' />";
  echo "<h7> E) </h7>";
echo "<span>".$row["ans_e"]."</span>";
echo "<br>";
          //  echo "right Ans:".$row['right_ans']."";
           $rightans = $row['right_ans'];
           $idshow = $row['id'];
           $idshow2 = $row['right_ans'];
           $qnote = $row['qnote'];
           echo "<button onclick='checking_ans(\"$rightans\", \"$idshow\", \"$idshow2\",  \"$qnote\")'>Try it</button>";
           echo "<p id='$idshow'></p>";
           echo "<p id='$idshow2'></p>";
           echo "</div>";  
           echo "</body>";
           
           // echo "id: " . $row["id"]. " - Name: " . $rightans. "<br>";
          }
        } else {
          echo "<br> 0 results";
        }
        $conn->close();
        ?>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  anss = "";
  function ansAA(ansA){
    anss = ansA;
    // console.log (1, anss, ansA);
  }
  function ansBB(ansB){
    anss = ansB;
  }
  function ansCC(ansC){
    anss = ansC;
  }function ansDD(ansD){
    anss = ansD;
  }function ansEE(ansE){
    anss = ansE;
  }
  function checking_ans(rightans, idshow, idshow2, qnote) {  
    // console.log (3, anss, idshow, idshow2)
    if(anss == rightans){
      document.getElementById(idshow).innerHTML = "Correct, click here for explanation <button onclick='showingrightans()'>explanation</button>";
    }else{
      document.getElementById(idshow).innerHTML = "Incorrect, Try again or you can view the answer with explanation by clicking here <button onclick='showingrightans()'>Right Answer</button>";
    }
    // idshow2 == showidplz;
    showidplz = idshow2;
    showright = rightans;
    qnote1 = qnote;
  }
  function showingrightans() {
    console.log (showidplz);
  document.getElementById(showidplz).innerHTML = "Right answer is "+showright.bold()+"<br> Here is a short note about the answer:<br>"+qnote1;
}
function get_block(){
  let	block_result=document.getElementById('block_options').value;
  // let	subject_reult=document.getElementById('subject_options').value;
  // if(md==1) mydata='mydata'; else mydata='0';
  // lt=md=='0'?'':'&lt=district';
  location.href="index.php?block="+block_result;
  // update_subject(block_result);
}

  function get_subject(block){
  let	subject_reult=document.getElementById('subject_options').value;
  // let	block_result=document.getElementById('block_options').value;

  // location.href=window.location.href+"&sub="+subject_reult;
  let params = new URLSearchParams(location.search);
location.href="index.php?block="+params.get('block')+"&sub="+subject_reult;

//   let params = new URLSearchParama(location.search);
// params.block
}
// function update_subject(block_result) {
//   console.log(block_result);
// 	  var a=[];
// 	  block=block_result;
// 	  var o={
// 		  "GUT": ["",  "Anatomy", "Community medicine",	"Embryology",	"Family medicine",	"Histology",	"Medical Education",	"Microbiology",	"Pathology",	"Pharmacology ",	"Physiology",	"Radiology", "Biochemistry", "Stem cell"],
  
// 	}
// 	  var a=o[block];
// 	  console.log (block);
// 	  var select = document.getElementById('subject_options');
// 	  var length = select.options.length;
// 	for (i = length-1; i >= 0; i--) select.options[i] = null;
// 	a.forEach(function add_option(item, index) {
// 		var opt = document.createElement('option');
// 		// opt.value = i;
// 		opt.innerHTML = item;
// 		select.appendChild(opt);
// 		});

// 	}

  
  function lec_name(){
  let	lec_name_reult=document.getElementById('lec_name').value;
  // let	block_result=document.getElementById('block_options').value;
  // location.href=window.location.href+"&method="+method_reult;  
  let params = new URLSearchParams(location.search);
location.href="index.php?block="+params.get('block')+"&sub="+params.get('sub')+"&lecname="+lec_name_reult;

  }
        
            $(document).ready(function() {

                $('#college').change(function() {
                    loadstage($(this).find(':selected').val())
                })
                $('#stage').change(function() {
                    loadblock($(this).find(':selected').val())
                })
                $('#block').change(function() {
                    loadsubject($(this).find(':selected').val())
                })
                $('#subject').change(function() {
                    loadlecname($(this).find(':selected').val())
                })


            });

            function loadBlock() {
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: "get=college"
                }).done(function(result) {


                    $(result).each(function() {
                        $("#college").append($(result));
                    })
                });
            }
            function loadstage(collegeId) {
                $("#stage").children().remove()
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: "get=stage&collegeId=" + collegeId
                }).done(function(result) {

                    $("#stage").append($(result));

                });
            }
            function loadblock(stageId) {
                $("#block").children().remove()
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: "get=block&stageId=" + stageId
                }).done(function(result) {

                    $("#block").append($(result));

                });
            }
            function loadsubject(blockId) {
                $("#subject").children().remove()
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: "get=subject&blockId=" + blockId
                }).done(function(result) {

                    $("#subject").append($(result));

                });
            }
            function loadlecname(subjectId) {
                $("#lecname").children().remove()
                $.ajax({
                    type: "POST",
                    url: "ajax.php",
                    data: "get=lecname&subjectId=" + subjectId
                }).done(function(result) {

                    $("#lecname").append($(result));

                });
            }

            // init the countries
            loadBlock();
       
</script>
<?php
if(isset($_SESSION['email'])) {
	// echo "<a href=$_SERVER[PHP_SELF]?logout=1>logoute</a>";
	}
if(isset($_REQUEST['logout'])) {
  session_unset();
  session_destroy(); 
  header("Location: login.php");
  // echo "<META HTTP-EQUIV='Refresh' Content='2; URL=login.php'>";
  }
?>
