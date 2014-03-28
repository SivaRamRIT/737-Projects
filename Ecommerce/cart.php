<?php

require_once 'LIB_project.php';
require_once 'anet_php_sdk/AuthorizeNet.php'; 
require_once 'P2_Utils.class.php';
echo html_head();

	if(isset($_POST['Empty']))
	{
	file_put_contents("cart.txt","");
	}
$data = file('cart.txt');
$Totalcost = 0;
echo "<div id='cartdiv'>";

	if (empty($data)) 
	{
	echo "<h2 style='color:red'>Your cart is empty</h2>";
	}

	if (!empty($data)) 
	{
			echo "<h2 style='color:white'>Current Cart Items</h2>";

		foreach($data as $data)
		{
		list($name,$desc,$price,$quan,$img,$salp) = explode("|",$data);

		
			  
		if($salp > 0)
		{
		//echo "<h2 style='color:white'>Current Cart Items</h2>";
		echo "<h2>$name</h2>
			  <p>$desc</p>
			  <p> Quantity 1 at $salp each, Total for item $salp </p>";
		
		  $Totalcost = $Totalcost + $salp;
		  }
		if($salp == 0)
        {
		//echo "<h2 style='color:white'>Current Cart Items</h2>";
		echo "<h2>$name</h2>
			  <p>$desc</p>
			  <p> Quantity 1 at $price each, Total for item $price </p>";
		
		
		  $Totalcost = $Totalcost + $price;
		  }
	}
    echo "<h2>Total cost = $Totalcost$</h2>";
	echo "<form action='cart.php' method='post' ><input type='submit' name='Empty' value='Empty Cart'></form>";
	echo "</div>";
}



echo "<div id = 'catalogdiv'>";
echo creditForm();
echo "</div>";

echo html_foot();

?>