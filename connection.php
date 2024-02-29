<?php
// $db_server = "localhost";
// $db_user = "root";
// $db_password = "";
// $db_name = "attendancedb";
// $connection = "";

// try {
//   // $connection is considered an object
//   $connection = mysqli_connect(
//     $db_server,
//     $db_user,
//     $db_password,
//     $db_name
//   );

// } catch (mysqli_sql_exception) {
//   echo "database isnt connected!!";

// }

// if ($connection) {
//   echo "database is connected successfully!!";
// }
try{
$db = new PDO('mysql:host=localhost;dbname=attendancedb;charset=utf8', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// echo "db is connected";
}
catch(PDOException $ex) {
echo "Error occured!"; //user friendly message
die ($ex->getMessage());
}
?>