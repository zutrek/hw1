-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 05, 2024 alle 23:49
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homework`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrelli`
--

CREATE TABLE `carrelli` (
  `id` int(11) NOT NULL,
  `id_utente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `carrelli`
--

INSERT INTO `carrelli` (`id`, `id_utente`) VALUES
(1, 9),
(3, 19);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `marca` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `memoria` varchar(255) DEFAULT NULL,
  `colore` varchar(255) NOT NULL,
  `prezzo` float NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `img1` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`id`, `categoria`, `marca`, `nome`, `memoria`, `colore`, `prezzo`, `img`, `img1`) VALUES
(1, 'telefonia', 'Apple', 'Iphone 15 Pro Max', '256GB', 'Nero', 1500, NULL, NULL),
(2, 'telefonia', 'Apple', 'Iphone 15 Pro Max', '256GB', 'Titanio Naturale', 1500, NULL, NULL),
(3, 'telefonia', 'Apple', 'Iphone 15 Pro Max', '256GB', 'Titanio Blu', 1500, NULL, NULL),
(4, 'telefonia', 'Apple', 'Iphone 12 ', '64GB', 'Verde', 600, NULL, NULL),
(5, 'telefonia', 'Apple', 'Iphone 11 ', '128GB', 'Bianco', 500, NULL, NULL),
(6, 'telefonia', 'Apple', 'Iphone 11 ', '128GB', 'Nero', 500, NULL, NULL),
(7, 'telefonia', 'Apple', 'Iphone 15 Pro ', '128GB', 'Titanio Bianco', 1200, NULL, NULL),
(8, 'telefonia', 'Apple', 'Iphone 15 Plus ', '128GB', 'Nero', 1300, NULL, NULL),
(9, 'telefonia', 'Samsung', 'Galaxy S24 ULTRA', '256GB', 'Grigio', 1000, NULL, NULL),
(10, 'telefonia', 'Samsung', 'Galaxy A55', '256GB', 'Giallo', 400, NULL, NULL),
(11, 'telefonia', 'Samsung', 'Galaxy A55', '256GB', 'Blu Scuro', 400, NULL, NULL),
(12, 'telefonia', 'Samsung', 'Galaxy S24', '256GB', 'Giallo', 800, NULL, NULL),
(13, 'telefonia', 'Samsung', 'Galaxy S24+', '256GB', 'Viola', 800, NULL, NULL),
(14, 'telefonia', 'Samsung', 'Galaxy S23', '128GB', 'Menta', 600, NULL, NULL),
(15, 'notebook', 'Lenovo', 'Essential V15-82', '256GB', 'Nero', 300, NULL, NULL),
(16, 'notebook', 'Lenovo', 'Essential V15-G2', '256GB', 'Nero', 200, NULL, NULL),
(17, 'smartwatch', 'Apple', 'Watch', '41mm', 'Bianco', 100, NULL, NULL),
(18, 'smartwatch', 'Samsung', 'Watch 6', '40mm', 'Grigio', 200, NULL, NULL),
(19, 'smartwatch', 'Huawei', 'Watch GT4', '41mm', 'Bianco', 0, NULL, NULL),
(20, 'console', 'Sony', 'Playstation 5', '1TB', 'Bianco', 700, NULL, NULL),
(21, 'console', 'Microsoft', 'Xbox serie S', '1TB', 'Nero', 650, NULL, NULL),
(22, 'tablet', 'Apple', 'Ipad 10.9', '64GB', 'Argento', 300, NULL, NULL),
(23, 'tablet', 'Apple', 'Ipad Pro', '256GB', 'Argento', 100, NULL, NULL),
(24, 'tablet', 'Samsung', 'Galaxy Tab S9', '128GB', 'Grigio', 500, NULL, NULL),
(25, 'tablet', 'Samsung', 'Galaxy tab S6 lite', '64GB', 'Argento', 250, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti_carrello`
--

CREATE TABLE `prodotti_carrello` (
  `id_carrello` int(11) DEFAULT NULL,
  `id_prodotto` int(11) DEFAULT NULL,
  `data_aggiunta` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `prodotti_carrello`
--

INSERT INTO `prodotti_carrello` (`id_carrello`, `id_prodotto`, `data_aggiunta`) VALUES
(3, 2, NULL),
(3, 3, NULL),
(3, 5, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `cognome`, `email`, `password`) VALUES
(9, 'gabriele', 'zinnari', 'gabrielezinnari@hotmail.it', '$2y$10$70XDlw1SFderYm6z/uL8I.3fFooGPb8dr2bCKb3xV8JCp2if57FsS'),
(19, 'giorgio', 'panariello', 'gabrisuper73@gmail.com', '$2y$10$GkGu3DvvLyKCOxskbsns0eaIOHYJT0M6.1WUv3xkTE2Xb4WuHUvTi');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrelli`
--
ALTER TABLE `carrelli`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_utente` (`id_utente`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `prodotti_carrello`
--
ALTER TABLE `prodotti_carrello`
  ADD KEY `id_carrello` (`id_carrello`),
  ADD KEY `id_prodotto` (`id_prodotto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `carrelli`
--
ALTER TABLE `carrelli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrelli`
--
ALTER TABLE `carrelli`
  ADD CONSTRAINT `carrelli_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `utenti` (`id`);

--
-- Limiti per la tabella `prodotti_carrello`
--
ALTER TABLE `prodotti_carrello`
  ADD CONSTRAINT `prodotti_carrello_ibfk_1` FOREIGN KEY (`id_carrello`) REFERENCES `carrelli` (`id`),
  ADD CONSTRAINT `prodotti_carrello_ibfk_2` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
