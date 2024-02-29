<?php
session_start();
include('connection.php');

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
  
  <div class="mainFeatures">
    <a href="index.php"class="btn btn-primary return" role="button" > Go Back </a> 
<a href="#"id="registerAttendance" class="btn btn-success" role="button"> Register Attendance </a> 
<a href="#"id="registerDeparture" class="btn btn-danger" role="button"> Register Departure </a> 
</div>
<div id="responseContainer"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    $('#registerAttendance').click(function(){
      $.ajax({ 
        type:"POST",
        url:"handleRegister.php",
        data: { action: "registerAttendance" },
        success: function(response) {
          $('#responseContainer').html('<h3>' + response + '</h3>');           
            }
      });

    });


    $('#registerDeparture').click(function(){
      $.ajax({ 
        type:"POST",
        url:"handleRegister.php",
        data: { action: "registerDeparture" },
        success: function(response) {
          $('#responseContainer').html('<h3>' + response + '</h3>');         
           }
      });

    });

  });
</script>
</body>
</html>
