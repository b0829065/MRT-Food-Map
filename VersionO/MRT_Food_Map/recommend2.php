<?php 
	session_start();
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	$State = $_COOKIE['LoginState'];
	$UserName = $_COOKIE['UserName'];
    $PageCount = $_COOKIE['PageCount'];

	if(!$State){
		echo "<script>alert('請先登入！');</script>";
        header("refresh:0;url = index.php");
	}
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
	
	$CityState = $_GET["City"];
	$DistrictState = $_GET["District"];

    if($PageCount == 0){
        $FoodType = @$_POST["FoodType"];
        setcookie("FoodType", $FoodType, time()+3600);
        $RestaurantName = @$_POST["RestaurantName"];
        setcookie("RestaurantName", $RestaurantName, time()+3600);
        $RestaurantBranch = @$_POST["RestaurantBranch"];
        setcookie("RestaurantBranch", $RestaurantBranch, time()+3600);
        $Phone = @$_POST["Phone"];
        setcookie("Phone", $Phone, time()+3600);
        $MenuUrl = @$_POST["MenuUrl"];
        setcookie("MenuUrl", $MenuUrl, time()+3600);
        $Station = @$_POST["Station"];
        setcookie("Station", $Station, time()+3600);

        $StationID = '';

        $sqlStation = "SELECT * FROM `MRTStation` WHERE `StationName`='$Station'";
        $resultStation = $connect->query($sqlStation);
        if ($resultStation->num_rows > 0) {
            while ($rowStation = $resultStation->fetch_assoc()){
                $StationID = $rowStation['StationID'];
            }
        }
        setcookie("StationID", $StationID, time()+3600);
    }
   
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>MRT Food Map Recommend</title>
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
									<li><a class="icon solid fa-thumbs-up" href="recommend.php"><span>推薦餐廳</span></a></li>
									<li><a class="icon solid fa-retweet" href="right-sidebar.html"><span>Right Sidebar</span></a></li>
									<li><a class="icon solid fa-sitemap" href="no-sidebar.html"><span>No Sidebar</span></a></li>
								</ul>
							</nav>

					<!--register-->


					<header>
						<h1><strong>美食推薦</strong></h1>
					</header>
					<br>
					<div class=container>
						<form name="recommend" method="post" action="RecommendAdd.php">
						    <section>
								<p>餐廳地址</p>
								<div class="col-6 col-12-small">
									<center> <!--php-->
										<select name="city-list" onchange="changeDistrict(this)" style="width:350px;">
											<option value='' >縣市</option>
									    <?php
											$sqlCity = "SELECT * FROM `City`";
											$resultCity = $connect->query($sqlCity);
											
											if ($resultCity->num_rows > 0) {
												$CityChoose = '';
												while ($rowCity = $resultCity->fetch_assoc()){
													$CityID = $rowCity['CityID'];
													$City = $rowCity['City'];
													if($CityState == $CityID){
														$CityChoose = 'selected';
													}
													else{
														$CityChoose = '';
													}
													echo"<option value='$CityID' $CityChoose >$City</option>";
												}
											}
										?>
										</select>
									</center>
								</div><br>
								<div class="col-6 col-12-small">
									<center> <!--php-->
										<select name="district-list" onchange="changeRoad(this)" style="width:350px;"required>
                                            <option value='' >行政區</option>
									    <?php
											$sqlDistrict = "SELECT * FROM `District` NATURAL JOIN `CityDistrict` WHERE `CityID`= '$CityState'";
											$resultDistrict = $connect->query($sqlDistrict);
																
											if ($resultDistrict->num_rows > 0) {
												while ($rowDistrict = $resultDistrict->fetch_assoc()){
													$DistrictID = $rowDistrict['DistrictID'];
													$District = $rowDistrict['District'];
													if($DistrictState == $DistrictID){
														$DistrictChoose = 'selected';
													}
													else{
														$DistrictChoose = '';
													}

													echo"<option value='$DistrictID$CityState' $DistrictChoose>$District</option>";
												}
											}
										?>
										</select>
									</center>
								</div><br>
								
								<div class="col-6 col-12-small">
									<center> <!--php-->
										<select name="road-list" style="width:350px;" required>
                                        <option value='' >路</option>
									    <?php
											$sqlRoad = "SELECT * FROM `DistrictRoad` WHERE `DistrictID`= '$DistrictState'";
											$resultRoad = $connect->query($sqlRoad);
																
											if ($resultRoad->num_rows > 0) {
												while ($rowRoad = $resultRoad->fetch_assoc()){
													$RoadID = $rowRoad['DistrictRoadID'];
													$Road = $rowRoad['Road'];

													echo"<option value='$RoadID'>$Road</option>";
												}
											}
										?>
										</select>
									</center>
								</div><br>	
								
								<div class="col-6 col-12-small">
									<center> <!--php-->
										<select name="section" style="width:350px;">
											<option value='none'>路段</option>
											<option value='一'>一段</option>
											<option value='二'>二段</option>
											<option value='三'>三段</option>
											<option value='四'>四段</option>
											<option value='五'>五段</option>
											<option value='六'>六段</option>
											<option value='七'>七段</option>
											<option value='八'>八段</option>
											<option value='九'>九段</option>
											<option value='十'>十段</option>
										</select>
									</center>
								</div><br>
								<div class="col-6 col-12-small">
									<center> <!--php-->
									<input name="Ln" oninput="value=value.replace(/[^\d]/g,'')" placeholder="巷" type="text" style="width:350px;" /><br>
									<input name="Aly" oninput="value=value.replace(/[^\d]/g,'')" placeholder="弄" type="text" style="width:350px;" /><br>
									<input name="No" placeholder="號	Ex: 398之1" type="text" style="width:350px;" required/><br>
									<input name="F" oninput="value=value.replace(/[^\d]/g,'')" placeholder="樓層" type="text" style="width:350px;" /><br>
									<input name="Rm" oninput="value=value.replace(/[^\d]/g,'')" placeholder="室" type="text" style="width:350px;" /><br>
									
									</center>
								</div>
                                            
							<!--php-->
                            
							<center><input type="submit" class="button"></input></center>
                            </section>
                            

						</form>

						<script type="text/javascript">
							
							function changeDistrict(selectObject){
								var CityNum = selectObject.value;
								var Url = "recommend2.php?City="+CityNum;
                                document.cookie = 'PageCount=2';
								this.location = Url;
								
							}
							function changeRoad(selectObject){
								var DistrictNum = selectObject.value;
								var District = DistrictNum.substr(0, 3);
								var City = DistrictNum.substr(3, 2);
								var Url = "recommend2.php?City="+City+"&District="+District;
								document.cookie = 'PageCount=2';
								this.location = Url;
							}	
						</script>
						
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
	</body>
</html>