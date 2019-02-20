<div class="thress-tabs-table-top-filters">
    <div class="left-fil1">
        <div class="btn-and-caret-icon-dropdown">
            <a href="#" class="create-camp-btn create-adset-popup" data-toggle="modal" data-target="#create-camp-btn">+ Create Ad Set</a>

            <!-- crate ad set popup  -->
            <div id="create-ad-set-btn" class="modal fade common-three-tabs-popup" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create Ad Set</h4>
                        </div>
                        <div class="modal-body">
                            <div class="popup-left-form">
                                <div class="sec1">
                                    <div class="row" style="margin-bottom:30px;">
                                        <div class="col-md-12">
                                            <div class="custom-autocomplete-select">
                                                <select class="selectpicker show-tick">
                                                    <option data-tokens="ketchup mustard">Create New Campaign</option>
                                                    <option data-tokens="mustard">Use Existing Campaign</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-4">
                                                Campaign Name
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" name="" placeholder="Enter a campaign name" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-4">
                                                Buying Type
                                            </label>
                                            <div class="col-md-8">
                                                <div class="custom-autocomplete-select">
                                                    <select class="selectpicker show-tick">
                                                        <option data-tokens="ketchup mustard">Auction</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-4">
                                                Campaign Objective
                                            </label>
                                            <div class="col-md-8">
                                                <button class="light-grey-btn show-camp-obj-btn"><img src="img/brand-awarns-icon.png">Traffic</button>
                                                <div class="objective">
                                                    <div class="objective-cat">
                                                        <h5>Awareness</h5>
                                                        <ul>
                                                            <li><img src="img/brand-awarns-icon.png"> Brand</li>
                                                            <li><img src="img/brand-awarns-icon.png"> Brand</li>
                                                            <li><img src="img/brand-awarns-icon.png"> Brand</li>
                                                            <li><img src="img/brand-awarns-icon.png"> Brand</li>
                                                        </ul>
                                                    </div>
                                                    <div class="objective-cat">
                                                        <h5>Awareness</h5>
                                                        <ul>
                                                            <li><img src="img/brand-awarns-icon.png"> Brand</li>
                                                            <li><img src="img/brand-awarns-icon.png"> Brand</li>
                                                        </ul>
                                                    </div>
                                                    <div class="objective-cat">
                                                        <h5>Awareness</h5>
                                                        <ul>
                                                            <li><img src="img/brand-awarns-icon.png"> Brand</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sec1">
                                    <div class="row" style="margin-bottom:30px;">
                                        <div class="col-md-12">
                                            <div class="custom-autocomplete-select">
                                                <select class="selectpicker show-tick">
                                                    <option data-tokens="ketchup mustard">Create New Ad Set</option>
                                                    <option data-tokens="mustard">Use Existing Ad Set</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-4">
                                                Ad Set Name
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" name="" placeholder="Enter an ad set name" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sec1">
                                    <div class="row" style="margin-bottom:30px;">
                                        <div class="col-md-12">
                                            <div class="custom-autocomplete-select">
                                                <select class="selectpicker show-tick">
                                                    <option data-tokens="ketchup mustard">Create New Ad</option>
                                                    <option data-tokens="mustard">Use Existing Ad</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-4">
                                                Ad Name
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" name="" placeholder="Enter an ad name" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sec1">
                                    <p class="no-of-camp">Creating 1 campaign, 1 ad set and 1 ad</p>
                                </div>
                            </div>
                            <!--  <div class="popup-right-form col-md-4">sds</div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="light-grey-btn" data-dismiss="modal" style="float: left;">Cancel</button>
                            <button class="blue-btn">Save </button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- crate ad set popup ends  -->

            <div class="dropdown caret-icon-dropdown-with-btn">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
                    <span class="caret"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <a class="dropdown-item create-existing-campaign create-camp-popup" href="#" data-toggle="modal" data-target="#create-camp-btn">Create Campaign</a>
                     <a class="dropdown-item create-existing-campaign create-ad-popup" href="#" data-toggle="modal" data-target="#create-camp-btn">Create Ad</a>
                </div>
            </div>
        </div>
        <div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
            <a class="create-camp-btn duplicate-adset-click" href="#duplicate-adsets" data-toggle="modal"><i class="fa fa-copy"></i> Duplicate</a>
           <!--  <div class="dropdown caret-icon-dropdown-with-btn">
               <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
               <span class="caret"></span> 
               </button>
               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <a class="dropdown-item duplicate" rel="adset" href="#">Quick Duplicate</a> 
                 
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
           </div> -->
        </div>
        <div class="simple-default-icons-group" style="margin-left:10px">
            <ul>
                <li  id="delete_adsets"><i class="fa fa-trash disable-me"></i></li>
                <li class="dropdown export-menu">
                    <i class="fa fa-download dropdown-toggle" type="button" data-toggle="dropdown"></i>
                    <ul class="dropdown-menu export_campaigns">
                      <li data-toggle="modal" data-target="#loader_div"><a href="#">Export Selected</a></li>
                      <li data-toggle="modal" data-target="#loader_div"><a href="#" >Export Selected as Plain Text</a></li>
                      <li data-toggle="modal" data-target="#loader_div"><a href="#">Export All</a></li>
                  </ul>
                </li>
              <!--   <li><i class="fa fa-tag disable-me"></i></li> -->
            </ul>
        </div>
        <div class="single-btn-div" style="margin-left: 10px">
            <button class="light-grey-btn" style="height: 24px;" data-toggle="modal" data-target="#create-rule-btn">Create Rule</button>
          
        </div>
    </div>
    <div class="right-fil1">
        <ul>
            <?php include 'breakdown.php';?>
            <li>
                <a href="export.php/?type=adset&act=<?php echo $_GET['act']; ?>&code=<?php echo $_GET['code']; ?>"  style="color:#333"> <button class="light-grey-btn" style="height: 24px; line-height: normal;">Export</button></a>
            </li>
        </ul>
    </div>
