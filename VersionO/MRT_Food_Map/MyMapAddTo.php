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

    
    $RestaurantName = @$_POST["RestaurantName"];
    $RestaurantBranch = @$_POST["RestaurantBranch"];
    $Station = @$_POST["Station"];

    $StationID = '';

    $sqlStation = "SELECT * FROM `MRTStation` WHERE `StationName`='$Station'";
    $resultStation = $connect->query($sqlStation);
    if ($resultStation->num_rows > 0) {
        while ($rowStation = $resultStation->fetch_assoc()){
            $StationID = $rowStation['StationID'];
        }
    }

    $sqlMyMap = "SELECT * FROM `MyMap`";
    $ResultCount = $connect->query($sqlMyMap);
    $Count = $ResultCount->num_rows + 1;
    $Count = str_pad($Count,6,"0",STR_PAD_LEFT);
    $Count = "Y".$Count;
    
    $sqlMap =  "INSERT INTO `MyMap`(`MyRestaurantID`, `Account`, `MyRestaurantName`, `MyRestaurantBranch`, `StationID`) 
                      VALUES ('$Count','$UserName','$RestaurantName','$RestaurantBranch','$StationID')";
    //echo "$sqlMap";
    $ResultMap= $connect->query($sqlMap);
        
    echo "<script>alert('新增成功！');</script>";
    header("refresh:0;url = index.php");
    $connect->close();
?>
