-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Abr-2023 às 22:12
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `southnetwork`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `followers`
--

CREATE TABLE `followers` (
  `operation_id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `followed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `followers`
--

INSERT INTO `followers` (`operation_id`, `follower_id`, `followed_id`) VALUES
(1, 1005, 1006),
(2, 1006, 1004),
(3, 1006, 1005);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `post_description` varchar(255) NOT NULL,
  `post_image` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`post_id`, `author_id`, `post_description`, `post_image`, `date`) VALUES
(1023, 1005, 'nova foto de perfil.', '644723acdaa0f.jpg', '2023114024633'),
(1024, 1004, 'rio de janeiro é muito lindo.', '644739c2cbf59.jpg', '2023114042402'),
(1035, 1004, 'salve', '6447d2afe7aa0.jpg', '2023114151631'),
(1042, 1004, 'south', '6448286e342e2.png', '2023114212222');

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_comments`
--

CREATE TABLE `post_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `comment_text` varchar(255) NOT NULL,
  `comment_answers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `post_comments`
--

INSERT INTO `post_comments` (`comment_id`, `post_id`, `author_name`, `comment_text`, `comment_answers`) VALUES
(19, 1023, 'josue', 'salve mano, tudo bem com você meu amigo?', NULL),
(20, 1023, 'joao_lima', 'é noises', NULL),
(21, 1041, 'joao_lima', 'test', NULL),
(22, 1041, 'joao_lima', 'Salve mano', NULL),
(23, 1042, 'joao_lima', 'south né pai', NULL),
(24, 1042, 'joao_lima', 'não tem jeito', NULL),
(25, 1042, 'joao_lima', 'fala do homen', NULL),
(26, 1042, 'joao_lima', 'teste de texto ', NULL),
(27, 1042, 'joao_lima', 'se passar do ponto deve cortar ', NULL),
(28, 1042, 'joao_lima', 'deveria cortar, vamos ver se funciona, fiquem ligados ai em', NULL),
(29, 1042, 'joao_lima', 'tem que ver tbm questão de foto, tá meio sla', NULL),
(30, 1042, 'joao_lima', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20', NULL),
(31, 1042, 'joao_lima', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20', NULL),
(32, 1042, 'joao_lima', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20', NULL),
(33, 1042, 'joao_lima', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20', NULL),
(34, 1042, 'joao_lima', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20', NULL),
(35, 1042, 'joao_lima', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20', NULL),
(36, 1035, 'joao_lima', 'é isso ', NULL),
(37, 1023, 'josue', 'oi', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `post_likes`
--

CREATE TABLE `post_likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `post_likes`
--

INSERT INTO `post_likes` (`like_id`, `user_id`, `post_id`) VALUES
(13, 1005, 1023),
(49, 1005, 1024),
(61, 1004, 1035),
(62, 1004, 1024),
(63, 1004, 1042);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profiles`
--

CREATE TABLE `profiles` (
  `user_id` int(20) NOT NULL,
  `profile_bio` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `profiles`
--

INSERT INTO `profiles` (`user_id`, `profile_bio`, `profile_image`) VALUES
(1004, '<i class=\"fa-solid fa-code\"></i> Programador profissional, não acredita? Eu fiz esse site <i class=\"fa-solid fa-thumbs-up\"></i>', ''),
(1005, 'é nois mano!', '6447236a6217a.jpg'),
(1006, 'é noise', ''),
(1007, 'Programador ', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`) VALUES
(1004, 'joao_lima', 'joaoperolima1508@gmail.com', '$2a$08$NzQ1MDc2NDkyNjQ0NWFkO.Ns8LtTNFElIwpG8JF6mUrUFRYVdyLeq'),
(1005, 'pereira1508', 'joaopedrolima1508@hotmail.com', '$2a$08$MjEwMDgwMzQxNzY0NDVjO.rGqtJqE0M/P33iSxtt9CR9fT2oN6qra'),
(1006, 'josue', 'jplimapereira123@gmail.com', '$2a$08$MTY3ODIzMDIwMDY0NDVkN.X4p6GXy8RK1W8oZTW7MrEu73LF7RCLC'),
(1007, 'south_1508', 'ramonaraujolima897@gmail.com', '$2a$08$MTI4MTYyNDA2MjY0NDZhOOjaGMa/DF/W5/HmZuI6lpqTspfJoVVU.');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`operation_id`);

--
-- Índices para tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Índices para tabela `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Índices para tabela `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Índices para tabela `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`user_id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `followers`
--
ALTER TABLE `followers`
  MODIFY `operation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1045;

--
-- AUTO_INCREMENT de tabela `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
