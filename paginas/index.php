<?php
    include ('../basedados/basedados.h');
    session_start();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FelixBus</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">FelixBus</h1>
            <nav class="nav">
                <ul>
                    <form action="index.php" method="GET">
                        <button>Home</button>
                    </form>
                
                    <?php 
                        if (isset($_SESSION['admin']) or isset($_SESSION['funcionario'])) {
                            echo'<form action="managementArea.php" method="GET">
                                    <button>Área de Gestão</button>
                                 </form>';
                        }                
                    
                        if (isset($_SESSION['admin'])) {
                            echo'<form action="adminArea.php" method="GET">
                                    <button>Área de Administração</button>
                                 </form>';
                        }
                        
                        if (isset($_SESSION["email"])) {
                            $sqlNome = "SELECT nome
                                        FROM utilizador
                                        WHERE email = '" .$_SESSION["email"]."'";

                            $resultNome = mysqli_query($conn, $sqlNome);

                            while ($rowNome = mysqli_fetch_assoc($resultNome)) {
                                echo '<form action="profile.php" method=”GET”>
                                        <button><strong>' .$rowNome['nome']. '</strong></button>
                                    </form>';
                            }

                            $sqlSaldo = "SELECT saldo
                                        FROM utilizador
                                        WHERE email = '" .$_SESSION["email"]."'";
                                        
                            $resultSaldo = mysqli_query($conn, $sqlSaldo);

                            while ($rowSaldo = mysqli_fetch_assoc($resultSaldo)) {
                                echo '<button> Saldo: '  .$rowSaldo['saldo']. '€</button>';
                            }

                            echo '<form action="logout.php" method=”GET”>
                                    <button> Terminar Sessão</button>
                                </form>';
                        } else {
                            echo '<form action="login.html" method=”GET”>
                                    <button> Iniciar Sessão </button>
                                </form>';
                        }
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <section>
        <div class="container">
            <h2>Para onde vamos?</h2>
            <form action="searchRoute.php" method="POST">
                <div class="pesquisa">
                    <div class="cidades">
                        <label for="partida">Partida:</label>
                        <input type="text" id="partida" name="start" placeholder="Ex: Lisboa">
                    </div>
                    <div class="cidades">
                        <label for="chegada">Chegada:</label>
                        <input type="text" id="chegada" name="end" placeholder="Ex: Porto">
                    </div>
                    
                    <div class="pesquisarBtn" style="display: flex; align-items: flex-end;">
                            <button>Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>


    <section class="destinations">
        <div class="container">
            <h2>Viagens adicionadas recentemente</h2>
            <div class="cards">
                <?php
                    $sqlRecentRoutes = 'SELECT *
                                        FROM bilhete
                                        ORDER BY idBilhete desc
                                        LIMIT 5';

                    $resultRecentRoutes = mysqli_query($conn, $sqlRecentRoutes);

                    while ($row = mysqli_fetch_array($resultRecentRoutes)) {
                        echo '<div class="card">
                                <h3>'.$row['Partida'].' - '.$row['Chegada'].'</h3>
                                <p>'.$row['dataPartida'].'</p>
                                <p>'.$row['Preço'].'€</p>
                                <form action="buyTicket.php" method="POST">
                                    <input type="hidden" name="idBilhete" value="' . $row['idBilhete'] . '">
                                    <input type="hidden" name="preco" value="' . $row['Preço'] . '">
                                    <input type="hidden" name="partida" value="' . $row['Partida'] . '">
                                    <input type="hidden" name="chegada" value="' . $row['Chegada'] . '">
                                    <button type="submit" class="buy-btn">Comprar Bilhete</button>
                                </form>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <section class="about">
        <div class="container">
            <h2>Sobre Nós</h2>
            <p>Somos uma plataforma dedicada a oferecer uma experiência simples e conveniente para a compra de bilhetes de autocarro. Nossa missão é conectar você aos seus destinos favoritos com o máximo conforto e economia.</p>
        </div>
    </section>

    <section class="contact">
        <div class="container">
            <h2>Contatos</h2>
            <p>Email: felixbus@gmail.com</p>
            <p>Telefone: 272686563</p>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 FelixBus. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>

<?php
    mysqli_close($conn);
?>