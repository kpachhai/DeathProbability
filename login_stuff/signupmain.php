<?php
  require '../setup/core.inc.php';
  require '../setup/connect.inc.php';

  if(loggedin()) {
    header('Location: ../main_test/deathprobability.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign up &middot; Death Probability</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        background:url("../assets/img/death-1920x1200.jpg");
        background-size: cover;
        background-repeat: no-repeat;
      }

      .form-signin {
        width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

#top-form {
  margin-bottom:0;
  border-bottom:0;
  -webkit-border-radius: 5ppx 5px 0px 0px;
  border-radius: 5px 5px 0px 0px;
}
 
#middle-form {
  margin:0 auto;
  border-top:0;
  border-bottom:0;
  -webkit-border-radius: 0;
  border-radius: 0;
}
 
#bottom-form {
  margin-top:0;
  border-top:0;
  -webkit-border-radius: 0px 0px 5px 5px;
  border-radius: 0px 0px 5px 5px;
}

    </style>
</head>
<body>
<link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">

<div class="container pull-left">

   <div class="span4 pull-left">
  <form class="form-signin" id="top-form" action="<?php echo $current_file; ?>" method="POST">
    <h2 class="form-signin-heading">Sign Up!</h2>
      <input type="text" class="input-block-level" name="username" placeholder="Username" required /><br>
      <input type="password" class="input-block-level" name="password" placeholder="Password" required /><br>
      <input type="password" class="input-block-level" name="password_again" placeholder="Confirm Password" required /><br>
      <input type="text" class="input-block-level" name="firstname" placeholder="First Name" required /><br>
      <input type="text" class="input-block-level" name="lastname" placeholder="Last Name" required /><br>
<?php
	
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_again']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			$password_hash = md5($password);
			$password_again = $_POST['password_again'];
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			if(!empty($username) && !empty($password) && !empty($password_again) && !empty($firstname) && !empty($lastname)) {
				if($password != $password_again) {
					echo 'Passwords do not match';
				}
				else {
					$query = "SELECT username FROM Login WHERE username='$username'";
					$query_run = mysql_query($query);
					
					if(mysql_num_rows($query_run) == 1) {
						echo 'The username \''.$username.'\' already exists.';
					}
					else {
						$query = "INSERT INTO Login VALUES ('', '".mysql_real_escape_string($username)."', '".mysql_real_escape_string($password_hash)."', '".mysql_real_escape_string($firstname)."', '".mysql_real_escape_string($lastname)."')";
						if($query_run = mysql_query($query)) {
							header('Location: signup_success.php');
						}
						else {
							echo 'Sorry we couldn\'t register you at this time. Try again later.';
						}
					}
				}
			}
			else {
				echo 'All fields are required';
			}
		}
	
?>

	<button class="btn btn-large btn-primary" type="submit" value="Sign Up">Sign Up!</button>
  </form>
  <form class="form-signin" id="bottom-form" action="../index.php">
    <button class="btn btn-large" type="submit" value="Log in">Back to Log in</button>
  </form>

</div>
</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-transition.js"></script>
    <script src="../assets/js/bootstrap-alert.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="../assets/js/bootstrap-scrollspy.js"></script>
    <script src="../assets/js/bootstrap-tab.js"></script>
    <script src="../assets/js/bootstrap-tooltip.js"></script>
    <script src="../assets/js/bootstrap-popover.js"></script>
    <script src="../assets/js/bootstrap-button.js"></script>
    <script src="../assets/js/bootstrap-collapse.js"></script>
    <script src="../assets/js/bootstrap-carousel.js"></script>
    <script src="../assets/js/bootstrap-typeahead.js"></script>

  </body>
