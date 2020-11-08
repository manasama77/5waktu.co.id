<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
include("config2.php");
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
//$kueri_price_list = mysqli_query($con, "SELECT price.type, price.perkalian, price.id_product_price_list, pc.product_name, cp.class_type, region.nama_region, price.price FROM tbl_product_price_list AS price LEFT JOIN tbl_product_catalog AS pc ON price.id_product_catalog = pc.id_product_catalog LEFT JOIN tbl_class_price AS cp ON price.id_class_price = cp.id_class_price LEFT JOIN tbl_region AS region ON price.id_region = region.id_region ORDER BY price.id_product_price_list ASC LIMIT $posisi,$batas");

$kueri_hitung_region = mysqli_query($con, "SELECT * FROM tbl_region ORDER BY nama_region ASC");
$kueri = mysqli_query($con, "SELECT class_name, product_name, price, nama_region FROM tbl_class_name cn JOIN tbl_product_catalog tpc JOIN tbl_class_pricelist cpl JOIN tbl_region reg WHERE cn.id_class_name = tpc.id_class_name and cpl.id_class_name = cn.id_class_name and reg.id_region = cpl.id_region GROUP BY reg.nama_region ASC");
$kueri_hitung_region2 = mysqli_query($con, "SELECT id_region, nama_region
FROM tbl_region
GROUP BY
tbl_region.nama_region
ORDER BY nama_region ASC");
$row_hitung_region2 = mysqli_num_rows($kueri_hitung_region2);
//echo $row_hitung_region2;



$row_region = mysqli_num_rows($kueri_hitung_region);
//echo $row_region;
//echo("<br>");
$kueri_hitung_product = mysqli_query($con, "SELECT
product.id_class_name,
product.product_name,
cn.class_name,
cn.weight_class
FROM
tbl_product_catalog AS product
LEFT JOIN tbl_class_name AS cn ON cn.id_class_name = product.id_class_name");

$row_product = mysqli_num_rows($kueri);
//echo $row_product;
//echo("<br>");
?>

<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td align="center" bgcolor="grey"><b><span style="font-size:9px">No</span></b></td>
    <td align="center" bgcolor="grey"><b><span style="font-size:9px">Class Type</span></b></td>
    <td align="center"  bgcolor="grey"><b><span style="font-size:9px">Product Name</span></b></td>
    <?php
	for($i=1;$i<=$row_region;$i++)
	{
		$data_region=mysqli_fetch_array($kueri_hitung_region);
		$id_region[0]=$data_region['id_region'];
		$nama_region[0]=$data_region['nama_region'];
	?>
    <td align="center"  bgcolor="grey">
        <b><span style="font-size:9px">
        <?php
		foreach($id_region as $key)
		{
			echo $key;
		}
		?>
        <br />
		<?php
		foreach($nama_region as $key2)
		{
			echo $key2;
		}
		?>
        </span></b>
    </td>
    <?php
	}
	?>
  </tr>
  <?php
  //$no=0;
  for($j=1;$j<=$row_product;$j++)
  {
	//$no++;
	$data_product=mysqli_fetch_array($kueri);
	$data_hitung_region2 = mysqli_fetch_array($kueri_hitung_region2);
  ?>
  <tr>
    <td align="center"><span style="font-size:9px"><?=$j;?></span></td>
    <td align="center"><span style="font-size:9px">
	<?=$data_product['class_name'];?>
    <br />
	<!--?=$data_product['class_name'];?-->
    </span></td>
    <td align="center"><span style="font-size:9px"><?=$data_product['product_name'];?></span></td>
	<?php
	for($i=1;$i<=$row_region;$i++)
	{
	?>
    <td align="center"><span style="font-size:9px"><?=$data_product['price'];?></span></td>
	<?php
	}
	?>
	<!--?php
	//PRICE
	for($i=1;$i<=$row_region;$i++)
	{
		//$id_class_name = $data_product['id_class_name'];
		$product_name2[0] = $data_product['product_name'];
		foreach($product_name2 as $key3)
		{
			$product_name3=$key3;
			//echo($product_name3);
			//echo(" - ");
		}
		//echo $regional;
		$col_region[0]=$data_hitung_region2['id_region'];
		foreach($col_region as $keyabc=>$value)
		{
			$regional=$value;
			$kueri_harga_region=mysqli_query($con, "select cpl.price
			from tbl_class_pricelist as cpl
			left join tbl_product_catalog as product on cpl.id_class_name = product.id_class_name
			where product.product_name = '$product_name3' and cpl.id_region = '$regional'");
			
			$data_price = mysqli_fetch_array($kueri_harga_region);
			$harga=$data_price['price'];
		}
		
	?-->
    <!--td align="center">
    <span style="font-size:9px"-->
    	<!--?=$harga;?-->
    <!--/span>
    </td-->
    <!--?php
	}
	?-->
  </tr>
  <?php
  }
  ?>
</table>