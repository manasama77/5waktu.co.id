<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$kueri_class_price = mysqli_query($con, "SELECT price.id_class_price, price.class_type, price.weight_class, region.nama_region FROM tbl_class_price AS price LEFT JOIN tbl_region AS region ON price.id_region = region.id_region ORDER BY price.class_type");
$kueri_region = mysqli_query($con, "SELECT * FROM tbl_region");
?>
<div><h3><a href="admin.php?page=addclassprice">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Class Price / Kelas Harga
</a></h3></div>
<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Class Price</b></td>
    <td align="center"  bgcolor="grey"><b>Class Name</b></td>
    <td align="center"  bgcolor="grey"><b>Weight Class</b></td>
    <!--td align="center"  bgcolor="grey"><b>Region</b></td-->
    <!--td align="center"  bgcolor="grey"><b>Class Type</b></td>
    <td align="center"  bgcolor="grey"><b>Price</b></td-->
    <td align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_class_price);
  if($row == NULL)
  {
  ?>
  <tr>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <!--td align="center">-</td-->
    <!--td align="center">-</td>
    <td align="center">-</td-->
  </tr>
  <?php
  }
  while($data_class_price = mysqli_fetch_array($kueri_class_price))
  {
  ?>
  <tr>
    <td align="center"><?=$data_class_price['id_class_price'];?></td>
    <td align="center"><?=$data_class_price['class_type'];?></td>
    <td align="center"><?=$data_class_price['weight_class'];?></td>
    <!--td align="center"><//?=$data_class_price['nama_region'];?></td-->
    <!--td align="center"><?//=$data_class_price['class_type_name'];?></td>
    <td align="center"><?//=$data_class_price['price'];?></td-->
    <td align="center"><a href="admin.php?page=editclassprice&&id=<?=$data_class_price['id_class_price'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deleteclassprice.php?id=<?=$data_class_price['id_class_price'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
  </tr>
  <?php
  }
  ?>
</table>