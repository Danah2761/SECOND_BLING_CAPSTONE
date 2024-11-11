
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','super_admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


INSERT INTO `admin` (`admin_id`, `username`, `email`, `password`, `phone`, `role`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$12$jpeJLPrr804.v7QN/NMQzOxFAu6lF/OGI0oIGgGPtoGxG4PWhc.O6', '0556544333', 'super_admin'),
(2, 'zasipeqavo', 'late@mailinator.com', '$2y$10$hzkfO6Vm8w5ORTkCSQ7kpOVx14cBDiEs6BijS1R.aXva.C1agZ5MS', '0545444444', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `authenticators`
--

CREATE TABLE `authenticators` (
  `authenticator_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `id_number` varchar(20) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `authenticators`
--

INSERT INTO `authenticators` (`authenticator_id`, `admin_id`, `username`, `email`, `password`, `phone`, `id_number`, `address`) VALUES
(3, 1, 'sara', 'sara@auth.com', '$2y$10$24fXxiumzJQBll1zyu4JReEGWPr/mNFVNGJxZGhzr7EpEgGvYyQ16', '0578984747', '2752344564', 'jubaildd');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `admin_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `admin_id`) VALUES
(1, 'Rings', 1),
(2, 'Necklaces', 1),
(3, 'Bracelets', 1),
(4, 'Bracelet', 1),
(5, 'Anklets', 1),
(6, 'Pendants', 1),
(7, 'Bangles', 1),
(8, 'Brooches', 1),
(9, 'Chokers', 1),
(10, 'Cufflinks', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `admin_id` int DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `admin_id`, `email`, `password`, `phone`, `address`) VALUES
(1, 'Boris', 'Flowers', NULL, 'mugetak@mailinator.com', '$2y$10$BJwkUL5vAsjYpOEY95m61u1QaQNVn3Cm6iEbJNecHMsei32zjKCTO', '0545454444', 'Sed nemo nostrum vol'),
(2, 'Eagan', 'Molina', NULL, 'vatelid@mailinator.com', '$2y$10$XsjfSAcYQ06Y9WSizgjuEuE2HHO.v6hhqDEpsUl60ZSOC2eXagAeS', '0545444444', 'Facere commodo dolor'),
(3, 'Danahf', 'Al-Sedran', NULL, 'cus@cus.com', '$2y$10$76DUc.3Q5NVcDlOOnj6/dOgA1o6C79gjcls8LpDXOEI5FmbVSC7ya', '0576848888', 'الرياض شارع 23ddc');

-- --------------------------------------------------------

--
-- Table structure for table `deal`
--

CREATE TABLE `deal` (
  `deal_id` int NOT NULL,
  `customer_id` int DEFAULT NULL,
  `seller_id` int DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `deal_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_price` decimal(10,2) DEFAULT NULL,
  `deal_status` enum('pending','shipped','delivered','canceled') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `deal`
--

INSERT INTO `deal` (`deal_id`, `customer_id`, `seller_id`, `admin_id`, `deal_date`, `total_price`, `deal_status`) VALUES
(17, 3, 2, 1, '2024-11-02 19:13:41', '600.00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `deal_item`
--

CREATE TABLE `deal_item` (
  `deal_item_id` int NOT NULL,
  `deal_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int NOT NULL,
  `deal_id` int DEFAULT NULL,
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_method` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `seller_id` int DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text,
  `category_id` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `authenticity_certificate` tinyint(1) DEFAULT NULL,
  `stock_quantity` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `seller_id`, `product_name`, `image`, `description`, `category_id`, `price`, `authenticity_certificate`, `stock_quantity`) VALUES
(2, 2, 'Messika Diamond Bangle', 'uploads/1.jpg', '<p>A stunning necklace with delicate chains and sparkling gemstones. The perfect accessory to elevate any outfit. Available in various styles and colors.</p>', 4, '868.00', 1, 0),
(3, 2, 'Dior Diamond Necklace', 'uploads/2.jpeg', '<p>Messika\'s Love Drop Earrings are a stunning piece of jewelry. Featuring a delicate diamond-encrusted drop, these earrings add a touch of glamour to any outfit. The timeless design and exceptional craftsmanship make them a cherished piece for any jewelry collection.</p>', 2, '426.00', 1, 0),
(9, 2, 'Mesmera Y Necklace', 'uploads/3.jpg', 'This fascinating Y-shaped necklace is a bold testament to Swarovski’s expertise. Its rhodium-plated design comes to life with crystal settings in all sizes and in an infinite number of shapes. To enhance this sophisticated design, the extension is adorned with a Swarovski Zirconia, while a lobster clasp allows it to be perfectly adjusted to suit your desired style. The perfect piece to add some sparkle to your party look', 2, '2500.00', 1, 1),
(10, 2, 'Graff Warparound Diamond Bangle\n', 'uploads/4.jpg', 'A beautiful heart-shaped pendant made of solid 22k gold. This necklace is perfect for expressing love and affection, with its elegant design and fine craftsmanship.', 3, '1800.00', 1, 0),
(11, 2, 'Sabrina ArtCarved Diamond Ring', 'uploads/5.jpg', 'This exquisite bracelet features an array of emerald-cut emerald stones set in 18k yellow gold. It is a perfect blend of classic design and vibrant color, ideal for formal occasions.', 6, '3200.00', 0, 1),
(12, 2, 'Tiffany and Co. Diamond Ring ', 'uploads/6.jpg', 'Elegant pearl drop earrings featuring freshwater pearls and diamonds set in sterling silver. These earrings offer a sophisticated look for evening events or casual wear.', 1, '450.00', 1, 0),
(13, 2, 'Robinson’s Ninacci Dangling Earrings', 'uploads/7.jpg', 'A radiant ruby pendant framed with diamonds, suspended from a delicate 18k white gold chain. This exquisite piece makes a perfect gift for someone special.', 6, '2100.00', 1, 0),
(14, 2, 'Madeline Garrett', 'uploads/dummy-slug-2024-11-01-67250027565ee.jpg', '<p>Asperiores laboris e.qweq</p>', 8, '677.00', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_authentication`
--

CREATE TABLE `product_authentication` (
  `authentication_id` int NOT NULL,
  `product_id` int DEFAULT NULL,
  `authentication_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `authenticity_status` enum('valid','invalid') DEFAULT NULL,
  `admin_id` int DEFAULT NULL,
  `authenticator_id` int DEFAULT NULL,
  `notes` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `product_authentication`
--

INSERT INTO `product_authentication` (`authentication_id`, `product_id`, `authentication_date`, `authenticity_status`, `admin_id`, `authenticator_id`, `notes`) VALUES
(1, 9, '2024-11-01 14:36:20', 'invalid', 1, 3, 'sdasdasdwefasd'),
(2, 2, '2024-09-17 07:17:48', 'invalid', 1, NULL, 'wef'),
(3, 10, '2024-10-16 08:32:07', 'valid', NULL, 3, 'esf'),
(4, 3, '2024-11-01 14:36:14', 'invalid', NULL, 3, 'sadsasd'),
(5, 12, '2024-11-01 14:36:26', 'invalid', NULL, 3, 'asd'),
(6, 13, '2024-11-01 14:36:33', 'valid', NULL, 3, 'asd'),
(7, 14, '2024-11-01 15:27:31', 'valid', NULL, 3, 'werwerewr