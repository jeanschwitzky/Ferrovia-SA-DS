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
    <link rel="stylesheet" href="../css/sensores.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Ferrovia - Sensores</title>
</head>

<body>
    <header>
        <div id="cabecalho">
            <nav>
                <ul id="menu">
                    <a class="bi bi-list" id="menuToggle"></a>
                    <div id="titulo">
                    <h1>Gerenciamento de Sensores</h1>
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
            <form id="sensorForm">
                <div class="form-group">
                    <label for="tipoSensor">Tipo de Sensor:</label>
                    <select id="tipoSensor" required>
                        <option value="Temperatura">Temperatura</option>
                        <option value="Pressão">Pressão</option>
                        <option value="Umidade">Umidade</option>
                        <option value="Vibração">Vibração</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="localizacaoSensor">Localização:</label>
                    <input type="text" id="localizacaoSensor" placeholder="Ex: Estação 1" required>
                </div>

                <div class="form-group">
                    <label for="statusSensor">Status:</label>
                    <select id="statusSensor" required>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                        <option value="Manutenção">Manutenção</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="dataInstalacao">Data de Instalação:</label>
                    <input type="date" id="dataInstalacao" required>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="botao-salvar">Salvar</button>
                    <button type="button" id="cancelBtn" class="botao-cancelar">Cancelar</button>
                </div>
            </form>

            <div id="cardsContainer"></div>

            <div class="flexivel">
                <button id="addBtn" class="botao-adicionar">
                    <i class="bi bi-plus-circle" style="font-size: 30px;"></i> Adicionar Sensor
                </button>
                <button id="removeAllBtn" class="botao-remover">
                    <i class="bi bi-trash" style="font-size: 30px;"></i> Remover Todos
                </button>
            </div>
        </section>
    </main>
    <script src="../js/sensores.js"></script>
</body>

</html>