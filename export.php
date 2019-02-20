<?php

    session_start();
    $cSession = curl_init();                     
    if($_SESSION['time_range']['since']!='Invalid date'){
        $rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
    }else{
        $rg="&date_preset=lifetime";
    }


	/*get camapagins, adsets and ads*/

	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$_REQUEST['act']."/campaigns?access_token=".$_REQUEST['code']."&fields=name,objective_for_results,account_id,buying_type,objective,id,status,start_time,delivery_info,stop_time,insights{reach,impressions,frequency,unique_clicks,spend},adsets{id,name,status,delivery_info,billing_event,attribution_spec,targeting,bid_amount,lifetime_budget,daily_budget,start_time,end_time,objective_for_results,objective_for_cost,targeting_age_min,targeting_age_max,optimization_goal,targeting_genders,lifetime_imps,targeting_countries,activities{actor_name,event_time,application_name,translated_event_type,extra_data},insights{reach,frequency,impressions,unique_clicks,spend}},ads{name,id,delivery_info,preview_link,creative_title,creative_body,creative_link_url,objective_for_results,objective_for_cost,status,insights{frequency,impressions,spend,unique_clicks,total_unique_actions,relevance_score,reach},adcreatives{image_url,id}}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$camapaigns = json_decode($result, true);


	if($_GET['type'] && $_GET['type']=='campaign'){		

	    header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=report.csv');  
        $output = fopen("php://output", "w");  
        fputcsv($output, array('S/No.','Start','Ends','Campaign Name','Delivery','Result','Reach','Impressions','Cost Per Result','Amount Spent','Frequency','Unique Links Clicks'));  
        $j=0;
        if(count($camapaigns['data'])> 0):
        	foreach ($camapaigns['data'] as $camp): 

                 
                    $cSession = curl_init(); 
                    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$camp['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type,video_10_sec_watched_actions,video_30_sec_watched_actions,video_p100_watched_actions,video_p25_watched_actions,video_p50_watched_actions,video_p75_watched_actions,video_p95_watched_actions,cost_per_10_sec_video_view,video_avg_percent_watched_actions,inline_post_engagement,cost_per_inline_post_engagement,objective&access_token=".$_REQUEST['code']."".$rg);
                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                    $result_b=curl_exec($cSession);
                    curl_close($cSession);
                    $camp_inights = json_decode($result_b, true);



        		$reach='-';
        		$imp = '-';
        		$amt_spend= '-';
        		$freq = '-';
        		$uniq = '-';
                if(isset($camp['stop_time'])){
                    $stop_time=date_format(date_create($camp['stop_time']), ' j M, Y');
                }else{ 
                    $stop_time= 'Ongoing';
                }

        		if(isset($camp_inights['data'])){
        			$reach = $camp_inights['data'][0]['reach'];
        		}
        		if(isset($camp_inights['data'])){
        			$imp = $camp_inights['data'][0]['impressions'];
        		}
        		if(isset($camp_inights['data'])){
        			$amt_spend = '$'.$camp_inights['data'][0]['spend'];
        		}
        		if(isset($camp_inights['data'])){
        		 	$freq = $camp_inights['data'][0]['frequency'];
        		}
        		if(isset($camp_inights['data'])){
        			$uniq =  $camp_inights['data'][0]['unique_clicks'];
        		}  
                //result
                if(!empty($camp_inights['data'])){
               
                        if($camp_inights['data'][0]['objective']=='POST_ENGAGEMENT'){
                            $res = $camp_inights['data'][0]['inline_post_engagement'];

                        }
                        if($camp_inights['data'][0]['objective']=='LINK_CLICKS'){
                            $res= $camp_inights['data'][0]['inline_link_clicks'];    
                        }
                        if($camp_inights['data'][0]['objective']=='CONVERSIONS'){
                            $res= '';    
                        }
                        if($camp_inights['data'][0]['objective']=='PAGE_LIKES'){
                            if(!empty($camp_inights['data'][0]['actions'])){
                                foreach($camp_inights['data'][0]['actions'] as $act){                               
                                    if($act['action_type']=='like'){
                                        $res= $act['value'];                                 
                                    }
                                }
                            }                       
                        }                       
                    }else{ $res = '-';}
                    $res .= ' ('.str_replace('_',' ', ucfirst($camp['objective_for_results'])).' ) '; 
                //result end 
                //result cost
                   
                    if(!empty($camp_inights['data'])){                  
                     
                        if($camp_inights['data'][0]['objective']=='POST_ENGAGEMENT'){
                            
                            $res_cost = $camp_inights['data'][0]['cost_per_inline_post_engagement'];

                        }
                        if($camp_inights['data'][0]['objective']=='LINK_CLICKS'){
                            $res_cost = $camp_inights['data'][0]['cost_per_inline_link_click'];    
                        }
                        if($camp_inights['data'][0]['objective']=='CONVERSIONS'){
                            $res_cost = '-';   
                        }
                        if($camp_inights['data'][0]['objective']=='PAGE_LIKES'){    
                            if(!empty($camp_inights['data'][0]['cost_per_action_type'])){                       
                                foreach($camp_inights['data'][0]['cost_per_action_type'] as $act){                              
                                    if($act['action_type']=='like'){
                                        $res_cost = $act['value'];                                 
                                    }
                                }
                            }                       
                        }
                        //echo $type;
                        
                    }else{ $res_cost= '-';}
                    $res_cost .=  '( Per '.str_replace('_',' ', ucfirst($camp['objective_for_results'])).')'; 
                //result cost end  		

            $j++;
            fputcsv($output,array($j,date_format(date_create($camp['start_time']),'j F Y'),$stop_time,$camp['name'],$camp['delivery_info'][ 'status'],$res,$reach,$imp,$res_cost,$amt_spend,$freq,$uniq));
        	endforeach;
      	endif;


	}

	/*adset*/

	if($_GET['type'] && $_GET['type']=='adset'){		

	    header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=report.csv');  
        $output = fopen("php://output", "w");  
        fputcsv($output, array('S/No.','Start','Ends','Ad Set Name','Delivery','Schedule','Result','Budget','Reach','Impressions','Cost Per Result','Amount Spend','Frequency','Unique Link Clicks'));  
        $j=0;
      	if(!empty($camapaigns[ 'data'])) :
            foreach($camapaigns[ 'data'] as $campaign) : 
                $total_adset+= count($campaign['adsets']['data']); 
                if($campaign['adsets']['data']) :
                foreach ($campaign['adsets']['data'] as $adset) : 



                  
           
                    $cSession = curl_init(); 
                    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$adset['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type,video_10_sec_watched_actions,video_30_sec_watched_actions,video_p100_watched_actions,video_p25_watched_actions,video_p50_watched_actions,video_p75_watched_actions,video_p95_watched_actions,cost_per_10_sec_video_view,video_avg_percent_watched_actions,inline_post_engagement,cost_per_inline_post_engagement,objective&access_token=".$_REQUEST['code']."".$rg);
                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                    $result_b=curl_exec($cSession);
                    curl_close($cSession);
                    $adset_inights = json_decode($result_b, true);


        		$reach='-';
        		$imp = '-';
        		$amt_spend= '-';
        		$freq = '-';
        		$uniq = '-';
        		if(isset($adset_inights['data'])){
        		 	$reach = $adset_inights['data'][0]['reach'];
        		}
        		if(isset($adset_inights['data'])){
        			$imp = $adset_inights['data'][0]['impressions'];
        		}
        		if(isset($adset_inights['data'])){
        			$amt_spend = '$'.$adset_inights['data'][0]['spend'];
        		}
        		if(isset($adset_inights['data'])){
        		 	$freq = $adset_inights['data'][0]['frequency'];
        		}
        		if(isset($adset_inights['data'])){
        			$uniq =  $adset_inights['data'][0]['unique_clicks'];
        		}     	

               
                    if($adset['daily_budget']==0){
                        $budget = '$'.$adset['lifetime_budget']/100;
                       
                    }
                     if($adset['lifetime_budget']==0){
                           $budget =  '$'.$adset['daily_budget']/100;
                       
                    }

                      //result
                if(!empty($adset_inights['data'])){
               
                        if($adset_inights['data'][0]['objective']=='POST_ENGAGEMENT'){
                            $res = $adset_inights['data'][0]['inline_post_engagement'];

                        }
                        if($adset_inights['data'][0]['objective']=='LINK_CLICKS'){
                            $res= $adset_inights['data'][0]['inline_link_clicks'];    
                        }
                        if($adset_inights['data'][0]['objective']=='CONVERSIONS'){
                            $res= '';    
                        }
                        if($adset_inights['data'][0]['objective']=='PAGE_LIKES'){
                            if(!empty($adset_inights['data'][0]['actions'])){
                                foreach($adset_inights['data'][0]['actions'] as $act){                               
                                    if($act['action_type']=='like'){
                                        $res= $act['value'];                                 
                                    }
                                }
                            }                       
                        }                       
                    }else{ $res = '-';}
                    $res .= ' ('.str_replace('_',' ', ucfirst($adset['objective_for_results'])).' ) '; 
                    //result end 
                    //result cost
                   
                    if(!empty($adset_inights['data'])){                  
                     
                        if($adset_inights['data'][0]['objective']=='POST_ENGAGEMENT'){
                            
                            $res_cost = $adset_inights['data'][0]['cost_per_inline_post_engagement'];

                        }
                        if($adset_inights['data'][0]['objective']=='LINK_CLICKS'){
                            $res_cost = $adset_inights['data'][0]['cost_per_inline_link_click'];    
                        }
                        if($adset_inights['data'][0]['objective']=='CONVERSIONS'){
                            $res_cost = '-';   
                        }
                        if($camp_inights['data'][0]['objective']=='PAGE_LIKES'){    
                            if(!empty($adset_inights['data'][0]['cost_per_action_type'])){                       
                                foreach($adset_inights['data'][0]['cost_per_action_type'] as $act){                              
                                    if($act['action_type']=='like'){
                                        $res_cost = $act['value'];                                 
                                    }
                                }
                            }                       
                        }
                        //echo $type;
                        
                    }else{ $res_cost= '-';}
                    $res_cost .=  '( Per '.str_replace('_',' ', ucfirst($adset['objective_for_results'])).')'; 

                    //schedule
                    $schd =  $start_date=date_format(date_create($adset['start_time']), ' j F, Y').' - ';
                    if(isset($adset['end_time'])){
                     $schd .=date_format(date_create($adset['end_time']), ' j F, Y');
                        $interval = date_diff(date_create($adset['start_time']), date_create($adset['end_time']));                        
                        $schd .=' ('.($interval->format('%R%a')+1) .' days ) ';

                    }else{ $schd .= 'Ongoing';}
             


            $j++;
            fputcsv($output,array($j,date_format(date_create($adset['start_time']),'j F Y'),$adset['stop_time'],$adset['name'],$adset['delivery_info'][ 'status'],$schd,$res,$budget,$reach,$imp,$res_cost,$amt_spend,$freq,$uniq));
        	endforeach;
      	endif;
      	endforeach;
      	endif;


	}

	/*ads*/


		if($_GET['type'] && $_GET['type']=='ad'){		

	    header('Content-Type: text/csv; charset=utf-8');  
        header('Content-Disposition: attachment; filename=report.csv');  
        $output = fopen("php://output", "w");  
        fputcsv($output, array('S/No.','Ad Name','Delivery','Result','Relevance','Reach','Cost Per Result','Impressions','Amount Spend','Frequency','Unique Link Clicks','Button Clicks'));  
        $j=0;
          if(!empty($camapaigns[ 'data'])) :
                foreach($camapaigns['data'] as $ads) : 
                $adsets= $ads['adsets']['data']; 
                $total_ads+= count($ads['ads']['data']); 
                if($ads['ads']['data']) :
                foreach ($ads['ads']['data'] as $key=> $ad) : 
                    $cSession = curl_init(); 
                     curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$ad['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type,video_10_sec_watched_actions,video_30_sec_watched_actions,video_p100_watched_actions,video_p25_watched_actions,video_p50_watched_actions,video_p75_watched_actions,video_p95_watched_actions,cost_per_10_sec_video_view,video_avg_percent_watched_actions,inline_post_engagement,cost_per_inline_post_engagement,objective,total_unique_actions&access_token=".$_REQUEST['code']."".$rg);
                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                    $result_b=curl_exec($cSession);
                    curl_close($cSession);
                    $ad_insights = json_decode($result_b, true); 
        		$reach='-';
        		$imp = '-';
        		$amt_spend= '-';
        		$freq = '-';
        		$uniq = '-';
        		if(isset($ad_insights['data'])){
        		 	$reach = $ad_insights['data'][0]['reach'];
        		}
        		if(isset($ad_insights['data'])){
        			$imp = $ad_insights['data'][0]['impressions'];
        		}
        		if(isset($ad_insights['data'])){
        			$amt_spend = '$'.$ad_insights['data'][0]['spend'];
        		}
        		if(isset($ad_insights['data'])){
        		 	$freq = $ad_insights['data'][0]['frequency'];
        		}
        		if(isset($ad_insights['data'])){
        			$uniq =  $ad_insights['data'][0]['unique_clicks'];
        		}
                if(isset($ad_insights['data'])){
                    $button =  $ad_insights['data'][0]['total_unique_actions'];
                }     		

                //result
                if(!empty($ad_insights['data'])){
               
                        if($ad_insights['data'][0]['objective']=='POST_ENGAGEMENT'){
                            $res = $ad_insights['data'][0]['inline_post_engagement'];

                        }
                        if($ad_insights['data'][0]['objective']=='LINK_CLICKS'){
                            $res= $ad_insights['data'][0]['inline_link_clicks'];    
                        }
                        if($ad_insights['data'][0]['objective']=='CONVERSIONS'){
                            $res= '';    
                        }
                        if($ad_insights['data'][0]['objective']=='PAGE_LIKES'){
                            if(!empty($ad_insights['data'][0]['actions'])){
                                foreach($ad_insights['data'][0]['actions'] as $act){                               
                                    if($act['action_type']=='like'){
                                        $res= $act['value'];                                 
                                    }
                                }
                            }                       
                        }                       
                    }else{ $res = '-';}
                    $res .= ' ('.str_replace('_',' ', ucfirst($ad['objective_for_results'])).' ) '; 
                    //result end 
                    //result cost
                   
                    if(!empty($ad_insights['data'])){                  
                     
                        if($ad_insights['data'][0]['objective']=='POST_ENGAGEMENT'){
                            
                            $res_cost = $ad_insights['data'][0]['cost_per_inline_post_engagement'];

                        }
                        if($ad_insights['data'][0]['objective']=='LINK_CLICKS'){
                            $res_cost = $ad_insights['data'][0]['cost_per_inline_link_click'];    
                        }
                        if($ad_insights['data'][0]['objective']=='CONVERSIONS'){
                            $res_cost = '-';   
                        }
                        if($ad_insights['data'][0]['objective']=='PAGE_LIKES'){    
                            if(!empty($ad_insights['data'][0]['cost_per_action_type'])){                       
                                foreach($ad_insights['data'][0]['cost_per_action_type'] as $act){                              
                                    if($act['action_type']=='like'){
                                        $res_cost = $act['value'];                                 
                                    }
                                }
                            }                       
                        }
                        //echo $type;
                        
                    }else{ $res_cost= '-';}
                    $res_cost .=  '( Per '.str_replace('_',' ', ucfirst($ad['objective_for_results'])).')'; 
                    //rel
                 if(isset($ad_insights['data'])){$rel = $ad_insights['data'][0]['relevance_score'][ 'score'];}else{ $rel = '-';}


            $j++;
            fputcsv($output,array($j,$ad['name'],$ad['delivery_info'][ 'status'],$res,$rel,$reach,$res_cost,$imp,$amt_spend,$freq,$uniq,$button));
        	endforeach;
      	endif;
    endforeach;
endif;


	}

?>