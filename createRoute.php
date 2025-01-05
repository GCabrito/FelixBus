<?php
    session_start();

    //ligar à base de dados
    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'FelixBus';

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(! $conn ){
        die('Could not connect: ' . mysqli_error($conn));
    }
    
    $origin = $_POST["origin"];
    $destination = $_POST["destination"];
    $startTime = $_POST["startTime"];
    $arriveTime = $_POST["arriveTime"];
    $price = $_POST["price"];

    $sql = "INSERT INTO bilhete (Partida, Chegada, dataPartida, dataChegada, Preço)
            VALUES ('$origin', '$destination', '$startTime', '$arriveTime', '$price')";

    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows ($conn) == 1) {
        echo ('<script>window.location.href = "adminArea.php"</script>');
    }
        
    mysqli_close($conn);
?>