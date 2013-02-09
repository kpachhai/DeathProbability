<?php
	 require '../setup/core.inc.php';
	 require '../setup/connect.inc.php';
	 
	if(!loggedin()) header('Location: ../index.php');
?>

<!DOCTYPE html>

<head>
  <title>History</title>
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
        width: 90%;
        min-width: 1120px;
        padding: 19px 29px 29px 19px;
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
        width: 50px;
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

//Global variables
$never = "Never";
$few = "Few times a month";
$several_week = "Several times a week";
$once = "Once a day";
$several_day = "Several times a day";
$yes = "Yes";
$no = "No";

if($firstname != "deleteme" && $surname != "deleteme") {
  echo '<li class="active"><a href="deathprobability.php">Take the test</a></li>';
  echo '<li><a href="../my_account/myaccount.php">My Account</a></li>';
  if(isset($_SESSION['age'])) echo '<li><a href="result.php">Last Result</a></li>';
  echo '<li><a href="../login_stuff/logout.php">Logout</a></li>';
  echo '</ul>';
  echo '<div class="login-text pull-right">';
  echo 'Logged in as '.$surname.', '.$firstname.'.'.'   ';
}
else {
		header('Location: deathprobability.php');
}

$query = "SELECT * FROM Info WHERE username='$username'";
$result = mysql_query($query);	
$num=mysql_numrows($result);
mysql_close();
?>
    </div> <!--login-text-->
    <h3 class="muted">History</h3>
  </div> <!--masthead-->
<br><br><br>
<table class="table table-striped">
<thead>
<td><center><strong>Name</strong></center></td>
<td><center><strong>Age</strong></center></td>
<td><center><strong>Gender</strong></center></td>
<td><center><strong>Weight</strong></center></td>
<td><center><strong>Height</strong></center></td>
<td><center><strong>State</strong></center></td>
<td><center><strong>Smoke</strong></center></td>
<td><center><strong>Drink</strong></center></td>
<td><center><strong>Exercise</strong></center></td>
<td><center><strong>Drive</strong></center></td>
<td><center><strong>Unhealthy Diet</strong></center></td>
<td><center><strong>Stress</strong></center></td>
<td><center><strong>Family History of Diabetes</strong></center></td>
<td><center><strong>Family History of Heart Disease</strong></center></td>
<td><center><strong>Family History of Alzheimer's</strong></center></td>
<td><center><strong>Family History of Depression</strong></center></td>

</thead>

<?php
	$i=0;
	while ($i < $num) {

		$f1=mysql_result($result,$i,"Username");
		$f2=mysql_result($result,$i,"Name");
		$f3=mysql_result($result,$i,"Age");
		$f4=mysql_result($result,$i,"Sex");
		$f5=mysql_result($result,$i,"Weight");
		$f6=mysql_result($result,$i,"HeightFt");
		$f7=mysql_result($result,$i,"HeightIn");
		$f8=mysql_result($result,$i,"State");
		$f9=mysql_result($result,$i,"Smoke");
				if($f9 == '0') $resultf9 = $never;
				else if($f9 == '1') $resultf9 = $few;
				else if($f9 == '2') $resultf9 = $several_week;
				else if($f9 == '3') $resultf9 = $once;
				else $resultf9 = $several_day;
		$f10=mysql_result($result,$i,"Drink");
				if($f10 == '0') $resultf10 = $never;
				else if($f10 == '1') $resultf10 = $few;
				else if($f10 == '2') $resultf10 = $several_week;
				else if($f10 == '3') $resultf10 = $once;
				else $resultf10 = $several_day;
		$f11=mysql_result($result,$i,"Exercise");
				if($f11 == '0') $resultf11 = $never;
				else if($f11 == '1') $resultf11 = $few;
				else if($f11 == '2') $resultf11 = $several_week;
				else if($f11 == '3') $resultf11 = $once;
				else $resultf11 = $several_day;
		$f12=mysql_result($result,$i,"Drive");
				if($f12 == '0') $resultf12 = $never;
				else if($f12 == '1') $resultf12 = $few;
				else if($f12 == '2') $resultf12 = $several_week;
				else if($f12 == '3') $resultf12 = $once;
				else $resultf12 = $several_day;
		$f13=mysql_result($result,$i,"UnhealthyMeal");
				if($f13 == '0') $resultf13 = $never;
				else if($f13 == '1') $resultf13 = $few;
				else if($f13 == '2') $resultf13 = $several_week;
				else if($f13 == '3') $resultf13 = $once;
				else $resultf13 = $several_day;
		$f14=mysql_result($result,$i,"StressLevel");
				if($f14 == '0') $resultf14 = $never;
				else if($f14 == '1') $resultf14 = $few;
				else if($f14 == '2') $resultf14 = $several_week;
				else if($f14 == '3') $resultf14 = $once;
				else $resultf14 = $several_day;
		$f15=mysql_result($result,$i,"DiabetesHistory");
				if($f15 == '0') $resultf15 = $yes;
				else $resultf15 = $no;
		$f16=mysql_result($result,$i,"HeartDiseaseHistory");
				if($f16 == '0') $resultf16 = $yes;
				else $resultf16 = $no;
		$f17=mysql_result($result,$i,"AlzheimersHistory");
				if($f17 == '0') $resultf17 = $yes;
				else $resultf17 = $no;
		$f18=mysql_result($result,$i,"DepressionHistory");
				if($f18 == '0') $resultf18 = $yes;
				else $resultf18 = $no;
?>

<tr>
<td><center><?php echo $f2; ?></center></td>
<td><center><?php echo $f3; ?></center></td>
<td><center><?php echo $f4; ?></center></td>
<td><center><?php echo $f5; ?></center></td>
<td><center><?php echo $f6.'ft '.$f7.' inches'; ?></center></td>
<td><center><?php echo $f8; ?></center></td>
<td><center><?php echo $resultf9; ?></center></td>
<td><center><?php echo $resultf10; ?></center></td>
<td><center><?php echo $resultf11; ?></center></td>
<td><center><?php echo $resultf12; ?></center></td>
<td><center><?php echo $resultf13; ?></center></td>
<td><center><?php echo $resultf14; ?></center></td>
<td><center><?php echo $resultf15; ?></center></td>
<td><center><?php echo $resultf16; ?></center></td>
<td><center><?php echo $resultf17; ?></center></td>
<td><center><?php echo $resultf18; ?></center></td>
</tr>

<?php
		$i++;
	}	
	
?></table><br>
	
<br><br><br>
<center>
<iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/DeathProbability" scrolling="no" frameborder="0" style="border:none; width:175px; height:80px">
</iframe>
<br>
<a href="../extra_stuff/feedback.php"><u>Give us feedback</u></a></center>
</div> <!--container-narrow-->
</body>
</html>
