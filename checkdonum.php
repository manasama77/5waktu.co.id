<?php
include('config.php');

if(isset($_POST['do_num']))
{
 $name=$_POST['do_num'];

 $checkdata=" SELECT do_num FROM tbl_pengiriman WHERE do_num='$name' ";

 $query=mysqli_query($con, $checkdata);

 if(mysqli_num_rows($query)>0)
 {
  echo "<b><font color=\"red\">DO Number Already Exist</font></b>";
 }
 else
 {
  echo "<b><font color=\"green\">OK</font></b>";
 }
 exit();
}
?>