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

    $InputID = @$_POST["MemberID"];
    
    echo "<br>";

    $InputPasswd = @$_POST["Password"];
    
    echo "<br>";

    $sqlUser = "SELECT * FROM `Member`";
    $resultUser = $connect->query($sqlUser);

    $Root = 'false';
    $AccountState = false;//Account是否正確
    $PasswordState = false;//Password是否正確

    if ($resultUser->num_rows > 0) {
        while ($rowUser = $resultUser->fetch_assoc())
        {
            $ID = $rowUser['Account'];
            $Password = $rowUser['Password'];
            
            if($ID == 'root')
            {
                $Root = true;
            }

            if($ID == $InputID)
            {
                $AccountState = true;
                echo "<br>";
                echo "ID OK";
            }
            if($Password == $InputPasswd)
            {
                $PasswordState = true;
                echo "<br>";
                echo "Passwd OK";
            }
        }
    }
    if($Root and $PasswordState)
    {
        setcookie("LoginState", true, time()+3600);
        setcookie("UserName", $InputID, time()+3600);
        echo "<script>alert('You are KING！');</script>";
        header('refresh:0;url = administrator.php');
        $connect->close();
        exit;
    } 

    if(!$AccountState or !$PasswordState)
    {
        echo "<script>alert('帳號或密碼錯誤，請重新輸入！');</script>";
        $connect->close();
        setcookie("LoginState", false, time()+3600);
        header('refresh:0;url = login.html'); 
        exit;
    }
    
    if($AccountState and $PasswordState)
    {
        setcookie("LoginState", true, time()+3600);
        setcookie("UserName", $InputID, time()+3600);
        echo "<script>alert('登入成功！');</script>";
        header('refresh:0;url = index.php');
        $connect->close();
        exit;
    } 

    //echo $AccountState;
    //echo $PasswordState;
?>