<?php 

$conn =  mysqli_connect("localhost", "root", "", "inventaris");

//menambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];

	if ($stocksekarang >= $qty) {
	$tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

		$addtokeluar = mysqli_query($conn, "insert into keluar(idbarang, penerima, qty) values ('$barangnya','$penerima','$qty')");
		$updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");

		if ($addtokeluar&&$updatestockmasuk) {
			header('location:keluar.php');
		}else{
			echo 'Gagal';
			header('location:keluar.php');
		}
	}else{
		//kalau barangnya tidak cukup
		echo '
		<script>
			alert("Stock saat ini tidak mencukupi");
			window.location.href="keluar.php";
		</script>';
	}
}


//edit barang keluar
if (isset($_POST['updatebarangkeluar'])) {
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if ($qty > $qtyskrg) {
		$selisih = $qty - $qtyskrg;
		$kurangin = $stockskrg - $selisih;

		if ($selisih <= $stockskrg) {
			$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
			$updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
			if ($kurangistocknya&&$updatenya) {
				header('location:keluar.php');
			}else{
				echo "Gagal";
				header('location:keluar.php');
			}
		}else{
			echo '
			<script>alert("Stock tidak mencukupi");
			window.location.href="keluar.php";
			</script>
			';
		}
	}else{
		$selisih = $qtyskrg - $qty;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
		if ($kurangistocknya&&$updatenya) {
			header('location:keluar.php');
		}else{
			echo "Gagal";
			header('location:keluar.php');
		}
	}

}

//menghapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
	$idk = $_POST['idk'];

	$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stock = $data['stock'];

	$selisih = $stock + $qty;

	$update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
	$hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

	if ($update&&$hapusdata) {
		header("location:keluar.php");
	}else{
		header("location:keluar.php");
	}
}


 ?>