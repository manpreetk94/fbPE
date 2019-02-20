jQuery(document).ready(function(){
       
        $('.two-tabs-first-radio').show();
		$('.two-tabs-second-radio').hide();
		$('.two-tabs-third-radio').hide();
		$('.canvas_options').hide();
		//map
		/*$('.map_country').show();
		$('.map_region').hide();
		$('.map_dma').hide();*/

	jQuery('[data-toggle="tooltip"]').tooltip();
	jQuery('code a').click(function() {
		jQuery('#myModal .modal-body p').text(jQuery(this).data('reason'));
	});
	
	/*set dropdown value in input in create campaign popup*/
	jQuery('.camp_objective li').click(function() {
		jQuery('#camp_objective').val(jQuery(this).data('value'));
		jQuery('.camp_objective').prev().text(jQuery(this).text().trim());
		jQuery(".camp_objective").toggle();  
	});
	/*set dropdown value in input in create campaign popup*/
	/*delete campaign*/
		$(document).on('click','#delete_camp',function(){
		var array = [];
		jQuery('.campaigns_checkbox:checked').each(function() {		
			array.push(jQuery(this).parent().parent().attr('id'));
		});	
		jQuery('#delete_camp_id').val(JSON.stringify(array));
	});
	/*delete campaign*/

	/*delete adsets*/

		$(document).on('click','#delete_adsets',function(){
		var array = [];
		var length = jQuery('.adsets_checkbox:checked').length;
		jQuery('.adsets_checkbox:checked').each(function() {
			array.push(jQuery(this).parent().parent().attr('id'));
		});	
		jQuery('#delete_adset_id').val(JSON.stringify(array));
	});
	/*delete adsets*/
	/*delete ad*/
	  $(document).on('click','#delete_ads',function(){
		var array = [];
		var length = jQuery('.ad_checkbox:checked').length;
		jQuery('.ad_checkbox:checked').each(function() {
			array.push(jQuery(this).parent().parent().attr('id'));
		});	
		jQuery('#delete_ads_id').val(JSON.stringify(array));
	});
	/*delete ad*/

	/*choose campaign state new or existing*/
	jQuery('#choose_campaigns').change(function() {
	
		var value = jQuery(this).val();
		if(value == 'new') {
			jQuery('#new_campaign').show();
			jQuery('#existing_campaign').hide();
			jQuery('#new_campaign input[name="campaign_name"]').val('');
		} else {
			jQuery('#new_campaign').hide();
			jQuery('#existing_campaign').show();
			jQuery('#exit_campaign_name').val('');
			jQuery('#exit_camapaign_id').val('');
			jQuery('#exit_campaign_name').parent().removeClass('cross-existing-camp');
			jQuery('#exit_campaign_name').attr('readonly',false);
			//jQuery('#existing_campaign .custom-auto-complete-data').show();
		}
	});

	jQuery('#existing_campaign ul>li').click(function() {
		jQuery('#exit_campaign_name').val(jQuery(this).data('name'));
		jQuery('#exit_campaign_name').parent().addClass('cross-existing-camp');
		jQuery('#exit_campaign_name').attr('readonly',true);
		jQuery('#exit_camapaign_id').val(jQuery(this).data('id'));
	});

	jQuery('#existing_campaign .cross-existing-camp-icon').click(function() {
		jQuery('#exit_campaign_name').parent().removeClass('cross-existing-camp');
		jQuery('#exit_campaign_name').val('');
		jQuery('#exit_camapaign_id').val('');
		jQuery('#exit_campaign_name').attr('readonly',false);
	});
	/*choose campaign state new or existing*/

	/*choose exist adsets*/
	jQuery('#exist_adsets ul>li').click(function() {
		jQuery('#exit_adset_name').val(jQuery(this).data('name'));
		jQuery('#exit_adset_name').parent().addClass('cross-existing-camp');
		jQuery('#exit_adset_name').attr('readonly',true);
		jQuery('#exit_adset_id').val(jQuery(this).data('id'));
	});

	jQuery('#exist_adsets .cross-existing-camp-icon').click(function() {
		jQuery('#exit_adset_name').parent().removeClass('cross-existing-camp');
		jQuery('#exit_adset_name').val('');
		jQuery('#exit_adset_id').val('');
		jQuery('#exit_adset_name').attr('readonly',false);
	});
	/*choose exist adsets*/

	/*duplicate campaigns*/

		$(document).on('click','.duplicate-campaign',function(){
		var array = [];
		jQuery('.campaigns_checkbox:checked').each(function() {
			array.push(jQuery(this).parent().parent().attr('id'));
		});	
		jQuery('#duplicate_campaign_id').val(JSON.stringify(array));
	});
	/*duplicate campaigns*/

	/* duplicate adsets popup*/
	
	$(document).on('click','.duplicate-adset-click',function(){
		var array = [];
		jQuery('.adsets_checkbox:checked').each(function() {
			array.push(jQuery(this).parent().parent().attr('id'));
		});	
		jQuery('#duplicate_adsets_id').val(JSON.stringify(array));
	});


	$(document).on('click','#duplicate-adsets input[name="campaign_for_adset"]',function(){
		var value = jQuery(this).val();
		if(value == 'Original campaign') {
			jQuery('#already_campaign').hide();
			jQuery('#new_camp').hide();
			jQuery('#already_campaign_name').val('');
			jQuery('#already_campaign_id').val('');
			jQuery('#new_camp input[name="campaign_name"]').val('');
			jQuery('#new_camp #camp_objective').val('LINK_CLICKS');
			jQuery('#new_camp .camp_obj_name').text('Traffic');
		} else if(value == 'Existing campaign') {
			jQuery('#already_campaign').show();
			jQuery('#new_camp').hide();
			jQuery('#new_camp input[name="campaign_name"]').val('');
			jQuery('#new_camp #camp_objective').val('LINK_CLICKS');
			jQuery('#new_camp .camp_obj_name').text('Traffic');
		} else {
			jQuery('#already_campaign_name').val('');
			jQuery('#already_campaign_id').val('');
			jQuery('#already_campaign').hide();
			jQuery('#new_camp').show();
		}
	});


	$(document).on('click','#already_campaign ul>li',function(){
		jQuery('#already_campaign_name').val(jQuery(this).data('name'));
		jQuery('#already_campaign_name').parent().addClass('cross-existing-camp');
		jQuery('#already_campaign_name').attr('readonly',true);
		jQuery('#already_campaign_id').val(jQuery(this).data('id'));
	});


	$(document).on('click','#already_campaign .cross-existing-camp-icon',function(){
		jQuery('#already_campaign_name').parent().removeClass('cross-existing-camp');
		jQuery('#already_campaign_name').val('');
		jQuery('#already_campaign_id').val('');
		jQuery('#already_campaign_name').attr('readonly',false);
	});

	/* duplicate adsets popup*/

	$(document).on('click','.create-adset-popup',function(){
		jQuery('#choose_campaigns option:eq(1)').prop('selected',true);
		jQuery("#choose_campaigns").selectpicker("refresh");
		jQuery('#exit_campaign_name').prop('readonly',false);
		jQuery('#new_campaign, #exist_adsets').hide();
		jQuery('#existing_campaign, #new_adsets').show();
		jQuery('#choose_adsets option[value="existing"]').prop('disabled', false);
		jQuery('#choose_adsets option[value="new"]').prop('selected',true);
		jQuery("#choose_adsets").selectpicker("refresh");
		jQuery('#ad_input_box').hide();
		jQuery('#choose_ads option[value="skip"]').prop('selected',true);
		jQuery("#choose_ads").selectpicker("refresh");
	});


	$(document).on('click','.create-ad-popup',function(){

		jQuery('#choose_campaigns option[value="existing"]').prop('selected',true);
		jQuery("#choose_campaigns").selectpicker("refresh");
		jQuery('#exit_campaign_name,#exit_adset_name').prop('readonly',false);
		jQuery('#new_campaign, #new_adsets').hide();
		jQuery('#existing_campaign, #exist_adsets').show();
		jQuery('#choose_adsets option[value="existing"]').prop('disabled', false);
		jQuery('#choose_adsets option[value="skip"], #choose_ads option[value="skip"]').prop('disabled', true);
		jQuery('#choose_adsets option[value="existing"]').prop('selected',true);
		jQuery("#choose_adsets").selectpicker("refresh");
		jQuery('#choose_ads option[value="new"]').prop('selected',true);
		jQuery("#choose_ads").selectpicker("refresh");
		jQuery('#ad_input_box').show();
	});


	$(document).on('click','.create-camp-popup',function(){
		jQuery('#choose_campaigns option[value="new"]').prop('selected',true);
		jQuery("#choose_campaigns").selectpicker("refresh");
		jQuery('#exit_campaign_name').prop('readonly',false);
		jQuery('#new_campaign, #new_adsets, #ad_input_box').show();
		jQuery('#existing_campaign, #exist_adsets').hide();
		jQuery('#choose_adsets option[value="existing"]').prop('disabled', true);
		jQuery('#choose_adsets option[value="new"], #choose_ads option[value="new"]').prop('selected', true);
		jQuery("#choose_adsets").selectpicker("refresh");
		jQuery("#choose_ads").selectpicker("refresh");
	});

	/* Export funcationality*/

	$(document).on('click','.export_campaigns li',function(){
	
		var text = jQuery(this).text();
		var campaign_array = [];
		if(text == 'Export Selected' || text == 'Export Selected as Plain Text') {
			campaign_array = checkMainDiv();
			csvImport(campaign_array, text);
		} else {
			csvImport(_camapaigns, text);
		}
		setTimeout(function() {			
		},1500);
	});

	function checkMainDiv() {
		var campaign_array = [];
		var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
		if(main_div_id == '#camp') {
			jQuery('.campaigns_checkbox:checked').each(function() {
				var cmp_id  = jQuery(this).parent().parent().attr('id');
				var newData = _.find(_camapaigns, function(o) { return o.id == cmp_id;  });
				campaign_array.push(newData);
			});
			return campaign_array;
		} 
		if(main_div_id == '#ad-sets') {
		 	jQuery('.adsets_checkbox:checked').each(function() {
				var adset_id  = jQuery(this).parent().parent().attr('id');
				_camapaigns.forEach(function(item,index) {
					if(item.adsets) {
						var adsets = _.find(item.adsets.data, function(o) { return o.id == adset_id;  });
						if(adsets != undefined) {
							campaign_array.push(_camapaigns[index]);
						}
					}
				});
			});
			return campaign_array;
		}
		if(main_div_id == '#ads') {
			jQuery('.ad_checkbox:checked').each(function() {
				var ad_id  = jQuery(this).parent().parent().attr('id');
				_camapaigns.forEach(function(item,index) {
					if(item.ads) {
						var ads = _.find(item.ads.data, function(o) { return o.id == ad_id;  });
						if(ads != undefined) {
							campaign_array.push(_camapaigns[index]);
						}
					}
				});
			});
			return campaign_array;
		}
	}

	var finalVal = 'Campaign ID,Campaign Name,Campaign Status,Campaign Objective,Buying Type,Ad Set ID,Ad Set Run Status,Ad Set Lifetime Impressions,Ad Set Name,Ad Set Time Start,Ad Set Daily Budget,Ad Set Lifetime Budget,Countries,Location Types,Gender,Age Min,Age Max,Optimization Goal,Attribution Spec,Billing Event,Bid Amount,Ad ID,Ad Status,Preview Link,Ad Name,Title,Body'+'\n';

	var plainVal = 'Campaign ID Campaign Name Campaign Status Campaign Objective Buying Type Ad Set ID Ad Set Run Status Ad Set Lifetime Impressions Ad Set Name Ad Set Time Start Ad Set Daily Budget Ad Set Lifetime Budget Countries Location Types Gender Age Min Age Max Optimization Goal Attribution Spec Billing Event Bid Amount Ad ID Ad Status Preview Link Ad Name Title Body'+'\n';

	function csvImport(data, text) {
		if(data.length > 0) {
			data.forEach(function(camp, index) {
				if(text == 'Export Selected as Plain Text') {
					plainVal += camp.id+' '+camp.name+' '+camp.status+' '+camp.objective+' '+camp.buying_type;
				} else {
					finalVal += camp.id+','+camp.name+','+camp.status+','+camp.objective+','+camp.buying_type;
				}

				if(camp.adsets) {
					camp.adsets.data.forEach(function(adset, innerIndex) {
						var date = new Date(adset.start_time);
						var newDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' +  date.getFullYear()+ ' '+date.getHours()+':'+date.getMinutes()+':'+date.getSeconds();
						
						if($.inArray('gender',adset.targeting) > 0) {
							var gender = adset.targeting.gender;
						} else {
							var gender = '';
						}

						if(adset.attribution_spec) {
							var attribution_spec = adset.attribution_spec;
						} else {
							var attribution_spec = '';
						}

						if($.inArray('targeting', adset) > 0) {
							var countries = adset.targeting.geo_locations.countries[0];
							var location_types = adset.targeting.geo_locations.location_types[0];
							var age_min = adset.targeting.age_min;
							var age_max = adset.targeting.age_max;
						} else {
							var countries = '';
							var location_types = '';
							var age_min = '';
							var age_max = '';
						}

						if(text == 'Export Selected as Plain Text') {
							plainVal += ' '+adset.id+' '+adset.status+' '+adset.lifetime_imps+' '+adset.name+' '+newDate+' '+adset.daily_budget+' '+adset.lifetime_budget+' '+countries+' '+location_types+' '+gender+' '+age_min+' '+age_max+' '+adset.optimization_goal+' '+attribution_spec+' '+adset.billing_event+' '+adset.bid_amount;
						} else {
							finalVal += ','+adset.id+','+adset.status+','+adset.lifetime_imps+','+adset.name+','+newDate+','+adset.daily_budget+','+adset.lifetime_budget+','+countries+','+location_types+','+gender+','+age_min+','+age_max+','+adset.optimization_goal+','+attribution_spec+','+adset.billing_event+','+adset.bid_amount;
						}
						
					});
				}
				if(camp.ads) {
					camp.ads.data.forEach(function(ads, innerIndex) {
						if(ads.creative_title) {
							var title = ads.creative_title;
						} else {
							var title = '';
						}

						if(ads.creative_body) {
							var body = ads.creative_body;
						} else {
							var body = '';
						}

						if(ads.status) {
							var status = ads.status;
						} else {
							var status = '';
						}

						if (body.search(/("|,|\n)/g) >= 0)
							body = '"' + body + '"';

						if(text == 'Export Selected as Plain Text') {
							plainVal += ' '+ads.id+' '+status+' '+ads.preview_link+' '+ads.name+' '+title+' '+body;
						} else {
							finalVal += ','+ads.id+','+status+','+ads.preview_link+','+ads.name+','+title+','+body;
						}
					});
				}
				plainVal += '\n';
				finalVal += '\n';
			});
		} 
		setTimeout(function() {
			jQuery('#loader_div.loaderPopup').modal('hide');
			if(text == 'Export Selected as Plain Text') {
				jQuery('#export-as-plain-text textarea').val(plainVal);
				jQuery('#export-as-plain-text').modal('show');
			} else {
				var pom = document.createElement('a');
				pom.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(finalVal));
				var date = new Date();
				pom.setAttribute('download', 'export_'+date.getFullYear()+'_'+date.getMonth()+'_'+date.getDate()+'.csv');
				pom.click(); 
			}
		},500);
		
	}
	/* Export funcationality*/


	/*Edit campaign name*/

	$(document).on('click','.edit-camp-btn',function(){
		jQuery(this).closest('.editable-row').addClass('padding0');
		jQuery(this).closest('.show-camp-row').hide();
		jQuery(this).parent().parent().parent().find('.hide-camp-row').show();
		jQuery(this).parent().parent().next().children().focus();
		jQuery(this).parent().parent().parent().next().hide();
	});


	$(document).on('focusout','.editable-input',function(ev){
	
	

		if(ev.which == 13 || ev.which == 0) {
			$('#loader_div').modal('show');
			var name = jQuery(this).val();
			var access_token = get('code');
			var id = jQuery(this).parent().parent().parent().parent().attr('id');
			var _this = jQuery(this);
			jQuery.ajax({
				'url'    	:  'https://graph.facebook.com/v2.11/'+id,
				'method'	:  'POST',
				'data'		:  'name='+name+'&access_token='+access_token,
				success : function(data){
					console.log('data after', data);
					$('#loader_div').modal('hide');
					if(data.success == true) {
						
						_this.parent().hide();
						_this.parent().siblings().show();		
						_this.parent().parent().next().show();
						_this.parent().parent().parent().removeClass('padding0');
						//alert(_this.parent().parent().children().attr('class'));
						_this.parent().parent().children().first().html(name+'<span class="edit-row-title"><i class="fa fa-pencil edit-camp-btn" aria-hidden="true"></i></span>');
					}
				}
			});
		}
	});

	/*edit name in edit tab*/

	jQuery('.inline_name_edit_tab').keyup(function(ev) {
		if(ev.which == 13) {
			$('#loader_div').modal('show');
			var name = jQuery(this).val();
			var access_token = get('code');
			var id = jQuery(this).parent().attr('id');
			var _this = jQuery(this);
			jQuery.ajax({
				'url'    	:  'https://graph.facebook.com/v2.11/'+id,
				'method'	:  'POST',
				'data'		:  'name='+name+'&access_token='+access_token,
				success : function(data){
					console.log('data afeter', data);
					if(data.success == true) {
						window.location.reload();
					}
				}
			});
		}
	});


	function get(name){
		if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
			return decodeURIComponent(name[1]);
	}
	/*Edit campaign name*/
	$('.bet').hide();
	$('.remain').show();
	$('.bugget_bid').hide();

});


function gets(name){
	if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.search))
		return decodeURIComponent(name[1]);
}


