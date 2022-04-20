<?php
 class Baliemedewerkers {
    private $db;

    public function __construct() {
        $this->db = new Database;

    }
    public function getBaliemedewerker() {
        $this->db->query("SELECT * FROM persoon");
        $result = $this->db->resultSet();
        return $result;
    }
public function getSingleBaliemedewerker($id) {
    $this->db->query("SELECT * FROM persoon WHERE id = :id");
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
}

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

public function deleteBaliemedewerker($id) {
    $this->db->query("DELETE FROM persoon WHERE id = :id");

    $this->db->bind(":id", $id, PDO::PARAM_INT);

    $this->db->execute();
}
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