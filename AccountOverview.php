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


	//for country
	/*$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$act."/insights/?access_token=".$code."&fields=reach,spend".$rg."&breakdowns=country");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$country = json_decode($result, true);	
	$cont='';
	if(!empty($country['data'])){
		foreach($country['data'] as $count){
			$cont .=$count['country'].'|'; 
		}

		$cont = rtrim($cont,'|');
	}*/

	//for region
	/*$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$act."/insights/?access_token=".$code."&fields=reach,spend".$rg."&breakdowns=region");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$region_data = json_decode($result, true);	
	$region='';
	if(!empty($region_data['data'])){

	foreach($region_data['data'] as $key=>$count){
		if($key<=12){
			$region .=$count['region'].'|'; 
		}
	}
	$region = rtrim($region,'|');
	}*/

	//for region
	/*$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$act."/insights/?access_token=".$code."&fields=reach,spend".$rg."&breakdowns=dma");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$dma_data = json_decode($result, true);	
	$dma='';
	if(!empty($dma_data['data'])){
	foreach($dma_data['data'] as $ky=>$count){
		if($ky<=12){
			$dma .=$count['dma'].'|'; 
		}
	}
	$dma = rtrim($dma,'|');
}*/

	
?>
<div class="col-md-12" style="padding: 0">
	<!-- Nav tabs -->
	<div class="card">
		<ul class="nav nav-tabs four-sub-tabs" role="tablist">
			<li role="presentation" class="active">
				<a href="#reach" aria-controls="home" role="tab" data-toggle="tab">
					<div class="reach">
						<div class="rel-cont">Reach </div>
						<span class="sub-tab-down-arrow-search">	                                        					
							<div class="down-arrow-custom-auto-select">
								<!-- <i class="fa fa-caret-down caret-show-select" aria-hidden="true"></i> -->
								<div class="custom-autocomplete-select">
									<select class="selectpicker select-green-text show-tick first_slct" data-live-search="true">
										<option  value="<?php echo $account_insights['data'][0]['reach']; ?>" data-type="Reach">Reach</option>
										<option  value="<?php echo $account_insights['data'][0]['spend']; ?>" data-type="Spend">Spend</option>
										<option value="<?php  echo $account_insights['data'][0]['inline_link_clicks']; ?>" data-type="Link Click">Link Click</option>
										<option  value="<?php echo $account_insights['data'][0]['impressions']; ?>" data-type="Impression">Impression</option>
										<option  value="<?php echo $account_insights['data'][0]['inline_post_engagement']; ?>" data-type="Post Engagement">Post Engagement</option>
										<option  value="<?php echo @$account_insights['data'][0]['video_30_sec_watched_actions']; ?>" data-type="30 sec Video View">30 sec Video View </option>
										
									</select>
								</div>
							</div>
						</span>
					</div>
					<b class="count-in-number first_slct_number"></i>  <?php if(isset($account_insights['data'][0]['reach'])) {echo $account_insights['data'][0]['reach']; }else{ echo '0';}?></b>
				</a>
			</li>
			<li role="presentation">
				<a href="#spent" aria-controls="profile" role="tab" data-toggle="tab">
					<div class="spent-amt">
						
						<span class="spt-cont">Spend </span>
						<span class="sub-tab-down-arrow-search">	                                        					
							<div class="down-arrow-custom-auto-select">
								<!-- <i class="fa fa-caret-down caret-show-select" aria-hidden="true"></i> -->
								<div class="custom-autocomplete-select">
									<select class="selectpicker select-green-text show-tick secd_slct" data-live-search="true">
										
										<option  value="<?php echo $account_insights['data'][0]['spend']; ?>" data-type="Spend">Spend</option>
										<option  value="<?php echo $account_insights['data'][0]['reach']; ?>" data-type="Reach">Reach</option>
										<option value="<?php echo $account_insights['data'][0]['inline_link_clicks']; ?>" data-type="Link Click">Link Click</option>
										<option  value="<?php echo $account_insights['data'][0]['impressions']; ?>" data-type="Impression">Impression</option>
										<option  value="<?php echo $account_insights['data'][0]['inline_post_engagement']; ?>" data-type="Post Engagement">Post Engagement</option>
										<option  value="<?php echo @$account_insights['data'][0]['video_30_sec_watched_actions']; ?>" data-type="30 sec Video View">30 sec Video View </option>
										
									</select>
								</div>
							</div>
						</span>
					</div>
					<b class="count-in-number secd_slct_number" ><!-- <i class="fa fa-rupee" aria-hidden="true"></i> --> 
					    <?php if(isset($account_insights['data'][0]['spend'])) {echo $account_insights['data'][0]['spend']; }else{ echo '0';}?>				 	
					</b>
				</a>
			</li>
			<li role="presentation">
				<a href="#impression" aria-controls="messages" role="tab" data-toggle="tab">
					<div class="impre">
						<span class="imp-cont">Impressions </span>
						<span class="sub-tab-down-arrow-search">	                                        					
							<div class="down-arrow-custom-auto-select">
								<!-- <i class="fa fa-caret-down caret-show-select" aria-hidden="true"></i> -->
								<div class="custom-autocomplete-select">
									<select class="selectpicker select-green-text show-tick thrd_slct" data-live-search="true">
										<option  value="<?php echo $account_insights['data'][0]['impressions']; ?>" data-type="Impression">Impression</option>
										<option  value="<?php echo $account_insights['data'][0]['reach']; ?>" data-type="Reach">Reach</option>
										<option  value="<?php echo $account_insights['data'][0]['spend']; ?>" data-type="Spend">Spend</option>
										<option value="<?php echo $account_insights['data'][0]['inline_link_clicks']; ?>" data-type="Link Click">Link Click</option>
										
										<option  value="<?php echo $account_insights['data'][0]['inline_post_engagement']; ?>" data-type="Post Engagement">Post Engagement</option>
										<option  value="<?php echo @$account_insights['data'][0]['video_30_sec_watched_actions']; ?>" data-type="30 sec Video View">30 sec Video View </option>
										
									</select>
								</div>
							</div>
						</span>
					</div>
					<b class="count-in-number thrd_slct_number">  <?php if(isset($account_insights['data'][0]['impressions'])) {echo $account_insights['data'][0]['impressions']; }else{ echo '0';}?></b>			
				</a>
			</li>
			<li role="presentation">
				<a href="#link-clicks" aria-controls="settings" role="tab" data-toggle="tab">
					<div class="link-clicks">
						<span class="link-cont">Link Clicks </span>
						<span class="sub-tab-down-arrow-search">	                                        					
							<div class="down-arrow-custom-auto-select">
								<!-- <i class="fa fa-caret-down caret-show-select" aria-hidden="true"></i> -->
								<div class="custom-autocomplete-select">
									<select class="selectpicker select-green-text show-tick fort_slct" data-live-search="true">
										<option value="<?php echo $account_insights['data'][0]['inline_link_clicks']; ?>" data-type="Link Click">Link Click</option>
										<option  value="<?php echo $account_insights['data'][0]['impressions']; ?>" data-type="Impression">Impression</option>
										<option  value="<?php echo $account_insights['data'][0]['reach']; ?>" data-type="Reach">Reach</option>
										<option  value="<?php echo $account_insights['data'][0]['spend']; ?>" data-type="Spend">Spend</option>							
										
										<option  value="<?php echo $account_insights['data'][0]['inline_post_engagement']; ?>" data-type="Post Engagement">Post Engagement</option>
										<option  value="<?php echo @$account_insights['data'][0]['video_30_sec_watched_actions']; ?>" data-type="30 sec Video View">30 sec Video View </option>
										
									</select>
								</div>
							</div>
						</span>
					</div>
					<b class="count-in-number fort_slct_number">  <?php if(isset($account_insights['data'][0]['inline_link_clicks'])) {echo $account_insights['data'][0]['inline_link_clicks']; }else{ echo '0';}?></b>
				</a> 
			</li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content graph-tabs">
			<div role="tabpanel" class="tab-pane active tab1" id="reach">
				<?php include "account/tab1.php"; ?>
			</div>
			<div role="tabpanel" class="tab-pane tab2" id="spent">
					<?php include "account/tab2.php"; ?>
			</div>
			<div role="tabpanel" class="tab-pane tab3" id="impression">
				<?php include "account/tab3.php"; ?>
			</div>
			<div role="tabpanel" class="tab-pane tab4" id="link-clicks">
				<?php include "account/tab4.php"; ?>	
			</div>
		</div>
	</div>
	<div class="table-result">
		<table class="table">
			<thead class="thead-default">
				<tr>
					<th>Objective</th>
					<th>Results</th>
					<th>Cost per Result</th>
					<th>Reach</th>
					<th>Amount Spent</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $account_insights['data'][0]['objective']; ?></td>
					<td><?php echo $account_insights['data'][0]['inline_link_clicks']; ?></td>
					<td><?php echo $account_insights['data'][0]['cost_per_inline_link_click']; ?></td>
					<td><?php echo $account_insights['data'][0]['reach']; ?></td>
					<td><?php echo $account_insights['data'][0]['spend']; ?></td>
				</tr>	
											
			</tbody>
		</table>
	</div>
	<div class="row"> 
		<div class="col-md-6">
			<div class="age-area">
				<div class="card">
					<ul class="nav nav-tabs" role="tablist">
						<!-- <li role="presentation" class="active">
							<a href="#age-gender" aria-controls="home" role="tab" data-toggle="tab">
								Age and Gender
							</a>
						</li> -->
						<li role="presentation" class="active">
							<a href="#age" aria-controls="profile" role="tab" data-toggle="tab">	 
								Age		                                    	 		                                    		 
							</a>
						</li>
						<li role="presentation">
							<a href="#gender" aria-controls="messages" role="tab" data-toggle="tab">		                         		
								Gender 	
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<!-- <div role="tabpanel" class="tab-pane active" id="age-gender">
							<div class="custom-autocomplete-select age-gender-select">
								<select class="selectpicker select-blue-text show-tick" data-live-search="true" name="spline1_age-gender">
									<option  value="reach">Reach</option>
									<option  value="spend">Amount Spend</option>
									<option  value="impressions">Impressions</option>
									<option  value="inline_link_clicks">Link Clicks</option>
									<option  value="inline_post_engagement">Post Engagement</option>								
								</select>
						
								<select class="selectpicker select-green-text show-tick" data-live-search="true" name="spline2_age-gender">								
									<option  value="spend">Amount Spend</option>
									<option  value="reach">Reach</option>
									<option  value="impressions">Impressions</option>
									<option  value="inline_link_clicks">Link Clicks</option>
									<option  value="inline_post_engagement">Post Engagement</option>
								</select>
						
							</div>
							<div class="no-result-found apd_chart_age_gender">
								
							</div>	
						
						
						</div> -->
						<div role="tabpanel" class="tab-pane active" id="age">
							<div class="custom-autocomplete-select age-select">

								<select class="selectpicker select-blue-text show-tick spline_age" data-live-search="true" name="spline1_age">
									<option  value="reach">Reach</option>
									<option  value="spend">Amount Spend</option>
									<option  value="impressions">Impressions</option>
									<option  value="inline_link_clicks">Link Clicks</option>
									<option  value="inline_post_engagement">Post Engagement</option>
								</select>
								<select class="selectpicker select-green-text show-tick spline_age" data-live-search="true" name="spline2_age">
									<option  value="spend">Amount Spend</option>
									<option  value="reach">Reach</option>
									<option  value="impressions">Impressions</option>
									<option  value="inline_link_clicks">Link Clicks</option>
									<option  value="inline_post_engagement">Post Engagement</option>
								</select>
							</div>
							<div class="no-result-found apd_chart_age">
								<?php include "account/age-chart.php"; ?>
							</div>


						</div>
						<div role="tabpanel" class="tab-pane" id="gender">
							<div class="custom-autocomplete-select gender-select">
								<select class="selectpicker select-blue-text show-tick spline_gender" data-live-search="true" name="spline1_gender">
									<option  value="reach">Reach</option>
									<option  value="spend">Amount Spend</option>
									<option  value="impressions">Impressions</option>
									<option  value="inline_link_clicks">Link Clicks</option>
									<option  value="inline_post_engagement">Post Engagement</option>
								
								</select>

								<select class="selectpicker select-green-text show-tick spline_gender" data-live-search="true" name="spline2_gender">
									<option  value="spend">Amount Spend</option>
									<option  value="reach">Reach</option>
									<option  value="impressions">Impressions</option>
									<option  value="inline_link_clicks">Link Clicks</option>
									<option  value="inline_post_engagement">Post Engagement</option>
								</select>

							</div>
							<div class="no-result-found apd_chart_gender">
								<?php include "account/gender-chart.php"; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>    	
		<div class="col-md-6">
			<div class="hours-area">
				<div class="card">
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#age-gender" aria-controls="home" role="tab" data-toggle="tab">
								Hour				                                        		 
							</a>
						</li>
					</ul>

					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="age-gender">
							<div class="custom-autocomplete-select">
								<select class="selectpicker select-blue-text show-tick spline_hour" data-live-search="true" name="spline1_hour">
									<option  value="reach">Reach</option>
									<option  value="spend">Amount Spend</option>
									<option  value="impressions">Impressions</option>
									<option  value="inline_link_clicks">Link Clicks</option>
									<option  value="inline_post_engagement">Post Engagement</option>
								
								</select>

								<select class="selectpicker select-green-text show-tick spline_hour" data-live-search="true" name=spline2_hour>
									<option  value="spend">Amount Spend</option>
									<option  value="reach">Reach</option>
									<option  value="impressions">Impressions</option>
									<option  value="inline_link_clicks">Link Clicks</option>
									<option  value="inline_post_engagement">Post Engagement</option>
								</select>

							</div>
							<div class="no-result-found apd_chart_hour">
								<?php include "account/hour-chart.php"; ?>
							</div>
						</div>	                                       	                                        
					</div>		
				</div>
			</div>
		</div>
	</div>	
	<!-- <div class="location-section">
		<div class="row">
			<div class="col-md-12">
				<h1>Location</h1>
				<div class="col-md-2 location-radio-selection">
					<form>
						<label class="radio-inline">
							<input type="radio" name="optradio_lc" checked class="optradio_lc" value="https://maps.googleapis.com/maps/api/staticmap?size=700x350&maptype=roadmap&markers=size:mid|color:red|<?php echo $cont;?>&zoom=1"  >Country
						</label>
						<label class="radio-inline">
							<input type="radio" name="optradio_lc" value="https://maps.googleapis.com/maps/api/staticmap?size=700x350&maptype=roadmap&markers=size:mid|color:red|<?php echo $region;?>&zoom=1" class="optradio_lc" >Region
						</label>
						<label class="radio-inline">
							<input type="radio" name="optradio_lc" value="https://maps.googleapis.com/maps/api/staticmap?size=700x350&maptype=roadmap&markers=size:mid|color:red|<?php echo $dma;?>&zoom=1" class="optradio_lc">DMA Region
						</label>
					</form>
				</div>
				<div class="col-md-10 location-map">
					<div class="map-result">
						<img src="img/map-img.jpg">
						<img src="https://maps.googleapis.com/maps/api/staticmap?size=700x350&maptype=roadmap&markers=size:mid|color:red|<?php echo $cont;?>&zoom=1" class="map_country" style="width:100%;" alt="">  -->
				
					<!-- 	<img src="https://maps.googleapis.com/maps/api/staticmap?size=700x350&maptype=roadmap&markers=size:mid|color:red|<?php echo $region;?>&zoom=1" class="map_region">  -->
						
						<!--  <img src="https://maps.googleapis.com/maps/api/staticmap?size=700x350&maptype=roadmap&markers=size:mid|color:red|<?php echo $dma;?>&zoom=1" class="map_dma">  -->

			<!-- 		</div>
					<div class="select-on-map">
						<div class="custom-autocomplete-select"> -->
							<!-- <select class="selectpicker  show-tick" data-live-search="true">
								<option data-tokens="ketchup mustard">Lorem Ipsum</option>
								<option data-tokens="mustard">Lorem</option>
								<option data-tokens="frosting">Dummy text printing</option>
								<option data-tokens="ketchup mustard">Lorem Ipsum</option>
							
							</select> -->

			<!-- 			</div>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<div class="account-bottom-custom-table">
		<div class="col-md-12" style="padding: 0">
			<div class="top-custom-colums-dropdown pull-right">
				

				<div class="dropdown breakdowns">
					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						Breakdown
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu account_breakdown" aria-labelledby="dropdownMenu1">
						<li data-tokens="breakdowns" value="clear"  style="text-align:center;font-size:10px; color:#23527c;">Clear All Breakdowns</a></li>
						<li class="dropdown-header">By delivery</li>
							<li data-tokens="time_range" value="1" >Day</li>
							<li value="7"  data-tokens="time_range" >Week </li>
							<li value="14" data-tokens="time_range" >2 Week</li>									    
							<li value="30" data-tokens="time_range" >Month</li>									    
						<li class="dropdown-header">By Time</li>
							<li data-tokens="breakdowns"  value="age" >Age</li>
                            <li data-tokens="breakdowns"  value="gender">Gender</li>
                            <li data-tokens="breakdowns"  value="age,gender">Age and Gender</li>
                            <li data-tokens="breakdowns"  value="country">Country</li>
                            <li data-tokens="breakdowns"  value="region">Region</li>
                            <li data-tokens="breakdowns"  value="dma ">DMA Region </li>
                            <li data-tokens="breakdowns"  value="impression_device">Impression Device </li>
                            <li data-tokens="breakdowns"  value="device_platform">Platform Device </li>
                            <li data-tokens="breakdowns"  value="publisher_platform">Publisher Platform  </li>
                            <li data-tokens="breakdowns"  value="publisher_platform">Publisher Platform  </li>
						<li class="dropdown-header">By Action</li>
							<li data-tokens="action_breakdowns"  value="action_destination"  > Destination </li>
							<li data-tokens="action_breakdowns"  value="action_device" > Conversion Device </li>
							<li data-tokens="action_breakdowns"  value="action_reaction"> Post Reaction Type </li>
							<li data-tokens="action_breakdowns"  value="action_link_click_destination">Link Click Destination </li>
							<li data-tokens="action_breakdowns"  value="action_video_type"> Video View type </li>
							<li data-tokens="action_breakdowns"  value="action_video_sound"> Video Sound </li>
							<li data-tokens="action_breakdowns"  value="action_carousel_card_name"> Carousal card</li>
					</ul>
				</div>

			</div>
			<div class="col-md-12 acc-table-result">
				<div class="table-result account_overview_table">
					<?php include "account/account_overview_table.php"; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <div class="col-md-2 right-area" style="padding-right: 0">
	<div class="cost-summary">
		<h5>Account Spending Limit <i class="fa fa-info-circle" aria-hidden="true"></i></h5>
		<img src="img/amount-slider.jpg">
		<p><b>&#8377; 330.00</b> spent toward limit.</p>
		<p><b>&#8377; 330.00</b> limit.</p>
		<p><a href="">Manage Billing & Payments</a></p>
	</div>
</div> -->