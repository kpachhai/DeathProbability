<?php
	 require '../setup/core.inc.php';
	 require '../setup/connect.inc.php';
	 
	 //echo "<b><center>DEATH PROBABILITY</center></b><br><br>";
	 
	if(!loggedin()) header('Location: ../index.php');
?>

<!DOCTYPE html>

<head>
  <title>My Account</title>
  <link href="../assets/css/bootstrap.css" rel="stylesheet" />
  <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        background:url("../assets/img/Death_by_Viper_mod.png");
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: right;
        background-attachment:fixed;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 50px;
        width: 700px;
        padding: 19px 29px 29px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .container-narrow > hr {
        margin: 30px 0;
      }
      
      .login-text {
        padding: 6px;
      }

      .gender-block {
        background-color: white;
        border: 1px solid #CCC;
        display: inline-block;
        height: 20px;
        padding: 4px 6px;
      }

      .radio-spacing {
      padding: 0px 6px;
      }

      #labelbox {
        width: 175px;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
</head>

<body>
  <div class="container-narrow">
    <div class="masthead">
      <ul class="nav nav-pills pull-right">
<?php
$username = getuserfield('Username');
$firstname = getuserfield('FirstName');
$surname = getuserfield('LastName');
$ip_address = getipaddress();

if($firstname != "deleteme" && $surname != "deleteme") {
  echo '<li class="active"><a href="../main_test/deathprobability.php">Take the test</a></li>';
  echo '<li><a href="myaccount.php">My Account</a></li>';
  if(isset($_SESSION['age'])) echo '<li><a href="../main_test/result.php">Last Result</a></li>';
  echo '<li><a href="../main_test/history.php">History</a></li>';
  echo '<li><a href="../login_stuff/logout.php">Logout</a></li>';
  echo '</ul>';
  echo '<div class="login-text pull-right">';
  echo 'Logged in as '.$surname.', '.$firstname.'.'.'   ';
}
else {
  header('Location: ../main_test/deathprobability.php');
}
?>
    </div> <!--login-text-->
    <h3 class="muted">Delete Account?</h3>
  </div> <!--masthead-->

<?php

		if(isset($_POST['Delete'])) {
				$query = "DELETE FROM Login WHERE Username='$username'";
				$query2 = "DELETE FROM Info WHERE Username='$username'";
				if($query_run = mysql_query($query)) {
					if($query_run2 = mysql_query($query2)) {
						header('Location: logout.php');
					}
					else {
						echo 'We couldn\'t delete your account at this time. Please try again later.';				
					}
				}
				else {
					echo 'We couldn\'t delete your account at this time. Please try again later.';
				}
			}
			else if(isset($_POST['Undelete'])) {
				header('Location: myaccount.php');	
			}
?>

<!--<div class="row">-->
<!--<div class="span6">-->
<br>This action cannot be undone.<br>
<form action="deleteaccount.php" method="POST">
  <button class="btn btn-large" type="submit" name="Delete"/>Absolutely</button>
  <button class="btn btn-large" type="submit" name="Undelete"/>Go Back</button>
</form>
	
<br><br><br>
<center>
<iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/DeathProbability" scrolling="no" frameborder="0" style="border:none; width:175px; height:80px">
</iframe>
<br>
<a href="../extra_stuff/feedback.php"><u>Give us feedback</u></a></center>
</div> <!--container-narrow-->
</body>
</html>
