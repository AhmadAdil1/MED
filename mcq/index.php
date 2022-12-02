
<?php
include "cnns.php";
require_once 'not_loggedin.php';


// echo "<pre>"; print_r($_SESSION); echo "</pre>";
if(isset($_REQUEST['role_to'])) $_SESSION['role']=$_REQUEST['role_to'];
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
echo "</div>";
  die();
}

if(empty($_SESSION['college'])) {
echo"<body onload='get_college_options()'>";
?>  
 <form action="upload_data_gmail.php" name="frm" method="post">

  <div class="form-group" onload="get_college_options()">
     <label for="college">College:</label>
       <select id="college" name="college" onchange="get_stage_options()" value="<?php echo $college; ?>" require>
       <option value=""></option>
       </select>
      </div>
      <div class="form-group">
      <label for="stage">Stage:</label>
        <select id="stage" name="stage" value="<?php echo $stage; ?>" require>
        <option value=""></option>
        </select>
       </div>
       <input type="submit" name="gsubmit" value="Submit">
 </form>
       <script>
   function get_college_options() {
      var sl = document.getElementById("college");
      for (const i in colleges) {
        let va = colleges[i].split("|");
          var option = document.createElement("option");
          option.value = va[0];
          option.text = va[1];
          sl.add(option);
        
      }
    }
    
    function get_stage_options() {
      // console.log("1");
      // We have to delete all the options then add new options
      var selectElement = document.getElementById("stage");
      while (selectElement.length > 0) {
        selectElement.remove(0);
      }
      var adding = document.getElementById("stage");
      var added = document.createElement("option");
      added.text = "";
      adding.add(added);
      var c = document.getElementById('college').value;
      var sl1 = document.getElementById("stage");
      for (const i in stage_names) {
        let va = stage_names[i].split("|");
        if (va[2] == c) {
          var option = document.createElement("option");
          option.value = va[0];
          option.text = va[1];
          sl1.add(option);
        }
      }
    }

       </script>
<?php
die();
}else{
  echo "Welcome $_SESSION[name1], lets answer some quetions!";
  $stage = $_SESSION['stage'];
  echo"<body onload='get_blocks_options(\"$stage\")'>";

}
function update_block($conn){
    $sql="SELECT id, `block`, stage_id from blockperstage";
  $result = $conn->query($sql);
  $s="const blocks = [\n";
  while($row = $result->fetch_assoc()) {
    $blockk = $row['block'];
    $id = $row['id'];
    $stage_id = $row['stage_id'];
      $s.="'$id|$blockk|$stage_id|',\n";
    }
    $s.="];\n";
        $fn="block.js";
        $fp=fopen($fn,"w");
        fwrite($fp,$s);
        fclose($fp);
      }
      
function update_subject($conn){
     $sql="SELECT id, `subject_name`, block_id from subjectsperblock";
$result = $conn->query($sql);
$s="const subjects = [\n";
while($row = $result->fetch_assoc()) {
  $subject_name = $row['subject_name'];
  $id = $row['id'];
  $block_id = $row['block_id'];
    $s.="'$id|$subject_name|$block_id|',\n";
  }
  $s.="];\n";

      $fn="subject.js";
      $fp=fopen($fn,"w");
      fwrite($fp,$s);
      fclose($fp);
    }
         
function update_lecname($conn){
     $sql="SELECT id, `lecture_name`, subject_id from lecnamepersubject";
$result = $conn->query($sql);
$s="const lec_names = [\n";
while($row = $result->fetch_assoc()) {
  $lecture_name = $row['lecture_name'];
  $id = $row['id'];
  $subject_id = $row['subject_id'];
    $s.="'$id|$lecture_name|$subject_id|',\n";
  }
  $s.="];\n";

      $fn="lecturename.js";
      $fp=fopen($fn,"w");
      fwrite($fp,$s);
      fclose($fp);
    }

            
function update_stage($conn){
  $sql="SELECT id, `stage`, college_id from stagespercollege";
$result = $conn->query($sql);
$s="const stage_names = [\n";
while($row = $result->fetch_assoc()) {
$stage = $row['stage'];
$id = $row['id'];
$college_id = $row['college_id'];
 $s.="'$id|$stage|$college_id|',\n";
}
$s.="];\n";

   $fn="stages.js";
   $fp=fopen($fn,"w");
   fwrite($fp,$s);
   fclose($fp);
 }

           
