<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$keyword_min_pricelist = $_REQUEST['keyword_min_pricelist'];
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
if($keyword_min_pricelist == NULL)
{
	$kueri_min_pricelist = mysqli_query($con, "SELECT mpl.id_min_pricelist, region.nama_region, mpl.price_list FROM tbl_min_pricelist AS mpl LEFT JOIN tbl_region AS region ON mpl.id_region = region.id_region ORDER BY mpl.id_min_pricelist LIMIT $posisi,$batas");
}
else
{
	$kueri_min_pricelist = mysqli_query($con, "SELECT mpl.id_min_pricelist, region.nama_region, mpl.price_list FROM tbl_min_pricelist AS mpl LEFT JOIN tbl_region AS region ON mpl.id_region = region.id_region WHERE region.nama_region LIKE '%$keyword_min_pricelist%' ORDER BY mpl.id_min_pricelist LIMIT $posisi,$batas");
}
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
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Min Price List</b></td>
    <td align="center"  bgcolor="grey"><b>Region</b></td>
    <td align="center"  bgcolor="grey"><b>Price List</b></td>
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
    <td align="center"><a href="admin.php?page=editminpricelist&&id=<?=$data_min_pricelist['id_min_pricelist'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deleteminpricelist.php?id=<?=$data_min_pricelist['id_min_pricelist'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
  </tr>
  <?php
  }
  ?>
</table>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="SELECT * FROM tbl_min_pricelist AS mpl LEFT JOIN tbl_region AS region ON mpl.id_region = region.id_region WHERE region.nama_region LIKE'%$keyword_min_pricelist%'";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=fmpl&&halaman=1&&keyword_min_pricelist=$keyword_min_pricelist><< First</A> | 
            <A HREF=$file?page=configuration&&tab=fmpl&&halaman=$previous&&keyword_min_pricelist=$keyword_min_pricelist>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=fmpl&&halaman=$i&&keyword_min_pricelist=$keyword_min_pricelist>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=fmpl&&halaman=$i&&keyword_min_pricelist=$keyword_min_pricelist>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=fmpl&&halaman=$jmlhalaman&&keyword_min_pricelist=$keyword_min_pricelist>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=fmpl&&halaman=$next&&keyword_min_pricelist=$keyword_min_pricelist>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=fmpl&&halaman=$jmlhalaman&&keyword_min_pricelist=$keyword_min_pricelist>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>