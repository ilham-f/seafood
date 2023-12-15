<?php

require_once 'db.php';

class pemesanan extends db {

    function show(){
        $data = $this->db->prepare("SELECT * FROM pemesanan");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }
    
    function joinKonsumen(){
        $data = $this->db->prepare("SELECT * 
                                    FROM calon_konsumen c
                                    JOIN pemesanan p ON p.id_calon_konsumen = c.id_calon_konsumen
                                    WHERE p.status_pemesanan < '5'");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }

    function dtpemesanan(){
        $data = $this->db->prepare("SELECT * 
                                    FROM pemesanan p
                                    JOIN detail_pemesanan dp ON p.id_pemesanan = dp.id_pemesanan
                                    JOIN barang b ON dp.id_barang = b.id_barang");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }

    function store($id_calon_konsumen, $tgl_pemesanan, $status_pemesanan, $alamat_pengiriman, $total_harga){
        $data = $this->db->prepare("INSERT INTO pemesanan (id_calon_konsumen, tgl_pemesanan, status_pemesanan, alamat_pengiriman, total_harga)
                                    VALUES (?, ?, ?, ?, ?)");

        $data->bindParam(1, $id_calon_konsumen);
        $data->bindParam(2, $tgl_pemesanan);
        $data->bindParam(3, $status_pemesanan);
        $data->bindParam(4, $alamat_pengiriman);
        $data->bindParam(5, $total_harga);
        
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
        
        return $result;
    }
    
    function update($id_pemesanan, $status_pemesanan, $alamat_pengiriman){
        $data = $this->db->prepare("UPDATE pemesanan 
                                    SET status_pemesanan = '$status_pemesanan'
                                    WHERE id_pemesanan = '$id_pemesanan'");
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
            
        return $result;
    }
    
    function delete($id_pemesanan){
        $data = $this->db->prepare("UPDATE pemesanan
                                    SET status_pemesanan = '4'
                                    WHERE id_pemesanan = '$id_pemesanan'");

        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
            
        return $result;
    }
}

?>