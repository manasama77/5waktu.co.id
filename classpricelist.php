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

$kueri_class_pricelist = mysqli_query($con, "
SELECT cpl.id_class_pricelist, cn.class_name, cn.weight_class, cpl.class_type, cpl.price, region.nama_region
FROM tbl_class_pricelist AS cpl
LEFT JOIN tbl_class_name AS cn
ON cpl.id_class_name=cn.id_class_name
LEFT JOIN tbl_region AS region
ON cpl.id_region=region.id_region
ORDER BY cn.weight_class LIMIT $posisi,$batas");

$kueri_region = mysqli_query($con, "
SELECT region.nama_region
FROM tbl_region AS region
ORDER BY region.nama_region");

$row_class_pricelist = mysqli_num_rows($kueri_class_pricelist);
//echo $row_class_pricelist;
//echo ("<br>");
$row_region = mysqli_num_rows($kueri_region);
//echo $row_region;
?>
<div><h3><a href="admin.php?page=addclasspricelist">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Class Price List / Daftar Kelas Harga
</a><br />
</h3>
  <form id="form1" name="form1" method="post" action="admin.php?page=configuration&&tab=fcpl&&halaman=1">
    Pencarian by Price
    <input name="price" type="text" id="price" size="10" maxlength="10" />
    <input type="submit" name="button" id="button" value="Search" />
  </form>
</div>
<hr/>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey">ID Class Price List</td>
    <td align="center" bgcolor="grey">Class Name</td>
    <td align="center" bgcolor="grey">Weight Class</td>
    <td align="center" bgcolor="grey">Class Type</td>
    <td align="center" bgcolor="grey">Price</td>
    <td align="center" bgcolor="grey">Region</td>
    <td align="center" bgcolor="grey">Config</td>
  </tr>
  <?php
  while($data_class_pricelist=mysqli_fetch_array($kueri_class_pricelist))
  {
  ?>
  <tr>
    <td align="center"><?=$data_class_pricelist['id_class_pricelist'];?></td>
    <td align="center"><?=$data_class_pricelist['class_name'];?></td>
    <td align="center"><?=strtoupper($data_class_pricelist['weight_class']);?></td>
    <td align="center"><?=strtoupper($data_class_pricelist['class_type']);?></td>
    <td align="center">
    <?php
	$price = $data_class_pricelist['price'];
	$jumlah_desimal ="0";
	$pemisah_desimal =",";
	$pemisah_ribuan =".";
	
	echo "Rp ".number_format($price, $jumlah_desimal, $pemisah_desimal, $pemisah_ribuan);
	?>
    </td>
    <td align="center"><?=$data_class_pricelist['nama_region'];?></td>
    <td align="center"><a href="admin.php?page=editclasspricelist&&id=<?=$data_class_pricelist['id_class_pricelist'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deleteclassprice.php?id=<?=$data_class_pricelist['id_class_pricelist'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="select * from tbl_class_pricelist";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=cpl&&halaman=1><< First</A> | 
            <A HREF=$file?page=configuration&&tab=cpl&&halaman=$previous>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=cpl&&halaman=$i>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=cpl&&halaman=$i>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=cpl&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=cpl&&halaman=$next>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=cpl&&halaman=$jmlhalaman>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>