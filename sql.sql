-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/11/2023 às 15:45
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
-- Banco de dados: `perdidos_achados`
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
(2, 'Carteira'),
(3, 'Livros'),
(4, 'Bolsas'),
(5, 'Eletronicos'),
(6, 'Acessórios'),
(7, 'Instrumentos Músicais'),
(8, 'Esporte'),
(9, 'Brinquedos'),
(10, 'Vestuário'),
(11, 'Móveis'),
(12, 'Eletrodomésticos'),
(13, 'Ferramentas'),
(31, 'adsasdsdasd'),
(32, 'aaaab'),
(33, 'aaaaaaaaac'),
(34, 'aaaaaaad'),
(35, 'UAHEAUHEAUAHE'),
(36, 'AEUAEHEAUHEAUHAEEA'),
(37, 'AEUAEHEAUHEAUHAEEA'),
(38, 'AEUAEHEAUHEAUHAEEA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `objetos_encontrados`
--

CREATE TABLE `objetos_encontrados` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `local` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `codpessoa` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `objetos_encontrados`
--

INSERT INTO `objetos_encontrados` (`id`, `nome`, `descricao`, `local`, `data`, `categoria`, `imagem`, `codpessoa`) VALUES
(105, 'Óculos de Sol', 'Óculos de sol modelo aviador', 'Lagoa Park', '2023-11-25', 'Acessórios', 'img/objetos_encontrados/oculos.png', 3),
(106, 'Carteira', 'Carteira de couro marrom', 'Shopping Center', '2023-11-25', 'Objetos Pessoais', 'img/objetos_encontrados/carteira.png', 4),
(107, 'Celular', 'Smartphone modelo XZ', 'Estação de Metrô', '2023-11-25', 'Eletrônicos', 'img/objetos_encontrados/celular.png', 5),
(140, 'Óculos de Sol', 'Óculos de sol encontrados na praia', 'Praia do Sol', '2023-11-18', 'Acessórios', 'img/objetos_encontrados/oculos.png', 2),
(141, 'Bolsa', 'Bolsa encontrada no shopping', 'Shopping Center', '2023-11-19', 'Bolsas', 'img/objetos_encontrados/bolsa.png', 7),
(142, 'Cachecol', 'Cachecol perdido no inverno', 'Parque do Gelo', '2023-11-20', 'Vestuário', 'img/objetos_encontrados/cachecol.png', 9),
(143, 'Laptop', 'Laptop encontrado no café', 'Café Expresso', '2023-11-24', 'Eletrônicos', 'img/objetos_encontrados/laptop.png', 3),
(144, 'Guarda-chuva', 'Guarda-chuva perdido na estação', 'Estação de Trem', '2023-11-25', 'Acessórios', 'img/objetos_encontrados/guarda_chuva.png', 8),
(145, 'Livro', 'Livro encontrado na biblioteca', 'Biblioteca Municipal', '2023-11-26', 'Livros', 'img/objetos_encontrados/livro.png', 5),
(146, 'Câmera', 'Câmera encontrada no parque', 'Parque da Cidade', '2023-11-21', 'Eletrônicos', 'img/objetos_encontrados/camera.png', 3),
(147, 'Guarda-chuva', 'Guarda-chuva esquecido no ônibus', 'Ônibus 102', '2023-11-22', 'Acessórios', 'img/objetos_encontrados/guarda_chuva.png', 8),
(148, 'Livro', 'Livro encontrado na biblioteca', 'Biblioteca Municipal', '2023-11-23', 'Livros', 'img/objetos_encontrados/livro.png', 5),
(149, 'Mochila', 'Mochila perdida no parque', 'Parque da Cidade', '2023-11-24', 'Bolsas', 'img/objetos_encontrados/mochila.png', 2),
(150, 'Relógio', 'Relógio encontrado na rua', 'Rua Principal', '2023-11-25', 'Acessórios', 'img/objetos_encontrados/relogio.png', 7),
(151, 'Cachorro de Pelúcia', 'Cachorro de pelúcia encontrado no parque infantil', 'Parque Infantil', '2023-12-01', 'Brinquedos', 'img/objetos_encontrados/cachorro_pelucia.png', 9),
(152, 'Anel', 'Anel esquecido na loja de jóias', 'Shopping Luxo', '2023-12-02', 'Acessórios', 'img/objetos_encontrados/anel.png', 4),
(153, 'Skate', 'Skate perdido na pista', 'Pista de Skate', '2023-12-03', 'Esportes', 'img/objetos_encontrados/skate.png', 10),
(154, 'Cadeira de Praia', 'Cadeira de praia esquecida na areia', 'Praia Tropical', '2023-12-04', 'Móveis', 'img/objetos_encontrados/cadeira_praia.png', 7),
(155, 'Boné', 'Boné encontrado no parque', 'Parque da Juventude', '2023-12-05', 'Acessórios', 'img/objetos_encontrados/bone.png', 2),
(156, 'Mala', 'Mala perdida no aeroporto', 'Aeroporto Internacional', '2023-12-06', 'Bolsas', 'img/objetos_encontrados/mala.png', 8),
(158, 'Tablet', 'Tablet encontrado no café', 'Café do Centro', '2023-12-08', 'Eletrônicos', 'img/objetos_encontrados/tablet.png', 6),
(159, 'Patins', 'Patins perdidos no parque', 'Parque da Cidade', '2023-12-09', 'Esportes', 'img/objetos_encontrados/patins.png', 3),
(160, 'Colar', 'Colar esquecido no restaurante', 'Restaurante Elegante', '2023-12-10', 'Acessórios', 'img/objetos_encontrados/colar.png', 5),
(161, 'Celular', 'branco da xiaomi', 'praça osorio', '2023-11-15', 'Eletrônicos', 'img/objetos_encontrados/celular_branco.png', NULL),
(163, 'Chave', 'chave do carro hb20', 'Rua 17 arco iris', '2022-01-12', 'Chaves', 'img/objetos_encontrados/chave_carro.png', NULL),
(164, 'Tenis', 'All star branco', 'Centro da cidade', '2021-12-15', 'Vestuário', 'img/objetos_encontrados/imagem_65636fe23aca8.png', NULL),
(173, 'Celular', 'Branco, xiaomi', 'Pelotas, Centro', '2023-09-12', 'Eletronicos', 'img/objetos_encontrados/imagem_6563ac51216ba.png', 39),
(178, 'dasdsadsa', 'sdasdaasdsda', 'sdasdasda', '2023-11-15', 'Bolsas', 'img/objetos_encontrados/imagem_6564d9d5a2616.jpeg', 1),
(182, 'adsaasdsad', 'dsadssda', 'sdasdasda', '0011-11-11', 'Vestuário', 'img/objetos_encontrados/imagem_6567f52e0d419.jpeg', 40),
(183, 'dsasdasda', 'dsasdadas', 'dsasdaasd', '1111-11-01', 'Eletrodomésticos', 'img/objetos_encontrados/imagem_6567f5ca5884c.jpeg', 40),
(184, 'dsasdasda', 'dsasdadas', 'dsasdaasd', '1111-11-01', 'Eletrodomésticos', 'img/objetos_encontrados/imagem_6567f5d123dc8.jpeg', 40);

-- --------------------------------------------------------

--
-- Estrutura para tabela `objetos_perdidos`
--

CREATE TABLE `objetos_perdidos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `local` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `codpessoa` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `objetos_perdidos`
--

INSERT INTO `objetos_perdidos` (`id`, `nome`, `descricao`, `local`, `data`, `created_at`, `categoria`, `imagem`, `codpessoa`) VALUES
(31, 'Mochila', 'Mochila escolar azul', 'Parque Municipal', '2023-11-25', '2023-11-26 13:38:09', 'Bolsas', 'img/objetos_perdidos/sem_imagem.png', 7),
(32, 'Chapéu', 'Chapéu de palha com fita vermelha', 'Praia da Cidade', '2023-11-25', '2023-11-26 13:38:09', 'Vestuário', 'img/objetos_perdidos/sem_imagem.png', 8),
(33, 'Tablet', 'Tablet marca YZ', 'Biblioteca Municipal', '2023-11-25', '2023-11-26 13:38:09', 'Eletrônicos', 'img/objetos_perdidos/sem_imagem.png', 9),
(34, 'Chave do Carro', 'Chaveiro com chave do carro', 'Estacionamento', '2023-11-25', '2023-11-26 13:38:09', 'Objetos Pessoais', 'img/objetos_perdidos/sem_imagem.png', 10),
(35, 'Boné', 'Preto de aba reta', 'Local do Objeto Perdido 01', '2023-11-10', '2023-11-26 13:42:12', 'Objetos Pessoais', 'img/objetos_perdidos/sem_imagem.png', 7),
(67, 'Celular', 'Celular perdido no parque', 'Parque da Cidade', '2023-11-15', '2023-11-26 13:54:21', 'Eletrônicos', 'img/objetos_perdidos/sem_imagem.png', 3),
(68, 'Chaves', 'Chaves encontradas na rua', 'Rua Principal', '2023-11-16', '2023-11-26 13:54:21', 'Chaves', 'img/objetos_perdidos/sem_imagem.png', 8),
(69, 'Carteira', 'Carteira perdida no ônibus', 'Ônibus 101', '2023-11-17', '2023-11-26 13:54:21', 'Documentos', 'img/objetos_perdidos/sem_imagem.png', 5),
(70, 'Relógio', 'Relógio perdido no centro', 'Centro da Cidade', '2023-11-21', '2023-11-26 13:57:13', 'Acessórios', 'img/objetos_perdidos/sem_imagem.png', 1),
(71, 'Mochila', 'Mochila encontrada na escola', 'Escola Primária', '2023-11-22', '2023-11-26 13:57:13', 'Bolsas', 'img/objetos_perdidos/sem_imagem.png', 4),
(72, 'Chapéu', 'Chapéu perdido no parque', 'Parque Natural', '2023-11-23', '2023-11-26 13:57:13', 'Vestuário', 'img/objetos_perdidos/sem_imagem.png', 6),
(73, 'Celular', 'Celular perdido no shopping', 'Shopping Center', '2023-11-26', '2023-11-26 13:58:39', 'Eletrônicos', 'img/objetos_perdidos/sem_imagem.png', 5),
(75, 'Notebook', 'Notebook esquecido no café', 'Café Central', '2023-11-28', '2023-11-26 13:58:39', 'Eletrônicos', 'img/objetos_perdidos/sem_imagem.png', 10),
(76, 'Bicicleta', 'Bicicleta perdida no parque', 'Parque da Cidade', '2023-11-29', '2023-11-26 13:58:39', 'Esportes', 'img/objetos_perdidos/sem_imagem.png', 3),
(77, 'Óculos', 'Óculos perdidos no ônibus', 'Ônibus 103', '2023-11-30', '2023-11-26 13:58:39', 'Acessórios', 'img/objetos_perdidos/sem_imagem.png', 6),
(78, 'Bola de Futebol', 'Bola de futebol perdida no campo', 'Campo de Futebol', '2023-12-11', '2023-11-26 13:59:51', 'Esportes', 'img/objetos_perdidos/sem_imagem.png', 7),
(79, 'Livro de Receitas', 'Livro de receitas esquecido na cozinha', 'Casa da Avó', '2023-12-12', '2023-11-26 13:59:51', 'Livros', 'img/objetos_perdidos/sem_imagem.png', 4),
(80, 'Chapéu de Sol', 'Chapéu de sol perdido na praia', 'Praia do Verão', '2023-12-13', '2023-11-26 13:59:51', 'Acessórios', 'img/objetos_perdidos/sem_imagem.png', 10),
(81, 'Câmera Fotográfica', 'Câmera fotográfica esquecida no parque', 'Parque da Cidade', '2023-12-14', '2023-11-26 13:59:51', 'Eletrônicos', 'img/objetos_perdidos/sem_imagem.png', 2),
(82, 'Carrinho de Brinquedo', 'Carrinho de brinquedo encontrado na calçada', 'Rua das Crianças', '2023-12-15', '2023-11-26 13:59:51', 'Brinquedos', 'img/objetos_perdidos/sem_imagem.png', 8),
(83, 'Luvas', 'Luvas perdidas na estação de esqui', 'Estação de Esqui Montanha Gelada', '2023-12-16', '2023-11-26 13:59:51', 'Vestuário', 'img/objetos_perdidos/sem_imagem.png', 6),
(85, 'Bola de Basquete', 'Bola de basquete perdida na quadra', 'Quadra de Basquete', '2023-12-18', '2023-11-26 13:59:51', 'Esportes', 'img/objetos_perdidos/sem_imagem.png', 9),
(86, 'Brinco', 'Brinco esquecido na joalheria', 'Joalheria Preciosa', '2023-12-19', '2023-11-26 13:59:51', 'Acessórios', 'img/objetos_perdidos/sem_imagem.png', 5),
(87, 'Cadeira de Escritório', 'Cadeira de escritório perdida no prédio', 'Prédio Empresarial', '2023-12-20', '2023-11-26 13:59:51', 'Móveis', 'img/objetos_perdidos/sem_imagem.png', 3),
(92, 'Mangueira', 'laranja, 4metros', 'Dom guilherme litran', '2020-02-21', '2023-11-26 20:37:38', 'Eletronicos', 'img/objetos_perdidos/imagem_6563ac92647e7.png', 39),
(93, 'cao', 'cao', 'cao', '2023-11-22', '2023-11-26 20:54:14', 'casaco', 'uploads/tablet.png', 39),
(94, 'adsdsasdadaddadas', 'dsasaddas', 'sadsadsadas', '0111-11-11', '2023-11-28 04:39:49', 'Documentos', 'img/objetos_perdidos/imagem_65656f1516054.png', 1),
(95, 'Livro', 'Harry Potter, capa dura', 'Lisboa, shopping 21', '1111-11-11', '2023-11-30 01:11:52', 'Livros', 'uploads/9.jpeg', 40);

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
(1, 'fernando', 'fernando@gmail.com', '12345', '2023-11-26', 0, '052a30aea61b67b62d47971217fe2ac7', 1, 'coala segurando varios objetos.jpeg', '96087060', 'Rua Dom Guilherme Litran', 'Areal', 'Pelotas'),
(2, 'Maria Silva', 'maria@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(3, 'José Santos', 'jose@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(4, 'Amanda Souza', 'amanda@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(5, 'Ricardo Oliveira', 'ricardo@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(6, 'Patrícia Lima', 'patricia@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(7, 'Lucas Pereira', 'lucas@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(8, 'Cristina Santos', 'cristina@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(9, 'Alexandre Costa', 'alexandre@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(10, 'Roberta Almeida', 'roberta@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(11, 'Diego Martins', 'diego@email.com', '$2y$10$uj5g..2P9xvq8w0iZxjjjO0hMBh/2ivSYa7ve2yVrSvKjv8KvtM/a', '2023-11-25', 0, '', 1, NULL, NULL, NULL, NULL, NULL),
(39, 'lucas', 'lucas@gmail.com', '$2y$10$PtKNew7JFmOFU.WCW15r6OH8jgzs3sj04AYVowXiGift0UMqFmVh2', '2023-11-26', 0, '0e60805fdedcfc201487bc78859ad407', 1, NULL, NULL, NULL, NULL, NULL),
(40, 'Administrador', 'luishenriquefonsecaphp@gmail.com', '$2y$10$GZ8Lvzq/..AdFzrNXx8pYO8VDJ6N3BCwu6F7WV97Ow.221fwxqRVW', '2023-11-29', 1, '5653f11913b78667b21243a66b8c0d6e', 1, '2.jpeg', '96087060', 'Rua Dom Guilherme Litran', 'Areal', 'Pelotas'),
(41, 'naoADM', 'naoadm@gmail.com', '$2y$10$y9l2iXVGwhDxXDxZQdB00evXcFCHeo/6v.FYDmChghCWVbfL8T/wC', '2023-11-30', 0, 'a91ebf0c08f97f495d49522a5b2799ef', 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `recuperacao`
--

CREATE TABLE `recuperacao` (
  `utilizador` varchar(255) NOT NULL,
  `chave` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `recuperacao`
--

INSERT INTO `recuperacao` (`utilizador`, `chave`) VALUES
('luishenriquefonsecaphp@gmail.com', '$2y$10$Jn50S/qL6NRtQkOypiSGu.jrXfxS8PnGlpyxLlGJj9pCPXdLP0SLK'),
('LuisHenriqueFonsecaPHP@gmail.com', '$2y$10$HnhMMQtyI0Y392mTRL97PObsLBr/tqsvJaWOHwe.AQuZjnnfFAt6y'),
('LuisHenriqueFonsecaPHP@gmail.com', '$2y$10$K8Ooj3aKTTBFdFp60UujOOTrhP7heRpfEfwIWZIjoFdgFDowsuMcO'),
('luishenriquefonsecaphp@gmail.com', '$2y$10$2fZ.xzSvg3QxQeXvFXs/m.cUl5QnEVo3Ekfw.x4VaarzNGlxDwQDG'),
('fonsecah269@gmail.com ', '$2y$10$qcPfhDhMjoYXIqdBzIOSJeTn7WG8r9Y6uPNypWBkOYehYPWWiRybm'),
('luishenriquefonsecaphp@gmail.com', '$2y$10$eauRKTdRqvSCOZYtphqM8OQjaWaL3DqC84RW9PBKqK3mHDeboQPgq');

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
-- Índices de tabela `objetos_encontrados`
--
ALTER TABLE `objetos_encontrados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `codpessoa` (`codpessoa`);

--
-- Índices de tabela `objetos_perdidos`
--
ALTER TABLE `objetos_perdidos`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `objetos_encontrados`
--
ALTER TABLE `objetos_encontrados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT de tabela `objetos_perdidos`
--
ALTER TABLE `objetos_perdidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `codpessoa` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `utilizadores`
--
ALTER TABLE `utilizadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `objetos_encontrados`
--
ALTER TABLE `objetos_encontrados`
  ADD CONSTRAINT `objetos_encontrados_ibfk_1` FOREIGN KEY (`codpessoa`) REFERENCES `pessoa` (`codpessoa`);

--
-- Restrições para tabelas `objetos_perdidos`
--
ALTER TABLE `objetos_perdidos`
  ADD CONSTRAINT `objetos_perdidos_ibfk_1` FOREIGN KEY (`codpessoa`) REFERENCES `pessoa` (`codpessoa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
