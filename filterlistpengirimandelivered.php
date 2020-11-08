<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<style>
td{ font-size:12px; }
</style>
<?php
$batas=5;
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
	
$no=$posisi+1;
?>
<?php
$keyword=$_REQUEST['keyword'];
$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_report as r left join tbl_product_catalog as pc on r.id_product_catalog = pc.id_product_catalog WHERE product_name like '%$keyword%' and status='delivered' LIMIT $posisi,$batas");
$row = mysqli_num_rows($kueri_waiting);
?>
<form id="form1" name="form1" method="post" action="admin.php?page=pengiriman&amp;&amp;status=filterdelivered">
  Search by Product
  <input name="keyword" type="text" id="keyword" size="50" maxlength="50" />
  <input type="submit" name="button" id="button" value="Search" />
</form>
<hr />
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey">ID Report</td>
    <td align="center" bgcolor="grey">Product</td>
    <td align="center" bgcolor="grey">Qty</td>
    <td align="center" bgcolor="grey">Dealer</td>
    <td align="center" bgcolor="grey">Price</td>
    <td align="center" bgcolor="grey">Total Price</td>
    <td align="center" bgcolor="grey">Status</td>
    <td align="center" bgcolor="grey">Notes</td>
    <?php
	if($_SESSION['login']['username'] == "sales")
	{
	?>
    <?php
	}
	else
	{
	?>
    <td align="center" bgcolor="grey">Config</td>
    <?php
	}
	?>
  </tr>
  <?php
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
    <?php
	if($_SESSION['login']['username'] == "sales")
	{
	?>
    <?php
	}
	else
	{
	?>
    <td align="center">-</td>
    <?php
	}
	?>
  </tr>
  <?php
  }
  else
  {
	  while($data_waiting = mysqli_fetch_array($kueri_waiting))
  	{
	  $no++;
	  $id_vehicle = $data_waiting['id_vehicle'];
	  $id_driver = $data_waiting['id_driver'];
	  $id_assistant = $data_waiting['id_assistant'];
	  $id_dealer = $data_waiting['id_dealer'];
	  $id_product_catalog = $data_waiting['id_product_catalog'];
  ?>
  <tr>
    <td align="center"><?=$data_waiting['id_report'];?></td>
    <td align="center">
    <?php
	$kueri_product_catalog = mysqli_query($con, "SELECT * FROM tbl_product_catalog WHERE id_product_catalog = '$id_product_catalog'");
	while($data_product_catalog = mysqli_fetch_array($kueri_product_catalog))
  	{
	?>
	<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal<?=$data_waiting['id_report'];?>"><?=$data_product_catalog['product_name'];?></button>
	<?php
	}
	?>
	<!-- Modal -->
	<?php
	$id_report=$data_waiting['id_report'];
	$kueri_modal=mysqli_query($con, "
	SELECT
	tbl_report.id_report as 'id_report',
	tbl_vehicle.no_polisi as 'vehicle_num',
	tbl_driver.nama as 'nama_driver',
	tbl_assistant.nama as 'nama_asst',
	tbl_report.do_num as 'do_num',
	tbl_report.do_print_date as 'do_print_date',
	tbl_report.exit_date as 'exit_date',
	tbl_report.estimation_date as 'estimation_date',
	tbl_report.received_date as 'received_date',
	tbl_report.received_num as 'received_num',
	tbl_dealer.nama_dealer as 'nama_dealer',
	tbl_expedition.duration as 'duration',
	tbl_expedition.nama_expedition as 'nama_expedition',
	tbl_region.nama_region as 'nama_region',
	tbl_product_catalog.product_name as 'product_name',
	tbl_class_name.class_name as 'class_name',
	tbl_report.quantity as 'quantity',
	tbl_report.total_weight as 'total_weight',
	tbl_report.total_volumetric as 'total_volumetric',
	tbl_report.price as 'price',
	tbl_report.total_price as 'total_price',
	tbl_report.description as 'description',
	tbl_report.status as 'status'
	FROM
	tbl_report
	INNER JOIN tbl_vehicle ON tbl_report.id_vehicle = tbl_vehicle.id_vehicle
	INNER JOIN tbl_driver ON tbl_report.id_driver = tbl_driver.id_driver
	INNER JOIN tbl_assistant ON tbl_report.id_assistant = tbl_assistant.id_assistant
	INNER JOIN tbl_dealer ON tbl_report.id_dealer = tbl_dealer.id_dealer
	INNER JOIN tbl_expedition ON tbl_dealer.id_expedition = tbl_expedition.id_expedition
	INNER JOIN tbl_region ON tbl_dealer.id_region = tbl_region.id_region
	INNER JOIN tbl_product_catalog ON tbl_report.id_product_catalog = tbl_product_catalog.id_product_catalog
	INNER JOIN tbl_class_name ON tbl_product_catalog.id_class_name = tbl_class_name.id_class_name
	WHERE id_report = $id_report
	");
	$data_modal=mysqli_fetch_array($kueri_modal);
	?>
		<div class="modal fade" id="myModal<?=$data_waiting['id_report'];?>" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Detail Info</h4>
					</div>
					<div class="modal-body">
						<table width="100%" class="table table-responsive table-hover">
						<tr>
							<td width="30px">ID Report</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['id_report'];?></td>
						</tr>
						<tr>
							<td>Mobil</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['vehicle_num'];?></td>
						</tr>
						<tr>
							<td>Driver</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['nama_driver'];?></td>
						</tr>
						<tr>
							<td>Asst.</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['nama_asst'];?></td>
						</tr>
						<tr>
							<td>DO Num</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['do_num'];?></td>
						</tr>
						<tr>
							<td>DO Print Date</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['do_print_date'];?></td>
						</tr>
						<tr>
							<td>Exit Date</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['exit_date'];?></td>
						</tr>
						<tr>
							<td>Estimation Date</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['estimation_date'];?></td>
						</tr>
						<tr>
							<td>Received Date</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['received_date'];?></td>
						</tr>
							<td>Received Num</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['received_num'];?></td>
						</tr>
						<tr>
							<td>Dealer</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['nama_dealer'];?></td>
						</tr>
						<tr>
							<td>Expedition</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['nama_expedition'];?> (<?=$data_modal['duration'];?> Day)</</td>
						</tr>
						<tr>
							<td>Region</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['nama_region'];?></td>
						</tr>
						<tr>
							<td>Product Name</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['product_name'];?></td>
						</tr>
						<tr>
							<td>Class Name</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['class_name'];?></td>
						</tr>
						<tr>
							<td>Quantity</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['quantity'];?></td>
						</tr>
						<tr>
							<td>Total Weight</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['total_weight'];?></td>
						</tr>
						<tr>
							<td>Total Volume</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['total_volumetric'];?></td>
						</tr>
						<tr>
							<td >Price / Unit</td>
							<td width="5px" align="center">:</td>
							<td width="100px">
							<?php
							$price = $data_modal['price'];
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							
							echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							?>
							</td>
						</tr>
						<tr>
							<td>Total Price</td>
							<td width="5px" align="center">:</td>
							<td width="100px">
							<?php
							$price = $data_modal['total_price'];
							$jumlah_desimal ="0";
							$pemisah_desimal =",";
							$pemisah_ribuan =".";
							
							echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
							?>
							</td>
						</tr>
						<tr>
							<td>Status</td>
							<td width="5px" align="center">:</td>
							<td width="100px">
							<?php
							$status=strtoupper($data_modal['status']);
							echo $status;
							?>
							</td>
						</tr>
						<tr>
							<td>Notes</td>
							<td width="5px" align="center">:</td>
							<td width="100px"><?=$data_modal['description'];?></td>
						</tr>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
			  </div>
			</div>
		</div>
    </td>
    <td align="center"><?=$data_waiting['quantity'];?></td>
    <td align="center"><?php
		$kueri_dealer = mysqli_query($con, "SELECT * FROM tbl_dealer WHERE id_dealer = '$id_dealer'");
		while($data_dealer = mysqli_fetch_array($kueri_dealer))
  		{
			echo $data_dealer['nama_dealer'];
			$id_expedition = $data_dealer['id_expedition'];
			$id_region = $data_dealer['id_region'];
		}
		?></td>
    <td align="center"><?php
		$price = $data_waiting['price'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		
		echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?></td>
    <td align="center"><?php
		$price = $data_waiting['total_price'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		
		echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?></td>
    <td align="center">
	<?php
	if($data_waiting['do_print_date']=="0000-00-00" && $data_waiting['exit_date']=="0000-00-00" && $data_waiting['received_date']=="0000-00-00")
	{
		//$status="waiting";
		$late = NULL;
	}
	elseif($data_waiting['do_print_date']!=="0000-00-00" && $data_waiting['exit_date']="0000-00-00" && $data_waiting['received_date']=="0000-00-00")
	{
		//$status="waiting";
		$late = NULL;
	}
	elseif($data_waiting['do_print_date']!=="0000-00-00" && $data_waiting['exit_date']!=="0000-00-00" && $data_waiting['received_date']==NULL)
	{
		//$status="progress";
		$late = NULL;
	}
	elseif($data_waiting['do_print_date']!=="0000-00-00"&& $data_waiting['exit_date']!=="0000-00-00" && $data_waiting['received_date']!=="0000-00-00")
	{
		//$status="<font color=\"green\">Delivered</font>";;
		$late = $data_waiting['late'];
		if($late < 0)
		{
			$late = "<font color=\"red\">Late $late Day</font>";
		}
		elseif($late > 0)
		{
			$late = "<font color=\"green\">On Time</font>";
		}
		
	}
	
	echo $data_waiting['status'];
	echo("<br>");
	echo $late;
	
	?></td>
    <td align="center"><?=$data_waiting['description'];?></td>
    <?php
	if($_SESSION['login']['username'] == "sales")
	{
	?>
    <?php
	}
	else
	{
	?>
    <td align="center">
    <a href="admin.php?page=editreport&&id=<?=$data_waiting['id_report'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deletereport.php?status=delivered&&id=<?=$data_waiting['id_report'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a>
    </td>
    <?php
	}
	?>
  </tr>
  <?php
	}
  }
  ?>
</table>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="SELECT * FROM tbl_report as r left join tbl_product_catalog as pc on r.id_product_catalog = pc.id_product_catalog WHERE product_name like '%$keyword%' and status='delivered'";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=pengiriman&&status=filterdelivered&&halaman=1&&keyword=$keyword><< First</A> | 
            <A HREF=$file?page=pengiriman&&status=filterdelivered&&halaman=$previous&&keyword=$keyword>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=pengiriman&&status=filterdelivered&&halaman=$i&&keyword=$keyword>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=pengiriman&&status=filterdelivered&&halaman=$i&&keyword=$keyword>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=pengiriman&&status=filterdelivered&&halaman=$jmlhalaman&&keyword=$keyword>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=pengiriman&&status=filterdelivered&&halaman=$next&&keyword=$keyword>Next ></A> | 
      <A HREF=$file?page=pengiriman&&status=filterdelivered&&halaman=$jmlhalaman&&keyword=$keyword>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>

<script language="javascript" type="text/javascript">
<!--
function popitup(url) {
	newwindow=window.open(url,'name');
	if (window.focus) { newwindow.focus() }
	return false;
}

// -->
</script>