<h5 class="white-block-legend">Traffic</h5>
					<div class="white-block-body">
						<label class="light-grey-label">Choose where you want to drive traffic. You'll enter more details about the destination later.</label>
						<div class="radio">
							<label><input type="radio" name="destination_type" id="adset-web" value="WEBSITE" <?php if($destination_type=='WEBSITE'){ echo 'checked'; }?>>Website</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="destination_type" id="adset-app" value="APP" <?php if($destination_type=='APP'){ echo 'checked'; }?>>App</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="destination_type" id="adset-messenger" value="MESSENGER" <?php if($destination_type=='MESSENGER'){ echo 'checked'; }?>>Messenger</label>
						</div>
					</div>