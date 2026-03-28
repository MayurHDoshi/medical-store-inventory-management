-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 03:10 PM
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
-- Database: `mym`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `c_address` varchar(255) DEFAULT NULL,
  `c_phoneNo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `c_name`, `c_address`, `c_phoneNo`) VALUES
(1, 'ABC Pharma', '123 ABC Street, Mumbai, India', '9876543210'),
(2, 'XYZ Pharmaceuticals', '456 XYZ Road, Delhi, India', '8765432109'),
(3, 'PQR Drugs Ltd.', '789 PQR Avenue, Kolkata, India', '7654321098'),
(4, 'LMN Healthcare', '101 LMN Lane, Chennai, India', '6543210987'),
(5, 'JKL Medicines', '222 JKL Street, Bangalore, India', '5432109876'),
(6, 'MNO Biotech', '333 MNO Road, Hyderabad, India', '4321098765'),
(7, 'DEF Pharma', '444 DEF Avenue, Pune, India', '3210987654'),
(8, 'GHI Pharmaceuticals', '555 GHI Lane, Jaipur, India', '2109876543'),
(9, 'RST Drugs Ltd.', '666 RST Street, Ahmedabad, India', '1098765432'),
(10, 'VWX Healthcare', '777 VWX Road, Lucknow, India', '0987654321'),
(11, 'STU Medicines', '888 STU Avenue, Chandigarh, India', '9876543210'),
(12, 'NOP Biotech', '999 NOP Street, Indore, India', '8765432109'),
(13, 'JKM Pharma', '111 JKM Road, Bhopal, India', '7654321098'),
(14, 'ABC Pharmaceuticals', '222 ABC Lane, Surat, India', '6543210987'),
(15, 'XYZ Drugs Ltd.', '333 XYZ Avenue, Visakhapatnam, India', '5432109876');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) UNSIGNED NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_id`, `medicine_id`, `quantity`) VALUES
(1, 1, 15),
(2, 2, 18),
(3, 3, 12),
(4, 4, 16),
(5, 5, 14),
(6, 6, 10),
(7, 7, 17),
(8, 8, 19),
(9, 9, 11),
(10, 10, 63),
(11, 11, 125),
(12, 12, 55),
(13, 13, 32),
(14, 14, 33),
(15, 15, 56),
(16, 16, 38),
(17, 17, 47),
(18, 18, 61),
(19, 19, 84),
(20, 20, 29),
(21, 21, 35),
(22, 22, 40),
(23, 23, 32),
(24, 24, 38),
(25, 25, 36),
(26, 26, 33),
(27, 27, 37),
(28, 28, 31),
(29, 29, 34),
(30, 30, 39),
(31, 31, 45),
(32, 32, 50),
(33, 33, 42),
(34, 34, 48),
(35, 35, 46),
(36, 36, 43),
(37, 37, 47),
(38, 38, 41),
(39, 39, 44),
(40, 40, 49),
(41, 41, 55),
(42, 42, 60),
(43, 43, 52),
(44, 44, 58),
(45, 45, 56),
(46, 46, 53),
(47, 47, 57),
(48, 48, 51),
(49, 49, 54),
(50, 50, 59),
(51, 51, 65),
(52, 52, 70),
(53, 53, 62),
(54, 54, 68),
(55, 55, 66),
(56, 56, 63),
(57, 57, 67),
(58, 58, 61),
(59, 59, 64),
(60, 60, 69),
(61, 61, 75),
(62, 62, 80),
(63, 63, 72),
(64, 64, 78),
(65, 65, 76),
(66, 66, 73),
(67, 67, 77),
(68, 68, 71),
(69, 69, 74),
(70, 70, 79),
(71, 71, 85),
(72, 72, 90),
(73, 73, 82),
(74, 74, 88),
(75, 75, 86),
(76, 76, 83),
(77, 77, 87),
(78, 78, 81),
(79, 79, 84),
(80, 80, 89),
(81, 81, 95),
(82, 82, 100),
(83, 83, 92),
(84, 84, 98),
(85, 85, 96),
(86, 86, 93),
(87, 87, 97),
(88, 88, 91),
(89, 89, 94),
(90, 90, 99),
(91, 91, 105),
(92, 92, 110),
(93, 93, 102),
(94, 94, 108),
(95, 95, 106),
(96, 96, 103),
(97, 97, 107),
(98, 98, 101),
(99, 99, 104),
(100, 100, 109);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `medicine_id` int(11) NOT NULL,
  `m_name` varchar(255) NOT NULL,
  `m_mrp` decimal(10,2) NOT NULL,
  `m_composition` varchar(255) DEFAULT NULL,
  `m_packaging` varchar(50) DEFAULT NULL,
  `m_location` varchar(50) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`medicine_id`, `m_name`, `m_mrp`, `m_composition`, `m_packaging`, `m_location`, `company_id`) VALUES
