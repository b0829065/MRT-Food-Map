<?php
    session_start();
	
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

    
    $FoodType = @$_POST["FoodType"];
    //echo $FoodType;

    $sqlFood = "SELECT * FROM `FoodType`";
    $ResultCount = $connect->query($sqlFood);
    $Count = $ResultCount->num_rows + 1;
    $Count = str_pad($Count,2,"0",STR_PAD_LEFT);
    $Count = "N".$Count;
    $Count = "F".$Count;

    if ($ResultCount->num_rows > 0) {
        while ($rowFood = $ResultCount->fetch_assoc())
        {
            $FoodTypeName = $rowFood['FoodTypeName'];
            
            if($FoodTypeName == $FoodType){
                echo "<script>alert('這個類別很受歡迎！已經有人推薦了喔！！');</script>";
                header("refresh:0;url = index.php");
                $connect->close();
                exit;
            }
        }
    }

    $sqlType =  "INSERT INTO `FoodType`(`FoodTypeID`, `FoodTypeName`) VALUES ('$Count','$FoodType')";
    //echo "$sqlMap";
    $Result= $connect->query($sqlType);
    echo "<script>alert('感謝推薦！');</script>";
    header("refresh:0;url = index.php");
    $connect->close();
    exit;
?>