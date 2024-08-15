<?php 

$conn =  mysqli_connect("localhost", "root", "", "inventaris");


//menambah stock barang
if (isset($_POST['addnewbarang'])) {
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];
	$stock = $_POST['stock'];

	//soal gambar
	$allowed_extension = array('png','jpg','jfif');
	$nama = $_FILES['file']['name']; //mengambil nama gambar
	$dot = explode('.', $nama);
	$ekstensi = strtolower(end($dot)); //mengambil ekstensinya
	$ukuran = $_FILES['file']['size']; //mengambil ukuran file
	$file_tmp = $_FILES['file']['tmp_name']; //mengambil lokasi filenya

	//penamaan file -> enkripsi
	$image = md5(uniqid($nama,true) . time()).'.'.$ekstensi;

	//validasi uda ada atau belum
	$cek = mysqli_query($conn, "select * from stock where namabarang='$namabarang'");
	$hitung = mysqli_num_rows($cek);

	if ($hitung<1) {
		//jika belum ada

		//proses upload gambar
		if (in_array($ekstensi, $allowed_extension) === true) {
			//validasi ukuran filenya
			if ($ukuran < 15000000) {
				move_uploaded_file($file_tmp, '../images/'.$image);

				$addtotable = mysqli_query($conn, "insert into stock (namabarang, deskripsi, stock, image) values ('$namabarang','$deskripsi','$stock','$image')");
				if ($addtotable) {
					header('location:index.php');
				}else{
					echo 'Gagal';
					header('location:index.php');
				}


			}else{
				//kalau filenya lebih 15 mb
				echo '
				<script>
					alert("Nama Barang Sudah Terdaftar");
					window.location.href="index.php";
				</script>
				';
			}

		}else{
			//kalau file tidak png atau jpg
			echo '
			<script>
				alert("File Harus png/jpg");
				window.location.href="index.php";
			</script>
			';
		}

	}else{
		//jika suda ada
		echo '
		<script>
			alert("Nama Barang Sudah Terdaftar");
			window.location.href="index.php";
		</script>
		';
	}
};


//update stock barang
if (isset($_POST['updatebarang'])) {
	$idb = $_POST['idb'];
	$namabarang = $_POST['namabarang'];
	$deskripsi = $_POST['deskripsi'];

	//soal gambar
	$allowed_extension = array('png','jpg','jfif');
	$nama = $_FILES['file']['name']; //mengambil nama gambar
	$dot = explode('.', $nama);
	$ekstensi = strtolower(end($dot)); //mengambil ekstensinya
	$ukuran = $_FILES['file']['size']; //mengambil ukuran file
	$file_tmp = $_FILES['file']['tmp_name']; //mengambil lokasi filenya

	//penamaan file -> enkripsi
	$image = md5(uniqid($nama,true) . time()).'.'.$ekstensi;

	if ($ukuran==0) {
		//jika tidak ingin upload
		$update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
		if ($update) {
			header('location:index.php');
		}else{
			echo 'Gagal';
			header('location:index.php');
		}
	}else{
		//jika ingin 
		move_uploaded_file($file_tmp, '../images/'.$image);
		$update = mysqli_query($conn, "update stock set namabarang='$namabarang', deskripsi='$deskripsi', image='$image' where idbarang='$idb'");
		if ($update) {
			header('location:index.php');
		}else{
			echo 'Gagal';
			header('location:index.php');
		}
	}
};















//delete stock barang
if (isset($_POST['hapusbarang'])) {
	$idb = $_POST['idb'];

	$gambar = mysqli_query($conn, "select * from stock where idbarang='$idb'");
	$get = mysqli_fetch_array($gambar);
	$img = '../images/'.$get['image'];
	unlink($img);

	$hapus = mysqli_query($conn, "delete from stock where idbarang='$idb'");
	if ($hapus) {
		header('location:index.php');
	}else{
		echo 'Gagal';
		header('location:index.php');
	}
}

?>