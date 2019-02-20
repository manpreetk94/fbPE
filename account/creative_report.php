<div class="table-result" style="margin-top: 0">
	  <table class="table">
        <thead class="thead-default">
            <tr>
               	<th></th>
                <th>Ad Creative</th>
                <th>Delivery </th>
                <th>Results </th>
                <th>Reach </th>
                <th>Cost per Result </th>
                <th>Amount Spent </th>              
                <th>Frequency </th>
                <th>Impressions</th>
                <th>Unique Link Clicks</th>                
            </tr>
        </thead>
        <tbody>

            <?php
           
               
                $total_ads = count($ads['data']); 
                if($ads['data']) :
                    foreach ($ads['data'] as $key=> $ad) :

                        /*for insights*/
                    $cSession = curl_init();                     
                    if($_SESSION['time_range']['since']!='Invalid date'){
                        $rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
                    }else{
                        //$rg="&period=lifetime";
                         $rg="&date_preset=lifetime";
                    }
                    
                    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$ad['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type,video_10_sec_watched_actions,video_30_sec_watched_actions,video_p100_watched_actions,video_p25_watched_actions,video_p50_watched_actions,video_p75_watched_actions,video_p95_watched_actions,cost_per_10_sec_video_view,video_avg_percent_watched_actions,inline_post_engagement,cost_per_inline_post_engagement,objective&access_token=".$code."".$rg);
                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                    $result_b=curl_exec($cSession);
                    curl_close($cSession);
                    $ad_insights = json_decode($result_b, true); 
                    if(isset($ad_insights['data'])){ $total_amount+= $ad_insights['data'][0]['spend']; }
                    if(isset($ad_insights['data'])){ $total_freqency+= $ad_insights['data'][0]['frequency'];}
                    if(isset($ad_insights['data'])){ $total_impression+= $ad_insights['data'][0]['impressions'];}
                    if(isset($ad_insights['data'])){ $total_unq_click+= $ad_insights['data'][0]['unique_clicks'];}
                    if(isset($ad_insights['data'])){ $total_reach+= $ad_insights['data'][0]['reach'];}
                    if(isset($ad_insights['data'])){ $total_inline_link_clicks+= $ad_insights['data'][0]['inline_link_clicks'];}
                    if(isset($ad_insights['data'])){ $total_cost_per_inline_link_click+= $ad_insights['data'][0]['cost_per_inline_link_click'];} 

                        ?>
                        <tr class="ad_rows camp_<?php echo $ad['id'];?> adsets_<?php echo $ad['adset_id'];?>" id="<?php echo $ad['id'];?>"  adcreative="<?php echo @$ad['adcreatives']['data'][0]['id']; ?>">
                           	
                           	<td class="">
                                <img src="<?php echo $ad['adcreatives']['data'][0]['thumbnail_url']; ?>">
                            </td>

                            <td class="">
                                <?php echo $ad['adcreatives']['data'][0]['body']; ?>
                            </td>
                            <td>
                                <?php echo $ad['delivery_info'][ 'status']; ?>
                            </td>
                            <td>
                               <?php
                                    if(!empty($ad_insights['data'])){
                                        $type = '<p>'.str_replace('_',' ', ucfirst($ad_insights['data'][0]['objective'])).'</p>';
                                        if($ad_insights['data'][0]['objective']=='POST_ENGAGEMENT'){
                                            echo $ad_insights['data'][0]['inline_post_engagement'];

                                        }
                                        if($ad_insights['data'][0]['objective']=='LINK_CLICKS'){
                                            echo $ad_insights['data'][0]['inline_link_clicks'];    
                                        }
                                        if($ad_insights['data'][0]['objective']=='CONVERSIONS'){
                                            echo '';    
                                        }
                                        if($ad_insights['data'][0]['objective']=='PAGE_LIKES'){
                                            
                                            foreach($ad_insights['data'][0]['actions'] as $act){                               
                                                if($act['action_type']=='like'){
                                                    echo $act['value'];                                 
                                                }
                                            }
                                        
                                        }
                                        echo $type;
                                    }
                                    ?>

                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['reach'];}else{ echo '-';}?>
                            </td>
                            <td>
                               <?php
                                if(!empty($ad_insights['data'])){                  
                                    $type = '<p> Per '.str_replace('_',' ', ucfirst($ad_insights['data'][0]['objective'])).'</p>';
                                    if($ad_insights['data'][0]['objective']=='POST_ENGAGEMENT'){
                                        
                                        echo $ad_insights['data'][0]['cost_per_inline_post_engagement'];

                                    }
                                    if($ad_insights['data'][0]['objective']=='LINK_CLICKS'){
                                        echo $ad_insights['data'][0]['cost_per_inline_link_click'];    
                                    }
                                    if($ad_insights['data'][0]['objective']=='CONVERSIONS'){
                                        echo '-';   
                                    }
                                    if($ad_insights['data'][0]['objective']=='PAGE_LIKES'){                            
                                        foreach($ad_insights['data'][0]['cost_per_action_type'] as $act){                              
                                            if($act['action_type']=='like'){
                                                echo $act['value'];                                 
                                            }
                                        }                       
                                    }
                                    echo $type;                                    
                                }
                                ?>
                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['spend'];}else{ echo '-';}?>
                            </td>                           
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['frequency'];}else{ echo '-';}?>
                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['impressions'];}else{ echo '-';}?>
                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['unique_clicks'];}else{ echo '-';}?>
                            </td>
                            
                        </tr>                      
                    <?php endforeach; endif; 
        ?>
               
        </tbody>
    </table>
</div>