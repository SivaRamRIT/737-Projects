<?php

/*******************************************************
html_head()
--------------------------------------------------------
DESCRIPTION:
			Returns the html start elements like doctype, 
			head tag , style tag and body tag. Body tag 
			returns a title div ang the navigation div.
INPUT: None

********************************************************/
			
function html_head()
{

echo '<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
//Checking if the user agent is a mobile and directing it to seperate stylesheet	
if( stripos($_SERVER['HTTP_USER_AGENT'],'Android')||stripos($_SERVER['HTTP_USER_AGENT'],'webOS')||stripos($_SERVER['HTTP_USER_AGENT'],'iPhone')||stripos($_SERVER['HTTP_USER_AGENT'],'iPod'))
{
echo '<link rel="stylesheet" type="text/css" href="mobile.css"/ media="handheld">';
}
//Default Stylesheet
echo '<link rel="stylesheet" type="text/css" href="pstyle.css"/>
	
	<title>Gaming Zone</title>
</head>
<body>
<div>
	<div id="titlediv">
	<img src="Te_Image" alt="" /><h2> The Gaming Zone </h2>
	</div>
	<div id="menu">
	 <ul>
						<li><a href="index.php" >Home</a></li>
						<li><a href="cart.php" >Cart</a></li>
						<li><a href="admin.php" >Admin</a></li>
						<li><a href="cform.php" >Contact</a></li>
						<li><a href="services.php">Services</a></li>
						<li><a href="project2.rss">Project2.rss</a></li>
	</ul>
	</div>';
}

/*************************************************************
html_foot()
--------------------------------------------------------------
DESCRIPTION:
			Returns the html footer elements. It also includes
			a div that collects user information like brower 
			details and ip address.
INPUT: None

***************************************************************/


function html_foot()
{
//To get the  broser info
$browser = $_SERVER['HTTP_USER_AGENT'];
//To get the client ip address
$ip = $_SERVER['REMOTE_ADDR'];

echo "<div id='footerdiv' >";
echo "<p>Your browser details are $browser </p>";
echo "<p> your ip address is $ip</p>";

echo"</div>
</div>
</body>
</html>";
}

/******************************************************************
sanitizingString($var)
-------------------------------------------------------------------
DESCRIPTION: 
			This function returns the sanitized string that is free 
			from errors. This functionmakes sure that input came from 
			expected location, input is of expected length, of expected 
			type, etc.
INPUT:
			$var 			Input string to be sanitized
			
***********************************************************************/
				



function sanitizingString($var){
$var = trim($var);
$var = stripslashes($var);
$var = htmlentities($var);
$var = strip_tags($var);
return $var;
}

/***********************************************************************

addToCart($filename,$choice)
-------------------------------------------------------------------------
DESCRIPTION:
			This function adds the item to the cart.php, cart.txt and 
			catalog.txt files with updated quantity every time the add
			tocart button is pressed
INPUT :
			$filename		The name of the file that is to be read
			$choice			Holds the value of the item selected 
*************************************************************************/
		

function addToCart($filename,$choice)
{
//Reading the file into an array
$data2 = file($filename);
//Assigning values to the variables while exploding the selected item
list($name,$desc,$price,$quan,$img,$salp) = explode("|",$data2[$choice]);
//updaing quantity
$red_quan = $quan - 1;
//Imploding to a string
$result = implode("|",array($name,$desc,$price,$red_quan,$img,$salp));

//Replacing the selected item with the updated string
$data2 = str_replace($data2[$choice],$result,$data2);
$newdata = implode($data2);
//Replacing the entire catalog file with the updated string
$fp = fopen('catalog.txt','w');
fwrite($fp,"$newdata");
fclose($fp);
//Writing the updated string to cart file
file_put_contents("cart.txt",$result,FILE_APPEND);

}

function permaLink($choice)
{

$data = file('catalog.txt');


	list($name,$desc,$price,$quan,$img,$salp) = explode("|",$data[$choice]);

		
		$string .= "<h2>$name</h2>
			  <img src='$img' alt='' /> <p>$desc</p>
			  <p>Sale Price = $salp$ (Regularly $price$). Only $quan left </p>
		 <form action='index.php' method='post'> <input type='hidden' name='item' value='$i'/> <input type='submit' name='add' value='add to cart' /></form>";
	
return $string;

}

function creditForm()
{
$fp_sequence = time(); // Any sequential number like an invoice number.
$url = "http://people.rit.edu/sxm6917/739/project%202/cart.php";
$api_login_id = '9j7K6m96tYV'; // your api login
$transaction_key = '53F6tR545r2KsbMx'; //Your transaction Key
$md5_setting = '9j7K6m96tYV'; // Your MD5 Setting - use your api login id
$string ="";
$totalCost = 50;



$string .= AuthorizeNetDPM::getCreditCardForm($totalCost, $fp_sequence, $url, $api_login_id, $transaction_key);



if ($_SERVER['REQUEST_METHOD'] == "POST" && 
	isset($_POST['Empty'])) {
	//project1_empty_cart();
	file_put_contents("cart.txt","");
} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

	$string .= "<div>".P2_Utils::project2_process_authorize()."</div>";
	
} else if ($_SERVER['REQUEST_METHOD'] && 
		isset($_GET['response_code']) ) {
		
	$string .= "<div>".P2_Utils::project2_process_authorize_response()."</div>";
}


return $string;

}

function pagination($data,$count)
{


$show  = array_slice($array, $count, 5);

return $show;

}
?>