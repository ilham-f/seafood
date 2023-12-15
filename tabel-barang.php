<?php

require_once 'barang.php';
require_once 'jenis_barang.php';

$data = new Barang;
$jenis = new Jenis_barang;

// Delete barang
if(isset($_POST['delete'])){
    $id_barang = $_POST['id_barang'];

    $data->delete($id_barang);

    header("Location: tabel-barang.php");
}

// Update barang
if(isset($_POST['update'])){
    // id_barang, id_jenis, nama_barang, stok_barang, berat_barang, harga_jual, gambar_barang
    $id_barang = $_POST['id_barang'];
    $id_jenis = $_POST['id_jenis'];
    $nama_barang = $_POST['nama_barang'];
    $stok_barang = $_POST['stok_barang'];
    $berat_barang = $_POST['berat_barang'];
    $harga_jual = $_POST['harga_jual'];
    $gambar_barang = $_FILES['gambar_barang'];

    if ($gambar_barang['error'] == 4) {
        $data->updateBarang($id_barang, $id_jenis, $nama_barang, $stok_barang, $berat_barang, $harga_jual);
    } else {
        $gambar = $data->upload($gambar_barang);
        $data->update($id_barang, $id_jenis, $nama_barang, $stok_barang, $berat_barang, $harga_jual, $gambar);
    }
    
    
    header("Location: tabel-barang.php");
}

