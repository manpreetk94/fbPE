<div class="edit-camp-form" style="display: none;" id="ads-full-details">
    <form id="ad_content" name="ad_content" method="post">
        <input type="hidden" name="ad_edit" value="ad_edit">
        <input type="hidden" name="ad_id" value="" class="ad_id">
        <input type="hidden" name="code" value="<?php echo $_GET['code']; ?>">

        <div class="ads-details-list">
            <div class="col-md-6 col-sm-8">
                <div class="edit-camp-left-blocks">
                    <div class="form-white-block" style="padding: 15px;" id="<?php echo $ads['id'];?>">
                        <label>Ad Set Name</label>
                        <input type="text"  class="form-control inline_name_edit_tab" id="ad_name" name="ad_name">
                        <a href="#" class="ad_rename">Advanced Options</a>
                        <!-- edit ad set name popup -->

                        <div id="rename-ad-set-popup" class="modal fade rename-ad-set-popup" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Rename 1 ad</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="common-row">
                                            <label>For each Ad</label>
                                            <div class="custom-autocomplete-select" style="display: inline-block;">
                                                <select class="selectpicker show-tick set-ad-set-name" data-size="3">
                                                    <option data-tokens="ketchup mustard" class="avail-names">Rename using available fields</option>
                                                    <option data-tokens="mustard" class="set-manual-name">Set name manually</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="common-row">
                                            <div class="rename-using-available">
                                                <div class="available-fields">
                                                    <h1>Available Fields</h1>
                                                    <input type="text" name="" placeholder="Enter custom field" class="form-control">
                                                </div>
                                                <div class="position-arrows">
                                                    <i class="fa fa-exchange"></i>
                                                </div>
                                                <div class="fields-in-naming">dgdg
                                                </div>
                                                <div class="additional-formating">dgd
                                                </div>
                                            </div>
                                            <div class="set-name-manually">
                                                2
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="blue-btn" data-dismiss="modal">Ok</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="form-white-block identity">
                        <h5 class="white-block-legend">Identity</h5>
                        <div class="white-block-body">
                            <div class="col-md-12">
                                <label class="light-grey-label">Facebook Page </label>
                                <p>Choose a Facebook Page to represent your business in News Feed. Your ad will link to your site, but it will show as coming from your Facebook Page.</p>
                                <div class="custom-autocomplete-select" id="apd_fbPages_opt">
                                    <select class="selectpicker show-tick" data-size="3" id="apd_fbPages_opts" name="ad_facebook_page" >
                                        <option data-tokens="ketchup mustard" value="">Choose a Page </option>
                                    </select>
                                </div>
                                <p>or <a href="#">Don't Connect a Facebook Page</a> (will disable News Feed ads).</p>
                            </div>

                            <div class="col-md-12">
                                <hr class="edit-forms-divider" style="margin-bottom: 20px">
                            </div>

                            <div class="col-md-12">

                                <label class="light-grey-label">Instagram Account </label>
                                <p>The selected Page has no Instagram account connected. Your ad will use the Page name and profile picture.</p>
                                <div class="identity-instagram">
                                    <span class="instagram_act_apd custom-autocomplete-select">
                                            <select class="selectpicker show-tick" data-size="3" id="">
                                                    <option data-tokens="ketchup mustard" value="">Choose a Page </option>
                                            </select>
                                        </span>
                                    <span>OR</span>
                                    <button class="light-grey-btn" data-toggle="modal" data-target="#add-insta-acct-btn"><i class="fa fa-instagram" aria-hidden="true"></i> Add an Account</button>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-white-block new-existing-ads-tab" style="padding:0px;">
                        <ul class="nav nav-tabs">
                            <li class="by_create_ad"><a data-toggle="tab" href="#crt-ad">Create Ad</a></li>
                            <li class="ad_exist_post"><a data-toggle="tab" href="#ext-post">Use Existing Post</a></li>
                        </ul>

                        <div class="tab-content">

                            <div id="crt-ad" class="tab-pane fade">
                                <ul class="ad_type_ul">
                                    <li class="img-vid-li">
                                        <input type="radio" id="img-vid" name="ad_type"  value="img-vid">
                                        <img src="img/single-img-icon.jpg">
                                        <label for="img-vid">Ad with an image or video</label>
                                    </li>

                                    <li class="mul-img-li">
                                        <div class="crt-ad-radio-and-img">
                                            <input type="radio" id="mul-img" name="ad_type" value="mul-img">
                                            <img src="img/single-img-icon.jpg">
                                        </div>
                                        <div class="crt-ad-label-and-p">
                                            <label for="mul-img">
                                                <b>Ad with multiple images or videos in a carousel</b> Show multiple images or videos for the same price.
                                            </label>
                                        </div>
                                    </li>

                                    <li class="mul-img-li">
                                        <div class="crt-ad-radio-and-img">
                                            <input type="radio" id="img-coll" name="ad_type" value="img-coll">
                                            <img src="img/single-img-icon.jpg">
                                        </div>
                                        <div class="crt-ad-label-and-p">
                                            <label for="img-coll">
                                                <b>Collection</b>Feature a collection of items that open into a fullscreen mobile experience.
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                                <!-- two tabs second radio button content -->
                                <?php include 'create_ad_opt1.php';?>
                                 <!-- two tabs first radio button content -->
                                <div class="two-tabs-second-radio">
                                	<?php include 'create_ad_opt2.php';?>
                                </div>
                                <!-- two tabs third radio button content -->
								 <?php include 'create_ad_opt3.php';?>
                            </div>
                            <div id="ext-post" class="tab-pane fade">

		                        <label>Page Post</label>
		                        <br>
		                        <!-- <p class="no-post-exist"><i class="fa fa-info-circle" aria-hidden="true"></i> No eligible posts exist.</p> -->
                                <input type="hidden" name="object_story_id" value="" class="object_story_id">
                                <span class="light-grey-btn get-new-posts"> <i class="fa fa-caret-down"></i></span>
                                    <div class="three-new-posts-list">

                                    </div>

		                        <span class="light-grey-btn plus-popup" data-target="#create-new-post-popup" data-toggle="modal">+</span>
		                        <br>
                                <p class="page_post_field" style="display:none;">
                                    <input type="text" value="" name="page_post_id_field" class="form-control page_post_id_field" placeholder="Enter Post Id">
                                    <span class="cancel_page_post_id_field">Cancel</span><span class="submit_page_post_id_field">Submit</span>
                                </p>
		                        <div style="float: left; width: 100%; text-align: left;"><a href="#" class="enter_post_id">Enter Post ID</a></div>
		                    </div>
		                </div>
					</div>

	                <div class="form-white-block tracking-form">
	                    <h5 class="white-block-legend">Tracking</h5>
	                    <div class="white-block-body">
	                        <div class="col-md-12 track-row">
	                            <label class="light-grey-label">Facebook Page </label>
	                            <input type="text" name="url_tags" placeholder="Ex: key1=value1&key2=value2" class="col-md-12 url_tags" value="">
	                        </div>
	                        <div class="col-md-12 track-row">
	                            <label class="light-grey-label">Conversion Tracking </label>
	                            <p>Select one or more options for conversion tracking. You'll see the results in Ads Manager along with ad performance data.</p>
	                            <div class="radio">
	                                <label>
	                                   <!--  <input name="optradio" type="radio">Track all conversions from my Facebook pixel</label> -->
	                                    <label class="light-grey-label">Facebook Pixel </label>
	                                <div class="pixel-tracking-ids">
	                                    
	                                </div>
	                            </div>
	                            <!-- <div class="radio">
	                                <label>
	                                    <input name="optradio" type="radio">Do not track conversions</label>
	                            </div> -->
	                        </div>
	                      <!--   <div class="col-md-12 track-row">
                              <label>Mobile App Events Tracking (optional)</label>
                              <div class="custom-autocomplete-select">
                                  <select class="selectpicker show-tick" data-size="3">
                                      <option data-tokens="ketchup mustard">Columns</option>
                                      <option data-tokens="mustard">Lorem</option>
                                      <option data-tokens="frosting">Dummy text printing</option>
                                  </select>
                              </div>
                          </div> -->
	                    </div>
	                </div>
	            </div>
	        </div>
	        <div class="col-md-6 col-sm-5">
	            <div class="form-white-block" style="margin-top:20px;">
	                <div class="row main-heading">
	                    <div class="col-md-9 padding10 edit_tab_status" rel="ad">
                            <h5><b>Ad id<span id="ad_id"></span></b></h5>
                            <input type="checkbox"  id="ad_status"  data-toggle="toggle" data-size="mini" name="status"> 
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
	                        <a href="#" class="ad_totals" rel="camp"><span class="camp_total_camps" rel="">1</span> Campaigns</a>
	                        <br>
	                        <span>Targeting, placement, budget and schedule</span>
	                    </p>
	                    <p>
	                        <a href="#" class="ad_totals" rel="adset"><span class="camp_total_adsets" rel=""></span> Ad Set</a>
	                        <br>
	                        <span>Images, videos, text and links</span>
	                    </p>
	                </div>
	            </div>
	          

	            <div class="form-white-block ad-preview">
	                <?php include 'ad_preview.php'; ?>
	            </div>
	        </div>
	    </div>
    </form>
