<?php
	 require '../setup/core.inc.php';
	 require '../setup/connect.inc.php';
	 
	 //echo "<b><center>DEATH PROBABILITY</center></b><br><br>";
	 
	if(!loggedin()) header('Location: ../index.php');
?>

<!DOCTYPE html>

<head>
  <title>Questionnaire</title>
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
        max-width: 1100px;
        min-width: 600px;
        width: 70%;
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
        margin: 0px -5px;
        z-index: 0;
        position: relative;
	-webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
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

if($firstname != "deleteme" && $surname != "deleteme") {
  echo '<li class="active"><a href="../my_account/myaccount.php">My Account</a></li>';
  echo '<li><a href="history.php">History</a></li>';
  echo '<li><a href="../login_stuff/logout.php">Logout</a></li>';
  echo '</ul>';
  echo '<div class="login-text pull-right">';
  echo 'Logged in as '.$surname.', '.$firstname.'.'.'   ';
}
else {
  /*echo 'Please sign up for more functionality like posting the results to your facebook page.<br>';
  echo 'In addition, all your data will be deleted once you log out since you\'re logged in as Guest.<br>';*/
  echo '<li class="active"><a href="../login_stuff/logout.php">Logout</a></li>';
  echo '</ul>';
  echo '<div class="login-text pull-right">';
  echo 'Logged in as Guest.';
}
?>
    </div> <!--login-text-->
    <h3 class="muted">Questionnaire</h3>
  </div> <!--masthead-->

<?php

		if(isset($_POST['name']) && isset($_POST['age']) && isset($_POST['sex']) && isset($_POST['weight']) && isset($_POST['heightft']) && isset($_POST['heightin']) 
				&& isset($_POST['state']) && isset($_POST['smoke']) && isset($_POST['drink']) && isset($_POST['exercise']) && isset($_POST['drive']) && isset($_POST['unhealthymeal'])
				&& isset($_POST['stresslevel']) && isset($_POST['diabeteshistory']) && isset($_POST['heartdiseasehistory']) && isset($_POST['alzheimershistory']) && isset($_POST['depressionhistory'])) {
			$name = $_POST['name'];
			$age = $_POST['age'];
			$sex = $_POST['sex'];
			$weight = $_POST['weight'];
			$heightft = $_POST['heightft'];
			$heightin = $_POST['heightin'];
			$state = $_POST['state'];
			$smoke = $_POST['smoke'];
			$drink = $_POST['drink'];
			$exercise = $_POST['exercise'];
			$drive = $_POST['drive'];
			$unhealthymeal = $_POST['unhealthymeal'];
			$stresslevel = $_POST['stresslevel'];
			$diabeteshistory = $_POST['diabeteshistory'];
			$heartdiseasehistory = $_POST['heartdiseasehistory'];
			$alzheimershistory = $_POST['alzheimershistory'];
			$depressionhistory = $_POST['depressionhistory'];
			
			if(!empty($name)) {
			
				if($age == 1 && ($weight < 10 || $weight > 30 || $heightft > 1)) 
					echo 'Please enter a valid weight and height for a person of that age.';
				else if($age == 2 && ($weight < 30 || $weight > 50 || $heightft > 2))
					echo 'Please enter a valid weight and height for a person of that age.';
				else if($age > 2 && $age <= 6 && ($weight < 30 || $weight > 50 || $heightft > 4)) 
					echo 'Please enter a valid weight and height for a person of that age.';
				else if($age > 6 && $age <= 11 && ($weight < 30 || $weight > 100 || $heightft > 6)) 
					echo 'Please enter a valid weight and height for a person of that age.';		
				else if($age > 11 && $age < 15 && ($weight < 50 || $weight > 300 || $heightft > 7)) 
					echo 'Please enter a valid weight and height for a person of that age.';
				else {
							$_SESSION['name'] = $name;
							$_SESSION['age'] = $age;
							$_SESSION['sex'] = $sex;
			$_SESSION['weight'] = $weight;
			$_SESSION['heightft'] = $heightft;
			$_SESSION['heightin'] = $heightin;
			$_SESSION['state'] = $state;
			$_SESSION['smoke'] = $smoke;
			$_SESSION['drink'] = $drink;
			$_SESSION['exercise'] = $exercise;
			$_SESSION['drive'] = $drive;
			$_SESSION['unhealthymeal'] = $unhealthymeal;
			$_SESSION['stresslevel'] = $stresslevel;
			$_SESSION['diabeteshistory'] = $diabeteshistory;
			$_SESSION['heartdiseasehistory'] = $heartdiseasehistory;
			$_SESSION['alzheimershistory'] = $alzheimershistory;
			$_SESSION['depressionhistory'] = $depressionhistory;
					
					$query = "INSERT INTO Info VALUES('', '$username', '$name', '$age', '$sex', '$weight', '$heightft', '$heightin', '$state', '$smoke', '$drink', '$exercise', 
					'$drive', '$unhealthymeal', '$stresslevel', '$diabeteshistory', '$heartdiseasehistory', '$alzheimershistory', '$depressionhistory')";
					if($query_run = mysql_query($query)) {
						header('Location: result.php');
					}
					else {
						echo 'Sorry we couldn\'t take the death probability test right now. Try again later.';
					}				
				}
			}
			else {
				echo 'Something is empty.';
			} 
		}
		else {
			echo 'All fields are required.';
		}
