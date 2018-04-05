<?php
	if( $_POST ){
		    // put form submission in session
		    $_SESSION["POST"] = $_POST;
		    // redirect and stop script immediately
		    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		    header( "Location: ".$url );
		    exit;
		}
		if( isset( $_SESSION["POST"] ) ){
		    // there is form submission
		    $_POST = $_SESSION["POST"];
		    unset( $_SESSION["POST"] ); //unset it
		}
?>
