<?php

include("db_connect.php");
error_reporting(0);
session_start();
if (strlen($_SESSION["username"]) == 0) {
    header("location:login.php");
} else {


    include "./partials/_functions.php";
    if (isset($_POST["route_id"])) {
        $route_id =  $_POST["route_id"];
    }

    $sql = "SELECT * FROM `routes` WHERE `route_id` LIKE '$route_id'";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (isset($_POST["submit"])) {
            $customer_name = $_POST["cname"];
            $customer_mail = $_POST["cemail"];
            $route_id = $_POST["route_id"];
            $bus_no  = $_POST["busno"];
            $route_source = $_POST["sourceSearch"];
            $route_destination = $_POST["destinationSearch"];
            $booked_seat = $_POST["seatinput"];
            $amount = $_POST["bookAmount"];



            $booking_exist =  exist_booking($conn, $customer_mail, $route_id);
            $booking_added = false;

            if (!$booking_added) {
                $sql = "INSERT INTO `booking` (`customer_name`, `customer_mail`,  `route_id`, `bus_no`, `booked_amount`, `booked_seat`, `booking_created`) VALUES ('$customer_name', '$customer_mail', '$route_id', '$bus_no', '$amount','$booked_seat', current_timestamp());";


                $result = mysqli_query($conn, $sql);
                $autoInc_id = mysqli_insert_id($conn);

                if ($autoInc_id) {
                    $key = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    $code = "";

                    for ($i = 0; $i < 5; ++$i)
                        $code .= $key[rand(0, strlen($key) - 1)];

                    // Generates the unique bookingid
                    $booking_id = $code . $autoInc_id;


                    $query = "UPDATE `booking` SET `booking_id` = '$booking_id' WHERE `booking`.`id` = $autoInc_id;";
                    $q_result = mysqli_query($conn, $query);

                    if (!$q_result)
                        echo "Not working";
                }
                if ($result)
                    $booking_added = true;
            }


            if ($booking_added) {
                echo '<script>alert("Seat Book successfully")</script>';




                // update seat table
                $busno = get_from_table($conn, "routes", "route_id", $route_id, "bus_no");

                $seats = get_from_table($conn, "seats", "bus_no", $busno, "seat_booked");

                if ($seats) {
                    $seats .= "," . $booked_seat;
                } else
                    $seats = $booked_seat;

                $updateSeatSql = "UPDATE `seats` SET `seat_booked` = '$seats' WHERE `seats`.`bus_no`='$busno';";
                mysqli_query($conn, $updateSeatSql);
            } else {

                echo '<script>alert("Booking already exits")</script>';
            }
        }
    }



