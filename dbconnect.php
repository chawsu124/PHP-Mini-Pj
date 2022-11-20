<?php
    $server = 'localhost';
    $name = 'root';
    $pass = '';
    $dbname = 'login_registration_system';

    $db = mysqli_connect($server,$name,$pass,$dbname);

    // if($db){
    //     echo "Database connect successfully";
    // }else{
    //     die("Connect Error" . mysqli_connect_error($db));
    // }

    if(!$db){
        die("Connect Error" . mysqli_connect_error($db));
    }
?>