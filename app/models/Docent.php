<?php
class Docent
{
  private $db;

  public function __construct()
  {
    $this->db = new Database();
  }

  public function getDocenten()
  {
    $this->db->query("SELECT * FROM `docent`;");

    $result = $this->db->resultSet();

    return $result;
  }

  public function getSingleDocent($id)
  {
    $this->db->query("SELECT * FROM docent WHERE id = :id");
    $this->db->bind(':id', $id, PDO::PARAM_INT);
    return $this->db->single();
  }

  public function updateDocent($post)
  {
    $this->db->query("UPDATE docent 
                      SET afkorting = :afkorting,
                          voornaam = :voornaam,
                          tussenvoegsel = :tussenvoegsel,
                          achternaam = :achternaam,
                          email = :email,
                          telnum = :telnum,
                          mentorklas = :mentorklas
                      WHERE id =:id");

    $this->db->bind(':id', $post["id"], PDO::PARAM_INT);
    $this->db->bind(':afkorting', $post["afkorting"], PDO::PARAM_STR);
    $this->db->bind(':voornaam', $post["voornaam"], PDO::PARAM_STR);
    $this->db->bind(':tussenvoegsel', $post["tussenvoegsel"], PDO::PARAM_STR);
    $this->db->bind(':achternaam', $post["achternaam"], PDO::PARAM_STR);
    $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
    $this->db->bind(':telnum', $post["telnum"], PDO::PARAM_STR);
    $this->db->bind(':mentorklas', $post["mentorklas"], PDO::PARAM_STR);

    return $this->db->execute();
  }

  public function deleteDocent($id)
  {
    $this->db->query("DELETE FROM docent WHERE id = :id");
    $this->db->bind("id", $id, PDO::PARAM_INT);
    return $this->db->execute();
  }

  public function createDocent($post)
  {
    $this->db->query("INSERT INTO docent(id, afkorting, voornaam, tussenvoegsel, achternaam, email, telnum, mentorklas) 
    VALUES(:id, :afkorting, :voornaam, :tussenvoegsel, :achternaam, :email, :telnum, :mentorklas)");

    $this->db->bind(':id', $post["id"], PDO::PARAM_INT);
    $this->db->bind(':afkorting', $post["afkorting"], PDO::PARAM_STR);
    $this->db->bind(':voornaam', $post["voornaam"], PDO::PARAM_STR);
    $this->db->bind(':tussenvoegsel', $post["tussenvoegsel"], PDO::PARAM_STR);
    $this->db->bind(':achternaam', $post["achternaam"], PDO::PARAM_STR);
    $this->db->bind(':email', $post["email"], PDO::PARAM_STR);
    $this->db->bind(':telnum', $post["telnum"], PDO::PARAM_STR);
    $this->db->bind(':mentorklas', $post["mentorklas"], PDO::PARAM_STR);

    return $this->db->execute();
  }
}
