<?php
session_start();
require_once 'PageNew.class.php';



if (isset($_SESSION['login'])) {
		header("Location:index.php");
			}

	if (isset($_POST['login']))
{
$name = $_POST['user'];
$pass = $_POST['password'];

        $curl_handle = curl_init();
	    $data = array('name'=>$name, 'password'=>$pass); 
		curl_setopt($curl_handle, CURLOPT_URL,'http://nova.it.rit.edu/~739_group_three/739/project%203/A/test_login.php');
		//curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl_handle, CURLOPT_HEADER, 0);
		curl_setopt($curl_handle, CURLOPT_POST, true);
		curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $data);
		//curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		//echo "in send post";
		$output = curl_exec($curl_handle);
		curl_close($curl_handle);
		
		if($output = 1)
		{
		//$_SESSION['login'] = 'true';
		}
		
	
		
		
       
		
		
}
if (isset($_POST['login']) && (!isset($_POST['user']) || !isset($_POST['password']))) {
		echo "username and passwords are required";
	}
	
	

    echo PageNew::getFormHeader("http://nova.it.rit.edu/~739_group_three/739/project%203/A/new_login.php");
	echo PageNew::getInputBox($name="user",$label="User name: ",$size="10",$type="text",$value=$user);
	echo PageNew::getInputBox($name="password",$label="Password: ",$size="20",$type="password");
	echo " ".PageNew::getSubmitButton($name="login",$value="Login");
	echo PageNew::getFormFooter();	

	echo PageNew::footer();
	
	


	
?>