<?php
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/gestao.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Ferrovia</title>
</head>

<body>
    <header>
        <div id="cabecalho">
            <nav>
                <ul id="menu">
                    <a class="bi bi-list" id="menuToggle"></a>
                    <div id="titulo">
                    <h1>Gestão de Rotas</h1>
                    </div>
                     <div class="bem-vindo">
                        <a class="bi bi-person-circle" href="perfil.php"></a>
                        <?php
                        echo "<p>Bem-vindo, " . htmlspecialchars($_SESSION["nome_usuario"]) . "!</p>";

                        ?>
                        <a href="sair.php">
                            <input type="button" value="Sair" event="sair.php" class="sair-button">
                        </a>
                    </div>

                </ul>
            </nav>
        </div>
        <div id="side-menu">
            <ul class="menu-list">
                <a class="menu-item" href="perfil.php">Perfil</a>
                <a class="menu-item" href="dashboard.php">Dashboard Geral</a>
                <a class="menu-item" href="notificacoes.php">Notificações</a>
                <a class="menu-item" href="manuntencao.php">Manutenção</a>
                <a class="menu-item" href="gestao.php">Gestão de rotas</a>
                <a class="menu-item" href="relatorios.php">Relatórios e Análises</a>
                <a class="menu-item" href="usuarios.php">Gerenciamento de Usuários</a>
                <a class="menu-item" href="sensores.php">Sensores</a>
            </ul>
        </div>
    </header>

    <main>
        <section class="conteudo">
            <section class="conteudo">
                <div class="card">
                    <h2>Rotas</h2>
                <div class="mapa-frame">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14305.21780163144!2d-48.847432713382446!3d-26.31663938178757!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94deb17917615d17%3A0xc4ff5570e603a778!2zU2VkZSBkYSBFc3Rhw6fDo28gZGEgTWVtw7NyaWEg8J-agg!5e0!3m2!1spt-BR!2sbr!4v1748962422860!5m2!1spt-BR!2sbr"
                        width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                </div>
                <form id="notificacaoForm" action="cadastrarRota.php" method="POST">
                    <div class="form-group">
                        <label for="tipoNotificacao">Nome da Rota:</label>
                        <input type="text" id="tipoNotificacao" placeholder="Ex: Linha Sul - Rota A1" required>
                    </div>

                    <div class="form-group">
                        <label for="tremNotificacao">Status:</label>
                        <select id="tremNotificacao" required>
                            <option value="Em Andamento">Em Andamento</option>
                            <option value="Não Iniciada">Não Iniciada</option>
                            <option value="Concluída">Em atraso</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="localizacaoNotificacao">Local de Partida:</label>
                        <input type="text" id="localizacaoNotificacao" placeholder="Ex: Joinville" required>
                    </div>

                    <div class="form-group">
                        <label for="problemaNotificacao">Local de Chegada:</label>
                        <input type="text" id="problemaNotificacao" placeholder="Ex: Curitiba" required></input>
                    </div>

                    <div class="form-group">
                        <label for="dataNotificacao">Data:</label>
                        <input type="date" id="dataNotificacao" required>
                    </div>

                    <div class="form-group">
                        <label for="horaNotificacao">Horário Chegada:</label>
                        <input type="time" id="horaNotificacao" required>
                    </div>

                    <div class="form-buttons">
                        <button type="submit" class="botao-salvar">Salvar</button>
                        <button type="button" id="cancelBtn" class="botao-cancelar">Cancelar</button>
                    </div>
                </form>
                <div id="cardsContainer"></div>

                <div class="flexivel">
                    <button id="addBtn" class="botao-adicionar">
                        <i class="bi bi-plus-circle" style="font-size: 30px;"></i> Adicionar
                    </button>
                    <button id="removeAllBtn" class="botao-remover">
                        <i class="bi bi-trash" style="font-size: 30px;"></i> Remover Todas
                    </button>
                </div>
            </section>
    </main>
    <script src="../js/gestao.js"></script>
</body>

</html>