<?php
    include ('../basedados/basedados.h');
    session_start();

    $start = $_POST['start'];
    $end = $_POST['end'];

    if (!empty($start) && !empty($end)) {
        $sql = "SELECT idBilhete, Partida, Chegada, dataPartida, dataChegada, Preço
                FROM bilhete
                WHERE Partida = '$start' AND Chegada = '$end'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $_SESSION['searchRouteStart'] = $row['Partida'];
                $_SESSION['searchRouteEnd'] = $row['Chegada'];
            }
            echo '<script>window.location.href = "viewRoutes.php";</script>';
        } else {
            unset($_SESSION['searchRouteStart']);
            unset($_SESSION['searchRouteEnd']);
            echo '<script>alert("Não foi encontrada nenhuma rota.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        }
    } elseif (!empty($start) && empty($end)) {
        $sql = "SELECT idBilhete, Partida, Chegada, dataPartida, dataChegada, Preço
                FROM bilhete
                WHERE Partida = '$start'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $_SESSION['searchRouteStart'] = $row['Partida'];
            }
            echo '<script>window.location.href = "viewRoutes.php";</script>';
        } else {
            unset($_SESSION['searchRouteStart']);
            echo '<script>alert("Não foi encontrada nenhuma rota.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        }

    } elseif (!empty($end) && empty($start)) {
        $sql = "SELECT idBilhete, Partida, Chegada, dataPartida, dataChegada, Preço
                FROM bilhete
                WHERE Chegada = '$end'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_array($result)){
                $_SESSION['searchRouteEnd'] = $row['Chegada'];
            }
            echo '<script>window.location.href = "viewRoutes.php";</script>';
        } else {
            unset($_SESSION['searchRouteEnd']);
            echo '<script>alert("Não foi encontrada nenhuma rota.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        }
    }

    mysqli_close($conn);
?>
