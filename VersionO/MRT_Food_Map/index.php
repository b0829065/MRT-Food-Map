<?php
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	session_start();
	$State = $_COOKIE['LoginState'];
	
	$UserName = $_COOKIE['UserName'];
	//echo $State;
	//echo "<br>";
	setcookie('like[0]', '0' , time()+3600);
	setcookie('like[1]', '0' , time()+3600);
	setcookie('like[2]', '0' , time()+3600);
	setcookie('like[3]', '0' , time()+3600);
	setcookie('like[4]', '0' , time()+3600);
	setcookie('fav[0]', '0' , time()+3600);
	setcookie('fav[1]', '0' , time()+3600);
	setcookie('fav[2]', '0' , time()+3600);
	setcookie('fav[3]', '0' , time()+3600);
	setcookie('fav[4]', '0' , time()+3600);

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
<script>
	
</script>

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

						<!-- Logo -->
							<h1 id="logo"><a href="index.php">MRT Food Map</a></h1>
							<br>
							<h2>捷運美食地圖</h2>
							<div class="col-8">
								<ul class="actions">
									<li><a href="<?php echo $LogHtml; ?>" class="button"><?php echo $Log; ?></a></li>
									<?php
										if($State){
											echo "<br><br>";
											echo "<h2>HELLO！$UserName</h3>";
										}
										else{
											echo "&emsp;&emsp;<li><a href='register.php' class='button'>註冊</a></li>";
										}
									?>
								</ul>
							</div>

						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon solid fa-home" href="index.php"><span>首頁</span></a></li>
									<li>
										<a href="#" class="icon fa-map"><span>我的地圖</span></a>
										<ul>
											<li><a href="#HotType">熱門地圖</a></li>
											<li><a href="MyMapAdd.php">我的地圖</a></li>
										</ul>
									</li>
									<li>
										<a href="#" class="icon solid fa-thumbs-up"><span>我要推薦</span></a>
										<ul>
											<li><a href="recommend.php">推薦餐廳</a></li>
											<li><a href="addclass.php">推薦類別</a></li>
										</ul>
									</li>
								</ul>
							</nav>

					</div>
				</section>

			<!-- Features -->
			
				<section id="features">
					<div class="container">
						<header id="HotType">
							<h2> <strong>選擇想要的尋找的食物...</strong></h2>
						</header>
						<div class="row aln-center" id="FoodTypeContainer">
							<?php
								$sqlFood = "SELECT * FROM `FoodType`";
								$resultFood = $connect->query($sqlFood);

								if ($resultFood->num_rows > 0) {
									$i = 0;
									while ($rowFood = $resultFood->fetch_assoc())
									{
										$FoodTypeName = $rowFood['FoodTypeName'];
										$FoodTypeID = $rowFood['FoodTypeID'];
										
										if($i >= 25){
											$img = 'F019';
										}
										else{
											$img = $FoodTypeID;
										}
										echo '<div class="col-4 col-6-medium col-12-small">';
										echo '	<section>';
										echo "	 	<a href='test.php?FoodType=$FoodTypeID' class='image featured'><img src='images/$img.jpeg' alt='' /></a>";
										echo "		<header><h3>$FoodTypeName</header></h3>";
										echo '	<section>';
										echo '</div>';
										$i++;
									}
								}
							?>
							
						</div>
					</div>
				</section>
			
			<!-- Footer -->
				<section id="footer">
					<div class="container">
						<header>
							<h2>Questions or comments? <strong>Get in touch:</strong></h2>
						</header>
						<div class="row">
							<div class="col-6 col-12-medium">
								<section>
									<form method="post" action="#">
										<div class="row gtr-50">
											<div class="col-6 col-12-small">
												<input name="name" placeholder="Name" type="text" />
											</div>
											<div class="col-6 col-12-small">
												<input name="email" placeholder="Email" type="text" />
											</div>
											<div class="col-12">
												<textarea name="message" placeholder="Message"></textarea>
											</div>
											<div class="col-12">
												<a href="#" class="form-button-submit button icon solid fa-envelope">Send Message</a>
											</div>
										</div>
									</form>
								</section>
							</div>
							<div class="col-6 col-12-medium">
								<section>
									<p>Erat lorem ipsum veroeros consequat magna tempus lorem ipsum consequat Phaselamet
									mollis tortor congue. Sed quis mauris sit amet magna accumsan tristique. Curabitur
									leo nibh, rutrum eu malesuada.</p>
									<div class="row">
										<div class="col-6 col-12-small">
											<ul class="icons">
												<li class="icon solid fa-home">
													1234 Somewhere Road<br />
													Nashville, TN 00000<br />
													USA
												</li>
												<li class="icon solid fa-phone">
													(000) 000-0000
												</li>
												<li class="icon solid fa-envelope">
													<a href="#">info@untitled.tld</a>
												</li>
											</ul>
										</div>
										<div class="col-6 col-12-small">
											<ul class="icons">
												<li class="icon brands fa-twitter">
													<a href="#">@untitled</a>
												</li>
												<li class="icon brands fa-instagram">
													<a href="#">instagram.com/untitled</a>
												</li>
												<li class="icon brands fa-dribbble">
													<a href="#">dribbble.com/untitled</a>
												</li>
												<li class="icon brands fa-facebook-f">
													<a href="#">facebook.com/untitled</a>
												</li>
											</ul>
										</div>
									</div>
								</section>
							</div>
						</div>
					</div>
					<div id="copyright" class="container">
						<ul class="links">
							<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</div>
				</section>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>