$(document).on('click','.ads-preview-dropd-down-list a',function(){
	$(".ads-preview-dropd-down-list ul").toggle();   	  	
});

	
//<!-- date range -->
$(document).ready(function(){

	$(".ads-preview-dropd-down-list a").click(function(event) {	
		$(".ads-preview-dropd-down-list ul").toggle();   	  	
	});

	$(".show-camp-obj-btn").click(function(event) {
		event.preventDefault();
		$(".objective").toggle();   	  	
	});

	$(".get-new-customer").click(function(event) {
		$(".three-new-customers-list").toggle();   	  	
	});

	$(".get-new-posts").click(function(event) {
		$(".three-new-posts-list").toggle();   	  	
	});


	$('#img-vid').click(function () {
		$('.two-tabs-first-radio').show();
		$('.two-tabs-second-radio').hide();
		$('.two-tabs-third-radio').hide();
	});
	$('#mul-img').click(function () {

		$('.two-tabs-first-radio').hide();
		$('.two-tabs-second-radio').show();
		$('.two-tabs-third-radio').hide();
		$('.clear_video').hide();
	});
	$('#img-coll').click(function () {
		$('.two-tabs-first-radio').hide();
		$('.two-tabs-second-radio').hide();
		$('.two-tabs-third-radio').show();
	});

	$('#demo').daterangepicker({
		"showDropdowns": true, 
		"showWeekNumbers": true,
		"timePickerSeconds": true,
		"autoApply": true,
		"dateLimit": {
			"days": 7
		},
		"ranges": {
			"Today": [
			"2017-09-18T06:26:37.657Z",
			"2017-09-18T06:26:37.657Z"
			],
			"Yesterday": [
			"2017-09-17T06:26:37.657Z",
			"2017-09-17T06:26:37.657Z"
			],
			"Last 7 Days": [
			"2017-09-12T06:26:37.657Z",
			"2017-09-18T06:26:37.657Z"
			],
			"Last 30 Days": [
			"2017-08-20T06:26:37.657Z",
			"2017-09-18T06:26:37.658Z"
			],
			"This Month": [
			"2017-08-31T18:30:00.000Z",
			"2017-09-30T18:29:59.999Z"
			],
			"Last Month": [
			"2017-07-31T18:30:00.000Z",
			"2017-08-31T18:29:59.999Z"
			]
		},
		"locale": {
			"direction": "ltr",
			"format": "MM/DD/YYYY HH:mm",
			"separator": " - ",
			"applyLabel": "Apply",
			"cancelLabel": "Cancel",
			"fromLabel": "From",
			"toLabel": "To",
			"customRangeLabel": "Custom",
			"daysOfWeek": [
			"Su",
			"Mo",
			"Tu",
			"We",
			"Th",
			"Fr",
			"Sa"
			],
			"monthNames": [
			"January",
			"February",
			"March",
			"April",
			"May",
			"June",
			"July",
			"August",
			"September",
			"October",
			"November",
			"December"
			],
			"firstDay": 1
		},
		"alwaysShowCalendars": true,
		"startDate": "09/12/2017",
		"endDate": "09/18/2017",
		"opens": "left"
	}, function(start, end, label) {
		console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
	}); 
});

//<!-- header-filter-drop-down script-->
$(document).ready(function () {
	$(".btn-select").each(function (e) {
		var value = $(this).find("ul li.selected").html();
		if (value != undefined) {
			$(this).find(".btn-select-input").val(value);
			$(this).find(".btn-select-value").html(value);
		}
	});
});

$(document).on('click', '.btn-select', function (e) {
	e.preventDefault();
	var ul = $(this).find("ul");
	if ($(this).hasClass("active")) {
		if (ul.find("li").is(e.target)) {
			var target = $(e.target);
			target.addClass("selected").siblings().removeClass("selected");
			var value = target.html();
			$(this).find(".btn-select-input").val(value);
			$(this).find(".btn-select-value").html(value);
		}
		ul.hide();
		$(this).removeClass("active");
	}
	else {
		$('.btn-select').not(this).each(function () {
			$(this).removeClass("active").find("ul").hide();
		});
		ul.slideDown(300);
		$(this).addClass("active");
	}
});

$(document).on('click', function (e) {
	var target = $(e.target).closest(".btn-select");
	if (!target.length) {
		$(".btn-select").removeClass("active").find("ul").hide();
	}
});


$(document).ready(function(){
	$('.selectpicker').selectpicker();
});


//<!-- power editor menus script -->
$(document).ready(function(){
	$(".power-editor-menu").click(function(event) {
		$(".power-editor-menus-list").slideToggle();
		$(".body-overlay").toggle();
		$("body").toggleClass("overflowHdn");

	});
});

//<!-- sub header-left account dropdown -->
$(document).ready(function(){
	$(".sub-header-left-acnt-sec a").click(function(event) {
		$(".personal-acc-by-id").slideToggle();   	 
	});
});

//<!-- second tab duplicate entry popup script -->
$(document).ready(function(){	
	$('.spinner .btn:first-of-type').on('click', function() {
		$(this).parent().prev().val(parseInt($(this).parent().prev().val())+parseInt(1));
	});
	$('.spinner .btn:last-of-type').on('click', function() {
		if($(this).parent().prev().val() > 1) {
			$(this).parent().prev().val(parseInt($(this).parent().prev().val())-parseInt(1));
		}
	});		 
});

