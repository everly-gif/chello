<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chello</title>
    <link href="./css/main.css" rel="stylesheet"/> 
</head>
<body>
<?php include './partials/header.php' ;?>
    <div class="main-cont">
        <div class="div1">
            <h1>The one stop employee <span style="color: #1746A2;">management</span> tool</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur finibus aliquet augue, sed facilisis arcu. Curabitur accumsan iaculis odio quis elementum. Nullam lacus massa, tristique vitae viverra quis, finibus nec risus. Aliquam sit amet libero non ipsum porttitor interdum.</p>
        </div>
        <div class="div2"><img src="./images/management-portal.png"></div>
    </div>
    <div class="main-cont-2">
        <div class="div1">
             <img src="./images/minimalistic.png">
        </div>
        <div class="div2">
            <h1>Minimilastic and <span style="color: #1746A2;">Effective</span></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur finibus aliquet augue, sed facilisis arcu. Curabitur accumsan iaculis odio quis elementum. Nullam lacus massa, tristique vitae viverra quis, finibus nec risus. Aliquam sit amet libero non ipsum porttitor interdum.</p></div>
    </div>
    <div class="main-cont">
        <div class="div1">
            <h1>Interactive<span style="color: #1746A2;"> Dashboards</span></h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur finibus aliquet augue, sed facilisis arcu. Curabitur accumsan iaculis odio quis elementum. Nullam lacus massa, tristique vitae viverra quis, finibus nec risus. Aliquam sit amet libero non ipsum porttitor interdum.</p>
        </div>
        <div class="div2"><img src="./images/interactive-dashboard.png"></div>
    </div>
    <div class="banner">
        <h1>Get <span style="color:#F0C929">Started</span> Today</h1>
        <a href="sign-up.php">Sign Up</a>
    </div>
    <?php include './partials/footer.php' ;?>
</body>
</html>