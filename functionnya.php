<?php
///////////////////////////////////////////////////////
function check($satuan_penghitungan, $weight_class, $id_kategori_produk, $quantity, $weight, $id_kota, $total_weight){
	include("config.php");
	if($satuan_penghitungan=="weight"){
		if($weight_class=="c" && $id_kategori_produk==11){
			if($quantity<=10){
				$quantity=1;
				$total_weight=$weight*$quantity;
			}else{
				$quantity=$quantity/10;
				$quantity=ceil($quantity);
				$total_weight=$weight*$quantity;
			}

			if($total_weight>=21){
				$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
				$data_harga=mysqli_fetch_array($kueri_harga);
				return $harga_dasar=$data_harga['satuan_harga'];
			}elseif($total_weight<=20){
				$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota = '$id_kota'");
				$data_harga=mysqli_fetch_array($kueri_harga);
				return $harga_dasar=$data_harga['satuan_harga_minimum'];
			}
			
		}elseif($weight_class=="c" && $id_kategori_produk==12){
			if($quantity<=25){
				$quantity=1;
				$total_weight=$weight*$quantity;
			}else{
				$quantity=$quantity/25;
				$quantity=ceil($quantity);
				$total_weight=$weight*$quantity;
			}

			if($total_weight >= 21){
				$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
				$data_harga=mysqli_fetch_array($kueri_harga);
				return $harga_dasar=$data_harga['satuan_harga'];
			}elseif($total_weight <= 20){
				$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota = '$id_kota'");
				$data_harga=mysqli_fetch_array($kueri_harga);
				return $harga_dasar=$data_harga['satuan_harga_minimum'];
			}
		}elseif($weight_class=="c" && $id_kategori_produk==14){
			if($quantity<=10){
				$quantity=1;
				$total_weight=$weight*$quantity;
			}else{
				$quantity=$quantity/10;
				$quantity=ceil($quantity);
				$total_weight=$weight*$quantity;
			}
			
			if($total_weight >= 21){
				$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
				$data_harga=mysqli_fetch_array($kueri_harga);
				return $harga_dasar=$data_harga['satuan_harga'];
			}else{
				$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota = '$id_kota'");
				$data_harga=mysqli_fetch_array($kueri_harga);
				return $harga_dasar=$data_harga['satuan_harga_minimum'];
			}
		}elseif($weight_class=="c" && $total_weight<="20"){
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_minimum WHERE id_kota = '$id_kota'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga_minimum'];
		}elseif($weight_class=="c" && $total_weight>="21"){
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga'];
		}elseif($weight_class=="b" && $id_kategori_produk==8){
			if($quantity<=6){
				$quantity=1;
				$total_weight=$weight*$quantity;
			}else{
				$quantity=$quantity/6;
				$quantity=ceil($quantity);
				$total_weight=$weight*$quantity;
			}
			
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga'];
		}elseif($weight_class=="b" && $id_kategori_produk==6  || $id_kategori_produk==7  || $id_kategori_produk==9){
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga'];
		}elseif($weight_class=="a" && $id_kategori_produk==2 && $weight<="150"){
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_electone WHERE id_kota = '$id_kota'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga_electone'];
		}elseif($weight_class=="a" && $id_kategori_produk==2 && $weight>="151"){
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga'];
		}elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight<="150"){
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_clavinova WHERE id_kota = '$id_kota'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga_clavinova'];
		}elseif($weight_class=="a" && $id_kategori_produk==3 || $id_kategori_produk==4 && $weight>="151"){
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga'];
		}else{
			$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_kota WHERE id_kota = '$id_kota' AND id_kategori_produk = '$id_kategori_produk'");
			$data_harga=mysqli_fetch_array($kueri_harga);
			return $harga_dasar=$data_harga['satuan_harga'];
		}
	}elseif($satuan_penghitungan=="volumetric"){
		$kueri_harga=mysqli_query($con, "SELECT * FROM tbl_satuan_harga_volumetric WHERE id_kota='$id_kota'");
		$data_harga=mysqli_fetch_array($kueri_harga);
		return $harga_dasar=$data_harga['satuan_harga_volumetric'];
	}
}
///////////////////////////////////////////////////////
?>