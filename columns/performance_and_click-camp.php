<table class="table table-bordered table-inverse table-striped table-hover" id="camapaign_table">
	    <thead class="thead-default">
	        <tr>
	        	<th>
	        		<input type="checkbox" name="" class="all_camapaign_checkbox">
	        	</th>
	        	<th></th>
	        	<th>Campaign Name</th>
	        	<th>Delivery </th>
	        	<th>Results </th>
	        	<th>Reach </th>
	        	<th>Cost per Result </th>
	        	<th>Amount Spent </th>
	        	<th>Ends </th>
	        	<th>Frequency </th>
	        	<th>Impressions </th>
	        	<th>Unique Link Clicks </th>
	        	<th> Clicks </th>
	        	<th> CPC    </th>
	        	<th> CTR    </th>
	        	<th> People Taking Action </th>
	        </tr>
	    </thead>
	    <tbody id="camapaign_listing">
	        <?php if(count($camapaigns['data'])> 0): foreach ($camapaigns['data'] as $camapaign): 
                
                  	/*for insights*/
                  	$cSession = curl_init();                     
                    if($_SESSION['time_range']['since']!='Invalid date'){
						$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
					}else{
						$rg="&date_preset=lifetime";
					}
					
                    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$camapaign['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,cost_per_action_type,video_10_sec_watched_actions,video_30_sec_watched_actions,video_p100_watched_actions,video_p25_watched_actions,video_p50_watched_actions,video_p75_watched_actions,video_p95_watched_actions,cost_per_10_sec_video_view,video_avg_percent_watched_actions,inline_post_engagement,cost_per_inline_post_engagement,objective,cpc,clicks,total_unique_actions&access_token=".$code."".$rg);
                    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($cSession,CURLOPT_HEADER, false); 
                    $result_b=curl_exec($cSession);
                    curl_close($cSession);
                    $camp_inights = json_decode($result_b, true);
                  

                    if(isset($camp_inights['data'])){ $total_amount+= $camp_inights['data'][0]['spend']; }
	                if(isset($camp_inights['data'])){ $total_freqency+= $camp_inights['data'][0]['frequency'];}
	                if(isset($camp_inights['data'])){ $total_impression+= $camp_inights['data'][0]['impressions'];}
	                if(isset($camp_inights['data'])){ $total_unq_click+= $camp_inights['data'][0]['unique_clicks'];}
	                if(isset($camp_inights['data'])){ $total_reach+= $camp_inights['data'][0]['reach'];}
	                if(isset($camp_inights['data'])){ $total_inline_link_clicks+= $camp_inights['data'][0]['inline_link_clicks'];}
	                if(isset($camp_inights['data'])){ $total_cost_per_inline_link_click+= $camp_inights['data'][0]['cost_per_inline_link_click'];} 
	                if(isset($camp_inights['data'])){ $total_clicks+= $camp_inights['data'][0]['clicks'];} 
	                if(isset($camp_inights['data'])){ $total_cpc+= $camp_inights['data'][0]['cpc'];} 
	                if(isset($camp_inights['data'])){ $total_ctr+= $camp_inights['data'][0]['ctr'];} 
	                if(isset($camp_inights['data'])){ $total_total_unique_actions+= $camp_inights['data'][0]['total_unique_actions'];} 

            ?>

         
	        <tr class="camp_rows" id="<?php echo $camapaign['id'];?>">
	            <td>
	                <input type="checkbox" name="" class="campaigns_checkbox">
	            </td>
	            <td>
	                <input type="checkbox" <?php if($camapaign['status']=='ACTIVE' ) { echo 'checked'; } ?> class="campaigns_status" data-toggle="toggle" data-size="mini">
	            </td>
	            <td class="editable-row">
	                <a href="#">
                        <div class="show-camp-row">
	                    <?php echo $camapaign['name']; ?> <span class="edit-row-title"><i class="fa fa-pencil edit-camp-btn" aria-hidden="true"></i></span>
                        </div>
                        <div class="hide-camp-row">
                            <input class="form-control editable-input" value="<?php echo $camapaign['name']; ?>">
                        </div>
	                </a>
	                <div class="row-editing-icons">
	                    <a href="#" class="view-charts" data-id="#view-tab"><i class="fa fa-bar-chart" aria-hidden="true"></i> View Chart</a>
	                    <a href="#" class="edit-charts" data-id="#edit-tab"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
	                    <a href="#duplicate-campaign" data-toggle="modal" class="duplicate-campaign"><i class="fa fa-copy" aria-hidden="true"></i> Duplicate</a>
	                </div>
	            </td>
	            <td>
	                <?php echo $camapaign['delivery_info']['status'];?>
	            </td>
	            <td>
	                
	                <?php
	                if(!empty($camp_inights['data'])){
	                	$type = '<p>'.str_replace('_',' ', ucfirst($camp_inights['data'][0]['objective'])).'</p>';
	                	if($camp_inights['data'][0]['objective']=='POST_ENGAGEMENT'){
	                		echo $camp_inights['data'][0]['inline_post_engagement'];

	                	}
	                	if($camp_inights['data'][0]['objective']=='LINK_CLICKS'){
	                		echo $camp_inights['data'][0]['inline_link_clicks'];	
	                	}
	                	if($camp_inights['data'][0]['objective']=='CONVERSIONS'){
	                		echo '';	
	                	}
	                	if($camp_inights['data'][0]['objective']=='PAGE_LIKES'){
	                		if(!empty($camp_inights['data'][0]['actions'])){
		                		foreach($camp_inights['data'][0]['actions'] as $act){	                			
		                			if($act['action_type']=='like'){
		                				echo $act['value'];	                				
		                			}
		                		}
		                	}
	                	
	                	}
	                //	echo $type;
	                }
	                 echo $type = '<p>'.str_replace('_',' ', ucfirst($adsets['objective_for_results'])).'</p>'; 
	                ?>
	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'])){echo $camp_inights['data'][0]['reach'];}else{ echo '-';}?>
	            </td>
	            <td>
	                <?php
	                if(!empty($camp_inights['data'])){	                
	                	$type = '<p> Per '.str_replace('_',' ', ucfirst($camp_inights['data'][0]['objective'])).'</p>';
	                	if($camp_inights['data'][0]['objective']=='POST_ENGAGEMENT'){
	                		
	                		echo $camp_inights['data'][0]['cost_per_inline_post_engagement'];

	                	}
	                	if($camp_inights['data'][0]['objective']=='LINK_CLICKS'){
	                		echo $camp_inights['data'][0]['cost_per_inline_link_click'];	
	                	}
	                	if($camp_inights['data'][0]['objective']=='CONVERSIONS'){
	                		echo '-';	
	                	}
	                	if($camp_inights['data'][0]['objective']=='PAGE_LIKES'){
	                		if(!empty($camp_inights['data'][0]['cost_per_action_type'])){	                		
		                		foreach($camp_inights['data'][0]['cost_per_action_type'] as $act){	                			
		                			if($act['action_type']=='like'){
		                				echo $act['value'];	                				
		                			}
		                		}	
		                	}                	
	                	}
	                	//echo $type;
	                	
	                }
	                echo $type = '<p> Per '.str_replace('_',' ', ucfirst($camapaign['objective_for_results'])).'</p>'; 

	                ?>

	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'][0]['spend'])){echo '$'.$camp_inights['data'][0]['spend'];}else{ echo '-';}?>
	            </td>
	            <td>
	                <?php if(isset($camapaign['stop_time'])){echo $start_date=date_format(date_create($camapaign['stop_time']), ' j M, Y');}else{ echo 'Ongoing';}?>
	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'])){echo round($camp_inights['data'][0]['frequency'],2);}else{ echo '-';}?>
	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'])){echo $camp_inights['data'][0]['impressions'];}else{ echo '-';}?>
	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'])){echo $camp_inights['data'][0]['unique_clicks'];}else{ echo '-';}?>
	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'])){echo $camp_inights['data'][0]['clicks'];}else{ echo '-';}?>
	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'])){echo $camp_inights['data'][0]['cpc'];}else{ echo '-';}?>
	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'])){echo $camp_inights['data'][0]['ctr'];}else{ echo '-';}?>
	            </td>
	            <td>
	                <?php if(isset($camp_inights['data'])){echo $camp_inights['data'][0]['total_unique_actions'];}else{ echo '-';}?>
	            </td>
	        </tr>

               <?php
                /* breakdown start */
                if(isset($breakdown) && isset($breakdown_type)){

                	if($breakdown_type=='time_range'){
                		if(!empty($camapaign['insights']['data'])){
                		$range=json_encode(array('since'=>$camapaign['insights']['data'][0]['date_start'],'until'=>$camapaign['insights']['data'][0]['date_stop']));
                		$breakdown=$range.'&time_increment='.$breakdown;
                		}
                	}
                	
					$cSession = curl_init();
                    curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$camapaign['id']."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click,actions,clicks,cpc,ctr,total_unique_actions&".$breakdown_type."=".$breakdown."&access_token=".$code);
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
				                            <td></td>
				                            <td></td>
				                        </tr>
				                        <?php
                        	 		endif;
                        	 	endforeach;
                        	endif;

                        	 	?>
                 
	                        <?php if(count($breaks['data'])>1): ?>	 	
	                        <tr class="camp_rows">
	                            <td>	                               
	                            </td>
	                            <td>	                                
	                            </td>
	                            <td class="editable-row">
	                            <?php if($breakdown_type=='time_range'){ echo $brk['date_start'] .'-'.$brk['date_stop']; }else{  echo $brk[$breakdown]; } ?>
	                            </td>
	                            <td>
	                                
	                            </td>
	                            <td>
	                                <?php echo $brk['inline_link_clicks']; ?>
	                            </td>
	                            <td>
	                                <?php echo @$brk['reach'];?>
	                            </td>
	                              <td>
	                                  <?php  echo @$brk['cost_per_inline_link_click'];?>
	                              </td>
	                              <td>
	                                  <?php echo @$brk['spend'];?>
	                              </td>
	                              <td>
	                                  -
	                              </td>
	                              <td>
	                                  <?php echo @$brk['frequency']; ?>
	                              </td>
	                              <td>
	                                 <?php echo @$brk['impressions']; ?>
	                              </td>
	                              <td>

	                               <?php echo @$brk['unique_clicks']; ?>
	                                 
	                              </td>
	                            

	                               <?php echo @$brk['clicks']; ?>
	                                 
	                              </td>
	                              

	                               <?php echo @$brk['cpc']; ?>
	                                 
	                              </td>
	                              <td>

	                               <?php echo @$brk['ctr']; ?>
	                                 
	                              </td>
	                              <td>
	                               <td>
						                <?php echo $brk['total_unique_actions']; ?>
						            </td>
	                              </td>
	                        </tr>
                        	<?php
                        	endif;
                        endforeach;
                    endif;
                }
                /* breakdown end */
            ?>
            
	        <?php endforeach; ?>
	        <tr>
	            <td colspan="2"></td>
	            <td>Result form
	                <?php echo count($camapaigns[ 'data']); ?> campaigns</td>
	            <td></td>
	            <td><?php if($total_inline_link_clicks) { echo $total_inline_link_clicks; } else { echo 'Link Click'; } ?></td>
	           	<td><?php if($total_reach) { echo $total_reach; } else { echo 'People'; } ?></td>
	            <td><?php if($total_cost_per_inline_link_click) { echo '$'.$total_cost_per_inline_link_click; } else { echo 'Per link click'; } ?></td>
	            <td><?php if($total_amount) { echo '$'.$total_amount; } else { echo '—Total'; } ?></td>
	            <td></td>
	            <td><?php if($total_freqency) { echo $total_freqency; } else { echo '—Per Person'; } ?></td>
	            <td><?php if($total_impression) { echo $total_impression; } else { echo '—Total'; } ?></td>
	            <td><?php if($total_unq_click) { echo $total_unq_click; } else { echo '—Total'; } ?></td>
	            <td><?php if($total_clicks) { echo $total_clicks; } else { echo '—Total'; } ?></td>
	            <td><?php if($total_cpc) { echo $total_cpc; } else { echo '—Total'; } ?></td>
	            <td><?php if($total_ctr) { echo $total_ctr; } else { echo '—Total'; } ?></td>
	             <td><?php if($total_total_unique_actions) { echo $total_total_unique_actions; } else { echo '—Total'; } ?></td>

	        </tr>
	        <?php else :?>
	        <tr>

	            <td colspan="12" align="center">No Result Found  </td>
	        </tr>
	        <?php endif ?>
	    </tbody>
	</table>