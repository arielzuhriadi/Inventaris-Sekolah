<?php 
    include '../koneksi/koneksipeminjaman.php';

 ?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Cetak Peminjaman</title>
  <link rel="shortcut icon" type="image/x-icon" href="logo-removebg-preview.ico">
  <style>
@media print {
    .page-break { display: block; page-break-before: always; }
}
      #invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 44mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: .9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 40px;
  width: 150px;
  background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;
  background-size: 150px 40px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
  background: url(https://www.sistemit.com/wp-content/uploads/2020/02/SISTEMITCOM-smlest.png) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: .5em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}
    </style>
 
  <script>
  window.console = window.console || function(t) {};
</script>
 
  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>
 
 
</head>
 
<body translate="no" >
 
 
  <div id="invoice-POS">
 
    <center id="top">
      <div class="...">
          <img src="../img/logo-removebg-preview.png" style="width:50px">
      </div>
      <div class="info"> 
        <h2>SMK Siti Banun</h2>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->
 
    <div id="mid">
      <div class="info">
        <h2>Info Kontak</h2>
        <p> 
           Alamat : Sigambal</br>
            Email  : arielzuhriadi0@gmail.com</br>
            Telephone   : 082274319609</br>
        </p>
      </div>
    </div>
 
    <div id="bot">
 
            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item"><h2>Id Barang</h2></td>
                        <td class="item"><h2>nama barang</h2></td>
                        <td class="Hours"><h2>jumlah</h2></td>
                        <td class="Rate"><h2>Peminjam</h2></td>
                    </tr>

                    <?php 
                        $cetak = mysqli_query($conn, "select * from peminjaman p, stock s where s.idbarang = p.idbarang order by idpeminjaman DESC");
                        $i = 1;
                        while($data = mysqli_fetch_array($cetak)){
                            $idk = $data['idpeminjaman'];
                            $idb = $data['idbarang'];
                            $tanggal = $data['tanggalpinjam'];
                            $namabarang = $data['namabarang'];
                            $qty = $data['qty'];
                            $penerima = $data['peminjam'];
                            $status = $data['status'];
                     ?>

                    <tr class="service">
                        <td class="tableitem"><p class="itemtext"><?=$idb;?></p></td>
                        <td class="tableitem"><p class="itemtext"><?=$namabarang;?></p></td>
                        <td class="tableitem"><p class="itemtext"><?=$qty;?></p></td>
                        <td class="tableitem"><p class="itemtext"><?=$penerima;?></p></td>
                    </tr>

                    <?php  
                        }
                     ?>
                </table>
            </div>


            <br><br>

            <div id="legalcopy">
                <p class="legal"><strong>Terimakasih Telah Mengembalikan barang...</strong>  Silahkan Masukkan ke Gudang
                </p>
            </div>

        </div>
  </div>
  <script>
      window.print();
  </script>

 
</body>
 
</html>