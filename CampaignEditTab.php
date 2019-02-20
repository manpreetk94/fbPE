<div id="camapaign-full-details" style="display: block;">
	<form id="campaign_content" method="post" name="campaign_content">
		<input type="hidden" name="campaign_edit" value="campaign_edit">
        <input type="hidden" name="campaign_id" value="" class="campaign_id">
        <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">

		<div class="camapaign-details-list" id="">
			<div class="col-md-7 col-sm-8">
				<div class="form-white-block" style="padding: 15px; margin-top: 20px;">
					<div class="row">
						<div class="col-sm-4"><label for="email" class="pull-right">Campaign Name:</label></div>
						<div class="col-sm-8 padding0" id="<?php echo $camapaign['id'];?>">
							<input type="email" class="form-control inline_name_edit_tab" id="camp_name" value="" name="camp_name">
							 <a href="#" class="camp_rename">Advanced Options</a>
						</div>
					</div>
				</div>
				<div class="form-white-block">
					<h5 class="white-block-legend">Campaign Details</h5>
					<div class="white-block-body">
						<div class="col-sm-12">
							<div class="col-sm-6"><label class="pull-right">Objective</label></div>
							<div class="col-sm-6 padding0" id="camp_objectivea"></div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6"><label class="pull-right">Buying Type</label></div>
							<div class="col-sm-6 padding0" id="camp_buyingtype"><?php echo $camapaign['buying_type'];?></div>
						</div>
						<div class="col-sm-12">
							<div class="col-sm-6"><label class="pull-right">Campaign Spending Limit <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
							<div class="col-sm-6 padding0">
								<span class="spend_area">
									<input type="text" name="spend_cap" class="camp_spend_cap"><span><b><span class="total_spend">0.00 </span>Total Spent</b></span>
									<p>New limit must be at least <span class="atleat_spend">5,000.00 </span></p>								
								</span>
								<a href="#" class="set_limit">Set Limit</a>
								<a href="#" class="remove_limit">Remove Limit</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-5 col-ms-4">
				<div class="form-white-block" style="margin-top:20px;">
					<div class="row main-heading">
						<div class="col-md-9 padding10"><h5><b>Campaign id:<span id="camp_id"></span> </b></h5>
						<input type="checkbox" id="camp_status" data-toggle="toggle" data-size="mini" name="status" value=""> </div>
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
							<a href="#" class="camp_totals" rel="adset"><span class="camp_total_adsets" rel=""></span> Ad Set</a><br>
							<span>Targeting, placement, budget and schedule</span>
						</p>
						<p>
							<a href="#" class="camp_totals" rel="ad"><span class="camp_total_ads" rel=""></span> Ad</a><br>
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
			</div>
		</div>
	</form>
</div>

<!--ajx msg -->
<div id="api_request_camp" class="modal fade" role="dialog">
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
<div id="camp_rename" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">×</button>
            <h4 class="modal-title">Rename 1 Campaign</h4>
        </div>
        <div class="modal-body">
          	<label class="radio-inline">
	      		<input type="radio" name="rename" value="opt1" checked rel="camp">Enter a name
	    	</label>
	    	<div class="form-group">				
			    <input type="text" class="form-control recamp_name rename_opt1" name="recamp_name">
			</div>
			<label class="radio-inline">
	      		<input type="radio" name="rename" value="opt2" rel="camp">Create a name from existing info
	    	</label>
	    	<div class="formatting">	
				<div class="dropdown">
					<span class="dropdown-toggle" type="button" id="add_format" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<b>  Additional Formatting  </b>							
					</span>
					<ul class="dropdown-menu add_format" aria-labelledby="rename_camp_fields">
						<li> 
							<div class="form-group">
							    <label>Separate each field with:</label>
							    <input type="text" class="form-control camp_sep_sign" name="sep-sign" value="_">
							</div>
						</li>
					</ul>
				</div>
			</div>
	    	<div class="form-group rename-grp"> 		    						
			    <div class="rename_info">
			    	<span class="slct_fields_camp"></span>
		    		<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="rename_camp_fields" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<b> + </b>							
						</button>
						<ul class="dropdown-menu rename_camp_fields" aria-labelledby="rename_camp_fields">
							<li class="dropdown-header all-main-head">
								<h5 ><span>Campaign</span> <i class="fa fa-angle-right arrow"></i> </h5>
								<ul class="camp-sub-list">
									<li  rel="" id="cmp_id"><a href="#" > Campaign ID</a>
									</li>
									<li  rel="" id="cmp_nme"><a href="#" > Campaign Name</a>
									</li>
									<li  rel="" id="cmp_obj"><a href="#" > Objective</a>
									</li>
								</ul>
							</li>
							<li class="dropdown-header all-main-head custom_text">
								<h5>Custom Text</h5>	
							</li>						
						</ul>
					</div>
			    </div>
			</div>
			<div class="form-group rename-grp">				
			    <p>Preview</p>
			    <span class="camp_prw"></span>
			</div>                
        </div>
        <div class="modal-footer">                
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-default submit_rename" rel="camp">OK</button>
        </div>     
    </div>
  </div>
</div>