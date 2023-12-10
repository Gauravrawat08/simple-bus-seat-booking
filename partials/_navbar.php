<?php 
error_reporting(0);
session_start();
include 'db_connect.php';
$loggedin = false;
 
if(strlen($_SESSION['username'])==0 ){
    $loggedin = true;
  
 
}
 



?>
<?php

echo '<header>
<nav class="navbar">
 <div class="logo">BUS SEAT BOOK SYSTEM</div>
 <div class="mid-item">
     <a href="index.php">Home</a>
     <a href="index.php">Book Ticket</a>
     <a href="seatavailability.php">Seat Availability</a>
     <a href="profile.php">Profile</a>
     </div>';
   if($loggedin ){         
        echo '<div class="left-item"> 
               <a href="./login.php">Login</a>
             <a href="signup.php">Signup</a>';
    }

   if(!$loggedin){                 

          echo '<p>Welcome -'.$_SESSION["username"].'</p>';
          echo '<a href="logout.php">logout</a></div>';}

        

      echo  '</nav>
    </header>';
?>