// <!-- right drawer script -->
$(document).ready(function(){
	$(".open-drw-arrow").click(function(event) {  		
		if(!$(this).parent().parent().parent().parent().hasClass('drawer-open-content')){
			$('#view-tab').addClass('active in');
			$('.drawer-view-chart').addClass('active');
			$('.drawer-edit').removeClass('active');
			$('.drawer-history').removeClass('active');
			$('.drawer-view-chart').removeClass('active');	
		}
		

		//viewTab();
		var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
		if(main_div_id == '#camp') {
			if($('.campaigns_checkbox').is(':checked')) {
				$(".right-fix-drawer-outr").toggleClass("drawer-open-content"); 
			} 	  
		} 
		if(main_div_id == '#ad-sets') {
			if($('.adsets_checkbox').is(':checked')) {
				$(".right-fix-drawer-outr").toggleClass("drawer-open-content"); 
			} 	
		}
		if(main_div_id == '#ads') {
			if($('.ad_checkbox').is(':checked')) {
				$(".right-fix-drawer-outr").toggleClass("drawer-open-content"); 
			}
		}

		if($('.right-fix-drawer-outr').hasClass('drawer-open-content')){
			viewTab();
		}

		
	});
	$(".open-drw").click(function(event) {  
		var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
		if(main_div_id == '#camp') {
			if($('.campaigns_checkbox').is(':checked')) {
				if($('.right-fix-drawer-outr').hasClass('drawer-open-content') == false) {
					$(".right-fix-drawer-outr").toggleClass("drawer-open-content"); 
				}
			} 
		}
		if(main_div_id == '#ad-sets') {
			if($('.adsets_checkbox').is(':checked')) {
				if($('.right-fix-drawer-outr').hasClass('drawer-open-content') == false) {
					$(".right-fix-drawer-outr").toggleClass("drawer-open-content"); 
				}
			} 		
		}
		if(main_div_id == '#ads') {
			if($('.ad_checkbox').is(':checked')) {
				if($('.right-fix-drawer-outr').hasClass('drawer-open-content') == false) {
					$(".right-fix-drawer-outr").toggleClass("drawer-open-content"); 
				}
			} 		
		}
		  
	});

	/*On off toggle butn*/
	setTimeout(function(){
	
			$(document).on('click','td .toggle-group label,td .toggle-group span',function(){
			var cmp_id = $(this).parent().parent().parent().parent().attr('id');			
			var sts =$(this).text(); 
			changeStatus(cmp_id,sts);
			$('.campaigns_checkbox').prop('checked',false);
			$(this).parent().parent().parent().prev().find('.campaigns_checkbox').prop('checked', true);
			var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
			if($('.campaigns_checkbox').is(':checked')) {
				$(main_div_id+' div.disable-me,'+main_div_id+' li>i').removeClass('disable-me');
			} else {
				$(main_div_id+' .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2),'+main_div_id+' .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
			}

			if($(this).text() == 'On') {
				if(main_div_id == '#camp') {					
					$('#camapaign-full-details .toggle.btn.btn-xs').removeClass('btn-primary').removeClass('on').addClass('btn-default off');
				} 
				if(main_div_id == '#ad-sets') {					
					$('#adsets-full-details .toggle.btn.btn-xs').removeClass('btn-primary').removeClass('on').addClass('btn-default off');
				}
				if(main_div_id == '#ads') {				
					$('#ads-full-details .toggle.btn.btn-xs').removeClass('btn-primary').removeClass('on').addClass('btn-default off');
				}
			} else {
				if(main_div_id == '#camp') {
					$('#camapaign-full-details .toggle.btn.btn-xs').addClass('btn-primary').removeClass('btn-default off');
				} 
				if(main_div_id == '#ad-sets') {
					$('#adsets-full-details .toggle.btn.btn-xs').addClass('btn-primary').removeClass('btn-default off');
				}
				if(main_div_id == '#ads') {
					$('#ads-full-details .toggle.btn.btn-xs').addClass('btn-primary').removeClass('btn-default off');
				}
			}
		});

		
			
			$(document).on('click','.camapaign-details-list .toggle-group label, .adsets-details-list .toggle-group label, .ads-details-list .toggle-group label',function(){
			var cmp_id = $(this).parent().prev().val();
		
			
			if($(this).text() == 'On') {
				$('tr#'+cmp_id+' .toggle.btn.btn-xs').removeClass('btn-primary').removeClass('on').addClass('btn-default off');
			} else {
				$('tr#'+cmp_id+' .toggle.btn.btn-xs').addClass('btn-primary').removeClass('btn-default off');
			}
		}); 
	},500);
	/*On off toggle butn*/

	/*Campaigns checkbox*/

		$(document).on('click','.campaigns_checkbox',function(){
		if(!$(this).is(':checked')) {
			$('.all_camapaign_checkbox').prop('checked',false);
		}
		$('#adset_table tbody tr,#ad_table tbody tr').addClass('hide-row');
		var checked_count = $('.campaigns_checkbox:checked').length;
		$('.campaigns_checkbox:checked').each(function() {
			var cmp_id = $(this).parent().parent().attr('id');
			
			$('#adset_table tbody tr.camp_'+cmp_id+', #ad_table tbody tr.camp_'+cmp_id).removeClass('hide-row').addClass('show-row');
			$('#camapaign-full-details').show();
			$('#ads-full-details,#adsets-full-details').hide();
			$('#camapaign_selected span').text(checked_count);
			$('#camapaign_selected').show();
			$('.dummy_text').text('Campaign');
			if(checked_count > 1) {
				$('.mixed_value').show();
				$('.mixed_value').text(checked_count+ 'Campaigns');
				$('.camp_total_adsets').text($('#adset_table tbody .adset_rows.show-row').length);
				$('.camp_total_ads').text($('#ad_table tbody .ad_rows.show-row').length);
				$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').hide();
				$('#camp_name').val('Mixed Value');
				$('#camp_status').parent().hide();
			} else {
				getCampaginsData(cmp_id);
			}
		});

		if($('.campaigns_checkbox').is(':checked')) {
			$('li.ad-sets a span').text(' for '+checked_count+' Campaign');
			$('li.ads a span').text(' for '+checked_count+' Campaign');
			$('#camp .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #camp .left-fil1 .simple-default-icons-group li>i').removeClass('disable-me');
		} else {
			$('#adset_table tbody tr,#ad_table tbody tr').show();
			$('li.ad-sets a span').text('');
			$('li.ads a span').text('');
			$('#camapaign_selected').hide();
			$(".right-fix-drawer-outr").removeClass("drawer-open-content");
			$('#camp .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #camp .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
		}
	});


	$(document).on('click','.all_camapaign_checkbox',function(){
		if($(this).is(':checked')) {
			$('.campaigns_checkbox').prop('checked', true);
			var campaigns_count = $('.campaigns_checkbox:checked').length;
			$('#camapaign_selected span').text(campaigns_count);
			$('#camapaign_selected').show();
			$('.camp_total_adsets').text($('#adset_table tbody .adset_rows').length);
			$('.camp_total_ads').text($('#ad_table tbody .ad_rows').length);
			if(!$('#adsets_selected').is(':visible')) {
				$('li.ad-sets a span').text(' for '+campaigns_count+' Campaign');
				$('li.ads a span').text(' for '+campaigns_count+' Campaign');
			}

		} else {
			if(!$('#adsets_selected').is(':visible')) {
				$('li.ad-sets a span').text('');
				$('li.ads a span').text('');
			}
			$('.campaigns_checkbox').prop('checked', false);
			$('#camapaign_selected').hide();
			$(".right-fix-drawer-outr").removeClass("drawer-open-content");
		}

		if(campaigns_count > 1) {
			$('.mixed_value').show();
			$('.mixed_value').text(campaigns_count+ ' Campaigns');
			$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').hide();
			$('#camp_name').val('Mixed Value');
			$('#camp_status').parent().hide();
		} else {
			$('.mixed_value').hide();
			$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').show();
			$('#camapaign-full-details').show();
			$('#adsets-full-details').hide();
			$('#ads-full-details').hide();
			var camp_id = $('.campaigns_checkbox:checked').parent().parent().attr('id');
			getCampaginsData(camp_id);
		}
	});

	$('#camapaign_selected i').click(function() {
		$('#camapaign_selected').hide();
		$('.campaigns_checkbox').prop('checked',false);
		$('li.ad-sets a span').text('');
		$('li.ads a span').text('');
		$('.all_camapaign_checkbox').prop('checked',false);
		$(".right-fix-drawer-outr").removeClass("drawer-open-content");
		$('#adset_table tbody tr,#ad_table tbody tr').removeClass('hide-row').removeClass('show-row');
		$('#camp .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #camp .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
	});
	/*Campaigns checkbox*/

	
	/*adset checkbox*/

		$(document).on('click','.adsets_checkbox',function(){
		$('#camapaign-full-details, #ads-full-details').hide();
		$('#adsets-full-details').show();
		$('li.ad-sets a span').hide();
		if(!$(this).is(':checked')) {
			$('.all_adsets_checkbox').prop('checked',false);
		}

		$('#ad_table tbody tr').addClass('hide-row');
		var checked_count = $('.adsets_checkbox:checked').length;
		$('.adsets_checkbox:checked').each(function() {
			var adsets_id = $(this).parent().parent().attr('id');
			$('#ad_table tbody tr.adsets_'+adsets_id).addClass('show-row');
			$('#adsets_selected span').text(checked_count);
			$('#adsets_selected').show();
			$('.dummy_text').text('Ad Sets');
			if(checked_count > 1) {
				$('.mixed_value').show();
				$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').hide();
				$('.mixed_value').text(checked_count+ ' Ad Sets');
				$('#adsets-full-details').show();
				$('.camp_total_adsets').text($('#ad_table tbody tr.ad_rows').length);
				$('.camp_total_camps').text($('#camapaign_table tbody tr.camp_rows').length);
				$('#adset_name').val('Mixed Value');
				$('#adset_status').parent().hide();
			} else {
				getAdsetsData(adsets_id);
			}
		});

		if($('.adsets_checkbox').is(':checked')) {
			$('li.ads a span').text(' for '+checked_count+' Ad Set');
			$('#ad-sets .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ad-sets .left-fil1 .simple-default-icons-group li>i').removeClass('disable-me');
		} else {
			$('#ad_table tbody tr').show();
			if($('#camapaign_selected').is(':visible')) {
				$('li.ad-sets a span').show();
				var campaigns_count = $('.campaigns_checkbox:checked').length;
				$('li.ad-sets a span').text(' for '+campaigns_count+' Campaign');
				$('li.ads a span').text(' for '+campaigns_count+' Campaign');
			} else {
				$('li.ads a span').text('');
			}
			$(".right-fix-drawer-outr").removeClass("drawer-open-content");
			$('#adsets_selected').hide();
			$('#ad-sets .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ad-sets .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
		}
	});


	$(document).on('click','.all_adsets_checkbox',function(){
		if($(this).is(':checked')) {
			$('.adsets_checkbox').prop('checked', true);
			var adsets_count = $('.adsets_checkbox:checked').length;
			$('li.ad-sets a span').hide();
			$('#adsets_selected span').text(adsets_count);
			$('#adsets_selected').show();
			$('li.ads a span').text(' for '+adsets_count+' Ad Set');
			$('#adsets-full-details').show();
			$('#camapaign-full-details, #ads-full-details').hide();
			$('#adset_name').val('Mixed Value');
			$('#adset_status').parent().hide();
			$('#ad-sets .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ad-sets .left-fil1 .simple-default-icons-group li>i').removeClass('disable-me');
		} else {
			$('.adsets_checkbox').prop('checked', false);
			$(".right-fix-drawer-outr").removeClass("drawer-open-content");
			$('#ad-sets .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ad-sets .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
			if($('#camapaign_selected').is(':visible')) {
				$('li.ad-sets a span').show();
				$('#adsets_selected').hide();
				var campaigns_count = $('.campaigns_checkbox:checked').length;
				$('li.ad-sets a span').text(' for '+campaigns_count+' Campaign');
				$('li.ads a span').text(' for '+campaigns_count+' Campaign');
			} else {
				$('li.ads a span').text('');
				$('li.ad-sets a span').text('');
				$('li.ad-sets a span').show();
				$('#adsets_selected').hide();
			}
		}

		if(adsets_count > 1) {
			$('.mixed_value').show();
			$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').hide();
			$('.mixed_value').text(adsets_count+ ' Ad Sets');
			$('#adsets-full-details').show();
			$('.camp_total_ads').text($('#ad_table tbody tr.ad_rows').length);
			$('.camp_total_camps').text($('#camapaign_table tbody tr.camp_rows').length);
			$('#adset_name').val('Mixed Value');
			$('#adset_status').parent().hide();
		} else {
			$('#camapaign-full-details').hide();
			$('#adsets-full-details').show();
			$('#ads-full-details').hide();
		}
	});

	$('#adsets_selected i').click(function() {
		$('#adsets_selected').hide();
		$('.adsets_checkbox').prop('checked',false);
		if($('#camapaign_selected').is(':visible')) {
			var campaigns_count = $('.campaigns_checkbox:checked').length;
			$('li.ads a span').text(' for '+campaigns_count+' Campaign');
		} else {
			$('li.ads a span').text('');
		}
		$('li.ad-sets a span').show();
		$('.all_adsets_checkbox').prop('checked',false);
		$(".right-fix-drawer-outr").removeClass("drawer-open-content");
		$('#ad_table tbody tr').removeClass('hide-row').removeClass('show-row');
		$('#ad-sets .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ad-sets .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
	});
	/*end adset checkbox*/



	$(document).on('click','.ad_checkbox',function(){
		if(!$(this).is(':checked')) {
			$('.all_ad_checkbox').prop('checked',false);
		}

		$('#camapaign-full-details, #adsets-full-details').hide();
		$('#ads-full-details').show();
		$('#ads .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ads .left-fil1 .simple-default-icons-group li>i').removeClass('disable-me');
		$('#ads_selected').show();
		var checked_count = $('.ad_checkbox:checked').length;
		$('.ad_checkbox:checked').each(function() {
			var ads_id = $(this).parent().parent().attr('id');
			$('#ads_selected span').text(checked_count);
			$('.dummy_text').text('Ads');
			$('li.ads a span').hide();
			if(checked_count > 1) {
				$('#ad_mixed').show();
				$('.camp_total_camps').text($('#camapaign_table tbody tr.camp_rows').length);
				$('.camp_total_adsets').text($('#adset_table tbody tr.adset_rows').length);
				$('#ad_name').val('Mixed Value');
				$('#ad_status').parent().hide();
			} else {
				getAdData(ads_id);
			}
		});

		if(!$('.ad_checkbox').is(':checked')) {
			$(".right-fix-drawer-outr").removeClass("drawer-open-content");
			$('.ad_checkbox').prop('checked', false);
			$('li.ads a span').show();
			$('#ads_selected').hide();
			$('#ads .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ads .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
		}

	});


	$(document).on('click','.all_ad_checkbox',function(){
		if($(this).is(':checked')) {
			$('#camapaign-full-details').hide();
			//$('#adsets-full-details').hide();
			$('#ads-full-details').show();
			$('.ad_checkbox').prop('checked', true);
			var ads_count = $('.ad_checkbox:checked').length;
			$('li.ads a span').hide();
			$('#ads_selected span').text(ads_count);
			$('#ads_selected').show();
			$('#ads_selected span').text(ads_count);
			$('#ads .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ads .left-fil1 .simple-default-icons-group li>i').removeClass('disable-me');

		} else {
			$('.ad_checkbox').prop('checked', false);
			$('li.ads a span').show();
			$('#ads_selected').hide();
			$('#ads .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ads .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
		}

		if(ads_count > 1) {
			//$('.adsets-details-list').hide();
			$('#ad_mixed').show();
			$('.camp_total_camps').text($('#camapaign_table tbody tr.camp_rows').length);
			$('.camp_total_adsets').text($('#adset_table tbody tr.adset_rows').length);
			$('#ad_name').val('Mixed Value');
			$('#ad_status').parent().hide();
		} else {
			getAdData(ads_id);
		}
	});

	$('#ads_selected i').click(function() {
		$('#ads_selected').hide();
		$('li.ads a span').show();
		$('.ad_checkbox').prop('checked', false);
		$('.all_ad_checkbox').prop('checked',false);
		$(".right-fix-drawer-outr").removeClass("drawer-open-content");
		$('#ads .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2), #ads .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
	});

	$('.add-reference').click(function(){
		$('#userid').val($(this).data('accountid'));
		$('#reference').val($(this).data('reference'));
	});

	$('.save-reference').click(function(e){
		e.preventDefault();
		$.ajax({
			'url' 	 	: 'AjaxFile.php',
			'method' 	: 'post',
			'data'		: 'userid='+$('#userid').val()+'&reference='+$('#reference').val(),
			success : function(data) {
				if(data >= 1) {
					alert('successfully added');
					location.reload();
				}
			}
		});
	});

	$('.postcomment').click(function() {
		$('#user_id').val($(this).data('userid'));
		$('#msg').val($(this).data('comment'));
	});

	$('.save-comment').click(function(e){
		e.preventDefault();
		$.ajax({
			'url' 	 	: 'AjaxFile.php',
			'method' 	: 'post',
			'data'		: 'userid='+$('#user_id').val()+'&comment='+$('#msg').val(),
			success : function(data) {
				if(data >= 1) {
					alert('successfully added');
					location.reload();
				}
			}
		});
	});


	$(document).on('click','.view-charts,.edit-charts',function(e){
		e.preventDefault();
		var id = $(this).parent().parent().parent().attr('id');
		var href_id = $(this).data('id');
		var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
		$(main_div_id+' div.disable-me,'+main_div_id+' li>i').removeClass('disable-me');
		if(main_div_id == '#camp') {
			$('.campaigns_checkbox').prop('checked', false);
			$(this).parent().parent().parent().find('.campaigns_checkbox').prop('checked',true);
			getCampaginsData(id);
		}
		if(main_div_id == '#ad-sets') {
			$('.adsets_checkbox').prop('checked', false);
			$(this).parent().parent().parent().find('.adsets_checkbox').prop('checked',true);	
			getAdsetsData(id);	
		}
		if(main_div_id == '#ads') {
			$('.ad_checkbox').prop('checked', false);
			$(this).parent().parent().parent().find('.ad_checkbox').prop('checked',true);	
			getAdData(id);
		}
		$('a[href="'+href_id+'"]').click();
		
	});


	$(document).on('click','.edit-campaigns',function(){
		$('a[href="#edit-tab"]').click();
	});
});


function getCampaginsData(cmp_id) {
	$('#adset_table tbody tr,#ad_table tbody tr').addClass('hide-row');
	$('#adset_table tbody tr.camp_'+cmp_id+', #ad_table tbody tr.camp_'+cmp_id).removeClass('hide-row').addClass('show-row');
	$('li.ad-sets a span').text(' for 1 Campaign');
	$('li.ads a span').text(' for 1 Campaign');
	$('#camapaign_selected span').text(1);
	$('#camapaign_selected').show();
	$('#adsets-full-details, #ads-full-details').hide();
	$('#camapaign-full-details').show();
	$('.dummy_text').text('Campaigns');
	var newData = _.find(_camapaigns, function(o) { return o.id == cmp_id;  });
	$('#camp_status').parent().show();
	

	var camp_name =  $('#'+cmp_id).find('.editable-input').val();
    $('.right-fix-drawer-outr span.camapaign_name').text(camp_name);
	$('#camp_name').val(camp_name);

	
	$('#camp_objectivea').html(newData.objective.replace("_", " "));
	$('#camp_buyingtype').text(newData.buying_type);
	$('#camp_id').text(newData.id);
	$('#history_tab_all').attr('rel',newData.id);
	
	var oids=[];
	$(".camp_"+newData.id).each(function() {    	
    	oids.push($(this).attr('id')); 
	});

	$('#history_tab_all').attr('token',JSON.stringify(oids));

	console.log(oids);
	$('#view_tab_all').attr('rel',newData.id);

	$('.camp_total_adsets').attr('rel',newData.id);
	$('.camp_total_ads').attr('rel',newData.id);
	$('#camp_status').val(newData.status);
	$('#camp_status').parent().attr('class','');
	$('#camp_status').parent().attr('class',$('table tr#'+newData.id+' .campaigns_status').parent().attr('class'));
	$('.camp_total_adsets').text(newData.adsets.data.length);
	if(newData.ads) {
		$('.camp_total_ads').text(newData.ads.data.length);
	}
	$('.mixed_value').hide();
	$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').show();
	
	if(newData.spend_cap){
		$('.camp_spend_cap').val(newData.spend_cap);
		$('.spend_area').show();
		$('.remove_limit').show();
		$('.set_limit').hide();
	}else{
		$('.spend_area').hide();
		$('.remove_limit').hide();
		$('.set_limit').show();
	}
	$('#camp_name').parent().attr('id',newData.id);
	total_spend(newData.id);
	$('.campaign_id').val(newData.id);
	$('.objectiveGRP').val(newData.objective_for_results);
	$('.confirm_close').attr('rel','campaign');
}

function getAdsetsData(adsets_id) {
	$('#adsets_selected span').text(1);
	$('#adsets_selected').show();
	$('.dummy_text').text('Ad Sets');
	$('#camapaign-full-details, #ads-full-details').hide();
	$('#adsets-full-details').show();
	$('#adset_status').parent().show();
	$('.mixed_value').hide();
	$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').show();
	$('.adsets-details-list').show();
	$('#ad_table tbody tr').addClass('hide-row');
	$('#ad_table tbody tr.adsets_'+adsets_id).addClass('show-row');
	$('li.ads a span').text('for 1 Ad Set');
	_camapaigns.forEach(function(item,index) {
		if(item.adsets) {
			var adsets = _.find(item.adsets.data, function(o) { return o.id == adsets_id;  });
			if(adsets != undefined) {

				var adset_name =  $('#'+adsets.id).find('.editable-input').val();
				$('.right-fix-drawer-outr span.camapaign_name').text(adset_name);
				$('#adset_name').val(adset_name);
				$('.old_bud_adset_name').text(adset_name);
				$('#adset_id').text(adsets.id);
				$('#history_tab_all').attr('rel',adsets.id);
				var oids=[];
				oids.push(adsets.campaign_id);
				$(".adsets_"+adsets.id).each(function() {    	
			    	oids.push($(this).attr('id')); 
				});

				$('#history_tab_all').attr('token',JSON.stringify(oids));

		
				$('#view_tab_all').attr('rel',adsets.id);
				$('#adset_status').val(adsets.status);
				$('.adset_id').val(adsets.id);
				$('#adset_status').parent().attr('class','');
				$('#adset_status').parent().attr('class',$('table tr#'+adsets.id+' .adsets_status').parent().attr('class'));
				if(item.ads) {
					$('.camp_total_ads').text(item.ads.data.length);
				}
				$('.camp_total_camps').text(1);		
				$('.camp_total_camps').attr('rel',adsets.id);
				$('.camp_total_ads').attr('rel',adsets.id);				
			
				//get schedule data

				//getAdsetDetail(adsets);
				getAdsetDetail(adsets.id);
				camp_list_adset_popup();
				//alert(adsets.daily_budget);
				
			  

				$('select[name="addsets_min_age"]').find('option[value="'+adsets.targeting_age_min+'"]').attr("selected",true);
				$('select[name="addsets_max_age"]').find('option[value="'+adsets.targeting_age_max+'"]').attr("selected",true);

				
				var loc = adsets.targeting.geo_locations.countries;
				loc.forEach(function(item,index) {
					
					$('select[name="location[]"]').find('option[value="'+item+'"]').attr("selected",true);
						
				});
				if(typeof(adsets.targeting_genders) == "undefined" || adsets.targeting_genders == null) {
				    $('#All').attr('checked', 'checked');
				}else{					
					if(adsets.targeting_genders==0){
						$('#All').attr('checked', 'checked');
					}
					if(adsets.targeting_genders==1){
						$('#Men').attr('checked', 'checked');
					}
					if(adsets.targeting_genders==2){
						$('#Women').attr('checked', 'checked');
					}
				}

				console.log(adsets.targeting.locales);
				if(typeof(adsets.targeting.locales) != "undefined" && adsets.targeting.locales != null) {
				    getLocaleNames(adsets.targeting.locales);
				}
				if(typeof(adsets.targeting.flexible_spec) != "undefined" && adsets.targeting.flexible_spec != null) {
				    getFlexibleSpecNames(adsets.targeting.flexible_spec);
				}
			

				


			
				$('#addsets_location').text(adsets.targeting_countries);
				$('#adset_name').parent().attr('id',adsets.id);	
				$('#adset_id_forAudi').val(adsets.id);					

				var saved_audience_id='';
				if(typeof(adsets.saved_audience) != "undefined" && adsets.saved_audience != null) {
					saved_audience_id= adsets.saved_audience.id;					
				}
				/* get saved audiences */
				accountSavedAudiences(saved_audience_id);					
				/*show adset saved audience detail*/
				if(typeof(adsets.saved_audience) != "undefined" && adsets.saved_audience != null) {					
					show_saved_audience_in_adset(adsets.saved_audience.id);
				}				
				getCustomAudience();
				$('.objectiveGRP').val(adsets.objective_for_results);
				$('.confirm_close').attr('rel','adset');
			}
		}
	});
}
function accountSavedAudiences(saved_audience_id){
	var access_token = gets('code');
	var act = gets('act');
	  if(saved_audience_id==''){
	  	$('.saved_aud_detail').html('');
	  	$('.custom_audience').show();
	  }
	jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				 data: {
				 	'saved_audience' :'get',
				 	'act' : act,
				 	'access_token': access_token,
					'audience_id' : saved_audience_id
				 },
	
				success: function (data) {	
							
					$('#apd_saved_audience').html(data);  
					$('.selectpicker').selectpicker('refresh'); 
				}
		});
}
function getAdData(ads_id) {
	$('#camapaign-full-details, #adsets-full-details').hide();
	$('#ads-full-details').show();
	$('#ad_status').parent().show();

	$('#ads_selected').show();
	$('.dummy_text').text('Ads');
	
	_camapaigns.forEach(function(item,index) {
		if(item.ads) {
			var ads = _.find(item.ads.data, function(o) { return o.id == ads_id;  });
		
			if(ads != undefined) {

				$('#img-wid-type').prop('checked',false);
				$('#vid-wid-type').prop('checked',false);
				var ad_name =  $('#'+ads_id+".ad_rows").find('.editable-input').val();
				//alert(ad_name);
				$('.right-fix-drawer-outr span.camapaign_name').text(ad_name);
				$('#ad_name').val(ad_name);
				$('#ad_id').text(ads.id);
				$('.ad_id').val(ads.id);
				$('#history_tab_all').attr('rel',ads.id);
				$('.camp_total_camps').attr('rel',ads.id);
				$('.camp_total_adsets').attr('rel',ads.id);
				var oids=[];
				oids.push(ads.campaign_id);
				oids.push(ads.adset_id);
				

				$('#history_tab_all').attr('token',JSON.stringify(oids));			
				$('#view_tab_all').attr('rel',ads.id);			
				$('#ad_status').parent().attr('class',$('table tr#'+ads.id+' .ads_status').parent().attr('class'));
				if(item.adsets) {
					$('.camp_total_adsets').text(item.adsets.data.length);
				}
				$('.camp_total_camps').text(1);
				$('#ad_name').parent().attr('id',ads.id);

				var ad_page_id='';
				$('.apd_adcreative').val(ads.adcreatives);

				$('.dest_web_mesngr').show();
				$('.ad_exist_post').show();
				
				//checking id ad id create for by existing post
				if(ads.creative.object_story_id != undefined){

					$( ".dest-mngr" ).prop( "checked", true );
					$('#ext-post').addClass('in active');
					$('.ad_exist_post').addClass('active');

					$('#crt-ad').removeClass('in active');
					$('.by_create_ad').removeClass('active');
					

					//fb pages
					var story_id =ads.creative.object_story_id;
					$('.object_story_id').val(story_id);
					ad_page_id =story_id.substring(0, story_id.indexOf("_"));	

					getFbPages(ad_page_id,story_id);

					$( ".dest-mngr" ).prop( "checked", true );
					$( "#img-vid" ).prop( "checked", true );

					// set deafult values in others tab
					$( "#img-vid" ).prop( "checked", true );
					$('#img-wid-type').prop( "checked", true );
					$('#vid-wid-type').prop( "checked", false );
					$('.select_img').html('<span class="light-grey-btn common-select-img-popup" data-target="#common-select-img-popup" data-toggle="modal">Select Image</span>');
					$('.select_vid').html('<span class="light-grey-btn  common-select-video-popup mul_videos_popup" rel="">Select Video</span>');
					$('.clear_image').hide();
					$('.clear_video').hide();
					$('#radio-tab1').addClass('active');
					$('#radio-tab2').removeClass('active');
				}else{
					$('#crt-ad').addClass('in active');
					$('.by_create_ad').addClass('active');

					$('#ext-post').removeClass('in active');
					$('.ad_exist_post').removeClass('active');

					//unhide divs which may be hidden if no ad type is selected
					$('.fullscreen-canvas').show();
					$('.dest_web_mesngr').show();
					$('.ad_type_ul').show();
					$('.ad_exist_post').show();
					var website_url = ads.creative_link_url;
					var title =ads.creative_title;
					var body =ads.creative_body;

					
					//get ad creative data in tab fields
					ads.adcreatives.data.forEach(function(item,index) {
						var picture =item.image_url;
						if(item.object_story_spec) {
							var adc = item.object_story_spec;
							ad_page_id = adc.page_id;
							var ad_data;
							var apd_pic;
							if(adc.link_data){
								apd_pic='#selected_images';
								ad_data=adc.link_data;
							}
							if(adc.video_data){
								apd_pic='#selected_videos';
								ad_data=adc.video_data;
								$('.video_id').val(ad_data.video_id);
							}

							
							//$('.website_url').val(ad_data.link);
							$('.website_url').val(website_url);
							if(ad_data.link){
								$( ".dest-mngr" ).prop( "checked", true );
							}else{
								$( ".msngr" ).prop( "checked", true );
							}
							$('.caption').val(ad_data.caption);
							$('.cmessage').val(body);
						
							$('.ctext').val(title);
							$('.cdescription').val(ad_data.description);
							$('.cimage_hash').val(ad_data.image_hash);

							//add type (single,multiple,collection) selection
							if(ad_data.child_attachments){
								$( "#mul-img" ).prop( "checked", true );
								$('.two-tabs-first-radio').hide();
								$('.two-tabs-second-radio').show();
								$('.two-tabs-third-radio').hide();

							}else if(ad_data.collection_thumbnails){
								$( "#img-coll" ).prop( "checked", true );
								$('.two-tabs-first-radio').hide();
								$('.two-tabs-second-radio').hide();
								$('.two-tabs-third-radio').show();
								

								if(picture){

									$('.col_cover_image').html('<img src="'+picture+'" width="70px" height="70px" class="thumb selected-img-thumb" >');
								}
							} else{
								
								$( "#img-vid" ).prop( "checked", true );
							

								$('.two-tabs-first-radio').show();
								$('.two-tabs-second-radio').hide();
								$('.two-tabs-third-radio').hide();

								$('.clear_image').hide();
								$('.clear_video').hide();


								//image or video
								if(adc.link_data){
								
									$('#img-wid-type').prop('checked',true);
									$('#vid-wid-type').prop('checked',false);
									$('.radio-tab1').addClass('active');
									$('#radio-tab1').addClass('active');
									$('.radio-tab1').click();
									$('#selected_videos').html('');
									$('.clear_image').show();
									$('.select_vid').html('<span class="light-grey-btn  common-select-video-popup mul_videos_popup" rel="">Select Video</span>');
								
									
								}
								if(adc.video_data){
									
									$('#vid-wid-type').prop('checked',true);
									$('#img-wid-type').prop('checked',false);
									$('.radio-tab2').addClass('active');
									$('#radio-tab2').addClass('active');
									$('.radio-tab2').click();
									$('#selected_images').html('');
									
									$('.clear_video').show();
									$('.select_img').html('<span class="light-grey-btn common-select-img-popup" data-target="#common-select-img-popup" data-toggle="modal">Select Image</span>');


								}

							}
							

							

							//set image if availabe or not in ad
							if(item.thumbnail_url){	
								
								$(apd_pic).html('<img src="'+item.thumbnail_url+'" width="70px" height="70px" class="thumb selected-img-thumb" >');
								
								//$('.select_vid').html('');
							}else{
							
								$('.select_img').html('<span class="light-grey-btn common-select-img-popup" data-target="#common-select-img-popup" data-toggle="modal">Select Image</span>');
								
								$('.select_vid').html('<span class="light-grey-btn  common-select-video-popup mul_videos_popup" rel="">Select Video</span>');
							}

							
						    getFbPages(ad_page_id);	

							if(item.url_tags) {
								$('.url_tags').val(item.url_tags);
							}


							//call to action button selected
							if(ad_data.call_to_action){
								$('.call_to_action_image option[value="'+ad_data.call_to_action.type+'"]').prop("selected", "selected");
							}

						}else{

							$( "#mul-img" ).prop( "checked", false );
							$( "#img-coll" ).prop( "checked", false );
							$( "#img-vid" ).prop( "checked", false );

							$('.cmessage').text(body);
							$('.ctext').val(title);
							
							$('.cimage_hash').val(ads.creative.image_hash);

							$('#selected_images').html('<img src="'+ads.creative.image_url+'" width="70px" height="70px" class="thumb selected-img-thumb" >');
							
							if(ads.creative.object_id){	
						

								$('.object_id').val(ads.creative.object_id);
								
									$('.clear_image').show();
									$('#img-wid-type').prop('checked',true);
									$('#vid-wid-type').prop('checked',false);
									$('.radio-tab1').addClass('active');
									$('#radio-tab1').addClass('active');
									$('.radio-tab1').click();
									$('#selected_videos').html('');


							}

							if(ads.creative.video_id){	
									
									$('.object_id').val(ads.creative.video_id);
								

									$('.clear_image').hide();

									$('#vid-wid-type').prop('checked',true);
									$('#img-wid-type').prop('checked',false);
									$('.radio-tab2').addClass('active');
									$('#radio-tab2').addClass('active');
									$('.radio-tab2').click();
									$('#selected_images').html('');

							}
							

							if(ads.creative.url_tags) {
								$('.url_tags').val(url_tags);
							}
						
							if(ads.creative.call_to_action_type) {
								$('.call_to_action_image option[value="'+ads.creative.call_to_action_type+'"]').prop("selected", "selected");
							}
						
							//hide canvas
							$('.fullscreen-canvas').hide();
							$('.dest_web_mesngr').hide();
							$('.ad_type_ul').hide();
							$('.ad_exist_post').hide();
							$('.dest_web_mesngr').hide();
							if(ads.creative.object_id){
								getFbPages(ads.creative.object_id);
							}
	
						}
						//get url tags
						
					});
				}

				//set rel in save  button of tab
				$('.objectiveGRP').val(ads.objective_for_results);
				$('.confirm_close').attr('rel','ad');
				//get ads crreative content				
				getAdCreative(ads.creative.id);
				//get pixel data 
				getFbpixel();	
				//get ad previews		
				setInterval(getpreview(ads.creative_id), 60000);
				//set page id in post status popup
				$('.post_fbpage_id').val(ad_page_id);


			}
		}
	});
}


$(document).ready(function(){
	$('#select-manual').click(function () {
		$('.manual-imgs-radio-opt').show();
		$('.dynamic-template-radio-opt').hide();
		 
	});
	$('#dynamic-temp').click(function () {
		$('.manual-imgs-radio-opt').hide();
		$('.dynamic-template-radio-opt').show();
		 
	});
})

$(document).ready(function(){
	$('#fixed-img-begining').click(function () {
		if ($('#fixed-img-begining').is(":checked"))
		{ 
			$('.fixed-img-begining').show();
			$('.fixed-img-end').hide();
		}
		else
		{ 
			$('.fixed-img-end').show();
			$('.fixed-img-begining').hide();
		}
	});
	$('#fixed-img-end').click(function () {
		if ($('#fixed-img-end').is(":checked"))
		{ 
			$('.fixed-img-end').show();
			$('.fixed-img-begining').hide();
		}
		else
		{ 
			$('.fixed-img-begining').show();
			$('.fixed-img-end').hide();
		}
	});


	

	
});

$(document).ready(function(){
	$('.input-field-common-plus').click(function () {
	
		$(this).parent().find(".input-field-common-plus-ul").toggle();
	});
	 
});
 
 // product set popup owl carousel script 
$(document).ready(function() {
  $('.owl-carousel').owlCarousel({
    loop: true,
    margin: 10,
    autoWidth:true,
    responsiveClass: true, 
    dots: false,   
    responsive: {   
      0: {
        items: 1,
        nav: true
      },
      600: {
        items: 3,
        nav: false
      },
      1000: {
        items: 5,
        nav: true,
        loop: false,
        margin: 20
      }
    }

  });
});
 // edit appearance popup code
$(document).ready(function(){
	$('.eight-defined-colors input:radio').change(function(){
	    if($(this).is(":checked")) {		    	
	        $(this).parent().addClass("checked-checkbox");
	         $(this).parent().siblings().find('input:radio').prop('checked', false);
	         $(this).parent().siblings().removeClass("checked-checkbox");
	    }
	});
});

// set ad set name popup script
$(document).ready(function(){
	$('.set-ad-set-name').click(function () {
		if ($('.set-ad-set-name ul li:first-child').hasClass( "selected" ))
		{ 
			$('.rename-using-available').show();
			$('.set-name-manually').hide();
		}
		else
		{ 
			$('.set-name-manually').show();
			$('.rename-using-available').hide();
		}
	});
});

/*11 nov*/


$(document).on('click','#adjust_budget_popup',function(){
	var daily_budget = $('#addsets_daily_bugdet').val();

	$('.old_bud').text(daily_budget);
	$('#adjust_button').modal('show');
});

$(document).on('change','.chg_slct_bud',function(){
	var val = $('#set_bud_type_value').val(); 	
 	var money = $('#set_bud_type_money').val(); 	
 	var budget = $('#addsets_daily_bugdet').val();
 	var set_bud_type = $('#set_bud_type').val(); 	
 	if(val!=''){

 		if(set_bud_type!='='){
 		
 			$('.typ_mon').show();
	 			
	 			/*if % and $ */
			 	if(money=='%'){


			 		var nwBudget = parseInt(budget) * parseInt(val) / parseInt(100);
					if(set_bud_type=="+"){
			 			$('.new_bud').text(parseInt(nwBudget)+parseInt(budget));
			 			$('.inc_dec_bud').text('increase budget by '+ val +'%');
			 		}else{
			 			$('.new_bud').text(parseInt(budget) - parseInt(nwBudget));
			 			$('.inc_dec_bud').text('decrease budget by '+ val +'%');
			 		}
				}else{
			 		if(set_bud_type=="+"){
					 		var nwBudget = parseInt(budget) + parseInt(val); 			
					 		$('.new_bud').text(nwBudget);
					 		$('.inc_dec_bud').text('increase budget by '+ val +'$');
			 		}else{
			 			var nwBudget = parseInt(budget) - parseInt(val); 			
			 			$('.new_bud').text(nwBudget);
			 			$('.inc_dec_bud').text('decrease budget by '+ val +'$');
			 		}		 		
				}
				/*if % and $  end*/
 		
 		}else{
 			$('.typ_mon').hide();
 			$('.new_bud').text(val);
 			$('.inc_dec_bud').text(' budget is '+ val +'$');
 		}

	}else{
		$('.new_bud').text(budget);
	}
});



$(document).on('keyup','#set_bud_type_value',function(){
 	var val = $(this).val(); 	
 	var money = $('#set_bud_type_money').val(); 	
 	var budget = $('#addsets_daily_bugdet').val();
 	var set_bud_type = $('#set_bud_type').val(); 	
 	if(val!=''){

 		if(set_bud_type!='='){
 			$('.typ_mon').show();
 			
	 			/*if % and $ */
			 	if(money=='%'){


			 		var nwBudget = parseInt(budget) * parseInt(val) / parseInt(100);
					if(set_bud_type=="+"){
			 			$('.new_bud').text(parseInt(nwBudget)+parseInt(budget));
			 			$('.inc_dec_bud').text('increase budget by '+ val +'%');
			 		}else{
			 			$('.new_bud').text(parseInt(budget) - parseInt(nwBudget));
			 			$('.inc_dec_bud').text('decrease budget by '+ val +'%');
			 		}
				}else{
			 		if(set_bud_type=="+"){
					 		var nwBudget = parseInt(budget) + parseInt(val); 			
					 		$('.new_bud').text(nwBudget);
					 		$('.inc_dec_bud').text('increase budget by '+ val +'$');
			 		}else{
			 			var nwBudget = parseInt(budget) - parseInt(val); 			
			 			$('.new_bud').text(nwBudget);
			 			$('.inc_dec_bud').text('decrease budget by '+ val +'$');
			 		}		 		
				}
				/*if % and $  end*/
 		
 		}else{
			$('.typ_mon').hide();
			$('.inc_dec_bud').text(' budget is '+ val +'$');
 			$('.new_bud').text(val);
 		}

	}else{
		$('.new_bud').text(budget);
	}
});


// update daily buget in bugdet pop up (adset)


	$(document).on('click','.alter_daily_bud',function(){
		
			var nwBudget;
			var val = $('#set_bud_type_value').val(); 	
		 	var money = $('#set_bud_type_money').val(); 	
		 	var budget = $('#addsets_daily_bugdet').val();
		 	var set_bud_type = $('#set_bud_type').val(); 	
		 	if(val!=''){

		 		if(set_bud_type!='='){
		 			
			 			
			 			/*if % and $ */
					 	if(money=='%'){


					 		nwBudget = parseInt(budget) * parseInt(val) / parseInt(100);

							if(set_bud_type=="+"){
								nwBudget = parseInt(nwBudget)+parseInt(budget);
					 			
					 		}else{
					 			nwBudget = parseInt(nwBudget) - parseInt(budget);
					 		
					 		}
						}else{
					 		if(set_bud_type=="+"){
							 		nwBudget = parseInt(budget) + parseInt(val); 			
							 		
					 		}else{
					 			 nwBudget = parseInt(budget) - parseInt(val); 			
					 			
					 		}		 		
						}
						/*if % and $  end*/
		 		
		 		}else{
		 			nwBudget = val;
		 		}

			}else{
				nwBudget = budget;
			
			}		
			var id = $('#adset_name').parent().attr('id');
			var access_token = gets('code');
			
			var _this = jQuery(this);
			jQuery.ajax({
				'url'    	:  'https://graph.facebook.com/v2.11/'+id,
				'method'	:  'POST',
				'data'		:  'daily_budget='+nwBudget+'&access_token='+access_token,
				success : function(data){
					console.log('data after', data);
					if(data.success == true) {
						window.location.reload();
					}
				}
			});
		
	});
//15nov
$(document).on('click','#save_ad_image_popup',function(){
	var access_token = gets('code');
	var act = gets('act');	
	var fieldName = 'img-thumb';

	var value = $('#slct_creative').attr('rel');	
	var page_id = $(this).attr('rel');
	var ad_id =  $('#ad_name').parent().attr('id');
	
	//where to append hash value of image
	var apd_input = $('#save_ad_image_popup').attr('apd-input');
	if(apd_input==''){
			$('#selected_images').html('<img src="'+value+'" width="70px" height="70px" class="thumb selected-img-thumb" >');
		}else{
			$('#selected_images'+apd_input).html('<img src="'+value+'" width="70px" height="70px" class="thumb selected-img-thumb" >');
	}	
	$('#loader_div').modal('show');
	var _this = jQuery(this);
		jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'POST',				
			data: { 
		        'ad_imag': value, 
		        'access_token': access_token,
		        'act': act,
		        //'add_creative_id': add_creative_id,
		        'page_id': page_id
		    },
		    'dataType':'json',
			success : function(data){
				if(data.status=='success'){
				if(apd_input==''){					
					$('.cimage_hash').val(data.hash);
				}else{
					$('.image_hash'+apd_input).val(data.hash);
				
				}
					$('#common-select-img-popup').modal('hide');

				}else{
					swal("",data.msg);
				
				}
				$('#loader_div').modal('hide');
			}
		});
});



//image upload
function readURL(input) {
  if (input.files && input.files[0]) {
  	var reader = new FileReader();
	reader.onload = function (e) {      	
		$('#save_ad_image_popup').addClass('disable');
      	    var img = '<div class="loded_img thumb selected-img-thumb" rel="" id="slct_creative"><img src="'+e.target.result+'" width="100px" height="100px"></div>';

      		$('.apd_creative_img').html(img);         
      		//submit
      		$("#creative_img_upload").ajaxForm({ //Shows the response image in the div named preview 
		        success:function(data){
		        	
		        	$('#slct_creative').attr('rel',data);
		        	$('#save_ad_image_popup').removeClass('disable');

		        }, 
		        error:function(){

		        } 
	       	}).submit();
      		/*end*/
      	};
  		reader.readAsDataURL(input.files[0]);

  	}
}
//for multiple images add

$(document).on('click','.mul_images_popup',function(){
	var rel = $(this).attr('rel');
	$('#save_ad_image_popup').attr('apd-input',rel);
	$('#common-select-img-popup').modal('show');

});

function historyTab(){
	$('#view-tab').removeClass('active');
	$('#view-tab').removeClass('in');
	$('#edit-tab').removeClass('active');
	$('#edit-tab').removeClass('in');
	var object_id = $('#history_tab_all').attr('rel');
	var oids = $('#history_tab_all').attr('token');
	var access_token = gets('code');
	var act = gets('act');
	var activity_type = $('#activity_type').val();
	var activity_by = $('#activity_by').val();

	//$('#loader_div').modal('show');
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'POST',				
			data: { 
		        'object_id': object_id, 
		        'access_token': access_token,
		        'act': act,
		        'activity_type':activity_type,
		        'activity_by':activity_by,
		        'oids':oids
		        
		    },
			success : function(data){
			
				$('#apd_history').html(data);
			//	$('#loader_div').modal('hide');
			}
		});
}


function viewTab(e){

	var obj = $('.objectiveGRP').val();
	$('#history-tab').removeClass('active');
	$('#history-tab').removeClass('in');
	$('#edit-tab').removeClass('active');
	$('#edit-tab').removeClass('in');

	var object_id = $('#view_tab_all').attr('rel');	
	var access_token = gets('code');
	var act = gets('act');

		jQuery.ajax({
				
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',	
				'data':{
						'access_token': access_token,  
						'view_tab_objec_id' : object_id,
						'obj':obj,
				},
				'dataType':'json',
				async: true,
				cache: false,
				success : function(data){			
				
					if(data.status='success'){
						$('.view_link_click').text(data.result_amt);
						$('.view_reach').text(data.reach);
						$('.view_spent').text(data.spend);
						$('.obj_type').text(data.result_label);
									
						perform_graph(object_id,data.result_fr_perform_graph,data.result_cost_perform_graph);
						demographicTab();
						placementTab();
					}
				},
				error: function (xhr,request, error) {		
				$('#loader_div').modal('hide');		  
				$('.api_request_adset_msg').text(xhr.responseJSON.error.error_user_msg);
				$('#api_request_adset').modal('show');				 
			}
		});
		e.stopImmediatePropagation();
    	return false;
	//}
}

function perform_graph(object_id,result_fr_perform_graph=null,result_cost_perform_graph=null){
	var access_token = gets('code');
	$('.perform_graph').html('<div class="no-result-found"><img src="img/load.gif" style="margin-top: 55px;" > </div>');
	$('.people_graph').html('<div class="no-result-found"><img src="img/load.gif" style="margin-top: 55px;" > </div>');
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'GET',				
			'data': {				 		
				 		
			 		'access_token':access_token,
			 		'perform_graph':object_id,
			 		'result_fr_perform_graph':result_fr_perform_graph,
			 		'result_cost_perform_graph':result_cost_perform_graph

			},
		    'dataType':'json',
			success: function (data) {

				
				$('.perform_graph').html(data.chart);
				$('.people_graph').html(data.reached_chart);
				$('.spend_graph').html(data.spend_chart);
			//	$('.obj_type').text(data.objective_for_results);
				$('.graphic').attr('rel',object_id);
			}
	});


}

/*page post start*/	
$(document).on('submit','#page_post_form',function(e){	
	var formData = new FormData(this);
    e.preventDefault();
    $('#loader_div').modal('show');
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'POST',		
			'dataType':'json',
			contentType: false,
        	processData: false,
        	data: formData,
        	async: false,
        	
			success: function (data) {
				$('#loader_div').modal('hide');	
				if(data.status=='success'){
					
					$('#create-new-post-popup').modal('hide');
					$('.form-control').val('');
				}else{
				
					swal('',data.msg);
				}
				
			}
	});
});
$(document).on('click','.enter_post_id',function(){
	$('.page_post_field').toggle();
});
$(document).on('click','.cancel_page_post_id_field',function(){
	//$('.enter_post_id').click();
	$('.page_post_field').toggle();
	$('.page_post_id_field').val('');
});
$(document).on('click','.submit_page_post_id_field',function(e){
	
	var val = $('.page_post_id_field').val();
	if(val==''){
		
		swal('','Please enter post id');
		return false;
	}

	
	var name = $('div[token="' + val + '"]').attr('rel');
	if(typeof name=='undefined'){
		
		swal('','Wrong post id');
	}else{
		$('.get-new-posts').html(name+'<i class="fa fa-caret-down"></i>');
		$('.object_story_id').val(val);
	}


});




