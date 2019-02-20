<?php
/*session_start();

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

FacebookSession::setDefaultApplication('1783307898635198', 'c820ff0f49f2dabb18ad259bbe5a63ce');


$session = new FacebookSession('EAAAAUaZA8jlABAFfy5Wvbhy6ZBBOhsxegYuoyTllk7oqvsZBNBRPVMN2Y2huovZBr5PBjyESuwaEIPJfKvvZCclzRtnSqCfzEvZAI82qLLqWsXf5uUE9mJfj4c10nR9M264GJSYBLAGj9JlpEt0HuiRn9RZBW0U4fgZD');


use FacebookAds\Object\AdCampaign;
use FacebookAds\Object\Fields\AdSetFields;

$adcampaign = new AdCampaign('23842651697850433');
$adsets = $adcampaign->getAdSets(array(
  AdSetFields::NAME,
  AdSetFields::CAMPAIGN_STATUS
));


foreach ($adsets as $adset) {
  echo $adset->name;
}*/

/*$ch = curl_init(); 
				$url = "https://graph.facebook.com/v2.11/search";
				$fields = array(
					'type' 				=> 	'adgeolocation',
					'location_types'=>["india"],
					'q' 	=>  'pu',
					'access_token' 		=> 	'EAAUDxjelmCQBAD2niMDBBGZBMdmSXoYKhdUIGtaw05oJ3NJmW7GEGiq9w6qWZBX0MZBtTl5tzBTYWiZBAEhWZCErrbGZBZAK6rB48TqdQLEgI1MT9N4ZAluV9EYpRzzyjmp2l1rqJWFAcB2Y5kXLzQ0VinxgFTKzqzPt3BipR7j7qApZBJd1WZBiaw',
					
				);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$adsets = json_decode($result, true);
				echo '<pre>';
				print_r($adsets);*/

	/*			$ch = curl_init('http://fb2.devserver.co.in/fb-track/uploads/grb_2.avi');

 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 curl_setopt($ch, CURLOPT_HEADER, TRUE);
 curl_setopt($ch, CURLOPT_NOBODY, TRUE);

 $data = curl_exec($ch);
 $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

 curl_close($ch);
 echo $size;*/



				$ch = curl_init();
				$url = "https://graph-video.facebook.com/v2.11/act_324836501314612/advideos";		

				

				 $img1 = file_get_contents("http://fb2.devserver.co.in/fb-track/uploads/grb_2.avi");
				 
				

				$video="http://fb2.devserver.co.in/fb-track/uploads/SampleVideo_1280x720_1mb.mp4";
				
				$fields = array(
						
					
						'file_url'=>$video,
						'title' =>'testing video',
						'access_token' 		=> 	'EAAAAUaZA8jlABAPbR4DPFgO6GqjuReacjSXHNN4tjuYUvvSYYj6tbfGKbYCopVAUQqgl1YjxwwZCGNQ0ayMId4iaHNnq48b26swmU09uwT9UlW5jSNap9UVikCwv6YDlKxB8MpfK5shn2St6o4K8JHhS7BYAezpYfk8BlECNZAMgMmjGh4jOP6Yw1RBIJgZD',
				
				);		
								
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$adcreative= json_decode($result, true);	
				echo '<pre>';
				print_r($adcreative);
				die;


	/*$url="https://graph.facebook.com/v2.11/act_324836501314612/advideos";
	$fields = array();
	
	$fields['images_urls'][]='https://scontent.xx.fbcdn.net/v/t45.1600-4/23656919_23842676171400514_663837154656387072_n.png?_nc_ad=z-m&_nc_cid=0&oh=774637db65d8339c2bbcae7c2153025c&oe=5AC713C4';
	$fields['images_urls'][]='https://scontent.xx.fbcdn.net/v/t45.1600-4/23656919_23842676171400514_663837154656387072_n.png?_nc_ad=z-m&_nc_cid=0&oh=774637db65d8339c2bbcae7c2153025c&oe=5AC713C4';
	$fields['images_urls'][]='https://scontent.xx.fbcdn.net/v/t45.1600-4/23656919_23842676171400514_663837154656387072_n.png?_nc_ad=z-m&_nc_cid=0&oh=774637db65d8339c2bbcae7c2153025c&oe=5AC713C4';
	$fields['duration_ms'] = 1000;
	$fields['transition_ms'] = 200;
	$field = array(
					'access_token' 	=> 	'EAAAAUaZA8jlABACoOBZCo6K8mbVKUHbaZCtZCn2SW3ClBJpbE7DYi9xBaAaBfD55ObXu9xiRIObHXbXUJKt9YKDvZAoCJLQaPf0JZAIegaPZCzR7GSx8Pn0kc1IRAJASzIh5RHyEbYi2iLzpKuloZAnxvJvQheE0a1FppS8M6uEEyZB62leFfnythibbXbcVAK5QZD',
					'slideshow_spec' =>	json_encode($fields)			
					
				);

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $field);
	$result=curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result, true);
	echo '<pre>';
	print_r($result);*/
				die;