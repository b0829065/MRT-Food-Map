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

    
    $Action = @$_POST["myField"];
    echo $Action;

    $DistrictID = @$_POST["DistrictID"];
    echo $DistrictID;

    $RoadID = @$_POST["road-list"];
    echo $RoadID;
    
    $Road = @$_POST["Road"];
    echo $Road;

    if($Action == "新增"){
        if(!$Road){
            echo "<script>alert('不能新增空路名喔！');</script>";
            header("refresh:0;url = addstreet.php");
            $connect->close();
            exit;
        }
        $sqlMyMap = "SELECT * FROM `DistrictRoad`";
        $ResultCount = $connect->query($sqlMyMap);
        $Count = $ResultCount->num_rows + 1;
        $Count = str_pad($Count,4,"0",STR_PAD_LEFT);
        $Count = "R".$Count;

        $sqlRoad =  "INSERT INTO `DistrictRoad`(`DistrictRoadID`, `DistrictID`, `Road`) VALUES ('$Count','$DistrictID','$Road')";
        //echo "$sqlMap";
        $ResultRoad= $connect->query($sqlRoad);
        echo "<script>alert('新增成功！');</script>";
        header("refresh:0;url = administrator.php");
        $connect->close();
        exit;
    }
    elseif($Action == "修改"){
        $sqlRoad =  "UPDATE `DistrictRoad` SET `Road`='$Road' WHERE `DistrictRoadID` = '$RoadID'";
        //echo "$sqlMap";
        $ResultRoad = $connect->query($sqlRoad);
        echo "<script>alert('修改成功！');</script>";
        header("refresh:0;url = administrator.php");
        $connect->close();
        exit;
    }
    elseif($Action == "刪除"){
        $sqlRoad =  "DELETE FROM `DistrictRoad` WHERE `DistrictRoadID` = '$RoadID'";
        //echo "$sqlMap";
        $ResultRoad = $connect->query($sqlRoad);
        echo "<script>alert('刪除成功！');</script>";
        header("refresh:0;url = administrator.php");
        $connect->close();
        exit;
    }
  
?>
