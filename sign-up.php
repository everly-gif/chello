<?php
include './partials/db.php';

if(isset($_POST["sign-up"])){
  $name = mysqli_real_escape_string($mysqli,$_POST['name']);
  $email= mysqli_real_escape_string($mysqli,$_POST['email']);
  $contact= mysqli_real_escape_string($mysqli,$_POST['contact']);
  $password= mysqli_real_escape_string($mysqli,$_POST['password']);
  $confPassword= mysqli_real_escape_string($mysqli,$_POST['confirmPassword']);

  if($password === $confPassword){
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $unique = $mysqli->query("SELECT `mail_id` FROM `employer` WHERE `mail_id`='$email' ");
    if(mysqli_num_rows($unique)==0){
    $query = $mysqli->query("INSERT INTO `employer` VALUES (NULL,'$name','$email','$contact','$hash')");
    if($query){
       echo "<script>alert('Successfully registered company account !!');</script>";
       header('location:login.php');
    }
    else echo "<script>alert('Something went wrong , please try again ... ');</script>";
    }
    else echo "<script>alert('Company already registered with same email ... ');</script>";
  }
  else{
    echo "<script>alert('Credentials don't match, please try again ... ');</script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel ="stylesheet" href="./css/login.css"/>
</head>
<body>
  <?php include './partials/header.php';?>
  <div class="parent-cont">
    <form method="post">
      <h1>Sign Up</h1>
      <input type="text" placeholder="Enter your company name" name="name" required/>
      <input type="email" placeholder="Enter your company email" name="email" required/>
      <input type="text" placeholder="Enter your company contact number" name="contact" required/>
      <input type="password" placeholder="Enter your password" name="password" required/>
      <input type="password" placeholder="Re-Enter your password" name="confirmPassword" required/>
      <button type="submit" name="sign-up">Create My Account</button>
      <p>Already have an account?<a href="login.php"> Login</a></p>
    </form>
  </div>
</body>
</html>