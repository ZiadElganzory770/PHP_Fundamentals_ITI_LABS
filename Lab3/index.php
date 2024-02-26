<?php

require_once 'vendor/autoload.php';

use App\Counter;
use App\Visitor;

session_start();

$countFilePath = "Counter.txt";
$counter = new Counter($countFilePath);

if (!Visitor::isCounted()) {
    $counter->incrementCount();
}

echo "Unique visits: " . $counter->getCount();

?>
