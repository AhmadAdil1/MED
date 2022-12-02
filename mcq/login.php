<?php 
//  echo 'PHP version: ' . phpversion();
include "cnns.php";
require_once 'not_loggedin.php';
require_once 'config.php';

// echo "<pre>"; print_r($_SESSION); echo "</pre>";
/*
If get code -> 
  check db: if user_exist() -> login() else add_user()
  add session
  redirect to index
*/
// echo "<a href=logout.php>logout</a> ";
// echo "<a href=index.php>index</a> ";


// if (isset($_SESSION['email'])){
// header("Location: index.php");
// }else {
//   echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
// }

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
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name1'] = $user['name1'];
            $_SESSION['name2'] = $user['name2'];
            $_SESSION['college'] = $user['college'];
            $_SESSION['stage'] = $user['stage'];
            $_SESSION['role'] = $user['role'];
            header('location: index.php');
        } else {
        $errors['login_fail'] = "Wrong credentails";
        }
    }
    }
return $errors;
}
// echo "<pre>"; print_r($_SESSION); echo "</pre>";
//   // authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  // $_SESSION["token"] = $token;
  echo "<pre>"; print_r($token); echo "</pre>";
  $client->setAccessToken($token['access_token']);
  
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $userinfo = [
    'email' => $google_account_info['email'],
    'first_name' => $google_account_info['givenName'],
    'last_name' => $google_account_info['familyName'],
    'gender' => $google_account_info['gender'],
    'full_name' => $google_account_info['name'],
    'picture' => $google_account_info['picture'],
    'verifiedEmail' => $google_account_info['verifiedEmail'],
    'token' => $google_account_info['id'],
  ];
  check_user($conn, $userinfo);
  echo "line 118 <br>";
  
  //   // save user data into session
//   $_SESSION['user_token'] = $token;
//   // $_SESSION['email'] = $email;
// $sql = "SELECT * FROM mcq_users WHERE email ='{$userinfo['email']}'";
// $result = mysqli_query($conn, $sql);
// if (mysqli_num_rows($result) > 0) {
//   // user is exists
//   $userinfo = mysqli_fetch_assoc($result);
// }
}
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <link rel="stylesheet" href="lib/bootstrap.min.css">
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

  function check_user($conn, $userinfo){
    $sql = "SELECT * FROM mcq_users WHERE email ='$userinfo[email]'";
    // echo "$sql<br>";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = $result->fetch_assoc()) {
      // user is exists
      echo "index <br>";
      print_r($userinfo);
      echo $row['email']; 
      // $userinfo = mysqli_fetch_assoc($result);
      $_SESSION['email'] = $userinfo['email'];
      $_SESSION['id'] = $row['id'];
      // $_SESSION['verified'] = $user['verified'];
      $_SESSION['name1'] = $row['name1'];
      $_SESSION['name2'] = $row['name2'];
      $_SESSION['college'] = $row['college'];
      $_SESSION['stage'] = $row['stage'];
      $_SESSION['role'] = $row['role'];
// echo "<pre>"; print_r($_SESSION); echo "</pre>";
      // echo "<meta http-equiv='refresh' content='1;url=index.php'>";
  // echo "<META HTTP-EQUIV='Refresh' Content='0; URL=index.php'>";
  header("Location: index.php");
      // $college = $userinfo['college'];
      // echo $college;
      // $stage = $userinfo['stage'];
      // $role = $userinfo['role'];
    }} else {
      // user is not exists
      $sql = "INSERT INTO mcq_users (email, name1, name2, name3, token) VALUES ('{$userinfo['email']}', '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['full_name']}', '{$userinfo['token']}')";
      $result = mysqli_query($conn, $sql);
      // echo "<meta http-equiv='refresh' content='0;url=index.php>";
      if ($result) {
        
          $_SESSION['email'] = $userinfo['email'];
          // $_SESSION['id'] = $userinfo['id'];
          $_SESSION['college'] = $userinfo['college'];
          $_SESSION['name1'] = $userinfo['first_name'];
          $_SESSION['name2'] = $userinfo['last_name'];
          $_SESSION['role'] = $userinfo['role'];
          $_SESSION['stage'] = $userinfo['stage'];
       
        header("Location: index.php");
      } else {
        echo "User is not created";
        die();
      }
    }
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
     <?php
      echo "<a href='".$client->createAuthUrl()."'><img width='300' height='60' src='gmaill.png'></a>";
        // echo "<button name='login-btn' class='btn btn-primary btn-block btn-lg'><a href='".$client->createAuthUrl()."'></a>Google Login</button>";
      ?>

      <div style="font-size: 0.8em; text-align: center;"> New member? <a href="signup.php">Sign-up here</a></div>
    </div>
    </form>
    </div>
    </div>
    </div>
</body>
</html>

