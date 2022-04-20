<?php

class Item extends Controller
{
    public $logs = [];
    private $itemModel;
    private $statusModel;

    public function __construct()
    {
        $this->itemModel = $this->model('Items');
        $this->statusModel = $this->model('Status');
    }

    public function index()
    {

        $data = [
            '' => ''
        ];
        $this->view('artikel/index', $data);
    }


    //gives the view table rows
    public function read($pageNumber,$message = "")
    {

        //set up alerts that pop up when we have done an action
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
                case "item-failed":
                    $alert .= '<div class="alert alert-danger" style="text-align: center;" role="alert">
                            items ophalen niet gelukt
                            </div>';
                    break;
                default:
                    break;
            }
        }
        //create the rows for inside the table
        try {
            if($pageNumber > $this->page_count()){
                $pageNumber = 1;
            }
            $records = "";
            foreach ($this->itemModel->getPages($pageNumber) as $record) {
                $records .= "<tr>
            <th scope='row'>" . $record->id . "</th>
            <td> " . $record->omschrijving . "</td>
            <td> " . $record->merk . "</td>
            <td> " . $record->typenummer . "</td>
            <td> " . $record->aanschaffingsdatum . "</td>
            <td> " . $record->prijs . "</td>
            <td> " . $record->status . "</td>
            <td>
                <a href='" . URLROOT .  "/item/update/" . $record->id . "'>
                    edit
                </a>
            </td>
            <td>
                <a href='" . URLROOT . "/item/delete/" . $record->id . "'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x' viewBox='0 0 16 16'>
                        <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
                    </svg>
                </a>
            </td>   
            </tr>";
            }
        } catch (PDOException $e) {
            array_push($this->logs, 'reading failed ' . $e->getMessage());
            echo $e->getMessage();
            exit();
        }

        $data = [
            'records' => $records,
            'logs' => $this->logs,
            'alert' => $alert,
            'pageItems' => $this->page_items($this->page_count()),
            'pageNumber' => $pageNumber
        ];
        $this->view('item/read', $data);
    }

    //fills a string with options for a HTML selector
    public function fillSelector($info = '')
    {
        $records = "";
        foreach ($this->statusModel->getStatus() as $record) {
            $selected = ($info == $record->omschrijving) ? "selected" : ""; //check if the status is the one we have selected
            $records .= "<option value = '" . $record->omschrijving . "'" . $selected . ">" . $record->omschrijving .  "</option>";
        }
        return $records;
    }

    //gives the view the option tags for inside the selector
    public function create()
    {
        $validateValues = ["omschrijving", "merk", "typenummer", "aanschaffingsdatum", "prijs", "status"];
       //check if we have entered the page via a post request. if yes we have already submitted the form
        if ($_SERVER["REQUEST_METHOD"] === 'POST') {
            //make sure all the post values we need are filled in
            if($this->validate($validateValues)){
                try {
                    //filter all the post variables and put the into the model
                    $this->itemModel->omschrijving = filter_var($_POST["omschrijving"], FILTER_UNSAFE_RAW);
                    $this->itemModel->merk = filter_var($_POST["merk"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $this->itemModel->typenummer = filter_var($_POST["typenummer"], FILTER_UNSAFE_RAW);
                    $this->itemModel->aanschaffingsdatum = filter_var($_POST["aanschaffingsdatum"], FILTER_UNSAFE_RAW);
                    $this->itemModel->prijs = filter_var($_POST["prijs"], FILTER_SANITIZE_NUMBER_FLOAT);
                    $this->itemModel->status = filter_var($_POST["status"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    //execute insert statement
                    $this->itemModel->insertItem();

                    array_push($this->logs, 'creating success');
                    
                    header('Location:' . URLROOT . '/item/read/1/creating-success');
                } catch (PDOException $e) {
                    array_push($this->logs, 'creating failed ' . $e->getMessage());
                    header('Location:' . URLROOT . '/item/read/1/creating-failed');
                }
            }
            else{
                header('Location:' . URLROOT . '/item/read/1/creating-failed');
            }
        } else {
            try {
                //get the options for the category selector
                $records = $this->fillSelector();
            } catch (PDOException $e) {
                array_push($this->logs, 'getting options failed ' . $e->getMessage());
                header('Location:' . URLROOT . '/item/read/1/creating-failed');
            }

            $data = [
                'records' => $records,
                'logs' => $this->logs
            ];
            $this->view('item/create', $data);
        }
    }



    //passes the info of the specified record 
    public function update($id = null)
    {   
        $validateValues = ["omschrijving", "merk", "typenummer", "aanschaffingsdatum", "prijs", "status", "id" ];
        //checks if the method we used to access this page is equal to POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //make sure every value is filled in the post array that we need
            if($this->validate($validateValues)){
                //sets the properties in the model and executes the update query
                try {
                    $this->itemModel->omschrijving = filter_var($_POST["omschrijving"], FILTER_UNSAFE_RAW);
                    $this->itemModel->merk = filter_var($_POST["merk"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $this->itemModel->typenummer = filter_var($_POST["typenummer"], FILTER_UNSAFE_RAW);
                    $this->itemModel->aanschaffingsdatum = filter_var($_POST["aanschaffingsdatum"], FILTER_UNSAFE_RAW);
                    $this->itemModel->prijs = filter_var($_POST["prijs"], FILTER_SANITIZE_NUMBER_FLOAT);
                    $this->itemModel->status = filter_var($_POST["status"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $this->itemModel->id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
        
                    $this->itemModel->updateitem();
        
                    header("Location: " . URLROOT . "/item/read/1/update-success");
                } catch (PDOException $e) {
                    array_push($this->logs, "updating failed " . $e->getMessage());
                    header("Location: " . URLROOT . "/item/read/1/update-failed");
                }
            }
            else{
                header("Location: " . URLROOT . "/item/read/1/update-failed");
            }
        } else {

            try {
                //set the id property of the model and get the info based on that
                $this->itemModel->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

                $info = $this->itemModel->getInfoById();
                if (!empty($info)) {
                    $selector = $this->fillSelector($info->status);
                } else {
                    header('Location:' . URLROOT . '/item/read/1/info-failed');
                }
            } catch (PDOException $e) {
                array_push($this->logs, 'info failed ' . $e->getMessage());
                header('Location:' . URLROOT . '/item/read/1/info-failed');
            }
        }

        $data = [
            'info' => $info,
            'logs' => $this->logs,
            'records' => $selector
        ];
        $this->view('item/update', $data);
    }

    //deletes a row from the database where the id is the specified id
    public function delete($id)
    {
        try {
            $this->itemModel->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
            if ($this->itemModel->getInfoById()) {
                $this->itemModel->delete();

                array_push($this->logs, "deleting succes");

                header("Location: " . URLROOT . "/item/read/1/delete-success");
            } else {
                header("Location: " . URLROOT . "/item/read/1/delete-failed");
            }
        } catch (PDOException $e) {
            array_push($this->logs, "deleting failed " . $e->getMessage());
            header("Location: " . URLROOT . "/item/read/1/delete-failed");
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


    //get the amount of records and get the amount of pages based on that
    public function page_count(){
        try{
            $itemsCount = $this->itemModel->countItems()->itemCount;
        }catch(PDOException $e){
            header("Refresh:0; url=" . URLROOT . "/item/read/1/item-failed");
        }
            $pages = 0;
            $counter = 0;
        for($count = 0; $count <= $itemsCount; $count++){
            if($counter == 5){
                $counter = 0;
                $pages++;
            }else{
                $counter++;
            }    
        }

        if($counter > 0){
            $pages++;
        }
        return $pages;
    }

    public function page_items($pages){
        $page_items = "";
        for($x=1;$x <= $pages;$x++){
            $page_items .= '<li class="page-item"><a class="page-link" href="'. URLROOT . '/item/read/'. $x . '">'. $x. '</a></li>';
        }
        return $page_items;
    }
}
