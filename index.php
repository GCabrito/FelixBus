<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FelixBus</title>
</head>
<body style="margin: 0; font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <header class="header" style="background:rgb(3, 99, 0); color: #fff; padding: 1rem 0; margin-top: -30px">
        <div class="container" style="width: 90%; margin: 0 auto; max-width: 1200px;">
            <h1 class="logo" style="font-size: 2rem; font-weight: bold;">FelixBus</h1>
            <nav class="nav">
                <ul style="list-style: none; padding: 0; display: flex; justify-content: flex-end; margin-top: -30px; margin-bottom: -5px">
                    <li style="margin-left: 20px; color: #fff; text-decoration: none; font-size: 1rem;">Home</li>
                    <li style="margin-left: 20px; color: #fff; text-decoration: none; font-size: 1rem;">Destinos</li>
                    <li style="margin-left: 20px; color: #fff; text-decoration: none; font-size: 1rem;">Sobre</li>
                    <li style="margin-left: 20px; color: #fff; text-decoration: none; font-size: 1rem;">Contato</></li>
                </ul>
            </nav>
        </div>
    </header>

    <section style="padding: 2rem 0;">
        <div class="container" style="width: 90%; max-width: 1200px; margin: 0 auto; text-align: center;">
            <h2 style="text-align: center; margin-bottom: 2rem; color: rgb(3, 99, 0); font-size: 2rem;">Para onde vamos?</h2>
            <div style="display: flex; justify-content: center; gap: 10px; flex-wrap: wrap;">
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <label for="partida" style="margin-bottom: 0.5rem; font-weight: bold;">Partida:</label>
                    <input type="text" id="partida" placeholder="Ex: Castelo Branco" style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; width: 250px;">
                </div>
                <div style="display: flex; flex-direction: column; align-items: center;">
                    <label for="chegada" style="margin-bottom: 0.5rem; font-weight: bold;">Chegada:</label>
                    <input type="text" id="chegada" placeholder="Ex: Covilhã" style="padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; width: 250px;">
                </div>
                <div style="display: flex; align-items: flex-end;">
                    <button style="padding: 0.8rem 1.5rem; background: rgb(3, 99, 0); color: #fff; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; transition: background-color 0.3s ease;">Pesquisar</button>
                </div>
            </div>
        </div>
    </section>

    <!-- colocar a partir da BD a info dos bilhetes, ajeitar o css para ocupar a largura toda -->
    <section class="destinations" style="padding: 2rem 0; background: #f4f4f4;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 2rem;">Viagens adicionadas recentemente</h2>
            <div class="cards" style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                <div class="card" style="background: #fff; border: 1px solid #ddd; border-radius: 5px; padding: 1rem; text-align: center; width: 300px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                    <h3 style="margin-bottom: 1rem;">Lisboa</h3>
                    <p>A partir de €10</p>
                    <a href="#" style="background:rgb(3, 99, 0); color: #fff; padding: 0.5rem 1rem; text-decoration: none; border-radius: 5px;">Comprar Bilhete</a>
                </div>
                <div class="card" style="background: #fff; border: 1px solid #ddd; border-radius: 5px; padding: 1rem; text-align: center; width: 300px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                    <h3 style="margin-bottom: 1rem;">Porto</h3>
                    <p>A partir de €15</p>
                    <a href="#" style="background:rgb(3, 99, 0); color: #fff; padding: 0.5rem 1rem; text-decoration: none; border-radius: 5px;">Comprar Bilhete</a>
                </div>
                <div class="card" style="background: #fff; border: 1px solid #ddd; border-radius: 5px; padding: 1rem; text-align: center; width: 300px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                    <h3 style="margin-bottom: 1rem;">Faro</h3>
                    <p>A partir de €20</p>
                    <a href="#" style="background:rgb(3, 99, 0); color: #fff; padding: 0.5rem 1rem; text-decoration: none; border-radius: 5px;">Comprar Bilhete</a>
                </div>
            </div>
        </div>
    </section>

    <section class="about" style="padding: 2rem 0;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 1rem;">Sobre Nós</h2>
            <p style="text-align: center; max-width: 800px; margin: 0 auto;">Somos uma plataforma dedicada a oferecer uma experiência simples e conveniente para a compra de bilhetes de autocarro. Nossa missão é conectar você aos seus destinos favoritos com o máximo conforto e economia.</p>
        </div>
    </section>

    <section class="contact" style="padding: 2rem 0; background: #f4f4f4;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 1remf;">Contatos</h2>
            <div style="text-align: center; max-width: 800px; margin: 0 auto;">
                <p>
                    Email: felixbus@gmail.com
                </p>
                <p>
                    Telefone: 272686563
                </p>
            </div>
        </div>
    </section>

    <footer class="footer" style="background:rgb(3, 99, 0); color: #fff; text-align: center; padding: 1rem 0;">
        <div class="container">
            <p style="margin: 0;">&copy; 2025 FelixBus. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
</html>
