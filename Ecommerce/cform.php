<?php

require_once 'LIB_project.php';
echo html_head();

echo "<div id='form1div'>";
    echo "<table>
	<tr>
	<td>Name:</td> 
	<td><input type='text' name='name' value='name'></td>
	</tr>
	<tr>
	<td>E-Mail:</td>
	<td><input type='text' name='mail' value='mail'></td>
	</tr>
	<tr>
	<td>Comments:</td>
	<td><textarea name='desc' rows='5' cols='30' >$desc</textarea></td>
	</tr>
	</table>
	<input type='submit' name='submit' value='Submit' />";
	
echo "</div>";	
echo html_foot();

?>