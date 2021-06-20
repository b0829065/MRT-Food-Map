<?php 
    //創建cookie
    session_start();
    setcookie("LoginState", '', time()-3600);
    setcookie("UserName", '', time()-3600);
    

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

    $Account = @$_POST["MemberID"];
    echo $Account;
    echo "<br>";

    $Password = @$_POST["Password"];
    echo $Password;
    echo "<br>";

    $SafeQ1 = @$_POST["SafeQ1"];
    echo $SafeQ1;
    echo "<br>";

    $Answer1 = @$_POST["Answer1"];
    echo $Answer1;
    echo "<br>";

    $SafeQ2 = @$_POST["SafeQ2"];
    echo $SafeQ2;
    echo "<br>";

    $Answer2 = @$_POST["Answer2"];
    echo $Answer2;
    echo "<br>";

    $SafeQ3 = @$_POST["SafeQ3"];
    echo $SafeQ3;
    echo "<br>";

    $Answer3 = @$_POST["Answer3"];
    echo $Answer3;
    echo "<br>";

    if($SafeQ1 == 'none' or $SafeQ2 == 'none' or $SafeQ3 == 'none')
    {
        echo "<script>alert('請重新選擇安全問題！');</script>";
        echo "<meta http-equiv='Refresh' content='0; URL=register.php'>"; 

        $connect->close();
        exit;
    }

    $registerState = true;
    $sqlUser = "SELECT * FROM `Member`";
    $resultUser = $connect->query($sqlUser);
    if ($resultUser->num_rows > 0) {
        while ($rowUser = $resultUser->fetch_assoc())
        {
            $ID = $rowUser['Account'];

            if($ID ==  $Account)
            {
                echo "<br>";
                echo "<script>alert('帳號重複，請重新填寫！');</script>";
                echo "<meta http-equiv='Refresh' content='0; URL=register.php'>"; 
                $registerState = false;
                $connect->close();
                exit;
            }

        }
    }
    if($SafeQ1 == 'none' or $SafeQ2 == 'none' or $SafeQ3 == 'none')
    {
        echo "<script>alert('請重新選擇安全問題！');</script>";
        echo "<meta http-equiv='Refresh' content='0; URL=register.php'>"; 
        $registerState = false;
        $connect->close();
        exit;
    }

    if($registerState){
        $sqlMember = "INSERT INTO `Member`(`Account`, `Password`) VALUES ('$Account', '$Password')";
        $resultMember = $connect->query($sqlMember);
        echo $sqlMember;
        echo "<br>";

        $sqlAnswer1 = "INSERT INTO `MemberQA`(`Account`, `QuestionID`, `Answer`) VALUES ('$Account', '$SafeQ1', '$Answer1')";
        $resultAnswer1 = $connect->query($sqlAnswer1);
        echo $sqlAnswer1;

        $sqlAnswer2 = "INSERT INTO `MemberQA`(`Account`, `QuestionID`, `Answer`) VALUES ('$Account', '$SafeQ2', '$Answer2')";
        $resultAnswer2 = $connect->query($sqlAnswer2);
        echo $sqlAnswer2;
        echo "<br>";

        $sqlAnswer3 = "INSERT INTO `MemberQA`(`Account`, `QuestionID`, `Answer`) VALUES ('$Account', '$SafeQ3', '$Answer3')";
        $Answer3 = $connect->query($sqlAnswer3);
        echo $sqlAnswer3;
        echo "<br>";
        
        echo "<script>alert('註冊成功！');</script>";
        header("refresh:0;url = index.php");
        $connect->close();
        
        exit;
    }
?>