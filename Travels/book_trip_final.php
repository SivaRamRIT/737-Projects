<?php



$value = 0;
$DBHostName = "localhost";
$DBUserName = "739_group_three";
$DBPassword = "fr1end";
$DBName = "739_group_three";
$itId=$_POST['it_id'];
$schId=$_POST['sh_id'];
$name=$_POST['traveler_name'];
$amt= $_POST['paid_amount'];
$maxNum=$_POST['max_travelers'];

$mysqli = new mysqli($DBHostName,$DBUserName,$DBPassword,$DBName);

$stmt1= $mysqli->prepare("select count(*) from trip_traveler where trip_id=?");
$stmt1->bind_param('i', $schId);
$stmt1->execute();
$res=$stmt1->store_result();
$num=$stmt1->num_rows();

//$num = getNumTravelerPerScheduleId($schId);
if($num<$maxNum)
{
	 $date = '2012-11-11';
	  //$string= "Ticket Booked for trip: ". $count;
	 $table_name = 'trip_traveler';
	 
	// $mysqli = new mysqli($DBHostName,$DBUserName,$DBPassword,$DBName);
	 
	if($stmt = $mysqli->prepare("INSERT INTO trip_traveler (trip_id, date_booked, amount_paid, name) VALUES (?, ?, ?, ?)"))
	   {
		//$stmt->bind_param('isds', $schId, $date, $amt, $name);
		$stmt->bind_param('isds', $_POST['sh_id'], $date, $_POST['paid_amount'], $_POST['traveler_name']);
		$stmt->execute();
		$stmt->store_result();
		$value=1;
		
	//echo $value;	
}
echo "<h1 style='color:green;'>Ticket has been booked</h1>";
}
else{
 $string= "Ticket cannot be booked for trip: ".$count;
  echo "<h1>".$string."</h1>";
	}
  



