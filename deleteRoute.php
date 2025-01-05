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
    
    if (isset($_POST['idBilhete'])){
        $idBilhete = $_POST['idBilhete'];

        $sql = "DELETE FROM bilhete
            WHERE idBilhete = '$idBilhete'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows ($conn) == 1) {
            echo ('<script>window.location.href = "adminArea.php"</script>');
        }
    } 

    mysqli_close($conn);
?>