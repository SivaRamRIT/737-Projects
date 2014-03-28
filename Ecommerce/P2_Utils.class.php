<?php

class P2_Utils {

public function __construct()
{
}

public static function project2_process_authorize() {

$url = "http://people.rit.edu/sxm6917/739/project%202/cart.php";
$api_login_id = '9j7K6m96tYV'; // your api login
$md5_setting = '9j7K6m96tYV'; // Your MD5 Setting - use your api login id
$response = new AuthorizeNetSIM($api_login_id, $md5_setting);

if ($response->isAuthorizeNet()) {
   if ($response->approved) {
      // Do your processing here.
      $redirect_url = $url . 
		'?response_code=1&transaction_id=' .
	 	$response->transaction_id; 
   } else {
       // Redirect to error page.
       $redirect_url = $url . 
		'?response_code='.$response->response_code .
		 '&response_reason_text=' . 
		$response->response_reason_text;
    }
   	// Send the Javascript back to AuthorizeNet, which
	// will redirect user back to your site.
     return AuthorizeNetDPM::getRelayResponseSnippet($redirect_url);
} else {
    return "Error -- not AuthorizeNet. Check your MD5 Setting.";
}

}

public static function project2_process_authorize_response() {

     if ($_GET['response_code'] == 1) {
           //empty cart on success
		   file_put_contents("cart.txt","");
            //project1_empty_cart();
           return "<br /><span class='good'>Thank you for your purchase! Transaction id: " . htmlentities($_GET['transaction_id'])."</span><br />";
     } else {
              return "<br /><span class='error'>Sorry, an error occurred: " . htmlentities($_GET['response_reason_text'])."</span></br >";
     }

}
}

?>