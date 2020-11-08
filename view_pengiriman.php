<?php
include('config.php');
$id = $_REQUEST['id'];
$kueri = mysqli_query($con, "SELECT * FROM tbl_report WHERE id_report = '$id'");
$data = mysqli_fetch_array($kueri);
$id_vehicle = $data['id_vehicle'];
$id_driver = $data['id_driver'];
$id_assistant = $data['id_assistant'];
$id_dealer = $data['id_dealer'];
$id_product_catalog = $data['id_product_catalog'];

?>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <td>ID Report</td>
    <td>:</td>
    <td><?=$data['id_report'];?></td>
  </tr>
  <tr>
    <td>Mobil</td>
    <td>:</td>
    <td><?php
		$kueri_vehicle = mysqli_query($con, "SELECT * FROM tbl_vehicle WHERE id_vehicle = '$id_vehicle'");
		while($data_vehicle = mysqli_fetch_array($kueri_vehicle))
  		{
			echo $data_vehicle['no_polisi'];
		}
		?></td>
  </tr>
  <tr>
    <td>Driver</td>
    <td>:</td>
    <td><?php
		$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver WHERE id_driver = '$id_driver'");
		while($data_driver = mysqli_fetch_array($kueri_driver))
  		{
			echo $data_driver['nama'];
		}
		?></td>
  </tr>
  <tr>
    <td>Assistant</td>
    <td>:</td>
    <td><?php
		$kueri_assistant = mysqli_query($con, "SELECT * FROM tbl_assistant WHERE id_assistant = '$id_assistant'");
		while($data_assistant = mysqli_fetch_array($kueri_assistant))
  		{
			echo $data_assistant['nama'];
		}
		?></td>
  </tr>
  <tr>
    <td>DO Number</td>
    <td>:</td>
    <td><?=$data['do_num'];?></td>
  </tr>
  <tr>
    <td>DO Print Date</td>
    <td>:</td>
    <td><?=$data['do_print_date'];?></td>
  </tr>
  <tr>
    <td>Exit Date</td>
    <td>:</td>
    <td><?=$data['exit_date'];?></td>
  </tr>
  <tr>
    <td>Received Date</td>
    <td>:</td>
    <td><?=$data['received_date'];?></td>
  </tr>
  <tr>
    <td>Received Number</td>
    <td>:</td>
    <td><?=$data['received_num'];?></td>
  </tr>
  <tr>
    <td>Dealer</td>
    <td>:</td>
    <td><?php
		$kueri_dealer = mysqli_query($con, "SELECT * FROM tbl_dealer WHERE id_dealer = '$id_dealer'");
		while($data_dealer = mysqli_fetch_array($kueri_dealer))
  		{
			echo $data_dealer['nama_dealer'];
			$id_expedition = $data_dealer['id_expedition'];
			$id_region = $data_dealer['id_region'];
		}
		?></td>
  </tr>
  <tr>
    <td>Expedition</td>
    <td>:</td>
    <td><?php
		$kueri_expedition = mysqli_query($con, "SELECT * FROM tbl_expedition WHERE id_expedition = '$id_expedition'");
		while($data_expedition = mysqli_fetch_array($kueri_expedition))
  		{
			echo $data_expedition['nama_expedition'];
		}
		?></td>
  </tr>
  <tr>
    <td>Region</td>
    <td>:</td>
    <td><?php
		$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region WHERE id_region = '$id_region'");
		while($region_region = mysqli_fetch_array($kueri_region))
  		{
			echo $region_region['nama_region'];
		}
		?></td>
  </tr>
  <tr>
    <td>Product Name</td>
    <td>:</td>
    <td><?php
		$kueri_product_catalog = mysqli_query($con, "SELECT * FROM tbl_product_catalog WHERE id_product_catalog = '$id_product_catalog'");
		while($data_product_catalog = mysqli_fetch_array($kueri_product_catalog))
  		{
			echo $data_product_catalog['product_name'];
		}
		?></td>
  </tr>
  <tr>
    <td>Class Name</td>
    <td>:</td>
    <td><?php
		//echo $id_product_catalog;
		$kueri_class_type = mysqli_query($con, "SELECT cn.class_name FROM tbl_product_catalog AS pc LEFT JOIN tbl_class_name AS cn ON cn.id_class_name = pc.id_class_name WHERE id_product_catalog = '$id_product_catalog'");
		while($data_class_type = mysqli_fetch_array($kueri_class_type))
  		{
			/*$type = $data_class_type['type'];
			if($type == 'v')
			{
				$type = "Volumetric";
			}
			elseif($type == 'k')
			{
				$type = "per/kg";
			}
			elseif($type == 'j')
			{
				$type = "Jakarta + Real Cost";
			}
			elseif($type == 'p')
			{
				$type = "Price";
			}*/
			//echo $type;
			echo $data_class_type['class_name'];
		}
		?></td>
  </tr>
  <tr>
    <td>Quantity Unit</td>
    <td>:</td>
    <td><?=$data['quantity'];?></td>
  </tr>
  <tr>
    <td>Total Weight (kg)</td>
    <td>:</td>
    <td><?=$data['total_weight'];?></td>
  </tr>
  <tr>
    <td>Total Volume (m3)</td>
    <td>:</td>
    <td><?=$data['total_volumetric'];?></td>
  </tr>
  <tr>
    <td>Price</td>
    <td>:</td>
    <td><?php
		$price = $data['price'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		
		echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?></td>
  </tr>
  <tr>
    <td>Total Price</td>
    <td>:</td>
    <td><?php
		$price = $data['total_price'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		
		echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?></td>
  </tr>
  <tr>
    <td>Notes</td>
    <td>:</td>
    <td><?=$data['description'];?></td>
  </tr>
  <tr>
    <td>Status</td>
    <td>:</td>
    <td><?php
	if($data['do_print_date']=="0000-00-00" && $data['exit_date']=="0000-00-00" && $data['received_date']=="0000-00-00")
	{
		//$status="waiting";
		$late = NULL;
	}
	elseif($data['do_print_date']!=="0000-00-00" && $data['exit_date']="0000-00-00" && $data['received_date']=="0000-00-00")
	{
		//$status="waiting";
		$late = NULL;
	}
	elseif($data['do_print_date']!=="0000-00-00" && $data['exit_date']!=="0000-00-00" && $data['received_date']==NULL)
	{
		//$status="progress";
		$late = NULL;
	}
	elseif($data['do_print_date']!=="0000-00-00"&& $data['exit_date']!=="0000-00-00" && $data['received_date']!=="0000-00-00")
	{
		//$status="<font color=\"green\">Delivered</font>";;
		$late = $data['late'];
		if($late < 0)
		{
			$late = "<font color=\"red\">Late $late Day</font>";
		}
		elseif($late > 0)
		{
			$late = "<font color=\"green\">On Time</font>";
		}
		
	}
	
	echo $data['status'];
	echo("<br>");
	echo $late;
	
	?></td>
  </tr>
</table>
