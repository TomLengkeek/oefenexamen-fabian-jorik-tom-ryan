<?php
class Docenten extends Controller
{

  public function __construct()
  {
    $this->docentModel = $this->model('Docent');
  }

  public function index()
  {
    /**
     * Haal via de method getFruits() uit de model Fruit de records op
     * uit de database
     */
    $docenten = $this->docentModel->getDocenten();

    /**
     * Maak de inhoud voor de tbody in de view
     */
    $rows = '';
    foreach ($docenten as $value) {
      $rows .= "<tr>
                <td>$value->id</td>
                <td>" . htmlentities($value->afkorting, ENT_QUOTES, 'ISO-8859-1') . "</td>
                <td>" . htmlentities($value->voornaam, ENT_QUOTES, 'ISO-8859-1') . "</td>
                <td>" . htmlentities($value->tussenvoegsel, ENT_QUOTES, 'ISO-8859-1') . "</td>
                <td>" . htmlentities($value->achternaam, ENT_QUOTES, 'ISO-8859-1') . "</td>
                <td>" . htmlentities($value->email, ENT_QUOTES, 'ISO-8859-1') . "</td>
                <td>" . htmlentities($value->telnum, ENT_QUOTES, 'ISO-8859-1') . "</td>
                <td>" . htmlentities($value->mentorklas, ENT_QUOTES, 'ISO-8859-1') . "</td>
                <td><a href='" . URLROOT . "./docenten/update/$value->id'>update</td>
                <td><a href='" . URLROOT . "./docenten/delete/$value->id'>delete</td>
              </tr>";
    }


    $data = [
      'title' => '<h1>Landenoverzicht</h1>',
      'docenten' => $rows
    ];
    $this->view('docenten/index', $data);
  }

  public function update($id = null)
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $this->docentModel->updateDocent($_POST);
      header("Location:" . URLROOT . "/docenten/index");
    } else {
      $row = $this->docentModel->getSingleDocent($id);
      $data = [
        'title' => '<h1>Update landenoverzicht</h1>',
        'row' => $row
      ];
      $this->view("docenten/update", $data);
    }
  }
  public function delete($id)
  {
    $this->docentModel->deleteDocent($id);

    $data = [
      'deleteStatus' => "Het record met id = $id is verwijdert "
    ];
    $this->view("docenten/delete", $data);
    header("Refresh:2; url=" . URLROOT . "/docenten/index");
  }

  public function create()
  {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

      $this->docentModel->createDocent($_POST);

      header("Location:" . URLROOT . "/docenten/index");
    } else {
      $data = [
        'title' => "Voer een nieuw land toe"
      ];

      $this->view("docenten/create", $data);
    }
  }
}
