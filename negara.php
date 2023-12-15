<?php

require_once 'db.php';

class negara extends db {

    function show(){
        $data = $this->db->prepare("SELECT * FROM negara");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }
    
    function store($id_negara, $nama_negara){
        $data = $this->db->prepare("INSERT INTO negara ($id_negara, $nama_negara) VALUES (?, ?)");

        $data->bindParam(1, $id_negara);
        $data->bindParam(2, $nama_negara);
        
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