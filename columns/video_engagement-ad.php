  <table class="table table-bordered table-inverse table-striped" id="ad_table">
        <thead class="thead-default">
            <tr>
                <th>
                    <input type="checkbox" class="all_ad_checkbox">
                </th>
                <th></th>
               <th colspan="2">Ad Name</th>
                <th>Delivery </th>
                <th>Impressions </th>
                <th>10- Second Video View </th>
                <th>Cost Per 10- Second Video View </th>
                <th>30- Second Video View </th>
                <th>Reach </th>
                <th>Amount Spent </th>
                <th>Video Percentage Watched </th>
                <th>Video Watched at 25 %  </th>
                <th>Video Watched at 50 %  </th>
                <th>Video Watched at 75 %  </th>
                <th>Video Watched at 95 %  </th>
                <th>Video Watched at 100 % </th>
            </tr>
        </thead>
        <tbody>

            <?php
               
                $total_ads+= count($ads['data']); 
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

                    if(isset($ad_insights['data'])){ $total_impression+= $ad_insights['data'][0]['impressions'];}
                    if(isset($ad_insights['data'])){ $total_video_10_sec_watched_actions+= $ad_insights['data'][0]['video_10_sec_watched_actions'][0]['value']; }
                    if(isset($ad_insights['data'])){ $total_cost_per_10_sec_video_view+= $ad_insights['data'][0]['cost_per_10_sec_video_view'][0]['value']; }
                    if(isset($ad_insights['data'])){ $video_30_sec_watched_actions+= $ad_insights['data'][0]['video_30_sec_watched_actions'][0]['value']; }
                    if(isset($ad_insights['data'])){ $total_reach+= $ad_insights['data'][0]['reach'];}
                    if(isset($ad_insights['data'])){ $total_amount+= $ad_insights['data'][0]['spend']; }

                    if(isset($ad_insights['data'])){ $total_video_avg_percent_watched_actions+= $ad_insights['data'][0]['video_avg_percent_watched_actions'][0]['value']; }

                    if(isset($ad_insights['data'])){ $total_video_p25_watched_actions+= $ad_insights['data'][0]['video_p25_watched_actions'][0]['value']; }
                    if(isset($ad_insights['data'])){ $total_video_p50_watched_actions+= $ad_insights['data'][0]['video_p50_watched_actions'][0]['value']; }
                    if(isset($ad_insights['data'])){ $total_video_p75_watched_actions+= $ad_insights['data'][0]['video_p75_watched_actions'][0]['value']; }
                   if(isset($ad_insights['data'])){ $total_video_p95_watched_actions+= $ad_insights['data'][0]['video_p95_watched_actions'][0]['value']; }
                   if(isset($ad_insights['data'])){ $total_video_p100_watched_actions+= $ad_insights['data'][0]['video_p100_watched_actions'][0]['value']; }

                        ?>
                        <tr class="ad_rows camp_<?php echo $ads['campaign_id'];?> adsets_<?php echo $ads['adset_id']?>" id="<?php echo $ad['id'];?>"  adcreative="<?php echo @$ad['adcreatives']['data'][0]['id']; ?>">
                            <td>
                                <input type="checkbox" name="" class="ad_checkbox">
                            </td>
                            <td>
                                <input type="checkbox" <?php if($ad['status']=='ACTIVE' ) { echo "checked"; }?> class="ad_status" data-toggle="toggle" data-size="mini"></td>
                             <td style="width:22px;">
                                <img src="<?php echo $ad['adcreatives']['data'][0]['thumbnail_url']; ?>">
                            </td>
                            <td class="editable-row">
                                <a href="#">
                                    <div class="show-camp-row">
                                        <?php echo $ad['name']; ?> <span class="edit-row-title"><i class="fa fa-pencil edit-camp-btn" aria-hidden="true"></i></span>
                                    </div>
                                    <div class="hide-camp-row">
                                        <input class="form-control editable-input" value="<?php echo $ad['name']; ?>">
                                    </div>
                                </a>
                                <div class="row-editing-icons">
                                    <a href="#"  class="view-charts" data-id="#view-tab"><i class="fa fa-bar-chart" aria-hidden="true"></i> View Chart</a>
                                    <a href="#"  class="edit-charts" data-id="#edit-tab"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                    <a href="#duplicate-adSet" data-toggle="modal"><i class="fa fa-copy" aria-hidden="true"></i> Duplicate</a>
                                </div>
                            </td>
                            <td>
                                <?php echo $ad['delivery_info'][ 'status']; ?>
                            </td>
                            <td>                
                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['impressions'];}else{ echo '';}?>
                            </td>  
                            <td>                    
                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['video_10_sec_watched_actions'][0]['value'];}else{ echo '';} ?>
                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['cost_per_10_sec_video_view'][0]['value'];}else{ echo '';}?>
                            
                            </td>
                            <td>
                            <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['video_30_sec_watched_actions'][0]['value'];}else{ echo '';}?>

                            </td>

                             <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['reach'];}else{ echo '-';}?>
                            </td>
                           
                            <td>
                                <?php if(isset($ad_insights['data'][0]['spend'])){echo '$'.$ad_insights['data'][0]['spend'];}else{ echo '-';}?>
                            </td>
                            <td>
                                
                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['video_avg_percent_watched_actions'][0]['value'];}else{ echo '';}?>
                                </td>
                            </td>
                            <td>

                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['video_p25_watched_actions'][0]['value'];}else{ echo '';}?>
                                </td>

                            <td>
                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['video_p50_watched_actions'][0]['value'];}else{ echo '';}?>
                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['video_p75_watched_actions'][0]['value'];}else{ echo '';}?>
                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['video_p95_watched_actions'][0]['value'];}else{ echo '';}?>
                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo @$ad_insights['data'][0]['video_p100_watched_actions'][0]['value'];}else{ echo '';}?>
                            </td>
                        </tr>

                        <?php
                            /* breakdown start */                
                           if(isset($breakdown) && isset($breakdown_type)){      

                            if($breakdown_type=='time_range'){
                                if(!empty($ad['insights']['data'])){
                                $range=json_encode(array('since'=>$ad['insights']['data'][0]['date_start'],'until'=>$ad['insights']['data'][0]['date_stop']));
                                $breakdown=$rg.'&time_increment='.$breakdown;
                                
                                }
                            }             
                                $cSession = curl_init(); 
                                curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$ad['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,inline_post_engagement,cost_per_inline_post_engagement,cost_per_action_type,objective&".$breakdown_type."=".$breakdown."&access_token=".$code."");
                                curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                                curl_setopt($cSession,CURLOPT_HEADER, false); 
                                $result_b=curl_exec($cSession);
                                curl_close($cSession);
                                $breaks = json_decode($result_b, true);                  
                                if(!empty($breaks['data'])):                       
                                    foreach($breaks['data'] as $brk): 
                                        if(!empty($brk['actions']) && $breakdown_type=='action_breakdowns'):
                                            foreach($brk['actions'] as $br_action): 
                                                if(isset($br_action[$breakdown])) : ?>
                                                     <tr class="camp_rows" ">
                                                        <td></td>
                                                        <td></td>
                                                        <td class="editable-row">
                                                           <?php echo $br_action[$breakdown]; ?>
                                                        </td>
                                                        <td></td>
                                                        <td><?php echo @$br_action['value']; ?></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php if(count($breaks['data'])>1): ?>      
                                         <tr class="ad_rows" ">
                                            <td> </td>
                                            <td></td>
                                            <td class="editable-row">
                                               <?php if($breakdown_type=='time_range'){ echo $brk['date_start'] .'-'.$brk['date_stop']; }else{  echo $brk[$breakdown]; } ?>
                                            </td>
                                            <td> </td>
                                           <td>             
                                                <?php echo @$brk['impressions'];?>
                                            </td>  
                                            <td>                    
                                                <?php echo @$brk['video_10_sec_watched_actions'][0]['value']; ?>
                                            </td>
                                            <td>
                                                <?php echo @$brk['cost_per_10_sec_video_view'][0]['value'];?>                           
                                            </td>
                                            <td>
                                                <?php echo @$brk['video_30_sec_watched_actions'][0]['value'];?>
                                            </td>
                                            <td>
                                                <?php echo $brk['reach'];?>
                                            </td>                          
                                            <td>
                                                <?php echo '$'.$brk['spend']; ?>
                                            </td>
                                            <td>
                                                <?php echo @$brk['video_avg_percent_watched_actions'][0]['value'];?>
                                                
                                            </td>
                                            <td>
                                                <?php echo @$brk['video_p25_watched_actions'][0]['value'];?>
                                            </td>

                                            <td>
                                                <?php echo @$brk['video_p50_watched_actions'][0]['value'];?>
                                            </td>
                                            <td>
                                                <?php echo @$brk['video_p75_watched_actions'][0]['value']; ?>
                                            </td>
                                            <td>
                                                <?php echo @$brk['video_p95_watched_actions'][0]['value']; ?>
                                            </td>
                                            <td>
                                                <?php echo @$brk['video_p100_watched_actions'][0]['value']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                        endif;
                                    endforeach;
                                endif;
                            } 
                            /* breakdown end */
                        ?>
                    <?php endforeach; endif; 
                ?>
                <?php if($total_ads> 0) : ?>
                <tr>
                    <td colspan="2"></td>
                    <td>Results from
                        <?php echo $total_ads; ?> ad</td>
                    <td></td>
                    <td><?php if($total_impression) { echo $total_impression; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_video_10_sec_watched_actions) { echo $total_video_10_sec_watched_actions; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_cost_per_10_sec_video_view) { echo $total_cost_per_10_sec_video_view; } else { echo '—Total'; } ?></td>
                    <td><?php if($video_30_sec_watched_actions) { echo $video_30_sec_watched_actions; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_reach) { echo $total_reach; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_amount) { echo $total_amount; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_video_avg_percent_watched_actions) { echo $total_video_avg_percent_watched_actions; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_video_p25_watched_actions) { echo $total_video_p25_watched_actions; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_video_p50_watched_actions) { echo $total_video_p50_watched_actions; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_video_p75_watched_actions) { echo $total_video_p75_watched_actions; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_video_p95_watched_actions) { echo $total_video_p95_watched_actions; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_video_p100_watched_actions) { echo $total_video_p100_watched_actions; } else { echo '—Total'; } ?></td>
                
                </tr>
                <?php else : ?>
                <tr>
                    <td colspan="15" align="center"><b>No Result Found</b>
                    </td>
                </tr>
                <?php endif; ?>
        </tbody>
    </table>