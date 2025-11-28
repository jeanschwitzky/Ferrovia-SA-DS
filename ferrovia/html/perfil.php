<?php
session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
    header("Location: login.php");
    exit;
}

$data = $_SESSION["data_nascimento_usuario"];
if (strpos($data, "/") !== false) {
    $partes = explode("/", $data);
    $data = $partes[2] . "-" . $partes[1] . "-" . $partes[0];
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/perfil.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Perfil - Ferrovia</title>
</head>

<body>
    <header>
        <div class="main-nav">
            <div class="nav-left">
                <a class="bi bi-list" id="menuToggle"></a>
            </div>

            <div class="nav-center">
                <h1>Perfil</h1>
            </div>

            <div class="nav-right">
                <a class="bi bi-person-circle" href="perfil.php"></a>
                <?php
                // Mantido para contexto, mas remova se quiser 100% igual ao Notificações
                echo "<p>" . htmlspecialchars($_SESSION["nome_usuario"]) . "</p>";
                ?>
                <a href="sair.php" class="sair-link">
                    <button class="sair-button">Sair</button>
                </a>
            </div>
        </div>
        
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
            <form action="editar_perfil.php" method="POST"
                onsubmit="return confirm('Deseja realmente salvar as alterações?')">

                <input type="hidden" name="pk_usuario" value="<?php echo $_SESSION["usuario_id"]; ?>">

                <div class="card2"> <div class="card-title">Dados do Perfil</div>

                    <div class="linha-campo form-group">
                        <i class="bi bi-person-circle"></i>
                        <input type="text" id="nome_usuario" name="nome_usuario" required placeholder="Nome completo"
                            value="<?php echo htmlspecialchars($_SESSION["nome_usuario"]); ?>" />
                    </div>

                    <div class="linha-campo form-group">
                        <i class="bi bi-envelope-fill"></i>
                        <input type="email" id="email_usuario" name="email_usuario" required placeholder="Email"
                            value="<?php echo htmlspecialchars($_SESSION["email_usuario"]); ?>" />
                    </div>

                    <div class="linha-campo form-group">
                        <i class="bi bi-lock-fill"></i>
                        <input type="password" id="senha_usuario" name="senha_usuario" required placeholder="Senha"
                            value="senha_usuario" />
                    </div>


                    <div class="linha-campo form-group">
                        <i class="bi bi-calendar-check-fill"></i>
                        <input type="date" id="data_nascimento_usuario" name="data_nascimento_usuario" required
                            value="<?php echo htmlspecialchars($data); ?>" />
                    </div>

                    <div class="linha-campo form-group">
                        <i class="bi bi-gender-ambiguous"></i>
                        <input type="text" id="genero_usuario" name="genero_usuario" required placeholder="Gênero"
                            value="<?php echo htmlspecialchars($_SESSION["genero_usuario"]); ?>" />
                    </div>

                    <div class="linha-campo form-group">
                        <i class="bi bi-person-vcard-fill"></i>
                        <input type="text" id="cpf_usuario" name="cpf_usuario" required placeholder="CPF" minlength="11"
                            maxlength="11" value="<?php echo htmlspecialchars($_SESSION["cpf_usuario"]); ?>" />
                    </div>

                    <div class="linha-campo form-group">
                        <i class="bi bi-geo-alt-fill"></i>
                        <input type="text" id="endereco_usuario" name="endereco_usuario" required placeholder="Endereço"
                            value="<?php echo htmlspecialchars($_SESSION["endereco_usuario"]); ?>" />
                    </div>
                
                    <div class="form-buttons">
                        <button type="submit" class="botao-salvar">Salvar</button>
                        <a href="dashboard.php" style="flex: 1; text-decoration: none;">
                            <button type="button" class="botao-cancelar">Cancelar</button>
                        </a>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <script src="../js/perfil.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body>

</html>