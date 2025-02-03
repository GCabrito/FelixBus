<?php
    include ('../basedados/basedados.h');
    session_start();
    
    $origin = $_POST["origin"];
    $destination = $_POST["destination"];
    $startTime = $_POST["startTime"];
    $arriveTime = $_POST["arriveTime"];
    $price = $_POST["price"];
    $capacity = $_POST["capacity"];

    $sql = "INSERT INTO bilhete (Partida, Chegada, dataPartida, dataChegada, Preço, Capacidade)
            VALUES ('$origin', '$destination', '$startTime', '$arriveTime', '$price', '$capacity')";

    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows ($conn) == 1) {
        echo ('<script>window.location.href = "adminArea.php"</script>');
    }
        
    mysqli_close($conn);
?>