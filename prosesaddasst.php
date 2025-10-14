<?php
include('config.php');
$nama_asst= $_REQUEST['nama_asst'];
$kueri_cek = mysqli_query($con, "SELECT * FROM tbl_asst WHERE nama_asst = '$nama_asst'");
$row = mysqli_num_rows($kueri_cek);
if($row == NULL)
{
	$kueri2 = mysqli_query($con, "INSERT INTO tbl_asst (id_asst, nama_asst) VALUES ('','$nama_asst')");
	if($kueri2)
	{
		header("location:admin.php?page=asst");
	}
	else
	{
		header("location:admin.php?page=addasst&&error=2");
	}
}
else
{
	header("location:admin.php?page=addasst&&error=1&&nama_asst=$nama_asst");

}
?>