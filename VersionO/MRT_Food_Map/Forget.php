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

    $Answer = @$_POST["Answer"];
    $QuestionID = @$_POST["QuestionID"];
    $Account = @$_POST["MemberID"];

    $AnswerState = false;

    $sqlQ = "SELECT * FROM `MemberQA` NATURAL JOIN `Question` WHERE `Account` = '$Account' AND `QuestionID` = '$QuestionID'";
	$resultQ = $connect->query($sqlQ);
												
	if ($resultQ->num_rows > 0) {
		while ($rowQ = $resultQ->fetch_assoc()){
			$Correct = $rowQ['Answer'];
            
			if($Answer == $Correct){
                $AnswerState = true;
            }
			
		}
    }

    $Password = '';
    $sqlUser = "SELECT * FROM `Member` WHERE `Account` = '$Account'";
    $resultUser = $connect->query($sqlUser);

    if ($resultUser->num_rows > 0) {
        while ($rowUser = $resultUser->fetch_assoc())
        {
            $Password = $rowUser['Password'];
        }
    }
    if($AnswerState){
        echo "<script>alert('Your Password: $Password');</script>";
        header("refresh:0;url = index.php");
        $connect->close();
    }
    else{
        echo "<script>alert('驗證失敗...QAQ');</script>";
        header("refresh:0;url = index.php");
        $connect->close();
    }
?>