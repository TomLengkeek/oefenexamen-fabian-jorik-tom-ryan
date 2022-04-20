<?php

class Artikel extends Controller
{
    public $logs = [];
    private $artikelModel;
    private $categoryModel;

    public function __construct()
    {
        $this->artikelModel = $this->model('Artikelen');
        $this->categoryModel = $this->model('Category');
    }

    public function index()
    {

        $data = [
            '' => ''
        ];
        $this->view('artikel/index', $data);
    }


    //gives the view table rows
    public function read($message = "")
    {

        $alert = null;
        if (!empty($message)) {
            switch ($message) {
                case "info-failed":
                    $alert .=  '<div class="alert alert-danger" style="text-align: center;" role="alert">
                            info ophalen gefaald probeer later opnieuw
                            </div>';
                    break;
                case "creating-failed":
                    $alert .= '<div class="alert alert-danger" style="text-align: center;" role="alert">
                            artikel aanmaken niet gelukt.. probeer later opnieuw
                            </div>';
                    break;
                case "creating-success":
                    $alert .= '<div class="alert alert-success" style="text-align: center;" role="alert">
                            Artikel succesvol aangemaakt                       
                            </div>';
                    break;
                case "update-success":
                    $alert .= '<div class="alert alert-success" style="text-align: center;" role="alert">
                            Artikel succesvol geupdate                       
                            </div>';
                    break;
                case "delete-success":
                    $alert .= '<div class="alert alert-success" style="text-align: center;" role="alert">
                            Artikel succesvol verwijderd                       
                            </div>';
                    break;
                case "update-failed":
                    $alert .= '<div class="alert alert-danger" style="text-align: center;" role="alert">
                            artikel updaten niet gelukt.. probeer later opnieuw
                            </div>';
                    break;
                case "delete-failed":
                    $alert .= '<div class="alert alert-danger" style="text-align: center;" role="alert">
                            artikel verwijderen niet gelukt.. probeer later opnieuw
                            </div>';
                    break;
                default:
                    break;
            }
        }
        try {
            $records = "";
            foreach ($this->artikelModel->getArtikelen() as $record) {
                $records .= "<tr>
            <th scope='row'>" . $record->artikelid . "</th>
            <td> " . $record->omschrijving . "</td>
            <td> " . $record->category . "</td>
            <td> " . $record->aantal . "</td>
            <td> " . $record->locatie . "</td>
            <td> " . $record->kosten . "</td>
            <td>
                <a href='" . URLROOT .  "/artikel/update/" . $record->artikelid . "'>
                    edit
                </a>
            </td>
            <td>
                <a href='" . URLROOT . "/artikel/delete/" . $record->artikelid . "'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x' viewBox='0 0 16 16'>
                        <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
                    </svg>
                </a>
            </td>   
            </tr>";
            }
        } catch (PDOException $e) {
            array_push($this->logs, 'reading failed ' . $e->getMessage());
        }

        $data = [
            'records' => $records,
            'logs' => $this->logs,
            'alert' => $alert
        ];
        $this->view('artikel/read', $data);
    }

    //fills a string with options for a HTML selector
    public function fillSelector($info = '')
    {
        $records = "";
        foreach ($this->categoryModel->getCategory() as $record) {
            $selected = ($info == $record->category) ? "selected" : ""; //check if the category is the one we have selected
            $records .= "<option value = '" . $record->category . "'" . $selected . ">" . $record->category .  "</option>";
        }
        return $records;
    }

