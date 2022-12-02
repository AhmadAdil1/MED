
<?php
include "cnns.php";
// include_once "upload_data.php";

if(!isset($_SESSION['email'])){ //if login in session is not set
  header("Location: login.php");
}
echo "<pre>"; print_r($_SESSION); echo "</pre>";
// echo "<pre dir=ltr>"; print_r($_REQUEST); echo "</pre>";

$sql = "SELECT * FROM questions ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["ans_a"]. " " . $row["ans_a"]. "<br>";
  }
} else {
  echo "0 results";
}
// $conn->close();


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
<select id=college name=college class=input onchange='update_stage()'> -->
	 <option></option>
 <option value="hmu_medicine">Hawler Medical University- College of Medicine</option> 
<option value="hmu_dentistry">Hawler Medical University- College of Dentistry</option>
<option value="hmu_pharmacy">Hawler Medical University- College of Pharmacy</option> 
</select>
<!-- <?php

// $query = "SELECT id, college_name, `value` FROM colleges";
// $result = mysqli_query($conn, $query) ;
?>

<select id=college name=college class=input onchange='update_stage()'>
<option></option> -->

<?php 

while ($row = mysqli_fetch_array($result))
{
    echo "<option value=".$row['id'].">".$row['college_name']."</option>";
}
?>        
</select>
<!-- if ($_SESSION["college"] == "hmu_medicine"){ -->
	 <!-- $collegevalue = "Hawler Medical University- College of Medicine"; }?>"></option> -->
</div>
<br>
<div class=fld id=fld_stage>
<div>Stage</div>
<select id=stage name=stage class=input onchange='update_block()' required>
<option></option>
</select>
</div>
<br>
<?php
//  $query ="SELECT DISTINCT `block` FROM mcq_str WHERE stage=$_SESSION[stage] AND college='$_SESSION[college]'";
// $result = $conn->query($query);
// if($result->num_rows> 0){
//   $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
// }
?>
<!-- 
<select name="block">
   <option>select block</option>
  <?php 
//   foreach ($options as $option) {
  ?>
    <option><?php echo $option['block']; ?> </option>
    <?php 
    // }
   ?>
</select> -->


<div class=fld id=fld_block>
<div>Block</div>
<select id=block name=block class=input onchange='update_subject()' required>
<option></option>


</select>
</div>
<br>
<div class=fld id=fld_subject>
<div>Subject</div>
<select id=subject name=subject  class=input onchange='subject_lecname()' required>
<option></option>
</select>
</div>

<div class=fld id=fld_name>
<div>Name of lecture:</div>
<select id="lname" name="lname" class=input >
<option></option>
</select>
</div>
<br>

  <label for="qname">Question:</label><br>
  <textarea type="text" id="qname" name="qname" rows="4" cols="50" placeholder="Write down the question " required></textarea><br><br>
  <!-- <input type="text" id="qname" name="qname"><br><br> -->
  <div>
<input type='radio' id='cor_ans' name="cor_ans" value='on1' />

  <!-- <input type="checkbox" class="radio"  name="cor_ans_a" /> -->
  <label for="ans_aname">Answer A:</label>
  <input type="text" id="ans_aname" name="ans_aname" required><br><br>
  <!-- <input type="checkbox" class="radio" value="1" name="fooby[1][]" /> -->

  </div>
  <div>
<input type='radio' id='cor_ans' name="cor_ans" value='on2' />
  <!-- <input type="checkbox" class="radio"  name="cor_ans_b" /> -->
  <label for="ans_bname">Answer B:</label>
  <input type="text" id="ans_bname" name="ans_bname" required><br><br>
  <!-- <input type="checkbox" class="radio" value="1" name="fooby[1][]" /> -->
</div>
<div>
<input type='radio' id='cor_ans' name="cor_ans" value='on3' />
<!-- <input type="checkbox" class="radio"  name="cor_ans_c" /> -->
<label for="ans_cname">Answer C:</label>
  <input type="text" id="ans_cname" name="ans_cname" required><br><br>
</div>
<div>
<input type='radio' id='cor_ans' name="cor_ans" value='on4' />
<!-- <input type="checkbox" class="radio"  name="cor_ans_d" /> -->
  <label for="ans_dname">Answer D:</label>
  <input type="text" id="ans_dname" name="ans_dname" required><br><br>
