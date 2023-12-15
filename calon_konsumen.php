<?php

require_once 'db.php';

class calon_konsumen extends db {

    function show(){
        $data = $this->db->prepare("SELECT * FROM calon_konsumen");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }
    
    
    function joinNegara(){
        $data = $this->db->prepare("SELECT * 
                                    FROM calon_konsumen c JOIN negara n
                                    ON c.id_negara = n.id_negara
                                    ORDER BY C.id_calon_konsumen DESC");

        try {
            $data->execute();
            $result = $data->fetchAll();
        } catch (PDOException $e) {
            print_r($e->getMessage());
        }

        return $result;
    }

    
    //id_calon_konsumen,id_negara,nama_calon_konsumen,email_calon_konsumen,tgl_penawaran_terakhir

    function store($id_negara, $nama_calon_konsumen, $email_calon_konsumen, $tgl_penawaran_terakhir){
        $data = $this->db->prepare("INSERT INTO calon_konsumen (id_negara,nama_calon_konsumen,email_calon_konsumen,tgl_penawaran_terakhir) 
                                    VALUES (?, ?, ?, ?)");
        
        $data->bindParam(1, $id_negara);
        $data->bindParam(2, $nama_calon_konsumen);
        $data->bindParam(3, $email_calon_konsumen);
        $data->bindParam(4, $tgl_penawaran_terakhir);
        
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
        
        return $result;
    }
    
    function update($id_calon_konsumen, $id_negara, $nama_calon_konsumen, $email_calon_konsumen, $tgl_penawaran_terakhir){
        $data = $this->db->prepare("UPDATE calon_konsumen 
                                    SET id_negara = '$id_negara', 
                                        nama_calon_konsumen = '$nama_calon_konsumen', 
                                        email_calon_konsumen = '$email_calon_konsumen', 
                                        tgl_penawaran_terakhir = '$tgl_penawaran_terakhir'
                                    WHERE id_calon_konsumen = '$id_calon_konsumen'");
        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
            
        return $result;
    }
    
    function delete($id_calon_konsumen){
        $data = $this->db->prepare("DELETE FROM calon_konsumen
                                    WHERE id_calon_konsumen = '$id_calon_konsumen'");

        try {
            $result = $data->execute();
        } catch (PDOExeption $e) {
            print_r($e->getMessage());
        }
            
        return $result;
    }
}

?>