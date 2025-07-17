<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados

    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $start = mysqli_real_escape_string($conn, $_POST['start']);
    $end = mysqli_real_escape_string($conn, $_POST['end']);

    // Limpa variáveis de sessão anteriores de pesquisa de rotas
    unset($_SESSION['searchRouteStart']);
    unset($_SESSION['searchRouteEnd']);

    // Pesquisa por partida e chegada
    if (!empty($start) && !empty($end)) {
        $sql = "SELECT idBilhete, Partida, Chegada, dataPartida, dataChegada, Preço
                FROM bilhete
                WHERE Partida = '$start' AND Chegada = '$end'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Se encontrou rotas, guarda na sessão e redireciona
            while($row = mysqli_fetch_array($result)){
                $_SESSION['searchRouteStart'] = $row['Partida'];
                $_SESSION['searchRouteEnd'] = $row['Chegada'];
            }
            echo '<script>window.location.href = "viewRoutes.php";</script>';
        } else {
            // Se não encontrou, limpa sessão e mostra alerta
            unset($_SESSION['searchRouteStart']);
            unset($_SESSION['searchRouteEnd']);
            echo '<script>alert("Não foi encontrada nenhuma rota.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        }
    } 
    // Pesquisa apenas por partida
    elseif (!empty($start)) {
        $sql = "SELECT idBilhete, Partida, Chegada, dataPartida, dataChegada, Preço
                FROM bilhete
                WHERE Partida = '$start'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Se encontrou rotas, guarda na sessão e redireciona
            while($row = mysqli_fetch_array($result)){
                $_SESSION['searchRouteStart'] = $row['Partida'];
            }
            echo '<script>window.location.href = "viewRoutes.php";</script>';
        } else {
            // Se não encontrou, limpa sessão e mostra alerta
            unset($_SESSION['searchRouteStart']);
            echo '<script>alert("Não foi encontrada nenhuma rota.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        }

    } 
    // Pesquisa apenas por chegada
    elseif (!empty($end)) {
        $sql = "SELECT idBilhete, Partida, Chegada, dataPartida, dataChegada, Preço
                FROM bilhete
                WHERE Chegada = '$end'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // Se encontrou rotas, guarda na sessão e redireciona
            while($row = mysqli_fetch_array($result)){
                $_SESSION['searchRouteEnd'] = $row['Chegada'];
            }
            echo '<script>window.location.href = "viewRoutes.php";</script>';
        } else {
            // Se não encontrou, limpa sessão e mostra alerta
            unset($_SESSION['searchRouteEnd']);
            echo '<script>alert("Não foi encontrada nenhuma rota.");</script>';
            echo '<script>window.location.href = "index.php";</script>';
        }
    }

    mysqli_close($conn); // Fecha a ligação à base de dados
?>
