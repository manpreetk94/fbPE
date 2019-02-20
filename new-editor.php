<?php 
include 'header.php';

$error= '';
$success= '';

/*get all page ids of selected user*/
	
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://manage.marketresearchltd.net/v1/accounts/get_assigned_accounts?method=post&uid=".$_SESSION['user']['uid']."&pass=".$_SESSION['user']['pass']."&key=".$_SESSION['user']['key']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$users = json_decode($result, true);
	$for_ads_fbPages=array();
	if(!empty($users['response'])):
	foreach ($users['response'] as $key => $user) :
		if($user['ad_account_info']['id']==$_REQUEST['act']):					
			foreach ($user['pages'] as $keys => $pge) :

				$for_ads_fbPages[]=$pge;
				$pges[]=$pge['id'];
			endforeach;
		endif;
	endforeach;
	endif;
	if(!empty($pges)){		
		$page_id = $pges[0];
	}

	
	
/*get all page ids of selected user*/

if(isset($_SESSION['user'])) :

	/*create campaigns and adsets and ads*/
	if(isset($_REQUEST['camp_save_draft'])) {
		
		/*create a campaigns*/
		if($_REQUEST['choose_campaigns'] == 'new') {

			if($_REQUEST['campaign_name'] != '') { 
				$campaign_name = $_REQUEST['campaign_name'];
			} else {
				$campaign_name = 'Untitled Campaign';
			}

			$ch = curl_init();
			$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/campaigns";
			$fields = array(
				'name' 			=> $campaign_name,
				'objective' 	=>  $_REQUEST['objective'],
				'access_token' 	=> 	$_REQUEST['code']
			);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
			$result = curl_exec($ch);
			curl_close($ch);
			$camp = json_decode($result, true);
		
			if(isset($camp['error'])){
				$error .= $camp['error']['message'];
			}else{
				$success .='Campaign created.';
			}
		
			
			?>
			<!-- <script type="text/javascript">
				jQuery(document).ready(function(){
					setTimeout(function() {
						var camp_id = '<?php echo $camp['id']?>';
						jQuery("#camapaign_table tr#"+camp_id+' .campaigns_checkbox').prop('checked',true);
						jQuery("#camapaign_table tr#"+camp_id+' .edit-charts').click();
					},500);
				});
			</script> -->
			<?php 
		}

		if($_REQUEST['choose_campaigns'] == 'existing') {
			$camp['id'] = $_REQUEST['exit_camapaign_id'];
		}
		/*create a campaigns*/
		/*create a adset inside created campaign*/
		if($camp) {
			if($_REQUEST['adset_name'] != '') { 
				$adset_name = $_REQUEST['adset_name'];
			} else {
				$adset_name = 'Untitled AdSet';
			}

			if($_REQUEST['choose_adsets'] == 'new') {

				$ch = curl_init();
				$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adsets";
				$fields = array(
					'name' 				=> 	$adset_name,
					'billing_event' 	=>  'IMPRESSIONS',
					'access_token' 		=> 	$_REQUEST['code'],
					'campaign_id'  		=> 	$camp['id'],
					'targeting'    		=> 	'{"geo_locations":{"countries":["US"]}}',
					'bid_amount'		=> 	200,
					'daily_budget'		=> 	10000,
					'optimization_goal' => 	'IMPRESSIONS',
					'destination_type'	=>  'WEBSITE'
				);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$adsets = json_decode($result, true);
				
				if(isset($adsets['error'])){
					$error .='</br>'. $adsets['error']['message'];
				}
				else{
				$success .='</br> Adset created.';
				}
				
				if($_REQUEST['choose_campaigns'] == 'existing') : ?>
				<!-- <script type="text/javascript">
					jQuery(document).ready(function(){
						setTimeout(function() {
							jQuery('a[href="#ad-sets"]').click();
							var adset_id = '<?php echo $adsets['id']?>';
							jQuery("#adset_table tr#"+adset_id+' .adsets_checkbox').prop('checked',true);
							jQuery("#adset_table tr#"+adset_id+' .edit-charts').click();
						},500);
					});
				</script> -->
				<?php 
				endif;
			}
			if($_REQUEST['choose_adsets'] == 'existing') {
				/*$cSession = curl_init(); 
				curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['exit_adset_id']."/?access_token=".$_REQUEST['code']."&fields=id,name,campaign_id,status,delivery_info,billing_event,targeting,bid_amount,optimization_goal,lifetime_budget,daily_budget,start_time,end_time,objective_for_results,objective_for_cost,targeting_age_min,targeting_age_max,targeting_genders,targeting_countries,activities{actor_name,event_time,application_name,translated_event_type,extra_data},insights{reach,frequency,impressions,unique_clicks,spend}");
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($cSession,CURLOPT_HEADER, false); 
				$result=curl_exec($cSession);
				curl_close($cSession);
				$adsets_data = json_decode($result, true);
				if($adsets_data['optimization_goal'] == '') {
					$optimization_goal = 'NONE';
				} else {
					$optimization_goal = $adsets_data['optimization_goal'];
				}
				$ch = curl_init();
				$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adsets";
				$fields = array(
					'access_token' 				=> 	$_REQUEST['code'],
					'campaign_id'  				=> 	$camp['id'],
					'name' 						=> 	$adsets_data['name'],
					'billing_event' 			=>  $adsets_data['billing_event'],
					'targeting'    				=> 	json_encode($adsets_data['targeting']),
					'bid_amount'				=> 	$adsets_data['bid_amount'],
					'daily_budget'				=> 	$adsets_data['daily_budget'],
					'status'					=>  $adsets_data['status'],
					'delivery_info'				=>  json_encode($adsets_datas['delivery_info']),
					'lifetime_budget'			=>  $adsets_data['lifetime_budget'],
					'start_time'				=>  $adsets_data['start_time'],
					'objective_for_results'		=>  $adsets_data['objective_for_results'],
					'objective_for_cost'		=>  $adsets_data['objective_for_cost'],
					'activities'				=>  json_encode($adsets_data['activities']),
					'optimization_goal'			=>  $optimization_goal,
					'destination_type'			=>  'WEBSITE'
				);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$adsets = json_decode($result, true);
				if(isset($adsets['error'])){
					$error .='</br>'. $adsets['error']['message'];
				}else{
				$success .='</br> Adset created.';
				}*/
				$adsets['id'] = $_REQUEST['exit_adset_id'];
			}
			/*add images*/
				$ch = curl_init();
				$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adimages";		

				$img = file_get_contents("http://www.topcareer.jp/inter/assets/images/fair/tcus2017/photo_ew.png");
				$fields = array(
					'access_token' 	=> 	$_REQUEST['code'],	
					'filename' => 'filename',				
					'bytes' 		=> base64_encode($img),
				);		
								
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$adcreative= json_decode($result, true);	
				if(isset($adcreative['error'])){
					$error .='</br>'. $adcreative['error']['message'];
				}
			/*add images*/

			/* add creative */
				$ch = curl_init();
				$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adcreatives";
				$link_data =array('link_data'=>array('image_hash'=>$adcreative['images']['bytes']['hash'],'link'=>'https://www.facebook.com','message'=>'message'),'page_id'=>$page_id);
				$fields = array(
					'access_token' 	=> 	$_REQUEST['code'],
					'name' =>	$adsets['id'],					
					'object_story_spec'=>json_encode($link_data),			
				);
				
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$adcreative= json_decode($result, true);
				if(isset($adcreative['error'])){
					$error .='</br>'. $adcreative['error']['message'];
				}

				/* end add creative */


			/* create ad */
				$ch = curl_init();
				$creative_id=array();
				$creative_id['creative_id']=$adcreative['id'];
			    $creative_id=json_encode($creative_id);
			    if($_REQUEST['ad_name']==''){
			    	$ad_name = 'Untitled Ad';
			    }else{
			    	$ad_name = $_REQUEST['ad_name'];
			    }

				$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/ads";
				$fields = array(
					'access_token' 	=> 	$_REQUEST['code'],
					'name' 			=>  $ad_name,
					'adset_id' 		=> 	$adsets['id'],
					'creative' 		=> $creative_id,
					//'redownload'	=> "true",
					'status' 		=> 'ACTIVE',

				);				
				//print_r($fields);				
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$adimages = json_decode($result, true);				
				if(isset($adimages['error'])){
					if($adimages['error']['error_user_msg']){
							$error .='</br>'. $adimages['error']['error_user_msg'];
					}else{
						$error .='</br>'. $adimages['error']['message'];
					}
				}else{
				$success .='</br> Ad created.';
				}
				
				
			/* create ad */
			/*create a adset inside created campaign*/
		}
	}
	/*create campaigns and adsets and ads*/

	/*delete campaigns*/
	if(isset($_REQUEST['delete_campaigns'])) {
		$campaigns_ids = json_decode($_REQUEST['campaign_id'], true);
		
		if(!empty($campaigns_ids)){
			foreach ($campaigns_ids as $val ) {
				$url = 'https://graph.facebook.com/v2.11/'.$val.'/?access_token='.$_REQUEST['code'];
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				$data = json_decode($response, true);
				//print_r($data);
			}
		}
	}
	/*delete campaigns*/

	/*delete adsets*/
	if(isset($_REQUEST['delete_adsets'])) {
		$adsets_id = json_decode($_REQUEST['delete_adset_id'], true);
		if(!empty($adsets_id)){
			foreach ($adsets_id as $val ) {
				$url = 'https://graph.facebook.com/v2.11/'.$val.'/?access_token='.$_REQUEST['code'];
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				//$data = json_decode($result, true);
			}
		}
	}

	/*delete adsets*/

	/*delete ads*/
	if(isset($_REQUEST['delete_adsets'])) {
		$ads_id = json_decode($_REQUEST['delete_ads_id'], true);
		if(!empty($ads_id)){
			foreach ($ads_id as $val ) {
				$url = 'https://graph.facebook.com/v2.11/'.$val.'/?access_token='.$_REQUEST['code'];
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($ch);
				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				//$data = json_decode($result, true);
			}
		}
	}

	/*delete ads*/



	/*duplicates_campaigns*/
	if(isset($_REQUEST['duplicates_campaigns'])) {
		$camps_id = json_decode($_REQUEST['duplicate_campaign_id'], true);
		$total_copies = $_REQUEST['duplicate_campaign_count'];
		if(!empty($camps_id)):
			foreach($camps_id as $id) {
				$cSession = curl_init(); 
				curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$id."/?access_token=".$_REQUEST['code']."&fields=name,buying_type,objective,id,objective_for_results,objective_for_cost,status,delivery_info,start_time,stop_time,insights{reach,impressions,frequency,unique_clicks,spend},adsets{id,name,status,delivery_info,billing_event,targeting,bid_amount,lifetime_budget,daily_budget,start_time,end_time,objective_for_results,objective_for_cost,targeting_age_min,targeting_age_max,targeting_genders,targeting_countries,activities{actor_name,event_time,application_name,translated_event_type,extra_data},insights{reach,frequency,impressions,unique_clicks,spend}},account_id,ads{name,id,delivery_info,objective_for_results,objective_for_cost,status,insights{frequency,impressions,spend,unique_clicks,total_unique_actions,relevance_score,reach}}");
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($cSession,CURLOPT_HEADER, false); 
				$result=curl_exec($cSession);
				curl_close($cSession);
				$camapaigns = json_decode($result, true);

				/*make copy of existing campaings */
				for($i=0; $i<$total_copies; $i++) {
					$ch = curl_init();
					$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/campaigns";
					$fields = array(
						'access_token' 				=> 	$_REQUEST['code'],
						'name' 						=>	$camapaigns['name'].' - Copy',
						'objective' 				=>  $camapaigns['objective'],
						'buying_type' 				=> 	$camapaigns['buying_type'],
						'objective_for_results'		=> 	$camapaigns['objective_for_results'],
						'objective_for_cost'		=> 	$camapaigns['objective_for_cost'],
						'status'					=>  $camapaigns['status'],
						'start_time'				=>  $camapaigns['start_time'],
						'account_id'				=>  $camapaigns['account_id'],
						'delivery_info'				=>  json_encode($camapaigns['delivery_info'])
					);
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_POST, true);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
					$result = curl_exec($ch);
					curl_close($ch);
					$newCamp = json_decode($result, true); ?>
					<script type="text/javascript">
						jQuery(document).ready(function(){
							setTimeout(function() {
								var camp_id = '<?php echo $newCamp['id']?>';
								jQuery("#camapaign_table tr#"+camp_id+' .campaigns_checkbox').prop('checked',true);
								jQuery("#camapaign_table tr#"+camp_id+' .edit-charts').click();
							},500);
						});
					</script>
					<?php 

					/*make copy of adset inside campaigns*/
					if($newCamp) {
						foreach ($camapaigns['adsets']['data'] as $adset) :
						$ch = curl_init();
						$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adsets";
						$fields = array(
							'access_token' 				=> 	$_REQUEST['code'],
							'campaign_id'  				=> 	$newCamp['id'],
							'name' 						=> 	$adset['name'],
							'billing_event' 			=>  $adset['billing_event'],
							'targeting'    				=> 	json_encode($adset['targeting']),
							'bid_amount'				=> 	$adset['bid_amount'],
							'daily_budget'				=> 	$adset['daily_budget'],
							'status'					=>  $adset['status'],
							'delivery_info'				=>  json_encode($adsets['delivery_info']),
							'lifetime_budget'			=>  $adset['lifetime_budget'],
							'start_time'				=>  $adset['start_time'],
							'objective_for_results'		=>  $adset['objective_for_results'],
							'objective_for_cost'		=>  $adset['objective_for_cost'],
							'activities'				=>  json_encode($adset['activities'])
						);
						curl_setopt($ch, CURLOPT_URL, $url);
						curl_setopt($ch, CURLOPT_POST, true);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
						$result = curl_exec($ch);
						curl_close($ch);
						$adsets = json_decode($result, true);
						endforeach;
					}
					/*make copy of adset inside campaigns*/
				}
				/*make copy of existing campaings */
			}
		endif;		
	}
	/*duplicates_campaigns*/

	/* duplicates adsets*/
	if(isset($_REQUEST['duplicates_adsets_saved'])) {
		
		$adsets_id = json_decode($_REQUEST['duplicate_adsets_id'], true);
		foreach ($adsets_id as $adset) {
			$camp_style = $_REQUEST['campaign_for_adset'];
			/*create new campaing first if New campaign set*/
			if($camp_style == 'New campaign') {
				$ch = curl_init();
				$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/campaigns";
				$fields = array(
					'name' 			=> 	$_REQUEST['campaign_name'],
					'objective' 	=>  $_REQUEST['objective'],
					'access_token' 	=> 	$_REQUEST['code']
				);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$newCampData = json_decode($result, true);
				$new_camp_id = $newCampData['id'];
				
			}
			/*create new campaing first*/

			/*get seleceted adsets data*/
			$cSession = curl_init(); 
			curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$adset."/?access_token=".$_REQUEST['code']."&fields=id,name,campaign_id,status,delivery_info,billing_event,targeting,bid_amount,optimization_goal,lifetime_budget,daily_budget,start_time,end_time,objective_for_results,objective_for_cost,targeting_age_min,targeting_age_max,targeting_genders,targeting_countries,activities{actor_name,event_time,application_name,translated_event_type,extra_data},insights{reach,frequency,impressions,unique_clicks,spend}");
			curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($cSession,CURLOPT_HEADER, false); 
			$result=curl_exec($cSession);
			curl_close($cSession);
			$adsets_data = json_decode($result, true);
			if($adsets_data['optimization_goal'] == '') {
				$optimization_goal = 'NONE';
			} else {
				$optimization_goal = $adsets_data['optimization_goal'];
			}
			/*get seleceted adsets data*/

			if($camp_style == 'Original campaign') {
				$new_camp_id = $adsets_data['campaign_id'];
			} 
			if($camp_style == 'Existing campaign') {
				$new_camp_id = $_REQUEST['already_campaign_id'];	
			}
			/*made duplicatte copy of adsets in camapaigns*/
			$total_copies = $_REQUEST['duplicate_adsets_count'];
			for ($i=0; $i<$total_copies; $i++) {
				$ch = curl_init();
				$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adsets";
				$fields = array(
					'access_token' 				=> 	$_REQUEST['code'],
					'campaign_id'  				=> 	$new_camp_id,
					'name' 						=> 	$adsets_data['name'],
					'billing_event' 			=>  $adsets_data['billing_event'],
					'targeting'    				=> 	json_encode($adsets_data['targeting']),
					'bid_amount'				=> 	$adsets_data['bid_amount'],
					'daily_budget'				=> 	$adsets_data['daily_budget'],
					'status'					=>  $adsets_data['status'],
					'delivery_info'				=>  json_encode($adsets_datas['delivery_info']),
					'lifetime_budget'			=>  $adsets_data['lifetime_budget'],
					'start_time'				=>  $adsets_data['start_time'],
					'objective_for_results'		=>  $adsets_data['objective_for_results'],
					'objective_for_cost'		=>  $adsets_data['objective_for_cost'],
					'activities'				=>  json_encode($adsets_data['activities']),
					'optimization_goal'			=>  $optimization_goal
				);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
				$result = curl_exec($ch);
				curl_close($ch);
				$new_adsets = json_decode($result, true);
			}
			/*made duplicatte copy of adsets in camapaigns*/

		}
	}
	/* duplicates adsets*/

	/*get all accounts of selected user*/
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/me/adaccounts?fields=account_status,name,account_id,business&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$accounts = json_decode($result, true);
	
	/*get all accounts of selected user*/


	/*get all accounts of business user*/
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/me/?fields=business_users{id,name,email,business},name,picture&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$b_users = json_decode($result, true);  
		
	/*get all accounts of business user*/
	


	/*get camapagins, adsets and status*/
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/campaigns?access_token=".$_REQUEST['code']."&period=lifetime&fields=name,objective_for_results,objective_for_cost,account_id,buying_type,objective,id,status,start_time,stop_time,delivery_info,brand_configuration,spend_cap,insights{reach,impressions,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,date_start,date_stop,actions,cost_per_action_type},adsets{campaign_id,id,saved_audience,is_autobid,name,status,delivery_info,billing_event,attribution_spec,targeting,bid_amount,lifetime_budget,daily_budget,start_time,end_time,objective_for_results,objective_for_cost,targeting_age_min,targeting_age_max,optimization_goal,targeting_genders,lifetime_imps,targeting_countries,activities{actor_name,event_time,application_name,translated_event_type,extra_data},insights{reach,frequency,impressions,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type},pacing_type,destination_type,date_start,date_stop},ads{campaign_id,adset_id,name,id,delivery_info,preview_link,creative{object_story_id,image_url,call_to_action_type,image_hash,url_tags,object_id,video_id},creative_id,creative_title,creative_body,creative_link_url,objective_for_results,objective_for_cost,status,insights{frequency,impressions,spend,unique_clicks,total_unique_actions,relevance_score,reach,inline_link_clicks,cost_per_inline_link_click,date_start,date_stop,actions,cost_per_action_type},adcreatives{image_url,id,object_story_spec,object_story_id,title,body,link_url,thumbnail_url,description,caption,url_tags}}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$camapaigns = json_decode($result, true);


	/* get activities */

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/?access_token=".$_REQUEST['code']."&fields=name,activities{event_time,event_type,object_name,application_name,extra_data,date_time_in_timezone,translated_event_type,actor_name,object_id},adimages{url_128,hash},advideos{title,id,picture,updated_time,length},business{profile_picture_uri,name},users");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$history = json_decode($result, true);

	
	/* end get  activities */

