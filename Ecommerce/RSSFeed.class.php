<?php
//header('Content-Type: application/xml');

class RSSFeed {
	
	public $rssFile;
	
	function __construct($filename) {
		$this->rssFile = $filename;
	}
	
	//This function would be used AFTER updating the catalog file in your admin.php script
public	function replaceRSS($catalogFile) {
$dom = new DomDocument();
$dom->formatOutput = true;
echo "inside";

		//create root element: rss with version attribute and append directly to the DOM: $dom->appendChild("root element variable name"); 
         $theRootElement = $dom->createElement('rss');
         $theVersionAtrribute = $dom->createAttribute('version');
         $theVersionAtrribute->value = '2.0';
		
         $theRootElement->appendChild($theVersionAtrribute);
		 //$theRootElement->appendChild($theEncodingAttribute);
		 $dom->appendChild($theRootElement);

        //create channel element with children: title, language, link and description and append it 
        //the root element (use the variable holding the root element from above)
		$theChannelItem = $dom->createElement('channel');
		$theCtitleElement = $dom->createElement('title');
		$theClinkElement = $dom->createElement('link');
		$theClanElement = $dom->createElement('language');
		$theCdescElement = $dom->createElement('description');
		
		$theCtitleText = $dom->createTextNode('Project 2 RSS Feed');
		$theClinkText = $dom->createTextNode('http://people.rit.edu/sxm6917/739/project2/project2.rss');
		$theClanText = $dom->createTextNode('en-us');
		$theCdescText = $dom->createTextNode('Project 2 RSS Feed');
		
		$theCtitleElement->appendChild($theCtitleText);
		$theClinkElement->appendChild($theClinkText);
		$theClanElement->appendChild($theClanText);
		$theCdescElement->appendChild($theCdescText);
		
		$theChannelItem->appendChild($theCtitleElement);
		$theChannelItem->appendChild($theClanElement);
		$theChannelItem->appendChild($theClinkElement);
		$theChannelItem->appendChild($theCdescElement);
		
		$data = file($catalogFile);
		date_default_timezone_set('UTC');
		$cDate = date('1 jS \of F Y h:i:s A');
		foreach($data as $data)
	    {
	list($name,$desc,$price,$quan,$img,$salp) = explode("|",$data);

		if($salp > 0)
		{
		$theItemElement = $dom->createElement('item');
		
		$theTitleElement = $dom->createElement('title');
		$theTitleText = $dom->createTextNode("$name");
		$theTitleElement->appendChild($theTitleText);
		
		$theDescElement = $dom->createElement('description');
		$theDescText = $dom->createCDATASection("$desc");
		$theDescElement->appendChild($theDescText);
		
		$theLinkElement = $dom->createElement('link');
		$theLinkText = $dom->createTextNode("http://www.wwe.com");
		$theLinkElement->appendChild($theLinkText);
		
		$theLanElement = $dom->createElement('language');
		$theLanText = $dom->createTextNode('en-us');
		$theLanElement->appendChild($theLanText);
		
		$theDateElement = $dom->createElement('pubDate');
		$theDateText = $dom->createTextNode($cDate);
		$theDateElement->appendChild($theDateText);
		
		$thePriceElement = $dom->createElement('price');
		$thePriceText = $dom->createTextNode($price);
		$thePriceElement->appendChild($thePriceText);
		
		$theSalepElement = $dom->createElement('salePrice');
		$theSalePText = $dom->createTextNode($salp);
		$theSalepElement->appendChild($theSalePText);
		
		$theItemElement->appendChild($theTitleElement);
		//$theItemElement->appendChild($theLanElement);
	    $theItemElement->appendChild($theLinkElement);
		$theItemElement->appendChild($theDateElement);
		$theItemElement->appendChild($theDescElement);
		$theItemElement->appendChild($thePriceElement);
		$theItemElement->appendChild($theSalepElement);
		
		$theChannelItem->appendChild($theItemElement);
		
		}
		
		}
		
		$theRootElement->appendChild($theChannelItem);
		
		
		$dom->save($this->rssFile);
	}
}
		
?>	
		
