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
    
    $userEmail = $_POST["userEmail"];

    $sql = "SELECT u.nome, u.email, u.pass, u.morada, t.Nome, u.estado, u.saldo
            FROM utilizador u join tipoutilizador t
            ON u.tipoUtilizador = t.idTipoUtilizador
            WHERE email = '$userEmail'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_affected_rows ($conn) == 1) {
        while($row = mysqli_fetch_array($result)){
            $_SESSION['searchUserName'] = $row['nome'];
            $_SESSION['searchUserEmail'] = $row['email'];
            $_SESSION['searchUserPassword'] = $row['pass'];
            $_SESSION['searchUserAdress'] = $row['morada'];
            $_SESSION['searchUserType'] = $row['Nome'];
            $_SESSION['searchUserState'] = $row['estado'];
            $_SESSION['searchUserMoney'] = $row['saldo'];
        }
        echo ('<script>window.location.href = "adminArea.php"</script>');
    }
        
    mysqli_close($conn);
?>