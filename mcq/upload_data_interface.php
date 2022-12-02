<?php
include "cnns.php";
require_once 'not_loggedin.php';

//if login in session is not set
if (!isset($_SESSION['email'])) {
  header("Location: login.php");
}
// echo "<pre>";print_r($_SESSION);echo "</pre>";
// echo "<pre dir=ltr>"; print_r($_REQUEST); echo "</pre>";
if(isset($_REQUEST['role_to'])) $_SESSION['role']=$_REQUEST['role_to'];
$role = $_SESSION['role'];
if ($role != 1 && $role != 2 ){
  die();
}
?>
<!-- Form interface -->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>MCQ - upload Data</title>
  <html>

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <style>
    input[type=text],
    select {
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
#backgroundofans
    {
      border-radius: 5px;
      background-color: #f2f2f2;
      /* padding: 20px; */
    }
  </style>

</head>
<?php
  $stage = $_SESSION['stage'];
  echo"<body style='padding-bottom: 40px;' onload='get_blocks_options(\"$stage\")'>";

  // welcomming the admin
  echo "Welcome $_SESSION[name1] at stage $_SESSION[stage] ";
  ?>
  <br>
  <a href=index.php>index</a>
  <h1>Question input</h1>
  <form action=upload_data.php method=POST/GET>
    <label for="block_options">Choose a block:</label>
    <select name="block_options" id="block_options" style="width: 150px;" onchange="get_subject_options()" required>
      <option value=""></option>
    </select>

    <br><label for="subject_options">Choose a subjects:</label><select name="subject_options" id="subject_options" style="width: 150px;" onchange="get_lecname_options()" required>
      <option value=""></option>
    </select>

    <br><label for='lec_name'>Choose a lecture name:</label><select name="lec_name" id="lec_name" style="width:150px;" required>
      <option value=""></option>
    </select>
    <br>
    <label for="qname">Question:</label><br>
    <textarea type="text" id="qname" name="qname" rows="4" cols="50" style="border: 2px solid;" placeholder="Write down the question" required></textarea><br><br>
    <div id=backgroundofans>
      <input type='radio' id='cor_ans' name="cor_ans" value='on1' />
      <label for="ans_aname">Answer A:</label>
      <input type="text" id="ans_aname" name="ans_aname" required><br><br>
    </div>
    <div id=backgroundofans>
      <input type='radio' id='cor_ans' name="cor_ans" value='on2' />
      <label for="ans_bname">Answer B:</label>
      <input type="text" id="ans_bname" name="ans_bname" required><br><br>
    </div>
    <div id=backgroundofans>
      <input type='radio' id='cor_ans' name="cor_ans" value='on3' />
      <label for="ans_cname">Answer C:</label>
      <input type="text" id="ans_cname" name="ans_cname" required><br><br>
    </div>
    <div id=backgroundofans>
      <input type='radio' id='cor_ans' name="cor_ans" value='on4' />
      <label for="ans_dname">Answer D:</label>
      <input type="text" id="ans_dname" name="ans_dname" required><br><br>
    </div>
    <div id=backgroundofans>
      <input type='radio' id='cor_ans' name="cor_ans" value='on5' />
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


  <script>
    function get_blocks_options(stage) {
      var sl = document.getElementById("block_options");
      // console.log(sl);
      for (const i in blocks) {
        let va = blocks[i].split("|");
        if (va[2] == stage) {
          var option = document.createElement("option");
          option.value = va[0];
          option.text = va[1];
          sl.add(option);
        }
      }
    }

    function get_subject_options() {
      // We have to delete all the options then add new options
      var selectElement = document.getElementById("subject_options");
      while (selectElement.length > 0) {
        selectElement.remove(0);
      }
      var adding = document.getElementById("subject_options");
      var added = document.createElement("option");
      added.text = "";
      adding.add(added);
      var c = document.getElementById('block_options').value;
      var sl1 = document.getElementById("subject_options");
      for (const i in subjects) {
        let va = subjects[i].split("|");
        if (va[2] == c) {
          var option = document.createElement("option");
          option.value = va[0];
          option.text = va[1];
          sl1.add(option);
        }
      }
    }

    function get_lecname_options() {
      var selectElement2 = document.getElementById("lec_name");
      while (selectElement2.length > 0) {
        selectElement2.remove(0);
      }
      var addings = document.getElementById("lec_name");
      var addeds = document.createElement("option");
      addeds.text = "";
      addings.add(addeds);
      let d = document.getElementById('subject_options').value;
      var sl2 = document.getElementById("lec_name");
      for (const i in lec_names) {
        let va = lec_names[i].split("|");
        if (va[2] == d) {
          var option = document.createElement("option");
          option.value = va[0];
          option.text = va[1];
          sl2.add(option);
        }
      }
    }
  </script>
</body>

</html>