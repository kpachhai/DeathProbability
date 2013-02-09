<?php
	require '../setup/core.inc.php';
	require '../setup/connect.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Guest Sign in &middot; Death Probability</title>
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
    <h2 class="form-signin-heading">Guest Sign In</h2>
      <input type="text" class="input-block-level" name="nickname" placeholder="Nickname" required /><br>

<?php
	mysql_query("UPDATE counter SET counter = counter + 1");
	$count = mysql_fetch_row(mysql_query("SELECT counter FROM counter"));
	
	if(isset($_POST['nickname'])) {
		$username = $_POST['nickname'];
		$password = "default";
		$password_hash = md5($password);
		$firstname = "deleteme";
		$lastname = "deleteme";
		
		if(!empty($username)) {
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
		else {
			echo 'All fields are required';			
		}
	}
	
?>

	<br><button class="btn btn-large btn-primary" name="guestlogin" type="submit"/>Sign in as guest</button>
  </form>
  <form class="form-signin" id="middle-form" action="../index.php">
    <button class="btn btn-large" name="Go Back" type="submit"/>Go Back</button>
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

