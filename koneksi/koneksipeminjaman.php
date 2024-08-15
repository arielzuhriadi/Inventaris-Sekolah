<?php 
	$conn =  mysqli_connect("localhost", "root", "", "inventaris");

//meminjam barang
if (isset($_POST['pinjam'])) {
	$idbarang = $_POST['barangnya'];
	$qty = $_POST['qty'];
	$penerima = $_POST['penerima'];

	//ambil stock
	$stok_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
	$stok_nya = mysqli_fetch_array($stok_saat_ini);
	$stok = $stok_nya['stock'];

	//kurangi stocknya
	$new_stock = $stok - $qty;

	$insertpinjam = mysqli_query($conn, "insert into peminjaman (idbarang, qty, peminjam) values ('$idbarang','$qty','$penerima')");

	//mengurangi stock ditabel stock
	$kurangistok = mysqli_query($conn, "update stock set stock='$new_stock' where idbarang='$idbarang'");


	if ($insertpinjam&&$kurangistok) {
		//jika berhasil
		echo '
		<script>
			alert("Berhasil");
			window.location.href="peminjaman.php";
		</script>';
	}else{
		//jika gagal
		echo '
		<script>
			alert("Gagal");
			window.location.href="peminjaman.php";
		</script>';
	}
}


//menyelesaikan peminjaman
if (isset($_POST['barangkembali'])) {
	$idpinjam = $_POST['idpinjam'];
	$idbarang = $_POST['idbarang'];

	//eksekusi
	$update_status = mysqli_query($conn, "update peminjaman set status='Kembali' where idpeminjaman='$idpinjam'");

	//ambil stock sekarang
	$stok_saat_ini = mysqli_query($conn, "select * from stock where idbarang='$idbarang'");
	$stok_nya = mysqli_fetch_array($stok_saat_ini);
	$stok = $stok_nya['stock'];

	//ambil qty dari idpinjam sekarang
	$stok_saat_ini1 = mysqli_query($conn, "select * from peminjaman where idpeminjaman='$idpinjam'");
	$stok_nya1 = mysqli_fetch_array($stok_saat_ini1);
	$stok1 = $stok_nya1['qty'];

	//kurangi stocknya
	$new_stock = $stok1 + $stok;

	//kembalikan stoknya
	$kembalikan_stock = mysqli_query($conn, "update stock set stock='$new_stock' where idbarang='$idbarang'");


	if ($update_status&&$kembalikan_stock) {
		//jika berhasil
		echo '
		<script>
			alert("Berhasil");
			window.location.href="peminjaman.php";
		</script>';
	}else{
		//jika gagal
		echo '
		<script>
			alert("Gagal");
			window.location.href="peminjaman.php";
		</script>';
	}
}

 ?>