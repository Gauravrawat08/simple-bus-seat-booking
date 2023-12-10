<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign up</title>
  <link rel="stylesheet" href="./css/style.css">


</head>

<body>
  <?php require  "partials/_navbar.php"; ?>
  <section class="reg-container">

    <div class="reg-div">          

      <h2>Sign up</h2>
      <form name="form1" id="form1" onsubmit="return FormValidation()" action="login_ragister.php" method="post">
        <div class="form_box">

          <div class="input-row">
            <input type="text" name="username" placeholder="Username*">
            <span class="error">Please Enter Your Username</span>
          </div>

          <div class="input-row">
            <input type="text" name="mail" placeholder="Email*">
            <span class="error">Please Enter Your Email</span>
          </div>

          <div class="input-row">
            <input type="tel" name="mobileno" placeholder="Phone*" minlength="1" maxlength="10">
            <span class="error">Please Enter Your Phone</span>
          </div>

          <div class="input-row">
            <input type="password" name="password" placeholder="password*">
            <span class="error">Please Enter Your Password</span>
          </div>
          <input type="submit" value="Submit" name="register">

        </div>
      </form>
      <div class="link">
        <a href="login.php">Already Sign Up</a> or <a href="admin.php">Admin Login</a>
      </div>

    </div>

    </div>
    </div>


  </section>


  <script src="js/javascript.js"></script>



  <script>
    function FormValidation() {
     
      var username = document.form1.username;
      var mail = document.form1.mail;
      var phone = document.form1.mobileno;
      var password = document.form1.password;
      var conditions = document.form1.conditions;

      //username validation
      if (username.value == "") {
        username.nextElementSibling.style.display = "block";
        username.style.border = "1px solid #f00";
        return false
      } else {
        username.nextElementSibling.style.display = "none";
        username.style.border = "1px solid transparent";
      }

      //email validation
      if (!mail.value.match(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/) || mail.value == "") {
        mail.nextElementSibling.style.display = "block";
        mail.style.border = "1px solid #f00";
        return false
      } else {
        mail.nextElementSibling.style.display = "none";
        mail.style.border = "1px solid transparent";
      }

      //phone no validation
      if (!phone.value.match(/^\(?([5-9]{1})\)?([0-9]{9})$/) || phone.value == "") {
        phone.nextElementSibling.style.display = "block";
        phone.style.border = "1px solid #f00";
        return false
      } else {
        phone.nextElementSibling.styl
        e.display = "none";
        phone.style.border = "1px solid transparent";
      }
      //  password validation
      if (password.value == "") {
        password.nextElementSibling.style.display = "block";
        password.style.border = "1px solid #f00";
        return false
      } else {
        password.nextElementSibling.style.display = "none";
        password.style.border = "1px solid transparent";
      }


    }
  </script>







</body>

</html>