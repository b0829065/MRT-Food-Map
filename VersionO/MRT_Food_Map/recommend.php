<?php 
	session_start();
	setcookie("RestaurantID", '', time()-3600);
	
	setcookie("FoodType", '', time()-3600);
	setcookie("RestaurantName", '', time()-3600);
	setcookie("RestaurantBranch", '', time()-3600);
	setcookie("Phone", '', time()-3600);
	setcookie("MenuUrl", '', time()-3600);
	setcookie("Station", '', time()-3600);

	setcookie("PageCount", '0', time()+3600);

	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	$State = $_COOKIE['LoginState'];
	$UserName = $_COOKIE['UserName'];

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
						<form name="recommend" method="post" action="recommend2.php">
							<section>
								<p>推薦類別</p>
								<div class="col-6 col-12-small">
									<center> <!--php-->
										<select name="FoodType" style="width:350px;" required>
									    <?php
											$sqlFood = "SELECT * FROM `FoodType`";
											$resultFood = $connect->query($sqlFood);
														
														if ($resultFood->num_rows > 0) {
															while ($rowFood = $resultFood->fetch_assoc())
															{
																$FoodTypeID = $rowFood['FoodTypeID'];
																$FoodTypeName = $rowFood['FoodTypeName'];
														
																echo"<option value='$FoodTypeID'>$FoodTypeName</option>";
															}
														}
													?>
										</select>
									</center>
								</div>
							</section>
							<section>
								<p>餐廳名稱</p>
								<div class="col-6 col-12-small">
									<center><input name="RestaurantName" placeholder="餐廳名稱" type="text" style="width:350px;" required/></center>
								</div>
							</section>
							<section>
								<p>餐廳分店</p>
								<div class="col-6 col-12-small">
									<center><input name="RestaurantBranch" placeholder="餐廳分店" type="text" style="width:350px;"/></center>
								</div>
							</section>
							<section>
								<p>餐廳電話</p>
								<div class="col-6 col-12-small">
									<center><input name="Phone" oninput="value=value.replace(/[^\d]/g,'')" placeholder="餐廳電話" type="text" style="width:350px;"/></center>
								</div>
							</section>
							<section>
								<p>餐廳菜單<br />(請提供菜單網址URL)</p>
								<div class="col-6 col-12-small">
									<center><input name="MenuUrl" placeholder="菜單網域名稱" type="text" style="width:350px;" /></center>
								</div>
							</section>										
							<section>
								<p>選擇鄰近的捷運線與捷運站</p>
								<div class="col-6 col-12-small">
									<center> <!--php-->
										<select id="college-list" onchange="changeCollege(this.selectedIndex)" style="width:350px;"></select>
										<br>
									<p>選擇捷運站</p>
									<select name="Station" id="sector-list" style="width:350px;" required></select>
									</center>
								</div>
							</section>
							
							<!--php-->
							<input type="submit" class="button"></input>
							<br><br>
							<h4>下一步，請繼續填寫推薦的餐廳資料！</h4>
						</form>



						<script type="text/javascript">
							var colleges=['文湖線','淡水信義線','松山新店線','忠和新蘆線','板南線' ,'環狀線'];
							var collegeSelect=document.getElementById("college-list");
							var inner="";
							for(var i=0;i<colleges.length;i++){
								inner=inner+'<option value=i>'+colleges[i]+'</option>';
							}
							collegeSelect.innerHTML=inner;
								var sectors=new Array();
								sectors[0]=['動物園','木柵' ,'萬芳社區' ,'萬芳醫院' ,'辛亥' ,'麟光','六張犁' ,'科技大樓' ,'大安' ,'忠孝復興' ,'南京復興' ,'中山國中' ,'松山機場' ,'大直' ,'劍南路' ,'西湖' ,'港墘' ,'文德' ,'內湖' ,'大湖公園' ,'葫洲' ,'東湖' ,'南港軟體園區' ,'南港展覽館'];
								sectors[1]=['象山','台北101/世貿','信義安和','大安','大安森林公園','東門','中正紀念堂','台大醫院','台北車站','中山','雙連' ,'民權西路' ,'圓山' ,'劍潭' ,'士林' ,'芝山' ,'明德' ,'石牌' ,'唭哩岸' ,'奇岩' ,'北投' ,'復興崗' ,'忠義' ,'關渡' ,'竹圍' ,'紅樹林' ,'淡水'];
								sectors[2]=['新店','新店區公所','七張','大坪林','景美','萬隆','公館','台電大樓','古亭' ,'中正紀念堂' ,'小南門' ,'西門' ,'北門' ,'中山' ,'松江南京' ,'南京復興' ,'南京三名' ,'松山'];
								sectors[3]=['南勢角','景安','永安市場','頂溪' ,'古亭' ,'東門' ,'忠孝新生' ,'松江南京' ,'行天宮' ,'中山國小' ,'明權西路' ,'大橋頭' ,'台北橋' ,'菜寮' ,'三重' ,'先仄公' ,'先嗇宮' ,'頭前庄' ,'新莊' ,'輔大' ,'丹鳳' ,'迴龍' ,'三重國小' ,'三和國中' ,'徐匯中學' ,'三民高中' ,'蘆洲'];
								sectors[4]=['頂埔','永寧','土城','海山','亞東醫院','府中','板橋','新埔','江子翠' ,'龍山寺' ,'西門' ,'台北車站' ,'善導寺' ,'忠孝新生' ,'忠孝復興' ,'忠孝敦化' ,'國父紀念館' ,'市政府' ,'永春' ,'後山埤' ,'昆陽' ,'南港' ,'南港展覽館'];
								sectors[5]=['大坪頂', '十四張' ,'秀朗橋' ,'景平' ,'景安' ,'中和' ,'橋和' ,'中原' ,'板新' ,'新埔民生' ,'頭前庄' ,'幸福' ,'新北產業園區'];
								function changeCollege(index){
								var Sinner="";
								for(var i=0;i<sectors[index].length;i++){
									Sinner=Sinner+'<option value='+sectors[index][i]+'>'+sectors[index][i]+'</option>';
								}
								var sectorSelect=document.getElementById("sector-list");
									sectorSelect.innerHTML=Sinner;
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