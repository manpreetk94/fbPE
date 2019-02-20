<?php 

include 'header.php';
if (isset($_SESSION['user'])) : 
	
	?>
	<div class="col-md-12">
		<div class="col-md-3 col-md-offset-4 login-div"><code><?php echo $_SESSION['user']['email']; ?></code>&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;<a href="logout.php">Logout</a></div>
	</div>
	<?php 
	$cSession = curl_init(); 
	curl_setopt($cSession,CURLOPT_URL,"https://manage.marketresearchltd.net/v1/accounts/get_assigned_accounts?method=post&uid=".$_SESSION['user']['uid']."&pass=".$_SESSION['user']['pass']."&key=".$_SESSION['user']['key']);
	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($cSession,CURLOPT_HEADER, false); 
	$result=curl_exec($cSession);
	curl_close($cSession);
	$users = json_decode($result, true);

	//echo '<pre>';
	//print_r($users);
    //die;

?>
<div class="col-md-12 marginTop3">
	<div class="col-md-12">
		<form class="form-inline">
			<div class="col-md-2">
				<div class="form-group">
					<label for="email">Disabled:</label>
					<select class="form-control" id="disable">
						<option>Hide</option>
						<option>Unhide</option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="email">Accounts:</label>
					<select class="form-control" id="accounts">
						<option>All</option>
						<option>Personal</option>
						<option>Business</option>
					</select>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-12">
		<table class="table table-striped table-bordered" id="myTable2">
			<thead>
				<tr>
					<td>Ad Account Name</td>
					<td>Reference</td>
					<td>Email</td>
					<td>FB Password</td>
					<td>Online</td>
					<td>Status</td>
					<td>Payment Method</td>
					<td>Timezone</td>
					<td>Pixel Id</td>
					<td>TSpend</td>
					<td>LSpend</td>
					<td>Type</td>
					<td>Account Id</td>
					<td>Payment</td>
					<td>Comment</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($users['response'] as $key => $user) : 
					$get = $db->query("SELECT * FROM fb_user_details WHERE user_id = '".$user['nsp_account_id']."' ");
					$data = $get->fetch_assoc();
				?>
				<tr data-disable="<?php if($user['ad_account_info']['account_status'] == 2 ) { echo 'Hide';} else { echo 'Unhide';}?>" data-accounts="<?php if($user['ad_account_info']['business']) { echo "Business"; } else { echo "Personal"; } ?>">
					<td>
						<a target="_blank" href="new-editor.php?act=<?php echo $user['ad_account_info']['id'];?>&email-id=<?php echo $user['facebook_details']['facebook_email'];?>&code=<?php echo $user['access_token'];?>"><?php echo $user['ad_account_info']['name']; ?></a>
					</td>
					<td><a class="add-reference" data-toggle="modal" data-target="#add-reference" data-accountid="<?php echo $user['nsp_account_id'];?>" data-reference="<?php echo $data['reference'];?>"><?php if($data['reference'] == '') : ?>Add reference <?php else : echo $data['reference']; endif; ?> </a> </td>
					<td class="fb_email"><?php echo $user['facebook_details']['facebook_email']; ?></td>
					<td><?php echo $user['facebook_details']['facebook_password']; ?></td>
					<td>
						<?php if($user['is_online'] == 1): ?>
							<span class="glyphicon glyphicon-ok-circle" style="color:green"></span>
						<?php else : ?>
							<span class="glyphicon glyphicon-remove-circle" style="color:crimson"></span>
						<?php endif ?>
					</td>
					<td>
						<code>
							<?php if($user['ad_account_info']['account_status'] == 1) { echo $user['ad_account_info']['account_status']."/ ACTIVE"; } 
							else if($user['ad_account_info']['account_status'] == 2) { echo '<a data-toggle="modal" data-target="#myModal" data-reason="'.$user['ad_account_info']['disable_reason'].'">'.$user['ad_account_info']['account_status']."/ DISABLED".'</a>'; } 
							else if($user['ad_account_info']['account_status'] == 3) { echo $user['ad_account_info']['account_status']."/ UNSETTLED"; } 
							else if($user['ad_account_info']['account_status'] == 7) { echo $user['ad_account_info']['account_status']."/ PENDING_RISK_REVIEW"; } 
							else if($user['ad_account_info']['account_status'] == 9) { echo $user['ad_account_info']['account_status']."/ IN_GRACE_PERIOD"; } 
							else if($user['ad_account_info']['account_status'] == 9) { echo $user['ad_account_info']['account_status']."/ IN_GRACE_PERIOD"; } 
							else if($user['ad_account_info']['account_status'] == 100) { echo $user['ad_account_info']['account_status']."/ PENDING_CLOSURE"; } 
							else if($user['ad_account_info']['account_status'] == 101) { echo $user['ad_account_info']['account_status']."/ CLOSED"; } 
							else if($user['ad_account_info']['account_status'] == 102) { echo $user['ad_account_info']['account_status']."/ PENDING_SETTLEMENT"; } 
							else if($user['ad_account_info']['account_status'] == 201) { echo $user['ad_account_info']['account_status']."/ ANY_ACTIVE"; } 
							else if($user['ad_account_info']['account_status'] == 202) { echo $user['ad_account_info']['account_status']."/ ANY_CLOSED"; } 
							?>
						</code>
					</td>
					<td><?php if($user['ad_account_info']['funding_source_details']['display_string'] != '') { echo $user['ad_account_info']['funding_source_details']['display_string']; }  else { echo "none"; };?></td>
					<td><?php echo $user['ad_account_info']['timezone_name']; ?></td>
					<td>						
						<?php 
						$cSession = curl_init(); 
						curl_setopt($cSession,CURLOPT_URL,"https://graph.facebook.com/v2.10/".$user['ad_account_info']['id']."/adspixels?access_token=".$user['access_token']);
						curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
						curl_setopt($cSession,CURLOPT_HEADER, false); 
						$result=curl_exec($cSession);
						curl_close($cSession);
						$pixel_id = json_decode($result, true);
						if($pixel_id['data'][0]['id'] == '') { echo 'none'; } else { echo $pixel_id['data'][0]['id']; }
						?>
					</td>
					<td></td>
					<td>$<?php $lspend = $user['ad_account_info']['amount_spent']/100; echo number_format($lspend,2);?></td>
					<td><?php if($user['ad_account_info']['business']) { echo "Business"; } else { echo "Personal"; } ?></td>
					<td><?php echo $user['ad_account_info']['id']; ?></td>
					<td><a data-toggle="modal" data-target="#credit_card">Add a credit card</a></td>
					<td align="center"><span class="btn postcomment" data-toggle="modal" data-target="#comment" data-userid="<?php echo $user['nsp_account_id'];?>" data-comment="<?php echo $data['comment'];?>"><?php if($data['comment'] == '') : ?><i class="fa fa-comment-o" aria-hidden="true"></i><?php else :?> <i class="fa fa-comment" aria-hidden="true"></i> <?php endif;?> </span></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Disable Reason</h4>
			</div>
			<div class="modal-body">
				<p>Some text in the modal.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div id="comment" class="modal fade" role="dialog">
	<form method="post">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Comment</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="user_id">
					<textarea rows="5" cols="78" style="resize: none;" id="msg" class="form-control"></textarea>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary save-comment">Save</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</form>