?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seat Book</title>
        <link rel="stylesheet" href="./css/style.css">

    </head>

    <body>
        <?php require  "partials/_navbar.php"; ?>



        <section class="seat-container">

            <div class="book-form-container">


                <form action="booking.php" method="post" class="client-form">

                    <div class="client-details">


                        <div class="book-inbox">
                            <label for="cname">Customer Name</label>
                            <input type="text" name="cname" id="cname" required>
                        </div>

                        <div class="book-inbox">
                            <label for="cemail">Contact Email</label>
                            <input type="email" name="cemail" id="cemail" required>
                        </div>

                        <div class="book-inbox">
                            <label for="routeSearch">Route</label>
                            <input type="text" name="route_id" value="<?php echo $row['route_id']; ?>" readonly>


                        </div>
                        <div class="book-inbox">
                            <label for="busno">Bus Number</label>
                            <input type="text" id="busno" name="busno" value="<?php echo $row['bus_no']; ?>" readonly>


                        </div>




                        <div class="book-inbox">
                            <label for="sourceSearch">Source</label>
                            <input type="text" name="sourceSearch" id="sourceSearch" class="searchInput" value="<?php echo $row['fromcity']; ?>" readonly>

                        </div>
                        <div class="book-inbox">
                            <label for="destinationSearch">Destination</label>

                            <input type="text" name="destinationSearch" id="destinationSearch" class="searchInput" value="<?php echo $row['tocity']; ?>" readonly>


                        </div>

                        <div class="book-inbox">
                            <label for="seatInput">Seat Number</label>
                            <input type="text" id="seatinput" name="seatinput" readonly>
                        </div>


                        <div class="book-inbox">
                            <label for="bookAmount">Total Amount</label>
                            <input type="text" name="bookAmount" id="bookAmount" value="<?php echo $row['cost']; ?>" readonly>
                        </div>

                        <div class="book-inbox">
                            <input type="submit" value="submit" name="submit" id="seat-btn">
                        </div>

                    </div>
                </form>
                <div class="seat-details">

                    <!-- <table id="table">
                         -->

                    <div class="seats-box">
                        <div class="oneBox">



                            <?php
                            $busnum = $row["bus_no"];
                            $sql = "SELECT * FROM `seats` WHERE `bus_no` = '$busnum'";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($result);
                            $data_string = $data["seat_booked"];
                            $data_array = explode(",", $data_string);



                            for ($i = 0; $i < 20; $i++) {
                                if ($data_array[$i] == 1) {
                                    $one = true;
                                }
                                if ($data_array[$i] == 2) {
                                    $tow = true;
                                }
                                if ($data_array[$i] == 3) {
                                    $three = true;
                                }
                                if ($data_array[$i] == 4) {
                                    $four = true;
                                }
                                if ($data_array[$i] == 5) {
                                    $five = true;
                                }
                                if ($data_array[$i] == 6) {
                                    $six = true;
                                }
                                if ($data_array[$i] == 7) {
                                    $seven = true;
                                }
                                if ($data_array[$i] == 8) {
                                    $eight = true;
                                }
                                if ($data_array[$i] == 9) {
                                    $nine = true;
                                }
                                if ($data_array[$i] == 10) {
                                    $o10 = true;
                                }
                                if ($data_array[$i] == 11) {
                                    $o11 = true;
                                }
                                if ($data_array[$i] == 12) {
                                    $o12 = true;
                                }
                                if ($data_array[$i] == 13) {
                                    $o13 = true;
                                }
                                if ($data_array[$i] == 14) {
                                    $o14 = true;
                                }
                                if ($data_array[$i] == 15) {
                                    $o15 = true;
                                }
                                if ($data_array[$i] == 16) {
                                    $o16 = true;
                                }
                                if ($data_array[$i] == 17) {
                                    $o17 = true;
                                }
                                if ($data_array[$i] == 18) {
                                    $o18 = true;
                                }
                                if ($data_array[$i] == 19) {
                                    $o19 = true;
                                }
                                if ($data_array[$i] == 20) {
                                    $t20 = true;
                                }
                                if ($data_array[$i] == 21) {
                                    $t21 = true;
                                }
                                if ($data_array[$i] == 22) {
                                    $t22 = true;
                                }
                                if ($data_array[$i] == 23) {
                                    $t23 = true;
                                }
                                if ($data_array[$i] == 24) {
                                    $t24 = true;
                                }
                                if ($data_array[$i] == 25) {
                                    $t25 = true;
                                }
                                if ($data_array[$i] == 26) {
                                    $t26 = true;
                                }
                                if ($data_array[$i] == 27) {
                                    $t27 = true;
                                }
                                if ($data_array[$i] == 28) {
                                    $t28 = true;
                                }
                                if ($data_array[$i] == 29) {
                                    $t29 = true;
                                }
                                if ($data_array[$i] == 30) {
                                    $t30 = true;
                                }
                                if ($data_array[$i] == 31) {
                                    $t31 = true;
                                }
                                if ($data_array[$i] == 32) {
                                    $t32 = true;
                                }
                                if ($data_array[$i] == 33) {
                                    $t33 = true;
                                }
                                if ($data_array[$i] == 34) {
                                    $t34 = true;
                                }
                                if ($data_array[$i] == 35) {
                                    $t35 = true;
                                }
                                if ($data_array[$i] == 36) {
                                    $t36 = true;
                                }
                                if ($data_array[$i] == 37) {
                                    $t37 = true;
                                }
                                if ($data_array[$i] == 38) {
                                    $t38 = true;
                                }
                                if ($data_array[$i] == 39) {
                                    $t39 = true;
                                }
                                if ($data_array[$i] == 40) {
                                    $f40 = true;
                                }
                            }











                            if ($one) {

                                echo '<input type="button"  onclick="showme(1)" value="1" class=" seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(1)" value="1" class="seat-green setBoxsize">';
                            }
                            if ($tow) {
                                echo '<input type="button"  onclick="showme(2)" value="2" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(2)" value="2" class=" seat-green setBoxsize">';
                            }
                            if ($three) {
                                echo '<input type="button"  onclick="showme(3)" value="3" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(3)" value="3" class="  seat-green setBoxsize">';
                            }
                            if ($four) {
                                echo '<input type="button"  onclick="showme(4)" value="4" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(4)" value="4" class="  seat-green setBoxsize">';
                            }
                            if ($five) {
                                echo '<input type="button"  onclick="showme(5)" value="5" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(5)" value="5" class="seat-green setBoxsize">';
                            }
                            if ($six) {
                                echo '<input type="button"  onclick="showme(6)" value="6" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(6)" value="6" class="seat-green setBoxsize">';
                            }
                            if ($seven) {
                                echo '<input type="button"  onclick="showme(7)" value="7" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(7)" value="7" class="seat-green setBoxsize">';
                            }
                            if ($eight) {
                                echo '<input type="button"  onclick="showme(8)" value="8" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(8)" value="8" class="seat-green setBoxsize">';
                            }
                            if ($nine) {
                                echo '<input type="button"  onclick="showme(9)" value="9" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(9)" value="9" class="seat-green setBoxsize">';
                            }
                            if ($o10) {
                                echo '<input type="button"  onclick="showme(10)" value="10" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(10)" value="10" class="seat-green setBoxsize">';
                            }
                            if ($o11) {
                                echo '<input type="button"  onclick="showme(11)" value="11" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(11)" value="11" class="seat-green setBoxsize">';
                            }
                            if ($o12) {
                                echo '<input type="button"  onclick="showme(12)" value="12" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(12)" value="12" class="seat-green setBoxsize">';
                            }
                            if ($o13) {
                                echo '<input type="button"  onclick="showme(13)" value="13" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(13)" value="13" class="seat-green setBoxsize">';
                            }
                            if ($o14) {
                                echo '<input type="button"  onclick="showme(14)" value="14" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(14)" value="14" class="seat-green setBoxsize">';
                            }
                            if ($o15) {
                                echo '<input type="button"  onclick="showme(15)" value="15" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(15)" value="15" class="seat-green setBoxsize">';
                            }
                            if ($o16) {
                                echo '<input type="button"  onclick="showme(16)" value="16" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(16)" value="16" class="seat-green setBoxsize">';
                            }
                            if ($o17) {
                                echo '<input type="button"  onclick="showme(17)" value="17" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(17)" value="17" class="seat-green setBoxsize">';
                            }
                            if ($o18) {
                                echo '<input type="button"  onclick="showme(18)" value="18" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(18)" value="18" class="seat-green setBoxsize">';
                            }
                            if ($o19) {
                                echo '<input type="button"  onclick="showme(19)" value="19" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(19)" value="19" class="seat-green setBoxsize">';
                            }
                            if ($t20) {
                                echo '<input type="button"  onclick="showme(20)" value="20" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(20)" value="20" class="seat-green setBoxsize">';
                            } ?>

                        </div>

                        <div class="towBox">



                            <?php




                            if ($t21) {
                                echo '<input type="button"  onclick="showme(21)" value="21" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(21)" value="21" class="seat-green setBoxsize">';
                            }
                            if ($t22) {
                                echo '<input type="button"  onclick="showme(22)" value="22" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(22)" value="22" class="seat-green setBoxsize">';
                            }
                            if ($t23) {
                                echo '<input type="button"  onclick="showme(23)" value="23" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(23)" value="23" class="seat-green setBoxsize">';
                            }
                            if ($t24) {
                                echo '<input type="button"  onclick="showme(24)" value="24" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(24)" value="24" class="seat-green setBoxsize">';
                            }
                            if ($t25) {
                                echo '<input type="button"  onclick="showme(25)" value="25" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(25)" value="25" class="seat-green setBoxsize">';
                            }

                            if ($t26) {
                                echo '<input type="button"  onclick="showme(26)" value="26" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(26)" value="26" class="seat-green setBoxsize">';
                            }

                            if ($t27) {
                                echo '<input type="button"  onclick="showme(27)" value="27" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(27)" value="27" class="seat-green setBoxsize">';
                            }
                            if ($t28) {
                                echo '<input type="button"  onclick="showme(28)" value="28" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(28)" value="28" class="seat-green setBoxsize">';
                            }
                            if ($t29) {
                                echo '<input type="button"  onclick="showme(29)" value="29" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(29)" value="29" class="seat-green setBoxsize">';
                            }
                            if ($t30) {
                                echo '<input type="button"  onclick="showme(30)" value="30" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(30)" value="30" class="seat-green setBoxsize">';
                            }
                            if ($t31) {
                                echo '<input type="button"  onclick="showme(31)" value="31" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(31)" value="31" class="seat-green setBoxsize">';
                            }
                            if ($t32) {
                                echo '<input type="button"  onclick="showme(32)" value="32" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(32)" value="32" class="seat-green setBoxsize">';
                            }
                            if ($t33) {
                                echo '<input type="button"  onclick="showme(33)" value="33" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(33)" value="33" class="seat-green setBoxsize">';
                            }
                            if ($t34) {
                                echo '<input type="button"  onclick="showme(34)" value="34" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(34)" value="34" class="seat-green setBoxsize">';
                            }
                            if ($t35) {
                                echo '<input type="button"  onclick="showme(35)" value="35" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(35)" value="35" class="seat-green setBoxsize">';
                            }
                            if ($t36) {
                                echo '<input type="button"  onclick="showme(36)" value="36" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(36)" value="36" class="seat-green setBoxsize">';
                            }
                            if ($t37) {
                                echo '<input type="button"  onclick="showme(37)" value="37" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(37)" value="37" class="seat-green setBoxsize">';
                            }
                            if ($t38) {
                                echo '<input type="button"  onclick="showme(38)" value="38" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(38)" value="38" class="seat-green setBoxsize">';
                            }
                            if ($t39) {
                                echo '<input type="button"  onclick="showme(39)" value="39" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(39)" value="39" class="seat-green setBoxsize">';
                            }
                            if ($f40) {
                                echo '<input type="button"  onclick="showme(40)" value="40" class="seat-red setBoxsize">';
                            } else {
                                echo '<input type="button"  onclick="showme(40)" value="40" class="seat-green setBoxsize">';
                            }


                            ?>



                        </div>









                    </div>




        </section>
        <script>
            function showme(count) {
                let button = document.input;
                document.getElementById("seatinput").value = count;
                

            }
            var redseat = document.getElementsByClassName('seat-red');
            for (var i = 0; i < redseat.length; i++) {
                if (redseat[i].type == 'button') {
                    redseat[i].disabled = true;
                }
            }
        </script>
        <script src="./js/javascript.js"></script>

    </body>

    </html>

<?php }; ?>