   <div id="create-rule-btn" class="modal fade common-three-tabs-popup" role="dialog" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Create Rule</h4>
                        </div>
                        <form method="post" id="create_rule_form">
                        <div class="modal-body">
                            <div class="popup-left-form">
                                <div class="sec1">
                                    <p>Automatically update campaigns, ad sets or ads in bulk by creating automated rules.</p>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-3">
                                                Apply Rule To
                                            </label>
                                            <div class="col-md-9">
                                                <div class="custom-autocomplete-select">
                                                    <select class="selectpicker show-tick" name="entity_type" id="rule_entity_type">
                                                        
                                                        <option data-tokens="ketchup mustard" value="ADSET">All active ad sets </option>
                                                        <option data-tokens="ketchup mustard" value="CAMPAIGN">All active campaigns </option>
                                                        <option data-tokens="ketchup mustard" value="AD">All active ads </option>
                                                    </select>
                                                </div>
                                                <p style="color: #999">Your rule will apply to campaigns that are active at the time the rule runs</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-3">
                                                Action
                                            </label>
                                            <div class="col-md-9">
                                                <div class="custom-autocomplete-select">
                                                    <select class="selectpicker show-tick" name="execution_type" id="exc_type_rule">
                                                        <option data-tokens="ketchup mustard" value="PAUSE">Turn Off </option>
                                                        <option data-tokens="ketchup mustard" value="UNPAUSE">Turn On </option>
                                                        <option data-tokens="ketchup mustard" value="NOTIFICATION">Send Notification Only </option>
                                                        <optgroup label="Adjust Budget"  class="bug_bid_outgrp">
                                                            <option data-tokens="ketchup mustard" value="CHANGE_BUDGET_IN"> Increase Daily Budget By</option>
                                                            <option data-tokens="ketchup mustard" value="CHANGE_BUDGET_DEC"> Decrease Daily Budget By</option>
                                                        </optgroup>
                                                         <optgroup label="Adjust Manual Bid" class="bug_bid_outgrp">
                                                            <option data-tokens="ketchup mustard" value="CHANGE_BID_IN"> Increase Bid By</option>
                                                            <option data-tokens="ketchup mustard" value="CHANGE_BID_DEC"> Decrease Bid By</option>
                                                        </optgroup>                                                         
                                                    </select>
                                                    <span class="bugget_bid">
                                                        <input type="text" name="execution_type_value" id="execution_type_value">
                                                        <select class="selectpicker show-tick" name="execution_type_unit"  id="execution_type_unit">
                                                            <option value="ACCOUNT_CURRENCY">$</option>
                                                            <option value="PERCENTAGE">%</option>
                                                        </select>
                                                    </span>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-3">
                                                Conditions <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </label>
                                            <div class="col-md-9 conditions-btw">
                                                <p style="margin: 0">ALL of the following match</p>

                                                <span class="selected_filters">
                                                   
                                                </span>
                                                <div class="custom-autocomplete-select conditions-btw-right" id="filter_select">
                                                    <select class="selectpicker show-tick filter_name" data-size="5" name="filter_name" id="filter_name">
                                                        <optgroup label="Most Common">
                                                            <option >Spent </option>
                                                            <option >Lifetime Spent </option>
                                                            <option >Frequency </option>
                                                            <option >Results </option>                                                          
                                                            <option >Mobile App Install </option>
                                                            <option >Cost per mobile cost</option>
                                                            <option >Hours Since Creation </option>
                                                        </optgroup>
                                                        <optgroup label="Website Convertions">
                                                            <!-- <option>All websites convertions</option>
                                                            <option>Adds Payment Info</option>
                                                            <option> Adds to cart </option>
                                                            <option>Adds To wishlist</option>
                                                            <option>Completed Registration</option> -->
                                                           <!--  <option>Initiates Checkout</option> -->
                                                            <!-- <option>Leads</option> -->
                                                           <!--  <option>Purchases</option>
                                                           <option>Searches</option>
                                                           <option>Views Content</option>
                                                           <option>Other Websites</option> -->
                                                        </optgroup>
                                                       <!--  <optgroup label="Cost per website Conversion">
                                                           <option>Cost per add payment info</option>
                                                           <option>Cost per add to cart</option>
                                                           <option>Cost per add to wishlist</option>
                                                           <option>Cost Per Completed Registration</option>
                                                           <option>Cost Per Initiates Checkout</option>
                                                           <option>Cost Per Leads</option>
                                                           <option>Cost Per Purchases</option>
                                                           <option>Cost Per Searches</option>
                                                           <option>Cost Per Views Content</option>
                                                       </optgroup> -->
                                                     <!--    <optgroup label="Mobile App Events">
                                                         <option>All mobile app events</option>
                                                         <option>Mobile app featur unlock</option>
                                                         <option>Mobile App starts</option>
                                                         <option>Mobile app payment Detail</option>
                                                         <option>Mobile app Adds to cart (facebook Pixel) </option>
                                                         <option>Mobile app Adds To wishlist</option>
                                                         <option>Mobile app Registration</option>
                                                         <option>Mobile app Checkout</option>
                                                         <option>Mobile app Acheivments</option>
                                                         <option>Mobile app Purchases</option>
                                                         <option>Mobile app Searches</option>
                                                         <option>Mobile app credit Spends</option>
                                                         <option>Mobile app tutorial complitions</option>
                                                         <option>Other mobile app actions</option>
                                                     </optgroup> -->
                                                    <!-- <optgroup label="Cost Per Mobile App Events">
                                                       <option>Cost Per All mobile app events</option>
                                                      <option>Cost Per Mobile app featur unlock</option>
                                                      <option>Cost Per Mobile App starts</option>
                                                      <option>Cost Per Mobile app payment Detail</option>
                                                      <option>Cost Per Mobile app Adds to cart  </option>
                                                      <option>Cost Per Mobile app Adds To wishlist</option>
                                                      <option>Cost Per Mobile app Registration</option>
                                                      <option>Cost Per Mobile app Checkout</option>
                                                      <option>Cost Per Mobile app Acheivments</option>
                                                      <option>Cost Per Mobile app Purchases</option>
                                                      <option>Cost Per Mobile app Searches</option>
                                                      <option>Cost Per Mobile app credit Spends</option> 
                                                       <option>Cost Per Mobile app tutorial complitions</option>                                                          
                                                         </optgroup> -->
                                                         <optgroup label="Other">
                                                            <option>CPC</option>
                                                            <option>CPM</option>
                                                            <option>CTR</option>
                                                            <option value="impressions">Impressions</option>
                                                            <option value="reach">Reach</option>
                                                            <option>Leads</option>
                                                            <option>Actions</option>
                                                            <option>Clicks</option>
                                                            <option>CPA</option>
                                                            <option>CPC</option>
                                                            <option>CPP</option>
                                                            <option>CTR</option>
                                                            <option>Result Rate</option>
                                                            <option>Social Clicks</option>
                                                            <option value="social_impressions">Social Impressions</option>
                                                            <option>Unique Clicks</option>
                                                            <option>Unique Social Clicks</option>
                                                            <option value="unique_impressions">Unique Social Impressions</option>
                                                            <option>Today Spent</option>
                                                            <option>Yesterday Spent</option>
                                                         </optgroup>
                                                    </select>
                                                    <select class="selectpicker show-tick rule_operater filter_operater" name="filter_operater"  id="filter_operater">                                                        
                                                        <option data-tokens="ketchup mustard" value="GREATER_THAN"> is greater than</option>
                                                        <option data-tokens="ketchup mustard" value="LESS_THAN" >is smaller than</option>
                                                        <option data-tokens="ketchup mustard" value="IN_RANGE">is between</option>
                                                        <option data-tokens="ketchup mustard" value="NOT_IN_RANGE">is not between</option>
                                                    </select>
                                                    <span class="bet">
                                                        <input type="text" name="filter_from" class="filter_from"> -
                                                        <input type="text" name="filter_to" class="filter_to">
                                                    </span>
                                                    <span class="remain">
                                                        <input type="text" name="filter_value" class="filter_value">
                                                    </span>
                                                    <a href="javascript:void(0)" class="filter_add">+</a>

                                                </div>
                                                <div class="sub-label-and-field">
                                                    <label>Time Range <i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                    <div class="custom-autocomplete-select">
                                                        <select class="selectpicker show-tick" name="time_preset">
                                                            <option data-tokens="ketchup mustard" value="TODAY">Today</option>
                                                            <option data-tokens="ketchup mustard" value="YESTERDAY">Yesterday</option>
                                                            <option data-tokens="ketchup mustard" value="YESTERDAY">Previous days</option>
                                                            <option data-tokens="ketchup mustard" value="LAST_3_DAYS">Last 3 days</option>
                                                            <option data-tokens="ketchup mustard" value="LAST_7_DAYS">Last 7 days</option>
                                                            <option data-tokens="ketchup mustard" value="LAST_14_DAYS">Last 14 days</option>
                                                            <option data-tokens="ketchup mustard" value="LAST_30_DAYS">Last 30 days</option>
                                                            <option data-tokens="ketchup mustard" value="LIFETIME">Lifetime</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="sub-label-and-field">
                                                    <label>Attribution Window <i class="fa fa-info-circle" aria-hidden="true"></i></label>
                                                    <p>1 day after viewing ad and 28 days after clicking on ad</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-3 label-for-p">
                                                Frequency <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </label>
                                            <div class="col-md-9">
                                                <p> <b>Continuously -</b> This rule will run as often as possible (usually every 30 minutes).</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-3 label-for-p">
                                                Notification <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </label>
                                            <div class="col-md-9">
                                                <p> <b>	On Facebook -</b> You'll get a notification when conditions for this rule are met.</p>
                                                <p>
                                                    <input type="checkbox"><b>Email -</b>Include results from this rule to an email sent once per day when any of your rules have conditions that are met or new rules are created.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-3 label-for-p">
                                                Subscriber <i class="fa fa-info-circle" aria-hidden="true"></i>
                                            </label>
                                            <div class="col-md-9">
                                                <p><b><?php echo $accounts['data'][0]['name']; ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="col-md-3">
                                                Rule Name
                                            </label>
                                            <div class="col-md-9">
                                            <input type="hidden" name="act" value="<?php echo $_GET['act']; ?>">
                                            <input type="hidden" name="access_token" value="<?php echo $_GET['code']; ?>">
                                            <input type="text" name="rule_name" placeholder="Rule Name" class="form-control rule_name" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--  <div class="popup-right-form col-md-4">sds</div> -->
                        </div>
                        <div class="modal-footer">
                        <!--     <button type="button" class="light-grey-btn" data-dismiss="modal" style="float: left;">Preview</button><span class="preview-span">Create at least one condition to see a preview of results.</span> -->
                            <button class="light-grey-btn" data-dismiss="modal">Cancel</button>
                            <button class="blue-btn submit_rule_form">Create</button>
                        </div>
                        </form>
                    </div>

                </div>
            </div>


<!-- rule created -->
<div id="add_rule_creation" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <form method="post">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title">Add Rule</h4>
            </div>
            <div class="modal-body">
              
                <p class="rule_creation_msg"> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" >OK</button>               
            </div>
        </form>
    </div>

  </div>
</div>
<!--rule created -->