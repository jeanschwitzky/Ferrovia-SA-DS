
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
    <!-- Verifique se este caminho está correto -->
    <link rel="stylesheet" href="../css/gestao.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Ferrovia - Gestão de Rotas</title>
</head>

<body>
    <header>
        <!-- CABEÇALHO COM FLEXBOX: Estrutura idêntica à de manutenção para consistência -->
        <div class="main-nav">
            <!-- LADO ESQUERDO: Ícone do Menu -->
            <div class="nav-left">
                <a href="#" id="menuToggle" class="bi bi-list"></a>
            </div>

            <!-- CENTRO: Título Principal -->
            <div class="nav-center">
                <h1>Gestão de Rotas</h1>
            </div>

            <!-- LADO DIREITO: Boas-vindas, Perfil e Sair -->
            <div class="nav-right">
                <?php
                echo "<p>Bem-vindo, " . htmlspecialchars($_SESSION["nome_usuario"]) . "!</p>";
                ?>
                <!-- Ícone de Perfil -->
                <a class="bi bi-person-circle" href="perfil.php"></a>
                <!-- Botão Sair -->
                <a href="sair.php" class="sair-button">Sair</a>
            </div>
        </div>

        <!-- MENU LATERAL (Side Menu) -->
        <div id="side-menu">
        <ul class="menu-list">
            <a class="menu-item" href="perfil.php">Perfil</a>
            <a class="menu-item" href="dashboard.php">Dashboard Geral</a>
            <a class="menu-item" href="notificacoes.php">Notificações</a>
            <a class="menu-item" href="manutencao.php">Manutenção</a>
            <a class="menu-item" href="gestao.php">Gestão de Rotas</a>
            <a class="menu-item" href="relatorios.php">Relatórios e Análises</a>
            <a class="menu-item" href="sensores.php">Sensores</a>
            <a class="menu-item" href="trem.php">Trem</a>
        </ul>
    </div>
    </header>

    <main>
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
            
            <form id="notificacaoForm" action="cadastrar_rota.php" method="POST">
                <div class="form-group">
                    <label for="nome_rota">Nome da Rota:</label>
                    <input type="text" name="nome_rota" placeholder="Ex: Linha Sul - Rota A1" required>
                </div>

                <div class="form-group">
                    <label for="status_rota">Status:</label>
                    <select name="status_rota" required>
                        <option value="Em Andamento">Em Andamento</option>
                        <option value="Não Iniciada">Não Iniciada</option>
                        <option value="Em atraso">Em atraso</option>
                        <option value="Concluída">Concluída</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="partida_rota">Local de Partida:</label>
                    <input type="text" name="partida_rota" placeholder="Ex: Joinville" required>
                </div>

                <div class="form-group">
                    <label for="chegada_rota">Local de Chegada:</label>
                    <input type="text" name="chegada_rota" placeholder="Ex: Curitiba" required>
                </div>

                <div class="form-group">
                    <label for="data_rota">Data:</label>
                    <input type="date" name="data_rota" required>
                </div>

                <div class="form-group">
                    <label for="hora_rota">Horário Chegada:</label>
                    <input type="time" name="hora_rota" required>
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
                    <i class="bi bi-plus-circle"></i> Adicionar
                </button>
                <button id="removeAllBtn" class="botao-remover">
                    <i class="bi bi-trash"></i> Remover Todas
                </button>
            </div>
        </section>
    </main>
    <script src="../js/gestao.js"></script>
</body>

</html>