<?php
require_once 'LIB_project.php';
require_once 'RSSFeed.class.php';

echo html_head();

echo "<div id='form2div'>";
$data = 'rss_class.xml';
$dom = new DomDocument();
$dom->load($data);

$all_students=$dom->getElementsByTagName("student");
 
foreach($all_students as $all_students)
{
$fname = $all_students->getElementsByTagName('first');
$lname = $all_students->getElementsByTagName('last');
$link = $all_students->getElementsByTagName('url');


$valLink = $link->item(0)->nodeValue;
$valFname = $fname->item(0)->nodeValue;
$valLname = $lname->item(0)->nodeValue;
//echo $valLink;
if($link->item(0)->hasAttribute('selected'))
{


echo "<h1 style='color:red';> $valFname $valLname </h1>";

$file = "$valLink";
//if(file_exists($file))
//{

//if (@fopen($_REQUEST[$file],"r")) {
$doc = new DomDocument();
$doc->load($file);

$all_item = $doc->getElementsByTagName('item');

foreach($all_item as $all_item)
{

$title = $all_item->getElementsByTagName('title');
$pubDate = $all_item->getElementsByTagName('pubDate');
$desc = $all_item->getElementsByTagName('description');
$price = $all_item->getElementsByTagName('price');
$salep = $all_item->getElementsByTagName('salePrice');

$valTitle = $title->item(0)->nodeValue;
$valpubDate = $pubDate->item(0)->nodeValue;
$valdesc = $desc->item(0)->nodeValue;
$valprice = $price->item(0)->nodeValue;
$valsalep = $salep->item(0)->nodeValue;


echo "<h2> $valTitle </h2>
      <p> $valpubDate </p>
	  <p> $valdesc</p>
	  <p>Original Price: $valprice </p>
	  <p>Sale Price $valsalep </p>";

}


//}
//else
//{
//echo "Does not exist or not readable";
//}
}
}
echo "</div>";
echo html_foot();
?>