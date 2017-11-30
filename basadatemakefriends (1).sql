-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 30 Lis 2017, 19:32
-- Wersja serwera: 10.1.26-MariaDB
-- Wersja PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `basadatemakefriends`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `makefriends`
--

CREATE TABLE `makefriends` (
  `id` int(11) NOT NULL,
  `login` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `email` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `birthday` date NOT NULL,
  `city` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `province` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `makefriends`
--

INSERT INTO `makefriends` (`id`, `login`, `email`, `password`, `name`, `birthday`, `city`, `province`) VALUES
(1, 'kornik', 'korniktablet@gmail.com', 'root', 'Dawid', '1998-07-01', 'Wygwizd?w', 'Ma?opolska'),
(3, 'dawidek', 'dawidek@gmail.com', '$2y$10$CiovDGOKqmBPYm.tjp3SHOftQQaLh0UWo/gYLfNW7eb0OWuQyv7n6', 'dawidek', '1998-01-07', 'dasda', 'dawqdas'),
(5, 'szymon1088', 'szymonzalarski98@gmail.com', '$2y$10$2dbhnvbDoTKppAFXfx4OZukRUGV/1VbVfPJGyFCEfLFh6V9cxZRbm', 'Szymon Zalarski', '1998-10-23', 'ChrzanÃ³w', 'MaÅ‚opolskie');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `makefriends`
--
ALTER TABLE `makefriends`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `makefriends`
--
ALTER TABLE `makefriends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
