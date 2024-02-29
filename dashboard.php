<?php
include('connection.php');
session_start();
$user_id = $_SESSION["user_id"];
// print_r($_SESSION);
// echo $user_id;
$stmt = $db->prepare("SELECT C.*, U.* FROM check_in C 
INNER JOIN users U ON C.user_id = U.user_id 
WHERE C.user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// print_r($result);

// $query = $db->prepare("SELECT CO.*, U.* FROM check_out CO
// INNER JOIN users U ON CO.user_id = U.user_id 
// WHERE CO.user_id = :user_id");
// $query->bindParam(':user_id', $user_id);
// $query->execute();
// $result2 = $query->fetchAll(PDO::FETCH_ASSOC);
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
</div>
<table class="table table-primary table-striped">
  <tr>
    <th>First name</th>
    <th>Last name</th>
    <th>Attendance</th>
    <th>Departure</th>
  </tr>
  <?php foreach ($result as $row) { ?>
      <tr>
        <td><?php echo $row['first_name'] ?></td>
        <td><?php echo $row['last_name'] ?></td>
        <td><?php echo date('l', strtotime($row['check_in'])) . ' ' . date('Y-m-d H:i:s', strtotime($row['check_in'])) ?></td>
        <td><?php echo date('l', strtotime($row['check_out'])) . ' ' . date('Y-m-d H:i:s', strtotime($row['check_out'])) ?></td>
      </tr>
  <?php } ?>
</table>
</body>
</html>