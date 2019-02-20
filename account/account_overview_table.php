<?php
	if($_SESSION['time_range']['since']!='Invalid date'){
		$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
	}else{
		$rg="&date_preset=lifetime";
	}
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$act."/insights/?access_token=".$code."&fields=reach,spend,impressions,inline_link_clicks,video_30_sec_watched_actions,objective,cost_per_inline_link_click,unique_clicks,frequency,account_name".$rg);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$account_insights = json_decode($result, true);

?>
<table class="table">
	<thead class="thead-default">
		<tr>
			<th>Account Name</th>
			<th>link Click</th>
			<th>Reach</th>																       
			<th>Amount Spent</th>
			<th>Frequency</th>
			<th>Impressions</th>
			<th>Unique Link Clicks</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			if(!empty($account_insights['data'])):
			foreach($account_insights['data'] as $insg): ?>
			<tr>
				<td><?php echo $insg['account_name']; ?></td>
				<td><?php echo $insg['inline_link_clicks']; ?></td>
				<td><?php echo $insg['reach']; ?></td>
				<td><?php echo $insg['spend']; ?></td>
				<td><?php echo $insg['frequency']; ?></td>
				<td><?php echo $insg['impressions']; ?></td>
				<td><?php echo $insg['unique_clicks']; ?></td>
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
                                curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$act."/insights/?access_token=".$code."&fields=reach,spend,impressions,inline_link_clicks,video_30_sec_watched_actions,objective,cost_per_inline_link_click,unique_clicks,frequency,actions,account_name&".$breakdown_type."=".$breakdown);
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
                                                    <tr>
														<td <?php echo $br_action[$breakdown]; ?></td>
														<td><?php echo $br_action['inline_link_clicks']; ?></td>
														<td><?php echo $br_action['reach']; ?></td>
														<td><?php echo $br_action['spend']; ?></td>
														<td><?php echo $br_action['frequency']; ?></td>
														<td><?php echo $br_action['impressions']; ?></td>
														<td><?php echo $br_action['unique_clicks']; ?></td>
													</tr>
                                                    <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                        <?php if(count($breaks['data'])>1): ?>      
                                        <tr>
											<td>  <?php if($breakdown_type=='time_range'){ echo $brk['date_start'] .'-'.$brk['date_stop']; }else{  echo $breakdown.' - ' .$brk[$breakdown]; } ?></td>
											<td><?php echo $brk['inline_link_clicks']; ?></td>
											<td><?php echo $brk['reach']; ?></td>
											<td><?php echo $brk['spend']; ?></td>
											<td><?php echo $brk['frequency']; ?></td>
											<td><?php echo $brk['impressions']; ?></td>
											<td><?php echo $brk['unique_clicks']; ?></td>
										</tr>
                                        <?php
                                        endif;
                                    endforeach;
                                endif;
                            } 
                            /* breakdown end */
			?>
		<?php endforeach; 
			endif;
		?>										
		<?php if(empty($account_insights['data'])): ?>
				<td class="apd_account_name"></td>
				<td></td>
				<td></td>
				<td>$0.00</td>
				<td></td>
				<td></td>
				<td></td>
		<?php endif; ?>
	</tbody>
</table>