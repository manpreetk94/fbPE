  <table class="table table-bordered table-inverse table-striped" id="ad_table">
        <thead class="thead-default">
            <tr>
                <th>
                    <input type="checkbox" class="all_ad_checkbox">
                </th>
                <th></th>
                <th colspan="2">Ad Name</th>
                <th>Delivery </th>
                <th>Results </th>
                <th>Reach </th>
                <th>Cost per Result </th>
                <th>Amount Spent </th>
                <!-- <th>Ends </th> -->
                <th>Relevance </th>
                <th>Frequency </th>
                <th>Impressions </th>
                <th>Unique Link Clicks </th>
                <th>Button Clicks </th>
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
                    
                    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$ad['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type,video_10_sec_watched_actions,video_30_sec_watched_actions,video_p100_watched_actions,video_p25_watched_actions,video_p50_watched_actions,video_p75_watched_actions,video_p95_watched_actions,cost_per_10_sec_video_view,video_avg_percent_watched_actions,inline_post_engagement,cost_per_inline_post_engagement,objective,relevance_score,total_unique_actions&access_token=".$code."".$rg);
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

                    if(isset($ad_insights['data'])){ $total_unique_actions+= $ad_insights['data'][0]['total_unique_actions'];} 

                        ?>
                        <tr class="ad_rows camp_<?php echo $ad['campaign_id'];?> adsets_<?php echo $ad['adset_id'];?>" id="<?php echo $ad['id'];?>"  adcreative="<?php echo @$ad['adcreatives']['data'][0]['id']; ?>">
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
                                        <input class="form-control editable-input" value='<?php echo $ad['name']; ?>'>
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
                               <?php
                                    if(!empty($ad_insights['data'])){
                                       // $type = '<p>'.str_replace('_',' ', ucfirst($ad_insights['data'][0]['objective'])).'</p>';
                                        if($ad_insights['data'][0]['objective']=='POST_ENGAGEMENT'){
                                            echo $ad_insights['data'][0]['inline_post_engagement'];

                                        }
                                        if($ad_insights['data'][0]['objective']=='LINK_CLICKS'){
                                            echo $ad_insights['data'][0]['inline_link_clicks'];    
                                        }
                                        if($ad_insights['data'][0]['objective']=='CONVERSIONS'){
                                            echo '-';    
                                        }
                                        if($ad_insights['data'][0]['objective']=='PAGE_LIKES'){
                                            if(!empty($ad_insights['data'][0]['actions'])){    
                                                foreach($ad_insights['data'][0]['actions'] as $act){                               
                                                    if($act['action_type']=='like'){
                                                        echo $act['value'];                                 
                                                    }
                                                }
                                            }
                                        
                                        }
                                       
                                    }else{
                                         echo '-'; 
                                    }

                                    echo $type = '<p>'.str_replace('_',' ', ucfirst($ad['objective_for_results'])).'</p>'; 
                                    ?>

                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['reach'];}else{ echo '-';}?>
                            </td>
                            <td>
                               <?php
                                if(!empty($ad_insights['data'])){                  
                                   // $type = '<p> Per '.str_replace('_',' ', ucfirst($ad_insights['data'][0]['objective'])).'</p>';
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
                                        if(!empty($ad_insights['data'][0]['cost_per_action_type'])){                              
                                            foreach($ad_insights['data'][0]['cost_per_action_type'] as $act){                              
                                                if($act['action_type']=='like'){
                                                    echo $act['value'];                                 
                                                }
                                            } 
                                        }                      
                                    }
                                  //  echo $type;                                    
                                } else {
                                     echo '-';                                     
                                }

                                   echo $type = '<p> Per '.str_replace('_',' ', ucfirst($ad['objective_for_results'])).'</p>';

                                ?>
                            </td>
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['spend'];}else{ echo '-';}?>
                            </td>
                          <!--   <td>Ongoing-</td> -->
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['relevance_score'][ 'score'];}else{ echo '-';}?>
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
                            <td>
                                <?php if(isset($ad_insights['data'])){echo $ad_insights['data'][0]['total_unique_actions'];}else{ echo '-';}?>
                            </td>
                        </tr>

                        <?php
                            /* breakdown start */                
                           if(isset($breakdown) && isset($breakdown_type)){      

                             if($breakdown_type=='time_range'){
                                /*  if(!empty($camapaign['insights']['data'])){
                                    $range=json_encode(array('since'=>$camapaign['insights']['data'][0]['date_start'],'until'=>$camapaign['insights']['data'][0]['date_stop']));*/
                                    $breakdown=$rg.'&time_increment='.$breakdown;
                                    //}
                                }else{
                                    
                                    $else=$rg;

                                }             
                                $cSession = curl_init(); 
                                curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$ad['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,inline_post_engagement,cost_per_inline_post_engagement,cost_per_action_type,total_unique_actions,objective&".$breakdown_type."=".$breakdown."&access_token=".$code.$else);
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
                                                     <tr class="camp_rows" >
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
                                                          <td></td>
                                                            <td></td>
                                                         
                                                              
                                                    </tr>
                                                    <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php if(count($breaks['data'])>1): ?>      
                                         <tr class="ad_rows" >
                                            <td> </td>
                                            <td></td>
                                            <td class="editable-row" colspan="2">
                                               <?php if($breakdown_type=='time_range'){ echo $brk['date_start'] .'-'.$brk['date_stop']; }else{ 
                                                    if($breakdown=='age,gender'){
                                                        echo $brk['age'].'  '.$brk['gender'];
                                                    }else{
                                                        echo $brk[$breakdown]; 
                                                        } 
                                                    } 
                                                ?>
                                            </td>
                                            <td>- </td>
                                            <td> 
                                             <?php
                                               // if(!empty($brk['inline_link_clicks'])){
                                                    $type = '<p>'.str_replace('_',' ', ucfirst($brk['objective'])).'</p>';
                                                    if($brk['objective']=='POST_ENGAGEMENT'){
                                                        echo $brk['inline_post_engagement'];

                                                    }
                                                    if($brk['objective']=='LINK_CLICKS'){
                                                        echo $brk['inline_link_clicks'];    
                                                    }
                                                    if($brk['objective']=='CONVERSIONS'){
                                                        echo '';    
                                                    }
                                                    if($brk['objective']=='PAGE_LIKES'){
                                                        if(!empty($brk['actions'])){
                                                            foreach($brk['actions'] as $act){                               
                                                                if($act['action_type']=='like'){
                                                                    echo $act['value'];                                 
                                                                }
                                                            }
                                                        }
                                                    
                                                    }
                                                    echo $type;
                                               // }
                                                ?>  
                                            </td>
                                            <td> <?php echo @$brk['reach'];?></td>
                                            <td> <?php
                                                    //if(!empty($brk['data'])){                   
                                                        $type = '<p> Per '.str_replace('_',' ', ucfirst($brk['objective'])).'</p>';
                                                        if($brk['objective']=='POST_ENGAGEMENT'){
                                                            
                                                            echo $brk['cost_per_inline_post_engagement'];

                                                        }
                                                        if($brk['objective']=='LINK_CLICKS'){
                                                            echo $brk['cost_per_inline_link_click'];    
                                                        }
                                                        if($brk['objective']=='CONVERSIONS'){
                                                            echo '-';   
                                                        }
                                                        if($brk['objective']=='PAGE_LIKES'){   
                                                           if(!empty($brk['cost_per_action_type'])){                         
                                                                foreach($brk['cost_per_action_type'] as $act){                              
                                                                    if($act['action_type']=='like'){
                                                                        echo $act['value'];                                 
                                                                    }
                                                                }
                                                            }                       
                                                        }
                                                        echo $type;
                                                        
                                                    //}

                                                    ?>  
                                            </td>
                                            
                                            <td> <?php echo @$brk['spend'];?> </td>
                                            <td> - </td>
                                         
                             
                                            <td> <?php echo @$brk['frequency']; ?></td>
                                            <td>  <?php echo @$brk['impressions']; ?>  </td>
                                            <td> <?php echo @$brk['unique_clicks']; ?> </td>
                                            <td> <?php echo @$brk['total_unique_actions']; ?> </td>
                                            

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
                    <td></td>
                    <td><?php if($total_inline_link_clicks) { echo $total_inline_link_clicks; } else { echo 'Link Click'; } ?></td>
                    <td><?php if($total_reach) { echo $total_reach; } else { echo 'People'; } ?></td>
                    <td><?php if($total_cost_per_inline_link_click) { echo '$'.$total_cost_per_inline_link_click; } else { echo 'Per link click'; } ?></td> 
                    <td><?php if($total_amount) { echo '$'.$total_amount; } else { echo '—Total'; } ?></td>
                    
                    <td></td>
                    
                    <td><?php if($total_freqency) { echo $total_freqency; } else { echo '—Per Person'; } ?></td>
                    <td><?php if($total_impression) { echo $total_impression; } else { echo '—Total'; } ?></td>
                     <td><?php if($total_unq_click) { echo $total_unq_click; } else { echo '—Total'; } ?></td>
                    <td><?php if($total_unique_actions) { echo $total_unique_actions; } else { echo '—Total'; } ?></td>
                </tr>
                <?php else : ?>
                <tr>
                    <td colspan="15" align="center"><b>No Result Found</b>
                    </td>
                </tr>
                <?php endif; ?>
        </tbody>
    </table>