<?php
	require '../setup/core.inc.php';
	require '../setup/connect.inc.php';
	 
	echo "<b><center>FEEDBACK-FORM</center></b><br><br>";
	 
	if(!loggedin()) header('Location: ../index.php');
	else {
		$username = getuserfield('Username');
		$firstname = getuserfield('FirstName');
		$surname = getuserfield('LastName');
		$ip_address = getipaddress();
		
		if($firstname != "deleteme" && $surname != "deleteme") {
			echo 'You\'re logged in as '.$surname.', '.$firstname.'.'.' <br><br>';
			echo '<a href="../main_test/deathprobability.php">Take the test</a>';
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo '<a href="../my_account/myaccount.php">My Account</a>';
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			if(isset($_SESSION['age'])) {
				echo '<a href="../main_test/result.php">Last Result</a>';
				echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			echo '<a href="../main_test/history.php">History</a>';
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			echo '<a href="../login_stuff/logout.php">Logout</a>';
		}
		else {
			echo 'You\'re logged in as Guest.<br>';
			echo '<a href="../main_test/deathprobability.php">Take the test</a>';
			echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			if(isset($_SESSION['age'])) {
				echo '<a href="../main_test/result.php">Last Result</a>';
				echo "&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			echo '<a href="../login_stuff/logout.php">Logout</a>';
		}
		
		echo '<br><br>';
		
		  function spamcheck($field)
		  {
		  //filter_var() sanitizes the e-mail
		  //address using FILTER_SANITIZE_EMAIL
		  $field=filter_var($field, FILTER_SANITIZE_EMAIL);

		  //filter_var() validates the e-mail
		  //address using FILTER_VALIDATE_EMAIL
		  if(filter_var($field, FILTER_VALIDATE_EMAIL))
			{
			return TRUE;
			}
		  else
			{
			return FALSE;
			}
		  }

		if (isset($_REQUEST['email']))
		  {//if "email" is filled out, proceed

		  //check if the email address is invalid
		  $mailcheck = spamcheck($_REQUEST['email']);
		  if ($mailcheck==FALSE)
			{
			echo "Invalid input";
			}
		  else
			{//send email
			$email = $_REQUEST['email'] ;
			$subject = $_REQUEST['subject'] ;
			$message = $_REQUEST['message'] ;
			mail("kiran.pachhai@yahoo.com", "Subject: $subject",
			$message, "From: $email" );
			echo 'Thank you for your feedback.Click <a href="../my_account/myaccount.php">here</a> to return.';
			}
		  }
		else
		  {//if "email" is not filled out, display the form
		  echo "<form method='post' action='feedback.php'>
		  From(Email): <input name='email' type='text'><br>
		  Subject: <input name='subject' type='text'><br>
		  Message:<br>
		  <textarea name='message' rows='15' cols='40'>
		  </textarea><br>
		  <input type='submit'>
		  </form>";
		  }
	 }
?>

<iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/DeathProbability"
	scrolling="no" frameborder="0"
	style="border:none; width:450px; height:80px">
</iframe>

<?php	 
	if(!loggedin()) header('Location: index.php');	
	else {	
		$firstname = getuserfield('FirstName');
		$surname = getuserfield('LastName');
		
		if($firstname != "deleteme" && $surname != "deleteme") {
?>

<center><script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u=https://www.facebook.com/DeathProbability&t=Take the death probability test','sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url(http://static.ak.fbcdn.net/images/share/facebook_share_icon.gif?0:26981) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:#3b5998 url(http://static.ak.fbcdn.net/images/share/facebook_share_icon.gif?0:26981) no-repeat top right; text-decoration:none; } </style> <a href="http://www.facebook.com/share.php?u=<url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;">Share your result</a></center>

<?php
		}
	}
?>

