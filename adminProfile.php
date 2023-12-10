<?php
error_reporting(0);
session_start();
include 'db_connect.php';


if (strlen($_SESSION['Adminname']) == 0) {

    header("location:admin.php");
} else {

    $mail = $_SESSION["mail"];

?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>

        <link rel="stylesheet" href="./css/style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    </head>

    <body>
        <?php require  "partials/_navbaradmin.php"; ?>
        <section class="container">
            <div class="profile-div">
                <div class="admin-img">
                    <img src="./image/adminprofile.jpg" alt="admin profile">
                    <div class="profile-data">
                        <p id="aname"><?php echo $_SESSION["Adminname"] ?></p>
                        <p><?php echo $mail ?></p>

                        <div class="lgt-out">
                            <a href="logout.php">logout</a>
                            <a href="pannel.php">Pannel</a>
                        </div>

                    </div>

                </div>
  
            </div>
            </div>


        </section>


        <script src="js/javascript.js"></script>
    </body>


    </html>


<?php };

?>