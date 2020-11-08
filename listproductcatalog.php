<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
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
$kueri_product_catalog = mysqli_query($con, "SELECT product.id_product_catalog, product.product_name, product.weight, product.volumetric, product.panjang, product.lebar, product.tinggi, product.packing_status, cn.class_name FROM tbl_product_catalog AS product LEFT JOIN tbl_class_name AS cn ON product.id_class_name = cn.id_class_name ORDER BY product.product_name ASC LIMIT $posisi,$batas");

/*
while($data = mysqli_fetch_array($kueri_product_catalog))
{
	foreach($data AS $key)
	{
		echo $key;
	}
}*/
?>
<div>
  <h3><a href="admin.php?page=addproductcatalog">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Product Catalog</a></h3>
  <form id="form1" name="form1" method="post" action="admin.php?page=product&&filter">
    Search by Product
    <input name="keyword" type="text" id="keyword" size="50" maxlength="50" />
    <input type="submit" name="button" id="button" value="Search" />
  </form>
</div>
<hr/>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Product Catalog</b></td>
    <td align="center"  bgcolor="grey"><b>Product Name</b></td>
    <td align="center"  bgcolor="grey"><b>Weight</b></td>
    <td align="center"  bgcolor="grey"><b>Volumetric</b></td>
    <td align="center"  bgcolor="grey"><b>Panjang</b></td>
    <td align="center"  bgcolor="grey"><b>Lebar</b></td>
    <td align="center"  bgcolor="grey"><b>Tinggi</b></td>
    <td align="center"  bgcolor="grey"><b>Packing Status</b></td>
    <td align="center"  bgcolor="grey"><b>Class Name</b></td>
    <td align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_product_catalog);
  if($row == NULL)
  {
  ?>
  <tr>
    <td align="center" width="10%">-</td>
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
  while($data_product_catalog = mysqli_fetch_array($kueri_product_catalog))
  {
  ?>
  <tr>
    <td align="center"><?=$data_product_catalog['id_product_catalog'];?></td>
    <td align="center"><?=$data_product_catalog['product_name'];?></td>
    <td align="center"><?=$data_product_catalog['weight'];?></td>
    <td align="center"><?=$data_product_catalog['volumetric'];?></td>
    <td align="center"><?=$data_product_catalog['panjang'];?></td>
    <td align="center"><?=$data_product_catalog['lebar'];?></td>
    <td align="center"><?=$data_product_catalog['tinggi'];?></td>
    <td align="center"><?=$data_product_catalog['packing_status'];?></td>
    <td align="center"><?=$data_product_catalog['class_name'];?></td>
    <td align="center"><a href="admin.php?page=editproductcatalog&&id=<?=$data_product_catalog['id_product_catalog'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deleteproductcatalog.php?id=<?=$data_product_catalog['id_product_catalog'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="select * from tbl_product_catalog";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=product&&halaman=1><< First</A> | 
            <A HREF=$file?page=product&&halaman=$previous>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=product&&halaman=$i>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=product&&halaman=$i>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=product&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=product&&halaman=$next>Next ></A> | 
      <A HREF=$file?page=product&&halaman=$jmlhalaman>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>