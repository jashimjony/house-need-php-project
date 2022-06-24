-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2019 at 09:01 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `houzneed`
--

-- --------------------------------------------------------

--
-- Table structure for table `he_cart`
--

CREATE TABLE `he_cart` (
  `row_id` int(11) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `itemID` varchar(255) NOT NULL,
  `itemImg` varchar(255) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_cart`
--

INSERT INTO `he_cart` (`row_id`, `userID`, `itemID`, `itemImg`, `itemName`, `qty`, `price`, `status`) VALUES
(2, '#CUST0003', '#SKU0016', 'images/837_3.jpg', 'Panasonic Air Pot', 1, '474.00', 'UNPAID'),
(3, '#CUST0003', '#SKU0027', 'images/lg-49uk6320_1.jpg', 'LG 49-inch UHD TV', 1, '1999.00', 'UNPAID');

-- --------------------------------------------------------

--
-- Table structure for table `he_contact`
--

CREATE TABLE `he_contact` (
  `id` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `msg` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_contact`
--

INSERT INTO `he_contact` (`id`, `userName`, `userEmail`, `subject`, `msg`, `reply`) VALUES
(1, 'Muhammad arif', 'arif@gmail.com', 'out of stock product', 'air product out of stock', 'YES'),
(2, 'Muhammad arif', 'arif@gmail.com', 'Payment', 'Cannot pay, payment failed', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `he_feedback`
--

CREATE TABLE `he_feedback` (
  `id` int(11) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userRating` int(11) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_feedback`
--

INSERT INTO `he_feedback` (`id`, `userID`, `userName`, `userRating`, `feedback`) VALUES
(1, '#CUST0002', 'Muhammad Arif', 5, 'Nice platform'),
(2, '#CUST0003', 'Muhd Alif', 5, 'Nice product and platform');

-- --------------------------------------------------------

--
-- Table structure for table `he_item`
--

CREATE TABLE `he_item` (
  `itemID` varchar(255) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `itemImg` varchar(255) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_item`
--

INSERT INTO `he_item` (`itemID`, `itemName`, `itemImg`, `price`, `qty`, `status`, `category`, `description`) VALUES
('#SKU0001', 'Hisense 1.0 HP Non-Inverter Air-Conditioner', 'images/aircon.jpg', '900.00', '0', 'OUT OF STOCK', 'Home Appliances', 'Health Protection, High Density Filter.\r\nCompared with ordinary dust filter, the high density filter can remove more than 90% dust and other particles. Just simply wash the dust filter with water and you can enjoy fresh air everyday.'),
('#SKU0002', 'Honeywell 450sqf Air Purifier ', 'images/airpurifier.jpg', '1500.00', '100', 'IN STOCK', 'Home Appliances', 'Smooth touch controls Intuitive smooth touch controls panel make it easy to operate.\r\nBest in class airflow design Zero blind angles, ensures optimum air suction and pure air flow to enable high efficiency of purification in an operating environment.'),
('#SKU0008', 'Sharp Air Cooler', 'images/shp-pja36tvw.jpg', '377.00', '100', 'IN STOCK', 'Home Appliances', 'Trying to get a good night sleep or an afternoon siesta, or even having a chillaxing with a small gathering, can already make you break into a sweaty frenzy. Sharp Air Cooler PJA36TVW might just be what you need. This Air Cooler helps you to stay cool and'),
('#SKU0009', 'Toshiba 8kg Washing Machine', 'images/5300_2.jpg', '900.00', '100', 'IN STOCK', 'Home Appliances', 'QUICK OVERVIEW\r\n8 kg\r\nMega Power Wash\r\nClean View Transparent Lid\r\nFrgrance Course\r\nCassette Lint Filter'),
('#SKU0010', 'Hitachi 661L Side by Side Fridge', 'images/1911_3.jpg', '3465.00', '100', 'IN STOCK', 'Home Appliances', 'QUICK OVERVIEW\r\n661 Litres\r\nInverter x Dual Fan Cooling\r\nTouch Screen Controller\r\nNano Titanium Filter\r\nLED Light\r\nColour:Glass Silver'),
('#SKU0011', 'Panasonic NAMI 5-Blade Ceiling Fan', 'images/psn-fm15e2.jpg', '545.00', '100', 'IN STOCK', 'Home Appliances', 'QUICK OVERVIEW\r\n5 blade design\r\nYuragi (natural breeze) design\r\nEnhanced safety features\r\nRemote control with 5 present speed\r\nGreater air delivery\r\n1, 3, 6 hour off and sleep timer'),
('#SKU0012', 'Electrolux ErgoSteam Iron ', 'images/ele-esi5116.jpg', '133.00', '100', 'IN STOCK', 'Home Appliances', 'Powerful, intelligent Electrolux Steam Iron ESI5116 for perfect results faster. Iron everything from jeans to silk with no risk of burning thanks to vertical steam technology. It is a durable steam iron that allows easy gliding on all fabrics.'),
('#SKU0013', 'Electrolux Allure II Booster Pump Water Heater', 'images/ele-ewe361gadwr.jpg', '544.00', '100', 'IN STOCK', 'Home Appliances', 'The perfect balance between design and function in instant water heaters. Electrolux water heaters help smooth out the little hassles in your shower experience. This elegant line of water heaters is designed to give you a little more time while discoverin'),
('#SKU0014', 'Morphy Richards 732005 Supervac 2 in 1 Cordless Vacuum Cleaner', 'images/mrd-732005.jpg', '598.00', '100', 'IN STOCK', 'Home Appliances', 'QUICK OVERVIEW\r\nCordless and rechargeable for easier and safer vacuuming\r\nCollapsible handle for compact storage\r\nLightweight, easy to manoeuvre and suitable for all floors.\r\n\r\nThe Supervac 2-in-1 cordless cleaner is perfect for every day cleaning. Use as'),
('#SKU0015', 'Pensonic Mosquito Killer ', 'images/pen-pik11_1.jpg', '147.00', '100', 'IN STOCK', 'Home Appliances', 'This insect killer uses nontoxic UV light to attract and eliminates mosquitoes, biting flies, and other insects. Itâ€™s odourless and safer than any other chemical counterparts like sprays and biochemical nukes. The insect killer features high-impact stru'),
('#SKU0016', 'Panasonic Air Pot', 'images/837_3.jpg', '474.00', '100', 'IN STOCK', 'Kitchen Appliances', 'The Panasonic Air Pot NC-HU401P is not your ordinary thermo pot. It is packed with an array of advanced features, making it convenient, reliable and energy-saving. Featuring a 4-speed dispenser which automatically increases or decreases the volume of hot '),
('#SKU0017', 'Faber Bread Toaster', 'images/fbr-ft203ss.jpg', '69.00', '100', 'IN STOCK', 'Kitchen Appliances', 'Enjoy great toasts every time with the Faber FT203SS. Featuring 900 watts of power, wide slots, defrost/reheat/cancel settings, and removable crumb tray â€“ your bread slices will come out with perfect browning each time.With wide slots, you can now toast'),
('#SKU0018', 'Panasonic Food Processer ', 'images/psn-mk5087m_1.jpg', '279.00', '100', 'IN STOCK', 'Kitchen Appliances', 'Panasonic\'s food processor MK5087M comes with a choice of 5 different blades to suit your every cooking needs. With help from this little kitchen helper, you can start making exquisite cooking masterpieces at home for family and friends to enjoy.'),
('#SKU0019', 'Panasonic 300W Blender ', 'images/psn-mx800s_1.jpg', '109.00', '100', 'IN STOCK', 'Kitchen Appliances', 'Introducing the Panasonic 300W Blender MX-800S â€“ a simple blender with a clean design that does the job well. It is equipped with a powerful 300 watt motor that will help spin the blades fast enough to blend solid ingredients. Blend your favourite bever'),
('#SKU0020', 'Samsung 23L Solo Microwave Oven with Quick Defrost ', 'images/sam-ms23k3513ak.jpg', '310.00', '100', 'IN STOCK', 'Kitchen Appliances', 'QUICK OVERVIEW\r\nTriple Distribution System,\r\nHealthy Cooking,\r\nQuick Defrost,\r\n23L'),
('#SKU0021', 'Panasonic 38L Large Capacity Electric Oven', 'images/psn-nbh3800ssk.jpg', '658.00', '0', 'OUT OF STOCK', 'Kitchen Appliances', 'QUICK OVERVIEW\r\n38L Large Capacity,\r\nDouble layer glass door for heating retaining,\r\nUpper and lower M shaped heater for effective heating,\r\n3D hot-air convection with 360Â° rotation,\r\n70Â° - 230Â° temperature control,\r\n0 - 120 minutes Timer'),
('#SKU0022', 'Elba Designer Hood', 'images/elb-ehe9121stbk.jpg', '1359.00', '100', 'IN STOCK', 'Kitchen Appliances', 'QUICK OVERVIEW\r\nSuction Power : 1,400mÂ³/hr,\r\nWith Hydraulic Hinge Opening,\r\n2-Speed Sensor Touch Control,\r\nMotor Power : 250W,\r\nLED Light 2x2W,\r\nWith Charcoal Filter'),
('#SKU0023', 'Panasonic Ceramic Hob Cooker (Dual Zones)', 'images/ky-r727r_front_6x.jpg', '1513.00', '100', 'IN STOCK', 'Kitchen Appliances', 'Panasonic Ceramic Hob Cooker (Dual Zones) KY-R727R. Unique features of ceramic hob allows easy cleaning due to flat surface. The ceramic hob also have 9 power levels for ultra-precision cooking. It also has great temperature control which allows 70% therm'),
('#SKU0024', 'Panasonic 2.2L Automatic Rice Cooker', 'images/psn-sry22gjlsk.jpg', '182.00', '100', 'IN STOCK', 'Kitchen Appliances', 'Get the Panasonic SR-Y22FGJ rice cooker and dish out a variety of rice delicacies effortlessly for your entire family.\r\nMade of polycarbonate, this rice cooker is durable and will function smoothly for long. The see-through glass aallows you to see the pr'),
('#SKU0025', 'Panasonic Hygienia Dish Dryer', 'images/psn-fds3am-1.jpg', '305.00', '100', 'IN STOCK', 'Kitchen Appliances', 'QUICK OVERVIEW\r\nHygienia Dish Dryer\r\nInhibits Bateria and Fungus\r\nPractical and Hygenic\r\nLarge Opening Space'),
('#SKU0026', 'Sony 32-inch LED TV', 'images/sny-kdl32r300e.jpg', '989.00', '50', 'IN STOCK', 'Digital', 'QUICK OVERVIEW\r\n80 cm (32\"),\r\nWXGA Resolution (1366 x 768),\r\nDolbyâ„¢ Digital, Dolbyâ„¢ Digital Plus, Dolbyâ„¢ pulse Audio Support,\r\n2 x HDMI,\r\n1 x USB Port'),
('#SKU0027', 'LG 49-inch UHD TV', 'images/lg-49uk6320_1.jpg', '1999.00', '50', 'IN STOCK', 'Digital', 'QUICK OVERVIEW\r\n49-inch,\r\nMulti-channel,\r\nHigh-Resolution,\r\n4K Active HDR'),
('#SKU0028', 'DJI Mavic Air (Arctic White) ', 'images/dji-mavic.airc_wht_.jpg', '4199.00', '20', 'IN STOCK', 'Digital', 'QUICK OVERVIEW\r\nMax Flight Time: 21 min3,\r\nMax Speed: 68.4 kph4 in Sport Mode5,\r\nSupports Dual Frequency Bands of 2.4/5.8GHz6 '),
('#SKU0029', 'Canon PIXMA Printer', 'images/2159_3.jpg', '288.00', '100', 'IN STOCK', 'Digital', 'QUICK OVERVIEW\r\nPrint, Scan & Copy,\r\nColor Inkjet Printer,\r\nResolution up to 4,800 x 1,200 dpi,\r\n449(W) x 304(D) x 152(H)mm,\r\n5.3kg'),
('#SKU0030', 'Nikon D5300 DSLR Camera with 18-55mm Lens', 'images/nik-d5300-b-1855vr.jpg', '3078.00', '20', 'IN STOCK', 'Digital', 'QUICK OVERVIEW\r\nNikon F mount (with AF contacts),\r\nTotal 24.78 million pixels,\r\nFocus point (39 or 11),\r\nISO 100-12800,\r\nHi-Speed USB,\r\nType C mini-pin HDMI connector,\r\nOne rechargeable Li-ion EN-EL14a battery\r\nApprox. 125 x 98 x 76 mm (4.9 x 3.9 x 3 in.)'),
('#SKU0031', 'Fitbit Ionic Smartwatch', 'images/fit-fb503wtgy_1.jpg', '1228.00', '100', 'IN STOCK', 'Digital', 'QUICK OVERVIEW\r\nPersonal Coaching,\r\nBuilt-in GPS,\r\nStores Music,\r\nHeart Rate,\r\nMulti-Day Battery'),
('#SKU0032', 'Sony XB21 Extra Bassâ„¢ Portable BluetoothÂ® Speaker ', 'images/sny-srsxb21bce_f0.jpg', '366.00', '100', 'IN STOCK', 'Digital', 'QUICK OVERVIEW\r\nExtra Bass,\r\nLive Sound,\r\nSmall and Compact Size,\r\nDual 42mm Unit Mica Speaker,\r\nLine Lights,\r\nIP67 Waterproof, Dustproof and Rustproof,\r\nLong Battery Life, up to 12 hour,\r\nEasy Control,\r\nBlueteooth - NFC'),
('#SKU0033', 'Jamo Home Cinema System ', 'images/2844_3.jpg', '2677.00', '20', 'IN STOCK', 'Digital', 'Introducing the Jamo S626HCS3 â€“ featuring more than 810-watts of power, providing the best bang for the buck, without compromising on sound and quality. Experience crisp and clear sound from your favourite TV shows thanks to the two 3-way speakers and a'),
('#SKU0034', 'MSI 15.6-Inch Thin Bezel Gaming GeForceÂ® GTX 1050 1TB HDD+256GB SSD+8GB RAM', 'images/msi_nb_gf63_photo_1_2_1_1.png', '3799.00', '0', 'OUT OF STOCK', 'Digital', 'QUICK OVERVIEW\r\n8th Gen IntelÂ® Coreâ„¢ i5 processor,\r\nWindows 10 Home,\r\nSteelSeries Backlight Keyboard (Single-Color, Red),\r\nGeForceÂ® GTX 1050,\r\n1TB HDD+256GB SSD/8GB RAM,\r\n15.6-Inch Full HD (1920x1080), IPS level display,\r\nThin bezel design\r\n21.7mm thi'),
('#SKU0035', 'Microsoft Surface Book2 - 13\" Intel Core i5 8GB + 256GB GPU (Platinum)', 'images/13_-1.jpg', '6507.00', '9', 'IN STOCK', 'Digital', 'QUICK OVERVIEW\r\nUp to 4 Times More Power.\r\nUp to 17 Hours1 of Battery Life1.\r\nLatest Quad-Core Powered IntelÂ® Coreâ„¢ Processors.\r\nLatest NVIDIAÂ® GeforceÂ® Gpus.\r\nFour Modes: Laptop, Tablet, Studio & View.\r\nEngineered for the Best of Office');

--
-- Triggers `he_item`
--
DELIMITER $$
CREATE TRIGGER `create item id` BEFORE INSERT ON `he_item` FOR EACH ROW BEGIN
  INSERT INTO he_itemid_gen VALUES (NULL);
  SET NEW.itemID = CONCAT('#SKU', LPAD(LAST_INSERT_ID(), 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `he_itemid_gen`
--

CREATE TABLE `he_itemid_gen` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_itemid_gen`
--

INSERT INTO `he_itemid_gen` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35);

-- --------------------------------------------------------

--
-- Table structure for table `he_order`
--

CREATE TABLE `he_order` (
  `orderID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userNo` varchar(12) NOT NULL,
  `paymentAmount` decimal(9,2) NOT NULL,
  `payMethod` varchar(10) NOT NULL,
  `payStatus` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `postal` varchar(10) NOT NULL,
  `state` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `he_order`
--

INSERT INTO `he_order` (`orderID`, `userID`, `userName`, `userEmail`, `userNo`, `paymentAmount`, `payMethod`, `payStatus`, `address`, `city`, `postal`, `state`, `status`, `orderDate`) VALUES
('#ORD0001', '#CUST0001', 'Ahmad Razrul', 'razrul@gmail.com', '0182705205', '905.00', 'debit', 'PAID', 'sa 45 lorong 2 kampung tengah batu 13', 'puchong', '47150', 'SELANGOR', 'COMPLETED', '2019-05-01 10:35:14'),
('#ORD0002', '#CUST0002', 'Muhammad Arif', 'arif@gmail.com', '0172772670', '1505.00', 'debit', 'PAID', 'A33, D\'Streetmall Kota Seriemas', 'Nilai', '71800', 'NEGERI SEMBILAN', 'PROCESSING', '2019-05-01 06:51:46'),
('#ORD0003', '#CUST0002', 'Muhammad Arif', 'arif@gmail.com', '0172772670', '1505.00', 'debit', 'PAID', 'A33, D\'Streetmall Kota Seriemas', 'Nilai', '71800', 'NEGERI SEMBILAN', 'PROCESSING', '2019-05-01 07:52:08'),
('#ORD0004', '#CUST0002', 'Muhammad Arif', 'arif@gmail.com', '0172772670', '1505.00', 'debit', 'PAID', 'A33, D\'Streetmall Kota Seriemas', 'Nilai', '71800', 'NEGERI SEMBILAN', 'SHIPPED', '2019-05-01 10:35:39'),
('#ORD0005', '#CUST0003', 'Muhd Alif', 'alif@gmail.com', '0182705205', '6512.00', 'debit', 'PAID', '59 - 61 G Jalan Nautika BU20/B, Section U20, Pusat Komersial TSB', 'Sungai Buloh', '40160', 'SELANGOR', 'SHIPPED', '2019-05-02 10:05:36');

--
-- Triggers `he_order`
--
DELIMITER $$
CREATE TRIGGER `create order no` BEFORE INSERT ON `he_order` FOR EACH ROW BEGIN
  INSERT INTO he_orderid_gen VALUES (NULL);
  SET NEW.orderID = CONCAT('#ORD', LPAD(LAST_INSERT_ID(), 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `he_orderid_gen`
--

CREATE TABLE `he_orderid_gen` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_orderid_gen`
--

INSERT INTO `he_orderid_gen` (`id`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `he_order_item`
--

CREATE TABLE `he_order_item` (
  `id` int(255) NOT NULL,
  `orderID` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL,
  `itemID` varchar(255) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_order_item`
--

INSERT INTO `he_order_item` (`id`, `orderID`, `userID`, `itemID`, `itemName`, `price`, `qty`, `orderDate`) VALUES
(1, '#ORD0001', '#CUST0001', '1', 'Hisense 1.0 HP Non-Inverter Air-Conditioner', '900.00', 1, '2019-04-29 12:48:37'),
(2, '#ORD0002', '#CUST0002', '#SKU0002', 'Honeywell 450sqf Air Purifier ', '1500.00', 1, '2019-05-01 06:51:46'),
(3, '#ORD0003', '#CUST0002', '#SKU0002', 'Honeywell 450sqf Air Purifier ', '1500.00', 1, '2019-05-01 07:52:08'),
(4, '#ORD0004', '#CUST0002', '#SKU0002', 'Honeywell 450sqf Air Purifier ', '1500.00', 1, '2019-05-01 10:03:36'),
(5, '#ORD0005', '#CUST0003', '#SKU0035', 'Microsoft Surface Book2 - 13', '6507.00', 1, '2019-05-02 10:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `he_order_item_temp`
--

CREATE TABLE `he_order_item_temp` (
  `row_id` int(11) NOT NULL,
  `orderID` varchar(255) NOT NULL,
  `userID` varchar(100) NOT NULL,
  `itemID` varchar(100) NOT NULL,
  `itemName` varchar(100) NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `orderDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_order_item_temp`
--

INSERT INTO `he_order_item_temp` (`row_id`, `orderID`, `userID`, `itemID`, `itemName`, `price`, `qty`, `orderDate`) VALUES
(2, '', '#CUST0003', '#SKU0016', 'Panasonic Air Pot', '474.00', 1, '2019-05-02 10:11:00'),
(3, '', '#CUST0003', '#SKU0027', 'LG 49-inch UHD TV', '1999.00', 1, '2019-05-02 15:13:05');

-- --------------------------------------------------------

--
-- Table structure for table `he_user`
--

CREATE TABLE `he_user` (
  `userID` varchar(255) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(50) NOT NULL,
  `userPassword` varchar(50) NOT NULL,
  `userNo` varchar(15) NOT NULL,
  `userGender` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_user`
--

INSERT INTO `he_user` (`userID`, `userName`, `userEmail`, `userPassword`, `userNo`, `userGender`, `role`) VALUES
('#CUST0001', 'Ahmad Razrul', 'razrul@gmail.com', '758c3fe0f3ff3ec9bace8b5724c4da33', '0182705205', 'Male', 'ADMIN'),
('#CUST0002', 'Muhammad Arif', 'arif@gmail.com', 'a0514586a408be35e9165e7eedce000e', '0172772670', 'Male', 'ADMIN'),
('#CUST0003', 'Muhd Alif', 'alif@gmail.com', 'cc381ce13dd0bd2f5dd3ec67aac562ce', '0182705205', 'Male', 'CUSTOMER'),
('#CUST0006', 'Muhammad Hisham', 'hisham@gmail.com', '86e5fba15fa485eb89fd486bfad369a9', '0122253346', 'Male', 'CUSTOMER');

--
-- Triggers `he_user`
--
DELIMITER $$
CREATE TRIGGER `id gen` BEFORE INSERT ON `he_user` FOR EACH ROW BEGIN
  INSERT INTO he_userid_gen VALUES (NULL);
  SET NEW.userID = CONCAT('#CUST', LPAD(LAST_INSERT_ID(), 4, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `he_userid_gen`
--

CREATE TABLE `he_userid_gen` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `he_userid_gen`
--

INSERT INTO `he_userid_gen` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `he_cart`
--
ALTER TABLE `he_cart`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `he_contact`
--
ALTER TABLE `he_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_feedback`
--
ALTER TABLE `he_feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_item`
--
ALTER TABLE `he_item`
  ADD PRIMARY KEY (`itemID`);

--
-- Indexes for table `he_itemid_gen`
--
ALTER TABLE `he_itemid_gen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_order`
--
ALTER TABLE `he_order`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `he_orderid_gen`
--
ALTER TABLE `he_orderid_gen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_order_item`
--
ALTER TABLE `he_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `he_order_item_temp`
--
ALTER TABLE `he_order_item_temp`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `he_user`
--
ALTER TABLE `he_user`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `he_userid_gen`
--
ALTER TABLE `he_userid_gen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `he_cart`
--
ALTER TABLE `he_cart`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `he_contact`
--
ALTER TABLE `he_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `he_feedback`
--
ALTER TABLE `he_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `he_itemid_gen`
--
ALTER TABLE `he_itemid_gen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `he_orderid_gen`
--
ALTER TABLE `he_orderid_gen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `he_order_item`
--
ALTER TABLE `he_order_item`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `he_order_item_temp`
--
ALTER TABLE `he_order_item_temp`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `he_userid_gen`
--
ALTER TABLE `he_userid_gen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
