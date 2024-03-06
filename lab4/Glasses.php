<?php

require_once("vendor/autoload.php");

$db = new DBHandler;
$item = null;

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["id"])) {
  if ($db->connect()) {
    $item = $db->get_record_by_id($_GET["id"], "id");
  }
}

if (!empty($item)) {
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
  </head>

  <body>
    <table>
      <tr>
        <th>id</th>
        <th>code</th>
        <th>Type</th>
        <th>price</th>
        <th>rating</th>
        <th>Img</th>
      </tr>
      <tr>
        <td><?php echo $item->id; ?></td>
        <td><?php echo $item->PRODUCT_code; ?></td>
        <td><?php echo $item->product_name; ?></td>
        <td><?php echo $item->list_price; ?></td>
        <td><?php echo $item->Rating; ?></td>
        <td><img width="200" height="200" src="../images/<?php echo $item->Photo; ?>" alt="Image"></td>
      </tr>
    </table>
  </body>

  </html>
<?php
}

$db->disconnect();

?>