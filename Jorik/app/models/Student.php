<?php
  class Student {
    private $db;

    //Database dingen
    public function __construct() {
      $this->db = new Database();
    }

    //Get tabel students 
    public function getStudents() {
      $this->db->query("SELECT * FROM `student`;");

      $result = $this->db->resultSet();

      return $result;
    }

    //Single record out database
    public function getSingleStudent($id){
        $this->db->query("SELECT * FROM student WHERE id = :id");
        $this->db->bind(':id', $id, PDO::PARAM_INT);
        return $this->db->single();
    }

    //Function for editing students
    public function updateStudent($post){
        var_dump($post);
        $this->db->query("UPDATE student
        SET voornaam = :voornaam,
        tussenvoegsel = :tussenvoegsel,
        achternaam = :achternaam,
        email = :email,
        telefoonnumer = :telefoonnumer,
        klas = :klas,
        studentnummer = :studentnummer,
        beroep = :beroep
        WHERE id = :id
        ");

        $this->db->bind(':id', $post['id'],PDO::PARAM_INT);
        $this->db->bind(':voornaam', $post['voornaam'],PDO::PARAM_STR);
        $this->db->bind(':tussenvoegsel', $post['tussenvoegsel'],PDO::PARAM_STR);
        $this->db->bind(':achternaam', $post['achternaam'],PDO::PARAM_STR);
        $this->db->bind(':email', $post['email'],PDO::PARAM_STR);
        $this->db->bind(':telefoonnumer', $post['telefoonnumer'],PDO::PARAM_INT);
        $this->db->bind(':klas', $post['klas'],PDO::PARAM_STR);
        $this->db->bind(':studentnummer', $post['studentnummer'],PDO::PARAM_INT);
        $this->db->bind(':beroep', $post['beroep'],PDO::PARAM_STR);

        return $this->db->execute();


    }


    //Function for deleting studens out of database
    public function deleteStudent($id) {
        $this->db->query("DELETE FROM student WHERE id = :id");
    
        $this->db->bind(":id", $id, PDO::PARAM_INT);
    
        $this->db->execute();
    }


    //Function for making new records in database
    public function createStudent($post) {
        $this->db->query("INSERT INTO student(id, voornaam, tussenvoegsel, achternaam, email, telefoonnumer, klas, studentnummer, beroep)
         VALUES(:id, :voornaam, :tussenvoegsel, :achternaam, :email, :telefoonnumer, :klas, :studentnummer, :beroep         )");

        $this->db->bind(':id', NULL, PDO::PARAM_INT);
        $this->db->bind(':voornaam', $post["voornaam"],PDO::PARAM_STR);
        $this->db->bind(':tussenvoegsel', $post["tussenvoegsel"],PDO::PARAM_STR);
        $this->db->bind(':achternaam', $post["achternaam"],PDO::PARAM_STR);
        $this->db->bind(':email', $post["email"],PDO::PARAM_STR);
        $this->db->bind(':telefoonnumer', $post["telefoonnumer"],PDO::PARAM_INT);
        $this->db->bind(':klas', $post["klas"],PDO::PARAM_STR);
        $this->db->bind(':studentnummer', $post["studentnummer"],PDO::PARAM_INT);
        $this->db->bind(':beroep', $post["beroep"],PDO::PARAM_STR);
        return $this->db->execute();
    }
  }

?>