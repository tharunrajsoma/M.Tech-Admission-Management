<?php

if(isset($_POST["submit"]))
{
	// echo date('Y-m-d', strtotime(`1-Feb-2016`));
	// return;sDATE
	/*Define column names and their type*/
	$hardCodedColumnNamesTypes = array(
	'APPLICATION NUMBER' =>	'int(5)',
	'NAME' =>	'varchar(34)',
	'GENDER' =>	'varchar(6)',
	'MARITAL STATUS' =>	'varchar(7)',
	'BIRTH CATEGORY' =>	'varchar(25)',
	'DATE OF BIRTH' =>	'varchar(11)',
	'PLACE OF BIRTH' =>	'varchar(50)',
	'FATHER NAME' => 'varchar(33)',
	'DISABLE STATUS' =>	'varchar(16)',
	'DISABLE DESCRIPTION' => 'varchar(90)',
	'ADDRESS DETAILS' => 'varchar(175)',
	'MOBILE NUMBER' =>	'bigint(13)',
	'REGISTERED EMAIL ID' =>	'varchar(34)',
	'DEGREE TYPE NAME' =>	'varchar(7)',
	'DEGREE NAME' =>	'varchar(47)',
	'INSTITUTE NAME' =>	'varchar(85)',
	'UNIVERSITY' =>	'varchar(87)',
	'SPECILIZATION'	 => 'varchar(90)',
	'DIVISION' =>	'varchar(36)',
	'YEAR OF PASS' =>	'varchar(10)',
	'SECURED MARKS' =>	'varchar(5)',
	'TOTAL MARKS' =>	'varchar(4)',
	'PERCENTAGE OF MARKS' =>	'varchar(6)',
	'SECURED GP' =>	'varchar(4)',
	'TOTAL GP' =>	'varchar(4)',
	'PERCENTAGE OF GP' =>	'varchar(3)',
	'EXPERIENCE TYPE NAME' =>	'varchar(60)',
	'ORGANIZATION NAME' =>	'varchar(89)',
	'DESIGNITION' => 'varchar(53)',
	'FROM DATE' =>	'varchar(11)',
	'TO DATE'	 => 'varchar(11)',
	'DURATION' =>	'varchar(10)',
	'NATURE OF WORK' =>' varchar(362)',
	'ENTRY EXAM NAME' =>	'varchar(4)',
	'REGISTRATION NUMBER' =>	'varchar(14)',
	'EXAM YEAR' =>	'varchar(10)',
	'VALID UPTO' =>	'DATE',
	'GATE SCORE' =>	'decimal(6,2)',
	'GATE AIR' =>	'int(5)',
	'SPECILAZATION DESCRIPTION' =>	'varchar(10)',
	'PRIORITY' =>	'varchar(12)',
	'PROGRAM TYPE'	 => 'varchar(9)',
	'REFERENCE TYPE NAME' =>	'varchar(11)',
	'REFERENCE NUMBER' =>	'varchar(27)',
	'AMOUNT' =>	'int(3)'

	);
	// echo $hardCodedColumnNamesTypes['APPLICATION NUMBER'];

	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'rk3095@@@@');
	define('DB_DATABASE', 'test2');
	$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

	$filename=$_FILES["file"]["name"];
	$ext=substr($filename,strrpos($filename,"."),(strlen($filename)-strrpos($filename,".")));
	$filen = substr($filename, 0, -4); //filename without ".csv"

	//we check,file must be have csv extention
	if($ext==".csv")
	{
		/*-----------CSV File processing -----------*/
		$filePath = "/home/rahul/Desktop".'/'.$filename;
		// $filePath = $_SERVER['PWD'].'/'.$filename;

		$file = fopen($filePath, 'r');

		//Processing
		$num = 1;
		$columnNameArray = fgetcsv($file);
		// echo $columnNameArray[0];
		// echo array_key_exists(mixed $columnNameArray[0], array $hardCodedColumnNamesTypes);
		while (1) 
		{
			if ( array_key_exists($columnNameArray[0], $hardCodedColumnNamesTypes) == FALSE)
			{
				$columnNameArray = fgetcsv($file);
				$num = $num + 1;
			}
			else
			{
				break;
			}
		}
		
		
		$valsColumnNameArray = array_count_values($columnNameArray);

		$columnNameArray = array_reverse($columnNameArray);
		foreach ($columnNameArray as $key => $value)
		{
		    if ($valsColumnNameArray[$value] > 1) {

		    	$valsColumnNameArray[$value] = $valsColumnNameArray[$value] - 1;
		    	$columnNameArray[$key] = $columnNameArray[$key] . '$' .  $valsColumnNameArray[$value];
		    }
		}
		$columnNameArray = array_reverse($columnNameArray);

		// echo $columnNameArray[0];


		// Process to create table
		$columnNameArrayMysql = "";
		$columnNameString = "";
		

		$flagName = 0;
		$flagValidUpto = 0;
		foreach ($columnNameArray as $key => $value)
		{
			$valueT = explode('$', $value);
			// echo $value[0];


			// DateTime::createFromFormat('Y-m-d G:i:s', $myString)

			if($key == 0)
			{
				$columnNameArrayMysql = $columnNameArrayMysql . " `". $value . "` ". $hardCodedColumnNamesTypes[$valueT[0]];
				if ($value == 'NAME') 
				{
					$flagName = 1;
					$columnNameString = $columnNameString . '@var1';
				}
				elseif ($value == 'VALID UPTO') 
				{
					$flagValidUpto = 1;
					$columnNameString = $columnNameString . '@var2';
				}
				else
				{
					$columnNameString = $columnNameString . " `". $value . "`";
				}
			}
			else
			{
				$columnNameArrayMysql = $columnNameArrayMysql . ", `". $value . "` ". $hardCodedColumnNamesTypes[$valueT[0]];
				if ($value == 'NAME') 
				{
					$flagName = 1;
					$columnNameString = $columnNameString . ", ". '@var1';
				} 
				elseif ($value == 'VALID UPTO') 
				{
					$flagValidUpto = 1;
					$columnNameString = $columnNameString . ", ". '@var2';
				}
				else 
				{
					$columnNameString = $columnNameString . ", `". $value . "`";
				}
				
			}


			// echo $value, " ", $hardCodedColumnNamesTypes[$value], "\n";
		}

		// echo $columnNameArrayMysql;
		echo $columnNameString;

		/*-----------Create MYSQL Table -----------*/
		// CREATE TABLE pet (name VARCHAR(20), owner VARCHAR(20), species VARCHAR(20), sex CHAR(1), birth DATE, death DATE);
		$dropIfExists = "DROP TABLE IF EXISTS `{$filen}`";
		mysqli_query($db,$dropIfExists);
		$createTable = "CREATE TABLE `{$filen}` ({$columnNameArrayMysql})";
		// echo $createTable;
		mysqli_query($db,$createTable);


		// echo $file;
		if ($flagName == 0 && $flagValidUpto == 0) 
		{
			$q = "LOAD DATA LOCAL INFILE '{$filePath}' INTO TABLE `{$filen}` fields terminated by ',' OPTIONALLY ENCLOSED BY '\"' ignore {$num} lines";
		}
		elseif ($flagName == 1 && $flagValidUpto == 0) 
		{
			$q = "LOAD DATA LOCAL INFILE '{$filePath}' INTO TABLE `{$filen}` fields terminated by ',' OPTIONALLY ENCLOSED BY '\"' ignore {$num} lines ({$columnNameString}) set `NAME` = substr(@var1, 4) ";
		}
		elseif ($flagName == 0 && $flagValidUpto == 1) 
		{
			$q = "LOAD DATA LOCAL INFILE '{$filePath}' INTO TABLE `{$filen}` fields terminated by ',' OPTIONALLY ENCLOSED BY '\"' ignore {$num} lines ({$columnNameString}) set `VALID UPTO` = STR_TO_DATE(@var2, '%d-%b-%y')";
		}
		else
		{
			$q = "LOAD DATA LOCAL INFILE '{$filePath}' INTO TABLE `{$filen}` fields terminated by ',' OPTIONALLY ENCLOSED BY '\"' ignore {$num} lines ({$columnNameString}) set `NAME` = substr(@var1, 4), `VALID UPTO` = STR_TO_DATE(@var2, ''%d-%b-%Y' or '%Y-%m-%d'') ";
		}
		// %m/%d/%Y

		// $q = "LOAD DATA LOCAL INFILE '{$filePath}' INTO TABLE `{$filen}` fields terminated by ',' OPTIONALLY ENCLOSED BY '\"' ignore {$num} lines ({$columnNameString}) set `NAME` = substr(@var1, 4), 				CASE WHEN @var2 REGEXP '[d-b-Y]' THEN `VALID UPTO`  = STR_TO_DATE(@var2, '%d-%b-%Y')      					`VALID UPTO` = STR_TO_DATE(@var2, '%Y-%m-%d') ";

		// $q = "LOAD DATA LOCAL INFILE '{$filePath}' INTO TABLE {$filen} fields terminated by ',' OPTIONALLY ENCLOSED BY '\"' ignore {$num} lines ({$columnNameString}) set `VALID UPTO` = STR_TO_DATE(@var2, '%d-%b-%y') ";
		echo $q;
		echo $result = mysqli_query($db,$q);
		// LOAD DATA LOCAL INFILE '{$file}' INTO TABLE {$table}
		// mysql_query($q, $db);
	}
	else {
	    echo "Error: Please Upload only CSV File";
	}


}
?>