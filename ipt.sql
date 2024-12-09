-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 06:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipt`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories_tbl`
--

CREATE TABLE `categories_tbl` (
  `id` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_tbl`
--

CREATE TABLE `orders_tbl` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(5) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details_tbl`
--

CREATE TABLE `order_details_tbl` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_tbl`
--

CREATE TABLE `products_tbl` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `category` varchar(100) NOT NULL,
  `subcategory` varchar(255) NOT NULL,
  `thumbnail_1` varchar(255) NOT NULL,
  `thumbnail_2` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products_tbl`
--

INSERT INTO `products_tbl` (`id`, `product_name`, `description`, `quantity`, `price`, `image_url`, `created_at`, `modified_at`, `category`, `subcategory`, `thumbnail_1`, `thumbnail_2`) VALUES
(7, 'S24 ULTRA 5G 12/256GB T.VLT SAMSUNG SM-S928 GALAXY', 'The Samsung Galaxy S24 Ultra 5G (SM-S928) is a powerhouse smartphone featuring 12GB of RAM, 256GB of storage, and cutting-edge performance. With its sleek Titanium Violet finish, this device combines premium design with advanced 5G connectivity.', 99999999, 84990.00, 'id7.png', '2024-11-26 13:32:10', '0000-00-00 00:00:00', 'mobile', '0', 'id7.png', 'id7.7.png'),
(8, 'S24+ 12/256GB M. GRAY SAMSUNG SM-S926 GALAXY', 'Experience ultimate performance with the Samsung Galaxy S24+ featuring a sleek Metal Gray finish, 12GB of RAM, and 256GB of storage for seamless multitasking and ample space. ', 99999999, 68990.00, 'id8.png', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'mobile', '0', 'id8.png', 'id8.8.png'),
(9, 'S24+ 12/256GB O. BLK SAMSUNG SM-S926 GALAXY', 'The Samsung Galaxy S24+ 12/256GB in Phantom Black (SM-S926) combines sleek design with powerful performance, featuring a 6.7-inch Dynamic AMOLED display, a robust Snapdragon 8 Gen 3 processor, and 12GB RAM for seamless multitasking.', 99999999, 68990.00, 's24 256gb 0 black samsung.png', '2024-11-25 03:55:58', '2024-11-26 03:55:58', 'mobile', '0', 's24 256gb 0 black samsung.png', 's24 256gb 0 black samsung BACK.png'),
(10, 'IPHONE 16 256GB BLACK APPLE', 'The iPhone 16 256GB in sleek Black offers exceptional performance with Apple\'s latest technology, featuring a stunning display, advanced camera system, and powerful A-series chip. ', 9999999, 63370.00, 'iphone 16 256gb black.png', '2024-11-25 03:55:58', '2024-11-26 03:55:58', 'mobile', '0', 'iphone 16 256gb black.png', 'iphone 16 256gb black back.png'),
(11, 'IPHONE 16 128GB ULTRAMARINE APPLE', 'The iPhone 16 128GB in Ultramarine delivers cutting-edge performance with a sleek design, offering vibrant visuals on its advanced display and a powerful camera system for stunning photos and videos.', 99999999, 56210.00, 'iphone 16 128gb blue.png', '2024-11-26 00:23:29', '2024-11-26 07:23:29', 'mobile', '0', 'iphone 16 128gb blue.png', 'iphone 16 128gb blue back1.png'),
(12, 'IPHONE 15 PRO 256GB WHITE TITNM APPLE', 'The iPhone 15 Pro 256GB in White Titanium combines cutting-edge technology with a sleek, lightweight titanium design. It features a powerful A17 Pro chip, advanced camera capabilities, and ample storage for all your apps, photos, and videos.', 9999999, 68990.00, 'iphone 15 pro 256gb white.png', '2024-11-26 00:23:29', '2024-11-26 07:23:29', 'mobile', '0', 'iphone 15 pro 256gb white.png', 'iphone 15 pro 256gb whiten back.png'),
(13, 'LED-32STG5500 SKYWORTH 32`` GOOGLE 2K HD TV', 'The SKYWORTH LED-32STG5500 is a 32-inch Google-powered smart TV offering vibrant 2K HD resolution for crisp, lifelike visuals. With built-in Google services and apps, it delivers seamless streaming, voice control, and a user-friendly interface.', 99999999, 10990.00, 'LED-32STG5500 SKYWORTH 32.png', '2024-11-26 03:09:48', '2024-11-26 03:09:48', 'television', '0', 'LED-32STG5500 SKYWORTH 32.png', 'LED-32STG5500 SKYWORTH 32 SIDE.png'),
(14, 'LED-65LN70G SKYWORTH 65`` WALL PAPER GOOGLE 4K TV', 'The SKYWORTH LED-65LN70G is a sleek 65\" Wallpaper Google 4K TV that delivers stunning ultra-high-definition visuals with vibrant colors and sharp detail. Featuring a slim design, built-in Google Assistant, and access to a wide range of apps.', 9999999, 52990.00, 'LED-65LN70G SKYWORTH 65.png', '2024-11-26 03:09:48', '2024-11-26 03:09:48', 'television', '0', 'LED-65LN70G SKYWORTH 65.png', 'LED-65LN70G SKYWORTH 65 SIDE.png'),
(15, 'OLED65C4PSA LG 65\" OLED EVO 4K UHD THINQ AI TV', 'The OLED65C4PSA LG 65\" OLED EVO 4K UHD TV delivers stunning visuals with deep blacks, vibrant colors, and incredible detail thanks to its advanced OLED EVO technology. Equipped with ThinQ AI, it offers seamless voice control and immersive entertainment ex', 99999999, 80294.50, 'LG oled evo 4k uhd thinq ai tv.png', '2024-11-26 03:16:20', '2024-11-26 03:16:20', 'television', '0', 'LG oled evo 4k uhd thinq ai tv.png', 'LG oled evo 4k uhd thinq ai tv side.png'),
(16, 'QA65QN87DAGXXP SAMSUNG 65\" NEO QLED 4K SMART TV', 'The Samsung QA65QN800DGXXP is a stunning 65\" Neo QLED 8K Smart TV that delivers unparalleled clarity, vibrant colors, and exceptional detail with its Quantum Matrix Technology and advanced AI upscaling.', 9999999, 120990.00, 'samsung neo qled 4k.png', '2024-11-26 03:16:20', '2024-11-26 03:16:20', 'television', '0', 'samsung neo qled 4k.png', 'samsung neo qled 4k back.png'),
(17, 'QA65QN800DGXXP SAMSUNG 65\" NEO QLED 8K SMART TV', 'The Sony XR-65X90L is a stunning 65\" Full Array 4K HDR LED TV powered by the advanced Cognitive Processor XR, delivering exceptional picture clarity, vibrant colors, and immersive contrast. ', 9999999, 219990.00, 'SAMSUNG NEO QLED 8K.png', '2024-11-26 03:16:20', '2024-11-26 03:16:20', 'television', '0', 'SAMSUNG NEO QLED 8K.png', 'SAMSUNG NEO QLED 8K side.png'),
(18, 'XR-65X90L SONY 65\" FULL ARRAY 4K HDR LED GOOGLE TV', 'The Sony XR-65X90L is a stunning 65\" Full Array 4K HDR LED TV powered by the advanced Cognitive Processor XR, delivering exceptional picture clarity, vibrant colors, and immersive contrast. ', 9999999, 74990.00, 'SONY FULL ARRAY 4K HDR LED GOOGLE TV.png', '2024-11-26 03:16:20', '2024-11-26 03:16:20', 'television', '0', 'SONY FULL ARRAY 4K HDR LED GOOGLE TV.png', 'SONY FULL ARRAY 4K HDR LED GOOGLE TV1.png'),
(19, 'LED-40S5402A TCL 40\" ANDROID TV WITH VOICE ASSIST', 'The TCL LED-40S5402A is a 40\" Android TV that delivers stunning Full HD visuals and seamless streaming with built-in Google Assistant for hands-free voice control. ', 9999999, 12995.00, 'TCL LED-40S5402A TCL 40.png', '2024-11-26 03:16:20', '2024-11-26 03:16:20', 'television', '0', 'TCL LED-40S5402A TCL 40.png', 'TCL LED-40S5402A TCL 40 SIDE.png'),
(20, 'LED-65C69B PRO TCL 65\" GOOGLE QLED 4K TV W/ LOCAL', 'The LED-65C69B PRO by TCL is a stunning 65-inch Google QLED 4K TV that delivers vibrant colors, sharp contrasts, and superior picture quality with local dimming technology.', 99999999, 41990.00, 'TCL LED-65C69B PRO TCL 65.png', '2024-11-26 03:25:04', '2024-11-26 03:25:04', 'television', '0', 'TCL LED-65C69B PRO TCL 65.png', 'TCL LED-65C69B PRO TCL 65 SIDE.png'),
(21, '42/38CEP024308 CARRIER 2.5HP SPLIT INV AC AURA', 'The Carrier 42/38CEP024308 is a high-efficiency 2.5HP Split Inverter Air Conditioner designed for optimal cooling performance with reduced energy consumption.', 99999999, 62100.00, '1. CARRIER 2.5HP SPLIT INV AC AURA.png', '2024-11-26 03:26:20', '2024-11-26 03:26:20', 'aircondition', '0', '1. CARRIER 2.5HP SPLIT INV AC AURA.png', '1.1 CARRIER 2.5HP SPLIT INV AC AURA.png'),
(22, '42/38CAC012308 CARRIER 1.5HP SPLIT INV AC OPTIMA', 'The 42/38CAC012308 Carrier 1.5HP Split Inverter Air Conditioner Optima offers efficient cooling with advanced inverter technology, ensuring energy savings while maintaining consistent temperature control. ', 9999999, 29900.00, '2. CARRIER 1.5HP SPLIT INV AC OPTIMA.png', '2024-11-26 03:26:20', '2024-11-26 03:26:20', 'aircondition', '0', '', ''),
(23, 'RAS+RAC 24HT/HTP FW HITACHI 2.5HP INV SPLIT AC', 'The Hitachi RAS+RAC 24HT/HTP is a 2.5HP inverter split air conditioner designed for efficient and reliable cooling in medium to large spaces. Featuring advanced airflow technology and energy-saving performance, it ensures consistent comfort and quiet oper', 99999999, 56295.00, '3 HITACHI 2.5HP INV SPLIT AC.png', '2024-11-26 06:05:29', '2024-11-26 06:05:29', 'aircondition', '0', '3 HITACHI 2.5HP INV SPLIT AC.png', '3.2 HITACHI 2.5HP INV SPLIT AC.png'),
(24, 'HSN/U24IPX2 LG 2.5HP PREM INV UV NANO SPLIT AC ION', 'The HSN/U24IPX2 LG 2.5HP Premium Inverter UV Nano Split AC features advanced UV Nano technology for cleaner, healthier air and a built-in ionizer for enhanced purification. ', 9999999, 65990.00, '4 .4 LG 2.5HP PREM INV UV NANO SPLIT AC ION.png', '2024-11-26 06:05:29', '2024-11-26 06:05:29', 'aircondition', '0', '4 .4 LG 2.5HP PREM INV UV NANO SPLIT AC ION.png', '4 LG 2.5HP PREM INV UV NANO SPLIT AC ION.png'),
(25, 'HSN/U24ISY2 LG 2.5HP STD INV THINQ SPLIT AC', 'The LG 2.5HP Standard Inverter ThinQ Split AC (HSN/U24ISY2) combines powerful cooling performance with energy efficiency, ideal for larger spaces. ', 9999999, 59990.00, '5 LG 1.5HP STD INV THINQ SPLIT AC.png', '2024-11-26 06:05:29', '2024-11-26 06:05:29', 'aircondition', '0', '0', ''),
(26, 'SRK/C10YYP-W7 MITSUBISHI 1HP DLX SPLIT AC', 'The SRK/C10YYP-W7 Mitsubishi 1HP Deluxe Split AC offers efficient cooling with advanced technology, designed to deliver optimal comfort in small to medium-sized rooms. ', 9999999, 33400.00, '6 MITSUBISHI 1HP DLX SPLIT AC.png', '2024-11-26 06:05:29', '2024-11-26 06:05:29', 'aircondition', '0', '0', ''),
(27, 'CS/CU-XU24AKQ PANASONIC 2.5HP PRM INV SPLIT AIRCON', 'The Panasonic CS/CU-XU24AKQ 2.5HP Premium Inverter Split Air Conditioner delivers efficient cooling with advanced inverter technology, ensuring consistent temperature control while reducing energy consumption.', 9999999, 69665.00, '7 PANASONIC 2.5HP PRM INV SPLIT AIRCON.png', '2024-11-26 06:05:29', '2024-11-26 06:05:29', 'aircondition', '0', '7 PANASONIC 2.5HP PRM INV SPLIT AIRCON.png', '7.7 PANASONIC 1HP STD INV SPLIT AIRCON.png'),
(28, 'AR10CYECABTN+XTC SAMSUNG 1HP INV SPLIT M.BLK AC', 'The AR10CYECABTN+XTC is a high-performance Samsung 1HP Inverter Split Air Conditioner, designed to provide efficient cooling and energy savings. ', 9999999, 31995.00, '8 SAMSUNG 1HP INV SPLIT M.BLK AC.png', '2024-11-26 06:05:29', '2024-11-26 06:05:29', 'aircondition', '0', '8 SAMSUNG 1HP INV SPLIT M.BLK AC.png', '8 .8 SAMSUNG 1HP INV SPLIT M.BLK AC.png'),
(29, 'MH6565DIS LG 25L SMART INVERTER MICROWAVE OVEN', 'The MH6565DIS LG 25L Smart Inverter Microwave Oven offers advanced cooking technology with precise power control for even heating and faster cooking times.', 99999999, 8995.00, '1  LG 25L SMART INVERTER MICROWAVE OVEN.png', '2024-11-26 07:10:57', '2024-11-26 07:10:57', 'homeappliances', 'oven', '1  LG 25L SMART INVERTER MICROWAVE OVEN.png', '1.1 LG 25L SMART INVERTER MICROWAVE OVEN.png'),
(30, 'NN-GT35NB PANASONIC GRILL MICROWAVE OVEN', 'The NN-GT35NB Panasonic Grill Microwave Oven offers versatile cooking options with a combination of microwave and grill functions, making it ideal for grilling, baking, and reheating.', 9999999, 11620.00, '2 NN-GT35NB PANASONIC GRILL MICROWAVE OVEN.png', '2024-11-26 07:10:57', '2024-11-26 07:10:57', 'homeappliances', 'oven', '2 NN-GT35NB PANASONIC GRILL MICROWAVE OVEN.png', '2.2  NN-GT35NB PANASONIC GRILL MICROWAVE OVEN.png'),
(31, 'MS23T5018AP/TC SAMSUNG 23L CLEAN PINK MWO', 'The Samsung MS23T5018AP/TC 23L Clean Pink Microwave Oven combines a sleek, modern design with powerful performance, perfect for quick cooking and reheating. ', 9999999, 6845.00, '3 SAMSUNG 23L CLEAN PINK MWO.png', '2024-11-26 07:10:57', '2024-11-26 07:10:57', 'homeappliances', 'microwave', '3 SAMSUNG 23L CLEAN PINK MWO.png', '3.3 SAMSUNG 23L CLEAN PINK MWO.png'),
(32, 'MG30T5018CC/TC SAMSUNG 30L MICROWAVE OVEN', 'The Samsung MG30T5018CC/TC 30L Microwave Oven combines a spacious 30-liter capacity with advanced cooking technology for efficient and versatile meal preparation. ', 9999999, 9595.00, '4 SAMSUNG 30L MICROWAVE OVEN.png', '2024-11-26 07:10:57', '2024-11-26 07:10:57', 'homeappliances', 'microwave', '4 SAMSUNG 30L MICROWAVE OVEN.png', '4.4 SAMSUNG 30L MICROWAVE OVEN.png'),
(33, 'MS2502BP WHIRLPOOL 25L DIG MICROWAVE OVEN', 'The Whirlpool MS2502BP is a 25-liter microwave oven designed for efficient and convenient cooking. Featuring advanced technology, it offers multiple power levels and cooking presets, making it ideal for quick and even meal preparation.', 9999999, 6295.00, '5 WHIRLPOOL 25L DIG MICROWAVE OVEN.png', '2024-11-26 07:10:57', '2024-11-26 07:10:57', 'homeappliances', 'microwave', '5 WHIRLPOOL 25L DIG MICROWAVE OVEN.png', '5.5 WHIRLPOOL 25L DIG MICROWAVE OVEN.png'),
(34, 'MWX203ESB WHIRLPOOL SILVER DIG. W/BOWL', 'The MWX203ESB Whirlpool Silver Digital Microwave with Bowl offers advanced cooking features in a sleek, silver design. Its intuitive digital controls and spacious interior provide efficient and convenient meal preparation.', 9999999, 5990.00, '6 WHIRLPOOL SILVER DIG BOWL.png', '2024-11-26 07:10:57', '2024-11-26 07:10:57', 'homeappliances', 'microwave', '0', ''),
(35, 'RHPC3000-PH 11N1 RUSSELL HOBBS DIGITAL RICE COOKER', 'The RHPC3000-PH 11N1 Russell Hobbs Digital Rice Cooker offers a sleek, user-friendly design with multiple cooking functions, allowing you to easily prepare perfect rice every time. ', 99999999, 6996.00, '1 RUSSELL HOBBS DIGITAL RICE COOKER.png', '2024-11-26 07:28:53', '2024-11-26 07:28:53', 'homeappliances', 'ricecooker', '1 RUSSELL HOBBS DIGITAL RICE COOKER.png', '1.1 RUSSELL HOBBS DIGITAL RICE COOKER.png'),
(36, 'SR-3NAPSC PANASONIC PINK BABY RICE COOKER', 'The RSR-3NAPSC Panasonic Pink Baby Rice Cooker is a compact and stylish appliance designed to cook perfect rice with ease. Its user-friendly features and sleek pink design make it a charming addition to any kitchen.', 99999999, 2595.00, '2 PANASONIC PINK BABY RICE COOKER.png', '2024-11-26 07:31:59', '2024-11-26 07:31:59', 'homeappliances', 'ricecooker', '2 PANASONIC PINK BABY RICE COOKER.png', '2.2 PANASONIC PINK BABY RICE COOKER.png'),
(37, 'P-HD4515-67 PHILIPS 1.8L RICE COOKER', 'The PHILIPS P-HD4515-67 1.8L Rice Cooker is designed to deliver perfectly cooked rice with its advanced cooking technology and generous 1.8-liter capacity. With easy-to-use controls and a durable design.', 9999999, 4995.00, '3 PHILIPS 1.8L RICE COOKER.png', '2024-11-26 07:31:59', '2024-11-26 07:31:59', 'homeappliances', 'ricecooker', '3 PHILIPS 1.8L RICE COOKER.png', '3.3 PHILIPS 1.8L RICE COOKER.png'),
(38, 'GS-1007 ASAHI GAS STOVE (D)', 'The GS-1007 ASAHI Gas Stove (D) is a sleek and durable kitchen appliance designed for efficient cooking, featuring a sturdy build and high-performance burners. ', 99999999, 2850.00, '1 GS-1007 ASAHI GAS STOVE (D).png', '2024-11-26 07:36:12', '2024-11-26 07:36:12', 'homeappliances', 'stove', '0', ''),
(39, 'GS-447 ASAHI GAS STOVE (D)', 'The GS-447 ASAHI Gas Stove (D) features a sleek, durable design with high-efficiency burners, offering precise heat control for your cooking needs. Its easy-to-clean surface and reliable performance make it a perfect addition to any modern kitchen.', 9999999, 1375.00, '2 GS-447 ASAHI GAS STOVE (D).png', '2024-11-26 07:36:12', '2024-11-26 07:36:12', 'homeappliances', 'stove', '0', ''),
(40, 'KW-3564 KYOWA GAS STOVE GLASSTOP (D)', 'The KW-3564 Kyowa Gas Stove features a sleek glass top design, offering both durability and a modern aesthetic for your kitchen. ', 9999999, 2095.00, '3 KYOWA GAS STOVE GLASSTOP (D).png', '2024-11-26 07:36:12', '2024-11-26 07:36:12', 'homeappliances', 'stove', '3 KYOWA GAS STOVE GLASSTOP (D).png', '3.3 KYOWA GAS STOVE GLASSTOP (D).png'),
(41, 'G-702EF LA GERMANIA GAS STOVE (D)', 'The G-702EF LA Germania Gas Stove (D) is a sleek and efficient kitchen appliance designed for everyday cooking with its durable and user-friendly features. With multiple burners and a stylish design.', 9999999, 4575.00, '4 F LA GERMANIA GAS STOVE (D).png', '2024-11-26 07:36:12', '2024-11-26 07:36:12', 'homeappliances', 'stove', '0', ''),
(42, 'RI-524E RINNAI GAS STOVE (D)', 'The RI-524E Rinnai Gas Stove (D) is a high-performance kitchen appliance featuring durable construction and advanced flame control for efficient cooking. With its sleek design and multiple burners.', 9999999, 4550.00, '5 RI-524E RINNAI GAS STOVE (D).png', '2024-11-26 07:36:12', '2024-11-26 07:36:12', 'homeappliances', 'stove', '0', ''),
(43, 'GS-201BCG TECNOGAS 2 BURNER GAS STOVE', 'The 6 GS-201BCG TECNOGAS 2-burner gas stove offers reliable cooking performance with its compact design, ideal for small kitchens or quick meal preparations. Featuring high-quality burners, it ensures efficient heat.', 9999999, 3795.00, '6 GS-201BCG TECNOGAS 2 BURNER GAS STOVE.png', '2024-11-26 07:36:12', '2024-11-26 07:36:12', 'homeappliances', 'stove', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart_tbl`
--

CREATE TABLE `shopping_cart_tbl` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shopping_cart_tbl`
--

INSERT INTO `shopping_cart_tbl` (`id`, `user_id`, `product_id`, `quantity`, `total_price`, `created_at`, `modified_at`) VALUES
(25, 0, NULL, 1, 2990.00, '2024-11-18 05:53:22', '2024-11-18 05:53:22'),
(26, 0, NULL, 1, 2990.00, '2024-11-18 07:06:28', '2024-11-18 07:06:28'),
(27, 0, NULL, 1, 2990.00, '2024-11-18 07:21:38', '2024-11-18 07:21:38'),
(28, 0, NULL, 1, 31995.00, '2024-11-18 07:52:42', '2024-12-08 17:22:21'),
(29, 0, NULL, 1, 17990.00, '2024-11-18 08:13:49', '2024-12-04 22:02:32'),
(30, 0, NULL, 1, 2990.00, '2024-11-18 10:28:28', '2024-11-18 10:28:28'),
(31, 0, NULL, 1, 6845.00, '2024-11-18 22:48:49', '2024-11-29 10:14:02'),
(32, 0, NULL, 1, 2990.00, '2024-11-18 23:50:08', '2024-11-18 23:50:08'),
(33, 0, NULL, 1, 2990.00, '2024-11-19 01:30:27', '2024-11-19 01:30:27'),
(34, 0, NULL, 1, 2990.00, '2024-11-19 02:34:55', '2024-11-19 02:34:55'),
(35, 0, NULL, 1, 2990.00, '2024-11-19 04:30:09', '2024-11-19 04:30:09'),
(36, 0, NULL, 3, 2595.00, '2024-11-19 04:43:43', '2024-12-08 17:29:24'),
(37, 0, NULL, 1, 3495.25, '2024-11-19 05:11:53', '2024-11-19 05:11:53'),
(38, 0, NULL, 1, 2850.00, '2024-11-19 05:40:55', '2024-12-06 15:56:52'),
(39, 0, NULL, 1, 2990.00, '2024-11-19 05:46:29', '2024-11-19 05:46:29'),
(40, 0, NULL, 1, 3495.25, '2024-11-19 08:30:14', '2024-11-19 08:30:14'),
(41, 0, NULL, 1, 32990.00, '2024-11-19 09:15:14', '2024-11-19 09:15:14'),
(42, 0, NULL, 1, 4550.00, '2024-11-19 09:15:39', '2024-12-08 21:46:52'),
(43, 0, NULL, 1, 3495.25, '2024-11-19 09:32:51', '2024-11-19 09:32:51'),
(44, 0, NULL, 1, 2990.00, '2024-11-19 09:35:02', '2024-11-19 09:35:02'),
(45, 0, NULL, 1, 3495.25, '2024-11-19 09:51:04', '2024-11-19 09:51:04'),
(46, 0, NULL, 1, 3495.25, '2024-11-19 09:53:39', '2024-11-19 09:53:39'),
(47, 0, NULL, 1, 2990.00, '2024-11-19 10:23:15', '2024-11-19 10:23:15'),
(48, 0, NULL, 1, 69990.00, '2024-11-20 08:04:46', '2024-11-20 08:04:46'),
(49, 0, NULL, 1, 41990.00, '2024-11-20 09:36:14', '2024-11-20 09:36:14'),
(50, 0, NULL, 1, 3495.25, '2024-11-23 17:08:57', '2024-11-23 17:08:57'),
(51, 0, NULL, 1, 23990.00, '2024-11-24 03:22:14', '2024-11-24 03:22:14'),
(52, 0, NULL, 1, 119995.00, '2024-11-25 02:22:20', '2024-11-25 02:22:20'),
(53, 0, NULL, 1, 23990.00, '2024-11-25 05:28:32', '2024-11-25 05:28:32'),
(54, 0, NULL, 1, 69990.00, '2024-11-25 08:47:19', '2024-11-25 08:47:19'),
(55, 0, NULL, 1, 41990.00, '2024-11-25 09:36:17', '2024-11-25 09:36:17'),
(56, 0, NULL, 1, 23990.00, '2024-11-25 09:39:59', '2024-11-25 09:39:59'),
(57, 0, NULL, 1, 23990.00, '2024-11-25 09:44:34', '2024-11-25 09:44:34'),
(58, 0, NULL, 1, 41990.00, '2024-11-25 09:46:28', '2024-11-25 09:46:28'),
(59, 0, NULL, 1, 41990.00, '2024-11-25 09:56:52', '2024-11-25 09:56:52'),
(60, 0, NULL, 1, 41990.00, '2024-11-25 09:57:55', '2024-11-25 09:57:55'),
(61, 0, NULL, 1, 32990.00, '2024-11-25 10:00:26', '2024-11-25 10:00:26'),
(62, 0, NULL, 1, 19990.00, '2024-11-25 10:00:34', '2024-11-25 10:00:34'),
(63, 0, NULL, 1, 19990.00, '2024-11-25 10:24:52', '2024-11-25 10:24:52'),
(64, 0, NULL, 1, 19990.00, '2024-11-25 10:24:56', '2024-11-25 10:24:56'),
(65, 0, NULL, 1, 41990.00, '2024-11-25 10:38:59', '2024-11-25 10:38:59'),
(66, 0, NULL, 1, 32990.00, '2024-11-25 10:42:48', '2024-11-25 10:42:48'),
(67, 0, NULL, 1, 32990.00, '2024-11-25 10:43:02', '2024-11-25 10:43:02'),
(68, 0, NULL, 1, 19990.00, '2024-11-25 10:43:08', '2024-11-25 10:43:08'),
(69, 0, NULL, 1, 19990.00, '2024-11-25 10:43:24', '2024-11-25 10:43:24'),
(70, 0, NULL, 1, 32990.00, '2024-11-25 10:43:51', '2024-11-25 10:43:51'),
(71, 0, NULL, 1, 19990.00, '2024-11-25 10:44:10', '2024-11-25 10:44:10'),
(72, 0, NULL, 2, 107996.00, '2024-11-25 10:58:52', '2024-11-25 10:58:52'),
(73, 0, NULL, 1, 25000.00, '2024-11-25 10:59:03', '2024-11-25 10:59:03'),
(74, 0, NULL, 2, 105980.00, '2024-11-26 10:14:18', '2024-11-26 10:14:18'),
(75, 0, NULL, 1, 68990.00, '2024-11-26 13:35:02', '2024-11-26 13:35:02'),
(76, 0, NULL, 1, 84990.00, '2024-11-26 13:43:05', '2024-11-26 13:43:05'),
(77, 0, NULL, 1, 84990.00, '2024-11-26 13:43:24', '2024-11-26 13:43:24'),
(78, 0, NULL, 1, 84990.00, '2024-11-26 13:43:46', '2024-11-26 13:43:46'),
(79, 0, NULL, 1, 68990.00, '2024-11-26 13:43:57', '2024-11-26 13:43:57'),
(80, 0, NULL, 1, 84990.00, '2024-11-26 13:45:56', '2024-11-26 13:45:56'),
(81, 0, NULL, 1, 68990.00, '2024-11-26 13:46:30', '2024-11-26 13:46:30'),
(82, 0, NULL, 1, 84990.00, '2024-11-26 13:50:24', '2024-11-26 13:50:24'),
(83, 0, NULL, 1, 84990.00, '2024-11-26 13:53:29', '2024-11-26 13:53:29'),
(84, 0, NULL, 1, 219990.00, '2024-11-26 16:00:32', '2024-11-26 16:00:32'),
(85, 0, NULL, 1, 68990.00, '2024-11-29 08:39:54', '2024-11-29 08:39:54'),
(86, 0, NULL, 1, 6845.00, '2024-11-29 10:14:00', '2024-11-29 10:14:00'),
(87, 0, NULL, 1, 84990.00, '2024-11-29 10:18:04', '2024-11-29 10:18:04'),
(88, 0, NULL, 1, 84990.00, '2024-11-29 10:18:10', '2024-11-29 10:18:10'),
(89, 0, NULL, 1, 84990.00, '2024-11-29 10:18:17', '2024-11-29 10:18:17'),
(90, 0, NULL, 1, 84990.00, '2024-11-29 11:20:15', '2024-11-29 11:20:15'),
(91, 0, NULL, 1, 63370.00, '2024-11-29 11:20:22', '2024-11-29 11:20:22'),
(92, 0, NULL, 1, 10990.00, '2024-11-29 11:23:44', '2024-11-29 11:23:44'),
(93, 0, NULL, 1, 84990.00, '2024-11-29 11:41:00', '2024-11-29 11:41:00'),
(94, 0, NULL, 3, 254970.00, '2024-11-29 11:50:09', '2024-11-29 11:50:09'),
(95, 0, NULL, 5, 344950.00, '2024-11-29 11:50:18', '2024-11-29 11:50:18'),
(96, 0, NULL, 1, 84990.00, '2024-11-29 12:34:01', '2024-11-29 12:34:01'),
(97, 0, NULL, 1, 84990.00, '2024-11-29 12:50:46', '2024-11-29 12:50:46'),
(98, 0, NULL, 1, 84990.00, '2024-11-29 12:56:12', '2024-11-29 12:56:12'),
(99, 0, NULL, 1, 84990.00, '2024-11-29 12:56:28', '2024-11-29 12:56:28'),
(100, 0, NULL, 1, 84990.00, '2024-11-29 12:56:35', '2024-11-29 12:56:35'),
(101, 0, NULL, 1, 84990.00, '2024-11-29 12:57:11', '2024-11-29 12:57:11'),
(102, 0, NULL, 1, 84990.00, '2024-11-29 12:58:31', '2024-11-29 12:58:31'),
(103, 0, NULL, 1, 84990.00, '2024-11-29 12:58:42', '2024-11-29 12:58:42'),
(104, 0, NULL, 3, 254970.00, '2024-11-29 12:58:53', '2024-11-29 12:58:53'),
(105, 0, NULL, 1, 84990.00, '2024-11-29 12:59:38', '2024-11-29 12:59:38'),
(106, 0, NULL, 1, 68990.00, '2024-11-29 12:59:41', '2024-11-29 12:59:41'),
(107, 0, NULL, 1, 63370.00, '2024-11-29 12:59:45', '2024-11-29 12:59:45'),
(108, 0, NULL, 1, 10990.00, '2024-11-29 13:00:02', '2024-11-29 13:00:02'),
(109, 0, NULL, 1, 5990.00, '2024-11-29 13:00:28', '2024-11-29 13:00:28'),
(110, 0, NULL, 1, 84990.00, '2024-11-29 13:08:22', '2024-11-29 13:08:22'),
(111, 0, NULL, 4, 339960.00, '2024-11-29 13:08:27', '2024-11-29 13:08:27'),
(112, 0, NULL, 1, 84990.00, '2024-11-29 13:10:04', '2024-11-29 13:10:04'),
(113, 0, NULL, 1, 84990.00, '2024-11-29 13:10:07', '2024-11-29 13:10:07'),
(114, 0, NULL, 1, 84990.00, '2024-11-29 13:10:14', '2024-11-29 13:10:14'),
(115, 0, NULL, 1, 84990.00, '2024-11-29 13:10:28', '2024-11-29 13:10:28'),
(116, 0, NULL, 10, 849900.00, '2024-11-29 13:10:37', '2024-11-29 13:10:37'),
(117, 0, NULL, 10, 849900.00, '2024-11-29 13:10:45', '2024-11-29 13:10:45'),
(118, 0, NULL, 1, 84990.00, '2024-11-29 13:13:56', '2024-11-29 13:13:56'),
(119, 0, NULL, 1, 68990.00, '2024-11-29 13:14:04', '2024-11-29 13:14:04'),
(120, 0, NULL, 1, 84990.00, '2024-11-29 13:21:08', '2024-11-29 13:21:08'),
(121, 0, NULL, 1, 68990.00, '2024-11-29 13:21:21', '2024-11-29 13:21:21'),
(122, 0, NULL, 1, 56210.00, '2024-11-29 13:21:28', '2024-11-29 13:21:28'),
(123, 0, NULL, 3, 32970.00, '2024-11-29 13:22:49', '2024-11-29 13:22:49'),
(124, 0, NULL, 5, 54950.00, '2024-11-29 13:23:45', '2024-11-29 13:23:45'),
(125, 0, NULL, 2, 21980.00, '2024-11-29 13:25:36', '2024-11-29 13:25:36'),
(126, 0, NULL, 1, 84990.00, '2024-11-29 13:25:43', '2024-11-29 13:25:43'),
(127, 0, NULL, 1, 74990.00, '2024-11-29 13:25:52', '2024-11-29 13:25:52'),
(128, 0, NULL, 1, 84990.00, '2024-11-29 13:26:59', '2024-11-29 13:26:59'),
(129, 0, NULL, 1, 84990.00, '2024-11-29 13:29:22', '2024-11-29 13:29:22'),
(130, 0, NULL, 1, 84990.00, '2024-11-29 13:30:47', '2024-11-29 13:30:47'),
(131, 0, NULL, 1, 68990.00, '2024-11-29 13:30:55', '2024-11-29 13:30:55'),
(132, 0, NULL, 1, 84990.00, '2024-11-29 13:40:47', '2024-11-29 13:40:47'),
(133, 0, NULL, 1, 68990.00, '2024-11-29 13:42:59', '2024-11-29 13:42:59'),
(134, 0, NULL, 2, 169980.00, '2024-11-29 13:43:09', '2024-11-29 13:43:09'),
(135, 0, NULL, 1, 84990.00, '2024-11-29 14:12:03', '2024-11-29 14:12:03'),
(136, 0, NULL, 1, 68990.00, '2024-12-04 14:58:43', '2024-12-04 14:58:43'),
(137, 0, NULL, 1, 63370.00, '2024-12-04 15:12:39', '2024-12-04 15:12:39'),
(138, 0, NULL, 1, 10990.00, '2024-12-04 15:41:36', '2024-12-04 15:41:36'),
(139, 0, NULL, 1, 62100.00, '2024-12-04 20:07:53', '2024-12-04 20:07:53'),
(140, 0, NULL, 1, 8995.00, '2024-12-04 21:46:24', '2024-12-04 21:46:24'),
(141, 0, NULL, 1, 84990.00, '2024-12-04 21:49:21', '2024-12-04 21:49:21'),
(142, 0, NULL, 1, 8995.00, '2024-12-04 22:02:31', '2024-12-04 22:02:31'),
(143, 0, NULL, 1, 6996.00, '2024-12-04 22:02:39', '2024-12-04 22:02:39'),
(144, 0, NULL, 1, 11620.00, '2024-12-04 22:24:53', '2024-12-04 22:24:53'),
(145, 0, NULL, 1, 84990.00, '2024-12-04 23:08:38', '2024-12-04 23:08:38'),
(146, 0, NULL, 1, 84990.00, '2024-12-04 23:09:59', '2024-12-04 23:09:59'),
(147, 0, NULL, 1, 84990.00, '2024-12-04 23:10:11', '2024-12-04 23:10:11'),
(148, 0, NULL, 1, 10990.00, '2024-12-05 00:04:57', '2024-12-05 00:04:57'),
(149, 0, NULL, 1, 84990.00, '2024-12-05 00:15:59', '2024-12-05 00:15:59'),
(150, 0, NULL, 1, 84990.00, '2024-12-05 00:32:33', '2024-12-05 00:32:33'),
(151, 0, NULL, 1, 68990.00, '2024-12-05 00:32:48', '2024-12-05 00:32:48'),
(152, 0, NULL, 1, 10990.00, '2024-12-05 00:35:27', '2024-12-05 00:35:27'),
(153, 0, NULL, 1, 10990.00, '2024-12-05 00:36:36', '2024-12-05 00:36:36'),
(154, 0, NULL, 1, 84990.00, '2024-12-05 00:44:14', '2024-12-05 00:44:14'),
(155, 0, NULL, 1, 84990.00, '2024-12-05 00:52:06', '2024-12-05 00:52:06'),
(156, 0, NULL, 1, 84990.00, '2024-12-05 00:53:02', '2024-12-05 00:53:02'),
(157, 0, NULL, 1, 10990.00, '2024-12-05 01:02:24', '2024-12-05 01:02:24'),
(158, 0, NULL, 1, 84990.00, '2024-12-05 05:39:13', '2024-12-05 05:39:13'),
(159, 0, NULL, 1, 84990.00, '2024-12-05 06:03:10', '2024-12-05 06:03:10'),
(160, 0, NULL, 1, 84990.00, '2024-12-05 06:03:16', '2024-12-05 06:03:16'),
(161, 0, NULL, 2, 169980.00, '2024-12-05 06:15:00', '2024-12-05 06:15:00'),
(162, 0, NULL, 1, 84990.00, '2024-12-06 12:48:04', '2024-12-06 12:48:04'),
(163, 0, NULL, 2, 169980.00, '2024-12-06 13:46:29', '2024-12-06 13:46:29'),
(164, 0, NULL, 1, 84990.00, '2024-12-06 14:32:41', '2024-12-06 14:32:41'),
(165, 0, NULL, 1, 84990.00, '2024-12-06 15:53:20', '2024-12-06 15:53:20'),
(166, 0, NULL, 1, 84990.00, '2024-12-06 15:56:46', '2024-12-06 15:56:46'),
(167, 0, NULL, 1, 2850.00, '2024-12-06 15:56:50', '2024-12-06 15:56:50'),
(168, 0, NULL, 1, 10990.00, '2024-12-06 16:15:07', '2024-12-06 16:15:07'),
(169, 0, NULL, 1, 84990.00, '2024-12-06 16:15:21', '2024-12-06 16:15:21'),
(170, 0, NULL, 1, 62100.00, '2024-12-06 17:44:31', '2024-12-06 17:44:31'),
(171, 0, NULL, 1, 10990.00, '2024-12-06 23:05:41', '2024-12-06 23:05:41'),
(172, 0, NULL, 2, 169980.00, '2024-12-06 23:52:54', '2024-12-06 23:52:54'),
(173, 0, NULL, 1, 56210.00, '2024-12-07 00:10:28', '2024-12-07 00:10:28'),
(174, 0, NULL, 1, 10990.00, '2024-12-07 00:46:06', '2024-12-07 00:46:06'),
(175, 0, NULL, 1, 84990.00, '2024-12-07 01:23:48', '2024-12-07 01:23:48'),
(176, 0, NULL, 1, 84990.00, '2024-12-07 02:30:23', '2024-12-07 02:30:23'),
(177, 0, NULL, 1, 10990.00, '2024-12-07 02:51:25', '2024-12-07 02:51:25'),
(178, 0, NULL, 1, 4550.00, '2024-12-07 02:59:51', '2024-12-07 02:59:51'),
(179, 0, NULL, 1, 10990.00, '2024-12-07 03:00:08', '2024-12-07 03:00:08'),
(180, 0, NULL, 1, 10990.00, '2024-12-07 03:32:22', '2024-12-07 03:32:22'),
(181, 0, NULL, 1, 10990.00, '2024-12-07 03:32:25', '2024-12-07 03:32:25'),
(182, 0, NULL, 1, 84990.00, '2024-12-07 03:32:36', '2024-12-07 03:32:36'),
(183, 0, NULL, 1, 10990.00, '2024-12-07 03:33:00', '2024-12-07 03:33:00'),
(184, 0, NULL, 1, 10990.00, '2024-12-07 03:41:24', '2024-12-07 03:41:24'),
(185, 0, NULL, 1, 10990.00, '2024-12-07 03:41:52', '2024-12-07 03:41:52'),
(186, 0, NULL, 1, 10990.00, '2024-12-07 03:41:59', '2024-12-07 03:41:59'),
(187, 0, NULL, 1, 10990.00, '2024-12-07 03:42:15', '2024-12-07 03:42:15'),
(188, 0, NULL, 1, 10990.00, '2024-12-07 03:43:11', '2024-12-07 03:43:11'),
(189, 0, NULL, 1, 10990.00, '2024-12-07 03:43:51', '2024-12-07 03:43:51'),
(190, 0, NULL, 1, 10990.00, '2024-12-07 03:44:10', '2024-12-07 03:44:10'),
(191, 0, NULL, 1, 10990.00, '2024-12-07 03:44:41', '2024-12-07 03:44:41'),
(192, 0, NULL, 1, 84990.00, '2024-12-07 03:45:14', '2024-12-07 03:45:14'),
(193, 0, NULL, 1, 84990.00, '2024-12-07 03:45:36', '2024-12-07 03:45:36'),
(194, 0, NULL, 1, 10990.00, '2024-12-07 03:45:44', '2024-12-07 03:45:44'),
(195, 0, NULL, 1, 10990.00, '2024-12-07 03:46:20', '2024-12-07 03:46:20'),
(196, 0, NULL, 1, 10990.00, '2024-12-07 03:47:19', '2024-12-07 03:47:19'),
(197, 0, NULL, 1, 63370.00, '2024-12-07 03:47:25', '2024-12-07 03:47:25'),
(198, 0, NULL, 1, 6996.00, '2024-12-07 04:33:41', '2024-12-07 04:33:41'),
(199, 0, NULL, 1, 10990.00, '2024-12-07 04:33:49', '2024-12-07 04:33:49'),
(200, 0, NULL, 1, 84990.00, '2024-12-08 01:15:02', '2024-12-08 01:15:02'),
(201, 0, NULL, 1, 10990.00, '2024-12-08 01:16:54', '2024-12-08 01:16:54'),
(202, 0, NULL, 1, 10990.00, '2024-12-08 01:29:16', '2024-12-08 01:29:16'),
(203, 0, NULL, 1, 10990.00, '2024-12-08 01:42:10', '2024-12-08 01:42:10'),
(204, 0, NULL, 1, 10990.00, '2024-12-08 11:32:57', '2024-12-08 11:32:57'),
(205, 0, NULL, 1, 10990.00, '2024-12-08 12:32:00', '2024-12-08 12:32:00'),
(206, 0, NULL, 1, 10990.00, '2024-12-08 12:39:00', '2024-12-08 12:39:00'),
(207, 0, NULL, 1, 10990.00, '2024-12-08 12:41:47', '2024-12-08 12:41:47'),
(208, 0, NULL, 1, 10990.00, '2024-12-08 13:17:10', '2024-12-08 13:17:10'),
(209, 0, NULL, 1, 10990.00, '2024-12-08 13:18:32', '2024-12-08 13:18:32'),
(210, 0, NULL, 1, 10990.00, '2024-12-08 13:19:44', '2024-12-08 13:19:44'),
(211, 0, NULL, 1, 52990.00, '2024-12-08 13:22:59', '2024-12-08 13:22:59'),
(212, 0, NULL, 1, 10990.00, '2024-12-08 14:14:39', '2024-12-08 14:14:39'),
(213, 0, NULL, 1, 10990.00, '2024-12-08 15:55:22', '2024-12-08 15:55:22'),
(214, 0, NULL, 1, 84990.00, '2024-12-08 16:40:08', '2024-12-08 16:40:08'),
(215, 0, NULL, 1, 84990.00, '2024-12-08 16:59:50', '2024-12-08 16:59:50'),
(216, 0, NULL, 1, 68990.00, '2024-12-08 17:01:25', '2024-12-08 17:01:25'),
(217, 0, NULL, 1, 84990.00, '2024-12-08 17:01:41', '2024-12-08 17:01:41'),
(218, 0, NULL, 1, 10990.00, '2024-12-08 17:02:33', '2024-12-08 17:02:33'),
(219, 0, NULL, 1, 62100.00, '2024-12-08 17:03:57', '2024-12-08 17:03:57'),
(220, 0, NULL, 1, 84990.00, '2024-12-08 17:05:58', '2024-12-08 17:05:58'),
(221, 0, NULL, 1, 10990.00, '2024-12-08 17:06:07', '2024-12-08 17:06:07'),
(222, 0, NULL, 1, 10990.00, '2024-12-08 17:08:46', '2024-12-08 17:08:46'),
(223, 0, NULL, 1, 84990.00, '2024-12-08 17:10:35', '2024-12-08 17:10:35'),
(224, 0, NULL, 1, 10990.00, '2024-12-08 17:10:52', '2024-12-08 17:10:52'),
(225, 0, NULL, 1, 10990.00, '2024-12-08 17:11:09', '2024-12-08 17:11:09'),
(226, 0, NULL, 1, 31995.00, '2024-12-08 17:22:20', '2024-12-08 17:22:20'),
(227, 0, NULL, 1, 68990.00, '2024-12-08 17:22:36', '2024-12-08 17:22:36'),
(228, 0, NULL, 1, 63370.00, '2024-12-08 17:23:52', '2024-12-08 17:23:52'),
(229, 0, NULL, 1, 84990.00, '2024-12-08 17:24:13', '2024-12-08 17:24:13'),
(230, 0, NULL, 1, 10990.00, '2024-12-08 17:28:05', '2024-12-08 17:28:05'),
(231, 0, NULL, 1, 10990.00, '2024-12-08 17:28:46', '2024-12-08 17:28:46'),
(232, 0, NULL, 1, 2595.00, '2024-12-08 17:29:23', '2024-12-08 17:29:23'),
(233, 0, NULL, 1, 10990.00, '2024-12-08 17:33:39', '2024-12-08 17:33:39'),
(234, 0, NULL, 2, 9100.00, '2024-12-08 17:39:48', '2024-12-08 17:39:48'),
(235, 0, NULL, 1, 8995.00, '2024-12-08 20:21:06', '2024-12-08 20:21:06'),
(236, 0, NULL, 1, 84990.00, '2024-12-08 20:45:28', '2024-12-08 20:45:28'),
(237, 0, NULL, 1, 4550.00, '2024-12-08 21:46:51', '2024-12-08 21:46:51'),
(238, 0, NULL, 1, 6845.00, '2024-12-08 21:53:38', '2024-12-08 21:53:38'),
(239, 0, NULL, 1, 62100.00, '2024-12-08 22:01:24', '2024-12-08 22:01:24'),
(240, 0, NULL, 1, 10990.00, '2024-12-08 22:07:27', '2024-12-08 22:07:27'),
(241, 0, NULL, 1, 62100.00, '2024-12-08 22:23:39', '2024-12-08 22:23:39'),
(242, 0, NULL, 1, 62100.00, '2024-12-08 22:27:37', '2024-12-08 22:27:37'),
(243, 0, NULL, 1, 62100.00, '2024-12-08 22:27:51', '2024-12-08 22:27:51'),
(244, 0, NULL, 1, 62100.00, '2024-12-08 22:28:05', '2024-12-08 22:28:05'),
(245, 0, NULL, 1, 6845.00, '2024-12-08 22:30:34', '2024-12-08 22:30:34'),
(246, 0, NULL, 1, 10990.00, '2024-12-09 00:47:51', '2024-12-09 00:47:51');

-- --------------------------------------------------------

--
-- Table structure for table `users_tbl`
--

CREATE TABLE `users_tbl` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_tbl`
--

INSERT INTO `users_tbl` (`user_id`, `first_name`, `last_name`, `email`, `password`, `token`, `is_verified`, `is_admin`) VALUES
(1, '', '', 'user@gmail.com', '$2a$12$ssNDu3cXSudd8hgol9z69egXXLFD3WTlYc5NxUreEvqhyYF1WA8J2', NULL, 0, 0),
(29, '', '', 'admin@gmail.com', '$2a$12$rWWWAfNsY62UHyHwxunMieCkE/w3E5DbNCGGQzkS7.KbeomDXz.YW', NULL, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `order_details_tbl`
--
ALTER TABLE `order_details_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products_tbl`
--
ALTER TABLE `products_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_cart_tbl`
--
ALTER TABLE `shopping_cart_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_tbl`
--
ALTER TABLE `users_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories_tbl`
--
ALTER TABLE `categories_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `order_details_tbl`
--
ALTER TABLE `order_details_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_tbl`
--
ALTER TABLE `products_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `shopping_cart_tbl`
--
ALTER TABLE `shopping_cart_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `users_tbl`
--
ALTER TABLE `users_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders_tbl`
--
ALTER TABLE `orders_tbl`
  ADD CONSTRAINT `orders_tbl_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products_tbl` (`id`);

--
-- Constraints for table `order_details_tbl`
--
ALTER TABLE `order_details_tbl`
  ADD CONSTRAINT `order_details_tbl_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders_tbl` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
