<?php


session_start();
include './partials/db.php';

if(!isset($_SESSION['logged_in'])){
    header('location:index.php');
  }
  if($_SESSION['role']=="employee"){
    header('location:index.php');
  }
if(isset($_GET['id']))
$id = $_GET['id'];
else header('location:index.php');
if(isset($_POST['new_employee'])){
    $name = mysqli_real_escape_string($mysqli,$_POST['name']);
    $email= mysqli_real_escape_string($mysqli,$_POST['email']);
    $contact= mysqli_real_escape_string($mysqli,$_POST['contact']);
    $department= mysqli_real_escape_string($mysqli,$_POST['department']);
    $date = mysqli_real_escape_string($mysqli,$_POST['joining_date']);
    $date = date("Y-m-d", strtotime($date) );
    $employer_id = $_SESSION['user_id'];
    //convert to format
    $update = $mysqli->query("UPDATE `employee` SET `name` = '$name',mail_id = '$email',contact = '$contact', department = '$department',joining_date = '$date' WHERE `id`='$id' AND employer_id = '$employer_id'");
    if ($update) echo "<script>alert('Employee updated successfully ... ');window.location='manage-employees.php'</script>";
    else echo "<script>alert('Something went wrong');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chello - Update Employee</title>
    <link rel="stylesheet" href="./css/login.css"/>
</head>
<body>
<?php include './partials/header.php';?>

<?php
$query = $mysqli->query("SELECT `name`,mail_id,contact,department,joining_date FROM employee WHERE id = '$id'");
$result = mysqli_fetch_assoc($query);
echo '
<div class="parent-cont">
<form method = "post">
        <h1>Update Employee</h1>
        <input type="text" placeholder="Enter employee name" name="name" value="'.$result["name"].'"required/>
        <input type="email" placeholder="Enter employee email" name="email" value="'.$result["mail_id"].'"required/>
        <input type="text" placeholder="Enter employee contact number" name="contact" value="'.$result["contact"].'" required/>
        <input type="text" placeholder="Enter employee department" name="department" value="'.$result["department"].'" required/>
        <input type="date" placeholder="Enter employee joining date" name="joining_date" value="'.$result["joining_date"].'" required/>
        <button type="submit" name="new_employee" class="btn btn-primary">Save changes</button>
</form>
</div>
'
?>
</body>
</html>