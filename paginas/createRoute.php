<?php
    session_start(); // Inicia a sessão do utilizador
    include ('../basedados/basedados.h'); // Inclui a ligação à base de dados
    
    // Verifica se o utilizador está autenticado
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    // Verifica se o utilizador tem permissões de admin
    } elseif ($_SESSION['admin'] == false) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
        echo ('<script>window.location.href = "index.php";</script>');
    }
    
    // Escapa os valores recebidos do formulário para evitar SQL Injection
    $origin = mysqli_real_escape_string($conn, $_POST["origin"]) ;
    $destination = mysqli_real_escape_string($conn, $_POST["destination"]);
    $startTime = mysqli_real_escape_string($conn, $_POST["startTime"]);
    $arriveTime = mysqli_real_escape_string($conn, $_POST["arriveTime"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    $capacity = mysqli_real_escape_string($conn, $_POST["capacity"]);

    // Insere a nova rota na base de dados
    $sql = "INSERT INTO bilhete (Partida, Chegada, dataPartida, dataChegada, Preço, Capacidade)
            VALUES ('$origin', '$destination', '$startTime', '$arriveTime', '$price', '$capacity')";

    $result = mysqli_query($conn, $sql);

    // Verifica se a rota foi criada com sucesso
    if (mysqli_affected_rows ($conn) == 1) {
        echo ('<script>window.location.href = "adminArea.php"</script>');
    }
        
    mysqli_close($conn); // Fecha a ligação à base de dados
?>