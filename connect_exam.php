<?php
	$firstName = $_POST['StationID'];
	$newpost1 = $_POST['newpost1'];
	$newpost2 = $_POST['newpost2'];

	// Database connection
	$conn = new mysqli('localhost','root','123456','foodmap');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	}else{
		$stmt = $conn->prepare("insert into restaurant(StationID, newpost1, newpost2) values(?, ?, ?)");
		$stmt->bind_param("sssssi", $StationID, $newpost1, $newpost2);
		$execval = $stmt->execute();
		echo $execval;
		echo "restaurant add.. successfully...";
		$stmt->close();
		$conn->close();
	}
	if(isset($_POST['delete_btn'])){
		$id =$_POST['delete_id'];

		$query = "DELETE FROM 資料庫 WHERE id='$id' ";
		$query_run = mysqli_query($conn,$query);

		if($query_run){
			$_SESSION['success'] = "Your Data is Delete";
			header('Location: 帳號資料庫.php');
		}else{
			$_SESSION['status'] = "Your Data Delete is happen error";
			header('Location: 帳號資料庫.php');
		}
	}
	#參考資料https://www.youtube.com/watch?v=gUf1fpJwvmA&ab_channel=FundaOfWebIT
?>