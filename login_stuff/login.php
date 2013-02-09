<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Sign in &middot; Death Probability</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="./assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
        background:url("./assets/img/death-1920x1200.jpg");
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
<link href="./assets/css/bootstrap-responsive.css" rel="stylesheet">

<div class="container pull-left">

   <div class="span4 pull-left">
  <form class="form-signin" id="top-form" action="<?php echo $current_file; ?>" method="POST">
    <h2 class="form-signin-heading">Death Probability</h2>
      <input type="text" class="input-block-level" name="username" placeholder="Username/Nickname"/><br>
      <input type="password" class="input-block-level" name="password" placeholder="Password"/><br>

<?php
	mysql_query("UPDATE counter SET counter = counter + 1");
	$count = mysql_fetch_row(mysql_query("SELECT counter FROM counter"));

	if(isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = "default";
		$password_hash = md5($password);
		
		if(!empty($username)) {
			$query = "SELECT Id FROM Login WHERE Username='".mysql_real_escape_string($username)."' AND Password='".mysql_real_escape_string($password_hash)."'";
			if($query_run = mysql_query($query)) {
				$query_num_rows = mysql_num_rows($query_run);
				if($query_num_rows == 0) {
					echo '<font color=red>*Invalid username/password combination.</font><br>';
				}
				else if($query_num_rows == 1) {
					$user_id = mysql_result($query_run, 0, 'id');
					$user_name = $username;
					$_SESSION['user_id'] = $user_id;
					$_SESSION['user_name'] = $user_name;
					header('Location: index.php');
				}
			}
		}
		else {
			echo 'You must supply your nickname if you\'re logging in as a guest.';
		}		
	}
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$password_hash = md5($password);
		
		if(!empty($username) && !empty($password)) {
			$query = "SELECT Id FROM Login WHERE Username='".mysql_real_escape_string($username)."' AND Password='".mysql_real_escape_string($password_hash)."'";
			if($query_run = mysql_query($query)) {
				$query_num_rows = mysql_num_rows($query_run);
				if($query_num_rows == 0) {
					echo '<font color=red>*Invalid username/password combination.</font><br>';
				}
				else if($query_num_rows == 1) {
					$user_id = mysql_result($query_run, 0, 'id');
					$user_name = $username;
					$_SESSION['user_id'] = $user_id;
					$_SESSION['user_name'] = $user_name;
					header('Location: index.php');
				}
			}
		}
		else {
			echo 'You must supply both username and password.';
		}
	}
?>

	<button class="btn btn-large btn-primary" type="submit"/>Sign in</button>
  </form>
  <form class="form-signin" id="middle-form" action="./login_stuff/guestlogin.php" method="POST">
    <h3 class="form-heading">Don't have an account?</h3></br>
    <button class="btn btn-large" type="submit" name="guestlogin"/>Sign in as Guest</button>
  </form>
  <form class="form-signin" id="middle-form" action="./login_stuff/signupmain.php" method="POST">
    <button class="btn btn-large" type="submit" name="guestlogin"/>Sign up!</button>
  </form>
  <form class="form-signin" id="bottom-form">
    <iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/DeathProbability"
	scrolling="no" frameborder="0"
	style="border:none; width:450px; height:80px">
    </iframe>
    <br>
    <center>Total page views: <?php echo $count[0];?></center>
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
</html>

