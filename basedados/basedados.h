<?php

    $host = 'localhost';
        $dbusername = 'root';
        $dbpassword = '';
        $dbname = 'FelixBus';

        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
        if(! $conn ){
            die('Could not connect: ' . mysqli_error($conn));
        }

?>