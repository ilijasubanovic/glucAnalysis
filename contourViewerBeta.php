<!--V4 7.1.2015-->
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<head>
		<link href="examples.css" rel="stylesheet" type="text/css">
	</head> 
	<form enctype="multipart/form-data" action="contourViewerBeta.php" method="POST">
	<body><div class="MyCSSTable">
		<table id="naslov">
			<tr>
				<td  class="title" style="background:linear-gradient(90deg,#1C3F95 5%,#ffffff,#ffffff,#1C3F95 95%); color:#1C3F95;">
					<img src="./contourImage.jpg" alt="some_text" style="height:60px">
					<font size="60">CSV viewer</font>
				</td>
			</tr>
		</table>
		<table>
			<tr>
				<td class="row" >
					Choose CSV file:
					<div class="fileinputs">
						<input name="userfile" type="file" value="Upload File"/>
						<input type="submit"/>
					</div>
				</td>
				<td  class="row">
					<span>Start of Day</span></br>
					<input type="range" id="RangeDay" min="0" max="48" value="13" step="1" oninput="showTime(this.value,this.id)" onchange="showTime(this.value,this.id)" /></br>
					<span id="spanRangeDay" style="text-align: center;"	></span>
					<input type="hidden" name="spanRangeDay" id="spanRangeDaySend" value="12:12"></input>		
				</td>
				<td  class="row">
					<span>End of Morning</span></br>
					<input type="range" id="RangeMorning" min="0" max="48" value="13" step="1" oninput="showTime(this.value,this.id)" onchange="showTime(this.value,this.id)" /></br>
					<span id="spanRangeMorning"></span>
					<input type="hidden" name="spanRangeMorning" id="spanRangeMorningSend" value="12:12"></input>												
				</td>
				<td  class="row">
					<span>Start of Noon</span></br>
					<input type="range" id="RangeNoonStart" min="0" max="48" value="13" step="1" oninput="showTime(this.value,this.id)" onchange="showTime(this.value,this.id)" /></br>
					<span id="spanRangeNoonStart"></span>
					<input type="hidden" name="spanRangeNoonStart" id="spanRangeNoonStartSend" value="12:12"></input>								
				</td>
				<td  class="row">
					<span>End of Noon</span></br>
					<input type="range" id="RangeNoon" min="0" max="48" value="13" step="1" oninput="showTime(this.value,this.id)" onchange="showTime(this.value,this.id)" /></br>
					<span id="spanRangeNoon"></span>
					<input type="hidden" name="spanRangeNoon" id="spanRangeNoonSend" value="12:12"></input>
				</td>
				<td  class="row">
					<span>Start of Evening</span></br>
					<input type="range" id="RangeEveningStart" min="0" max="48" value="13" step="1" oninput="showTime(this.value,this.id)" onchange="showTime(this.value,this.id)" /></br>
					<span id="spanRangeEveningStart"></span>
					<input type="hidden" name="spanRangeEveningStart" id="spanRangeEveningStartSend" value="12:12"></input>
				</td>
				<td  class="row">
					<span>End of Evening</span></br>
					<input type="range" id="RangeEvening" min="0" max="48" value="13" step="1" oninput="showTime(this.value,this.id)" onchange="showTime(this.value,this.id)" /></br>
					<span id="spanRangeEvening"></span>
					<input type="hidden" name="spanRangeEvening" id="spanRangeEveningSend" value="12:12"></input>
				</td>										
				<td  class="row">
					<span>Min</span></br>
					<input type="range" id="Min" min="1" max="20" value="13" step="1" oninput="showGL(this.value,this.id)" onchange="showGL(this.value,this.id)" /></br>
					<span id="spanMin"></span>
					<input type="hidden" name="spanMin" id="spanMinSend" value="12:12"></input>
				</td>
				<td  class="row">
					<span>Max</span></br>
					<input type="range" id="Max" min="1" max="20" value="13" step="1" oninput="showGL(this.value,this.id)" onchange="showGL(this.value,this.id)" /></br>
					<span id="spanMax"></span>
					<input type="hidden" name="spanMax" id="spanMaxSend" value="12:12"></input>
				</td>
			</tr>
		</table>
		</div>
		</body>
	</form>
<html>


	<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../../excanvas.min.js"></script><![endif]-->
<script language="javascript" type="text/javascript" src="jquery.js"></script>
<script language="javascript" type="text/javascript" src="jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="jquery.flot.resize.js"></script>

<script type="text/javascript">

function showGraph() {

		var d1 = [];
		for (var i = 0; i < 14; i += 1) {
			d1.push([i, i]);
		}
	$.plot("#placeholder", [ d1]);
}

function showGL(newValue,id)
{
	var y=newValue;
	pid="span"+id;
	document.getElementById(pid).innerHTML=y;
	pid+="Send";
	document.getElementById(pid).value=y;
}
function showTime(newValue,id)
{
	var x=newValue%2;
	if (x==1)
	{
		y=(newValue/2);
		y-=0.5;
		y+=":30";
	}
	else
	{
		y=newValue/2;
		y+=":00";
	}
	pid="span"+id;
	document.getElementById(pid).innerHTML=y;
	pid+="Send";
	document.getElementById(pid).value=y;
}

window.onload = function(){
    showTime(12,"RangeDay");
    showTime(23,"RangeMorning");
	showTime(33,"RangeNoon");
	showTime(47,"RangeEvening");
	showTime(21,"RangeNoonStart");
	showTime(32,"RangeEveningStart");
	showGL(4,"Min");
	showGL(10,"Max");
}
</script>
</html>

