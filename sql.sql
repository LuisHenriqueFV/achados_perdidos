-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/12/2023 às 21:33
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
(78, 'Remédio'),
(83, 'Animais');

-- --------------------------------------------------------

--
-- Estrutura para tabela `historia`
--

CREATE TABLE `historia` (
  `id` int(11) NOT NULL,
  `relato` text NOT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historia`
--

INSERT INTO `historia` (`id`, `relato`, `data_hora`) VALUES
(7, ' <h1>Fiel Companheiro</h1>Luciana, uma apaixonada por animais, postou no site de achados e perdidos sobre o desaparecimento de seu gato, Whiskers. Meses depois, uma mulher chamada Carla encontrou Whiskers vagando em seu jardim e, ao verificar o site, descobriu que Luciana o procurava. A alegria foi imensa quando Luciana e Whiskers foram reunidos, graças à conexão feita pelo site\r\n\r\n', '2023-12-05 14:14:52'),
(8, '<h1> A Busca Pelo Ursinho de Estimação</h1 <p>João, um menino de sete anos, perdeu seu ursinho de estimação em um parque movimentado. Sua mãe, Marta, postou no site de achados e perdidos. Uma senhora chamada Maria o encontrou enquanto fazia sua caminhada diária. Ao ver o post, Maria devolveu o ursinho a João, criando um vínculo especial entre eles.</p>', '2023-12-05 14:15:03'),
(16, '<h1> A Devolução do Anel de Noivado</h1>Ana, distraída após um dia agitado, perdeu seu anel de noivado no transporte público. Um trabalhador chamado Carlos o encontrou e, ao verificar o site de achados e perdidos, localizou a postagem de Ana. Carlos fez questão de devolver pessoalmente o anel, testemunhando o alívio e a gratidão de Ana.', '2023-12-05 15:28:07'),
(17, '<h1>A Gentileza Inesperada</h1>Pedro, ao sair de um café, percebeu que deixou sua mochila contendo seu laptop no estabelecimento. O garçom, Antonio, encontrou a mochila e, ao verificar o site de achados e perdidos, entrou em contato com Pedro. Eles se encontraram, e Pedro ficou grato pela honestidade de Antonio, reforçando a fé na bondade humana.\r\n', '2023-12-05 15:30:51');

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
(208, 'Câmera', 'Tekpix', 'Praça Coronel Pedro Osorio', '2023-12-20', 'Eletrônicos', 'Encontrado', 'uploads/camera.png', 42),
(213, 'Óculos de Sol', 'Marca da Chilli Beans', 'Dom Guilherme Litran', '2023-12-12', 'Acessórios', 'Perdido', 'uploads/oculos.png', 42),
(214, 'Urso de Pelúcia', 'Marrom', 'Centro', '2023-12-20', 'Brinquedos', 'Encontrado', 'img/objeto/imagem_656b9cbf56a37.png', 42),
(215, 'Chave de boca', 'Enferrujada', 'Bairro Cohab 2', '2023-12-21', 'Ferramentas', 'Encontrado', 'img/objeto/imagem_656b9f5a04cde.png', 42),
(216, 'Celular', 'Marca: Xiaomi, branco', 'Academia Fitness', '2023-12-13', 'Eletrônicos', 'Encontrado', 'img/objeto/imagem_656ba0549c831.png', 42),
(217, 'Aliança', 'Aliança de casamento', 'Praça do centro', '2023-12-18', 'Joias', 'Encontrado', 'uploads/icons8-one-ring-100.png', 43),
(218, 'Fones de ouvido', 'Marca: Kz', 'Na escola', '2023-12-14', 'Eletrônicos', 'Perdido', 'img/objeto/imagem_656bc4a067a70.png', 42),
(219, 'Violão', 'Marca: Giannini', 'Praça', '2023-12-19', 'Instrumentos Musicais', 'Perdido', 'img/objeto/imagem_656cd516d2ce9.png', 42),
(220, 'Cachorro', 'Viralata caramelo', 'Praia do laranjal', '2023-12-05', 'Animais', 'Encontrado', 'img/objeto/imagem_656f1f359a6f4.png', 42),
(221, 'camera', 'sony', 'Laranjal, pelotas', '2023-12-05', 'Equipamentos de Fotografia', 'Perdido', 'img/objeto/imagem_padrao.png', 42);

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
(42, 'adm', 'adm@gmail.com', '$2y$10$3.XBqL6OS5hNMfeTFvvYXOehHQ.rRK6eXOhc0TxChjhL9lu.Z9xde', '2023-11-30', 1, '88a044f44a03e0459eb99c7ca13bd406', 1, '18.jpeg', '96087060', 'Rua Dom Guilherme Litran', 'Areal', 'Pelotas'),
(43, 'usuario', 'usuario@gmail.com', '$2y$10$XalNbebQHGQ2yv15.HFbPO9clrOZlQWNTpeoPjoQAFIMWIcLxae.S', '2023-11-30', 0, 'aabdc9e5d4447cf9b86212aeb71ab518', 1, NULL, '96087060', 'Rua Dom Guilherme Litran', 'Areal', 'Pelotas'),
(44, 'henrique', 'luiishenriiquefonseca@gmail.com', '$2y$10$frDDRWcTeyEqa6iRB1o8OOcPSmQRuK6Wh9AjS9C2cNnGQu7OvG1rS', '2023-12-05', 0, '845ed65730befbee6087327c7d1d85e2', 0, NULL, NULL, NULL, NULL, NULL);

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
-- Índices de tabela `historia`
--
ALTER TABLE `historia`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT de tabela `historia`
--
ALTER TABLE `historia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `objeto`
--
ALTER TABLE `objeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codpessoa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
