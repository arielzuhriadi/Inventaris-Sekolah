<?php 
include '../koneksi/koneksistock.php';
 ?>
<html>
<head>
  <title>Export Data</title>
  <link rel="shortcut icon" type="image/x-icon" href="logo-removebg-preview.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
      <h2 style="text-align: center;"><b>CETAK DATA PEMINJAMAN</b></h2>
        <div class="data-tables datatable-dark">
          
           <table class="table table-bordered" id="mauexport">
      <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Kepada</th>
            <th>Status</th>
        </tr>
      </thead>
      <tbody>

        <?php 
           $ambilsemuadatastock = mysqli_query($conn, "select * from peminjaman p, stock s where s.idbarang = p.idbarang order by idpeminjaman DESC");
            $i = 1;
            while($data = mysqli_fetch_array($ambilsemuadatastock)){
                $idk = $data['idpeminjaman'];
                $idb = $data['idbarang'];
                $tanggal = $data['tanggalpinjam'];
                $namabarang = $data['namabarang'];
                $qty = $data['qty'];
                $penerima = $data['peminjam'];
                $status = $data['status'];
                ?>
               <tr>
                <td><?=$i++;?></td>
                <td><?=$tanggal;?></td>
                <td><?=$namabarang;?></td>
                <td><?=$qty;?></td>
                <td><?=$penerima;?></td>
                <td><?=$status;?></td>
            </tr>
        <?php 
            }
         ?>
      </tbody>
    </table>
          
        </div>
</div>
  
<script>
$(document).ready(function() {
    $('#mauexport').DataTable( {
        dom: 'Bfrtip',
        buttons: [
           'excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<button type="submit" class="btn btn-primary" style="margin-left:85px;"><a href="peminjaman.php" class="text-white">Kembali</a></button>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

  

</body>

</html>