<?php
include '../cek_login.php';

// Fungsi untuk menampilkan daftar admin
function tampilkanAdmin() {
    global $koneksi;
    $query = "SELECT * FROM user WHERE level='admin'";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

// Fungsi untuk menambahkan admin baru
function tambahAdmin($username, $password) {
    global $koneksi;
    // Lakukan validasi data jika diperlukan
    $query = "INSERT INTO user (username, password, level) VALUES ('$username', '$password', 'admin')";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

// Fungsi untuk menghapus admin
function hapusAdmin($admin_id) {
    global $koneksi;
    $query = "DELETE FROM user WHERE id='$admin_id' AND level='admin'";
    $result = mysqli_query($koneksi, $query);
    return $result;
}


///
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST["new_username"];
    $new_password = $_POST["new_password"];

    // Panggil fungsi tambahAdmin
    if (tambahAdmin($new_username, $new_password)) {
        echo "Admin baru berhasil ditambahkan.";
    } else {
        echo "Gagal menambahkan admin baru.";
    }
}

?>
