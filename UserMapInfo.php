<?php
	function road($resultRoad,$content){
		while ($rowDistrict = $resultRoad->fetch_assoc()){
			$City = $rowDistrict['City'];
			$District = $rowDistrict['District'];
			$Road = $rowDistrict['Road'];
			echo "<p>$City$District$Road";
		}
		$Sec = $content['Sec'];
		if($Sec){
			echo "$Sec";
			echo "段";
		}
		$Ln = $content['Ln'];
		if($Ln){
			echo "$Ln";
			echo "巷";
		}
		$Aly = $content['Aly'];
		if($Ln){
			echo "$Aly";
			echo "弄";
		}
		$No = $content['No'];
		if($Ln){
			echo "$No";
			echo "號";
		}
		$F = $content['F'];
		if($F){
			echo "$F";
			echo "樓";
		}
		$Rm = $content['Rm'];
		if($Rm){
			echo "$Rm";
			echo "室";
		}
		echo "</p>";
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Left Sidebar - Strongly Typed by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">
			<!-- Header -->
				<section id="header">
					<div class="container">
							<?php						
								$temp1 = $_GET['StationID'];
								$connect = new mysqli( "localhost", "root", "0000", "foodmap");
        						$connect->query("SET NAMES 'utf8'");
        						if ($connect->connect_error) {
            						die("連線失敗: " . $connect->connect_error);
        						}
								$instr = "SELECT StationName FROM mrtstation WHERE StationID=".json_encode($temp1);
       							$resultS = $connect->query($instr);
								$row = mysqli_num_rows($resultS);
								while($station = $resultS->fetch_assoc()) {
									$StationName=$station['StationName'];
									echo "<h1 id=\"logo\" ><a href=\"UserMap.php\">".$StationName."站</a></h1>";
								}
							?>
						<!-- Nav -->

					</div>
				</section>

			<!-- Main -->
				<section id="main">
					<div class="container">
						<?php
							$GLOBALS['db_src']="foodmap";
							include("connect.php"); 
							$temp = $_GET['StationID'];
							$state = $_COOKIE['LoginState'];
							$account = $_COOKIE['UserName'];
							$sql = "SELECT * FROM  memberpressadd NATURAL JOIN restaurant WHERE StationID=".json_encode($temp)." and Account=".json_encode($account);
							$result = sql($sql);
							$row = mysqli_num_rows($result);
							echo "<div id=\"sidebar\" class=\"col-4 col-12-medium\">
									<section>
										<ul class=\"divided\">";
							if($row>0){
								$i=0;
								while($content = $result->fetch_assoc()) {
									$RestaurantName = $content['RestaurantName'];
									$Phone = $content['Phone'];
									$MenuURL = $content['MenuURL'];
									$RoadID = $content['DistrictRoadID'];
									$RestaurantID = $content['RestaurantID'];
									$sqlRoad = "SELECT * FROM `District` NATURAL JOIN `CityDistrict` NATURAL JOIN `DistrictRoad` NATURAL JOIN `City` WHERE `DistrictRoadID`= '$RoadID'";
									$resultRoad = sql($sqlRoad);
									echo "<li>
											<article class=\"box excerpt\">
												<header>
													<span class=\"date\">$RestaurantName</span>
													<h3>地址:";
										road($resultRoad,$content);
										echo 		"</h3>
													<h3>電話: $Phone</h3>
													<h3>菜單: </h3>
													<img src=\"$MenuURL\">
												</header>
												</article>
											</li>";

								}
								echo "</ul></section></div>";
							}
							else{
								echo	"<li>
											<article class=\"box excerpt\">
												<h3>此站目前無資料</h3>
											</article>
										</li>";
								
							}
						?>
					</div>
				</section>

				<section id="features">
					<div class="container">
						<div class="col-12">
							<ul class="actions">
								<li><a href="UserMap.php" class="button">返回</a></li>
							</ul>
						</div>
					</div>
				</section>



			<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
		</div>
	</body>
</html>