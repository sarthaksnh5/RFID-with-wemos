<?php 

require('connectDB.php');

if(!empty($_GET['CardID'])){
	$q = mysqli_real_escape_string($con, $_GET['CardID']);
	$query = "Select * from new_users where cardid = '$q';";
	$result = mysqli_query($conn, $query);
	if(mysqli_num_rows($result) > 0){		
		$query = "Select * from new_users where cardid = '$q' and card_sel = 1;";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_assoc($result)){
				$name = $row['name'];
				$serialno = $row['serialno'];
				$gender = $row['gender'];
			}
			
			$sql1 = "INSERT INTO new_logs(name, serialno, gender, cardid) VALUES('$name', '$serialno', '$gender', '$q');";
			$result1 = mysqli_query($conn, $sql1);
			if($result1){
				echo "logs entered";
			}
			else{
				echo "Failed";
			}
		}
		else{
			echo "Card is not verified by customer";
		}
	}
	else{
		$query = "Insert into new_users(cardid) values('$q');";
		$result = mysqli_query($conn, $query);
		if($result){
			echo "Card entered";
		}
		else{
			echo "Failed1";
			
		}
	}
	
	exit();
}

?>