?>
<script type="text/javascript">
	var _camapaigns = <?php echo json_encode($camapaigns['data']); ?>;
//	var _pages ='<?php echo $pages_html; ?>';

</script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.listing .account-category').click(function(){
			$('.account-category').removeClass('active');
			$(this).addClass('active');
			$('.current_account').text($(this).find('.account_name').text()+' ('+$(this).find('.account_id').text()+')');
			var url = window.location.toString();
			console.log('url', url);
			var act = '<?php echo $_REQUEST['act'];?>';
			window.location = url.replace(act, 'act_'+$(this).find('.account_id').text());
			$(".personal-acc-by-id").slideToggle();
		});	

	});
</script>
 <!-- add image and video in popup radio option script -->
 <script type="text/javascript">
 $(document).ready(function() {
	 $('.thumbCheck').click(function () {
        if ($('input:not(:checked)')) {
            $('div').removeClass('selected-img-thumb');
        }
        if ($('input').is(':checked')) {
            $(this).parent().addClass('selected-img-thumb');  
            var val= $(this).val();

            var img = '<div class="loded_img thumb selected-img-thumb" rel="" id="slct_creative"><img src="'+val+'" width="100px" height="100px"></div>';
      		$('.apd_creative_img').html(img);
      		$('#slct_creative').attr('rel',val);

        }
    });
});
 </script>

 <!-- video poups list and grid view script -->
 <script type="text/javascript">
 $(document).ready(function() {
	 $('.video-list-view-link').click(function () {
         $('.video-list-video').show();
         $('.video-grid-view').hide();
    });
	 $('.video-grid-view-link').click(function () {
         $('.video-list-video').hide();
         $('.video-grid-view').show();
    });
});
 </script>

 <!-- auto complete search script -->
 <script type="text/javascript">
 $(document).ready(function() {
	 $('.custom-auto-complete').click(function () {
         $(this).find('.custom-auto-complete-data').toggle();
         
    });
});

 setTimeout(function() {
    $('.error').fadeOut('slow');
}, 10000); // <-- time in milliseconds

 </script>
