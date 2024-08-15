<?php 
    require '../koneksi/koneksikeluar.php';
 
    session_start();

    // cek apakah yang mengakses halaman ini sudah login
    if($_SESSION['level']==""){
        header("location:index.php?pesan=gagal");
    }

 ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Barang Keluar</title>
        <link rel="shortcut icon" type="image/x-icon" href="logo-removebg-preview.ico">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .zoomable{
                width: 100px
            }
            .zoomable:hover{
                transform: scale(2.5);
                transition: 0.3s ease;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3">INVENTARIS SEKOLAH</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class='fas fa-boxes'></i></i></div>
                                Daftar Barang
                            </a>
                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class='fas fa-dolly-flatbed'></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="Keluar.php">
                                <div class="sb-nav-link-icon"><i class='fas fa-shipping-fast'></i></div>
                                Barang Keluar
                            </a>
                            <a class="nav-link" href="peminjaman.php">
                                <div class="sb-nav-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0m4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0m3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
                                  <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2"/>
                                </svg></div>
                                Peminjaman Barang
                            </a>
                            <a class="nav-link" href="../logout.php">
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                         <h1 class="mt-4" style="text-align: center; font-weight: bold; font-family: arial;">BARANG KELUAR</h1>
                       
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                   <!-- Button to Open the Modal -->
                                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Barang
                                  </button>
                                   <br>
                                      <div class="row mt-2">
                                        <div class="col">
                                            <form method="post" class="form-inline">
                                                <input type="date" name="tgl_mulai" class="p-1">
                                                <input type="date" name="tgl_selesai" class="p-1">
                                                <button type="submit" name="filter_tgl" class="btn btn-info">Filter</button>
                                        </form>
                                        </div>
                                      </div>
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Gambar</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php 
                                        if (isset($_POST['filter_tgl'])) {
                                                $mulai = $_POST['tgl_mulai'];
                                                $selesai = $_POST['tgl_selesai'];

                                                if ($mulai!=null || $selesai!=null) {
                                                    $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang = k.idbarang and tanggal BETWEEN '$mulai' and DATE_ADD('$selesai',INTERVAL 1 DAY) order by idkeluar DESC");
                                                }else{
                                                    $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang = k.idbarang");
                                                }
                                                 
                                            }else{
                                                 $ambilsemuadatastock = mysqli_query($conn, "select * from keluar k, stock s where s.idbarang = k.idbarang");
                                            }
                                           
                                        $i = 1;
                                        while($data = mysqli_fetch_array($ambilsemuadatastock)){
                                            $idk = $data['idkeluar'];
                                            $idb = $data['idbarang'];
                                            $tanggal = $data['tanggal'];
                                            $namabarang = $data['namabarang'];
                                            $qty = $data['qty'];
                                            $penerima = $data['penerima'];

                                            //cek ada gambar atau tidak
                                            $gambar = $data['image'];
                                            if ($gambar==null) {
                                                //jika tidak ada gambar
                                                $img = 'No Poto';
                                            }else{
                                                //jika ada gambar
                                                $img = '<img src="../images/'.$gambar.'" class="zoomable">';
                                            }
                                         ?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$tanggal;?></td>
                                            <td><?=$img;?></td>
                                            <td><?=$namabarang;?></td>
                                            <td><?=$qty;?></td>
                                            <td><?=$penerima;?></td>
                                            <td>
                                              <!-- Edit Barang -->
                                              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idk;?>">
                                                Edit
                                              </button>
                                              <!-- Edit Barang -->
                                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?=$idk;?>">
                                                Hapus
                                              </button>
                                            </td>
                                        </tr>


<!-- The Modal edit -->
      <div class="modal fade" id="edit<?=$idk;?>">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Barang</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post" autocomplete="off">
                <div class="modal-body">
                <input type="text" name="penerima" value="<?=$penerima;?>" class="form-control" required>
                <br>
                <input type="number" name="qty" value="<?=$qty;?>" class="form-control" required>
                <br>
                <input type="hidden" name="idb" value="<?=$idb;?>">
                <input type="hidden" name="idk" value="<?=$idk;?>">
                <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Submit</button>
                </div>
            </form>
            
            
          </div>
        </div>
      </div>


      <!-- The Modal hapus -->
      <div class="modal fade" id="delete<?=$idk;?>">
        <div class="modal-dialog">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Hapus Barang</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    Apakah Anda Yakin Ingin Menghapus <?=$namabarang;?>
                <input type="hidden" name="idb" value="<?=$idb;?>">
                <input type="hidden" name="kty" value="<?=$qty;?>">
                <input type="hidden" name="idk" value="<?=$idk;?>">
                <br>
                <br>
                <button type="submit" class="btn btn-primary" name="hapusbarangkeluar">Submit</button>
                </div>
            </form>
            
            
          </div>
        </div>
      </div>






                                        <?php 
                                             }
                                         ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>


    <!-- The Modal stock -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Barang</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" autocomplete="off">
            <div class="modal-body">
            <select name="barangnya" class="form-control">
                    <?php 
                    $ambilsemuadatanya = mysqli_query($conn, "select * from stock");
                    while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                        $namabarangnya = $fetcharray['namabarang'];
                        $idbarangnya = $fetcharray['idbarang'];
                     ?>

                     <option value="<?=$idbarangnya;?>"><?=$namabarangnya;?></option>

                     <?php 
                        }
                      ?>
                </select>
            <br>
            <input type="number" name="qty" placeholder="Quantity" class="form-control" required>
            <br>
            <input type="text" name="penerima" placeholder="Keterangan" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="addbarangkeluar">Submit</button>
            </div>
        </form>
        
        
      </div>
    </div>
  </div>

</html>