/*page post end*/

/*21 nov*/
function readpagePostURL(input) {
  if (input.files && input.files[0]) {
  	var reader = new FileReader();
	reader.onload = function (e) {    	
			$('.page_post_media').attr('src',e.target.result);         
      	};
  		reader.readAsDataURL(input.files[0]);
  	}
}

/* create rule*/


$(document).on('change','.rule_operater',function(){
	
	var val = $(this).val();	
	if(val=='IN_RANGE' || val=='NOT_IN_RANGE'){		
		$('.bet').css('display','inline');
		$('.remain').css('display','none');
	}

	if(val=='LESS_THAN' || val=='GREATER_THAN'){
		
		$('.bet').css('display','none');
		$('.remain').css('display','inline');
	}

	
});


$(document).on('change','#exc_type_rule',function(){
	
	var val = $(this).val();	
	
	if(val!='PAUSE' && val!='UNPAUSE' && val!='NOTIFICATION'){		
		$('.bugget_bid').css('display','inline');
	}else{
		$('.bugget_bid').css('display','none');
	}

	
	
});


$(document).on('click','.filter_add',function(e){

	var filter_name =$('#filter_name').val();	
	var filter_operater =$('#filter_operater').val();
	var filter_from =$('.filter_from').val();
	var filter_to =$('.filter_to').val();
	var filter_value =$('.filter_value').val();
	if(filter_operater=='NOT_IN_RANGE' || filter_operater=='IN_RANGE'){
			if(filter_from=='' || filter_to==''){
			
				swal('','Please enter values');
				return false;
			}
	}else{
		if(filter_value==''){
		
			swal('','Please enter value');
			return false;
		}
	}


	e.preventDefault();
	$('#loader_div').modal('show');
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'POST',				
			data: { 
		        'filter_name': filter_name, 
		        'filter_operater': filter_operater,
		        'filter_from': filter_from,		
		        'filter_to':filter_to,
		        'filter_value':filter_value        
		    },
			success: function (data) {				
				$('.selected_filters').append(data);	
				$('#loader_div').modal('hide');				
			}
	});
	
})