    //gives the view the option tags for inside the selector
    public function create()
    {
        $validateValues = ["omschrijving", "aantal", "category", "locatie", "kosten"];
       //check if we have entered the page via a post request. if yes we have already submitted the form
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            //make sure all the post values we need are filled in
            if($this->validate($validateValues)){
                try {
                    //filter all the post variables and put the into the model
                    $this->artikelModel->omschrijving = filter_var($_POST["omschrijving"], FILTER_UNSAFE_RAW);
                    $this->artikelModel->aantal = filter_var($_POST["aantal"], FILTER_SANITIZE_NUMBER_INT);
                    $this->artikelModel->category = filter_var($_POST["category"], FILTER_UNSAFE_RAW);
                    $this->artikelModel->locatie = filter_var($_POST["locatie"], FILTER_UNSAFE_RAW);
                    $this->artikelModel->kosten = filter_var($_POST["kosten"], FILTER_SANITIZE_NUMBER_FLOAT);

                    //execute insert statement
                    $this->artikelModel->insertArtikel();

                    array_push($this->logs, 'creating success');
                    
                    header('Location:' . URLROOT . '/artikel/read/creating-success');
                } catch (PDOException $e) {
                    array_push($this->logs, 'creating failed ' . $e->getMessage());
                    header('Location:' . URLROOT . '/artikel/read/creating-failed');
                }
            }
            else{
                header('Location:' . URLROOT . '/artikel/read/creating-failed');
            }
        } else {
            try {
                //get the options for the category selector
                $records = $this->fillSelector();
            } catch (PDOException $e) {
                array_push($this->logs, 'getting options failed ' . $e->getMessage());
                header('Location:' . URLROOT . '/artikel/read/creating-failed');
            }

            $data = [
                'records' => $records,
                'logs' => $this->logs
            ];
            $this->view('artikel/create', $data);
        }
    }



    //passes the info of the specified record 
    public function update($id = null)
    {
        $validateValues = ["omschrijving", "aantal", "category", "locatie", "kosten", "id" ];
        //checks if the method we used to access this page is equal to POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //make sure every value is filled in the post array that we need
            if($this->validate($validateValues)){
                //sets the properties in the model and executes the update query
                try {
                    $this->artikelModel->omschrijving = filter_var($_POST["omschrijving"], FILTER_UNSAFE_RAW);
                    $this->artikelModel->aantal = filter_var($_POST["aantal"], FILTER_SANITIZE_NUMBER_INT);
                    $this->artikelModel->category = filter_var($_POST["category"], FILTER_UNSAFE_RAW);
                    $this->artikelModel->locatie = filter_var($_POST["locatie"], FILTER_UNSAFE_RAW);
                    $this->artikelModel->kosten = filter_var($_POST["kosten"], FILTER_SANITIZE_NUMBER_FLOAT);
                    $this->artikelModel->id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        
                    $this->artikelModel->updateArtikel();
        
                    header("Location: " . URLROOT . "/artikel/read/update-success");
                } catch (PDOException $e) {
                    array_push($this->logs, "updating failed " . $e->getMessage());
                    header("Location: " . URLROOT . "/artikel/read/update-failed");
                }
            }
            else{
                header("Location: " . URLROOT . "/artikel/read/update-failed");
            }
        } else {

            try {
                //set the id property of the model and get the info based on that
                $this->artikelModel->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

                $info = $this->artikelModel->getInfoById();
                if (!empty($info)) {
                    $selector = $this->fillSelector($info->category);
                } else {
                    header('Location:' . URLROOT . '/artikel/read/info-failed');
                }
            } catch (PDOException $e) {
                array_push($this->logs, 'info failed ' . $e->getMessage());
                header('Location:' . URLROOT . '/artikel/read/info-failed');
            }
        }

        $data = [
            'info' => $info,
            'logs' => $this->logs,
            'selector' => $selector
        ];
        $this->view('artikel/update', $data);
    }

    //deletes a row from the database where the id is the specified id
    public function delete($id)
    {
        try {
            $this->artikelModel->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if ($this->artikelModel->getInfoById()) {
                $this->artikelModel->delete();

                array_push($this->logs, "deleting succes");

                header("Location: " . URLROOT . "/artikel/read/delete-success");
            } else {
                header("Location: " . URLROOT . "/artikel/read/delete-failed");
            }
        } catch (PDOException $e) {
            array_push($this->logs, "deleting failed " . $e->getMessage());
            header("Location: " . URLROOT . "/artikel/read/delete-failed");
        }
    }
    //fills a bootstrap card with information from rows in the artikel table where `geleend` = $status
    //status being the url parameter for deciding if we want 'inleveren' or 'uitlenen'
    //and then passes it to the view so we can display the information
    //also creates modals for the button so we can ask if they are sure
    public function uitlenen($status, $message = "")
    {
        $alert = "";
        //setting up variables for inleveren or uitlenen
        switch ($status) {
            case "uitlenen":
                $updateStatus = 0;
                $getStatus = true;
                $string = "inleveren";
                $title = "Uitgeleende artikelen";
                $button = "Ingeleverde artikelen";
                break;
            case "inleveren":
                $updateStatus = 1;
                $getStatus = false;
                $string = "uitlenen";
                $title = "Ingeleverde artikelen";
                $button = "Uitgeleende artikelen";
                break;
        }
        switch ($message) {
            case "inleveren-success":
                $alert .= '<div class="alert alert-success" style="text-align: center;" role="alert">
                            inleveren succesvol
                        </div>';
                // $this->messageShown = true;
                break;
            case "inleveren-failed":
                $alert .= '<div class="alert alert-danger" style="text-align: center;" role="alert">
                            inleveren niet gelukt
                            </div>';
                // $this->messageShown = true;
                break;
            case "uitlenen-success":
                $alert .= '<div class="alert alert-success" style="text-align: center;" role="alert">
                            uitlenen succesvol
                        </div>';
                // $this->messageShown = true;
                break;
            case "uitlenen-failed":
                $alert .= '<div class="alert alert-danger" style="text-align: center;" role="alert">
                            uitlenen niet gelukt
                            </div>';
                // $this->messageShown = true;
                break;

            default:
                break;
        }


        try {
            $records = '';
            foreach ($this->artikelModel->getGeleend($getStatus) as $record) {
                //because we cant use numbers we have to make sure the id doesnt have a space inbetween so we just take everything before the space
                $modalid = implode("", explode(" ", $record->omschrijving));
                $records .= '<div class="col-4 modal-card" id="' . $record->artikelid . '" style="padding-bottom:2%">
                <div class="card" style="text-align:center">
                    <div class="card-header">
                        ' . $record->category . '
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"> ' . $record->omschrijving . '</h5>
                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#' . $modalid . '">' . $string . '</a>
                    </div>
                </div>
            </div>
            <div class="modal" tabindex="-1" id="' . $modalid . '">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">' . $string . '</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Wilt u zeker het artikel ' . $record->omschrijving . ' ' . $string . '?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Nee</button>
                            <a href="' . URLROOT . '/artikel/inleveren/' . $record->artikelid . '/' . $updateStatus . '"><button type="button" class="btn btn-success">Ja</button></a>
                        </div>
                    </div>
                </div>
            </div>';
            }
        } catch (PDOException $e) {
            array_push($this->logs, "artikelen ophalen mislukt " . $e->getMessage());
            $alert .= '<div class="alert alert-danger" style="text-align: center;" role="alert">
                artikelen ophalen mislukt
            </div>';
        }
        $data = [
            "alert" => $alert,
            "records" => $records,
            "logs" => [$this->logs],
            "string" => $string,
            "title" => $title,
            "button" => $button
        ];

        $this->view("artikel/uitlenen", $data);
    }

    public function inleveren($id, $status)
    {
        if ($status) {
            $link = "uitlenen";
        } else {
            $link = "inleveren";
        }

        try {
            $this->artikelModel->id = $id;
            $this->artikelModel->toggleGeleend($status);
            array_push($this->logs, "inleveren success");
            header("Location: " . URLROOT . "/artikel/uitlenen/" . $link . "/" . $link .  "-success");
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
            header("Location: " . URLROOT . "/artikel/uitlenen/" . $link . "/" . $link .  "-failed");
        }
    }

    // checks if any of the given values are empty in the post array.
    public function validate($values = []){
        $validated = true;
        foreach($values as $value){
            if(empty($_POST[$value])){
                $validated = false;
                break;
            }
        }
        return $validated;
    }
}
