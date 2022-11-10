<?php 
// include('vars.php');
include "cnns.php";

define('DB_HOST', 'localhost');

// if (SRVR_VRSN){

//   define('DB_USER', 'waliomer_wali');

//   define('DB_PASS', 'E!M9P&rx3%?s');

//   define('DB_NAME', 'waliomer_ed');

//   }else{
  define('DB_USER', 'root');

  define('DB_PASS', '');

  define('DB_NAME', 'mcq');

  // }

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


$errors = array();
$username = "";
$email = "";
$name1 = "";
$name2 = "";
$name3 = "";
$college = "";
$stage = "";
// $spons_agency = "";
$stu_id = "";
// $role = "";

if (isset($_POST['signup-btn'])) {
  $name1 = $_POST['name1'];
  $name2 = $_POST['name2'];
  $name3 = $_POST['name3'];
  $email = $_POST['email'];
  // $role = $_POST['role'];
  $college = $_POST['college'];
  $stage = $_POST['stage'];
  // $spons_agency = $_POST['spons_agency'];
  $stu_id = $_POST['stu_id'];
  $password = $_POST['password'];
  $passwordConf = $_POST['passwordConf'];

  header("Refresh: 10; url=index.php");  
            echo "Welcome '" . $name1 . "'";
            exit;
  
  


  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
      $errors['email'] = "Email address is invalid";
  }
  

  if (empty($email)){
      $errors['email'] = "Email is required";
  }
  if (empty($name1)){
      $errors['name1'] = "First name is required";
  }
  if (empty($name2)){
    $errors['name2'] = "Second name is required";
}
if (empty($college)){
  $errors['college'] = "college is required";
}
// if (empty($stage)){
//   $errors['stage'] = "stage is required";
// }
  if (empty($stage)){
      $errors['stage'] = "stage is required";
  }
  if (empty($password)){
      $errors['password'] = "password required";
  }
 
  if ($password !== $passwordConf){
      $errors['password'] = "The two password do not match";
  }
   $emailQuery = "SELECT * FROM mcq_users WHERE email=? LIMIT 1";
   $stmt = $conn->prepare($emailQuery);
   $stmt->bind_param('s', $email);
   $stmt->execute();
   $result = $stmt->get_result();
   $userCount = $result->num_rows;
   $stmt->close();
   if ($userCount > 0){
      $errors['email'] = "Email already exists";

   }
    if (count($errors) === 0) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = bin2hex(random_bytes(50));
        $verified = false;

        $sql = "INSERT INTO mcq_users (name1, name2, name3, college, stage, stu_id, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssssss', $name1, $name2, $name3, $college, $stage, $stu_id, $email, $password);
      
      
        if ($stmt->execute()){
         $user_id = $conn->insert_id;
         $_SESSION['id'] = $user_id;
        
         $_SESSION['name1'] = $name1;
         $_SESSION['name2'] = $name2;
         $_SESSION['name3'] = $name3;
         $_SESSION['college'] = $college;
         $_SESSION['stage'] = $stage;
        //  $_SESSION['spons_agency'] = $spons_agency;
         $_SESSION['stu_id'] = $stu_id;
         $_SESSION['email'] = $email;
        //  $_SESSION['role'] = $role;
      //    $_SESSION['verified'] = $verified;

      //    sendVerificationEmail($email, $token);
         

         $_SESSION['message'] = "You are now logged in!";
         $_SESSION['alert-class'] = "alert-success";
         header('Location:index.php');
         exit();

        } else {
            $errors['db_error'] = "Database error: failed to register";
        }
      
        
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register</title>
    
<style>

li { list-style-type: none; }

.form-div {

  margin: 60px auto 60px;

  padding: 25px 15px 10px 15px;

  border: 1px solid #ccc;

  border-radius: 10px;

  font-family:arial, serif;

  font-size: 1.1em; 

}

.form-control:focus { box-shadow: none; }

form p { font-size: .89em; text-align: center; }

.form-div.login {

  margin-top: 100px;

}

