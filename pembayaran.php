<?php

require_once 'db.php';

class pembayaran extends db {

    function show(){
        $data = $this->db->prepare("SELECT * FROM pembayaran");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    } 
    
    function joinPemesanan(){
        $data = $this->db->prepare("SELECT * 
                                    FROM pembayaran b
                                    JOIN pemesanan p ON p.id_pemesanan = b.id_pemesanan");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }
    
    // id_pembayaran, id_pemesanan, tgl_pembayaran, jenis_pembayaran, status_pembayaran, total_pembayaran
    function store($id_pembayaran, $id_pemesanan, $tgl_pembayaran, $jenis_pembayaran, $status_pembayaran, $total_pembayaran){
        $data = $this->db->prepare("INSERT INTO pembayaran (id_pembayaran, id_pemesanan, tgl_pembayaran, jenis_pembayaran, status_pembayaran, total_pembayaran) VALUES (?, ?, ?, ?, ?, ?)");
        
        $data->bindParam(1, $id_pembayaran);
        $data->bindParam(2, $id_pemesanan);
        $data->bindParam(3, $tgl_pembayaran);
        $data->bindParam(4, $jenis_pembayaran);
        $data->bindParam(5, $status_pembayaran);
        $data->bindParam(6, $total_pembayaran);
        
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
        
        return $result;
    }
    
    function update($id_pembayaran, $status_pembayaran){
        $data = $this->db->prepare("UPDATE pembayaran 
                                    SET status_pembayaran = $status_pembayaran
                                    WHERE id_pembayaran = '$id_pembayaran'");
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
            
        return $result;
    }
    
    function delete($id_pemesanan){
        $data = $this->db->prepare("DELETE FROM pembayaran
                                    WHERE id_pembayaran = '$id_pembayaran'");

        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
            
        return $result;
    }
}

?>