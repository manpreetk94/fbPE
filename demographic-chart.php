
<script type="text/javascript">
$(function () {

var chart = new CanvasJS.Chart("chartContainerdemoWomen", {
	animationEnabled: true,
	theme:"light2",
	height:300,
	legendMarkerColor: "grey",
	title:{
		text: "Women"
	},
	axisY: {
		title: ""
	},
	legend: {
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	toolTip: {
		shared: true,
		content: toolTipFormatter
	},
	data: [{
		type: "bar",
		showInLegend: true,
		name: "<?php echo ucfirst($res1); ?>",
		color: "#00FFE6",
		dataPoints: <?php echo json_encode($women_spline1, JSON_NUMERIC_CHECK ); ?>
	},
	{
		type: "bar",
		showInLegend: true,
		name: "<?php echo ucfirst($res2); ?>",
		color: "#2E7CFA",
		dataPoints: <?php echo json_encode($women_spline2, JSON_NUMERIC_CHECK ); ?>
	},
	]
});
chart.render();

function toolTipFormatter(e) {

	var str = "";
	var total = 0 ;
	var str3;
	var str2 ;
	for (var i = 0; i < e.entries.length; i++){
		var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
		total = e.entries[i].dataPoint.y + total;
		str = str.concat(str1);
	}
	str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
	//str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
	//return (str2.concat(str)).concat(str3);
	return str2.concat(str);
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

});
</script>

<script type="text/javascript">
$(function () {

var chart = new CanvasJS.Chart("chartContainerdemoMen", {
	animationEnabled: true,
	theme:"light2",
	title:{
		text: "Men"
	},
	axisY: {
		title: ""
	},
	legend: {
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	toolTip: {
		shared: true,
		content: toolTipFormatter
	},
	data: [{
		type: "bar",
		showInLegend: true,
		name:  "<?php echo ucfirst($res1); ?>",
		color: "#00FFE6",
		dataPoints: <?php echo json_encode($men_spline1, JSON_NUMERIC_CHECK); ?>
	},
	{
		type: "bar",
		showInLegend: true,
		name:  "<?php echo ucfirst($res2); ?>",
		color: "#2E7CFA",
		dataPoints: <?php echo json_encode($men_spline2, JSON_NUMERIC_CHECK); ?>
	},
	]
});
chart.render();

function toolTipFormatter(e) {

	var str = "";
	var total = 0 ;
	var str3;
	var str2 ;
	for (var i = 0; i < e.entries.length; i++){
		var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
		total = e.entries[i].dataPoint.y + total;
		str = str.concat(str1);
	}
	str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
	//str3 = "<span style = \"color:Tomato\">Total: </span><strong>" + total + "</strong><br/>";
	//return (str2.concat(str)).concat(str3);
	return str2.concat(str);
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

});
</script>
<div class="result-found">
	<div class="custom-autocomplete-select">
	    <select class="selectpicker show-tick result" data-live-search="true" data-size="5" name="results1" id="result1"> 
	        <option data-tokens="" value="spend" <?php if($res1=='spend') { echo 'selected'; } ?> >Amount Spend</option>
	        <option data-tokens="" value="lead" <?php if($res1=='lead') { echo 'selected'; } ?>>Leads</option>           
	    </select>

	     <select class="selectpicker show-tick result" data-live-search="true" data-size="5" name="results2" id="result2"> 
	    	<option data-tokens="" value="reach" <?php if($res1=='reach') { echo 'selected'; } ?>>Reach</option> 
	    	<option data-tokens="" value="impressions" <?php if($res1=='impressions') { echo 'selected'; } ?>>Impression</option>  
	    </select>
	</div>
	<div id="chartContainerdemoWomen" style="height: 300px; width: 100%;"></div>
	<div id="chartContainerdemoMen" style="height: 300px; width: 100%;"></div>
</div>
