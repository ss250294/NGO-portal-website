<?php 
	//Start session
	session_start();

	include 'connect.php';
    include 'header.php';

    $searchQuery = $_POST['searchQuery'];

    $sqlQuery = "SELECT * FROM Ngo WHERE  name LIKE('%$searchQuery%') or address LIKE('%$searchQuery%')";
    $result = mysql_query($sqlQuery);

?>

<div  class="wrapper">
	<div  class="columns">

		<?php 
			if($result) {
				// setting this variable to pass check in authontication in auth.php and ngohome.php
				$_SESSION['search'] = "true";
				
				if(mysql_num_rows($result) > 0) {
					while ($row = mysql_fetch_assoc($result)) {
						$pid = $row['pid'];
						$nameNgo = $row['name'];
						$logoUrl = $row['logo'];
						$descNgo = substr($row['description'],0,150)."...";
						//echo " ".$nameNgo.$logoUrl.$descNgo;

							?>
							<form action="ngohome.php" method="post" enctype="multipart/form-data">
								<div class="pin">
									<input type="hidden" name="ngoPid" value=" <?php echo $pid ?>">
									<img src="<?php echo $logoUrl ?>" />
									<input type="submit" value="<?php echo $nameNgo ?>" style="width: 200px;" onClick="ClearAll();" >
									<p><?php echo $descNgo ?></p>
								</div>
							</form>
						<?php
					}  
				}
			}else {
				echo "No event posted so far";
			}
		?>
		
	</div>
</div>