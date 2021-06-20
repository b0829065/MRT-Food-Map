Strongly Typed by HTML5 UP
html5up.net | @ajlkn
Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)


This is Strongly Typed, a new site template with a minimal, semi-retro
look (inspired by old instruction manuals) and, as you might guess from its
name, a strong emphasis on type. It's fully responsive, built on HTML5/CSS3,
and includes styling for all basic page elements. Demo images* are courtesy of
regularjane, an incredibly talented photographer friend of mine. Be sure to
check out more of her work over at deviantART:

http://regularjane.deviantart.com/

(* = Not included! Only meant for use with my own on-site demo, so please do NOT download
and/or use any of Jane's work without her explicit permission!)

As usual, feedback, bug reports, and comments are not only welcome, but strongly
encouraged :)

AJ
aj@lkn.io | @ajlkn

PS: Not sure how to get that contact form working? Give formspree.io a try (it's awesome).


Credits:

	Demo Images:
		regularjane (regularjane.deviantart.com)

	Icons:
		Font Awesome (fontawesome.io)

	Other:
		jQuery (jquery.com)
		Responsive Tools (github.com/ajlkn/responsive-tools)


網頁介紹：
	1. index.php #主頁
		1) 如果未登入，選擇註冊、登入
		2) 如果已登入，選擇登出
		3) 顯示所有食物種類

	2. login.html #使用者登入

	3. Login.php #處理登入
		1) 連線資料庫
		2) 如果帳號密碼正確，將帳號和登入成功的狀態儲存Cookie，顯示 "登入成功" ，前往index.php
		3）如果帳號密碼錯誤，顯示 "帳號或密碼錯誤" ，前往login.html

	4. Logout.php #處理登出
		1) 刪除cookie
		2) 前往index.php

	5. recommend.php #使用者推薦新餐廳
		1) 如果未登入，顯示 "請先登入" ，前往index.php
		2) 顯示應填項目