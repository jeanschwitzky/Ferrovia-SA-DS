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
    <link rel="stylesheet" href="../css/gerenciamento_trens.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Ferrovia - Trens</title>
</head>

<body>
    <header>
        <div id="cabecalho">
            <nav>
                <ul id="menu">
                    <a class="bi bi-list" id="menuToggle"></a>
                    <div id="titulo">
                        <h1>Gerenciamento de Trens</h1>
                    </div>
                    <div class="bem-vindo">
                        <a class="bi bi-person-circle" href="perfil.php" title="Perfil"></a>
                        <?php
                        echo "<span>Bem-vindo, " . htmlspecialchars($_SESSION["nome_usuario"]) . "!</span>";
                        ?>
                        <a href="sair.php">
                            <button class="sair-button">Sair</button>
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
            <form id="tremForm" style="display:none;"  action="cadastrar_trem.php" method="POST">
                <div class="form-group">
                    <label for="nome_trem">Nome do Trem:</label>
                    <input type="text" name="nome_trem" placeholder="Ex: Expresso Sul" required>
                </div>
                <div class="form-group">
                    <label for="data_operacao">Data de Operação:</label>
                    <input type="date" name="data_operacao" required>
                </div>
                <div class="form-group">
                    <label for="capacidade_trem">Capacidade de Passageiros:</label>
                    <input type="number" name="capacidade_trem"  placeholder="Ex: 600">
                </div>
                <div class="form-group">
                    <label for="velocidade_trem">Velocidade Máxima (km/h):</label>
                    <input type="number" name="velocidade_trem"  placeholder="Ex: 300">
                </div>
                <div class="form-group">
                    <label for="fabricante_trem">Fabricante / Modelo:</label>
                    <input type="text" name="fabricante_trem" placeholder="Ex: Siemens Velaro">
                </div>
                <div class="form-group">
                    <label for="observacoes_trem">Observações:</label>
                    <textarea name="observacoes_trem" 
                        placeholder="Informações adicionais..."></textarea>
                </div>

                <div class="form-buttons">
                    <button type="submit" class="botao-salvar">Salvar</button>
                    <button type="button" id="cancelBtn" class="botao-cancelar">Cancelar</button>
                </div>
            </form>
            <div id="cardsContainer"></div>
            <div class="flexivel">
                <button id="addBtn" class="botao-adicionar">
                    <i class="bi bi-plus-circle" style="font-size: 30px;"></i> Adicionar Trem
                </button>
                <button id="removeAllBtn" class="botao-remover">
                    <i class="bi bi-trash" style="font-size: 30px;"></i> Remover Todos
                </button>
            </div>
        </section>
    </main>
    <script src="../js/trem.js"></script>
</body>

</html>