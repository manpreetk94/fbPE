
<h5 class="white-block-legend">Optimization & Delivery</h5>

 <form id="optimize_form" name="optimize_form" method="post">
	<div class="white-block-body">
		
		<div class="row">
			<div class="col-md-5"><label>Optimization for Ad Delivery <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
			<div class="col-md-6">
		
				<select class="selectpicker show-tick" data-size="3" name="optimization_goal" id="optimization_goal">
					<option value="LINK_CLICKS" <?php if($optimization_goal=='LINK_CLICKS'){ echo 'selected';} ?>>Link Clicks - Recommended</option>
					<option value="LANDING_PAGE_VIEWS"  <?php if($optimization_goal=='LANDING_PAGE_VIEWS'){ echo 'selected';} ?>>Landing Page Views </option>
					<option value="IMPRESSIONS"  <?php if($optimization_goal=='IMPRESSIONS'){ echo 'selected';} ?>> Impressions </option>
					<option value="OFFSITE_CONVERSIONS"  <?php if($optimization_goal=='OFFSITE_CONVERSIONS'){ echo 'selected';} ?>>Offsite Conversion </option>
					<option value="REACH"  <?php if($optimization_goal=='REACH'){ echo 'selected';} ?>>Daily Unique Reach</option>
					<option value="PAGE_LIKES"  <?php if($optimization_goal=='PAGE_LIKES'){ echo 'selected';} ?>>Page Likes</option>
					<option value="PAGE_ENGAGEMENT"  <?php if($optimization_goal=='PAGE_ENGAGEMENT'){ echo 'selected';} ?>>Page Engagement</option>
					<option value="POST_ENGAGEMENT"  <?php if($optimization_goal=='POST_ENGAGEMENT'){ echo 'selected';} ?>> Post Engagement </option>
				</select>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-5"><label>Bid Amount <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
			<div class="col-md-7">
				<div class="radio margin-top-zero">
					<label><input type="radio" name="is_auto_bid" id="is_auto_bid" class="is_auto_bid" <?php if($is_autobid=='true'){ echo 'checked';} ?>>Automatic - Let Facebook set the bid that helps you get the most impressions at the best price.</label><br>
					<label><input type="radio" name="is_auto_bid" id="manual_bid" class="is_auto_bid"  <?php if($is_autobid!='true'){ echo 'checked';} ?>>Manual - Enter a bid based on what 1,000 impressions are worth to you.</label>
				</div>
				<div class="input-group" >
					<input type="text" class="form-control" value="<?php echo $bid_amount; ?>" placeholder="Bid Value" id="bid_amount" name="bid_amount" <?php if($is_autobid!='true'){ echo 'style="display:block"';} else{ echo 'style="display:none"'; }?> >
				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-5"><label>When You Get Charged <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
			<div class="col-md-7">
				<div class="radio margin-top-zero">
				
					<label><input type="radio" name="billing_event" id="is_impression" value="IMPRESSIONS" <?php if($billing_event=='IMPRESSIONS'){echo 'checked';}?>>Impression</label><br>
					<label><input type="radio" name="billing_event" id="is_linkclick" value="LINK_CLICKS" <?php if($billing_event=='LINK_CLICKS'){echo 'checked';}?>>Link Click  (CPC)</label>

				</div>
			</div>							      											
		</div>
		<div class="row">
			<div class="col-md-5"><label>Delivery Type<i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
			<div class="col-md-7">
				<div class="radio margin-top-zero">
			
				
					<label><input type="radio" name="pacing_type" id="stard_adset" value="standard" <?php if($pacing_type=='standard'){ echo 'checked';} ?>>Standard - Show your ads throughout your selected schedule (recommended).</label><br>
					<label><input type="radio" name="pacing_type" id="acc_addset" value="no_pacing"  <?php if($pacing_type!='standard'){ echo 'checked';} ?>>Accelerated - Show your ads as quickly as possible.</label>

				</div>
			</div>							      											
		</div>
	
	</div>
</form>