(1, 'Paracetamol', 10.50, 'Paracetamol 500mg', 'Tablets', '25', 1),
(2, 'Amoxicillin', 15.75, 'Amoxicillin 250mg', 'Capsules', '55', 2),
(3, 'Ibuprofen', 20.25, 'Ibuprofen 400mg', 'Tablets', '105', 3),
(4, 'Ciprofloxacin', 30.00, 'Ciprofloxacin 500mg', 'Tablets', '125', 4),
(5, 'Lansoprazole', 45.80, 'Lansoprazole 30mg', 'Capsules', '75', 5),
(6, 'Omeprazole', 55.60, 'Omeprazole 20mg', 'Capsules', '45', 6),
(7, 'Atorvastatin', 70.30, 'Atorvastatin 10mg', 'Tablets', '175', 7),
(8, 'Simvastatin', 80.90, 'Simvastatin 20mg', 'Tablets', '15', 8),
(9, 'Metformin', 100.00, 'Metformin 500mg', 'Tablets', '95', 9),
(10, 'Losartan', 120.50, 'Losartan 50mg', 'Tablets', '185', 10),
(11, 'Amlodipine', 130.25, 'Amlodipine 5mg', 'Tablets', '35', 11),
(12, 'Salbutamol', 150.75, 'Salbutamol 100mcg', 'Inhaler', '65', 12),
(13, 'Levothyroxine', 200.25, 'Levothyroxine 50mcg', 'Tablets', '145', 13),
(14, 'Metronidazole', 250.00, 'Metronidazole 200mg', 'Tablets', '155', 14),
(15, 'Diazepam', 300.50, 'Diazepam 5mg', 'Tablets', '195', 15),
(16, 'Tramadol', 350.75, 'Tramadol 50mg', 'Capsules', '85', 1),
(17, 'Cetirizine', 400.25, 'Cetirizine 10mg', 'Tablets', '175', 2),
(18, 'Dexamethasone', 450.50, 'Dexamethasone 4mg', 'Tablets', '115', 3),
(19, 'Aspirin', 500.00, 'Aspirin 75mg', 'Tablets', '185', 4),
(20, 'Esomeprazole', 550.75, 'Esomeprazole 40mg', 'Capsules', '35', 5),
(21, 'Metoprolol', 600.25, 'Metoprolol 25mg', 'Tablets', '125', 6),
(22, 'Warfarin', 650.50, 'Warfarin 2mg', 'Tablets', '95', 7),
(23, 'Fluoxetine', 700.00, 'Fluoxetine 20mg', 'Capsules', '45', 8),
(24, 'Sertraline', 750.75, 'Sertraline 50mg', 'Tablets', '175', 9),
(25, 'Clopidogrel', 800.25, 'Clopidogrel 75mg', 'Tablets', '155', 10),
(26, 'Ranitidine', 850.50, 'Ranitidine 150mg', 'Tablets', '185', 11),
(27, 'Gabapentin', 900.00, 'Gabapentin 300mg', 'Capsules', '165', 12),
(28, 'Morphine', 950.75, 'Morphine 10mg', 'Tablets', '195', 13),
(29, 'Levofloxacin', 1000.25, 'Levofloxacin 500mg', 'Tablets', '25', 14),
(30, 'Phenytoin', 1050.50, 'Phenytoin 100mg', 'Capsules', '115', 15),
(31, 'Furosemide', 1100.00, 'Furosemide 40mg', 'Tablets', '195', 1),
(32, 'Prednisone', 1150.75, 'Prednisone 5mg', 'Tablets', '75', 2),
(33, 'Amphetamine', 1200.25, 'Amphetamine 10mg', 'Tablets', '35', 3),
(34, 'Clindamycin', 1250.50, 'Clindamycin 150mg', 'Capsules', '155', 4),
(35, 'Hydrochlorothiazide', 1300.75, 'Hydrochlorothiazide 12.5mg', 'Tablets', '85', 5),
(36, 'Nitroglycerin', 1350.25, 'Nitroglycerin 0.4mg', 'Sublingual Tablets', '125', 6),
(37, 'Pantoprazole', 1400.00, 'Pantoprazole 40mg', 'Tablets', '75', 7),
(38, 'Prednisolone', 1450.75, 'Prednisolone 10mg', 'Tablets', '185', 8),
(39, 'Levetiracetam', 1500.25, 'Levetiracetam 500mg', 'Tablets', '155', 9),
(40, 'Cephalexin', 1550.50, 'Cephalexin 250mg', 'Capsules', '25', 10),
(41, 'Amoxicillin-Clavulanate', 1600.75, 'Amoxicillin-Clavulanate 625mg', 'Tablets', '165', 11),
(42, 'Atenolol', 1650.25, 'Atenolol 25mg', 'Tablets', '125', 12),
(43, 'Acetaminophen', 1700.00, 'Acetaminophen 500mg', 'Tablets', '95', 13),
(44, 'Cyclobenzaprine', 1750.75, 'Cyclobenzaprine 10mg', 'Tablets', '35', 14),
(45, 'Alprazolam', 1800.25, 'Alprazolam 0.25mg', 'Tablets', '195', 15),
(46, 'Tamsulosin', 1850.50, 'Tamsulosin 0.4mg', 'Capsules', '85', 1),
(47, 'Metoclopramide', 1900.75, 'Metoclopramide 10mg', 'Tablets', '155', 2),
(48, 'Duloxetine', 1950.25, 'Duloxetine 30mg', 'Capsules', '125', 3),
(49, 'Meloxicam', 2000.50, 'Meloxicam 15mg', 'Tablets', '75', 4),
(50, 'Sildenafil', 2050.75, 'Sildenafil 50mg', 'Tablets', '175', 5),
(51, 'Tadalafil', 2100.25, 'Tadalafil 10mg', 'Tablets', '35', 6),
(52, 'Finasteride', 2150.50, 'Finasteride 5mg', 'Tablets', '195', 7),
(53, 'Methylprednisolone', 2200.00, 'Methylprednisolone 4mg', 'Tablets', '185', 8),
(54, 'Lisinopril', 2250.75, 'Lisinopril 10mg', 'Tablets', '155', 9),
(55, 'Ciprofloxacin-Dexamethasone', 2300.25, 'Ciprofloxacin-Dexamethasone 0.3%', 'Ear Drops', '25', 10),
(56, 'Fluconazole', 2350.50, 'Fluconazole 150mg', 'Capsules', '115', 11),
(57, 'Risperidone', 2400.75, 'Risperidone 1mg', 'Tablets', '95', 12),
(58, 'Lorazepam', 2450.25, 'Lorazepam 1mg', 'Tablets', '35', 13),
(59, 'Metoprolol', 2500.50, 'Metoprolol 50mg', 'Tablets', '155', 14),
(60, 'Hydromorphone', 2550.75, 'Hydromorphone 2mg', 'Tablets', '195', 15),
(61, 'Mirtazapine', 2600.25, 'Mirtazapine 15mg', 'Tablets', '85', 1),
(62, 'Naproxen', 2650.50, 'Naproxen 250mg', 'Tablets', '155', 2),
(63, 'Carvedilol', 2700.75, 'Carvedilol 12.5mg', 'Tablets', '125', 3),
(64, 'Clotrimazole', 2750.25, 'Clotrimazole 1%', 'Topical Cream', '75', 4),
(65, 'Desvenlafaxine', 2800.50, 'Desvenlafaxine 50mg', 'Tablets', '175', 5),
(66, 'Hydroxyzine', 2850.75, 'Hydroxyzine 25mg', 'Tablets', '35', 6),
(67, 'Meclizine', 2900.25, 'Meclizine 25mg', 'Tablets', '195', 7),
(68, 'Ondansetron', 2950.50, 'Ondansetron 4mg', 'Tablets', '85', 8),
(69, 'Letrozole', 3000.75, 'Letrozole 2.5mg', 'Tablets', '155', 9),
(70, 'Clonidine', 3050.25, 'Clonidine 0.1mg', 'Tablets', '25', 10),
(71, 'Hydrocortisone', 3100.50, 'Hydrocortisone 1%', 'Topical Cream', '115', 11),
(72, 'Fluticasone', 3150.75, 'Fluticasone 50mcg', 'Nasal Spray', '95', 12),
(73, 'Folic Acid', 3200.25, 'Folic Acid 5mg', 'Tablets', '35', 13),
(74, 'Montelukast', 3250.50, 'Montelukast 10mg', 'Tablets', '155', 14),
(75, 'Norgestimate-Ethinyl Estradiol', 3300.75, 'Norgestimate-Ethinyl Estradiol 0.25-0.035mg', 'Tablets', '195', 15),
(76, 'Nitrofurantoin', 3350.25, 'Nitrofurantoin 100mg', 'Capsules', '85', 1),
(77, 'Rifampin', 3400.50, 'Rifampin 300mg', 'Capsules', '155', 2),
(78, 'Thiamine', 3450.75, 'Thiamine 100mg', 'Tablets', '125', 3),
(79, 'Allopurinol', 3500.25, 'Allopurinol 100mg', 'Tablets', '75', 4),
(80, 'Mupirocin', 3550.50, 'Mupirocin 2%', 'Topical Cream', '175', 5),
(81, 'Doxycycline', 3600.75, 'Doxycycline 100mg', 'Capsules', '35', 6),
(82, 'Oxycodone', 3650.25, 'Oxycodone 5mg', 'Tablets', '195', 7),
(83, 'Bupropion', 3700.50, 'Bupropion 150mg', 'Tablets', '85', 8),
(84, 'Celecoxib', 3750.75, 'Celecoxib 200mg', 'Capsules', '155', 9),
(85, 'Tizanidine', 3800.25, 'Tizanidine 2mg', 'Tablets', '25', 10),
(86, 'Melatonin', 3850.50, 'Melatonin 3mg', 'Tablets', '115', 11),
(87, 'Citalopram', 3900.75, 'Citalopram 20mg', 'Tablets', '95', 12),
(88, 'Diazepam', 3950.25, 'Diazepam 2mg', 'Tablets', '35', 13),
(89, 'Albuterol', 4000.50, 'Albuterol 2.5mg', 'Inhaler', '155', 14),
(90, 'Clobetasol', 4050.75, 'Clobetasol 0.05%', 'Topical Cream', '195', 15),
(91, 'Insulin Glargine', 4100.25, 'Insulin Glargine 100units/mL', 'Injectable Solution', '85', 1),
(92, 'Levothyroxine', 4150.50, 'Levothyroxine 100mcg', 'Tablets', '155', 2),
(93, 'Budesonide', 4200.75, 'Budesonide 3mg', 'Capsules', '125', 3),
(94, 'Naltrexone', 4250.25, 'Naltrexone 50mg', 'Tablets', '75', 4),
(95, 'Ropinirole', 4300.50, 'Ropinirole 0.25mg', 'Tablets', '175', 5),
(96, 'Alendronate', 4350.75, 'Alendronate 70mg', 'Tablets', '35', 6),
(97, 'Baclofen', 4400.25, 'Baclofen 10mg', 'Tablets', '195', 7),
(98, 'Dicyclomine', 4450.50, 'Dicyclomine 10mg', 'Tablets', '85', 8),
(99, 'Ezetimibe', 4500.75, 'Ezetimibe 10mg', 'Tablets', '155', 9),
(100, 'Ethinyl Estradiol', 4550.25, 'Ethinyl Estradiol 0.035mg', 'Tablets', '25', 10);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_items_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `medicine_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_items_id`, `quantity`, `medicine_id`, `order_id`) VALUES
(194, 50, 10, 1),
(195, 100, 11, 2),
(196, 25, 12, 3),
(197, 10, 13, 4),
(198, 5, 14, 6),
(199, 30, 15, 7),
(200, 15, 16, 8),
(201, 20, 17, 9),
(202, 40, 18, 10),
(203, 60, 19, 11);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_phoneNo` varchar(20) DEFAULT NULL,
  `s_address` varchar(255) DEFAULT NULL,
  `s_mail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `s_name`, `s_phoneNo`, `s_address`, `s_mail`) VALUES
