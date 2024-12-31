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
                    <li>Home</li>
                    <li>Perfil</li>
                    <li>Área de Gestão</li> <!--apenas para funcionarios e admins -->
                    <li>Área de Administração</li> <!--apenas para admins -->
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