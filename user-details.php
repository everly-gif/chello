<?php

session_start();
include './partials/db.php';
if(isset($_SESSION['logged_in'])){
$id = $_SESSION['user_id'];
$table = $_SESSION['role'];
}
else{
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <title>User Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/user-details.css"/>
</head>
<body>
<?php include './partials/header.php'; ?>
<h1 class="heading">User Details</h1>
<div class="parent-cont">
<?php
if($table == 'employee'){
    $query = $mysqli->query("SELECT `name`,mail_id,contact,department,joining_date FROM $table WHERE `id` = $id");
    while($data = mysqli_fetch_assoc($query)){
        echo "<div class='info-cont'>
        <h5>Name    : <span style='color:#1746A2;'>".$data['name']."</span></h5>
        <h5>Email   : <span  style='color:#1746A2;'>".$data['mail_id']."</span></h5>
        <h5>Contact : <span  style='color:#1746A2;'>".$data['contact']."</span></h5>
        <h5>Department : <span  style='color:#1746A2;'>".$data['department']."</span></h5>
        <h5>Joining Date : <span  style='color:#1746A2;'>".$data['joining_date']."</span></h5>
        <a class='btn btn-primary' href='update-user-details.php'>Update Details</a>
        </div>";
    }
}
else{
    $query = $mysqli->query("SELECT `employer_name`,mail_id,contact FROM $table WHERE `id` = $id");
    while($data = mysqli_fetch_assoc($query)){
        echo "<div class='info-cont'>
        <h5>Name    : <span  style='color:#1746A2;'>".$data['employer_name']."</span></h5>
        <h5>Email   : <span  style='color:#1746A2;'>".$data['mail_id']."</span></h5>
        <h5>Contact : <span  style='color:#1746A2;'>".$data['contact']."</span></h5>
        <a class='btn btn-primary' href='update-user-details.php'>Update Details</a>
        </div>";
    }
}
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>