<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$kueri_class_price_list = mysqli_query($con, "SELECT * FROM tbl_class_price_list ORDER BY class_type ASC");
?>
<div><h3><a href="admin.php?page=addclasspricelist">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Class Price List / Daftar Kelas Harga
</a></h3></div>
<table width="100%" border="1" cellspacing="2" cellpadding="5">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Class Price List</b></td>
    <td align="center"  bgcolor="grey"><b>Class Type</b></td>
    <td align="center"  bgcolor="grey"><b>Weight Class</b></td>
    <td align="center"  bgcolor="grey"><b>Region</b></td>
    <td align="center"  bgcolor="grey"><b>Type Class</b></td>
    <td align="center"  bgcolor="grey"><b>Price</b></td>
    <td align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_class_price_list);
  if($row == NULL)
  {
  ?>
  <tr>
    <td align="center" width="10%">-</td>
    <td align="center">-</td>
    <td align="center" width="10%">-</td>
  </tr>
  <?php
  }
  else
  {	  
	  while($data_class_price_list = mysqli_fetch_array($kueri_class_price_list))
	  {
	  ?>
	  <tr>
		<td align="center"><?=$data_class_type['id_class_price_list'];?></td>
		<td align="center"><?=$data_class_type['class_type'];?></td>
        <td align="center"><?=$data_class_type['weight_class'];?></td>
        <td align="center"><?=$data_class_type['id_region'];?></td>
        <td align="center"><?=$data_class_type['class_type'];?></td>
        <td align="center"><?=$data_class_type['id_class_type'];?></td>
        <td align="center"><?=$data_class_type['price'];?></td>
		<td align="center"><a href="deletemobil.php?id=<?=$data_class_type['id_class_type'];?>"><div class="icon-trash"></div></a></td>
	  </tr>
  <?php
  	  }
  }
  ?>
</table>