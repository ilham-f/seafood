<?php

require_once 'calon_konsumen.php';
require_once 'negara.php';

$data = new calon_konsumen;
$negara = new negara;

// Delete calon_konsumen
if(isset($_POST['delete'])){
    $id_barang = $_POST['id_barang'];

    $data->delete($id_barang);

    header("Location: tabel-calon_konsumen.php");
}

// Update calon_konsumen
if(isset($_POST['update'])){
    //id_calon_konsumen,id_negara,nama_calon_konsumen,email_calon_konsumen,tgl_penawaran_terakhir
    $id_calon_konsumen = $_POST['id_calon_konsumen'];
    $id_negara = $_POST['id_negara'];
    $nama_calon_konsumen = $_POST['nama_calon_konsumen'];
    $email_calon_konsumen = $_POST['email_calon_konsumen'];
    $tgl_penawaran_terakhir = $_POST['tgl_penawaran_terakhir'];

    $data->update($id_calon_konsumen,$id_negara,$nama_calon_konsumen,$email_calon_konsumen,$tgl_penawaran_terakhir);
    
    header("Location: tabel-calon_konsumen.php");
}

// Tambah calon_konsumen
if(isset($_POST['add'])){
    //id_calon_konsumen,id_negara,nama_calon_konsumen,email_calon_konsumen,tgl_penawaran_terakhir
    $id_negara = $_POST['id_negara'];
    $nama_calon_konsumen = $_POST['nama_calon_konsumen'];
    $email_calon_konsumen = $_POST['email_calon_konsumen'];
    $tgl_penawaran_terakhir = $_POST['tgl_penawaran_terakhir'];

    $data->store($id_negara,$nama_calon_konsumen,$email_calon_konsumen,$tgl_penawaran_terakhir);
    
    header("Location: tabel-calon_konsumen.php");
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
                    <ul class="menu">
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

                        <li class="sidebar-item active">
                            <a href="tabel-calon_konsumen.php" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>Calon Konsumen</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
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
                            <h3>Tabel Calon Konsumen</h3>
                            <button type="button" class="btn btn-info mb-3 mt-4 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#tambah">
                                <span class="bi bi-plus-square me-2" style="padding-top: 2px;"></span>Tambah Calon Konsumen
                            </button>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tabel Calon Konsumen</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-borderless">
                                <!-- id_calon_konsumen,id_negara,nama_calon_konsumen,email_calon_konsumen,tgl_penawaran_terakhir -->
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">NEGARA</th>
                                        <th scope="col">NAMA</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">PENAWARAN TERAKHIR</th>
                                        <th scope="col" class="text-center">UBAH / HAPUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //var_dump($data->joinNegara()) ?>
                                    <?php foreach ($data->joinNegara() as $value)
                                       echo'
                                       <tr>
                                           <td>'.$value['id_calon_konsumen'].'</td>
                                           <td>'.$value['nama_negara'].'</td>
                                           <td>'.$value['nama_calon_konsumen'].'</td>
                                           <td>'.$value['email_calon_konsumen'].'</td>
                                           <td>'.$value['tgl_penawaran_terakhir'].'</td>
                                           <td class="d-flex justify-content-center">
                                               <button type="button" class="btn btn-warning me-1 d-flex" data-bs-toggle="modal" data-bs-target="#update'.$value['id_calon_konsumen'].'">
                                                   <li class="bi bi-pencil-square me-1" style="list-style-type: none; padding-top: 6px"></li>
                                                   <div style="padding-top: 4px">Ubah</div>
                                               </button>
                                               <button type="button" class="btn btn-danger d-flex" data-bs-toggle="modal" data-bs-target="#delete'.$value['id_calon_konsumen'].'">
                                                   <li class="bi bi-trash me-1" style="list-style-type: none; padding-top: 6px"></li>
                                                   <div style="padding-top: 4px">Hapus</div>
                                               </button>
                                           </td>
                                       </tr>';     
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Modal Delete-->
    <?php foreach ($data->show() as $value){
        echo'
            <div id="delete'.$value['id_calon_konsumen'].'" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-end">
                                <button type="button" class="btn-close text-end" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="mt-1">
                                <h4>Yakin untuk menghapus?</h4>	
                                <p>Apakah benar anda ingin menghapus '.$value['nama_calon_konsumen'].'?</p>
                            </div>
                            <div class="d-flex flex-row-reverse mt-3">
                                <form action="" method="post">
                                    <input type="hidden" name="id_barang" value="'.$value['id_calon_konsumen'].'" class="form-control col-6">
                                    <button class="btn btn-danger" type="submit" name="delete">Hapus</button>
                                </form>
                                <button class="btn btn-secondary me-2" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }?>

    <!-- Modal Update-->
    <?php foreach ($data->joinNegara() as $value){
        echo '
            <div class="modal fade bd-example-modal-lg" id="update'.$value['id_calon_konsumen'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Calon Konsumen</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post">
                                <input type="hidden" name="id_calon_konsumen" value="'.$value['id_calon_konsumen'].'" class="form-control col-6">

                                <label for="id_negara">Negara</label>
                                <br>
                                <select class="form-select border-1 rounded mt-2" name="id_negara">
                                    <option selected>Pilih Negara</option>';
                                    foreach ($negara->show() as $val){
                                        if($val['id_negara'] == $value['id_negara']){
                                            echo '
                                            <option selected="selected" value="'.$val['id_negara'].'">
                                                '.$val['nama_negara'].'
                                            </option>';
                                        } 
                                        else{
                                            echo '
                                            <option value="'.$val['id_negara'].'">
                                                '.$val['nama_negara'].'
                                            </option>';
                                        }
                                    }
                                echo '
                                </select>

                                <div class="mb-3 mt-3">
                                    <label for="nama_calon_konsumen" class="form-label">Nama Calon Konsumen</label>
                                    <input type="text" name="nama_calon_konsumen" value="'.$value['nama_calon_konsumen'].'" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="stok_barang" class="form-label">Email Calon Konsumen</label>
                                    <input type="text" name="email_calon_konsumen" value="'.$value['email_calon_konsumen'].'" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="tgl_penawaran_terakhir" class="form-label">Tanggal Penawaran Terakhir</label>
                                    <input type="text" name="tgl_penawaran_terakhir" value="'.$value['tgl_penawaran_terakhir'].'" class="form-control">
                                </div>

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

    <!-- Modal Tambah Barang -->
            <div class="modal fade bd-example-modal-lg" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Calon Konsumen</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" enctype="multipart/form-data">
                                <label for="id_negara">Negara</label>
                                <br>
                                <select class="form-select border-1 rounded mt-2" name="id_negara">
                                    <option selected>Pilih Negara</option>
                                    <?php
                                        foreach ($negara->show() as $val){
                                            echo'
                                                <option value="'.$val['id_negara'].'">
                                                    '.$val['nama_negara'].'
                                                </option>';
                                        }
                                    ?>
                                </select>

                                <div class="mb-3 mt-3">
                                    <label for="nama_calon_konsumen" class="form-label">Nama Calon Konsumen</label>
                                    <input type="text" name="nama_calon_konsumen" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="email_calon_konsumen" class="form-label">Email Calon Konsumen</label>
                                    <input type="text" name="email_calon_konsumen" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="tgl_penawaran_terakhir" class="form-label">Tanggal Penawaran Terakhir</label>
                                    <input type="text" name="tgl_penawaran_terakhir" class="form-control">
                                </div>

                                <div class="submit mt-4">
                                    <button type="submit" name="add" class="btn btn-primary">
                                        Tambah
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>

    <script>
    // Add active class to the current button (highlight it)
    var menu = document.getElementById("menu");
    var sidebars = menu.getElementsByClassName("sidebar-item");
    for (var i = 0; i < sidebars.length; i++) {
        sidebars[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }
    </script>

    <script src="assets/js/main.js"></script>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>