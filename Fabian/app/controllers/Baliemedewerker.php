<?php

class baliemedewerker extends Controller {
   
    public function __construct() {
       $this->baliemedewerkerModel = $this->model('Baliemedewerkers');
    }
    public function index() {
//this is for makning the tabel
       
        $baliemedewerker = $this->baliemedewerkerModel->getBaliemedewerker();

        $rows = '';
        foreach ($baliemedewerker as $baliemedewerkers) {
            
        
            $rows .= "<tr><th scope='row'>" .  $baliemedewerkers->id  . "</th>

            <td>".  $baliemedewerkers->studentnummer   . " </td>
            <td>" .  $baliemedewerkers->voornaam  . "</td>
            <td> " .  $baliemedewerkers->tussenvoegsel . " </td>
            <td> " .  $baliemedewerkers->achternaam . " </td>
            <td> " .    $baliemedewerkers->email . " </td>
            <td><a href='" .   URLROOT . "/baliemedewerker/delete/$baliemedewerkers->id'>delete</a></td>
            <td><a href='" .   URLROOT . "/Baliemedewerker/update/$baliemedewerkers->id'>update</a></td>
           


            ";
        

        }
        $data = [
            'title' => 'Home page',
            'baliemedewerkers' => $rows
        ];
        $this->view('baliemedewerker/index', $data);


      
    
    }
    //this is for update the 1 record
    public function update($id = null) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
       $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
       $this->baliemedewerkerModel->updateBaliemedewerker($_POST);
    
    header("Location: " . URLROOT . "/baliemedewerker/index");
    }else {
        try {
        $row = $this->baliemedewerkerModel->getSingleBaliemedewerker($id);
        $data = [
            'title' => '<h1>Update landenoverzicht</h1>',
            'row' => $row
        ];
        $this->view("baliemedewerker/update", $data);
     
        }
   
 catch(PDOException $e) {
    array_push($this->logs, 'update failed ' . $e->getMessage());

 }
   }
}
//this is for delete a record
    public function delete($id)  {

        try {
        $this->baliemedewerkerModel->deleteBaliemedewerker($id);
        $data = 
        [
            'deleteStatus' => "HEt record met id = $id is verwijdert"
        ];
        $this->view("baliemedewerker/delete", $data);
        header("Refresh:2; url=" . URLROOT . "/baliemedewerker/index");
      }  catch(PDOException $e) {
            array_push($this->logs, 'update failed ' . $e->getMessage());
        
        }
    
    } 
// here you create a record
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->baliemedewerkerModel->createBaliemedewerker($_POST);

                header("Location:" . URLROOT . "/baliemedewerker/index");
            } catch (PDOException $e) {
                echo "HEt inserten van het record is niet gelukt";
                header("Refresh:3; url=". URLROOT ."baliemedewerker/index");
            }
            
          } else {
                $data = [ 
                    'title' => "Voeg een nieuw land in"
                ];
                $this->view("baliemedewerker/create", $data);

            }

            }


        }
    



?>