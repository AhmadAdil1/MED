<?php
require_once 'config.php';
echo "<pre>"; print_r($_SESSION); echo "</pre>";


// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  // echo "<pre>";
  // print_r ($google_account_info);
  $userinfo = [
    'token' => $google_account_info['id'],
    'email' => $google_account_info['email'],
    'first_name' => $google_account_info['givenName'],
    'last_name' => $google_account_info['familyName'],
    'gender' => $google_account_info['gender'],
    'full_name' => $google_account_info['name'],
  ];
  // print_r($userinfo);
  // echo $userinfo['email'];
  // echo $userinfo['token'];
    $email = $userinfo['email'];

  // checking if user is already exists in database
  $sql = "SELECT * FROM mcq_users WHERE email ='{$userinfo['email']}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // user is exists
    $userinfo = mysqli_fetch_assoc($result);
    $token = $userinfo['token'];
    // $email = $userinfo['email'];
  } else {
    // user is not exists
    $sql = "INSERT INTO mcq_users (email, name1, name2, name3, gender, gmailid) VALUES ('{$userinfo['email']}', '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['full_name']}','{$userinfo['gender']}', '{$userinfo['token']}')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $token = $userinfo['token'];
    } else {
      echo "User is not created";
      die();
    }
  }

  // save user data into session
  $_SESSION['user_token'] = $token;
} else {
  if (!isset($_SESSION['user_token'])) {
    header("Location: index.php");
    die();
  }

  // checking if user is already exists in database
  $sql = "SELECT * FROM users WHERE token ='{$_SESSION['user_token']}'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    // user is exists
    $userinfo = mysqli_fetch_assoc($result);
  }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
</head>

<body>
  <!-- <img src="<?= $userinfo['picture'] ?>" alt="" width="90px" height="90px"> -->
  <ul>
    <li>id: <?= $userinfo['id'] ?></li>
    <li>Email Address: <?= $userinfo['email'] ?></li>
    <!-- <li>Gender: <?= $userinfo['gender'] ?></li> -->
    <li><a href="logout.php">Logout</a></li>
  </ul>

</body>

</html>