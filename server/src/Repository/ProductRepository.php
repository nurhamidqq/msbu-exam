<?php
namespace Src\Repository;
use PDO;
class ProductRepository{

    private $db = null;

    public function __construct($db){
        $this->db = $db;
    }

    public function findAll(){
        $q = $this->db->prepare("
        EXEC AllinOne
        @id = NULL, 
        @nama_barang= NULL, 
        @kode_barang=NULL,
        @jumlah_barang=NULL,
        @tanggal=NULL,
        @StatementType=N'Select';");

        try {
            $q->execute();
            $result = $q->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function search($nama){
        $q = $this->db->prepare("
        EXEC AllinOne
        @id = NULL, 
        @nama_barang= '".$nama."', 
        @kode_barang=NULL,
        @jumlah_barang=NULL,
        @tanggal=NULL,
        @StatementType=N'Search';");

        try {
            $q->execute();
            $result = $q->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function insert(Array $input){
        $q = $this->db->prepare("
        EXEC AllinOne
        @id = NULL, 
        @nama_barang= '".$input['nama_barang']."', 
        @kode_barang= '".$input['kode_barang']."',
        @jumlah_barang= '".$input['jumlah_barang']."',
        @tanggal= '". date("Y-m-d H:i:s") ."',
        @StatementType=N'Insert';");

        try {
            $q->execute();
            $result = $q->rowCount();
            return $result;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function update($id,Array $input){
        $q = $this->db->prepare("
        EXEC AllinOne
        @id = ".$id.", 
        @nama_barang= '".$input['nama_barang']."', 
        @kode_barang= '".$input['kode_barang']."',
        @jumlah_barang= '".$input['jumlah_barang']."',
        @tanggal= '". date("Y-m-d H:i:s") ."',
        @StatementType=N'Update';");

        try {
            $q->execute();
            $result = $q->rowCount();
            return $result;
        } catch (\PDOException $e) {
            return null;
        }
    }

    public function delete($id){
        $q = $this->db->prepare("
        EXEC AllinOne
        @id = ".$id.", 
        @nama_barang=NULL, 
        @kode_barang=NULL,
        @jumlah_barang=NULL,
        @tanggal=NULL,
        @StatementType=N'Delete';");

        try {
            $q->execute();
            $result = $q->rowCount();
            return $result;
        } catch (\PDOException $e) {
            return null;
        }
    }
}