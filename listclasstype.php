<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$kueri_class_type = mysqli_query($con, "SELECT * FROM tbl_class_type ORDER BY class_type_name ASC");
?>
<div><h3><a href="admin.php?page=addclasstype">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Class Type / Tipe Kelas
</a></h3></div>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td width="10%" align="center" bgcolor="grey"><b>ID Class Type</b></td>
    <td align="center"  bgcolor="grey"><b>Name Type Class</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_class_type);
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
	  while($data_class_type = mysqli_fetch_array($kueri_class_type))
	  {
	  ?>
	  <tr>
		<td align="center" width="10%"><?=$data_class_type['id_class_type'];?></td>
		<td align="center"><?=$data_class_type['class_type_name'];?></td>
		<td align="center"><a href="admin.php?page=editclasstype&&id=<?=$data_class_type['id_class_type'];?>"><div class="icon-edit"></div></a>
    	<br />
    	<a href="deleteclasstype.php?id=<?=$data_class_type['id_class_type'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
	  </tr>
  <?php
  	  }
  }
  ?>
</table>
</div>