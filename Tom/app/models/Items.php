<?php 
class Items {

    public $id;
    public $omschrijving;
    public $merk;
    public $typenummer;
    public $aanschaffingsdatum;
    public $prijs;
    public $status;

    private $db;
    //sets up the database connection
    public function __construct(){
        $this->db = new Database();
    }
    //returns all the records form the table item
    public function getItems(){
        $this->db->query('SELECT * FROM item');

        $result = $this->db->resultSet();

        return $result;
    }
    //executes the query for creating new item records
    public function insertitem(){
            $this->db->query("INSERT INTO item (omschrijving, merk, typenummer, aanschaffingsdatum, prijs, status)
            VALUES (:omschrijving, :merk, :typenummer, :aanschaffingsdatum, :prijs, :status)");

            $this->db->bind(":omschrijving", $this->omschrijving);
            $this->db->bind(":merk", $this->merk);
            $this->db->bind(":typenummer", $this->typenummer);
            $this->db->bind(":aanschaffingsdatum", $this->aanschaffingsdatum);
            $this->db->bind(":prijs", $this->prijs);
            $this->db->bind(":status", $this->status);


            $this->db->execute();
    }
    //returns every selected from a record with the specified id
    public function getInfoById(){
            $this->db->query("SELECT * FROM item WHERE id = $this->id");
            $this->db->execute();

            return $this->db->result();
    }
    //executes a query for updating the items with the given information
    public function updateItem(){
       $this->db->query("UPDATE item SET
                                        omschrijving = :omschrijving,
                                        merk = :merk,
                                        typenummer = :typenummer,
                                        aanschaffingsdatum = :aanschaffingsdatum,
                                        prijs = :prijs,
                                        status = :status
                                        WHERE id = :id");

        $this->db->bind(":omschrijving", $this->omschrijving);
        $this->db->bind(":merk", $this->merk);
        $this->db->bind(":typenummer", $this->typenummer);
        $this->db->bind(":aanschaffingsdatum", $this->aanschaffingsdatum);
        $this->db->bind(":prijs", $this->prijs);
        $this->db->bind(":status", $this->status);
        $this->db->bind(":id", $this->id);

        $this->db->execute();
    }
    //deletes the item with the specified id
    public function delete() {
        $this->db->query("DELETE FROM item WHERE id=:id");

        $this->db->bind(":id", $this->id);

        $this->db->execute();
    }

}
