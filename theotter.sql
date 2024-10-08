-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 08/10/2024 às 16:56
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
-- Banco de dados: `theotter`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL DEFAULT 1,
  `data_adicionado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `filmes`
--

CREATE TABLE `filmes` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `dataEstreia` date DEFAULT NULL,
  `distribuidoPor` varchar(255) DEFAULT NULL,
  `diretor` varchar(255) DEFAULT NULL,
  `genero` varchar(100) DEFAULT NULL,
  `duracao` time DEFAULT NULL,
  `classificacaoEtaria` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filmes`
--

INSERT INTO `filmes` (`id`, `titulo`, `descricao`, `imagem`, `dataEstreia`, `distribuidoPor`, `diretor`, `genero`, `duracao`, `classificacaoEtaria`, `created_at`) VALUES
(1, 'Moana 2', 'Moana viaja para os mares distantes depois de receber uma ligação inesperada de seus ancestrais.', 'images/cartaz_filme1.jpeg', '2024-11-28', 'Walt Disney Animation Studios', 'Dave Derrick Jr', 'Infantil', '02:14:23', 'Livre', '2024-10-07 19:00:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `imagem`, `categoria`) VALUES
(11, 'Fini Beijos 90g', 2.99, 'images/fini1.png', 'guloseimas'),
(12, 'Fini Dentaduras 90g', 3.99, 'images/fini2.png', 'guloseimas'),
(13, 'Fini Bananas 90g', 2.49, 'images/fini3.png', 'guloseimas'),
(14, 'Finibughers 90g', 3.49, 'images/fini5.png', 'guloseimas'),
(15, 'Fini Minhocas 90g', 4.49, 'images/fini4.png', 'guloseimas'),
(16, 'Fini Minhocas Ácidas 90g', 3.29, 'images/fini6.png', 'guloseimas'),
(17, 'Fini Beijos 90g', 2.79, 'images/fini9.png', 'guloseimas'),
(18, 'Fini Tubes Morango 90g', 5.99, 'images/fini11.png', 'guloseimas'),
(19, 'Balas de Mentha', 2.99, 'images/fini12.png', 'guloseimas'),
(20, 'Balas Azedinhas', 4.99, 'images/fini7.png', 'guloseimas'),
(21, 'Fini Frutas Tropicais 90g', 3.29, 'images/fini8.png', 'guloseimas'),
(22, 'Fini Ursinhos 90g', 4.29, 'images/fini10.png', 'guloseimas'),
(23, 'Coca-Cola 350ml', 4.99, 'images/bebida1.png', 'bebidas'),
(24, 'Guaraná Antarctica 350ml', 4.49, 'images/bebida2.png', 'bebidas'),
(25, 'Pepsi 350ml', 4.99, 'images/bebida3.png', 'bebidas'),
(26, 'Fanta Laranja 350ml', 4.79, 'images/bebida4.png', 'bebidas'),
(27, 'Sprite 350ml', 4.89, 'images/bebida5.png', 'bebidas'),
(28, 'Água Mineral 500ml', 2.99, 'images/bebida6.png', 'bebidas'),
(29, 'Água de Coco 330ml', 5.49, 'images/bebida7.png', 'bebidas'),
(30, 'Suco de Laranja 300ml', 6.99, 'images/bebida8.png', 'bebidas'),
(31, 'Suco de Uva 300ml', 6.49, 'images/bebida9.png', 'bebidas'),
(32, 'Chá Gelado Limão 350ml', 4.29, 'images/bebida10.png', 'bebidas'),
(33, 'Energético Red Bull 250ml', 9.99, 'images/bebida11.png', 'bebidas'),
(34, 'H2OH! Limão 500ml', 5.19, 'images/bebida12.png', 'bebidas'),
(35, 'Ruffles Original 55g', 5.99, 'images/snack1.png', 'snacks'),
(36, 'Cheetos Requeijão 45g', 4.49, 'images/snack2.png', 'snacks'),
(37, 'Doritos Queijo Nacho 55g', 6.49, 'images/snack3.png', 'snacks'),
(38, 'Fandangos Presunto 45g', 4.19, 'images/snack4.png', 'snacks'),
(39, 'Ruffles Cebola e Salsa 55g', 5.99, 'images/snack5.png', 'snacks'),
(40, 'Cheetos Onda 45g', 4.49, 'images/snack6.png', 'snacks'),
(41, 'Doritos Sweet Chili 55g', 6.49, 'images/snack7.png', 'snacks'),
(42, 'Fandangos Queijo 45g', 4.19, 'images/snack8.png', 'snacks'),
(43, 'Pringles Original 120g', 14.99, 'images/snack9.png', 'snacks'),
(44, 'Lays Original 45g', 5.99, 'images/snack10.png', 'snacks'),
(45, 'Cebolitos 45g', 4.29, 'images/snack11.png', 'snacks'),
(46, 'Baconzitos 45g', 4.49, 'images/snack12.png', 'snacks');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome_completo` varchar(255) NOT NULL,
  `genero` enum('Masculino','Feminino','Outro') NOT NULL,
  `apelido` varchar(100) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL,
  `usar_mesmo_cpf` tinyint(1) NOT NULL DEFAULT 0,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `senha_confirm` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_completo`, `genero`, `apelido`, `cpf`, `data_nascimento`, `usar_mesmo_cpf`, `email`, `telefone`, `senha`, `senha_confirm`) VALUES
(1, 'iza', 'Feminino', 'iza', '123456789', '0000-00-00', 0, 'izabele@gmail.com', '1223254545', '$2y$10$i1KdeSsHwX4/VcyKP0joU.cLvswnK1yqrsG/GPKo17rknbHfFcIWy', NULL),
(2, 'izabele pereira', 'Feminino', 'izinha', '70218358920', '0000-00-00', 0, 'izabele2304@gmail.com', '991972304', '$2y$10$LQYx/PTUQvaF0cpuAScyoeUqWu7GWRykgUWbeq3vOPQ400l6Awm1i', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- Índices de tabela `filmes`
--
ALTER TABLE `filmes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`),
  ADD UNIQUE KEY `unique_cpf` (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `filmes`
--
ALTER TABLE `filmes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
