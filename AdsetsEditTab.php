<div class="edit-camp-form" style="display: none;" id="adsets-full-details">

	<div class="adsets-details-list" id="" >
		<div class="col-md-7 col-ms-8">
			<div class="edit-camp-left-blocks">
				   <form id="adset_content" name="adset_content" method="post">
			        <input type="hidden" name="adset_edit" value="adset_edit">
			        <input type="hidden" name="adset_id" value="" class="adset_id">
			        <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">
					<div class="form-white-block" style="padding: 15px;" id="">
						<label>Ad Set Name</label>
						<input type="text" name="adset_name" class="form-control inline_name_edit_tab" id="adset_name">
						<a href="#" class="adset_rename">Advanced Options</a>
					</div>
					<div class="form-white-block apd_traffic">
						<?php include 'adset/traffic.php';?>
					</div>
					<div class="form-white-block apd_budget_schedule">					
						<?php include 'adset/budget_schedule.php';?>
					</div>
				
				</form>

				<div class="form-white-block">
					<?php include 'adset/audience.php';?>
				</div>


				<div id="save-aud" class="modal fade duplicate-row-popup" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Save Audience</h4>
							</div>
							<div class="modal-body">
								<form class="form-inline">
									<div class="row">
										<div class="col-md-4"><label for="email">Audience Name</label></div>
										<div class="col-md-6">
											<div class="input-group">
												<input type="name" class="form-control new_aud_name" value="">

											</div>
											<span class="apd_saved_aud_data">
											</span>
											
										</div>	
									</div>
								</form>		  	
							</div>
							<div class="modal-footer">
								<button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
								<button type="button" class="blue-btn" id="save_new_audience">Save</button>
							</div>
						</div>
					</div>
				</div>


				<div class="form-white-block">
						<?php include 'adset/placement.php';?>
				</div>
				<div class="form-white-block apd_optimize">
					<?php include 'adset/optimization_del.php'; ?>
				</div>	

			</div>
		</div>
		<div class="col-md-5 col-sm-5">
			<div class="form-white-block" style="margin-top:20px;">
				<div class="row main-heading">
					<div class="col-md-9 padding10"><h5 class="white-block-legend"><b>Ad Set id:<span id="adset_id"></span></b></h5>
						<input type="checkbox" id="adset_status"  data-toggle="toggle" data-size="mini" name="status">
					</div>
					<div class="col-md-3 padding10">
						<!-- <div class="btn-and-caret-icon-dropdown" style="margin-top: 6px;">
							<a href="#" class="create-camp-btn">Link</a>
							<div class="dropdown caret-icon-dropdown-with-btn">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
									<span class="caret"></span>
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" href="#">Action</a>
									<a class="dropdown-item" href="#">Another action</a>
									<a class="dropdown-item" href="#">Something else here</a>
								</div>
							</div>
						</div> -->
					</div>
				</div>
				<div class="white-block-body">
					<p>
						<a href="#" class="adset_totals" rel="camp"><span class="camp_total_camps" rel="">1</span> Campaigns</a><br>
						<span>Targeting, placement, budget and schedule</span>
					</p>
					<p>
						<a href="#" class="adset_totals" rel="ad"><span class="camp_total_ads" rel="">1</span> Ad</a><br>
						<span>Images, videos, text and links</span>
					</p>
					<hr>
					<p><b>Rule</b></p>
					<div class="btn-and-caret-icon-dropdown" style="margin-top: 6px;">
						<a href="#" class="create-camp-btn" data-toggle="modal" data-target="#create-rule-btn">Create Rule</a>
						<div class="dropdown caret-icon-dropdown-with-btn">
							<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
								<span class="caret"></span>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#create-rule-btn">Create Rule</a>
								<a class="dropdown-item feedback_modal1"  data-toggle="modal" href="#give_feedback" >Give Feedback</a>									
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="edit-camp-right-blocks">
				<div class="form-white-block">
					<h5 class="white-block-legend">Audience Definition</h5>
					<div class="white-block-body">
						<img src="img/audience.jpg"> <p>Your audience selection is fairly broad</p> 
						<p>Potential Reach: <span class="approximate_count">3,300,000</span> people</p> 

					</div>
				</div>
				<div class="form-white-block">
					<h5 class="white-block-legend">Estimated Daily Results</h5>
					<div class="white-block-body">
						<div class="col-md-12" style="padding-left: 0"><b>Reach</b> 33,000 - 210,000 <br>
						<img src="img/reach-img.jpg">
						</div>
						<div class="radio">
							<p>Your ads will automatically be shown to your audience in the places they're likely to perform best. For this objective, placements may include Facebook, Instagram, Audience Network and Messenger.</p>
						</div> 
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- modal -->
<div id="give_feedback" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">We'd Like to Hear From You</h4>
            </div>
            <form method="post" id="feedback_form">
	            <div class="modal-body">
	               	<div class="row">
	                    <div class="col-md-12">
	                        <label class="col-md-12">
	                            What has been your experience using Automated Rules?
	                        </label>
	                        <div class="col-md-12">                       
	                        	<textarea  name="experience_about_rule" placeholder="" class="form-control experience_about_rule" rows="5" ></textarea>
	                        </div>
	                    </div>
	                </div>
	                 	<div class="row">
	                    <div class="col-md-12">
	                        <label class="col-md-12">
	                        What do you wish you could do with Automated Rules in the future?
	                        </label>
	                        <div class="col-md-12">                       
	                        	<textarea  name="future_done" placeholder="Rule Name" class="form-control future_done" rows="5"  ></textarea>
	                        </div>
	                    </div>
	                </div>
				</div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="button" class="btn btn-info feedback_submit" >Save</button>
	            </div>
	        </form>
        </div>
    </div>
