<?php 
session_start();

$db = new Mysqli("localhost", "fbpowereditor", "india@123", "fbpowereditor");
if($db->connect_errno){
  die('Connect Error: ' . $db->connect_errno);
} 


if(isset($_REQUEST['reference'])) {
	
	$get = $db->query("SELECT id FROM fb_user_details WHERE user_id='".$_REQUEST['userid']."' ");
	if($get->num_rows > 0) {
		$db->query("UPDATE fb_user_details SET reference='".$_REQUEST['reference']."' WHERE user_id = '".$_REQUEST['userid']."' ");
	} else {
		$db->query("INSERT INTO fb_user_details(`user_id`,`reference`) VALUES('".$_REQUEST['userid']."','".$_REQUEST['reference']."')");
	}
	echo $db->affected_rows;
}

if(isset($_REQUEST['comment'])) {
	$get = $db->query("SELECT id FROM fb_user_details WHERE user_id='".$_REQUEST['userid']."' ");
	if($get->num_rows > 0) {
		$db->query("UPDATE fb_user_details SET comment='".$_REQUEST['comment']."' WHERE user_id = '".$_REQUEST['userid']."' ");
	} else {
		$db->query("INSERT INTO fb_user_details(`user_id`,`comment`) VALUES('".$_REQUEST['userid']."','".$_REQUEST['comment']."')");
	}
	echo $db->affected_rows;
}



if(isset($_REQUEST['ad_imag'])) {

				/*add images*/
	
				$ch  = curl_init();
				$url = "https://graph.facebook.com/v2.11/".$_REQUEST['act']	."/adimages";

				$img = file_get_contents($_REQUEST['ad_imag']);
				$fields = array(
					'access_token' 	=> 	$_REQUEST['access_token'],	
					'filename' => 'Emilia_Clarke_20131',				
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
				//print_r($adcreative);
				if($adcreative['error']['message']){
					echo json_encode(array('status'=>'failure','msg'=>$adcreative['error']['message']));
				}else{
					echo json_encode(array('status'=>'success','hash'=>$adcreative['images']['bytes']['hash']));
				}		
				
}

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES['myfile']))
{
	if(!empty($_FILES['myfile'])){
		$name = $_FILES['myfile']['name'];
		$size = $_FILES['myfile']['size'];
		$tmp = $_FILES['myfile']['tmp_name'];
		$path = "uploads/";
		move_uploaded_file($tmp, $path.$name);
		$link = $_SERVER['SERVER_NAME'].'/fb-track/'.$path.$name;
		echo 'http://'.$link;
	}

}

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES['myVideo']))
{
	if(!empty($_FILES['myVideo'])){
		$name = $_FILES['myVideo']['name'];
		$size = $_FILES['myVideo']['size'];
		$tmp = $_FILES['myVideo']['tmp_name'];
		$path = "uploads/";
		move_uploaded_file($tmp, $path.$name);
		$link = $_SERVER['SERVER_NAME'].'/fb-track/'.$path.$name;
		echo 'http://'.$link;
	}

}

if(isset($_REQUEST['object_id']) && !isset($_REQUEST['ad_edit'])){

	$object_id = $_REQUEST['object_id'];
	$activity_type =$_REQUEST['activity_type'];
	$activity_by = $_REQUEST['activity_by'];
	$extra_oids=array();



	
	if($activity_type=='all'){
		$filter='&oid='.$_REQUEST['object_id'];
	}else{
		$filter='&category='.$activity_type;
	}

	if($activity_by=='Facebook'){
		$by='Facebook';
	}else{
		$by='';
	}

	if($_SESSION['time_range']['since']!='Invalid date'){
			//$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
	
			$rg='&since='.$_SESSION['time_range']['since'].'&until='.$_SESSION['time_range']['until'];
	}else{
		
		$rg="";
	}

	$oids = json_decode($_REQUEST['oids'],true);
	$oids[] = $_REQUEST['object_id'];


		

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/activities?&fields=event_time,event_type,object_name,application_name,extra_data,date_time_in_timezone,translated_event_type,actor_name,object_id&access_token=".$_REQUEST['access_token'].$filter.$rg.'&limit=100');
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$history = json_decode($result, true);		
	$apd ='';
	
	    if(isset($history['data'])): 
            foreach($history['data'] as $hist): 
                	
             if(in_array($hist['object_id'], $oids)):
                if($by=='Facebook' && $hist['actor_name']=='Facebook'){
                	

					$apd .= ' 
                    <tr>
                        <td>'. $hist['translated_event_type'] .'</td>
                        <td>';
                      if(!empty($hist['event_type']) && $hist['event_type']=='add_images'){
                          $apd .=  'New image added to library';
                            }else if(!empty($hist['event_type']) && $hist['event_type']=='update_ad_set_target_spec'){
                          $apd .=  'Ad set target.';
                            }
                            else if(!empty($hist['event_type']) && $hist['event_type']=='update_ad_creative'){
                          $apd .=  'Ad Creatives.';
                            } 
                            else if(!empty($hist['event_type']) && $hist['event_type']=='ad_review_approved'){
                          $apd .=  '__';
                            }
                            else if(!empty($hist['event_type']) && ($hist['event_type']=='update_ad_set_run_status' || $hist['event_type']=='update_ad_run_status' || $hist['event_type']=='update_campaign_run_status' )){
                          		$extra = json_decode($hist['extra_data'],true);
                          		$apd .=  'From <b>'.$extra['old_value'].'</b> to <b>'.$extra['new_value'].'</b>';
                            }
                             else if(!empty($hist['event_type']) && $hist['event_type']=='update_campaign_group_spend_cap'){
                         		$extra = json_decode($hist['extra_data'],true);

                         		$apd .='From <b>';
                         		if($extra['old_value']==''){ $apd .= ' Unlimited ';}else{$apd .= $extra['old_value'];}
                         		$apd .='</b>to<b>';
                         		 if($extra['new_value']==''){ $apd .= ' Unlimited ';}else{$apd .= $extra['new_value'];}
                         		$apd .='</b>';
                            }
                            else if(!empty($hist['event_type']) && $hist['event_type']=='update_ad_set_budget'){
		                          $extra = json_decode($hist['extra_data'],true);
		                          $apd .='From <b>';
                         			if($extra['old_value']['old_value']==''){ $apd .= ' Unlimited ';}else{$apd .= $extra['old_value']['old_value']/100;}
                         			$apd .='</b> to <b>';
                         			 if($extra['new_value']['new_value']==''){ $apd .= ' Unlimited ';}else{$apd .= $extra['new_value']['new_value']/100 ; $apd .=' '.$extra['new_value']['additional_value'];}
                         			$apd .='</b>';

		                    }

                            else{
                                $extra = json_decode($hist['extra_data'],true);
                                    if(!empty($extra)){                                    	
                                        foreach ($extra as $key => $value) {
                                         $apd .=  $key.' = '. $value.'</br>';
                                       }
                                    }
                                }  

                             
                                 
                      $apd .=' </td>
                        <td class="editable-row">'.$hist['object_name'] .'</td>
                        <td>'.$hist['actor_name'].'</td>
                        <td>'. $hist['date_time_in_timezone'] .'</td>
                    </tr>';
                  //  endif;
                    }

                    if($by==''){
                   	
			
					$apd .= ' 
                    <tr>
                        <td>'. $hist['translated_event_type'] .'</td>
                        <td>';
                      if(!empty($hist['event_type']) && $hist['event_type']=='add_images'){
                          $apd .=  'New image added to library';
                            }else if(!empty($hist['event_type']) && $hist['event_type']=='update_ad_set_target_spec'){
                          $apd .=  'Ad set target.';
                            }else if(!empty($hist['event_type']) && $hist['event_type']=='update_ad_creative'){
                          $apd .=  'Ad Creative.';
                            } else if(!empty($hist['event_type']) && $hist['event_type']=='ad_review_approved'){
                          $apd .=  '__';
                            }
                             else if(!empty($hist['event_type']) && ($hist['event_type']=='update_ad_set_run_status' || $hist['event_type']=='update_ad_run_status' || $hist['event_type']=='update_campaign_run_status' )){
                          		$extra = json_decode($hist['extra_data'],true);
                          			$apd .=  'From <b>'.$extra['old_value'].'</b> to <b>'.$extra['new_value'].'</b>';
                            }else if(!empty($hist['event_type']) && $hist['event_type']=='update_campaign_group_spend_cap'){
                         		$extra = json_decode($hist['extra_data'],true);
                         			
                         		$apd .='From <b>';
                         		if($extra['old_value']=='' ){ $apd .= ' Unlimited ';}else{$apd .= $extra['old_value'];}
                         		$apd .='</b>to<b>';
                         		 if($extra['new_value']==''){ $apd .= ' Unlimited ';}else{$apd .= $extra['new_value'];}
                         		$apd .='</b>';
                            }
                            else if(!empty($hist['event_type']) && $hist['event_type']=='update_ad_set_budget'){
		                          $extra = json_decode($hist['extra_data'],true);
		                        
		                          $apd .='From <b>';
                         			if($extra['old_value']['old_value']==''){ $apd .= ' Unlimited ';}else{$apd .= $extra['old_value']['old_value']/100;}
                         			$apd .='</b> to <b>';
                         			 if($extra['new_value']['new_value']==''){ $apd .= ' Unlimited ';}else{$apd .= $extra['new_value']['new_value']/100 ; $apd .=' '.$extra['new_value']['additional_value'];}
                         			$apd .='</b>';

		                    }
                            else{
                                $extra = json_decode($hist['extra_data'],true);
                                    if(!empty($extra)){                                    	
                                        foreach ($extra as $key => $value) {
                                         $apd .=  $key.' = '. $value.'</br>';
                                       }
                                    }
                                }  

                             
                                 
                      $apd .=' </td>
                        <td class="editable-row">'.$hist['object_name'] .'</td>
                        <td>'.$hist['actor_name'].'</td>
                        <td>'. $hist['date_time_in_timezone'] .'</td>
                    </tr>';
                    }
                endif;
            endforeach; 
        endif; 

             if(empty($history['data'])){
             	$apd .='<tr> <td colspan="5"><p style="text-align:center;font-weight:bold;font-size:16px;">There is not any activity available for the selected date range</p>
             			<p style="text-align:center;font-size:14px;">Change the date to view any activity.</p>
             			<p style="text-align:center;font-size:12px;">It can take upto  15 minutes for your changes to show here. </p>
			             	</td>
			            </tr>';
             }

             if($apd==''){
             	$apd ='<tr> <td colspan="5"><p style="text-align:center;font-weight:bold;font-size:16px;">There is not any activity available for the selected date range</p>
             			<p style="text-align:center;font-size:14px;">Change the date to view any activity.</p>
             			<p style="text-align:center;font-size:12px;">It can take upto  15 minutes for your changes to show here. </p>
			             	</td>
			            </tr>';
             }

             
             echo $apd;

}

