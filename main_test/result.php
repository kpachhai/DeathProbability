<?php
	 require '../setup/core.inc.php';
	 require '../setup/connect.inc.php';
	 
	 //echo "<b><center>DEATH PROBABILITY</center></b><br><br>";
	 
	if(!loggedin()) header('Location: ../index.php');

	function ageGroup($age){
		switch($age)
		{
			case($age < 0):
				return 0;
			case ($age > 0 && $age <= 14):
				return 1;
			case ($age > 14 && $age <= 24):
				return 2;
			case ($age > 24 && $age <= 34):
				return 3;
			case($age > 34 && $age <= 44):
				return 4;
			case($age > 44 && $age <= 54):
				return 5;
			case($age > 54 && $age <= 64):
				return 6;
			case($age > 64 && $age <= 74):
				return 7;
			case($age > 74):
				return 8;
		}
	}
	function queryDeathData($ageGroup, $gender){
		$query = "SELECT * FROM deathData WHERE AgeGroup = ".$ageGroup." AND Sex = '".$gender."'";
		$result = mysql_query($query);
		return $result;
	}
	
    function storeData($result){
		for($i = 0; $i < 13; $i++){
			$array[$i] = mysql_result($result, 0, ($i+3));
		}
		return $array;
	}

	function calcSmokeCancer($smoke, $stat){
		switch($smoke){
			case 0:
				return $stat;
			case 1:
				return ($stat*1.5);
			case 2:
				return ($stat*2);
			case 3:
				return ($stat*3);
			case 4:
				return ($stat*4);
		}
	}
	
	function calcSmokeHeart($smoke, $stat){
		
		switch($smoke){
			case 0:
				return $stat;
			case 1:
				return ($stat*1.1);
			case 2:
				echo 'case 2';
				return ($stat*1.5);
			case 3:
				return ($stat*2);
			case 4:
				return ($stat*3);
		}
	}
	
	function calcMealHeart($meal, $stat){
		
		switch($meal){
			case 0:
				return $stat;
			case 1:
				return ($stat*1.5);
			case 2:
				return ($stat*3);
			case 3:
				return ($stat*4);
			case 4:
				return ($stat*8);
		}
	}
	
	function calcDriveAccident($drive, $stat){
				switch($drive){
			case 0:
				return $stat;
			case 1:
				return ($stat*1.5);
			case 2:
				return ($stat*2);
			case 3:
				return ($stat*2.5);
			case 4:
				return ($stat*3);
		}
	}
	
	function calcDrinkCrime($drink, $stat){
				switch($drink){
			case 0:
				return $stat;
			case 1:
				return ($stat*1.5);
			case 2:
				return ($stat*2);
			case 3:
				return ($stat*2.5);
			case 4:
				return ($stat*3);
		}
	}
	
	function calcDrinkKidney($drink, $stat){
				switch($drink){
			case 0:
				return $stat;
			case 1:
				return ($stat*1.5);
			case 2:
				return ($stat*2);
			case 3:
				return ($stat*3);
			case 4:
				return ($stat*4);
		}
	}
	
	function calcStressFlu($stress, $stat){
		switch($stress){
			case 0:
				return $stat;
			case 1:
				return ($stat*2);
			case 2:
				return ($stat*3);
			case 3:
				return ($stat*4);
			case 4:
				return ($stat*5);		
		}
	}
	
	function calcStressStroke($stress, $stat){
		switch($stress){
			case 0:
				return $stat;
			case 1:
				return ($stat*2);
			case 2:
				return ($stat*3);
			case 3:
				return ($stat*5);
			case 4:
				return ($stat*7.5);		
		}
	}
	
	function calcAlz($alz, $stat){	
		if($alz){
			return $stat*4;
		}
		else {
			return $stat;
		}
	}
	
	function calcDiabetes($diabetes, $stat){	
		if($diabetes){
			return $stat*4;
		}
		else {
			return $stat;
		}
	}
	
	function calcHeart($heart, $stat){	
		if($heart){
			return $stat*4;
		}
		else {
			return $stat;
		}
	}
		
	function calcDepression($depression, $stat){	
		if($depression){
			return $stat*4;
		}
		else {
			return $stat;
		}
	}
	
	
	
	function calcHealth($statsArray){
		$statsArray[1] = calcDriveAccident($_SESSION['drive'], $statsArray[1]);
		$statsArray[2] = calcDrinkCrime($_SESSION['drink'], $statsArray[2]);
		$statsArray[3] = calcSmokeCancer($_SESSION['smoke'], $statsArray[3]);
		$statsArray[4] = calcSmokeHeart($_SESSION['smoke'], $statsArray[4]);
		$statsArray[4] = calcMealHeart($_SESSION['unhealthymeal'], $statsArray[4]);
		$statsArray[10] = calcStressFlu($_SESSION['stresslevel'], $statsArray[10]);
		$statsArray[6] = calcStressStroke($_SESSION['stresslevel'], $statsArray[6]);
		$statsArray[7] = calcAlz($_SESSION['alzheimershistory'], $statsArray[7]);
		$statsArray[8] = calcDiabetes($_SESSION['diabeteshistory'], $statsArray[8]);
		$statsArray[4]	= calcHeart($_SESSION['heartdiseasehistory'], $statsArray[4]);
		$statsArray[10]	= calcHeart($_SESSION['depressionhistory'], $statsArray[10]);
		$statsArray[11] = calcDrinkKidney($_SESSION['drink'], $statsArray[11]);
		$statsArray[12] = 0;
		for($i = 0; $i <12; $i++){
			$statsArray[12] += $statsArray[$i];
		}
		
		return $statsArray;
	}
	
	if(isset($_SESSION['age'])) {
		$result = queryDeathData(ageGroup($_SESSION['age']), $_SESSION['sex']);
		$stats = storeData($result);
		$stats = calcHealth($stats);
	}
	else {
		header('Location: deathprobability.php');
	}

