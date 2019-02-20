<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
// init app with app id and secret

//FacebookSession::setDefaultApplication( '1783307898635198','c820ff0f49f2dabb18ad259bbe5a63ce' );
FacebookSession::setDefaultApplication( '1506114812817351','0c079869f481523073f7bbefdbf3ee3a' );


// login helper with redirect_uri
    $helper = new FacebookRedirectLoginHelper('http://fbpower-editor.devserver.co.in/fbconfig.php' );
try {
  $session = $helper->getSessionFromRedirect();
  /*$request = new FacebookRequest(
  	$session,
  	'GET',
  	'/1493352994253591/ads'
  );
  $response = $request->execute();
  $graphObject = $response->getGraphObject();*/
} catch( FacebookRequestException $ex ) {
  // When Facebook returns an error
} catch( Exception $ex ) {
  // When validation fails or other local issues
}
// see if we have a session
if ( isset( $session ) ) {
  // graph api request for user data
  $request = new FacebookRequest( $session, 'GET', '/me' );
  $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
     	$fbid = $graphObject->getProperty('id');              // To Get Facebook ID
 	    $fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	    $femail = $graphObject->getProperty('email');    // To Get Facebook email ID
	/* ---- Session Variables -----*/
	    $_SESSION['FBID'] = $fbid;           
      $_SESSION['FULLNAME'] = $fbfullname;
	    $_SESSION['EMAIL'] =  $femail;
    /* ---- header location after session ----*/
  header("Location: userlist.php");
} else {
  $loginUrl = $helper->getLoginUrl();
 header("Location: ".$loginUrl);
}
?>