if($_REQUEST['page_post_status']){

	$url="https://graph.facebook.com/".$_REQUEST['page_id']."/feed?message=".$REQUEST['page_post_status']."&access_token=".$_REQUEST['access_token'];

	$fields=array(
			"access_token" =>$_REQUEST['access_token'],
			"message" =>$_REQUEST['page_post_status'],			
	);

	if(!empty($_FILES['page_post_media'])){
			$name = $_FILES['page_post_media']['name'];
			$size = $_FILES['page_post_media']['size'];
			$tmp = $_FILES['page_post_media']['tmp_name'];
			$path = "uploads/";
			move_uploaded_file($tmp, $path.$name);
			$link = $_SERVER['SERVER_NAME'].'/fb-track/'.$path.$name;
			$attachment = 'http://'.$link;		
			$fields['picture']=$attachment;
			$fields['link']=$attachment;
			
			$url="https://graph.facebook.com/".$_REQUEST['page_id']."/feed?message=".$_REQUEST['page_post_status']."&access_token=".$_REQUEST['access_token']."&attachment_url=".$attachment;

		}
		
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

		$result=curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result, true);
		/*echo '<pre>';
		print_r($result);
		die;*/
		
		if(isset($result['error'])){
			
			echo json_encode(array('status'=>'failure','msg'=>$result['error']['message']));
		}else{

			echo json_encode(array('status'=>'success'));
		}
	
	die;
}

if($_REQUEST['filter_name'] && $_REQUEST['filter_operater'] && !isset($_REQUEST['rule_name'])){

	$name = str_replace(' ', '_', strtolower($_REQUEST['filter_name'])); 
	$value=$_REQUEST['filter_value'];
	$val = $_REQUEST['filter_value'];
	$operater = $_REQUEST['filter_operater'];
	if($operater=='NOT_IN_RANGE' || $operater=='IN_RANGE'){
			$value=$_REQUEST['filter_from'].'-'.$_REQUEST['filter_to'];
			$value = array($_REQUEST['filter_from'],$_REQUEST['filter_to']);
			$val =$_REQUEST['filter_from'].'-'.$_REQUEST['filter_to'];

	}

	$new['field'] = $name;
	$new['operator'] = $_REQUEST['filter_operater'];
	$new['value'] =$value ;
	//$new['filter_from'] = $_REQUEST['filter_from'] ;
	//$new['filter_to'] = $_REQUEST['filter_to'] ;

 	$filters = $_SESSION['filters'];	
 	$filters[]=$new;
 	$_SESSION['filters'] = $filters;
 	$data = '<div class="slct_fil">'.$_REQUEST['filter_name'] .' > '.$val.' <span class="cross_filter">x</span></div>';

 	echo $data;

}


/* rule create */
if($_REQUEST['rule_name']){

	$name = $_REQUEST['rule_name'];
	$filters=array();
	$filter_form=array();

	$schedule_spec ='{ "schedule_type": "DAILY" }';
	$evaluation_spec['evaluation_type'] = 'SCHEDULE';

	$entity_type['field'] = 'entity_type';
	$entity_type['value'] = $_REQUEST['entity_type'];
	$entity_type['operator'] = 'EQUAL';

	$time_preset['field'] = 'time_preset';
	$time_preset['value'] = $_REQUEST['time_preset'];
	$time_preset['operator'] = 'EQUAL';

	$filters = $_SESSION['filters'];


	/*form  filter start */
	$exist=0;


	foreach($filters as $key=>$filt){
		if($filt['field']==$_REQUEST['filter_name']){
			$exist=1;
			$ky=$key;
		}

	}

	if($_REQUEST['filter_name']!='' && $_REQUEST['filter_operater']!=''){

			if($_REQUEST['filter_operater']=='NOT_IN_RANGE' || $_REQUEST['filter_operater']=='IN_RANGE'){
				if($_REQUEST['filter_from']!='' && $_REQUEST['filter_to']!=''){

					$filter_form['field'] = str_replace(' ', '_', strtolower($_REQUEST['filter_name']));			
					$filter_form['operator'] = $_REQUEST['filter_operater'];
					$filter_form['value']=array($_REQUEST['filter_from'],$_REQUEST['filter_to']);

					if($exist==1){
						unset($filters[$ky]);
					}

					
				}
			}else{

				if($_REQUEST['filter_value']!=''){
					$filter_form['field'] = str_replace(' ', '_', strtolower($_REQUEST['filter_name']));
					$filter_form['value'] = $_REQUEST['filter_value'];
					$filter_form['operator'] = $_REQUEST['filter_operater'];
					if($exist==1){
						unset($filters[$ky]);
					}
				}
			}			
	}
		
	/*form  filter end*/
	$filters[] = $filter_form;
	$filters[] = $entity_type;
	$filters[] = $time_preset;

	foreach ($filters as $keys => $value) {
		if(empty($value)){
			unset($filters[$keys]);
		}
	}

	$evaluation_spec['filters']=$filters;
	/*budget and bid*/
	if($_REQUEST['execution_type']!='PAUSE' && $_REQUEST['execution_type']!='UNPAUSE' && $_REQUEST['execution_type']!='NOTIFICATION'){	
		$opr = '';
        if($_REQUEST['execution_type']=='CHANGE_BUDGET_DEC' || $_REQUEST['execution_type']=='CHANGE_BID_DEC'){
        	$opr = '-';
        }

        if($_REQUEST['execution_type']=='CHANGE_BUDGET_DEC' || $_REQUEST['execution_type']=='CHANGE_BUDGET_IN'){
        	$exc_type = 'CHANGE_BUDGET';
        }

        if($_REQUEST['execution_type']=='CHANGE_BID_DEC' || $_REQUEST['execution_type']=='CHANGE_BID_IN'){
        	$exc_type = 'CHANGE_BID';
        }

		$execution_spec['execution_type']=$exc_type;
		$new =array(
					'field'=>"change_spec",
					'value' =>array('amount'=>$_REQUEST['execution_type_value'],'unit'=>$_REQUEST['execution_type_unit']),
					'operator' => 'EQUAL'
				);
		$execution_spec['execution_options'][]=$new;	
		 $execution_spec=json_encode($execution_spec);

		
	}else{
		$execution_spec='{ "execution_type": "'.$_REQUEST['execution_type'].'" }';
	}
	/*budget and bid */

	/*Add rule */
	$url="https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adrules_library/?access_token=".$_REQUEST['access_token'];
	$fields = array();
	$fields['name']=$_REQUEST['rule_name'];
	$fields['schedule_spec'] =$schedule_spec;
	$fields['evaluation_spec']=json_encode($evaluation_spec);
	$fields['execution_spec']=$execution_spec;
	
		
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$result=curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result, true);



	if(isset($result['error'])){
		echo $result['error']['message'];
	}else{
		if($result['id']){
			echo 'Rule created successfully';
		}
	}

	
}

/*feedback */

/* rule create */
if($_REQUEST['experience_about_rule']){

	$exp = $_REQUEST['experience_about_rule'];
	$future = $_REQUEST['future_done'];
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
//	$headers .= 'From: <webmaster@example.com>' . "\r\n";
///	$headers .= 'Cc: myboss@example.com' . "\r\n";
	$to = 'rulesengine@fb.com';
	$subject = "We'd Like to Hear From You";
	$message ='<h4> What has been your experience using Automated Rules?</h4>
				<h5>'.$exp.'</h5>
				<h4>What do you wish you could do with Automated Rules in the future?</h4>
				<h5>'.$future.'</h5>';
	if(mail($to,$subject,$message,$headers)){
		echo 'success';
	}else{
		echo 'failure';
	}

}

if(isset($_REQUEST['saved_audience'])){
	

	$cSession = curl_init(); 

	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/saved_audiences/?access_token=".$_REQUEST['access_token']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$saved_audience = json_decode($result, true);
	
	$html ='<select class="selectpicker show-tick" data-size="3" id="saved_aud" name="saved_aud">											<option  value="" class="">New Audience</option>';
	

	if($saved_audience['data']){
		foreach($saved_audience['data'] as $data){
			$slct='';
			if($_REQUEST['audience_id']==$data['id']){
				$slct= 'selected';
			}
			$html .='<option  value="'.$data['id'].'" class="slt_audi" '.$slct.'>'.$data['name'].'</option>';
		}
	}				
							
			$html .='</select>';

			echo $html;


			//echo json_encode(array('html'=>$html,'approximate_count'=>$audience['approximate_count']));

}

if(isset($_REQUEST['saved_audience_id'])){

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['saved_audience_id']."/?access_token=".$_REQUEST['access_token']."&fields=approximate_count,targeting,sentence_lines");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$saved_audience = json_decode($result, true);
   	$html='';
  	foreach($saved_audience['sentence_lines'] as $sen){
  		$child = implode(', ' , $sen['children']);
  		$html .='<p>'.$sen['content'].' '.$child.'</p>';
  	}
	$html .='<input type="hidden" value="'.$_REQUEST['saved_audience_id'].'" name="saved_aud_id"  class="saved_aud_id">';
   	echo json_encode(array('html'=>$html,'approximate_count'=>$saved_audience['approximate_count']));

}

if(isset($_REQUEST['new_aud_name']) && !isset($_REQUEST['adset_edit']) && !isset($_REQUEST['ad_edit'])&&  !isset($_REQUEST['campaign_edit']) ){

	$url="https://graph.facebook.com/v2.11/".$_REQUEST['act']."/saved_audiences/?access_token=".$_REQUEST['access_token'];
	$fields = array();
	$fields['name']		 =  $_REQUEST['new_aud_name'];
	$fields['targeting']['age_min'] = $_REQUEST['addsets_min_age'];
	$fields['targeting']['age_max'] = $_REQUEST['addsets_max_age'];
	$fields['targeting']['geo_locations']['countries'] = $_REQUEST['location'];
	if(!empty($_REQUEST['detail'])){
		$fields['targeting']['flexible_spec'][]=$_REQUEST['detail'];
	}
	if(!empty($_REQUEST['locale'])){
		$fields['targeting']['locales']=$_REQUEST['locale'];
	}
	if(!empty($_REQUEST['custom_audience']))
	{
			$fields['targeting']['custom_audiences']=$_REQUEST['custom_audience'];
	}
	if(!empty($_REQUEST['excluded_custom_audiences']))
	{
			$fields['targeting']['excluded_custom_audiences']=$_REQUEST['excluded_custom_audiences'];
	}
	if($_REQUEST['target_gender']!=''){
		$fields['targeting']['genders'][]=$_REQUEST['target_gender'];
	}


	$fields['targeting']=json_encode($fields['targeting']);

	//$fields['adsets']=array($_REQUEST['adset_id']);
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$result=curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result, true);
	
	
	if($result['id']){
		echo json_encode(array('status'=>'success','id'=>$result['id']));
	}else{
		echo json_encode(array('status'=>'failure','message'=>$result['error']['message'])); 
	}
}

