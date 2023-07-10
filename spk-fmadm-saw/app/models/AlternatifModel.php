<?php

class AlternatifModel {

    private $table = 'alternatif';
    private $tableKriteria = 'kriteria';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllAlternatif()
    {
        $this->db->query(
            'SELECT * FROM '
            . $this->table .
            ' INNER JOIN '
            . $this->tableKriteria .
            ' ON '. $this->table .'.id_alternatif = '. $this->tableKriteria .'.id_kriteria'
        );

        return $this->db->resultSet();
    }

    public function getAlternatifById($id)
    {
        $this->db->query(
            'SELECT * FROM '
            . $this->table .
            ' INNER JOIN '
            . $this->tableKriteria .
            ' ON '. $this->table .'.id_alternatif = '. $this->tableKriteria .'.id_kriteria WHERE id_alternatif=:id'
        );

        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function tambahAlternatif($data)
    {
        $query = "INSERT INTO ". $this->table ." (nama_alternatif) VALUES (:nama_alternatif)";

        $this->db->query($query);
        $this->db->bind('nama_alternatif', $data['nama_alternatif']);

        $this->db->execute();
        return $this->db->rowCount();
    }
    
    public function tambahKriteria($data)
    {
        $query = "INSERT INTO ". $this->tableKriteria ." (nama) VALUES (:nama)";

        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        
        for ($i=1; $i <= 11; $i++) { 
            $this->db->bind('c'.$i, $data['c'.$i]);
        }

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateAlternatif($data)
    {
        $query = "UPDATE ". $this->table ." SET 
            nama=:nama, c1=:c1, c2=:c2, c3=:c3, c4=:c4, c5=:c5, c6=:c6, c7=:c7, c8=:c8, c9=:c9, c10=:c10, c11=:c11
            WHERE id_alternatif=:id";

        $this->db->query($query);
        $this->db->bind('id', $data['id_alternatif']);
        $this->db->bind('nama', $data['nama']);

        for ($i=1; $i <= 11; $i++) { 
            $this->db->bind('c'.$i, $data['c'.$i]);
        }

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusAlternatif($id)
    {
        $query = "DELETE FROM ". $this->table ." WHERE id_alternatif=:id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}