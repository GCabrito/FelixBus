<?php
    include ('../basedados/basedados.h');
    session_start();
    
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $money = mysqli_real_escape_string($conn, $_POST['money']);
    $searchEmail = mysqli_real_escape_string($conn, $_SESSION['searchUserEmail']);

    $sql = "UPDATE utilizador
            SET nome = '$name', pass = '$password', email = '$email', morada = '$address'
            WHERE email ='$searchEmail'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) >= 0){
        unset($_SESSION['searchUserEmail']);
        echo ('<script>window.location.href = "adminArea.php"</script>');
    }

    mysqli_close($conn);
?>