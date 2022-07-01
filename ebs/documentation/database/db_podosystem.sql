-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09-Jul-2018 às 21:52
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_powerclinic`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_agends`
--

CREATE TABLE `tb_agends` (
  `id_agend` int(11) NOT NULL,
  `agend_hour` varchar(255) DEFAULT NULL,
  `agend_date` date DEFAULT NULL,
  `agend_local` varchar(255) DEFAULT NULL,
  `agend_status` varchar(1) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_agends`
--

INSERT INTO `tb_agends` (`id_agend`, `agend_hour`, `agend_date`, `agend_local`, `agend_status`, `client_id`, `service_id`, `user_id`) VALUES
(2, '9:45', '2018-06-22', 'sala 5', '1', 20, 6, 1),
(4, '17:00', '2018-06-27', 'sala 15', '0', 20, 2, 2),
(5, '9:00', '2018-06-26', 'sala de podologia', '0', 20, 2, 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_clients`
--

CREATE TABLE `tb_clients` (
  `id_client` int(11) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_phone` varchar(255) DEFAULT NULL,
  `client_cellphone` varchar(255) DEFAULT NULL,
  `client_cpf` varchar(255) DEFAULT NULL,
  `client_created_in` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `client_address` varchar(255) DEFAULT NULL,
  `client_birth` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_clients`
--

INSERT INTO `tb_clients` (`id_client`, `client_name`, `client_email`, `client_phone`, `client_cellphone`, `client_cpf`, `client_created_in`, `client_address`, `client_birth`) VALUES
(9, 'Fabio', 'fabio@email.com', '(85) 3233-2524', '(85) 99938-889', '123.123.129-11', '2017-12-12 03:00:00', 'Rua barueri, 54', '1977-11-11'),
(17, 'Rafaela a', 'rafa@email.com', '(85) 3223-2322', '(85) 96969-6969', '123.123.123-12', '2018-06-18 14:53:55', 'rua 10', '1985-11-19'),
(18, 'Gildo', 'g@g.com', '(85) 3333-2222', '(85) 96462-6366', '121.212.121-21', '2018-06-19 13:33:17', 'rua 23', '2000-04-14'),
(20, 'Fabio Silva', 'fsilva@email.com', '(85) 3322-1122', '(85) 99965-6666', '123.123.321-21', '2018-06-19 13:52:07', 'anjo branco', '2000-01-19'),
(21, 'gildo', 'gil@g.com', '(85) 3223-2322', '(85) 96969-6969', '111.111.111-12', '2018-06-20 13:25:43', 'rua 10', '2000-12-12'),
(22, 'eu', 'eu@eu.com', '(75) 6845-6465', '(48) 97879-4654', '894.654.645-65', '2018-06-20 14:41:44', '12313', '2011-10-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_profiles`
--

CREATE TABLE `tb_profiles` (
  `id_profile` int(11) NOT NULL,
  `profile_name` varchar(40) DEFAULT NULL,
  `profile_page` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_profiles`
--

INSERT INTO `tb_profiles` (`id_profile`, `profile_name`, `profile_page`) VALUES
(1, 'Administrador', 'admin'),
(2, 'Funcionario', 'func');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_services`
--

CREATE TABLE `tb_services` (
  `id_service` int(11) NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `service_desc` varchar(255) DEFAULT NULL,
  `service_price` float(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_services`
--

INSERT INTO `tb_services` (`id_service`, `service_name`, `service_desc`, `service_price`) VALUES
(2, 'Hemograma Completo', 'Coleta de Exames de Soro e Sangue', 55.99),
(4, 'Raio X', 'Pequeno', 100.00),
(5, 'Exame de urina', 'Teste ', 90.00),
(6, 'Hemograma Completo +', 'Completo', 200.00);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_users`
--

CREATE TABLE `tb_users` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `user_cellphone` varchar(255) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_cpf` varchar(255) DEFAULT NULL,
  `user_birth` date DEFAULT NULL,
  `user_created_in` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user_last_access` timestamp NULL DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tb_users`
--

INSERT INTO `tb_users` (`id_user`, `user_name`, `user_email`, `user_password`, `user_phone`, `user_cellphone`, `user_address`, `user_cpf`, `user_birth`, `user_created_in`, `user_last_access`, `profile_id`) VALUES
(1, 'Fabio Sousa', 'fabio@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '8532323232', '8596664622', 'rua 10', '19119119122', '2018-05-09', '2018-05-24 14:15:02', NULL, 1),
(2, 'Rafaela Costa', 'rafaela@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '(85) 3232-3221', '(85) 96666-666', 'rua do lago', '191.192.193-19', '2018-05-19', '2018-05-28 13:56:46', '2018-05-28 03:00:00', 2),
(8, 'Fabio Sousa', 'fabioalexandre_sousa@hotmail.com', '', '(85) 8585-8585', '(85) 96969-6969', 'rua do lago 200', '191.919.191-91', '1977-11-11', '2018-06-04 13:20:26', NULL, 2),
(9, 'Rita Armênia', 'rita@email.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '(85) 3232-5555', '(85) 99999-6666', 'rua do lago', '121.456.789-00', '1965-07-17', '2018-06-25 13:12:47', NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_agends`
--
ALTER TABLE `tb_agends`
  ADD PRIMARY KEY (`id_agend`),
  ADD KEY `client_id` (`client_id`,`service_id`,`user_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_clients`
--
ALTER TABLE `tb_clients`
  ADD PRIMARY KEY (`id_client`),
  ADD UNIQUE KEY `client_email` (`client_email`),
  ADD UNIQUE KEY `client_cpf` (`client_cpf`);

--
-- Indexes for table `tb_profiles`
--
ALTER TABLE `tb_profiles`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indexes for table `tb_services`
--
ALTER TABLE `tb_services`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_cpf` (`user_cpf`),
  ADD KEY `profile_id` (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_agends`
--
ALTER TABLE `tb_agends`
  MODIFY `id_agend` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_clients`
--
ALTER TABLE `tb_clients`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_profiles`
--
ALTER TABLE `tb_profiles`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_services`
--
ALTER TABLE `tb_services`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_agends`
--
ALTER TABLE `tb_agends`
  ADD CONSTRAINT `tb_agends_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `tb_clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_agends_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `tb_services` (`id_service`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_agends_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tb_users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `tb_users`
--
ALTER TABLE `tb_users`
  ADD CONSTRAINT `tb_users_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `tb_profiles` (`id_profile`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
