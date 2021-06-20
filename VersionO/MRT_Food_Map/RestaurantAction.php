<?php 
	session_start();
	
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

    
    $Action = @$_POST["myField"];
    echo $Action;

    $RestaurantID = @$_POST["RestaurantID"];
    echo $RestaurantID;

    $RestaurantName = @$_POST["RestaurantName"];
    echo $RestaurantName;
    
    $BranchName = @$_POST["BranchName"];
    echo $BranchName;

    $MenuURL = @$_POST["MenuURL"];
    echo $MenuURL;

    $Phone = @$_POST["Phone"];
    echo $MenuURL;

    $Mon = @$_POST["Mon"];
    echo $Mon;

    $Tue = @$_POST["Tue"];
    echo $Tue;

    $Wed = @$_POST["Wed"];
    echo $Wed;

    $Thu = @$_POST["Thu"];
    echo $Thu;

    $Fri = @$_POST["Fri"];
    echo $Fri;

    $Sat = @$_POST["Sat"];
    echo $Sat;

    $Sun = @$_POST["Sun"];
    echo $Sun;

    if($Action == "修改"){
        $sqlRoad =  "UPDATE `Restaurant` SET `RestaurantName`='$RestaurantName',`BranchName`='$BranchName',`MenuURL`='$MenuURL',`Phone`='$Phone',
                    `Mon`='$Mon',`Tue`='$Tue',`Wed`='$Wed',`Thu`='$Thu',`Fri`='$Fri',`Sat`='$Sat',`Sun`='$Sun' WHERE `RestaurantID` = '$RestaurantID'";

        //echo "$sqlMap";
        $ResultRoad = $connect->query($sqlRoad);
        echo "<script>alert('修改成功！');</script>";
        header("refresh:0;url = administrator.php");
        $connect->close();
        exit;
    }
    elseif($Action == "刪除"){
        $sqlRoad =  "DELETE FROM `Restaurant` WHERE `RestaurantID` = '$RestaurantID'";
        //echo "$sqlMap";
        $ResultRoad = $connect->query($sqlRoad);
        echo "<script>alert('刪除成功！');</script>";
        header("refresh:0;url = administrator.php");
        $connect->close();
        exit;
    }
  
?>
