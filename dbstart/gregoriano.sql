-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 22, 2023 alle 16:33
-- Versione del server: 8.0.35-0ubuntu0.22.04.1
-- Versione PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gregoriano`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `greg_altezza_salti`
--

CREATE TABLE `greg_altezza_salti` (
  `ID` int NOT NULL,
  `nome` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `greg_altezza_salti`
--

INSERT INTO `greg_altezza_salti` (`ID`, `nome`) VALUES
(1, 'Terza minore'),
(2, 'Terza maggiore'),
(3, 'Quarta minore'),
(4, 'Quarta maggiore'),
(5, 'Quinta giusta'),
(6, 'Sesta minore'),
(7, 'Sesta maggiore'),
(8, 'Settima minore'),
(9, 'Settima maggiore'),
(10, 'Ottava');

-- --------------------------------------------------------

--
-- Struttura della tabella `greg_analisi`
--

CREATE TABLE `greg_analisi` (
  `ID` int NOT NULL,
  `canto_ID` int NOT NULL,
  `iniziale` int NOT NULL,
  `finale` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `greg_analisi`
--

INSERT INTO `greg_analisi` (`ID`, `canto_ID`, `iniziale`, `finale`) VALUES
(3, 2, 0, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `greg_analisi_note`
--

CREATE TABLE `greg_analisi_note` (
  `ID` int NOT NULL,
  `analisi_ID` int NOT NULL,
  `nota` int NOT NULL COMMENT '0 => ''DO'',\r\n        1 => ''RE'',\r\n        2 => ''MI'',\r\n        3 => ''FA'',\r\n        4 => ''SOL'',\r\n        5 => ''LA'',\r\n        6 => ''SI'',',
  `numero` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `greg_analisi_note`
--

INSERT INTO `greg_analisi_note` (`ID`, `analisi_ID`, `nota`, `numero`) VALUES
(2, 3, 0, 5),
(3, 3, 1, 0),
(4, 3, 2, 0),
(5, 3, 3, 0),
(6, 3, 4, 0),
(7, 3, 5, 0),
(8, 3, 6, 0),
(23, 3, 7, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `greg_canti`
--

CREATE TABLE `greg_canti` (
  `ID` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `descrizione` text NOT NULL,
  `modo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `greg_canti`
--

INSERT INTO `greg_canti` (`ID`, `nome`, `file`, `url`, `descrizione`, `modo`) VALUES
(2, 'Salve regina', NULL, NULL, '', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `greg_entrateUscite`
--

CREATE TABLE `greg_entrateUscite` (
  `ID` int NOT NULL,
  `abbr` varchar(3) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `greg_entrateUscite`
--

INSERT INTO `greg_entrateUscite` (`ID`, `abbr`, `nome`) VALUES
(1, 'DOG', 'Direzione opposta per grado'),
(2, 'DOS', 'Direzione opposta per salto'),
(3, 'MDG', 'Medesima direzione per salto');

-- --------------------------------------------------------

--
-- Struttura della tabella `greg_modi`
--

CREATE TABLE `greg_modi` (
  `ID` int NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `greg_modi`
--

INSERT INTO `greg_modi` (`ID`, `nome`) VALUES
(1, 'Primo modo');

-- --------------------------------------------------------

--
-- Struttura della tabella `greg_salti`
--

CREATE TABLE `greg_salti` (
  `ID` int NOT NULL,
  `analisi_ID` int NOT NULL,
  `altezza_id` int NOT NULL,
  `direzione` tinyint(1) NOT NULL COMMENT '1= ascendente\r\n2=discendente',
  `stile_entrata_ID` int DEFAULT NULL,
  `stile_uscita_ID` int DEFAULT NULL,
  `doppiosalto` int NOT NULL DEFAULT '0',
  `ordine` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `greg_salti`
--

INSERT INTO `greg_salti` (`ID`, `analisi_ID`, `altezza_id`, `direzione`, `stile_entrata_ID`, `stile_uscita_ID`, `doppiosalto`, `ordine`) VALUES
(12, 3, 6, 1, NULL, NULL, 1, 1),
(13, 3, 2, 2, NULL, NULL, 1, 2),
(14, 3, 1, 1, NULL, NULL, 1, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `greg_tipo_salto`
--

CREATE TABLE `greg_tipo_salto` (
  `ID` int NOT NULL,
  `nome` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dump dei dati per la tabella `greg_tipo_salto`
--

INSERT INTO `greg_tipo_salto` (`ID`, `nome`) VALUES
(1, 'DOG'),
(2, 'DOS'),
(3, 'NR'),
(4, 'MDG');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `greg_altezza_salti`
--
ALTER TABLE `greg_altezza_salti`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `greg_analisi`
--
ALTER TABLE `greg_analisi`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `greg_analisi_note`
--
ALTER TABLE `greg_analisi_note`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `analisiK` (`analisi_ID`);

--
-- Indici per le tabelle `greg_canti`
--
ALTER TABLE `greg_canti`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `greg_entrateUscite`
--
ALTER TABLE `greg_entrateUscite`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `greg_modi`
--
ALTER TABLE `greg_modi`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `greg_salti`
--
ALTER TABLE `greg_salti`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `altezzaFk` (`altezza_id`),
  ADD KEY `analisiFk` (`analisi_ID`) USING BTREE,
  ADD KEY `entrataFk` (`stile_entrata_ID`),
  ADD KEY `uscitaFk` (`stile_uscita_ID`);

--
-- Indici per le tabelle `greg_tipo_salto`
--
ALTER TABLE `greg_tipo_salto`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `greg_altezza_salti`
--
ALTER TABLE `greg_altezza_salti`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `greg_analisi`
--
ALTER TABLE `greg_analisi`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la tabella `greg_analisi_note`
--
ALTER TABLE `greg_analisi_note`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT per la tabella `greg_canti`
--
ALTER TABLE `greg_canti`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `greg_entrateUscite`
--
ALTER TABLE `greg_entrateUscite`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `greg_modi`
--
ALTER TABLE `greg_modi`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `greg_salti`
--
ALTER TABLE `greg_salti`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT per la tabella `greg_tipo_salto`
--
ALTER TABLE `greg_tipo_salto`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `greg_analisi_note`
--
ALTER TABLE `greg_analisi_note`
  ADD CONSTRAINT `analisiK` FOREIGN KEY (`analisi_ID`) REFERENCES `greg_analisi` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Limiti per la tabella `greg_salti`
--
ALTER TABLE `greg_salti`
  ADD CONSTRAINT `altezzaFk` FOREIGN KEY (`altezza_id`) REFERENCES `greg_altezza_salti` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `analisi` FOREIGN KEY (`analisi_ID`) REFERENCES `greg_analisi` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `entrataFk` FOREIGN KEY (`stile_entrata_ID`) REFERENCES `greg_entrateUscite` (`ID`),
  ADD CONSTRAINT `uscitaFk` FOREIGN KEY (`stile_uscita_ID`) REFERENCES `greg_entrateUscite` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
