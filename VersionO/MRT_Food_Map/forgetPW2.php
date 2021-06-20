<?php 

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

    $Account = @$_POST["MemberID"];
    echo $Account;
    echo "<br>";

    /*
        echo "<script>alert('註冊成功！');</script>";
        header("refresh:0;url = index.php");
        $connect->close();
        
        exit;
    */
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
									<li><a class="icon solid fa-home" href="index.html"><span>首頁</span></a></li>
									<li>
										<a href="#" class="icon fa-map"><span>Dropdown</span></a>
										<ul>
											<li><a href="#">Lorem ipsum dolor</a></li>
											<li><a href="#">Magna phasellus</a></li>
											<li><a href="#">Etiam dolore nisl</a></li>
											<li>
												<a href="#">Phasellus consequat</a>
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

						<!--login-->
						<header>
							<h1><strong>忘記密碼</strong></h1>
						</header>
						<br>
						<br>
						<br>
							<div class=container>
						
									<form method="post" action="Forget.php">
										<!--<div class="row gtr-50">-->
										<section>
											<div class="col-6 col-12-small">
												<h2>安全問題</h2><!--php 這裡要跳出問題-->
												<?php
													$sqlQ = "SELECT * FROM `MemberQA` NATURAL JOIN `Question` WHERE `Account` = '$Account'";
													$resultQ = $connect->query($sqlQ);
													$rand = rand(0,2);
													$i = 0;
													if ($resultQ->num_rows > 0) {
														while ($rowQ = $resultQ->fetch_assoc())
														{
															$QuestionID = $rowQ['QuestionID'];
															$Question = $rowQ['Question'];
															if($i == $rand){
																echo "<input name='QuestionID' type='hidden' value='$QuestionID' />";
																echo "<input name='MemberID' type='hidden' value='$Account' />";
																echo "<h2>$Question</h2>";
															}
															
															$i++;
														}
													}
												?>
												<center><input name="Answer" placeholder="答案" type="text" style="width:350px;" /></center>
											</div>
										</section>
												<!--php-->
												<input type="submit" class="button" value="找回密碼">
	

									</form>
						
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