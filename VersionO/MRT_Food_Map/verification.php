<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<script type="text/javascript"> 
	var num;
	function hide(num) { 
		document.getElementsByClassName("hide")[num].style.display = 'none';
	} 
</script> 

<html>
	<head>
		<title>Left Sidebar - Strongly Typed by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="left-sidebar is-preload">
		<div id="page-wrapper">

			<!-- Header -->
				<section id="header">
					<div class="container">

						<!-- Logo -->
							<h1 id="logo" ><a href="index.html">驗證</a></h1>
						<!-- Nav -->
							<nav id="nav">
								<ul>
									<li><a class="icon solid fa-home" href="index.html"><span>Introduction</span></a></li>
									<li>
										<a href="#" class="icon fa-chart-bar"><span>Dropdown</span></a>
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

					</div>
				</section>

			<!-- Main -->
				<section id="main">
					<div class="container">
				

							<!-- Sidebar -->
								<div id="sidebar" class="col-4 col-12-medium">

									<!-- Excerpts -->
										<section>
											<ul class="divided">
												<li>
													<!-- Excerpt -->
														<article class="box excerpt">
															<header>
																<span class="date">美食分類驗證</span>
															</header>

															<!--php-->
														
														<div class="hide">
															<h3>乾麵</h3>
															<span>
																<button onclick="changeAction(this)" class="icon solid fa-check" value="通過"><span>通過</span></button>&emsp;
																<button onclick="changeAction(this)" class="icon solid fa-times" value="刪除"><span>刪除</span></button>
																<input type="button" onclick="GetAction()" class="button" value="查看"/>
																<input type="hidden" id="myField" name="myField" value="" />
															</span>	
														</div><br>

														<div class="hide">
															<h3>紅豆餅</h3>
															<button class="icon solid fa-check" onclick="hide(1)"><span>通過</span></button>&emsp;
															<button class="icon solid fa-times" onclick="hide(1)"><span>刪除</span></button>
														</div><br>

														<div class="hide">
															<h3>臭豆腐</h3>
															<button class="icon solid fa-check" onclick="hide(2)"><span>通過</span></button>&emsp;
															<button class="icon solid fa-times" onclick="hide(2)"><span>刪除</span></button>
														</div>
						

														</article>
												</li>
												<li>
													<!-- Excerpt -->
														<article class="box excerpt">
															<header>
																<span class="date">新增餐廳驗證</span>
																
															</header>
															<!--php-->
															<div class="hide">
																<h3>餐廳:</h3>
																<h3>地址:</h3>
																<h3>電話:</h3>
																<h3>菜單:</h3>
																<button class="icon solid fa-check" onclick="hide(3)"><span>通過</span></button>&emsp;
																<button class="icon solid fa-times" onclick="hide(3)"><span>刪除</span></button>
															</div><br>

															<div class="hide">
																<h3>餐廳:</h3>
																<h3>地址:</h3>
																<h3>電話:</h3>
																<h3>菜單:</h3>
																<button class="icon solid fa-check" onclick="hide(4)"><span>通過</span></button>&emsp;
																<button class="icon solid fa-times" onclick="hide(4)"><span>刪除</span></button>
															</div><br>
														</article>
												</li>
											</ul>
										</section>
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