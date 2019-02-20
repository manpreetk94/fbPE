<?php
	if($_SESSION['time_range']['since']!='Invalid date'){
		$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
	}else{
		$rg="&date_preset=lifetime";
	}
	$break = '&breakdowns=hourly_stats_aggregated_by_audience_time_zone';
	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$act."/insights/?fields=impressions,ctr,place_page_name,reach,frequency,unique_clicks,spend,inline_link_clicks,cost_per_inline_link_click&access_token=".$code."".$rg.$break);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$result = json_decode($result, true);	

	$spline1=array();
	$spline2=array();
	

	if($res1=='' && $res2==''){		
		$res1='reach';
		$res2 ='spend';
	}

	if(!empty($result['data'])){
		foreach ($result['data'] as $key => $value) {
						
				$spline1[$key]['label']=$value['hourly_stats_aggregated_by_audience_time_zone'];
				if(isset($value[$res1])){
					$spline1[$key]['y']=$value[$res1];
				}else{
					$spline1[$key]['y']=0;
				}
				$spline2[$key]['label']=$value['hourly_stats_aggregated_by_audience_time_zone'];
				if(isset($value[$res2])){
					$spline2[$key]['y']=$value[$res2];
				}else{
					$spline2[$key]['y']=0;
				}

				
		}		
			
		}
?>
<script type="text/javascript">
	$(function () {

	var chart = new CanvasJS.Chart("chartContainerAccountHour", {
		animationEnabled: true,
			theme:"light2",
		legendMarkerColor: "grey",
		title:{
			text: ""
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
			type: "column",
			showInLegend: true,
			name: "<?php echo $res1; ?>",
			color: "#3d6ad6",
			dataPoints: <?php echo json_encode($spline1, JSON_NUMERIC_CHECK ); ?>
		},
		{
			type: "column",
			showInLegend: true,
			name: "<?php echo $res2; ?>",
			color: "#13bda6",
			dataPoints: <?php echo json_encode($spline2, JSON_NUMERIC_CHECK ); ?>
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

<?php if(!empty($result['data'])){ ?>

		<div id="chartContainerAccountHour" style="height: 300px; width: 100%;"></div> 

<?php }else{ ?>

	<img src="img/no-result-img.jpg"><br>	
	<b>No Activity During Date Range</b><br>

<?php }?>