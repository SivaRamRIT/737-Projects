<?php
require_once 'LIB_project.php';

echo html_head();

if(isset($_POST['add'])){

$itemno = $_POST['item'];
echo "<h2 style='color:white'>This item has been added to cart</h2>";
addToCart('catalog.txt',$itemno);
}

$data = file('catalog.txt');
echo "<div id='salediv' >";
echo "<h1>Sale Items</h1>";
$i=0;

	foreach($data as $data)
	{
	list($name,$desc,$price,$quan,$img,$salp) = explode("|",$data);

		if($salp > 0)
		{
		echo "<h2><a href='PermaLInk.php?choice=$i'>$name</a></h2>
			  <img src='$img' alt='' /> <p>$desc</p>
			  <p>Sale Price = $salp$ (Regularly $price$). Only $quan left </p>";
		echo "<form action='index.php' method='post'> <input type='hidden' name='item' value='$i'/> <input type='submit' name='add' value='add to cart' /></form>";
		}
	$i++;

	}
echo "</div>";

if(isset($_POST['add1'])){

	
	$itemno2 = $_POST['item1'];
	addToCart('catalog.txt',$itemno2);
	
}

$data2 = file('catalog.txt');
echo "<div id='catalogdiv'>";
echo "<h1>Catalog</h1>";
$j=0;



	foreach($data2 as $data2)
	{
	list($name,$desc,$price,$quan,$img,$salp) = explode("|",$data2);


		if($salp == 0)
		{
		//print_r($data2);
		//pagination($data2,1);
		echo "<h2><a href='PermaLInk.php?choice=$j'>$name</a></h2>
			  <img src='$img' alt='' /> <p>$desc</p>
			  <p>Price = $price$  Only $quan left </p>";
		echo "<form action='index.php' method='post' > <input type='hidden' name='item1' value='$j'> <input type='submit' name='add1' value='add to cart' /></form>";
		}
	$j++;
	}
echo "</div>";
	
	
	
echo html_foot();
?>