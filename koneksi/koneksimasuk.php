<?php 

$conn =  mysqli_connect("localhost", "root", "", "inventaris");

//menambbah barang masuk
if (isset($_POST['barangmasuk'])) {
	$barangnya = $_POST['barangnya'];
	$penerima = $_POST['penerima'];
	$qty = $_POST['qty'];

	$cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
	$ambildatanya = mysqli_fetch_array($cekstocksekarang);

	$stocksekarang = $ambildatanya['stock'];
	$tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

	$addtomasuk = mysqli_query($conn, "insert into masuk(idbarang, keterangan, qty) values ('$barangnya','$penerima','$qty')");
	$updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");

	if ($addtomasuk&&$updatestockmasuk) {
		header('location:masuk.php');
	}else{
		echo 'Gagal';
		header('location:masuk.php');
	}
};

//edit barang masuk
if (isset($_POST['updatebarangmasuk'])) {
	$idb = $_POST['idb'];
	$idm = $_POST['idm'];
	$deskripsi = $_POST['keterangan'];
	$qty = $_POST['qty'];

	$lihatstock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$stocknya = mysqli_fetch_array($lihatstock);
	$stockskrg = $stocknya['stock'];

	$qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
	$qtynya = mysqli_fetch_array($qtyskrg);
	$qtyskrg = $qtynya['qty'];

	if ($qty > $qtyskrg) {
		$selisih = $qty - $qtyskrg;
		$kurangin = $stockskrg + $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
		if ($kurangistocknya&&$updatenya) {
			header('location:masuk.php');
		}else{
			echo "Gagal";
			header('location:masuk.php');
		}
	}else{
		$selisih = $qtyskrg - $qty;
		$kurangin = $stockskrg - $selisih;
		$kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
		$updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
		if ($kurangistocknya&&$updatenya) {
			header('location:masuk.php');
		}else{
			echo "Gagal";
			header('location:masuk.php');
		}
	}

}

//menghapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
	$idb = $_POST['idb'];
	$qty = $_POST['kty'];
	$idm = $_POST['idm'];

	$getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$data = mysqli_fetch_array($getdatastock);
	$stock = $data['stock'];

	$selisih = $stock - $qty;

	$update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
	$hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

	if ($update&&$hapusdata) {
		header("location:masuk.php");
	}else{
		header("location:masuk.php");
	}
}

?>