<?php
	function calculateAverage($tableArray,$weekNumber)
	{
		$lastRow = sizeof($tableArray);
		$lastRow -= 2;
		$rc =0;
		
		//fill first field with week number
		$tableArray[$lastRow-2][0] = "Week : ";
		$tableArray[$lastRow-2][0] .= $weekNumber;
		$tableArray[$lastRow-2][0] .= " average";
		
		//for each column
		for($i=1;$i<15;$i++)
		{
			$count = 0;
			$tableArray[$lastRow-2][$i] = "";
			//for last seven days
			for($x=3;$x<10;$x++)
			{
				if($lastRow>$x-1)
				{
					if($tableArray[$lastRow-$x][$i] != "")
					{
						$pieces = explode(", ", $tableArray[$lastRow-$x][$i]); //if more values exist in same field with ", " delimiter
						$sizeField = sizeof($pieces);
						for($j = 0; $j < $sizeField;$j++) //loop through all values in field 
						{
							$tableArray[$lastRow-2][$i] += $pieces[$j]; //set sum
							$count +=1; //count 
						}
					}
				}
			}
			//if there are any measurements in that period
			if($tableArray[$lastRow-2][$i] != "")
			{
				//for glucose levels calculate only average
				if($i<8 OR ($i>11 AND $i<14))
				{
					$tableArray[-1][$i] += $tableArray[$lastRow-2][$i];
					$tableArray[-2][$i] += $count;
					$tableArray[$lastRow-2][$i] /= $count;
					$tableArray[$lastRow-2][$i] = round($tableArray[$lastRow-2][$i], 2);
					
				}
				//for insulin inputs and total measurement number calculate average and sum
				else
				{
					$tmp = $tableArray[$lastRow-2][$i];
					$tableArray[$lastRow-2][$i] = "SUM : ";
					$tableArray[$lastRow-2][$i] .= $tmp;
					$tableArray[-1][$i] += $tmp;
					$tableArray[-2][$i] += $count;
					$tableArray[$lastRow-2][$i] .= "<br>AV: ";
					$tmp /= $count;
					$tableArray[$lastRow-2][$i] .= round($tmp,2);
				}
			}
			else $tableArray[$lastRow-2][$i] = "";
		}
		return $tableArray;
	}
	//function to format date if date in dd.mm.yyyy format
	function formatDate($dateIn)
	{
	//echo($dateIn);
	//echo(substr($dateIn,2,1));
		if(substr($dateIn,2,1)==".")
		{
					

			$dateIn=str_replace(".","/",$dateIn);
			$tmpStr=substr($dateIn,3,3);
			$tmpStr.=substr($dateIn,0,3);
			$tmpStr.=substr($dateIn,6,4);
		}
		//already in correct format mm/dd/yyyy
		else
			$tmpStr = $dateIn;
			//echo($tmpStr);
		return $tmpStr;
	}
	//set initial variables
	if( isset($_POST['languageR']) )
	{
		$language=$_POST["languageR"];
	}
	else 
		$language="en";
	
	$morningStart = "06:00";
	$morningEnd = "11:30";
	$noonStart = "10:30";
	$noonEnd = "16:30";
	$eveningStart = "16:00";
	$eveningEnd = "23:59";
	$nightStart = "00:00";
	$nightEnd = "06:00";
	$dayStart = "06:00";
	$maxGL = 10;
	$minGL = 4;
	if(isset($_POST['spanRangeDay']) AND isset($_POST['spanRangeMorning']) AND isset($_POST['spanRangeNoonStart'])
	AND isset($_POST['spanRangeNoon']) AND isset($_POST['spanRangeEveningStart']) AND isset($_POST['spanRangeEvening']))
	{
		if(strtotime($_POST['spanRangeDay'])<strtotime($_POST['spanRangeMorning']) AND 
		strtotime($_POST['spanRangeNoonStart'])<strtotime($_POST['spanRangeNoon']) AND 
		strtotime($_POST['spanRangeEveningStart'])<strtotime($_POST['spanRangeEvening']))
		{
			if( isset($_POST['spanRangeDay']) )
			{
				$morningStart=$_POST["spanRangeDay"];
				$nightEnd = $_POST["spanRangeDay"];
				$dayStart = $_POST["spanRangeDay"];
			}
			if( isset($_POST['spanRangeMorning']) )
			{
				$morningEnd=$_POST["spanRangeMorning"];
			}	
			if( isset($_POST['spanRangeNoonStart']) )
			{
				$noonStart=$_POST["spanRangeNoonStart"];
			}
			if( isset($_POST['spanRangeNoon']) )
			{
				$noonEnd=$_POST["spanRangeNoon"];
			}	
			if( isset($_POST['spanRangeEveningStart']) )
			{
				$eveningStart=$_POST["spanRangeEveningStart"];
			}
			if( isset($_POST['spanRangeEvening']) )
			{
				$eveningEnd=$_POST["spanRangeEvening"];
				$nightStart=$_POST["spanRangeEvening"];
			}	
			if( isset($_POST['spanMax']) )
			{
				$maxGL=$_POST["spanMax"];
			}
			if( isset($_POST['spanMin']) )
			{
				$minGL=$_POST["spanMin"];
			}
		}
		else
			echo("Day period ranges are not set correct. Default ones will be used.");
	}
	$fileExists=0;
	
	if(isset($_FILES['userfile']))
	{
		$fileExists=1;
		//open file
		if (($handle = fopen($_FILES['userfile']['tmp_name'], 'r')) !== FALSE AND $fileExists==1) {
			//initialize variables
			$currentDate = "00";	
			$ind = 0;
			$gDay = "start";
			
			//loop through all csv records in file
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				//if not first line ("Date" or "Datum")
				$firstLine = array("Date", "Dato", "Datum", "Fecha", "Data", "?µ???µ????", "Päivämäärä");
				if(!(in_array($data[0], $firstLine))) {
				$formatedDate=formatDate($data[0]);
					//set current date to one in current record
					$currentDay = date('l', strtotime($formatedDate));

					//initialize array when first record
					if($gDay == "start") {
						$gDay = date('l', strtotime($formatedDate));
						$myar[$ind][0] = "";
						$myar[$ind][1] = "";
						$myar[$ind][2] = "";
						$myar[$ind][3] = "";
						$myar[$ind][4] = "";
						$myar[$ind][5] = "";
						$myar[$ind][6] = "";
						$myar[$ind][7] = "";
						$myar[$ind][8] = "";
						$myar[$ind][9] = "";
						$myar[$ind][10] = "";
						$myar[$ind][11] = "";
						$myar[$ind][12] = "100";
						$myar[$ind][13] = "1";					
						$myar[$ind][14] = "0";				
					}
					//if new day, create new row
					if($currentDay != $gDay) {
						//reset measurement counter variable
						$count = 0;
						//find MIN and MAX for previous row (loop through records in previous array row)
						for($x=1;$x<8;$x++){
							if ($myar[$ind][$x] != "") //if not empty
							{
								$pieces = explode(", ", $myar[$ind][$x]); //if more values exist in same field put them to array ", " delimiter
								$sizeField = sizeof($pieces);
								$count += $sizeField; //increase measurement counter with number of values in field
								for($i = 0; $i < $sizeField;$i++) //loop through all values in field and check for min and max
								{
									if(($pieces[$i] != "") AND ($pieces[$i] < $myar[$ind][12]))
										$myar[$ind][12] = $pieces[$i]; //set MIN
									if(($pieces[$i] != "") AND ($pieces[$i] > $myar[$ind][13]))
										$myar[$ind][13] = $pieces[$i]; // set MAX
								}
							}
						}
						// add measurement count value to last field of row
						$myar[$ind][14] = $count;
						//create new row (increase index and set default values into array)
						$ind++;
						$myar[$ind][0] = "";
						$myar[$ind][1] = "";
						$myar[$ind][2] = "";
						$myar[$ind][3] = "";
						$myar[$ind][4] = "";
						$myar[$ind][5] = "";
						$myar[$ind][6] = "";
						$myar[$ind][7] = "";				
						$myar[$ind][8] = "";
						$myar[$ind][9] = "";
						$myar[$ind][10] = "";
						$myar[$ind][11] = "";
						$myar[$ind][12] = "100";
						$myar[$ind][13] = "1";
						$myar[$ind][14] = "0";
						
						$gDay = $currentDay;
					}
					if($language == "cro")
					{
						switch($currentDay) {
							case "Monday": $currentDay = "Ponedjeljak"; break;
							case "Tuesday": $currentDay = "Utorak"; break;
							case "Wednesday": $currentDay = "Srijeda"; break;
							case "Thursday": $currentDay = "Cetvrtak"; break;
							case "Friday": $currentDay = "Petak"; break;
							case "Saturday": $currentDay = "Subota"; break;
							case "Sunday": $currentDay = "Nedjelja"; break;
						}
					}
					$flag=0;
					//Fill first field (day, date)
					$myar[$ind][0] = $currentDay;
					$myar[$ind][0] .= "  -  ";
					$myar[$ind][0] .= $formatedDate;
					
					$beforeAfterMark = explode(", ", $data[18]);
					//HR, EN, DK, FN, FR, NL, NO, D, P, SI, E, S, I, G
					$checkBefore = array("Prije obroka", "Nataste", "Before Meal ", "Fasting", "For maltid ", "Fastende", "Ennen ateriaa ", "Paasto", "Avant repas ", "A jeun", "Voor de maaltijd ", "Nuchter", "For mat ", "For maltid ", "Fastende",	"Vor Mahlzeit ", "Nüchtern", "Antes da ingestao de alimentos ", "Jejum", "Pred obrokom", "Na tesce", "Antes de comer ", "En ayunas", "Före mat", "Fastar", "Pre pasto ", "Digiuno", "???? ?? ???µ? ", "?? ???????");
					$checkFastActing = array("Brzodjelujuci", "Fast-Acting", "Hurtig virk", "Nopeavaik. ins.", "rapide Action ", "Kortwerkend", "Rasktvirkende", "Schnellwirks", "Rápida", "Kratkodelujoci", "Snabbverkande", "veloce Azione", "??????? ????.");
					$checkLongActing = array("Dugodjelujuci", "Long-Acting", "Langsom virk", "Pitkävaik. ins.", "lente Action", "Langwerkend", "Langvarig", "Langwirksam", "Lenta", "Dolgodelujoci", "Langverkande", "lenta Azione", "?????? ????.");
					$checkLongActing = array("Dugodjelujuci", "Long-Acting", "Langsom virk", "Pitkävaik. ins.", "lente Action", "Langwerkend", "Langvarig", "Langwirksam", "Lenta", "Dolgodelujoci", "Langverkande", "lenta Azione", "?????? ????.");
					
					//GL before meal
					if($data[2] != "" AND (in_array($beforeAfterMark[0], $checkBefore))) {
						//morning
						if(strtotime($data[1]) > strtotime("$morningStart") and strtotime($data[1]) <= strtotime("$noonStart"))
						{
							if ($myar[$ind][1] != "") 
								$myar[$ind][1] .= ", ";
							$myar[$ind][1] .= $data[2];
						}
						else if(strtotime($data[1]) > strtotime("$noonStart") and strtotime($data[1]) <= strtotime("$eveningStart"))
						//noon
						{
							if ($myar[$ind][3] != "") 
								$myar[$ind][3] .= ", ";
							$myar[$ind][3] .= $data[2];
							if($myar[$ind][4] != "")
							{
								if($myar[$ind][2] != "")
									$myar[$ind][2] .= ", ";
								$myar[$ind][2] .= $myar[$ind][4];
								$myar[$ind][4] = "";
							}
						}
						else if((strtotime("$eveningEnd")>strtotime("$eveningStart") AND strtotime($data[1]) > strtotime("$eveningStart") and strtotime($data[1]) <= strtotime("$eveningEnd")) OR
						(strtotime("$eveningEnd")<strtotime("$eveningStart") AND strtotime($data[1]) > strtotime("$eveningStart")) OR
						(strtotime("$eveningEnd")<strtotime("$eveningStart") AND strtotime($data[1]) < strtotime("$eveningStart") AND strtotime($data[1]) < strtotime("$eveningEnd")))
						//evening
						{	
							if ($myar[$ind][5] != "") 
								$myar[$ind][5] .= ", ";
							$myar[$ind][5] .= $data[2];
							if($myar[$ind][6] != "")
							{
								if($myar[$ind][4] != "")
									$myar[$ind][4] .= ", ";
								$myar[$ind][4] .= $myar[$ind][6];
								$myar[$ind][6] = "";
							}						
						}
						//night
						else if(strtotime($data[1]) <= strtotime("$dayStart"))
						{
							if($ind != 0)  //inserted to prevent index going to -1 for first record in csv file, if first record in file, should go to previous day that doent exist, so goes to same day
							{	$flag=1;
								$ind--;
							}
								
							if($data[2] < $myar[$ind][12]) $myar[$ind][12] = $data[2];
							if($data[2] > $myar[$ind][13]) $myar[$ind][13] = $data[2];
							$myar[$ind][14] += 1;
							if ($myar[$ind][7] != "") 
								$myar[$ind][7] .= ", ";
							$myar[$ind][7] .= $data[2];
							if($ind != 0)  //inserted to prevent index going to -1 for first record in csv file, if first record in file, should go to previous day that doent exist, so goes to same day
							if($flag == 1)
							{
								$ind++;
								$flag=0;
							}
						}
						else if(strtotime("$nightStart")>strtotime("$dayStart") AND strtotime($data[1]) >= strtotime("$nightStart") and strtotime($data[1]) > strtotime("$dayStart"))
						{
							if ($myar[$ind][7] != "") 
								$myar[$ind][7] .= ", ";
							$myar[$ind][7] .= $data[2];
						}
					}	
					//GL after			
					else if($data[2] != "") 
					{
						//morning
						if(strtotime($data[1]) > strtotime("$morningStart") and strtotime($data[1]) <= strtotime("$morningEnd"))
						{
							if ($myar[$ind][2] != "") 
								$myar[$ind][2] .= ", ";
							$myar[$ind][2] .= $data[2];
						}
						//noon
						else if(strtotime($data[1]) > strtotime("$morningEnd") and strtotime($data[1]) <= strtotime("$noonEnd"))
						{
							if ($myar[$ind][4] != "") 
								$myar[$ind][4] .= ", ";
							$myar[$ind][4] .= $data[2];
						}
						//evening
						else if((strtotime("$eveningEnd")>strtotime("$eveningStart") AND strtotime($data[1]) > strtotime("$noonEnd") and strtotime($data[1]) <= strtotime("$eveningEnd")) OR
						(strtotime("$eveningEnd")<strtotime("$eveningStart") AND strtotime($data[1]) > strtotime("$eveningStart")) OR
						(strtotime("$eveningEnd")<strtotime("$eveningStart") AND strtotime($data[1]) < strtotime("$eveningStart") AND strtotime($data[1]) < strtotime("$eveningEnd")))
						{
							if(strtotime($data[1]) <= strtotime("$dayStart"))
							{
								if($ind != 0)  //inserted to prevent index going to -1 for first record in csv file, if first record in file, should go to previous day that doent exist, so goes to same day
								{	$flag=1;
									$ind--;
								}
								if($data[2] < $myar[$ind][12]) $myar[$ind][12] = $data[2];
								if($data[2] > $myar[$ind][13]) $myar[$ind][13] = $data[2];
								$myar[$ind][14] += 1;
								if ($myar[$ind][6] != "") 
									$myar[$ind][6] .= ", ";
								$myar[$ind][6] .= $data[2];

								if($flag == 1)
								{
									$ind++;
									$flag=0;
								}
							}
							else
							{
								if ($myar[$ind][6] != "") 
									$myar[$ind][6] .= ", ";
								$myar[$ind][6] .= $data[2];
							}
						}
						//night strtotime("$nightStart")<strtotime("$dayStart") AND 
						else if(strtotime($data[1]) <= strtotime("$dayStart"))
						{
							if($ind != 0)  //inserted to prevent index going to -1 for first record in csv file, if first record in file, should go to previous day that doent exist, so goes to same day
							{	$flag=1;
								$ind--;
							}
							if($data[2] < $myar[$ind][12]) $myar[$ind][12] = $data[2];
							if($data[2] > $myar[$ind][13]) $myar[$ind][13] = $data[2];
							$myar[$ind][14] += 1;
							if ($myar[$ind][7] != "") 
								$myar[$ind][7] .= ", ";
							$myar[$ind][7] .= $data[2];
							if($flag == 1)
							{
								$ind++;
								$flag=0;
							}
						}
						else if(strtotime("$nightStart")>strtotime("$dayStart") AND strtotime($data[1]) >= strtotime("$nightStart") and strtotime($data[1]) > strtotime("$dayStart"))
						{
							if ($myar[$ind][7] != "") 
								$myar[$ind][7] .= ", ";
							$myar[$ind][7] .= $data[2];
						}
					}
					//insulin values
					
					else if ($data[14] != "")
					{
						//morning
						if((in_array($data[14], $checkFastActing)) AND strtotime($data[1]) > strtotime("$dayStart") and strtotime($data[1]) <= strtotime("$noonStart"))
						{
							if ($myar[$ind][8] != "") 
								$myar[$ind][8] .= ", ";
							$myar[$ind][8] .= $data[13];
						}
						//noon
						else if((in_array($data[14], $checkFastActing)) AND strtotime($data[1]) > strtotime("$noonStart") and strtotime($data[1]) <= strtotime("$eveningStart"))
						{
							if ($myar[$ind][9] != "") 
								$myar[$ind][9] .= ", ";
							$myar[$ind][9] .= $data[13];
						}
						//evening
						else if(in_array($data[14], $checkFastActing) AND (
								(strtotime($data[1]) > strtotime("$eveningStart")) OR 
								(strtotime($data[1]) < strtotime("$eveningStart") AND strtotime($data[1]) < strtotime("$dayStart"))))
						{
							if(strtotime($data[1]) < strtotime("$eveningStart") AND strtotime($data[1]) < strtotime("$dayStart"))
							{
								if($ind != 0)  //inserted to prevent index going to -1 for first record in csv file, if first record in file, should go to previous day that doent exist, so goes to same day
								{	$flag=1;
									$ind--;
								}
								if ($myar[$ind][10] != "") 
									$myar[$ind][10] .= ", ";
								$myar[$ind][10] .= $data[13];
								if($flag == 1)
								{
									$ind++;
									$flag=0;
								}
							}
							else
							{
								if ($myar[$ind][10] != "") 
									$myar[$ind][10] .= ", ";
								$myar[$ind][10] .= $data[13];
							}
						}
						//night
						else if (in_array($data[14], $checkLongActing))
						{
							//if after midnight, belongs to previous day
							if(strtotime($data[1]) <= strtotime("$dayStart"))
							{
								if($ind != 0)  //inserted to prevent index going to -1 for first record in csv file, if first record in file, should go to previous day that doent exist, so goes to same day
								{	$flag=1;
									$ind--;
								}
								if ($myar[$ind][11] != "") 
									$myar[$ind][11] .= ", ";
								$myar[$ind][11] .= $data[13];
								if($flag == 1)
								{
									$ind++;
									$flag=0;
								}
							}
							else
							{
							if ($myar[$ind][11] != "") 
								$myar[$ind][11] .= ", ";
							$myar[$ind][11] .= $data[13];
							}
						}
						//other insulins
						else if(!(in_array($data[14], $checkLongActing)) AND !(in_array($data[14], $checkFastActing)))
						{
							//if after midnight, belongs to previous day
							if(strtotime($data[1]) >= strtotime("00:00") and strtotime($data[1]) <= strtotime("$eveningStart"))
							{
								if($ind != 0)  //inserted to prevent index going to -1 for first record in csv file, if first record in file, should go to previous day that doent exist, so goes to same day
								{	$flag=1;
									$ind--;
								}
								if ($myar[$ind][11] != "") 
									$myar[$ind][11] .= ", ";
								$myar[$ind][11] .= $data[13];
								if($flag == 1)
								{
									$ind++;
									$flag=0;
								}
							}
							else
							{
							if ($myar[$ind][11] != "") 
								$myar[$ind][11] .= ", ";
							$myar[$ind][11] .= $data[13];
							}
						}
					}//end if insulin
				}//end if first row
			}//end while loop
			
			//analysis, after each week add new row with analysis and last row at the end with total sum
			$weekNumber = 0;
			$x = 0;
			$indexNewArray = 0;
			//create two rows in array to sumarize all measurements
			for($x=0;$x<15;$x++){
				$tmpArray[-1][$x] = 0;
				$tmpArray[-2][$x] = 0;
			}
			$tmpX=sizeof($myar);
			for($x=0;$x<$tmpX;$x++){
				$pieces = explode(" - ", $myar[$x][0]);
				
				//if first row set weeknumber
				if ($weekNumber == 0)
					$weekNumber = date("W", strtotime($pieces[1]));
				//if same week just add row
				if($weekNumber == date("W", strtotime($pieces[1])))
					$tmpArray[$x+$indexNewArray] = $myar[$x];
				//if new week add new row with analysis of previous week
				else
				{
					$indexNewArray += 1;
					$y = $x;
					$y += $indexNewArray;
					$tmpArray[$y-1] = $myar[$x];
					$tmpArray[$y] = $myar[$x];
					$weekNumber = date("W", strtotime($pieces[1]));
					$tmpPieces = explode(" - ", $myar[$x-1][0]);
					$previousWeekNumber = date("W", strtotime($tmpPieces[1]));

					$tmpArray = calculateAverage($tmpArray,$previousWeekNumber);
					$lastWeekIndex = $y;
				}
			}
			$myar = $tmpArray;

			$lastRowIndex = sizeof($myar);
			$lastRowIndex -= 3;
			$cntLastRow = 0;
			//set min and max in last row
			for($in=1;$in<8;$in++) 
			{
				if ($myar[$lastRowIndex][$in] != "") //if not empty
				{
					$piecesG = explode(", ", $myar[$lastRowIndex][$in]); //if more values exist in same field put them to array ", " delimiter
					$sizeFieldG = sizeof($piecesG);
					for($inG = 0; $inG < $sizeFieldG;$inG++) //loop through all values in field and check for min and max
					{	
						$myar[$lastRowIndex][14]++;
						if(($piecesG[$inG] != "") AND ($piecesG[$inG] < $myar[$lastRowIndex][12]))
							$myar[$lastRowIndex][12] = $piecesG[$inG]; //set MIN
						if(($piecesG[$inG] != "") AND ($piecesG[$inG] > $myar[$lastRowIndex][13]))
							$myar[$lastRowIndex][13] = $piecesG[$inG]; // set MAX
					}
				}
			}
			//calculate last week averages
			for($in=1;$in<15;$in++) 
			{
				$myar[$lastRowIndex+1][$in] = "";
				$count=0;
				for($indexLastWeek=$lastWeekIndex;$indexLastWeek<=$lastRowIndex;$indexLastWeek++)
				{
					if($myar[$indexLastWeek][$in] != "")
					{
						$pieces = explode(", ", $myar[$indexLastWeek][$in]); //if more values exist in same field with ", " delimiter
						$sizeField = sizeof($pieces);
						for($j = 0; $j < $sizeField;$j++) //loop through all values in field 
						{
							$myar[$lastRowIndex+1][$in] += $pieces[$j]; //set sum
							$count +=1; //count 
						}
					}
					else
						$myar[$lastRowIndex+1][$in] .= "";
						
				
		
				}
				//if there are any measurements in that period
				if($myar[$lastRowIndex+1][$in] != "")
				{
					//for glucose levels calculate only average
					if($in<8 OR ($in>11 AND $in<14))
					{
						$myar[-1][$in] += $myar[$lastRowIndex+1][$in];
						$myar[-2][$in] += $count;
						$myar[$lastRowIndex+1][$in] /= $count;
						$myar[$lastRowIndex+1][$in] = round($myar[$lastRowIndex+1][$in], 2);
					
					}
					//for insulin inputs and total measurement number calculate average and sum
					else
					{
						$tmp = $myar[$lastRowIndex+1][$in];
						$myar[$lastRowIndex+1][$in] = "SUM : ";
						$myar[$lastRowIndex+1][$in] .= $tmp;
						$myar[-1][$in] += $tmp;
						$myar[-2][$in] += $count;
						$myar[$lastRowIndex+1][$in] .= "<br>AV: ";
						$tmp /= $count;
						$myar[$lastRowIndex+1][$in] .= round($tmp,2);
					}
				}
				else $myar[$lastRowIndex+1][$in] = "";
			}
				
			$myar[$lastRowIndex+1][0] = "Week : ";
			$myar[$lastRowIndex+1][0] .= $weekNumber;
			$myar[$lastRowIndex+1][0] .= " average";		

			
			//calculate hba1c 
			$tmpX=sizeof($myar);
			$tmpSum = 0;
			$tmpCount = 0;
			$ind = 0;
			$counterHb = 0;
			$graphArray = array("5");
			$graphX = array("0");
			$graphXview = array("W0-Y0000");

			for($x=0;$x<$tmpX-2;$x++){
				$pieces = explode(" : ", $myar[$x][0]); //if week row, different formating
				//90 days average is used to calculate hba1c. For first 90 days just take average of days available
				if($pieces[0] != "Week" AND $x<91)
				{
					for($y=1;$y<8;$y++){
						if ($myar[$x][$y] != "") //if not empty
						{
							$pieces = explode(", ", $myar[$x][$y]); //if more values exist in same field put them to array ", " delimiter
							$sizeField = sizeof($pieces);
							$count += $sizeField; //increase measurement counter with number of values in field
							for($i = 0; $i < $sizeField;$i++) //loop through all values in field and sum
							{
								$tmpSum += $pieces[$i]; //sum
								$tmpCount += 1;
							}
						}
					}
					$myar[$x][15] = round (($tmpSum/$tmpCount),2);
					$myar[$x][16] = round((((($tmpSum/$tmpCount)*18)+77.3)/35.6),2); //formula for hba1c calculcation http://diabetesupdate.blogspot.com/2006/12/formulas-equating-hba1c-to-average.html
				//	$myar[$x][17] = round((((($tmpSum/$tmpCount)*18)+46.7)/28.7),2); //formula for hba1c calculcation to be checked		
					if($x<32)
						$myar[$x][16] = "NA";

				
				}
				//90 days average is used to calculate hba1c. after 90 days take average of last 90 days
				else if($pieces[0] != "Week" AND $x>90)
				{
					$tmpSum = 0;
					$tmpCount = 0;
					for($y=$x-90;$y<=$x;$y++)
					{
						for($z=1;$z<8;$z++){
							if ($myar[$y][$z] != "") //if not empty
							{
								$pieces = explode(", ", $myar[$y][$z]); //if more values exist in same field put them to array ", " delimiter
								$sizeField = sizeof($pieces);
								$count += $sizeField; //increase measurement counter with number of values in field
								for($i = 0; $i < $sizeField;$i++) //loop through all values in field and sum
								{
									$tmpSum += $pieces[$i]; //sum
									$tmpCount += 1;
								}
							}
						}
					}
					$myar[$x][15] = round (($tmpSum/$tmpCount),2);
					$myar[$x][16] = round((((($tmpSum/$tmpCount)*18)+77.3)/35.6),2); //formula for hba1c calculcation http://diabetesupdate.blogspot.com/2006/12/formulas-equating-hba1c-to-average.html
				//	$myar[$x][17] = round((((($tmpSum/$tmpCount)*18)+46.7)/28.7),2); //formula for hba1c calculcation to be checked
				}
				else if($pieces[0] == "Week")
				{
					
					$myar[$x][15] = $myar[$x-1][15];
					$myar[$x][16] = $myar[$x-1][16];
					if($myar[$x][16]!="NA"){
						array_push($graphArray,$myar[$x][16]);
						$tmpPiece = explode(" ",$pieces[1]);
						//echo($myar[$x-1][0]);
						
						
						
						$dateDelimiter = substr($myar[$x-1][0],-5,1);
						$tmpPiece2 = explode($dateDelimiter,$myar[$x-1][0]);
//						$tmpPiece2 = explode("/",$myar[$x-1][0]);

						$tmpVar = "W";
						$tmpVar .= $tmpPiece[0];
						$tmpVar .= "-";
						$tmpVar .= $tmpPiece2[2];
						$counterHb++;
						array_push($graphX,$counterHb);
						array_push($graphXview,$tmpVar);
					//	$myar[$x][17] = $myar[$x-1][15];
					}
				}
			}
		
			//create HTML output
			$out = "";
		//	$script = '<script>var newArr = new Array(' . implode(',', $graphArray) . ');</script>';

			//$out .= "<body onload=\"showGraph()\"><div id=\"content\"><div class=\"demo-container\"><div id=\"placeholder\" class=\"demo-placeholder\"></div></div></div></body>";
			
$js_array = json_encode($graphArray);
$js_arrayWeeks = json_encode($graphX);
$js_arrayWeeksView = json_encode($graphXview);

$out .= "
<script type=\"text/javascript\">

$(function() {
var array = $js_array;
var arrayW = $js_arrayWeeks;
var arrayWView = $js_arrayWeeksView;

var arsize = array.length;
	var d1 = [];
	var d2 = [];
	for (var i = 1; i < arsize; i += 1) {
		d1.push([arrayW[i],array[i]]);
		d2.push(arrayWView[i]);
	}
	var plot = $.plot(\"#placeholder\", [{ data: d1, label: \"HbA1C estimation\"}], {
			series: {
				lines: {
					show: true
				},
				points: {
					show: true
				}
			},
			grid: {
				hoverable: true,
				clickable: true
			},
		});
	
		$(\"<div id='tooltip'></div>\").css({
			position: \"absolute\",
			display: \"none\",
			border: \"1px solid #fdd\",
			padding: \"2px\",
			\"background-color\": \"#f0e0e0\",
			opacity: 0.80
		}).appendTo(\"body\");
		
		$(\"#placeholder\").bind(\"plothover\", function (event, pos, item) {

				if (item) {
					var x = item.datapoint[0].toFixed(0),
						y = item.datapoint[1].toFixed(2);
					var weekv = d2[x];
					$(\"#tooltip\").html(weekv + \" = \" + y)
						.css({top: item.pageY+5, left: item.pageX+5})
						.fadeIn(200);
				}
		});

	
			placeholder.resize(function () {
			$(\".message\").text(\"Placeholder is now \"
				+ $(this).width() + \"x\" + $(this).height()
				+ \" pixels\");
		});
	
		$(\".demo-container\").resizable({
			maxWidth: 900,
			maxHeight: 500,
			minWidth: 450,
			minHeight: 250,
		});
	
});
 </script>
 		</head> 
