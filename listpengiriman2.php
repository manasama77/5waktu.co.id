<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<style>
td{ font-size:12px; }
</style>
<?php
$batas=10;
if(isset($_GET['halaman']))
{
	$halaman=$_GET['halaman'];
	$posisi = ($halaman-1) * $batas;
}
else
{
	$posisi=0;
	$halaman=1;
}
$kueri_report = mysqli_query($con, "SELECT * FROM tbl_report LIMIT $posisi,$batas");
$no=$posisi+1;
?>
<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Report</b></td>
    <td align="center" bgcolor="grey"><b>Mobil</b></td>
    <td align="center"  bgcolor="grey"><b>Driver</b></td>
    <td align="center"  bgcolor="grey"><b>Asst.</b></td>
    <td align="center"  bgcolor="grey"><b>DO Num.</b></td>
    <td align="center"  bgcolor="grey"><b>DO Print Date</b></td>
    <td align="center"  bgcolor="grey"><b>Exit Date</b></td>
    <td align="center"  bgcolor="grey"><b>Received Date</b></td>
    <td align="center"  bgcolor="grey"><b>Late Date</b></td>
    <td align="center"  bgcolor="grey"><b>Received Num.</b></td>
    <td align="center"  bgcolor="grey"><b>Dealer</b></td>
    <td align="center"  bgcolor="grey"><b>Expedition</b></td>
    <td align="center"  bgcolor="grey"><b>Region</b></td>
    <td align="center"  bgcolor="grey"><b>Product Name</b></td>
    <td align="center"  bgcolor="grey"><b>Class Name</b></td>
    <td align="center"  bgcolor="grey"><b>Quantity<br />Unit</b></td>
    <td align="center"  bgcolor="grey"><b>Total Weight<br />(kg)</b></td>
    <td align="center"  bgcolor="grey"><b>Total Volume<br />(m3)</b></td>
    <td align="center"  bgcolor="grey"><b>Price</b></td>
    <td align="center"  bgcolor="grey"><b>Total Price</b></td>
    <td align="center"  bgcolor="grey"><b>Desc.</b></td>
    <td align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_report);
  if($row == NULL)
  {
  ?>
  <tr>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
  </tr>
  <?php
  }
  ?>
  <?php
  while($data_report = mysqli_fetch_array($kueri_report))
  {
	  $no++;
	  $id_vehicle = $data_report['id_vehicle'];
	  $id_driver = $data_report['id_driver'];
	  $id_assistant = $data_report['id_assistant'];
	  $id_dealer = $data_report['id_dealer'];
	  $id_product_catalog = $data_report['id_product_catalog'];
  ?>
  <tr>
    <td align="center" width="10%">
		<?=$data_report['id_report'];?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$kueri_vehicle = mysqli_query($con, "SELECT * FROM tbl_vehicle WHERE id_vehicle = '$id_vehicle'");
		while($data_vehicle = mysqli_fetch_array($kueri_vehicle))
  		{
			echo $data_vehicle['no_polisi'];
		}
		?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver WHERE id_driver = '$id_driver'");
		while($data_driver = mysqli_fetch_array($kueri_driver))
  		{
			echo $data_driver['nama'];
		}
		?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$kueri_assistant = mysqli_query($con, "SELECT * FROM tbl_assistant WHERE id_assistant = '$id_assistant'");
		while($data_assistant = mysqli_fetch_array($kueri_assistant))
  		{
			echo $data_assistant['nama'];
		}
		?>
    </td>
    
    <td align="center" width="10%">
		<?=$data_report['do_num'];?>
    </td>
    
    <td align="center" width="10%">
		<?=$data_report['do_print_date'];?>
    </td>
    
    <td align="center" width="10%">
		<?=$data_report['exit_date'];?>
    </td>
    
    <td align="center" width="10%">
		<?=$data_report['received_date'];?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$late_date = $data_report['late_date'];
		if($late_date == NULL)
		{
			$late_date = 0;
		}			
		?>
		<?=$late_date;?> Day
    </td>

    
    <td align="center" width="10%">
		<?=$data_report['received_num'];?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$kueri_dealer = mysqli_query($con, "SELECT * FROM tbl_dealer WHERE id_dealer = '$id_dealer'");
		while($data_dealer = mysqli_fetch_array($kueri_dealer))
  		{
			echo $data_dealer['nama_dealer'];
			$id_expedition = $data_dealer['id_expedition'];
			$id_region = $data_dealer['id_region'];
		}
		?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$kueri_expedition = mysqli_query($con, "SELECT * FROM tbl_expedition WHERE id_expedition = '$id_expedition'");
		while($data_expedition = mysqli_fetch_array($kueri_expedition))
  		{
			echo $data_expedition['nama_expedition'];
		}
		?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region WHERE id_region = '$id_region'");
		while($region_region = mysqli_fetch_array($kueri_region))
  		{
			echo $region_region['nama_region'];
		}
		?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$kueri_product_catalog = mysqli_query($con, "SELECT * FROM tbl_product_catalog WHERE id_product_catalog = '$id_product_catalog'");
		while($data_product_catalog = mysqli_fetch_array($kueri_product_catalog))
  		{
			echo $data_product_catalog['product_name'];
		}
		?>
    </td>
    
    <td align="center" width="10%">
		<?php
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
		?>
    </td>
    
    <td align="center" width="10%">
		<?=$data_report['quantity'];?>
    </td>
    
    <td align="center" width="10%">
		<?=$data_report['total_weight'];?>
    </td>
    
    <td align="center" width="10%">
		<?=$data_report['total_volume'];?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$price = $data_report['price'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		
		echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
    </td>
    
    <td align="center" width="10%">
		<?php
		$price = $data_report['total_price'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		
		echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?>
    </td>
    
    <td align="center" width="10%">
		<?=$data_report['description'];?>
    </td>
    
    <td align="center">
    	<a href="admin.php?page=editreport&&id=<?=$data_report['id_report'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deletereport.php?id=<?=$data_report['id_report'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a>
	</td>
  </tr>
  <?php
  }
  ?>
</table>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="select * from tbl_report";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=pengiriman&&halaman=1><< First</A> | 
            <A HREF=$file?page=pengiriman&&halaman=$previous>< Previous</A> | ";
    }
    else
    { 
        echo "<< First | < Previous | ";
    }
    
    $angka=($halaman > 3 ? " ... " : " ");
    for($i=$halaman-2;$i<$halaman;$i++)
    {
      if ($i < 1) 
          continue;
      $angka .= "<a href=$file?page=pengiriman&&halaman=$i>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=pengiriman&&halaman=$i>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=pengiriman&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=pengiriman&&halaman=$next>Next ></A> | 
      <A HREF=$file?page=pengiriman&&halaman=$jmlhalaman>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>