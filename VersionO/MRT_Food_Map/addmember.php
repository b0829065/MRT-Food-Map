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
						<h1><a href="administrator.php"><span>管理者介面</span></a></h1>
					<br /><h2>#我們的VIP#</h2><br /><br />
					</header>
					<div class="panel-body">
						<table>
							<tr>
								<td>Num</td>
								<td>Account</td>
								<td>Password</td>
							</tr>
							<?php
								$sqlMember = "SELECT * FROM `Member`";
								$resultMember = $connect->query($sqlMember);
								$i = 1;
								
								if ($resultMember->num_rows > 0) {
									
									while ($rowMember = $resultMember->fetch_assoc()){
										$Account = $rowMember['Account'];
										$Password= $rowMember['Password'];

										echo "<tr>";
										echo "	<td>$i</td>";
										echo "	<td>$Account</td>";
										echo "	<td>$Password</td>";
										echo "</tr>";
										$i++;
									}
								}
							?>
						</table>

					</div>
				</div>
			</section>
		</div>
	</body>
</html>