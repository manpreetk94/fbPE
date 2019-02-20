
<script>
//window.onload = function () {
console.log($('.graphs').width());
if($( ".graphs" ).width()<=100){
	var width=screen.availWidth;
	width = 600;
}else{
	var width=$( ".graphs" ).width();
}

$(function () {
//console.log('sss'+$('.perform_graph').width());
var chart = new CanvasJS.Chart("chartContainer", {
	theme:"light2",
	animationEnabled: true,
	width:width,
	height:300,
	title:{
		text: ""
	},
	axisY :{
		includeZero: false,
		title: "",
		suffix: ""
	},
	toolTip: {
		shared: "true"
	},
	legend:{
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	data: [
	
	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: "##. ",
		name: "<?php echo $objective_for_results; ?>",
		dataPoints: <?php echo json_encode($spline1, JSON_NUMERIC_CHECK ); ?>
	},

	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: " ##.  cost per result",
		name: "Cost per <?php echo $objective_for_results; ?>",
		dataPoints: <?php echo json_encode($spline2, JSON_NUMERIC_CHECK ); ?>
	}]
});
chart.render();

	function toggleDataSeries(e) {
		if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible ){
			e.dataSeries.visible = false;
		} else {
			e.dataSeries.visible = true;
		}
		chart.render();
	}

});
</script>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>