?>

<!DOCTYPE html>

<head>
  <title>My Result</title>
  <script type="text/javascript" src="d3.v2.js">></script>
  <link rel="stylesheet" type ="text/css" href="style.css" />
  <link href="../assets/css/bootstrap.css" rel="stylesheet" />

  <script>
	var gen = new Array();
	var test = new Array();
	
	gen[0] = '<?php echo $stats[0]; ?>';
	gen[1] = '<?php echo $stats[1]; ?>';
	gen[2] = '<?php echo $stats[2]; ?>';
	gen[3] = '<?php echo $stats[3]; ?>';
	gen[4] = '<?php echo $stats[4]; ?>';
	gen[5] = '<?php echo $stats[5]; ?>';
	gen[6] = '<?php echo $stats[6]; ?>';
	gen[7] = '<?php echo $stats[7]; ?>';
	gen[8] = '<?php echo $stats[8]; ?>';
	gen[9] = '<?php echo $stats[9]; ?>';
	gen[10] = '<?php echo $stats[10]; ?>';
	gen[11] = '<?php echo $stats[11]; ?>';
	var total = '<?php echo $stats[12]; ?>';
	
	for(var i = 0; i < 12; i++){
		gen[i] = (100*(gen[i]/total));
	}
	
  </script>

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
        width: 1000px;
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
        padding: 8px;
        font-size: 14px;
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
  echo '<li class="active"><a href="deathprobability.php">Take the test again</a></li>';
  echo '<li><a href="../my_account/myaccount.php">My Account</a></li>';
  echo '<li><a href="history.php">History</a></li>';
  echo '<li><a href="../login_stuff/logout.php">Logout</a></li>';
  echo '</ul>';
  echo '<div class="login-text pull-right">';
  echo '<text class="login-text">Logged in as '.$surname.', '.$firstname.'.'.'</text>   ';
}
else {
  echo '<li><a href="../login_stuff/logout.php">Logout</a></li>';
  echo '</ul>';
  echo '<div class="login-text pull-right">';
  echo '<text class="login-text">Logged in as Guest.</text><br>';
}
?>
    </div> <!--login-text-->
    <h3 class="muted">Results</h3>
  </div> <!--masthead-->

