<?php
	session_start();
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	$State = $_COOKIE['LoginState'];
	$UserName = $_COOKIE['UserName'];

	if(!$State or $UserName != 'root'){
		echo "<script>alert('Bye！');</script>";
        header("refresh:0;url = index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>MRT Food Map/administrator</title>
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
							<li><a class="icon solid fa-home" href="index.php"><span>首頁</span></a></li>
							<li>
								<a href="#" class="icon fa-map"><span>我的地圖</span></a>
								<ul>
									<li><a href="#">熱門地圖</a></li>
									<li><a href="MyMapAdd.php">我的地圖</a></li>
								</ul>
							</li>
							<li><a class="icon solid fa-thumbs-up" href="recommend.php"><span>推薦餐廳</span></a></li>
							<li><a class="icon solid fa-retweet" href="right-sidebar.html"><span>Right Sidebar</span></a></li>
							<li><a class="icon solid fa-sitemap" href="no-sidebar.html"><span>No Sidebar</span></a></li>
						</ul>
					</nav>

					<!-- administrator -->
					<header>
						<h1><a href="administrator.html"><span>管理者介面</span></a></h1>
                    <br /><br /><br />
					</header>
					<div class="container">
						<div class="col-8">
							<a href="addstreet.php" class="button" style="width:350px;">修改街道</a></li>
						</div>
					</div>
					<br />
					<div class="container">
						<div class="col-8">
							<a href="addrestaurant.php" class="button" style="width:350px;">修改餐廳</a></li>
						</div>
					</div>
					<br />
					<div class="container">
						<div class="col-8">
							<a href="addmember.php" class="button" style="width:350px;">查看會員資料</a></li>
						</div>
					</div>
					<br >
					<div class="container">
						<div class="col-8">
							<a href="verification.html" class="button" style="width:350px;">驗證類別/餐廳</a></li>
						</div>
					</div>
					<br />
					<br />
				</div>
			</section>
		</div>
	</body>
</html>