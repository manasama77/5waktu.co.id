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

$kueri_dealer = mysqli_query($con, "SELECT dealer.id_dealer, dealer.nama_dealer, expedition.nama_expedition, region.nama_region FROM tbl_dealer AS dealer LEFT JOIN tbl_expedition AS expedition ON dealer.id_expedition = expedition.id_expedition LEFT JOIN tbl_region AS region ON dealer.id_region = region.id_region ORDER BY dealer.nama_dealer ASC LIMIT $posisi,$batas");

?>
<div><h3><a href="admin.php?page=adddealer">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Dealer
</a></h3>
<form id="form1" name="form1" method="post" action="admin.php?page=configuration&&tab=fdealer&&halaman=1">
Pencarian by Dealer Name
<input name="keyword_dealer" type="text" id="keyword_dealer" size="50" maxlength="50" />
<input type="submit" name="button" id="button" value="Search" />
</form>
</div>
<hr/>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Dealer</b></td>
    <td align="center"  bgcolor="grey"><b>Nama Dealer</b></td>
    <td align="center"  bgcolor="grey"><b>Expedition</b></td>
    <td align="center"  bgcolor="grey"><b>Region</b></td>
    <td align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_dealer);
  if($row == NULL)
  {
  ?>
  <tr>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
  </tr>
  <?php
  }
  else
  {	  
	  while($data_dealer = mysqli_fetch_array($kueri_dealer))
	  {
	  ?>
	  <tr>
		<td align="center" width="10%"><?=$data_dealer['id_dealer'];?></td>
		<td align="center"><?=$data_dealer['nama_dealer'];?></td>
        <td align="center"><?=$data_dealer['nama_expedition'];?></td>
        <td align="center"><?=$data_dealer['nama_region'];?></td>
		<td align="center"><a href="admin.php?page=editdealer&&id=<?=$data_dealer['id_dealer'];?>"><div class="icon-edit"></div></a>
    	<br />
    	<a href="deletedealer.php?id=<?=$data_dealer['id_dealer'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
	  </tr>
  <?php
  	  }
  }
  ?>
</table>
</div>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="select * from tbl_dealer";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=dealer&&halaman=1><< First</A> | 
            <A HREF=$file?page=configuration&&tab=dealer&&halaman=$previous>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=dealer&&halaman=$i>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=dealer&&halaman=$i>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=dealer&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=dealer&&halaman=$next>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=dealer&&halaman=$jmlhalaman>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>