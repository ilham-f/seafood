<?php

require_once 'pemesanan.php';
$data = new pemesanan;
// var_dump($data->joinKonsumen());
// die;

// Delete pemesanan
if(isset($_POST['delete'])){
    $id_pemesanan = $_POST['id_pemesanan'];

    $data->delete($id_pemesanan);

    header("Location: tabel-pemesanan.php");
}

// Update pemesanan
if(isset($_POST['update'])){
    // id_pemesanan, id_calon_konsumen, tgl_pemesanan, status_pemesanan, alamat_pengiriman, total_harga
    $id_pemesanan = $_POST['id_pemesanan'];
    $status_pemesanan = $_POST['status_pemesanan'];
    $alamat_pengiriman = $_POST['alamat_pengiriman'];

    $data->update($id_pemesanan, $status_pemesanan, $alamat_pengiriman);
    
    header("Location: tabel-pemesanan.php");
}

// Tambah pemesanan
if(isset($_POST['add'])){
    // id_pemesanan, id_calon_konsumen, tgl_pemesanan, status_pemesanan, alamat_pengiriman, total_harga
    $id_calon_konsumen = $_POST['id_calon_konsumen'];
    $tgl_pemesanan = $_POST['tgl_pemesanan'];
    $status_pemesanan = $_POST['status_pemesanan'];
    $alamat_pengiriman = $_POST['alamat_pengiriman'];
    $total_harga = $_POST['total_harga'];

    $data->store($id_calon_konsumen, $tgl_pemesanan, $status_pemesanan, $alamat_pengiriman, $total_harga);
    
    header("Location: tabel-pemesanan.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ham's Seafood</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <a href="index.php" class="mt-2 ms-1">Ham's Seafood</a>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu" id="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="tabel-barang.php" class='sidebar-link'>
                                <i class="bi bi-box"></i>
                                <span>Barang</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a href="tabel-calon_konsumen.php" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>Calon Konsumen</span>
                            </a>
                        </li>

                        <li class="sidebar-item active">
                            <a href="tabel-pemesanan.php" class='sidebar-link'>
                                <i class="bi bi-bag"></i>
                                <span>Pemesanan</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>

        <!-- Main -->
        <div id="main">
            <header class="mb-3">
                <a href="" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Tabel Pemesanan</h3>
                            <button type="button" class="btn btn-info mb-3 mt-4 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#tambah">
                                <span class="bi bi-plus-square me-2" style="padding-top: 2px;"></span>Tambah Pesanan
                            </button>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tabel Pemesanan</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-borderless" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">KONSUMEN</th>
                                        <th scope="col">TOTAL HARGA</th>
                                        <th scope="col">TANGGAL PESAN</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col" class="text-center">UBAH STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        //var_dump($data->joinKonsumen()) 
                                        // id_pemesanan, id_calon_konsumen, tgl_pemesanan, status_pemesanan, alamat_pengirima, total_harga
                                    ?>
                                    <?php foreach ($data->joinKonsumen() as $value){
                                        echo'
                                        <tr>
                                            <td>'.$value['id_pemesanan'].'</td>
                                            <td>'.$value['nama_calon_konsumen'].'</td>
                                            <td>'.$value['total_harga'].'</td>
                                            <td>'.$value['tgl_pemesanan'].'</td>
                                            <td>';
                                                if ($value['status_pemesanan'] == 1) {
                                                    echo '<small class="fst-italic">Diterima</small>';
                                                }
                                                elseif ($value['status_pemesanan'] == 2) {
                                                    echo '<small class="fst-italic">Dalam Pengiriman</small>';
                                                }
                                                elseif ($value['status_pemesanan'] == 3) {
                                                    echo '<small class="fst-italic">Sedang diproses</small>';
                                                }
                                                elseif ($value['status_pemesanan'] == 4) {
                                                    echo '<small class="fst-italic">Menunggu Pembayaran</small>';
                                                }
                                                else{
                                                    echo '<small class="fst-italic">Menunggu Pembayaran</small>';
                                                }
                                            echo ' </td>
                                            <td class="d-flex justify-content-center">
                                                <button type="button" style="height: 35px" class="btn btn-info me-2 d-flex" data-bs-toggle="modal" data-bs-target="#info'.$value['id_pemesanan'].'">
                                                    <li class="bi bi-info-square" style="list-style-type: none; padding-top: 2px"></li>
                                                </button> 
                                                <button type="button" class="btn btn-warning me-2 d-flex" data-bs-toggle="modal" data-bs-target="#update'.$value['id_pemesanan'].'">
                                                    <li class="bi bi-pencil-square" style="list-style-type: none; padding-top: 2px"></li>
                                                </button> 
                                                <button type="button" class="btn btn-danger d-flex" data-bs-toggle="modal" data-bs-target="#delete'.$value['id_pemesanan'].'">
                                                    <li class="bi bi-trash" style="list-style-type: none; padding-top: 2px"></li>
                                                </button> 
                                            </td>
                                        </tr>';    
                                    }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Modal Delete-->
    <?php foreach ($data->joinKonsumen() as $value){
        echo'
            <div id="delete'.$value['id_pemesanan'].'" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-end">
                                <button type="button" class="btn-close text-end" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="mt-1">
                                <h4>Yakin untuk menghapus?</h4>	
                                <p>Apakah benar anda ingin menghapus pesanan '.$value['nama_calon_konsumen'].' dengan ID Pemesanan '.$value['id_pemesanan'].'?</p>
                            </div>
                            <div class="d-flex flex-row-reverse mt-3">
                                <form action="" method="post">
                                    <input type="hidden" name="id_pemesanan" value="'.$value['id_pemesanan'].'" class="form-control col-6">
                                    <button class="btn btn-danger" type="submit" name="delete">Hapus</button>
                                </form>
                                <button class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }?>

    <!-- Modal Update Status-->
    <?php foreach ($data->show() as $value){
        echo '
            <div class="modal fade" id="update'.$value['id_pemesanan'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Pesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post">
                                <input type="hidden" name="id_pemesanan" value="'.$value['id_pemesanan'].'" class="form-control col-6">

                                <label for="status_pemesanan">Status Pesanan</label>
                                <br>
                                <select class="form-select border-1 rounded mt-2" name="status_pemesanan">
                                    <option selected>Status Pesanan</option>';
                                    for ($i=1; $i <= 5; $i++) { 
                                        if ($i == 1 && $i == $value['status_pemesanan']) {
                                            echo '
                                            <option selected="selected" value="'.$i.'">
                                                <small class="fst-italic">Diterima</small>
                                            </option>';
                                        }else if ($i == 2 && $i == $value['status_pemesanan']) {
                                            echo '
                                            <option selected="selected" value="'.$i.'">
                                                <small class="fst-italic">Dalam pengiriman</small>
                                            </option>';
                                        }else if ($i == 3 && $i == $value['status_pemesanan']) {
                                            echo '
                                            <option selected="selected" value="'.$i.'">
                                                <small class="fst-italic">Sedang Diproses</small>
                                            </option>';
                                        }else if ($i == 4 && $i == $value['status_pemesanan']) {
                                            echo '
                                            <option selected="selected" value="'.$i.'">
                                                <small class="fst-italic">Menunggu pembayaran</small>
                                            </option>';
                                        }elseif ($i == 1) {
                                            echo '
                                            <option value="'.$i.'">
                                                <small class="fst-italic">Diterima</small>
                                            </option>';
                                        }elseif ($i == 2) {
                                            echo '
                                            <option value="'.$i.'">
                                                <small class="fst-italic">Dalam pengiriman</small>
                                            </option>';
                                        }elseif ($i == 3) {
                                            echo '
                                            <option value="'.$i.'">
                                                <small class="fst-italic">Sedang Diproses</small>
                                            </option>';
                                        }elseif ($i == 4) {
                                            echo '
                                            <option value="'.$i.'">
                                                <small class="fst-italic">Menunggu pembayaran</small>
                                            </option>';
                                        }elseif ($i == 5) {
                                            echo '
                                            <option value="'.$i.'">
                                                <small class="fst-italic">Batal</small>
                                            </option>';
                                        }
                                    }
                                echo '
                                </select>

                                <div class="submit mt-4">
                                    <button type="submit" name="update" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>';
    }?>

    <!-- Modal Info-->
    <?php foreach ($data->dtpemesanan() as $dt){
        echo '
            <div class="modal fade" id="info'.$dt['id_pemesanan'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Pesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <h4>Barang Pesanan</h4>
                                <hr>';
                                foreach ($barang->show() as $b){
                                    if ($b['id_barang'] == $dt['id_barang']) {
                                        echo'
                                        <div class="mb-3 mt-3">
                                            <label class="form-label">'.$b['nama_barang'].'</label>
                                            <input type="text" class="form-control" value="'.$b['harga_jual'].'" readonly>
                                        </div>';
                                    }
                                }
                        echo'
                        </div>
                    </div>
                </div>
            </div>';
    }?>

    <!-- Modal Tambah Pemesanan -->
            <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pemesanan</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="mb-3 mt-3">
                                    <label for="id_calon_konsumen" class="form-label">Id Konsumen</label>
                                    <input type="text" name="id_calon_konsumen" class="form-control col-6">
                                </div>

                                <input type="hidden" name="status_pemesanan" class="form-control" value="4">

                                <div class="mb-3 mt-3">
                                    <label for="tgl_pemesanan" class="form-label">Tanggal Pemesanan (YYYY-MM-DD)</label>
                                    <input type="text" name="tgl_pemesanan" class="form-control">
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="alamat_pengiriman" class="form-label">Alamat Pengiriman</label>
                                    <input type="text" name="alamat_pengiriman" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="total_harga" class="form-label">Total Harga</label>
                                    <input type="number" name="total_harga" class="form-control">
                                </div>

                                <div class="submit mt-4">
                                    <button type="submit" name="add" class="btn btn-primary">
                                        Simpan
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>