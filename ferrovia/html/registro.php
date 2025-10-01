<?php
session_start();

$erro = $_SESSION['erro'] ?? '';
unset($_SESSION['erro']);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/registro.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <title>Ferrovia - Criar Conta</title>
</head>

<body>
  <header>
    <div id="cabecalho">
      <nav>
        <ul id="menu">
          <h1>Crie sua conta</h1>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section class="conteudo">
      <form action="cadastro.php" method="post" >
        <div class="adicionar">

          <div class="prencher">
            <label for="nome"><i class="bi bi-person-circle"></i></label>
            <input type="text" id="nome_usuario" name="nome_usuario" required placeholder="Nome completo" />
          </div>

          <div class="prencher">
            <label for="email"><i class="bi bi-envelope-fill"></i></label>
            <input type="email" id="email_usuario" name="email_usuario" required placeholder="Email" />
          </div>

          <div class="prencher">
            <label for="senha"><i class="bi bi-lock-fill"></i></label>
            <input type="password" id="senha_usuario" name="senha_usuario" required placeholder="Senha" />
          </div>

          <div class="prencher">
            <label for="nascimento"><i class="bi bi-calendar-check-fill"></i></label>
            <input type="date" id="data_nascimento_usuario" name="data_nascimento_usuario" required />
          </div>

          <div class="prencher">
            <label for="genero"><i class="bi bi-gender-ambiguous"></i></label>
            <input type="text" id="genero_usuario" name="genero_usuario" required placeholder="Gênero" />
          </div>

          <div class="prencher">
            <label for="cpf"><i class="bi bi-person-vcard-fill"></i></label>
            <input type="text" id="cpf_usuario" name="cpf_usuario" required placeholder="CPF" minlength="11" maxlength="11"/>
          </div>

          <div class="prencher">
            <label for="endereco"><i class="bi bi-geo-alt-fill"></i></label>
            <input type="text" id="endereco_usuario" name="endereco_usuario" required placeholder="Endereço" />
          </div>

        </div>

        <br />
        <button type="submit" class="botao-adicionar">Criar</button>

        <?php
        echo "<div>$erro</div>";
        ?>
      </form>
    </section>
  </main>

  <script src="../js/validacao.js"></script>
</body>
</html>