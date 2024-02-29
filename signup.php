<?php
session_start();
include("connection.php");
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
<div class="formContainer">
  <h1>Signup</h1>
<form method="post" action="">
  <div class="mb-3">
    <label for="username" class="form-label">username</label>
    <input type="username" class="form-control" id="username" name="username" aria-describedby="emailHelp">

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
 
  <div class="mb-3">
    <label for="firstname" class="form-label">first name</label>
    <input type="text" class="form-control" id="firstname" name="firstname">
  </div>
 
  <div class="mb-3">
    <label for="lastname" class="form-label">lastname</label>
    <input type="text" class="form-control" id="lastname" name="lastname">
  </div>
 
  <button type="submit" name="signup" class="btn btn-primary signup" >Submit</button>
</form>
</div>
</body>
</html>
<?php
if (isset($_POST['signup'])) {
  $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
  $first_name = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_SPECIAL_CHARS);
  $last_name = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_SPECIAL_CHARS);
  if(trim($username)=="" ||trim($password)==""  || trim($first_name)=="" || trim($last_name)==""  )
  echo "missing info";
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  try{
  $stmt = $db->prepare("INSERT INTO users (username, password, first_name, last_name) VALUES(?,?,?,?)");

 $stmt->execute([$username, $hashed_password, $first_name, $last_name]);
 $user_id = $db->lastInsertId();
 $_SESSION['user_id'] = $user_id; 
  header('Location:index.php');
    } catch (PDOException $e) {
      // Handle error
      echo "Error: " . $e->getMessage();
    }
  }  
  
?>