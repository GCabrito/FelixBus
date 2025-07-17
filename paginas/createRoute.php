<?php
    session_start();
    include ('../basedados/basedados.h');
    
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    } elseif ($_SESSION['admin'] == false) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }

    session_start();
    
    $origin = mysqli_real_escape_string($conn, $_POST["origin"]) ;
    $destination = mysqli_real_escape_string($conn, $_POST["destination"]);
    $startTime = mysqli_real_escape_string($conn, $_POST["startTime"]);
    $arriveTime = mysqli_real_escape_string($conn, $_POST["arriveTime"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $capacity = mysqli_real_escape_string($conn, $_POST["capacity"]);

    $sql = "INSERT INTO bilhete (Partida, Chegada, dataPartida, dataChegada, Preço, Capacidade)
            VALUES ('$origin', '$destination', '$startTime', '$arriveTime', '$price', '$capacity')";

    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows ($conn) == 1) {
        echo ('<script>window.location.href = "adminArea.php"</script>');
    }
        
    mysqli_close($conn);
?>