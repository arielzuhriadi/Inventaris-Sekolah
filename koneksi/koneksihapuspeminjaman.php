<?php 

$conn =  mysqli_connect("localhost", "root", "", "inventaris");


//menghapus barang keluar
if (isset($_POST['hps'])) {
	$idb = $_POST['idb'];
	$idk = $_POST['idk'];

	$hapusdata = mysqli_query($conn, "delete from peminjaman where idpeminjaman='$idk'");

	if ($hapusdata) {
		header("location:peminjaman.php");
	}else{
		header("location:peminjaman.php");
	}
}

 ?>