<?php
    session_start();

    $host = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'FelixBus';

    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if(! $conn ){
        die('Could not connect: ' . mysqli_error($conn));
    }
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
                                echo '<form action="profile.php" method=”GET”>
                                        <button> Saldo: '  .$rowSaldo['saldo']. '€</button>
                                    </form>';
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

    <main>
        <section>
            <div class="container">
                <div class="pesquisa">
                    <div class="cidades">
                        <label for="partida">Partida:</label>
                        <input type="text" id="partida" placeholder="Ex: Lisboa">
                    </div>
                    <div class="cidades">
                        <label for="chegada">Chegada:</label>
                        <input type="text" id="chegada" placeholder="Ex: Porto">
                    </div>
                    <div class="pesquisarBtn" style="display: flex; align-items: flex-end;">
                        <button>Pesquisar</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="ticket-list">
            <div class="container">
                <h2>Bilhetes Disponíveis</h2>
                <div class="tickets">
                    <div class="ticket">
                        <h3>Lisboa → Porto</h3>
                        <p><strong>Horário:</strong> 10:00 - 14:00</p>
                        <p><strong>Preço:</strong> €15</p>
                        <button class="buy-btn">Comprar Bilhete</button>
                    </div>
                    <div class="ticket">
                        <h3>Lisboa → Faro</h3>
                        <p><strong>Horário:</strong> 12:00 - 16:00</p>
                        <p><strong>Preço:</strong> €20</p>
                        <button class="buy-btn">Comprar Bilhete</button>
                    </div>
                    <!-- Mais bilhetes podem ser listados dinamicamente -->
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 FelixBus. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>