if(isset($_REQUEST['get_fb_pages_list'])){

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/me/accounts/get_assigned_accounts/?access_token=".$_REQUEST['access_token']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$list = json_decode($result, true);
	
	$pages_html ='<select class="selectpicker show-tick" data-size="3" disabled>';
	$pages_html .='<option value=""></option>';
		if(!empty($list['data'])){			
				foreach($list['data']  as $fb_page){
					$slct='';
					if($fb_page['id']==$_REQUEST['page_id']){
						$slct ='selected';
					}
					$pages_html .='<option data-tokens="mustard" value="'.$fb_page['id'].'"  '.$slct.'>'.$fb_page['name'].'</option>';
				}		
		}else{
			$pages_html .='<option data-tokens="mustard" value="">No Pages Found</option>';
		}
		$pages_html .='</select>';



	//get selected facebook page's posts
		if($_REQUEST['page_id']!=''){

				$cSession = curl_init(); 
				curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['page_id']."/posts?fields=message,name,picture,id,is_instagram_eligible&limit=100&access_token=".$_REQUEST['access_token']);
				curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
				curl_setopt($cSession,CURLOPT_HEADER, false); 
				$result=curl_exec($cSession);
				curl_close($cSession);
				$posts = json_decode($result, true);
				
				$posts_html='';
				$selected_story_msg='No Post selected  <i class="fa fa-caret-down"></i>';
				if(!empty($posts['data'])){
					foreach($posts['data'] as $post){

						if(isset($post['message'])){
							$name=$post['message'];
						}else{
							$name=$post['name'];
						}
						$posts_html .=' <div class="s-r exist_post" rel="'.$name.'" token="'.$post['id'].'">
                                            <div class="s-r-left">
                                                <img src="'.$post['picture'].'">
                                            </div>
                                            <div class="s-r-right">
                                                <b>'.$name.'</b>                                              
                                            </div>
                                        </div>';
                        if($_REQUEST['story_id']==$post['id']){
                        	$selected_story_msg=$name.' <i class="fa fa-caret-down"></i>';
                        }

					}
				}else{
					$posts_html='No Posts Found <i class="fa fa-caret-down"></i>';
				}

		}

	    echo json_encode(array('fb_pages'=>$pages_html,'posts_html'=>$posts_html,'selected_story_msg'=>$selected_story_msg));
	
}
if(isset($_REQUEST['get_connected_insta'])){

	$cSession = curl_init();
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['page_id']."/?fields=connected_instagram_account&access_token=".$_REQUEST['access_token']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$insta = json_decode($result, true);
	
	if(isset($insta['connected_instagram_account'])){
		$insta_id=$insta['connected_instagram_account']['id'];
			$cSession = curl_init();
			curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$insta_id."/?fields=name,id,username&access_token=".$_REQUEST['access_token']);
			curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($cSession,CURLOPT_HEADER, false); 
			$result=curl_exec($cSession);
			curl_close($cSession);
			$instaList = json_decode($result, true);
			if($instaList){
				$instaHTML='<select class="selectpicker show-tick" data-size="2" >';
				$pages_html .='<option value=""></option>';
				$instaHTML .='<option data-tokens="mustard" value="'.$instaList['id'].'">'.$instaList['name'].'</option>';
				$instaHTML .='</select>';
			}		

			echo $instaHTML;
	}else{
		echo '<button class="light-grey-btn">No Account</button>';
	}		
}

if(isset($_REQUEST['search_value']) && $_REQUEST['search_value']!=''){
	
	/*get camapagins, adsets and ads*/	
	$ext = 0;
	$fltr['field']=$_REQUEST['option'];
	$fltr['operator']=$_REQUEST['contain'];
	$fltr['value']=$_REQUEST['search_value'];
	if($_REQUEST['contain']=='IN'){
			foreach($_SESSION['search_filter'] as $key=>$srch){
				
				if($srch['field']==$_REQUEST['option']){				
					$ext=1;					
					$srch['value'][]=$_REQUEST['search_value'];
					$_SESSION['search_filter'][$key]['value']=$srch['value'];					
				}
			}
		if($ext == 0){
			$fltr['value']=array($_REQUEST['search_value']);
			$exist=array();
			$exist = $_SESSION['search_filter'];
			$exist[]=$fltr;
			$_SESSION['search_filter']=$exist;
		}
	}
	else{		
		$exist=array();
		$exist = $_SESSION['search_filter'];
		$exist[]=$fltr;
		$_SESSION['search_filter']=$exist;
	}
	
    $total = json_encode($_SESSION['search_filter']);    
  	//$total="[{'field':'adset.targeting_age_max','operator':'GREATER_THAN','value':['inactive','active']}]";	

	/*$camapaigns= getData($_REQUEST['act'],$_REQUEST['code'],$total);
	$camapaigns=array('camapaigns'=>$camapaigns,'code'=>$_REQUEST['code']);	
	$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
	$adset= renderPhpFile('AdsetsContent.php', $camapaigns);
	$ad= renderPhpFile('AdsContent.php', $camapaigns);*/

	$allData = getAllData($_REQUEST['act'],$_REQUEST['code'],$total);
	$allData = json_decode($allData,true);

	$camapaigns=array('camapaigns'=>$allData['camapaigns'],'code'=>$_REQUEST['code']);
	$adsets=array('adsets'=>$allData['adsets'],'code'=>$_REQUEST['code']);
	$ads=array('ads'=>$allData['ads'],'code'=>$_REQUEST['code']);

	
	$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
	$adset= renderPhpFile('AdsetsContent.php', $adsets);
	$ad= renderPhpFile('AdsContent.php', $ads);


	$fill = '<div class="slct_fill custom-autocomplete-select conditions-btw-right"><span class="light-grey-btn new">'.str_replace('.', ' ',$_REQUEST['option']) .' </span> <span class="light-grey-btn new">'.$_REQUEST['contain'].'</span> <span class="light-grey-btn new">'.str_replace('_', ' ',$_REQUEST['search_value']).' </span><span class="cross_search" rel="'.$_REQUEST['option'].'" val="'.$_REQUEST['search_value'].'">x</span></div>';
	$data = array('camp'=>$camp,'adset'=>$adset,'ad'=>$ad,'fill'=>$fill,'total'=>$total,'session'=>$_SESSION['search_filter'],'code'=>$_REQUEST['code']);
	echo json_encode($data);
}

/*cross */
if(isset($_REQUEST['cross_filter'])){
	
	if($_REQUEST['cross_filter']==''){
		$_SESSION['search_filter']=array();
	}else{
		if(!empty($_SESSION['search_filter'])){
			//if metrics filter
			if($_REQUEST['type']==1){
				unset($_SESSION['search_filter'][$_REQUEST['token_key']]);		
			}else{

				foreach($_SESSION['search_filter'] as $key=>$srch){
					if($srch['field']==$_REQUEST['cross_filter']){
						if($srch['operator']=='IN'){					
							$ky = array_search($_REQUEST['val'], $srch['value']);
							
							unset($srch['value'][$ky]);		
							if(empty($srch['value'])){
								unset($_SESSION['search_filter'][$key]);
							}else{		
								$_SESSION['search_filter'][$key]['value']=$srch['value'];
							}

						}else{
							unset($_SESSION['search_filter'][$key]);
						}
					}
				}
			}
		}
	}		
	$total='null';
	if(!empty($_SESSION['search_filter'])){
    	 $total = json_encode($_SESSION['search_filter']);
	}
    /*$camapaigns= getData($_REQUEST['act'],$_REQUEST['code'],$total);
	$camapaigns=array('camapaigns'=>$camapaigns,'code'=>$_REQUEST['code']);	
	$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
	$adset= renderPhpFile('AdsetsContent.php', $camapaigns);
	$ad= renderPhpFile('AdsContent.php', $camapaigns);	*/

	$allData = getAllData($_REQUEST['act'],$_REQUEST['code'],$total);
	$allData = json_decode($allData,true);

	$camapaigns=array('camapaigns'=>$allData['camapaigns'],'code'=>$_REQUEST['code']);
	$adsets=array('adsets'=>$allData['adsets'],'code'=>$_REQUEST['code']);
	$ads=array('ads'=>$allData['ads'],'code'=>$_REQUEST['code']);

	
	$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
	$adset= renderPhpFile('AdsetsContent.php', $adsets);
	$ad= renderPhpFile('AdsContent.php', $ads);


	$data = array('camp'=>$camp,'adset'=>$adset,'ad'=>$ad,'total'=>$total);
	echo json_encode($data);
}

function renderPhpFile($filename, $vars = null) {
	if (is_array($vars) && !empty($vars)) {
	    extract($vars,EXTR_SKIP);
	}
	ob_start();
	include $filename;
	return ob_get_clean();
}

function getData($act=null,$code=null,$filter=null){


	//$data = getAllData($act,$code,$filter);

	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/campaigns?access_token=".$_REQUEST['code']."&level=ad&filtering=".$filter."&fields=name,account_id,deleivery_info,buying_type,objective,id,status,start_time,stop_time,delivery_info,brand_configuration,spend_cap,objective_for_results,insights{reach,impressions,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,date_start,date_stop},adsets{id,is_autobid,name,status,delivery_info,billing_event,attribution_spec,targeting,bid_amount,lifetime_budget,daily_budget,start_time,end_time,objective_for_results,objective_for_cost,targeting_age_min,targeting_age_max,optimization_goal,targeting_genders,lifetime_imps,targeting_countries,activities{actor_name,event_time,application_name,translated_event_type,extra_data},insights{reach,frequency,impressions,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click},pacing_type,destination_type,date_start,date_stop},ads{name,id,delivery_info,preview_link,creative_title,creative_body,creative_link_url,objective_for_results,objective_for_cost,status,insights{frequency,impressions,spend,unique_clicks,total_unique_actions,relevance_score,reach,inline_link_clicks,cost_per_inline_link_click,date_start,date_stop},adcreatives{image_url,id,object_story_spec,body,thumbnail_url}}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$camapaigns = json_decode($result, true);
	return $camapaigns;
}

function getAllData($act=null,$code=null,$filter=null){

	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/campaigns?access_token=".$_REQUEST['code']."&level=ad&filtering=".$filter."&fields=name,account_id,delivery_info,objective,id,status,start_time,stop_time,objective_for_results");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$camapaigns = json_decode($result, true);

	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adsets?access_token=".$_REQUEST['code']."&level=ad&filtering=".$filter."&fields=id,is_autobid,name,status,delivery_info,objective,daily_budget,lifetime_budget,end_time,start_time,campaign_id,objective_for_results");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$adsets = json_decode($result, true);

	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/ads?access_token=".$_REQUEST['code']."&level=ad&filtering=".$filter."&fields=name,id,delivery_info,objective_for_results,objective_for_cost,status,adcreatives{thumbnail_url},adset_id,campaign_id");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$ads = json_decode($result, true);
	

	return json_encode(array('camapaigns'=>$camapaigns,'adsets'=>$adsets,'ads'=>$ads));
}
if(!empty($_REQUEST['breakdown'])){

	$camapaigns= getData($_REQUEST['act'],$_REQUEST['code'],'null');
	/*if($_REQUEST['breakdown']=='clear'){
		$camapaigns=array('camapaigns'=>$camapaigns,'code'=>$_REQUEST['code']);
	}else{
		$camapaigns=array('camapaigns'=>$camapaigns,'breakdown'=>$_REQUEST['breakdown'],'code'=>$_REQUEST['code'],'breakdown_type'=>$_REQUEST['type']);	
	}*/

	/*$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
	$adset= renderPhpFile('AdsetsContent.php', $camapaigns);	
	$ad= renderPhpFile('AdsContent.php', $camapaigns);	*/


	$allData = getAllData($_REQUEST['act'],$_REQUEST['code'],'null');
	$allData = json_decode($allData,true);

	if($_REQUEST['breakdown']=='clear'){
		$camapaigns=array('camapaigns'=>$allData['camapaigns'],'code'=>$_REQUEST['code']);
		$adsets=array('adsets'=>$allData['adsets'],'code'=>$_REQUEST['code']);
		$ads=array('ads'=>$allData['ads'],'code'=>$_REQUEST['code']);

	}else{
		$camapaigns=array('camapaigns'=>$camapaigns,'breakdown'=>$_REQUEST['breakdown'],'code'=>$_REQUEST['code'],'breakdown_type'=>$_REQUEST['type']);	

		$camapaigns=array('camapaigns'=>$allData['camapaigns'],'code'=>$_REQUEST['code'],'breakdown'=>$_REQUEST['breakdown'],'breakdown_type'=>$_REQUEST['type']);
		$adsets=array('adsets'=>$allData['adsets'],'code'=>$_REQUEST['code'],'breakdown'=>$_REQUEST['breakdown'],'breakdown_type'=>$_REQUEST['type']);
		$ads=array('ads'=>$allData['ads'],'code'=>$_REQUEST['code'],'breakdown'=>$_REQUEST['breakdown'],'breakdown_type'=>$_REQUEST['type']);


	}
   
    $camp= renderPhpFile('CampaignsContent.php', $camapaigns);
	$adset= renderPhpFile('AdsetsContent.php', $adsets);
	$ad= renderPhpFile('AdsContent.php', $ads);

	$data = array('camp'=>$camp,'adset'=>$adset,'ad'=>$ad);
	echo json_encode($data);
}