<body>
	<div id=\"content\">

		<div class=\"demo-container\">
			<div id=\"placeholder\" class=\"demo-placeholder\"></div>
		</div>
	</div>
</body>
	";		
			
			
			$out .= "<body><div class=\"CSS_Table_Example\"><table>";
	
			//create first row
			if($language == "cro")
			{
				$out .= "<tr><td>Datum</td>";
				$out .= "<td>Jutro - prije<br>$morningStart<br>-<br>$noonStart</td>";
				$out .= "<td>Jutro - poslije<br>$morningStart<br>-<br>$morningEnd</td>";
				$out .= "<td>Podne - prije<br>$noonStart<br>-<br>$eveningStart</td>";
				$out .= "<td>Podne - poslije<br>$morningEnd<br>-<br>$noonEnd</td>";
				$out .= "<td>Vecer - prije<br>$eveningStart<br>-<br>$eveningEnd</td>";
				$out .= "<td>Vecer - poslije<br>$noonEnd<br>-<br>$eveningEnd</td>";
				$out .= "<td>Noc<br>$nightStart<br>-<br>$dayStart</td>";
				$out .= "<td>Inzulin - dorucak</td>";
				$out .= "<td>Inzulin - rucak</td>";
				$out .= "<td>Inzulin - vecera</td>";
				$out .= "<td>Inzulin - noc</td>";
				$out .= "<td>GUK - MIN</td>";
				$out .= "<td>GUK - MAX</td>";
				$out .= "<td>Br. mj.</td>";
				$out .= "<td>Average 90 days [mmol/L]</td>";
				$out .= "<td>HbA1C estimation* 90 days [%]</td>";
		//		$out .= "<td>HbA1C estimation** 90 days [%]</td>";
			}
			else
			{
				$out .= "<tr><td>Date</td>";
				$out .= "<td>Morning - before<br>$morningStart<br>-<br>$noonStart</td>";
				$out .= "<td>Morning - after<br>$morningStart<br>-<br>$morningEnd</td>";
				$out .= "<td>Noon - before<br>$noonStart<br>-<br>$eveningStart</td>";
				$out .= "<td>Noon - after<br>$morningEnd<br>-<br>$noonEnd</td>";
				$out .= "<td>Evening - before<br>$eveningStart<br>-<br>$eveningEnd</td>";
				$out .= "<td>Evening - after<br>$noonEnd<br>-<br>$eveningEnd</td>";
				$out .= "<td>Night<br>$nightStart<br>-<br>$dayStart</td>";
				$out .= "<td>Insulin FA - breakfast</td>";
				$out .= "<td>Insulin FA - lunch</td>";
				$out .= "<td>Insulin FA - dinner</td>";
				$out .= "<td>Insulin LA</td>";
				$out .= "<td>GL - MIN <br>  < $minGL</td>";
				$out .= "<td>GL - MAX <br>  > $maxGL</td>";
				$out .= "<td>Measur. count</td>";
				$out .= "<td>Average 90 days [mmol/L]</td>";
				$out .= "<td>HbA1C estimation* 90 days [%]</td>";
			//	$out .= "<td>HbA1C estimation** 90 days [%]</td>";
			}
			$x = 0;
			//loop through array and create rows
			for($x=0;$x<sizeof($myar)-2;$x++)
			{
				$pieces = explode(" : ", $myar[$x][0]); //if week row, different formating
				if($pieces[0] != "Week")
				{
					$out .= "<tr>\n<td>";
					$out .= $myar[$x][0];
					$out .= "</td>\n<td>";
					$out .= $myar[$x][1];
					$out .= "</td>\n<td bgcolor=\"FFFF99\">";
					$out .= $myar[$x][2];
					$out .= "</td>\n<td bgcolor=\"FFFF66\">";
					$out .= $myar[$x][3];
					$out .= "</td>\n<td class=\"cellClass\">";
					$out .= $myar[$x][4];
					$out .= "</td>\n<td bgcolor=\"FFFF33\">";
					$out .= $myar[$x][5];
					$out .= "</td>\n<td bgcolor=\"FFFF33\">";	
					$out .= $myar[$x][6];
					$out .= "</td>\n<td bgcolor=\"F8F8F8\">";	
					$out .= $myar[$x][7];
					$out .= "</td>\n<td>";	
					$out .= $myar[$x][8];
					$out .= "</td>\n<td>";	
					$out .= $myar[$x][9];
					$out .= "</td>\n<td>";	
					$out .= $myar[$x][10];
					$out .= "</td>\n<td>";	
					$out .= $myar[$x][11];	
					$out .= "</td>\n";
					//conditional formatting for MIN and MAX
					if ($myar[$x][12] < $minGL)
						$out .= "<td class=\"red\">";
					else
						$out .= "<td bgcolor=\"99FF66\">";	
					$out .= $myar[$x][12];
					$out .= "</td>";
					if ($myar[$x][13] > $maxGL)
						$out .= "<td class=\"red\">";
					else
						$out .= "<td bgcolor=\"99FF66\">";	
					$out .= $myar[$x][13];
					$out .= "</td><td>";	
					$out .= $myar[$x][14];
					$out .= "</td><td>";	
					$out .= $myar[$x][15];
					$out .= "</td><td>";	
					$out .= $myar[$x][16];
				//	$out .= "</td><td>";	
				//	$out .= $myar[$x][17];
					$out .= "</td></tr>";	
				}
				else 
				{
					$out .= "<tr>\n<td class=\"week\">";
					$out .= $myar[$x][0];
					$out .= "</td>\n<td  class=\"week\">";
					$out .= $myar[$x][1];
					$out .= "</td>\n<td  class=\"week\">";
					$out .= $myar[$x][2];
					$out .= "</td>\n<td  class=\"week\">";
					$out .= $myar[$x][3];
					$out .= "</td>\n<td  class=\"week\">";
					$out .= $myar[$x][4];
					$out .= "</td>\n<td  class=\"week\">";
					$out .= $myar[$x][5];
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= $myar[$x][6];
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= $myar[$x][7];
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= $myar[$x][8];
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= $myar[$x][9];
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= $myar[$x][10];
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= $myar[$x][11];	
					$out .= "</td>\n";
					//conditional formatting for MIN and MAX
					if ($myar[$x][12] < $minGL)
						$out .= "<td class=\"week\">";
					else
						$out .= "<td class=\"week\">";	
					$out .= $myar[$x][12];
					$out .= "</td>";
					if ($myar[$x][13] > $maxGL)
						$out .= "<td class=\"week\">";
					else
						$out .= "<td class=\"week\">";	
					$out .= $myar[$x][13];
					$out .= "</td><td class=\"week\">";	
					$out .= $myar[$x][14];	
					$out .= "</td><td class=\"week\">";	
					$out .= $myar[$x][15];	
					$out .= "</td><td class=\"week\">";	
					$out .= $myar[$x][16];
				//	$out .= "</td><td class=\"week\">";	
				//	$out .= $myar[$x][17];	
					$out .= "</td></tr>";	
				}
			}
			//last row
					$out .= "<tr>\n<td class=\"week\">";
					$out .= "Total :";
					$out .= "</td>\n<td  class=\"week\">";
					$out .= round($myar[-1][1]/$myar[-2][1],2);
					$out .= "</td>\n<td  class=\"week\">";
					$out .= round($myar[-1][2]/$myar[-2][2],2);
					$out .= "</td>\n<td  class=\"week\">";
					$out .= round($myar[-1][3]/$myar[-2][3],2);
					$out .= "</td>\n<td  class=\"week\">";
					$out .= round($myar[-1][4]/$myar[-2][4],2);
					$out .= "</td>\n<td  class=\"week\">";
					$out .= round($myar[-1][5]/$myar[-2][5],2);
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= round($myar[-1][6]/$myar[-2][6],2);
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= round($myar[-1][7]/$myar[-2][7],2);
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= "SUM: ";
					$out .= $myar[-1][8];
					$out .= "<br>AV: ";
					$out .= round($myar[-1][8]/$myar[-2][8],2);
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= "SUM: ";
					$out .= $myar[-1][9];
					$out .= "<br>AV: ";
					$out .= round($myar[-1][9]/$myar[-2][9],2);
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= "SUM: ";
					$out .= $myar[-1][10];
					$out .= "<br>AV: ";
					$out .= round($myar[-1][10]/$myar[-2][10],2);
					$out .= "</td>\n<td  class=\"week\">";	
					$out .= "SUM: ";
					$out .= $myar[-1][11];
					$out .= "<br>AV: ";
					$out .= round($myar[-1][11]/$myar[-2][11],2);
					$out .= "</td>\n";
					//conditional formatting for MIN and MAX
					$out .= "<td class=\"week\">";	
					$out .= round($myar[-1][12]/$myar[-2][12],2);
					$out .= "</td>";
					$out .= "<td class=\"week\">";	
					$out .= round($myar[-1][13]/$myar[-2][13],2);
					$out .= "</td><td class=\"week\">";
					$out .= "SUM: ";
					$out .= $myar[-1][14];
					$out .= "<br>AV: ";
					$out .= round($myar[-1][14]/$myar[-2][14],2);
					$out .= "</td><td class=\"week\">";
					$out .= $myar[$x-1][15];
					$out .= "</td><td class=\"week\">";
					$out .= $myar[$x-1][16];
			//		$out .= "</td><td class=\"week\">";
			//		$out .= $myar[$x-1][17];
					$out .= "</td></tr>";	
				//end creating output
				$out .= "</table>";
				$out .= "*  HbA1C calculated with formula: A1C = (eAG X 18 + 77.3)/35.6<br>";
				//	$out .= "** HbA1C calculated with formula: A1C = (eAG X 18 + 46.7)/28.7";
				$out .= "</div></body>";

			//$out = "";
			echo $out;
			fclose($handle);
		}//end if open file
		else
		{
			echo ("Invalid file!!!! Check file format and try again");
		}
	}
		//echo $fileExists;
	?>
</html>
