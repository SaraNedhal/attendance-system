<?php
session_start();
include("connection.php");
$user_id = $_SESSION['user_id'];
try{
$stmt = $db->prepare("SELECT U.user_id, CONCAT(U.first_name , ' ' , U.last_name) AS Fullname,  DATE(C.check_in) AS attendance_date,
MIN(C.check_in) AS first_check_in,
MAX(C.check_out) AS last_check_out
FROM
users U
INNER JOIN
check_in C ON U.user_id = C.user_id
WHERE
C.check_out IS NOT NULL  AND U.user_id = $user_id
GROUP BY
U.user_id, DATE(C.check_in)
ORDER BY
attendance_date DESC");
$stmt->execute();
$reportData = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // print_r($reportData);
} catch (PDOException $e) {
    die("Could not fetch report: " . $e->getMessage());
}

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
  <h1>Summary Report</h1>
<div class="mainFeatures">
    <a href="index.php"class="btn btn-primary return" role="button" > Go Back </a> 
</div>
<table class="table table-primary table-striped">
  <tr>
    <th>User ID</th>
    <th> Full name</th>
    <th>Date</th>
    <th>First Check-In</th>
    <th>Last Check-Out</th>
    <th>Total hours</th>
  </tr>
  <?php foreach ($reportData as $row) {
     $date1 = $row['first_check_in'];
     $date2 = $row['last_check_out'];
   
     $start_date = new DateTime($date1);
     $difference = $start_date->diff( new DateTime($date2));
   
 ?>
      <tr>
        <td><?php echo $row['user_id'] ?></td>
        <td><?php echo $row['Fullname'] ?></td>
        <td><?php echo $row['attendance_date'] ?></td>
        <td><?php echo $row['first_check_in'] ?></td>
        <td><?php echo $row['last_check_out']?></td>
        <td><?php echo $difference->h.' Hours' . $difference->i . 'Minutes' ?></td>
      </tr>
  <?php } ?>
</table>
</body>
</html>

