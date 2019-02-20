<div class="thress-tabs-table-top-filters">
    <div class="left-fil1">
        <div class="btn-and-caret-icon-dropdown">

            <a href="#" class="create-camp-btn create-ad-popup" data-toggle="modal" data-target="#create-camp-btn">+ Create Ad</a>

            <!-- crate ad popup  -->
            <div id="create-ad-btn" class="modal fade common-three-tabs-popup" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create Ad</h4>
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
                            <button class="blue-btn">Save to Draft</button>
                        </div>
                    </div>

                </div>
            </div>
            <!-- crate ad popup ends  -->

            <div class="dropdown caret-icon-dropdown-with-btn">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
                    <span class="caret"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                   <a class="dropdown-item create-existing-campaign create-camp-popup" href="#" data-toggle="modal" data-target="#create-camp-btn">Create Campaign</a>
                    <a class="dropdown-item create-existing-campaign create-adset-popup" href="#" data-toggle="modal" data-target="#create-camp-btn">Create Adset</a>
                </div>
            </div>
        </div>
        <div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
            <a href="#" class="create-camp-btn"><i class="fa fa-copy"></i> Duplicate</a>
            <!-- <div class="dropdown caret-icon-dropdown-with-btn">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border-left:0">
                  <span class="caret"></span> 
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item duplicate" rel="ad" href="#">Quick Duplicate</a> 
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
        <div class="simple-default-icons-group " style="margin-left:10px">
            <ul>
                <li id="delete_ads" ><i class="fa fa-trash disable-me"></i></li>
                <li class="dropdown export-menu">
                    <i class="fa fa-download dropdown-toggle" type="button" data-toggle="dropdown"></i>
                    <ul class="dropdown-menu export_campaigns">
                      <li data-toggle="modal" data-target="#loader_div"><a href="#">Export Selected</a></li>
                      <li data-toggle="modal" data-target="#loader_div"><a href="#" >Export Selected as Plain Text</a></li>
                      <li data-toggle="modal" data-target="#loader_div"><a href="#">Export All</a></li>
                  </ul>
                </li>
              <!-- <li><i class="fa fa-tag disable-me"></i></li> -->
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
                  <a href="export.php/?type=ad&act=<?php echo $_GET['act']; ?>&code=<?php echo $_GET['code']; ?>"  style="color:#333"> <button class="light-grey-btn" style="height: 24px; line-height: normal;">Export</button></a>
            </li>
        </ul>
    </div>
</div>

<div class="table-result table-responsive ads-fourth-tab-table">
    <!--delete ads -->
<div id="delete_ads_popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Delete Ads</h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="delete_ads_id" id="delete_ads_id">
                <p>Are you sure you want to delete this ads?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" name="delete_adsets">Delete</button>
            </div>
        </form>
    </div>

  </div>
</div>
<!--delete ads -->
    <div id="duplicate-ads" class="modal fade duplicate-row-popup" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Duplicate Ads</h4>
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
            include 'columns/video_engagement-ad.php';
        }elseif($file =='performance_and_click'){
            include 'columns/performance_and_click-ad.php';
        }else{
             include 'columns/performance-ad.php';
             
        }
            ?>
</div>