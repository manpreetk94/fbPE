
<script>
//window.onload = function () {

$(function () {
//console.log('sss'+$('.people_graph').width());
if($( ".graphs" ).width()<=100){
	var width=screen.availWidth;
	width = 600;
}else{
	var width=$( ".graphs" ).width();
}

var chart = new CanvasJS.Chart("chartContainerReach", {
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
		name: "Reach",
		dataPoints: <?php echo json_encode($reach, JSON_NUMERIC_CHECK ); ?>
	},

	{
		type: "spline", 
		showInLegend: true,
		yValueFormatString: " ##. ",
		name: "Frequency",
		dataPoints: <?php echo json_encode($frequency, JSON_NUMERIC_CHECK ); ?>
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
<div id="chartContainerReach" style="height: 300px; width: 100%;"></div>

