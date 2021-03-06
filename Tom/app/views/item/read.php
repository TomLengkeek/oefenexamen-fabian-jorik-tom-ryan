<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>ICT Item Overzicht</title>

    <style>

    </style>
</head>

<body>
    <div class="container">
        <?php
        if(!empty($data['alert'])){
            echo $data['alert'];
            header("Refresh: 1; url=". URLROOT . "/item/read/" . $data["pageNumber"]);
        }
        ?>
        <div class="row">
            <h1>Overzicht van Items</h1>
        </div>
        <div class="row" style="padding-bottom:1%">
            <a href="<?=URLROOT?>/artikel/create" style="padding-top: 10px;"><button type="button" class="btn btn-secondary">artikel aanmaken</button></a>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-dark table-hover" style="text-overflow: ellipsis">
                    <thead>
                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">omschrijving</th>
                            <th scope="col">merk</th>
                            <th scope="col">typenummer</th>
                            <th scope="col">aanschaffingsdatum</th>
                            <th scope="col">prijs</th>
                            <th scope="col">status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        echo $data['records'];
                        ?>
                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <?=$data["pageItems"]?>
                </ul>
                </nav>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>