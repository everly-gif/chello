<?php

include './partials/db.php';

if(isset($_POST["login_submit"])){
  $role = false;
  $email= mysqli_real_escape_string($mysqli,$_POST['email']);
  $password= mysqli_real_escape_string($mysqli,$_POST['password']);
  $employer = $mysqli->query("SELECT `mail_id` FROM `employer` WHERE `mail_id` = '$email'");
  $employee = $mysqli->query("SELECT `mail_id` FROM `employee` WHERE `mail_id` = '$email'");
  if(mysqli_num_rows($employer)>0) $role = 'employer' ;
  elseif (mysqli_num_rows($employee)>0) $role = 'employee';
  if($role){
    $details = $mysqli->query("SELECT `id`,`mail_id`,`password` FROM $role WHERE `mail_id` = '$email'");
    $data = mysqli_fetch_assoc($details);
    $verify = password_verify($password,$data['password']);
  
    if($verify){
    session_start();
    $_SESSION['logged_in']=true;
    $_SESSION['user_id'] = $data['id'];
    $_SESSION['username'] = $data['mail_id'];
    $_SESSION['role'] = $role;
    echo "<script>alert('Successfully logged in... ');</script>";
    //todo if employer redirect to dashboard else redirect to task board
    }
    else{
      echo "<script>alert('Wrong credentials, please try again... ');</script>";
    }
  }
  else echo "<script>alert('No registered account on this email ... ');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css"/>
</head>
<body>
<?php include './partials/header.php' ;?>
<div class="parent-cont">
    <form method="post" class="form">
      <h1>Login</h1>
      <input type = "text" placeholder="Enter username/email" name="email"/>
      <input type= "password" placeholder="Enter password" name="password"/><br>
      <button type="submit" name="login_submit">Login</button>
      <p>Don't have an account?<a href="sign-up.php"> Create new account</a></p>
    </form>
</div>
</body>
</html>