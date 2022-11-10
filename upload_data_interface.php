
<?php
include "cnns.php";

if(!isset($_SESSION['email'])){ //if login in session is not set
  header("Location: login.php");
}
// echo "<pre>"; print_r($_SESSION); echo "</pre>";
// echo "<pre dir=ltr>"; print_r($_REQUEST); echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
      <title>MCQ - upload Data</title>
	  <html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: black;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  /* padding: 20px; */
}
</style>

   </head>

<body>
<?php
echo "Welcome $_SESSION[name1] $_SESSION[id] ";
?>
<h1>Question input</h1>
<form action=upload_data.php  method= POST/GET>
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
<select id=subject name=subject  class=input onchange='update_method()' required>
<option></option>
</select>
</div>
<br>
<div class=fld id=fld_method>
<div>Method</div>
<select id=method name=method class=input onchange='update_lecname()' required>
<option></option>
</select>
</div>
<br>
<div class=fld id=fld_name>
<div>Name of lecture:</div>
<select id="lname" name="lname" class=input required>
<option></option>
</select>
</div>
<br>
<!--  
<label for="lname">Name of lecture:</label>
  <input type="text" id="lname" name="lname"><br><br> -->
  <label for="qname">Question:</label><br>
  <textarea type="text" id="qname" name="qname" rows="4" cols="50" placeholder="Write down the question "></textarea><br><br>
  <!-- <input type="text" id="qname" name="qname"><br><br> -->
  <div>
<input type='radio' id='cor_ans' name="cor_ans" value='on1' />

  <!-- <input type="checkbox" class="radio"  name="cor_ans_a" /> -->
  <label for="ans_aname">Answer A:</label>
  <input type="text" id="ans_aname" name="ans_aname"><br><br>
  <!-- <input type="checkbox" class="radio" value="1" name="fooby[1][]" /> -->

  </div>
  <div>
<input type='radio' id='cor_ans' name="cor_ans" value='on2' />
  <!-- <input type="checkbox" class="radio"  name="cor_ans_b" /> -->
  <label for="ans_bname">Answer B:</label>
  <input type="text" id="ans_bname" name="ans_bname"><br><br>
  <!-- <input type="checkbox" class="radio" value="1" name="fooby[1][]" /> -->
</div>
<div>
<input type='radio' id='cor_ans' name="cor_ans" value='on3' />
<!-- <input type="checkbox" class="radio"  name="cor_ans_c" /> -->
<label for="ans_cname">Answer C:</label>
  <input type="text" id="ans_cname" name="ans_cname"><br><br>
</div>
<div>
<input type='radio' id='cor_ans' name="cor_ans" value='on4' />
<!-- <input type="checkbox" class="radio"  name="cor_ans_d" /> -->
  <label for="ans_dname">Answer D:</label>
  <input type="text" id="ans_dname" name="ans_dname"><br><br>
</div>
<div>
<input type='radio' id='cor_ans' name="cor_ans" value='on5' />
	<!-- <input type="checkbox" class="radio"  name="cor_ans_e" /> -->
	<label for="ans_ename">Answer E:</label>
  <input type="text" id="ans_ename" name="ans_ename"><br><br>
</div>
<label for="qnote">Note:</label><br>
  <textarea type="text" id="qnote" name="qnote" rows="4" cols="50" placeholder="Write down the question note "></textarea><br><br>
 
<label for="level">Level:</label>
  <select id="level" name="level">
  <option value=""></option>
  <option value="1">Easy</option>
  <option value="2">Middle</option>
  <option value="3">Hard</option>
</select><br><br>

  <input type="submit" value="Submit">
</form>

<?php
if(isset($_SESSION['email'])) {
	echo "<a href=$_SERVER[PHP_SELF]?logout=1>logout</a>";
	}
