-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/10/2025 às 17:50
-- Versão do servidor: 8.0.21
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ferrovia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `pk_notificacao` int NOT NULL,
  `nome_notificacao` varchar(87) NOT NULL,
  `localizacao_notificacao` varchar(87) NOT NULL,
  `problema_notificacao` varchar(1000) NOT NULL,
  `data_notificacao` date NOT NULL,
  `hora_notificacao` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `pk_usuario` int NOT NULL,
  `nome_usuario` varchar(50) DEFAULT NULL,
  `email_usuario` varchar(50) DEFAULT NULL,
  `senha_usuario` varchar(255) DEFAULT NULL,
  `data_nascimento_usuario` date DEFAULT NULL,
  `genero_usuario` varchar(15) DEFAULT NULL,
  `cpf_usuario` char(11) DEFAULT NULL,
  `endereco_usuario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`pk_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `data_nascimento_usuario`, `genero_usuario`, `cpf_usuario`, `endereco_usuario`) VALUES
(1, 'Laura', 'jean@gmail.com', '12345678', '2025-09-12', 'Masculino', '12345678901', 'Rua Urusanga'),
(13, 'Edu', 'laura@gmail.com', '$2y$10$y3mb.UUQCTJ9.YMN5bfxa.Ws5.p4Uiorxspfv37hqjS8fzDEoyETK', '2025-09-04', 'Masculino', '12345678901', 'Rua Urusanga'),
(14, 'Carlos', 'Arthur@gmail.com', '$2y$10$4MeP/0IkbpvgQX3I.xlVtOdf..SqKcml97uxv/vx/d3QIZXHS95DW', '2025-09-18', 'Masculino', '12345678901', 'Rua Urusanga'),
(16, 'Marcos', 'marcos@gmail.com', '$2y$10$H9PX2674M5sqknON0vujbu9WOueL.3Mpx8sNoUWhX6MSHbAvqXT3.', '2025-09-01', 'Feminino', '01234567890', 'Rua Sesi'),
(17, 'lucas rafael pereira', 'rafael@gmail.com', '$2y$10$GUBZBtLZXd6s6zmdZjKzz.PY6zXDgUtbhMA4CACmnFBe8/eIzrPfi', '2025-09-16', 'Feminino', '12323232333', 'Rua Sesi'),
(18, 'jean', 'jeanc@gmail.com', '$2y$10$jnSL6oyRV66/7qCamV8V6es3TRQ8cXUDRbvfZuoBjWw0erSxfWaES', '2025-09-05', 'helicoptero', '12345672201', 'Rua Urusanga');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`pk_notificacao`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`pk_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `pk_notificacao` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `pk_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