</div>
<div>
<input type='radio' id='cor_ans' name="cor_ans" value='on5' />
	<!-- <input type="checkbox" class="radio"  name="cor_ans_e" /> -->
	<label for="ans_ename">Answer E:</label>
  <input type="text" id="ans_ename" name="ans_ename" required><br><br>
</div>
<label for="qnote">Note:</label><br>
  <textarea type="text" id="qnote" name="qnote" rows="4" cols="50" placeholder="Write down the question note " required></textarea><br><br>
 
<label for="level">Level:</label>
  <select id="level" name="level" required>
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
	// function update_stage() {
	// var a=[];
	// college=document.getElementById("college").value;
	// <?php 
    //   $query = "SELECT id, stage, college_id FROM stagespercollege WHERE college_id="+$college;
    //   $result = mysqli_query($conn, $query);
	//   mysqli_fetch_column($result, $id = 0);
    // ?>
	// var o={
	// 	$college: 
	// }
	// var o={
	// 	"hmu_medicine": ["","1", "2", "3", "4", "5", "6"],
	// 	"hmu_dentistry": ["","1", "2", "3", "4", "5"],
	// 	"hmu_pharmacy": ["","1", "2", "3", "4", "5"],
	// 	}
	// var a=o[college];
	// 	var select = document.getElementById('stage');
	// 	var length = select.options.length;
	// 	for (i = length-1; i >= 0; i--) select.options[i] = null;
		
	// var select = document.getElementById('stage');
	// var length = select.options.length;
	// for (i = length-1; i >= 0; i--) select.options[i] = null;
	// a.forEach(function add_option(item, index) {
	// 	var opt = document.createElement('option');
	// 	// opt.value = i;
	// 	opt.innerHTML = item;
	// 	select.appendChild(opt);
	// 	});
	// }
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
		// "hmu_medicine4": ["","gyn", "medicine", "college"],
		// "hmu_medicine5": ["","gyn", "medicine", "college"],
		// "hmu_medicine6": ["","gyn", "medicine", "college"],
		// "hmu_medicine2": ["","IBS", "MSD", "CVS", "RS", "HP"],
		// "hmu_pharmacy1": ["","phIBS", "biology", "HSDM"],
		// "hmu_pharmacy2": ["","kurdology", "biology", "HSDM"],
		// "hmu_pharmacy3": ["","kurdology", "biology", "HSDM"],
		// "hmu_dentistry1": ["","denIBS", "biology", "HSDM"],
		// "hmu_dentistry2": ["","kurdology", "biology", "HSDM"],
		// "hmu_dentistry3": ["","kurdology", "biology", "HSDM"],
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
		  "hmu_medicine3GUT": ["",  "Anatomy", "Community medicine",	"Embryology",	"Family medicine",	"Histology",	"Medical Education",	"Microbiology",	"Pathology",	"Pharmacology ",	"Physiology",	"Radiology", "Biochemistry", "Stem cell"],
  
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
	function subject_lecname() {
	var a=[];
	subject=document.getElementById("subject").value;
	block=document.getElementById("block").value;
	stage=document.getElementById("stage").value;
	college=document.getElementById("college").value;
	stagecollegeblocksubject = college+stage+block+subject;
	var o={
		"hmu_medicine3GUTAnatomy": ["",	"kidney,suprarenal gland & ureter,bladder and urethra",	"Anatomy of Thyroid and Parathyroid glands",	"female reproductive organs & external genitalia",	"muscles, fascia & peritonium of the pelvis perineum, the perineal region and fossae",	"surface anatomy and surgical incisions in GUS",	"the bony pelvis(male and female)",	"the inguinal region, male reproductive organs & male external genitalis",
],
		"hmu_medicine3GUTCommunity medicine": ["",	"Dietary modifications advised for patients with chronic kidney disease, nephrotic syndrome and urinary stone disease",	"AIDS",	"Prevention of Diabetes Mellitus",	"Public health screening in obs.and gyn",	"Risk Factors for Diabetes Mellitus",	"The epidemiology and prevention of the major sexually transmitted infections including HIV",
],
		"hmu_medicine3GUTEmbryology": ["",	"development of urinary system and clinical correlate",	"Family medicine",	"Antenatal care and screening in pregnancy",

		],
		"hmu_medicine3GUTHistology": ["","Histological structure of male gental tract",	"Histological structure of ovaries, ducts, uterus, cervix, vagina and external genitalia (female genital tract)",	"Histological structure of the kidney, ureter and urinary bladder",
],
		"hmu_medicine3GUTMicrobiology": ["","E. coli , Klebsiella,  Proteus & Enterobacter spp",	"IgA nephropathy and Post streptococcus glomerulonephritis",	"Retroviruses AIDS",	"Immunology of endocrine system",
],
		"hmu_medicine3GUTPathology": ["","benign tumers and malignancy of the breast",	"Diseases Affecting Tubules and Interstitium, Renal Stones, and Cystic Diseases of Kidney",	"Diseases of testis and prostate",	"Diseases of the ovaries",	"Kidney Tumors and Diseases of urinary bladder",	"Non neoplastic diseases of thyroid gland",	"Pathology of Adrenal Gland",	"Thyroid malignancy and Parathyroid Pathology",	"Tubulointerstitial nephritis, cystic diseases of kidney",
],
		"hmu_medicine3GUTPharmacology": ["",	"Corticosteroid drugs",	"Diuretics",	"Drugs for infertility & assisted reproduction",	"Drugs used to treat Diabetes mellitus",	"Drugs used to treat Thyroid diseases",	"Female sex hormones & contraception",	"Treatment of sexually transmitted diseases",	"Treatment of UTI",
],
		"hmu_medicine3GUTPhysiology": ["",	"A Functional Overview of Endocrine System: Hormone Receptors","Acid Base Balance by The Kidney",	"Kidney regulation of sodium and water balance",	"Physiology of Pancreas (Insulin and Glucagon)",	"Physiology of The Adrenal Glands",	"Physiology of Thyroid and Parathroid Glands",	"The Endocrine Role of Placenta and Maintenance of Pregnancy, lactation and menopause",	"Urine Formation (Filtration, Absorption and Secretion)",
],
		"hmu_medicine3GUTRadiology": ["",	"Radiological imaging techniques of the genitourinary tract",	"radiology in obs, and gynecology",	"Imaging of the breast",
],
		"hmu_medicine3GUT": ["",],
		"hmu_medicine3GUT": ["",],
		"hmu_medicine3GUT": ["",],
		"hmu_medicine3GUT": ["",],
		"hmu_medicine3GUTmedicine": ["","lg1", "lg2", "lg3", "sgl1", "sgl2", "sgl3", "ccp1", "ccp2", "ccp3", "cp1", "cp2", "lab1", "lab2"],
		"hmu_pharmacy1phIBSmedicine": ["","lg1", "lg2", "lg3", "sgl1", "sgl2", "sgl3", "ccp1", "ccp2", "ccp3", "cp1", "cp2", "lab1", "lab2"],
		"hmu_dentistry1denIBSmedicine": ["","lg1", "lg2", "lg3", "sgl1", "sgl2", "sgl3", "ccp1", "ccp2", "ccp3", "cp1", "cp2", "lab1", "lab2"],
		"GUTmedicine": ["","lg1", "lg2", "lg3", "sgl1", "sgl2", "sgl3", "ccp1", "ccp2", "ccp3", "cp1", "cp2", "lab1", "lab2"],
  }
	var a=o[stagecollegeblocksubject];
	// console.log (stagecollegeblock);
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
	
// 		function update_lecname() {
// 		var a=[];
// 		subject=document.getElementById("subject").value;
// 		// method=document.getElementById("method").value;
// 		block=document.getElementById("block").value;
// 		stage=document.getElementById("stage").value;
// 		college=document.getElementById("college").value;
// 		stagecollegeblocksubject = college+stage+block+subject;
// 	var o={
// 		"hmu_medicine3GUTmedicine": ["","GUT disease", "GUT problems"],
// 		"hmu_pharmacy1phIBSmedicinelg1": ["","GUT disease", "GUT problems"],
// 		"hmu_dentistry1denIBSmedicinelg1": ["","GUT disease", "GUT problems"],
// 		"GUTmedicinelg1": ["","GUT disease", "GUT problems"],
		
//   }
// 	var a=o[stagecollegeblocksubject];
// 	console.log (stagecollegeblocksubject);
// 	var select = document.getElementById('lname');
// 	var length = select.options.length;
// 	for (i = length-1; i >= 0; i--) select.options[i] = null;
// 	a.forEach(function add_option(item, index) {
// 		var opt = document.createElement('option');
// 		// opt.value = i;
// 		opt.innerHTML = item;
// 		select.appendChild(opt);
// 		});
// 	}
let a = { hmu_medicine: { stages: [{ block: { "gyn": { subjects: { radiology: { lectures: ["lec 1", "lec 2", "lect 3"] } } }, } }], } };

</script>
</body>
</html>
