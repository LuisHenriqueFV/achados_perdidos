-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/12/2023 às 01:27
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `achados_perdidos`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(47, 'Eletrônicos'),
(48, 'Roupas'),
(49, 'Acessórios'),
(50, 'Livros'),
(51, 'Documentos'),
(52, 'Brinquedos'),
(53, 'Joias'),
(54, 'Relógios'),
(55, 'Equipamento Esportivo'),
(56, 'Ferramentas'),
(57, 'Artigos de Beleza'),
(58, 'Instrumentos Musicais'),
(59, 'Equipamentos de Camping'),
(60, 'Óculos'),
(62, 'Utensílios Domésticos'),
(63, 'Material de Escritório'),
(64, 'Bolsas e Malas'),
(65, 'Calçados'),
(66, 'Artigos de Decoração'),
(67, 'Produtos de Limpeza'),
(68, 'Objetos de Arte'),
(69, 'Produtos de Jardinagem'),
(70, 'Equipamentos de Fotografia'),
(71, 'Brindes Promocionais'),
(72, 'Material de Ensino'),
(73, 'Artigos para Animais de Estimação'),
(74, 'Artigos de Viagem'),
(75, 'Equipamentos de Pesca'),
(76, 'Objetos de Coleção'),
(77, 'Equipamentos Médicos'),
(78, 'Remédio');

-- --------------------------------------------------------

--
-- Estrutura para tabela `objeto`
--

CREATE TABLE `objeto` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `local` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `tipo` enum('Encontrado','Perdido') NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `codpessoa` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `objeto`
--

INSERT INTO `objeto` (`id`, `nome`, `descricao`, `local`, `data`, `categoria`, `tipo`, `imagem`, `codpessoa`) VALUES
(195, 'Aliança', 'aliança de noivado', 'Pedro Osório', '2023-11-09', 'Joias', 'Perdido', 'uploads/anel.png', 42),
(197, 'Celular', 'Xiaomi', 'Pelotas, Centro', '2023-11-10', 'Eletrônicos', 'Encontrado', 'uploads/celular_branco.png', 43),
(198, 'Guarda-Chuva', 'Preto', 'Pelotas, Centro', '2023-11-08', 'Acessórios', 'Encontrado', 'uploads/guarda_chuva.png', 43);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `codpessoa` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(30) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(355) DEFAULT NULL,
  `reg_date` date NOT NULL DEFAULT curdate(),
  `adm` int(11) DEFAULT 0,
  `codigo_verificacao` varchar(32) NOT NULL DEFAULT '',
  `verificado` tinyint(1) DEFAULT 0,
  `imagem` varchar(255) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa`
--

INSERT INTO `pessoa` (`codpessoa`, `nome`, `email`, `senha`, `reg_date`, `adm`, `codigo_verificacao`, `verificado`, `imagem`, `cep`, `logradouro`, `bairro`, `cidade`) VALUES
(42, 'adm', 'adm@gmail.com', '$2y$10$3.XBqL6OS5hNMfeTFvvYXOehHQ.rRK6eXOhc0TxChjhL9lu.Z9xde', '2023-11-30', 1, '88a044f44a03e0459eb99c7ca13bd406', 1, '10.jpeg', NULL, NULL, NULL, NULL),
(43, 'usuario', 'usuario@gmail.com', '$2y$10$XalNbebQHGQ2yv15.HFbPO9clrOZlQWNTpeoPjoQAFIMWIcLxae.S', '2023-11-30', 0, 'aabdc9e5d4447cf9b86212aeb71ab518', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperacao`
--

CREATE TABLE `recuperacao` (
  `utilizador` varchar(255) NOT NULL,
  `chave` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `utilizadores`
--

CREATE TABLE `utilizadores` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `objeto`
--
ALTER TABLE `objeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codpessoa` (`codpessoa`);

--
-- Índices de tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`codpessoa`);

--
-- Índices de tabela `recuperacao`
--
ALTER TABLE `recuperacao`
  ADD KEY `utilizador` (`utilizador`);

--
-- Índices de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de tabela `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codpessoa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `objeto`
--
ALTER TABLE `objeto`
  ADD CONSTRAINT `objeto_ibfk_1` FOREIGN KEY (`codpessoa`) REFERENCES `pessoa` (`codpessoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
