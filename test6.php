<html>
	<head>
		<form enctype="multipart/form-data" action="test6.php" method="POST">
	<table>
		<tr>
			<td>
				<span>Start of Day</span>
			</td>
			<td>
				<span>End of Morning</span></br>
			</td>
		</tr>
		<tr>
			<td>
				<input type="range" id="RangeDay" min="0" max="48" value="13" step="1" onchange="showTime(this.value,this.id)" />
				<span id="spanRangeDay"></span>
				<input type="hidden" name="spanRangeDay" id="spanRangeDaySend" value="12:12"></input>																
			</td>
			<td>
				<input type="range" id="RangeMorning" min="0" max="48" value="13" step="1" onchange="showTime(this.value,this.id)" />
				<span id="spanRangeMorning"></span>
				<input type="hidden" name="spanRangeMorning" id="spanRangeMorningSend" value="12:12"></input>												
			</td>
		</tr>	
		<tr>	
			<td>
				<span>Start of Noon</span>
			</td>
			<td>
				<span>End of Noon</span>
			</td>
		</tr>
			<td>
				<input type="range" id="RangeNoonStart" min="0" max="48" value="13" step="1" onchange="showTime(this.value,this.id)" />
				<span id="spanRangeNoonStart"></span>
				<input type="hidden" name="spanRangeNoonStart" id="spanRangeNoonStartSend" value="12:12"></input>								
			</td>
			<td>
				<input type="range" id="RangeNoon" min="0" max="48" value="13" step="1" onchange="showTime(this.value,this.id)" />
				<span id="spanRangeNoon"></span>
				<input type="hidden" name="spanRangeNoon" id="spanRangeNoonSend" value="12:12"></input>				
			</td>
		</tr>
		<tr>
			<td>
				<span>Start of Evening</span></br>
			</td>
			<td>
				<span>End of Evening</span></br>
			</td>						
		</tr>
		<tr>
			<td>
				<input type="range" id="RangeEveningStart" min="0" max="48" value="13" step="1" onchange="showTime(this.value,this.id)" />
				<span id="spanRangeEveningStart"></span>
				<input type="hidden" name="spanRangeEveningStart" id="spanRangeEveningStartSend" value="12:12"></input>

			</td>			
			<td>
				<input type="range" id="RangeEvening" min="0" max="48" value="13" step="1" onchange="showTime(this.value,this.id)" />
				<span id="spanRangeEvening"></span>
				<input type="hidden" name="spanRangeEvening" id="spanRangeEveningSend" value="12:12"></input>
			
			</td>			

		</tr>		
	<table>
	
			<input type="radio" name="languageR" value="cro" checked="checked">Croatian
			<input type="radio" name="languageR" value="en">English <br>
			<input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
			Choose CSV file: <input name="userfile" type="file"/>
			<input type="submit" value="Upload File" />
		</form>
	</head> 
<script type="text/javascript">
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

	
}
</script>

</html>

<table border="1" bordercolor="#000000" style="background-color:#FFFFCC" width="100%"  align="center" cellpadding="3" cellspacing="3">
<?php

