<?php

require_once 'LIB_project.php';
require_once 'RSSFeed.class.php';

echo html_head();

echo "<h1>Administer Inventory Page</h1>";
$data = file('catalog.txt');

	
echo "<div id='form1div'>";	
	echo "<form action = 'admin.php' method='POST'>
	
	<h2> Edit an Item </h2>";
	echo "Choose an item to Edit: <select name='chooseone'>";
	
$i=0;


foreach($data as $data)
{
list($name,$desc,$price,$quan,$img,$salp) = explode("|",$data);
$final = implode("-" , array($name,$desc));


	echo "<option value='$i'>$final</option>";
	
	$i++;
	}
	echo "</select>
           <input type='submit' name='edit' value='select' /><br/><br/>";
	   
	$option = $_POST['chooseone'];
	//echo $option;
	
	$data2 = file('catalog.txt');

	
    list($name,$desc,$price,$quan,$img,$salp) = explode("|",$data2[$option]);
	
	
    echo "<table>
	<tr>
	<td>Name:</td> 
	<td><input type='text' name='name' value='$name'></td>
	</tr>
	<tr>
	<td>Description:</td>
	<td><textarea name='desc' rows='5' cols='30' >$desc</textarea></td>
	</tr>
	<tr>
	<td>Price:</td>
	<td><input type='text' name='price' value='$price'></td>
	</tr>
	<tr>
	<td>Quantity On Hand:</td>
	<td><input type='text' name='quan' value='$quan' ></td>
	</tr>
	<tr>
	<td>Sale Price:</td>
	<td><input type='text' name='salePrice' value='$salp' ></td>
	</tr>
	
	<tr>
	<td>New Image:</td>
	<td><input type='hidden' name='image' value='$img' ><input type='file' name='new image'  ></td>
	</tr>
	</table>
	<hr/>
	<strong>Your Password:</strong> <input type='password' name='pwd' size='15'><br/><br/>
	<input type='reset' value='Reset Form' />
	<input type='hidden' name='option' value='$option' ><input type='submit' name='submit' value='Submit Form' />";
		

	echo "</form>";
	   
echo "</div>";


if(isset($_POST['submit'])){

sanitizingString($_POST);
$newoption = $_POST['option'];
$name = $_POST['name'];
$desc = $_POST['desc'];
$price = $_POST['price'];
$quan = $_POST['quan'];
$img = $_POST['image'];
$salep = $_POST['salePrice'];
$password = $_POST['pwd'];
define("pass","samurai");
$pwd = constant("pass");




//if((is_string($name)=='true')&&(is_string($desc)=='true')&&(is_int($price)=='true')&&(is_int($quan)=='true')&&(is_int($salep)=='true'))
//{

if((strlen($name)>0)&&(strlen($desc)>0)&&(strlen($price)>0)&&(strlen($quan)>0)&&(strlen($salep)>0)&&($pwd == $password))
{
sanitizingString($_POST);

$data3 = file('catalog.txt');
$result = implode("|",array($name,$desc,$price,$quan,$img,$salep));
$data3 = str_replace($data3[$newoption],"$result\n",$data3);
$newdata = implode($data3);

$fp = fopen('catalog.txt','w');
fwrite($fp,"$newdata");
fclose($fp);
//header('Content-Type: application/xml');
$testObject = new RssFeed('project2.rss');
//$testObject->_construct('project2.rss');
$testObject->replaceRSS('catalog.txt');
}
else
{
echo "Please fill in all the fields and check the password";
}
}

echo "<div id='form2div' >";
	echo "<form action = 'admin.php' method='POST'>
	
	<h2> Add a item </h2>
	<table>
	<tr>
	<td>Name:</td>
	<td><input type='text' name='name'></td>
	</tr>
	<tr>
	<td>Description:</td> 
	<td><textarea name='desc' rows='5' cols='30'></textarea></td>
	</tr>
	<tr>
	<td>Price:</td>
	<td><input type='text' name='price'></td>
	</tr>
	<tr>
	<td>Quantity On Hand:</td>
	<td><input type='text' name='quan'></td>
	</tr>
	<tr>
	<td>Sale Price:</td>
	<td><input type='text' name='salePrice'></td>
	</tr>
	<tr>
	<td>New Image:</td>
	<td><input type='hidden' name='image' value='$img'><input type='file' name='image'></td>
	</tr>
	</table>
	<hr/>
	<strong>Your Password:</strong> <input type='password' name='pwd' size='15'><br/><br/>
	<input type='reset' value='Reset Form' />
	<input type='submit' name='submit2' value='Submit Form' />
	
	</form>";
