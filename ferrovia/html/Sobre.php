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
    <title>Ferrovia - Sobre</title>
    <link rel="stylesheet" href="../css/Sobre.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="main-nav">
        <div class="nav-left">
            <i class="bi bi-list" id="menuToggle"></i>
        </div>
        <div class="nav-center">
            <h1>Sobre</h1>
        </div>
        <div class="nav-right">
            <a class="bi bi-person-circle" href="perfil.php"></a>
            <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION["nome_usuario"]); ?>!</p>
            <a href="sair.php"><button class="sair-button">Sair</button></a>
        </div>
    </header>

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
            <a class="menu-item" href="Sobre.php">Sobre</a>
        </ul>
    </div>

    <main>
        <section class="about-hero about-hero-split">
            <div class="about-hero-inner">
                <div class="hero-text">
                    <h2>Bem-vindo a Linfer</h2>
                    <p class="lead">A solução inteligente para o gerenciamento moderno de ferrovias. Integramos tecnologia de ponta com monitoramento em tempo real para aumentar eficiência, segurança e controle operacional.</p>
                    <a href="#contato" class="cta-button">Fale conosco</a>
                </div>
                <div class="hero-image">
                    <img src="imagem.trem\trem.png" alt="Trem moderno nos trilhos" />
                </div>
            </div>
        </section>

        <section class="about-section container">
            <h3>Visão Geral</h3>
            <p>
                Nosso sistema integra tecnologia de ponta com monitoramento em tempo real, oferecendo eficiência,
                segurança e controle total sobre as operações ferroviárias.
            </p>

            <h3>Nosso Aplicativo</h3>
            <p>
                O aplicativo Linfer é a interface central do nosso sistema. Através dele, gestores e operadores têm
                acesso instantâneo a informações e ferramentas que facilitam a operação diária.
            </p>

            <ul class="features-list features-grid">
                <li class="feature-item"><i class="bi bi-geo-alt feature-icon"></i><strong>Localização</strong><span>Localização em tempo real de todos os trens.</span></li>
                <li class="feature-item"><i class="bi bi-thermometer-half feature-icon"></i><strong>Sensores</strong><span>Medições de temperatura e umidade de composições e trilhos.</span></li>
                <li class="feature-item"><i class="bi bi-bell feature-icon"></i><strong>Alertas</strong><span>Notificações automáticas sobre condições operacionais.</span></li>
                <li class="feature-item"><i class="bi bi-bar-chart feature-icon"></i><strong>Relatórios</strong><span>Relatórios e análises para otimizar rotas e reduzir custos.</span></li>
            </ul>

            <h3>Nossa Tecnologia</h3>
            <p>
                Cada trem e trecho monitorado está equipado com sensores IoT que enviam dados constantemente para nossa
                plataforma na nuvem. Esses dados são processados por pipelines analíticos e apresentados no aplicativo em tempo real.
            </p>

            <h3>Nosso Propósito</h3>
            <p>
                Queremos tornar o transporte ferroviário mais inteligente, sustentável e seguro, promovendo um futuro
                em que a tecnologia impulsione a eficiência operacional e a preservação ambiental.
            </p>
        </section>

<section class="team-section container">
    <h3>Conheça a Equipe</h3>
    <div class="team-grid">

        <div class="team-member">
            <i class="bi bi-person-circle team-icon"></i>
            <h4>Arthur Ferreira Wiest</h4>
            <p>Test Designer, Testador, Gerente do Banco de  Dados, Administrador do  Banco de Dados</p>
        </div>

        <div class="team-member">
            <i class="bi bi-person-circle team-icon"></i>
            <h4>Carlos Augusto Narloch</h4>
            <p>Testador, Designer</p>
        </div>

        <div class="team-member">
            <i class="bi bi-person-circle team-icon"></i>
            <h4>Jean Carlos Schwitzky</h4>
            <p>Gerente de Teste, Gerente do Projeto de  Teste, Administrador do Sistema de Teste, Implementador</p>
        </div>

        <div class="team-member">
            <i class="bi bi-person-circle team-icon"></i>
            <h4>Laura Carolina Reeck</h4>
            <p>Administrador do Sistema de Teste, Implementadora</p>
        </div>
    </div>
</section>


        <section class="contact-cta container" id="contato">
            <h3>Quer saber mais?</h3>
            <p>Entre em contato conosco para uma demonstração e descubra como a Linfer pode transformar sua operação ferroviária.</p>
            <a href="perfil.php" class="cta-button">Acessar painel</a>
        </section>
    </main>

    <script src="../js/Sobre.js"></script>
</body>
</html>