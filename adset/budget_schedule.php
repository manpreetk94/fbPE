<h5 class="white-block-legend">Budget & Schedule</h5>
	<div class="white-block-body">
		<div class="row">
			<div class="col-md-5"><label class="bud_title">Lifetime Budget</label></div>
			<div class="col-md-6">
				<span class="daily_bud" style="display:<?php if($daily_budget==0) { echo 'none'; } else{ echo 'block'; } ?>;">
					<input type="text" name="daily_budget" value="<?php echo $daily_budget/100;?>" style=" margin-right: 10px;width:100px;" id="addsets_daily_bugdet">									
				<!-- 	<button class="light-grey-btn"  id="adjust_budget_popup" >Adjust Budget</button -->
				</span>
				<span class="lifetime_bud" style="display:<?php if($lifetime_budget==0) { echo 'none'; }  else { echo 'block'; } ?>;">
					<input type="text" name="lifetime_budget" value="<?php echo $lifetime_budget/100;?>" style=" margin-right: 10px;width:100px;" id="addsets_lifetime_bugdet" >	
				</span>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5"><label>Schedule Start</label></div>
			<div class="col-md-6">
				<p class="addsets_start_time"><?php echo $start_time; ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-5"><label>Schedule End</label></div>
			<div class="col-md-7">
				<div class="radio margin-top-zero">
					<label><input type="radio" name="optradio_schd" class="not_schedule_adset" <?php if($schd==0){ echo 'checked';} ?> value="no"> Don't schedule end date, run as ongoing</label><br>
					<label><input type="radio" name="optradio_schd" class="schedule_adset" <?php if($schd==1){ echo 'checked';} ?> value="yes">End run on:</label>
					<div class="input-group schedule_fields" <?php if($schd==1){ echo 'stye="display:block"';}else{  echo 'stye="display:none"'; } ?>>
						<input type="text" class="col-sm-6" value="<?php echo $end_date; ?>" placeholder="" id="schedule_date" name="schedule_date">
						<input type="text" class="col-sm-6" value="<?php echo $end_time; ?>" placeholder="" id="schedule_time" name="schedule_time">
					</div>

				</div>
			</div>	
		</div>
		<div class="row">
			<div class="col-md-5"><label>Ad Scheduling</label></div>
			<div class="col-md-7">
				<div class="radio margin-top-zero">
					<label><input type="radio" name="optradio">Run ads all the time</label><br>
					<label><input type="radio" name="optradio">Run ads on a schedule</label>
				</div>
			</div>							      											
		</div>							
	</div>