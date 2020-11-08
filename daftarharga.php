<div class="container">
	<div class="widget-header"><i class="fa fa-list-alt"></i><h3>Daftar Harga</h3>
</div>
<div class="widget-content">
<div id="formcontrols" class="tab-pane active">
	<form id="add_dealer1" class="form-horizontal" action="admin.php?page=daftarharga&&showdata=on" method="post">
		<fieldset>
			
			<div class="control-group">
				<label class="control-label">Kota</label>
				<div class="controls">
					<select name="id_kota" id="id_kota">
					<?php
					$kueri_kota = mysqli_query($con, "SELECT * FROM tbl_kota ORDER BY nama_kota ASC");
					while($data_kota=mysqli_fetch_array($kueri_kota))
					{
						$id_kota=$data_kota['id_kota'];
						$nama_kota=$data_kota['nama_kota'];
					?>
					  <option value="<?php echo $id_kota; ?>"><?php echo $nama_kota; ?></option>
					<?php
					}
					?>
					</select>
				</div>
			</div>
			
			<div class="form-actions">
				<button class="btn btn-primary" type="submit">Submit</button>
			</div>
		</fieldset>
	</form>
</div>
<hr />
<?php
if(isset($_REQUEST['showdata']))
{
	$kueri_nama_kota = mysqli_query($con, "SELECT nama_kota, satuan_penghitungan FROM tbl_kota WHERE id_kota = ".$_REQUEST['id_kota']);
	$data_nama_kota = mysqli_fetch_array($kueri_nama_kota);
	$id_kota=$_REQUEST['id_kota'];
?>
<h3>Kota: <?=$data_nama_kota['nama_kota'];?></h3>
<h4>Jenis Penghitungan: <?=strtoupper($data_nama_kota['satuan_penghitungan']);?></h4><hr>
<?php
if($data_nama_kota['satuan_penghitungan'] == 'weight')
{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td align="center"><h4>Class A</h4></td>
		<td align="center" width="10px">&nbsp;</td>
		<td align="center"><h4>Class B</h4></td>
		<td align="center" width="10px">&nbsp;</td>
		<td align="center"><h4>Class C</h4></td>
    </tr>
	<tr>
	  <td valign="top">
		<table width="100%" class="table table-responsive table-hover">
			<tr>
				<td align="center" bgcolor="grey"><b>Produk Name</b></td>
				<td align="center" bgcolor="grey"><b>Kategori Produk</b></td>
				<td align="center" bgcolor="grey"><b>Satuan Harga</b></td>
				</tr>
			<?php
			$kueri_produk_katalog_a = mysqli_query($con, "SELECT pk.produk_name, kp.id_kategori_produk, kp.nama_kategori_produk FROM tbl_produk_katalog AS pk Left Join tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE kp.weight_class =  'a' ORDER BY pk.produk_name ASC");
			while($data_produk_katalog_a=mysqli_fetch_array($kueri_produk_katalog_a))
			{
				$id_kategori_produk = $data_produk_katalog_a['id_kategori_produk'];
				$nama_kategori_produk = $data_produk_katalog_a['nama_kategori_produk'];
				$produk_name = $data_produk_katalog_a['produk_name'];
				$kueri_satuan_harga_a = mysqli_query($con, "SELECT satuan_harga FROM tbl_satuan_harga_kota WHERE id_kota =  '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
				$data_satuan_harga_a = mysqli_fetch_array($kueri_satuan_harga_a);
				$satuan_harga_a = $data_satuan_harga_a['satuan_harga'];
			?>
			<tr>
				<td align="center"><?=$data_produk_katalog_a['produk_name'];?></td>
				<td align="center"><?=$data_produk_katalog_a['nama_kategori_produk'];?></td>
				<td align="center"><?=$satuan_harga_a;?></td>
			</tr>
			<?php
			}
			?>
		</table>
	  </td>
	  <td>&nbsp;</td>
	  <td valign="top">
		<table width="100%" class="table table-responsive table-hover">
			<tr>
				<td align="center" bgcolor="grey"><b>Produk Name</b></td>
				<td align="center" bgcolor="grey"><b>Kategori Produk</b></td>
				<td align="center" bgcolor="grey"><b>Satuan Harga</b></td>
				</tr>
			<?php
			$kueri_produk_katalog_b = mysqli_query($con, "SELECT pk.produk_name, kp.id_kategori_produk, kp.nama_kategori_produk FROM tbl_produk_katalog AS pk Left Join tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE kp.weight_class =  'b' ORDER BY pk.produk_name ASC");
			while($data_produk_katalog_b=mysqli_fetch_array($kueri_produk_katalog_b))
			{
				$id_kategori_produk_b = $data_produk_katalog_b['id_kategori_produk'];
				$nama_kategori_produk_b = $data_produk_katalog_b['nama_kategori_produk'];
				$produk_name_b = $data_produk_katalog_b['produk_name'];
				
				$kueri_satuan_harga_b = mysqli_query($con, "SELECT satuan_harga FROM tbl_satuan_harga_kota WHERE id_kota =  '$id_kota' AND id_kategori_produk = '$id_kategori_produk_b'");
				$data_satuan_harga_b = mysqli_fetch_array($kueri_satuan_harga_b);
				$satuan_harga_b = $data_satuan_harga_b['satuan_harga'];
			?>
			<tr>
				<td align="center"><?=$produk_name_b;?></td>
				<td align="center"><?=$nama_kategori_produk_b;?></td>
				<td align="center"><?=$satuan_harga_b;?></td>
			</tr>
			<?php
			}
			?>
		</table>
	  </td>
	  <td>&nbsp;</td>
	  <td valign="top">
		<table width="100%" class="table table-responsive table-hover">
			<tr>
				<td align="center" bgcolor="grey"><b>Produk Name</b></td>
				<td align="center" bgcolor="grey"><b>Satuan Harga</b></td>
				<td align="center" bgcolor="grey"><b>Minimum Harga</b></td>
			</tr>
			<?php
			$kueri_produk_katalog_c = mysqli_query($con, "SELECT pk.produk_name, kp.id_kategori_produk FROM tbl_produk_katalog AS pk Left Join tbl_kategori_produk AS kp ON pk.id_kategori_produk = kp.id_kategori_produk WHERE kp.weight_class =  'c' ORDER BY pk.produk_name ASC");
			while($data_produk_katalog_c=mysqli_fetch_array($kueri_produk_katalog_c))
			{
				$id_kategori_produk_c = $data_produk_katalog_c['id_kategori_produk'];
				$produk_name_c = $data_produk_katalog_c['produk_name'];
				
				$kueri_satuan_harga_c = mysqli_query($con, "SELECT satuan_harga FROM tbl_satuan_harga_kota WHERE id_kota =  '$id_kota' AND id_kategori_produk = '$id_kategori_produk_c'");
				$data_satuan_harga_c = mysqli_fetch_array($kueri_satuan_harga_c);
				$satuan_harga_c = $data_satuan_harga_c['satuan_harga'];
				
				$kueri_minimum_harga_c = mysqli_query($con, "SELECT satuan_harga_minimum FROM tbl_satuan_harga_minimum WHERE id_kota =  '$id_kota'");
				$data_minimum_harga_c = mysqli_fetch_array($kueri_minimum_harga_c);
				$minimum_harga_c = $data_minimum_harga_c['satuan_harga_minimum'];
			?>
			<tr>
				<td align="center"><?=$produk_name_c;?></td>
				<td align="center"><?=$satuan_harga_c;?></td>
				<td align="center"><?=$minimum_harga_c;?></td>
			</tr>
			<?php
			}
			?>
		</table>
	  </td>
    </tr>
</table>
<?php
}
elseif($data_nama_kota['satuan_penghitungan'] == 'volumetric')
{
?>
	<table width="100%" class="table table-responsive table-hover">
		<tr>
			<td align="center" bgcolor="grey"><b>Produk Name</b></td>
			<td align="center" bgcolor="grey"><b>Satuan Harga</b></td>
			<div class="alert alert-info" align="center"><b>Jenis Penghitungan <u>Volumetric</u> Semua produk dihitung sama, tidak terpisah berdasarkan Kelompok Weight Class A, B, C</b></div>
			</tr>
		<?php
		$kueri_produk_katalog_vol = mysqli_query($con, "SELECT produk_name FROM tbl_produk_katalog ORDER BY produk_name ASC");
		while($data_produk_katalog_vol=mysqli_fetch_array($kueri_produk_katalog_vol))
		{
			$id_kota = $_REQUEST['id_kota'];
			$produk_name = $data_produk_katalog_vol['produk_name'];
			$kueri_satuan_harga_vol = mysqli_query($con, "SELECT satuan_harga_volumetric FROM tbl_satuan_harga_volumetric WHERE id_kota =  '$id_kota'");
			$data_satuan_harga_vol = mysqli_fetch_array($kueri_satuan_harga_vol);
			$satuan_harga_volumetric = $data_satuan_harga_vol['satuan_harga_volumetric'];
		?>
		<tr>
			<td align="center"><?=$produk_name;?></td>
			<td align="center"><?=$satuan_harga_volumetric;?></td>
		</tr>
		<?php
		}
		?>
	</table>
<?php
}
}
?>
</div>