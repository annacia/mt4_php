-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Jun-2018 às 05:10
-- Versão do servidor: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mt4`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dispositivo`
--

CREATE TABLE `dispositivo` (
  `pkDispositivo` int(11) NOT NULL,
  `createdDispositivo` datetime DEFAULT NULL,
  `modifiedDispositivo` datetime DEFAULT NULL,
  `idDispositivo` int(11) NOT NULL,
  `hostname` char(24) NOT NULL,
  `ip` varchar(12) NOT NULL,
  `fkTipo` int(11) NOT NULL,
  `fkFabricante` int(11) NOT NULL,
  `fkModelo` int(11) NOT NULL,
  `fkUsuario` int(11) NOT NULL,
  `ativoDispositivo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `dispositivo`
--

INSERT INTO `dispositivo` (`pkDispositivo`, `createdDispositivo`, `modifiedDispositivo`, `idDispositivo`, `hostname`, `ip`, `fkTipo`, `fkFabricante`, `fkModelo`, `fkUsuario`, `ativoDispositivo`) VALUES
(14, '2018-06-01 01:56:34', '2018-06-01 02:01:03', 23, 'nTkxt9qtqBVCjRCDsT5nTA==', '127.162.2.1', 12, 7, 9, 12, 1),
(15, '2018-06-01 01:58:08', NULL, 3, 'cnVD1iWDKNbTyqZc8Dar3Q==', '123.142.9.1', 13, 8, 10, 13, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

CREATE TABLE `fabricante` (
  `pkFabricante` int(11) NOT NULL,
  `createdFabricante` datetime DEFAULT NULL,
  `modifiedFabricante` datetime DEFAULT NULL,
  `nomeFabricante` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fabricante`
--

INSERT INTO `fabricante` (`pkFabricante`, `createdFabricante`, `modifiedFabricante`, `nomeFabricante`) VALUES
(1, '2018-05-28 19:15:20', NULL, 'Cisco'),
(6, '2018-06-01 01:55:28', NULL, 'TP-Link'),
(7, '2018-06-01 01:56:34', NULL, 'Siemens'),
(8, '2018-06-01 01:58:08', NULL, 'Teleindustria');

-- --------------------------------------------------------

--
-- Estrutura da tabela `log`
--

CREATE TABLE `log` (
  `pkLog` int(11) NOT NULL,
  `createdLog` datetime DEFAULT NULL,
  `resultado` varchar(50) NOT NULL,
  `fkDispositivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `log`
--

INSERT INTO `log` (`pkLog`, `createdLog`, `resultado`, `fkDispositivo`) VALUES
(14, '2018-06-01 02:04:38', '<br> Login realizado com sucesso <br> WHOAMI: nick', 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo`
--

CREATE TABLE `modelo` (
  `pkModelo` int(11) NOT NULL,
  `createdModelo` datetime DEFAULT NULL,
  `modifiedModelo` datetime DEFAULT NULL,
  `nomeModelo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo`
--

INSERT INTO `modelo` (`pkModelo`, `createdModelo`, `modifiedModelo`, `nomeModelo`) VALUES
(2, '2018-05-28 19:26:49', NULL, 'Multigigabit 24-port switches'),
(8, '2018-06-01 01:55:28', NULL, 'Modelo de teste'),
(9, '2018-06-01 01:56:34', NULL, 'Modelo de teste 2'),
(10, '2018-06-01 01:58:07', NULL, 'Modelo de teste 3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo`
--

CREATE TABLE `tipo` (
  `pkTipo` int(11) NOT NULL,
  `createdTipo` datetime DEFAULT NULL,
  `modifiedTipo` datetime DEFAULT NULL,
  `nomeTipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo`
--

INSERT INTO `tipo` (`pkTipo`, `createdTipo`, `modifiedTipo`, `nomeTipo`) VALUES
(11, '2018-06-01 01:55:28', NULL, 'Repetidor'),
(12, '2018-06-01 01:56:34', NULL, 'Servidor'),
(13, '2018-06-01 01:58:07', NULL, 'Roteador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `pkUsuario` int(11) NOT NULL,
  `createdUsuario` datetime DEFAULT NULL,
  `modifiedUsuario` datetime DEFAULT NULL,
  `nomeUsuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`pkUsuario`, `createdUsuario`, `modifiedUsuario`, `nomeUsuario`) VALUES
(11, '2018-06-01 01:55:29', NULL, 'carol'),
(12, '2018-06-01 01:56:34', NULL, 'nick'),
(13, '2018-06-01 01:58:08', NULL, 'cams');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD PRIMARY KEY (`pkDispositivo`),
  ADD UNIQUE KEY `ip` (`ip`),
  ADD KEY `fabricanteDispositivo` (`fkFabricante`),
  ADD KEY `modeloDispositivo` (`fkModelo`),
  ADD KEY `tipoDispositivo` (`fkTipo`),
  ADD KEY `usuarioDispositivo` (`fkUsuario`);

--
-- Indexes for table `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`pkFabricante`),
  ADD UNIQUE KEY `nomeFabricante` (`nomeFabricante`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`pkLog`),
  ADD KEY `dispositivoLog` (`fkDispositivo`);

--
-- Indexes for table `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`pkModelo`),
  ADD UNIQUE KEY `nomeModelo` (`nomeModelo`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`pkTipo`),
  ADD UNIQUE KEY `nomeTipo` (`nomeTipo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`pkUsuario`),
  ADD UNIQUE KEY `nomeUsuario` (`nomeUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dispositivo`
--
ALTER TABLE `dispositivo`
  MODIFY `pkDispositivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `pkFabricante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `pkLog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `modelo`
--
ALTER TABLE `modelo`
  MODIFY `pkModelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `pkTipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `pkUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `dispositivo`
--
ALTER TABLE `dispositivo`
  ADD CONSTRAINT `fabricanteDispositivo` FOREIGN KEY (`fkFabricante`) REFERENCES `fabricante` (`pkFabricante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `modeloDispositivo` FOREIGN KEY (`fkModelo`) REFERENCES `modelo` (`pkModelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tipoDispositivo` FOREIGN KEY (`fkTipo`) REFERENCES `tipo` (`pkTipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarioDispositivo` FOREIGN KEY (`fkUsuario`) REFERENCES `usuario` (`pkUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `dispositivoLog` FOREIGN KEY (`fkDispositivo`) REFERENCES `dispositivo` (`pkDispositivo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
