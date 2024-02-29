<?php
session_start();
include("connection.php");
echo $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Attendance System</h1>
  <div class="mainFeatures">
    <a href="login.php"class="btn btn-primary" role="button"> Login </a> 
<a href="signup.php"class="btn btn-info" role="button"> Signup </a> 
<a href="registerAttendanceAndDeparture.php"class="btn btn-warning" role="button"> register Attendance And Departure </a> 
<a href="dashboard.php"class="btn btn-dark" role="button"> View Attendance Report </a>
<a href="summaryReport.php"class="btn btn-success" role="button">Summary Report </a>
</div> 
  </body>
</html>