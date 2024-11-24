-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24/11/2024 às 22:00
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

CREATE DATABASE theotter;

USE theotter;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `sessionTime` varchar(255) DEFAULT NULL,
  `room_number` varchar(10) NOT NULL,
  `seats` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `data_adicionado` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantidade` int(11) DEFAULT 1,
  `produto_id` int(11) DEFAULT NULL,
  `seat` varchar(255) DEFAULT NULL,
  `produto_snack_id` int(11) DEFAULT NULL,
  `preco_snack` decimal(10,2) DEFAULT NULL,
  `status` enum('ativo','bloqueado') DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`id`, `usuario_id`, `movie_id`, `movie_name`, `sessionTime`, `room_number`, `seats`, `price`, `poster_path`, `data_adicionado`, `quantidade`, `produto_id`, `seat`, `produto_snack_id`, `preco_snack`, `status`) VALUES
(148, 2, 0, 'Filme Desconhecido', NULL, 'Sala Desco', '130', 0.00, '../../images/default_poster.jpg', '2024-11-22 04:33:57', 1, NULL, NULL, NULL, NULL, 'bloqueado'),
(149, 2, 0, 'Gladiador II', NULL, 'Sala 1', '165', 30.00, '../../images/gladia.jpg', '2024-11-22 20:44:32', 1, NULL, NULL, NULL, NULL, 'bloqueado'),
(153, 2, 0, 'Gladiador II', NULL, 'Sala 1', '135', 30.00, '../../images/gladia.jpg', '2024-11-22 21:59:42', 1, NULL, NULL, NULL, NULL, 'bloqueado'),
(154, 2, 1, 'Wicked - Parte 1', NULL, 'Sala 2', '101', 30.00, '../../images/wic.jpg', '2024-11-22 22:00:01', 1, NULL, NULL, NULL, NULL, 'bloqueado'),
(156, 2, 2, 'Terrifier 3', NULL, 'Sala 1', '141', 30.00, '../../images/terrifier.jpg', '2024-11-22 22:01:00', 1, NULL, NULL, NULL, NULL, 'bloqueado'),
(157, 2, 3, 'Moana 2', NULL, 'Sala 1', '122', 30.00, '../../images/moana1.jpg', '2024-11-22 22:01:16', 1, NULL, NULL, NULL, NULL, 'bloqueado'),
(158, 2, 4, 'Mufasa', NULL, 'Sala 1', '153', 30.00, '../../images/mufasa1.jpg', '2024-11-22 22:01:27', 1, NULL, NULL, NULL, NULL, 'bloqueado'),
(161, 2, 1, 'Wicked - Parte 1', NULL, 'Sala 2', '120', 30.00, '../../images/wic.jpg', '2024-11-23 19:25:37', 1, NULL, NULL, NULL, NULL, 'ativo'),
(196, 37, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 05:07:30', 1, 23, NULL, NULL, NULL, 'ativo'),
(197, 37, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 05:07:43', 1, 49, NULL, NULL, NULL, 'ativo'),
(198, 37, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 05:07:46', 1, 53, NULL, NULL, NULL, 'ativo'),
(199, 37, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 05:07:58', 1, 51, NULL, NULL, NULL, 'ativo'),
(200, 37, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 05:08:01', 1, 47, NULL, NULL, NULL, 'ativo'),
(201, 37, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 05:08:09', 1, 33, NULL, NULL, NULL, 'ativo'),
(202, 37, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 05:08:14', 1, 34, NULL, NULL, NULL, 'ativo'),
(203, 37, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 05:12:48', 2, 11, NULL, NULL, NULL, 'ativo'),
(208, 2, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 06:41:22', 1, 11, NULL, NULL, NULL, 'ativo'),
(210, 2, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 06:45:40', 1, 33, NULL, NULL, NULL, 'ativo'),
(211, 2, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 06:45:45', 1, 30, NULL, NULL, NULL, 'ativo'),
(212, 2, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 06:45:47', 1, 27, NULL, NULL, NULL, 'ativo'),
(213, 2, 0, '', NULL, '', '', 0.00, NULL, '2024-11-24 16:21:58', 1, 15, NULL, NULL, NULL, 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `metodo_pagamento` varchar(255) NOT NULL,
  `data_pagamento` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamento`
