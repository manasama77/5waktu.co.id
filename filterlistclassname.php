<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$keyword_class_name = $_REQUEST['keyword_class_name'];

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

if($keyword_class_name == NULL)
{
	$kueri_class_name = mysqli_query($con, "SELECT * FROM tbl_class_name ORDER BY weight_class ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_class_name = mysqli_query($con, "SELECT * FROM tbl_class_name WHERE class_name LIKE '%$keyword_class_name%' ORDER BY weight_class ASC LIMIT $posisi,$batas");
}
?>
<div><h3><a href="admin.php?page=addclassname">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Class Name
</a>
</h3>
<form id="form1" name="form1" method="post" action="admin.php?page=configuration&&tab=fcn&&halaman=1">
    Pencarian by Class Name
    <input name="class_name" type="text" id="class_name" size="50" maxlength="50" />
    <input type="submit" name="button" id="button" value="Search" />
  </form>
</div>
<hr/>
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Class Name</b></td>
    <td align="center"  bgcolor="grey"><b>Class Name</b></td>
    <td align="center"  bgcolor="grey"><b>Weight Class</b></td>
    <td align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_class_name);
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
  else
  {	  
	  while($data_class_name = mysqli_fetch_array($kueri_class_name))
	  {
	  ?>
	  <tr>
		<td align="center"><?=$data_class_name['id_class_name'];?></td>
		<td align="center"><?=$data_class_name['class_name'];?></td>
        <td align="center"><?=strtoupper($data_class_name['weight_class']);?></td>
		<td align="center"><a href="admin.php?page=editclassname&&id=<?=$data_class_name['id_class_name'];?>"><div class="icon-edit"></div></a>
    	<br />
    	<a href="deleteclassname.php?id=<?=$data_class_name['id_class_name'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
	  </tr>
  <?php
  	  }
  }
  ?>
</table>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="SELECT * FROM tbl_class_name WHERE class_name LIKE '%$keyword_class_name%'";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=fcn&&halaman=1&&keyword_class_name=$keyword_class_name><< First</A> | 
            <A HREF=$file?page=configuration&&tab=fcn&&halaman=$previous&&keyword_class_name=$keyword_class_name>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=fcn&&halaman=$i&&keyword_class_name=$keyword_class_name>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=fcn&&halaman=$i&&keyword_class_name=$keyword_class_name>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=fcn&&halaman=$jmlhalaman&&keyword_class_name=$keyword_class_name>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=fcn&&halaman=$next&&keyword_class_name=$keyword_class_name>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=fcn&&halaman=$jmlhalaman&&keyword_class_name=$keyword_class_name>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>