<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function connect_database() {
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "social_media_db";

  $conn = mysqli_connect($servername, $username, $password, $database);
  if (!$conn) {
    //echo "Connected Failed";
    die("Connection failed: " . mysqli_connect_error());
  } else {
    //echo "Connected successfully";
    return $conn;
    
  }
}
// function connect_database() {
//   $servername = "dvlp-db.c5owecj5w07b.us-east-1.rds.amazonaws.com";
//   $username = "pws-translate";
//   $password = "<EZ{hXmq{XdH";
//   $database = "db_1";

//   $conn = mysqli_connect($servername, $username, $password, $database);
//   if (!$conn) {
//     //echo "Connected Failed";
//     die("Connection failed: " . mysqli_connect_error());
//   } else {
//     //echo "Connected successfully";
//     return $conn;
    
//   }
// }
