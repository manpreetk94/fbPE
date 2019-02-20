<?php 
session_start();
if(isset($_SESSION['user'])) :
	/*get accounts of selected user*/
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.10/me/adaccounts?fields=account_status,name,account_id,business&access_token=".$_REQUEST['code']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$accounts = json_decode($result, true);
	/*get accounts of selected user*/
	/*get camapagins*/
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.10/".$_REQUEST['act']."/campaigns?access_token=".$_REQUEST['code']."&fields=name,buying_type,objective,id,objective_for_results,objective_for_cost,status,delivery_info,start_time,stop_time,insights{reach,impressions,frequency,unique_clicks,spend},adsets{id,name,status,delivery_info,lifetime_budget,daily_budget,start_time,end_time,objective_for_results,objective_for_cost,targeting_age_min,targeting_age_max,targeting_genders,targeting_countries,activities{actor_name,event_time,application_name,translated_event_type,extra_data},insights{reach,frequency,impressions,unique_clicks,spend}},account_id,ads{name,id,delivery_info,objective_for_results,objective_for_cost,status,insights{frequency,impressions,spend,unique_clicks,total_unique_actions,relevance_score,reach}}");
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$camapaigns = json_decode($result, true);
    /* echo '<pre>';
     print_r($camapaigns);
     die;
	*/
	/*get camapagins*/
?>
<!DOCTYPE html>
<html>
<head>
<title>FB Power-Editor</title>
<script type="text/javascript">
	var _camapaigns = <?php echo json_encode($camapaigns['data']); ?>;
</script>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/jscolor.js"></script>

<!-- Include Date Range Picker -->
<script type="text/javascript" src="js/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lodash@4.17.4/lodash.min.js"></script>


<script type="text/javascript">
	$(document).ready(function() {
		$('.listing .account-category').click(function(){
			$('.account-category').removeClass('active');
			$(this).addClass('active');
			$('.current_account').text($(this).find('.account_name').text()+' ('+$(this).find('.account_id').text()+')');
			var url = window.location.toString();
			console.log('url', url);
			var act = '<?php echo $_REQUEST['act'];?>';
			window.location = url.replace(act, 'act_'+$(this).find('.account_id').text());
			$(".personal-acc-by-id").slideToggle();
		});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".ads-preview-dropd-down-list a").click(function(event) {
			$(".ads-preview-dropd-down-list ul").toggle();   	  	
		});
	});
</script>
<!-- main three tabs create new popup -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".show-camp-obj-btn").click(function(event) {
			$(".objective").toggle();   	  	
		});
	});
</script>
<!-- new-customer dropdown -->
<script type="text/javascript">
	$(document).ready(function() {
		$(".get-new-customer").click(function(event) {
			$(".three-new-customers-list").toggle();   	  	
		});
	});
</script>
 
 <!-- two tabs three radio options script -->
 <script type="text/javascript">
 	$( document ).ready(function () {
        $('#img-vid').click(function () {
            $('.two-tabs-first-radio').show();
            $('.two-tabs-second-radio').hide();
            $('.two-tabs-third-radio').hide();
        });
        $('#mul-img').click(function () {
            $('.two-tabs-first-radio').hide();
            $('.two-tabs-second-radio').show();
            $('.two-tabs-third-radio').hide();
        });
        $('#img-coll').click(function () {
            $('.two-tabs-first-radio').hide();
            $('.two-tabs-second-radio').hide();
            $('.two-tabs-third-radio').show();
        });
     });    
 </script>

 <!-- add image in popup radio option script -->
 <script type="text/javascript">
 $(document).ready(function() {
	 $('.thumbCheck').click(function () {
        if ($('input:not(:checked)')) {
            $('div').removeClass('selected-img-thumb');
        }
        if ($('input').is(':checked')) {
            $(this).parent().addClass('selected-img-thumb');           
        }
    });
});
 </script>
</head>
<body>

