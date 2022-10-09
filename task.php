<?php
session_start();

include './partials/db.php';

if(!isset($_SESSION['logged_in'])){
  header('location:index.php');
}
if($_SESSION['role']=="employer"){
  header('location:index.php');
}

if(isset($_POST['new_task'])){
    $desc = mysqli_real_escape_string($mysqli,$_POST['desc']);
    $type= mysqli_real_escape_string($mysqli,$_POST['type']);
    $start_time= mysqli_real_escape_string($mysqli,$_POST['start_time']);
    $total_time= mysqli_real_escape_string($mysqli,$_POST['total_time']);
    $employee_id = $_SESSION['user_id'];
    $start_time = date('Y-m-d H:i:s', strtotime($start_time)); 
    $now = new DateTime();
    $current_date = $now->format('Y-m-d H:i:s');
    $employee_id = $_SESSION['user_id'];
    $query = $mysqli->query("INSERT INTO `task` VALUES(NULL,'$desc','$type','$start_time','$total_time','$employee_id')");
    if ($query) echo "<script>alert('Task added successfully ... ');</script>"; 
    else echo "<script>alert('Something went wrong, try again ...');</script> ";
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./css/dashboard.css" rel="stylesheet"/>
    <title>Dashboard - Employee Management</title>
</head>
<body>
<?php include './partials/header.php'?>
<h1 class="heading"> Manage Tasks</h1>
<div class="btn-cont" style="margin-right:20px;"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add a task +
</button></div>
<div class="graph-cont">
<div  id="parent-cont-1">
  <canvas id="pieChart1" width="300px" height="300px"></canvas>
</div>
<div  id="parent-cont-2">
  <canvas id="pieChart2" width="300px" height="200px">not found</canvas>
</div>
<div  id="parent-cont-3" >
  <canvas id="barChart"  width="500px" >not found</canvas>
</div>
</div>
<div class="parent-cont">
    <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method = "post">
        <input type="text" placeholder="Enter task description" name="desc" required/>
        <select name="type" required>
            <option disabled selected >Select task type</option>
            <option>Break</option>
            <option>Work</option>
            <option>Meeting</option>
        </select>
        <input type="datetime-local" name="start_time" max="<?php $now = new DateTime(); $current_date = $now->format('Y-m-d'); echo $current_date." 23:59:00";?>" onkeydown="return false" required/>
        <input type="number"  placeholder="Enter time taken in (minutes)" min = 1 name="total_time" required/>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="new_task" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <table>
        <tr>
            <th>Task description</th>
            <th>Task type</th>
            <th>Starting Time</th>
            <th>Time taken in(min)</th>
        </tr>
    <?php
    $employee = $_SESSION['user_id'];
    $query = $mysqli->query("SELECT `id`,`desc`,`type`,`start_time`,`total_time`  FROM `task` WHERE `employee_id`= '$employee'");
    while($data = mysqli_fetch_assoc($query)){
        echo '<tr>
        <td>'.$data["desc"].'</td>
        <td>'.$data["type"].'</td>
        <td>'.$data["start_time"].'</td>
        <td>'.$data["total_time"].'</td>
        <tr>';
    }
    ?>
    </table>
  </div>
    <?php
    $now = new DateTime();
    $today = $now->format('Y-m-d'); 
    $previous_day = $now->modify("-1 days")->format('Y-m-d');

    $total_work_today =$mysqli->query("SELECT SUM(total_time) FROM `task` WHERE `start_time` >= '$today' AND (employee_id = '$employee' AND `type` = 'Work')");
    $total_work_today_data = mysqli_fetch_assoc($total_work_today);
    $total_work_today = $total_work_today_data['SUM(total_time)'] ?? '0';
    
    $total_work_previous =$mysqli->query("SELECT SUM(total_time) FROM `task` WHERE DATE(`start_time`) = '$previous_day' AND (employee_id = '$employee' AND `type` = 'Work')");
    $total_work_previous_data = mysqli_fetch_assoc($total_work_previous);
    $total_work_previous = $total_work_previous_data['SUM(total_time)'] ?? '0' ;

    $total_break_today =$mysqli->query("SELECT SUM(total_time) FROM `task` WHERE `start_time` >= '$today' AND (employee_id = '$employee' AND `type` = 'Break')");
    $total_break_today_data = mysqli_fetch_assoc($total_break_today);
    $total_break_today = $total_break_today_data['SUM(total_time)'] ?? '0';

    $total_break_previous =$mysqli->query("SELECT SUM(total_time) FROM `task` WHERE DATE(`start_time`) = '$previous_day' AND (employee_id = '$employee' AND `type` = 'Break')");
    $total_break_previous_data = mysqli_fetch_assoc($total_break_previous);
    $total_break_previous = $total_break_previous_data['SUM(total_time)'] ?? '0';

    $total_meeting_today =$mysqli->query("SELECT SUM(total_time) FROM `task` WHERE `start_time` >= '$today' AND (employee_id = '$employee' AND `type` = 'Meeting')");
    $total_meeting_today_data = mysqli_fetch_assoc($total_meeting_today);
    $total_meeting_today = $total_meeting_today_data['SUM(total_time)'] ?? '0';

    $total_meeting_previous =$mysqli->query("SELECT SUM(total_time) FROM `task` WHERE DATE(`start_time`) ='$previous_day' AND (employee_id = '$employee' AND `type` = 'Meeting')");
    $total_meeting_previous_data = mysqli_fetch_assoc($total_meeting_previous);
    $total_meeting_previous = $total_meeting_previous_data['SUM(total_time)'] ?? '0';

    ?>

    <?php
    //work
    $now = new DateTime();
    $work_array = array();
    $today = $now->format('Y-m-d');
    $past_date = $now->modify("-7 days")->format('Y-m-d');
    $i = $past_date;
    $cnt = 1;
    while($i < $today){
    $query = $mysqli->query("SELECT  start_time,SUM(`total_time`) AS `total_time` FROM `task` WHERE DATE(start_time) = '$i' AND (employee_id = '$employee' AND `type` = 'work')");
    if(mysqli_num_rows($query)>=1){
    while($details = mysqli_fetch_assoc($query)){
    array_push($work_array, $details['total_time']?? 0);
    }

    }
    $i = $now->modify(($cnt)."days")->format('Y-m-d');

    }

    //break
    $break_array = array();
    $today = $now->format('Y-m-d');
    $past_date = $now->modify("-7 days")->format('Y-m-d');
    $i = $past_date;
    $cnt = 1;
    while($i < $today){
    $query = $mysqli->query("SELECT SUM(`total_time`) AS `total_time` FROM `task` WHERE DATE(start_time) = '$i' AND (employee_id = '$employee' AND `type` = 'Break')");
    if(mysqli_num_rows($query)>=1){
    while($details = mysqli_fetch_assoc($query)){
    array_push($break_array,$details['total_time'] ?? 0);
    }
    }

    $i = $now->modify(($cnt)."days")->format('Y-m-d');

    }

    //meeting
    $meet_array = array();
    $today = $now->format('Y-m-d');
    $past_date = $now->modify("-7 days")->format('Y-m-d');
    $i = $past_date;
    $cnt = 1;
    while($i < $today){
    $query = $mysqli->query("SELECT  SUM(`total_time`) AS `total_time` FROM `task` WHERE DATE(start_time) = '$i' AND (employee_id = '$employee' AND `type` = 'Meeting')");
    if(mysqli_num_rows($query)>=1){
    while($details = mysqli_fetch_assoc($query)){
    array_push($meet_array,$details['total_time']?? 0);
    }
    }

    $i = $now->modify(($cnt)."days")->format('Y-m-d');
   
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
    <script>
    var week_work = <?php echo json_encode($work_array)?>;
    var week_break = <?php echo json_encode($break_array)?>;
    var week_meet = <?php echo json_encode($meet_array)?>;
    console.log(week_meet);
    
    var today = moment(new Date());
    var yesterday = today.add(-1, 'days').format("DD-MM-YYYY");
    var week_date = today.add(-7, 'days').format("DD-MM-YYYY");
    var labels_array=[];
    for(var i = 0 ; i < 7 ; i++){
    var j = 1;
    var date = today.add(j, 'days').format("DD-MM-YYYY");
    labels_array[i] = date;
    }
    console.log(labels_array);

    const bar_data = {
        labels: labels_array,
        datasets: [
            {
            label: 'Not Working',
            data: week_break,
            backgroundColor: '#FFCCB3',
            },
            {
            label: 'Working',
            data: week_work,
            backgroundColor:'#F675A8',
            },
            {
            label: 'Meeting',
            data: week_meet,
            backgroundColor: 'green',
            },
        ]

    }

    const bar_config = {
    type: 'bar',
    data: bar_data,
    options: {
        maintainAspectRatio: false,
        plugins: {
        title: {
            display: true,
            text: 'Weekly Data'
        },
        },
        responsive: true,
        scales: {
        x: {
            stacked: true,
        },
        }
    }
    };

    const barChart = new Chart(
        document.getElementById('barChart'),
        bar_config
    );
    const labels = [
        'Work',
        'Meeting',
        'Break'
    ];

    const data = {
        labels: labels,
        label: 'My First dataset',
        datasets: [{
        backgroundColor: ['#F0C929','#1746A2','#F29393'],
        borderColor: 'white',
        data: ["<?php echo $total_work_today?>", "<?php echo $total_meeting_today ?>", "<?php echo $total_break_today?>"],
        }]
    };

    const config = {
        type: 'pie',
        data: data,
        options: {maintainAspectRatio: false}
    };
     const pieChart1 = new Chart(
       document.getElementById('pieChart1'),
        config
    );
   
    const labels1 = [
        'Work',
        'Meeting',
        'Break'
    ];


    const chart2 = {
    labels: labels,
    datasets: [{
      label: 'My Second dataset',
      backgroundColor: ['#F0C929','#1746A2','#F29393'],
      borderColor: 'white',
      data: ["<?php echo $total_work_previous?>", "<?php echo $total_meeting_previous?>", "<?php echo $total_break_previous ?>"],
    }]
  }
  const chart_config_2 = {
    type: 'pie',
    data: chart2,
    options: {maintainAspectRatio: false}
  };
   var previous_work = "<?php echo $total_work_previous?>"
   var previous_meeting = "<?php echo $total_meeting_previous?>"
   var previous_break = "<?php echo $total_break_previous?>"
   if(previous_work == 0 && previous_meeting == 0 && previous_break == 0){
    document.getElementById('parent-cont-2').innerHTML="Not found";
    document.getElementById("pieChart2").style.width = "0px";
    document.getElementById("pieChart2").style.height = "0px";
   }
   else{ const pieChart2 = new Chart(
        document.getElementById('pieChart2'),
        chart_config_2
    );
   }
</script>
    

</body>
</html>