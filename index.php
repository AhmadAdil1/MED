<?php
include "cnns.php";


if(!isset($_SESSION['email'])){ //if login in session is not set
  header("Location: login.php");
}
// echo "<pre>"; print_r($_SESSION); echo "</pre>";
$role_to=$_SESSION['role'];
if($role_to == 1){
  echo "<br><a href=upload_data_interface.php>Upload Data</a><br>";
}
$where='';
if ($_SESSION['college'] == "hmu-medicine" ){
  $stage = "3";
}
// $stage= $_SESSION['stage'];
if(isset($_REQUEST['block'])) $where="block='$_REQUEST[block]' AND ";
$sql = "SELECT * FROM questions WHERE $where stage='$stage'";
echo $sql;
$result = $conn->query($sql);
$i=0;
echo "<br><a href='index.php?block=GIT'>GIT</a>";
if(isset($_REQUEST['block'])) $where="block='$_REQUEST[block]' AND ";
$sql = "SELECT * FROM questions WHERE $where stage='$stage'";
// echo $sql;
$result = $conn->query($sql);
$i=0;
echo "<br><a href='index.php?block=GUT'>GUT</a>";
if(isset($_REQUEST['block'])) $where="block='$_REQUEST[block]' AND ";
$sql = "SELECT * FROM questions WHERE $where stage='$stage'";
// echo $sql;
$result = $conn->query($sql);
$i=0;
echo "<br><a href='index.php?block=CNS'>CNS</a>";

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $i++;
    echo "<html>";
    echo "<head><title>SBA</title></head>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    
    echo "<ul style='padding:0; display: block;'class='quiz'>";
      echo  "<h4 style='background-color: #f2f2f2; margin:0px;  padding: 0; font-weight: bold;'>".$i.") ".$row["question"]."</h4>";
        echo "<ul class='choices' style='background-color: #f2f2f2;'>";
        echo  "<label>";
        echo "<input type='radio' id='ans_a' name='".$row["id"]."' value='A' />";
        echo "<h7> A) </h7>";
           echo "<span>".$row["ans_a"]."</span>";
          echo  "</label>";
           echo "<br>";
           echo  "<label>";
           echo "<input type='radio' id='ans_b' name='".$row["id"]."' value='B' />";
           echo "<h7> B) </h7>";
        echo "<span>".$row["ans_b"]."</span>";
       echo  "</label>";
        echo "<br>";
        echo  "<label>";
        echo "<input type='radio' id='ans_c' name='".$row["id"]."' value='C' />";
        echo "<h7> C) </h7>";
     echo "<span>".$row["ans_c"]."</span>";
    echo  "</label>";
     echo "<br>";
     echo  "<label>";
     echo "<input type='radio' id='ans_d' name='".$row["id"]."' value='D' />";
     echo "<h7> D) </h7>";
  echo "<span>".$row["ans_d"]."</span>";
 echo  "</label>";
  echo "<br>";
  echo  "<label>";
  echo "<input type='radio' id='ans_e' name='".$row["id"]."' value='e' />";
  echo "<h7> E) </h7>";
echo "<span>".$row["ans_e"]."</span>";
echo  "</label>";
echo "<br>";
           
       echo "</ul>";
       echo "</ul>";
    // echo "</li>";
    
    // echo "id: " . $row["id"]. " - Name: " . $row["ans_a"]. " " . $row["ans_a"]. "<br>";
  }
} else {
  echo "0 results";
 }
// echo "<button class='view-results' onclick='returnScore()'>View Results</button>";
// echo "<span id='myresults' class='my-results'>My results will appear here</span>";
$conn->close();
?>
<script>
    var answers = ["A", "C", "B"],
    tot = answers.length;
function getCheckedValue(radioName) {
    var radios = document.getElementsByName(radioName);
    for (var y = 0; y < radios.length; y++)
        if (radios[y].checked) return radios[y].value;
}
function getScore() {
    var score = 0;
    for (var i = 0; i < tot; i++)
        if (getCheckedValue("id" + i) === answers[i]) score += 1;
    return score;
}
function returnScore() {
    document.getElementById("myresults").innerHTML =
        "Your score is " + getScore() + "/" + tot;
    if (getScore() > 2) {
        console.log("Bravo");
    }
}

function filter_verification(user_stage){
		let	check_filter=document.getElementById('check_dropdown').value;
		// if(md==1) mydata='mydata'; else mydata='0';
		// lt=md=='0'?'':'&lt=district';
		// location.href="index.php?loc="+md+lt+"&rt=0&v="+check_filter;
    <?php
    $sql = "SELECT * FROM questions WHERE stage='$check_filter'";
    ?>
    return;
}
</script>
<?php
if(isset($_SESSION['email'])) {
	echo "<a href=$_SERVER[PHP_SELF]?logout=1>logoute</a>";
	}
if(isset($_REQUEST['logout'])) {
  // session_start();
  session_unset();
  session_destroy(); 
  // echo "<META HTTP-EQUIV='Refresh' Content='2; URL=login.php'>";
  header("Location: login.php");

  }
?>
<!-- <!DOCTYPE html>
<head>
    <script>
      var answer = 2 ;
      var correctAnswer = 1;
      function checkAnswer() {
   if(answer == correctAnswer){
    // alert("Well done!");
    document.write("well done")
} else {
  document.write("Too bad")
    // alert("Too bad!");
}
   }
    </script>
</head>
<body>
<button onclick="checkAnswer()">Check</button>

</body>
</html> -->