</div>

<!--rename  -->
<div id="ad_rename" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Rename 1 Ad</h4>
            </div>
            <div class="modal-body">
                <label class="radio-inline">
                    <input type="radio" name="rename" value="opt1" checked rel="ad">Enter a name
                </label>
                <div class="form-group">                
                    <input type="text" class="form-control read_name rename_opt1" name="read_name">
                </div>
                <label class="radio-inline">
                    <input type="radio" name="rename" value="opt2" rel="ad">Create a name from existing info
                </label>
                <div class="formatting">    
                    <div class="dropdown">
                        <span class="dropdown-toggle" type="button" id="add_format2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b>  Additional Formatting  </b>                            
                        </span>
                        <ul class="dropdown-menu add_format2" aria-labelledby="add_format2">
                            <li> 
                                <div class="form-group">
                                    <label>Separate each field with:</label>
                                    <input type="text" class="form-control ad_sep_sign" name="sep-sign" value="_">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="form-group">                
                    <div class="rename_info">
                        <span class="slct_fields_ad"></span>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="rename_ad_fields" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <b> + </b>                          
                            </button>
                            <ul class="dropdown-menu rename_ad_fields" aria-labelledby="rename_ad_fields">
                                                        
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group rename-grp ">                
                    <p>Preview</p>
                    <span class="ad_prw"></span>

                </div>                
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-default submit_rename" rel="ad">OK</button>
            </div>
        </form>
    </div>
  </div>
</div>