function update_colleges($conn){
  $sql="SELECT id, `college_name` from colleges";
$result = $conn->query($sql);
$s="const colleges = [\n";
while($row = $result->fetch_assoc()) {
$college_name = $row['college_name'];
$id = $row['id'];
 $s.="'$id|$college_name|',\n";
 // $c=$row[0];
}
$s.="];\n";

   $fn="colleges.js";
   $fp=fopen($fn,"w");
   fwrite($fp,$s);
   fclose($fp);
 }

 function update_all($conn){
  update_colleges($conn);
  update_stage($conn);
  update_block($conn);
  update_subject($conn);
  update_lecname($conn);
  header("Location: index.php");
 }

  if (isset($_GET['update_all_js'])) {
    update_all($conn);
  }

  $role_to=$_SESSION['role'];
  $stage= $_SESSION['stage'];
  $college= $_SESSION["college"];

echo "<br><br><label for='blocks'>Choose a block:</label>
<select name='block_options' id='block_options' onchange='get_block_query()' style='max-width:20px;border:0px;'><option value=''></option></select>";

echo "<br><label for='subjects'>Choose a subjects:</label><select name='subject_options' id='subject_options' onchange='get_subject()' style='max-width:20px;border:0px;'><option value=''></option></select>";

echo "<br><label for='lec_name'>Choose a lecture name:</label><select name='lec_name' id='lec_name' onchange='lec_name()' style='max-width:20px;border:0px;'><option value=''></option></select>";

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
    echo "<body style='padding-bottom: 40px;'>";
    echo "<ul style='padding:0; display: block;'class='quiz'>";
      echo  "<h4 style='background-color: #f2f2f2; margin:0px;  padding: 0; font-weight: bold;'>".$i.") ".$row["question"]."</h4>";
        echo "<ul class='choices' style='background-color: #f2f2f2;'>";
        $ansA = $row['ans_a'];
    echo "<div name='ans_a'>";
    echo "<input type='radio'  id='ans_a' name=".$row["id"]."  value=".$row["ans_a"]."  onclick='ansAA(\"$ansA\")'/>"; 
        echo "<h7> A) </h7>";
           echo "<span>".$row["ans_a"]."</span>";
           echo "</div>";
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
           echo "<p id='demo'></p>";

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
      
<script>
function get_blocks_options(stage){
  var sl=document.getElementById("block_options");
  // console.log(sl);
  // stage = 3;
  for (const i in blocks) {
    let va=blocks[i].split("|");
    if(va[2]==stage){
    var option = document.createElement("option");
    option.value = va[0];
    option.text = va[1];
    sl.add(option);
    }
    }
    var url_string = window.location.href;
    var url = new URL(url_string);
    var c = url.searchParams.get("block");
    // console.log(c);
    get_subject_options(c)
  
}
function get_subject_options(c){

// console.log(c); 
  var sl1=document.getElementById("subject_options");
    // blocked = 1;
    for (const i in subjects) {
      let va=subjects[i].split("|");
    console.log(va);
      if(va[2]==c){
      var option = document.createElement("option");
      option.value = va[0];
      option.text = va[1];
      sl1.add(option);
      }
      }
      var url_string = window.location.href;
    var url = new URL(url_string);
    var d = url.searchParams.get("sub");
    // console.log(c);
    get_lecname_options(d)

}
function get_lecname_options(d){
  var sl2=document.getElementById("lec_name");
    for (const i in lec_names) {
      let va=lec_names[i].split("|");
    console.log(va);
      if(va[2]==d){
      var option = document.createElement("option");
      option.value = va[0];
      option.text = va[1];
      sl2.add(option);
      }
      }

}

function get_block_query(){
  let	block_result=document.getElementById('block_options').value;
  // console.log(block_result);

  // let	subject_reult=document.getElementById('subject_options').value;
  // if(md==1) mydata='mydata'; else mydata='0';
  // lt=md=='0'?'':'&lt=district';
  location.href="index.php?block="+block_result;
  // update_subject(block_result);

}
  anss = "";
  function ansAA(ansA){
    anss = ansA;
    console.log (1, anss, ansA);
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

  function get_subject(block){
  let	subject_reult=document.getElementById('subject_options').value;
  // let	block_result=document.getElementById('block_options').value;
  // location.href=window.location.href+"&sub="+subject_reult;
  let params = new URLSearchParams(location.search);
location.href="index.php?block="+params.get('block')+"&sub="+subject_reult;

//   let params = new URLSearchParama(location.search);
// params.block
}


  
  function lec_name(){
  let	lec_name_reult=document.getElementById('lec_name').value;
  // let	block_result=document.getElementById('block_options').value;
  // location.href=window.location.href+"&method="+method_reult;  
  let params = new URLSearchParams(location.search);
location.href="index.php?block="+params.get('block')+"&sub="+params.get('sub')+"&lecname="+lec_name_reult;
}
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