echo "</div>";	


if(isset($_POST['submit2'])){

sanitizingString($_POST);
$name = $_POST['name'];
$desc = $_POST['desc'];
$price = $_POST['price'];
$quan = $_POST['quan'];
$img = $_POST['image'];
$salep = $_POST['salePrice'];
$password = $_POST['pwd'];
define("pass","samurai");
$pwd = constant("pass");




if((strlen($name)>0)&&(strlen($desc)>0)&&(strlen($price)>0)&&(strlen($quan)>0)&&(strlen($salep)>0)&&($pwd == $password))
{
sanitizingString($_POST);

$result = implode("|",array($name,$desc,$price,$quan,$img,$salep));
echo "$result";
file_put_contents("catalog.txt","\n$result",FILE_APPEND);
$testObject = new RssFeed('project2.rss');
$testObject->replaceRSS('catalog.txt');
}
else
{
echo "Please fill in all the fields and check the password";
}
}


$file = file_get_contents('rss_class.xml');
$dom = new DomDocument();
$dom->loadXML($file);

$all_students=$dom->getElementsByTagName("student");

echo "<div id='form2div'>";	
echo "<form action = 'admin.php' method='POST' >";
echo "choose feed from classmates: <select multiple='multiple' name='allStudents'>";

$k=0;

foreach($all_students as $all_students){

$fname = $all_students->getElementsByTagName('first');
$lname = $all_students->getElementsByTagName('last');
$url = $all_students->getElementsByTagName('url');

$valFname = $fname->item(0)->nodeValue;
$valLname = $lname->item(0)->nodeValue;
$valLink = $url->item(0)->nodeValue;

if($url->item(0)->hasAttribute('selected'))
{

echo "<option value='$valLink' selected='selected'>$valFname $valLname</option>";
}

else
{
echo "<option value='$valLink' >$valFname $valLname</option>";
$k++;
}
}
echo "</select>";
echo "<input type='submit' name='choose' value='select' /></br>";
echo "<strong>Your Password:</strong> <input type='password' name='pwd' size='15'>";
echo "<input type='submit' name='save' value='save' /></form>";
echo "</div>";




$choice = $_POST['allStudents'];
$password = $_POST['pwd'];
define("pass","samurai");
$pwd = constant("pass");


$file = 'rss_class.xml';
$dom = new DomDocument();

$dom->load($file);

$full_students=$dom->getElementsByTagName("student");
echo "<div id='form2div'>";
foreach($full_students as $full_students){

$fname = $full_students->getElementsByTagName('first');
$lname = $full_students->getElementsByTagName('last');
$url = $full_students->getElementsByTagName('url');




$valFname = $fname->item(0)->nodeValue;
$valLname = $lname->item(0)->nodeValue;
$valLink = $url->item(0)->nodeValue;

if($valLink == $choice)
{

$url->item(0)->setAttribute('selected','selected');


echo "<form action='admin.php' method='post'>";
echo "$valFname $valLname"; 
echo "<input type='hidden' name='option' value='$valLink'><input type='submit' name='remove' value='remove'></form>";
}
}


$dom->save($file);
echo "</div>";


if(isset($_POST['remove']))
{


$option = $_POST['option'];

$file2 = 'rss_class.xml';
$dom = new DomDocument();

$dom->load($file2);

$full_students=$dom->getElementsByTagName("student");

foreach($full_students as $full_students){

$fname = $full_students->getElementsByTagName('first');
$lname = $full_students->getElementsByTagName('last');
$url = $full_students->getElementsByTagName('url');

$valFname = $fname->item(0)->nodeValue;
$valLname = $lname->item(0)->nodeValue;
$valLink = $url->item(0)->nodeValue;
$link= $url->item(0);

if($valLink == $option)
{

$link->removeAttribute('selected');
}

}
$dom->save($file2);
}

echo html_foot();


?>



	
	
	
	
	
	
	
	
	
	
	


	
