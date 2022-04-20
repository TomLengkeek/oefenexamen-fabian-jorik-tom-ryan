<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Studenoverzicht</title>
  </head>
  <body>
  <?php echo $data["title"]; ?>

    
<table class="table table-dark">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">voornaam</th>
      <th scope="col">tussenvoegsel</th>
      <th scope="col">achternaam</th>
      <th scope="col">email</th>
      <th scope="col">telefoonnummer</th>
      <th scope="col">klas</th>
      <th scope="col">studentnummer</th>
      <th scope="col">beroep</th>
      <th scope="col">update</th>
      <th scope="col">delete</th>
    </tr>
  </thead>
  <tbody>
  <?=$data['students']?>
  </tbody>
</table>

<a href="<?=URLROOT;?>/students/create">Nieuw record </a>
<a href="<?=URLROOT;?>/homepages/index">terug</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

   
  </body>
</html>