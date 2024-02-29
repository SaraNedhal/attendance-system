<?php
session_start();
include('connection.php');
$user_id = $_SESSION['user_id'];
if(isset($_POST['action'])){
  if($_POST['action'] == 'registerAttendance'){
  $sql = $db->prepare("SELECT check_id FROM check_in WHERE user_id = :user_id AND check_out IS NULL");
  $sql->bindParam(":user_id" , $user_id);
  $sql->execute();
  $result = $sql->fetch(PDO::FETCH_ASSOC);
  if($result){
    echo"You have to checkout before Checking in again!!";
  }else{
  $stmt = $db->prepare('INSERT INTO check_in (user_id,check_in) VALUES(:user_id, NOW())');
  $stmt->bindParam(':user_id' , $user_id);
  $stmt->execute();
  echo "Attendance registered successfully!";
  }
}elseif($_POST['action'] == 'registerDeparture'){
  $query = $db->prepare('UPDATE check_in SET check_out = NOW() WHERE user_id = :user_id AND check_out IS NULL');
  $query->bindParam(':user_id' , $user_id);
  $query->execute();
  echo "Departure registered successfully!";

}
}else{
  echo "cant register";
}


?>