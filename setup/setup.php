<?php
	require 'connect.inc.php';
	
	$query = "CREATE TABLE Info (Id int(6) PRIMARY KEY NOT NULL auto_increment, Username varchar(50) NOT NULL, Name varchar(40) NOT NULL, Age int(6) NOT NULL, Sex varchar(6) NOT NULL, Weight double NOT NULL, HeightFt double NOT NULL, HeightIn double NOT NULL, State varchar(15) NOT NULL, 
		Smoke int(6) NOT NULL, Drink int(6) NOT NULL, Exercise int(6) NOT NULL, Drive int(6) NOT NULL, UnhealthyMeal int(6) NOT NULL, DiabetesHistory int(6) NOT NULL, HeartDiseaseHistory int(6) NOT NULL, AlzheimersHistory int(6) NOT NULL,
			StressLevel int(6) NOT NULL, DepressionHistory int(6) NOT NULL)"; 
	mysql_query($query);
		
	$query2 = "CREATE TABLE Login 
			(
			Id int(6) PRIMARY KEY NOT NULL auto_increment, 
			Username varchar(50) NOT NULL, 
			Password varchar(50) NOT NULL, 
			FirstName varchar(50) NOT NULL, 
			LastName varchar(50) NOT NULL)";
	mysql_query($query2);
		
	$root_password = 'root';
	$root_password_hash = md5($root_password);
		
	$query3 = "SELECT Id FROM Login WHERE Username='root' AND Password='$root_password_hash'";
	$query_run = mysql_query($query3);
		
	if($query_run) {
		$query_num_rows = mysql_num_rows($query_run);
		if($query_num_rows == 0) {						
			$query4 = "INSERT INTO Login VALUES('', 'root', '$root_password_hash', 'Admin', 'Admin')";
			mysql_query($query4);				
			echo 'Root created<br>';
		}
		else {
			echo 'Already created a root account<br>';
		}
	}
	
	$query5 = "CREATE TABLE counter (counter INT(20) NOT NULL)";
	$query5_run = mysql_query($query5);
	if($query5_run) {
		$query5_num_rows = mysql_num_rows($query5_run);
		if($query5_num_rows == 0) {
			$query6 = "INSERT INTO counter VALUES('0')";
			mysql_query($query6);
			echo 'Counter variable created<br>';
		}
		else {
			echo 'Already created a counter variable<br>';
		}
	}
	
	$deathDataQuery = "CREATE TABLE deathData
				(
				Id int(6) PRIMARY KEY NOT NULL auto_increment,
				AgeGroup int(0) NOT NULL,
				Sex varchar(8) NOT NULL,
				OtherHealthIssues int(7) NOT NULL,
				AccidentalInjuries int(7) NOT NULL,
				CrimesDrugsAlcohol int(7) NOT NULL,
				Cancer int(7) NOT NULL,
				HeartDisease int(7) NOT NULL,
				LungDisease int(7) NOT NULL,
				Stroke int(7) NOT NULL,
				Alzheimers int(7) NOT NULL,
				Diabetes int(7) NOT NULL,
				Hypertension int(7) NOT NULL,
				FluPneumonia int(7) NOT NULL,
				KidneyDisease int(7) NOT NULL,
				total int(7) NOT NULL
				)";
	$deathQueryRun = mysql_query($deathDataQuery);
	if($deathQueryRun){
		echo "Death Data Table Created<br>";
	}
	else{
		echo "Unable to create Death Data Table<br>";
	}
	
	$query = "INSERT INTO deathData VALUES(
			'',
			'0',
			'both',
			'180249',
			'89185',
			'91416',
			'490102',
			'386301',
			'132995',
			'128838',
			'79003',
			'68705',
			'61751',
			'52405',
			'49934',
			'1808884'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
	
	/*----- Age group 1 ------*/
		
	$query = "INSERT INTO deathData VALUES(
			'',
			'1',
			'female',
			'6919',
			'1643',
			'572',
			'144',
			'14',
			'20',
			'110',
			'0',
			'17',
			'2',
			'265',
			'65',
			'9711'
			)";
	$success = mysql_query($query);
	if($success)
		echo "Age Group 1 female death data entered <br>";
		
	$query = "INSERT INTO deathData VALUES(
			'',
			'1',
			'male',
			'8464',
			'2707',
			'800',
			'164',
			'23',
			'37',
			'158',
			'0',
			'15',
			'5',
			'304',
			'85',
			'12762'
			)";
	$success = mysql_query($query);
	if($success)
		echo "Age Group 1 male death data entered <br>";
	
	
	/*----- Age group 2 ------*/
		
	$query = "INSERT INTO deathData VALUES(
			'',
			'2',
			'female',
			'731',
			'2198',
			'2542',
			'361',
			'24',
			'10',
			'85',
			'0',
			'77',
			'35',
			'141',
			'44',
			'6248'
			)";
	$success = mysql_query($query);
	if($success)
		echo "Age Group 2 female death data entered <br>";
		
	$query = "INSERT INTO deathData VALUES(
			'',
			'2',
			'male',
			'1096',
			'6926',
			'10221',
			'528',
			'89',
			'11',
			'108',
			'0',
			'90',
			'58',
			'183',
			'45',
			'19355'
			)";
	$success = mysql_query($query);
	if($success)
		echo "Age Group 2 male death data entered <br>";
	
	/*----Age group 3 ------*/
	//Female
	$query = "INSERT INTO deathData VALUES(
			'',
			'3',
			'female',
			'1510',
			'2130',
			'3593',
			'1442',
			'241',
			'34',
			'239',
			'0',
			'251',
			'172',
			'284',
			'135',
			'10031'
			)";
	$success = mysql_query($query);
	if($success)
		echo "Age group 3 Female data entered <br>";
	//Male
	$query = "INSERT INTO deathData VALUES(
			'',
			'3',
			'male',
			'2999',
			'6102',
			'12531',
			'1183',
			'714',
			'33',
			'298',
			'0',
			'371',
			'319',
			'149',
			'353',
			'25052'
			)";
	$success = mysql_query($query);
	if($success)
		echo "Age group 3 Male data entered <br>";
	
	/*---- Age Group 4 ----*/
	//Female
	$query = "INSERT INTO deathData VALUES(
			'',
			'4',
			'female',
			'2839',
			'1922',
			'5092',
			'6140',
			'1389',
			'213',
			'872',
			'0',
			'664',
			'639',
			'490',
			'388',
			'20648'
			)";
	$success = mysql_query($query);
	if($success)
		echo "Age group 4 Female data entered <br>";
	
	//Male
	$query = "INSERT INTO deathData VALUES(
			'',
			'4',
			'male',
			'5964',
			'5931',
			'12767',
			'4038',
			'4185',
			'226',
			'1044',
			'0',
			'1208',
			'1312',
			'591',
			'476',
			'37734'
			)";
	$success = mysql_query($query);
	if($success)
		echo "Age group 4 Male data entered <br>";
		
		
	/*---- Age Group 5 ----*/
	//Female
	$query = "INSERT INTO deathData VALUES(
			'',
			'5',
			'female',
			'6254',
			'2777',
			'7268',
			'20965',
			'5648',
			'2039',
			'2778',
			'64',
			'2123',
			'1885',
			'1139',
			'1042',
			'53982'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
	
	//Male
	$query = "INSERT INTO deathData VALUES(
			'',
			'5',
			'male',
			'13801',
			'7821',
			'15637',
			'20458',
			'17637',
			'2044',
			'3385',
			'48',
			'3602',
			'3760',
			'1355',
			'1361',
			'95145'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
	
		
	/*---- Age Group 6 ----*/
	//Female
	$query = "INSERT INTO deathData VALUES(
			'',
			'6',
			'female',
			'8444',
			'2715',
			'3513',
			'41376',
			'12573',
			'6465',
			'4546',
			'387',
			'4524',
			'2831',
			'1685',
			'2142',
			'91201'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
	
	//Male
	$query = "INSERT INTO deathData VALUES(
			'',
			'6',
			'male',
			'18280',
			'6782',
			'9283',
			'47807',
			'33445',
			'7171',
			'5977',
			'327',
			'6837',
			'5288',
			'2209',
			'2750',
			'146156'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
	
	
	/*---- Age Group 7 ----*/
	//Female
	$query = "INSERT INTO deathData VALUES(
			'',
			'7',
			'female',
			'10658',
			'3281',
			'3332',
			'58409',
			'21445',
			'15221',
			'8295',
			'2290',
			'6490',
			'3644',
			'2752',
			'3935',
			'139752'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
		
	//Male
	$query = "INSERT INTO deathData VALUES(
			'',
			'7',
			'male',
			'13976',
			'5459',
			'3816',
			'66980',
			'40884',
			'15541',
			'9283',
			'1819',
			'8295',
			'4617',
			'3434',
			'4418',
			'178522'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
		
	
	/*---- Age Group 8 ----*/
	//Female
	$query = "INSERT INTO deathData VALUES(
			'',
			'8',
			'female',
			'43642',
			'16478',
			'945',
			'108754',
			'134917',
			'45362',
			'59841',
			'52362',
			'19505',
			'24882',
			'21185',
			'17810',
			'545683'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
	
	//Male
	$query = "INSERT INTO deathData VALUES(
			'',
			'3',
			'male',
			'35413',
			'14135',
			'3373',
			'105185',
			'113073',
			'38568',
			'31819',
			'21697',
			'14654',
			'12250',
			'16069',
			'15089',
			'421325'
			)";
	$success = mysql_query($query);
	if($success)
		echo "general death data entered <br>";
	
	
	mysql_close();

?>