$(document).on('click','.cross_filter',function(){
	$(this).parent().remove();
});

$(document).on('click','.submit_rule_form',function(e){
	e.preventDefault();
	var name = $('.rule_name').val();
	if(name==''){
		
		swal('','Please enter rule name');
		return false;
	}
	$('#loader_div').modal('show');

	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'POST',				
			data: $('#create_rule_form').serialize(),
			success: function (data) {
			
				$('.rule_creation_msg').text(data);			
			   
			    $('#loader_div').modal('hide');
			    $('#add_rule_creation').modal('show');

			}
	});

	
});


$(document).on('change','#rule_entity_type',function(){
	
	var val = $(this).val();	
	
	if(val=='ADSET')
	{
		$('.bug_bid_outgrp').show();
	} else {
		
		 $('.bug_bid_outgrp').hide();
	}

});


$(document).on('click','input[name=is_auto_bid]',function(){
	
    if (this.id == "manual_bid") {
        $("#bid_amount").show();
        var bid='false';
    }else{
    	$("#bid_amount").hide();
    	var bid='true';
    }
    
	//bidChange(bid);

});


$(document).on('keyup','#bid_amount1',function(ev){
	if(ev.which == 13) {
		var bid='false';
		var bid_amount =$('#bid_amount').val();
		bidChange(bid,bid_amount);
	}
});
function bidChange(bid,bid_amount=null){
	var id = $('#adset_name').parent().attr('id');
	var access_token = gets('code');	
	var _this = jQuery(this);
	if(bid_amount){
		var send = 'is_autobid='+bid+'&access_token='+access_token+'&bid_amount='+bid_amount;
	}else{
		var send = 'is_autobid='+bid+'&access_token='+access_token;
	}
	$('#loader_div').modal('show');
	jQuery.ajax({
		'url'    	:  'https://graph.facebook.com/v2.11/'+id,
		'method'	:  'POST',
		'data'		:  send,
		 dataType: "json",
		success : function(data){	
			$('#loader_div').modal('hide');		
			if(data.success == true) {
				swal('','Bid is updated');
				$('.api_request_adset_msg').text('Bid is updated');
				$('#api_request_adset').modal('show');	

			}
		},
		error: function (xhr,request, error) {				  
				$('.api_request_adset_msg').text(xhr.responseJSON.error.error_user_msg);
				$('#loader_div').modal('hide');	
				$('#api_request_adset').modal('show');				 
			}
	});
}
/*$(document).on('click','input[name=pacing_type]',function(){
	var del_type=this.value;		
	var pacing_type = del_type;
	var access_token = gets('code');	
	var id = $('#adset_name').parent().attr('id');
	$('#loader_div').modal('show');	
	
	jQuery.ajax({
		'url'    	:  'https://graph.facebook.com/v2.11/'+id,	
		'method'	:  'POST',
		'data'		:  'pacing_type='+'["'+pacing_type+'"]'+'&access_token='+access_token,
		 dataType: "json",
		success : function(data){	
		console.log(data);	
			if(data.success == true) {
				$('.api_request_adset_msg').text('Deleivery type is updated');
				$('#loader_div').modal('hide');	
				$('#api_request_adset').modal('show');		
			}
		},
		error: function (xhr,request, error) {						  
				$('.api_request_adset_msg').text(xhr.responseJSON.error.error_user_msg);
				$('#loader_div').modal('hide');	
				$('#api_request_adset').modal('show');				 
			}
	});

});*/

/*$(document).on('click','input[name=billing_event]',function(){
	var billing_event=this.value;			
	var access_token = gets('code');	
	var id = $('#adset_name').parent().attr('id');
	$('#loader_div').modal('show');	
	
	jQuery.ajax({
		'url'    	:  'https://graph.facebook.com/v2.11/'+id,	
		'method'	:  'POST',
		'data'		:  'billing_event='+billing_event+'&access_token='+access_token,
		dataType    : "json",
		success : function(data){	
		console.log(data);	
			if(data.success == true) {
				$('.api_request_adset_msg').text('Value updated');
				$('#loader_div').modal('hide');	
				$('#api_request_adset').modal('show');		
			}
		},
		error: function (xhr,request, error) {						  
				$('.api_request_adset_msg').text(xhr.responseJSON.error.error_user_msg);
				$('#loader_div').modal('hide');	
				$('#api_request_adset').modal('show');				 
			}
	});

});*/


$(document).on('click','.feedback_modal',function(){	
	$('#give_feedback').modal('show');
});

$(document).on('click','.feedback_submit',function(){
	var val1 = $('.experience_about_rule').val();
	var val2 = $('.future_done').val();

	if(val1=='' || val2==''){
		$('.feedback_msg').text('Please fill all fields');
		$('#add_feebacks').modal('show');
		return false;
	}

$('#loader_div').modal('show');	
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'POST',				
			data: $('#feedback_form').serialize(),
			success: function (data) {
				$('#loader_div').modal('hide');	
				if(data=='success'){
					$('#give_feedback').modal('hide');
					$('.experience_about_rule').text('');
					$('.future_done').text('');
					$('.feedback_msg').text('Rule has been created successfully.');
					$('#add_feebacks').modal('show');
				}		    

			}
	});
});

$(document).on('change','#saved_aud',function(){
	var val =$(this).val();
	var adset_id = $('#adset_name').parent().attr('id');
	if(val!=''){
		var access_token = gets('code');
		var act = gets('act');
		$('#loader_div').modal('show');	

		jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'GET',				
			 data: {
			 	'saved_audience_id': val,
			 	'act' : act,
			 	'access_token': access_token,
			 	'adset_id':adset_id
			},
			'dataType':'json',
			success: function (data) {
				/*$('#loader_div').modal('hide');
				$('.saved_aud_detail').html(data);
				$('.saved_aud_detail').show();
				$('.custom_audience').hide();	
*/
					$('.saved_aud_detail').html(data.html);
					$('.approximate_count').text(data.approximate_count);
					$('.custom_audience').hide();
					$('.saved_aud_detail').show();
					$('#loader_div').modal('hide');	

			}
	    });	

	}else{

		$('.custom_audience').show();
		$('.saved_aud_detail').hide();	
	}
});


$(document).on('click','.target_gender',function(){
  
  var rel =$(this).attr('rel');
  $('#'+rel).attr('checked','');
});


  $(document).on('click','.submit_audience',function(){
  

  	var gender = $('input[name=target_gender]:checked').val();
  	var gen = $('input[name=target_gender]:checked').attr('id');  	

  	var min = $('#addsets_min_age1').val();
  	var max = $('#addsets_max_age1').val();

  	var loc =$('#txtPlaces').val();
  	var lang = $('#target_language').val();

  	var html='<p>Location: '+loc+'</p><p>Age: '+min+' - '+max+'</p><p>Gender: '+gen+'</p><p>Language:'+lang+'</p>';
  	$('.apd_saved_aud_data').html(html);
  	$('.selectpicker').selectpicker('refresh'); 
  	$('#save-aud').modal('show');
  });

  $(document).on('click','#save_new_audience',function(){
  	var name= $('.new_aud_name').val();
  	
  	if(name==''){
  		swal('','Please enter Audience name');

  		return false;
  	}
  	$('.new_audd_name').val(name);
  	$('#loader_div').modal('show');
  
  		jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'POST',				
			data: $('#audience_form').serialize(),
			'dataType':'json',
			success: function (data) {
			
				$('#loader_div').modal('hide');
				if(data.status=='success'){

					$('#save-aud').modal('hide');
					accountSavedAudiences(data.id);
					show_saved_audience_in_adset(data.id);
		
					swal('','Audience Saved Successfully');


				}else{
				
					swal('',data.message);
				}
			}
		});

  
  });

/*$(document).on('change','#optimization_goals',function(){
  	var optimization_goal = $(this).val();
  	var id = $('#adset_name').parent().attr('id');
	var access_token = gets('code');	
	var _this = jQuery(this);
	$('#loader_div').modal('show');
	jQuery.ajax({
		'url'    	:  'https://graph.facebook.com/v2.11/'+id,
		'method'	:  'POST',
		'data'		:  'optimization_goal='+optimization_goal+'&access_token='+access_token,
		 dataType: "json",
		success : function(data){
			$('#loader_div').modal('hide');
			if(data.success == true) {
				$('.api_request_adset_msg').text('Optimization Goal is updated.');
				$('#api_request_adset').modal('show');		
			}
		},
		error: function (xhr,request, error) {
				$('#loader_div').modal('hide');
				$('.api_request_adset_msg').text(xhr.responseJSON.error.error_user_msg);
				$('#api_request_adset').modal('show');
				 
		}
	});
		
});*/

  /*set campaign spending limit*/

  	$(document).on('keyup','.camp_spend_cap',function(ev){
		if(ev.which == 13) {
			var spend_cap = jQuery(this).val();
			var access_token = gets('code');
			var id = jQuery('#camp_name').parent().attr('id');
			
			var _this = jQuery(this);
			$('#loader_div').modal('show');
			jQuery.ajax({
				'url'    	:  'https://graph.facebook.com/v2.11/'+id,
				'method'	:  'POST',
				'data'		:  'spend_cap='+spend_cap+'&access_token='+access_token,
				success : function(data){
				
					$('#loader_div').modal('hide');
					//console.log(data);
					if(data.success == true) {
						$('.api_request_adset_msg').text('Optimization Goal is updated.');
						$('#api_request_camp').modal('show');
					}
				},
				error: function (xhr,request, error) {
					$('#loader_div').modal('hide');
				  	$('.api_request_adset_msg').text(xhr.responseJSON.error.error_user_msg);
				  	swal('',xhr.responseJSON.error.error_user_msg);
					///$('#api_request_camp').modal('show');				 
				}
			});
		}
	});
	$(document).on('click','.set_limit',function(){
		$('.spend_area').show();
		$(this).hide();
		$('.remove_limit').show();
	});
	$(document).on('click','.remove_limit',function(){
		$('.spend_area').hide();
		$(this).hide();
		$('.camp_spend_cap').val('');
		$('.set_limit').show();
	});
/*destination type*/
/*$(document).on('click','input[name=destination_type]',function(){
	
	var destination_type=this.value;
	var access_token = gets('code');	
	var _this = jQuery(this);
	var id = $('#adset_name').parent().attr('id');
	$('#loader_div').modal('show');
	
	jQuery.ajax({
		'url'    	:  'https://graph.facebook.com/v2.11/'+id,
		'method'	:  'POST',
		'data'		:  'destination_type='+destination_type+'&access_token='+access_token,
		 dataType: "json",
		success : function(data){		
			$('#loader_div').modal('hide');
			if(data.success == true) {
				$('.api_request_adset_msg').text('Destination type is updated');
				$('#api_request_adset').modal('show');		
			}
		},
		error: function (xhr,request, error) {	
				$('#loader_div').modal('hide');			  
				$('.api_request_adset_msg').text(xhr.responseJSON.error.message);
				$('#api_request_adset').modal('show');				 
			}
	});

});*/

function getFbPages(page_id=null,story_id=null){
	var access_token = gets('code');
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'GET',				
			 data: {
			 	'get_fb_pages_list': 'true',
			 	'page_id' : page_id,
			 	'story_id':story_id,
			 	'access_token': access_token
			 },
			'dataType':'json',
			 'async': false,
			  cache: false,
			success: function (data) {	

				//$('#loader_div').modal('hide');				
				$('#apd_fbPages_opts').html(data.fb_pages);				 
				$('.three-new-posts-list').html(data.posts_html);
				$('.get-new-posts').html(data.selected_story_msg);
				$('.selectpicker').selectpicker('refresh');
			//	return false; 
			}
	});	
	if(page_id!=''){

		jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				 data: {
				 	'get_connected_insta': 'true',
				 	'page_id' : page_id,
				 	'access_token': access_token
				 },
				success: function (data) {		
				
					$('.instagram_act_apd').html(data);				 
					$('.selectpicker').selectpicker('refresh'); 
				}
		});	

	}

}




$(document).on('click','.search_by',function(){

	if ($(this).hasClass('ticked')){
		return false;
	}
	
	$('.search_by_filter').hide();
	$('#search_clear').show();
	$('#search_option').html('<option value="'+$(this).attr('value')+'">'+$(this).attr('rel')+'</option>');
	$('.selectpicker').selectpicker('refresh');
	$('#search_div').show();
	

});

$(document).on('click','#dropdownMenu2',function(){
	$('.search_by_filter').hide();
});
$(document).on('click','.search_by_id',function(){
	
		if ($(this).hasClass('ticked')){
		return false;
	}
	$('#search_clear').show();
	$('#search_option').html('<option value="'+$(this).attr('value')+'">'+$(this).attr('rel')+'</option>');
	$('#search_contain').html(' <option data-tokens="ketchup mustard" value="EQUAL"> IS</option><option data-tokens="ketchup mustard" value="NOT_EQUAL"> Is Not</option>');
	$('.selectpicker').selectpicker('refresh');
	$('#search_div').show();
	
});