/*time range*/

if($_REQUEST['time_range']){

	$_SESSION['time_range']['since']=$_REQUEST['since'];
	$_SESSION['time_range']['until']=$_REQUEST['until'];


	// $camapaigns= getData($_REQUEST['act'],$_REQUEST['code'],'null');
	// $camapaigns=array('camapaigns'=>$camapaigns,'code'=>$_REQUEST['code']);
	 $account_data=array('code'=>$_REQUEST['code'],'act'=>$_REQUEST['act']);

	$allData = getAllData($_REQUEST['act'],$_REQUEST['code'],'null');
	$allData = json_decode($allData,true);

	$camapaigns=array('camapaigns'=>$allData['camapaigns'],'code'=>$_REQUEST['code']);
	$adsets=array('adsets'=>$allData['adsets'],'code'=>$_REQUEST['code']);
	$ads=array('ads'=>$allData['ads'],'code'=>$_REQUEST['code'],'act'=>$_REQUEST['act']);


	
	$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
	$adset= renderPhpFile('AdsetsContent.php', $adsets);
	$ad= renderPhpFile('AdsContent.php', $ads);
	$creative_report= renderPhpFile('account/creative_report.php', $ads);
	$account_overview= renderPhpFile('AccountOverview.php', $account_data);	
	$data = array('camp'=>$camp,'adset'=>$adset,'ad'=>$ad,'account_overview'=>$account_overview,'creative_report'=>$creative_report);
	echo json_encode($data);
}
if($_REQUEST['metrics']){
	if(($_REQUEST['metrics']=='camp_metrics') || ($_REQUEST['metrics']=='adset_metrics') || ($_REQUEST['metrics']=='ad_metrics') ){
		
		 $total="[{'field':'".$_REQUEST['option']."','operator':'".$_REQUEST['operater']."','value':'".$_REQUEST['value']."'}]";

		if($_SESSION['time_range']['since']!='Invalid date'){
			$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
		}else{
			
			$rg="&date_preset=lifetime";
		}
		
		$cSession = curl_init(); 	
		curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/insights?access_token=".$_REQUEST['code']."&level=ad&fields=campaign_id,adset_id,ad_id".$rg."&filtering=".$total);
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		curl_close($cSession);
		$ids = json_decode($result, true);
			
		$met=0;
		//print_r($ids);
		$total_ids=array();
		if(!empty($ids['data'])){
			foreach($ids['data'] as $id ){
				if($_REQUEST['metrics']=='camp_metrics'){
					$total_ids[]=$id['campaign_id'];
					$field='id';
					$met=1;
				}
				if($_REQUEST['metrics']=='adset_metrics'){
					$total_ids[]=$id['adset_id'];
					$field='adset.id';
					$met=1;
				}
				if($_REQUEST['metrics']=='ad_metrics'){
					$total_ids[]=$id['ad_id'];
					$field='ad.id';
					$met=1;
				}
				
			}
		}

		$fltr['field']=$field;
		$fltr['operator']='IN';
		$fltr['value']=$total_ids;
		//echo $total_ids;
		$_SESSION['search_filter'][]=$fltr;
		end($_SESSION['search_filter']);
		$end_key = key($_SESSION['search_filter']);

		$total = json_encode($_SESSION['search_filter']);    
	  	//$total="[{'field':'adset.targeting_age_max','operator':'GREATER_THAN','value':['inactive','active']}]";	

		$camapaigns= getData($_REQUEST['act'],$_REQUEST['code'],$total);
		$camapaigns=array('camapaigns'=>$camapaigns,'code'=>$_REQUEST['code']);	
		$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
		$adset= renderPhpFile('AdsetsContent.php', $camapaigns);
		$ad= renderPhpFile('AdsContent.php', $camapaigns);
		

		$fill = '<div class="slct_fill custom-autocomplete-select conditions-btw-right"><span class="light-grey-btn new">'.$_REQUEST['option'] .' </span> <span class="light-grey-btn new">'.$_REQUEST['operater'].'</span> <span class="light-grey-btn new">'.$_REQUEST['value'].' </span><span class="cross_search" rel="'.$_REQUEST['option'].'" val="'.$_REQUEST['value'].'" token="'.$end_key.'" type="'.$met.'">x</span></div>';

		$data = array('camp'=>$camp,'adset'=>$adset,'ad'=>$ad,'fill'=>$fill,'session'=>$_SESSION['search_filter']);
		echo json_encode($data);



	}
}

if($_REQUEST['show_saved_audience_in_adset']){

	$audience_id = $_REQUEST['saved_audience_id_adset'];
	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$audience_id."/?access_token=".$_REQUEST['access_token']."&fields=targeting,approximate_count,sentence_lines");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$saved_audience = json_decode($result, true);
	
  	$html='';
  	foreach($saved_audience['sentence_lines'] as $sen){
  		$child = implode(', ' , $sen['children']);
  		$html .='<p>'.$sen['content'].' '.$child.'</p>';
  	}
  	$html .='<input type="hidden" value="'.$_REQUEST['saved_audience_id_adset'].'" name="saved_aud_id"  class="saved_aud_id">';

	 	echo json_encode(array('html'=>$html,'approximate_count'=>$saved_audience['approximate_count']));
		

}

if(isset($_REQUEST['perform_graph'])){

		
		if($_SESSION['time_range']['since']!='Invalid date'){
			$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}&time_increment=1";
		}else{
			$rg="&date_preset=lifetime&time_increment=1";
		}



		$cSession = curl_init(); 	
	/*	 curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['perform_graph']."/?fields=insights{impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type},objective_for_results&access_token=".$_REQUEST['access_token'].$rg);*/
		  curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['perform_graph']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,objective,cost_per_action_type,inline_post_engagement,cost_per_inline_post_engagement&access_token=".$_REQUEST['access_token'].$rg.'&limit=100');
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		curl_close($cSession);
		$result = json_decode($result, true);
		/*echo '<pre>';
		print_r($_SESSION['time_range']);
		die;*/
		
		$spline1=array();
		$spline2=array();
		$reach=array();
		$frequency=array();
		$cum_spnd=array();
		$spnd=array();
		if(!empty($result['data'])){
			foreach ($result['data'] as $key => $value) {
				
				$spline1[$key]['label']=date_format(date_create($value['date_start']) ,'j F').' to '.date_format(date_create($value['date_stop']) ,'j F');

				if($_REQUEST['result_fr_perform_graph']=='like'){
					if(!empty($value['actions'])){
						foreach($value['actions'] as $act){	                			
	            			if($act['action_type']=='like'){
	            				$spline1[$key]['y']=$act['value'];
								             				
	            			}
	            		}
            		}

            		if(!empty($value['cost_per_action_type'])){
	            		foreach($value['cost_per_action_type'] as $act){	                			
	            			if($act['action_type']=='like'){
	            		
								$spline2[$key]['y']=$value['result_cost_perform_graph'];               				
	            			}
	            		}
            		}


				}else{
					$spline1[$key]['y']=$value[$_REQUEST['result_fr_perform_graph']];
					$spline2[$key]['y']=$value[$_REQUEST['result_cost_perform_graph']];
				}
				
					$spline2[$key]['label']=date_format(date_create($value['date_start']) ,'j M').' to '.date_format(date_create($value['date_stop']) ,'j M');
					//reached tab
					$reach[$key]['label']=date_format(date_create($value['date_start']) ,'j M').' to '.date_format(date_create($value['date_stop']) ,'j M');
					$reach[$key]['y']=$value['reach'];
					$frequency[$key]['label']=date_format(date_create($value['date_start']) ,'j M').' to '.date_format(date_create($value['date_stop']) ,'j M');
					$frequency[$key]['y']=$value['frequency'];

					//end reached tab
					$cum_spnd[$key]['label']=date_format(date_create($value['date_start']) ,'j M').' to '.date_format(date_create($value['date_stop']) ,'j M');
					$cum_spnd[$key]['y']=@$cum_spnd[$key-1]['y']+$value['spend'];
					$spnd[$key]['label']=date_format(date_create($value['date_start']) ,'j M').' to '.date_format(date_create($value['date_stop']) ,'j M');
					$spnd[$key]['y']=$value['spend'];
				
				
			}


			$data=array('spline1'=>$spline1,'spline2'=>$spline2,'objective_for_results'=>str_replace('_',' ', ucfirst($result['objective_for_results']) ) );
			$reached=array('reach'=>$reach,'frequency'=>$frequency,'objective_for_results'=>str_replace('_',' ', ucfirst($result['objective_for_results']) ) );
			$spends=array('cum_spnd'=>$cum_spnd,'spnd'=>$spnd,'objective_for_results'=>str_replace('_',' ', ucfirst($result['objective_for_results']) ) );
			$chart= renderPhpFile('performance-chart.php', $data);
			$reached_chart= renderPhpFile('performanceReach-chart.php', $reached);
			$spend_chart= renderPhpFile('spend-chart.php', $spends);

		}else{
			 $no_result= '<div class="no-result-found "><img src="img/no-result-img.jpg"><br>	
								<b>No Activity During Date Range</b><br>
								</div>';
			$chart=$no_result;
			$reached_chart=$no_result;

		}

		$data = array('chart'=>$chart,'objective_for_results'=>str_replace('_',' ', ucfirst($result['data'][0]['objective']) ) ,'reached_chart'=>$reached_chart,'spend_chart'=>$spend_chart);
		echo json_encode($data);

}