function calculateAverage($tableArray,$weekNumber)
{
	
	$lastRow = sizeof($tableArray);
	$tableArray[$lastRow-2][0] = "Week : ";
	$tableArray[$lastRow-2][0] .= $weekNumber;
	$tableArray[$lastRow-2][0] .= " average";

	for($i=1;$i<15;$i++)
	{
		$count = 0;
		$tableArray[$lastRow-2][$i] = "";
		for($x=3;$x<10;$x++)
		{
			if($tableArray[$lastRow-$x][$i] != "")
			{
				$pieces = explode(", ", $tableArray[$lastRow-$x][$i]); //if more values exist in same field put them to array ", " delimiter
				$sizeField = sizeof($pieces);
				for($j = 0; $j < $sizeField;$j++) //loop through all values in field 
				{
					$tableArray[$lastRow-2][$i] += $pieces[$j]; //set sum
					$count +=1;
				}
			}
			//else $tableArray[$lastRow-2][$i] = "";
		}
		if($tableArray[$lastRow-2][$i] != "")
		{
			if($i<8 OR ($i>11 AND $i<14))
			{
				$tableArray[$lastRow-2][$i] /= $count;
				$tableArray[$lastRow-2][$i] = round($tableArray[$lastRow-2][$i], 2);
			}
			else
			{
				$tmp = $tableArray[$lastRow-2][$i];
				$tableArray[$lastRow-2][$i] = "SUM : ";
				$tableArray[$lastRow-2][$i] .= $tmp;
				$tableArray[$lastRow-2][$i] .= " AVER.: ";
				$tmp /= $count;
				$tableArray[$lastRow-2][$i] .= round($tmp,2);
			}
		}
		else $tableArray[$lastRow-2][$i] = "";	
	//$tableArray[$lastRow-2][1] = $sum;	
	}
		
		
		
		
	//$tableArray[$lastRow-2][2] = $weekNumber;
	//$tableArray[$lastRow-2][3] = $weekNumber;
	//$tableArray[$lastRow-2][4] = $weekNumber;
	//$tableArray[$lastRow-2][5] = $weekNumber;
	//$tableArray[$lastRow-2][6] = $weekNumber;
	//$tableArray[$lastRow-2][7] = $weekNumber;
	//$tableArray[$lastRow-2][8] = $weekNumber;
	//$tableArray[$lastRow-2][9] = $weekNumber;
	//$tableArray[$lastRow-2][10] = $weekNumber;
	//$tableArray[$lastRow-2][11] = $weekNumber;
	//$tableArray[$lastRow-2][12] = $weekNumber;
	//$tableArray[$lastRow-2][13] = $weekNumber;
	//$tableArray[$lastRow-2][14] = $weekNumber;
	
	return $tableArray;
}




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
			if($data[0] != "Datum") {
				//set current date to one in current record
				$currentDay = date('l', strtotime($data[0]));
				//initialize array when first record
				if($gDay == "start") {
					$gDay = date('l', strtotime($data[0]));
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
						case "Thursday": $currentDay = "Èetvrtak"; break;
						case "Friday": $currentDay = "Petak"; break;
						case "Saturday": $currentDay = "Subota"; break;
						case "Sunday": $currentDay = "Nedjelja"; break;
					}
				}
				
				//Fill first field (day, date)
				$myar[$ind][0] = $currentDay;
				$myar[$ind][0] .= "  -  ";
				$myar[$ind][0] .= $data[0];
				
				//GL before meal
				if($data[2] != "" AND ($data[18] == "Prije obroka" OR $data[18] == "Nataste" OR $data[18] == "Before Meal" OR $data[18] == "Fasting")) {
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
					}
					else if(strtotime($data[1]) > strtotime("$eveningStart") and strtotime($data[1]) <= strtotime("$eveningEnd"))
					//evening
					{	
						if ($myar[$ind][5] != "") 
							$myar[$ind][5] .= ", ";
						$myar[$ind][5] .= $data[2];
					}
					//night
					else if(strtotime($data[1]) >= strtotime("00:00") and strtotime($data[1]) <= strtotime("$dayStart"))
					{
						$ind--;
						if($data[2] < $myar[$ind][12]) $myar[$ind][12] = $data[2];
						if($data[2] > $myar[$ind][13]) $myar[$ind][13] = $data[2];
						$myar[$ind][14] += 1;
						if ($myar[$ind][7] != "") 
							$myar[$ind][7] .= ", ";
						$myar[$ind][7] .= $data[2];
						$ind++;
					}
					else if(strtotime("$nightStart")>strtotime("$dayStart") AND strtotime($data[1]) >= strtotime("$nightStart") and strtotime($data[1]) > strtotime("$dayStart"))
					{
						if ($myar[$ind][7] != "") 
							$myar[$ind][7] .= ", ";
						$myar[$ind][7] .= $data[2];
					}
				}	
				//GL after			
				else if($data[2] != "" AND ($data[18] == "Iza obroka" OR $data[18] == "After Meal")) 
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
					else if(strtotime($data[1]) > strtotime("$noonEnd") and strtotime($data[1]) <= strtotime("$eveningEnd"))
					{
						if ($myar[$ind][6] != "") 
							$myar[$ind][6] .= ", ";
						$myar[$ind][6] .= $data[2];
					}
					//night strtotime("$nightStart")<strtotime("$dayStart") AND 
					else if(strtotime($data[1]) >= strtotime("00:00") and strtotime($data[1]) <= strtotime("$dayStart"))
					{
						$ind--;
						if($data[2] < $myar[$ind][12]) $myar[$ind][12] = $data[2];
						if($data[2] > $myar[$ind][13]) $myar[$ind][13] = $data[2];
						$myar[$ind][14] += 1;
						if ($myar[$ind][7] != "") 
							$myar[$ind][7] .= ", ";
						$myar[$ind][7] .= $data[2];
						$ind++;
					}
					else if(strtotime("$nightStart")>strtotime("$dayStart") AND strtotime($data[1]) >= strtotime("$nightStart") and strtotime($data[1]) > strtotime("$dayStart"))
					{
						if ($myar[$ind][7] != "") 
							$myar[$ind][7] .= ", ";
						$myar[$ind][7] .= $data[2];
					}
				}
				// GL other
				else if ($data[2] != "")
				{
					//morning
					if(strtotime($data[1]) > strtotime("$dayStart") and strtotime($data[1]) <= strtotime("$morningEnd"))
					{
						if ($myar[$ind][1] != "") 
							$myar[$ind][1] .= ", ";
						$myar[$ind][1] .= $data[2];
					}
					//noon
					else if(strtotime($data[1]) > strtotime("$morningEnd") and strtotime($data[1]) <= strtotime("$noonEnd"))
					{
						if ($myar[$ind][3] != "") 
							$myar[$ind][3] .= ", ";
						$myar[$ind][3] .= $data[2];
					}
					//evening
					else if(strtotime($data[1]) > strtotime("$noonEnd") and strtotime($data[1]) <= strtotime("$eveningEnd"))
					{
						if ($myar[$ind][5] != "") 
							$myar[$ind][5] .= ", ";				
						$myar[$ind][5] .= $data[2];
					}
					//night strtotime("$nightStart")<strtotime("$dayStart") AND 
					else if(strtotime($data[1]) >= strtotime("00:00") and strtotime($data[1]) <= strtotime("$dayStart"))
					{
						$ind--;
						if($data[2] < $myar[$ind][12]) $myar[$ind][12] = $data[2];
						if($data[2] > $myar[$ind][13]) $myar[$ind][13] = $data[2];
						$myar[$ind][14] += 1;
						if ($myar[$ind][7] != "") 
							$myar[$ind][7] .= ", ";
						$myar[$ind][7] .= $data[2];
						$ind++;
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
					if(($data[14] == "Brzodjelujuci" OR $data[14] == "Fast-Acting") AND strtotime($data[1]) > strtotime("$dayStart") and strtotime($data[1]) <= strtotime("$noonStart"))
					{
						if ($myar[$ind][8] != "") 
							$myar[$ind][8] .= ", ";
						$myar[$ind][8] .= $data[13];
					}
					//noon
					else if(($data[14] == "Brzodjelujuci" OR $data[14] == "Fast-Acting") AND strtotime($data[1]) > strtotime("$noonStart") and strtotime($data[1]) <= strtotime("$eveningStart"))
					{
						if ($myar[$ind][9] != "") 
							$myar[$ind][9] .= ", ";
						$myar[$ind][9] .= $data[13];
					}
					//evening
					else if(($data[14] == "Brzodjelujuci" OR $data[14] == "Fast-Acting") AND strtotime($data[1]) > strtotime("$eveningStart") and strtotime($data[1]) <= strtotime("$eveningEnd"))
					{
						if ($myar[$ind][10] != "") 
							$myar[$ind][10] .= ", ";
						$myar[$ind][10] .= $data[13];
					}
					//night
					else if ($data[14] == "Dugodjelujuci" OR $data[14] == "Long-Acting")
					{
						//if after midnight, belongs to previous day
						if(strtotime($data[1]) >= strtotime("00:00") and strtotime($data[1]) <= strtotime("$eveningStart"))
						{
							$ind--;
							if ($myar[$ind][11] != "") 
								$myar[$ind][11] .= ", ";
							$myar[$ind][11] .= $data[13];
							$ind++;
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
		
		//analysis
		$weekNumber = 0;
		$x = 0;
		$indexNewArray = 0;
		for($x=0;$x<sizeof($myar);$x++){
			$pieces = explode(" - ", $myar[$x][0]);
			if ($weekNumber == 0)
				$weekNumber = date("W", strtotime($pieces[1]));
			
			if($weekNumber == date("W", strtotime($pieces[1])))
				$tmpArray[$x+$indexNewArray] = $myar[$x];
			else
			{
				$indexNewArray += 1;
				$y = $x;
				$y += $indexNewArray;
				$tmpArray[$y-1] = $myar[$x];
				$tmpArray[$y] = $myar[$x];
				$tmpArray = calculateAverage($tmpArray,$weekNumber);

				$weekNumber = date("W", strtotime($pieces[1]));
			}
			echo $pieces[1];
			echo $weekNumber;
		}
		
		$myar = $tmpArray;
	
		//create HTML output
		$out = "";
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
			$out .= "<td>Noæ<br>$nightStart<br>-<br>$dayStart</td>";
			$out .= "<td>Inzulin - doruèak</td>";
			$out .= "<td>Inzulin - ruèak</td>";
			$out .= "<td>Inzulin - veèera</td>";
			$out .= "<td>Inzulin - noæ</td>";
			$out .= "<td>GUK - MIN</td>";
			$out .= "<td>GUK - MAX</td>";
			$out .= "<td>Br. mj.</td></tr>";
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
			$out .= "<td>Insulin - breakfast</td>";
			$out .= "<td>Insulin - lunch</td>";
			$out .= "<td>Insulin - dinner</td>";
			$out .= "<td>Insulin - night</td>";
			$out .= "<td>GL - MIN</td>";
			$out .= "<td>GL - MAX</td>";
			$out .= "<td>Measur. count</td></tr>";
		}
		$x = 0;
		//loop through array and create rows
		for($x=0;$x<sizeof($myar);$x++){
			$out .= "<tr>\n<td>";
			$out .= $myar[$x][0];
			$out .= "</td>\n<td bgcolor=\"FFFF99\">";
			$out .= $myar[$x][1];
			$out .= "</td>\n<td bgcolor=\"FFFF99\">";
			$out .= $myar[$x][2];
			$out .= "</td>\n<td bgcolor=\"FFFF66\">";
			$out .= $myar[$x][3];
			$out .= "</td>\n<td bgcolor=\"FFFF66\">";
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
			if ($myar[$x][12] < 4)
				$out .= "<td bgcolor=\"FF6666\">";
			else
				$out .= "<td bgcolor=\"99FF66\">";	
			$out .= $myar[$x][12];
			$out .= "</td>";
			if ($myar[$x][13] > 10)
				$out .= "<td bgcolor=\"FF6666\">";
			else
				$out .= "<td bgcolor=\"99FF66\">";	
			$out .= $myar[$x][13];
			$out .= "</td><td>";	
			$out .= $myar[$x][14];	
			$out .= "</td></tr>";	
		}//end creating output
	echo $out;
    fclose($handle);
	}//end if open file
	else
	{
		echo ("Invalid file!!!! Check file format and try again");
	}
}
	echo $fileExists;
?>