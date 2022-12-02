<?php
include "cnns.php";

if(!isset($_SESSION['email'])){ //if login in session is not set
  header("Location: login.php");
}
echo "<pre>"; print_r($_SESSION); echo "</pre>";
echo "<pre dir=ltr>"; print_r($_REQUEST); echo "</pre>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
      <title>MCQ - upload Data</title>
   </head>
<body>
  <a href=upload_data.php>upload data</a>
<?php
echo "Welcome $_SESSION[name1] $_SESSION[id] ";
?>
<h1>Question input</h1>
<!-- <form action=upload_data.php  method= POST/GET> -->
<div class=fld id=fld_collect>
<div>College</div>
<select id=college name=college class=input onchange='update_stage()' required>
<option></option>
<option value="hmu_medicine">Hawler Medical University- College of Medicine</option>
<option value="hmu_dentistry">Hawler Medical University- College of Dentistry</option>
<option value="hmu_pharmacy">Hawler Medical University- College of Pharmacy</option>
</select>
</div>
<br>
<div class=fld id=fld_stage>
<div>Stage</div>
<select id=stage name=stage class=input onchange='update_block()' required>
<option></option>
</select>
</div>
<br>
<div class=fld id=fld_block>
<div>Block</div>
<select id=block name=block class=input onchange='update_subject()' required>
<option></option>
</select>
</div>
<br>
<div class=fld id=fld_subject>
<div>Subject</div>
<select id=subject name=subject class=input required>
<option></option>
</select>
</div>
<br>
  <label for="ltype">Lecture Type:</label>
  <select id="ans" name="ans">
  <option value=""></option>
  <option value="lg">LG</option>
  <option value="sgl">SGL</option>
  <option value="practical">practical</option>
</select><br><br>
<label for="lname">Name of lecture:</label>
  <input type="text" id="lname" name="lname"><br><br>
  <label for="qname">Question:</label><br>
  <textarea type="text" id="qname" name="qname" rows="4" cols="50" placeholder="Write down the question "></textarea><br><br>
  <!-- <input type="text" id="qname" name="qname"><br><br> -->
  <label for="ans_aname">Answer A:</label>
  <input type="text" id="ans_aname" name="ans_aname"><br><br>
  <label for="ans_bname">Answer B:</label>
  <input type="text" id="ans_bname" name="ans_bname"><br><br>
  <label for="ans_cname">Answer C:</label>
  <input type="text" id="ans_cname" name="ans_cname"><br><br>
  <label for="Ans_dname">Answer D:</label>
  <input type="text" id="ans_dname" name="ans_dname"><br><br>
  <label for="ans_ename">Answer E:</label>
  <input type="text" id="ans_ename" name="ans_ename"><br><br>
  <label for="ans">Right Answer:</label>
  <select id="ans" name="ans">
  <option value="A">A</option>
  <option value="B">B</option>
  <option value="C">C</option>
  <option value="D">D</option>
</select><br><br>

  <input type="submit" value="Submit">
</form>

<?php
if(isset($_SESSION['email'])) {
	echo "<a href=$_SERVER[PHP_SELF]?logout=1>logoutw</a>";
	}
if(isset($_REQUEST['logout'])) {
  // session_start();
  session_unset();
  session_destroy(); 
  echo "<META HTTP-EQUIV='Refresh' Content='2; URL=login.php'>";
  }
?>

<script>
  function update_stage() {
	var a=[];
	college=document.getElementById("college").value;
	var o={
		"hmu_medicine": ["","HMU Stage 1", "HMU Stage 2", "HMU Stage 3", "HMU Stage 4", "HMU Stage 5", "HMU Stage 6"],
		"hmu_dentistry": ["","1", "2", "3", "4", "5"],
		"hmu_pharmacy": ["","1", "2", "3", "4", "5"],
		}
	var a=o[college];
		var select = document.getElementById('stage');
		var length = select.options.length;
		for (i = length-1; i >= 0; i--) select.options[i] = null;
		
	var select = document.getElementById('stage');
	var length = select.options.length;
	for (i = length-1; i >= 0; i--) select.options[i] = null;
	a.forEach(function add_option(item, index) {
		var opt = document.createElement('option');
		// opt.value = i;
		opt.innerHTML = item;
		select.appendChild(opt);
		});
	}
  function update_block() {
	var a=[];
	stage=document.getElementById("stage").value;
	var o={
		"HMU Stage 3": ["","GIT", "GUT", "CNS", "TRANS", "5"],
		"HMU Stage 2": ["","IBS", "MSD", "CVS", "RS", "HP"],
		"HMU Stage 1": ["","kurdology", "biology", "HSDM"],
  }
	var a=o[stage];
	var select = document.getElementById('block');
	var length = select.options.length;
	for (i = length-1; i >= 0; i--) select.options[i] = null;
	a.forEach(function add_option(item, index) {
		var opt = document.createElement('option');
		// opt.value = i;
		opt.innerHTML = item;
		select.appendChild(opt);
		});
	}
  function update_subject() {
	var a=[];
	block=document.getElementById("block").value;
	var o={
		"GIT": ["","pharma", "GUT", "CNS", "TRANS", "5"],
		"GUT": ["","IBS", "MSD", "CVS", "RS", "HP"],
		"IBS": ["","Biochemistry", "Phatology", "Pharmacology", "Immunology"],
  }
	var a=o[block];
	var select = document.getElementById('subject');
	var length = select.options.length;
	for (i = length-1; i >= 0; i--) select.options[i] = null;
	a.forEach(function add_option(item, index) {
		var opt = document.createElement('option');
		// opt.value = i;
		opt.innerHTML = item;
		select.appendChild(opt);
		});
	}

</script>
</body>
</html>
