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
  <h1>Login</h1>
<form method="post" action="">
<div class=" mb-3">
    <label for="username" class="form-label">username</label>
    <input type="username" class="form-control" id="username" name="username" aria-describedby="emailHelp">
</div>

  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
 
 
  <a href="signup.php" class="navigateSignup">Don't have account, sign up</a>
  <button type="submit" name="login" class="btn btn-primary login">Submit</button>
</form>

</div>
</body>
</html>
<?php
if(isset($_POST['login'])){
  $username = filter_input(INPUT_POST , "username" , FILTER_SANITIZE_SPECIAL_CHARS);
  $password = filter_input(INPUT_POST , "password" , FILTER_SANITIZE_SPECIAL_CHARS);

  if(trim($username)=="" ||trim($password)=="")
  echo "missing info";

  $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
  
  $stmt->bindParam(':username' , $username);

  $stmt->execute();

  $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
if($user_info){
  if(password_verify($password , $user_info['password'])){
    $_SESSION['user_id'] = $user_info['user_id'];
    header('Location: index.php');
  }else{
    echo "username or password are incorrect";
  }
}else{
  echo "username or password are incorrect";

}

}
?>