if(isset($_REQUEST['demographic'])){

		if($_SESSION['time_range']['since']!='Invalid date'){
			$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}&time_increment=1";
		}else{
			$rg="&date_preset=lifetime";
		}

		$break = '&breakdowns=age,gender';

		$cSession = curl_init(); 	
		 curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['demographic']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click&access_token=".$_REQUEST['access_token']."".$rg.$break.'&limit=100');
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		curl_close($cSession);
		$result = json_decode($result, true);		
	
		
		$women_spline1=array();
		$women_spline2=array();
		$men_spline1=array();
		$men_spline2=array();
		if($_REQUEST['res1']!='' && $_REQUEST['res2']!=''){
			$res1=$_REQUEST['res1'];
			$res2 =$_REQUEST['res2'];
		}else{
			$res1='reach';
			$res2 ='spend';
		}

		if(!empty($result['data'])){
			foreach ($result['data'] as $key => $value) {
				if($value['gender']=='female'){					
					$women_spline1[$key]['label']=$value['age'];
					if(isset($value[$res1])){
						$women_spline1[$key]['y']=$value[$res1];
					}else{
						$women_spline1[$key]['y']=0;
					}
					$women_spline2[$key]['label']=$value['age'];
					if(isset($value[$res2])){
						$women_spline2[$key]['y']=$value[$res2];
					}else{
						$women_spline2[$key]['y']=0;
					}

					
				}
				if($value['gender']=='male'){					
					$men_spline1[$key]['label']=$value['age'];
					if(isset($value[$res1])){
						$men_spline1[$key]['y']=$value[$res1];
					}else{
						$men_spline1[$key]['y']=0;
					}
					$men_spline2[$key]['label']=$value['age'];
					if(isset($value[$res2])){
						$men_spline2[$key]['y']=$value[$res2];
					}else{
						$men_spline2[$key]['y']=0;
					}
				}
			}
			$data=array('women_spline1'=>array_values($women_spline1),'women_spline2'=>array_values($women_spline2),'men_spline1'=>array_values($men_spline1),'men_spline2'=>array_values($men_spline2),'res1'=>$res1,'res2'=>$res2);
			echo $chart= renderPhpFile('demographic-chart.php', $data);
		}else{
			echo $chart= '<div class="no-result-found"><img src="img/no-result-img.jpg"><br>	
								<b>No Activity During Date Range</b><br>
								</div>';
		}

		
}

if(isset($_REQUEST['placement_graphic'])){


		if($_SESSION['time_range']['since']!='Invalid date'){
			$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}&time_increment=1";
		}else{
			$rg="&date_preset=lifetime";
		}
		$break = '&breakdowns=device_platform,publisher_platform';
		$dvc = $_REQUEST['dvc'];
		$cSession = curl_init(); 	
		 curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['placement_graphic']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click&access_token=".$_REQUEST['access_token']."".$rg.$break.'&limit=100');
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($cSession,CURLOPT_HEADER, false); 
		$result=curl_exec($cSession);
		curl_close($cSession);
		$result = json_decode($result, true);		
	
		
		$spline1=array();
		$spline2=array();
	
		if($_REQUEST['res1']!='' && $_REQUEST['res2']!=''){
			$res1=$_REQUEST['res1'];
			$res2 =$_REQUEST['res2'];
		}else{
			$res1='reach';
			$res2 ='spend';
		}

		if($dvc==''){
			$dvc='all';
		}

		if(!empty($result['data'])){
			foreach ($result['data'] as $key => $value) {

				
				
			
				if($dvc!='all'){

					
					if($dvc==$value['device_platform']){

						$spline1[$key]['label']=$value['publisher_platform'];
						if(isset($value[$res1])){
							$spline1[$key]['y']=$value[$res1];
						}else{
							$spline1[$key]['y']=0;
						}
						$spline2[$key]['label']=$value['publisher_platform'];
						if(isset($value[$res2])){
							$spline2[$key]['y']=$value[$res2];
						}else{
							$spline2[$key]['y']=0;
						}
					}


				}else{
					if( $result['data'][$key+1]['publisher_platform'] == $value['publisher_platform'] ){
					
						continue;
					}


					$spline1[$key]['label']=$value['publisher_platform'];
					if(isset($value[$res1])){
						$spline1[$key]['y']=$value[$res1];
					}else{
						$spline1[$key]['y']=0;
					}
					$spline2[$key]['label']=$value['publisher_platform'];
					if(isset($value[$res2])){
						$spline2[$key]['y']=$value[$res2];
					}else{
						$spline2[$key]['y']=0;
					}
				}
			}	

			 $cont = count($spline1);

			$arrayKeyInst = searchArrayKeyVal("label", 'instagram', $spline1);
			if($arrayKeyInst==''){
				$spline1[$cont+1]['label']='Instagram';
				$spline1[$cont+1]['y']=0;
				$spline2[$cont+1]['label']='Instagram';
				$spline2[$cont+1]['y']=0;
            }

            $arrayKeyMsg = searchArrayKeyVal("label", 'messenger', $spline1);
			if($arrayKeyMsg==''){
				$spline1[$cont+2]['label']='Messenger';
				$spline1[$cont+2]['y']=0;
				$spline2[$cont+2]['label']='Messenger';
				$spline2[$cont+2]['y']=0;
            }

            $arrayKeyAud = searchArrayKeyVal("label", 'audience_network', $spline1);
			if($arrayKeyAud==''){
				$spline1[$cont+3]['label']='Messenger';
				$spline1[$cont+3]['y']=0;
				$spline2[$cont+3]['label']='Messenger';
				$spline2[$cont+3]['y']=0;
            }

			
			$data=array('spline1'=>array_values($spline1),'spline2'=>array_values($spline2 ),'res1'=>$res1,'res2'=>$res2,'dvc'=>$dvc);
			echo $chart= renderPhpFile('placement-chart.php', $data);
		}else{
			echo $chart= '<div class="no-result-found"><img src="img/no-result-img.jpg"><br>	
							<b>No Activity During Date Range</b><br>
							</div>';
		}

}
if(isset($_REQUEST['column'])){

		/*$camapaigns= getData($_REQUEST['act'],$_REQUEST['code'],'null');
		$camapaigns=array('camapaigns'=>$camapaigns,'code'=>$_REQUEST['code'],'file'=>$_REQUEST['column']);
		$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
		$adset= renderPhpFile('AdsetsContent.php', $camapaigns);
		$ad= renderPhpFile('AdsContent.php', $camapaigns);	*/

		$allData = getAllData($_REQUEST['act'],$_REQUEST['code'],'null');
		$allData = json_decode($allData,true);

		$camapaigns=array('camapaigns'=>$allData['camapaigns'],'code'=>$_REQUEST['code'],'file'=>$_REQUEST['column']);
		$adsets=array('adsets'=>$allData['adsets'],'code'=>$_REQUEST['code'],'file'=>$_REQUEST['column']);
		$ads=array('ads'=>$allData['ads'],'code'=>$_REQUEST['code'],'file'=>$_REQUEST['column']);

		
		$camp= renderPhpFile('CampaignsContent.php', $camapaigns);
		$adset= renderPhpFile('AdsetsContent.php', $adsets);
		$ad= renderPhpFile('AdsContent.php', $ads);

		$data = array('camp'=>$camp,'adset'=>$adset,'ad'=>$ad);
		echo json_encode($data);
	
}

if(isset($_REQUEST['ad_edit'])){
	


	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['ad_id']."/?access_token=".$_REQUEST['code']."&fields=id,name,creative_id,adcreatives{object_story_spec,instagram_actor_id}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);
	
	$link_data['link']=$_REQUEST['website_url'];
	$link_data['message']=$_REQUEST['cmessage'];
	$link_data['name']=$_REQUEST['ctext'];
	$link_data['caption']=$_REQUEST['caption'];
	$link_data['description'] = $_REQUEST['cdescription'];
	$link_data['image_hash']=$_REQUEST['cimage_hash'];
	$link_data['call_to_action']='{ "type": "'.$_REQUEST['call_to_action_image'].'" }';


	if($_REQUEST['multi_share_end_card']=='on'){
		$link_data['multi_share_end_card']='true';		
	}else{
		$link_data['multi_share_end_card']='false';	
	}
	if($_REQUEST['multi_share_optimized']=='on'){
		$link_data['multi_share_optimized']='true';		
	}else{
		$link_data['multi_share_optimized']='false';	
	}

	
	$data_type='';
	$unset_data_type='';
	//for type 1
	if($_REQUEST['ad_type']=='img-vid'){
	
		if($_REQUEST['img-wid-type']=='video'){
			$link_data['video_id']=$_REQUEST['cvideo_id'];
			$link_data['title']=$_REQUEST['ctext'];


			$picture= getVideodata($_REQUEST['cvideo_id'],$_REQUEST['code']);
			$link_data['image_url']=$picture;

			
			$data_type='video_data';
			$unset_data_type='link_data';
			
			unset($link_data['name']);
			unset($link_data['caption']);
			unset($link_data['description']);
			unset($link_data['multi_share_optimized']);
			unset($link_data['multi_share_end_card']);
			unset($link_data['image_hash']);
			if($link_data['link']!=''){
				$link_vid=array('link'=>$_REQUEST['website_url']);
			}else{
				$link_vid=array('link'=>'http://bubblewhale.club/makers-or-breakers-techcrunch/');
			}
			unset($link_data['link']);
			if($_REQUEST['call_to_action_image']=='LIKE_PAGE'){
					$link_data['call_to_action']='{ "type": "'.$_REQUEST['call_to_action_image'].'" ,"value": {
          "page":'.$_REQUEST['ad_facebook_page'].'}}';
			}else{
				$link_data['call_to_action']='{ "type": "'.$_REQUEST['call_to_action_image'].'" ,"value":'.json_encode($link_vid).'}';
			}
		}else{
			$data_type='link_data';
			$unset_data_type='video_data';
		}

		unset($link_data['child_attachments']);
	}
	//for type 2
	if($_REQUEST['ad_type']=='mul-img'){
		$data_type='link_data';
		$unset_data_type='video_data';
		$link_data['message']=$_REQUEST['cmessage_opt2'];
		$childrens=$_REQUEST['child_attachments'];


		foreach($_REQUEST['child_attachments'] as $ch=>$child){
			if($child['mul-wid-type']=='video'){				

				$picture = getVideodata($child['video_id'],$_REQUEST['code']);
				$childrens[$ch]['video_id']=$child['video_id'];
				$childrens[$ch]['picture']=$picture;
				unset($childrens[$ch]['image_hash']);

			}else{
				unset($childrens[$ch]['video_id']);
			}

			if($child['link']==''){
				$childrens[$ch]['link']=$_REQUEST['website_url'];
			}
			unset($childrens[$ch]['mul-wid-type']);
		}
		$link_data['child_attachments'] = $childrens;
		unset($link_data['description']);
		
	}
	//for type 3
	if($_REQUEST['ad_type']=='img-coll'){
		$data_type='link_data';
		$unset_data_type='video_data';
		$link_data['message']=$_REQUEST['cmessage_opt3'];
		$link_data['name']=$_REQUEST['ctext_opt3'];	
		//$value$link_data['collection_thumbnails']=$result['adcreatives']['data'][0]['object_story_spec']['link_data']
		unset($link_data['description']);	
		
	}

	$adc=array();
	

	foreach ($result['adcreatives']['data'] as $key => $value) {
		
		$value['object_story_spec']['page_id']=$_REQUEST['ad_facebook_page'];
		//$value['object_story_spec']['instagram_actor_id']='1659386540779069';
		$value['object_story_spec']['instagram_actor_id']=$value['instagram_actor_id'];
		if($_REQUEST['ad_type']=='img-coll'){
			$link_data['collection_thumbnails']=$value['object_story_spec']['link_data']['collection_thumbnails'];
		}

		$value['object_story_spec'][$data_type]=$link_data;
		unset($value['object_story_spec'][$unset_data_type]);
 		$adc['object_story_spec']=$value['object_story_spec'];
 		$adc['instagram_actor_id']=$value['instagram_actor_id'];
 	}


 	//if its a story or create a new add
 	$fields = array();
 	if($_REQUEST['story']=='true'){
 		unset($adc['object_story_spec']);
 		$adc['object_story_id']=$_REQUEST['object_story_id'];		
 	}else{	

 		//if(null !==$_REQUEST['ad_type'] ){	
 		if($_REQUEST['object_id']=='' ){	
			unset($adc['object_story_id']);
		}else{
			unset($adc['object_story_spec']);
			unset($adc['object_story_id']);
			$adc['body']=$_REQUEST['cmessage'];
			$adc['image_hash']=$_REQUEST['cimage_hash'];
			$adc['title']=$_REQUEST['ctext'];			
			$adc['object_id']=$_REQUEST['object_id'];

			if($_REQUEST['img-wid-type']=='video'){
				$adc['video_id']=$_REQUEST['cvideo_id'];
				$picture= getVideodata($_REQUEST['cvideo_id'],$_REQUEST['code']);
				$adc['image_url']=$picture;
				unset($adc['object_id']);
			}
		}


 	} 

 	/*echo '<pre>';
 	print_r($adc);
 	die;*/


 	$url="https://graph.facebook.com/v2.11/".$_REQUEST['ad_id']."/?access_token=".$_REQUEST['code']; 	

 
 	$fields['creative'] = json_encode($adc);	
 	$fields['name'] = $_REQUEST['ad_name'];

 /*	if($_REQUEST['status']=='on'){
 		$fields['status'] = 'ACTIVE';
 	}else{
 		$fields['status'] = 'PAUSED';
 	}*/

 		/*echo '<pre>';
print_r($fields);
die;
*/
 	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$result=curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result, true);

	

	
	if($result['success']){
		echo json_encode(array('status'=>'success'));
	}else{
		if(isset($result['error']['error_user_msg'])){
			echo json_encode(array('status'=>'fail','msg'=>$result['error']['error_user_msg']));
		}else{
			echo json_encode(array('status'=>'fail','msg'=>$result['error']['message']));
		}
	}

}

