<TABLE  id="table">
  <TR>
    <TH>Sr.No.</TH>
    <TH>Name</TH>
    <TH>Number</TH>
    <TH>Gender</TH>
    <TH>CardID</TH>
  </TR>
<?php 
//Connect to database
require('connectDB.php');

$sql ="SELECT * FROM new_users ORDER BY id DESC";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result) > 0)
{
	$i = 1;
  while ($row = mysqli_fetch_assoc($result))
    {
?>
   <TR onclick="enterData(<?php echo $row['cardid']; ?>)">
      <TD><?php echo $i?></TD>
      <TD><?php echo $row['name']?></TD>
      <TD><?php echo $row['serialno']?></TD>
      <TD><?php echo $row['gender']?></TD>
      <TD><?php echo $row['cardid'];
          if ($row['card_sel'] == 1) {
              echo '<img src="image/che.png" style="margin-right: 60%; float: right;" width="20" height="20" title="The selected Card">';
          }
          else{
              echo '<img src="image/add.png" style="margin-right: 60%; float: right;" width="20" height="20" title="The selected Card">';
          }?>
      </TD>
   </TR>
<?php   
	$i = $i + 1;
    }
}
?>
</TABLE>