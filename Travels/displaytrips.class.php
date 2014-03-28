<?php
class showTrips{

	static function getUpcomingTrips(){
	
		$dom = new DomDocument();
		$dom->load("http://nova.it.rit.edu/~739_group_three/739/project%203/A/upcomingtrips.xml");
		
		
		$trip = $dom->getElementsByTagName('trip');
		$table = "";
		$table .= "<form action = '' method='POST'/>";
		$table .="<table id='tableOutput' border='1' cellpadding ='5'>";
		$table .="<tr>";
		$table .="<th>ID</th>";
		$table .="<th>CategoryName</th>";
		$table .="<th>LeaderName</th>";
		$table .="<th>LeaderActive</th>";
		$table .="<th>TripCost</th>";
		$table .="<th>Max_no_of_travelers</th>";
		$table .="<th>Start City</th>";
		$table .="<th>End City</th>";
		$table .="<th>Trip type</th>";
		$table .="<th>Starting Date</th>";
		$table .="<th>Ending Date</th>";
		$table .="</tr>";
		$planID="";
		foreach($trip as $tour)
		{
			$table .="<tr>";
			$schedule = $tour->getElementsByTagName('schedule');
				foreach($schedule as $plan)
				{
					$planID = $plan->getElementsByTagName('id')->item(0)->nodeValue;
					$itineraryID = $plan->getElementsByTagName('itineraryId')->item(0)->nodeValue;
					$startingDate = $plan->getElementsByTagName('startingDate')->item(0)->nodeValue;
					$endingDate = $plan->getElementsByTagName('endingDate')->item(0)->nodeValue;
					$leaderId = $plan->getElementsByTagName('leaderId')->item(0)->nodeValue;
					
				}

			$category = $tour->getElementsByTagName('category');
				foreach($category as $cat)
				{
					$catID = $cat->getElementsByTagName('id')->item(0)->nodeValue;
					$catName = $cat->getElementsByTagName('name')->item(0)->nodeValue;
					
				}
				
			$leader = $tour->getElementsByTagName('leader');
				foreach($leader as $guide)
				{
					$leaderID = $guide->getElementsByTagName('id')->item(0)->nodeValue;
					$leaderName = $guide->getElementsByTagName('name')->item(0)->nodeValue;
					$leaderActive = $guide->getElementsByTagName('active')->item(0)->nodeValue;
					
				}
				
			$itinerary = $tour->getElementsByTagName('itinerary');
				foreach($itinerary as $journey)
				{
					$tripID = $journey->getElementsByTagName('id')->item(0)->nodeValue;
					$tripCatID = $journey->getElementsByTagName('categoryId')->item(0)->nodeValue;
					$tripCost = $journey->getElementsByTagName('cost')->item(0)->nodeValue;
					$maxTravelers = $journey->getElementsByTagName('maxNumberOfTravelers')->item(0)->nodeValue;
					$startingCity = $journey->getElementsByTagName('startingCity')->item(0)->nodeValue;
					$endCity = $journey->getElementsByTagName('endingCity')->item(0)->nodeValue;
					$tripType = $journey->getElementsByTagName('itineraryText')->item(0)->nodeValue;
					
				}

			$table .="<td><input type='radio' value= '$planID|$tripID|$maxTravelers' name = 'booktrips'/></td>";
			
			
			
			$table .="<td>$catName</td>";
			$table .="<td>$leaderName</td>";
			$table .="<td>$leaderActive</td>";
			$table .="<td>$tripCost</td>";
			$table .="<td>$maxTravelers</td>";
			$table .="<td>$startingCity</td>";
			$table .="<td>$endCity</td>";
			$table .="<td>$tripType</td>";
			$table .= "<td>$startingDate</td>";
			$table .="<td>$endingDate</td>";
				
				$table .="</tr>";
		}
		$table .="</table><br/>";
		$table.= "<tr><td><label>Traveler Name: </label></td>";
		$table .= "<td><input type='text' name='travelerName' size='40' value=''></input></td>";
		$table .= "<td><label>Amount: </label></td>";
		$table .= "<td><input type='text' name='paidAmount' value=''></input></td>";
		$table.="<td></td><td><input type='submit' name='submit' value='BookTrip'></input></td>";
		$table .= "<td>Enter Code <img src='captcha.php'></td>";
		$table .="<td><input type='text' name='vercode' /></td>";

		$table.="<td></td><td><input type='submit' name='submit' value='BookTrip'></input></td>";
		$table.="</form><br/>";
		
		
					
		return $table;
		
	}
}

?>