<div id= "container">
	<div id ="piecontainer">
		<div id = "piedisplay"></div>
		<div id ="pie"></div>
	</div>
	<div id ="legend">
		<div id ="top spacer" class = "spacer"></div>
		<div id ="top spacer2" class = "spacer"></div>
		<div id ="top spacer3" class = "spacer"></div>

		<div class = "spacercolor"></div>
		<div id ="hiColor" class = "color"></div>
		<div id ="hiLabel" class = "key"> Other Health Issues</div>
		<div class = "spacercolor"></div>
		<div id ="stColor" class = "color"></div>
		<div id ="stLabel" class = "key">Stroke</div>

		<div id ="spacer 1" class = "spacer"></div>

		<div class = "spacercolor"></div>
		<div id ="aiColor" class = "color"></div>
		<div id ="aiLabel" class = "key"> Accidental Injuries</div>
		<div class = "spacercolor"></div>
		<div id ="alColor" class = "color"></div>
		<div id ="alLabel" class = "key">Alzheimer's</div>

		<div id ="spacer 2" class = "spacer"></div>

		<div class = "spacercolor"></div>
		<div id ="cdColor" class = "color"></div>
		<div id ="cdLabel" class ="key"> Crimes, Drugs, & Alcohol</div>
		<div class = "spacercolor"></div>
		<div id ="diColor" class = "color"></div>
		<div id ="diLabel" class = "key">Diabetes</div>

		<div id ="spacer 3" class ="spacer"></div>
		<div class = "spacercolor"></div>
		<div id ="caColor" class = "color"></div>
		<div id ="caLabel" class = "key">Cancer</div>
		<div class = "spacercolor"></div>
		<div id ="hyColor" class = "color"></div>
		<div id ="hyLabel" class = "key">Hyper Tension</div>

		<div id ="spacer 4" class ="spacer"></div>

		<div class = "spacercolor"></div>
		<div id ="hdColor" class ="color"></div>
		<div id ="hdLabel" class ="key">Heart-Disease</div>
		<div class = "spacercolor"></div>
		<div id ="flColor" class = "color"></div>
		<div id ="flLabel" class = "key">Flu & Pneumonia</div>

		<div id ="spacer 5" class ="spacer"></div>

		<div class = "spacercolor"></div>
		<div id ="luColor" class="color"></div>
		<div id ="luLabel" class="key">Lung Disease</div>
		<div class = "spacercolor"></div>
		<div id ="kiColor" class = "color"></div>
		<div id ="kiLabel" class = "key">Kidney Disease</div>
	</div>
</div>
<div id = "percentage" style = "font-weight: bold; position: relative; float: left; width: 500px; height: 50px; text-align: center;"></div>
<br>

<script type="text/javascript">

function drawGraph(){
	
	d3.select("#pie").select("svg").remove();
	d3.select("#piedisplay")
			.text('');	
	d3.select("#percentage")
			.text('');
	
	var width = 960,
    height = 500,
    outerRadius = Math.min(width, height) / 2,
    innerRadius = 0;
    data = gen,
    color = d3.scale.ordinal()
	.range(["#FF0000", "#00FF00", "#0000FF", "#FFFF00", "#FF00FF", "#00FFFF", "#FF9900", "#9933CC", "#9966FF", "#ff7676", "#ff9999", "#660033"]),
    donut = d3.layout.pie(),
    arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);

var vis = d3.select("#pie")
  .append("svg")
    .data([data])
    .attr("width", width)
    .attr("height", height);

var arcs = vis.selectAll("g.arc")
    .data(donut)
    .enter().append("g")
    .attr("class", "arc")
    .attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

arcs.append("path")
    .attr("fill", function(d, i) { 
	//return "white";
	return color(i); 
	})
    .attr("d", arc);

arcs.append("text")
    .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
    .attr("fill", "white")
    .attr("dy", ".35em")
    .attr("text-anchor", "middle")
    .attr("display", function(d) { return d.value > .15 ? null : "none"; })
    .text(
	function(d, i) { return d.value.toFixed(2)+"%"; }
	);
}

function drawSection(section){

		d3.select("#pie").select("svg").remove();
		
		var test = d3.select("#piedisplay")	
		.text('Other Health Issues');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(0)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

		arcs.append("text")
		.attr("fill", "white")
    		.attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
    		.attr("dy", ".35em")
    		.attr("text-anchor", "middle")
    		.attr("display", function(d) { return d.value > .15 ? null : "none"; })
    		.text(function(d, i) { return d.value.toFixed(2); });
	}

drawGraph();

var circle = d3.selectAll(".color")
	.append("svg")
	.attr("width", 50)
	.attr("height", 50);

