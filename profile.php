<?php
error_reporting(0);
session_start();
include 'db_connect.php';


if (strlen($_SESSION['username']) == 0) {
    // Redirect Login Page    
    header("location:login.php");
} else {




?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $_SESSION["username"] ?> :Profile</title>

        <link rel="stylesheet" href="./css/style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    </head>

    <body>
        <?php require  "partials/_navbar.php"; ?>
        <section class="container">
            <div class="profile-div">

                <div class="admin-img">
                    <img src="./image/userimage.jpg" alt="admin profile">
                    <div class="profile-data">
                        <!-- show user details  -->
                        <p id="aname"><?php echo $_SESSION["username"] ?></p>
                        <p><?php echo $_SESSION["email"] ?></p>
                        <p><?php echo $_SESSION["mobileno"] ?></p>

                        <div class="lgt-out">
                            <a href="logout.php">logout</a>

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
