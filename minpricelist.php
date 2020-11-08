<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
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
$kueri_min_pricelist = mysqli_query($con, "SELECT * FROM tbl_min_pricelist AS mpl LEFT JOIN tbl_region AS region ON mpl.id_region = region.id_region ORDER BY mpl.id_min_pricelist LIMIT $posisi,$batas");
?>
<div><h3><a href="admin.php?page=addminpricelist">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Min Price List
</a></h3>
<form id="form1" name="form1" method="post" action="admin.php?page=configuration&&tab=fmpl&&halaman=1">
Pencarian by Region
<input name="keyword_min_pricelist" type="text" id="keyword_min_pricelist" size="50" maxlength="50" />
<input type="submit" name="button" id="button" value="Search" />
</form>
</div>
<hr/>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Min Price List</b></td>
    <td align="center"  bgcolor="grey"><b>Region</b></td>
    <td align="center"  bgcolor="grey"><b>Min Price List</b></td>
    <td align="center"  bgcolor="grey"><b>Satuan Volumetric</b></td>
    <td align="center"  bgcolor="grey"><b>Satuan Weight</b></td>
	<td align="center"  bgcolor="grey"><b>Satuan Volumetric C</b></td>
    <td align="center"  bgcolor="grey"><b>Satuan Weight C</b></td>
    <td align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_min_pricelist);
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
  </tr>
  <?php
  }
  while($data_min_pricelist = mysqli_fetch_array($kueri_min_pricelist))
  {
  ?>
  <tr>
    <td align="center"><?=$data_min_pricelist['id_min_pricelist'];?></td>
    <td align="center"><?=$data_min_pricelist['nama_region'];?></td>
    <td align="center">
    <?php
	$price = $data_min_pricelist['price_list'];
	$jumlah_desimal ="0";
	$pemisah_desimal =",";
	$pemisah_ribuan =".";
	
	echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	?>
    </td>
	<td align="center">
    <?php
	$price = $data_min_pricelist['satuan_volumetric'];
	$jumlah_desimal ="0";
	$pemisah_desimal =",";
	$pemisah_ribuan =".";
	
	echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	?>
    </td>
	<td align="center">
    <?php
	$price = $data_min_pricelist['satuan_weight'];
	$jumlah_desimal ="0";
	$pemisah_desimal =",";
	$pemisah_ribuan =".";
	
	echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	?>
    </td>
	<td align="center">
    <?php
	$price = $data_min_pricelist['satuan_volumetric_c'];
	$jumlah_desimal ="0";
	$pemisah_desimal =",";
	$pemisah_ribuan =".";
	
	echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	?>
    </td>
	<td align="center">
    <?php
	$price = $data_min_pricelist['satuan_weight_c'];
	$jumlah_desimal ="0";
	$pemisah_desimal =",";
	$pemisah_ribuan =".";
	
	echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	?>
    </td>
    <td align="center"><a href="admin.php?page=editminpricelist&&id=<?=$data_min_pricelist['id_min_pricelist'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deleteminpricelist.php?id=<?=$data_min_pricelist['id_min_pricelist'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="SELECT mpl.id_min_pricelist, region.nama_region, mpl.price_list FROM tbl_min_pricelist AS mpl LEFT JOIN tbl_region AS region ON mpl.id_region = region.id_region";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=mpl&&halaman=1><< First</A> | 
            <A HREF=$file?page=configuration&&tab=mpl&&halaman=$previous>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=mpl&&halaman=$i>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=mpl&&halaman=$i>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=mpl&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=mpl&&halaman=$next>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=mpl&&halaman=$jmlhalaman>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>