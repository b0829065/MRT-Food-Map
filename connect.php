<?php
    function sql($instr){
        $connect = new mysqli( "localhost", "root", "0000", "foodmap");
        $connect->query("SET NAMES 'utf8'");
        if ($connect->connect_error) {
            die("連線失敗: " . $connect->connect_error);
        }
        $result = $connect->query($instr);
        return $result;
    }
?>