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
								<h2>餐廳新增/刪除</h2>
								<form action="RestaurantAction.php" method="post">
                                    <section>
										<div class="col-6 col-12-small">
											<center> <!--php-->
												<select name="city-list" onchange="changeType(this)" style="width:350px;">
													<option value='' >餐廳類別</option>
													<?php
														$sqlType = "SELECT * FROM `FoodType`";
														$resultType = $connect->query($sqlType);
														
														if ($resultType->num_rows > 0) {
															$TypeChoose = '';
															while ($rowType = $resultType->fetch_assoc()){
																$TypeID = $rowType['FoodTypeID'];
																$Type = $rowType['FoodTypeName'];

																if($TypeState == $TypeID){
																	$TypeChoose = 'selected';
																}
																else{
																	$TypeChoose = '';
																}
																echo"<option value='$TypeID' $TypeChoose >$Type</option>";
															}
														}
													?>
												</select>
											</center>
										</div><br>
										<div class="col-6 col-12-small">
											<center> <!--php-->
												<select name="district-list" onchange="changeR(this)" style="width:350px;"required>
													<option value='' >餐廳列表</option>
													<?php
														$sqlR = "SELECT * FROM `Restaurant` WHERE `FoodTypeID`= '$TypeState'";
														$resultR = $connect->query($sqlR);
																			
														if ($resultR->num_rows > 0) {
															$RChoose = '';
															while ($rowR = $resultR->fetch_assoc()){
																$RestaurantName = $rowR['RestaurantName'];
																$RestaurantID = $rowR['RestaurantID'];

																if($RState == $RestaurantID){
																	$RChoose = 'selected';
																}
																else{
																	$RChoose = '';
																}
																echo"<option value='$RestaurantID$TypeState' $RChoose>$RestaurantName</option>";
															}
														}
													?>
												</select>
											</center>
										</div><br><br>
										<div class="col-6 col-12-small">
											<h3>修改餐廳資訊</h3>
											<center> <!--php-->
												<?php
													if($RState){
														$sqlR = "SELECT * FROM `Restaurant` WHERE `FoodTypeID`= '$TypeState' AND `RestaurantID`= '$RState'";
														$resultR = $connect->query($sqlR);
																			
														if ($resultR->num_rows > 0) {
										
															while ($rowR = $resultR->fetch_assoc()){
																$RestaurantName = $rowR['RestaurantName'];
																$RestaurantID = $rowR['RestaurantID'];
																$BranchName = $rowR['BranchName'];
																$MenuURL = $rowR['MenuURL'];
																$Phone = $rowR['Phone'];
																$Mon = $rowR['Mon'];
																$Tue = $rowR['Tue'];
																$Wed = $rowR['Wed'];
																$Thu = $rowR['Thu'];
																$Fri = $rowR['Fri'];
																$Sat= $rowR['Sat'];
																$Sun = $rowR['Sun'];

																echo "<input type='hidden' name='RestaurantID' value='$RestaurantID' />";

																echo "餐廳名稱<input type='text' name='RestaurantName' value='$RestaurantName' style='width:350px;'/><br>";
																echo "分店名稱<input type='text' name='BranchName' value='$BranchName' style='width:350px;'/><br>";
																echo "菜單連結<input type='text' name='MenuURL' value='$MenuURL' style='width:350px;'/><br>";
																echo "電話<input type='text' name='Phone' value='$Phone' style='width:350px;'/><br>";
																echo "<h4>營業時間</h4>Mon<input type='text' name='Mon' value='$Mon' style='width:350px;'/><br>";
																echo "Tue<input type='text' name='Tue' value='$Tue' style='width:350px;'/><br>";
																echo "Wed<input type='text' name='Wed' value='$Wed' style='width:350px;'/><br>";
																echo "Thu<input type='text' name='Thu' value='$Thu' style='width:350px;'/><br>";
																echo "Fri<input type='text' name='Fri' value='$Fri' style='width:350px;'/><br>";
																echo "Sat<input type='text' name='Sat' value='$Sat' style='width:350px;'/><br>";
																echo "Sun<input type='text' name='Sun' value='$Sun' style='width:350px;'/><br>";
																
															}
														}
													}
												?>
											</center>
										</div><br>
										
										
									<span>
										<input type="button" onclick="changeAction(this)" class="button" value="修改"/>&nbsp&nbsp
										<input type="button" onclick="changeAction(this)" class="button" value="刪除"/>
										<!--<input type="button" onclick="GetAction()" class="button" value="查看"/>-->
										<input type="hidden" id="myField" name="myField" value="" />
									</span>	
									
									<br><br>
                                    <input type="submit" class="button" />
								    </section>
                                </form>
								<script type="text/javascript">
							
									function changeType(selectObject){
										var TypeNum = selectObject.value;
										var Url = "addrestaurant.php?Type=" + TypeNum;
										this.location = Url;
										
									}
									function changeR(selectObject){
										var RNum = selectObject.value;
										var Rest = RNum.substr(0, 6);
										var Type = RNum.substr(6, 4);
										var Url = "addrestaurant.php?Type="+Type+"&Rest="+Rest;
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