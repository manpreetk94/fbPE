 <table class="table table-bordered table-inverse table-striped" id="adset_table">
        <thead class="thead-default">
            <tr>
                <th>
                    <input type="checkbox" class="all_adsets_checkbox">
                </th>
                <th></th>
                <th>Ad Set Name</th>
                <th>Delivery </th>
                <th>Results </th>
                <th>Reach </th>
                <th>Cost per Result </th>
                <th>Budget </th>
                <th>Amount Spent </th>
                <th>Ends     </th>
                <th>Schedule </th>
                <th>Frequency </th>
                <th>Impressions </th>
                <th>Unique Link Clicks </th>
                <th> Clicks </th>
                <th> CPC    </th>
                <th> CTR    </th>
                <th> People Taking Action </th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
                $total_adset+= count($adsets['data']); 
                if(!empty($adsets['data'])):
                foreach ($adsets['data'] as $adsets) : 


                    /*for insights*/
                    $cSession = curl_init();                     
                    if($_SESSION['time_range']['since']!='Invalid date'){
                        $rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
                    }else{
                        //$rg="&period=lifetime";
                        $rg="&date_preset=lifetime";
                    }
                    
                    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$adsets['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type,video_10_sec_watched_actions,video_30_sec_watched_actions,video_p100_watched_actions,video_p25_watched_actions,video_p50_watched_actions,video_p75_watched_actions,video_p95_watched_actions,cost_per_10_sec_video_view,video_avg_percent_watched_actions,inline_post_engagement,cost_per_inline_post_engagement,objective,cpc,total_unique_actions,clicks&access_token=".$code."".$rg);
                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                    $result_b=curl_exec($cSession);
                    curl_close($cSession);
                    $adset_inights = json_decode($result_b, true); 
                    if(isset($adset_inights['data'])){ $total_amount+= $adset_inights['data'][0]['spend']; }
                    if(isset($adset_inights['data'])){ $total_freqency+= $adset_inights['data'][0]['frequency'];}
                    if(isset($adset_inights['data'])){ $total_impression+= $adset_inights['data'][0]['impressions'];}
                    if(isset($adset_inights['data'])){ $total_unq_click+= $adset_inights['data'][0]['unique_clicks'];}
                    if(isset($adset_inights['data'])){ $total_reach+= $adset_inights['data'][0]['reach'];}
                    if(isset($adset_inights['data'])){ $total_inline_link_clicks+= $adset_inights['data'][0]['inline_link_clicks'];}
                    if(isset($adset_inights['data'])){ $total_cost_per_inline_link_click+= $adset_inights['data'][0]['cost_per_inline_link_click'];} 
                    
                    if(isset($adset_inights['data'])){ $total_clicks+= $adset_inights['data'][0]['clicks'];} 
                    if(isset($adset_inights['data'])){ $total_cpc+= $adset_inights['data'][0]['cpc'];} 
                    if(isset($adset_inights['data'])){ $total_ctr+= $adset_inights['data'][0]['ctr'];} 
                    if(isset($adset_inights['data'])){ $total_total_unique_actions+= $adset_inights['data'][0]['total_unique_actions'];} 


                    ?>
            <tr id="<?php echo $adsets['id'];?>" class="adset_rows camp_<?php echo $adsets['campaign_id'];?>">
                <td>
                    <input type="checkbox" name="" class="adsets_checkbox">
                </td>
                <td>
                    <input type="checkbox" <?php if($adsets['status']=='ACTIVE' ) { echo "checked"; }?> class="adsets_status" data-toggle="toggle" data-size="mini"></td>
                <td class="editable-row">
                    <a href="#">
                         <div class="show-camp-row">
                            <?php echo $adsets['name']; ?> <span class="edit-row-title"><i class="fa fa-pencil edit-camp-btn" aria-hidden="true"></i></span>
                        </div>
                        <div class="hide-camp-row">
                            <input class="form-control editable-input" value="<?php echo $adsets['name']; ?>">
                        </div>
                    </a>
                    <div class="row-editing-icons">
                        <a href="#" class="view-charts" data-id="#view-tab"><i class="fa fa-bar-chart" aria-hidden="true"></i> View Chart</a>
                        <a href="#" class="edit-charts" data-id="#edit-tab"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                        <a href="#duplicate-adSet" data-toggle="modal"><i class="fa fa-copy" aria-hidden="true"></i> Duplicate</a>
                    </div>
                </td>
                <td>
                    <?php echo $adsets['delivery_info']['status'];?>
                </td>
                <td>
                   <?php
                    if(!empty($adset_inights['data'])){
                       // $type = '<p>'.str_replace('_',' ', ucfirst($adset_inights['data'][0]['objective'])).'</p>';
                        if($adset_inights['data'][0]['objective']=='POST_ENGAGEMENT'){
                            echo $adset_inights['data'][0]['inline_post_engagement'];

                        }
                        if($adset_inights['data'][0]['objective']=='LINK_CLICKS'){
                            echo $adset_inights['data'][0]['inline_link_clicks'];    
                        }
                        if($adset_inights['data'][0]['objective']=='CONVERSIONS'){
                            echo '';    
                        }
                        if($adset_inights['data'][0]['objective']=='PAGE_LIKES'){
                            if(!empty($adset_inights['data'][0]['actions'] )){
                                foreach($adset_inights['data'][0]['actions'] as $act){                               
                                    if($act['action_type']=='like'){
                                        echo $act['value'];                                 
                                    }
                                }
                            }                        
                        }
                       // echo $type;
                    }
                    echo $type = '<p>'.str_replace('_',' ', ucfirst($adsets['objective_for_results'])).'</p>'; 
                    ?>

                </td>
                <td>
                    <?php echo $adset_inights['data'][0]['reach']; ?> 
                </td>
                <td>
                     <?php
                    if(!empty($adset_inights['data'])){                  
                        //$type = '<p> Per '.str_replace('_',' ', ucfirst($adset_inights['data'][0]['objective'])).'</p>';
                        if($adset_inights['data'][0]['objective']=='POST_ENGAGEMENT'){
                            
                            echo $adset_inights['data'][0]['cost_per_inline_post_engagement'];

                        }
                        if($adset_inights['data'][0]['objective']=='LINK_CLICKS'){
                            echo $adset_inights['data'][0]['cost_per_inline_link_click'];    
                        }
                        if($adset_inights['data'][0]['objective']=='CONVERSIONS'){
                            echo '-';   
                        }
                        if($adset_inights['data'][0]['objective']=='PAGE_LIKES'){ 
                            if(!empty($adset_inights['data'][0]['cost_per_action_type'] )){                           
                                foreach($adset_inights['data'][0]['cost_per_action_type'] as $act){                              
                                    if($act['action_type']=='like'){
                                        echo $act['value'];                                 
                                    }
                                } 
                            }                      
                        }
                      //  echo $type;
                        
                    }
                      echo $type = '<p> Per '.str_replace('_',' ', ucfirst($adsets['objective_for_results'])).'</p>'; 

                    ?>
                </td>
                <td>
                    <?php
                    if($adsets['daily_budget']==0){
                        echo '$'.$adsets['lifetime_budget']/100;
                        echo '<p>Lifetime Budget</p>';
                    }
                     if($adsets['lifetime_budget']==0){
                        echo '$'.$adsets['daily_budget']/100;
                        echo '<p>Daily Budget</p>';
                    }
                ?>
                </td>
                <td>
                    <?php if($adset_inights['data'][0]['spend']){ echo '$'.$adset_inights['data'][0]['spend']; } else { echo '$0'; } ?>
                </td>
                <td>
                    <?php if(isset($adsets['end_time'])){echo $start_date=date_format(date_create($adsets['end_time']), ' j F, Y');}else{ echo 'Ongoing';}?>

                </td>
                <td>
                    <?php echo $start_date=date_format(date_create($adsets['start_time']), ' j F, Y');?>-
                    <?php if(isset($adsets['end_time'])){echo $start_date=date_format(date_create($adsets['end_time']), ' j F, Y');
                        $interval = date_diff(date_create($adsets['start_time']), date_create($adsets['end_time']));                        
                        echo '<p>'.($interval->format('%R%a')+1) .'days</p>';

                    }else{ echo 'Ongoing';}?>
                </td>
                <td>
                    <?php if(isset($adset_inights['data'])){echo round($adset_inights['data'][0]['frequency'],2); }else echo '-';?>
                </td>
                <td>
                    <?php if(isset($adset_inights['data'])){echo $adset_inights['data'][0]['impressions']; }else echo '-'; ?> </td>
                <td>
                    <?php if(isset($adset_inights['data'])){ echo $adset_inights['data'][0]['unique_clicks']; }else echo '-';?> </td>
                </td>

                <td>
                    <?php if(isset($adset_inights['data'])){echo $adset_inights['data'][0]['clicks'];}else{ echo '-';}?>
                </td>
                <td>
                    <?php if(isset($adset_inights['data'])){echo $adset_inights['data'][0]['cpc'];}else{ echo '-';}?>
                </td>
                <td>
                    <?php if(isset($adset_inights['data'])){echo $adset_inights['data'][0]['ctr'];}else{ echo '-';}?>
                </td>
                <td>
                    <?php if(isset($adset_inights['data'])){echo $adset_inights['data'][0]['total_unique_actions'];}else{ echo '-';}?>
                </td>
                </tr>



               <?php
                /* breakdown start */
                  if(isset($breakdown) && isset($breakdown_type)){

                    if($breakdown_type=='time_range'){
                        if(!empty($adsets['insights']['data'])){
                        $range=json_encode(array('since'=>$adsets['insights']['data'][0]['date_start'],'until'=>$adsets['insights']['data'][0]['date_stop']));
                        $breakdown=$rg.'&time_increment='.$breakdown;
                       
                        }
                    }

                  
                    $cSession = curl_init(); 
                    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$adsets['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,inline_post_engagement,cost_per_inline_post_engagement,cost_per_action_type,objective,clicks,cpc,ctr,total_unique_actions&".$breakdown_type."=".$breakdown."&access_token=".$code."");
                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                    $result_b=curl_exec($cSession);
                    curl_close($cSession);
                    $breaks = json_decode($result_b, true);                  
                    //echo '<pre>';
                    //print_r($breaks);
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
                                        </tr>
                                        <?php
                                    endif;
                                endforeach;
                            endif;

                                ?>
                            <?php if(count($breaks['data'])>1): ?>      
                            <tr class="adset_rows" >
                                <td> </td>
                                <td></td>
                                <td class="editable-row">
                                   <?php if($breakdown_type=='time_range'){ echo $brk['date_start'] .'-'.$brk['date_stop']; }else{  echo $brk[$breakdown]; } ?>
                                </td>
                                <td>- </td>
                                <td>  <?php
                                    if(!empty($brk['inline_link_clicks'])){
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
                                    }
                                    ?> </td>
                                <td> <?php echo @$brk['reach'];?></td>
                                <td> <?php
                                        if(!empty($brk['data'])){                   
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
                                            
                                        }

                                        ?> </td>
                                <td> - </td>
                                <td> <?php echo @$brk['spend'];?> </td>
                                <td> - </td>
                                <td> - </td>
                                <td> <?php echo @$brk['frequency']; ?></td>
                                <td>  <?php echo @$brk['impressions']; ?>  </td>
                                <td> <?php echo @$brk['unique_clicks']; ?> </td>
                                </td>
                                    <?php echo @$brk['clicks']; ?>
                                </td>
                                <td>                             
                                    <?php echo @$brk['cpc']; ?>
                                 
                                </td>
                                <td>
                                    <?php echo @$brk['ctr']; ?>
                                 
                                </td>                            
                                <td>
                                    <?php echo $brk['total_unique_actions']; ?>
                                </td>
                            </tr>
                            <?php
                            endif;
                        endforeach;
                    endif;
                }
                /* breakdown end */
            ?>

            <?php endforeach; endif;  ?>
            <?php if($total_adset> 0 ) : ?>
            <tr>
                <td colspan="2"></td>
                <td>Results from
                    <?php echo $total_adset; ?> ad set</td>
                <td></td>
                <td><?php if($total_inline_link_clicks) { echo $total_inline_link_clicks; } else { echo 'Link Click'; } ?></td>
                <td><?php if($total_reach) { echo $total_reach; } else { echo 'People'; } ?></td>
                <td><?php if($total_cost_per_inline_link_click) { echo '$'.$total_cost_per_inline_link_click; } else { echo 'Per link click'; } ?></td>

                <td></td>
                <td><?php if($total_amount) { echo '$'.$total_amount; } else { echo '—Total'; } ?></td>
                <td></td>
                <td></td>
                <td><?php if($total_freqency) { echo $total_freqency; } else { echo '—Per Person'; } ?></td>
                <td><?php if($total_impression) { echo $total_impression; } else { echo '—Total'; } ?></td>
                <td><?php if($total_unq_click) { echo $total_unq_click; } else { echo '—Total'; } ?></td>

                <td><?php if($total_clicks) { echo $total_clicks; } else { echo '—Total'; } ?></td>
                <td><?php if($total_cpc) { echo $total_cpc; } else { echo '—Total'; } ?></td>
                <td><?php if($total_ctr) { echo $total_ctr; } else { echo '—Total'; } ?></td>
                <td><?php if($total_total_unique_actions) { echo $total_total_unique_actions; } else { echo '—Total'; } ?></td>
                
            </tr>
            <?php else : ?>
            <tr>
                <td colspan="14" align="center"><b>No Result Found</b>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>    
    </table>