</div>

<div class="table-result table-responsive ad-sets-third-tab-table">
    <div id="duplicate-adSet" class="modal fade duplicate-row-popup" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Duplicate Ad Set</h4>
                </div>
                <div class="modal-body">
                    <form class="form-inline">
                        <div class="form-group">
                            <label for="email">Number of duplicates</label>
                            <div class="input-group spinner">
                                <input type="text" class="form-control" value="42">
                                <div class="input-group-btn-vertical">
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                    <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
                    <button type="button" class="blue-btn" data-dismiss="modal">Create Duplicate</button>
                </div>
            </div>

        </div>
    </div>

    <?php     
        if($file == 'video_engagement'){
            include 'columns/video_engagement-adset.php';
        }elseif($file =='performance_and_click'){
            include 'columns/performance_and_click-adset.php';
        }else{
            include 'columns/performance-adset.php';          
        }
    ?>    
</div>

<!--delete camapigns -->
<div id="delete_adsets_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Delete Adset</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="delete_adset_id" id="delete_adset_id">
                <p>Are you sure you want to delete this adset?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" name="delete_adsets">Delete</button>
            </div>
        </form>
    </div>

  </div>
</div>
<!--delete camapigns -->
<!-- duplicate adsets -->
<div id="duplicate-adsets" class="modal fade duplicate-row-popup" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="form" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Duplicate Ad Set Into:</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div id="original_camapaigns" class="marginAll">
                            <input type="radio" name="campaign_for_adset" checked value="Original campaign"> Original campaign
                        </div>
                        <div id="already_all_camapaigns" class="marginAll">
                            <input type="radio" name="campaign_for_adset" value="Existing campaign"> Existing campaign
                            <div id="already_campaign" style="display: none; margin-top: 5px;">
                                <input type="hidden" name="already_campaign_id" id="already_campaign_id">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12 custom-auto-complete using-existing-camp-input">
                                            <input type="text" id="already_campaign_name" placeholder="select a camapaign" readonly class="form-control">
                                            <i class="fa fa-remove cross-existing-camp-icon"></i>
                                            <div class="custom-auto-complete-data custom-dropdown camp_list_adset_popup" style="width: 94%">
                                                <ul>
                                                    <?php foreach ($camapaigns['data'] as $camapaign) :?>
                                                        <li data-id="<?php echo $camapaign['id'];?>" data-name="<?php echo $camapaign['name']; ?>">
                                                            <b><?php echo $camapaign['name']; ?></b>
                                                            <p><?php echo $camapaign['id'];?> 
                                                                <?php if($camapaign['objective']) { ?><i class="fa fa-circle"></i> <?php echo $camapaign['objective']; } ?> 
                                                                <?php if($camapaign['buying_type']) { ?><i class="fa fa-circle"></i> <?php echo $camapaign['buying_type']; } ?>
                                                            </p>
                                                        </li>
                                                    <?php endforeach;?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div id="new_camapaigns" class="marginAll">
                            <input type="radio" name="campaign_for_adset" value="New campaign"> New campaign
                            <div id="new_camp" style="display: none; margin-top: 5px;"> 
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-12">
                                            <input type="text" name="campaign_name" placeholder="Enter a campaign name" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12">
                                        <label class="col-md-4">
                                            Buying Type
                                        </label>
                                        <div class="col-md-8">
                                            <div class="custom-autocomplete-select">
                                                <select class="selectpicker show-tick" name="buying_type">
                                                    <option data-tokens="ketchup mustard">Auction</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 10px;">
                                    <input type="hidden" id="camp_objective" name="objective" value="LINK_CLICKS">
                                    <div class="col-md-12">
                                        <label class="col-md-4">
                                            Campaign Objective
                                        </label>
                                        <div class="col-md-8">
                                            <button class="light-grey-btn show-camp-obj-btn camp_obj_name"><img src="img/brand-awarns-icon.png">Traffic</button>
                                            <div class="objective camp_objective">
                                                <div class="objective-cat">
                                                    <h5>Awareness</h5>
                                                    <ul>
                                                        <li data-value="BRAND_AWARENESS"><img src="img/brand-awarns-icon.png"> Brand awareness</li>
                                                        <li data-value="REACH"><img src="img/brand-awarns-icon.png"> Reach</li>
                                                    </ul>
                                                </div>
                                                <div class="objective-cat">
                                                    <h5>Consideration</h5>
                                                    <ul>
                                                        <li data-value="LINK_CLICKS"><img src="img/brand-awarns-icon.png"> Traffic</li>
                                                        <li data-value="APP_INSTALLS"><img src="img/brand-awarns-icon.png"> App installs</li>
                                                        <li data-value="VIDEO_VIEWS"><img src="img/brand-awarns-icon.png"> Video views</li>
                                                        <li data-value="LEAD_GENERATION"><img src="img/brand-awarns-icon.png"> Lead generation</li>
                                                        <li data-value="POST_ENGAGEMENT"><img src="img/brand-awarns-icon.png"> Post enagagement</li>
                                                        <li data-value="PAGE_LIKES"><img src="img/brand-awarns-icon.png"> Page likes</li>
                                                        <li data-value="EVENT_RESPONSES"><img src="img/brand-awarns-icon.png"> Event responses</li>
                                                        <li data-value="LINK_CLICKS"><img src="img/brand-awarns-icon.png"> Messages</li>
                                                    </ul>
                                                </div>
                                                <div class="objective-cat">
                                                    <h5>Conversion</h5>
                                                    <ul>
                                                        <li data-value="CONVERSIONS"><img src="img/brand-awarns-icon.png"> Conversions</li>
                                                        <li data-value="PRODUCT_CATALOG_SALES"><img src="img/brand-awarns-icon.png"> Product catalog sales</li>
                                                        <li data-value="LINK_CLICKS"><img src="img/brand-awarns-icon.png"> Store visits</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="email" class="custom-label">Number of copies of each ad set </label>
                        <div class="input-group spinner">
                            <input type="hidden" class="form-control" name="duplicate_adsets_id" id="duplicate_adsets_id">
                            <input type="text" class="form-control" value="1" name="duplicate_adsets_count" min="1">
                            <div class="input-group-btn-vertical">
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-up"></i></button>
                                <button class="btn btn-default" type="button"><i class="fa fa-caret-down"></i></button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="blue-btn" name="duplicates_adsets_saved">Save to Draft</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- duplicate adsets -->