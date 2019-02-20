jQuery(document).ready(function(){
	jQuery('code a').click(function() {
		jQuery('#myModal .modal-body p').text(jQuery(this).data('reason'));
	});
});

//<!-- date range -->
$(document).ready(function(){
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
				$('#cmp_'+cmp_id+' .toggle.btn.btn-xs').removeClass('btn-primary').removeClass('on').addClass('btn-default off');
				$('#adset_'+cmp_id+' .toggle.btn.btn-xs').removeClass('btn-primary').removeClass('on').addClass('btn-default off');
			} else {
				$('#cmp_'+cmp_id+' .toggle.btn.btn-xs').addClass('btn-primary').removeClass('btn-default off');
				$('#adset_'+cmp_id+' .toggle.btn.btn-xs').addClass('btn-primary').removeClass('btn-default off');
			}
		});

		$('.camapaign-details-list .toggle-group label, .adsets-details-list .toggle-group label').click(function() {
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
	$('.campaigns_checkbox').click(function() {
		if(!$(this).is(':checked')) {
			$('.all_camapaign_checkbox').prop('checked',false);
		}
		var cmp_id = $(this).parent().parent().attr('id');
		var cmp_name = $(this).parent().parent().data('cmp_name');
		var checked_count = $('.campaigns_checkbox:checked').length;
		$('#camapaign-full-details').show();
		$('#adsets-full-details').hide();
		$('.right-fix-drawer-outr span.camapaign_name').text(cmp_name);
		$('#camapaign_selected span').text(checked_count);
		$('#camapaign_selected').show();
		$('.camapaign-details-list').hide();
		$('.dummy_text').text('Campaign');
		if(checked_count > 1) {
			$('#cmp_mixed').show();
			$('.mixed_value').show();
			$('.mixed_value').text(checked_count+ ' Campaigns');
			$('.total_campaigns_count').text(checked_count);
			$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').hide();
		} else {
			$('#cmp_'+cmp_id).show();
			$('.mixed_value').hide();
			$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').show();
			var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
			if($('.campaigns_checkbox').is(':checked')) {
				$('li.ad-sets a span').text('for '+checked_count+' Campaign');
				$('li.ads a span').text('for '+checked_count+' Campaign');
				$(main_div_id+' div.disable-me,'+main_div_id+' li>i').removeClass('disable-me');
			} else {
				$('li.ad-sets a span').text('');
				$('li.ads a span').text('');
				$('#camapaign_selected').hide();
				$(".right-fix-drawer-outr").removeClass("drawer-open-content");
				$(main_div_id+' .left-fil1 .btn-and-caret-icon-dropdown:gt(0):lt(2),'+main_div_id+' .left-fil1 .simple-default-icons-group li>i').addClass('disable-me');
			}
		}

	});

	$('.all_camapaign_checkbox').click(function() {
		if($(this).is(':checked')) {
			$('.campaigns_checkbox').prop('checked', true);
			var campaigns_count = $('.campaigns_checkbox:checked').length;
			$('#camapaign_selected span').text(campaigns_count);
			$('#camapaign_selected').show();
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
			$('.camapaign-details-list').hide();
			$('#cmp_mixed').show();
			$('.mixed_value').show();
			$('.mixed_value').text(campaigns_count+ ' Campaigns');
			$('.total_campaigns_count').text(campaigns_count);
			$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').hide();
		} else {
			$('.mixed_value').hide();
			$('.right-fix-drawer-outr span.camapaign_name,.dummy_text').show();
			$('#camapaign-full-details').show();
			$('#adsets-full-details').hide();
			$('#ads-full-details').hide();
			var camp_id = $('.campaigns_checkbox:checked').parent().parent().attr('id');
			var cmp_name =  $('.campaigns_checkbox:checked').parent().parent().data('cmp_name');
			$('#cmp_'+camp_id).show();
			$('.right-fix-drawer-outr span.camapaign_name').text(cmp_name);
		}
	});

	$('#camapaign_selected i').click(function() {
		$('#camapaign_selected').hide();
		$('.campaigns_checkbox').prop('checked',false);
		$('li.ad-sets a span').text('');
		$('li.ads a span').text('');
		$('.all_camapaign_checkbox').prop('checked',false);
	});
	/*Campaigns checkbox*/

	
	/*adset checkbox*/
	$('.adsets_checkbox').click(function() {
		$('#camapaign-full-details').hide();
		$('#adsets-full-details').show();
		$('li.ad-sets a span').hide();
		var adsets_id = $(this).parent().parent().attr('id');
		var adsets_name = $(this).parent().parent().data('adset_name');
		var checked_count = $('.adsets_checkbox:checked').length;
		$('.right-fix-drawer-outr span.camapaign_name').text(adsets_name);
		$('#adsets_selected span').text(checked_count);
		$('#adsets_selected').show();
		$('.adsets-details-list').hide();
		$('#adset_'+adsets_id).show();
		var main_div_id = $('.nav.nav-tabs.main-tabs li.active').children().attr('href');
		if($('.adsets_checkbox').is(':checked')) {
			$('li.ads a span').text('for '+checked_count+' Ad Set');
			$(main_div_id+' div.disable-me,'+main_div_id+' li>i').removeClass('disable-me');
		} else {
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
		} else {
			$('.adsets_checkbox').prop('checked', false);
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

		} else {
			$('#camapaign-full-details').hide();
			$('#adsets-full-details').show();
			$('#ads-full-details').hide();
			var adsets_id = $('.adsets_checkbox:checked').parent().parent().attr('id');
			var adsets_name =  $('.adsets_checkbox:checked').parent().parent().data('adset_name');
			$('#adset_'+adsets_id).show();
			$('.right-fix-drawer-outr span.camapaign_name').text(adsets_name);
		}
	});

	$('#adsets_selected i').click(function() {
		$('#adsets_selected').hide();
		$('.adsets_checkbox').prop('checked',false);
		$('li.ads a span').text('');
		$('li.ad-sets a span').show();
		$('.all_adsets_checkbox').prop('checked',false);
	});

	/*adset checkbox*/

	$('.all_ad_checkbox,.ad_checkbox').click(function() {
		if($(this).is(':checked')) {
			$('#camapaign-full-details').hide();
			$('#adsets-full-details').hide();
			$('#ads-full-details').show();
			$('.ad_checkbox').prop('checked', true);
			var ads_count = $('.ad_checkbox:checked').length;
			$('li.ads a span').hide();
			$('#ads_selected span').text(ads_count);
			$('#ads_selected').show();
		} else {
			$('.ad_checkbox').prop('checked', false);
			$('li.ads a span').show();
			$('#ads_selected').hide();
		}
	});

	$('.ad_checkbox').click(function() {
		var ads_id = $(this).parent().parent().attr('id');
		var ads_name = $(this).parent().parent().data('adset_name');
		$('.right-fix-drawer-outr span.camapaign_name').text(ads_name);
	});


	$('#ads_selected i').click(function() {
		$('#ads_selected').hide();
		$('li.ads a span').show();
		$('.ad_checkbox').prop('checked', false);
		$('.all_ad_checkbox').prop('checked',false);
	});

});