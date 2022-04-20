<?php
 class Baliemedewerkers {
    private $db;

    public function __construct() {
        $this->db = new Database;

    }
    //here you get a single records out the database
    public function getBaliemedewerker() {
        $this->db->query("SELECT * FROM persoon");
        $result = $this->db->resultSet();
        return $result;
    }
    //here yuo get a single record
public function getSingleBaliemedewerker($id) {
    $this->db->query("SELECT * FROM persoon WHERE id = :id");
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
}
//here you update the datebase
public function updateBaliemedewerker($post) {
 
    $this->db->query("UPDATE persoon
                            SET studentnummer = :studentnummer,
                            voornaam = :voornaam,
                            tussenvoegsel = :tussenvoegsel,
                            achternaam = :achternaam,
                            email = :email
                            WHERE id = :id");
   $this->db->bind(':id', $post["id"]);
   $this->db->bind(':studentnummer', $post["studentnummer"]);
   $this->db->bind(':voornaam', $post["voornaam"]);
   $this->db->bind(':tussenvoegsel', $post["tussenvoegsel"]);
   $this->db->bind(':achternaam', $post["achternaam"]);
   $this->db->bind(':email', $post["email"]);
   return $this->db->execute();
   
}
//here you delete a record from the database
public function deleteBaliemedewerker($id) {
    $this->db->query("DELETE FROM persoon WHERE id = :id");

    $this->db->bind(":id", $id, PDO::PARAM_INT);

    $this->db->execute();
}

//here you create a record
public function createBaliemedewerker($post) {
    $this->db->query("INSERT INTO persoon(id, studentnummer, voornaam, tussenvoegsel, achternaam, email)
     VALUES(:id, :studentnummer, :voornaam, :tussenvoegsel, :achternaam, :email)");
      $this->db->bind(':id', NULL);
      $this->db->bind(':studentnummer', $post["studentnummer"]);
      $this->db->bind(':voornaam', $post["voornaam"]);
      $this->db->bind(':tussenvoegsel', $post["tussenvoegsel"]);
      $this->db->bind(':achternaam', $post["achternaam"]);
      $this->db->bind(':email', $post["email"]);
      return $this->db->execute();
}



}


?>