.logout {

  color: red;

}

.form-wrapper.login { margin-top: 120px; }

.form-wrapper {

  border: 10px solid #80CED7;

  border-radius: 5px;

  padding: 30px 20px 5px 20px;

}

.form-wrapper.auth .form-title { color: #007EA7; }

.home-wrapper button,

.form-wrapper.auth button {

  background: #007EA7;

  color: white;

}

.home-wrapper {

  margin-top: 150px;

  border-radius: 5px;

  padding: 10px;

  border: 1px solid #80CED7;

}



</style>

</head>
<body>
<div class="container">
<div class="row">
    <div class="col-md-4- offset-md-4 form-div">
    <form action="signup.php" method="post">
      <h3 class="text-center">Register</h3>

      <?php 
      if(count($errors) > 0):
      ?>
     <div class="alert alert-danger">
         <?php foreach($errors as $error): ?>
          <li><?php echo $error; ?></li>
          <?php endforeach; ?>
      </div>
       <?php
       endif;
       ?>
      <div class="form-group">
      <label for="name1">First Name</label>
      <input type="text" name="name1" value="<?php echo $name1; ?>" placeholder="Write your first name" class="form-control form-control-lg" >
      </div>
      <div class="form-group">
      <label for="name2">Second Name</label>
      <input type="text" name="name2" value="<?php echo $name2; ?>" placeholder="Write your second name" class="form-control form-control-lg">
      </div>
      <div class="form-group">
      <label for="name3">Last Name</label>
      <input type="text" name="name3" value="<?php echo $name3; ?>" placeholder="Write your last name" class="form-control form-control-lg">
      </div>

      <div class="form-group">
      <label for="stu_id">student ID</label>
      <input type="text" name="stu_id" value="<?php echo $stu_id; ?>" class="form-control form-control-lg" placeholder="Write your ID (Not required)">
      </div>
      <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Write your email address" class="form-control form-control-lg" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
      </div>
      <!-- $a=array('','Project Manager','Coordinator','Supervisor','Caseworker','IMO','Community Mobilizer'); -->
      <div class="form-group">
     <label for="college">College:</label>
       <select id="college" name="college" value="<?php echo $college; ?>">
       <option value="0"></option>
       <option value="hmu-medicine">Hawler Medical Univeristy - college of medicine</option>
       <option value="hmu-dentistry">Hawler Medical Univeristy - college of Dentistry</option>
       <option value="hmu-Pharmacy">Hawler Medical Univeristy - college of Pharmacy</option>
     
       </select>
      </div>
      <div class="form-group">
      <label for="stage">Stage:</label>
        <select id="stage" name="stage" value="<?php echo $stage; ?>">
        <option value="0"></option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
        <option value="4">Four</option>
        <option value="5">Five</option>
        <option value="6">Six</option>
        </select>
       </div>
      <!-- <div class="form-group">
      <label for="stage">Stage:</label>
      <input type="text" name="stage"  value="<?php echo $stage; ?>" class="form-control form-control-lg" placeholder="Which stage?">
      </div> -->
      
      <!-- <div class="form-group">
      <label for="spons_agency">sponser Agency</label>
      <input type="text" name="spons_agency" value="<?php echo $spons_agency; ?>" class="form-control form-control-lg">
      </div> -->
      
      <div class="form-group" >
      <label for="password">Password</label>
      <input type="password" name="password" class="form-control form-control-lg" pattern=".{6,}" title="Eight or more characters" placeholder="6 or more characters">
      </div>

      <div class="form-group">
      <label for="passwordConf">Confirm Password</label>
      <input type="password" name="passwordConf" class="form-control form-control-lg" placeholder="confirm the pass">
      </div>
      <div class="form-group">
      <button type="submit" name="signup-btn" class="btn btn-primary btn-block btn-lg" >Sign up</button>
      <p class="text-center">Already a member? <a href="login.php">Sign in</a></p>
    </div>
    </form>
    </div>
    </div>
    </div>
   
</body>
</html>