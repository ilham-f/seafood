<?php

require_once 'db.php';

class jenis_barang extends db {

    function show(){
        $data = $this->db->prepare("SELECT * FROM jenis_barang");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }
    
    function store($id_jenis, $nama_jenis){
        $data = $this->db->prepare("INSERT INTO jenis_barang (id_jenis, nama_barang) VALUES (?, ?)");

        $data->bindParam(1, $id_jenis);
        $data->bindParam(2, $nama_jenis);
        
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
        
        return $result;
    }

    function update($id_jenis){
        
    }
    
    function delete($id_jenis){
        
    }
}

?>