<script language="javascript">
	function MRT(str) {
		window.location.href = 'station_restaurant.php?'+str;
		document.cookie = 'Station='+str;
		//document.cookie = 'LoginState=TRUE';
	}
</script>


<!DOCTYPE HTML>
<html>
	<head>
		<title>MRT Food Map</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="homepage is-preload">
		<div id="page-wrapper">
		<?php 
			$connect = new mysqli( "localhost", "root", "0000", "foodmap");
			$connect->query("SET NAMES 'utf8'");
			if ($connect->connect_error) {
				die("連線失敗: " . $connect->connect_error);
			}
			for($i=0;$i<5;$i++){
				if($_COOKIE['like'][$i]){
					$instr = "UPDATE restaurant set Likes=Likes+1 where `RestaurantID` =".json_encode($_COOKIE['like'][$i]);
					$result = $connect->query($instr);
				}
				if($_COOKIE['fav'][$i]){
					$account = $_COOKIE['UserName'];
					$instr = "INSERT INTO `memberpressadd` (`Account`, `RestaurantID`) VALUES (".json_encode($account)."," .json_encode($_COOKIE['fav'][$i]).")";
					$result = $connect->query($instr);
				}
			}
		?>
			<!-- Header -->
				<section id="header">
					<div class="container">

						<!-- Logo -->
							<h1 id="logo"><a href="index.html">MRT Food Map</a></h1>
							<br>
							<!--php-->
							<h2>拉麵</h2>
							<div class="col-8">
								<ul class="actions">
								<form name="station_restaurant.php" action="station_restaurant.php" method="get">
									<li><button onclick="MRT('S001')" style="background-color:#CE0000;position:absolute; left:180px; top:80 px;"><span>動物園</span></a></li>
									<li><button onclick="MRT('S002')" style="background-color:#CE0000;position:absolute; left:260px; top:80 px;"><span>木柵</span></a></li>
									<li><button onclick="MRT('S003')" style="background-color:#CE0000;position:absolute; left:350px; top:80 px;"><span>萬芳社區</span></a></li>
									<li><button onclick="MRT('S004')" style="background-color:#CE0000;position:absolute; left:430px; top:80 px;"><span>萬芳醫院</span></a></li>
									<li><button onclick="MRT('S005')" style="background-color:#CE0000;position:absolute; left:510px; top:80 px;"><span>辛亥</span></a></li>
									<li><button onclick="MRT('S006')" style="background-color:#CE0000;position:absolute; left:590px; top:80 px;"><span>麟光</span></a></li>
									<li><button onclick="MRT('S007')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>六張犁</span></a></li>
									<li><button onclick="MRT('S008')" style="background-color:#CE0000;position:absolute; left:780px; top:80 px;"><span>科技大樓</span></a></li><br>
									<li><button onclick="MRT('S009')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>大安</span></a></li><br>
									<li><button onclick="MRT('S010')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>忠孝復興</span></a></li><br>
									<li><button onclick="MRT('S011')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>南京復興</span></a></li><br>
									<li><button onclick="MRT('S012')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>中山國中</span></a></li><br>
									<li><button onclick="MRT('S013')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>松山機場</span></a></li><br>
									<li><button onclick="MRT('S014')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>大直</span></a></li><br>
									<li><button onclick="MRT('S015')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>劍南路</span></a></li><br>
									<li><button onclick="MRT('S016')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>西湖</span></a></li><br>
									<li><button onclick="MRT('S017')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>港墘</span></a></li><br>
									<li><button onclick="MRT('S018')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>文德</span></a></li><br>
									<li><button onclick="MRT('S019')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>內湖</span></a></li><br>
									<li><button onclick="MRT('S020')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>大湖公園</span></a></li><br>
									<li><button onclick="MRT('S021')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>葫洲</span></a></li><br>
									<li><button onclick="MRT('S022')" style="background-color:#CE0000;position:absolute; left:690px; top:80 px;"><span>東湖</span></a></li><br>
									<li><button onclick="MRT('S023')" style="background-color:#CE0000;position:absolute; left:780px; top:80 px;"><span>南港軟體園區</span></a></li><br>
									<li><button onclick="MRT('S024')" style="background-color:#CE0000;position:absolute; left:780px; top:80 px;"><span>南港展覽館</span></a></li><br>
									<li><button onclick="MRT('S025')" style="background-color:#CE0000;position:absolute; left:780px; top:80 px;"><span>淡水</span></a></li><br>
									<li><button onclick="MRT('S026')" style="background-color:#CE0000;position:absolute; left:780px; top:80 px;"><span>紅樹林</span></a></li><br>
									<li><button onclick="MRT('S027')" style="background-color:#CE0000;position:absolute; left:780px; top:80 px;"><span>竹圍</span></a></li><br>
									<li><button onclick="MRT('S028')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>關渡</span></a></li><br>
									<li><button onclick="MRT('S029')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>忠義</span></a></li><br>
									<li><button onclick="MRT('S030')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>復興崗</span></a></li><br>
									<li><button onclick="MRT('S031')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>北投</span></a></li><br>
									<li><button onclick="MRT('S032')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>新北投</span></a></li><br>
									<li><button onclick="MRT('S033')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>奇岩</span></a></li><br>
									<li><button onclick="MRT('S034')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>唭哩岸</span></a></li><br>
									<li><button onclick="MRT('S035')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>石牌</span></a></li><br>
									<li><button onclick="MRT('S036')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>明德</span></a></li><br>
									<li><button onclick="MRT('S037')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>芝山</span></a></li><br>
									<li><button onclick="MRT('S038')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>士林</span></a></li><br>
									<li><button onclick="MRT('S039')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>劍潭</span></a></li><br>
									<li><button onclick="MRT('S040')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>圓山</span></a></li><br>
									<li><button onclick="MRT('S041')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>民權西路</span></a></li><br>
									<li><button onclick="MRT('S042')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>雙連</span></a></li><br>
									<li><button onclick="MRT('S043')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>中山</span></a></li><br>
									<li><button onclick="MRT('S044')" style="background-color:#019858;position:absolute; left:780px; top:80 px;"><span>台北車站</span></a></li><br>
									<li><button onclick="MRT('S045')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>台大醫院</span></a></li><br>
									<li><button onclick="MRT('S046')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>中正紀念堂</span></a></li><br>
									<li><button onclick="MRT('S047')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>東門</span></a></li><br>
									<li><button onclick="MRT('S048')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>大安森林公園</span></a></li><br>
									<li><button onclick="MRT('S049')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>信義安和</span></a></li><br>
									<li><button onclick="MRT('S050')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>台北101/世貿</span></a></li><br>
									<li><button onclick="MRT('S051')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>象山</span></a></li><br>
									<li><button onclick="MRT('S052')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>新店</span></a></li><br>
									<li><button onclick="MRT('S053')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>新店區公所</span></a></li><br>
									<li><button onclick="MRT('S054')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>七張</span></a></li><br>
									<li><button onclick="MRT('S055')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>小碧潭</span></a></li><br>
									<li><button onclick="MRT('S056')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>大坪林</span></a></li><br>
									<li><button onclick="MRT('S057')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>景美</span></a></li><br>
									<li><button onclick="MRT('S058')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>萬隆</span></a></li><br>
									<li><button onclick="MRT('S059')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>公館</span></a></li><br>
									<li><button onclick="MRT('S060')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>台電大樓</span></a></li><br>
									<li><button onclick="MRT('S061')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>古亭</span></a></li><br>
									<li><button onclick="MRT('S062')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>小南門</span></a></li><br>
									<li><button onclick="MRT('S063')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>西門</span></a></li><br>
									<li><button onclick="MRT('S064')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>北門</span></a></li><br>
									<li><button onclick="MRT('S065')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>松江南京</span></a></li><br>
									<li><button onclick="MRT('S066')" style="background-color:#FF9224;position:absolute; left:780px; top:80 px;"><span>台北小巨蛋</span></a></li><br>
									<li><button onclick="MRT('S067')" style="background-color:#0072E3;position:absolute; left:780px; top:80 px;"><span>南京三民</span></a></li><br>
									<li><button onclick="MRT('S068')" style="background-color:#0072E3;position:absolute; left:780px; top:80 px;"><span>松山</span></a></li><br>
									<li><button onclick="MRT('S069')" style="background-color:#0072E3;position:absolute; left:780px; top:80 px;"><span>南勢角</span></a></li><br>
									<li><button onclick="MRT('S070')" style="background-color:#0072E3;position:absolute; left:780px; top:80 px;"><span>景安</span></a></li><br>
									<li><button onclick="MRT('S071')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>永安市場</span></a></li><br>
									<li><button onclick="MRT('S072')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>頂溪</span></a></li><br>
									<li><button onclick="MRT('S073')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>忠孝新生</span></a></li><br>
									<li><button onclick="MRT('S074')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>行天宮</span></a></li><br>
									<li><button onclick="MRT('S075')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>中山國小</span></a></li><br>
									<li><button onclick="MRT('S076')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>大橋頭</span></a></li><br>
									<li><button onclick="MRT('S077')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>台北橋</span></a></li><br>
									<li><button onclick="MRT('S078')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>菜寮</span></a></li><br>
									<li><button onclick="MRT('S079')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>三重</span></a></li><br>
									<li><button onclick="MRT('S080')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>先嗇宮</span></a></li><br>
									<li><button onclick="MRT('S081')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>頭前庄</span></a></li><br>
									<li><button onclick="MRT('S082')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>新莊</span></a></li><br>
									<li><button onclick="MRT('S083')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>輔大</span></a></li><br>
									<li><button onclick="MRT('S084')" style="background-color:#0072E3	;position:absolute; left:780px; top:80 px;"><span>丹鳳</span></a></li><br>
									<li><button onclick="MRT('S085')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>迴龍</span></a></li><br>
									<li><button onclick="MRT('S086')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>三重國小</span></a></li><br>
									<li><button onclick="MRT('S087')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>三和國中</span></a></li><br>
									<li><button onclick="MRT('S088')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>徐匯中學</span></a></li><br>
									<li><button onclick="MRT('S089')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>三民高中</span></a></li><br>
									<li><button onclick="MRT('S090')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>蘆洲</span></a></li><br>
									<li><button onclick="MRT('S091')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>南港</span></a></li><br>
									<li><button onclick="MRT('S092')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>昆陽</span></a></li><br>
									<li><button onclick="MRT('S093')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>後山埤</span></a></li><br>
									<li><button onclick="MRT('S094')" style="background-color:#F9F900	;position:absolute; left:780px; top:80 px;"><span>永春</span></a></li><br>
									<li><button onclick="MRT('S095')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>市政府</span></a></li><br>
									<li><button onclick="MRT('S096')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>國父紀念館</span></a></li><br>
									<li><button onclick="MRT('S097')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>忠孝敦化</span></a></li><br>
									<li><button onclick="MRT('S098')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>善導寺</span></a></li><br>
									<li><button onclick="MRT('S099')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>龍山寺</span></a></li><br>
									<li><button onclick="MRT('S100')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>江子翠</span></a></li><br>
									<li><button onclick="MRT('S101')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>新埔</span></a></li><br>
									<li><button onclick="MRT('S102')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>板橋</span></a></li><br>
									<li><button onclick="MRT('S103')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>府中</span></a></li><br>
									<li><button onclick="MRT('S104')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>亞東醫院</span></a></li><br>
									<li><button onclick="MRT('S105')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>海山</span></a></li><br>
									<li><button onclick="MRT('S106')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>土城</span></a></li><br>
									<li><button onclick="MRT('S107')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>永寧</span></a></li><br>
									<li><button onclick="MRT('S108')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>頂埔</span></a></li><br>
									<li><button onclick="MRT('S109')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>十四張</span></a></li><br>
									<li><button onclick="MRT('S110')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>秀朗橋</span></a></li><br>
									<li><button onclick="MRT('S111')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>景平</span></a></li><br>
									<li><button onclick="MRT('S112')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>中和</span></a></li><br>
									<li><button onclick="MRT('S113')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>橋和</span></a></li><br>
									<li><button onclick="MRT('S114')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>中原</span></a></li><br>
									<li><button onclick="MRT('S115')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>板新</span></a></li><br>
									<li><button onclick="MRT('S116')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>新埔民生</span></a></li><br>
									<li><button onclick="MRT('S117')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>幸福</span></a></li><br>
									<li><button onclick="MRT('S118')" style="background-color:#844200	;position:absolute; left:780px; top:80 px;"><span>新北產業園區</span></a></li><br>

					
								   


								</ul>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon solid fa-home" href="index.html"><span>首頁</span></a></li>
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