if(isset($_REQUEST['campaign_edit'])){


	$url="https://graph.facebook.com/v2.11/".$_REQUEST['campaign_id']."/?access_token=".$_REQUEST['code']; 	
 	
 	$fields['name'] = $_REQUEST['camp_name'];
 	$fields['spend_cap'] = $_REQUEST['spend_cap'];
 	if($_REQUEST['status']=='on'){
 		$fields['status'] = 'ACTIVE';
 	}else{
 		$fields['status'] = 'PAUSED';
 	}


	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$result=curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result, true);

	if($result['success']){
		echo json_encode(array('status'=>'success'));
	}else{
		if(isset($result['error']['error_user_msg'])){
			echo json_encode(array('status'=>'fail','msg'=>$result['error']['error_user_msg']));
		}else{
			echo json_encode(array('status'=>'fail','msg'=>$result['error']['message']));
		}
	}
}
if(isset($_REQUEST['adset_edit'])){



	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['adset_id']."/?fields=targeting&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);


	$url="https://graph.facebook.com/v2.11/".$_REQUEST['adset_id']."/?access_token=".$_REQUEST['code']; 	
 	if($_REQUEST['optradio_schd']=='no'){
 			$fields['end_time'] ='';
 	}else{
 		$date = $_REQUEST['schedule_date'].''.$_REQUEST['schedule_time'];
 		

 		$time = strtotime($date);
		$newformat = date('Y-m-d H:i',$time);
		$my_timestamp = strtotime($newformat);
		// stores timezone
		$my_timezone = date_default_timezone_get();
		//$fields['end_time']= date(DATE_ATOM, $time);


 	}
 	$fields['name'] = $_REQUEST['adset_name'];
 	if($_REQUEST['adset_status']=='ACTIVE'){
 		$fields['status'] = 'PAUSED';
 	}else{
 		$fields['status'] = 'ACTIVE';
 	}
 	$fields['daily_budget']=$_REQUEST['daily_budget']*100;
	$fields['lifetime_budget']=$_REQUEST['lifetime_budget']*100;
 	$fields['optimization_goal']=$_REQUEST['optimization_goal'];
 	if($_REQUEST['is_auto_bid']=='on'){
 		$fields['is_autobid']='true';
 	}else{
 		$fields['is_autobid']='false';
 		$fields['bid_amount']=$_REQUEST['bid_amount'];
 		
 	}
 	$fields['billing_event']=$_REQUEST['billing_event'];

 	if($_REQUEST['pacing_type']=='standard')
 	{
 		$fields['pacing_type']=json_encode(array('standard'));
 	}else{
 		$fields['pacing_type']=json_encode(array('no_pacing'));
 	}
 	$fields['destination_type']=$_REQUEST['destination_type'];
 	if($_REQUEST['saved_Audience']!='' && $_REQUEST['saved_Audience']!='undefined'){
 		$fields['saved_audience_id']=$_REQUEST['saved_Audience'];	
 	}else{
 		$result['targeting']['age_max']=$_REQUEST['addsets_max_age'];
 		$result['targeting']['age_min']=$_REQUEST['addsets_min_age'];
 		$result['targeting']['flexible_spec']=array();

 		$result['targeting']['flexible_spec'][]=$_REQUEST['detail'];

 		
 		if(count($result['targeting']['flexible_spec'])==1 && $result['targeting']['flexible_spec'][0]==''){
 			
 			unset($result['targeting']['flexible_spec']);
 		}
 		$result['targeting']['geo_locations']['countries']=$_REQUEST['location'];
 		$result['targeting']['locales']=$_REQUEST['locale'];
 		if(empty($result['targeting']['locales'])){
 			unset($result['targeting']['locales']);
 		}
 		$fields['targeting']=json_encode($result['targeting']);  
  	} 

  	
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$result=curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result, true);
	
	if($result['success']){
		echo json_encode(array('status'=>'success'));
	}else{
		if(isset($result['error']['error_user_msg'])){
			echo json_encode(array('status'=>'fail','msg'=>$result['error']['error_user_msg']));
		}else{
			echo json_encode(array('status'=>'fail','msg'=>$result['error']['message']));
		}
	}
}
if(isset($_REQUEST['slideImages'])){

	$url="https://graph.facebook.com/v2.11/me/videos/";
	$fields = array();
	$fields['images_urls'] = $_REQUEST['slideImages'];
	$fields['images_urls'][]='https://scontent.xx.fbcdn.net/v/t45.1600-4/23656919_23842676171400514_663837154656387072_n.png?_nc_ad=z-m&_nc_cid=0&oh=774637db65d8339c2bbcae7c2153025c&oe=5AC713C4';
	$fields['duration_ms'] = $_REQUEST['duration'];
	$fields['transition_ms'] = 200;
	$field = array(
					'access_token' 	=> 	$_REQUEST['code'],
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
	
	if($result['id']){
		echo json_encode(array('status'=>'success','id'=>$result['id']));
	}else{
		echo json_encode(array('status'=>'failure','msg'=>$result['error']['message']));
	}
}

if(isset($_REQUEST['get_ad_creative_content'])){

	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/?access_token=".$_REQUEST['code']."&fields=object_story_spec,object_story_id,body,title");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$creative = json_decode($result, true);


	$cSession = curl_init(); 
    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/?access_token=".$_REQUEST['code']."&fields=adimages{url_128,hash}");
    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cSession,CURLOPT_HEADER, false); 
    $result=curl_exec($cSession);
    curl_close($cSession);
    $hashs = json_decode($result, true);  
   



	$creative=array('creative'=>$creative,'hashs'=>$hashs);
	$opt2 = renderPhpFile('create_ad_opt2.php', $creative);
	$data = array('opt2'=>$opt2);
	echo json_encode($data);
}
if($_REQUEST['add_more_tab']){

	$tab=array('tab'=>$_REQUEST['tab']);
	$clone = renderPhpFile('clone_mul_image.php', $tab);
	$data = array('clone'=>$clone);
	echo json_encode($data);
}
if(isset($_REQUEST['fb_pixel'])){
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/adspixels/?access_token=".$_REQUEST['code']."&fields=id,can_proxy,name");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$pixels = json_decode($result, true);
	
	$html ='<ul>';
	if(!empty($pixels['data'])){

		foreach($pixels['data'] as $pixel){

	        $html .='<li><b>'.$pixel['name'].'</b><br>Pixel ID: '.$pixel['id'].'</li>';
	                            
		}
	}
	$html .='</ul>';

	echo $html;
}

if(isset($_REQUEST['getpreview'])){

	//Desktop
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=DESKTOP_FEED_STANDARD&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$DESKTOP_FEED_STANDARD = json_decode($result, true);

	//mobile feed
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=MOBILE_FEED_STANDARD&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$MOBILE_FEED_STANDARD = json_decode($result, true);

	//instant artical standard
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=INSTANT_ARTICLE_STANDARD&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$INSTANT_ARTICLE_STANDARD = json_decode($result, true);

	//instream video mobile
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=INSTREAM_VIDEO_MOBILE&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$INSTREAM_VIDEO_MOBILE = json_decode($result, true);

	//instream vide o desktop
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=INSTREAM_VIDEO_DESKTOP&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$INSTREAM_VIDEO_DESKTOP = json_decode($result, true);

	//right column desktop
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=RIGHT_COLUMN_STANDARD&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$RIGHT_COLUMN_STANDARD = json_decode($result, true);

	//suggested video mobile
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=INSTREAM_VIDEO_MOBILE&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$INSTREAM_VIDEO_MOBILE = json_decode($result, true);

	//suggested vide o desktop
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=SUGGESTED_VIDEO_DESKTOP&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$SUGGESTED_VIDEO_DESKTOP = json_decode($result, true);

	//instagram field
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=INSTAGRAM_STANDARD&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$INSTAGRAM_STANDARD = json_decode($result, true);


	//Audience network autstream
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=AUDIENCE_NETWORK_OUTSTREAM_VIDEO&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$AUDIENCE_NETWORK_OUTSTREAM_VIDEO = json_decode($result, true);

	//MESSENGER_MOBILE_INBOX_MEDIA
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['creative_id']."/previews/?ad_format=MESSENGER_MOBILE_INBOX_MEDIA&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$MESSENGER_MOBILE_INBOX_MEDIA = json_decode($result, true);





	$preview = array('DESKTOP_FEED_STANDARD'=>$DESKTOP_FEED_STANDARD['data'][0]['body'],
					'MOBILE_FEED_STANDARD'=>$MOBILE_FEED_STANDARD['data'][0]['body'],
					'INSTANT_ARTICLE_STANDARD'=>$INSTANT_ARTICLE_STANDARD['data'][0]['body'],
					'INSTREAM_VIDEO_MOBILE'=>$INSTREAM_VIDEO_MOBILE['data'][0]['body'],
					'INSTREAM_VIDEO_DESKTOP'=>$INSTREAM_VIDEO_DESKTOP['data'][0]['body'],
					'RIGHT_COLUMN_STANDARD'=>$RIGHT_COLUMN_STANDARD['data'][0]['body'],
					'INSTREAM_VIDEO_MOBILE'=>$INSTREAM_VIDEO_MOBILE['data'][0]['body'],
					'SUGGESTED_VIDEO_DESKTOP'=>$SUGGESTED_VIDEO_DESKTOP['data'][0]['body'],
					'INSTAGRAM_STANDARD'=>$INSTAGRAM_STANDARD['data'][0]['body'],
					'AUDIENCE_NETWORK_OUTSTREAM_VIDEO'=>$AUDIENCE_NETWORK_OUTSTREAM_VIDEO['data'][0]['body'],
					'MESSENGER_MOBILE_INBOX_MEDIA'=>$MESSENGER_MOBILE_INBOX_MEDIA['data'][0]['body'],
					);

	echo $camp= renderPhpFile('ad_preview.php', $preview);

}

