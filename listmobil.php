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

$kueri_mobil = mysqli_query($con, "SELECT mobil.id_vehicle, mobil.no_polisi, mobil.merk, mobil.jenis, mobil.jumlah_ban, mobil.isi_silinder, mobil.tahun_pembuatan, mobil.no_rangka, mobil.no_mesin, mobil.period_stnk, mobil.bahan_bakar, mobil.warna, driver.nama FROM tbl_vehicle AS mobil LEFT JOIN tbl_driver AS driver ON mobil.id_driver = driver.id_driver ORDER BY mobil.id_vehicle LIMIT $posisi,$batas");
$kueri_driver = mysqli_query($con, "SELECT * FROM tbl_driver");
?>
<div><h3><a href="admin.php?page=addvehicle">
<img src="img/Button-Add-icon.png" width="30px" style="padding:5px;" /> Add Vehicle / Mobil
</a></h3>
<form id="form1" name="form1" method="post" action="admin.php?page=configuration&&tab=fvehicle&&halaman=1">
Pencarian by No Polisi
<input name="keyword_vehicle" type="text" id="keyword_vehicle" size="50" maxlength="50" />
<input type="submit" name="button" id="button" value="Search" />
</form>
</div>
<hr/>
<div class="table-responsive">
<table width="100%" class="table table-responsive table-hover">
  <tr>
    <td align="center" bgcolor="grey"><b>ID Mobil</b></td>
    <td align="center"  bgcolor="grey"><b>No Polisi</b></td>
    <td align="center"  bgcolor="grey"><b>Merk</b></td>
    <td align="center"  bgcolor="grey"><b>Jenis</b></td>
    <td align="center"  bgcolor="grey"><b>Jumlah Ban</b></td>
    <td align="center"  bgcolor="grey"><b>Isi Silinder</b></td>
    <td align="center"  bgcolor="grey"><b>Tahun Pembuatan</b></td>
    <td align="center"  bgcolor="grey"><b>No Rangka</b></td>
    <td align="center"  bgcolor="grey"><b>No Mesin</b></td>
    <td align="center"  bgcolor="grey"><b>Period STNK</b></td>
    <td align="center"  bgcolor="grey"><b>Bahan Bakar</b></td>
    <td align="center"  bgcolor="grey"><b>Warna</b></td>
    <td align="center"  bgcolor="grey"><b>PIC Driver</b></td>
    <td align="center"  bgcolor="grey"><b>Config</b></td>
  </tr>
  <?php
  $row = mysqli_num_rows($kueri_mobil);
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
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center">-</td>
    <td align="center" width="10%">-</td>
  </tr>
  <?php
  }
  while($data_mobil = mysqli_fetch_array($kueri_mobil))
  {
  ?>
  <tr>
    <td align="center"><?=$data_mobil['id_vehicle'];?></td>
    <td align="center"><?=$data_mobil['no_polisi'];?></td>
    <td align="center"><?=$data_mobil['merk'];?></td>
    <td align="center"><?=$data_mobil['jenis'];?></td>
    <td align="center"><?=$data_mobil['jumlah_ban'];?></td>
    <td align="center"><?=$data_mobil['isi_silinder'];?></td>
    <td align="center"><?=$data_mobil['tahun_pembuatan'];?></td>
    <td align="center"><?=$data_mobil['no_rangka'];?></td>
    <td align="center"><?=$data_mobil['no_mesin'];?></td>
    <td align="center"><?=$data_mobil['period_stnk'];?></td>
    <td align="center"><?=$data_mobil['bahan_bakar'];?></td>
    <td align="center"><?=$data_mobil['warna'];?></td>
    <td align="center"><?=$data_mobil['nama'];?></td>
    <td align="center"><a href="admin.php?page=editmobil&&id=<?=$data_mobil['id_vehicle'];?>"><div class="icon-edit"></div></a>
    <br />
    <a href="deletemobil.php?id=<?=$data_mobil['id_vehicle'];?>" onClick="return confirm('Are you sure you want to DELETE??');"><div class="icon-trash"></div></a></td>
  </tr>
  <?php
  }
  ?>
</table>
</div>
<div align="center">
	<?php
    $file="admin.php";
    
    $tampil2="select * from tbl_vehicle";
    $hasil2=mysqli_query($con, $tampil2);
    $jmldata=mysqli_num_rows($hasil2);
    
    $jmlhalaman=ceil($jmldata/$batas);
    
    
    //link ke halaman sebelumnya (previous)
    if($halaman > 1)
    {
        $previous=$halaman-1;
        echo "<A HREF=$file?page=configuration&&tab=vehicle&&halaman=1><< First</A> | 
            <A HREF=$file?page=configuration&&tab=vehicle&&halaman=$previous>< Previous</A> | ";
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
      $angka .= "<a href=$file?page=configuration&&tab=vehicle&&halaman=$i>$i</A> ";
    }
    
    $angka .= " <b><u>$halaman</u></b> ";
    for($i=$halaman+1;$i<($halaman+3);$i++)
    {
      if ($i > $jmlhalaman) 
          break;
      $angka .= "<a href=$file?page=configuration&&tab=vehicle&&halaman=$i>$i</A> ";
    }
    
    $angka .= ($halaman+2<$jmlhalaman ? " ...  
              <a href=$file?page=configuration&&tab=vehicle&&halaman=$jmlhalaman>$jmlhalaman</A> " : " ");
    
    echo "$angka";
    
    //link kehalaman berikutnya (Next)
    if($halaman < $jmlhalaman)
    {
        $next=$halaman+1;
        echo " | <A HREF=$file?page=configuration&&tab=vehicle&&halaman=$next>Next ></A> | 
      <A HREF=$file?page=configuration&&tab=vehicle&&halaman=$jmlhalaman>Last >></A> ";
    }
    else
    { 
        echo " | Next > | Last >>";
    }
    echo "<p>Total Item : <b>$jmldata</b> Item</p>";
    
    ?>
</div>