$(document).on('click','.search_by_filter li',function(e){
	if ($(this).hasClass('ticked')){
		return false;
	}
	$(this).addClass('ticked');
	var access_token = gets('code');
	var act = gets('act');
	var contain ='IN';
	var option = $(this).attr('value');
	var value=$(this).attr('rel');
	
	if(value=='camp_metrics' || value=='adset_metrics' || value=='ad_metrics'){
		$('#search_clear').show();
		$('#search_option').html('<option value="'+$(this).attr('value')+'" rel="'+value+'">'+$(this).attr('value')+'</option>');
		$('#search_contain').html(' <option data-tokens="" value="GREATER_THAN">Is greather than</option><option data-tokens="" value="SMALLER_THAN"> Is smaller than</option>');
		$('.selectpicker').selectpicker('refresh');
		$('#search_div').show();
		return false;
	}
	$(this).addClass('active');
	$('#dropdownMenu1').click();

	$('#loader_div').modal('show');
	jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data': {
				 		'search_value': value,
				 		'contain' : contain,
				 		'option': option,
				 		'act': act,
				 		'code':access_token
				},
				'dataType':'json',
				success: function (data) {		
		
				$('#camp').html(data.camp);	
				$('#ad-sets').html(data.adset);
				$('#ads').html(data.ad);
				$('#searched').append(data.fill);	
				$('#search_div').hide();
				$('.search_value').val('');	
				$('#loader_div').modal('hide');		
				$('.selectpicker').selectpicker('refresh');	
				$("[data-toggle='toggle']").bootstrapToggle('destroy')                 
    			$("[data-toggle='toggle']").bootstrapToggle();
				}
		});

	return false;
	e.preventDefault();
	e.stopImmediatePropagation();	


});

/*end*/
$(document).on('click','.search_Close',function(){
	$(this).parent().hide();
	var opt = $('#search_option').val();
	$( '.search_by[ value="'+ opt + '"]' ).removeClass( 'ticked' );
	$( '.search_by[ value="'+ opt + '"]' ).removeClass( 'active' );

	$('.search_value').val('');
});
$(document).on('click','#apply_search',function(){
	var value = $('.search_value').val();
	if(value==''){
		
		swal('','Please enter value');
		return false;
	}

	var contain = $('#search_contain').val();
	var option  = $('#search_option').val();  
	var rel =$('select#search_option option:selected').attr('rel');
	
	$('li[value="'+ option +'"]').addClass( 'ticked' );

	if(rel=='camp_metrics' || rel=='adset_metrics' || rel=='ad_metrics'){
    	metrics(option,contain,value,rel);
    	 $('li[value="'+ option +'"]').addClass( 'active' );
    	return false;
    }	
    $('li[value="'+ option +'"]').addClass( 'active' );
  
	var access_token = gets('code');
	var act = gets('act');
	$('#loader_div').modal('show');

		jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				 'data': {
				 		'search_value': value,
				 		'contain' : contain,
				 		'option': option,
				 		'act': act,
				 		'code':access_token
				 },
				'dataType':'json',
				success: function (data) {		
				
				$('#camp').html(data.camp);	
				$('#ad-sets').html(data.adset);
				$('#ads').html(data.ad);
				$('#searched').append(data.fill);	
				$('#search_div').hide();
				$('.search_value').val('');	
				$('#loader_div').modal('hide');	
				$('.selectpicker').selectpicker('refresh');	
				$("[data-toggle='toggle']").bootstrapToggle('destroy')                 
    			$("[data-toggle='toggle']").bootstrapToggle();	
				}
		});	


});

$(document).on('click','.cross_search',function(e){
	
	$(this).parent().remove();
	var access_token = gets('code');
	var act = gets('act');
	var opt =$(this).attr('rel');
	var val =$(this).attr('val');
	var key =$(this).attr('token');
	var type =$(this).attr('type');
	$('li[ value="'+ opt +'"]').removeClass( 'ticked' );
	$('li[ value="'+ opt +'"]').removeClass( 'active' );
	$('#loader_div').modal('show');

	jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data': {
				 		'cross_filter': opt,
				 		'act': act,
				 		'val':val,
				 		'code':access_token,
				 		'token_key':key,
				 		'type':type				 		
				 },
				'dataType':'json',
				success: function (data) {			
					$('#camp').html(data.camp);	
					$('#ad-sets').html(data.adset);
					$('#ads').html(data.ad);
					$('#searched').append(data.fill);	
					$('#search_div').hide();
					$('#loader_div').modal('hide');
					$('.selectpicker').selectpicker('refresh');
					$("[data-toggle='toggle']").bootstrapToggle('destroy')                 
    				$("[data-toggle='toggle']").bootstrapToggle();				
				}
		});	
	e.preventDefault();
	e.stopImmediatePropagation();

});

$(document).on('change','.breakdowns',function(e){

	var type = $('select.breakdowns option:selected').attr('data-tokens');
	var breakdown = $(this).val();
	var access_token = gets('code');
	var act = gets('act');
	$('#loader_div').modal('show');
	
	jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data': {
				 		'breakdown': breakdown,
				 		'act': act,				 		
				 		'code':access_token,
				 		'type':type,
				 		 		
				 },
				'dataType':'json',
				success: function (data) {	
			
					$('#camp').html(data.camp);	
					$('#ad-sets').html(data.adset);					
					$('#ads').html(data.ad);
					$('select[name=breakdown]').val(breakdown);
					$('.breakdown option[value="'+breakdown+'"]').prop('selected', true);
					$(".selectpicker").selectpicker("refresh");
					$("[data-toggle='toggle']").bootstrapToggle('destroy')                 
    				$("[data-toggle='toggle']").bootstrapToggle();
					$('#loader_div').modal('hide');
						
				}
		});	
		e.preventDefault();
		e.stopImmediatePropagation();
});




function getDataRange(start,end){
	
	$('#loader_div').modal('show');
	var access_token = gets('code');
	var act = gets('act');

	console.log(start);
	  if(start == 'Invalid date'){ 
	  	start='Invalid date';
	  }else{
	  	start= start.format('YYYY-MM-DD')
	  }
	jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data': {
				 		'act': act,				 		
				 		'code':access_token,
				 		'time_range':'true',
				 		'since' :start,
				 		'until' : end.format('YYYY-MM-DD'),
				 		 		
				 },
				'dataType':'json',
				success: function (data) {		
					$('#loader_div').modal('hide');	
					$('#camp').html(data.camp);	
					$('#ad-sets').html(data.adset);
					$('#ads').html(data.ad);
					$('#creative_report').html(data.creative_report);
					$('.apd_account_overview').html(data.account_overview);
					$('.apd_account_name').text($('.account_name').val());
					$(".selectpicker").selectpicker("refresh");					
					$("[data-toggle='toggle']").bootstrapToggle('destroy')                 
    				$("[data-toggle='toggle']").bootstrapToggle();
						
				}
		});	
}




//saved audience show
function show_saved_audience_in_adset(audience_id){
	var access_token = gets('code');
	
	jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data': {				 		
				 		'show_saved_audience_in_adset':'true',
				 		'access_token':access_token,
				 		'saved_audience_id_adset':audience_id
				 },
				'dataType':'json',				
				success: function (data) {	
				
					$('.saved_aud_detail').html(data.html);
					$('.approximate_count').text(data.approximate_count);
					$('.custom_audience').hide();
					$('.saved_aud_detail').show();
					
				}
		});	

}

//chart
function demographicTab(res1=null,res2=null){
	var access_token = gets('code');
	var object_id = $('.graphic').attr('rel');
	$('.demographics').html('<div class="no-result-found"><img src="img/load.gif" style="margin-top: 55px;" > </div>');
	
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'GET',				
			'data': {				 		
				 		
			 		'access_token':access_token,
			 		'demographic':object_id,
			 		'res1':res1,
			 		'res2':res2

			},
			//'dataType':'json',
			success: function (data) {
				
				$('.demographics').html(data);
				$('.selectpicker').selectpicker('refresh');		
			
			}
	});

}
$(document).on('change','.result',function(){
	var res1 = $('#result1').val();
	var res2 = $('#result2').val();
	demographicTab(res1,res2);
});

function placementTab(res1=null,res2=null,dvc=null){
	
	var access_token = gets('code');
	var object_id = $('.graphic').attr('rel');
	
	if(dvc==''){
		dvc='all';
	}
	$('.placement').html('<div class="no-result-found"><img src="img/load.gif" style="margin-top: 55px;" > </div>');
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'GET',
			'async': false,				
			'data': {				 		
				 		
			 		'access_token':access_token,
			 		'placement_graphic':object_id,
			 		'res1':res1,
			 		'res2':res2,
			 		'dvc':dvc

			},
			success: function (data) {		
					
				$('.placement').html(data);
				$('.selectpicker').selectpicker('refresh');	
					

			}


	});
}
$(document).on('change','.place',function(){
	var res1 = $('#place1').val();
	var res2 = $('#place2').val();
	var dvc='all';
	$('#loader_div').modal('show')
	placementTab(res1,res2,dvc);
	$('#loader_div').modal('hide')
	return false;
});
$(document).on('change','.device_type',function(){
	var res1 = $('#place1').val();
	var res2 = $('#place2').val();
	var dvc  = $(this).val();
//	$('#loader_div').modal('show')
	placementTab(res1,res2,dvc);
//	$('#loader_div').modal('hide')
	return false;
});
$(document).on('change','.activity',function(){
	historyTab();
	return false;

});	


$(document).on('change','.column',function(){
	var column = $(this).val();
	var access_token = gets('code');
	var act = gets('act');
	$('#loader_div').modal('show');		
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'GET',
			'async': false,				
			'data': {				 		
				 		
			 		'act': act,
				 	'code':access_token,
			 		'column':column,
			 		

			},
			'dataType':'json',
			success: function (data) {		
					
				$('#camp').html(data.camp);	
				$('#ad-sets').html(data.adset);
				$('#ads').html(data.ad);				
				$('#loader_div').modal('hide');
				$('.selectpicker').selectpicker('refresh');	
				$("[data-toggle='toggle']").bootstrapToggle('destroy')                 
    			$("[data-toggle='toggle']").bootstrapToggle();	

			},
			error: function (xhr,request, error) {
				$('#loader_div').modal('hide');
			}


	});

	return false;
});




$(document).on('click','.confirm_close',function(e){
	var object = $(this).attr('rel');
	var optimize = [];
	var adset_status;
	var saved_audience='';
	if(object=='ad'){
		var id = 'ad_content';		
		var ad_status=$('.ad_status').val();
		
		
	}
	if(object=='campaign'){
		var id = 'campaign_content';		
	}
	if(object=='adset'){
		var id = 'adset_content';	
		var optimization_goal =$('#optimization_goal').val();	
		var is_auto_bid = $('input[name=is_auto_bid]').val();
		var bid_value =$('#bid_amount').val();
		var billing_event =$('#billing_event').val();
		var pacing_type =$('#pacing_type').val();	
	
		optimize['optimization_goal'] = $('#optimization_goal').val();	
		optimize['is_auto_bid'] = $('input[name=is_auto_bid]').val();
		optimize['bid_value'] = $('#bid_amount').val();
		optimize['billing_event'] = $('#billing_event').val();
		optimize['pacing_type'] = $('#pacing_type').val();
		var adset_status =$('#adset_status').val();

		var saved_audience =$('.saved_aud_id').val();
		if(typeof(saved_audience)=='undefined'){
			saved_audience='';
		}
		
	}
	var story = 'false';
	if($('.ad_exist_post').hasClass('active')){
		story='true';
	}

	$('#loader_div').modal('show');

	jQuery.ajax({

		'url'    	:  'AjaxFile.php',
		'method'	:  'POST',				
		'data'      :  $('#'+id).serialize()+ "&story="+story+"&"+$('#audience_form').serialize()+"&"+$('#optimize_form').serialize()+"&adset_status="+adset_status+"&saved_Audience="+saved_audience,
		'dataType':'json',
		success: function (data) {
			$('#loader_div').modal('hide');
			if(data.status=='success'){
				window.location.reload();
			}else{
				swal('',data.msg);
			}
		}
	});
	return false;
	e.preventDefault();
	e.stopImmediatePropagation();
});

$(document).on('click','.clear_image',function(){
	
	var rel=$(this).attr('rel');
	
	if(rel!= "option1" ){
	
		$('#selected_images'+rel).html('');
		$('.image_hash'+rel).val('');
		$('.select_img'+rel).html('<span class="light-grey-btn common-select-img-popup mul_images_popup" rel="'+rel+'">Select Images</span>');
		$('.select_img'+rel).show();
	}else{

		$('.select_img').html('<span class="light-grey-btn common-select-img-popup" data-target="#common-select-img-popup" data-toggle="modal">Select Image</span>');
		$('#selected_images').html('');	
		
	}
	$(this).hide();

});


/* create slideshow */

 
 	$(document).on('click','.thumbCheckSlide',function(){
      
      		var img='';

      		$( ".thumbCheckSlide" ).each(function() {
			     if ($(this).prop('checked')==true){ 
			     	var val= $(this).val();
			     	  	 img += '<div class="loded_img thumb selected-img-thumb" rel="" id="slct_creative"><img src="'+val+'" width="100px" height="100px"></div>';
			     	  $(this).parent().addClass('selected-img-thumb');     					

			     }else{
			     	 $(this).parent().removeClass('selected-img-thumb');  
			     }
			});

			$('.apd_creative_img_slide').html(img);


        
    });
	
	$(document).on('click','#save_slideshow_img',function(){

		var html ='<ul>';
		$( ".thumbCheckSlide" ).each(function() {
			     if ($(this).prop('checked')==true){ 
			     	var val= $(this).val();
			     	  	
			     	      					
			     	  	 html +='<li class="with-img-slide"><a href="#edit-slide-show-slide" data-toggle="modal"><i class="fa fa-pencil"></i></a><img src="'+val+'"><div class="slide-show-overlay"><i class="fa fa-remove"></i></div><input type="hidden" name="slideImages[]" value="'+val+'"></li>';
			     }
		});
		html +='</ul>';
		$('.slideshow-slides-gallery').html(html);
	});
 	
 	$(document).on('click','.final_slideshow',function(e){
 		
 		jQuery.ajax({

				'url'    	:  'AjaxFile.php',
				'method'	:  'POST',				
				'data'      :  $('#slideshow-form').serialize(),
				'dataType':'json',
				success: function (data) {
								
					if(data.status=='success'){
					
						$('.video_id_first_opt').val(data.id);
					}else{
					
						swal("",data.msg);
					}
				}
			});
			return false;
			e.preventDefault();
			e.stopImmediatePropagation();
 	});
/*slideshow end */

/*change campaign status*/





function changeStatus(id,status){
	if(status=='On'){
		var sts='PAUSED';
	}else{
		var sts='ACTIVE';
	}
	var access_token = gets('code');
	jQuery.ajax({
				'url'    	:  'https://graph.facebook.com/v2.11/'+id,
				'method'	:  'POST',
				'data'		:  'status='+sts+'&access_token='+access_token,
				success : function(data){
					console.log('data after', data);
					if(data.success == true) {
						//window.location.reload();
					}else{
						swal("",data.error.error_user_msg);
					
					}
				},
				error: function (xhr,request, error) {					  
						
					swal("",xhr.responseJSON.error.error_user_msg);						 
				}
			});

}
/*account overview*/
$(document).on('change','.first_slct',function(){
	var val = $('select.first_slct option:selected').val();
	var name = $('select.first_slct option:selected').attr('data-type');
	$('.rel-cont').html(name);
	if(val==''){val='0';}
	$('.first_slct_number').html(val);
	tabGraph('tab1',name);
});

$(document).on('change','.secd_slct',function(){
	var val = $('select.secd_slct option:selected').attr('value');
	var name = $('select.secd_slct option:selected').attr('data-type');
	$('.spt-cont').html(name);
	if(val==''){val='0';}
	$('.secd_slct_number').html(val);
	tabGraph('tab2',name);
});

$(document).on('change','.thrd_slct',function(){
	var val = $('select.thrd_slct option:selected').attr('value');
	var name = $('select.thrd_slct option:selected').attr('data-type');
	$('.imp-cont').html(name);
	if(val==''){val='0';}
	$('.thrd_slct_number').html(val);
	tabGraph('tab3',name);
});

$(document).on('change','.fort_slct',function(){
	var val = $('select.fort_slct option:selected').attr('value');
	var name = $('select.fort_slct option:selected').attr('data-type');
	$('.link-cont').html(name);
	if(val==''){val='0';}
	$('.fort_slct_number').html(val);
	tabGraph('tab4',name);
});

function tabGraph(tab,name){

	var access_token = gets('code');
	var act = gets('act');
	//$('#loader_div').modal('show');		
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			'method'	:  'GET',
			//'async': false,				
			'data': { 		
				 	'act': act,
				 	'code':access_token,
			 		'tabGraph':tab,
			 		'tabName':name			

			},
			success: function (data) {
				
					$('.'+tab).html(data);
						
				}
			});
	

}
/*account overview end */
//getAdCreative content

function getAdCreative(creative_id){
	var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({

				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data'      :  {
					'get_ad_creative_content':'true',
					'creative_id':creative_id,
					'code':access_token,
					'act':act
				},
				'dataType':'json',
				success: function (data) {
					
					$('.two-tabs-second-radio').html(data.opt2);
					$('.selectpicker').selectpicker('refresh');	
				}
			});
}


$(document).on('click','.exist_post',function(){
	var name =$(this).attr('rel');
	$('.get-new-posts').html(name+'<i class="fa fa-caret-down"></i>');
	$('.object_story_id').val($(this).attr('token'));
	$('.get-new-posts').click();
});

$(document).on('click','.add_more_tab',function(){
	var tab = $(this).attr('rel');
	var next = parseInt(tab)+1;
	
	$('.add_more_tab').remove();
	$('.remove_tab').remove();
	$('.crsl-slide').append('<li rel="'+tab+'"><a data-toggle="tab" href="#crsl-slide-dynamic-tab'+tab+'">'+tab+'</a></li><li class="add_more_tab" rel="'+next+'"><a data-toggle="tab" href="#">+</a></li>');
	
	jQuery.ajax({

				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data'      :  {
					'add_more_tab':'true',
					'tab':tab,					
				},
				'dataType':'json',
				success: function (data) {					
					$('.apd_mul_image').append(data.clone);					
				}
			});
});

