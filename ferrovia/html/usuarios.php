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
                    <h1>Gerenciamento de Usuários</h1>
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
            <form id="notificacaoForm">
                <div class="form-group">
                    <label for="tremNotificacao">Nome:</label>
                    <input type="text" id="tremNotificacao" placeholder="Ex: João Silva" required>
                </div>
                <div class="form-group">
                    <label for="tipoNotificacao">Função:</label>
                    <select id="tipoNotificacao" required>
                        <option value="Adiministardor">Adiministardor</option>
                        <option value="Especialista em Manutenção">Especialista em Manutenção</option>
                        <option value="Gestor de Rotas">Gestor de Rotas</option>
                        <option value="Analista">Analista</option>
                        <option value="Operador de Trem">Operador de Trem</option>
                        <option value="Outro">Outro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="problemaNotificacao">Código:</label>
                    <input type="text" id="problemaNotificacao" placeholder="Ex: 01" required>
                </div>

                <div class="form-group">
                    <label for="localizacaoNotificacao">Email:</label>
                    <input type="email" id="localizacaoNotificacao" placeholder="Ex: joao_silva@gmail.com" required>
                </div>

                <div class="form-group">
                    <label for="telefoneUsuario">Telefone:</label>
                    <input type="text" id="telefoneUsuario" placeholder="Ex: 47 91122-3344" required>
                </div>

                <div class="form-group">
                    <label for="enderecoUsuario">Endereço:</label>
                    <input type="text" id="enderecoUsuario" placeholder="Ex: Rua Urusanga, 111" required>
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
    <script src="../js/usuarios.js"></script>
</body>

</html>