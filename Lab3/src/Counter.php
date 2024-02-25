<?php

namespace App;


define("File_Path", "Counter.txt");

class Counter {
    private $countFilePath;

    public function __construct() {
        $this->countFilePath = File_Path;
    }

    public function getCount() {
        if (file_exists($this->countFilePath)) {
            return (int) file_get_contents($this->countFilePath);
        } else {
            return 0;
        }
    }

    public function incrementCount() {
        $count = $this->getCount();
        $count++;
        file_put_contents($this->countFilePath, $count);
    }
}

?>
