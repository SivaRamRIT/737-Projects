<?php
session_start();

//print_r($_SESSION);

/*if(!isset($_SESSION['login']))
{
header("Location:login.php");
}		*/	
				

if (!empty($_POST['logout'])){
        header("Location:logout.php");
        }

require_once "displaytrips.class.php";
require_once "PageNew.class.php";
echo PageNew::header("Book Trip Page");
echo PageNew::printTitle();

echo "<br/>";

echo showTrips::getUpcomingTrips();


        if(isset($_POST['submit']))
		{
		if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  { 
		echo  '<h2 style="color:red;">Incorrect verification code.</h2>'; 
		}
		else{
		if(($_POST['travelerName'] != "") && ($_POST['paidAmount'] != ""))
        {		
		$travelerName = $_POST['travelerName'];
		$paidAmount = $_POST['paidAmount'];
		list($it_id, $sh_id, $max_travelers) = explode('|', $_POST['booktrips']);
		$curl_handle = curl_init();
		$data = array('it_id'=>urlencode($it_id), 'sh_id'=>urlencode($sh_id), 'max_travelers'=>urlencode($max_travelers), 'traveler_name'=>urlencode($travelerName), 'paid_amount'=>urlencode($paidAmount));
		curl_setopt($curl_handle, CURLOPT_URL,'http://nova.it.rit.edu/~739_group_three/739/project%203/A/book_trip_final.php');
	    curl_setopt($curl_handle, CURLOPT_HEADER, 0);
		curl_setopt($curl_handle, CURLOPT_POST, true);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
	    $output = curl_exec($curl_handle);
		curl_close($curl_handle);
		
		
		echo json_encode($output);
		
		
		}
		else
				{
				echo "<h2 style='color:blue;'>please  fill in all the fileds</h2>";
				
				}
		}
		}
		
	echo '<form action="" method="POST">
<input type="submit" name="logout" value="logout"/><br /><br />
</form>	';		


echo "<br/>";

echo PageNew::footer();
?>