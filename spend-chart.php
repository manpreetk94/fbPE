
<script>
//window.onload = function () {
console.log($('.spend_graph').width());
if($( ".spend_graph" ).width()<=100){
	var width=screen.availWidth;
	width = 600;
}else{
	var width=$( ".spend_graph" ).width();
}

$(function () {
//console.log('sss'+$('.perform_graph').width());
var chart = new CanvasJS.Chart("chartContainerSpend", {
	theme:"light2",
	animationEnabled: true,
	width:width,
	height:300,
	title:{
		text: ""
	},
	axisY :{
		
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
	//	yValueFormatString: "##. ",
		name: "Amount Spent (Cumulative)",
		dataPoints: <?php echo json_encode($cum_spnd, JSON_NUMERIC_CHECK ); ?>
	},

	{
		type: "spline", 
		showInLegend: true,
	//	yValueFormatString: " ##.",
		name: "Amount Spent",
		dataPoints: <?php echo json_encode($spnd, JSON_NUMERIC_CHECK ); ?>
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

<div id="chartContainerSpend" style="height: 300px; width: 100%;"></div>