if(isset($_REQUEST['logout'])) {
  // session_start();
  session_unset();
  session_destroy(); 
//   echo "<META HTTP-EQUIV='Refresh' Content='2; URL=login.php'>";
header("Location: login.php");

  }
?>

<script>
  function update_stage() {
	var a=[];
	college=document.getElementById("college").value;
	var o={
		"hmu_medicine": ["","1", "2", "3", "4", "5", "6"],
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
	// var a=[];
	stage=document.getElementById("stage").value;
	college=document.getElementById("college").value;
	stagecollege = college+stage;
	var o={
		"hmu_medicine3": ["","GIT", "GUT", "CNS", "TRANS"],
		"hmu_medicine4": ["","gyn", "medicine", "college"],
		"hmu_medicine2": ["","IBS", "MSD", "CVS", "RS", "HP"],
		"hmu_medicine1": ["","kurdology", "biology", "HSDM"],
	}
	var a=o[stagecollege];
	var select = document.getElementById('block');
	var length = select.options.length;
	for (i = length-1; i >= 0; i--) select.options[i] = null;
	a.forEach(function add_option(item, index) {
		var opt = document.createElement('option');
		// opt.value = i;
		opt.innerHTML = item;
		select.appendChild(opt);
		// console.log (a,stagecollege,o);
		});
	}
  function update_subject() {
	var a=[];
	block=document.getElementById("block").value;
	stage=document.getElementById("stage").value;
	college=document.getElementById("college").value;
	stagecollegeblock = college+stage+block;
	var o={
		"hmu_medicine3GIT": ["","GIT", "patho", "Anatomy", "Physiology", "CCP"],
		"hmu_medicine3GUT": ["","medicine", "histology", "physiology", "pathology", "microbiology", "embryology", "pharmacology", "community_medicine", "anatomy", "biochemistry", "radiology", "gynecology", "surgery"],
		"hmu_medicine3CNS": ["","", "MSD", "CVS", "RS", "HP"],
		"hmu_medicine3TRANS": ["","GUT", "MSD", "CVS", "RS", "HP"],
		"hmu_medicine2MSD": ["","MSD", "MSD", "CVS", "RS", "HP"],
		"hmu_medicine2IBS": ["","IBS", "Phatology", "Pharmacology", "Immunology"],
  }
	var a=o[stagecollegeblock];
	console.log (stagecollegeblock);
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
	function update_method() {
	var a=[];
	subject=document.getElementById("subject").value;
	block=document.getElementById("block").value;
	stage=document.getElementById("stage").value;
	college=document.getElementById("college").value;
	stagecollegeblocksubject = college+stage+block+subject;
	var o={
		"hmu_medicine3GIT": ["","GIT", "patho", "Anatomy", "Physiology", "CCP"],
		"hmu_medicine3GUTmedicine": ["","lg1", "lg2", "lg3", "sgl1", "sgl2", "sgl3", "ccp1", "ccp2", "ccp3", "cp1", "cp2", "lab1", "lab2"],
		
  }
	var a=o[stagecollegeblocksubject];
	// console.log (stagecollegeblock);
	var select = document.getElementById('method');
	var length = select.options.length;
	for (i = length-1; i >= 0; i--) select.options[i] = null;
	a.forEach(function add_option(item, index) {
		var opt = document.createElement('option');
		// opt.value = i;
		opt.innerHTML = item;
		select.appendChild(opt);
		});
	}

	function update_lecname() {
	var a=[];
	subject=document.getElementById("subject").value;
	method=document.getElementById("method").value;
	block=document.getElementById("block").value;
	stage=document.getElementById("stage").value;
	college=document.getElementById("college").value;
	stagecollegeblocksubjectmethod = college+stage+block+subject+method;
	var o={
		"hmu_medicine3GUTmedicinelg1": ["","GUT disease", "GUT problems"],
		
  }
	var a=o[stagecollegeblocksubjectmethod];
	console.log (stagecollegeblocksubjectmethod);
	var select = document.getElementById('lname');
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
