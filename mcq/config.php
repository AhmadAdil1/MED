<?php

require_once 'vendor/autoload.php';

// session_start();

// init configuration
$clientID = '565053405139-5uu0rpeef46qervo141kn7899dcrnd14.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/mcq/login.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// Connect to database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "mcq";

$conn = mysqli_connect($hostname, $username, $password, $database);

