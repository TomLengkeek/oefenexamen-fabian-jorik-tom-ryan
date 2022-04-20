<?php
class Students extends Controller {

  public function __construct() {
    $this->studentModel = $this->model('Student');
  }

  public function index() {
    
    $students = $this->studentModel->getStudents();

   
    $rows = '';
    foreach ($students as $value){
      $rows .= "<tr>
                  <td>". $value->id . "</td>
                  <td>" . $value->voornaam . "</td>
                  <td>" . $value->tussenvoegsel . "</td>
                  <td>" . $value->achternaam . "</td>
                  <td>" . $value->email . "</td>
                  <td>" . $value->telefoonnumer . "</td>
                  <td>" . $value->klas . "</td>
                  <td>" . $value->studentnummer . "</td>
                  <td>" . $value->beroep . "</td>
                  
                </tr>";

               
    }


    $data = [
      'title' => '<h1>Studenoverzicht</h1>',
      'students' => $rows
    ];
    $this->view('students/index', $data);
  }

  
}

?>