<input type="hidden" value="<?php echo $history['name']; ?>" class="account_name">
<input type="hidden" value="" class="objectiveGRP">
<div class="web-outr">
	<!--header-part-->
	<div class="header-outr">
		<div class="header-inr">
			<div class="container-fluid">
				<div class="header-left-sec">
					<a href="#" class="logo"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
					<div class="power-editor-dropdown">
						<a href="#" class="power-editor-menu"><i class="fa fa-list" aria-hidden="true"></i><span>Power Editor</span></a>
					</div>
				</div>
				<div class="power-editor-menus-list">
					<div class="power-menu">
						<span class="menu-arrow"></span>
						<ul>
							<li>
								<h5><i class="fa fa-star" aria-hidden="true"></i> Frequently Used</h5>
							</li>
							<li><a href="ads-manager.html">Ads Manager</a>
							</li>
							<li><a href="index.html" class="active">Power Editor</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="header-right-ec pull-right">
					<div class="header-search">
						<div class="input-group stylish-input-group">
							<input type="text" class="form-control" placeholder="Search">
							<span class="input-group-addon">
								<button type="submit">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</span>
						</div>
					</div>
					<ul class="header-avatar">
						<li>
							<div class="dropdown header-ava">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="<?php echo $history['business']['profile_picture_uri']; ?>">
									<?php //echo $_SESSION[ 'user'][ 'email'];
									 echo $history['business']['name']; ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<span class="top-arrow"></span>
									<ul>
										<li>
											<a class="dropdown-item" href="https://www.facebook.com">Go to Personal News Feed</a><a class="dropdown-item pull-right" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
										</li>
										<?php 
										if(!empty($b_users['business_users']['data'])):
											foreach($b_users['business_users']['data'] as $b_usr) : ?>
											<li <?php if($history['business']['id']==$b_usr['business']['id']) { echo 'class="yes_act"';}?>>
												<?php $cSession = curl_init(); 
														curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$b_usr['business']['id']."/?fields=profile_picture_uri&access_token=".$_REQUEST['code']);
														curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
														curl_setopt($cSession,CURLOPT_HEADER, false); 
														$result=curl_exec($cSession);
														curl_close($cSession);
														$pic = json_decode($result, true); 
														if($pic['profile_picture_uri']==''){$pic['profile_picture_uri']='img/acc-img.png';}
														?>

												<div class="different-acc">
													
													<img src="<?php echo $pic['profile_picture_uri']; ?>">
													<?php if($history['business']['id']==$b_usr['business']['id']): ?>
														<i class="fa fa-check pull-right" aria-hidden="true"></i>
													<?php endif; ?>
													<p><b><?php echo $b_usr['business']['name']; ?></b>
														<?php echo $b_usr['email']; ?>
													</p>
												</div>
											</li>
											<?php											
											endforeach; 
										endif;
										 ?>
									
										<?php
										foreach($history['users']['data'] as $puser){
											if($puser['role']=='1001'){
												?>
												<li style="background-color:#edf2fa;">
													<div class="different-acc">
													
														<img src="https://graph.facebook.com/<?php echo $puser['id']; ?>/picture?type=square">
														<p><b>Your Personal Ad Account</b>
														<?php
														
																echo $puser['name'];
																
															
														?>
															
														</p>
													</div>
												</li>
										<?php
										break;
											}
										}
										?>
										
									</ul>  
								</div>
							</div>
						</li>
					</ul>
					<ul class="header-right-icons">
						<li><a href="#" class="notification"><i class="fa fa-globe" aria-hidden="true"></i></a> 

						

						</li>
						<li><!-- <a href="#" class="header-pages"><i class="fa fa-flag" aria-hidden="true"></i></a> -->

							<div class="dropdown header-ava">
								<button  style="vertical-align:baseline" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<a href="#" class="header-pages"><i class="fa fa-flag" aria-hidden="true"></i></a>
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<span class="top-arrow"></span>
									<ul>
										<li>
											<a class="dropdown-item" href="#">Your Pages</a
										</li>
										<?php
										if(!empty($for_ads_fbPages)):
											foreach($for_ads_fbPages as $fb_pages) : ?>
											<li>
												<?php $cSession = curl_init(); 
														curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$fb_pages['id']."/?fields=username,picture&access_token=".$_REQUEST['code']);
														curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
														curl_setopt($cSession,CURLOPT_HEADER, false); 
														$result=curl_exec($cSession);
														curl_close($cSession);
														$pic = json_decode($result, true); 
														if(@$pic['picture']['data']['url']==''){@$pic['picture']['data']['url']='img/acc-img.png';}
														?>
												<div class="different-acc">
													<img src="<?php echo $pic['picture']['data']['url']; ?>">
													<p><b><?php echo $fb_pages['name']; ?></b>
														<?php echo $fb_pages['category']; ?>
													</p>
												</div>
											</li>
											<?php endforeach; 
										endif;
										?>
										<?php if(empty($for_ads_fbPages)){
											echo "You don't have any Pages.";
											}
										?>										
										
									</ul>  
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--end header-part-->
	<div class="body-overlay"></div>
	<!-- main section -->
	<div class="working-area-outr">
		<!-- user accounts -->
		<div class="sub-header-outr">
			<div class="sub-header-inr">
				<div class="container-fluid">
					<div class="sub-header-left-acnt-sec">
						<a href="#"><span class="current_account"><?php echo $history['name']." (".str_replace('act_', '', $_REQUEST['act']).")";?></span> <i class="fa fa-caret-down" aria-hidden="true"></i></a>

						<div class="personal-acc-by-id-outr">
							<div class="personal-acc-by-id">
								<span class="top-arrow"></span>
								<ul>
									<li style="padding: 15px;">
										<input type="text" name="" class="form-control" placeholder="Search">
									</li>
								</ul>
								<ul class="listing" style="<?php if(count($accounts['data']) > 5) : echo 'height: 500px;'; endif; ?>">
									<li>
										<h5><img src="img/prsnl-acnt-icon.png"> your personal accounts</h5>
										<?php 
										if(!empty($accounts['data'])):
											foreach ($accounts['data'] as $key => $account): ?>
												<?php if($account['id'] == $_REQUEST['act']): $acc_class='active' ; else : $acc_class=''; endif; ?>
												<div class="account-category <?php echo $acc_class;?>">
													<img src="img/acnt-by-id-icon.png">
													<?php if($account['id'] == $_REQUEST['act']): ?>
															<i class="fa fa-check pull-right" aria-hidden="true"></i>
													<?php endif; ?>
													<p>
														<span class="account_name"><b><?php echo $account['name'];?></b></span> Account #: <span class="account_id"><?php echo $account['account_id'];?></span>
													</p>
												</div>
											<?php endforeach; 
										endif;
										?>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="sub-header-right-btns-sec">
						<ul>
							<!-- <li>
								<button class="light-grey-btn">Discard Changes</button>
							</li>
							<li>
								<button class="blue-btn"><i class="fa fa-arrow-up" aria-hidden="true"></i> Review Draft Items (3)</button>
							</li>
							<li>
								<button class="light-grey-btn"><i class="fa fa-gear" aria-hidden="true"></i>
								</button>
							</li> -->
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!--end user accounts -->
		<!-- error -->
			<div class="error text-center" style="color:red;">
			<?php
				if(isset($camapaigns['error']))
				{
					echo $camapaigns['error']['message'].'</br>';
				}
				if($error!=''){
					echo $error;
				}
			?>
			</div>
		<!-- error -->
		<!-- filters, search and date -->
		<div class="filter-header-outr">
			<div class="filter-header-inr">
				<div class="container-fluid">
					<div class="dropdown search-filter">
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<i class="fa fa-search" aria-hidden="true"></i> Search
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
								<li class="dropdown-header">Search By</li>
								<li class="search_by" rel="Campaign Name" value="name"><a href="#" id=""> Campaign Name</a>
								</li>
								<li class="search_by" rel="Adset Name" value="adset.name"><a href="#">Adset Name</a>
								</li>
								<li class="search_by" rel="Ad Name" value="ad.name"><a href="#">Ad Name</a>
								</li>
								<li class="search_by_id " rel="Campaign Id" value="id"><a href="#">Campaign Id</a>
								</li>
								<li class="search_by_id " rel="Adset Id" value="adset.id"><a href="#">Adset Id</a>
								</li>
								<li class="search_by_id " rel="Ad Id" value="ad.id"><a href="#">Ad Id</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="header-filter">
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1">
								<i class="fa fa-filter" aria-hidden="true"></i> Filters
								<span class="caret"></span>
							</button>
							<div class="dropdown-menu filters-for-all search_by_filter" aria-labelledby="dropdownMenu1" id="accordion11">
								<div class="first-level-li">
									<span>Campaign  Delivery</span>							
	  								<ul id="firstLink">
										
										<li rel="active" value="delivery_info" ><a href="#">Active</a>
										</li>
										<li rel="inactive"  value="delivery_info" ><a href="#">InActive</a>
										</li>
										<li rel="scheduled"  value="delivery_info" ><a href="#">Scheduled </a>
										</li>
										<li rel="not_delivering"  value="delivery_info" > <a href="#">Not Delivery </a>
										</li>
										<li rel="completed"  value="delivery_info" ><a href="#">Completed </a>
										</li>
										<li rel="rejected"  value="delivery_info" ><a href="#">Rejected </a>
										</li>
										<li rel="pending_review"  value="delivery_info" ><a href="#">Pending Review </a>
										</li>
										</ul>
								</div> 
								<div class="first-level-li">
									<span>Adset  Deleivery</span>							
	  								<ul id="firstLink">										
										<li rel="active"   value="adset.delivery_info" ><a href="#">Active</a>
										</li>
										<li rel="inactive"  value="adset.delivery_info" ><a href="#">InActive</a>
										</li>
										<li rel="scheduled"  value="adset.delivery_info" ><a href="#">Scheduled </a>
										</li>
										<li rel="not_delivering"  value="adset.delivery_info"><a href="#">Not Delivery </a>
										</li>
										<li rel="completed"  value="adset.delivery_info" ><a href="#">Completed </a>
										</li>
										<li rel="rejected"  value="adset.delivery_info" ><a href="#">Rejected </a>
										</li>
										<li rel="pending_review"  value="adset.delivery_info" ><a href="#">Pending Review </a>
										</li>
									</ul>
								</div> 
								<div class="first-level-li">
									<span>Ad  Deleivery</span>							
	  								<ul id="firstLink">										
										<li rel="active"  value="ad.delivery_info" ><a href="#">Active</a>
										</li>
										<li rel="inactive"  value="ad.delivery_info" ><a href="#">InActive</a>
										</li>
										<li rel="scheduled"  value="ad.delivery_info" ><a href="#">Scheduled </a>
										</li>
										<li rel="not_delivering"  value="ad.delivery_info" ><a href="#">Not Deleivery </a>
										</li>
										<li rel="completed"  value="ad.delivery_info" ><a href="#">Completed </a>
										</li>
										<li rel="rejected"  value="ad.delivery_info" ><a href="#">Rejected </a>
										</li>
										<li rel="pending"  value="ad.delivery_info" ><a href="#">Pending Review </a>
										</li>
									</ul>
								</div> 
								<div class="first-level-li">
									<span>Objectives</span>							
	  								<ul id="firstLink">										
										<li rel="APP_INSTALLS" value="objective"><a href="#">App Installs </a>
										</li>
										<li rel="LINK_CLICKS" value="objective"><a href="#">Link Click </a>
										</li>
										<li rel="BRAND_AWARENESS" value="objective"><a href="#" >Brand Awareness </a>
										</li>
										<li rel="PRODUCT_CATALOG_SALES" value="objective"><a href="#">Catalog Sales </a>
										</li>
										<li rel="CONVERSIONS" value="objective"><a href="#">Conversions</a>
										</li>
										<li rel="EVENT_RESPONSES" value="objective"><a href="#">Event Responses</a>
										</li>
										<li rel="LEAD_GENERATION" value="objective"><a href="#">Lead Generation</a>
										</li>
										<li rel="LOCAL_AWARENESS" value="objective"><a href="#">Local Awareness</a>
										</li>
										<li rel="MESSAGES" value="objective"><a href="#">Messages</a>
										</li>
										<li rel="OFFER_CLAIMS" value="objective"><a href="#">Offer Claims</a>
										</li>
										<li rel="PAGE_LIKES" value="objective"><a href="#">Page Like</a>
										</li>
										<li rel="POST_ENGAGEMENT" value="objective"><a href="#">Post Engagement</a>
										</li>
										<li rel="REACH" value="objective"><a href="#">Reach</a>
										</li>
										<li rel="APP_INSTALLS" value="objective"><a href="#">Video Views</a>
										</li>
									</ul>
								</div>
								<div class="first-level-li">
									<span>Campaign Metrics</span>							
	  								<ul id="firstLink">										
										<li rel="camp_metrics" value="campaign.cpa"><a href="#">CPA </a> </li>
										<li rel="camp_metrics" value="campaign.cpm"><a href="#">CPM </a> </li>
										<li rel="camp_metrics" value="campaign.frequency"><a href="#">Frequency </a> </li>
										<li rel="camp_metrics" value="campaign.impressions"><a href="#">Impressions </a>
										</li>
									</ul>
								</div>
								<div class="first-level-li">
									<span>Adset Metrics</span>							
	  								<ul id="firstLink">										
										<li rel="adset_metrics" value="adset.cpa"><a href="#">CPA </a> </li>
										<li rel="adset_metrics" value="adset.cpm"><a href="#">CPM </a> </li>
										<li rel="adset_metrics" value="adset.frequency"><a href="#">Frequency </a> </li>
										<li rel="adset_metrics" value="adset.impressions"><a href="#">Impressions </a>
										</li>
									</ul>
								</div> 	
								<div class="first-level-li">
									<span>Ad Metrics</span>							
	  								<ul id="firstLink">										
										<li rel="ad_metrics" value="ad.cpa"><a href="#">CPA </a> </li>
										<li rel="ad_metrics" value="ad.cpm"><a href="#">CPM </a> </li>
										<li rel="ad_metrics" value="ad.frequency"><a href="#">Frequency </a> </li>
										<li rel="ad_metrics" value="ad.impressions"><a href="#">Impressions </a>
										</li>
									</ul>
								</div>								
							</div>
						</div>
					</div>
					<div class="" id="searched">
					</div>
					<div class="custom-autocomplete-select conditions-btw-right" id="search_div" style="margin-left: 3px;display:none;">
                        <select class="selectpicker show-tick " data-size="5" name="" id="search_option">
                                                                                 
                        </select>
                        <select class="selectpicker show-tick rule_operater " name="search_contain"  id="search_contain">                                                  
                            <option data-tokens="ketchup mustard" value="CONTAIN"> Contain</option>
                            <option data-tokens="ketchup mustard" value="NOT_CONTAIN"> Does Not Contain</option>

                        </select>                                                   
                            <input type="text" name="search" class="search_value">  
                            <button class="light-grey-btn" style="height: 27px;padding-top:0px;" id="apply_search">Apply</button>               
                            <a href="javascript:void(0)" class="search_Close">x</a>

                    </div>
                    <!-- <button class="light-grey-btn search_Close" rel="" id="search_clear" style="display:none;">Clear</button> -->

					<div class="filter-by-date">
						

						<div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
							<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
							<span class="range_date"></span> <b class="caret"></b>
						</div>
						
					</div>

				</div>
			</div>
		</div>

		
		<!-- end filters, search and date -->
		<!-- main working area -->
		<div class="working-area">
			<!--section content -->
			<div class="main-four-tabs">
				<div class=" " style="float: left; width: 100%">
					<div class="tab four-tabs" role="tabpanel">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs main-tabs" role="tablist" style="margin-left: 1px;">
		                    <li role="presentation" class="acc-rev"><a href="#acc-rev" aria-controls="home" role="tab" data-toggle="tab">Account Overview</a></li>
		                    <li role="presentation" class="active camp"><a href="#camp" aria-controls="profile" role="tab" data-toggle="tab">Campaigns</a>
		                    	<div class="selected-row-count" id="camapaign_selected" style="display: none;"><span>2</span> selected <i class="fa fa-times" aria-hidden="true"></i></div>
		                    </li>
		                    <li role="presentation" class="ad-sets"><a href="#ad-sets" aria-controls="messages" role="tab" data-toggle="tab">Ad Sets<span></span></a>
								<div class="selected-row-count" id="adsets_selected" style="display: none;"><span>2</span> selected <i class="fa fa-times" aria-hidden="true"></i></div>
		                    </li>
		                    <li role="presentation" class="ads"><a href="#ads" aria-controls="settings" role="tab" data-toggle="tab">Ads<span></span></a>
								<div class="selected-row-count" id="ads_selected" style="display: none;"><span>2</span> selected <i class="fa fa-times" aria-hidden="true"></i></div>
		                    </li>
		                </ul>
		                 <!-- Tab panes content goes here-->
		                <div class="tab-content main-tabs-entries">

		                 	<!-- Account Overview -->								
							<div role="tabpanel" class="tab-pane acc-data-tabs" id="acc-rev">
								<div  class="col-sm-12" style="padding: 0">
							      
							        <div class="col-xs-2" style="padding: 0">							             
							            <ul class="nav nav-tabs tabs-left overview-cre-tabs">
							                <li class="active"><a href="#home" data-toggle="tab">Overview</a></li>
							                <li><a href="#creative_report" data-toggle="tab">Creative Report</a></li>
							                 
							            </ul>
							        </div>
							        <div class="col-xs-10">
							            <!-- Tab panes -->
							            <div class="tab-content" style="margin-top: 0">
							                <div class="tab-pane active apd_account_overview" id="home" style="padding-top: 0">
							                	<?php include 'AccountOverview.php'; ?></div>
							                <div class="tab-pane" id="creative_report" style="padding: 0">							                	<?php include 'creative_report.php'; ?>												
							                </div>							                
							            </div>
							        </div>
							        <div class="clearfix"></div>
							    </div>
		                 	</div>
		                 	<!-- end Account Overview -->

		                 	<!-- Campaigns Content -->
		                 	<div role="tabpanel" class="tab-pane active" id="camp">
		                 		<!-- <img src="img/Rolling.gif" class="" style="display:block;margin-left:auto;margin-right:auto;"> -->
		                 
		                 	</div>
		                 	<!-- end Campaigns Content -->
		                 	<!-- Adsets Content -->
		                 	<div role="tabpanel" class="tab-pane" id="ad-sets">
		                 	<!-- <img src="img/Rolling.gif" class="" style="display:block;margin-left:auto;margin-right:auto;"> -->
		                 	
		                 	</div>
		                 	<!--end Adsets Content -->
		                 	<!-- Ads Content -->
		                 	<div role="tabpanel" class="tab-pane" id="ads">
		                 	<!-- <img src="img/Rolling.gif" class="" style="display:block;margin-left:auto;margin-right:auto;"> -->
		                 	
		                 	</div>
		                 	<!--end Ads Content -->
		                </div>
		                 <!-- Tab panes content goes here-->
						<!-- end Nav tabs -->
						<!-- sidepanel secton -->
						<div class="right-fix-drawer-outr">
							<div class="right-fix-drawer-inr">
								<div class="right-fix-drawer">
									<ul class="drawer-four-icons nav nav-tabs">
										<li class="drawer-arrow open-drw-arrow"><a href="#">&nbsp;</a></li>
										<li class="drawer-view-chart open-drw"><a data-toggle="tab" href="#view-tab" ><i class="fa fa-bar-chart" aria-hidden="true" onclick="viewTab();" id="view_tab_all" rel=""></i></a></li>
										<li class="drawer-edit open-drw"><a data-toggle="tab" href="#edit-tab"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
										<li class="drawer-history open-drw" onclick="historyTab();"><a data-toggle="tab" href="#history-tab"><i class="fa fa-clock-o" aria-hidden="true" onclick="historyTab();" id="history_tab_all" rel="" token=""></i></a></li>
									</ul>
									<div class="drawer-data-rightSec">
										<div class="tab-content first-step-tabs-content">
											<!-- view tab -->
											<div id="view-tab" class="tab-pane fade in active">
												<?php include 'ViewTab.php';?>
											</div>
											<!-- end view tab -->
											<!-- edit tab -->
											<div id="edit-tab" class="tab-pane fade">
												<?php include 'EditTab.php';?>
											</div>
											<!-- end edit tab -->
											<!-- history tab -->
											<div id="history-tab" class="tab-pane fade">
												<?php include 'HistoryTab.php';?>
											</div>
											<!-- history tab -->
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end sidepanel secton -->
					</div>
				</div>
			</div>
			<!--section content -->
		</div>
		<!-- end main working area -->
	</div>
	<!-- loader popup-->
	<div id="loader_div" class="modal fade loaderPopup" role="dialog" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-body">
					<p>Please Wait</p>
					<img src="img/Rolling.gif">
				</div>
			</div>

		</div>
	</div>
	<!-- loader popup-->
	
	<?php include 'create-rule.php';?>

	<!--end main section -->
	<!-- all pop ups -->
	<?php include 'AllPops.php';?>


	<!-- all pop ups -->
</div>
<?php else : header('location:index.php'); endif ?>