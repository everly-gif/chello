<?php

session_start();

include './partials/db.php';

$table = $_SESSION['role'];

if(!isset($_SESSION['logged_in'])){
  header('location:index.php');
}
$id = $_SESSION['user_id'];
if(isset($_POST["update_user_employer"]) || isset($_POST["update_user_employee"])){
    $name = mysqli_real_escape_string($mysqli,$_POST['name']);
    $contact= mysqli_real_escape_string($mysqli,$_POST['contact']);
    $query = false;
    $column=false;
    if(isset($_POST["password"])){
        $password= mysqli_real_escape_string($mysqli,$_POST['password']);
        $password = password_hash($password,PASSWORD_DEFAULT);
        if($table == 'employer') $column = 'employer_name'; else $column = 'name';
        $query = $mysqli->query("UPDATE $table SET `$column`='$name' ,`contact` = '$contact',`password` = '$password' WHERE `id`= '$id'");
    }
    else{
        $query = $mysqli->query("UPDATE $table SET `$column`='$name' , `contact` = '$contact' WHERE `id`= '$id'");
    }
    if ($query) echo "<script>alert('Details updated successfully ... ');</script>";
    else echo "<script>alert('Something went wrong');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chello - Update Details</title>
    <link rel="stylesheet" href="./css/login.css"/>
</head>
<body>
<?php include './partials/header.php';
$id = $_SESSION['user_id'];
if($table == 'employer'){
$query = $mysqli->query("SELECT employer_name,mail_id,contact FROM $table WHERE `id` = '$id'");
$result = mysqli_fetch_assoc($query);
echo '
<div class="parent-cont">
<form method="post">
<h1>Update Details</h1>
<input type="text" placeholder="Enter name" name="name" value="'.$result["employer_name"].'"required/>
<input type="email" placeholder="Enter email" name="email" value="'.$result["mail_id"].'"disabled/>
<input type="text" placeholder="Enter contact number" name="contact" value="'.$result["contact"].'" required/>
<input type="password" placeholder="Enter password" name="password"/>
<button type="submit" name="update_user_employer">Update</button>
</form>
</div>';

}

else{
    $query = $mysqli->query("SELECT `name`,mail_id,contact,department,joining_date FROM $table WHERE `id` = '$id'");
$result = mysqli_fetch_assoc($query);
echo '
<div class="parent-cont">
<form method="post">
<h1>Update Details</h1>
<input type="text" placeholder="Enter name" name="name" value="'.$result["name"].'"required/>
<input type="email" placeholder="Enter email" name="email" value="'.$result["mail_id"].'"disabled/>
<input type="text" placeholder="Enter contact number" name="contact" value="'.$result["contact"].'" required/>
<input type="text" placeholder="Enter department" name="department" value="'.$result["department"].'" disabled/>
<input type="text" placeholder="Enter department" name="joining_date" value="'.$result["joining_date"].'" disabled/>
<input type="password" placeholder="Enter password" name="password"/>
<button type="submit" name="update_user_employee">Update</button>
</form>
</div>';
}


?>
</body>
</html>