// Tambah barang
if(isset($_POST['add'])){
    // id_barang, id_jenis, nama_barang, stok_barang, berat_barang, harga_jual, gambar_barang
    $id_jenis = $_POST['id_jenis'];
    $nama_barang = $_POST['nama_barang'];
    $stok_barang = $_POST['stok_barang'];
    $berat_barang = $_POST['berat_barang'];
    $harga_jual = $_POST['harga_jual'];
    $gambar_barang = $_FILES['gambar_barang'];

    $gambar = $data->upload($gambar_barang);
    $data->store($id_jenis, $nama_barang, $stok_barang, $berat_barang, $harga_jual, $gambar);

    header("Location: tabel-barang.php");
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

                        <li class="sidebar-item active">
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
                            <h3>Tabel Barang</h3>
                            <button type="button" class="btn btn-info mb-3 mt-4 d-flex justify-content-center" data-bs-toggle="modal" data-bs-target="#tambah">
                                <span class="bi bi-plus-square me-2" style="padding-top: 2px;"></span>Tambah Barang
                            </button>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tabel Barang</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-borderless">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">JENIS</th>
                                        <th scope="col">GAMBAR</th>
                                        <th scope="col">NAMA</th>
                                        <th scope="col">STOK (BOX)</th>
                                        <th scope="col">BERAT / BOX (KG)</th>
                                        <th scope="col">HARGA / KG</th>
                                        <th scope="col" class="text-center">UBAH / HAPUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php //var_dump($data->joinJenisBarang()) ?>
                                    <?php foreach ($data->joinJenisBarang() as $value)
                                        if ($value['gambar_barang'] != null){
                                            echo'
                                            <tr>
                                                <td>'.$value['id_barang'].'</td>
                                                <td>'.$value['nama_jenis'].'</td>
                                                <td><img class="img-fluid" style="display: block; width: 60px; height: 40px"
                                                    src="assets/img/'.$value['gambar_barang'].'"
                                                </td>
                                                <td>'.$value['nama_barang'].'</td>
                                                <td>'.$value['stok_barang'].'</td>
                                                <td>'.$value['berat_barang'].'</td>
                                                <td>'.$value['harga_jual'].'</td>
                                                <td class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-warning me-1 d-flex" data-bs-toggle="modal" data-bs-target="#update'.$value['id_barang'].'">
                                                        <li class="bi bi-pencil-square me-1" style="list-style-type: none; padding-top: 6px"></li>
                                                        <div style="padding-top: 4px">Ubah</div>
                                                    </button>
                                                    <button type="button" class="btn btn-danger d-flex" data-bs-toggle="modal" data-bs-target="#delete'.$value['id_barang'].'">
                                                        <li class="bi bi-trash me-1" style="list-style-type: none; padding-top: 6px"></li>
                                                        <div style="padding-top: 4px">Hapus</div>
                                                    </button>
                                                </td>
                                            </tr>';
                                        } else {
                                            echo'
                                            <tr>
                                                <td>'.$value['id_barang'].'</td>
                                                <td>'.$value['nama_jenis'].'</td>
                                                <td class="d-flex"><img class="img-fluid" style="display: block; width: 60px; height: 40px"
                                                    src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png"
                                                </td>
                                                <td>'.$value['nama_barang'].'</td>
                                                <td>'.$value['stok_barang'].'</td>
                                                <td>'.$value['berat_barang'].'</td>
                                                <td>'.$value['harga_jual'].'</td>
                                                <td class="d-flex justify-content-center">
                                                    <button type="button" class="btn btn-warning me-1 d-flex" data-bs-toggle="modal" data-bs-target="#update'.$value['id_barang'].'">
                                                        <li class="bi bi-pencil-square me-1" style="list-style-type: none; padding-top: 6px"></li>
                                                        <div style="padding-top: 4px">Ubah</div>
                                                    </button>
                                                    <button type="button" class="btn btn-danger d-flex" data-bs-toggle="modal" data-bs-target="#delete'.$value['id_barang'].'">
                                                        <li class="bi bi-trash me-1" style="list-style-type: none; padding-top: 6px"></li>
                                                        <div style="padding-top: 4px">Hapus</div>
                                                    </button>
                                                </td>
                                            </tr>';
                                        }
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
            <div id="delete'.$value['id_barang'].'" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="text-end">
                                <button type="button" class="btn-close text-end" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="mt-1">
                                <h4>Yakin untuk menghapus?</h4>	
                                <p>Apakah benar anda ingin menghapus '.$value['nama_barang'].'?</p>
                            </div>
                            <div class="d-flex flex-row-reverse mt-3">
                                <form action="" method="post">
                                    <input type="hidden" name="id_barang" value="'.$value['id_barang'].'" class="form-control col-6">
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
    <?php foreach ($data->joinJenisBarang() as $value){
        echo '
            <div class="modal fade bd-example-modal-lg" id="update'.$value['id_barang'].'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_barang" value="'.$value['id_barang'].'" class="form-control col-6">

                                <label for="id_jenis">Jenis Barang</label>
                                <br>
                                <select class="form-select border-1 rounded mt-2" name="id_jenis">
                                    <option selected>Pilih Jenis Barang</option>';
                                    foreach ($jenis->show() as $val){
                                        if($val['id_jenis'] == $value['id_jenis']){
                                            echo '
                                            <option selected="selected" value="'.$val['id_jenis'].'">
                                                '.$val['nama_jenis'].'
                                            </option>';
                                        } 
                                        else{
                                            echo '
                                            <option value="'.$val['id_jenis'].'">
                                                '.$val['nama_jenis'].'
                                            </option>';
                                        }
                                    }
                                echo '
                                </select>

                                <div class="mb-3 mt-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" name="nama_barang" value="'.$value['nama_barang'].'" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="stok_barang" class="form-label">Stok Barang (Box)</label>
                                    <input type="number" name="stok_barang" value="'.$value['stok_barang'].'" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="berat_barang" class="form-label">Berat Barang / Box (Kg)</label>
                                    <input type="text" name="berat_barang" value="'.$value['berat_barang'].'" class="form-control">
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="harga_jual" class="form-label">Harga Jual / Kg</label>
                                    <input type="number" name="harga_jual" value="'.$value['harga_jual'].'" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="gambar_barang" class="form-label">Gambar Barang</label>
                                    <input class="form-control col-6" name="gambar_barang" type="file" id="gambar_barang"
                                        onchange="previewImage(event);">
                                    <img class="mb-3 mt-3" id="update-preview"';
                                        if ($value['gambar_barang'] != null){
                                            echo'
                                                style="display: block; width: 210px; height: 140px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                                src="assets/img/'.$value['gambar_barang'].'"/>';
                                        }else{
                                            echo'
                                                style="display: block; width: 210px; height: 140px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                                src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png"/>';
                                        }
                                echo '
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
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" enctype="multipart/form-data">

                                <label for="id_jenis">Jenis Barang</label>
                                <br>
                                <select class="form-select border-1 rounded mt-2" name="id_jenis">
                                    <option selected>Pilih Jenis Barang</option>
                                    <?php foreach ($jenis->show() as $val){
                                        echo'
                                            <option value="'.$val['id_jenis'].'">
                                                '.$val['nama_jenis'].'
                                            </option>';
                                    }?>
                                </select>

                                <div class="mb-3 mt-3">
                                    <label for="nama_barang" class="form-label">Nama Barang</label>
                                    <input type="text" name="nama_barang" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="stok_barang" class="form-label">Stok Barang (Box)</label>
                                    <input type="number" name="stok_barang" class="form-control">
                                </div>
                                
                                <div class="mb-3 mt-3">
                                    <label for="berat_barang" class="form-label">Berat Barang / Box (Kg)</label>
                                    <input type="text" name="berat_barang" class="form-control">
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="harga_jual" class="form-label">Harga Jual / Kg</label>
                                    <input type="number" name="harga_jual" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label for="gambar_barang" class="form-label">Gambar Barang</label>
                                    <input class="form-control col-6" name="gambar_barang" type="file" id="gambar_barang"
                                        onchange="preview(event);">
                                    <img class="mb-3 mt-3" id="add-preview"
                                        style="display: block; width: 210px; height: 140px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"
                                        src="https://www.its.ac.id/tmesin/wp-content/uploads/sites/22/2022/07/no-image.png"/>
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

    <script>
        function previewImage(event) {
            if (event.target.files.length > 0) {
                const src = URL.createObjectURL(event.target.files[0]);
                const image = document.getElementById('update-preview');
                image.src = src;
                image.style.display = "block";
            }
        }
    </script>
    <script>
        function preview(event) {
            if (event.target.files.length > 0) {
                const src = URL.createObjectURL(event.target.files[0]);
                const image = document.getElementById('add-preview');
                image.src = src;
                image.style.display = "block";
            }
        }
    </script>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>

</body>

</html>