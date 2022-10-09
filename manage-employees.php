<?php
session_start();

include './partials/db.php';

if(!isset($_SESSION['logged_in'])){
  header('location:index.php');
}
if($_SESSION['role']=="employee"){
  header('location:index.php');
}

if(isset($_POST['new_employee'])){
    $name = mysqli_real_escape_string($mysqli,$_POST['name']);
    $email= mysqli_real_escape_string($mysqli,$_POST['email']);
    $contact= mysqli_real_escape_string($mysqli,$_POST['contact']);
    $department= mysqli_real_escape_string($mysqli,$_POST['department']);
    $date = mysqli_real_escape_string($mysqli,$_POST['joining_date']);
    $date = date("Y-m-d", strtotime($date) );
    $employer_id = $_SESSION['user_id'];
    //convert to format
    $unique = $mysqli->query("SELECT `mail_id` FROM `employee` WHERE `mail_id`='$email' ");
    if(mysqli_num_rows($unique)==0){
    $password = (time());
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $query = $mysqli->query("INSERT INTO `employee` VALUES(NULL,'$name','$email','$contact','$department','$date','$hash_password','$employer_id')");
    if ($query) echo "<script>alert('Employee added successfully ... ');alert('Please send your employee the temporary password : ".$password."');</script>"; else echo "<script>alert('Something went wrong');</script>";
    }
    else echo "<script>alert('Employee already exists ...');</script> ";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Dashboard - Employee Management</title>
    <link href="./css/dashboard.css" rel="stylesheet">
</head>
<body>
<?php include './partials/header.php'?>
<div class="parent-cont">
<h1>Manage employees</h1>
    <!-- Button trigger modal -->
<div class="btn-cont"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add New Employee +
</button></div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a New Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method = "post">
        <input type="text" placeholder="Enter employee name" name="name" required/>
        <input type="email" placeholder="Enter employee email" name="email" required/>
        <input type="text" placeholder="Enter employee contact number" name="contact" required/>
        <input type="text" placeholder="Enter employee department" name="department" required/>
        <input type="date" placeholder="Enter employee joining date" name="joining_date" required/>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="new_employee" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Mail Id</th>
            <th>Contact Number</th>
            <th>Department</th>
            <th>Joining Date</th>
            <th>View Statistics</th>
            <th>Update Details</th>
            <th>Deactive Account</th>
        </tr>
    <?php
    $employer = $_SESSION['user_id'];
    $query = $mysqli->query("SELECT `id`,`name`,`mail_id`,`contact`,`department`,`joining_date` FROM `employee` WHERE `employer_id`= '$employer' ORDER BY id");
    while($data = mysqli_fetch_assoc($query)){
        echo '<tr>
        <td>'.$data["id"].'</td>
        <td>'.$data["name"].'</td>
        <td>'.$data["mail_id"].'</td>
        <td>'.$data["contact"].'</td>
        <td>'.$data["department"].'</td>
        <td>'.$data["joining_date"].'</td>
        <td><a class="btn btn-primary" href="view-statistics.php?id='.$data["id"].'">View</a></td>
        <td><a class="btn btn-success" href="update-employee.php?id='.$data["id"].'">Update</a></td>
        <td><a class="btn btn-danger" href="deactivate.php?id='.$data["id"].'">Deactivate</a></td>
        </tr>';
    }
    ?>
    </table>
    
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>