<?php 
// include('vars.php');

include "cnns.php";

define('DB_HOST', 'localhost');
// ob_start();
// if (!isset($_SESSION)) {
// 	session_start();
// // 	}	
// echo "<pre>"; print_r($_SESSION); echo "</pre>";
// echo "<pre dir=ltr>"; print_r($_REQUEST); echo "</pre>";

// if (SRVR_VRSN){

//   define('DB_USER', 'waliomer_wali');

//   define('DB_PASS', 'E!M9P&rx3%?s');

//   define('DB_NAME', 'waliomer_ed');

//   }else{
  define('DB_USER', 'root');

  define('DB_PASS', '');

  define('DB_NAME', 'mcq');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);



if ($conn->connect_error) {

    die('Database error:' . $conn->connect_error);

}

$errors = array();



$username = "";

// $email = "";

$name1 = "";

$name2 = "";

$errors=check_newlogin($errors, $conn);



function check_newlogin($errors, $conn) {

if (isset($_POST['login-btn'])) {

    $username = $_POST['username'];
    
    $password = $_POST['password'];

    if (empty($password)){

      $errors['password'] = "password required";

      }

    if (count($errors) === 0){

        $sql = "SELECT * FROM mcq_users WHERE email=? LIMIT 1";

        // echo $sql;

    $stmt = $conn->prepare($sql);

    $stmt->bind_param('s', $username);

    $stmt->execute();

    $result = $stmt->get_result();

    $user = $result->fetch_assoc();

    // echo "$password,$user[password]";

        // Normal login

        if(password_verify($password, $user['password'])){
        // ob_start();
        //  if (!isset($_SESSION)) session_start();		

            $_SESSION['id'] = $user['id'];

            $_SESSION['email'] = $user['email'];

            // $_SESSION['verified'] = $user['verified'];

            $_SESSION['name1'] = $user['name1'];

            $_SESSION['name2'] = $user['name2'];

            $_SESSION['college'] = $user['college'];

            $_SESSION['stage'] = $user['stage'];
            $_SESSION['role'] = $user['role'];
            // $_SESSION['id'] = $user['id'];

            // echo "<pre>"; print_r($_SESSION); echo "</pre>";

            header('location: index.php');
         

        } else {

        $errors['login_fail'] = "Wrong credentails";

        }

    }

    }

return $errors;

}

?>

<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta name='viewport' content='width=device-width, initial-scale=1.0'>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <link rel="stylesheet" href="style.css">

  <title>Login</title>

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

    <div class="col-md-4- offset-md-4 form-div login">

    <form action="login.php" method="post">

      <h3 class="text-center">Login</h3>

<?php

//echo "line: ". __LINE__ . "<br>";

if(count($errors)>0){

  echo "<div class='alert alert-danger'>";

  foreach($errors as $error) echo "<li>$error</li>";

  echo "</div>";

  }

?>

      <div class="form-group">

      <label for="username">Username or email </label>

      <input type="text" name="username" value="<?php echo $username; ?>" class="form-control form-control-lg">

      </div>

    

      <div class="form-group">

      <label for="password">Password</label>

      <input type="password" name="password" class="form-control form-control-lg">

      </div>

  

  

      <div class="form-group">

      <button type="submit" name="login-btn" class="btn btn-primary btn-block btn-lg" >login </button><br>

      <!-- <p class="text-center">login with <a href="glogin.php">Google</a></p> -->

      <div style="font-size: 0.8em; text-align: center;"> New member? <a href="signup.php">Sign-up here</a></div>

      <!-- <div style="font-size: 0.8em; text-align: center;"><a href="../RegistrationLogin/login.php" class="admin">Admin</a></div> -->

    </div>

    </form>

    </div>

    </div>

    </div>

</body>

</html>

