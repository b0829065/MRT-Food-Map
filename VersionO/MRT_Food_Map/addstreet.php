<?php 
	session_start();
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	$State = $_COOKIE['LoginState'];
	$UserName = $_COOKIE['UserName'];

	if(!$State or $UserName != 'root'){
		echo "<script>alert('Bye！');</script>";
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
?>

<!DOCTYPE html>
<html>
	<head>
		<title>administrator/add steet</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">
			<!-- admin -->
			<section id="header">
				<div class="container">
					<!-- Nav -->
					<nav id="nav">
						<ul>
							<li><a class="icon solid fa-home" href="index.html"><span>首頁</span></a></li>
							<li><a href="#" class="icon fa-chart-bar"><span>Dropdown</span></a>
								<ul>
									<li><a href="#">Lorem ipsum dolor</a></li>
									<li><a href="#">Magna phasellus</a></li>
									<li><a href="#">Etiam dolore nisl</a></li>
									<li><a href="#">Phasellus consequat</a>
										<ul>
											<li><a href="#">Magna phasellus</a></li>
											<li><a href="#">Etiam dolore nisl</a></li>
											<li><a href="#">Phasellus consequat</a></li>
										</ul>
									</li>
									<li><a href="#">Veroeros feugiat</a></li>
								</ul>
							</li>
							<li><a class="icon solid fa-cog" href="left-sidebar.html"><span>Left Sidebar</span></a></li>
							<li><a class="icon solid fa-retweet" href="right-sidebar.html"><span>Right Sidebar</span></a></li>
							<li><a class="icon solid fa-sitemap" href="no-sidebar.html"><span>No Sidebar</span></a></li>
						</ul>
					</nav>
					<!-- administrator -->
					<header>
						<h1><a href="administrator.html"><span>管理者介面</span></a></h1>
					<br /><br /><br />
					</header>
					<div class="panel-body">
						<div class="col-6 col-12-small">
							<div class="panel panel-primary">
								<h2>街道新增/刪除</h2>
								
								<form action="StreetAction.php" method="post">
                                    <section>
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
										<p>新增/修改  路名</p>
										<div class="col-6 col-12-small">
											<center><input name="Road" placeholder="路名" type="text" style="width:350px;"/></center>
											<input type='hidden' name='DistrictID' value='<?php echo $DistrictState ?>' />
										</div>
										<br><br>
									<span>
										<input type="button" onclick="changeAction(this)" class="button" value="新增"/>
										<input type="button" onclick="changeAction(this)" class="button" value="修改"/>
										<input type="button" onclick="changeAction(this)" class="button" value="刪除"/>
										<!--<input type="button" onclick="GetAction()" class="button" value="查看"/>-->
										<input type="hidden" id="myField" name="myField" value="" />
									</span>	
									<br><br><br>
                                    <input type="submit" class="button" />
								</section>
                                </form>
								<script type="text/javascript">
							
									function changeDistrict(selectObject){
										var CityNum = selectObject.value;
										var Url = "addstreet.php?City="+CityNum;
										document.cookie = 'PageCount=2';
										this.location = Url;
										
									}
									function changeRoad(selectObject){
										var DistrictNum = selectObject.value;
										var District = DistrictNum.substr(0, 3);
										var City = DistrictNum.substr(3, 2);
										var Url = "addstreet.php?City="+City+"&District="+District;
										document.cookie = 'PageCount=2';
										this.location = Url;
									}
									var action;
									function changeAction(selectObject){
										action = selectObject.value;
										document.getElementById('myField').value = action;
									}
									function GetAction(){
										alert(document.getElementById('myField').value);
									}
								</script>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</body>
</html>