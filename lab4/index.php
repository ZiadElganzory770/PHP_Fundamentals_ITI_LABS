<?php
require_once "vendor/autoload.php";

$db = new DBHandler();
$fields = ["id", "PRODUCT_code", "Photo", "product_name"];
$items = array();

$page = isset($_GET["page"]) ? $_GET["page"] : 0;
$totalItems = 16;
$perPage = 5;
$totalPages = ceil($totalItems / $perPage);

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["click"])) {
  if ($_GET["click"] == "prev") {
    $page = max($page - 1, 0);
  } else if ($_GET["click"] == "next") {
    $page = min($page + 1, $totalPages - 1);
  }
}

if ($db->connect()) {
  $items = $db->get_data($fields, $page * $perPage);
}

if (($_SERVER["REQUEST_METHOD"] == "GET") && isset($_GET["name_column"]) && isset($_GET["value"])) {
  $items = $db->search_by_column($_GET["name_column"], $_GET["value"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>List</title>
</head>

<body>
  <?php
  if (count($items) > 0) {
    echo '<table>';
    echo '<tr>';
    foreach ($fields as $field) {
      echo '<th>' . $field . '</th>';
    }
    echo '</tr>';

    foreach ($items as $item) {
      echo '<tr>';
      foreach ($fields as $field) {
        echo '<td>' . $item->$field . '</td>';
      }
      echo '<td><a href="Glasses.php/?id=' . $item->id . '">More</a></td>';
      echo '</tr>';
    }
    echo '</table>';
    echo '<div class="pagination">';
    if ($page > 0) {
      echo "<a href='?click=prev&page=$page'>Prev</a>";
    }
    if ($page < $totalPages - 1) {
      echo "<a href='?click=next&page=$page'>Next</a>";
    }
    echo '</div>';
  }
  ?>
</body>

</html>

<?php
$db->disconnect();
?>