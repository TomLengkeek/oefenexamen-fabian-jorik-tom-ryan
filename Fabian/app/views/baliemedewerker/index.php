<!doctype html>
<html>
<head>

<meta name="description" content="Our first page">
<meta name="keywords" content="html tutorial template">
</head>
<body>
<a href="<?=URLROOT;?>/baliemedewerker/create">Nieuw record </a>
<table>
  <tr>
  <th>id</th>
  <th>name</th>
    <th>hoofdstad</th>
    <th>continet</th>
    <th>populatie</th>
    <th>update</th>
    <th>delete</th>
  </tr>
  <tr>
   <?php echo $data["baliemedewerkers"]; ?>
  </tr>
 
</table>
</body>
</html>


