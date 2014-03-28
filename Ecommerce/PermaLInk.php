<?php
require_once 'LIB_project.php';

echo html_head();

//print_r($_GET);
$choice = $_GET['choice'];

echo "<div id = 'cartdiv'>";
echo permaLink($choice);
echo "</div>";

echo "<a href='index.php'> Go Back to home page </a>" 

//echo html_foot();

?>