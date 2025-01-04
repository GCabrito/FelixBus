<?php
session_start();


$_SESSION['tipoUtilizador'] = "funcionario"; //variavel pra testar


function podeAcessarAreaDeGestao() {
    
    $permissoes = ['admin', 'funcionario'];

    
    return isset($_SESSION['tipoUtilizador']) && in_array($_SESSION['tipoUtilizador'], $permissoes);
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
                    
                    <form action="profile.php" method=”GET”>
                    <button> Perfil </button>
                     </form>
                    
                     
                     <?php if (podeAcessarAreaDeGestao()): ?>
        
        <form action="managementArea.php" method="GET">  <!-- apenas para funcionários e admins -->
            <button>Área de Gestão</button>
        </form>
    <?php endif; ?>
                   
                     <?php 
                     if ($_SESSION ['admin'] = true)
                     echo'<form action="adminArea.php" method="GET">
                          <button>Área de Administração</button>
                          </form>';
                    ?>
                </ul>
            </nav>
        </div>
    </header>

    <section>
        <div class="container">
            <h2>Para onde vamos?</h2>
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
                     <form action="viewRoutes.php" method=”GET”>
                        <button>Pesquisar</button>
                    </form>
                </div>

            </div>
        </div>
    </section>


    <section class="destinations">
        <div class="container">
            <h2>Viagens adicionadas recentemente</h2>
            <div class="cards">
                <div class="card">
                    <h3>Lisboa</h3>
                    <p>A partir de €10</p>
                    <a href="#">Comprar Bilhete</a>
                </div>
                <div class="card">
                    <h3>Porto</h3>
                    <p>A partir de €15</p>
                    <a href="#">Comprar Bilhete</a>
                </div>
                <div class="card">
                    <h3>Faro</h3>
                    <p>A partir de €20</p>
                    <a href="#">Comprar Bilhete</a>
                </div>
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
