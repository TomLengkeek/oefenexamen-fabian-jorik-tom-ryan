<?php
  class Student {
    private $db;

    public function __construct() {
      $this->db = new Database();
    }

    public function getStudents() {
      $this->db->query("SELECT * FROM `student`;");

      $result = $this->db->resultSet();

      return $result;
    }
  }

?>