if($_REQUEST['adset_budget_schedule']){
	
	//$adsets =json_decode( $_REQUEST['adset'],true);
	//$adset =$adsets['adset'];

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['adset']."?access_token=".$_REQUEST['access_token']."&fields=id,saved_audience,is_autobid,name,status,delivery_info,billing_event,attribution_spec,targeting,bid_amount,lifetime_budget,daily_budget,start_time,end_time,objective_for_results,objective_for_cost,targeting_age_min,targeting_age_max,optimization_goal,targeting_genders,lifetime_imps,targeting_countries,pacing_type,destination_type,delivery_estimate,campaign{id,name,objective}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$adset = json_decode($result, true);

	/*echo '<pre>';
	print_r($adset);
	die;*/
	//start time
	$stime = new DateTime($adset['start_time']); 
	$start_time  = $stime->format('D ,M j Y, h:i a');
	//end date & Time
	$etime = new DateTime($adset['end_time']); 
	$end_date  = $etime->format('d/m/Y');
	$end_time  = $etime->format('h:i a');
	
	//bugdet
	$daily_budget  =$adset['daily_budget']/100;
    $lifetime_budget  =$adset['lifetime_budget']/100;
 

    //schedule or not
    $schd='0';
    if(isset($adset['end_time'])){
    	$schd='1';
    }
	
	$budget_array =array('start_time'=>$start_time,'daily_budget'=>$adset['daily_budget'],'lifetime_budget'=>$adset['lifetime_budget'],'end_date'=>$end_date,'end_time'=>$end_time,'schd'=>$schd);
	$traffic_array=array('destination_type'=>$adset['destination_type']);
	$optimize_array =array('is_autobid'=>$adset['is_autobid'],'pacing_type'=>$adset['pacing_type'][0],'billing_event'=>$adset['billing_event'],'bid_amount'=>$adset['bid_amount'],'optimization_goal'=>$adset['optimization_goal']);
	$budget  = renderPhpFile('adset/budget_schedule.php', $budget_array);
	$traffic = renderPhpFile('adset/traffic.php', $traffic_array);
	$optimize = renderPhpFile('adset/optimization_del.php', $optimize_array);

	$potential_reach= $adset['delivery_estimate']['data'][0]['estimate_mau'];
	$tot=0;
	foreach ($adset['delivery_estimate']['data'][0]['daily_outcomes_curve'] as $key => $value) {
	$tot+=$value['reach'];
	}	
	$gen='All';
	if(isset($adset['targeting_genders']) && $adset['targeting_genders']=='1'){
		$gen='Men';
	}
	if(isset($adset['targeting_genders']) && $adset['targeting_genders']=='2'){
		$gen='Women';
	}
	if(isset($adset['targeting_countries']))
	{
		$cont = implode(' ', $adset['targeting_countries']);
	}else{
		$cont='';
	}
	//for rename popup
	$rename_popup ='<li class="dropdown-header all-main-head">
						<h5><span>Campaign </span><i class="fa fa-angle-right arrow"></i></h5>
						<ul class="camp-sub-list" rel="Campaign">
						
							<li  rel="'.$adset['campaign']['id'].'" id="cmp_id_adset"><a href="#" > Campaign ID</a></li>
							<li  rel="'.$adset['campaign']['name'].'" id="cmp_name_adset"><a href="#" > Campaign Name</a></li>
							<li  rel="'.$adset['campaign']['objective'].'" id="cmp_obj_adset"><a href="#" > Campaign objective</a></li>
						</ul>
					<li>
					<li class="dropdown-header all-main-head">
						<h5 ><span>Adset</span> <i class="fa fa-angle-right arrow"></i></h5>
						<ul class="camp-sub-list" rel="Adset">
					
							<li  rel="'.$adset['id'].'" id="Radset_id"><a href="#" > Adset ID</a></li>
							<li  rel="'.$adset['name'].'" id="Radset_name"><a href="#" > Adset Name</a></li>
							<li  rel="'.$adset['targeting_age_min'].'" id="Rage"><a href="#" > Age</a></li>
							<li  rel="'.$gen.'" id="Rgen"><a href="#" > Gender</a></li>
							<li  rel="'.$cont.'" id="Rcountry"><a href="#" > Countries</a></li>
						</ul>
					<li>
					<li class="dropdown-header all-main-head custom_text">
						<h5 >Custom Text</h5>	
					</li>
					';


	echo json_encode(array('budget'=>$budget,'traffic'=>$traffic,'optimize'=>$optimize,'potential_reach'=>$potential_reach,'tot'=>$tot,'rename_popup'=>$rename_popup));

}

if($_REQUEST['account_chart']){
	$chart = $_REQUEST['account_chart'];
	if($chart=='age'){
		$data = array('code'=>$_REQUEST['access_token'],'act'=>$_REQUEST['act'],'res1'=>$_REQUEST['spline1'],'res2'=>$_REQUEST['spline2']);
		$html  = renderPhpFile('account/age-chart.php', $data);
		echo json_encode(array('html'=>$html));
	}
	if($chart=='gender'){
		$data = array('code'=>$_REQUEST['access_token'],'act'=>$_REQUEST['act'],'res1'=>$_REQUEST['spline1'],'res2'=>$_REQUEST['spline2']);
		$html  = renderPhpFile('account/gender-chart.php', $data);
		echo json_encode(array('html'=>$html));
	}
	if($chart=='hour'){
		$data = array('code'=>$_REQUEST['access_token'],'act'=>$_REQUEST['act'],'res1'=>$_REQUEST['spline1'],'res2'=>$_REQUEST['spline2']);
		$html  = renderPhpFile('account/hour-chart.php', $data);
		echo json_encode(array('html'=>$html));
	}
}

if(!empty($_REQUEST['account_breakdown'])){

	$camapaigns= getData($_REQUEST['act'],$_REQUEST['code'],'null');
	if($_REQUEST['account_breakdown']=='clear'){
		$data=array('act'=>$_REQUEST['act'],'code'=>$_REQUEST['code']);
	}else{
		$data=array('breakdown'=>$_REQUEST['account_breakdown'],'code'=>$_REQUEST['code'],'breakdown_type'=>$_REQUEST['type'],'act'=>$_REQUEST['act']);	
	}


	$acc= renderPhpFile('account/account_overview_table.php', $data);
			

	$data = array('html'=>$acc);
	echo json_encode($data);
}
if(isset($_REQUEST['video_by_url'])){
	$video = $_REQUEST['video_by_url'];
	$title = $_REQUEST['title'];
	$fields = array(
			
		
			'file_url'=>$video,
			'title' =>$title,
			'access_token' 		=> $_REQUEST['code'],
	
	);
	$ch = curl_init();
	$url = "https://graph-video.facebook.com/v2.11/".$_REQUEST['act']."/advideos?fields=picture,id";	
					
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	$result = curl_exec($ch);
	curl_close($ch);
	$advideos= json_decode($result, true);	

	
	if($advideos['error']){
		echo json_encode(array('status'=>'failure','msg'=>$advideos['error']['error_user_msg']));
	}else{
		echo json_encode(array('status'=>'success','id'=>$advideos['id']));
	}
}

 function getVideodata($video_id,$code){

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$video_id."/?fields=picture,id&access_token=".$code);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);

	return $result['picture'];
}

if(isset($_REQUEST['detail_target'])){

	if(isset($_REQUEST['dets'])){
		$dets=$_REQUEST['dets'];
	}else{
		$dets=array();
	}

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/targetingsearch/?q=".$_REQUEST['detail_target']."&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);

	if($result['error']){
		echo json_encode(array('status'=>'failure','msg'=>$result['error']['message']));
	}else{
		$html='<ul>';
			if(!empty($result['data'])){
				foreach($result['data'] as $res){
					$has =0;
				if(!in_array($res['id'],$dets)){
					$has =1;
					$token = strtolower($res['path'][0]);
					$html .='<li rel="'.$res['id'].'" token="'.$token.'" ><span class="target_name">'.$res['name'].'</span><span class="target_key">'.$res['path'][0].'</span></li>';
					}
				}
			}else{
				$html="<h5><center>No Data Found</center></h5>";
			}


			if($has==0){
			$html="<h5><center>No Data Found</center></h5>";	
			}

		$html .='</ul>';

		echo json_encode(array('status'=>'success','html'=>$html));
	}
}



if(isset($_REQUEST['locale_search'])){
	if(isset($_REQUEST['langs'])){
		$langs=$_REQUEST['langs'];
	}else{
		$langs=array();
	}
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/search/?type=adlocale&q=".$_REQUEST['locale_search']."&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);

	if($result['error']){
		echo json_encode(array('status'=>'failure','msg'=>$result['error']['message']));
	}else{
		$html='<ul>';
			if(!empty($result['data'])){
				$has =0;
				foreach($result['data'] as $res){
					if(!in_array($res['key'],$langs)){
						$has =1;
					$html .='<li rel="'.$res['key'].'">'.$res['name'].'</li>';
					}
				}
			}else{
				$html="<h5><center>No Data Found</center></h5>";
			}

			if($has==0){
			$html="<h5><center>No Data Found</center></h5>";	
			}
		$html .='</ul>';

		echo json_encode(array('status'=>'success','html'=>$html));
	}
}
if(isset($_REQUEST['getCustomAudience'])){

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/customaudiences/?fields=name,id&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);

	if($result['error']){
		echo json_encode(array('status'=>'failure','msg'=>$result['error']['message']));
	}else{

		$html ='<select class="selectpicker custom_audience" data-show-subtext="true" data-live-search="true" multiple name="custom_audience[]" title="Select audience to include">';
		$ex_html ='<select class="selectpicker exl_custom_audience" data-show-subtext="true" data-live-search="true" multiple name="excluded_custom_audiences[]" title="Select audience to exclude"> ';
		if(!empty($result['data'])){		
			$html .='<option value="" selected>Include custom audience</option>';
			$ex_html .='<option value="" selected>Exclude custom audience</option>';
			foreach($result['data'] as $aud){
				$html .='<option  value="'.$aud['id'].'">'.$aud['name'].'</option>';
				$ex_html .='<option  value="'.$aud['id'].'">'.$aud['name'].'</option>';
			}
				
		}else{
			$html .='<option value="" disabled>No Audience Found</option>';
			$ex_html .='<option value="" disabled>No Audience Found</option>';
		}
		$html .='</select>';
		$ex_html .='</select>';

		$total =$html.'<br><a href="#" class="exl_cust_aud">Exclude</a><br>'.$ex_html;


		echo json_encode(array('status'=>'success','html'=>$html,'ex_html'=>$ex_html,'total'=>$total));
	}

}

 function AllLocales($code){
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/search/?type=adlocale&access_token=".$code);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);
	$locales=array();
	if(!empty($result['data'])){
		foreach($result['data'] as $key=>$res){
			$locales[$key]['name']=$res['name'];
			$locales[$key]['key']=$res['key'];
		}
	}

	return $locales;

	
}
if(isset($_REQUEST['getLocaleNames'])){
	
	$locales = AllLocales($_REQUEST['code']);

	$html='';
	foreach($_REQUEST['getLocaleNames'] as $lc){
			$arrayKey = searchArrayKeyVal("key", $lc, $locales);
			$html .='<p class="slct-tgt">'.$locales[$arrayKey]['name'].'<span class="pull-right cls"><i class="fa fa-times" aria-hidden="true"></i></span><input type="hidden" name="locale[]" value="'.$lc.'" class="lang_slct"></p>';
	}
	    
	echo $html;
	
}

