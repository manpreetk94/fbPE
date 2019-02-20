<?php
	if($_SESSION['time_range']['since']!='Invalid date'){
		$rg = "&time_range={'since':'".$_SESSION['time_range']['since']."','until':'".$_SESSION['time_range']['until']."'}";
	}else{
		$rg="&date_preset=lifetime";
	}
	$rg .='&time_increment=1';
	
	$cSession = curl_init(); 	
	curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.11/".$act."/insights/?fields=reach,date_start,date_stop,spend,impressions,inline_link_clicks&access_token=".$code."".$rg);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$account_graph = json_decode($result, true);	

	$spline1=array();
	

	if($tab4==''){		
		$tab4='inline_link_clicks';
	}

	if(!empty($account_graph['data'])){
		foreach ($account_graph['data'] as $key => $value) {
						
			$spline1[$key]['label']=$value['date_start'];
			if(isset($value[$tab4])){
				$spline1[$key]['y']=$value[$tab4];
			}else{
				$spline1[$key]['y']=0;
			}
			
		}		
	}
?>
<script type="text/javascript">
	$(function () {

	if($( ".tab4" ).width()==100){
	var width=screen.availWidth;
	width = parseInt(width)*75/100;
	}else{
		var width=$( ".tab4" ).width();
	}

	var chart = new CanvasJS.Chart("chartContainerAccountTab4", {
		animationEnabled: true,
		legendMarkerColor: "grey",
		width:width,
		theme:"light2",
		height:300,
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
			type: "spline",
			showInLegend: true,
			name: "<?php echo $tab4; ?>",
			color: "#3d6ad6",
			dataPoints: <?php echo json_encode($spline1, JSON_NUMERIC_CHECK ); ?>
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

<?php if(!empty($account_graph['data'])){ ?>

		<div id="chartContainerAccountTab4" style="width: 100%;height: 300px;"></div> 

<?php }else{ ?>
	<div class="no-result-found ">
	<img src="img/no-result-img.jpg"><br>	
	<b>No Activity During Date Range</b><br>
</div>
<?php }?>