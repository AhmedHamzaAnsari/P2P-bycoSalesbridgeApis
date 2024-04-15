-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2024 at 03:57 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bycobridge`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_black_spot`
--

CREATE TABLE `action_black_spot` (
  `id` int(11) NOT NULL,
  `alert_id` varchar(45) NOT NULL,
  `is_authorize` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `driver_cnic` varchar(255) NOT NULL,
  `who_is_responsible` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `action_excess_driving`
--

CREATE TABLE `action_excess_driving` (
  `id` int(11) NOT NULL,
  `alert_id` varchar(45) NOT NULL,
  `is_authorize` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `driver_cnic` varchar(255) NOT NULL,
  `who_is_responsible` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `action_night_voilation`
--

CREATE TABLE `action_night_voilation` (
  `id` int(11) NOT NULL,
  `alert_id` varchar(45) NOT NULL,
  `is_authorize` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `driver_cnic` varchar(255) NOT NULL,
  `who_is_responsible` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `action_nr`
--

CREATE TABLE `action_nr` (
  `id` int(11) NOT NULL,
  `alert_id` varchar(45) NOT NULL,
  `is_authorize` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `driver_cnic` varchar(255) NOT NULL,
  `who_is_responsible` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `action_overspeed`
--

CREATE TABLE `action_overspeed` (
  `id` int(11) NOT NULL,
  `alert_id` varchar(45) NOT NULL,
  `is_authorize` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `driver_cnic` varchar(255) NOT NULL,
  `who_is_responsible` varchar(255) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_blackspot_voiltion`
--

CREATE TABLE `activity_blackspot_voiltion` (
  `id` int(11) NOT NULL,
  `vehicle_id` varchar(45) NOT NULL,
  `vehicle_name` varchar(45) NOT NULL,
  `blackspot_id` varchar(45) NOT NULL,
  `blackspot_name` varchar(45) NOT NULL,
  `in_time` varchar(45) NOT NULL,
  `out_time` varchar(255) NOT NULL,
  `in_duration` varchar(45) NOT NULL,
  `cartraige_id` varchar(45) NOT NULL,
  `cartraige_name` varchar(45) NOT NULL,
  `time_peiod` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_contact`
--

CREATE TABLE `activity_contact` (
  `id` int(11) NOT NULL,
  `cartrauge_id` int(11) NOT NULL,
  `contact` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_excess_driving_voiltion`
--

CREATE TABLE `activity_excess_driving_voiltion` (
  `id` int(11) NOT NULL,
  `vehicle_id` varchar(45) NOT NULL,
  `vehicle_name` varchar(45) NOT NULL,
  `time` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `duration` varchar(45) NOT NULL,
  `cartraige_id` varchar(45) NOT NULL,
  `cartraige_name` varchar(45) NOT NULL,
  `time_peiod` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_night_voilation_voiltion`
--

CREATE TABLE `activity_night_voilation_voiltion` (
  `id` int(11) NOT NULL,
  `vehicle_id` varchar(45) NOT NULL,
  `vehicle_name` varchar(45) NOT NULL,
  `speed` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time` varchar(45) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL,
  `cartraige_id` varchar(45) NOT NULL,
  `cartriage_name` varchar(45) NOT NULL,
  `time_peiod` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_nr_voiltion`
--

CREATE TABLE `activity_nr_voiltion` (
  `id` int(11) NOT NULL,
  `vehicle_id` varchar(45) NOT NULL,
  `vehicle_name` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time` varchar(45) NOT NULL,
  `speed` varchar(45) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL,
  `cartraige_id` varchar(45) NOT NULL,
  `cartriage_name` varchar(45) NOT NULL,
  `time_peiod` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_overspeed_voiltion`
--

CREATE TABLE `activity_overspeed_voiltion` (
  `id` int(11) NOT NULL,
  `vehicle_id` varchar(45) NOT NULL,
  `vehicle_name` varchar(45) NOT NULL,
  `speed` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `time` varchar(45) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` varchar(45) NOT NULL,
  `longitude` varchar(45) NOT NULL,
  `cartraige_id` varchar(45) NOT NULL,
  `cartriage_name` varchar(45) NOT NULL,
  `time_peiod` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activity_time_check`
--

CREATE TABLE `activity_time_check` (
  `id` int(11) NOT NULL,
  `device_id` varchar(45) NOT NULL,
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `idel_time` varchar(45) NOT NULL,
  `stop_time` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin_distibutor`
--

CREATE TABLE `admin_distibutor` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(255) NOT NULL,
  `distributor_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `all_products`
--

CREATE TABLE `all_products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `approved_order`
--

CREATE TABLE `approved_order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(45) NOT NULL,
  `approved_time` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `is_special_approval` varchar(45) NOT NULL DEFAULT '0',
  `approved_by` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `app_user_dealer_visits`
--

CREATE TABLE `app_user_dealer_visits` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `date` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `status_value` varchar(45) NOT NULL DEFAULT 'Pending',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `axcess_driving_alerts`
--

CREATE TABLE `axcess_driving_alerts` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL DEFAULT '0',
  `vehicle_id` varchar(45) NOT NULL,
  `vehicle_name` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `driving_limit` varchar(45) NOT NULL,
  `excess_driving` varchar(45) NOT NULL,
  `duration` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bulkdatanew`
--

CREATE TABLE `bulkdatanew` (
  `id` int(255) NOT NULL,
  `imei` varchar(255) DEFAULT NULL,
  `st_server` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lng` varchar(255) DEFAULT NULL,
  `angle` varchar(255) DEFAULT NULL,
  `speed` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sim_number` varchar(255) DEFAULT NULL,
  `odometer` varchar(255) DEFAULT NULL,
  `list` varchar(355) DEFAULT NULL,
  `protocol` varchar(255) DEFAULT NULL,
  `last_idle` varchar(255) DEFAULT NULL,
  `last_move` varchar(255) DEFAULT NULL,
  `last_stop` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cartraige_sms_log`
--

CREATE TABLE `cartraige_sms_log` (
  `id` int(11) NOT NULL,
  `send_to` varchar(45) NOT NULL,
  `message` varchar(200) CHARACTER SET utf16 NOT NULL,
  `time` datetime DEFAULT NULL,
  `cartaige_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cartrauge_depot_check`
--

CREATE TABLE `cartrauge_depot_check` (
  `id` int(11) NOT NULL,
  `cartrauge_id` varchar(45) NOT NULL,
  `sms_alerts` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `priority` varchar(20) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` varchar(20) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `status_value` varchar(45) NOT NULL DEFAULT 'Pending',
  `Comments` varchar(45) NOT NULL,
  `complaint_no` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_damage`
--

CREATE TABLE `complaint_damage` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complaint_object_part`
--

CREATE TABLE `complaint_object_part` (
  `id` int(11) NOT NULL,
  `object_name` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `consignee_contact`
--

CREATE TABLE `consignee_contact` (
  `id` int(11) NOT NULL,
  `geo_id` varchar(45) NOT NULL,
  `contact_1` varchar(45) NOT NULL,
  `contact_2` varchar(45) DEFAULT NULL,
  `contact_3` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `containers_sizes`
--

CREATE TABLE `containers_sizes` (
  `id` int(11) NOT NULL,
  `sizes` int(11) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers`
--

CREATE TABLE `dealers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `privilege` varchar(45) NOT NULL DEFAULT 'Dealer',
  `sap_no` varchar(45) NOT NULL,
  `co-ordinates` varchar(1000) NOT NULL,
  `city` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `contact` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `actual_depot` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `housekeeping` varchar(45) NOT NULL,
  `no_lorries` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL DEFAULT 'circle',
  `zm` varchar(45) NOT NULL,
  `tm` varchar(45) NOT NULL,
  `asm` varchar(45) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `indent_price` varchar(45) NOT NULL DEFAULT '0',
  `Nozel_price` varchar(45) NOT NULL DEFAULT '0',
  `acount` varchar(45) NOT NULL DEFAULT '0',
  `parent_id` varchar(45) NOT NULL,
  `district` varchar(45) NOT NULL,
  `join_date` varchar(45) NOT NULL,
  `region` varchar(45) NOT NULL,
  `terr` varchar(45) NOT NULL,
  `cat_1` varchar(45) NOT NULL,
  `cat_2` varchar(45) NOT NULL,
  `develop_type` varchar(45) NOT NULL,
  `finance` varchar(45) NOT NULL,
  `owner_name` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_cluster_main`
--

CREATE TABLE `dealers_cluster_main` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `gasoline` varchar(45) NOT NULL,
  `hsd` varchar(45) NOT NULL,
  `motol` varchar(45) NOT NULL,
  `cng` varchar(45) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_cluster_sub`
--

CREATE TABLE `dealers_cluster_sub` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `omc_id` varchar(45) NOT NULL,
  `side` varchar(45) NOT NULL,
  `gasoline` varchar(45) NOT NULL,
  `hsd` varchar(45) NOT NULL,
  `motor` varchar(45) NOT NULL,
  `cng` varchar(45) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `coordinates` varchar(500) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_complaint`
--

CREATE TABLE `dealers_complaint` (
  `id` int(11) NOT NULL,
  `object_part_id` varchar(45) NOT NULL,
  `damage_overview_id` varchar(45) NOT NULL,
  `damage` varchar(45) NOT NULL,
  `text` varchar(45) NOT NULL,
  `cause_text` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_depots`
--

CREATE TABLE `dealers_depots` (
  `id` int(11) NOT NULL,
  `dealers_id` varchar(45) NOT NULL,
  `depot_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_dispenser`
--

CREATE TABLE `dealers_dispenser` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_factilities`
--

CREATE TABLE `dealers_factilities` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_lorries`
--

CREATE TABLE `dealers_lorries` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `lorry_no` varchar(45) NOT NULL,
  `product` varchar(45) NOT NULL,
  `min_limit` varchar(45) NOT NULL,
  `max_limit` varchar(45) NOT NULL,
  `current_dip` varchar(45) NOT NULL DEFAULT '0',
  `current_reading` varchar(45) NOT NULL DEFAULT '0',
  `update_time` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_monthly_targets`
--

CREATE TABLE `dealers_monthly_targets` (
  `id` int(11) NOT NULL,
  `date_month` varchar(45) NOT NULL,
  `target_amount` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_nozzel`
--

CREATE TABLE `dealers_nozzel` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `products` varchar(45) NOT NULL,
  `tank_id` varchar(45) NOT NULL,
  `dispenser_id` varchar(45) NOT NULL,
  `last_reading` varchar(45) NOT NULL DEFAULT '0',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_nozzel_readings`
--

CREATE TABLE `dealers_nozzel_readings` (
  `id` int(11) NOT NULL,
  `nozle_id` varchar(45) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `dispenser_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `old_reading` varchar(45) NOT NULL,
  `new_reading` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_products`
--

CREATE TABLE `dealers_products` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `from` varchar(45) NOT NULL,
  `to` varchar(45) NOT NULL,
  `indent_price` varchar(45) NOT NULL,
  `nozel_price` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `update_time` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_profitability`
--

CREATE TABLE `dealers_profitability` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `retailer_profitability` varchar(255) NOT NULL,
  `cf` varchar(45) NOT NULL,
  `sf` varchar(45) NOT NULL,
  `df` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_profitability_main`
--

CREATE TABLE `dealers_profitability_main` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `cf_total` varchar(1000) NOT NULL,
  `sf_total` varchar(1000) NOT NULL,
  `df_total` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_stock_variations`
--

CREATE TABLE `dealers_stock_variations` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `opening_stock` varchar(45) NOT NULL,
  `purchase_during_inspection_period` varchar(45) NOT NULL,
  `total_product_available_for_sale` varchar(45) NOT NULL,
  `sales_as_per_meter_reading` varchar(45) NOT NULL,
  `book_stock` varchar(45) NOT NULL,
  `current_physical_stock` varchar(45) NOT NULL,
  `gain_loss` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealers_tanks_nozels`
--

CREATE TABLE `dealers_tanks_nozels` (
  `id` int(11) NOT NULL,
  `tank_id` varchar(45) NOT NULL,
  `nozel_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_account`
--

CREATE TABLE `dealer_account` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `account` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_casual_visits`
--

CREATE TABLE `dealer_casual_visits` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `users_id` varchar(45) NOT NULL,
  `visit_time` varchar(45) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_dip_log`
--

CREATE TABLE `dealer_dip_log` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `tank_id` varchar(45) NOT NULL,
  `previous_dip` varchar(45) NOT NULL,
  `current_dip` varchar(45) NOT NULL,
  `old_reading` varchar(45) NOT NULL DEFAULT '0',
  `current_reading` varchar(45) NOT NULL DEFAULT '0',
  `datetime` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_inspection_price_check`
--

CREATE TABLE `dealer_inspection_price_check` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `ogra_price` varchar(45) NOT NULL,
  `pump_price` varchar(45) NOT NULL,
  `variance` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_inspection_quality_check`
--

CREATE TABLE `dealer_inspection_quality_check` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `response` varchar(255) NOT NULL,
  `files` varchar(1000) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_inspection_quantity_check`
--

CREATE TABLE `dealer_inspection_quantity_check` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `dispenser_id` varchar(45) NOT NULL,
  `nozle_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `result` varchar(45) NOT NULL,
  `totalizer` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_ledger_log`
--

CREATE TABLE `dealer_ledger_log` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `old_ledger` varchar(45) NOT NULL,
  `new_ledger` varchar(45) NOT NULL,
  `datetime` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_measurement_pricing`
--

CREATE TABLE `dealer_measurement_pricing` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `dispenser_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `pmg_accurate` varchar(45) NOT NULL,
  `shortage_pmg` varchar(45) NOT NULL,
  `hsd_accurate` varchar(45) NOT NULL,
  `shortage_hsd` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_measurement_pricing_action`
--

CREATE TABLE `dealer_measurement_pricing_action` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `appreation` varchar(1000) NOT NULL,
  `measure_taken` varchar(1000) NOT NULL,
  `warning` varchar(1000) NOT NULL,
  `pmg_ogra_price` varchar(45) NOT NULL,
  `pmg_pump_price` varchar(45) NOT NULL,
  `pmg_variance` varchar(45) NOT NULL,
  `hsd_ogra_price` varchar(45) NOT NULL,
  `hsd_pump_price` varchar(45) NOT NULL,
  `hsd_variance` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_nozel_price_log`
--

CREATE TABLE `dealer_nozel_price_log` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `indent_price` varchar(45) NOT NULL,
  `nozel_price` varchar(45) NOT NULL,
  `from` varchar(45) NOT NULL,
  `to` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_reconcilation`
--

CREATE TABLE `dealer_reconcilation` (
  `id` int(11) NOT NULL,
  `nozle_id` varchar(45) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `dispenser_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `old_reading` varchar(45) NOT NULL,
  `new_reading` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_stock_recon_new`
--

CREATE TABLE `dealer_stock_recon_new` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `total_days` varchar(45) NOT NULL,
  `last_recon_date` varchar(45) NOT NULL,
  `tanks` longtext NOT NULL,
  `sum_of_opening` varchar(250) NOT NULL,
  `sum_of_closing` varchar(250) NOT NULL,
  `nozzel` longtext NOT NULL,
  `total_sales` varchar(250) NOT NULL,
  `total_recipt` varchar(250) NOT NULL,
  `book_value` varchar(250) NOT NULL,
  `variance` varchar(250) NOT NULL,
  `remark` varchar(250) NOT NULL,
  `shortage_claim` varchar(250) NOT NULL,
  `variance_of_sales` varchar(250) NOT NULL,
  `average_daily_sales` varchar(250) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_target_response_return`
--

CREATE TABLE `dealer_target_response_return` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `monthly_target` varchar(45) NOT NULL,
  `target_achived` varchar(45) NOT NULL,
  `differnce` varchar(45) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_users`
--

CREATE TABLE `dealer_users` (
  `id` int(11) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dealer_wet_stock`
--

CREATE TABLE `dealer_wet_stock` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `tank_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `product_id` varchar(45) NOT NULL,
  `dip_old` varchar(45) NOT NULL,
  `dip_new` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `decant_category`
--

CREATE TABLE `decant_category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '1',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `decant_category_questions`
--

CREATE TABLE `decant_category_questions` (
  `id` int(11) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question` varchar(255) NOT NULL,
  `file` varchar(45) NOT NULL DEFAULT 'required',
  `status` varchar(45) NOT NULL DEFAULT '1',
  `answer` varchar(45) NOT NULL,
  `dpt` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `decant_response`
--

CREATE TABLE `decant_response` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `response` varchar(45) NOT NULL,
  `comment` varchar(1055) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `decant_response_files`
--

CREATE TABLE `decant_response_files` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `file` varchar(1000) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `decant_response_main`
--

CREATE TABLE `decant_response_main` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `data` longtext NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `header_data` mediumtext NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department_forms`
--

CREATE TABLE `department_forms` (
  `id` int(11) NOT NULL,
  `department_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department_users`
--

CREATE TABLE `department_users` (
  `id` int(11) NOT NULL,
  `department_id` varchar(45) NOT NULL,
  `parent_id` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `is_parent` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `depot_check`
--

CREATE TABLE `depot_check` (
  `id` int(11) NOT NULL,
  `veh_id` varchar(255) NOT NULL,
  `geo_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `in_time` varchar(255) NOT NULL,
  `log` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `depot_users`
--

CREATE TABLE `depot_users` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `depot_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `devicesnew`
--

CREATE TABLE `devicesnew` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `uniqueId` bigint(20) DEFAULT NULL,
  `latestPosition_id` bigint(20) DEFAULT NULL,
  `device_type` int(11) NOT NULL,
  `trackername` varchar(255) NOT NULL,
  `organisation` varchar(255) DEFAULT NULL,
  `tracker` varchar(50) NOT NULL,
  `speed` int(11) DEFAULT 1000,
  `speedlimit` int(11) DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `angle` int(11) DEFAULT NULL,
  `imei` varchar(255) DEFAULT NULL,
  `odometer` varchar(225) DEFAULT NULL,
  `ignition` varchar(45) NOT NULL,
  `lasttime` datetime DEFAULT NULL,
  `activedate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distributor_end_user`
--

CREATE TABLE `distributor_end_user` (
  `id` int(11) NOT NULL,
  `distributor_id` varchar(255) NOT NULL,
  `end_user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `distributor_view`
-- (See below for the actual view)
--
CREATE TABLE `distributor_view` (
`admin_id` varchar(255)
,`distributor_id` varchar(255)
,`admin_name` varchar(255)
,`dis_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `driver_detail`
--

CREATE TABLE `driver_detail` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cnic` varchar(255) NOT NULL,
  `mobile_no` varchar(255) NOT NULL,
  `privilage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `driver_training`
--

CREATE TABLE `driver_training` (
  `id` int(11) NOT NULL,
  `s_no` varchar(255) NOT NULL,
  `date` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `son_of` varchar(45) NOT NULL,
  `cnic` varchar(45) NOT NULL,
  `contact` varchar(45) NOT NULL,
  `licence` varchar(45) NOT NULL,
  `training_place` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `driver_vehicles`
--

CREATE TABLE `driver_vehicles` (
  `id` int(11) NOT NULL,
  `driver_id` varchar(45) NOT NULL,
  `vehicle_id` varchar(45) NOT NULL,
  `created_on` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `driving_alerts`
--

CREATE TABLE `driving_alerts` (
  `id` int(11) NOT NULL,
  `pos_id` varchar(255) NOT NULL,
  `type` varchar(45) NOT NULL,
  `is_load` varchar(45) NOT NULL DEFAULT '0',
  `message` varchar(500) NOT NULL,
  `description` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `device_id` varchar(45) DEFAULT NULL,
  `geo_id` varchar(45) DEFAULT NULL,
  `in_time` varchar(255) DEFAULT NULL,
  `lat` varchar(1000) DEFAULT NULL,
  `lng` varchar(1000) DEFAULT NULL,
  `speed` varchar(45) DEFAULT NULL,
  `time` varchar(45) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `email_scedule`
--

CREATE TABLE `email_scedule` (
  `id` int(11) NOT NULL,
  `report` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(11) NOT NULL,
  `from` varchar(45) NOT NULL,
  `to` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in structure for view `enduser_view`
-- (See below for the actual view)
--
CREATE TABLE `enduser_view` (
`distributor_id` varchar(255)
,`end_user_id` varchar(255)
,`dis_name` varchar(255)
,`enduser_name` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `followup_catlog`
--

CREATE TABLE `followup_catlog` (
  `id` int(11) NOT NULL,
  `followup_id` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `follow_ups`
--

CREATE TABLE `follow_ups` (
  `id` int(11) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `dpt_users` varchar(45) NOT NULL,
  `response_id` varchar(45) NOT NULL,
  `action_user_id` varchar(45) NOT NULL,
  `action_files` varchar(255) NOT NULL,
  `action_time` varchar(45) NOT NULL,
  `action_description` varchar(1000) NOT NULL,
  `table_name` varchar(45) NOT NULL,
  `cat_table` varchar(100) NOT NULL,
  `ques_table` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `geofenceing`
--

CREATE TABLE `geofenceing` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `consignee_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `District` varchar(255) NOT NULL,
  `Province` varchar(30) NOT NULL DEFAULT 'None',
  `Code2` varchar(255) NOT NULL,
  `Coordinates` longtext NOT NULL,
  `radius` varchar(255) NOT NULL,
  `Sales_Group` varchar(20) NOT NULL,
  `Supply_Location` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `geotype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_alerts_email_ids`
--

CREATE TABLE `geofence_alerts_email_ids` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `email_id` varchar(200) NOT NULL,
  `geofence_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_device`
--

CREATE TABLE `geofence_device` (
  `device_id` bigint(11) NOT NULL,
  `geofence_id` int(11) NOT NULL,
  `visits` int(11) DEFAULT 0,
  `status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_email_history`
--

CREATE TABLE `geofence_email_history` (
  `geofence_email_history_id` int(11) NOT NULL,
  `p_time` timestamp NULL DEFAULT NULL,
  `launch_time` timestamp NULL DEFAULT NULL,
  `geofence_email_history_count` varchar(45) NOT NULL DEFAULT '0',
  `e_type` varchar(45) DEFAULT 'twoHours'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_history`
--

CREATE TABLE `geofence_history` (
  `geofence_history_id` int(11) NOT NULL,
  `time1` timestamp NOT NULL DEFAULT current_timestamp(),
  `device_id` varchar(45) NOT NULL,
  `geofence_id` varchar(45) NOT NULL,
  `current_status` varchar(45) DEFAULT NULL,
  `geofence_history_latest_position` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_points`
--

CREATE TABLE `geofence_points` (
  `geofence_points_id` int(11) NOT NULL,
  `geofence_lat` varchar(45) NOT NULL,
  `geofence_long` varchar(45) NOT NULL,
  `geofence_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_tracking`
--

CREATE TABLE `geofence_tracking` (
  `geofence_tracking_id` int(50) NOT NULL,
  `geofence_tracking_geofence_id` int(11) NOT NULL,
  `geofence_tracking_device_id` varchar(45) NOT NULL,
  `geofence_tracking_status` varchar(45) DEFAULT NULL,
  `position_id` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `geo_assign_vehicle`
--

CREATE TABLE `geo_assign_vehicle` (
  `id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `geofence_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `geo_check`
--

CREATE TABLE `geo_check` (
  `id` int(11) NOT NULL,
  `veh_id` varchar(255) NOT NULL,
  `geo_id` varchar(255) NOT NULL,
  `in_time` varchar(255) NOT NULL,
  `out_time` varchar(255) NOT NULL,
  `log` varchar(45) NOT NULL,
  `in_duration` varchar(45) DEFAULT NULL,
  `depot_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `geo_check_audit`
--

CREATE TABLE `geo_check_audit` (
  `id` int(11) NOT NULL,
  `veh_id` varchar(255) NOT NULL,
  `geo_id` varchar(255) NOT NULL,
  `in_time` varchar(255) NOT NULL,
  `out_time` varchar(255) NOT NULL,
  `in_duration` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `geo_check_dup`
--

CREATE TABLE `geo_check_dup` (
  `id` int(11) NOT NULL,
  `veh_id` varchar(255) NOT NULL,
  `geo_id` varchar(255) NOT NULL,
  `in_time` varchar(255) NOT NULL,
  `out_time` varchar(255) DEFAULT NULL,
  `log` varchar(45) NOT NULL,
  `in_duration` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gf_alarm`
--

CREATE TABLE `gf_alarm` (
  `f_id` int(11) NOT NULL,
  `f_gfid` int(11) NOT NULL,
  `f_time` datetime NOT NULL,
  `f_gfname` varchar(25) NOT NULL,
  `f_positionid` bigint(20) NOT NULL,
  `f_gftype` varchar(10) NOT NULL,
  `f_tracid` varchar(15) NOT NULL,
  `f_status` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_log`
--

CREATE TABLE `group_log` (
  `group_log_id` int(10) NOT NULL,
  `corresponding_id` varchar(45) DEFAULT NULL,
  `user_id` varchar(45) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `device_id` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT 'create',
  `plate` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hec_category`
--

CREATE TABLE `hec_category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '1',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hec_category_questions`
--

CREATE TABLE `hec_category_questions` (
  `id` int(11) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question` varchar(255) NOT NULL,
  `file` varchar(45) NOT NULL DEFAULT 'required',
  `status` varchar(45) NOT NULL DEFAULT '1',
  `answer` varchar(45) NOT NULL,
  `dpt` varchar(45) NOT NULL,
  `duration` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hec_response`
--

CREATE TABLE `hec_response` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `response` varchar(45) NOT NULL,
  `comment` varchar(1055) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hec_response_files`
--

CREATE TABLE `hec_response_files` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `file` varchar(1000) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hec_response_main`
--

CREATE TABLE `hec_response_main` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `data` varchar(10000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `auditor_id` varchar(45) NOT NULL,
  `auditor_name` varchar(45) NOT NULL,
  `auditor_designation_id` varchar(45) NOT NULL,
  `auditor_designation` varchar(45) NOT NULL,
  `audit_date` varchar(45) NOT NULL,
  `retail_product` varchar(1000) NOT NULL,
  `ug_storage_tanks` varchar(1000) NOT NULL,
  `nfr_facilities` varchar(1000) NOT NULL,
  `retail_site_name` varchar(45) NOT NULL,
  `retail_site_id` varchar(45) NOT NULL,
  `location` varchar(255) NOT NULL,
  `address` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `province` varchar(45) NOT NULL,
  `region` varchar(45) NOT NULL,
  `last_audit_date` varchar(45) NOT NULL,
  `name_retailer_manager_id` varchar(45) NOT NULL,
  `name_retailer_manager` varchar(45) NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `form_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indentprice`
--

CREATE TABLE `indentprice` (
  `id` int(11) NOT NULL,
  `startdate` varchar(45) DEFAULT NULL,
  `enddate` varchar(45) DEFAULT NULL,
  `outletid` varchar(45) DEFAULT NULL,
  `product` varchar(45) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inlist_tracker`
--

CREATE TABLE `inlist_tracker` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `tracker` varchar(45) NOT NULL,
  `inlist_name` varchar(45) NOT NULL,
  `main_name` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspection_form`
--

CREATE TABLE `inspection_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspector_task`
--

CREATE TABLE `inspector_task` (
  `id` int(11) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `time` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `description` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `sales_status` varchar(45) NOT NULL DEFAULT '0',
  `measurement_status` varchar(45) NOT NULL DEFAULT '0',
  `wet_stock_status` varchar(45) NOT NULL DEFAULT '0',
  `dispensing_status` varchar(45) NOT NULL DEFAULT '0',
  `stock_variations_status` varchar(45) NOT NULL DEFAULT '0',
  `inspection` varchar(45) NOT NULL DEFAULT '0',
  `email_status` varchar(45) NOT NULL DEFAULT '0',
  `form_json` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspector_task_reschedule`
--

CREATE TABLE `inspector_task_reschedule` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `old_time` varchar(45) NOT NULL,
  `new_time` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspector_task_response`
--

CREATE TABLE `inspector_task_response` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `dealer_sign` varchar(255) NOT NULL,
  `representator_sign` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inspector_task_transfer_log`
--

CREATE TABLE `inspector_task_transfer_log` (
  `id` int(11) NOT NULL,
  `task_id` varchar(45) NOT NULL,
  `tranfer_from` varchar(45) NOT NULL,
  `transfer_to` varchar(45) NOT NULL,
  `reason` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `lng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lube_order`
--

CREATE TABLE `lube_order` (
  `id` int(11) NOT NULL,
  `grade_id` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL,
  `pack_size` varchar(45) NOT NULL,
  `ctn_size` varchar(45) NOT NULL,
  `pack_ctn` varchar(45) NOT NULL,
  `total_pack` varchar(45) NOT NULL,
  `total_order` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `sap_no` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lude_grade`
--

CREATE TABLE `lude_grade` (
  `id` int(11) NOT NULL,
  `grade` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `old_sapno`
--

CREATE TABLE `old_sapno` (
  `id` int(11) NOT NULL,
  `sap_id` varchar(45) NOT NULL,
  `old_sapno` varchar(255) NOT NULL,
  `updated_time` varchar(45) NOT NULL,
  `updated_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `omcs`
--

CREATE TABLE `omcs` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_datapool_detail`
--

CREATE TABLE `order_datapool_detail` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `delivery_based` varchar(255) NOT NULL,
  `rate` varchar(45) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `depot` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `imgae_url` varchar(255) NOT NULL,
  `cus_id` varchar(255) NOT NULL,
  `bank_info` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `trasection_id` varchar(255) NOT NULL,
  `vehicle` varchar(255) NOT NULL,
  `status_time` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `imei` varchar(255) NOT NULL,
  `orderno` varchar(255) NOT NULL,
  `HSD_qty` varchar(255) NOT NULL DEFAULT '0',
  `HOBC_qty` varchar(255) NOT NULL DEFAULT '0',
  `PMG_qty` varchar(255) NOT NULL DEFAULT '0',
  `approved_time` varchar(45) NOT NULL,
  `start_time` varchar(45) NOT NULL,
  `legder_balance` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_datapool_main`
--

CREATE TABLE `order_datapool_main` (
  `id` int(11) NOT NULL,
  `depot` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `tl_no` varchar(45) NOT NULL,
  `total_amount` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `status_value` varchar(45) DEFAULT 'pending',
  `legder_balance` varchar(255) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL,
  `product_json` varchar(10000) NOT NULL,
  `approved_time` varchar(45) NOT NULL,
  `start_time` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `delivery_based` varchar(255) NOT NULL,
  `rate` varchar(45) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `depot` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `imgae_url` varchar(255) NOT NULL,
  `cus_id` varchar(255) NOT NULL,
  `bank_info` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `trasection_id` varchar(255) NOT NULL,
  `vehicle` varchar(255) NOT NULL,
  `status_time` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `imei` varchar(255) NOT NULL,
  `orderno` varchar(255) NOT NULL,
  `HSD_qty` varchar(255) NOT NULL DEFAULT '0',
  `HOBC_qty` varchar(255) NOT NULL DEFAULT '0',
  `PMG_qty` varchar(255) NOT NULL DEFAULT '0',
  `approved_time` varchar(45) NOT NULL,
  `start_time` varchar(45) NOT NULL,
  `legder_balance` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail_log`
--

CREATE TABLE `order_detail_log` (
  `id` int(11) NOT NULL,
  `order_id` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `status_value` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_main`
--

CREATE TABLE `order_main` (
  `id` int(11) NOT NULL,
  `depot` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `tl_no` varchar(45) NOT NULL,
  `total_amount` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `status_value` varchar(45) DEFAULT 'pending',
  `legder_balance` varchar(255) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL,
  `product_json` varchar(10000) NOT NULL,
  `approved_time` varchar(45) NOT NULL,
  `start_time` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_shortage`
--

CREATE TABLE `order_shortage` (
  `id` int(11) NOT NULL,
  `order_id` varchar(45) NOT NULL,
  `file` varchar(45) NOT NULL,
  `product_json` varchar(1000) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `overspeed_log`
--

CREATE TABLE `overspeed_log` (
  `id` int(11) NOT NULL,
  `latestposition_id` varchar(45) NOT NULL,
  `device_id` varchar(45) NOT NULL,
  `time` varchar(45) NOT NULL,
  `msg_status` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pcc_category`
--

CREATE TABLE `pcc_category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '1',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pcc_category_questions`
--

CREATE TABLE `pcc_category_questions` (
  `id` int(11) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question` varchar(255) NOT NULL,
  `file` varchar(45) NOT NULL DEFAULT 'required',
  `status` varchar(45) NOT NULL DEFAULT '1',
  `answer` varchar(45) NOT NULL,
  `dpt` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pcc_response`
--

CREATE TABLE `pcc_response` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `response` varchar(45) NOT NULL,
  `comment` varchar(1055) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pcc_response_files`
--

CREATE TABLE `pcc_response_files` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `file` varchar(1000) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pcc_response_main`
--

CREATE TABLE `pcc_response_main` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `data` longtext NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `header_data` mediumtext NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `positionsnew`
--

CREATE TABLE `positionsnew` (
  `id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `course` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `power` double(20,0) DEFAULT NULL,
  `speed` double(20,0) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `device_id` bigint(20) DEFAULT NULL,
  `odometer` varchar(255) DEFAULT NULL,
  `alerts` varchar(255) DEFAULT NULL,
  `tracker` varchar(255) DEFAULT NULL,
  `vehicle_name` varchar(255) DEFAULT NULL,
  `msgid` bigint(200) NOT NULL,
  `objectid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `price_listing`
--

CREATE TABLE `price_listing` (
  `id` int(11) NOT NULL,
  `date` varchar(45) NOT NULL,
  `consignee_code` varchar(45) NOT NULL,
  `consignee_rate` varchar(45) NOT NULL,
  `deliverd_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `puma_sap_data`
--

CREATE TABLE `puma_sap_data` (
  `id` int(11) NOT NULL,
  `sap_no` varchar(45) NOT NULL,
  `sap_time` varchar(45) NOT NULL,
  `vehicle` varchar(45) NOT NULL,
  `depo` varchar(45) NOT NULL,
  `customer` varchar(45) NOT NULL,
  `product_detail` varchar(10000) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '0',
  `created_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receive_main`
--

CREATE TABLE `receive_main` (
  `id` int(11) NOT NULL,
  `trip_id` varchar(255) NOT NULL,
  `upload_receiving` varchar(255) NOT NULL,
  `diverstion` varchar(255) NOT NULL,
  `dispatched` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `trip_qty` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `receive_sub`
--

CREATE TABLE `receive_sub` (
  `id` int(11) NOT NULL,
  `receive_main_id` varchar(255) NOT NULL,
  `remark_case_product` varchar(255) NOT NULL,
  `remarks_deliverd_qty` varchar(255) NOT NULL,
  `shortage_ltr` varchar(255) NOT NULL,
  `receive_upload` varchar(255) NOT NULL,
  `trip_sub_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_email`
--

CREATE TABLE `report_email` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retail_category`
--

CREATE TABLE `retail_category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '1',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retail_category_questions`
--

CREATE TABLE `retail_category_questions` (
  `id` int(11) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question` varchar(255) NOT NULL,
  `file` varchar(45) NOT NULL DEFAULT 'required',
  `status` varchar(45) NOT NULL DEFAULT '1',
  `answer` varchar(45) NOT NULL,
  `dpt` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retail_response`
--

CREATE TABLE `retail_response` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `response` varchar(45) NOT NULL,
  `comment` varchar(1055) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retail_response_files`
--

CREATE TABLE `retail_response_files` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `file` varchar(1000) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `retail_response_main`
--

CREATE TABLE `retail_response_main` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `data` longtext NOT NULL,
  `site_name` varchar(100) NOT NULL,
  `header_data` mediumtext NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sapdata`
--

CREATE TABLE `sapdata` (
  `id` int(11) NOT NULL,
  `deliveryno` varchar(45) DEFAULT NULL,
  `tlno` varchar(45) DEFAULT NULL,
  `driverid` varchar(45) DEFAULT NULL,
  `dname` varchar(45) DEFAULT NULL,
  `dcnic` varchar(45) DEFAULT NULL,
  `dnumber` varchar(45) DEFAULT NULL,
  `tripstart` varchar(45) DEFAULT NULL,
  `tripend` varchar(45) DEFAULT NULL,
  `alerts` varchar(45) DEFAULT NULL,
  `datetime` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `intID` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sapend`
--

CREATE TABLE `sapend` (
  `id` int(11) NOT NULL,
  `deliveryno` varchar(45) DEFAULT NULL,
  `tlno` varchar(45) DEFAULT NULL,
  `driverid` varchar(45) DEFAULT NULL,
  `dname` varchar(45) DEFAULT NULL,
  `dcnic` varchar(45) DEFAULT NULL,
  `dnumber` varchar(45) DEFAULT NULL,
  `tripstart` varchar(45) DEFAULT NULL,
  `tripend` varchar(45) DEFAULT NULL,
  `alerts` varchar(45) DEFAULT NULL,
  `datetime` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sapstart`
--

CREATE TABLE `sapstart` (
  `id` int(11) NOT NULL,
  `deliveryno` varchar(45) NOT NULL,
  `tlno` varchar(45) DEFAULT NULL,
  `driverid` varchar(45) DEFAULT NULL,
  `dname` varchar(45) DEFAULT NULL,
  `dcnic` varchar(45) DEFAULT NULL,
  `dnumber` varchar(45) DEFAULT NULL,
  `tripstart` varchar(45) DEFAULT NULL,
  `tripend` varchar(45) DEFAULT NULL,
  `alerts` varchar(45) DEFAULT NULL,
  `datetime` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sap_data_upload`
--

CREATE TABLE `sap_data_upload` (
  `id` int(11) NOT NULL,
  `tl_no` varchar(45) NOT NULL,
  `delivery_no` varchar(255) NOT NULL,
  `gi_posting_date` varchar(255) NOT NULL,
  `sub_plant_name` varchar(255) NOT NULL,
  `receiving_plant` varchar(255) NOT NULL,
  `receiving_plant_name` varchar(255) NOT NULL,
  `material_group` varchar(255) NOT NULL,
  `material_no` varchar(255) NOT NULL,
  `gi_qty` varchar(255) NOT NULL,
  `phy_report_date` varchar(255) NOT NULL,
  `rep_doc_no` varchar(255) NOT NULL,
  `reported_at_ogra` varchar(255) NOT NULL,
  `actual_days` varchar(255) NOT NULL,
  `over_due_days` varchar(255) NOT NULL,
  `planned_arrival_date` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `color` varchar(45) NOT NULL,
  `text_color` varchar(45) NOT NULL,
  `inactive_color` varchar(45) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sms_link`
--

CREATE TABLE `sms_link` (
  `id` int(11) NOT NULL,
  `sub_id` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `sms` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `special_order`
--

CREATE TABLE `special_order` (
  `id` int(11) NOT NULL,
  `order_id` varchar(45) NOT NULL,
  `approved_time` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `approved_by` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `survey_category`
--

CREATE TABLE `survey_category` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '1',
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `survey_category_questions`
--

CREATE TABLE `survey_category_questions` (
  `id` int(11) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question` varchar(255) NOT NULL,
  `file` varchar(45) NOT NULL DEFAULT 'required',
  `status` varchar(45) NOT NULL DEFAULT '1',
  `answer` varchar(45) NOT NULL,
  `dpt` varchar(255) NOT NULL,
  `duration` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `survey_response`
--

CREATE TABLE `survey_response` (
  `id` int(11) NOT NULL,
  `main_id` varchar(45) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `response` varchar(45) NOT NULL,
  `comment` varchar(1055) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `survey_response_files`
--

CREATE TABLE `survey_response_files` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `category_id` varchar(45) NOT NULL,
  `question_id` varchar(45) NOT NULL,
  `file` varchar(1000) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `survey_response_main`
--

CREATE TABLE `survey_response_main` (
  `id` int(11) NOT NULL,
  `inspection_id` varchar(45) NOT NULL,
  `dealer_id` varchar(45) NOT NULL,
  `data` varchar(10000) NOT NULL,
  `dpt_id` varchar(45) NOT NULL,
  `form_id` varchar(45) NOT NULL,
  `form_name` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_close`
--

CREATE TABLE `trip_close` (
  `id` int(11) NOT NULL,
  `sub_id` varchar(45) NOT NULL,
  `sms` varchar(45) NOT NULL,
  `close_time` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_close_sms_log`
--

CREATE TABLE `trip_close_sms_log` (
  `id` int(11) NOT NULL,
  `send_to` varchar(45) NOT NULL,
  `message` varchar(200) NOT NULL,
  `time` datetime DEFAULT NULL,
  `sub_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_main`
--

CREATE TABLE `trip_main` (
  `id` int(11) NOT NULL,
  `lorry_no` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `base` varchar(255) NOT NULL,
  `driver_name` varchar(45) NOT NULL,
  `driver_cnic` varchar(255) NOT NULL,
  `driver_contact` varchar(255) NOT NULL,
  `driver_helper_name` varchar(45) NOT NULL,
  `driver_helper_cnic` varchar(255) NOT NULL,
  `driver_helper_contact` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `stage_area` varchar(255) NOT NULL,
  `trip_count` varchar(45) NOT NULL,
  `without_tracker` varchar(45) NOT NULL,
  `estimated_time` varchar(45) NOT NULL,
  `complete` varchar(45) NOT NULL,
  `create_time` varchar(45) NOT NULL,
  `user_id` varchar(45) NOT NULL,
  `sap_no` varchar(255) CHARACTER SET cp1256 NOT NULL,
  `cartraige_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_start_sms_log`
--

CREATE TABLE `trip_start_sms_log` (
  `id` int(11) NOT NULL,
  `send_to` varchar(45) NOT NULL,
  `message` varchar(200) CHARACTER SET utf16 NOT NULL,
  `time` datetime DEFAULT NULL,
  `sub_id` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trip_sub`
--

CREATE TABLE `trip_sub` (
  `id` int(11) NOT NULL,
  `main_id` int(11) NOT NULL,
  `consignee_code` varchar(255) NOT NULL,
  `consignee_id` varchar(45) NOT NULL,
  `consignee_name` varchar(255) NOT NULL,
  `products` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `document_ref` varchar(255) NOT NULL,
  `consignee_contact_1` varchar(255) NOT NULL,
  `consignee_contact_2` varchar(255) NOT NULL,
  `consignee_contact_3` varchar(255) NOT NULL,
  `del_order` varchar(255) NOT NULL,
  `eta` varchar(255) NOT NULL,
  `del_ch` varchar(255) NOT NULL,
  `by_` varchar(255) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `status` varchar(45) NOT NULL,
  `vehicle_id` varchar(45) NOT NULL,
  `vehicle_name` varchar(45) NOT NULL,
  `commets` varchar(255) NOT NULL,
  `stn_no` varchar(100) NOT NULL,
  `is_rtd` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uniform_order`
--

CREATE TABLE `uniform_order` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `sm` varchar(45) NOT NULL,
  `md` varchar(45) NOT NULL,
  `lg` varchar(45) NOT NULL,
  `xl` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uniform_type`
--

CREATE TABLE `uniform_type` (
  `id` int(11) NOT NULL,
  `type` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `privilege` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `userSettings_id` bigint(20) DEFAULT NULL,
  `status` varchar(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `notify` int(11) NOT NULL DEFAULT 1,
  `subacc_id` int(11) NOT NULL,
  `allowed_actions` varchar(45) NOT NULL DEFAULT '000000000000000000000000000000000000000000000',
  `independent_exist` varchar(45) NOT NULL DEFAULT '0',
  `image` varchar(500) DEFAULT NULL,
  `dealer_ids` mediumtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_asm_tm`
--

CREATE TABLE `users_asm_tm` (
  `id` int(11) NOT NULL,
  `asm_id` varchar(45) NOT NULL,
  `tm_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_devices_new`
--

CREATE TABLE `users_devices_new` (
  `users_id` bigint(20) NOT NULL,
  `devices_id` bigint(20) NOT NULL,
  `subacc_id` int(11) NOT NULL DEFAULT 0,
  `group_id` varchar(45) DEFAULT NULL,
  `users_devices_id` bigint(20) NOT NULL,
  `show_authority` varchar(45) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_doc`
--

CREATE TABLE `users_doc` (
  `id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `table_user_id` varchar(255) NOT NULL,
  `user_doc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_logistics`
--

CREATE TABLE `users_logistics` (
  `id` int(11) NOT NULL,
  `role` varchar(45) NOT NULL,
  `logistics_id` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users_zm_tm`
--

CREATE TABLE `users_zm_tm` (
  `id` int(11) NOT NULL,
  `zm_id` varchar(45) NOT NULL,
  `tm_id` varchar(45) NOT NULL,
  `created_at` varchar(45) NOT NULL,
  `created_by` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_inlist`
--

CREATE TABLE `vehicle_inlist` (
  `id` int(11) NOT NULL,
  `uniqueId` bigint(225) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `vehicle_status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_location`
--

CREATE TABLE `vehicle_location` (
  `car_name` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `device_id` bigint(20) DEFAULT NULL,
  `speed` int(11) DEFAULT NULL,
  `imileage` varchar(225) DEFAULT NULL,
  `pos_time` datetime DEFAULT NULL,
  `vlocation` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `dtype` varchar(50) DEFAULT NULL,
  `power` varchar(45) DEFAULT NULL,
  `latestPosition_id` bigint(20) DEFAULT NULL,
  `course` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure for view `distributor_view`
--
DROP TABLE IF EXISTS `distributor_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `distributor_view`  AS  select `ad`.`admin_id` AS `admin_id`,`ad`.`distributor_id` AS `distributor_id`,`u`.`name` AS `admin_name`,`ud`.`name` AS `dis_name` from ((`admin_distibutor` `ad` join `users` `u` on(`u`.`id` = `ad`.`admin_id`)) join `users` `ud` on(`ud`.`id` = `ad`.`distributor_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `enduser_view`
--
DROP TABLE IF EXISTS `enduser_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`p2ptrack@!!`@`localhost` SQL SECURITY DEFINER VIEW `enduser_view`  AS  select `eu`.`distributor_id` AS `distributor_id`,`eu`.`end_user_id` AS `end_user_id`,`u`.`name` AS `dis_name`,`ud`.`name` AS `enduser_name` from ((`distributor_end_user` `eu` join `users` `u` on(`u`.`id` = `eu`.`distributor_id`)) join `users` `ud` on(`ud`.`id` = `eu`.`end_user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_products`
--
ALTER TABLE `all_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`name`);

--
-- Indexes for table `approved_order`
--
ALTER TABLE `approved_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulkdatanew`
--
ALTER TABLE `bulkdatanew`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_damage`
--
ALTER TABLE `complaint_damage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaint_object_part`
--
ALTER TABLE `complaint_object_part`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `containers_sizes`
--
ALTER TABLE `containers_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers`
--
ALTER TABLE `dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_cluster_main`
--
ALTER TABLE `dealers_cluster_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_cluster_sub`
--
ALTER TABLE `dealers_cluster_sub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_complaint`
--
ALTER TABLE `dealers_complaint`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_depots`
--
ALTER TABLE `dealers_depots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_dispenser`
--
ALTER TABLE `dealers_dispenser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`dealer_id`,`name`);

--
-- Indexes for table `dealers_factilities`
--
ALTER TABLE `dealers_factilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_lorries`
--
ALTER TABLE `dealers_lorries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_monthly_targets`
--
ALTER TABLE `dealers_monthly_targets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`date_month`,`product_id`,`dealer_id`);

--
-- Indexes for table `dealers_nozzel`
--
ALTER TABLE `dealers_nozzel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_nozzel_readings`
--
ALTER TABLE `dealers_nozzel_readings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_products`
--
ALTER TABLE `dealers_products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`dealer_id`,`name`);

--
-- Indexes for table `dealers_profitability`
--
ALTER TABLE `dealers_profitability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_profitability_main`
--
ALTER TABLE `dealers_profitability_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_stock_variations`
--
ALTER TABLE `dealers_stock_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealers_tanks_nozels`
--
ALTER TABLE `dealers_tanks_nozels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_account`
--
ALTER TABLE `dealer_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_casual_visits`
--
ALTER TABLE `dealer_casual_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_dip_log`
--
ALTER TABLE `dealer_dip_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_inspection_price_check`
--
ALTER TABLE `dealer_inspection_price_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_inspection_quality_check`
--
ALTER TABLE `dealer_inspection_quality_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_inspection_quantity_check`
--
ALTER TABLE `dealer_inspection_quantity_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_ledger_log`
--
ALTER TABLE `dealer_ledger_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_measurement_pricing`
--
ALTER TABLE `dealer_measurement_pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_measurement_pricing_action`
--
ALTER TABLE `dealer_measurement_pricing_action`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_nozel_price_log`
--
ALTER TABLE `dealer_nozel_price_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_reconcilation`
--
ALTER TABLE `dealer_reconcilation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_stock_recon_new`
--
ALTER TABLE `dealer_stock_recon_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_target_response_return`
--
ALTER TABLE `dealer_target_response_return`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_users`
--
ALTER TABLE `dealer_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dealer_wet_stock`
--
ALTER TABLE `dealer_wet_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decant_category`
--
ALTER TABLE `decant_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decant_category_questions`
--
ALTER TABLE `decant_category_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decant_response`
--
ALTER TABLE `decant_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decant_response_files`
--
ALTER TABLE `decant_response_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decant_response_main`
--
ALTER TABLE `decant_response_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_forms`
--
ALTER TABLE `department_forms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`department_id`,`form_id`);

--
-- Indexes for table `department_users`
--
ALTER TABLE `department_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`department_id`,`name`);

--
-- Indexes for table `devicesnew`
--
ALTER TABLE `devicesnew`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `followup_catlog`
--
ALTER TABLE `followup_catlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hec_category`
--
ALTER TABLE `hec_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hec_category_questions`
--
ALTER TABLE `hec_category_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hec_response`
--
ALTER TABLE `hec_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hec_response_files`
--
ALTER TABLE `hec_response_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hec_response_main`
--
ALTER TABLE `hec_response_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspection_form`
--
ALTER TABLE `inspection_form`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_index` (`name`);

--
-- Indexes for table `inspector_task`
--
ALTER TABLE `inspector_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspector_task_reschedule`
--
ALTER TABLE `inspector_task_reschedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspector_task_response`
--
ALTER TABLE `inspector_task_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspector_task_transfer_log`
--
ALTER TABLE `inspector_task_transfer_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lube_order`
--
ALTER TABLE `lube_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lude_grade`
--
ALTER TABLE `lude_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `omcs`
--
ALTER TABLE `omcs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_datapool_detail`
--
ALTER TABLE `order_datapool_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_datapool_main`
--
ALTER TABLE `order_datapool_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail_log`
--
ALTER TABLE `order_detail_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_main`
--
ALTER TABLE `order_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_shortage`
--
ALTER TABLE `order_shortage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcc_category`
--
ALTER TABLE `pcc_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcc_category_questions`
--
ALTER TABLE `pcc_category_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcc_response`
--
ALTER TABLE `pcc_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcc_response_files`
--
ALTER TABLE `pcc_response_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pcc_response_main`
--
ALTER TABLE `pcc_response_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positionsnew`
--
ALTER TABLE `positionsnew`
  ADD UNIQUE KEY `id` (`id`,`device_id`),
  ADD UNIQUE KEY `msg` (`id`,`device_id`,`objectid`) USING BTREE,
  ADD KEY `msgrecord` (`device_id`,`msgid`);

--
-- Indexes for table `puma_sap_data`
--
ALTER TABLE `puma_sap_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_category`
--
ALTER TABLE `retail_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_category_questions`
--
ALTER TABLE `retail_category_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_response`
--
ALTER TABLE `retail_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_response_files`
--
ALTER TABLE `retail_response_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retail_response_main`
--
ALTER TABLE `retail_response_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_category`
--
ALTER TABLE `survey_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_category_questions`
--
ALTER TABLE `survey_category_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_response`
--
ALTER TABLE `survey_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_response_files`
--
ALTER TABLE `survey_response_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_response_main`
--
ALTER TABLE `survey_response_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uniform_order`
--
ALTER TABLE `uniform_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uniform_type`
--
ALTER TABLE `uniform_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_asm_tm`
--
ALTER TABLE `users_asm_tm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_devices_new`
--
ALTER TABLE `users_devices_new`
  ADD PRIMARY KEY (`users_devices_id`),
  ADD KEY `FK81E459A68294BA3` (`devices_id`),
  ADD KEY `FK81E459A6712480D` (`users_id`);

--
-- Indexes for table `users_zm_tm`
--
ALTER TABLE `users_zm_tm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_products`
--
ALTER TABLE `all_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `approved_order`
--
ALTER TABLE `approved_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bulkdatanew`
--
ALTER TABLE `bulkdatanew`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_damage`
--
ALTER TABLE `complaint_damage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint_object_part`
--
ALTER TABLE `complaint_object_part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `containers_sizes`
--
ALTER TABLE `containers_sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers`
--
ALTER TABLE `dealers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_cluster_main`
--
ALTER TABLE `dealers_cluster_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_cluster_sub`
--
ALTER TABLE `dealers_cluster_sub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_complaint`
--
ALTER TABLE `dealers_complaint`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_depots`
--
ALTER TABLE `dealers_depots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_dispenser`
--
ALTER TABLE `dealers_dispenser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_factilities`
--
ALTER TABLE `dealers_factilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_lorries`
--
ALTER TABLE `dealers_lorries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_monthly_targets`
--
ALTER TABLE `dealers_monthly_targets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_nozzel`
--
ALTER TABLE `dealers_nozzel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_nozzel_readings`
--
ALTER TABLE `dealers_nozzel_readings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_products`
--
ALTER TABLE `dealers_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_profitability`
--
ALTER TABLE `dealers_profitability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_profitability_main`
--
ALTER TABLE `dealers_profitability_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_stock_variations`
--
ALTER TABLE `dealers_stock_variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealers_tanks_nozels`
--
ALTER TABLE `dealers_tanks_nozels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_account`
--
ALTER TABLE `dealer_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_casual_visits`
--
ALTER TABLE `dealer_casual_visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_dip_log`
--
ALTER TABLE `dealer_dip_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_inspection_price_check`
--
ALTER TABLE `dealer_inspection_price_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_inspection_quality_check`
--
ALTER TABLE `dealer_inspection_quality_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_inspection_quantity_check`
--
ALTER TABLE `dealer_inspection_quantity_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_ledger_log`
--
ALTER TABLE `dealer_ledger_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_measurement_pricing`
--
ALTER TABLE `dealer_measurement_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_measurement_pricing_action`
--
ALTER TABLE `dealer_measurement_pricing_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_nozel_price_log`
--
ALTER TABLE `dealer_nozel_price_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_reconcilation`
--
ALTER TABLE `dealer_reconcilation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_stock_recon_new`
--
ALTER TABLE `dealer_stock_recon_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_target_response_return`
--
ALTER TABLE `dealer_target_response_return`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_users`
--
ALTER TABLE `dealer_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dealer_wet_stock`
--
ALTER TABLE `dealer_wet_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `decant_category`
--
ALTER TABLE `decant_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `decant_category_questions`
--
ALTER TABLE `decant_category_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `decant_response`
--
ALTER TABLE `decant_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `decant_response_files`
--
ALTER TABLE `decant_response_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `decant_response_main`
--
ALTER TABLE `decant_response_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_forms`
--
ALTER TABLE `department_forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_users`
--
ALTER TABLE `department_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devicesnew`
--
ALTER TABLE `devicesnew`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followup_catlog`
--
ALTER TABLE `followup_catlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_ups`
--
ALTER TABLE `follow_ups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hec_category`
--
ALTER TABLE `hec_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hec_category_questions`
--
ALTER TABLE `hec_category_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hec_response`
--
ALTER TABLE `hec_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hec_response_files`
--
ALTER TABLE `hec_response_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hec_response_main`
--
ALTER TABLE `hec_response_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspection_form`
--
ALTER TABLE `inspection_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspector_task`
--
ALTER TABLE `inspector_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspector_task_reschedule`
--
ALTER TABLE `inspector_task_reschedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspector_task_response`
--
ALTER TABLE `inspector_task_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inspector_task_transfer_log`
--
ALTER TABLE `inspector_task_transfer_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lube_order`
--
ALTER TABLE `lube_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lude_grade`
--
ALTER TABLE `lude_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `omcs`
--
ALTER TABLE `omcs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_datapool_detail`
--
ALTER TABLE `order_datapool_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_datapool_main`
--
ALTER TABLE `order_datapool_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail_log`
--
ALTER TABLE `order_detail_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_main`
--
ALTER TABLE `order_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_shortage`
--
ALTER TABLE `order_shortage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pcc_category`
--
ALTER TABLE `pcc_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pcc_category_questions`
--
ALTER TABLE `pcc_category_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pcc_response`
--
ALTER TABLE `pcc_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pcc_response_files`
--
ALTER TABLE `pcc_response_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pcc_response_main`
--
ALTER TABLE `pcc_response_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `puma_sap_data`
--
ALTER TABLE `puma_sap_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retail_category`
--
ALTER TABLE `retail_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retail_category_questions`
--
ALTER TABLE `retail_category_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retail_response`
--
ALTER TABLE `retail_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retail_response_files`
--
ALTER TABLE `retail_response_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retail_response_main`
--
ALTER TABLE `retail_response_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_category`
--
ALTER TABLE `survey_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_category_questions`
--
ALTER TABLE `survey_category_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_response`
--
ALTER TABLE `survey_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_response_files`
--
ALTER TABLE `survey_response_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_response_main`
--
ALTER TABLE `survey_response_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uniform_order`
--
ALTER TABLE `uniform_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uniform_type`
--
ALTER TABLE `uniform_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_asm_tm`
--
ALTER TABLE `users_asm_tm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_devices_new`
--
ALTER TABLE `users_devices_new`
  MODIFY `users_devices_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_zm_tm`
--
ALTER TABLE `users_zm_tm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
