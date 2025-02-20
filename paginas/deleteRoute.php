<?php
    include ('../basedados/basedados.h');
    
    if (!isset($_SESSION['email'])) {
        echo ('<script>alert("É necessário efetuar login");</script>');
        echo ('<script>window.location.href = "login.html";</script>');
        exit;
    } elseif ($_SESSION['admin'] == false) {
        echo ('<script>alert("Não tem acesso a esta página");</script>');
    }
    
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