<?php
session_start();
session_unset();
session_destroy();
unset($_SESSION["username"]);
unset($_SESSION["Adminname"]);
header("location: index.php");

?>