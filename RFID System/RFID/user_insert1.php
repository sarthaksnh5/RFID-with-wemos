<?php
session_start();

//Connect to database
require 'connectDB.php';
//**********************************************************************************************
//**********************************************************************************************
if ($_SERVER["REQUEST_METHOD"] == "POST"){

	if(isset($_POST['login'])) {

      $Uname = $_POST['Uname'];
      $Number = $_POST['Number'];
      $gender= $_POST['gender'];
      $card = $_POST['cardId'];
	  
	  $sql = "UPDATE new_users set name = '$Uname', serialno = '$Number', gender = '$gender', card_sel = 1 where cardid = '$card' ";
	  $result = mysqli_query($conn, $sql);
	  if($result){
		header("location: AddCard1.php?success=Updated");
        exit();
	  }
	  else{
		  header("location: AddCard1.php?error=SQL_Error");
		  exit();
	  }
      
  }
//**********************************************************************************************  
//**********************************************************************************************
    if(isset($_POST['del']))  {

        
        if (!empty($_POST['CardID'])) {

            $CardID = $_POST['CardID'];
            $sql = "DELETE from new_users where cardid = '$CardID';";
			$result = mysqli_query($conn, $sql);
			if($result){
			header("location: AddCard.php?success=deleted");
            exit();
			}
        else{
            header("location: AddCard.php?error=No_SelID");
            exit();
        }
	
    }
}
}
//**********************************************************************************************
?>