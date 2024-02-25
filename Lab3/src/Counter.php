<?php

// namespace App;

// class Counter {
//     private $countFilePath;

//     public function __construct($countFilePath) {
//         $this->countFilePath = $countFilePath;
//     }

//     public function getCount() {
//         if (file_exists($this->countFilePath)) {
//             $content = file_get_contents($this->countFilePath);
//             if (ctype_digit($content)) { 
//                 return (int) $content;
//             } else {
//                 return -1;
//             }
//         } else {
//             return 0;
//         }
//     }

//     public function incrementCount() {
//         $count = $this->getCount();
//         if($count == -1){
//             echo "Error: The content of the file is not a valid integer.";
//         } elseif($count == 0){
//             echo "File Not Exists";   
//         } else {
//             $count++;
//             file_put_contents($this->countFilePath, $count);
//         }

//     }
// }


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
