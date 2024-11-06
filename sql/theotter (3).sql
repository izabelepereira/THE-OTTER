-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/11/2024 às 05:51
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
  `quantidade` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 'Fini Beijos 90g', 2.99, '../../images/fini1.png', 'guloseimas'),
(12, 'Fini Dentaduras 90g', 3.99, '../../images/fini2.png', 'guloseimas'),
(13, 'Fini Bananas 90g', 2.49, '../../images/fini3.png', 'guloseimas'),
(14, 'Finibughers 90g', 3.49, '../../images/fini5.png', 'guloseimas'),
(15, 'Fini Minhocas 90g', 4.49, '../../images/fini4.png', 'guloseimas'),
(16, 'Fini Minhocas Ácidas 90g', 3.29, '../../images/fini6.png', 'guloseimas'),
(17, 'Fini Beijos 90g', 2.79, '../../images/fini9.png', 'guloseimas'),
(18, 'Fini Tubes Morango 90g', 5.99, '../../images/fini11.png', 'guloseimas'),
(19, 'Balas de Mentha', 2.99, '../../images/fini12.png', 'guloseimas'),
(20, 'Balas Azedinhas', 4.99, '../../images/fini7.png', 'guloseimas'),
(21, 'Fini Frutas Tropicais 90g', 3.29, '../../images/fini8.png', 'guloseimas'),
(22, 'Fini Ursinhos 90g', 4.29, '../../images/fini10.png', 'guloseimas'),
(23, 'Coca-Cola 350ml', 4.99, '../../images/bebida1.png', 'bebidas'),
(24, 'Guaraná Antarctica 350ml', 4.49, '../../images/bebida2.png', 'bebidas'),
(25, 'Pepsi 350ml', 4.99, '../../images/bebida3.png', 'bebidas'),
(26, 'Fanta Laranja 350ml', 4.79, '../../images/bebida4.png', 'bebidas'),
(27, 'Sprite 350ml', 4.89, '../../images/bebida5.png', 'bebidas'),
(28, 'Água Mineral 500ml', 2.99, '../../images/bebida6.png', 'bebidas'),
(29, 'Água de Coco 330ml', 5.49, '../../images/bebida7.png', 'bebidas'),
(30, 'Suco de Laranja 300ml', 6.99, '../../images/bebida8.png', 'bebidas'),
(31, 'Suco de Uva 300ml', 6.49, '../../images/bebida9.png', 'bebidas'),
(32, 'Chá Gelado Limão 350ml', 4.29, '../../images/bebida10.png', 'bebidas'),
(33, 'Energético Red Bull 250ml', 9.99, '../../images/bebida11.png', 'bebidas'),
(34, 'H2OH! Limão 500ml', 5.19, '../../images/bebida12.png', 'bebidas'),
(35, 'Ruffles Original 55g', 5.99, '../../images/snack1.png', 'snacks'),
(36, 'Cheetos Requeijão 45g', 4.49, '../../images/snack2.png', 'snacks'),
(37, 'Doritos Queijo Nacho 55g', 6.49, '../../images/snack3.png', 'snacks'),
(38, 'Fandangos Presunto 45g', 4.19, '../../images/snack4.png', 'snacks'),
(39, 'Ruffles Cebola e Salsa 55g', 5.99, '../../images/snack5.png', 'snacks'),
(40, 'Cheetos Onda 45g', 4.49, '../../images/snack6.png', 'snacks'),
(41, 'Doritos Sweet Chili 55g', 6.49, '../../images/snack7.png', 'snacks'),
(42, 'Fandangos Queijo 45g', 4.19, '../../images/snack8.png', 'snacks'),
(43, 'Pringles Original 120g', 14.99, '../../images/snack9.png', 'snacks'),
(44, 'Lays Original 45g', 5.99, '../../images/snack10.png', 'snacks'),
(45, 'Cebolitos 45g', 4.29, '../../images/snack11.png', 'snacks'),
(46, 'Baconzitos 45g', 4.49, '../../images/snack12.png', 'snacks'),
(47, 'Combo da Casa', 30.90, '../../images/combo1.png', 'combos'),
(48, 'Combo Light & fit', 50.90, '../../images/combo2.png', 'combos'),
(49, 'Combo Kids', 35.90, '../../images/combo3.png', 'combos'),
(50, 'Combo Individual', 29.90, '../../images/combo4.png', 'combos'),
(51, 'Combo Natalino', 43.90, '../../images/combo5.png', 'combos'),
(52, 'Combo Halloween', 46.90, '../../images/combo6.png', 'combos'),
(53, 'Combo Lovers', 38.90, '../../images/combo7.png', 'combos'),
(54, 'Combo Gourmet', 59.90, '../../images/combo8.png', 'combos');

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
  `senha_confirm` varchar(255) DEFAULT NULL,
  `token_autenticacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_completo`, `genero`, `apelido`, `cpf`, `data_nascimento`, `usar_mesmo_cpf`, `email`, `telefone`, `senha`, `senha_confirm`, `token_autenticacao`) VALUES
(1, 'iza', 'Feminino', 'iza', '123456789', '0000-00-00', 0, 'izabele@gmail.com', '1223254545', '$2y$10$i1KdeSsHwX4/VcyKP0joU.cLvswnK1yqrsG/GPKo17rknbHfFcIWy', NULL, NULL),
(2, 'izabele pereira', 'Feminino', 'izinha', '70218358920', '0000-00-00', 0, 'izabele2304@gmail.com', '991972304', '$2y$10$LQYx/PTUQvaF0cpuAScyoeUqWu7GWRykgUWbeq3vOPQ400l6Awm1i', NULL, 'cc4a5139aba811d7f425ef44a5632872'),
(5, 'pereira', 'Masculino', 'pereira', '1234567891', '0000-00-00', 0, 'pereira@gmail.com', '65645454545454', '$2y$10$xnXYWsIDiZf4pIBZbbSBKOWA0S3zhIq/486mUesk9WewUiF0Yp5CO', NULL, NULL),
(8, 'ida', 'Feminino', 'ida', '456.986.325-56', '0000-00-00', 1, 'ida@gmail.com', '(16) 99199-6859', '$2y$10$MwgnEvAoVNjsO83yOUoKz.bxlxSzfuwCTUGzrAMQ.ki4ZlapqY8Zy', NULL, NULL),
(10, 'jhonata', 'Masculino', 'diego', '569.836.248-97', '0000-00-00', 1, 'jhonata@gmail.com', '(99) 19729-8652', '$2y$10$N/vqn7UnPAYu25jVW3jwKe1roZFooCepUPjUUOLc32YfD1hzXZrQK', NULL, '6100aa61e302c7a2cb10396b7c896684'),
(11, 'bel', 'Feminino', 'belzita', '896.578.966-56', '0000-00-00', 1, 'bel@gmail.com', '(54) 48944-5645', '$2y$10$KZRk3kZrCcdIw8CJeL.7Wu7xkJRHP6h0EGv0PyvZB3cp4Y7njTwJO', NULL, '50464f690acd7f89b97edccd449328d7');

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
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
