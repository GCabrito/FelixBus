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
    
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $type = $_POST["type"];
    $money = $_POST["money"];
    $searchEmail = $_SESSION['searchUserEmail'];

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