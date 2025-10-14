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
$kueri_waiting = mysqli_query($con, "SELECT * FROM tbl_report WHERE status='waiting' LIMIT $posisi,$batas");
$row = mysqli_num_rows($kueri_waiting);
?>
Waiting
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
    <td align="center" bgcolor="grey">Config</td>
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
    <td align="center">-</td>
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
    <td align="center"><?php
		$kueri_product_catalog = mysqli_query($con, "SELECT * FROM tbl_product_catalog WHERE id_product_catalog = '$id_product_catalog'");
		while($data_product_catalog = mysqli_fetch_array($kueri_product_catalog))
  		{
			echo $data_product_catalog['product_name'];
		}
		?></td>
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
    <td align="center">
    <a href="admin.php?page=editreport&&id=<//?=$data_waiting['id_report'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deletereport.php?id=<?=$data_waiting['id_report'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a>
    </td>
  </tr>
  <?php
	}
  }
  ?>
</table>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="select * from tbl_report where status='waiting'";
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

<?php
$kueri_progress = mysqli_query($con, "SELECT * FROM tbl_report WHERE status='progress' LIMIT $posisi,$batas");
$row = mysqli_num_rows($kueri_progress);
?>
Progress
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
    <td align="center" bgcolor="grey">Config</td>
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
    <td align="center">-</td>
  </tr>
  <?php
  }
  else
  {
	  while($data_progress = mysqli_fetch_array($kueri_progress))
  	{
	  $no++;
	  $id_vehicle = $data_progress['id_vehicle'];
	  $id_driver = $data_progress['id_driver'];
	  $id_assistant = $data_progress['id_assistant'];
	  $id_dealer = $data_progress['id_dealer'];
	  $id_product_catalog = $data_progress['id_product_catalog'];
  ?>
  <tr>
    <td align="center"><?=$data_progress['id_report'];?></td>
    <td align="center"><?php
		$kueri_product_catalog = mysqli_query($con, "SELECT * FROM tbl_product_catalog WHERE id_product_catalog = '$id_product_catalog'");
		while($data_product_catalog = mysqli_fetch_array($kueri_product_catalog))
  		{
			echo $data_product_catalog['product_name'];
		}
		?></td>
    <td align="center"><?=$data_progress['quantity'];?></td>
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
		$price = $data_progress['price'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		
		echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?></td>
    <td align="center"><?php
		$price = $data_progress['total_price'];
		$jumlah_desimal ="0";
		$pemisah_desimal =",";
		$pemisah_ribuan =".";
		
		echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
		?></td>
    <td align="center">
	<?php
	if($data_progress['do_print_date']=="0000-00-00" && $data_progress['exit_date']=="0000-00-00" && $data_progress['received_date']=="0000-00-00")
	{
		//$status="waiting";
		$late = NULL;
	}
	elseif($data_progress['do_print_date']!=="0000-00-00" && $data_progress['exit_date']="0000-00-00" && $data_progress['received_date']=="0000-00-00")
	{
		//$status="waiting";
	}
	elseif($data_progress['do_print_date']!=="0000-00-00" && $data_progress['exit_date']!=="0000-00-00" && $data_progress['received_date']==NULL)
	{
		//$status="progress";
		$late = NULL;
	}
	elseif($data_progress['do_print_date']!=="0000-00-00"&& $data_progress['exit_date']!=="0000-00-00" && $data_progress['received_date']!=="0000-00-00")
	{
		//$status="<font color=\"green\">Delivered</font>";;
		$late = $data_progress['late'];
		if($late < 0)
		{
			$late = "<font color=\"red\">Late $late Day</font>";
		}
		elseif($late > 0)
		{
			$late = "<font color=\"green\">On Time</font>";
		}
		
	}
	
	echo $data_progress['status'];
	echo("<br>");
	echo $late;
	
	?></td>
    <td align="center"><?=$data_progress['description'];?></td>
    <td align="center">
    <a href="admin.php?page=editreport&&id=<//?=$data_progress['id_report'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deletereport.php?id=<?=$data_progress['id_report'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a>
    </td>
  </tr>
  <?php
	}
  }
  ?>
</table>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="select * from tbl_report where status='progress'";
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