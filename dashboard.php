<?php
include('./config.php');

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>



    <div class="dashboard">
        <h3>dashbord</h3>
        <span>
            <?php
            if(isset($_SESSION['loginMessage'])){

                echo $_SESSION['loginMessage'];
                unset($_SESSION['loginMessage']);
            }


            ?>

        </span>
        <div class="logOutBtn">
            <a href="logOut.php">log out</a>
        </div> 
        <div class="projett">
            <button><a href="projet.php">projets</a></button>

        </div>
    </div>   




</body>
</html>