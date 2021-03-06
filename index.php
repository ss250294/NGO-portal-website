<?php
//MySQL Database Connect
include 'connect.php';
include 'database.php';
		
?>
<!DOCTYPE HTML>

<html lang="en">
	<?php
 		include 'head.php'
	?>
	
	<body>
	<?php
		include 'header.php';

		if(isset($_SESSION['JUST_SIGNEDUP'])){
			?> 
			<div class="alert alert-warning alert-dismissable" style="display: table; margin: 0 auto; margin-top:-60px;" >
	  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  			<h2>To activate your account please click on activation link sent to your email</h2>
			</div>
			<?php
			unset($_SESSION['JUST_SIGNEDUP']);
		}

		if(isset($_SESSION['DONOR_NEW_PASS_LINK_SENT'])){
			?> 
			<div class="alert alert-warning alert-dismissable" style="display: table; margin: 0 auto; margin-top:-60px;" >
	  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  			<h2>Password reset instructions have been sent to your Email Address</h2>
			</div>
			<?php
			unset($_SESSION['DONOR_NEW_PASS_LINK_SENT']);
		}

		if(isset($_SESSION['DONOR_NEW_PASS_LINK_NOT_SENT'])){
			?> 
			<div class="alert alert-warning alert-dismissable" style="display: table; margin: 0 auto; margin-top:-60px;" >
	  			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  			<h2>Password reset instructions could not be sent to specified email</h2>
			</div>
			<?php
			unset($_SESSION['DONOR_NEW_PASS_LINK_NOT_SENT']);
		}
		if(isset($_GET['vcode']) && isset($_GET['demail'])){
			$queryEmail = "SELECT verified_Donor FROM Donor WHERE email='".$_GET['demail']."'";
			$resultQueryEmail = mysql_query($queryEmail);
			if ($row = mysql_fetch_assoc($resultQueryEmail)) {
				if($row['verified_Donor'] == $_GET['vcode']){
					$insertCode = "UPDATE Donor SET verified_Donor = '1' WHERE email='".$_GET['demail']."'";
					$resultInsert = mysql_query($insertCode);
					$justInserted = true;
					?>
					<div class="alert alert-warning alert-dismissable" style="display: table; margin: 0 auto; margin-top:-60px;" >
	  					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  					<h2>Congratulations! You have successfully registered as Social Worker to our website </h2>
					</div>
					<?php
				}elseif ($row['verified_Donor'] == '1') {
					$alreadyInserted = true;
					?>
					<div class="alert alert-warning alert-dismissable" style="display: table; margin: 0 auto; margin-top:-60px;" >
	  					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  					<h2> You have already registered as Social Worker to our website </h2>
					</div>
					<?php
				}else{
					$linkChanged = true;
					header("location: error.php");
				}
			}else{
				$linkChanged = true;
				header("location: error.php");
			}
		}elseif(isset($_GET['vcode']) && isset($_GET['nemail'])){
			$queryEmail = "SELECT verified_Ngo FROM Ngo WHERE email='".$_GET['nemail']."'";
			$resultQueryEmail = mysql_query($queryEmail);
			if ($row = mysql_fetch_assoc($resultQueryEmail)) {
				if($row['verified_Ngo'] == $_GET['vcode']){
					$insertCode = "UPDATE Ngo SET verified_Ngo = '1' WHERE email='".$_GET['nemail']."'";
					$resultInsert = mysql_query($insertCode);
					$justInserted = true;
					?> 
					<div class="alert alert-warning alert-dismissable" style="display: table; margin: 0 auto; margin-top:-60px;" >
	  					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  					<h2> Congratulations! You have successfully registered as NGO to our website </h2>
					</div>
					<?php
				}elseif ($row['verified_Ngo'] == '1') {
					$alreadyInserted = true;
					?> 
					<div class="alert alert-warning alert-dismissable" style="display: table; margin: 0 auto; margin-top:-60px;" >
	  					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  					<h2> You have already registered as NGO to our website </h2>
					</div>
					<?php
				}else{
					$linkChanged = true;
					header("location: error.php");
				}
			}else{
				$linkChanged = true;
				header("location: error.php");
			}
		}
	?>

		<div class="backimage" style="margin-left:20px; margin-right:15px; margin-top:0px">
			<div id="wowslider-container1" style="margin-top:40px;">
				<div class="ws_images"><ul>
					<li><img src="img/slider_images/images/pic102.jpg" alt="pic102" title="" id="wows1_0"/></li>
					<li><img src="img/slider_images/images/pic103.jpg" alt="pic103" title="" id="wows1_1"/></li>
					<li><img src="img/slider_images/images/pic104.jpg" alt="pic104" title="" id="wows1_2"/></li>
					<li><img src="img/slider_images/images/pic105.jpg" alt="pic105" title="" id="wows1_3"/></li>
					<li><img src="img/slider_images/images/pic106.jpg" alt="pic106" title="" id="wows1_4"/></li>
					<li><img src="img/slider_images/images/pic107.jpg" alt="pic107" title="" id="wows1_5"/></li>
					<li><img src="img/slider_images/images/pic108.jpg" alt="pic108" title="" id="wows1_6"/></li>
					<li><img src="img/slider_images/images/coname.jpg" alt="co-name" title="" id="wows1_7"/></li>
					</ul>
				</div>
				<div class="ws_bullets"><div>
					<a href="#" title="pic102"><img src="img/slider_images/tooltips/pic102.jpg" alt="pic102"/>1</a>
					<a href="#" title="pic103"><img src="img/slider_images/tooltips/pic103.jpg" alt="pic103"/>2</a>
					<a href="#" title="pic104"><img src="img/slider_images/tooltips/pic104.jpg" alt="pic104"/>3</a>
					<a href="#" title="pic105"><img src="img/slider_images/tooltips/pic105.jpg" alt="pic105"/>4</a>
					<a href="#" title="pic106"><img src="img/slider_images/tooltips/pic106.jpg" alt="pic106"/>5</a>
					<a href="#" title="pic107"><img src="img/slider_images/tooltips/pic107.jpg" alt="pic107"/>6</a>
					<a href="#" title="pic108"><img src="img/slider_images/tooltips/pic108.jpg" alt="pic108"/>7</a>
					<a href="#" title="co-name"><img src="img/slider_images/tooltips/coname.jpg" alt="co-name"/>8</a>
					</div>
				</div>
				
				<a href="#" class="ws_frame"></a>
					<div class="ws_shadow"></div>
					</div>
						<script type="text/javascript" src="engine/wowslider.js"></script>
						<script type="text/javascript" src="engine/script.js"></script>

						<script type="text/javascript">
						if(<?= isset($_SESSION['LOGIN_DONOR_ERRMSG_ARR']) ?>){
							$('#signinModal').modal('show');
							hideAll(); $('#signinModalContent').show(); $('#signinDonor').show();
							$('#donorTab a').tab('show');
							<?php unset($_SESSION['LOGIN_DONOR_ERRMSG_ARR']);  ?>
						}
						</script>

						<script type="text/javascript">
						if(<?= isset($_SESSION['LOGIN_NGO_ERRMSG_ARR']) ?>){
							$('#signinModal').modal('show');
							hideAll(); $('#signinModalContent').show(); $('#signinNgo').show();
							$('#ngoTab a').tab('show');
							<?php unset($_SESSION['LOGIN_NGO_ERRMSG_ARR']);  ?>
						}
						</script>
				<div >
					
					<div class="DetailBoxes">
						<div class="pin" style="min-width: 450px; width: auto; margin-left:50px; margin-top:15px;"  >
							<div >
								<h4><font color="black" size="3" face="verdana" >Welcome to Sampark</font></h4>
							</div>
							<p style="width: 450px" ><font size="2" face="verdana"> Browse for socially working organizations. </font></p>
							<p style="width: 450px" ><font size="2" face="verdana">Favourite/Follow the organizations you're interested in.</font></p>
							<p style="width: 450px" ><font size="2" face="verdana">Connect with the organizations. Rate organizations.</font></p>
						</div>
					</div>
					
					<div class="DetailBoxes">
						<div class="pin" style="min-width: 450px; width: auto; margin-left:50px; margin-top:-15px;">
							<div >
								<h4><font color="black"><font size="3" face="verdana">About This Site</font></h4>
							</div>
							<div >
							<p style="width: 450px" ><font size="2" face="verdana"> Hey! We provide a platform for willing contributors to connect to socially working non-profit organizations. The current scenario is that the bigger, or the more profound organizations attract willing donors with a greater propensity as compared to smaller ones.
							<em>Sampark</em> is an attempt to bring these organizations at the same level of accessibility. From the perspective of users, it only aims to increase the ease of usage. Sampark is the ideal platform for you to come online, and look for appropriate organizations which you would be willing to contribute to.</font></p>
				
							</div>
							
						</div>
					</div>
				</div>
			</div>
	</body>
</html>
<?php
		include 'footer.php'; 
?> 
