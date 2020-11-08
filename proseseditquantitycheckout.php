<?php
include('config.php');
session_start();
$status=$_REQUEST['status'];
$id_temp_produk=$_REQUEST['id_temp_produk'];
$random_id= $_REQUEST['random_id'];
$quantity= $_REQUEST['quantity'];
$id_produk_katalog= $_REQUEST['id_produk_katalog'];

$kueri_weight=mysqli_query($con, "SELECT * FROM tbl_kategori_produk AS kp LEFT JOIN tbl_produk_katalog AS pk ON kp.id_kategori_produk = pk.id_kategori_produk WHERE pk.id_produk_katalog=$id_produk_katalog");
$data_weight=mysqli_fetch_array($kueri_weight);
$weight_class=$data_weight['weight_class'];
$weight=$data_weight['weight'];
$volumetric=$data_weight['volumetric'];
$total_weight=$weight*$quantity;
$total_volumetric=$volumetric*$quantity;
$id_kategori_produk=$data_weight['id_kategori_produk'];
$satuan_penghitungan=$_SESSION["satuan_penghitungan"];
$id_kota=$_SESSION["id_kota"];

if($satuan_penghitungan=="weight")
{
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
			$total_harga=$data_harga['satuan_harga']*$total_weight;
		}
		elseif($total_weight<=20)
		{
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
			$data_harga=mysqli_fetch_array($kueri_harga);
			$total_harga=$data_harga['satuan_harga_minimum'];
		}
		
		
	}
	elseif($weight_class=="c" && $id_kategori_produk==12)
	{
		if($quantity<=50)
		{
			$quantity=1;
			$total_weight=$weight*$quantity;
		}
		else
		{
			$quantity=$quantity/50;
			$quantity=ceil($quantity);
			$total_weight=$weight*$quantity;
		}
		
		if($total_weight >= 21)
		{
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
			$data_harga=mysqli_fetch_array($kueri_harga);
			$total_harga=$data_harga['satuan_harga']*$total_weight;
		}
		elseif($total_weight <= 20)
		{
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
			$data_harga=mysqli_fetch_array($kueri_harga);
			$total_harga=$data_harga['satuan_harga_minimum'];
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
			$total_harga=$data_harga['satuan_harga']*$total_weight;
		}
		elseif($total_weight <= 20)
		{
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
			$data_harga=mysqli_fetch_array($kueri_harga);
			$total_harga=$data_harga['satuan_harga_minimum'];
		}
		
	}
	elseif($weight_class=="c" && $total_weight<="20")
	{
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota=$id_kota");
		$data_harga=mysqli_fetch_array($kueri_harga);
		$total_harga=$data_harga['satuan_harga_minimum'];
	}
	elseif($weight_class=="c" && $total_weight>="21")
	{
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
		$data_harga=mysqli_fetch_array($kueri_harga);
		// echo $total_weight;
		$total_harga=$data_harga['satuan_harga']*$total_weight;
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
		$total_harga=$data_harga['satuan_harga']*$quantity;
	}
	elseif($weight_class=="b" && $id_kategori_produk==6  || $id_kategori_produk==7  || $id_kategori_produk==9)
	{
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
		$data_harga=mysqli_fetch_array($kueri_harga);
		$total_harga=$data_harga['satuan_harga']*$quantity;
	}
	elseif($weight_class=="a" && $id_kategori_produk==2 && $weight<="150")
	{
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota=$id_kota");
		$data_harga=mysqli_fetch_array($kueri_harga);
		$total_harga=$data_harga['satuan_harga_electone']*$quantity;
	}
	elseif($weight_class=="a" && $id_kategori_produk==2 && $weight>="151")
	{
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
		$data_harga=mysqli_fetch_array($kueri_harga);
		//echo $data_harga['satuan_harga'];
		$total_harga=$data_harga['satuan_harga']*$total_weight;
	}
	elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight<="150")
	{
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota=$id_kota");
		$data_harga=mysqli_fetch_array($kueri_harga);
		$total_harga=$data_harga['satuan_harga_clavinova']*$quantity;
	}
	elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight>="151")
	{
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
		$data_harga=mysqli_fetch_array($kueri_harga);
		//echo $data_harga['satuan_harga'];
		$total_harga=$data_harga['satuan_harga']*$total_weight;
	}
	else
	{
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota=$id_kota AND id_kategori_produk=$id_kategori_produk");
		$data_harga=mysqli_fetch_array($kueri_harga);
		$total_harga=$data_harga['satuan_harga']*$weight*$quantity;
		
	}
}elseif($satuan_penghitungan=="volumetric"){
	$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric WHERE id_kota=$id_kota");
	$data_harga=mysqli_fetch_array($kueri_harga);
	$total_harga=$data_harga['satuan_harga_volumetric']*$volumetric*$quantity;
}

$kueri3 = mysqli_query($con, "UPDATE temp_produk SET quantity = '$quantity', total_harga = '$total_harga', total_weight = '$total_weight', total_volumetric = '$total_volumetric' WHERE id_temp_produk = '$id_temp_produk'");
if($kueri3)
{
	if(isset($_REQUEST['id']))
	{
		header("location:admin.php?status=$status&&page=editpengirimanprogress&&random_id=$random_id&&id=$_REQUEST[id]");
	}
	else
	{
		header("location:admin.php?page=checkout&&random_id=$random_id");
	}
}
else
{
	echo "ERROR SILAHKAN HUBUNGI ADMINISTRATOR";
}
