<?php
session_start();
    //Connect to database
    require'connectDB.php';

$output = '';
$outputdata = $_SESSION['exportdata'];

if(isset($_POST["export"])){

    $query = "SELECT * FROM new_logs;";
    $result = mysqli_query($conn, $query);
    if($result->num_rows > 0){
        $output .= '
                    <table class="table" bordered="1">  
                      <TR>
                        <TH>ID.No</TH>
                        <TH>Name</TH>
                        <TH>CardID</TH>
                        <TH>SerialNumber</TH>
                        <TH>Date</TH>                       
                      </TR>';
		$i = 1
      while($row=$result->fetch_assoc()) {

          $output .= '
                      <TR> 
                          <TD> '.$i.'</TD>
                          <TD> '.$row['name'].'</TD>
                          <TD> '.$row['cardid'].'</TD>
                          <TD> '.$row['serialno'].'</TD>
                          <TD> '.$row['Time'].'</TD>
                      </TR>';
		$i = $i + 1;
      }
      $output .= '</table>';
      header('Content-Type: application/xls');
      header('Content-Disposition: attachment; filename=UserLog'.$outputdata.'.xls');
      echo $output;
    }
    else{
        header( "location: view.php" );
    }
}
?>