</div>

<div id="add-reference" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Refernce</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" class="form-control" id="userid">
				<input type="text" class="form-control" id="reference">
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary save-reference">Save</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div id="credit_card" class="modal fade" role="dialog">
	<form method="post">
		<div class="modal-dialog">
			<div class="modal-content">
				
				<div class="modal-body">
					<div class="col-md-12">
						<div class="form-group">
							<label  for="card_number">Card number:</label>
							<input type="text" class="form-control" id="card_number" placeholder="111111111111111" required>
						</div>
					</div>
					<div class="col-md-12 padding0">
						<div class="col-md-6">
							<div class="form-group">
								<label  for="exp_month">Expiration month:</label>
								<input type="text" class="form-control" id="exp_month" placeholder="MM" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label  for="exp_year">Expiration year:</label>
								<input type="text" class="form-control" id="exp_year" placeholder="YY" required>
							</div>
						</div>
					</div>
					<div class="col-md-12 padding0">
						<div class="col-md-6">
							<div class="form-group">
								<label  for="cvv">CVV Code:</label>
								<input type="text" class="form-control" id="cvv" placeholder="123" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label  for="exp_year">Zipcode:</label>
								<input type="text" class="form-control" id="exp_year" placeholder="" required>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<button class="btn btn-success col-md-12">Apply Payment Method</button>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</form>
</div>
<style type="text/css">
	#myTable2 td input { height: 30px; }
	#credit_card .modal-body { display: inline-block; }
	#credit_card .padding0 { padding:0px; }
	#credit_card .modal-content, #credit_card .form-control { border-radius: 0px; }
	#credit_card .form-control { padding: 6px; }
	#credit_card .btn-success { border-radius: 0px; padding: 10px; }
	#add-reference .modal-content { margin-top: 20%; }
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('#myTable2').DataTable({
			"paging": true,
			"lengthChange": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"pageLength": 15,
			"order": [[ 0, "desc" ]]
		});
		var table = $('#myTable2').DataTable();
		jQuery('#disable').change(function(){
			var value = jQuery(this).val();
			$.fn.dataTable.ext.search.pop();
			$.fn.dataTable.ext.search.push(
				function(settings, data, dataIndex) {
					if(value == 'Hide') {
						return $(table.row(dataIndex).node()).attr('data-disable') != value;
					} else {
						return $(table.row(dataIndex).node()).attr('data-disable') != '';
					}
				}
				);
			table.draw();
		});

		jQuery('#accounts').change(function(){
			var value = jQuery(this).val();
			$.fn.dataTable.ext.search.pop();
			$.fn.dataTable.ext.search.push(
				function(settings, data, dataIndex) {
					if(value == 'All') {
						return $(table.row(dataIndex).node()).attr('data-accounts') != value;
					} else {
						return $(table.row(dataIndex).node()).attr('data-accounts') == value;
					}
				}
				);
			table.draw();
		});
	});
</script>
<?php else : header('location:index.php');  endif ?>