$(document).on('click','.remove_tab',function(){
	$(this).parent().remove();
	var  rel = $(this).attr('rel');
	$('ul.crsl-slide > :nth-last-child(2)').remove(); 
	$('ul.crsl-slide > :nth-last-child(2)').addClass('active');
	$('.add_more_tab').attr('rel',rel);
	var prev = parseInt(rel)-2;
	$('#crsl-slide-dynamic-tab'+prev).addClass('active in');
	
});

$(document).on('click','#mess-setup',function(){
	$('.website_dest').hide();
});
$(document).on('click','#web-url',function(){
	$('.website_dest').show();
});
function getFbpixel(){

	var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({

				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data'      :  {
					'fb_pixel':'true',					
					'code':access_token,
					'act':act
				},
				
				success: function (data) {					
					$('.pixel-tracking-ids').html(data);					
				}
			});

}

$(document).on('click','.preview_type li',function(e){
	var rel = $(this).attr('class');
	$('.preview_type li').removeClass('active');
	$(this).addClass('active');
	$('.item').removeClass('active');
	$('#'+rel).addClass('active');
	$(".ads-preview-dropd-down-list ul").toggle(); 
});

function getpreview(creative_id=null){
	var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({

				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data'      :  {
					'creative_id':creative_id,					
					'code':access_token,
					'act':act,
					'getpreview':'true'
				},
								
				success: function (data) {
					$('.ad-preview').html(data);					
					
				}
			});
}

//canvas
$(document).on('click','.full_screen_canvas',function(){

	
	if($(this).prop('checked')==true){
		$('.canvas_options').show();
	}else{
		$('.canvas_options').hide();
	}
	
});
//spend

function total_spend(campaign_id){
    var access_token = gets('code');
	jQuery.ajax({
				'url'    	:  'https://graph.facebook.com/v2.11/'+campaign_id+"/insights?fields=&date_preset=lifetime",
				'method'	:  'GET',
				'data'		:  '&access_token='+access_token,
				success : function(data){
					
					data.data.forEach(function(item,index) {
						if(item.spend) {
							$('.total_spend').text('$'+item.spend+' ');
							$('.atleat_spend').text(parseInt(item.spend)+100);
						}
					});
				}
			});
}

function getAdsetDetail(adsets){
 	var adset = adsets;
  	var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({
		'contentType' : 'application/json',
		'url'    	:  'AjaxFile.php',
		'method'	:  'GET',				
		'data'      :  {
			'adset_budget_schedule':'true',					

			'adset':adset,		
			'access_token':access_token,
			'act':act			
		},
		'dataType':'json',								
		success: function (data) {
	
			$('.approximate_count').text(data.potential_reach);
			$('.apd_budget_schedule').html(data.budget);	
			$('.apd_traffic').html(data.traffic);	
			$('.apd_optimize').html(data.optimize);	
			$('.rename_adset_fields').html(data.rename_popup);

		    $( "#schedule_date" ).datepicker({dateFormat: "dd/mm/yy"});
		    $( "#schedule_time" ).timepicker();  

		    
		    $('.selectpicker').selectpicker('refresh');	
		}
	});
}


$(document).on('click','.not_schedule_adset',function(){
	if($(this).prop('checked')==true){
		$('.schedule_fields').hide();
	}else{
		$('.schedule_fields').show();
	}
});

$(document).on('click','.schedule_adset',function(){
	if($(this).prop('checked')==true){
		$('.schedule_fields').show();
	}else{
		$('.schedule_fields').hide();
	}
});


$(document).on('click','#dropdownMenu1',function(){
	$('.search_by_filter').toggle();
	});

$(document).on('click','.first-level-li span',function(){
	$(this).next().toggle();
});





//account charts
$(document).on('change','.spline_age',function(){
	var spline1 =$('select[name="spline1_age"]').val();
	var spline2 =$('select[name="spline2_age"]').val();
	accountChart('age',spline1,spline2);
});

$(document).on('change','.spline_gender',function(){
	var spline1 =$('select[name="spline1_gender"]').val();
	var spline2 =$('select[name="spline2_gender"]').val();
	accountChart('gender',spline1,spline2);
});
$(document).on('change','.spline_hour',function(){
	var spline1 =$('select[name="spline1_hour"]').val();
	var spline2 =$('select[name="spline2_hour"]').val();
	accountChart('hour',spline1,spline2);
});

function accountChart(type,spline1,spline2){

	var access_token = gets('code');
	var act = gets('act');
	 $('#loader_div').modal('show');
	jQuery.ajax({
		
		'url'    	:  'AjaxFile.php',
		'method'	:  'GET',				
		'data'      :  {
			'account_chart':type,	
			'act':act,
			'access_token':access_token	,
			'spline1':spline1,
			'spline2':spline2
		},
		'dataType':'json',								
		success: function (data) {

			if(type=='age'){
				$('.apd_chart_age').html(data.html);	
			}else if(type=='hour'){
				$('.apd_chart_hour').html(data.html);	
			}else{
				$('.apd_chart_gender').html(data.html);	
			}		
		    $('.selectpicker').selectpicker('refresh');	
		    $('#loader_div').modal('hide');
		}
	});

	
}
$(document).on('click','.account_breakdown li',function(e){
	var head=$(this).attr('class');

    if(head=='dropdown-header'){
   		return false;
    }

    var type = $(this).attr('data-tokens');
	var account_breakdown = $(this).attr('value');
	var access_token = gets('code');
	var act = gets('act');
	$('#loader_div').modal('show');
	
	jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				'method'	:  'GET',				
				'data': {
				 		'account_breakdown': account_breakdown,
				 		'act': act,				 		
				 		'code':access_token,
				 		'type':type,
				 		 		
				 },
				'dataType':'json',
				success: function (data) {	
					$('.account_overview_table').html(data.html);
					$(".selectpicker").selectpicker("refresh");
					$('#loader_div').modal('hide');						
				}
		});	
		e.preventDefault();
		e.stopImmediatePropagation();

});

$(document).on('click','.optradio_lc',function(){
	var img = $(this).val();
	$('.map_country').attr('src',img);
	if(img=='country'){
		$('.map_country').show();
		$('.map_region').hide();
		$('.map_dma').hide();	
	}

	if(img=='region'){
		$('.map_country').hide();
		$('.map_region').show();
		$('.map_dma').hide();	
	}

	if(img=='dma'){
		$('.map_country').hide();
		$('.map_region').hide();
		$('.map_dma').show();	
	}
});

function metrics(option,operater,value,metrics){
	var access_token = gets('code');
	var act = gets('act');
	//var _this=this;
	$('#loader_div').modal('show');
		jQuery.ajax({
				'url'    	:  'AjaxFile.php',
				 context: this,
				'method'	:  'GET',				
				'data': {
				 		'value': value,
				 		'operater' : operater,
				 		'option': option,
				 		'act': act,
				 		'code':access_token,
				 		'metrics':metrics
				 },
				'dataType':'json',
				success: function (data) {		
					
					$('#camp').html(data.camp);	
					$('#ad-sets').html(data.adset);
					$('#ads').html(data.ad);
					$('#searched').append(data.fill);	
					$('#search_div').hide();
					$('.search_value').val('');	
					$('#loader_div').modal('hide');	
					$('.selectpicker').selectpicker('refresh');	
					$("[data-toggle='toggle']").bootstrapToggle('destroy')                 
    				$("[data-toggle='toggle']").bootstrapToggle();

					$(this).addClass('active');
					$('#loader_div').modal('hide');	
				}
		});	
}

function checkUrl(url)
{
    //regular expression for URL
    var pattern = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
 
    if(pattern.test(url)){
        return true;
    } else {
        return false;
    }
}
$(document).on('keyup','.link',function(){
	var res = checkUrl($(this).val());

	if(res == true){
		$(this).removeClass('red_border');
	}else{
		$(this).addClass('red_border');	
	}

});
//video
$(document).on('click','.slct_vid',function(){
	$('.slct_vid').prop('checked',false);
	$(this).prop('checked',true);
	$('.video_id').val($(this).val());
	$('.video_pic').val($(this).attr('id'));
	
});
$(document).on('click','.confirm_video',function(){
	var tab = 	jQuery('ul.video_tabs > li.active').attr('rel');
	var title ="";
	var video_id ='';
	/*where to append video*/	
	var rel = $(this).attr('rel');	


	/* end where to append video*/
	if(tab=='upload'){

		var html = $('.apd_creative_vid').html();
		if(html==''){
			swal("",'Please select video to upload');
			return false;
		}else{
			var url = $('.apd_creative_vid').attr('rel');
			if(url==''){
				swal("",'Please select video to upload');
				return false;
			}else{
				video_id = getVideoId(url,title,rel);
				
			}
		}
	}
	if(tab=='link'){
		var url =$('.vid_url').val();
		if(url==''){
	
			swal("",'Please enter video url');
			return false;
		}else{
			title 	 = $('.vid_name').val();
			video_id = getVideoId(url,title,rel);
			
		}
	}
	if(tab=='library'){
		video_id = $('.video_id').val();
		$('#selected_videos'+rel).html('<img src="'+$('.video_pic').val()+'" width="70px" height="70px" class="thumb selected-img-thumb" >');
		$('.clear_video').show();
		if(video_id==''){
			
			swal("",'Please select video');
			return false;
		}
		$('.video_id'+rel).val(video_id);
		$('.vid_popup_opt1').hide();
		$('#common-select-video-popup').modal('hide');
	}

	$('.clear_video').show();

	
});

function getVideoId(url,title,rel){
	var access_token = gets('code');
	var act = gets('act');
	$('#loader_div').modal('show');

	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			 context: this,
			'method'	:  'GET',				
			'data': {
			 		'video_by_url': url,
			 		'title':title,			 	
			 		'act': act,
			 		'code':access_token,
			 		
			 },
			'dataType':'json',
			success: function (data) {	
				$('#loader_div').modal('hide');	
				if(data.status=='success'){
					$('#selected_videos'+rel).html('<video controls class="thumb selected-img-thumb" src="'+url+'" ></video>');
					$('.video_id'+rel).val(data.id);
					$('.vid_popup_opt1').hide();
					$('#common-select-video-popup').modal('hide');
					//return data.id;
				}else{
				
					swal("",data.msg);
					return false;
				}
			}
	});	
}

$(document).on('click','.clear_video',function(){
	
	var rel=$(this).attr('rel');
	
	if(rel!= "option1" ){
	
		$('#selected_videos'+rel).html('');
		$('.image_hash'+rel).val('');
		$('.select_vid'+rel).html('<span class="light-grey-btn  common-select-video-popup mul_videos_popup" rel="'+rel+'">Select Video</span>');
		$('.select_vid'+rel).show();
	}else{

		$('.select_vid').html('<span class="light-grey-btn  common-select-video-popup mul_videos_popup" rel="">Select Video</span>');
		$('#selected_videos').html('');	
		$('.cvideo_id').val('');		
	}
	$(this).hide();

});

$(document).on('click','.common-select-video-popup',function(){
	var rel=$(this).attr('rel');
	$('.confirm_video').attr('rel',rel);
	$('#common-select-video-popup').modal('show');
});

//video upload

function readURLVid(input) {
  if (input.files && input.files[0]) {
  	var reader = new FileReader();
	reader.onload = function (e) {      	
		$('#confirm_video').addClass('disable');
      	
      	    var vid ='<video controls class="apd_creative_vid thumb selected-img-thumb"" src="'+e.target.result+'" rel="">< /video >';
      		$('.apd_creative_vid').html(vid);        
      		//submit
      		$("#creative_vid_upload").ajaxForm({ //Shows the response image in the div named preview 
		        success:function(data){
		        	console.log(data);
		        	//$('#slct_creative_vid').attr('rel',data);
		        	$('.apd_creative_vid').attr('rel',data);
		        	$('#confirm_video').removeClass('disable');

		        }, 
		        error:function(){

		        } 
	       	}).submit();
      		/*end*/
      	};
  		reader.readAsDataURL(input.files[0]);

  	}
}
$(document).on('click','.radio-tab1',function(){
	$('.radio-tab1').addClass('active');
	$('#radio-tab1').addClass('active');
	$('.radio-tab2').removeClass('active');
	$('#radio-tab2').removeClass('active');

	$('#img-wid-type').prop('checked',true);
	$('#vid-wid-type').prop('checked',false);


});
$(document).on('click','.radio-tab2',function(){
	$('.radio-tab1').removeClass('active');
	$('#radio-tab1').removeClass('active');
	$('.radio-tab2').addClass('active');
	$('#radio-tab2').addClass('active');

	$('#img-wid-type').prop('checked',false);
	$('#vid-wid-type').prop('checked',true);

});

$(document).on('click','.mul-crv-typ',function(){
	var rel=$(this).attr('rel');
	var value=$(this).attr('token');
	
	if(value=='image'){

		$('#img-mul-type'+rel).prop('checked',true);
		$('#vid-mul-type'+rel).prop('checked',false);
		$('#img_vid'+rel).addClass('active');
		$('#vid_vid'+rel).removeClass('active');
	}else{
		$('#img-mul-type'+rel).prop('checked',false);
		$('#vid-mul-type'+rel).prop('checked',true);
		$('#img_vid'+rel).removeClass('active');
		$('#vid_vid'+rel).addClass('active');
	}
});



window.setInterval(function(){
    var str = $('.carousel-inner div.active').attr('id');
    $('.preview_type li').removeClass('active');
    $('.'+str).addClass('active');
    $('.counter').text(str.substr(4));

    var txt = $('.'+str)
	    .clone()    //clone the element
	    .children() //select all the children
	    .remove()   //remove all the children
	    .end()  //again go back to selected element
	    .text();
    $('.slctd-prev').html(txt+'<i class="fa fa-caret-down" aria-hidden="true"></i>');
}, 500);

//detail targetting

$(document).on('keyup','.detail-target-field',function(ev){
	
	$('.detail-target-list').show();
	var dets=[];
	$(".dets").each(function() {  	
		dets.push($(this).val());
	});

	var access_token = gets('code');
	var act = gets('act');
	var search = $(this).val();
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			context	: this,
			'method'	:  'GET',				
			'data': {
			 		'detail_target':search,		 	
			 		'act': act,
			 		'code':access_token,
			 		'dets':dets
			 		
			 },
			'dataType':'json',
			success: function (data) {	
				if(data.status=='success'){
					$('.detail-target-list').html(data.html);
				}else{
					
					return false;
				}
			}
	});	

});
$(document).on('click','.detail-target-list ul li',function(){
    var id = $(this).attr('rel');
    var type = $(this).attr('token');
    var nme = $(this)
    .clone()    //clone the element
    .children() //select all the children
    .remove()   //remove all the children
    .end()  //again go back to selected element
    .text();
    var name = $(this).find("span.target_name").text();  
  
    var appd = '<p class="slct-tgt">'+name+'<span class="pull-right cls"><i class="fa fa-times" aria-hidden="true"></i></span><input type="hidden" name="detail['+type+'][]" value="'+id+'" class="dets"></p>';

    $('.detail-target-slctd').show();
    $('.detail-target-slctd').append(appd);
    $(this).remove();
    $('.detail-target-field').val('');

});
$(document).on('click','.cls',function(){
	$(this).parent().remove();

});

$(document).mouseup(function(e) 
{
    var container = $(".detail-target-list");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
        $('.detail-target-field').val('');
    }
});

//locale



$(document).on('keyup','.detail-locale-field',function(ev){
	
	$('.detail-locale-list').show();
	var langs=[];
	$(".lang_slct").each(function() {  	
		langs.push($(this).val());
	});
	
	var access_token = gets('code');
	var act = gets('act');
	var search = $(this).val();
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			 context	: this,
			'method'	:  'GET',				
			'data': {
			 		'locale_search':search,		 	
			 		'act': act,
			 		'code':access_token,
			 		'langs':langs
			 		
			 },
			'dataType':'json',
			success: function (data) {	
				if(data.status=='success'){
					$('.detail-locale-list').html(data.html);
				}else{
					return false;
				}
			}
	});	

});
$(document).on('click','.detail-locale-list ul li',function(){
    var id = $(this).attr('rel');
    var name = $(this)
    .clone()    //clone the element
    .children() //select all the children
    .remove()   //remove all the children
    .end()  //again go back to selected element
    .text();

    var appd = '<p class="slct-tgt">'+name+'<span class="pull-right cls"><i class="fa fa-times" aria-hidden="true"></i></span><input type="hidden" name="locale[]" value="'+id+'" class="lang_slct"></p>';

    $('.detail-locale-slctd').show();
    $('.detail-locale-slctd').append(appd);
    $(this).remove();
    $('.detail-locale-field').val('');

});
$(document).on('click','.cls',function(){
	$(this).parent().remove();

});

