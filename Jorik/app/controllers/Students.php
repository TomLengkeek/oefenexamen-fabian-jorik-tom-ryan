<?php
class Students extends Controller {

    //conection to model
  public function __construct() {
    $this->studentModel = $this->model('Student');
  }

  //Php for index 
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
                  <td><a href = '". URLROOT ."/students/update/$value->id'> update</a> </td>
                  <td><a href = '". URLROOT ."/students/delete/$value->id'> delete</a> </td>
                  
                </tr>";

               
    }


    $data = [
      'title' => '<h1>Studenoverzicht</h1>',
      'students' => $rows
    ];
    $this->view('students/index', $data);
  }

  //Edeting the records
  public function update($id = null){

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        try{
        $this->studentModel->updateStudent($_POST);
        }catch(PDOException $e)
        {
            echo $e->getMessage();
            exit();
        }
        header("Location: ". URLROOT . "/students/index");
    }else{
        $row = $this->studentModel->getSingleStudent($id);
        $data = [
        'title' => '<h1> Update Student gegevens</h1>',
        'row' => $row
        ];
        $this->view("students/update", $data);
      
    }
  }

  //deleting the records
  public function delete($id)  {

    try {
    $this->studentModel->deleteStudent($id);
    $data = 
    [
        'deleteStatus' => "Het record met id = $id is verwijdert"
    ];
    $this->view("students/delete", $data);
    header("Refresh:2; url=" . URLROOT . "/students/index");
  }  catch(PDOException $e) {
        array_push($this->logs, 'update failed ' . $e->getMessage());

    }
}
//creating new records
public function create() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $this->studentModel->createStudent($_POST);

            header("Location:" . URLROOT . "/students/index");
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
            // header("Refresh:3; url=". URLROOT ."students/index");
        }

      } else {
            $data = [ 
                'title' => "Voeg toe"
            ];
            $this->view("students/create", $data);

        }
  
    }
}

?>