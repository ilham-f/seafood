<?php

require_once 'db.php';

class barang extends db {

    function show(){
        $data = $this->db->prepare("SELECT * FROM barang");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }
    
    function joinJenisBarang(){
        $data = $this->db->prepare("SELECT * 
                                    FROM barang b join jenis_barang j
                                    ON b.id_jenis = j.id_jenis");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }

    function store($id_jenis, $nama_barang, $stok_barang, $berat_barang, $harga_jual, $gambar_barang){

        $data = $this->db->prepare("INSERT INTO barang (id_jenis, nama_barang, stok_barang, berat_barang, harga_jual, gambar_barang) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
        
        $data->bindParam(1, $id_jenis);
        $data->bindParam(2, $nama_barang);
        $data->bindParam(3, $stok_barang);
        $data->bindParam(4, $berat_barang);
        $data->bindParam(5, $harga_jual);
        $data->bindParam(6, $gambar_barang);
        
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
        
        return $result;
    }

    function upload($gambar){
        $namaFile = $gambar['name'];
        $error = $gambar['error'];
        $tmpName  = $gambar['tmp_name'];

        // cek apakah tidak ada gambar yang diupload
        if( $error == 4 ) {
            echo "<script>
                    alert('Silakan pilih gambar terlebih dahulu!');
                  </script>";
            return false;
        }

        // cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'webp'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if ( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
            echo "<script>
                    alert('Mohon gunakan format file jpg / jpeg / png / webp!');
                  </script>";
            return false;
        }

        move_uploaded_file($tmpName, 'assets/img/'.$namaFile);

        return $namaFile;
    }
    
    function update($id_barang, $id_jenis, $nama_barang, $stok_barang, $berat_barang, $harga_jual, $gambar_barang){
        $data = $this->db->prepare("UPDATE barang 
                                    SET id_jenis = '$id_jenis', 
                                        nama_barang = '$nama_barang', 
                                        stok_barang = $stok_barang, 
                                        berat_barang = '$berat_barang', 
                                        harga_jual = $harga_jual, 
                                        gambar_barang = '$gambar_barang'
                                    WHERE id_barang = $id_barang");

            
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
            
        return $result;
    }
    
    function updateBarang($id_barang, $id_jenis, $nama_barang, $stok_barang, $berat_barang, $harga_jual){
        $data = $this->db->prepare("UPDATE barang 
                                    SET id_jenis = '$id_jenis', 
                                        nama_barang = '$nama_barang', 
                                        stok_barang = $stok_barang, 
                                        berat_barang = '$berat_barang', 
                                        harga_jual = $harga_jual
                                    WHERE id_barang = $id_barang");

            
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }

        return $result;
    }
    
    function delete($id_barang){
        $data = $this->db->prepare("DELETE FROM barang
                                    WHERE id_barang = $id_barang");

        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
            
        return $result;
    }
    
}

?>