circle.append("circle")

	.attr("r", 25)
	.attr("cx", 25)
	.attr("cy", 25)
	
	.on("mouseout", drawGraph);
	
	
	d3.select("#hiColor").style("fill", color(0));		
	d3.select("#aiColor").style("fill", color(1));
	d3.select("#cdColor").style("fill", color(2));
	d3.select("#caColor").style("fill", color(3));
	d3.select("#hdColor").style("fill", color(4));
	d3.select("#luColor").style("fill", color(5));
	d3.select("#stColor").style("fill", color(6));
	d3.select("#alColor").style("fill", color(7));
	d3.select("#diColor").style("fill", color(8));
	d3.select("#hyColor").style("fill", color(9));
	d3.select("#flColor").style("fill", color(10));
	d3.select("#kiColor").style("fill", color(11));


	d3.select("#hiColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		
		var test = d3.select("#piedisplay")	
		.text('Other Health Issues');
		
		var percent = d3.select("#percentage")
		.text(data[0]+'%');
		
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(0)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});
	

	d3.select("#aiColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Accidental Injuries');	

		var percent = d3.select("#percentage")
		.text(data[1]+'%');

		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(1)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#cdColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Crimes Drugs & Alcohol');
	
		var percent = d3.select("#percentage")
		.text(data[2]+'%');	
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(2)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#caColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Cancer');
		
		var percent = d3.select("#percentage")
		.text(data[3]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(3)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#hdColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Heart Disease');
		
		var percent = d3.select("#percentage")
		.text(data[4]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(4)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);


	});

	d3.select("#luColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Lung Disease');
		
		var percent = d3.select("#percentage")
		.text(data[5]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(5)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#stColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Stroke');
		
		var percent = d3.select("#percentage")
		.text(data[6]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(6)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#alColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text("Alzheimer's");
		
		var percent = d3.select("#percentage")
		.text(data[7]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(7)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#diColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Diabetes');
		
		var percent = d3.select("#percentage")
		.text(data[8]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(8)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#hyColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Hyper Tension');
		
		var percent = d3.select("#percentage")
		.text(data[9]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(9)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#flColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Flu & Pneumonia');
		
		var percent = d3.select("#percentage")
		.text(data[10]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(10)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	d3.select("#kiColor").on("mouseover", function(){

		d3.select("#pie").select("svg").remove();
		var test = d3.select("#piedisplay")	
		.text('Kidney Disease');
		
		var percent = d3.select("#percentage")
		.text(data[11]+'%');
	
		var width = 960,
    		height = 500,
    		outerRadius = Math.min(width, height) / 2,
    		innerRadius = 0;
    		data = data,
    		color1 = color,
    		donut = d3.layout.pie(),
    		arc = d3.svg.arc().innerRadius(innerRadius).outerRadius(outerRadius);


		var vis = d3.select("#pie")
  		.append("svg")
    		.data([data])
    		.attr("width", width)
    		.attr("height", height);

		var arcs = vis.selectAll("g.arc")
    		.data(donut)
    		.enter().append("g")
    		.attr("class", "arc")
    		.attr("transform", "translate(" + outerRadius + "," + outerRadius + ")");

		arcs.append("path")
    		.attr("fill", 
		function(d, i) { 
		if(color1(i) == color1(11)){
			return color1(i);
		}
		else{
			return "white";} 
		}
		)
    		.attr("d", arc);

	});

	

</script>
<center>
<?php echo '&nbsp;'; ?>
</center>
<br>
<center>
<iframe src="https://www.facebook.com/plugins/like.php?href=https://www.facebook.com/DeathProbability" scrolling="no" frameborder="0" style="border:none; width:175px; height:80px"></iframe>
</center>
<?php
	if($firstname != "deleteme" && $surname != "deleteme") {
?>

<center>
<script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u=https://www.facebook.com/DeathProbability&t=Take the death probability test','sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><style> html .fb_share_button { display: -moz-inline-block; display:inline-block; padding:1px 20px 0 5px; height:15px; border:1px solid #d8dfea; background:url(http://static.ak.fbcdn.net/images/share/facebook_share_icon.gif?0:26981) no-repeat top right; } html .fb_share_button:hover { color:#fff; border-color:#295582; background:#3b5998 url(http://static.ak.fbcdn.net/images/share/facebook_share_icon.gif?0:26981) no-repeat top right; text-decoration:none; } </style> <a href="http://www.facebook.com/share.php?u=<url>" class="fb_share_button" onclick="return fbs_click()" target="_blank" style="text-decoration:none;">Share your result</a>
</center>
<?php	
	}
?>
<center>
<a href="../extra_stuff/feedback.php"><u>Give us feedback</u></a>
</center>
<br>

</div> <!--container-narrow-->
</body>
</html>
