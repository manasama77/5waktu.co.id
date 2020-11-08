<link href="tab-content/template5/tabcontent.css" rel="stylesheet" type="text/css" />
<script src="tab-content/tabcontent.js" type="text/javascript"></script>
<?php
$keyword_driver = $_REQUEST['keyword_driver'];

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

if($keyword_driver == NULL)
{
	$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver ORDER BY nama ASC LIMIT $posisi,$batas");
}
else
{
	$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver WHERE nama LIKE '%$keyword_driver%' ORDER BY nama ASC LIMIT $posisi,$batas");
}
?>
<div><h3><a href="admin.php?page=adddriver">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Driver / Supir
</a></h3>
<form id="form1" name="form1" method="post" action="admin.php?page=configuration&&tab=fdriver&&halaman=1">
Pencarian by Nama Driver
<input name="keyword_driver" type="text" id="keyword_driver" size="50" maxlength="50" />
<input type="submit" name="button" id="button" value="Search" />
</form>
</div>
<hr/>
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td width="10%" align="center" bgcolor="grey"><b>ID Driver</b></td>
    <td align="center"  bgcolor="grey"><b>Nama Lengkap</b></td>
    <td width="10%" align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_driver);
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
	  while($data_driver = mysqli_fetch_array($kueri_driver))
	  {
	  ?>
	  <tr>
		<td align="center" width="10%"><?=$data_driver['id_driver'];?></td>
		<td align="center"><?=$data_driver['nama'];?></td>
		<td align="center"><a href="admin.php?page=editdriver&&id=<?=$data_driver['id_driver'];?>"><div class="icon-edit"></div></a>
    	<br />
    	<a href="deletedriver.php?id=<?=$data_driver['id_driver'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
	  </tr>
  <?php
  	  }
  }
  ?>
</table>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="select * from tbl_driver WHERE nama LIKE '%$keyword_driver%'";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=fdriver&&halaman=1&&keyword_driver=$keyword_driver><< First</A> | 
            <A HREF=$file?page=configuration&&tab=fdriver&&halaman=$previous&&keyword_driver=$keyword_driver>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=fdriver&&halaman=$i&&keyword_driver=$keyword_driver>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=fdriver&&halaman=$i&&keyword_driver=$keyword_driver>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=fdriver&&halaman=$jmlhalaman&&keyword_driver=$keyword_driver>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=fdriver&&halaman=$next&&keyword_driver=$keyword_driver>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=fdriver&&halaman=$jmlhalaman&&keyword_driver=$keyword_driver>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>