?>

<!--<div class="row">-->
<!--<div class="span6">-->

<form action="deathprobability.php" method="POST"> <!--optionally class="form-horizontal" -->
  <div class="control-group">
    <!--<label class="control-label" for="name">Name:</label>-->
    <div class="row">
      <div class="controls input-prepend span5">
        <span class="add-on" id="labelbox">Name:</span>
        <input class="input-block-level" id="prependedInput" type="text" name="name" required />
      </div>
    </div>
  </div>

  <div class="control-group">
    <div class="row">
      <div class="controls input-prepend form-inline span3">
        <span class="add-on" id="labelbox" style="position: relative; z-index: 1">Sex:</span>
        <div class="gender-block">
          <div class="span2">
            <label class="radio radio-spacing">
              <input class="radio-spacing" type="radio" name="sex" value="male">Male
            </label>
            <label class="radio radio-spacing">
              <input class="radio-spacing" type="radio" name="sex" value="female">Female
            </label>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="control-group">
    <!--<label class="control-label" for="age">Age:</label>-->
    <div class="row">
      <div class="controls input-prepend span3">
        <span class="add-on" id="labelbox">Age:</span>
        <input class="input-block-level" id="prependedInput" type="number" name="age" min="1" max="130" placeholder="Years" required />
      </div>
    </div>
  </div>

  <div class="control-group">
    <div class="row">
      <div class="controls input-prepend span3">
        <span class="add-on" id="labelbox">Weight:</span>
        <input class="input-block-level" id="prependedInput" type="number" name="weight" min="10" max="1400" placeholder="Pounds" required />
      </div>
    </div>
  </div>

  <div class="control-group">
    <div class="row">
      <div class="controls input-prepend input-append span3">
        <span class="add-on" id="labelbox">Height:</span>
        <input class="input-block-level" id="appendedPrependedInput" type="number" name="heightft" min="1" max="8" placeholder="Feet" required/>
        <input class="input-block-level" id="prependedInput" type="number" name="heightin" min="0" max="11" placeholder="Inches" required />
      </div>
    </div>
  </div>

  <div class="control-group">
    <div class="row">
      <div class="controls input-prepend span5">
        <span class="add-on" id="labelbox">State:</span>
        <select name="state">
          <option value="AL">Alabama</option>
          <option value="AL">Alaska</option>
          <option value="AZ">Arizona</option>
          <option value="AR">Arkansas</option>
          <option value="CA">California</option>
          <option value="CO">Colorado</option>
          <option value="CT">Connecticut</option>
          <option value="DE">Delaware</option>
          <option value="FL">Florida</option>
          <option value="GA">Georgia</option>
          <option value="HI">Hawaii</option>
          <option value="ID">Idaho</option>
          <option value="IL">Illinois</option>
          <option value="IN">Indiana</option>
          <option value="IA">Iowa</option>
          <option value="KS">Kansas</option>
          <option value="KY">Kentucky</option>
          <option value="LA">Louisiana</option>
          <option value="ME">Maine</option>
          <option value="MD">Maryland</option>
          <option value="MA">Massachusetts</option>
          <option value="MI">Michigan</option>
          <option value="MN">Minnesota</option>
          <option value="MS">Mississippi</option>
          <option value="MO">Missouri</option>
          <option value="MT">Montana</option>
          <option value="NE">Nebraska</option>
          <option value="NV">Nevada</option>
          <option value="NH">New Hampshire</option>
          <option value="NJ">New Jersey</option>
          <option value="NM">New Mexico</option>
          <option value="NY">New York</option>
          <option value="NC">North Carolina</option>
          <option value="ND">North Dakota</option>
          <option value="OH">Ohio</option>
          <option value="OK">Oklahoma</option>
          <option value="OR">Oregon</option>
          <option value="PA">Pennsylvania</option>
          <option value="RI">Rhode Island</option>
          <option value="SC">South Carolina</option>
          <option value="SD">South Dakota</option>
          <option value="TN">Tennessee</option>
          <option value="TX">Texas</option>
          <option value="UT">Utah</option>
          <option value="VT">Vermont</option>
          <option value="VA">Virginia</option>
          <option value="WA">Washington</option>
          <option value="WV">West Virginia</option>
          <option value="WI">Wisconsin</option>
          <option value="WY">Wyoming</option>
        </select>
      </div>
    </div>
  </div>



