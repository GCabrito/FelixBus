<?php
    include ('../basedados/basedados.h');
    include ('loginVerification.php');
    session_start();
    
    if (isset($_POST['idBilhete'])){
        $idBilhete = mysqli_real_escape_string($conn, $_POST['idBilhete']);
        
        $sql = "DELETE FROM bilhete
            WHERE idBilhete = '$idBilhete'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_affected_rows ($conn) == 1) {
            echo ('<script>window.location.href = "adminArea.php"</script>');
        }
    } 

    mysqli_close($conn);
?>