<?php
    $dbhost = "localhost";
    $dbname = "bd_projeto";
    $dbusername = "jhonny";
    $dbpassword = "astronauta21";
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function new_id(){
        Global $conn;
        $row = $conn->query("SELECT id_image FROM image ORDER BY id_image DESC LIMIT 1" )->fetch();
        return $row['id_image']+1;
    }
