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

    $FoodType = $_COOKIE['FoodType'];
    $RestaurantName = $_COOKIE["RestaurantName"];
    echo "HEllo";
    echo $RestaurantName;
    $RestaurantBranch = $_COOKIE["RestaurantBranch"];
    $Phone = $_COOKIE["Phone"];
    $MenuUrl = $_COOKIE["MenuUrl"];
    $StationID = $_COOKIE["StationID"];

    $RoadID = @$_POST["road-list"];
    $No = @$_POST["No"];

    $Section = @$_POST["section"];
    $Ln = @$_POST["Ln"];
    $Aly = @$_POST["Aly"];
    $F = @$_POST["F"];
    $Rm = @$_POST["Rm"];

    $sqlR = "SELECT * FROM `Restaurant`";
    $resultR = $connect->query($sqlR);
    
    $AgainState = 0;
    $RestaurantID = '';

    if ($resultR->num_rows > 0) {
        while ($rowR = $resultR->fetch_assoc())
        {
            $RestaurantID = $rowR['RestaurantID'];

            $Name = $rowR['RestaurantName'];
            $Branch = $rowR['BranchName'];
            $NO = $rowR['No'];
            $DistrictRoadID = $rowR['DistrictRoadID'];

            if(($Name == $RestaurantName and $Branchand == $RestaurantBranch) or ($DistrictRoadID == $RoadID and $NO == $No)){
                $AgainState = 1;
                break;
            }
        }
    }

    

    if($AgainState){
        setcookie("RestaurantID", $RestaurantID, time()+3600);
        header("refresh:0;url = Again.php"); 
        $connect->close();
        exit;
    }
    else{
        $sqlCount = "SELECT * FROM `Recommend`";
        $ResultCount = $connect->query($sqlCount);
        $Count = $ResultCount->num_rows + 1;
        $Count = str_pad($Count,6,"0",STR_PAD_LEFT);
        $Count = "M".$Count;
        $Now = date('Y-m-d H:i:s');
        $sqlRecommend = "INSERT INTO `Recommend`(`RecommendID`,`Account`,`DateTime`, `Approval`,`RestaurantName`, `BranchName`, `FoodTypeID`, `MenuURL`, `OtherLikes`, 
                                     `DistrictRoadID`, `Sec`, `Ln`, `Aly`, `No`, `F`, `Rm`, `Phone`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`, `Sun`, `StationID`) 
                                     VALUES ('$Count','$UserName', '$Now', '0','$RestaurantName','$RestaurantBranch','$FoodType','$MenuUrl','0',
                                     '$RoadID','$Section','$Ln','$Aly','$No','$F','$Rm','$Phone','無','無','無','無','無','無','無', '$StationID')";
        echo "$sqlRecommend";
        $ResultRecommend = $connect->query($sqlRecommend);
        
        echo "<script>alert('感謝您的推薦！');</script>";
        header("refresh:0;url = index.php");
        $connect->close();
    }

?>