<div class="web-outr">	
	<div class="header-outr">
		<div class="header-inr">		 
			<div class="container-fluid">
				<div class="header-left-sec">			
					<a href="#" class="logo"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
					<div class="power-editor-dropdown">
						<a href="#" class="power-editor-menu"><i class="fa fa-list" aria-hidden="true"></i><span>Power Editor</span></a>
						
					</div>
				</div>
				<div class="power-editor-menus-list">
					<div class="power-menu">
						<span class="menu-arrow"></span>
						<ul>
							<li><h5><i class="fa fa-star" aria-hidden="true"></i> Frequently Used</h5></li>
							<li><a href="ads-manager.html">Ads Manager</a></li>
							<li><a href="index.html" class="active">Power Editor</a></li>
						</ul>
					</div>
				</div>
				<div class="header-right-ec pull-right">
					<div class="header-search">
						 <div class="input-group stylish-input-group">
		                    <input type="text" class="form-control"  placeholder="Search" >
		                    <span class="input-group-addon">
		                        <button type="submit">
		                            <span class="glyphicon glyphicon-search"></span>
		                        </button>  
		                    </span>
		                </div>
					</div>
					<ul class="header-avatar">
						<li>
							 
								<div class="dropdown header-ava">
								  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <img src="img/ava-icon.png"> <?php echo $_SESSION['user']['email']; ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
								  </button>
								  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">	
								  	<span class="top-arrow"></span>		
								  	<ul>
								  		<li>
								  		<a class="dropdown-item" href="#">Go to Personal News Feed</a><a class="dropdown-item pull-right" href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
								  		</li>
								  		<li>
								  			<div class="different-acc">
								  				<img src="img/acc-img.png">
								  				<p><b>Lorem ipsum dummy text</b><?php echo $_SESSION['user']['email']; ?></p>
								  			</div>
								  		</li>
								  		<li>
								  			<div class="different-acc active">
								  				<img src="img/acc-img.png">
								  				<p><b>Lorem ipsum dummy text</b><?php echo $_SESSION['user']['email']; ?></p>
								  			</div>
								  		</li>
								  		<li>
								  			<div class="different-acc">
								  				<img src="img/acc-img.png">
								  				<p><b>Lorem ipsum dummy text</b><?php echo $_SESSION['user']['email']; ?></p>
								  			</div>
								  		</li>
								  	</ul>					    
								    
								  </div>
								</div>
						</li>
						
					</ul>
					<ul class="header-right-icons">
						<li><a href="#" class="notification"><i class="fa fa-globe" aria-hidden="true"></i></a></li>
						<li><a href="#" class="header-pages"><i class="fa fa-flag" aria-hidden="true"></i></a></li>					
					</ul>
					<!-- <a href="#" class="help">Help <i class="fa fa-question-circle" aria-hidden="true"></i></a> -->
				</div>
			</div>		 
		</div>
	</div>
	<div class="body-overlay"></div>
	<div class="working-area-outr">
		<div class="sub-header-outr">
			<div class="sub-header-inr">
				<div class="container-fluid">	
						<div class="sub-header-left-acnt-sec">
								<a href="#"><span class="current_account"><?php echo $accounts['data'][0]['name']." (".str_replace('act_', '', $_REQUEST['act']).")";?></span> <i class="fa fa-caret-down" aria-hidden="true"></i></a>
									<div class="personal-acc-by-id-outr">

										<div class="personal-acc-by-id">
											<span class="top-arrow"></span>
											<ul><li style="padding: 15px;"><input type="text" name="" class="form-control" placeholder="Search"></li></ul>
											<ul class="listing">										
												<li>
													<h5><img src="img/prsnl-acnt-icon.png"> your personal accounts</h5>
													<?php foreach ($accounts['data'] as $key => $account): ?>
														<?php if($account['id'] == $_REQUEST['act']): $acc_class = 'active'; else : $acc_class = ''; endif ?>
														<div class="account-category <?php echo $acc_class;?>">
															<img src="img/acnt-by-id-icon.png">
															<p>
																<span class="account_name"><b><?php echo $account['name'];?></b></span>
																Account #: <span class="account_id"><?php echo $account['account_id'];?></span>
															</p>
														</div>
													<?php endforeach ?>	
													<!-- <div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category active">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div> -->
												</li>
												<!-- <li>
													<h5><img src="img/prsnl-acnt-icon.png"> your personal accounts</h5>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
												</li>
												<li>
													<h5><img src="img/prsnl-acnt-icon.png"> your personal accounts</h5>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
													<div class="account-category">
														<img src="img/acnt-by-id-icon.png">
														<p><b>Lorem Ipsum Account</b>Account #: 156893694872356</p>
													</div>
												</li> -->
											</ul>
											
										</div>
									</div>		
						</div>
						<div class="sub-header-right-btns-sec">
							<ul>
									<li><button class="light-grey-btn">Discard Changes</button></li>
									<li><button class="blue-btn"><i class="fa fa-arrow-up" aria-hidden="true"></i> Review Draft Items (3)</button></li>
									<li><button class="light-grey-btn"><i class="fa fa-gear" aria-hidden="true"></i></button></li>
							</ul>
						</div>
				</div>
			</div>
		</div>
		<div class="filter-header-outr">
				<div class="filter-header-inr">
						<div class="container-fluid">
							<div class="dropdown search-filter">
								 <div class="dropdown">
									  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    <i class="fa fa-search" aria-hidden="true"></i> Search
									    <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									  	<li class="dropdown-header">Search By</li>
									    <li><a href="#">Action</a></li>
									    <li><a href="#">Another action</a></li>
									    <li><a href="#">Something else here</a></li>									    
									  </ul>
									</div>
							</div>
							<div class="header-filter">
					            <div class="dropdown">
									  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									    <i class="fa fa-filter" aria-hidden="true"></i> Filters
									    <span class="caret"></span>
									  </button>
									  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
									  	<li class="dropdown-header">Search By</li>
									    <li><a href="#">Action</a></li>
									    <li><a href="#">Another action</a></li>
									    <li><a href="#">Something else here</a></li>									    
									  </ul>
									</div>
							</div>						 
							<div class="filter-by-date">
								<div id="demo" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
					    			<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
								    <span></span> <b class="caret"></b>
								</div>
							</div>
						</div>
				</div>
		</div>
		<div class="working-area">
			<div class="main-four-tabs">
			    <div class=" " style="float: left; width: 100%">
		            <div class="tab four-tabs" role="tabpanel">

		                <!-- Nav tabs -->

		                <ul class="nav nav-tabs main-tabs" role="tablist" style="margin-left: 1px;">

		                    <li role="presentation" class="acc-rev"><a href="#acc-rev" aria-controls="home" role="tab" data-toggle="tab">Account Overview</a></li>

		                    <li role="presentation" class="active camp"><a href="#camp" aria-controls="profile" role="tab" data-toggle="tab">Campaigns</a>
		                    	<div class="selected-row-count" id="camapaign_selected" style="display: none;"><span>2</span> selected <i class="fa fa-times" aria-hidden="true"></i></div>
		                    </li>

		                    <li role="presentation" class="ad-sets"><a href="#ad-sets" aria-controls="messages" role="tab" data-toggle="tab">Ad Sets<span></span></a>
								<div class="selected-row-count" id="adsets_selected" style="display: none;"><span>2</span> selected <i class="fa fa-times" aria-hidden="true"></i></div>
		                    </li>

		                    <li role="presentation" class="ads"><a href="#ads" aria-controls="settings" role="tab" data-toggle="tab">Ads<span></span></a>
								<div class="selected-row-count" id="ads_selected" style="display: none;"><span>2</span> selected <i class="fa fa-times" aria-hidden="true"></i></div>
		                    </li>

		                </ul>

		                <!-- Tab panes content goes here-->

		                <div class="tab-content main-tabs-entries">

		                    <div role="tabpanel" class="tab-pane acc-data-tabs" id="acc-rev">
		                    	<div class="col-md-10" style="padding: 0">

	                                    <!-- Nav tabs -->
	                                    <div class="card">
		                                    <ul class="nav nav-tabs four-sub-tabs" role="tablist">
		                                        <li role="presentation" class="active">
		                                        	<a href="#reach" aria-controls="home" role="tab" data-toggle="tab">
		                                        		<div class="reach">
		                                        				<div class="rel-cont">Reach <i class="fa fa-info-circle" aria-hidden="true"></i></div>
		                                        				<span class="sub-tab-down-arrow-search">		                                        					
		                                        					<div class="down-arrow-custom-auto-select">
		                                        						<!-- <i class="fa fa-caret-down caret-show-select" aria-hidden="true"></i> -->
		                                        						 <div class="custom-autocomplete-select">
																			<select class="selectpicker select-green-text show-tick" data-live-search="true">
																			  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																			  <option data-tokens="mustard">Lorem</option>
																			  <option data-tokens="frosting">Dummy text printing</option>
																			  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																			  <option data-tokens="mustard">Lorem</option>
																			  <option data-tokens="frosting">Dummy text printing</option>
																			  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																			  <option data-tokens="mustard">Lorem</option>
																			  <option data-tokens="frosting">Dummy text printing</option>
																			</select>

							                                        	</div>
		                                        					</div>
		                                        				</span>
		                                        		</div>
		                                        		<b class="count-in-number"><i class="fa fa-rupee" aria-hidden="true"></i> 25</b>
		                                        	</a>
		                                    	</li>
		                                        <li role="presentation">
		                                        	<a href="#spent" aria-controls="profile" role="tab" data-toggle="tab">
		                                    			<div class="spent-amt">
		                                    				Amount Spent <i class="fa fa-info-circle" aria-hidden="true"></i><span class="sub-tab-down-arrow-search"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
			                                    		</div>
			                                    		<b class="count-in-number"><i class="fa fa-rupee" aria-hidden="true"></i> 25</b>
		                                        	</a>

		                                    	</li>
		                                        <li role="presentation">
		                                    		<a href="#impression" aria-controls="messages" role="tab" data-toggle="tab">
			                                    		<div class="impre">
			                                				Impressions <i class="fa fa-info-circle" aria-hidden="true"></i><span class="sub-tab-down-arrow-search"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
			                                    		</div>
			                                    		<b class="count-in-number"><i class="fa fa-rupee" aria-hidden="true"></i> 25</b>			
		                                    		</a>
		                                        </li>
		                                        <li role="presentation">
		                                        	<a href="#link-clicks" aria-controls="settings" role="tab" data-toggle="tab">
		                                        		<div class="link-clicks">
		                                    				Link Clicks <i class="fa fa-info-circle" aria-hidden="true"></i><span class="sub-tab-down-arrow-search"><i class="fa fa-caret-down" aria-hidden="true"></i></span>
			                                    		</div>
			                                    		<b class="count-in-number"><i class="fa fa-rupee" aria-hidden="true"></i> 25</b>
		                                        	</a> 
		                                        </li>
		                                    </ul>

		                                    <!-- Tab panes -->
		                                    <div class="tab-content">
		                                        <div role="tabpanel" class="tab-pane active" id="reach">
		                                        	<div class="no-result-found">
		                                        			<img src="img/no-result-img.jpg"><br>	
		                                        			<b>No Activity During Date Range</b><br>
		                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
		                                        	</div>	
		                                        </div>
		                                        <div role="tabpanel" class="tab-pane" id="spent">
		                                        	<div class="no-result-found">
		                                        			<img src="img/no-result-img.jpg"><br>	
		                                        			<b>No Activity During Date Range</b><br>
		                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
		                                        	</div>		
		                                        </div>
		                                        <div role="tabpanel" class="tab-pane" id="impression">
		                                        	<div class="no-result-found">
		                                        			<img src="img/no-result-img.jpg"><br>	
		                                        			<b>No Activity During Date Range</b><br>
		                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
		                                        	</div>	
		                                        </div>
		                                        <div role="tabpanel" class="tab-pane" id="link-clicks">
		                                        	<div class="no-result-found">
		                                        			<img src="img/no-result-img.jpg"><br>	
		                                        			<b>No Activity During Date Range</b><br>
		                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
		                                        	</div>	
		                                        </div>
		                                    </div>
			
	                                	</div>
	                                	<div class="table-result">
											<table class="table">
											  <thead class="thead-default">
											    <tr>
											      <th>Objective</th>
											      <th>Results</th>
											      <th>Cost per Result</th>
											      <th>Reach</th>
											      <th>Amount Spent</th>
											    </tr>
											  </thead>
											  <tbody>
											    <tr>
											      <td>-</td>
											      <td>-</td>
											      <td>-</td>
											      <td>-</td>
											      <td>-</td>
											    </tr>										
											  </tbody>
											</table>
	                                	</div>
	                                	<div class="row"> 
	                                		<div class="col-md-6">
				                                	<div class="age-area">
				                                	   <div class="card">
					                                    <ul class="nav nav-tabs" role="tablist">
					                                        <li role="presentation" class="active">
					                                        	<a href="#age-gender" aria-controls="home" role="tab" data-toggle="tab">
					                                        		Age and Gender
					                                        		 
					                                        	</a>
					                                    	</li>
					                                        <li role="presentation">
					                                        	<a href="#age" aria-controls="profile" role="tab" data-toggle="tab">	 
					                                    			Age		                                    	 		                                    		 
					                                        	</a>
					                                    	</li>
					                                        <li role="presentation">
					                                    		<a href="#gender" aria-controls="messages" role="tab" data-toggle="tab">		                         		
						                                			Gender 	
					                                    		</a>
					                                        </li>
					                                       
					                                    </ul>
					                                     
					                                    <div class="tab-content">
					                                        <div role="tabpanel" class="tab-pane active" id="age-gender">
					                                        	<div class="custom-autocomplete-select">
					                                        		<select class="selectpicker select-blue-text show-tick" data-live-search="true">
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	</select>

																	<select class="selectpicker select-green-text show-tick" data-live-search="true">
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	</select>

					                                        	</div>
					                                        	<div class="no-result-found">
					                                        			<img src="img/no-result-img.jpg"><br>	
					                                        			<b>No Activity During Date Range</b><br>
					                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
					                                        	</div>	


					                                        </div>
					                                        <div role="tabpanel" class="tab-pane" id="age">
					                                        	<div class="custom-autocomplete-select">
					                                        		<select class="selectpicker select-blue-text show-tick" data-live-search="true">
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	</select>

																	<select class="selectpicker select-green-text show-tick" data-live-search="true">
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	</select>

					                                        	</div>
					                                        	<div class="no-result-found">
					                                        			<img src="img/no-result-img.jpg"><br>	
					                                        			<b>No Activity During Date Range</b><br>
					                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
					                                        	</div>


					                                        </div>
					                                        <div role="tabpanel" class="tab-pane" id="gender">
					                                        		<div class="custom-autocomplete-select">
					                                        		<select class="selectpicker select-blue-text show-tick" data-live-search="true">
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	</select>

																	<select class="selectpicker select-green-text show-tick" data-live-search="true">
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	</select>

					                                        	</div>
					                                        	<div class="no-result-found">
					                                        			<img src="img/no-result-img.jpg"><br>	
					                                        			<b>No Activity During Date Range</b><br>
					                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
					                                        	</div>
					                                        </div>
					                                        
					                                    </div>
									
				                                	</div>
				                                	</div>
				                            </div>    	
				                            <div class="col-md-6">
				                                	<div class="hours-area">
				                                	   <div class="card">
					                                    <ul class="nav nav-tabs" role="tablist">
					                                        <li role="presentation" class="active">
					                                        	<a href="#age-gender" aria-controls="home" role="tab" data-toggle="tab">
					                                        		Hour				                                        		 
					                                        	</a>
					                                    	</li>
					                                        
					                                       
					                                    </ul>
					                                     
					                                    <div class="tab-content">
					                                        <div role="tabpanel" class="tab-pane active" id="age-gender">
					                                        	<div class="custom-autocomplete-select">
					                                        		<select class="selectpicker select-blue-text show-tick" data-live-search="true">
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	</select>

																	<select class="selectpicker select-green-text show-tick" data-live-search="true">
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																	  <option data-tokens="mustard">Lorem</option>
																	  <option data-tokens="frosting">Dummy text printing</option>
																	</select>

					                                        	</div>
					                                        	<div class="no-result-found">
					                                        			<img src="img/no-result-img.jpg"><br>	
					                                        			<b>No Activity During Date Range</b><br>
					                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
					                                        	</div>
					                                        </div>	                                       	                                        
					                                    </div>		
				                                	</div>
				                                	</div>
		                                	</div>
		                                </div>	
		                                <div class="location-section">
		                                	<div class="row">
		                                			<div class="col-md-12">
		                                					<h1>Location</h1>
		                                					<div class="col-md-2 location-radio-selection">
		                                						 <form>
																	    <label class="radio-inline">
																	      <input type="radio" name="optradio">Country
																	    </label>
																	    <label class="radio-inline">
																	      <input type="radio" name="optradio">Region
																	    </label>
																	    <label class="radio-inline">
																	      <input type="radio" name="optradio">DMA Region
																	    </label>
																	  </form>
		                                					</div>
		                                					<div class="col-md-10 location-map">
		                                							<div class="map-result">
		                                									<img src="img/map-img.jpg">
		                                							</div>
		                                							<div class="select-on-map">
		                                									<div class="custom-autocomplete-select">
																				<select class="selectpicker  show-tick" data-live-search="true">
																				  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																				  <option data-tokens="mustard">Lorem</option>
																				  <option data-tokens="frosting">Dummy text printing</option>
																				  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
																				   
																				</select>

					                                        				</div>
		                                							</div>
		                                					</div>
		                                			</div>
		                                	</div>
		                                </div>
		                                <div class="account-bottom-custom-table">
		                                		<div class="col-md-12" style="padding: 0">
		                                				<div class="top-custom-colums-dropdown pull-right">
		                                					<div class="dropdown custm-columns">
															  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
															    Columns
															    <span class="caret"></span>
															  </button>
															  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
															    <li><a href="#">Action</a></li>
															    <li><a href="#">Another action</a></li>
															    <li><a href="#">Something else here</a></li>									    
															  </ul>
															</div>

															<div class="dropdown breakdowns">
															  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
															    Breakdown
															    <span class="caret"></span>
															  </button>
															  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
															  	<li><a href="">Clear All Breakdowns</a></li>
															  	<li class="dropdown-header">By delivery</li>
															    <li><a href="#">Action</a></li>
															    <li><a href="#">Another action</a></li>
															    <li><a href="#">Something else here</a></li>									    
															  </ul>
															</div>

		                                				</div>
		                                				<div class="col-md-12 acc-table-result">
								                                <div class="table-result">
																	<table class="table">
																	  <thead class="thead-default">
																	    <tr>
																	      <th>Account Name</th>
																	      <th>Results</th>
																	      <th>Reach</th>																       
																	      <th>Amount Spent</th>
																	      <th>Frequency</th>
																	      <th>Impressions</th>
																	      <th>Unique Link Clicks</th>
																	    </tr>
																	  </thead>
																	  <tbody>
																	    <tr>
																	      <td>Johnaccount</td>
																	      <td>-</td>
																	      <td>-</td>
																	      <td>-</td>
																	      <td>-</td>
																	      <td>-</td>
																	      <td>-</td>
																	    </tr>										
																	  </tbody>
																	</table>
							                                	</div>
		                                				</div>
		                                		</div>
		                                </div>
		                    	</div>
		                    	<div class="col-md-2 right-area" style="padding-right: 0">
		                    			<div class="cost-summary">
		                    					<h5>Account Spending Limit <i class="fa fa-info-circle" aria-hidden="true"></i></h5>
		                    					<img src="img/amount-slider.jpg">
		                    					<p><b>&#8377; 330.00</b> spent toward limit.</p>
		                    					<p><b>&#8377; 330.00</b> limit.</p>
		                    					<p><a href="">Manage Billing & Payments</a></p>
		                    			</div>
		                    	</div>
		                    </div>

		                    <div role="tabpanel" class="tab-pane active" id="camp">
		                    	<div class="thress-tabs-table-top-filters">
		                    		<div class="left-fil1">
				                    		<div class="btn-and-caret-icon-dropdown">
				                    			<a href="#" class="create-camp-btn" data-toggle="modal" data-target="#create-camp-btn">+ Create Campaign</a>
				                    			<!-- craete camp popup  -->
				                    			<div id="create-camp-btn" class="modal fade common-three-tabs-popup" role="dialog">
												  <div class="modal-dialog">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">Create Campaign</h4>
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
																					  <option data-tokens="ketchup mustard">Create New Campaign</option>
																					  <option data-tokens="mustard">Use Existing Campaign</option>
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
																					  <option data-tokens="ketchup mustard">Create New Campaign</option>
																					  <option data-tokens="mustard">Use Existing Campaign</option>
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
												<!-- craete camp popup ends  -->
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
											</div>	
											<div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
				                    			<a href="#" class="create-camp-btn"><i class="fa fa-copy"></i> Duplicate</a>
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
											</div>	
											<div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
				                    			<a href="#" class="create-camp-btn"><i class="fa fa-pencil"></i> Edit</a>
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
											</div>	
											<div class="simple-default-icons-group " style="margin-left:10px">	
												<ul>
													<li><i class="fa fa-refresh disable-me"></i></li>
													<li><i class="fa fa-trash disable-me"></i></li>
													<li><i class="fa fa-edit"></i></li>
													<li><i class="fa fa-tag disable-me"></i></li>
												</ul>
											</div>
											<div class="single-btn-div" style="margin-left: 10px">
												<button class="light-grey-btn" style="height: 24px;" data-toggle="modal" data-target="#create-rule-btn">Create Rule</button>
												<!-- create rule popup  -->
				                    			<div id="create-rule-btn" class="modal fade common-three-tabs-popup" role="dialog">
												  <div class="modal-dialog">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">Create Rule</h4>
												      </div>
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
										                                        		<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">All active campaigns </option>
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
										                                        		<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">Turn off campaigns</option>
																						</select>													
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
																					 <div class="custom-autocomplete-select conditions-btw-right">	
																						<select class="selectpicker show-tick" data-size="5">
																						  <optgroup label="Picnic">
																						    <option>cost per mobile app install </option>
																						    <option>Ketchup </option>
																						    <option>Relish </option>
																						  </optgroup>
																						  <optgroup label="Camping">
																						    <option>Tent </option>
																						    <option>Flashlight </option>
																						    <option>Toilet Paper </option>
																						  </optgroup>
																						</select>
																						<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">is not between</option>
																						</select>
																						<input type="text" name=""> - <input type="text" name="">
																						<a href="#">x</a>
										                                        	</div>
										                                        	<div class="sub-label-and-field">
										                                        		<label>Time Range <i class="fa fa-info-circle" aria-hidden="true"></i></label>
										                                        		<div class="custom-autocomplete-select">
											                                        		<select class="selectpicker show-tick">
																							  <option data-tokens="ketchup mustard">Last 3 days</option>
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
																					<p>	<b>Continuously -</b> This rule will run as often as possible (usually every 30 minutes).</p>	
																				</div>
																         	</div>
																    </div> 
																    <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3 label-for-p">
																         			Notification <i class="fa fa-info-circle" aria-hidden="true"></i>
																				</label>
																				<div class="col-md-9">
																					<p>	<b>	On Facebook -</b> You'll get a notification when conditions for this rule are met.</p>	
																					<p><input type="checkbox"><b>Email -</b>Include results from this rule to an email sent once per day when any of your rules have conditions that are met or new rules are created.</p>
																				</div>
																         	</div>
																    </div> 
																     <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3 label-for-p">
																         			Subscriber <i class="fa fa-info-circle" aria-hidden="true"></i>
																				</label>
																				<div class="col-md-9">
																					<p><b>John Clarke</b></p>	
																				</div>
																         	</div>
																    </div> 
																     <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3">
																         			Rule Name  
																				</label>
																				<div class="col-md-9">
																					<input type="text" name="" placeholder="Rule Name" class="form-control">
																				</div>
																         	</div>
																    </div> 
															</div>														
												         </div>
												        <!--  <div class="popup-right-form col-md-4">sds</div> -->
												      </div>
												      <div class="modal-footer">												      	
												        <button type="button" class="light-grey-btn" data-dismiss="modal" style="float: left;">Preview</button><span class="preview-span">Create at least one condition to see a preview of results.</span>
												        <button class="light-grey-btn">Cancel</button>
												        <button class="blue-btn">Create</button>
												      </div>
												    </div>

												  </div>
												</div>
												<!-- craete rule popup ends  -->

											</div>
									</div>
									<div class="right-fil1">
										<ul>
											<li>
													<div class="custom-autocomplete-select">
		                                        		<select class="selectpicker show-tick" data-live-search="true" data-size="5">
														  <option data-tokens="ketchup mustard">Columns</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														</select>													
		                                        	</div>
											</li>
											<li>
													<div class="custom-autocomplete-select">
		                                        		<select class="selectpicker show-tick" data-live-search="true" data-size="5">
														  <option data-tokens="ketchup mustard">Breakdown</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														</select>													
		                                        	</div>
											</li>
											<li>
												<button class="light-grey-btn" style="height: 24px; line-height: normal;">Export</button>
											</li>
										</ul>
									</div>			
		                    	</div>
		                      <div class="table-result table-responsive camp-second-tab-table">
		                      	<div id="duplicate-campaign" class="modal fade duplicate-row-popup" role="dialog">
		                      		<div class="modal-dialog">
		                      			<div class="modal-content">
		                      				<div class="modal-header">
		                      					<button type="button" class="close" data-dismiss="modal">&times;</button>
		                      					<h4 class="modal-title">Duplicate Campaign</h4>
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
		                      					<button type="button" class="blue-btn" data-dismiss="modal">Save to Draft</button>
		                      				</div>
		                      			</div>
		                      		</div>
		                      	</div>
		                      	<table class="table table-bordered table-inverse table-striped table-hover" id="camapaign_table">
		                      		<thead class="thead-default">
		                      			<tr>
		                      				<th><input type="checkbox" name="" class="all_camapaign_checkbox"></th>
		                      				<th></th>
		                      				<th>Campaign Name</th>
		                      				<th>Delivery <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th>Results <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th>Reach <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th>Cost per Result <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th>Amount Spent <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th>Ends <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th>Frequency <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th>Impressions <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th>Unique Link Clicks <i class="fa fa-info-circle" aria-hidden="true"></i></th>
		                      				<th class="more-plus"><a href="#">+</a></th>
		                      			</tr>
		                      		</thead>
		                      		<tbody id="camapaign_listing">
		                      			<?php 
		                      			if(count($camapaigns['data']) > 0):
		                      			foreach ($camapaigns['data'] as $camapaign):
		                      				
		                      				?>
		                      				<tr class="camp_rows" id="<?php echo $camapaign['id'];?>">
		                      					<td><input type="checkbox" name="" class="campaigns_checkbox"></td>
		                      					<td>
		                      						<input type="checkbox" <?php if($camapaign['status'] == 'ACTIVE') { echo 'checked'; } ?> class="campaigns_status" data-toggle="toggle" data-size="mini">
		                      					</td>
		                      					<td class="editable-row">
		                      						<a href="#"><?php echo $camapaign['name']; ?> <span class="edit-row-title"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
		                      						<div class="row-editing-icons">
		                      							<a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> View Chart</a>
		                      							<a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
		                      							<a href="#duplicate-campaign" data-toggle="modal"><i class="fa fa-copy" aria-hidden="true"></i> Duplicate</a>
		                      						</div>
		                      					</td>
		                      					<td><?php echo $camapaign['delivery_info']['status'];?></td>
		                      					<td><?php echo $camapaign['objective_for_results'];?></td>
		                      					<td><?php if(isset($camapaign['insights'])){echo $camapaign['insights']['data'][0]['reach'];}else{ echo '-';}?></td>
		                      					<td><?php echo $camapaign['objective_for_cost'];?></td>	
		                      					<td> <?php if(isset($camapaign['insights'])){echo '&#8377;'.$camapaign['insights']['data'][0]['spend'];}else{ echo '-';}?></td></td>
		                      					<td>
												<?php if(isset($camapaign['stop_time'])){echo $start_date=date_format(date_create($camapaign['stop_time']),' j F, Y');}else{ echo 'Ongoing';}?></td>
		                      					<td><?php if(isset($camapaign['insights'])){echo $camapaign['insights']['data'][0]['frequency'];}else{ echo '-';}?></td>
		                      					<td><?php if(isset($camapaign['insights'])){echo $camapaign['insights']['data'][0]['impressions'];}else{ echo '-';}?></td>
		                      					<td><?php if(isset($camapaign['insights'])){echo $camapaign['insights']['data'][0]['unique_clicks'];}else{ echo '-';}?></td>
		                      					<td></td>
		                      				</tr>
		                      			<?php endforeach; ?>
		                      				<tr>
		                      					<td colspan="2"></td>
		                      					<td>Result form <?php echo count($camapaigns['data']); ?> campaigns</td>
		                      					<td></td>
		                      					<td>—Link Click</td>
		                      					<td>—People</td>
		                      					<td>—Per Link Click</td>
		                      					<td>&#8377; 0.0</td>
		                      					<td></td>
		                      					<td>—Per Person</td>
		                      					<td>-Total</td>
		                      					<td>-Total</td>
		                      					<td></td>

		                      				</tr>
		                      			<?php else :?>
		                      				<tr>
		                      					<td colspan="13" align="center">No Result Found</td>
		                      				</tr>	
		                      			<?php endif ?>	
		                      		</tbody>
		                      	</table>
	                        </div>

		                    </div>

		                    <div role="tabpanel" class="tab-pane" id="ad-sets">
		                    	<div class="thress-tabs-table-top-filters">
		                    		<div class="left-fil1">
				                    		<div class="btn-and-caret-icon-dropdown">				                    			 
				                    			<a href="#" class="create-camp-btn" data-toggle="modal" data-target="#create-ad-set-btn">+ Create Ad Set</a>

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
												        <button class="blue-btn">Save to Draft</button>
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
												    <a class="dropdown-item" href="#">Action</a>
												    <a class="dropdown-item" href="#">Another action</a>
												    <a class="dropdown-item" href="#">Something else here</a>
												  </div>
												</div>
											</div>	
											<div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
				                    			<a href="#" class="create-camp-btn"><i class="fa fa-copy"></i> Duplicate</a>
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
											</div>	
											<div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
				                    			<a href="#" class="create-camp-btn"><i class="fa fa-pencil"></i> Edit</a>
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
											</div>	
											<div class="simple-default-icons-group" style="margin-left:10px">	
												<ul>
													<li><i class="fa fa-refresh disable-me"></i></li>
													<li><i class="fa fa-trash disable-me"></i></li>
													<li><i class="fa fa-edit"></i></li>
													<li><i class="fa fa-tag disable-me"></i></li>
												</ul>
											</div>
											<div class="single-btn-div" style="margin-left: 10px">
												<button class="light-grey-btn" style="height: 24px;" data-toggle="modal" data-target="#create-ad-set-rule-btn">Create Rule</button>
												<!-- create rule popup  -->
				                    			<div id="create-ad-set-rule-btn" class="modal fade common-three-tabs-popup" role="dialog">
												  <div class="modal-dialog">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">Create Rule</h4>
												      </div>
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
										                                        		<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">All active ad sets </option>
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
										                                        		<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">Turn off ad sets</option>
																						</select>													
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
																					 <div class="custom-autocomplete-select conditions-btw-right">	
																						<select class="selectpicker show-tick" data-size="5">
																						  <optgroup label="Picnic">
																						    <option>cost per mobile app install </option>
																						    <option>Ketchup </option>
																						    <option>Relish </option>
																						  </optgroup>
																						  <optgroup label="Camping">
																						    <option>Tent </option>
																						    <option>Flashlight </option>
																						    <option>Toilet Paper </option>
																						  </optgroup>
																						</select>
																						<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">is not between</option>
																						</select>
																						<input type="text" name=""> - <input type="text" name="">
																						<a href="#">x</a>
										                                        	</div>
										                                        	<div class="sub-label-and-field">
										                                        		<label>Time Range <i class="fa fa-info-circle" aria-hidden="true"></i></label>
										                                        		<div class="custom-autocomplete-select">
											                                        		<select class="selectpicker show-tick">
																							  <option data-tokens="ketchup mustard">Last 3 days</option>
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
																					<p>	<b>Continuously -</b> This rule will run as often as possible (usually every 30 minutes).</p>	
																				</div>
																         	</div>
																    </div> 
																    <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3 label-for-p">
																         			Notification <i class="fa fa-info-circle" aria-hidden="true"></i>
																				</label>
																				<div class="col-md-9">
																					<p>	<b>	On Facebook -</b> You'll get a notification when conditions for this rule are met.</p>	
																					<p><input type="checkbox"><b>Email -</b>Include results from this rule to an email sent once per day when any of your rules have conditions that are met or new rules are created.</p>
																				</div>
																         	</div>
																    </div> 
																     <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3 label-for-p">
																         			Subscriber <i class="fa fa-info-circle" aria-hidden="true"></i>
																				</label>
																				<div class="col-md-9">
																					<p><b>John Clarke</b></p>	
																				</div>
																         	</div>
																    </div> 
																     <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3">
																         			Rule Name  
																				</label>
																				<div class="col-md-9">
																					<input type="text" name="" placeholder="Rule Name" class="form-control">
																				</div>
																         	</div>
																    </div> 
															</div>														
												         </div>
												        <!--  <div class="popup-right-form col-md-4">sds</div> -->
												      </div>
												      <div class="modal-footer">												      	
												        <button type="button" class="light-grey-btn" data-dismiss="modal" style="float: left;">Preview</button><span class="preview-span">Create at least one condition to see a preview of results.</span>
												        <button class="light-grey-btn">Cancel</button>
												        <button class="blue-btn">Create</button>
												      </div>
												    </div>

												  </div>
												</div>
												<!-- craete rule popup ends  -->
											</div>
									</div>
									<div class="right-fil1">
										<ul>
											<li>
													<div class="custom-autocomplete-select">
		                                        		<select class="selectpicker show-tick" data-live-search="true" data-size="5">
														  <option data-tokens="ketchup mustard">Columns</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														</select>													
		                                        	</div>
											</li>
											<li>
													<div class="custom-autocomplete-select">
		                                        		<select class="selectpicker show-tick" data-live-search="true" data-size="5">
														  <option data-tokens="ketchup mustard">Breakdown</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														</select>													
		                                        	</div>
											</li>
											<li>
												<button class="light-grey-btn" style="height: 24px; line-height: normal;">Export</button>
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
									        <button type="button" class="blue-btn" data-dismiss="modal">Save to Draft</button>
									      </div>
									    </div>

									  </div>
									</div>
									<table class="table table-bordered table-inverse table-striped" id="adset_table">
									  <thead class="thead-default">
									    <tr>
									      <th><input type="checkbox" class="all_adsets_checkbox"></th>
									      <th></th>
									      <th>Ad Set Name</th>
									      <th>Delivery <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Results <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Reach <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Cost per Result <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Budget <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Amount Spent <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Ends <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Schedule <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Frequency <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Impressions <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Unique Link Clicks <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th class="more-plus"><a href="#">+</a></th>
									    </tr>
									  </thead>
									  <tbody>
									  	<?php 
									  	foreach($camapaigns['data'] as $campaign) : 
									  		$total_adset = count($campaign['adsets']['data']);
									  		foreach ($campaign['adsets']['data'] as $adsets) : 
									  			//echo '<pre>';
									  			//print_r($adsets);
									  	?>
									    <tr id="<?php echo $adsets['id'];?>" class="adset_rows camp_<?php echo $campaign['id'];?>">
									      <td><input type="checkbox" name="" class="adsets_checkbox"></td>
									      <td><input type="checkbox" <?php if($adsets['status'] == 'ACTIVE') { echo "checked"; }?> class="adsets_status" data-toggle="toggle" data-size="mini"></td>
									      <td>
									      	<a href="#"><?php echo $adsets['name']; ?> <span class="edit-row-title"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
									      	<div class="row-editing-icons">
									      			<a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> View Chart</a>
									      			<a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
									      			<a href="#duplicate-adSet" data-toggle="modal"><i class="fa fa-copy" aria-hidden="true"></i> Duplicate</a>	
									      	</div>
									      </td>
									      <td><?php echo $adsets['delivery_info']['status'];?></td>
									      <td><?php echo $adsets['objective_for_results'];?></td>
									      <td><?php echo $adsets['insights']['data'][0]['reach']; ?> </td> <!-- reach -->
									      <td><?php echo $adsets['objective_for_cost'];?></td>	
									      <td><?php echo $adsets['daily_budget'];?><span>Daily</span></td>
									      <td>&#8377; <?php echo $adsets['insights']['data'][0]['spend']; ?></td>
									      <td><?php if(isset($adsets['end_time'])){echo $start_date=date_format(date_create($adsets['end_time']),' j F, Y');}else{ echo 'Ongoing';}?></td>
									      <td>
												<?php echo $start_date=date_format(date_create($adsets['start_time']),' j F, Y');?>-
												<?php if(isset($adsets['end_time'])){echo $start_date=date_format(date_create($adsets['end_time']),' j F, Y');}else{ echo 'Ongoing';}?>
									      </td>
									      <td><?php if(isset($adsets['insights'])){echo $adsets['insights']['data'][0]['frequency']; }else echo '-';?></td>
									      <td> <?php if(isset($adsets['insights'])){echo $adsets['insights']['data'][0]['impressions']; }else echo '-'; ?> </td>
									      <td><?php if(isset($adsets['insights'])){ echo $adsets['insights']['data'][0]['unique_clicks'];  }else echo '-';?> </td>
									      <td></td>
									    </tr>
										<?php endforeach; endforeach; ?>
									    <?php if($total_adset > 0 ) : ?>
									    	<tr>
									    		<td colspan="2"></td>
									    		<td>Results from <?php echo $total_adset; ?> ad set</td>
									    		<td></td>
									    		<td>-<span>Link Click</span></td>
									    		<td>-<span>People</span></td>
									    		<td>-<span>Per Link Click</span></td>
									    		<td></td>
									    		<td>&#8377; 0.00 Total Spent</td>
									    		<td></td>
									    		<td></td>
									    		<td>-<span>Per People</span></td>
									    		<td>-<span>Total</span></td>
									    		<td>-<span>Total</span></td>
									    		<td></td>
									    	</tr>	
									    <?php else : ?>
									    	<tr>
									    		<td colspan="15" align="center"><b>No Result Found</b></td>
									    	</tr>
									    <?php endif; ?>						
									  </tbody>
									</table>
	                        	</div>
		                    </div>

		                    <div role="tabpanel" class="tab-pane" id="ads">
		                    	<div class="thress-tabs-table-top-filters">
		                    		<div class="left-fil1">
				                    		<div class="btn-and-caret-icon-dropdown">
				                    			
				                    			<a href="#" class="create-camp-btn" data-toggle="modal" data-target="#create-ad-btn">+ Create Ad</a>
 
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
												    <a class="dropdown-item" href="#">Action</a>
												    <a class="dropdown-item" href="#">Another action</a>
												    <a class="dropdown-item" href="#">Something else here</a>
												  </div>
												</div>
											</div>	
											<div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
				                    			<a href="#" class="create-camp-btn"><i class="fa fa-copy"></i> Duplicate</a>
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
											</div>	
											<div class="btn-and-caret-icon-dropdown disable-me" style="margin-left:10px">
				                    			<a href="#" class="create-camp-btn"><i class="fa fa-pencil"></i> Edit</a>
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
											</div>	
											<div class="simple-default-icons-group " style="margin-left:10px">	
												<ul>
													<li><i class="fa fa-refresh disable-me"></i></li>
													<li><i class="fa fa-trash disable-me"></i></li>
													<li><i class="fa fa-edit"></i></li>
													<li><i class="fa fa-tag disable-me"></i></li>
												</ul>
											</div>
											<div class="single-btn-div" style="margin-left: 10px">
												<button class="light-grey-btn" style="height: 24px;" data-toggle="modal" data-target="#create-ad-rule-btn">Create Rule</button>
												<!-- create ad rule popup  -->
				                    			<div id="create-ad-rule-btn" class="modal fade common-three-tabs-popup" role="dialog">
												  <div class="modal-dialog">

												    <!-- Modal content-->
												    <div class="modal-content">
												      <div class="modal-header">
												        <button type="button" class="close" data-dismiss="modal">&times;</button>
												        <h4 class="modal-title">Create Rule</h4>
												      </div>
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
										                                        		<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">All active ads </option>
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
										                                        		<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">Turn off ad</option>
																						</select>													
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
																					 <div class="custom-autocomplete-select conditions-btw-right">	
																						<select class="selectpicker show-tick" data-size="5">
																						  <optgroup label="Picnic">
																						    <option>cost per mobile app install </option>
																						    <option>Ketchup </option>
																						    <option>Relish </option>
																						  </optgroup>
																						  <optgroup label="Camping">
																						    <option>Tent </option>
																						    <option>Flashlight </option>
																						    <option>Toilet Paper </option>
																						  </optgroup>
																						</select>
																						<select class="selectpicker show-tick">
																						  <option data-tokens="ketchup mustard">is not between</option>
																						</select>
																						<input type="text" name=""> - <input type="text" name="">
																						<a href="#">x</a>
										                                        	</div>
										                                        	<div class="sub-label-and-field">
										                                        		<label>Time Range <i class="fa fa-info-circle" aria-hidden="true"></i></label>
										                                        		<div class="custom-autocomplete-select">
											                                        		<select class="selectpicker show-tick">
																							  <option data-tokens="ketchup mustard">Last 3 days</option>
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
																					<p>	<b>Continuously -</b> This rule will run as often as possible (usually every 30 minutes).</p>	
																				</div>
																         	</div>
																    </div> 
																    <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3 label-for-p">
																         			Notification <i class="fa fa-info-circle" aria-hidden="true"></i>
																				</label>
																				<div class="col-md-9">
																					<p>	<b>	On Facebook -</b> You'll get a notification when conditions for this rule are met.</p>	
																					<p><input type="checkbox"><b>Email -</b>Include results from this rule to an email sent once per day when any of your rules have conditions that are met or new rules are created.</p>
																				</div>
																         	</div>
																    </div> 
																     <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3 label-for-p">
																         			Subscriber <i class="fa fa-info-circle" aria-hidden="true"></i>
																				</label>
																				<div class="col-md-9">
																					<p><b>John Clarke</b></p>	
																				</div>
																         	</div>
																    </div> 
																     <div class="row">    	
																         	<div class="col-md-12">
																         		<label class="col-md-3">
																         			Rule Name  
																				</label>
																				<div class="col-md-9">
																					<input type="text" name="" placeholder="Rule Name" class="form-control">
																				</div>
																         	</div>
																    </div> 
															</div>														
												         </div>
												        <!--  <div class="popup-right-form col-md-4">sds</div> -->
												      </div>
												      <div class="modal-footer">												      	
												        <button type="button" class="light-grey-btn" data-dismiss="modal" style="float: left;">Preview</button><span class="preview-span">Create at least one condition to see a preview of results.</span>
												        <button class="light-grey-btn">Cancel</button>
												        <button class="blue-btn">Create</button>
												      </div>
												    </div>

												  </div>
												</div>
												<!-- craete rule popup ends  -->
											</div>
									</div>
									<div class="right-fil1">
										<ul>
											<li>
													<div class="custom-autocomplete-select">
		                                        		<select class="selectpicker show-tick" data-live-search="true" data-size="5">
														  <option data-tokens="ketchup mustard">Columns</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														</select>													
		                                        	</div>
											</li>
											<li>
													<div class="custom-autocomplete-select">
		                                        		<select class="selectpicker show-tick" data-live-search="true" data-size="5">
														  <option data-tokens="ketchup mustard">Breakdown</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														  <option data-tokens="ketchup mustard">Lorem Ipsum</option>
														  <option data-tokens="mustard">Lorem</option>
														  <option data-tokens="frosting">Dummy text printing</option>
														</select>													
		                                        	</div>
											</li>
											<li>
												<button class="light-grey-btn" style="height: 24px; line-height: normal;">Export</button>
											</li>
										</ul>
									</div>			
		                    	</div>
		                         <div class="table-result table-responsive ads-fourth-tab-table">
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
									        <button type="button" class="blue-btn" data-dismiss="modal">Save to Draft</button>
									      </div>
									    </div>

									  </div>
									</div>
									<table class="table table-bordered table-inverse table-striped" id="ad_table">
									  <thead class="thead-default">
									    <tr>
									      <th><input type="checkbox" class="all_ad_checkbox"></th>
									      <th></th>
									      <th>Ad Name</th>
									      <th>Delivery <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Results <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Reach <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Cost per Result <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Amount Spent <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Ends <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Relevance <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Frequency <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Impressions <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Unique Link Clicks <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th>Button Clicks <i class="fa fa-info-circle" aria-hidden="true"></i></th>
									      <th class="more-plus"><a href="#">+</a></th>
									    </tr>
									  </thead>
									  <tbody>
									  	<?php 
									  	foreach($camapaigns['data'] as $ads) : 
									  		$adsets = $ads['adsets']['data'];
									  		$total_adset = count($ads['ads']['data']);
									  		foreach ($ads['ads']['data'] as $key => $ad) : ?>
									  		<tr class="ad_rows camp_<?php echo $ads['id'];?> adsets_<?php echo $adsets[$key]['id'];?>" id="<?php echo $ad['id'];?>">
									  			<td><input type="checkbox" name="" class="ad_checkbox"></td>
									  			<td><input type="checkbox" <?php if($ad['status'] == 'ACTIVE') { echo "checked"; }?> class="ad_status" data-toggle="toggle" data-size="mini"></td>
									  			<td>
									  				<a href="#"><?php echo $ad['name']; ?> <span class="edit-row-title"><i class="fa fa-pencil" aria-hidden="true"></i></span></a>
									  				<div class="row-editing-icons">
									  					<a href="#"><i class="fa fa-bar-chart" aria-hidden="true"></i> View Chart</a>
									  					<a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
									  					<a href="#duplicate-adSet" data-toggle="modal"><i class="fa fa-copy" aria-hidden="true"></i> Duplicate</a>	
									  				</div>
									  			</td>
									  			<td><?php echo $ad['delivery_info']['status'];?></td>
									  			<td><?php echo $ad['objective_for_results'];?></td>
									  			<td><?php if(isset($ad['insights'])){echo $ad['insights']['data'][0]['reach'];}else{ echo '-';}?></td>
									  			<td><?php echo $ad['objective_for_cost'];?></td>	
									  			<td><?php if(isset($ad['insights'])){echo $ad['insights']['data'][0]['spend'];}else{ echo '-';}?></td>
									  			<td>Ongoing-</td>
									  			<td><?php if(isset($ad['insights'])){echo $ad['insights']['data'][0]['relevance_score']['score'];}else{ echo '-';}?></td>
									  			<td><?php if(isset($ad['insights'])){echo $ad['insights']['data'][0]['frequency'];}else{ echo '-';}?></td>
									  			<td><?php if(isset($ad['insights'])){echo $ad['insights']['data'][0]['impressions'];}else{ echo '-';}?></td>
									  			<td><?php if(isset($ad['insights'])){echo $ad['insights']['data'][0]['unique_clicks'];}else{ echo '-';}?></td>
									  			<td><?php if(isset($ad['insights'])){echo $ad['insights']['data'][0]['total_unique_actions'];}else{ echo '-';}?></td>
									  			<td></td>
									  		</tr>
									  	<?php endforeach; endforeach; ?>	
									  	<?php if($total_adset > 0) : ?>	
									  		<tr>
									  			<td colspan="2"></td>
									  			<td>Results from <?php echo $total_adset; ?> ad</td>
									  			<td></td>
									  			<td>-</td>
									  			<td>-<span>People</span></td>
									  			<td>-</td>
									  			<td>&#8377; 0.00 Total Spent</td>
									  			<td></td>
									  			<td></td>
									  			<td>-<span>Per People</span></td>
									  			<td>-<span>Total</span></td>
									  			<td>-<span>Total</span></td>
									  			<td>-<span>Total</span></td>
									  			<td></td>
									  		</tr>	
									  	<?php else : ?>
									  		<tr>
									  			<td colspan="16" align="center"><b>No Result Found</b></td>
									  		</tr>
									  	<?php endif; ?>	
									  </tbody>
									</table>
	                        	</div>

		                    </div>

		                </div>
		            </div>
			    </div>
			</div>
			<div class="right-fix-drawer-outr">
				<div class="right-fix-drawer-inr">
					<div class="right-fix-drawer">
							<ul class="drawer-four-icons nav nav-tabs">
								<li class="drawer-arrow open-drw-arrow"><a href="#">&nbsp;</a></li>
								<li class="drawer-view-chart open-drw"><a data-toggle="tab" href="#view-tab"><i class="fa fa-bar-chart" aria-hidden="true"></i></a></li>
								<li class="drawer-edit open-drw"><a data-toggle="tab" href="#edit-tab"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
								<li class="drawer-history open-drw"><a data-toggle="tab" href="#history-tab"><i class="fa fa-clock-o" aria-hidden="true"></i></a></li>
							</ul>
							<div class="drawer-data-rightSec">
								<div class="tab-content first-step-tabs-content">
								    <div id="view-tab" class="tab-pane fade in active">
								    	<h1 class="drw-main-heading">Performance Insights for <span class="dummy_text">Campaign:</span> <span class="camapaign_name">demo</span> <span class="mixed_value" style="display: none;"></h1>
								    	<div class="righ-drw-first-third-tab-cal">
								    			<button class="light-grey-btn">This month: Sep 1, 2017 - Sep 21, 2017</button>
								    	</div>
							      		<div class="hori-three-tabs tabbable-panel">							      			
											<div class="tabbable-line">
												<ul class="nav nav-tabs outr-tabs">
													<li class="active">
														<a href="#tab_default_1" data-toggle="tab">
															<i class="fa fa-bar-chart" aria-hidden="true"></i> Performance 
														</a>
														<span class="arrow"></span>
													</li>
													<li>
														<a href="#tab_default_2" data-toggle="tab">
															<i class="fa fa-users" aria-hidden="true"></i> Demographics 
														</a>
														<span class="arrow"></span>
													</li>
													<li>
														<a href="#tab_default_3" data-toggle="tab">
															<i class="fa fa-copy" aria-hidden="true"></i> Placement
														</a>
														<span class="arrow"></span>
													</li>
												</ul>
												<div class="tab-content three">
													<div class="tab-pane active performance" id="tab_default_1">
															<ul class="nav nav-pills nav-stacked col-md-3">
															  <li class="active"><a href="#links" data-toggle="pill">Results: Link Clicks</a></li>
															  <li><a href="#people" data-toggle="pill"><b>0</b><br>People Reached</a></li>
															  <li><a href="#amount" data-toggle="pill"><b>&#8377; 0.00</b><br>Amount Spent</a></li>
															  <li><a href="#custom" data-toggle="pill"><b>Custom</b></a></li>
															</ul>
															<div class="tab-content col-md-9">
															        <div class="tab-pane active" id="links">
															            <div class="no-result-found">
						                                        			<img src="img/no-result-img.jpg"><br>	
						                                        			<b>No Activity During Date Range</b><br>
						                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
						                                        		</div>
															        </div>
															        <div class="tab-pane" id="people">
															            <div class="no-result-found">
						                                        			<img src="img/no-result-img.jpg"><br>	
						                                        			<b>No Activity During Date Range</b><br>
						                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
						                                        		</div>
															        </div>
															        <div class="tab-pane" id="amount">
															             <div class="no-result-found">
						                                        			<img src="img/no-result-img.jpg"><br>	
						                                        			<b>No Activity During Date Range</b><br>
						                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
						                                        		</div>
															        </div>
															        <div class="tab-pane" id="custom">
															            <div class="no-result-found">
						                                        			<img src="img/no-result-img.jpg"><br>	
						                                        			<b>No Activity During Date Range</b><br>
						                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
						                                        		</div>
															        </div>
															</div> 


													</div>
													<div class="tab-pane demographics" id="tab_default_2">
														<div class="no-result-found">
		                                        			<img src="img/no-result-img.jpg"><br>	
		                                        			<b>No Activity During Date Range</b><br>
		                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
		                                        		</div>
													</div>
													<div class="tab-pane placement" id="tab_default_3">
														<div class="no-result-found">
		                                        			<img src="img/no-result-img.jpg"><br>	
		                                        			<b>No Activity During Date Range</b><br>
		                                        			<button class="light-grey-btn" style="margin-top: 15px;">Change Date</button>
		                                        		</div>
													</div>
												</div>
											</div>
										</div>
								    </div>
								    <div id="edit-tab" class="tab-pane fade">
								      <h1 class="drw-main-heading">Editing <span class="dummy_text">Campaign:</span> <span class="camapaign_name">demo</span> <span class="mixed_value" style="display: none;"></span></h1>
								      	<div class="edit-camp-form-outr">
								      		<!-- start of campaigns -->
								      		<div id="camapaign-full-details" style="display: block;">
								      				<div class="camapaign-details-list" id="">
								      					<div class="col-md-7 col-sm-8">
								      						<div class="form-white-block" style="padding: 15px; margin-top: 20px;">
								      							<div class="row">
								      								<div class="col-sm-4"><label for="email" class="pull-right">Campaign Name:</label></div>
								      								<div class="col-sm-8 padding0">
								      									<input type="email" class="form-control" id="camp_name" value="">
								      									<a href="#">Rename usign available fields</a>
								      								</div>
								      							</div>
								      						</div>
								      						<div class="form-white-block">
								      							<h5 class="white-block-legend">Campaign Details</h5>
								      							<div class="white-block-body">
								      								<div class="col-sm-12">
								      									<div class="col-sm-6"><label class="pull-right">Objective</label></div>
								      									<div class="col-sm-6 padding0" id="camp_objective"><?php echo $camapaign['objective'];?></div>
								      								</div>
								      								<div class="col-sm-12">
								      									<div class="col-sm-6"><label class="pull-right">Buying Type</label></div>
								      									<div class="col-sm-6 padding0" id="camp_buyingtype"><?php echo $camapaign['buying_type'];?></div>
								      								</div>
								      								<div class="col-sm-12">
								      									<div class="col-sm-6"><label class="pull-right">Campaign Spending Limit <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      									<div class="col-sm-6 padding0">
								      										<input type="text"><span><b>₹NaN.00 Total Spent</b></span>
								      										<p>New limit must be at least ₹5,000.00</p>
								      										<a href="#">Remove Limit</a>
								      									</div>
								      								</div>
								      							</div>
								      						</div>
								      					</div>

								      					<div class="col-md-5 col-ms-4">
								      						<div class="form-white-block" style="margin-top:20px;">
								      							<div class="row main-heading">
								      								<div class="col-md-9 padding10"><h5><b>Campaign id:<span id="camp_id"></span> </b></h5><input type="checkbox" id="camp_status" value="<?php echo $camapaign['id'];?>" data-toggle="toggle" data-size="mini"> </div>
								      								<div class="col-md-3 padding10">
								      									<div class="btn-and-caret-icon-dropdown" style="margin-top: 6px;">
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
								      									</div>
								      								</div>
								      							</div>
								      							<div class="white-block-body">
								      								<p>
								      									<a href="#"><span class="camp_total_adsets"></span> Ad Set</a><br>
								      									<span>Targeting, placement, budget and schedule</span>
								      								</p>
								      								<p>
								      									<a href="#"><span class="camp_total_ads"></span> Ad</a><br>
								      									<span>Images, videos, text and links</span>
								      								</p>
								      								<hr>
								      								<p><b>Rule</b></p>
								      								<div class="btn-and-caret-icon-dropdown" style="margin-top: 6px;">
								      									<a href="#" class="create-camp-btn">Create Rule</a>
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
								      								</div>
								      							</div>
								      						</div>
								      					</div>
								      				</div>
								      			
								      		</div>
								      		<!-- end of campaigns -->
								      		<!-- start of adsets -->
								      		<div class="edit-camp-form" style="display: none;" id="adsets-full-details">
								      			<div class="adsets-details-list" id="" >
								      				<div class="col-md-7 col-ms-8">
								      					<div class="edit-camp-left-blocks">
								      						<div class="form-white-block" style="padding: 15px;">
								      							<label>Ad Set Name</label>
								      							<input type="text" name="" class="form-control" id="adset_name">
								      							<a href="#">Rename usign available fields</a>
								      						</div>
								      						<div class="form-white-block">
								      							<h5 class="white-block-legend">Traffic</h5>
								      							<div class="white-block-body">
								      								<label class="light-grey-label">Choose where you want to drive traffic. You'll enter more details about the destination later.</label>
								      								<div class="radio">
								      									<label><input type="radio" name="optradio">Website</label>
								      								</div>
								      								<div class="radio">
								      									<label><input type="radio" name="optradio">App</label>
								      								</div>
								      								<div class="radio">
								      									<label><input type="radio" name="optradio">Messenger</label>
								      								</div>
								      							</div>
								      						</div>
								      						<div class="form-white-block">
								      							<h5 class="white-block-legend">Budget & Schedule</h5>
								      							<div class="white-block-body">
								      								<!-- <form> -->
								      									<div class="row">
								      										<div class="col-md-5"><label>Daily Budget</label></div>
								      										<div class="col-md-6">
								      											<input type="text" name="" value="<?php echo $adset['daily_budget']; ?>" style=" margin-right: 10px;width:100px;" id="addsets_daily_bugdet">
								      											<button class="light-grey-btn" data-toggle="modal" data-target="#adjust_button">Adjust Budget</button>
								      										</div>
								      									</div>
								      									<div class="row">
								      										<div class="col-md-5"><label>Schedule Start</label></div>
								      										<div class="col-md-6">
								      											<p class="addsets_start_time"><?php echo date_format(date_create($adset['start_time']), 'l, F d, Y h:i a');?></p>
								      										</div>
								      									</div>
								      									<div class="row">
								      										<div class="col-md-5"><label>Schedule End</label></div>
								      										<div class="col-md-7">
								      											<div class="radio margin-top-zero">
								      												<label><input type="radio" name="optradio">Don't schedule end date, run as ongoing</label><br>
								      												<label><input type="radio" name="optradio">End run on:</label>
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
								      								<!-- </form> -->
								      							</div>
								      						</div>	
								      						<div class="form-white-block">
								      							<h5 class="white-block-legend">Audience</h5>
								      							<div class="white-block-body">
								      								<form>
								      									<div class="row">
								      										<div class="col-md-5"><label>Custom Audiences <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-6">
								      											<input type="text" name="" value="800.00" class="form-control"><br>
								      											<a href="#">Exclude</a> | <a href="#">Create New</a>
								      										</div>
								      									</div>
								      									<div class="row">
								      										<div class="col-md-5"><label>Location <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-6">
								      											<textarea class="form-control" id="addsets_location"></textarea>
								      										</div>
								      									</div>
								      									<div class="row">
								      										<div class="col-md-5"><label>Age <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-6">
								      											<div class="custom-autocomplete-select">
									                                        		<select class="selectpicker show-tick " data-size="3" id="addsets_min_age" name="addsets_min_age">
									                                        		<?php for($j=13;$j<=65;$j++):?>
																					  <option  value="<?php echo $j; ?>" class="addsets_min_age"><?php echo $j;?></option>
																					<?php endfor;?>
																					 
																					</select>	
																					<select class="selectpicker show-tick" data-size="3" name="addsets_max_age">
																					<?php for($j=13;$j<=65;$j++):?>
																					  <option data-tokens="ketchup mustard" value="<?php echo $j;?>"><?php echo $j;?></option>
																					<?php endfor;?>
																					 
																					</select>													
									                                        	</div>
								      										</div>
								      									</div>
								      									<div class="row gender">
								      										<div class="col-md-5"><label style="border: 0">Gender <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-6 r">
								      											<div class="all-gen">
																				<input type="radio" name="radio" id="radio1" class="radio" checked/>
																				<label for="radio1">All</label>
																				</div>

																				<div class="male-gen">
																				<input type="radio" name="radio" id="radio2" class="radio"/>
																				<label for="radio2">Men</label>
																				</div>

																				<div class="female-gen">	
																				<input type="radio" name="radio" id="radio3" class="radio"/>
																				<label for="radio3">Women</label>
																				</div>
								      										</div>
								      									</div>
								      									<div class="row">
								      										<div class="col-md-5"><label>Languages <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-6">
								      											<input type="text" name="" placeholder="Enter a language" class="form-control"> 
								      										</div>
								      									</div>
								      									<div class="row"><hr class="edit-forms-divider">&nbsp;</hr></div>
								      									<div class="row">
								      										<div class="col-md-5"><label>Detailed Targeting <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-7">
								      											<div class="radio margin-top-zero">
								      												<label style="padding: 0">INCLUDE people who match at least ONE of the following <i class="fa fa-info-circle" aria-hidden="true"></i></label><br>
								      												<select class="form-control">
								      													<option>Option1</option>
								      												</select>
								      											</div>
								      										</div>	
								      									</div>
								      									<div class="row"><hr class="edit-forms-divider">&nbsp;</hr></div>
								      									<div class="row">
								      										<div class="col-md-5"><label>Connections <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-7">
								      											<div class="radio margin-top-zero">
								      												<div class="custom-autocomplete-select">
									                                        		<select class="selectpicker show-tick" data-size="3">
																					  <option data-tokens="ketchup mustard">Apps</option>
																					  
																					</select>			 											
									                                        	</div>
								      											</div>
								      										</div>	
								      									</div>
								      									<div class="row" style="margin: 0"><hr class="edit-forms-divider" style="margin: 0">
								      									&nbsp;</hr></div>
								      									<div class="row">
								      										<div class="col-md-5">&nbsp;</div>
								      										<div class="col-md-7">
								      											 <button type="button" class="light-grey-btn" data-toggle="modal" data-target="#save-aud">Save This Audience</button>
								      										</div>
								      									</div>
								      								</form>
								      							</div>
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
										                      								<input type="text" class="form-control" value="42">
										                      							</div>
										                      							<p>Location:<span>India</span></p>
										                      							<p>Location:<span>India</span></p>
										                      						</div>	
									                      						</div>
									                      					</form>		  	
									                      				</div>
									                      				<div class="modal-footer">
									                      					<button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
									                      					<button type="button" class="blue-btn" data-dismiss="modal">Save</button>
									                      				</div>
									                      			</div>
									                      		</div>
									                      	</div>


								      						<div class="form-white-block">
								      							<h5 class="white-block-legend">Placement</h5>
								      							<div class="white-block-body">
								      								<div class="radio">
								      									<label><input type="radio" name="optradio">Automatic Placements (Recommended)</label>
								      									<p>Your ads will automatically be shown to your audience in the places they're likely to perform best. For this objective, placements may include Facebook, Instagram, Audience Network and Messenger.</p>
								      								</div> 
								      								<div class="radio">
								      									<label><input type="radio" name="optradio">Edit Placements (Recommended)</label>
								      									<p>Your ads will automatically be shown to your audience in the places they're likely to perform best. For this objective, placements may include Facebook, Instagram, Audience Network and Messenger.</p>
								      								</div> 
								      							</div>
								      						</div>
								      						<div class="form-white-block">
								      							<h5 class="white-block-legend">Optimization & Delivery</h5>
								      							<div class="white-block-body">
								      								<!-- <form> -->
								      									<div class="row">
								      										<div class="col-md-5"><label>Optimization for Ad Delivery <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-6">
								      											 
								      											<button class="light-grey-btn" data-toggle="modal" data-target="">Adjust Budget</button>
								      										</div>
								      									</div>
								      									
								      									<div class="row">
								      										<div class="col-md-5"><label>Bid Amount <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-7">
								      											<div class="radio margin-top-zero">
								      												<label><input type="radio" name="optradio">Automatic - Let Facebook set the bid that helps you get the most impressions at the best price.</label><br>
								      												<label><input type="radio" name="optradio">Manual - Enter a bid based on what 1,000 impressions are worth to you.</label>
								      											</div>
								      										</div>	
								      									</div>
								      									<div class="row">
								      										<div class="col-md-5"><label>When You Get Charged <i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-7">
								      											<div class="radio margin-top-zero">
								      												<label>Impression</label> 
								      											</div>
								      										</div>							      											
								      									</div>
								      									<div class="row">
								      										<div class="col-md-5"><label>Delivery Type<i class="fa fa-info-circle" aria-hidden="true"></i></label></div>
								      										<div class="col-md-7">
								      											<div class="radio margin-top-zero">
								      												<label>Standard - Show your ads throughout your selected schedule (recommended)</label> 
								      											</div>
								      										</div>							      											
								      									</div>
								      								<!-- </form> -->
								      							</div>
								      						</div>	

								      					</div>
								      				</div>
								      				<div class="col-md-5 col-sm-5">
								      					<div class="form-white-block" style="margin-top:20px;">
								      						<div class="row main-heading">
								      							<div class="col-md-9 padding10"><h5 class="white-block-legend"><b>Ad Set id:<span id="adset_id"></span></b></h5><input type="checkbox" id="adset_status" value="<?php echo $adset['id'];?>" data-toggle="toggle" data-size="mini"> </div>
								      							<div class="col-md-3 padding10">
								      								<div class="btn-and-caret-icon-dropdown" style="margin-top: 6px;">
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
								      								</div>
								      							</div>
								      						</div>
								      						<div class="white-block-body">
								      							<p>
								      								<a href="#"><span class="camp_total_camps">1</span> Campaigns</a><br>
								      								<span>Targeting, placement, budget and schedule</span>
								      							</p>
								      							<p>
								      								<a href="#"><span class="camp_total_ads">1</span> Ad</a><br>
								      								<span>Images, videos, text and links</span>
								      							</p>
								      							<hr>
								      							<p><b>Rule</b></p>
								      							<div class="btn-and-caret-icon-dropdown" style="margin-top: 6px;">
								      								<a href="#" class="create-camp-btn">Create Rule</a>
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
								      							</div>
								      						</div>
								      					</div>
								      					<div class="edit-camp-right-blocks">
								      						<div class="form-white-block">
								      							<h5 class="white-block-legend">Audience Definition</h5>
								      							<div class="white-block-body">
								      								<img src="img/audience.jpg"> <p>Your audience selection is fairly broad</p> 

								      							</div>
								      						</div>
								      						<div class="form-white-block">
								      							<h5 class="white-block-legend">Estimated Daily Results</h5>
								      							<div class="white-block-body">
								      								 <div class="col-md-12" style="padding-left: 0"><b>Reach</b> 33,000 - 210,000 (of 110,000,000)<br>
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
										      <!-- end of adsets -->
										      <!-- starts of ads -->
										      	<div class="edit-camp-form" style="display: none;" id="ads-full-details">
										      		<?php /*foreach ($camapaigns['data'] as $ads) : 
								      			       foreach ($ads['ads']['data'] as $ads) : */?>
										      		<div class="ads-details-list" id="ad_<?php echo $ads['id']?>">
										      			<div class="col-md-6 col-sm-8">
										      				<div class="edit-camp-left-blocks">
										      					<div class="form-white-block" style="padding: 15px;">
										      						<label>Ad Set Name</label>
										      						<input type="text" name="" class="form-control" id="ad_name">
										      						<a href="#">Rename usign available fields</a>
										      					</div>

										      					<div class="form-white-block identity">
									      							<h5 class="white-block-legend">Identity</h5>
									      							<div class="white-block-body">
									      								<div class="col-md-12">
										      								<label class="light-grey-label">Facebook Page <i class="fa fa-info-circle" aria-hidden="true"></i></label>
										      								<p>Choose a Facebook Page to represent your business in News Feed. Your ad will link to your site, but it will show as coming from your Facebook Page.</p>
										      								<div class="custom-autocomplete-select">
								                                        		<select class="selectpicker show-tick" data-size="3">
																				  <option data-tokens="ketchup mustard">Columns </option>
																				  <option data-tokens="mustard">Lorem</option>
																				  <option data-tokens="frosting">Dummy text printing</option>
																				</select>	
								                                        	</div>
										      								<p>or <a href="#">Don't Connect a Facebook Page</a> (will disable News Feed ads).</p>
									      								</div>

									      								<div class="col-md-12">
									      										<hr class="edit-forms-divider" style="margin-bottom: 20px">
									      								</div>

									      								<div class="col-md-12">
									      										
										      								<label class="light-grey-label">Instagram Account  <i class="fa fa-info-circle" aria-hidden="true"></i></label>
										      								<p>The selected Page has no Instagram account connected. Your ad will use the Page name and profile picture.</p>
										      								<div class="identity-instagram">
										      									<button class="light-grey-btn"><img src="img/ident-acc-icon.jpg">Revinfotech (Page) <i class="fa fa-check" aria-hidden="true"></i></button>
										      									<span>OR</span>
										      									<button class="light-grey-btn" data-toggle="modal" data-target="#add-insta-acct-btn"><i class="fa fa-instagram" aria-hidden="true"></i> Add an Account</button>
										      									

										      								</div>	
									      								</div>
									      							</div>
								      							</div>

								      							<div class="form-white-block new-existing-ads-tab" style="padding:0px;">

										      						 <ul class="nav nav-tabs">
																	  <li class="active"><a data-toggle="tab" href="#crt-ad">Create Ad</a></li>
																	  <li><a data-toggle="tab" href="#ext-post">Use Existing Post</a></li>			 
																	</ul>

																	<div class="tab-content">
																	  <div id="crt-ad" class="tab-pane fade in active">
																	    <ul>
																	    	<li class="img-vid-li">
																	    		<input type="radio" id="img-vid" name="crt"> 
																	    		<img src="img/single-img-icon.jpg">
																	    		<label for="img-vid">Ad with an image or video</label>
																	    	</li>
																	    	
																	    	<li class="mul-img-li">
																		    	<div class="crt-ad-radio-and-img">	
																		    		<input type="radio" id="mul-img" name="crt"> 
																		    		<img src="img/single-img-icon.jpg">
																		    	</div>	
																		    	<div class="crt-ad-label-and-p">	
																		    		<label for="mul-img">
																		    			<b>Ad with multiple images or videos in a carousel</b>
																		    		 Show multiple images or videos for the same price.<a href="#">Learn more.</a>
																		    		</label>
																		    	</div>	
																	    	</li>
																	    	
																	    	<li class="mul-img-li">
																	    	<div class="crt-ad-radio-and-img">		
																	    		<input type="radio" id="img-coll" name="crt"> 
																	    		<img src="img/single-img-icon.jpg">
																	    	</div>	
																	    	<div class="crt-ad-label-and-p">	
																	    		<label for="img-coll">
																	    			<b>Collection</b>Feature a collection of items that open into a fullscreen mobile experience.<a href="#">Learn more.</a>
																	    		</label>
																	    	</div>	
																	    	</li>
																	    </ul>
																	    <div class="two-tabs-first-radio">
																														    <div class="crt-ad-radio-desc">
																														    	<b>Fullscreen Experience</b>
																														    	<p>Add a fullscreen Canvas, a mobile experience that opens instantly from your ad. Start with a template or create a custom layout with photos, videos and links to get people to engage with your business and encourage them to take action.</p>
																														    </div>
																														    <div class="full-scrn-canvs-opt">
																		    												<input type="checkbox" name=""><label>Add a fullscreen Canvas</label>
																													    	<ul>
																													    		<li>
																													    			<div class="r">
																													    				<input type="radio" name="full-scrn-options">
																													    			</div>
																													    			<div class="des">
																													    				Quick creation from a template
																													    				<div class="new-cst-and-use-temp-row">
																														    				<button class="light-grey-btn get-new-customer">Get new customer <i class="fa fa-caret-down"></i></button>
																														    				<div class="three-new-customers-list">
																														    					<div class="s-r">	
																														    						<div class="s-r-left">
																														    							<img src="img/new-cus-img.png">
																														    						</div>
																														    						<div class="s-r-right">
																														    							<b>Get New Customers</b><p>Drive conversions with a mobile landing page that encourages action.</p>
																														    						</div>
																														    					</div>
																														    					<div class="s-r">	
																														    						<div class="s-r-left">
																														    							<img src="img/new-cus-img.png">
																														    						</div>
																														    						<div class="s-r-right">
																														    							<b>Get New Customers</b><p>Drive conversions with a mobile landing page that encourages action.</p>
																														    						</div>
																														    					</div>
																														    					<div class="s-r">	
																														    						<div class="s-r-left">
																														    							<img src="img/new-cus-img.png">
																														    						</div>
																														    						<div class="s-r-right">
																														    							<b>Get New Customers</b><p>Drive conversions with a mobile landing page that encourages action.</p>
																														    						</div>
																														    					</div>
																														    				</div>	
																																				<button type="button" class="blue-btn" data-toggle="modal" data-target="#useTemplate">Use Template</button>

																																				
																													    				</div>
																													    			</div>
																													    		</li>
																													    		<li>
																													    			<div class="r">
																													    				<input type="radio" name="full-scrn-options">
																													    			</div>
																													    			<div class="des">
																													    				Create a Canvas using advanced creation
																													    				<div class="create-canv">
																													    					<button class="blue-btn" data-toggle="modal" data-target="#create-canv-popup">Create</button>
																													    					<div id="create-canv-popup" class="modal fade" role="dialog">
																																				  <div class="modal-dialog">

																																				    <!-- Modal content-->
																																				    <div class="modal-content">
																																				      <div class="modal-header">
																																				        <button type="button" class="close" data-dismiss="modal">&times;</button>
																																				        <h4 class="modal-title">Canvas Builder</h4>
																																				      </div>
																																				      <div class="modal-body">
																																				        <div class="canvs-popup-header-optns">	
																																				        	<a href="#add-cnvs-component-popup" class="round-cmpnt-btn" data-toggle="modal"><i class="fa fa-plus-circle"></i>Component</a>
																																				        	<ul>
																																				        		<li><i class="fa fa-mobile"></i><br/>Preview</li>
																																				        		<li><i class="fa fa-mobile"></i><br/>Share</li>
																																				        		<li><i class="fa fa-save"></i><br/>Save</li>
																																				        		<li><i class="fa fa-check-square"></i><br/>Finish</li>
																																				        	</ul>
																																				        </div> 
																																				        <div class="canvs-components">
																																				        	<div class="canvs-components-left-sec">
																																					        	<div class="canvs-row">
																																					        		<input type="text" name="" placeholder="Give our canvas a name ..." class="canvs-title-field">
																																					        	</div>
																																					        	<div class="canvs-row he-cnvs-row se-cnvs-row">
																																					        		  <div class="panel-group" id="accordion">
																																										  <div class="panel panel-default">
																																										    <div class="panel-heading">
																																										      <h4 class="panel-title">
																																										        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#cnvs-settings">
																																										          Settings
																																										        </a>
																																										      </h4>
																																										    </div>
																																										    <div id="cnvs-settings" class="panel-collapse collapse">
																																										      <div class="panel-body">
																																										        <div class="common-row"> 
																																										        	<div class="col-md-3">
																																										        		<label>Theme</label>
																																										        	</div>
																																										        	<div class="col-md-9 theme-optn">
																																										        			<div class="tra-bg"><input type="radio" name="theme-optn"><a href="#">T</a></div>
																																										        			<div class="grey-bg"><input type="radio" name="theme-optn"><a href="#">T</a></div>
																																										        			<div class="cust-bg"><input type="radio" name="theme-optn">
																																										        				<button
																														    class="jscolor"
																														    style="width:50px; height:20px;"></button>Custom</div>
																															        	</div>
																															        </div>
																															        <div class="common-row"> 
																															        	<div class="col-md-3">
																															        		<label>Swipe to open final link <i class="fa fa-info-circle"></i></label>
																															        	</div>
																															        	<div class="col-md-9 theme-optn">
																															        			<input type="checkbox" class="ad_status" data-toggle="toggle" data-size="mini">
																															        	</div>
																															        </div>
																															        <div class="common-row"> 
																															        	<div class="col-md-3">
																															        		<label>Support Instagram <i class="fa fa-info-circle"></i></label>
																															        	</div>
																															        	<div class="col-md-9 theme-optn">
																															        			<input type="checkbox" class="ad_status" data-toggle="toggle" data-size="mini">
																															        	</div>
																															        </div>
																															      </div>
																															    </div>
																															  </div>																														   
																															</div>
																												        	</div>
																												        	<div class="canvs-row he-cnvs-row">
																												        		  <div class="panel-group" id="header-accordion">
																																	  <div class="panel panel-default">
																																	    <div class="panel-heading">
																																	      <h4 class="panel-title">
																																	      	<span>Header <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
																																	        <a class="accordion-toggle" data-toggle="collapse" data-parent="#header-accordion" href="#cnvs-header">
																																	          &nbsp;
																																	        </a>
																																	         <div class="dropdown comp-option-drp">
																																			    <button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
																																			    <ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>																																       
																																			    </ul>
																																			  </div>
																																	      </h4>
																																	    </div>
																																	    <div id="cnvs-header" class="panel-collapse collapse">
																																	      <div class="panel-body header-component">
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<img src="../img/dummy-img-thumbnail.jpg">
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		Upload a logo for your Canvas. For best results, images should be 882 x 66 pixels<br/>
																																	        		<button class="light-grey-btn">Upload Photo</button>
																																	        	</div>
																																	        </div>
																																	         <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Background Color</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		abc
																																	        	</div>
																																	        </div>
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Background Opacity</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		<option>
																																	        			<select>Select</select>
																																	        		</option>
																																	        	</div>
																																	        </div>
																																	      </div>
																																	    </div>
																																	  </div>																														   
																																	</div>
																												        	</div>
																												        	<div class="canvs-row cr-cnvs-row">
																												        		  <div class="panel-group" id="carousel-accordion">
																																	  <div class="panel panel-default">
																																	    <div class="panel-heading">
																																	      <h4 class="panel-title">
																																	      	<span>Carousel <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
																																	        <a class="accordion-toggle" data-toggle="collapse" data-parent="#carousel-accordion" href="#carousel-header">
																																	          &nbsp;
																																	        </a>
																																	         <div class="dropdown comp-option-drp">
																																			    <button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
																																			    <ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>																																       
																																			    </ul>
																																			  </div>
																																	      </h4>
																																	    </div>
																																	    <div id="carousel-header" class="panel-collapse collapse">
																																	      <div class="panel-body header-component">
																																	        
																																	         <div class="common-row">
																																	        	<p>Upload 2-10 images to show them in a carousel format. If images are not the same size, they will be cropped to match your first image.</p>
																																	        </div>
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Layout</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		 <div>
																																	        		 	<input type="radio" name="layout-opt"><i class="fa fa-mobile"></i>Fit to Width (Linkable)
																																	        		 </div>
																																	        		 <div>
																																	        		 	<input type="radio" name="layout-opt"><i class="fa fa-mobile"></i>FFit to Height (Tilt to Pan)
																																	        		 </div>
																																	        	</div>
																																	        </div>
																																	        <div class="common-row">
																																	        	<ul class="crsl-slide">
																																					<li><a href="#">1</a></li>
																																					<li><a href="#"  class="active">2</a></li>																												
																																					<li><a href="#">+</a></li>
																																				</ul>
																																				<div class="edit-selected-slide">
																																					<div class="common-row">	
																																		    			<div class="left-img">
																																		    				<img src="../img/use-temp-img-thumb.jpg">
																																		    			</div>
																																		    			<div class="right-detail">
																																		    				 <button class="light-grey-btn">Upload Photo</button>
																																		    				 <button class="light-grey-btn pull-right"><i class="fa fa-trash"></i></button>
																																		    			</div>
																																		    		</div>
																																		    		<div class="common-row">
																																						<label>Destination</label>
																																						<div class="row">
																																							<div class="col-md-3">
																																								<div class="custom-autocomplete-select cnvs-destination-dropdown">															 
																																									<select class="selectpicker show-tick" data-size="3">	 
																																						                 <option data-tokens="ketchup mustard">Website</option>	
																																						                 <option data-tokens="mustard">App Store</option>	  
																																						                 <option data-tokens="frosting">Canvas</option>											
																																									</select>													
																																								</div>
																																							</div>
																																							<div class="col-md-8">			
																																								<input type="text" name="" class="form-control">
																																							</div>	
																																						</div>		
																																					</div>
																																				</div>
																																	        </div>
																																	      </div>
																																	    </div>
																																	  </div>																														   
																																	</div>
																												        	</div>
																												        	<div class="canvs-row btn-cnvs-row">
																												        			<div class="panel-group" id="button-accordion">
																																	  <div class="panel panel-default">
																																	    <div class="panel-heading">
																																	      <h4 class="panel-title">
																																	      	<span>Button <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
																																	        <a class="accordion-toggle" data-toggle="collapse" data-parent="#button-accordion" href="#button-header">
																																	          &nbsp;
																																	        </a>
																																	         <div class="dropdown comp-option-drp">
																																			    <button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
																																			    <ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>																																       
																																			    </ul>
																																			  </div>
																																	      </h4>
																																	    </div>
																																	    <div id="button-header" class="panel-collapse collapse">
																																	      <div class="panel-body header-component">
																																	      	<div class="common-row">
																																	      		<form>
																																	      		<textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
																																	      		</form>
																																	      	</div>
																																		      <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Destination (required)</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		 <div class="col-md-4">
																																	        		 	<div class="custom-autocomplete-select cnvs-destination-dropdown">															 
																																							<select class="selectpicker show-tick" data-size="3">	 
																																				                 <option data-tokens="ketchup mustard">Website</option>	
																																				                 <option data-tokens="mustard">App Store</option>	  
																																				                 <option data-tokens="frosting">Canvas</option>											
																																							</select>													
																																						</div>
																																	        		 </div>
																																	        		 <div class="col-md-8">
																																	        		 	<input type="text" placeholder="http://" class="form-control">
																																	        		 </div>
																																	        	</div>
																																	        </div>
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Button color</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		d
																																	        	</div>
																																	        </div>
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Background color</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		d
																																	        	</div>
																																	        </div>
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Button style</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		<div class="col-md-6">
																																	        			<input type="radio" name="btn-style">Border (default)
																																	        		</div>
																																	        		<div class="col-md-6">
																																	        			<input type="radio" name="btn-style">Fill
																																	        		</div>
																																	        	</div>
																																	        </div>
																																	         <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Button position</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		<div class="col-md-6">
																																	        			<input type="radio" name="btn-pos">In line (default)
																																	        		</div>
																																	        		<div class="col-md-6">
																																	        			<input type="radio" name="btn-pos">Fixed to Bottom
																																	        		</div>
																																	        	</div>
																																	        </div>
																																	      </div>
																																	    </div>
																																	  </div>																														   
																																	</div>
																												        	</div>
																												        	<div class="canvs-row photo-cnvs-row">
																												        		  <div class="panel-group" id="photo-accordion">
																																	  <div class="panel panel-default">
																																	    <div class="panel-heading">
																																	      <h4 class="panel-title">
																																	      	<span>Photo <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
																																	        <a class="accordion-toggle" data-toggle="collapse" data-parent="#photo-accordion" href="#photo-header">
																																	          &nbsp;
																																	        </a>
																																	         <div class="dropdown comp-option-drp">
																																			    <button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
																																			    <ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>																																       
																																			    </ul>
																																			  </div>
																																	      </h4>
																																	    </div>
																																	    <div id="photo-header" class="panel-collapse collapse">
																																	      <div class="panel-body header-component">
																																	         
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Layout</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		 <div class="col-md-4">
																																	        		 	<input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Width (Linkable)
																																	        		 </div>
																																	        		 <div class="col-md-4">
																																	        		 	<input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Width (Tap to Expand)
																																	        		 </div>
																																	        		 <div class="col-md-4">
																																	        		 	<input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Height (Tilt to Pan)
																																	        		 </div>
																																	        	</div>
																																	        </div>
																																	        <div class="common-row">																														        	
																																				<div class="edit-selected-slide">
																																					<div class="common-row">	
																																		    			<div class="left-img">
																																		    				<img src="../img/use-temp-img-thumb.jpg">
																																		    			</div>
																																		    			<div class="right-detail">
																																		    				<p>Recommended: Image height of 1920 pixels</p>
																																		    				<button class="light-grey-btn">Upload Photo</button>
																																		    				  
																																		    			</div>
																																		    		</div>
																																		    		<div class="common-row">
																																						<label>Destination</label>
																																						<div class="row">
																																							<div class="col-md-3">
																																								<div class="custom-autocomplete-select cnvs-destination-dropdown">															 
																																									<select class="selectpicker show-tick" data-size="3">	 
																																						                 <option data-tokens="ketchup mustard">Website</option>	
																																						                 <option data-tokens="mustard">App Store</option>	  
																																						                 <option data-tokens="frosting">Canvas</option>											
																																									</select>													
																																								</div>
																																							</div>
																																							<div class="col-md-8">			
																																								<input type="text" name="" class="form-control">
																																							</div>	
																																						</div>		
																																					</div>
																																				</div>
																																	        </div>
																																	      </div>
																																	    </div>
																																	  </div>																														   
																																	</div>
																												        	</div>
																												        	<div class="canvs-row text-cnvs-row">
																												        			<div class="panel-group" id="text-accordion">
																																	  <div class="panel panel-default">
																																	    <div class="panel-heading">
																																	      <h4 class="panel-title">
																																	      	<span>Text <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
																																	        <a class="accordion-toggle" data-toggle="collapse" data-parent="#text-accordion" href="#text-header">
																																	          &nbsp;
																																	        </a>
																																	         <div class="dropdown comp-option-drp">
																																			    <button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
																																			    <ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>																																       
																																			    </ul>
																																			  </div>
																																	      </h4>
																																	    </div>
																																	    <div id="text-header" class="panel-collapse collapse">
																																	      <div class="panel-body header-component">
																																	      	<div class="common-row">
																																	      		<p>Add context to your ad. Tell people more about your product or brand.</p>
																																	      		<form>
																																	      		<textarea name="editor2" id="editor2" rows="10" cols="80"></textarea>
																																	      		</form>
																																	      	</div>
																																		     
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Background color</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		d
																																	        	</div>
																																	        </div>																														      
																																	      </div>
																																	    </div>
																																	  </div>																														   
																																	</div>
																												        	</div>
																												        	<div class="canvs-row video-cnvs-row">
																												        		  <div class="panel-group" id="video-accordion">
																																	  <div class="panel panel-default">
																																	    <div class="panel-heading">
																																	      <h4 class="panel-title">
																																	      	<span>Video <i class="fa fa-pencil" class="edit-cnvs-title"></i></span>
																																	        <a class="accordion-toggle" data-toggle="collapse" data-parent="#video-accordion" href="#video-header">
																																	          &nbsp;
																																	        </a>
																																	         <div class="dropdown comp-option-drp">
																																			    <button id="comp-option" type="button" data-toggle="dropdown"><i aria-hidden="true" class="fa fa-ellipsis-h"></i></button>
																																			    <ul class="dropdown-menu" role="menu" aria-labelledby="comp-option">
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Delete</a></li>
																																			      <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Show Advanced Settings</a></li>																																       
																																			    </ul>
																																			  </div>
																																	      </h4>
																																	    </div>
																																	    <div id="video-header" class="panel-collapse collapse">
																																	      <div class="panel-body header-component">
																																	         
																																	        <div class="common-row">
																																	        	<div class="col-md-3 left">
																																	        		<label>Layout</label>
																																	        	</div>
																																	        	<div class="col-md-9 right">
																																	        		 <div class="col-md-6">
																																	        		 	<input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Width
																																	        		 </div>
																																	        		 <div class="col-md-6">
																																	        		 	<input type="radio" name="layout-opt"><i class="fa fa-mobile"></i> Fit to Height (Tilt to Pan)
																																	        		 </div>																														        		
																																	        	</div>
																																	        </div>
																																	        <div class="common-row">																														        	
																																				<div class="edit-selected-slide">
																																					<div class="common-row">	
																																		    			<div class="left-img">
																																		    				<img src="../img/use-temp-img-thumb.jpg">
																																		    			</div>
																																		    			<div class="right-detail">
																																		    				<p>Upload a video file (.mp4 or .mov). Recommended: keep your videos under 2 minutes and use captions so that people can still engage without audio.</p>
																																		    				<button class="light-grey-btn">Upload Video</button>
																																		    				  
																																		    			</div>
																																		    		</div>																															    		
																																				</div>
																																	        </div>
																																	      </div>
																																	    </div>
																																	  </div>																														   
																																	</div>
																												        	</div>
																												        	<div class="canvs-row add-more text-center">																									        	
																												        		<a href="#add-cnvs-component-popup" class="plus-add-more-c" data-toggle="modal">+ Add more component</a>
																												        	</div>
																											        	</div>
																											        	<div class="canvs-components-right-sec">
																												        	<div style="margin-top: 0" class="common-row">
																																<div class="img-or-video-prev">
																																	<img src="../img/use-temp-img-prev.jpg">
																																</div>
																																<h1>Add Context</h1>
																																<p>Change the text and use this space to tell people about your product, brand, or service. </p>
																																<button class="big-black-bordered-btn">Write something ...</button>
																															</div>
																															<div class="common-row">
																																<div class="img-or-video-prev">
																																	<img src="../img/use-temp-img-prev.jpg">
																																</div>
																																<h1>Add Context</h1>
																																<p>Change the text and use this space to tell people about your product, brand, or service. </p>
																																<button class="big-black-bordered-btn">Write something ...</button>
																															</div>
																											        	</div>
																											        </div>
																											      </div>
																											    </div>
																											  </div>
																										</div>
																				    				</div>
																				    			</div>
																				    		</li>
																				    		<li>
																				    			<div class="r">
																				    				<input type="radio" name="full-scrn-options">
																				    			</div>
																				    			<div class="des">
																				    				Use existing Canvas
																				    			</div>
																				    		</li>
																				    	</ul>	
																				    </div>
																				    <div class="img-and-video-radio-opt">
																				    	<div class="img-video-radio-tabs">
																							<ul class="nav nav-tabs">
																								<li class="active">
																									<a href="#radio-tab1" data-toggle="tab">
																										<label class="radio-inline">
																											<input id="f-option" name="selector" type="radio">
																											<label for="f-option">Image</label>
																											<div class="check"></div>
																										</label>
																									</a>
																								</li>
																								<li>
																									<a href="#radio-tab2" data-toggle="tab">
																										<label class="radio-inline">
																											<input id="f-option" name="selector" type="radio">
																											<label for="f-option">Video / Slideshow</label>
																											<div class="check"></div>
																										</label>
																									</a>
																								</li>
																							</ul>
																								
																							<div class="tab-content">
																						    	<div class="img-radio-tab-cont tab-pane active" id="radio-tab1">
																						    			<div class="select-img-row">
																						    				<button class="light-grey-btn common-select-img-popup" data-target="#common-select-img-popup" data-toggle="modal">Select Image</button>
																						    				
																						    			</div>
																						    			<div class="img-specification">
																						    				<h5>IMAGE SPECIFICATIONS</h5>
																						    				<ul>
																						    					<li>Recommended image size: 1200 × 628 pixels</li>
																						    					<li>Recommended image ratio: 1.91:1</li>
																						    					<li>To maximize ad delivery, use an image that contains little or no overlaid text.</li>
																						    				</ul>
																						    			</div>
																						    			<div class="destination-row">
																						    				<h5>Destination <i class="fa fa-info-circle"></i></h5>
																						    				<div class="common-row">
																						    					<input type="radio" name="">
																						    					<div class="col-md-11" style="padding-left: 0">
																						    						<b>Website URL</b> <i class="fa fa-info-circle"></i><br>
																						    						<input type="text" name="" class="form-control">
																						    					</div>
																						    					<div class="common-row">
																						    						<input type="radio" name="">
																						    						<div class="col-md-11" style="padding-left: 0">
																							    						<b>Messenger Setup</b> <i class="fa fa-info-circle"></i><br>
																							    						<p>Create the first few messages people see in Messenger after they click on your ad.</p>
																							    						<button class="light-grey-btn">Set up message</button>
																						    						</div>
																						    					</div>
																						    				</div>
																						    			</div>
																						    			<div class="common-row">						    	
																				    						<label>Display Link</label>
																				    						<input type="text" class="form-control">
																						    			</div>
																						    			<div class="common-row">
																				    						<label>Text</label>
																				    						<textarea class="form-control" placeholder="Enter text that clearly tells people about what you're promoting"></textarea>					    				
																						    			</div>
																						    			<div class="common-row">						    	
																				    						<label>Headline</label>
																				    						<input type="text" class="form-control">
																						    			</div>
																						    			<div class="common-row">
																				    						<label>News Feed Link Description <i class="fa fa-info-circle"></i></label>
																				    						<textarea class="form-control" placeholder="Enter text that clearly tells people about what you're promoting"></textarea>					    				
																						    			</div>
																						    			<div class="common-row">
																				    						<label>Call To Action <i class="fa fa-info-circle"></i></label><br>
																				    						<div class="custom-autocomplete-select call-to-ac-lrn-more">
																												<select class="selectpicker show-tick" data-size="8">
																												  <option data-tokens="ketchup mustard">Learn More</option>
																												  <option data-tokens="mustard">Lorem</option>
																												  <option data-tokens="frosting">Dummy text</option>
																												  <option data-tokens="mustard">Lorem</option>
																												  <option data-tokens="frosting">Dummy text</option>
																												  <option data-tokens="mustard">Lorem</option>
																												  <option data-tokens="frosting">Dummy text</option>
																												</select>													
																                                        	</div>
																				    						 				    				
																						    			</div>
																						    	</div>
																								<div class="video-slideshow-radio-tab-cont tab-pane" id="radio-tab2">

																									<div class="common-row">
																										<button class="light-grey-btn common-select-video-popup" data-target="#common-select-video-popup" data-toggle="modal">Select Video</button>
																											<div id="common-select-video-popup" class="modal fade" role="dialog">
																											  <div class="modal-dialog">

																											    <!-- Modal content-->
																											    <div class="modal-content">
																											      <div class="modal-header">
																											        
																											        <ul class="nav nav-tabs">
																													  <li class="active"><a data-toggle="tab" href="#browse-lib"><i class="fa fa-file-video-o"></i> Browse Library</a></li>
																													  <li><a data-toggle="tab" href="#paste-link"><i class="fa fa-link"></i> Paste a Link</a></li>
																													  <li><a data-toggle="tab" href="#upload-video"><i class="fa fa-upload"></i> Upload Videos</a></li>
																													</ul>
																											      </div>
																											      <div class="modal-body">																											       
																														<div class="tab-content">
																														  <div id="browse-lib" class="tab-pane fade in active">
																															    <div class="filtering-and-grid-view-optns">
																															    	<a href="#" class="list-view-link"><i aria-hidden="true" class="fa fa-th-list"></i></a>
																															    	<a href="#" class="grid-view-link"><i aria-hidden="true" class="fa fa-th-large"></i></a>
																															    </div>
																															    <div class="video-views-outr">
																															    	<div class="simple-custom-upload-btn">
																																    	<button class="light-grey-btn"><i class="fa fa-upload"></i> Upload</button>
																																    	<input type="file" name="">
																																    </div>	
																															    	<div class="video-list-video">
																																			<table  class="table table-bordered table-inverse table-striped table-hover">
																												                      		<thead class="thead-default">
																												                      			<tr>
																												                      				<th></th>																												                      				 
																												                      				<th>Video Name</th>
																												                      				<th>Duration</th>
																												                      				<th>Last Used</th>
																												                      				<th>Resolution</th>
																												                      			</tr>
																												                      		</thead>
																												                      		<tbody>
																												                      			<tr class="video_rows">
																												                      				<td><input type="checkbox" name=""></td>	
																												                      				<td>
																												                      					<img src="../img/ident-acc-icon.jpg"> <span>Video (1958816381040581)</span>
																												                      				</td>
																												                      				<td>0.03</td> 
																												                      				<td>2017-10-14</td>
																												                      				<td>566x690</td>
																												                      			</tr>
																												                      			<tr class="video_rows">
																												                      				<td><input type="checkbox" name=""></td>	
																												                      				<td>
																												                      					<img src="../img/ident-acc-icon.jpg"> <span>Video (1958816381040581)</span>
																												                      				</td>
																												                      				<td>0.03</td> 
																												                      				<td>2017-10-14</td>
																												                      				<td>566x690</td>
																												                      			</tr>
																												                      			<tr class="video_rows">
																												                      				<td><input type="checkbox" name=""></td>	
																												                      				<td>
																												                      					<img src="../img/ident-acc-icon.jpg"> <span>Video (1958816381040581)</span>
																												                      				</td>
																												                      				<td>0.03</td> 
																												                      				<td>2017-10-14</td>
																												                      				<td>566x690</td>
																												                      			</tr>
																												                      			<tr class="video_rows">
																												                      				<td><input type="checkbox" name=""></td>	
																												                      				<td>
																												                      					<img src="../img/ident-acc-icon.jpg"> <span>Video (1958816381040581)</span>
																												                      				</td>
																												                      				<td>0.03</td> 
																												                      				<td>2017-10-14</td>
																												                      				<td>566x690</td>
																												                      			</tr>
																												                      		</tbody>
																												                      	</table>
																															    	</div>
																															    	<div class="video-grid-view">
																															    		<div class="common-row">
																															    			<div class="col-md-4">
																															    				<div class="single-video-thumb-view">
																															    						<img src="../img/a.jpg">
																															    						<div class="detail">							
																															    							<p>Video (1956329526...</p>
																															    							<span>0.06</span>
																															    						</div>
																															    						<input type="radio" name="">
																															    				</div>
																															    			</div>
																															    			<div class="col-md-4">
																															    				<div class="single-video-thumb-view">
																															    						<img src="../img/a.jpg">
																															    						<div class="detail">							
																															    							<p>Video (1956329526...</p>
																															    							<span>0.06</span>
																															    						</div>
																															    						<input type="radio" name="">
																															    				</div>
																															    			</div>
																															    			<div class="col-md-4">
																															    				<div class="single-video-thumb-view">
																															    						<img src="../img/a.jpg">
																															    						<div class="detail">							
																															    							<p>Video (1956329526...</p>
																															    							<span>0.06</span>
																															    						</div>
																															    						<input type="radio" name="">
																															    				</div>
																															    			</div>
																															    		</div>
																															    	</div>
																															    </div>
																														  </div>
																														  <div id="paste-link" class="tab-pane fade">
																														    <div class="paste-link-left">
																														    	<div class="common-row upload-inst">
																														    		<img src="../img/paste-link-dummy-img.png"> <span>Quickly upload a video by pasting the link of a hosted video file.</span>
																														    	</div>
																														    	<div class="common-row">
																														    		<div class="col-md-3 text-right"><label>Video URL</label></div>
																														    		<div class="col-md-8"><input type="text" name="" class="form-control"></div>
																														    	</div>
																														    	<div class="common-row">
																														    		<div class="col-md-3 text-right"><label>Title</label></div>
																														    		<div class="col-md-8"><input type="text" name="" class="form-control"></div>
																														    	</div>
																														    </div>
																														    <div class="paste-link-right">
																														    	<b>Paste a Direct Download Link to Your Video</b>
																														    	<p>Your video file must be directly downloadable from the link. We currently don't support shareable links or links that need to be authenticated.</p>
																														    	<p>If you are having trouble uploading, make sure you are pasting a direct download link from wherever it is hosted. You can test if it is downloadable by pasting the link in your browser. If supported, the video file will automatically download.</p>
																														    </div>
																														  </div>
																														  <div id="upload-video" class="tab-pane fade">
																														     	<div class="upload-btn-wrapper">
																																  <button class="btn"><i class="fa fa-upload"></i> Drag and drop a video or click to upload</button>
																																  <input type="file" name="myfile" />
																																</div>
																														  </div>
																														</div>
																											      </div>
																											      <div class="modal-footer">
																											        <button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
																											        <button type="button" class="blue-btn" data-dismiss="modal">Confirm</button>
																											      </div>
																											    </div>

																											  </div>
																											</div>


																										<button class="crt-slideshow-btn light-grey-btn">
																											Create Slideshow 
																										</button>
																									</div>
																									<div class="video-specification">

																						    				<h5>Video Recommendations:</h5>
																						    				<ul>
																						    					<li>Recommended Length: Up to 15 seconds</li>
																						    					<li>Recommended Aspect Ratio: Vertical (4:5)</li>
																						    					<li>Sound: Enabled with captions included</li>
																						    				</ul>

																						    				<h5>Video Specifications:</h5>
																						    				<ul>
																						    					<li>Recommended format: .mp4, .mov or .gif</li>
																						    					<li>Required Lengths By Placement:
																						    						<ul style="padding-top: 15px;padding-bottom: 5px;">
																						    							<li>Facebook: 240 minutes max</li>
																						    							<li>Audience Network: 5 - 120 seconds</li>
																						    							<li>Instagram Feed: Up to 60 seconds</li>
																						    						</ul>	

																						    					</li>
																						    					<li>Resolution: 600px minimum width</li>
																						    					<li>File size: Up to 4 GB max</li>
																						    				</ul>

																						    				<h5>Slideshow Specifications:</h5>
																						    				<ul>
																						    					<li>Use high resolution images or a video file to create a slideshow</li>
																						    					<li>Facebook and Instagram: 50 seconds max</li>
																						    					<li>Slideshows will loop</li>
																						    				</ul>
																						    			 
																									</div>

																									<div class="destination-row">
																					    				<h5>Destination <i class="fa fa-info-circle"></i></h5>
																					    				<div class="common-row">
																					    					<input type="radio" name="">
																					    					<div class="col-md-11" style="padding-left: 0">
																					    						<b>Website URL</b> <i class="fa fa-info-circle"></i><br>
																					    						<input type="text" name="" class="form-control">
																					    					</div>
																					    					<div class="common-row">
																					    						<input type="radio" name="">
																					    						<div class="col-md-11" style="padding-left: 0">
																						    						<b>Messenger Setup</b> <i class="fa fa-info-circle"></i><br>
																						    						<p>Create the first few messages people see in Messenger after they click on your ad.</p>
																						    						<button class="light-grey-btn">Set up message</button>
																					    						</div>
																					    					</div>
																					    				</div>
																						    		</div>
																					    			<div class="common-row">						    	
																			    						<label>Display Link</label>
																			    						<input type="text" class="form-control">
																					    			</div>
																					    			<div class="common-row">
																			    						<label>Text</label>
																			    						<textarea class="form-control" placeholder="Enter text that clearly tells people about what you're promoting"></textarea>					    				
																					    			</div>
																					    			<div class="common-row">						    	
																			    						<label>Headline</label>
																			    						<input type="text" class="form-control">
																					    			</div>
																					    			<div class="common-row">
																			    						<label>News Feed Link Description <i class="fa fa-info-circle"></i></label>
																			    						<textarea class="form-control" placeholder="Enter text that clearly tells people about what you're promoting"></textarea>					    				
																					    			</div>
																					    			<div class="common-row">
																			    						<label>Call To Action <i class="fa fa-info-circle"></i></label><br>
																			    						<div class="custom-autocomplete-select call-to-ac-lrn-more">
																											<select class="selectpicker show-tick" data-size="8">
																											  <option data-tokens="ketchup mustard">Learn More</option>
																											  <option data-tokens="mustard">Lorem</option>
																											  <option data-tokens="frosting">Dummy text</option>
																											  <option data-tokens="mustard">Lorem</option>
																											  <option data-tokens="frosting">Dummy text</option>
																											  <option data-tokens="mustard">Lorem</option>
																											  <option data-tokens="frosting">Dummy text</option>
																											</select>													
															                                        	</div>
																			    						 				    				
																					    			</div>
																								</div>
																							</div>
																						</div>
																				    </div>


																		</div>
																		<!-- two tabs first radio button content -->

																		<div class="two-tabs-second-radio">
																			<div class="manual-and-dynamic-cont">
																				<h5>Images/Videos and Links </h5>
																				<ul class="manual-and-dynamic-first-ul">
																					<li><input type="radio" name="img-vid-links" id="select-manual"><label for="select-manual">Manually choose images, videos and links</label></li>
																					<li><input type="radio" name="img-vid-links" id="dynamic-temp"><label for="dynamic-temp">Fill template dynamically from a product set</label></li>
																				</ul>
																				<div class="manual-imgs-radio-opt">
																					<div class="common-row">
																						<label>Text</label>
																						<textarea class="form-control" placeholder="Enter text that clearly tells people about what you're promoting" style="font-size:12px"></textarea>
																					</div>
																					<div class="common-row">
																						<h5>Destination </h5>
																						<div class="common-row">
																							<input type="radio" name="web-url" id="web-url"><label for="web-url">Website URL</label>
																						</div>
																						<div class="common-row">
																							<input type="radio" name="web-url" id="mess-setup"><label for="mess-setup">Messenger Setup </label>
																							<p>Create the first few messages people see in Messenger after they click on your ad</p> 
																							<button class="light-grey-btn">Set up message</button>
																						</div>
																						<div class="common-row">
																							<input type="checkbox" name=""> <label>Add a card at end with your Page profile picture</label>
																						</div>
																						<div class="common-row cards-imgs">
																							<a href="#" class="select-card-link">Select card from previous ads</a>
																							<ul class="crsl-slide">
																								<li><a href="#">1</a></li>
																								<li><a href="#">2</a></li>
																								<li><a href="#">3</a></li>
																								<li><a href="#">4</a></li>
																								<li><a href="#">5</a></li>
																								<li><a class="active" href="#">6</a></li>
																								<li><a href="#">+</a></li>
																							</ul>
																								<div class="img-and-video-radio-opt-for-cards">
																									    	<div class="img-video-radio-tabs">
																												<ul class="nav nav-tabs">
																													<li class="active">
																														<a data-toggle="tab" href="#radio-tab3" aria-expanded="true">
																															<label class="radio-inline">
																																<input type="radio" name="selector" id="f-option">
																																<label for="f-option">Image</label>
																																<div class="check"></div>
																															</label>
																														</a>
																													</li>
																													<li class="">
																														<a data-toggle="tab" href="#radio-tab4" aria-expanded="false">
																															<label class="radio-inline">
																																<input type="radio" name="selector" id="f-option">
																																<label for="f-option">Video / Slideshow</label>
																																<div class="check"></div>
																															</label>
																														</a>
																													</li>
																												</ul>
																													
																												<div class="tab-content">
																											    	<div id="radio-tab3" class="img-radio-tab-cont tab-pane active">
																											    			<div class="select-img-row">
																											    				<button data-toggle="modal" data-target="#common-select-img-popup" class="light-grey-btn common-select-img-popup">Select Image</button>
																											    			</div>
																											    			<div class="img-specification">
																											    				<h5>IMAGE SPECIFICATIONS</h5>
																											    				<ul>
																											    					<li>Recommended image size: 1200 × 628 pixels</li>
																											    					<li>Recommended image ratio: 1.91:1</li>
																											    					<li>To maximize ad delivery, use an image that contains little or no overlaid text.</li>
																											    				</ul>
																											    			</div>
																											    			<div class="destination-row">
																											    				<div class="common-row">
																												    				<h5>Destination URL  <i class="fa fa-info-circle"></i></h5>
																												    				<input type="text" class="form-control" name="">
																												    			</div>
																											    			</div>
																											    			<div class="destination-row">
																											    				<div class="common-row">
																												    				<h5>Headline <i class="fa fa-info-circle"></i></h5>
																												    				<input type="text" class="form-control" name="">
																												    			</div>
																											    			</div>
																											    			<div class="destination-row">
																											    				<div class="common-row">
																												    				<h5>Description  <i class="fa fa-info-circle"></i></h5>
																												    				<input type="text" class="form-control" name="">
																												    			</div>
																											    			</div>
																											    	</div>
																													<div id="radio-tab4" class="video-slideshow-radio-tab-cont tab-pane">

																														<div class="common-row">
																															<button class="light-grey-btn select-video-btn">Select Video</button>
																															<button class="crt-slideshow-btn light-grey-btn">
																																Create Slideshow 
																															</button>
																														</div>
																														<div class="video-specification">

																											    				<h5>Video Recommendations:</h5>
																											    				<ul>
																											    					<li>Recommended Length: Up to 15 seconds</li>
																											    					<li>Recommended Aspect Ratio: Vertical (4:5)</li>
																											    					<li>Sound: Enabled with captions included</li>
																											    				</ul>

																											    				<h5>Video Specifications:</h5>
																											    				<ul>
																											    					<li>Recommended format: .mp4, .mov or .gif</li>
																											    					<li>Required Lengths By Placement:
																											    						<ul style="padding-top: 15px;padding-bottom: 5px;">
																											    							<li>Facebook: 240 minutes max</li>
																											    							<li>Audience Network: 5 - 120 seconds</li>
																											    							<li>Instagram Feed: Up to 60 seconds</li>
																											    						</ul>	

																											    					</li>
																											    					<li>Resolution: 600px minimum width</li>
																											    					<li>File size: Up to 4 GB max</li>
																											    				</ul>

																											    				<h5>Slideshow Specifications:</h5>
																											    				<ul>
																											    					<li>Use high resolution images or a video file to create a slideshow</li>
																											    					<li>Facebook and Instagram: 50 seconds max</li>
																											    					<li>Slideshows will loop</li>
																											    				</ul>
																											    			 
																														</div>

																														<div class="destination-row">
																											    				<div class="common-row">
																												    				<h5>Destination URL  <i class="fa fa-info-circle"></i></h5>
																												    				<input type="text" class="form-control" name="">
																												    			</div>
																											    			</div>
																											    			<div class="destination-row">
																											    				<div class="common-row">
																												    				<h5>Display Link  <i class="fa fa-info-circle"></i></h5>
																												    				<input type="text" class="form-control" name="">
																												    			</div>
																											    			</div>
																											    			
																											    			<div class="destination-row">
																											    				<div class="common-row">
																												    				<h5>Headline <i class="fa fa-info-circle"></i></h5>
																												    				<input type="text" class="form-control" name="">
																												    			</div>
																											    			</div>
																											    			<div class="destination-row">
																											    				<div class="common-row">
																												    				<h5>Description  <i class="fa fa-info-circle"></i></h5>
																												    				<input type="text" class="form-control" name="">
																												    			</div>
																											    			</div>
																													</div>
																												</div>
																											</div>
																									    </div>








																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<!-- two tabs second radio button content -->

																		<div class="two-tabs-third-radio">
																			3
																		</div>
																		<!-- two tabs third radio button content -->

																	  </div>
																	  <div id="ext-post" class="tab-pane fade">
																	 	<label>Page Post</label><br>
																	 	<p class="no-post-exist"><i class="fa fa-info-circle" aria-hidden="true"></i> No eligible posts exist.</p>
																	 	<button class="light-grey-btn plus-popup">+</button><br>
																	 	<a href="#">Enter Post ID</a>
																	  </div>																	  
																	</div>
										      					</div>

										      					<div class="form-white-block tracking-form">
										      						<h5 class="white-block-legend">Tracking</h5>
										      						<div class="white-block-body">
										      							<div class="col-md-12 track-row">
										      								<label class="light-grey-label">Facebook Page <i class="fa fa-info-circle" aria-hidden="true"></i></label>
										      								 <input type="text" name="" placeholder="Ex: key1=value1&key2=value2" class="col-md-12">
									      								</div>
									      								<div class="col-md-12 track-row">
										      								<label class="light-grey-label">Pixel Tracking <i class="fa fa-info-circle" aria-hidden="true"></i></label>
										      								<div class="radio">
										      									<label><input name="optradio" type="radio">Track all conversions from my Facebook pixel</label>
										      									<div class="pixel-tracking-ids">
											      									<ul>
											      										<li><b>John Pixel</b><br>Pixel ID: 143012979405875</li>
											      									</ul>			 
											      								</div>	
								      										</div>
								      										 <div class="radio">
										      									<label><input name="optradio" type="radio">Do not track conversions</label> 
								      										</div>
									      								</div>
									      								<div class="col-md-12 track-row">
									      									<label>Mobile App Events Tracking (optional)</label>
									      									<div class="custom-autocomplete-select">
																				<select class="selectpicker show-tick" data-size="3">
																				  <option data-tokens="ketchup mustard">Columns</option>
																				  <option data-tokens="mustard">Lorem</option>
																				  <option data-tokens="frosting">Dummy text printing</option>
																				</select>													
								                                        	</div>
									      								</div>
										      						</div>
										      					</div>

										      				</div>
										      			</div>
										      			<div class="col-md-6 col-sm-5">
									      					<div class="form-white-block" style="margin-top:20px;">
									      						<div class="row main-heading">
									      							<div class="col-md-9 padding10"><h5><b>Ad id<span id="ad_id"></span></b></h5><input type="checkbox" checked id="ad_status" value="" data-toggle="toggle" data-size="mini"> </div>
									      							<div class="col-md-3 padding10">
									      								<div class="btn-and-caret-icon-dropdown" style="margin-top: 6px;">
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
									      								</div>
									      							</div>
									      						</div>
									      						<div class="white-block-body">
									      							<p>
									      								<a href="#"><span class="camp_total_camps">1</span> Campaigns</a><br>
									      								<span>Targeting, placement, budget and schedule</span>
									      							</p>
									      							<p>
									      								<a href="#"><span class="camp_total_adsets"></span> Ad Set</a><br>
									      								<span>Images, videos, text and links</span>
									      							</p>
									      						</div>
									      					</div>
									      					<div class="form-white-block">
									      						<div class="row main-heading">
									      						 	<h5 class="white-block-legend" style="border-bottom: 0">
									      						 		<i class="fa fa-warning" style="color:red"></i> 
									      								Fix 1 Error in 1 Ad
									      							</h5>
									      						</div>  
									      						<div class="white-block-body">
									      							<p>
									      								 Promoted Object Is Missing: Your campaign must include an ad set with a selected object to promote related to your objective (ex: Page, URL, event). Please update your ad set to continue. (#1487930)
									      							</p>
									      						</div>
									      					</div> 

									      					<div class="form-white-block ad-preview">
									      						<div class="row main-heading">
									      						 	<h5 class="white-block-legend" style="border-bottom: 0">
									      						 		 Ad Preview
									      							</h5>
									      						</div>  
									      						<div class="white-block-body">
									      							<div class="row">
									      								<div class="col-md-6 ads-preview-dropd-down-list">
									      									<a href="#" class="light-grey-btn">Feature Phone <i class="fa fa-caret-down" aria-hidden="true"></i></a>
									      									<ul>
									      										<li><img src="img/ads-list-icon1.jpg"> Mobile News Feed</li>
									      										<li><img src="img/ads-list-icon1.jpg"> Feature Phone</li>
									      										<li class="active"><img src="img/ads-list-icon1.jpg"> Desktop New Feed</li>
									      										<li><img src="img/ads-list-icon1.jpg"> Mobile News Feed</li>
									      										<li><img src="img/ads-list-icon1.jpg"> Feature Phone</li>
									      										<li><img src="img/ads-list-icon1.jpg"> Desktop New Feed</li>
									      									</ul>
									      								</div>
									      								<div class="col-md-6 text-right" style="padding-right: 50px;">5 of 10</div>
									      							</div>
									      							<div class="row">
									      								<div class="col-md-12 text-center">
									      									<div id="ads-preview-crsl" class="carousel slide" data-ride="carousel">	
																			    <div class="carousel-inner">
																			      <div class="item active">
																			      		<img src="img/ads-preview-icon.jpg">
																			         	<p>Please select a Facebook Page post to show this type of ad</p>
																			      </div>

																			      <div class="item">
																			       		<img src="img/ads-preview-icon.jpg">
																			         	<p>Please select a Facebook Page post to show this type of ad</p>
																			      </div>
																			    
																			      <div class="item">
																			      		<img src="img/ads-preview-icon.jpg">
																			         	<p>Please select a Facebook Page post to show this type of ad</p>
																			      </div>
																			    </div>

																			    <!-- Left and right controls -->
																			    <a class="left carousel-control" href="#ads-preview-crsl" data-slide="prev">
																			      <span class="glyphicon glyphicon-chevron-left"></span>
																			      <span class="sr-only">Previous</span>
																			    </a>
																			    <a class="right carousel-control" href="#ads-preview-crsl" data-slide="next">
																			      <span class="glyphicon glyphicon-chevron-right"></span>
																			      <span class="sr-only">Next</span>
																			    </a>
																			</div>
																		</div>	
									      							</div>
									      						</div>
									      					</div> 

								      					</div>
										      		</div>
										      	<?php //endforeach; endforeach; ?>
										      	
										      	</div>
										      <!-- ends of ads -->
										</div> 
										<div class="save-editing-fix-bar">	
												<span>1 item to review</span>     
												<button class="light-grey-btn">Close</button>
												<button class="blue-btn">Review Draft Items</button>
										</div>
								    </div>
								    <div id="history-tab" class="tab-pane fade">
								    	<h1 class="drw-main-heading">Activity History for <span class="dummy_text">Campaign:</span> <span class="camapaign_name">demo</span> <span class="mixed_value" style="display: none;"></h1>	
								     	<div class="righ-drw-first-third-tab-cal">
								    			<button class="light-grey-btn">This month: Sep 1, 2017 - Sep 21, 2017</button>
								    	</div>
								    	<div class="history-table">
								    		<div class="history-filtering">
								    			<div class="custom-autocomplete-select">
	                                        		<select class="selectpicker show-tick" data-live-search="true" data-size="3">
													  <option data-tokens="ketchup mustard">Columns</option>
													  <option data-tokens="mustard">Lorem</option>
													  <option data-tokens="frosting">Dummy text printing</option>
													</select>	
													<select class="selectpicker show-tick" data-live-search="true" data-size="3">
													  <option data-tokens="ketchup mustard">Columns</option>
													  <option data-tokens="mustard">Lorem</option>
													  <option data-tokens="frosting">Dummy text printing</option>
													</select>													
	                                        	</div>
	                                        </div>	
							    			<table class="table table-bordered table-inverse table-striped table-hover">
												  <thead class="thead-default">
												    <tr>													       
												      <th>Activity</th>
												      <th>Activity Details</th>
												      <th>Item Changed</th>
												      <th>Name</th>
												      <th>Date and Time</th>													     
												    </tr>
												  </thead>
												  <tbody>
												    <tr>
												      <td>Ad set targeting updated...</td>
												      <td>&#8377; 800.00 Per day</td>
												      <td class="editable-row">new</td>
												      <td>John Clarke</td>
												      <td>09/15/2017 at 4:29pm</td>													       
												    </tr>
												    <tr>
												      <td>Ad set targeting updated...</td>
												      <td>&#8377; 800.00 Per day</td>
												      <td class="editable-row">new</td>
												      <td>John Clarke</td>
												      <td>09/15/2017 at 4:29pm</td>	
												    </tr>
												    <tr>
												      <td>Ad set targeting updated...</td>
												      <td>&#8377; 800.00 Per day</td>
												      <td class="editable-row">new</td>
												      <td>John Clarke</td>
												      <td>09/15/2017 at 4:29pm</td>	
												    </tr>										
												  </tbody>
											</table>
											<div class="no-more-his-result">
													No more activities to show
											</div>
								    	</div>
								    </div>									   
								  </div>
							</div>
					</div>
				</div>
			</div>
		</div>		
	</div>				
</div>
<!-- adjust budget popup -->
<div id="adjust_button" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Editing Budget for 1 Ad Set</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-4">
						<label class="pull-right">For each ad set:</label>
					</div>
					<div class="col-md-4">
						<div class="custom-autocomplete-select">
							<select class="selectpicker show-tick" data-size="5">
								<option data-tokens="ketchup mustard">Increase daily budget by</option>
								<option data-tokens="mustard">Increase daily budget by</option>
								<option data-tokens="frosting">Decrease daily budget by</option>
								<option data-tokens="ketchup mustard">Set daily budget to</option>
							</select>													
						</div>
					</div>
					<div class="col-md-4 inline-text">
						<input type="text" class="form-control custom-input">
						<div class="custom-autocomplete-select">
							<select class="selectpicker show-tick" data-size="5">
								<option data-tokens="ketchup mustard">%</option>
								<option data-tokens="mustard">$</option>
							</select>													
						</div>
					</div>
				</div>

				<div class="row" style="margin-top: 10px;">
					<div class="col-md-9 col-md-offset-2 inline-text">
						<input type="checkbox" class="">
						<label>Daily budget cap (optional):</label>
						<input type="text" class="form-control custom-input">
					</div>
				</div>
				
				<div class="row"><div class="col-md-9 col-md-offset-2">Combined total of all budgets:800.00</div></div>

				<div class="row" style="margin-top: 20px;">
					<div class="col-md-12">
						<table class="table table-bordered table-striped"> 
							<thead>
								<tr>
									<th>Ad Set</th>
									<th>Old Budget</th>
									<th>New Budget</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Product 1</td>
									<td>800.00</td>
									<td>800.00</td>
								</tr>
								<tr>
									<td><b>1 Ad Sets</b><br><span>increase budget by 0%</span></td>
									<td><b>800.00</b><br><span>Previous Total Budget </span></td>
									<td><b>800.00</b><br><span>New Total Budget </span></td>
								</tr>
							</tbody>						
						</table>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info" data-dismiss="modal">Save</button>
			</div>
		</div>

	</div>
</div>
<!-- adjust budget popup -->

<!--camp Mixed Value -->
<div id="cam_mixed_value" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal">&times;</button>
        <p>Selected items have mixed statuses</p>
      </div>
      <div class="modal-footer">
      	<div class="col-md-6">
      		<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
      	</div>
      	<div class="col-md-6">
      		<button type="button" class="btn btn-primary">Pause all</button>
      		<button type="button" class="btn btn-primary">Run all</button>
      	</div>
      </div>
    </div>

  </div>
</div>
<!--camp Mixed Value -->

<div id="add-insta-acct-btn" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title">Connect an Instagram Account for Advertising</h4>
			</div>
			<div class="modal-body">
				<div class="radio">
					<label><input name="optradio" type="radio">Add an existing account <span>Connect an existing Instagram account to this Page.</span></label> 
				</div>
				<div class="radio">
					<label><input name="optradio" type="radio">Create a new account<span>Create a new Instagram account and connect it to this Page.</span></label> 
				</div>
				<hr class="edit-forms-divider">&nbsp;
				<p>Enter the email address and username you want to use for your new Instagram account. We'll send you an email with instructions on setting your password.</p>
				<form>
					<input type="text" name="" class="form-control" placeholder="Username">
					<input type="text" name="" class="form-control" placeholder="Email">
					<input type="text" name="" class="form-control" placeholder="Re-enter email">
					<input type="text" name="" class="form-control" placeholder="Phone number">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
				<button type="button" class="blue-btn" data-dismiss="modal">Save to Confirm</button>
			</div>
		</div>

	</div>
</div>


<!-- USer Modal -->
<div id="useTemplate" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Create a Fullscreen Experience</h4>
			</div>
			<div class="modal-body">
				<div class="use-temp-let-sec"> 
					<div class="use-temp-pop-row">
						<h5>Cover Image or Video</h5>
						<p>Use an eye-catching image or video as a visual way to introduce your product, service or brand.</p>
						<div class="use-temp-radio-tabs">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#temp-radio-tab1" data-toggle="tab">
										<label class="radio-inline">
											<input id="f-option" name="selector" type="radio">
											<label for="f-option">Image</label>
											<div class="check"></div>
										</label>
									</a>
								</li>
								<li>
									<a href="#temp-radio-tab2" data-toggle="tab">
										<label class="radio-inline">
											<input id="f-option" name="selector" type="radio">
											<label for="f-option">Video</label>
											<div class="check"></div>
										</label>
									</a>
								</li>
							</ul>
								
							<div class="tab-content">
						    	<div class="img-radio-tab-cont tab-pane active" id="temp-radio-tab1">
						    		<div class="common-row">	
						    			<div class="left-img">
						    				<img src="../img/use-temp-img-thumb.jpg">
						    			</div>
						    			<div class="right-detail">
						    				<p>Recommended: Image width of 1080 pixels</p>
						    				<button class="light-grey-btn">Replace Photo</button>
						    			</div>
						    		</div>	
						    		<div class="common-row">
						    			<label>Destination URL (optional)</label>
						    			<input type="text" name="" class="form-control">
						    		</div>
						    	</div>
								<div class="video-slideshow-radio-tab-cont tab-pane" id="temp-radio-tab2">
					    			<div class="common-row">	
						    			<div class="left-img">
						    				<img src="../img/use-temp-img-thumb.jpg">
						    			</div>
						    			<div class="right-detail">
						    				<p>Recommended: Image width of 1080 pixels</p>
						    				<button class="light-grey-btn">Upload Video</button>
						    			</div>
						    		</div>							    		 
								</div>
							</div>
						</div>
					</div>
					<div class="use-temp-pop-row">
						<h5>Text</h5>
						<textarea class="form-control"></textarea>
					</div>
					<div class="use-temp-pop-row">
						<h5>Text</h5>
						<textarea class="form-control"></textarea>
					</div>
					<div class="use-temp-pop-row">
						<h5>Button</h5>
						<p>Give people an action to take.</p>
						<div class="common-row">
							<label>Text</label>
							<input type="text" name="" class="form-control">
						</div>
						<div class="common-row">
							<label>Destination URL</label>
							<input type="text" name="" class="form-control">
						</div>
					</div>
					<div class="use-temp-pop-row">
						<h5>Carousel</h5>
						<p>Upload 2-10 images to show them in a carousel format. If images are not the same size, they will be cropped to match your first image.</p>
						<ul class="crsl-slide">
							<li><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li><a href="#">5</a></li>
							<li><a href="#" class="active">6</a></li>
							<li><a href="#">+</a></li>
						</ul>
						<div class="edit-selected-slide">
							<div class="common-row">	
				    			<div class="left-img">
				    				<img src="../img/use-temp-img-thumb.jpg">
				    			</div>
				    			<div class="right-detail">
				    				 <button class="light-grey-btn">Replace Photo</button>
				    				 <button class="light-grey-btn pull-right"><i class="fa fa-trash"></i></button>
				    			</div>
				    		</div>
				    		<div class="common-row">
								<label>Destination URL</label>
								<input type="text" name="" class="form-control">
							</div>
						</div>
					</div>
					<div class="use-temp-pop-row">
						<div class="common-row">
							<h5>Text</h5>
							<textarea class="form-control" placeholder="Add descriptive content for people to read while they swipe through your carousel images."></textarea>
						</div>	
						<div class="common-row">
							<h5>Button</h5>
							<p>Give people an action to take.</p>
						</div>
						<div class="common-row">
							<label>Text</label>
							<input type="text" name="" class="form-control">
						</div>
						<div class="common-row">
							<label>Destination URL</label>
							<input type="text" name="" class="form-control">
						</div>
					</div>
					 
				</div>
				<div class="use-temp-right-sec">
					<div class="common-row" style="margin-top: 0">
						<div class="img-or-video-prev">
							<img src="../img/use-temp-img-prev.jpg">
						</div>
						<h1>Add Context</h1>
						<p>Change the text and use this space to tell people about your product, brand, or service. </p>
						<button class="big-black-bordered-btn">Write something ...</button>
					</div>

					<div class="common-row">
						<div class="img-or-video-prev">
							<img src="../img/use-temp-img-prev.jpg">
						</div>
						<h1>Add Context</h1>
						<p>Change the text and use this space to tell people about your product, brand, or service. </p>
						<button class="big-black-bordered-btn">Write something ...</button>
					</div>

				</div>	



			</div>
			<div class="modal-footer">
				<button class="light-grey-btn"><i class="fa fa-mobile"></i> Preview on Mobile</button>
				<button type="button" class="blue-btn" data-dismiss="modal">Done</button>
			</div>
		</div>

	</div>
</div>


<div id="add-cnvs-component-popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select components to add</h4>
      </div>
      <div class="modal-body">
        <div class="single-cnvs-cpmponent">
        	<div class="cc">
                <div class="items">
                    <div class="info-block block-info clearfix">                      
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="a" autocomplete="off" value="">
                                    <img src="../img/button_unselected.png">
                                    <!-- <span class="glyphicon glyphicon-ok glyphicon-lg"></span> -->
                                    <h5>Button</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-cnvs-cpmponent">
        	<div class="cc">
                <div class="items">
                    <div class="info-block block-info clearfix">                      
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default" style="padding-top: 33px;">
                                <div class="bizcontent">
                                    <input type="checkbox" name="a" autocomplete="off" value="">
                                    <img src="../img/carousel_unselected.png">
                                    <!-- <span class="glyphicon glyphicon-ok glyphicon-lg"></span> -->
                                    <h5>Carousel</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-cnvs-cpmponent">
        	<div class="cc">
                <div class="items">
                    <div class="info-block block-info clearfix">                      
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="a" autocomplete="off" value="">
                                    <img src="../img/photo_unselected.png">
                                    <!-- <span class="glyphicon glyphicon-ok glyphicon-lg"></span> -->
                                    <h5>Photo</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-cnvs-cpmponent">
        	<div class="cc">
                <div class="items">
                    <div class="info-block block-info clearfix">                      
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="a" autocomplete="off" value="">
                                    <img src="../img/text_unselected.png">
                                    <!-- <span class="glyphicon glyphicon-ok glyphicon-lg"></span> -->
                                    <h5>Text Block</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="single-cnvs-cpmponent">
        	<div class="cc">
                <div class="items">
                    <div class="info-block block-info clearfix">                      
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="a" autocomplete="off" value="">
                                    <img src="../img/video_unselected.png">
                                    <!-- <span class="glyphicon glyphicon-ok glyphicon-lg"></span> -->
                                    <h5>Video</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
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

<div id="common-select-img-popup" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <ul class="nav nav-tabs">
		  <li class="active"><a data-toggle="tab" href="#upload-img-tab"><i class="fa fa-upload"></i> Upload Image</a></li>
		  <li><a data-toggle="tab" href="#img-library"><i class="fa fa-file-image-o"></i> Image Library</a></li>
		  <li><a data-toggle="tab" href="#stock-imgs"><i class="fa fa-file-image-o"></i> Stock Images</a></li>
		</ul>
      </div>
      <div class="modal-body">																											       
			<div class="tab-content">
			  <div id="upload-img-tab" class="tab-pane fade in active" style="text-align:center;">
			   <div class="upload-btn-wrapper">
				  <button class="btn"><i class="fa fa-upload"></i> Drag and drop an image or click to upload</button>
				  <input type="file" name="myfile" />
				</div>
			  </div>
			  <div id="img-library" class="tab-pane fade">
			     <div class="img-filtering-tags">
			     		<a href="#">All 23</a> <a href="#" class="active">Add Images 23</a> <a href="#">Instagram Images</a>
			     </div>
			     <div class="img-gallery-thumb">
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">																														     	
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     	<div class="thumb">
			     		<span><img src="../img/ident-acc-icon.jpg"></span>	
			     		<input type="radio" name="img-thumb" class="thumbCheck">
			     	</div>
			     </div>
			  </div>
			  <div id="stock-imgs" class="tab-pane fade">
			    <div class="common-row img-search-field">
			    	<input type="text" name="" class="form-control" placeholder="Search Free Stock Images">
			    </div>
			    <div class="stock-imgs-gallery-thumb">
			    	<div class="no-stock-search">
			    		<img src="../img/no-stock-dummy-img.png">
			    		<p>Search for professional images to use in your ads.<br>Any images you select will be saved in your image library.</p>
			    	</div>
			    </div>
			  </div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="light-grey-btn" data-dismiss="modal">Cancel</button>
        <button type="button" class="blue-btn" data-dismiss="modal">Confirm</button>
      </div>
    </div>

  </div>
</div>



</body>
</html>
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'editor1' );
	CKEDITOR.replace( 'editor2' );
</script>
<?php else : header('location:index.php'); endif ?>