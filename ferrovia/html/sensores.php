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
    <title>Ferrovia - Sensores</title>
    <link rel="stylesheet" href="../css/sensores.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="main-nav">
        <div class="nav-left">
            <i class="bi bi-list" id="menuToggle"></i>
        </div>
        <div class="nav-center">
            <h1>Gerenciamento de Sensores</h1>
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
        <section class="conteudo">
            <form id="sensorForm" action="cadastrar_sensores.php" method="POST">
                <div class="form-group">
                    <label for="tipo_sensor">Tipo de Sensor:</label>
                    <select name="tipo_sensor" required>
                        <option value="Temperatura">Temperatura</option>
                        <option value="Pressão">Pressão</option>
                        <option value="Umidade">Umidade</option>
                        <option value="Vibração">Vibração</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="localizacao_sensor">Localização:</label>
                    <input type="text" name="localizacao_sensor" placeholder="Ex: Estação 1" required>
                </div>

                <div class="form-group">
                    <label for="status_sensor">Status:</label>
                    <select name="status_sensor" required>
                        <option value="Ativo">Ativo</option>
                        <option value="Inativo">Inativo</option>
                        <option value="Manutenção">Manutenção</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="data_instalacao">Data de Instalação:</label>
                    <input type="date" name="data_instalacao" required>
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

        <main>
            <div class="conteudo">


                <h2 class="mqtt-title">Leitura em Tempo Real</h2>

                <br>
                <div class="mqtt-grid">

                    <?php
                    $topics = [
                        'S1/Temperatura',
                        'S1/Umidade',
                        'S1/Luminosidade',
                        'S1/Presença1',
                        'S2/Presença2',
                        'S2/Presença4',
                        'S2/Servo3',
                        'S3/Presença3',
                        'S3/Servo1',
                        'S3/Servo2',
                        'Trem/Trem'
                    ];


                    function idFmt($t)
                    {
                        return str_replace('/', '_', $t);
                    }


                    foreach ($topics as $t):
                        $id = idFmt($t); ?>


                        <div class="card card-mqtt">
                            <div class="card-title"><?= $t ?></div>
                            <div class="card-text">
                                <p class="mqtt-value" id="<?= $id ?>">—</p>
                                <p class="mqtt-time" id="time_<?= $id ?>">Última atualização: —</p>
                            </div>
                        </div>


                    <?php endforeach; ?>


                </div>


            </div>
        </main>


        <script>

            // Converte "S1/Temperatura" → "S1_Temperatura"
            function conv(topic) {
                return topic.replace(/\//g, "_");
            }

            function atualizarCard(topic, valor) {

                // converte para o ID correto do HTML
                const id = conv(topic);

                const valEl = document.getElementById(id);
                const timeEl = document.getElementById("time_" + id);

                if (valEl) {
                    valEl.textContent = valor;
                }

                if (timeEl) {
                    timeEl.textContent = "Última atualização: " + new Date().toLocaleString("pt-BR");
                }
            }

            function atualizar() {
                fetch("get_messages.php")
                    .then(r => r.json())
                    .then(data => {
                        console.log("Mensagens recebidas:", data);
                        for (const topic in data) {
                            atualizarCard(topic, data[topic]);
                        }
                    })
                    .catch(err => console.error("Erro ao receber mensagens:", err));
            }

            setInterval(atualizar, 1000);
            atualizar();

        </script>

    </main>


    <script src="../js/sensores.js"></script>
</body>

</html>