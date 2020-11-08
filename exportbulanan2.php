<?php
$excel_bulanan=$_REQUEST['excel_bulanan'];
$excel_tahun=$_REQUEST['excel_tahun'];
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="js/jquery.table2excel.js"></script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" cellspacing="0" cellpadding="0" border="1" class="table2excel" data-tableName="Test Table 1">
  <tr>
    <td colspan="22"><h3>Report Monthly - <?=$excel_bulanan;?></h3></td>
  </tr>
  <tr>
    <td>DO NUM</td>
	<td>Status Delivery</td>
    <td>WAREHOUSE</td>
    <td>DO Print Date</td>
	<td>Exit Date</td>
	<td>Exit Time</td>
	<td>Delivery to Expedition</td>
	<td>Estimation Date</td>
	<td>Received Date</td>
	<td>Received Num</td>
	<td>Received Name</td>
	<td>Dealer</td>
	<td>City</td>
	<td>Expedition</td>
	<td>Product Name</td>
	<td>Weight</td>
	<td>Volumetric</td>
	<td>Quantity</td>
	<td>Calculated Bases</td>
	<td>Basic Cost (IDR)</td>
	<td>Total Cost (IDR)</td>
	<td>Total DO Cost (IDR)</td>
  </tr>
  	<?php
  	include("config.php");
  
  	//query menampilkan data
    $kueri = mysqli_query($con, "
    SELECT
tbl_pengiriman.id_pengiriman,
tbl_pengiriman.random_id,
tbl_pengiriman.do_num,
tbl_pengiriman.nama_gudang AS warehouse,
tbl_pengiriman.do_print_date,
tbl_pengiriman.exit_date,
tbl_pengiriman.waktu_pengiriman AS exit_time,
tbl_pengiriman.date_terima_ekspedisi AS delivery_to_expedition,
tbl_pengiriman.estimation_date,
tbl_pengiriman.received_date,
tbl_pengiriman.received_num,
tbl_dealer.nama_dealer,
tbl_kota.nama_kota,
tbl_ekspedisi.nama_ekspedisi,
tbl_kota.satuan_penghitungan AS calculated_bases,
tbl_kota.id_kota,
tbl_pengiriman.sum_harga AS total_do_cost,
tbl_mobil.no_polisi AS delivery_truck,
tbl_driver.nama_driver AS truck_driver,
tbl_pengiriman.status_pengiriman AS status_delivery,
tbl_pengiriman.status_penerimaan,
tbl_pengiriman.late,
tbl_pengiriman.received_name
FROM
tbl_pengiriman
Left Join tbl_dealer ON tbl_pengiriman.id_dealer = tbl_dealer.id_dealer
Left Join tbl_kota ON tbl_dealer.id_kota = tbl_kota.id_kota
Left Join tbl_ekspedisi ON tbl_dealer.id_ekspedisi = tbl_ekspedisi.id_ekspedisi
Left Join tbl_mobil ON tbl_pengiriman.id_mobil = tbl_mobil.id_mobil
Left Join tbl_driver ON tbl_pengiriman.id_driver = tbl_driver.id_driver
WHERE MONTH(tbl_pengiriman.exit_date) = '$excel_bulanan'
AND YEAR(tbl_pengiriman.exit_date) = '$excel_tahun'
    ");
	//$total_data=mysqli_num_rows($kueri);
	//echo "total data: $total_data <br>";
    $no = 0;
    //$row=mysqli_num_rows($kueri);
    while($data=mysqli_fetch_array($kueri))
    	{
    		$random_id=$data['random_id'];
    		$do_num=$data['do_num'];
       		$warehouse=$data['warehouse'];
       		$do_print_date=$data['do_print_date'];
       		$exit_date=$data['exit_date'];
       		$exit_time=$data['exit_time'];
       		$delivery_to_expedition=$data['delivery_to_expedition'];
       		$estimation_date=$data['estimation_date'];
       		$received_date=$data['received_date'];
       		$received_num=$data['received_num'];
       		$nama_dealer=$data['nama_dealer'];
       		$nama_kota=$data['nama_kota'];
       		$nama_ekspedisi=$data['nama_ekspedisi'];
			
       		$calculated_bases=$data['calculated_bases'];
       		$id_kota=$data['id_kota'];
       		$total_do_cost=$data['total_do_cost'];
       		$delivery_truck=$data['delivery_truck'];
       		$truck_driver=$data['truck_driver'];
       		$status_delivery=$data['status_delivery'];
       		$status_penerimaan=$data['status_penerimaan'];
       		$late=$data['late'];
       		$received_name=$data['received_name'];
       		//$notes=$data['notes'];
			
			$kueri2=mysqli_query($con,"
				SELECT
				tbl_produk_katalog.produk_name
				FROM
				tbl_produk_katalog
				LEFT Join temp_produk ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
				WHERE temp_produk.random_id='$random_id'");
			
			$total_produk=mysqli_num_rows($kueri2);
			$batas=$total_produk-1;
			//echo "total produk: $total_data <br>";
			
			if($total_produk>1)
			{
	?>
	
	
	
  <tr>
    <td rowspan="<?=$total_produk;?>"><?=$do_num;?></td>
	<td rowspan="<?=$total_produk;?>"><?=$status_delivery;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$warehouse;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$do_print_date;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$exit_date;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$exit_time;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$delivery_to_expedition;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$estimation_date;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$received_date;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$received_num;?></td>
	<td rowspan="<?=$total_produk;?>"><?=$received_name;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$nama_dealer;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$nama_kota;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$nama_ekspedisi;?></td>
	<?php
	$kueri3=mysqli_query($con,"
			SELECT
			tbl_produk_katalog.id_produk_katalog,
			tbl_produk_katalog.produk_name,
			tbl_produk_katalog.weight,
			tbl_produk_katalog.volumetric,
			temp_produk.quantity,
			tbl_kategori_produk.id_kategori_produk,
			tbl_kategori_produk.weight_class,
			temp_produk.total_harga
			FROM
			tbl_produk_katalog
			LEFT Join temp_produk ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
			LEFT Join tbl_kategori_produk ON tbl_kategori_produk.id_kategori_produk = tbl_produk_katalog.id_kategori_produk
			WHERE temp_produk.random_id='$random_id'
			LIMIT 0,1");
	$data_produk=mysqli_fetch_array($kueri3);
	
	$produk_name=$data_produk['produk_name'];
	$weight=$data_produk['weight'];
	$volumetric=$data_produk['volumetric'];
	$quantity=$data_produk['quantity'];
	$total_weight=$weight*$quantity;
	$id_kategori_produk=$data_produk['id_kategori_produk'];
	$total_harga=$data_produk['total_harga'];
	
	//PENGHITUNGAN HARGA DASAR
						if($calculated_bases=="weight")
						{
							$weight_class=$data_produk['weight_class'];
							
							$id_produk_katalog=$data_produk['id_produk_katalog'];
							
							if($weight_class=="c" && $id_kategori_produk==11)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight>=21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight<=20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==12)
							{
								if($quantity<=25)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/25;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==14)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $total_weight<="20")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_minimum'];
							}
							elseif($weight_class=="c" && $total_weight>="21")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==8)
							{
								if($quantity<=6)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/6;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==6  || $id_kategori_produk==7  || $id_kategori_produk==9)
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_electone'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_clavinova'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
							}
							else
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
								
							}
						}elseif($calculated_bases=="volumetric"){
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_volumetric'];
						}
	?>
    <td><?=$produk_name;?></td>
    <td><?=$weight;?></td>
    <td><?=$volumetric;?></td>
    <td><?=$quantity;?></td>
    <td><?=$calculated_bases;?></td>
    <td><?=$harga_dasar;?></td>
    <td><?=$total_harga;?></td>
    <td rowspan="<?=$total_produk;?>"><?=$total_do_cost;?></td>
	
  </tr>
  
  
  
  <?php
  $kueri4=mysqli_query($con,"
			SELECT
			tbl_produk_katalog.id_produk_katalog,
			tbl_produk_katalog.produk_name,
			tbl_produk_katalog.weight,
			tbl_produk_katalog.volumetric,
			temp_produk.quantity,
			tbl_kategori_produk.id_kategori_produk,
			tbl_kategori_produk.weight_class,
			temp_produk.total_harga
			FROM
			tbl_produk_katalog
			LEFT Join temp_produk ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
			LEFT Join tbl_kategori_produk ON tbl_kategori_produk.id_kategori_produk = tbl_produk_katalog.id_kategori_produk
			WHERE temp_produk.random_id='$random_id'
			LIMIT 1,$batas");
			
	$total_produk2=mysqli_num_rows($kueri4);
	//echo $total_produk2;
	for($i=0;$i<$total_produk2;$i++)
	{
		$data_produk2=mysqli_fetch_array($kueri4);
		
		$produk_name=$data_produk2['produk_name'];
		$weight=$data_produk['weight'];
		$volumetric=$data_produk['volumetric'];
		$quantity=$data_produk['quantity'];
		$total_weight=$weight*$quantity;
		$id_kategori_produk=$data_produk['id_kategori_produk'];
		$total_harga=$data_produk['total_harga'];
		
		if($calculated_bases=="weight")
						{
							$weight_class=$data_produk['weight_class'];
							
							$id_produk_katalog=$data_produk['id_produk_katalog'];
							
							if($weight_class=="c" && $id_kategori_produk==11)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight>=21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight<=20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==12)
							{
								if($quantity<=25)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/25;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==14)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $total_weight<="20")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_minimum'];
							}
							elseif($weight_class=="c" && $total_weight>="21")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==8)
							{
								if($quantity<=6)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/6;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==6  || $id_kategori_produk==7  || $id_kategori_produk==9)
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_electone'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_clavinova'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
							}
							else
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
								
							}
						}elseif($calculated_bases=="volumetric"){
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_volumetric'];
						}
  ?>
  <tr>
	<td><?=$produk_name;?></td>
	<td><?=$weight;?></td>
	<td><?=$volumetric;?></td>
	<td><?=$quantity;?></td>
	<td><?=$calculated_bases;?></td>
	<td><?=$harga_dasar;?></td>
	<td><?=$total_harga;?></td>
  </tr>
  	<?php
	}
			}
			else
			{
				//jika data produk cuma 1
	?>
	
	
	
	
	
	
	
	
	
  <tr>
    <td><?=$do_num;?></td>
    <td><?=$status_delivery;?></td>
    <td><?=$warehouse;?></td>
    <td><?=$do_print_date;?></td>
    <td><?=$exit_date;?></td>
    <td><?=$exit_time;?></td>
    <td><?=$delivery_to_expedition;?></td>
    <td><?=$estimation_date;?></td>
    <td><?=$received_date;?></td>
    <td><?=$received_num;?></td>
    <td><?=$received_name;?></td>
    <td><?=$nama_dealer;?></td>
    <td><?=$nama_kota;?></td>
    <td><?=$nama_ekspedisi;?></td>
	<?php
	$kueri5=mysqli_query($con,"
			SELECT
			tbl_produk_katalog.id_produk_katalog,
			tbl_produk_katalog.produk_name,
			tbl_produk_katalog.weight,
			tbl_produk_katalog.volumetric,
			temp_produk.quantity,
			tbl_kategori_produk.id_kategori_produk,
			tbl_kategori_produk.weight_class,
			temp_produk.total_harga
			FROM
			tbl_produk_katalog
			LEFT Join temp_produk ON temp_produk.id_produk_katalog = tbl_produk_katalog.id_produk_katalog
			LEFT Join tbl_kategori_produk ON tbl_kategori_produk.id_kategori_produk = tbl_produk_katalog.id_kategori_produk
			WHERE temp_produk.random_id='$random_id'
			LIMIT 0,1");
	$data_produk=mysqli_fetch_array($kueri5);
	
	$produk_name=$data_produk['produk_name'];
	$weight=$data_produk['weight'];
	$volumetric=$data_produk['volumetric'];
	$quantity=$data_produk['quantity'];
	$total_harga=$data_produk['total_harga'];
	
	if($calculated_bases=="weight")
						{
							$weight_class=$data_produk['weight_class'];
							
							$id_produk_katalog=$data_produk['id_produk_katalog'];
							
							if($weight_class=="c" && $id_kategori_produk==11)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight>=21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight<=20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==12)
							{
								if($quantity<=25)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/25;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $id_kategori_produk==14)
							{
								if($quantity<=10)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/10;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								if($total_weight >= 21)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga'];
								}
								elseif($total_weight <= 20)
								{
									$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
									$data_harga=mysqli_fetch_array($kueri_harga);
									$harga_dasar=$data_harga['satuan_harga_minimum'];
								}
								
							}
							elseif($weight_class=="c" && $total_weight<="20")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_minimum'];
							}
							elseif($weight_class=="c" && $total_weight>="21")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==8)
							{
								if($quantity<=6)
								{
									$quantity=1;
									$total_weight=$weight*$quantity;
								}
								else
								{
									$quantity=$quantity/6;
									$quantity=ceil($quantity);
									$total_weight=$weight*$quantity;
								}
								
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="b" && $id_kategori_produk==6  || $id_kategori_produk==7  || $id_kategori_produk==9)
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_electone'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==2 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight<="150")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga_clavinova'];
							}
							elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight>="151")
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								//echo $data_harga['satuan_harga'];
								$harga_dasar=$data_harga['satuan_harga'];
							}
							else
							{
								$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
								$data_harga=mysqli_fetch_array($kueri_harga);
								$harga_dasar=$data_harga['satuan_harga'];
								
							}
						}elseif($calculated_bases=="volumetric"){
							$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric WHERE id_kota=$id_kota");
							$data_harga=mysqli_fetch_array($kueri_harga);
							$harga_dasar=$data_harga['satuan_harga_volumetric'];
						}
	?>
    <td><?=$produk_name;?></td>
	<td><?=$weight;?></td>
	<td><?=$volumetric;?></td>
	<td><?=$quantity;?></td>
	<td><?=$calculated_bases;?></td>
	<td><?=$harga_dasar;?></td>
	<td><?=$total_harga;?></td>
	<td><?=$total_do_cost;?></td>


  </tr>	
	<?php
			}
		}
	?>
  
  <?php
	$kueri_sum_harga=mysqli_query($con,"SELECT SUM(tbl_pengiriman.sum_harga) AS sum_total_harga FROM tbl_pengiriman WHERE MONTH(tbl_pengiriman.exit_date) = '$excel_bulanan'");
	$data_sum_harga=mysqli_fetch_array($kueri_sum_harga);
	$sum_total_harga=$data_sum_harga['sum_total_harga'];
  ?>
  <tr>
    	<td align="right" colspan="19"><b>Sum Total Harga</b></td>
        <td align="left" colspan="7"><b><?=$sum_total_harga;?></b></td>
    </tr>
	<tr>
		<td align="justify" colspan="22"><h4><i>
		<ol>
			<li>10% tax is not include in the prices</li>
			<li>Work days are Monday - Saturday</li>
			<li>When the exit time is over 3:00 PM, arrival estimation date will be +1 day</li>
			<li>The delivery costs for piano and keyboards (over 25kg) are calculated by weight</li>
			<li>For other instruments, delivery costs are calculated based on the number of units</li>
			<li>All instruments for Kalimantan region, delivery cost are calculated based on volumetric</li>
			<li>The delivery costs for PA, MProd, Brass, Inst.Part, Acc and books bellow 20kg are calculated based on minimum cost, but if PA, MProd, Brass, Inst.Part, Acc and books above 20kg are calculated based on weight</li>
			<li>If the estimated delivery date falls during a national holiday, the items will be delivered the next working day. However, the system will still consider the delivery date as normal</li>
		</ol>
		</i></h4></td>
	</tr>
</table>
</body>
</html>
<script>
$(function() {
	$(".table2excel").table2excel({
		exclude: ".noExl",
		name: "Excel Document Name",
		filename: "LimaWaktuLogistic Monthly",
		fileext: ".xls",
		exclude_img: true,
		exclude_links: true,
		exclude_inputs: true
	});
});
</script>