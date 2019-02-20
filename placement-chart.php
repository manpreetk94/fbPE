

<script>
$(function () {

var chart = new CanvasJS.Chart("chartContainerPlacement", {
	animationEnabled: true,
	height:300,
		theme:"light2",
	title:{
		text: ""
	},	
	axisY: {
		title: "",
		titleFontColor: "#00FFE6",
		lineColor: "#00FFE6",
		labelFontColor: "#00FFE6",
		tickColor: "#00FFE6"
		
	},
	axisY2: {
		title: "",
		titleFontColor: "#2EC7FA",
		lineColor: "#2EC7FA",
		labelFontColor: "#2EC7FA",
		tickColor: "#2EC7FA"
		
	},	
	toolTip: {
		shared: true
	},
	legend: {
		cursor:"pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "<?php echo $res1; ?>",
		legendText: "<?php echo $res1; ?>",
		showInLegend: true, 
		color: "#00FFE6",
		dataPoints:<?php echo json_encode($spline1, JSON_NUMERIC_CHECK ); ?>
	},
	{
		type: "column",	
		name: "<?php echo $res2; ?>",
		legendText: "<?php echo $res2; ?>",
		axisYType: "secondary",
		showInLegend: true,
		color: "#2E7CFA",
		dataPoints:<?php echo json_encode($spline2, JSON_NUMERIC_CHECK ); ?>
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

});
</script>

<div class="row result-found">
	<div class="col-sm-9">
	<div class="custom-autocomplete-select">
	    <select class="selectpicker show-tick place" data-live-search="true" data-size="5" name="place1" id="place1"> 
	        <option data-tokens="" value="spend" <?php if($res1=='spend') { echo 'selected'; } ?> >Amount Spend</option>
	        <option data-tokens="" value="lead" <?php if($res1=='lead') { echo 'selected'; } ?>>Leads</option>           
	    </select>

	     <select class="selectpicker show-tick place" data-live-search="true" data-size="5" name="place2" id="place2"> 
	    	<option data-tokens="" value="reach" <?php if($res2=='reach') { echo 'selected'; } ?>>Reach</option> 
	    	<option data-tokens="" value="impressions" <?php if($res2=='impressions') { echo 'selected'; } ?>>Impression</option>  
	    </select>
	</div>

	<div id="chartContainerPlacement" style="height: 300px; width: 100%;"></div>
	</div>
	<div class="col-sm-3">
		<div class="custom-autocomplete-select">
		    <select class="selectpicker show-tick device_type" data-live-search="true" data-size="5" name="device" id="device_type"> 
		        <option data-tokens="" value="all" <?php if($dvc=='all') { echo 'selected'; } ?> > Mobile And Desktop</option>
		        <option data-tokens="" value="mobile" <?php if($dvc=='mobile') { echo 'selected'; } ?> > Mobile Only</option>
		        <option data-tokens="" value="desktop" <?php if($dvc=='desktop') { echo 'selected'; } ?> > Desktop Only</option>	             
		    </select>
		</div>
		<p><b>About Placement Results</b></p>
		<p>Ad delivery is optimized to allocate your budget to placements likely to perform best with your audience, based on your targeting and bid amount.</p>
	</div>
</div>


