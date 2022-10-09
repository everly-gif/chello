<?php
include './partials/db.php';
if(isset($_GET["id"])){
$id = $_GET["id"];
$query = $mysqli->query("DELETE FROM `employee` WHERE `id`='$id'");
if($query){
    echo "
    <script>alert('Successfully deactivated user');
    window.location='manage-employees.php';
    </script>
    ";
}
else{
    echo "
    <script>alert('Something went wrong, try again..');
    window.location='manage-employees.php';
    </script>
    ";
}
}
else{
    header('location:manage-employees.php');
}
?>