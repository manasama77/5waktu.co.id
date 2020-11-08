<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$kueri_class_pricelist = mysqli_query($con, "SELECT
cn.class_name,
cn.weight_class
FROM
tbl_class_pricelist AS cpl
Left Join tbl_class_name AS cn ON cpl.id_class_name = cn.id_class_name
GROUP BY
cn.class_name
ORDER BY
cn.weight_class ASC
");
$kueri_row_class_name = mysqli_query($con, "SELECT class_name FROM tbl_class_name ORDER by weight_class ASC");
$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region AS region ORDER BY region.nama_region ASC");
$kueri_harga = mysqli_query($con, "SELECT
cpl.price,
cpl.class_type
FROM
tbl_class_pricelist AS cpl
Left Join tbl_region ON cpl.id_region = tbl_region.id_region");

?>
<div><h3><a href="admin.php?page=addclasspricelist">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Class Price List
</a></h3></div>

<table width="100%" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <td align="center" bgcolor="grey"><div style="font-size:9px;">Class Name</div></td>
    <td align="center" bgcolor="grey"><div style="font-size:9px;">Weight Class</div></td>
    <?php
	$row_class_name = mysqli_num_rows($kueri_row_class_name);
	$row_region = mysqli_num_rows($kueri_region);
  	while($data_region = mysqli_fetch_array($kueri_region))
  	{
  	?>
    <td width="10" align="center" bgcolor="grey"><div style="font-size:9px;"><?=$data_region['nama_region'];?></div></td>
    <?php
	}
	?>
  </tr>
  <?php
  for($y=1; $y<=$row_class_name; $y++)
  {
	  $data_class_pricelist = mysqli_fetch_array($kueri_class_pricelist);
  ?>
      <tr>
        <td><div style="font-size:9px;"><?=$data_class_pricelist['class_name'];?></div></td>
        <td><div style="font-size:9px;"><?=$data_class_pricelist['weight_class'];?></div></td>
        <?php
        for($i=1; $i<=$row_region; $i++)
        {
			$data_harga = mysqli_fetch_array($kueri_harga);
			$price = $data_harga['price'];
        ?>
            <td>
            <div style="font-size:9px;">
				<?php
				if($data_harga['class_type'] == "volumetric")
				{
					$price = "Volumetric";
				}
				elseif($data_harga['class_type'] == "weight")
				{
					$price = "Weight";
				}
				?>
				<?=$price;?>
            </div>
            </td>
        <?php
        }
        ?>
      </tr>
  <?php
  }
  ?>
  <!--tr>
    <td><div style="font-size:9px;">Class Name2</div></td>
    <td><div style="font-size:9px;">Class Type2</div></td>
    <td><div style="font-size:9px;">Weight Class2</div></td>
    <td><div style="font-size:9px;">Price2</div></td>
  </tr-->
</table>
<p>&nbsp;</p>
