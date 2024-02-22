<?php
    function store_file($name,$email){
        $fp = fopen(submit_file,"a+");
        if($fp){
            $input = date("Y-m-d H:i:s").",".$_SERVER['REMOTE_ADDR'].",". $_SERVER['HTTP_USER_AGENT'].","."$name,$email".PHP_EOL;
            if(fwrite($fp,$input)){
                fclose($fp);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function display_all_submits(){
        $lines = file(submit_file);
        foreach($lines as $line){
            $words= explode(",",$line);
            $i=0;
            foreach($words as $word){
                if($i==0){
                    echo "<h5>Visit Date : $word</h5>";
                } elseif($i == 1){
                    echo "<h5>IP Address : $word</h5>";
                } elseif($i == 2){
                    echo "<h5>Browser : $word</h5>";
                } elseif($i == 3){
                    echo "<h5>Name : $word</h5>";
                } elseif($i == 4){
                    echo "<h5>Email : $word</h5>";                    
                }
                $i++;
            }
            echo "<hr>";
        }
    }
?>