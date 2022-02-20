-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2022 pada 17.45
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `winzelle`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `cartID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `cartSize` varchar(5) NOT NULL DEFAULT 's',
  `cartQty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cart`
--

INSERT INTO `cart` (`cartID`, `productID`, `userID`, `cartSize`, `cartQty`) VALUES
(4, 12, 2, '', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `categoryName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`) VALUES
(1, 'Top'),
(2, 'Pants'),
(3, 'Accessories'),
(4, 'Beauty');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contact`
--

CREATE TABLE `contact` (
  `contactID` int(11) NOT NULL,
  `contactEmail` varchar(255) NOT NULL,
  `contactName` varchar(255) NOT NULL,
  `contactText` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `contact`
--

INSERT INTO `contact` (`contactID`, `contactEmail`, `contactName`, `contactText`) VALUES
(1, 'coba@gmail.com', 'Michell', 'Selamat pagi, saya dengan email xxx tidak bisa login. Apakah anda bisa membantu?'),
(2, 'testing@gmail.com', 'panggil saja Alex', 'Alex need help');

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `orderID` int(11) NOT NULL,
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `orderQty` int(11) NOT NULL,
  `orderSize` varchar(5) DEFAULT NULL,
  `orderPayment` varchar(255) NOT NULL,
  `orderCourier` varchar(255) NOT NULL,
  `orderDate` date NOT NULL,
  `ratingID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`orderID`, `productID`, `userID`, `orderQty`, `orderSize`, `orderPayment`, `orderCourier`, `orderDate`, `ratingID`) VALUES
(1, 9, 2, 1, 'M', 'LinkAja', 'J&T Express', '2022-01-02', 1),
(2, 10, 2, 2, 'L', 'LinkAja', 'J&T Express', '2022-01-02', NULL),
(3, 14, 2, 2, '', 'LinkAja', 'J&T Express', '2022-01-02', NULL),
(4, 5, 3, 1, 'L', 'DANA', 'Sicepat', '2022-01-02', 2),
(5, 8, 4, 1, 'M', 'GoPay', 'JNE', '2022-01-02', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `productCount` int(11) DEFAULT 0,
  `productName` varchar(255) NOT NULL,
  `productPrice` int(11) NOT NULL,
  `productRating` int(11) NOT NULL DEFAULT 0,
  `productImage` varchar(255) NOT NULL,
  `productDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`productID`, `categoryID`, `productCount`, `productName`, `productPrice`, `productRating`, `productImage`, `productDesc`) VALUES
(5, 1, 3, 'White Crop Blazer', 200000, 4, 'atasan6.jpg', 'Korean White Crop Blazer Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, vero?'),
(6, 1, 6, 'Choco Long Blazer', 350000, 5, 'atasan7.jpg', 'Korean Choco Long Blazer Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, vero?'),
(7, 1, 3, 'White Shirt ', 120000, 0, 'atasan8.jpg', 'Korean White Shirt Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, vero?'),
(8, 1, 3, 'Yellow Sweater ', 150000, 5, 'atasan10.jpg', 'Korean Yellow Sweater Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, vero?'),
(9, 2, 6, 'Nude Hot Pants', 125000, 4, 'bawahan1.jpg', 'Korean Nude Hot Pants Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, vero?'),
(10, 2, 2, 'Black Hot Pants', 145000, 0, 'bawahan5.jpg', 'Black Hot Pants Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eos, adipisci.'),
(11, 3, 11, 'Butterfly Tape', 25000, 0, 'acc1.jpg', 'Butterfly Tape Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta repellendus, velit molestias labore sed culpa doloribus ab recusandae maxime ea?'),
(12, 3, 6, 'Scrunchies Rainbow', 20000, 3, 'acc7.jpg', 'Scrunchies Rainbow Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta repellendus, velit molestias labore sed culpa doloribus ab recusandae maxime ea?'),
(14, 4, 3, 'Eyeshadow Rainbow', 125000, 0, 'beauty4.jpg', 'Eyeshadow Rainbow Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta repellendus, velit molestias labore sed culpa doloribus ab recusandae maxime ea?'),
(15, 4, 0, 'Roll Face', 75000, 0, 'beauty6.jpg', 'Roll Face Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, vero?'),
(16, 1, 0, 'Black Crop Top', 160000, 0, 'atasan4.jpg', 'Black Crop Top Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, vero?'),
(17, 1, 0, 'White Blouse ', 210000, 0, 'atasan2.jpg', 'Korean White Blouse Lorem ipsum dolor sit, amet consectetur adipisicing elit. Blanditiis, vero?'),
(21, 4, 0, 'Lip Tint', 125000, 0, 'beauty8.png', 'Lip Tint Many desktop publishing packages and web page editors now use Lorem Ipsum as'),
(22, 2, 0, 'Black Hot Pants', 185000, 0, 'bawahan2.jpg', 'Korean Black Hot Pants Many desktop publishing packages and web page editors now use Lorem Ipsum as');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rating`
--

CREATE TABLE `rating` (
  `ratingID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `ratingNumb` int(11) DEFAULT 0,
  `ratingDesc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rating`
--

INSERT INTO `rating` (`ratingID`, `orderID`, `ratingNumb`, `ratingDesc`) VALUES
(1, 1, 4, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as'),
(2, 4, 4, 'Blazernya real pict ! Many desktop publishing packages and web page editors now use Lorem Ipsum as'),
(3, 5, 5, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userAddress` varchar(255) NOT NULL,
  `userProfile` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `userLevel` int(11) NOT NULL DEFAULT 0,
  `userSlug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`userID`, `userName`, `userEmail`, `userPassword`, `userAddress`, `userProfile`, `userLevel`, `userSlug`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$1qdgPhqW8IcA9A4lY0LFRO./1V.A2fSBcJ5iAkwMkOKkmyKTXw5Kq', 'Jakarta', 'default.jpg', 1, '$2y$10$NSrusM4cY0vCAvjBpYGsNOLaP92/mQ4CI8hy831.uFJnfiY7K292u'),
(2, 'Cecilia M', 'user@gmail.com', '$2y$10$EtnnLzoJm4sRZGzb2fupAu77x0hOrlo2hHb9Qs3jKDaauo0OOTkQW', 'Jakarta, Indonesia', 'default.jpg', 0, '$2y$10$VSFajNI.U39aquY3dyTDPe4zuxnHysmLzvOpbWWpqLI6wmoQy20bS'),
(3, 'Si Hyun', 'panggilsajaAlex@gmail.com', '$2y$10$lm9KE6WLSi3bojTI2fp2gelRipmEypsrfFVbMkV2LwT89lEHwcLjC', 'Korea', 'default.jpg', 0, '$2y$10$Xwh.5Z8.TiLxjLO78WIdN.Z4ETns1e9YdVJ9mLfU9vMjQEMT/uo2W'),
(4, 'SaeBom', 'yoonSae@gmail.com', '$2y$10$SNeWhmaIsRY7IMYt8HHaFO7YzdKojrVHiBeeaG09JNXqhTvdMpwpG', 'Korea', 'default.jpg', 0, '$2y$10$Om467TH0ssZtjnXhnG9GFulS6QVVa.Aphm1IPaQTv8TCm4/he7Kpe');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `userID` (`userID`);

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indeks untuk tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactID`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `productID` (`productID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `FK_Rating` (`ratingID`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`),
  ADD KEY `categoryID` (`categoryID`);

--
-- Indeks untuk tabel `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ratingID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `contactID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `rating`
--
ALTER TABLE `rating`
  MODIFY `ratingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`productID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
