<?php
include 'header.php';
if(isset($_REQUEST['Login'])) {
	$fetch = $db->query("SELECT * FROM users WHERE email = '".$_REQUEST['Username']."' AND password = '".$_REQUEST['Password']."'");
	if($fetch->num_rows > 0) {
		$_SESSION['user'] = $fetch->fetch_assoc();
		header('location:accounts.php');
	} else {
		$_SESSION['alert'] = 'Please enter valid credentials';
	} 
} 

?>
<div class = "container">
	<div class="wrapper">
		<form action="" method="post" name="Login_Form" class="form-signin">       
		    <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
			  <hr class="colorgraph"><br>
			  <?php if(isset($_SESSION['alert'])) : ?> <div style="color: red;"><?php echo $_SESSION['alert']; unset($_SESSION['alert']);?></div> <?php endif ?>
			  <input type="email" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
			  <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>     		  
			  <button class="btn btn-lg btn-primary btn-block"  name="Login" value="Login" type="Submit">Login</button>  			
		</form>			
	</div>
</div>