function searchArrayKeyVal($sKey, $id, $array) {
   foreach ($array as $key => $val) {
       if ($val[$sKey] == $id) {
           return $key;
       }
   }
   return false;
}

if(isset($_REQUEST['getFlexibleSpecNames'])){
	
	$html='';
	foreach($_REQUEST['getFlexibleSpecNames'] as $key=>$main){
		foreach($main as $keys=>$inner){
			
			foreach($inner as $inner1){
			$html .='<p class="slct-tgt">'.$inner1['name'].'<span class="pull-right cls"><i class="fa fa-times" aria-hidden="true"></i></span><input type="hidden" name="detail['.$keys.'][]" value="'.$inner1['id'].'" class="dets"></p>';
			}
		}
	}
	echo $html;
}

if(isset($_REQUEST['getEstimation'])){
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/reachestimate/?targeting_spec=".$_REQUEST['getEstimation']."&access_token=".$code);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);
	/*if(!empty($result['data'])){
		echo json_encode('status'=>'success','potential'=>$result['data']['users']);
	}else{
		echo json_encode('status'=>'failure');
	}*/
}

if(isset($_REQUEST['view_tab_objec_id'])){

	if($_SESSION['time_range']['since']!='Invalid date'){
			$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}&time_increment=1";
	}else{
		$rg="&date_preset=lifetime";
	}


	$cSession = curl_init(); 
	

	
curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['view_tab_objec_id']."/insights/?fields=reach,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type,inline_post_engagement,cost_per_inline_post_engagement,objective&access_token=".$_REQUEST['access_token'].$rg);


	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);


	if(!empty($result['data'])){


		$result_label = str_replace('_',' ', ucfirst($result['data'][0]['objective']));	
		$reach = $result['data'][0]['reach'];
		$spend = $result['data'][0]['spend'];


		if($result['data'][0]['objective']=='POST_ENGAGEMENT'){
    		$result_amt = $result['data'][0]['inline_post_engagement'];
    		$result_fr_perform_graph='inline_post_engagement';
    		$result_cost_perform_graph='cost_per_inline_post_engagement';

    	}
    	if($result['data'][0]['objective']=='LINK_CLICKS'){
    		$result_amt = $result['data'][0]['inline_link_clicks'];	
    		$result_fr_perform_graph='inline_link_clicks';
    		$result_cost_perform_graph='cost_per_inline_link_click';
    	}
    	if($result['data'][0]['objective']=='CONVERSIONS'){
    		$result_amt = '';	
    		$result_fr_perform_graph='';
    		$result_cost_perform_graph='';
    	}
    	if($result['data'][0]['objective']=='PAGE_LIKES'){
    		
    		foreach($result['data'][0]['actions'] as $act){	                			
    			if($act['action_type']=='like'){
    				$result_amt = $act['value'];	                				
    			}
    		}

    		$result_fr_perform_graph='like';
    		$result_cost_perform_graph='value';
    	
    	}

		echo json_encode(array('status'=>'success','result_fr_perform_graph'=>$result_fr_perform_graph,'result_label'=>$result_label,'result_amt'=>'$'.$result_amt,'reach'=>$reach,'spend'=>$spend,'result_cost_perform_graph'=>$result_cost_perform_graph));

	}else{

		$result_label = str_replace('_',' ', ucfirst($_REQUEST['obj']));	
		echo json_encode(array('status'=>'success','result_label'=>$result_label,'result_amt'=>'$0.00','reach'=>'0','spend'=>'0'));
	}

	
	
}

if($_REQUEST['camp_list_adset_popup']){

	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/campaigns?access_token=".$_REQUEST['code']."&level=ad&filtering=".$filter."&fields=name,buying_type,objective,id");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$camapaigns = json_decode($result, true);

	$html='<ul>';
	if(!empty($camapaigns['data'])){
		foreach($camapaigns['data'] as $camp):
		$html .="<li data-id=". $camp['id']." data-name=". $camp['name'] .">
                                                            <b>". $camp['name']."</b>
                                                            <p>". $camp['id'];
                                                           if($camp['objective']) { 
                                                           	$html .="<i class='fa fa-circle'></i>". $camp['objective'];
                                                           } 
                                                             if($camp['buying_type']) { 
                                                             	$html .='<i class="fa fa-circle"></i>'. $camp['buying_type']; 
                                                             } 
                                                           $html .= "</p>
                                                        </li>";
        endforeach;
	}else{
		$html .="<li>No data Found</li>";
	}
	$html .='</ul>';
	echo $html;
}
if(isset($_REQUEST['tabGraph'])){

	if($_REQUEST['tabName']=='Reach'){
		$tab='reach';
	}
	if($_REQUEST['tabName']=='Link Click'){
		$tab='inline_link_clicks';
	}
	if($_REQUEST['tabName']=='Impression'){
		$tab='impressions';
	}
	if($_REQUEST['tabName']=='Spend'){
		$tab='spend';
	}
	if($_REQUEST['tabName']=='Post Engagement'){
		$tab='inline_post_engagement';
	}
	if($_REQUEST['tabName']=='30 sec Video View'){
		$tab='video_30_sec_watched_actions';
	}


	$account_data=array('code'=>$_REQUEST['code'],'act'=>$_REQUEST['act'],$_REQUEST['tabGraph']=>$tab);
	$account_overview= renderPhpFile('account/'.$_REQUEST['tabGraph'].'.php', $account_data);	
	echo $account_overview;
}
if(isset($_REQUEST['getAddRenameFields'])){

	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['getAddRenameFields']."/?access_token=".$_REQUEST['code']."&fields=name,creative{instagram_actor_id,object_id,image_hash},campaign{id,name,objective},adset{id,name,targeting_age_min,targeting_genders,targeting_countries}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$ads = json_decode($result, true);
	

	$gen='All';
	if(isset($ads['adset']['targeting_genders']) && $ads['adset']['targeting_genders']=='1'){
		$gen='Men';
	}
	if(isset($ads['adset']['targeting_genders']) && $ads['adset']['targeting_genders']=='2'){
		$gen='Women';
	}
	if(isset($ads['adset']['targeting_countries']))
	{
		$cont = implode(' ', $ads['adset']['targeting_countries']);
	}else{
		$cont='';
	}
	//for rename popup
	$rename_popup ='<li class="dropdown-header all-main-head">
						<h5 ><span>Campaign </span><i class="fa fa-angle-right arrow"></i></h5>
						<ul class="camp-sub-list" rel="Campaign">
							<li  rel="'.$ads['campaign']['id'].'" id="cmp_id_ad"><a href="#" > Campaign ID</a></li>
							<li  rel="'.$ads['campaign']['name'].'" id="cmp_name_ad"><a href="#" > Campaign Name</a></li>
							<li  rel="'.$ads['campaign']['objective'].'" id="cmp_obj_ad"><a href="#" > Campaign objective</a></li>

						</ul>
					</li>
						
					<li class="dropdown-header all-main-head">
						<h5 ><span>Adset </span><i class="fa fa-angle-right arrow"></i></h5>
						<ul class="camp-sub-list" rel="Adset">
					
							<li  rel="'.$ads['adset']['id'].'" id="Radset_id_ad"><a href="#" > Adset ID</a></li>
							<li  rel="'.$ads['adset']['name'].'" id="Radset_name_ad"><a href="#" > Adset Name</a></li>
							<li  rel="'.$ads['adset']['name'].'" id="Radset_name_ad"><a href="#" > Adset Name</a></li>
							<li  rel="'.$ads['targeting_age_min'].'" id="Rage_ad"><a href="#" > Age</a></li>
							<li  rel="'.$gen.'" id="Rgen_ad"><a href="#" > Gender</a></li>
							<li  rel="'.$cont.'" id="Rcountry_ad"><a href="#" > Countries</a></li>
						</ul>
					</li>
					<li class="dropdown-header all-main-head">
						<h5><span>Ads</span> <i class="fa fa-angle-right arrow"></i></h5>
						<ul class="camp-sub-list" rel="Ad">
							<li  rel="'.$ads['id'].'" id="Rad_id"><a href="#" > Ad ID</a></li>
							<li  rel="'.$ads['name'].'" id="Rad_name"><a href="#" > Ad Name</a></li>
							<li  rel="'.$ads['creative']['title'].'" id="R_title"><a href="#" > Headline</a></li>
							<li  rel="'.$ads['creative']['image_hash'].'" id="R_image_hash"><a href="#" > Image Hash</a></li>
							<li  rel="'.$ads['creative']['object_id'].'" id="R_object_id"><a href="#" > Page Id</a></li>
							<li  rel="'.$ads['creative']['instagram_actor_id'].'" id="R_insta"><a href="#" > Instagram Page Id</a></li>
						</ul>
					</li>
					<li class="dropdown-header all-main-head custom_text">
						<h5 >Custom Text</h5>	
					</li>';

	echo $rename_popup;

}
if(isset($_REQUEST['camp_total_adsets'])){
	
	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['camp_total_adsets']."/?access_token=".$_REQUEST['code']."&fields=name,adsets{id},ads{id}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$results = json_decode($result, true);

	$adset_ids=array();
	if(!empty($results['adsets']['data'])){
		foreach($results['adsets']['data'] as $data){
			$adset_ids[]=$data['id'];
		}
	}

	$ad_ids=array();
	if(!empty($results['ads']['data'])){
		foreach($results['ads']['data'] as $data){
			$ad_ids[]=$data['id'];
		}
	}

	echo json_encode(array('status'=>'success','adset_ids'=>$adset_ids,'ad_ids'=>$ad_ids));
}
if(isset($_REQUEST['adset_totals'])){
	
	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['adset_totals']."/?access_token=".$_REQUEST['code']."&fields=name,campaign_id,ads{id}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$results = json_decode($result, true);

	

	$ad_ids=array();
	if(!empty($results['ads']['data'])){
		foreach($results['ads']['data'] as $data){
			$ad_ids[]=$data['id'];
		}
	}

	echo json_encode(array('status'=>'success','campaign_id'=>$results['campaign_id'],'ad_ids'=>$ad_ids));
}
if(isset($_REQUEST['ad_totals'])){
	
	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['ad_totals']."/?access_token=".$_REQUEST['code']."&fields=name,campaign_id,adset_id");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$results = json_decode($result, true);


	echo json_encode(array('status'=>'success','campaign_id'=>$results['campaign_id'],'adset_id'=>$results['adset_id']));
}