(1, 'ABC Pharmaceuticals', '9876543210', '123, Main Street, Bangalore, Karnataka', 'abcpharma@example.com'),
(2, 'XYZ Healthcare', '8765432109', '456, Park Avenue, Mumbai, Maharashtra', 'xyzhealthcare@example.com'),
(3, 'PQR Distributors', '7654321098', '789, Lake Road, Chennai, Tamil Nadu', 'pqrdistributors@example.com'),
(4, 'LMN Suppliers', '6543210987', '101, Ridge Street, Kolkata, West Bengal', 'lmnsuppliers@example.com'),
(5, 'DEF Pharma', '5432109876', '234, Forest Lane, Hyderabad, Telangana', 'defpharma@example.com'),
(6, 'GHI Pharmaceuticals', '4321098765', '567, Ocean View, Pune, Maharashtra', 'ghipharma@example.com'),
(7, 'JKL Distributors', '3210987654', '890, Mountain Drive, Ahmedabad, Gujarat', 'jkl@example.com'),
(8, 'MNO Healthcare', '2109876543', '111, River Road, Jaipur, Rajasthan', 'mnohealthcare@example.com'),
(9, 'RST Distributors', '1098765432', '222, Valley Street, Lucknow, Uttar Pradesh', 'rst@example.com'),
(10, 'UVW Suppliers', '0987654321', '333, Hillside Avenue, Chandigarh', 'uvw@example.com'),
(11, 'PQS Pharmaceuticals', '9876543210', '444, Sunrise Boulevard, Patna, Bihar', 'pqspharma@example.com'),
(12, 'MRS Healthcare', '8765432109', '555, Sunset Road, Guwahati, Assam', 'mrshealthcare@example.com'),
(13, 'JKI Distributors', '7654321098', '666, Meadow Lane, Kochi, Kerala', 'jki@example.com'),
(14, 'FGH Pharma', '6543210987', '777, Hillcrest Drive, Bhopal, Madhya Pradesh', 'fghpharma@example.com'),
(15, 'NOP Healthcare', '5432109876', '888, Garden Road, Dehradun, Uttarakhand', 'nophealthcare@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `sup_order`
--

CREATE TABLE `sup_order` (
  `order_id` int(11) NOT NULL,
  `o_date` date NOT NULL,
  `delivery_date` date DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sup_order`
--

INSERT INTO `sup_order` (`order_id`, `o_date`, `delivery_date`, `order_status`, `supplier_id`) VALUES
(1, '2024-04-20', '2024-07-10', 'Delivered', 1),
(2, '2024-03-20', '2024-03-31', 'Pending', 2),
(3, '2024-06-25', '2024-10-28', 'Delivered', 3),
(4, '2025-03-28', '2025-04-03', 'Delivered', 4),
(6, '2024-01-15', '2024-03-20', 'Delivered', 3),
(7, '2024-05-10', '2024-05-20', 'Pending', 5),
(8, '2024-08-02', '2024-08-15', 'Pending', 6),
(9, '2024-11-10', '2024-11-15', 'Delivered', 7),
(10, '2024-02-05', '2024-03-10', 'Delivered', 8),
(11, '2024-09-15', '2024-10-25', 'Pending', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`medicine_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_items_id`),
  ADD KEY `medicine_id` (`medicine_id`),
  ADD KEY `order_items_ibfk_2` (`order_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `sup_order`
--
ALTER TABLE `sup_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `medicine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `sup_order`
--
ALTER TABLE `sup_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`medicine_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `sup_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sup_order`
--
ALTER TABLE `sup_order`
  ADD CONSTRAINT `sup_order_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
