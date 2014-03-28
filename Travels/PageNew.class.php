<?php
class PageNew {
   static function header($title='untitled', $stylesheet='stylesheet.css'){
   	return <<<END
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>$title</title>
	<link type="text/css" rel="stylesheet" href='$stylesheet'/>
</head>
<body>
END;
   }
   
	static function footer() {
		return <<<END
                            
</body>
</html>
END;
   }
   
   static function navigation(){
		return "<div class='nav'><a href='logout.php'>&nbsp;&nbsp;Logout</a></div>\n";
   }
	
	static function printTitle()
	{
		$string = '<div id="header">';
		$string .= '<h1>Elika Travels</h1>';
		$string .= '</div>';

		return $string;
	}

 
 static function createSearchForm()
	{
		
		$string = '<form id="searchForm" action="" method="POST"/>';
		
		$string .= '<h2>Search Criteria</h2>';

		$string .= '<table border=1><tr><td>Category:  <input type="text" name="catname"></td>';
        		  

		$string .= '<td>From:  <input type="text" name="startcity"></td>';

		$string .= '<td>To:  <input type="text" name="endcity"></td>';
				   
		$string .= '<td><input type="submit" value="Go" name="go"></td></tr></table>';

        $string .= '<h2>Available Trips</h2>';
		$string .= Trips::getUpcomingTrips();
	
                                
		$string .= '</form>';
		
		return $string;
	
	}
	
	static function getFormHeader($action='',$method='post') {
	return "<form action=\"$action\" method=\"$method\">";
}

static function getFormFooter() {
	return "</form>";
}


static function getSubmitButton($name,$value) {
	return "<input type=\"submit\" name=\"$name\" value=\"$value\" />";
}

static function getInputBox($name,$label,$size,$type="text",$value="",$readonly="") {
	$size = ($size=="") ?"":" size=\"$size\" ";
	return " $label <input type=\"$type\" name=\"$name\" $size value=\"$value\" $readonly />";
}

static function getHeading($text,$level=2,$color="black") {
	return "<h$level style=\"color: $color;\">$text</h$level>\n";
}

 } // end class Page
 
 
                
                
                
                
                
                
?>