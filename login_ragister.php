<?php
require('db_connect.php');
session_start();

//user login
if (isset($_POST['login'])) {
  $email = $_POST["mail"];
  $password = $_POST["password"];


  $sql = "SELECT * FROM `userlist` WHERE `mail` = '$email' AND `password` = '$password'";
  $result = mysqli_query($conn, $sql);
  $numofrow = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  if ($numofrow > 0) {
    // Login Sucessfull
    session_start();
    $_SESSION["loggedIn"] = true;
    $_SESSION["username"] = $row["username"];
    $_SESSION["mobileno"] = $row["mobileno"];
    $_SESSION["email"] = $row["mail"];
    header("location:seatavailability.php");
  } else {
     // Login failure and Redirect login Page 
    echo "<script>alert('Wrong Email and Password');  window.location.href='login.php'</script>";
  }
}




//admin login

if (isset($_POST['alogin'])) {
  $mail = $_POST["mail"];
  $password = $_POST["password"];
  
  $sql = "SELECT * FROM `tbladmin` WHERE `mail` = '$mail' AND `password` = '$password'";
  $result = mysqli_query($conn, $sql);
  $num = mysqli_num_rows($result);
  $row = mysqli_fetch_assoc($result);
  if ($num > 0) {
      // Admin Login Sucessfull 
    $_SESSION["Adminname"] = $row["Adminname"];
    $_SESSION["mail"] = $row["mail"];
    // Redirect Admin Pannel Page  
    header("location:pannel.php");
  } else {
    // Login failure and Redirect admin Page    
    echo "<script>alert('Wrong Email and Password');  window.location.href='admin.php'</script>";
  }
}




//registered 
if (isset($_POST['register'])) {
  $username = $_POST["username"];
  $email =  $_POST["mail"];
  $mobileno = $_POST["mobileno"];
  $password = $_POST["password"];

  // Check if the user email already exists
  $exitSql = "SELECT * FROM userlist WHERE mail = '$email'";
  $result = mysqli_query($conn, $exitSql);
  $num = mysqli_num_rows($result);
  if ($num > 0) {
    
    // Redirect signup Page
    echo "<script>alert('This  Email id already associated with another user');
    window.location.href='signup.php';</script>";
  } 
  else {
    
    $sql = "INSERT INTO userlist (username, mail,mobileno,password)
    VALUES('$username','$email','$mobileno','$password')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      
      // Redirect Login Page
      echo "<script>alert('You have successfully registered');
          window.location.href='login.php'</script>";
    }
  }
}