--

INSERT INTO `pagamento` (`id`, `usuario_id`, `total`, `metodo_pagamento`, `data_pagamento`) VALUES
(1, 2, 30.00, 'pix', '2024-11-18 06:03:52'),
(2, 2, 30.00, 'debit-card', '2024-11-18 06:05:21'),
(3, 2, 128.01, 'credit-card', '2024-11-18 06:08:47'),
(4, 2, 128.01, 'pix', '2024-11-18 06:15:53'),
(5, 2, 128.01, 'pix', '2024-11-18 06:37:01'),
(6, 2, 30.00, 'credit-card', '2024-11-18 06:44:29'),
(7, 2, 128.01, 'pix', '2024-11-18 07:07:50'),
(8, 2, 128.01, 'pix', '2024-11-18 07:08:34'),
(9, 2, 128.01, 'pix', '2024-11-18 07:11:57'),
(10, 2, 128.01, 'credit-card', '2024-11-18 07:51:08'),
(11, 2, 128.01, 'pix', '2024-11-18 07:55:29'),
(12, 2, 128.01, 'pix', '2024-11-18 07:56:58'),
(13, 2, 128.01, 'pix', '2024-11-18 08:00:50'),
(14, 2, 128.01, 'pix', '2024-11-18 08:03:11'),
(15, 2, 128.01, 'pix', '2024-11-18 08:05:43'),
(16, 2, 128.01, 'pix', '2024-11-18 08:08:51'),
(17, 2, 128.01, 'pix', '2024-11-18 08:11:48'),
(18, 2, 128.01, 'pix', '2024-11-18 08:14:35'),
(19, 2, 128.01, 'pix', '2024-11-18 08:16:00'),
(20, 2, 128.01, 'pix', '2024-11-18 08:16:42'),
(21, 2, 128.01, 'pix', '2024-11-18 08:27:21'),
(22, 2, 128.01, 'pix', '2024-11-18 08:46:15'),
(23, 2, 47.56, 'pix', '2024-11-18 11:21:21'),
(24, 2, 17.56, 'pix', '2024-11-20 03:13:02'),
(25, 2, 342.89, 'credit-card', '2024-11-21 03:26:30'),
(26, 2, 342.89, 'pix', '2024-11-21 03:28:09'),
(27, 2, 300.03, 'pix', '2024-11-21 16:47:44'),
(28, 2, 404.73, 'pix', '2024-11-21 16:56:44'),
(29, 2, 404.73, 'pix', '2024-11-21 17:09:54'),
(30, 2, 404.73, 'pix', '2024-11-21 17:10:40'),
(31, 2, 404.73, 'pix', '2024-11-21 17:18:05'),
(32, 2, 404.73, 'pix', '2024-11-21 17:20:30'),
(33, 2, 404.73, 'pix', '2024-11-21 17:20:33'),
(34, 2, 404.73, 'pix', '2024-11-21 17:23:20'),
(35, 2, 404.73, 'credit-card', '2024-11-21 17:23:41'),
(36, 2, 404.73, 'credit-card', '2024-11-21 17:23:51'),
(37, 2, 404.73, 'pix', '2024-11-21 17:37:00'),
(38, 2, 404.73, 'pix', '2024-11-21 17:51:37'),
(39, 2, 404.73, 'pix', '2024-11-21 17:57:50'),
(40, 2, 404.73, 'pix', '2024-11-21 18:00:40'),
(41, 2, 404.73, 'pix', '2024-11-21 18:08:48'),
(42, 2, 404.73, 'pix', '2024-11-21 18:13:06'),
(43, 2, 404.73, 'pix', '2024-11-21 18:19:07'),
(44, 2, 404.73, 'pix', '2024-11-21 18:21:10'),
(45, 2, 404.73, 'pix', '2024-11-21 18:24:35'),
(46, 2, 404.73, 'pix', '2024-11-21 18:24:58'),
(47, 2, 404.73, 'pix', '2024-11-21 18:27:24'),
(48, 2, 404.73, 'pix', '2024-11-21 18:29:27'),
(49, 2, 404.73, 'pix', '2024-11-21 18:30:17'),
(50, 2, 404.73, 'pix', '2024-11-21 18:31:19'),
(51, 2, 404.73, 'pix', '2024-11-21 18:32:43'),
(52, 2, 404.73, 'pix', '2024-11-21 18:33:58'),
(53, 2, 404.73, 'pix', '2024-11-21 18:44:27'),
(54, 2, 404.73, 'pix', '2024-11-21 18:48:24'),
(55, 2, 404.73, 'credit-card', '2024-11-21 18:49:08'),
(56, 2, 404.73, 'debit-card', '2024-11-21 18:49:47'),
(57, 2, 404.73, 'pix', '2024-11-21 18:54:39'),
(58, 2, 404.73, 'pix', '2024-11-21 18:56:06'),
(59, 2, 404.73, 'pix', '2024-11-21 18:56:51'),
(60, 2, 404.73, 'pix', '2024-11-21 18:58:36'),
(61, 2, 404.73, 'pix', '2024-11-21 19:03:20'),
(62, 2, 404.73, 'pix', '2024-11-21 19:04:25'),
(63, 2, 404.73, 'pix', '2024-11-21 19:10:50'),
(64, 2, 404.73, 'pix', '2024-11-21 19:11:38'),
(65, 2, 427.19, 'pix', '2024-11-22 20:47:16'),
(66, 2, 427.19, 'pix', '2024-11-22 20:47:56'),
(67, 2, 580.08, 'pix', '2024-11-23 19:21:39'),
(68, 2, 580.08, 'pix', '2024-11-23 19:21:46'),
(69, 2, 583.07, 'pix', '2024-11-23 19:24:21'),
(70, 2, 583.07, 'pix', '2024-11-23 19:24:22'),
(71, 2, 583.07, 'pix', '2024-11-23 19:24:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos_reembolso`
--

CREATE TABLE `pedidos_reembolso` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo_reembolso` varchar(255) NOT NULL,
  `status` enum('Aprovado','Negado') DEFAULT 'Aprovado',
  `data_pedido` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos_reembolso`
--

INSERT INTO `pedidos_reembolso` (`id`, `usuario_id`, `tipo_reembolso`, `status`, `data_pedido`) VALUES
(1, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-12 17:29:21'),
(2, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 17:30:34'),
(3, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-12 17:30:41'),
(4, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-12 17:32:19'),
(5, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-12 17:32:51'),
(6, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 17:45:19'),
(7, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 17:45:27'),
(8, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 17:56:56'),
(9, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 17:59:40'),
(10, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 17:59:44'),
(11, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 18:00:00'),
(12, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 18:00:07'),
(13, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 18:00:54'),
(15, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 18:04:01'),
(16, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-12 18:04:50'),
(17, 2, '', 'Negado', '2024-11-12 18:06:13'),
(18, 2, '', 'Negado', '2024-11-12 18:07:42'),
(19, 2, '', 'Negado', '2024-11-12 18:08:27'),
(20, 2, '', 'Negado', '2024-11-12 18:09:59'),
(21, 2, '', 'Negado', '2024-11-12 18:10:18'),
(22, 2, '', 'Negado', '2024-11-12 18:11:31'),
(25, 2, '', 'Negado', '2024-11-12 18:14:19'),
(26, 2, '', 'Negado', '2024-11-12 18:14:28'),
(27, 2, '', 'Negado', '2024-11-12 18:19:28'),
(28, 2, '', 'Negado', '2024-11-12 18:20:28'),
(29, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:26:25'),
(30, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:29:21'),
(31, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:29:36'),
(32, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:29:50'),
(33, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:30:21'),
(34, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:33:01'),
(35, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:33:12'),
(36, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:33:58'),
(37, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:37:11'),
(38, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:37:23'),
(39, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:37:34'),
(40, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:38:15'),
(41, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:38:27'),
(42, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:39:18'),
(43, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:39:29'),
(44, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:39:36'),
(45, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:39:53'),
(46, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:40:01'),
(47, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:40:09'),
(48, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:41:18'),
(49, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:41:54'),
(50, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:42:02'),
(51, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:42:16'),
(52, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:42:28'),
(53, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:42:38'),
(54, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:42:44'),
(55, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:42:54'),
(56, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:43:14'),
(57, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:43:59'),
(58, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:46:17'),
(59, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:55:22'),
(60, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:56:02'),
(61, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 03:56:46'),
(62, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 03:58:38'),
(63, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 03:58:57'),
(64, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 04:02:02'),
(65, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:02:13'),
(66, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:02:35'),
(67, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:02:44'),
(68, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:02:57'),
(69, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:03:05'),
(70, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:03:40'),
(71, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:04:50'),
(72, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:06:24'),
(73, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:07:49'),
(74, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:08:35'),
(75, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:08:51'),
(76, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:09:22'),
(77, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:10:10'),
(78, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:10:16'),
(79, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:12:50'),
(80, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:12:54'),
(81, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:13:49'),
(82, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:14:03'),
(83, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:14:41'),
(84, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:16:57'),
(85, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:17:06'),
(86, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:17:23'),
(87, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:17:31'),
(88, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:17:31'),
(89, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:17:38'),
(90, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:17:45'),
(91, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:19:40'),
(92, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:20:14'),
(93, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:20:47'),
(94, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:20:50'),
(95, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:21:08'),
(96, 2, '', 'Negado', '2024-11-15 04:31:07'),
(97, 2, '', 'Negado', '2024-11-15 04:31:47'),
(98, 2, '', 'Negado', '2024-11-15 04:32:10'),
(99, 2, '', 'Negado', '2024-11-15 04:32:29'),
(100, 2, '', 'Negado', '2024-11-15 04:32:52'),
(101, 2, '', 'Negado', '2024-11-15 04:33:52'),
(102, 2, '', 'Negado', '2024-11-15 04:34:18'),
(103, 2, '', 'Negado', '2024-11-15 04:34:35'),
(104, 2, '', 'Negado', '2024-11-15 04:35:10'),
(105, 2, '', 'Negado', '2024-11-15 04:35:46'),
(106, 2, '', 'Negado', '2024-11-15 04:36:49'),
(107, 2, '', 'Negado', '2024-11-15 04:37:12'),
(108, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 04:38:49'),
(109, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 04:39:09'),
(110, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 04:40:01'),
(111, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-15 04:40:27'),
(112, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:40:39'),
(113, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:43:09'),
(114, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:43:23'),
(115, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:44:23'),
(116, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-15 04:44:31'),
(117, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:44:42'),
(118, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:45:20'),
(119, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:45:32'),
(120, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:46:08'),
(121, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:46:15'),
(122, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:46:19'),
(123, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:46:35'),
(124, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:46:35'),
(125, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:46:35'),
(126, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:46:36'),
(127, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:46:37'),
(128, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:49:07'),
(129, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:49:20'),
(130, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:50:26'),
(131, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:50:39'),
(132, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:52:12'),
(133, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:52:40'),
(134, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:53:24'),
(135, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:53:25'),
(136, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:53:42'),
(137, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:54:21'),
(138, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:54:32'),
(139, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:54:42'),
(140, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:54:47'),
(141, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:55:02'),
(142, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:55:15'),
(143, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:56:08'),
(144, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:56:16'),
(145, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:56:27'),
(146, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:56:31'),
(147, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:57:23'),
(148, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:57:40'),
(149, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:58:06'),
(150, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 04:59:29'),
(151, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:00:01'),
(152, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:00:09'),
(153, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:05:21'),
(154, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:06:18'),
(155, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:34:20'),
(156, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:34:41'),
(157, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:34:55'),
(158, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:35:17'),
(159, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:35:52'),
(160, 2, 'Reembolso do Ingresso, aviso prévio', 'Aprovado', '2024-11-15 05:36:00'),
(161, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-19 23:27:24'),
(162, 2, 'Reembolso do Ingresso e produtos do Snack Bar, aviso prévio', 'Aprovado', '2024-11-19 23:27:39'),
(163, 2, 'Qualquer reembolso mas sem pedido com antecedência', 'Negado', '2024-11-19 23:29:15');

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
(18, 'Fini Ursinhos 90g', 5.99, '../../images/fini11.png', 'guloseimas'),
(19, 'Fini Ovos Fritos', 2.99, '../../images/fini12.png', 'guloseimas'),
(20, 'Fini Tubes Morango', 4.99, '../../images/fini7.png', 'guloseimas'),
(21, 'Fini Tubes Ácido', 3.29, '../../images/fini8.png', 'guloseimas'),
(22, 'Fini Tubes Twister', 4.29, '../../images/fini10.png', 'guloseimas'),
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
(40, 'Cheetos Lua', 4.49, '../../images/snack6.png', 'snacks'),
(41, 'Doritos Sweet Chili 55g', 6.49, '../../images/snack7.png', 'snacks'),
(42, 'Fandangos Queijo 45g', 4.19, '../../images/snack8.png', 'snacks'),
(43, 'Pringles Original 120g', 14.99, '../../images/snack9.png', 'snacks'),
(44, 'Lays Original 45g', 5.99, '../../images/snack10.png', 'snacks'),
(45, 'Cebolitos 45g', 4.29, '../../images/snack11.png', 'snacks'),
(46, 'Baconzitos 45g', 4.49, '../../images/snack12.png', 'snacks'),
(47, 'Combo da Casa', 30.90, '../../images/combo1a.png', 'combos'),
(48, 'Combo Light & fit', 50.90, '../../images/combo2b.png', 'combos'),
(49, 'Combo Kids', 35.90, '../../images/combo3c.png', 'combos'),
(50, 'Combo Individual', 29.90, '../../images/combo4d.png', 'combos'),
(51, 'Combo Natalino', 43.90, '../../images/combo5e.png', 'combos'),
(52, 'Combo Halloween', 46.90, '../../images/combo6f.png', 'combos'),
(53, 'Combo Lovers', 38.90, '../../images/combo7g.png', 'combos'),
(54, 'Combo Gourmet', 59.90, '../../images/combo8h.png', 'combos'),
(55, 'Combo Tradicional', 32.90, '../../images/combo9.png', 'combos'),
(56, 'Pipoca Pequena', 8.90, '../../images/pipocap.png', 'combos'),
(57, 'Pipoca Média', 14.90, '../../images/pipocam.png', 'combos'),
(58, 'Pipoca Grande', 22.90, '../../images/pipocag.png', 'combos');

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
  `token_autenticacao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome_completo`, `genero`, `apelido`, `cpf`, `data_nascimento`, `usar_mesmo_cpf`, `email`, `telefone`, `senha`, `token_autenticacao`) VALUES
(2, 'izabele pereira', 'Feminino', 'izinha', '70218358920', '0000-00-00', 0, 'izabele2304@gmail.com', '991972304', '$2y$10$LQYx/PTUQvaF0cpuAScyoeUqWu7GWRykgUWbeq3vOPQ400l6Awm1i', '6529414a32670ce219d8c369af8507d5'),
(13, 'william', 'Masculino', 'will', '123.456.789-10', '0000-00-00', 0, 'will@gmail.com', '(16) 99789-5632', '$2y$10$6wmXl/uYFvV1JE5PeQqs6O.8JqEnzWg1jwU7eFM.gFQ.nu5OJQo.a', '4d28800011fa9b5a84f213d1b1a0fea0'),
(14, 'eita', 'Masculino', 'eita', '46235656565', '0000-00-00', 1, 'eita@gmail.com', '54654545465', '$2y$10$EsAPozLzfzRPAQRGs0q4kOfKHkHLa5tdyLUdtEObcGDL1h9k65qXa', NULL),
(15, 'iza', 'Masculino', 'izinha', '46546545465', '0000-00-00', 0, 'iza@gmail.com', '65645646546', '$2y$10$rkp.ZrQYQ.fph6ckNvn/UupiMFNvXrMpnkCriP2kQ35yE1IOeYUyu', NULL),
(16, 'oi', 'Feminino', 'ana', '65446546545', '0000-00-00', 0, 'cu@gmail.com', '66546545645', '$2y$10$dMNFbf5/XqoLaJv9Nsir1eiWl61KskW34YXd3xHCcO7cF/dVI.FvW', NULL),
(17, 'ida', 'Feminino', 'idinha', '45645645645', '0000-00-00', 0, 'ida@gmail.com', '22112132132', '$2y$10$.8yFbGO7EOjXv17tvRvgz.5HoYOX1wZrSqox4bbN.bkpWb0wFL4gu', NULL),
(18, 'julia', 'Feminino', 'ju', '45986523698', '0000-00-00', 1, 'ju@gmail.com', '54654654564', '$2y$10$tuXmuWbce/JdSHOTA25kgO/2bKbYdsvcIqVEeYAF7vm/Mk5aiICy2', NULL),
(19, 'enzo', 'Feminino', 'enzo', '32215664546', '0000-00-00', 1, 'enzo@gmail.com', '62661651651', '$2y$10$QfneqzzRlsTDGdzZzN8Y9e09gLEid3dHLjtDbIsrpyeCYthnF98PK', NULL),
(20, 'diogo', 'Masculino', 'dido', '51632894923', '0000-00-00', 0, 'di@gmail.com', '16988897523', '$2y$10$NQ.PzvWYb/P0TsWpeMrI7eN06pkJvWHH7FA3dPiOLW.Dr981./ZeK', NULL),
(21, 'aa', 'Masculino', 'aaa', '44444444444', '0000-00-00', 0, 'w@gmail.com', '55555555555', '$2y$10$zzi9DImJoSABXQuIOW8xq./RSk9q81c/Emar95gp2zkDQEK9dh/4S', 'a0ef56227175da8cf807a6f1dacffb34'),
(26, 'q', 'Feminino', 'q', '222.222.222-22', '0000-00-00', 0, 'b@gmail.com', '(33) 33333-3333', '$2y$10$KAFniyp66euz4fvWztKOeuDd0Q/thnDY9IyR.wUNec/WdH4dqlPri', NULL),
(28, 'q', 'Feminino', 'q', '111.111.111-11', '0000-00-00', 0, 'c@gmail.com', '(33) 33333-3333', '$2y$10$2V69N/XR4z4BEf69rgZyK.pyJHd7GPrjI/cqQtaR4aBXsFo8jGjiu', NULL),
(29, 'q', 'Feminino', 'q', '555.555.555-55', '0000-00-00', 0, 'd@gmail.com', '(33) 33333-3333', '$2y$10$APTq9OekYNbWfHF06YRQxu13O.pxp6kulaI44sNDKlyJZVe412yXy', '9510eb432c953f0d1319caf3ea512b90'),
(30, 'q', 'Feminino', 'q', '777.777.777-77', '0000-00-00', 0, 'e@gmail.com', '(33) 33333-3333', '$2y$10$O7PrgOdAtQcbzOmXKriq.Oc1BfV38nanap/OFtEmCuDR55RIQKRjW', NULL),
(37, 'diogo gay', 'Outro', 'diogo', '568.742.398-99', '0000-00-00', 0, 'diogo@gmail.com', '(16) 33359-8745', '$2y$10$Dk7qDEQhDAsEbMLwfTy1s.OU7ErKYDcwjD2dURpSU3zcmyQel0lCC', 'c8e152f1ab7c4d8fdcc5132031ddeeb9');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `pedidos_reembolso`
--
ALTER TABLE `pedidos_reembolso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de tabela `pedidos_reembolso`
--
ALTER TABLE `pedidos_reembolso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `pedidos_reembolso`
--
ALTER TABLE `pedidos_reembolso`
  ADD CONSTRAINT `pedidos_reembolso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