<!--  </div>-->
<!--</div>-->


Please answer the following questions to the best of your ability. <br><br>

<table class="table table-hover"><!-- border="2" cellspacing="2" cellpadding="2"-->

<thead>
<td><div class="span1"><strong>Question</strong></div></td>
<td><div class="span1"><strong>Never</strong></div></td>
<td><div class="span1"><strong>Few times a month</strong></div></td>
<td><div class="span1"><strong>Several times a week</strong></div></td>
<td><div class="span1"><strong>Once a day</strong></div></td>
<td><div class="span1"><strong>Several times a day</strong></div></td>
</thead>

<tr>
<td>How often do you smoke?</td>
<td><center><input type="radio" name="smoke" value="0"></center></td>
<td><center><input type="radio" name="smoke" value="1"></center></td>
<td><center><input type="radio" name="smoke" value="2"></center></td>
<td><center><input type="radio" name="smoke" value="3"></center></td>
<td><center><input type="radio" name="smoke" value="4"></center></td>
</tr>

<tr>
<td>How often do you drink?</td>
<td><center><input type="radio" name="drink" value="0"></center></td>
<td><center><input type="radio" name="drink" value="1"></center></td>
<td><center><input type="radio" name="drink" value="2"></center></td>
<td><center><input type="radio" name="drink" value="3"></center></td>
<td><center><input type="radio" name="drink" value="4"></center></td>
</tr>

<tr>
<td>How often do you exercise?</td>
<td><center><input type="radio" name="exercise" value="0"></center></td>
<td><center><input type="radio" name="exercise" value="1"></center></td>
<td><center><input type="radio" name="exercise" value="2"></center></td>
<td><center><input type="radio" name="exercise" value="3"></center></td>
<td><center><input type="radio" name="exercise" value="4"></center></td>
</tr>

<tr>
<td>How often do you drive?</td>
<td><center><input type="radio" name="drive" value="0"></center></td>
<td><center><input type="radio" name="drive" value="1"></center></td>
<td><center><input type="radio" name="drive" value="2"></center></td>
<td><center><input type="radio" name="drive" value="3"></center></td>
<td><center><input type="radio" name="drive" value="4"></center></td>
</tr>

<tr>
<td>How often do you eat unhealthy meal?</td>
<td><center><input type="radio" name="unhealthymeal" value="0"></center></td>
<td><center><input type="radio" name="unhealthymeal" value="1"></center></td>
<td><center><input type="radio" name="unhealthymeal" value="2"></center></td>
<td><center><input type="radio" name="unhealthymeal" value="3"></center></td>
<td><center><input type="radio" name="unhealthymeal" value="4"></center></td>
</tr>

<tr>
<td>How often do you find yourself significantly stressed out?</td>
<td><center><input type="radio" name="stresslevel" value="0"></center></td>
<td><center><input type="radio" name="stresslevel" value="1"></center></td>
<td><center><input type="radio" name="stresslevel" value="2"></center></td>
<td><center><input type="radio" name="stresslevel" value="3"></center></td>
<td><center><input type="radio" name="stresslevel" value="4"></center></td>
</tr>

<thead>
<td><strong>Question<br></strong></td>
<td><center><strong>No</strong></center></td>
<td><center><strong>Yes</strong></center></td>
</thead>

<tr>
<td>Does anyone in your family have a history of diabetes?</td>
<td><center><input type="radio" name="diabeteshistory" value="0"></center></td>
<td><center><input type="radio" name="diabeteshistory" value="1"></center></td>
</tr>

<tr>
<td>Does anyone in your family have a history of heart disease?</td>
<td><center><input type="radio" name="heartdiseasehistory" value="0"></center></td>
<td><center><input type="radio" name="heartdiseasehistory" value="1"></center></td>
</tr>

<tr>
<td>Does anyone in your family have a history of Alzheimer's?</td>
<td><center><input type="radio" name="alzheimershistory" value="0"></center></td>
<td><center><input type="radio" name="alzheimershistory" value="1"></center></td>
</tr>

<tr>
<td>Does anyone in your family have a history of depression?</td>
<td><center><input type="radio" name="depressionhistory" value="0"></center></td>
<td><center><input type="radio" name="depressionhistory" value="1"></center></td>
</tr>

</table><br>

<button class="btn btn-large btn-primary" type="submit" value="Submit" />Submit!</button>
<br><br>

<br>Did you make a mistake?<br>
<button class="btn btn-large" type="reset" />Reset</button>
<!--<input type="reset">--><br><br>
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
