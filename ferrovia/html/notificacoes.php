<?php
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

if (isset($_SESSION['erro'])) {
    echo "<script>alert('" . $_SESSION['erro'] . " (Código: " . $_SESSION['erro_codigo'] . ")');</script>";
    unset($_SESSION['erro']);
    unset($_SESSION['erro_codigo']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/notificacoes.css">
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
                        <h1>Notificações</h1>
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
                <a class="menu-item" href="manutencao.php">Manutenção</a>
                <a class="menu-item" href="gestao.php">Gestão de rotas</a>
                <a class="menu-item" href="relatorios.php">Relatórios e Análises</a>
                <a class="menu-item" href="sensores.php">Sensores</a>
                <a class="menu-item" href="trem.php">Trem</a>
            </ul>
        </div>
    </header>

    <main>
        <section class="conteudo">
            <form id="notificacaoForm" action="cadastrar_notificacao.php" method="POST">
                <div class="form-group">
                    <label for="nome_notificacao">Nome:</label>
                    <input type="text" name="nome_notificacao" placeholder="Ex: Alerta de Interdição" required>
                </div>

                <div class="form-group">
                    <label for="localizacao_notificacao">Localização:</label>
                    <input type="text" name="localizacao_notificacao" placeholder="Ex: Estação 1" required>
                </div>

                <div class="form-group">
                    <label for="problema_notificacao">Problema:</label>
                    <textarea name="problema_notificacao" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="data_notificacao">Data:</label>
                    <input type="date" name="data_notificacao" required>
                </div>

                <div class="form-group">
                    <label for="hora_notificacao">Hora:</label>
                    <input type="time" name="hora_notificacao" required>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="botao-salvar">Salvar</button>
                    <button type="button" id="cancelBtn" class="botao-cancelar">Cancelar</button>
                </div>
            </form>

            <div id="cardsContainer">
            </div>

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
    <<script src="../js/notificacoes.js"></script>
</body>

</html>