<?php 

class Status{
    public $omschrijving;

    public $logs = [];
    private $db;

   public function __construct()
   {
       $this->db = new Database();
   }

   //reads all information from the table and returns a string for a html selector
   public function getStatus(){
            $this->db->query("SELECT * FROM status");
            $result = $this->db->resultSet();
            
            return $result;
   }
}

?>