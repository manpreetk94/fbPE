<div class="thress-tabs-table-top-filters">
    <div class="left-fil1">
        <div class="btn-and-caret-icon-dropdown">
            <a href="#" class="create-camp-btn create-camp-popup" data-toggle="modal" data-target="#create-camp-btn">+ Create Campaign</a>
           
            <div class="dropdown caret-icon-dropdown-with-btn">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
                    <span class="caret"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item create-existing-campaign create-adset-popup" href="#" data-toggle="modal" data-target="#create-camp-btn">Create Adset</a>
                    <a class="dropdown-item create-existing-campaign create-ad-popup" href="#" data-toggle="modal" data-target="#create-camp-btn">Create Ad</a>
                </div>
            </div>
        </div>
        <div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
            <a class="create-camp-btn duplicate-campaign" href="#duplicate-campaign" data-toggle="modal"><i class="fa fa-copy"></i> Duplicate</a>
            <!-- <div class="dropdown caret-icon-dropdown-with-btn">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
               <span class="caret"></span> 
                </button>
                   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <a class="dropdown-item duplicate" rel="campaign" href="#">Quick Duplicate</a>
                   
               </div> 
            </div> -->
        </div>
        <div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
            <a href="#" class="create-camp-btn edit-campaigns"><i class="fa fa-pencil"></i> Edit</a>
           <!--  <div class="dropdown caret-icon-dropdown-with-btn">
               <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
                 <span class="caret"></span>
               </button>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <a class="dropdown-item" href="#">Action</a>
                 <a class="dropdown-item" href="#">Another action</a>
                 <a class="dropdown-item" href="#">Something else here</a>
             </div> 
            </div>-->
        </div>
        <div class="simple-default-icons-group " style="margin-left:10px">
            <ul>
                <!-- <li><i class="fa fa-refresh disable-me"></i></li> -->
                <li  id="delete_camp"><i class="fa fa-trash disable-me" data-toggle="tooltip" title="Delete"></i></li>
                <li class="dropdown export-menu">
                    <i class="fa fa-download dropdown-toggle" type="button" data-toggle="dropdown"></i>
                    <ul class="dropdown-menu export_campaigns">
                      <li data-toggle="modal" data-target="#loader_div"><a href="#">Export Selected</a></li>
                      <li data-toggle="modal" data-target="#loader_div"><a href="#" >Export Selected as Plain Text</a></li>
                      <li data-toggle="modal" data-target="#loader_div"><a href="#">Export All</a></li>
                  </ul>
                </li>
                <!-- <li><i class="fa fa-tag disable-me" data-toggle="tooltip" title="Delete"></i></li> -->
            </ul>
        </div>
        <div class="single-btn-div" style="margin-left: 10px">
            <button class="light-grey-btn" style="height: 24px;" data-toggle="modal" data-target="#create-rule-btn">Create Rule</button>
            <!-- create rule popup  -->
         		<?php //include 'create-rule.php';?>
            <!-- craete rule popup ends  -->

        </div>
    </div>
    <div class="right-fil1">
        <ul>
             <?php include 'breakdown.php';?>
            <li>
               <a href="export.php/?type=campaign&act=<?php echo $_GET['act']; ?>&code=<?php echo $_GET['code']; ?>" style="color:#333"> <button class="light-grey-btn" style="height: 24px; line-height: normal;">Export</button></a>
            </li>
        </ul>
    </div>
</div>

<div class="table-result table-responsive camp-second-tab-table">
	<div id="duplicate-campaign" class="modal fade duplicate-row-popup" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
                <form class="form-inline" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Duplicate Campaign</h4>
				</div>
				<div class="modal-body">
						<div class="form-group">
							<label for="email">Number of duplicates</label>
							<div class="input-group spinner">
								<input type="hidden" class="form-control" name="duplicate_campaign_id" id="duplicate_campaign_id">
                                <input type="text" class="form-control" value="1" name="duplicate_campaign_count" min="1">
								<div class="input-group-btn-vertical">
									<button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
									<button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
								</div>
							</div>
						</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
					<button type="submit" class="blue-btn" name="duplicates_campaigns">Create Duplicate</button>
				</div>
            </form>
			</div>
		</div>
	</div>
	
	<?php  

	
		if($file == 'video_engagement'){
			include 'columns/video_engagement-camp.php';
		}elseif($file =='performance_and_click'){
			include 'columns/performance_and_click-camp.php';
		}else{
			include 'columns/performance-camp.php';
		}
	?>

</div>

<!--delete camapigns -->
<div id="delete_campaigns_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Delete Campaign</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="campaign_id" id="delete_camp_id" value="">
                <p>Are you sure you want to delete this campaign? This cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" name="delete_campaigns">Delete</button>
            </div>
        </form>
    </div>

  </div>
</div>
<!--delete camapigns -->


