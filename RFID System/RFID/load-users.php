<TABLE id='table'>
<TR>
    <TH>ID.No</TH>
    <TH>Name</TH>
    <TH>CardID</TH>
    <TH>SerialNumber</TH>
    <TH>Time</TH>
</TR>
<?php
session_start();
//Connect to database
require'connectDB.php';

$seldate = $_SESSION["exportdata"];

$sql = "SELECT * FROM new_logs;";
$result=mysqli_query($conn,$sql);

if (mysqli_num_rows($result) > 0)
{
  while ($row = mysqli_fetch_assoc($result))
  {
?>
        <TR>
        <TD><?php echo $row['id'];?></TD>
        <TD><?php echo $row['name'];?></TD>
        <TD><?php echo $row['cardid'];?></TD>
        <TD><?php echo $row['serialno'];?></TD>
        <TD><?php echo $row['Time'];?></TD>
        </TR>
<?php
  }
}
?>
</TABLE>