</div>


<!--delete camapigns -->
<div id="add_feebacks" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Feedback</h4>
            </div>
            <div class="modal-body">
              
                <p class="feedback_msg">Feedback has been submitted successfully. </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
       <!--          <button type="submit" class="btn btn-primary" name="delete_campaigns">Delete</button> -->
            </div>
        </form>
    </div>

  </div>
</div>
<!--delete camapigns -->

<!--ajx msg -->
<div id="api_request_adset" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">AdSet</h4>
            </div>
            <div class="modal-body">
              
                <p class="api_request_adset_msg"> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
       <!--          <button type="submit" class="btn btn-primary" name="delete_campaigns">Delete</button> -->
            </div>
        </form>
    </div>

  </div>
</div>


<!--rename  -->
<div id="adset_rename" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Rename 1 Adset</h4>
            </div>
            <div class="modal-body">
              	<label class="radio-inline">
		      		<input type="radio" name="rename" value="opt1" checked rel="adset">Enter a name
		    	</label>
		    	<div class="form-group">				
				    <input type="text" class="form-control readset_name rename_opt1" name="readset_name">
				</div>
				<label class="radio-inline">
		      		<input type="radio" name="rename" value="opt2" rel="adset">Create a name from existing info
		    	</label>
		    	<div class="formatting">	
					<div class="dropdown">
						<span class="dropdown-toggle" type="button" id="add_format1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<b>  Additional Formatting  </b>							
						</span>
						<ul class="dropdown-menu add_format1" aria-labelledby="add_format1">
							<li> 
								<div class="form-group">
								    <label>Separate each field with:</label>
								    <input type="text" class="form-control adset_sep_sign" name="sep-sign" value="_">
								</div>
							</li>
						</ul>
					</div>
				</div>
		    	<div class="form-group">				
				    <div class="rename_info">
				    	<span class="slct_fields_adset"></span>
			    		<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="rename_adset_fields" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<b> + </b>							
							</button>
							<ul class="dropdown-menu rename_adset_fields" aria-labelledby="rename_adset_fields">
														
							</ul>
						</div>
				    </div>
				</div>
				<div class="form-group rename-grp">				
				    <p>Preview</p>
				    <span class="adset_prw"></span>

				</div>                
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-default submit_rename" rel="adset">OK</button>
            </div>
        </form>
    </div>
  </div>
</div>