$(document).mouseup(function(e) 
{

    var container = $(".detail-locale-list");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
        $('.detail-locale-field').val('');
    }
    var cont = $('.dropdown');
    if (!cont.is(e.target) && cont.has(e.target).length === 0) 
    {
        $('.search_by_filter').hide();        
    }


    var rename = $('.slct_camp_field');
    if (!rename.is(e.target) && rename.has(e.target).length === 0) 
    {    	
        $(".cust_text_inp").each(function() {  	
        	if($(this).attr('rel')=='camp'){
	    		var val = $(this).val(); 
	    		$(this).parent().attr('rel',val);
	    		$(this).parent().addClass('cust_value');
	    		previewName('camp');
	    		$(this).replaceWith('<a href="#" class="cust_text">'+val+'</a>');   
	    	}
    	});
    }


    var renameAdset = $('.slct_adset_field');
    if (!renameAdset.is(e.target) && renameAdset.has(e.target).length === 0) 
    {
        $(".cust_text_inp").each(function() { 
        if($(this).attr('rel')=='adset'){ 	
    		var val = $(this).val(); 
    		$(this).parent().attr('rel',val);
    		$(this).parent().addClass('cust_value');
    		previewName('adset');
    		$(this).replaceWith('<a href="#" class="cust_text">'+val+'</a>');   		
    		
    		}
		});        
    }


    var renameAd = $('.slct_ad_field');
    if (!renameAd.is(e.target) && renameAd.has(e.target).length === 0) 
    {
    	

        $(".cust_text_inp").each(function() {  	
        	if($(this).attr('rel')=='ad'){
    		var val = $(this).val(); 
    		$(this).parent().attr('rel',val);
    		$(this).parent().addClass('cust_value');
    		previewName('ad');
    		$(this).replaceWith('<a href="#" class="cust_text">'+val+'</a>');   		
    		
    		}
		});
        
    }

});


function getCustomAudience(){

    var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			 context: this,
			'method'	:  'GET',				
			'data': {
			 		'getCustomAudience':'true',		 	
			 		'act': act,
			 		'code':access_token,			 		
			 },
			'dataType':'json',
			success: function (data) {	
				if(data.status=='success'){
					$('.custm_aud_slct').html(data.total);				
					$('.selectpicker').selectpicker('refresh');	
				}else{
				
					return false;
				}
			}
	});	

}

$(document).on('click','.exl_cust_aud',function(){
	$('.exl_custom_audience').toggle();
});
function getLocaleNames(locale){

	var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			 context: this,
			'method'	:  'GET',				
			'data': {
			 		'getLocaleNames':locale,
			 		'code':access_token		
			},			
			success: function (data) {					
				$('.detail-locale-slctd').show();
    			$('.detail-locale-slctd').html(data);
			}
	});
}
function getFlexibleSpecNames(spec){

	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			 context: this,
			'method'	:  'GET',				
			'data': {
			 		'getFlexibleSpecNames':spec,		 	
			},			
			success: function (data) {					
				$('.detail-target-slctd').show();
   				$('.detail-target-slctd').html(data);
			}
	});
}
/*function getEstimation(target){
	var access_token = gets('code');
	var act = gets('act');

	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			 context: this,
			'method'	:  'GET',				
			'data': {
			 		'getEstimation':target,
			},	
			'act': act,
			'code':access_token,	
			'dataType':json	
			success: function (data) {					
				if(data.status){
					$('.approximate_count').text(data.potential);
				}
			}
	});
}*/
$(document).on('click','#delete_camp',function(){
	if($(this).children().hasClass('disable-me')){
		return false;
	}
	$('#delete_campaigns_popup').modal('show');
});
$(document).on('click','#delete_adsets',function(){
	if($(this).children().hasClass('disable-me')){
		return false;
	}
	$('#delete_adsets_popup').modal('show');
});
$(document).on('click','#delete_ads',function(){
	if($(this).children().hasClass('disable-me')){
		return false;
	}
	$('#delete_ads_popup').modal('show');
});

function camp_list_adset_popup(){
	var access_token = gets('code');
	var act = gets('act');

	jQuery.ajax({
			'url'    	:  'AjaxFile.php',
			 context: this,
			'method'	:  'GET',				
			'data': {
			 		'camp_list_adset_popup':'true',
			 		'code':access_token,
			 		'act':act
			},	
			
			//'dataType':json	
			success: function (data) {					
				$('.camp_list_adset_popup').html(data);
				$('.custom-auto-complete-data').show();
			}
	});
}
$(document).ready(function(){
	var cst_height = screen.availHeight;



	 $(".right-fix-drawer-outr").css("height",parseInt(cst_height)-150);
	 $(".edit-camp-form-outr ").css("height",parseInt(cst_height)-220);

});
$(document).on('click','.close_edit_tab',function(){
	$('.right-fix-drawer-outr').removeClass('drawer-open-content');
});

$(document).on('click','.camp_rename',function(){
	var id = jQuery(this).parent().attr('id');
	var name = jQuery('#camp_name').val();
	var obj = jQuery('#camp_objectivea').text();
	$('.recamp_name').val(name);
	$('#cmp_id').attr('rel',id);
	$('#cmp_nme').attr('rel',name);
	$('#cmp_obj').attr('rel',obj);
	//$('input[name="opt1"]').prop('checked','true');	
	$('.camp_prw').text(name);
	$('#camp_rename').modal('show');

});
$(document).on('click','.adset_rename',function(){
	var id = jQuery(this).parent().attr('id');
	var name = jQuery('#adset_name').val();
	$('.readset_name').val(name);
	$('.adset_prw').text(name);
	$('#adset_rename').modal('show');

});
$(document).on('click','.ad_rename',function(){
	var id = jQuery(this).parent().attr('id');
	var name = jQuery('#ad_name').val();
	$('.read_name').val(name);
	$('.ad_prw').text(name);
	getAddRenameFields(id);
	$('#ad_rename').modal('show');

});

$(document).on('click','.rename_camp_fields li',function(){
	if($(this).hasClass('all-main-head') && !$(this).hasClass('custom_text') ){
		return false;
	}
	if($(this).hasClass('custom_text'))
	{
		var html ='<span class="slct_camp_field" rel="">Custom Text : <a href="#" class="cust_text">Enter Custom Text</a> <i class="fa fa-remove slct_rmv" rel="camp"></i></span>';
	}else{
		var html ='<span class="slct_camp_field" rel="'+$(this).attr('id')+'">Campaign : '+$(this).children().text()+' <i class="fa fa-remove slct_rmv" rel="camp"></i></span>';
		$(this).hide();
	}
	$('.slct_fields_camp').append(html);	
	previewName('camp');
	$('.rename_camp_fields').hide();
});

$(document).on('click','.rename_adset_fields li',function(){

	if($(this).hasClass('all-main-head') && !$(this).hasClass('custom_text') ){
		return false;
	}

	if($(this).hasClass('custom_text'))
	{
		var html ='<span class="slct_adset_field" rel="">Custom Text : <a href="#" class="cust_text">Enter Custom Text</a> <i class="fa fa-remove slct_rmv" rel="adset"></i></span>';
	}else{
		var parent = $(this).parent().attr('rel');
		//console.log(parent);	
		var html ='<span class="slct_adset_field" rel="'+$(this).attr('id')+'">'+parent+' : '+$(this).children().text()+' <i class="fa fa-remove slct_rmv" rel="adset"></i></span>';
		$(this).hide();
	}
	$('.slct_fields_adset').append(html);	
	previewName('adset');
	$('.rename_adset_fields').hide();
});

$(document).on('click','.rename_ad_fields li',function(){

	if($(this).hasClass('all-main-head') && !$(this).hasClass('custom_text') ){
		return false;
	}
	
	if($(this).hasClass('custom_text'))
	{
		var html ='<span class="slct_ad_field" rel="">Custom Text : <a href="#" class="cust_text">Enter Custom Text</a> <i class="fa fa-remove slct_rmv" rel="ad"></i></span>';
	}else{
			var parent = $(this).parent().attr('rel');
		var html ='<span class="slct_ad_field" rel="'+$(this).attr('id')+'">'+parent+' : '+$(this).children().text()+' <i class="fa fa-remove slct_rmv" rel="ad"></i></span>';
		$(this).hide();
	}
	$('.slct_fields_ad').append(html);	

	previewName('ad');
	$('.rename_ad_fields').hide();
});
$(document).on('click','.slct_rmv',function(){
	var id = $(this).parent().attr('rel');
	
	$(this).parent().remove();
	$('#'+id).show();
	previewName($(this).attr('rel'));
});

function previewName(type){
	var prw = $('.'+type+'_prw').text();
	if(prw==''){
		var apd ='';
	}else{
		var apd = $('.'+type+'_sep_sign').val();
		//var apd ='_';
	}
	var text= '';
	var ky=0;
	$('.'+type+'_prw').text('');
	$(".slct_"+type+"_field").each(function() {    	
		if($(this).hasClass('cust_value')){
			text = $(this).attr('rel');
		}else{
    	 	text = $('#'+$(this).attr('rel')).attr('rel');
    	}
    	if(ky==0){
    	 	$('.'+type+'_prw').append(text);
    	 	ky=1;
    	}else{
    	 	$('.'+type+'_prw').append(apd+text);
    	}
	});

}

$(document).on('click','.cust_text',function(){
	if($(this).parent().hasClass('slct_ad_field')){
		var rel = 'ad';
	}
	if($(this).parent().hasClass('slct_adset_field')){
		var rel = 'adset';
	}
	if($(this).parent().hasClass('slct_camp_field')){
		var rel = 'camp';
	}
	var html = '<input type="text" value="'+$(this).text()+'" class="cust_text_inp" rel="'+rel+'">';
	$(this).replaceWith(html);
});

$(document).on('keypress','.rename_opt1',function(){
	if($(this).attr('name')=='recamp_name'){
    	$('.camp_prw').text($(this).val());         
    }
    if($(this).attr('name')=='readset_name'){
    	$('.adset_prw').text($(this).val());         
    }
     if($(this).attr('name')=='read_name'){
    	$('.ad_prw').text($(this).val());         
    }
});
$(document).on('click','input[name=rename]',function(){
 	var val = $(this).val();
 	var rel= $(this).attr('rel');

	 	if(val=='opt1'){
	 		$('.'+rel+'_prw').text($('.re'+rel+'_name').val());
	 		$('.re'+rel+'_name').prop("disabled", false)
	 	}else{
	 		$('.re'+rel+'_name').attr('disabled','true');
	 		previewName(rel);
	 	}
	
});

$(document).on('click','.submit_rename',function(){
	var rel = $(this).attr('rel');
	var val = $('.'+rel+'_prw').text();
	if(val==''){
		swal("",'Please enter value');
		
		return false;
	}else{
		
		$('#'+rel+"_name").val(val);
		$('#'+rel+"_rename").modal('hide');
		
	}
});
function getAddRenameFields(id){
	var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({
		'url'    	:  'AjaxFile.php',
		context: this,
		'method'	:  'GET',				
		'data': {'getAddRenameFields':id,'code':access_token,'act':act},	
		success: function (data) {					
			$('.rename_ad_fields').html(data);
		}
	});
}

$(document).on('change','input[name="sep-sign"]',function(){
	if($(this).hasClass('camp_sep_sign')){
		previewName('camp');
	}
	if($(this).hasClass('adset_sep_sign')){
		previewName('adset');
	}
	if($(this).hasClass('ad_sep_sign')){
		previewName('ad');
	}
});

$(document).on('click','.all-main-head h5',function(){
	$(this).next().toggle();

	$(this).parent().parent().parent().click();
	$('.rename_camp_fields').css('display','block');
	$(this).toggleClass('down-arrow');

               
 
});
$(document).on('click','#rename_camp_fields',function(){
	$('.rename_camp_fields').toggle();
});
$(document).on('click','#rename_adset_fields',function(){
	$('.rename_adset_fields').toggle();
});
$(document).on('click','#rename_ad_fields',function(){
	$('.rename_ad_fields').toggle();
});
$(document).on('click','td',function(){

	var tr = $(this).parent().attr('class').split(' ')[0];

    if($(this).children().attr('class')!='campaigns_checkbox' && $(this).children().attr('class')!='adsets_checkbox' && $(this).children().attr('class')!='ad_checkbox'){
    	
    
	    if($(this).parent().hasClass('selected_row')){ 
	    	
	    	$(this).parent().find('.campaigns_checkbox').prop('checked',false);
	    	$(this).parent().find('.adsets_checkbox').prop('checked',false);
	    	$(this).parent().find('.ad_checkbox').prop('checked',false);
	    	$(this).parent().removeClass('selected_row');
	    	return false;
	    }

		if(tr=='camp_rows'){		
			$('.selected_row').find('.campaigns_checkbox').prop('checked',false);
			$('.camp_rows').removeClass('selected_row');	
		    $(this).parent().addClass('selected_row');
		    $('.selected_row').find('.campaigns_checkbox').click();
		    $('.selected_row').find('.campaigns_checkbox').prop('checked','true');
		}

		if(tr=='adset_rows'){
		
			$('.selected_row').find('.adsets_checkbox').prop('checked',false);
			$('.adset_rows').removeClass('selected_row');	
		    $(this).parent().addClass('selected_row');
		    $('.selected_row').find('.adsets_checkbox').click();
		    $('.selected_row').find('.adsets_checkbox').prop('checked','true');
		}

		if(tr=='ad_rows'){
		
			$('.selected_row').find('.ad_checkbox').prop('checked',false);
			$('.ad_rows').removeClass('selected_row');	
		    $(this).parent().addClass('selected_row');
		    $('.selected_row').find('.ad_checkbox').click();
		    $('.selected_row').find('.ad_checkbox').prop('checked','true');
		}
	}
	
		
});


$(document).on('click','.camp_totals',function(){
	var id = $(this).children().attr('rel');
	var type = $(this).attr('rel');
    var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({
		'url'    	:  'AjaxFile.php',
		context: this,
		'method'	:  'GET',				
		'data': {'camp_total_adsets':id,'code':access_token,'act':act,'get_type':type},	
		dataType:'json',
		success: function (data) {					
			if(data.status=='success'){
				if(type=='adset'){
					
					$('.camp').removeClass('active');
					$('.ad-sets').addClass('active');
					$('#camp').removeClass('active');
					$('#ad-sets').addClass('active');					
					data.adset_ids.forEach(function(item,index) {				
						if($('#'+item).find('.adsets_checkbox').prop('checked')==true){
							$('#'+item).find('.adsets_checkbox').prop('checked',false);
						}
						$('#'+item).find('.adsets_checkbox').click();
					});
				}
				if(type=='ad'){
	
					$('.camp').removeClass('active');										
					$('.ad-sets').removeClass('active');
					$('.ads').addClass('active');
					$('#ad-sets').removeClass('active');
					$('#camp').removeClass('active');
					$('#ads').addClass('active');					
					data.ad_ids.forEach(function(item,index) {				
						if($('#'+item+".ad_rows").find('.ad_checkbox').prop('checked')==true){
							$('#'+item+".ad_rows").find('.ad_checkbox').prop('checked',false);
						}
						$('#'+item+".ad_rows").find('.ad_checkbox').click();
					});
				}

			}
		}
	});
});
$(document).on('click','.adset_totals',function(){
	var id = $(this).children().attr('rel');
	var type = $(this).attr('rel');
    var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({
		'url'    	:  'AjaxFile.php',
		context: this,
		'method'	:  'GET',				
		'data': {'adset_totals':id,'code':access_token,'act':act,'get_type':type},	
		dataType:'json',
		success: function (data) {					
			if(data.status=='success'){
				if(type=='camp'){
		
					$('.ads').removeClass('active');
					$('.ad-sets').addClass('active');
					$('#ads').removeClass('active');
					$('#ad-sets').addClass('active');				
					
					if($('#'+data.campaign_id).find('.campaigns_checkbox').prop('checked')==true){
						$('#'+data.campaign_id).find('.campaigns_checkbox').prop('checked',false);
					}
					$('#'+data.campaign_id).find('.campaigns_checkbox').click();
				
				}
				if(type=='ad'){
			
					$('.camp').removeClass('active');										
					$('.ad-sets').removeClass('active');
					$('.ads').addClass('active');
					$('#ad-sets').removeClass('active');
					$('#camp').removeClass('active');
					$('#ads').addClass('active');
					
					data.ad_ids.forEach(function(item,index) {						
						if($('#'+item+".ad_rows").find('.ad_checkbox').prop('checked')==true){
							$('#'+item+".ad_rows").find('.ad_checkbox').prop('checked',false);
						}
						$('#'+item+".ad_rows").find('.ad_checkbox').click();
					});
				}

			}
		}
	});
});
$(document).on('click','.ad_totals',function(){
	var id = $(this).children().attr('rel');
	var type = $(this).attr('rel');
    var access_token = gets('code');
	var act = gets('act');
	jQuery.ajax({
		'url'    	:  'AjaxFile.php',
		context: this,
		'method'	:  'GET',				
		'data': {'ad_totals':id,'code':access_token,'act':act,'get_type':type},	
		dataType:'json',
		success: function (data) {					
			if(data.status=='success'){
				if(type=='camp'){		

					$('.ads').removeClass('active');
					$('.ad-sets').removeClass('active');
					$('#ads').removeClass('active');
					$('#ad-sets').removeClass('active');
					$('.camp').addClass('active');				
					$('#camp').addClass('active');			
				
					if($('#'+data.campaign_id).find('.campaigns_checkbox').prop('checked')==true){
							$('#'+data.campaign_id).find('.campaigns_checkbox').prop('checked',false);
						}
					$('#'+data.campaign_id).find('.campaigns_checkbox').click();
				
				}
				if(type=='adset'){				

					$('.camp').removeClass('active');
					$('.ad-sets').addClass('active');
					$('#camp').removeClass('active');
					$('#ad-sets').addClass('active');
					$('.ads').removeClass('active');
					$('#ads').removeClass('active');					
					$('#'+data.adset_id).find('.adsets_checkbox').click();
					console.log($('#'+data.adset_id).find('.adsets_checkbox').prop('checked'));
					if($('#'+data.adset_id).find('.adsets_checkbox').prop('checked')==true){
							$('#'+data.adset_id).find('.adsets_checkbox').prop('checked',false);
						}
					console.log($('#'+data.adset_id).find('.adsets_checkbox').attr('type'));

				}
			}

		}
		
	});
});