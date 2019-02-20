jQuery(document).ready(function(){
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
	jQuery('#delete_camp').click(function(){
		var length = jQuery('.campaigns_checkbox:checked').length;
		var array = [];
		if(length > 1) {
			jQuery('.campaigns_checkbox:checked').each(function() {
				array.push(jQuery(this).parent().parent().attr('id'));
			});	
			jQuery('#delete_camp_id').val(JSON.stringify(array));
		} else {
			array.push(jQuery('.campaigns_checkbox:checked').parent().parent().attr('id'));
			jQuery('#delete_camp_id').val(JSON.stringify(array));
		}
	});
	/*delete campaign*/
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
		$('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
	});
	$('.spinner .btn:last-of-type').on('click', function() {
		$('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
	});		 
});

// <!-- right drawer script -->
$(document).ready(function(){
	$(".open-drw-arrow").click(function(event) {  
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
		$('td .toggle-group label,td .toggle-group span').click(function(){
			var cmp_id = $(this).parent().parent().parent().parent().attr('id');
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

		$('.camapaign-details-list .toggle-group label, .adsets-details-list .toggle-group label, .ads-details-list .toggle-group label').click(function() {
			var cmp_id = $(this).parent().prev().val();
			alert(cmp_id);
			if($(this).text() == 'On') {
				$('tr#'+cmp_id+' .toggle.btn.btn-xs').removeClass('btn-primary').removeClass('on').addClass('btn-default off');
			} else {
				$('tr#'+cmp_id+' .toggle.btn.btn-xs').addClass('btn-primary').removeClass('btn-default off');
			}
		}); 
	},500);
	/*On off toggle butn*/

	/*Campaigns checkbox*/
	$('.campaigns_checkbox').click(function() {
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

		var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
		if($('.campaigns_checkbox').is(':checked')) {
			$('li.ad-sets a span').text('for '+checked_count+' Campaign');
			$('li.ads a span').text('for '+checked_count+' Campaign');
			$(main_div_id+' div.disable-me,'+main_div_id+' li>i').removeClass('disable-me');
		} else {
			$('#adset_table tbody tr,#ad_table tbody tr').show();
			$('li.ad-sets a span').text('');
			$('li.ads a span').text('');
			$('#camapaign_selected').hide();
			$(".right-fix-drawer-outr").removeClass("drawer-open-content");
			$(main_div_id+' .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2),'+main_div_id+' .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
		}
	});

	$('.all_camapaign_checkbox').click(function() {
		if($(this).is(':checked')) {
			$('.campaigns_checkbox').prop('checked', true);
			var campaigns_count = $('.campaigns_checkbox:checked').length;
			$('#camapaign_selected span').text(campaigns_count);
			$('#camapaign_selected').show();
			$('.camp_total_adsets').text($('#adset_table tbody .adset_rows').length);
			$('.camp_total_ads').text($('#ad_table tbody .ad_rows').length);
			if(!$('#adsets_selected').is(':visible')) {
				$('li.ad-sets a span').text('for '+campaigns_count+' Campaign');
				$('li.ads a span').text('for '+campaigns_count+' Campaign');
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
		$('#adset_table tbody tr,#ad_table tbody tr').removeClass('hide-row');
	});
	/*Campaigns checkbox*/

	
	/*adset checkbox*/
	$('.adsets_checkbox').click(function() {
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

		var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
		if($('.adsets_checkbox').is(':checked')) {
			$('li.ads a span').text('for '+checked_count+' Ad Set');
			$(main_div_id+' div.disable-me,'+main_div_id+' li>i').removeClass('disable-me');
		} else {
			$('#ad_table tbody tr').show();
			if($('#camapaign_selected').is(':visible')) {
				$('li.ad-sets a span').show();
				var campaigns_count = $('.campaigns_checkbox:checked').length;
				$('li.ad-sets a span').text('for '+campaigns_count+' Campaign');
				$('li.ads a span').text('for '+campaigns_count+' Campaign');
			} else {
				$('li.ads a span').text('');
			}
			$(".right-fix-drawer-outr").removeClass("drawer-open-content");
			$('#adsets_selected').hide();
			$(main_div_id+' .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2),'+main_div_id+' .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
		}
	});

	$('.all_adsets_checkbox').click(function() {
		if($(this).is(':checked')) {
			$('.adsets_checkbox').prop('checked', true);
			var adsets_count = $('.adsets_checkbox:checked').length;
			$('li.ad-sets a span').hide();
			$('#adsets_selected span').text(adsets_count);
			$('#adsets_selected').show();
			$('li.ads a span').text('for '+adsets_count+' Ad Set');
			$('#adsets-full-details').show();
			$('#camapaign-full-details, #ads-full-details').hide();
			$('#adset_name').val('Mixed Value');
			$('#adset_status').parent().hide();
		} else {
			$('.adsets_checkbox').prop('checked', false);
			$(".right-fix-drawer-outr").removeClass("drawer-open-content");
			if($('#camapaign_selected').is(':visible')) {
				$('li.ad-sets a span').show();
				$('#adsets_selected').hide();
				var campaigns_count = $('.campaigns_checkbox:checked').length;
				$('li.ad-sets a span').text('for '+campaigns_count+' Campaign');
				$('li.ads a span').text('for '+campaigns_count+' Campaign');
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
			$('li.ads a span').text('for '+campaigns_count+' Campaign');
		} else {
			$('li.ads a span').text('');
		}
		$('li.ad-sets a span').show();
		$('.all_adsets_checkbox').prop('checked',false);
		$(".right-fix-drawer-outr").removeClass("drawer-open-content");
		$('#ad_table tbody tr').removeClass('hide-row').removeClass('show-row');
	});
	/*end adset checkbox*/


	$('.ad_checkbox').click(function() {

		if(!$(this).is(':checked')) {
			$('.all_ad_checkbox').prop('checked',false);
		}

		$('#camapaign-full-details, #adsets-full-details').hide();
		$('#ads-full-details').show();
		
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
		}

	});

	$('.all_ad_checkbox').click(function() {
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

		} else {
			$('.ad_checkbox').prop('checked', false);
			$('li.ads a span').show();
			$('#ads_selected').hide();
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
			/*_camapaigns.forEach(function(item,index) {
				var ads = _.find(item.ads.data, function(o) { return o.id == ads_id;  });
				if(ads != undefined) {
					$('#ad_status').parent().show();
					$('.right-fix-drawer-outr span.camapaign_name').text(ads.name);
					$('#ad_name').val(ads.name);
					$('#adset_id').text(ads.id);
					$('#adset_status').val(ads.id);
					$('#adset_status').parent().attr('class','');
					$('#adset_status').parent().attr('class',$('table tr#'+ads.id+' .adsets_status').parent().attr('class'));
					$('.camp_total_adsets').text(item.adsets.data.length);
					$('.camp_total_camps').text(1);
				}
			});*/
			//$(".right-fix-drawer-outr").removeClass("drawer-open-content");
		}
	});

	$('#ads_selected i').click(function() {
		$('#ads_selected').hide();
		$('li.ads a span').show();
		$('.ad_checkbox').prop('checked', false);
		$('.all_ad_checkbox').prop('checked',false);
		$(".right-fix-drawer-outr").removeClass("drawer-open-content");
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

	$('.view-charts,.edit-charts').click(function(e) {
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
});


function getCampaginsData(cmp_id) {
	$('#adset_table tbody tr,#ad_table tbody tr').addClass('hide-row');
	$('#adset_table tbody tr.camp_'+cmp_id+', #ad_table tbody tr.camp_'+cmp_id).removeClass('hide-row').addClass('show-row');
	$('li.ad-sets a span').text('for 1 Campaign');
	$('li.ads a span').text('for 1 Campaign');
	$('#camapaign_selected span').text(1);
	$('#camapaign_selected').show();
	$('#adsets-full-details, #ads-full-details').hide();
	$('#camapaign-full-details').show();
	$('.dummy_text').text('Campaigns');
	var newData = _.find(_camapaigns, function(o) { return o.id == cmp_id;  });
	$('#camp_status').parent().show();
	$('.right-fix-drawer-outr span.camapaign_name').text(newData.name);
	$('#camp_name').val(newData.name);
	$('#camp_objective').text(newData.objective);
	$('#camp_buyingtype').text(newData.buying_type);
	$('#camp_id').text(newData.id);
	$('#camp_status').val(newData.id);
	$('#camp_status').parent().attr('class','');
	$('#camp_status').parent().attr('class',$('table tr#'+newData.id+' .campaigns_status').parent().attr('class'));
	$('.camp_total_adsets').text(newData.adsets.data.length);
	if(newData.ads) {
		$('.camp_total_ads').text(newData.ads.data.length);
	}
	$('.mixed_value').hide();
	$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').show();
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
		var adsets = _.find(item.adsets.data, function(o) { return o.id == adsets_id;  });
		if(adsets != undefined) {
			$('.right-fix-drawer-outr span.camapaign_name').text(adsets.name);
			$('#adset_name').val(adsets.name);
			$('#adset_id').text(adsets.id);
			$('#adset_status').val(adsets.id);
			$('#adset_status').parent().attr('class','');
			$('#adset_status').parent().attr('class',$('table tr#'+adsets.id+' .adsets_status').parent().attr('class'));
			$('.camp_total_ads').text(item.ads.data.length);
			$('.camp_total_camps').text(1);						
			$('#addsets_daily_bugdet').val(adsets.daily_budget);					
			$('.addsets_start_time').text(adsets.start_time);				

			$('select[name="addsets_min_age"]').find('option[value="'+adsets.targeting_age_min+'"]').attr("selected",true);
			$('select[name="addsets_max_age"]').find('option[value="'+adsets.targeting_age_max+'"]').attr("selected",true);

			if(adsets.targeting_genders==1){
				$('#radio2').attr('checked', 'checked');
			}
			if(adsets.targeting_genders==2){
				$('#radio3').attr('checked', 'checked');
			}
			if(adsets.targeting_genders==0){
				$('#radio1').attr('checked', 'checked');
			}
			$('#addsets_location').text(adsets.targeting_countries);
		}
	});
}

function getAdData(ads_id) {
	$('#camapaign-full-details, #adsets-full-details').hide();
	$('#ads-full-details').show();
	$('#ad_status').parent().show();
	$('#adsets_selected span').text(1);
	$('#adsets_selected').show();
	$('.dummy_text').text('Ads');
	_camapaigns.forEach(function(item,index) {
		var ads = _.find(item.ads.data, function(o) { return o.id == ads_id;  });
		if(ads != undefined) {
			$('.right-fix-drawer-outr span.camapaign_name').text(ads.name);
			$('#ad_name').val(ads.name);
			$('#ad_id').text(ads.id);
			$('#ad_status').val(ads.id);
			//$('#ad_status').parent().attr('class','');
			$('#ad_status').parent().attr('class',$('table tr#'+ads.id+' .ads_status').parent().attr('class'));
			$('.camp_total_adsets').text(item.adsets.data.length);
			$('.camp_total_camps').text(1);
		}
	});
}

