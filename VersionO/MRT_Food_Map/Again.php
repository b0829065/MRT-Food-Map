<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	session_start();
	$State = $_COOKIE['LoginState'];
	$UserName = $_COOKIE['UserName'];
    $RestaurantID = $_COOKIE['RestaurantID'];
	//echo $State;
	//echo "<br>";

	//echo $UserName;

	// 建立MySQL的資料庫連接 
	$host = 'localhost';
	//改成你登入phpmyadmin帳號
	$user = 'root';
	//改成你登入phpmyadmin密碼
	$passwd = '';
	//資料庫名稱
	$database = 'FoodMap';
	//實例化mysqli(資料庫路徑, 登入帳號, 登入密碼, 資料庫)
	$connect = new mysqli($host, $user, $passwd, $database);
	//設定連線編碼，防止中文字亂碼
	$connect->query("SET NAMES 'utf8'");

	if ($connect->connect_error) {
		die("連線失敗: " . $connect->connect_error);
	}
	//echo "連線成功";
	//echo "<br>";

	$Log = '登入';
	$LogHtml = 'login.html';
	if($State){
		$Log = '登出';
		$LogHtml = 'Logout.php';
	}

?>

<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>MRT Food Map</title>

		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header">
					<div class="container">
						<!-- Nav -->
                        <nav id="nav">
							<ul>
								<li><a class="icon solid fa-home" href="index.php"><span>首頁</span></a></li>
								<li>
									<a href="#" class="icon fa-map"><span>我的地圖</span></a>
									<ul>
										<li><a href="#">熱門地圖</a></li>
										<li><a href="#">我的地圖</a></li>
									</ul>
								</li>
								<li><a class="icon solid fa-thumbs-up" href="left-sidebar.html"><span>推薦餐廳</span></a></li>
								<li><a class="icon solid fa-retweet" href="right-sidebar.html"><span>Right Sidebar</span></a></li>
								<li><a class="icon solid fa-sitemap" href="no-sidebar.html"><span>No Sidebar</span></a></li>
							</ul>
						</nav>

						<!--login-->
						<header>
							<h1><strong>您選的餐廳非常熱門</strong></h1>
                            <br>
                            <h2>已經有相同的餐廳囉！</h2>
						</header>
						<br>
						
                        <section>
                            <?php
                                $sqlR = "SELECT * FROM `Restaurant` WHERE `RestaurantID` = '$RestaurantID'";
                                $resultR = $connect->query($sqlR);

                                if ($resultR->num_rows > 0) {
                                    while ($rowR = $resultR->fetch_assoc())
                                    {
                                        $Url = $rowR['MenuURL'];
                                        echo "<img src='$Url' alt='' />";

                                        $Name = $rowR['RestaurantName'];
                                        echo "<br><br><h2>$Name</h2>";

                                        $Branch = $rowR['BranchName'];
                                        if($Branch){
                                            echo "<span style='font-size: 30px;'>$Branch 店</span>";
                                        }

                                        $StationID = $rowR['StationID'];
                                        $sqlStation = "SELECT * FROM `MRTStation` WHERE `StationID`='$StationID'";
                                        $resultStation = $connect->query($sqlStation);
                                        if ($resultStation->num_rows > 0) {
                                            while ($rowStation = $resultStation->fetch_assoc()){
                                                $Station = $rowStation['StationName'];
                                            }
                                        }
                                        echo "<p style='font-size: 30px;line-height:10px'>Location: $Station";
                                        echo "站</p>";

                                        $Tel = $rowR['Phone'];
                                        echo "<p style='font-size: 30px;line-height:10px'>Phone: $Tel</p>";

                                        echo "<span style='font-size: 30px;line-height:10px'>";
                                        $RoadID = $rowR['DistrictRoadID'];
                                        $sqlDistrict = "SELECT * FROM `District` NATURAL JOIN `CityDistrict` NATURAL JOIN `DistrictRoad` NATURAL JOIN `City` WHERE `DistrictRoadID`= '$RoadID'";
										$resultDistrict = $connect->query($sqlDistrict);
																
										if ($resultDistrict->num_rows > 0) {
											while ($rowDistrict = $resultDistrict->fetch_assoc()){
                                                $City = $rowDistrict['City'];
                                                $District = $rowDistrict['District'];
                                                $Road = $rowDistrict['Road'];
                                                echo "<p>$City$District$Road";
                                            }
                                        
                                        }
                                        $Sec = $rowR['Sec'];
                                        if($Sec){
                                            echo "$Sec";
                                            echo "段";
                                        }
                                        $Ln = $rowR['Ln'];
                                        if($Ln){
                                            echo "$Ln";
                                            echo "巷";
                                        }
                                        $Aly = $rowR['Aly'];
                                        if($Ln){
                                            echo "$Aly";
                                            echo "弄";
                                        }
                                        $No = $rowR['No'];
                                        if($Ln){
                                            echo "$No";
                                            echo "號";
                                        }
                                        $F = $rowR['F'];
                                        if($F){
                                            echo "$F";
                                            echo "樓";
                                        }
                                        $Rm = $rowR['Rm'];
                                        if($Rm){
                                            echo "$Rm";
                                            echo "室";
                                        }
                                        echo "<p></span>";
                                    }
                                }
                            ?>
                            <a href="index.php" class="button" onclick="alertFunction()">好吧</a>
                        </section>
					</div>
				</section>

            <!-- Footer -->
			<section>			
				<div id="copyright" class="container">
					<ul class="links">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</section>
            <script type="text/javascript">
							
							function alertFunction(){
								alert("謝謝您的推薦！");
							}
							
						</script>


		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>