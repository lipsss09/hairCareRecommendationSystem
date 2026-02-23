-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250927.af95a2e028
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2026 at 05:56 AM
-- Server version: 8.4.3
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `haircare_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Shampoo', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(2, 'Conditioner', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(3, 'Hair Mask', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(4, 'Scalp Serum', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(5, 'Hair Tonic', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(6, 'Hair Oil', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(7, 'Hair Vitamin', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(8, 'Heat Protection', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(9, 'Creambath', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(10, 'Hair Mist', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(11, 'Hair Serum', '2026-02-21 07:30:37', '2026-02-21 07:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hair_assessments`
--

CREATE TABLE `hair_assessments` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `hair_type` enum('bergelombang','lurus','keriting') COLLATE utf8mb4_unicode_ci NOT NULL,
  `budget` enum('terjangkau','medium','premium') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hair_assessments`
--

INSERT INTO `hair_assessments` (`id`, `user_id`, `hair_type`, `budget`, `created_at`, `updated_at`) VALUES
(1, 3, 'bergelombang', 'medium', '2026-02-14 09:01:33', '2026-02-14 09:01:33'),
(2, 3, 'lurus', 'premium', '2026-02-14 10:43:55', '2026-02-14 10:43:55'),
(3, 3, 'keriting', 'premium', '2026-02-14 10:45:36', '2026-02-14 10:45:36'),
(4, 3, 'lurus', 'terjangkau', '2026-02-20 21:23:39', '2026-02-20 21:23:39'),
(5, 4, 'keriting', 'medium', '2026-02-20 21:31:59', '2026-02-20 21:31:59'),
(6, 4, 'bergelombang', 'premium', '2026-02-20 21:35:08', '2026-02-20 21:35:08'),
(7, 4, 'bergelombang', 'premium', '2026-02-20 21:35:43', '2026-02-20 21:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `hair_assessment_hair_problems`
--

CREATE TABLE `hair_assessment_hair_problems` (
  `id` bigint UNSIGNED NOT NULL,
  `hair_assessment_id` bigint UNSIGNED NOT NULL,
  `hair_problem_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hair_assessment_hair_problems`
--

INSERT INTO `hair_assessment_hair_problems` (`id`, `hair_assessment_id`, `hair_problem_id`, `created_at`, `updated_at`) VALUES
(4, 4, 2, NULL, NULL),
(5, 4, 9, NULL, NULL),
(6, 4, 10, NULL, NULL),
(7, 5, 1, NULL, NULL),
(8, 5, 2, NULL, NULL),
(9, 5, 5, NULL, NULL),
(10, 5, 8, NULL, NULL),
(11, 5, 12, NULL, NULL),
(12, 6, 4, '2026-02-20 21:35:08', '2026-02-20 21:35:08'),
(13, 6, 7, '2026-02-20 21:35:08', '2026-02-20 21:35:08'),
(14, 6, 8, '2026-02-20 21:35:08', '2026-02-20 21:35:08'),
(15, 7, 4, '2026-02-20 21:35:43', '2026-02-20 21:35:43'),
(16, 7, 7, '2026-02-20 21:35:43', '2026-02-20 21:35:43'),
(17, 7, 8, '2026-02-20 21:35:43', '2026-02-20 21:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `hair_assessment_scalp_conditions`
--

CREATE TABLE `hair_assessment_scalp_conditions` (
  `id` bigint UNSIGNED NOT NULL,
  `hair_assessment_id` bigint UNSIGNED NOT NULL,
  `scalp_condition_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hair_assessment_scalp_conditions`
--

INSERT INTO `hair_assessment_scalp_conditions` (`id`, `hair_assessment_id`, `scalp_condition_id`, `created_at`, `updated_at`) VALUES
(1, 3, 2, NULL, NULL),
(2, 3, 4, NULL, NULL),
(3, 4, 2, NULL, NULL),
(4, 4, 4, NULL, NULL),
(5, 5, 4, NULL, NULL),
(6, 6, 1, '2026-02-20 21:35:08', '2026-02-20 21:35:08'),
(7, 6, 4, '2026-02-20 21:35:08', '2026-02-20 21:35:08'),
(8, 7, 1, '2026-02-20 21:35:43', '2026-02-20 21:35:43'),
(9, 7, 4, '2026-02-20 21:35:43', '2026-02-20 21:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `hair_problems`
--

CREATE TABLE `hair_problems` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hair_problems`
--

INSERT INTO `hair_problems` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Ketombe', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(2, 'Rambut Rontok', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(3, 'Kulit Kepala Berminyak', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(4, 'Kulit Kepala Kering', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(5, 'Kulit Kepala Sensitif', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(6, 'Rambut Kusam', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(7, 'Rambut Tipis', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(8, 'Rambut Kering', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(9, 'Rambut Berminyak', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(10, 'Rambut Bercabang', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(11, 'Rambut Mengembang', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(12, 'Gatal pada Kulit Kepala', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(13, 'Kulit Kepala Iritasi', '2026-02-20 21:06:35', '2026-02-20 21:06:35'),
(29, 'Kulit Kepala Iritasi', '2026-02-21 07:30:37', '2026-02-21 07:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_14_155347_create_hair_assessments_table', 2),
(5, '2026_02_14_172524_create_master_table', 3),
(6, '2024_01_01_000005_create_hair_assessment_scalp_conditions_table', 4),
(7, '2024_01_01_000006_create_hair_assessment_hair_problems_table', 4),
(8, '2026_02_21_129241_create_categories_table', 5),
(9, '2026_02_21_132555_create_products_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `price` int NOT NULL,
  `size` int NOT NULL,
  `size_unit` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_ingredients` text COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `collected_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `created_at`, `updated_at`, `product_id`, `name`, `brand`, `category_id`, `price`, `size`, `size_unit`, `ingredients`, `key_ingredients`, `image_url`, `source`, `collected_date`) VALUES
(1, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P001', 'Hold Me Tight Pro Shampoo Spring Wonder', 'Lavojoy', 1, 97520, 280, 'ml', 'water, cocamidopropyl hydroxsultaine, sodium c14-16 olefin sulfonate, sodium lauroyl sarcosinate, sodium lauroamphoaetate, sodium taurine cocoyl methyltaurate, sodium chloride, phenoxyethanol, peg-40 hydrogenated castor oil, fragrance, cocamide mea, cocamidopropyl betaine, hydroxyacetopjenone, betaine, peg-6 caprylick/capric glycerides, piroctone olamine, sodium isostearoyl lactylate, polyquaternium-10, citric acid, sodium cocoyl isethionate, trimethylolpropane tricaprylate/tricaprate, etidronic acid, panthenol, butylene glycol, phytosteryl oleate, glyceryl behenate, sodium benzoate, ppg-26-buteth-26, zingiber officinale (ginger) root extract, anemarrhena asphodeloides root extract, panax ginseng root extract, propylene glycol, caffeine, angelica polymorpha sinensis root extract, biota orientalis leaf extract, polygonum multiflorum root extract, 1,2-hexanediol, caprylyl glycol, cyclodextrin, chlorphenesin, adenosine, glycerin, ethylhexylglycerin, diaminopyrimidine oxide, niacinamide, yeast extract, aesculus hippocastanum (horse chestnut) seed extract, ammonium glycyrrhizate, zinc gluconate, sodium citrate, chrysin, arginine, oleanolic acid, palmityoyl tripeptide-1, myristoyl pentapeptide-4, acetyl tetrapeptide-3, hexapeptide-3, biotin.', 'adenosine, arginine, biotin, caffeine, chrysin, diaminopyrimidine oxide, niacinamide, oleanolic acid, panax ginseng root extract, panthenol, piroctone olamine, polygonum multiflorum root extract, zinc gluconate', 'assets/images/products/P001.png', 'https://www.sociolla.com/shampoo/77587-hold-me-tight-pro-shampoo-spring-wonder', '2025-11-01'),
(2, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P002', 'Real Mary Exfoliating Scalp Shampoo', 'Rated Green', 1, 89100, 100, 'ml', 'water, rosmarinus offici nalis (rosemary) leaf water, sodium cocoyl isethionate, sodium methyl cocoyl taurate, disodium laureth sulfosuccinate, sodium lauroyl lactylate, decyl glucoside, rosmarinus officinalis (rosemary) leaf oil, quillaja saponaria bark extract, zingiber officina le (ginger) root extract, mentha piperita (peppermint) oil, glycerin, methylpropanediol, lauramide mipa, caprylyl glycol, coco - glucoside, citric acid, 1,2-hexanediol, trihydroxystearin, caprylic/capric triglyceride, ethylhexylglycerin, polyquaternium-10, salicylic acid, sodium citrate, sodium phytate, butylene glycol, tocopherol, alcohol, cetearyl alcohol, sodium benzoate, limonene', 'salicylic acid, tocopherol', 'assets/images/products/P002.png', 'https://www.sociolla.com/shampoo/14647-real-mary-exfoliating-scalp-shampoo?size=100_ml', '2025-11-01'),
(3, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P003', 'Real Grow Anti-Hair Loss Stimulating Scalp Spray', 'Rated Green', 5, 211500, 120, 'ml', 'rosmarinus officinalis (rosemary) leaf water, water, alcohol, dipropylene glycol, glycerin, methylpropanediol, rosmarinus officinalis (rosemary) leaf oil, pinus sylvestris leaf oil, glycine soja (soybean) seed extract, citrus aurantium dulcis (orange) peel oil, cocos nucifera (coconut) fruit extract, octyldodeceth-16, 1,2-hexanediol, menthol, salicylic acid, panthenol, tromethamine, zinc lactate, ethylhexylglycerin, pentylene glycol, butylene glycol, octanediol, biotin, hydrogenated lecithin, polyglyceryl-10 stearate, sodium ascorbyl phosphate, tocopheryl acetate, glyceryl arachidonate, glyceryl linolenate, retinyl palmitate, caffeine, limonene, linalool, geranio', 'biotin, caffeine, menthol, panthenol, retinyl palmitate, salicylic acid, sodium ascorbyl phosphate, tocopheryl acetate, zinc lactate', 'assets/images/products/P003.png', 'https://www.sociolla.com/hair-serum/56919-real-grow-anti-hair-loss-stimulating-scalp-spray', '2025-11-01'),
(4, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P004', 'Texture Experience Conditioner Green Tea Butter', 'Makarizo Professional', 2, 66600, 250, 'ml', 'aqua/water, sodium laureth sulfate, cocamidopropyl betaine, glycerin, polyquaternium-7, sodium chloride, fragrance', '', 'assets/images/products/P004.png', 'https://www.sociolla.com/conditioner/28173-texture-experience-conditioner-green-tea-butter', '2025-11-01'),
(5, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P005', 'Keratin Pro Daily Use Hair Mask', 'Cbd Professional', 3, 76800, 250, 'g', 'aqua, cyclopentasiloxane, behentrimonium chloride, hydroxypropyl starch phosphate, cetearyl alcohol, perfume, cetyl alcohol, glyceryl stearate, cetrimonium chloride, dimethiconol, isopropanol, peg-100 stearate, phenoxyethanol, panthenol, sodium pca, sorbitan caprylate, bht, disodium edta, hydrolyzed keratin, benzotriazolyl dodecyl p-cresol, sodium metabisulfite, citric acid.', 'hydrolyzed keratin, keratin, panthenol', 'assets/images/products/P005.png', 'https://www.sociolla.com/hair-mask/67659-keratin-pro-daily-use-hair-mask-500gr', '2025-11-01'),
(6, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P006', 'BONVIE Kemiri Gin Tonic (with Biotin + Aloe Vera + Peppermint)', 'Bonvie', 5, 90200, 60, 'ml', 'oleanolic acid, biotin, ginseng, kemiri, peppermint dan aloe vera.', 'biotin, oleanolic acid', 'assets/images/products/P006.png', 'https://www.sociolla.com/hair-tonic/86019-bonvie-kemiri-gin-tonic-with-biotin-aloe-vera-peppermint', '2025-11-01'),
(7, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P007', 'Rosemary Hair Growth Oil', 'Lash Boss', 11, 255000, 100, 'ml', 'rosemary,3% encapsulated biotin,rice bran oil,argan and jojoba oil', 'biotin', 'assets/images/products/P007.png', 'https://www.sociolla.com/hair-oil/82652-rosemary-hair-growth-oil?size=100_ml', '2025-11-01'),
(8, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P008', 'Hot Oil Hair & Scalp Treatment by Ree DermaWellness', 'Ree Derma Wellness', 6, 204600, 100, 'ml', 'water (aqua), capsicum anuum powder, ascorbic acid (vitamin o), pyridoxine (vitamin b6), tacopherols (vitamin e), manganese, flavonoids cocos nucifera (coconut) oil, phylloquinone (vitamin k) occurs naturally from ingredients.', 'ascorbic acid', 'assets/images/products/P008.png', 'https://www.sociolla.com/hair-oil/62563-hot-oil-hair-and-scalp-treatment-by-ree-dermawellness?size=100ml', '2025-11-01'),
(9, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P009', 'ERHAIR Scalperfect Allantoin & Silk Protein Scalp Soothing Serum', 'Erha', 4, 95200, 30, 'ml', 'allantoin, hydrolyzed silk protein, piroctone olamine, zinc gluconate, niacinamide, salicylic acid (bha), menthol', 'allantoin, hydrolyzed silk, menthol, niacinamide, piroctone olamine, salicylic acid, zinc gluconate', 'assets/images/products/P009.png', 'https://www.sociolla.com/hair-serum/53680-erhair-scalperfect-allantoin-and-silk-protein-scalp-soothing-serum', '2025-11-01'),
(10, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P010', 'Ciara Hair Perfector Protein Cream', 'Ciara', 7, 109250, 60, 'ml', 'silk amino extract, rambutan seed extract,keratin,hyaluranic acid', 'keratin', 'assets/images/products/P010.png', 'https://www.sociolla.com/hair-serum/85953-ciara-hair-perfector-protein-cream', '2025-11-01'),
(11, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P011', 'Premium EX Hair Fall Care & Repair Conditioner Treatment', 'Tsubaki', 2, 179530, 450, 'ml', 'aqua, stearyl alcohol, isopentyldiol, behentrimonium chloride, glycerin, dimethicone, sorbitol, cetyl alcohol, dipropylene glycol, isopropyl alcohol, fragrance, aminopropyl dimethicone, isopropyl myristate, sodium methyltaurate, peg-2 laurate, salicylic acid, sodium benzoate, phenoxyethanol, c13-16 isoparaffin, polysilicone-13, steartrimonium chloride, laurtrimonium chloride, c10-13 isoparaffin, squalane, disodium edta, camellia japonica seed oil, butylene glycol, cetrimonium chloride, sodium dilauramidoglutamide lysine, amodimethicone, bis-ethylhexyloxyphenol methoxyphenyl triazine, phytosteryl macadamiate, ppg-2-deceth-12, citrus unshiu peel extract, eucheuma serra/grateloupia sparsa/saccharina angustata/ulva linza/undaria pinnatifida extract, lactic acid, saccharina angustata/undaria pinnatifida extract, tocopherol, phytosteryl/octyldodecyl lauroyl glutamate.​', 'lactic acid, salicylic acid, tocopherol', 'assets/images/products/P011.png', 'https://www.sociolla.com/conditioner/89478-premium-ex-hair-fall-care-and-repair-conditioner-treatment', '2026-01-06'),
(12, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P012', 'Hair Vitamin Keratin Hair Repair Jar', 'Ellips', 7, 115815, 50, 'ml', 'cyclopentasiloxane, cyclotetrasiloxane, dimethiconol, fragrance', '', 'assets/images/products/P012.png', 'https://www.sociolla.com/hair-vitamin/28598-vitamin-rambut-keratin-hair-repair-jar', '2026-01-06'),
(13, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P013', 'Collagen Repair Hair Serum', 'Cbd Professional', 11, 937205, 100, 'ml', 'cyclopentasiloxane, isohexadecane, dimethiconol, dimethicone, caprylic/capric triglyceride, isopropyl myristate, perfume, aqua, carthamus tinctorius seed oil, rubus idaeus fruit extract, hydrolyzed collagen, phenoxyethanol', '', 'assets/images/products/P013.png', 'https://www.sociolla.com/hair-serum/76003-collagen-repair-hair-serum-100ml', '2026-01-06'),
(14, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P014', 'MISSDAISY Perfume Shampoo - Rose & Oud', 'Miss Daisy', 1, 369000, 500, 'ml', 'aqua, sodium lauroyl methylaminopropionate, sodium methyl cocoyl taurate, cocoamidopropyl betaine, lauryl hydroxysultaine, ppg-2 hydroxyethyl coco/isostearamide, peg-250 distearate, fragrance, palmitamidopropyltrimonium chloride, dipropylene glycol, phenoxyethanol, citric acid, polyquaternium-10, guar hydroxypropyltrimonium chloride, c10-40 isoalkylamidopropylethyldimonium ethosulfate, tetrasodium edta, o-cymen-5-ol, hydrolyzed wheat protein, silk amino acids, ceramide np, ceramide ap, ceramide eop, phytoshingosine, cholesterol, sodium lauroyl lactylate, carbomer, xanthan gum, nicotiamide, helichrysum italicum extract, hydrolyzed rhodophycea extract.', 'ceramide np, hydrolyzed wheat protein', 'assets/images/products/P014.png', 'https://www.sociolla.com/shampoo/76276-missdaisy-perfume-shampoo-rose-and-oud?size=500ml', '2026-01-06'),
(15, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P015', 'Intensive Scalp Serum', 'Djamujamu', 4, 203350, 45, 'ml', 'water, alcohol, pisum sativum sprout extract, ocimum basilicum hairy root culture extract, peg-40 hydrogenated castor oil, panax ginseng root extract, menthyl lactate, hydroxyethylcellulose, sodium benzoate, zingiber officinale root oil, salicylic acid, santalum austrocaledonicum wood oil.', 'panax ginseng root extract, salicylic acid', 'assets/images/products/P015.png', 'https://www.sociolla.com/hair-serum/74234-intensive-scalp-serum', '2026-01-06'),
(16, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P016', 'Barber Daily 2 in 1 Hair Tonic Bottle', 'Makarizo Professional', 5, 82980, 140, 'ml', 'water, alcohol, propylene glycol, peg-40 hydrogenated castor oil, aloe vera leaf extract, fragrance, phenoxyethanol, menthol, panthenyl ethyl ether, piroctone olamine, citric acid, menthyl lactate, panax ginseng root extract, potassium sorbate, sodium ben.', 'menthol, panax ginseng root extract, piroctone olamine', 'assets/images/products/P016.png', 'https://www.sociolla.com/hair-tonic/28188-barber-daily-2-in-1-hair-tonic-bottle', '2026-01-06'),
(17, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P017', 'Argan Repair Oil', 'Dancoly', 6, 259470, 60, 'ml', 'argania spinosa kernel oil helianthus annuus (sunflower) seed oil opuntia tuna extract citrus aurantium amara (bitter orange) flower extract boswellia carterii oil parfum phenoxyethanol.', 'argania spinosa kernel oil', 'assets/images/products/P017.png', 'https://www.sociolla.com/hair-oil/9717-argan-repair-oil', '2026-01-06'),
(18, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P018', 'Kelaya Hair Shampoo', 'Kelaya', 1, 48500, 100, 'ml', 'aqua, sodium laureth sulfate, cocamidopropyl betaine, tetrahydroxy ethyl sulphate- disodium, aloe barbadensis extract,menthol, polyquaternium-7, peg-150 distearate, fragrance, potassium hydroxide, aleurites moluccana extract, cetrimonium chloride, bis (c13-15 alkoxy) pg-amodimethicone, sodium chloride, peg-400, piroctone olamine, tetrasodium edta methylchloroisothiazolinone, methylisothiazolinone..', 'menthol, piroctone olamine', 'assets/images/products/P018.png', 'https://www.sociolla.com/hair-oil/9717-argan-repair-oil', '2026-01-06'),
(19, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P019', 'Keratin Protein Repair Conditioner', 'Beamarry New York', 2, 152213, 380, 'ml', 'aqua, cetearyl alcohol, ethylhexyl palmitate, steartrimonium chloride, dimethicone, glyceryl stearate, hydroxyethylcellulose, dmdm hydantoin, parfum, glycerin, propylene glycol phenoxyethanol panthenol macadamia ternifolia seed oil, argania spinosa kernel oil, ci 19140, keratin, hydrolyzed keratin, oxidized keratin, rosmarinus officinalis (rosemary) leaf oil, rosa rugosa flower extract, rosa rugosa flower oil, michelia alba flower oil cymbidium grandiflorum (orchid) root extract, ci 75470, rosa centifolia flower extract, jasminum officinale (jasmine) extract, bellis perennis (daisy) flower extract, xanthan gum.', 'argania spinosa kernel oil, hydrolyzed keratin, keratin, panthenol', 'assets/images/products/P019.png', 'https://www.sociolla.com/conditioner/85225-keratin-protein-repair-conditioner', '2026-01-06'),
(20, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P020', 'Coconut Milk Hair Serum', 'Beamarry New York', 11, 190246, 110, 'ml', 'cyclopentasiloxaneisododecane, ethylhexyl palmitate, dimethiconol dimethicone parfum, olea europaea jolive fruit oil argania spinosa kernel oil orbignya oleifera seed oil, tocopheryl acetate, ci 15985, simmondsia chinensis (jojoba) seed oil butyrospermum parkii (shea butter), vitis vinifera (grape) seed oil, prunus amygdalus dulcis (sweet almond) oil, keratin, hydrolyzed keratin, oxidized keratin.', 'argania spinosa kernel oil, hydrolyzed keratin, keratin, tocopheryl acetate', 'assets/images/products/P020.png', 'https://www.sociolla.com/hair-serum/85240-coconut-milk-hair-serum', '2026-01-06'),
(21, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P021', 'Fino Premium Touch Permeation Essence Hair Mask', 'Shiseido Fino', 3, 125000, 230, 'g', 'water, sorbitol, dimethicone, hydrogenated rapeseed oil alcohol, isopentyldiol, behentrimonium chloride, aminopropyldimethicone, alkyl (c12, 14) oxyhydroxypropylarginine hcl, stearyldihydroxypropyldimonium oligosaccharide, glutamate, stearyltrimonium chloride, trehalose, squalane, peg-90m, pca, dilauroyl glutamate (phytosteryl / octyldodecyl), polyquaternium-64, royal jelly extract, isopropanol, cetanol, octyldodecanol, ethanol, pg, bg, silica, bht, tocopherol, phenoxyethanol, sodium benzoate, fragrance, yellow 5', 'arginine, tocopherol', 'assets/images/products/P021.png', 'https://www.tokopedia.com/pure-luxury-hair/hair-mask-premium-touch-hair-care-set-conditioner-hair-mask-1733831961628214682?extParam=ivf%3Dfalse%26keyword%3Dhair+care+hair+mask%26search_id%3D20260107112831CD00692C3BFE5939DSZU%26src%3Dsearch&t_id=1767785334549&t_st=1&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-01-07'),
(22, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P022', ' CBD Professional Keratin Pro Daily', 'Cbd', 3, 105000, 500, 'gr', 'aqua, cyclopentasiloxane, behentrimonium chloride, hydroxypropyl starch phosphate, cetearyl alcohol, perfume, cetyl alcohol, glyceryl stearate, cetrimonium chloride, dimethiconol, isopropanol, peg-100 stearate, phenoxyethanol, panthenol, sodium pca, sorbitan caprylate, bht, disodium edta, hydrolyzed keratin, benzotriazolyl dodecyl p-cresol, sodium metabisulfite, citric acid', 'hydrolyzed keratin, keratin, panthenol', 'assets/images/products/P022.png', 'https://www.tokopedia.com/cbdprofessional/bbd-cbd-professional-keratin-pro-daily-use-hair-mask-500gr-haircare-treatment-perawatan-setelah-shampoo-conditioner-vitamin-rambut-kering-kusut-kusam-menjadi-halus-berkilau-membersihkan-melembutkan-rambut-seperti-smoothing-1729420095615175062?extParam=ivf%3Dfalse%26keyword%3Dhair+care+hair+mask%26search_id%3D20260107112831CD00692C3BFE5939DSZU%26src%3Dsearch%26whid%3D12613736&t_id=1767785334549&t_st=5&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-01-07'),
(23, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P023', 'MAKARIZO Hair Recovery ', 'Makarizo', 7, 69700, 50, 'ml', 'cyclopentasiloxane, cyclotetrasiloxane, phenyl trimethicone, dimethiconol, fragrance, tocopheryl acetate, hydrolyzed silk, pg-propyl methylsilanediol crosspolymer, hydrogenated soybean oil, retinyl palmitate, ascorbyl palmitate', 'hydrolyzed silk, retinyl palmitate, tocopheryl acetate', 'assets/images/products/P023.png', 'https://www.watsons.co.id/id/makarizo-hair-recovery-pump-50ml/p/BP_45180', '2026-01-07'),
(24, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P024', 'Hair Fall Control Shampoo ', 'Lab On Hair', 1, 179200, 300, 'ml', 'water, sodium laureth sulfate, cocamide mea, acrylates copolymer, cocamidopropyl hydroxysultaine, sodium chloride, fragrance, sodium cocoyl glycinate, dimethicone, glycerin, peg-150 distearate, behentrimonium chloride, triethanolamine, zingiber officinale (ginger) root, polyquaternium-7, methylparaben, allantoin, isopropyl alcohol, disodium edta, propylene glycol, magnesium nitrate, undecylenic acid, arginine, salicylic acid, zingiber officinale (ginger) root extract, 1,2-hexanediol, hydroxyacetophenone, propanediol, ci 19140, methylchloroisothiazolinone, magnesium chloride, methylisothiazolinone, panax ginseng root extract, ci 16255, hydrolyzed pea protein, larix europaea wood extract, glycine, sodium metabisulfite, camellia sinensis leaf extract, zinc chloride.', 'allantoin, arginine, camellia sinensis leaf extract, panax ginseng root extract, salicylic acid', 'assets/images/products/P024.png', 'https://www.watsons.co.id/id/makarizo-hair-recovery-pump-50ml/p/BP_45180', '2026-01-07'),
(25, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P025', 'Tresemme Keratin Smooth Shine Serum with Marula Oil for Dry Hair - Smooth & Shiny', 'Tresemme', 11, 156900, 97, 'ML', 'cyclopentasiloxane, cyclohexasiloxane, dimethiconol, phenyl trimethicone, sclerocarya birrea seed oil, hydrolyzed keratin, fragrance (parfum), aminopropyl dimethicone, dimethicone crosspolymer.', 'hydrolyzed keratin, keratin', 'assets/images/products/P025.png', 'https://www.sociolla.com/shampoo/79013-hair-fall-control-shampoo', '2026-01-07'),
(26, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P026', 'Elseve Aminexil Serum', 'Loreal', 11, 125000, 102, 'ml', 'aqua / water, alcohol denat, diaminopyrimidine oxide, tocopherol, sodium hyaluronate, sodium citrate, caffeine, safflower glucoside, peg-40 hydrogenated castor oil, arginine, aminomethyl propanol, ammonium polyacryloyldimethyl taurate, limonene, menthol, piroctone olamine, citric acid, coumarin, parfum / fragrance (f.i.l. z70018039/1)..', 'arginine, caffeine, diaminopyrimidine oxide, menthol, piroctone olamine, tocopherol', 'assets/images/products/P026.png', 'https://www.watsons.co.id/id/l-oreal-elseve-aminexil-serum-anti-hair-fall-serum-102ml/p/BP_59845', '2026-01-07'),
(27, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P027', 'Wonderlux Hold My Strands! Hair Fall Treatment', 'Wonderlux', 4, 150000, 75, 'ml', 'aqua, butylene glycol, tetrasodium, disuccinoyl cystine, propanediol, ammonium polyacryloyldimethyl taurate, hydroxypropylgluconamide, niacinamide, aloe barbadensis extract, oryza sativa bran water, hydroxypropylammonium gluconate, glycerin, ethanol, pathenol, chlorphenesin, phenoxyethanol, zingiber officinale extract, ppg-26-buteth-26, peg-40 hydrogenated castor oil, phyllanthus emblica fruit extract, bioflavonoids, glycine, apigenin, serine, glutamic acid, oleanolic acid, aspartic acid, leucine, biotinoyl tripeptide-1, alanine, lysine, arginine, tyrosine, phenylalanine, threonine, proline, valine, isoleucine, histidine.', 'arginine, biotin, niacinamide, oleanolic acid', 'assets/images/products/P027.png', 'https://www.watsons.co.id/id/wonderlux-wonderlux-hold-my-strands-hair-fall-treatment-scalp-serum-75ml/p/BP_39916', '2026-01-07'),
(28, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P028', 'Hair Tonic', 'Nr', 5, 81500, 200, 'ml', 'ethyl alcohol aqua fragrance peg40 hydrohenated castor oil triticum vulgare germ oil sodium salicylate propylene glycol dpanthenol linoleic acid retinyl palmitate ethoxydiglycol glucose citric acid chamomimilla recutita flower extract calcium pantothenate tussilago farfara leaf extract butylene glycol urtiva dioica extract serine pottassium sorbate caarmel inositol phenoxyethanol ci 47005 tartaric acid methylparaben ci 42090 biotin riboflavin butylparaben ethylparaben propylparaben isobutylparaben.', 'biotin, panthenol, retinyl palmitate', 'assets/images/products/P028.png', 'https://www.watsons.co.id/id/nr-hair-tonic-200ml/p/BP_72452', '2026-01-07'),
(29, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P029', 'Ginseng Hair Tonic', 'Mylea', 5, 49900, 200, 'ml', 'aqua, isopropyl alcohol, fragrance, peg-40 hydrogenated castor oil, propylene glycol, piroctone olamine, sodium salicylate, d-panthenol, citric acid, menthol, camphor, polysorbate 80, chamomilla recutita flower extract, glucose, linoleic acid, retinyl palmitate, alcohol, lactic acid, sodium benzoate, equisetum arvense extract, betula alba leaf extract, urtica dioica extract, phenoxyethanol, tocopheryl acetate, capric acid, potassium sorbate, ci 60730, caramel, ci 42090, methylparaben, tartaric acid, ethylparaben, propylparaben, butylparaben, bht.', 'lactic acid, menthol, panthenol, piroctone olamine, retinyl palmitate, tocopheryl acetate', 'assets/images/products/P029.png', 'https://www.watsons.co.id/id/mylea-ginseng-hair-tonic-200-ml/p/BP_72455', '2026-01-07'),
(30, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P030', 'Cave Hair Tonic', 'Cave', 5, 150000, 150, 'ml', 'aqua, alcohol denat, peg-40 hydrogenated castor oil, aleurites moluccana extract, fragrance (parfum) components and finished fragrances, panthenol, propylene glycol, menthol, capsicum annuum extract, cetyl pyridium chloride, ci 42090, biotin.', 'biotin, menthol, panthenol', 'assets/images/products/P030.png', 'https://www.watsons.co.id/id/cave-cave-hair-tonic-150ml/p/BP_43416', '2026-01-07'),
(31, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P031', 'Heat&Sun Protection Detangle Spray', 'Beamarry New York', 8, 167580, 200, 'ml', 'aqua, trideceth-10 amodimethicone, dimethiconol, glycerin, cocodimonium hydrox/propyl hydrolyzed keratin, propylene glycol, panthenol, tea-dodecylbenzenesulfonate, peg-40 hydrogenated castor oil, cetrimonium chloride, ethyl lauroyl arginate hcl, sodium citrate, benzophenône 4, parfum ethylhexy glycerin, 12-hexane diol citric acid, argania spinosá kernel oil, cocos nucifera (coconut) oil macadamia ternifo lia seed oil, sodium hivaluronate vitex trifola fruit extract, keratin, endrolvzed keratin oxidized keratin.', 'hydrolyzed keratin, keratin, panthenol', 'assets/images/products/P031.png', 'https://www.sociolla.com/shampoo/85377-heat-and-sun-protection-detangle-spray', '2026-01-09'),
(32, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P032', 'Pantene Conditioner Miracles Collagen Repair for Damage Care', 'Pantene', 2, 18000, 70, 'ml', 'water, silicone quaternium-26, stearyl alcohol, cetyl alcohol, benzyl alcohol, disodium edta, polysorbate 20, hexyl cinnamal, panthenol, histidine, panthenyl ethyl ether, citric acid, collagen.', 'panthenol', 'assets/images/products/P032.png', 'https://www.tokopedia.com/watsons-indonesia-official-store/pantene-conditioner-miracles-collagen-repair-for-damage-care-70ml?extParam=ivf%3Dfalse%26keyword%3Dconditioner%26search_id%3D202601091126430BB4AEC17105210F8KP8%26src%3Dsearch&t_id=1767957222016&t_st=4&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_resulty', '2026-01-09'),
(33, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P033', 'LOreal Total Repair 5 Hair Spa Mask', 'Loreal', 3, 100400, 200, 'ml', 'aqua/water, cetearyl alcohol, behentrimonium chloride, glycerin, cetyl esters, hydroxypropyltrimonium hydrolyzed wheat protein, dodocene, phenoxyethanol, arginine, chlorhexidine digluconate, poloxamen 407, limonene, linalool, benzyl salicylate, isopropyl myristate, 2-oleamido-1,3-octadecandediol, serine, bht, citric acid, butylphenyl methylpropional, lauryl peg/ppg-18/18 methicone, glutamic acid, hexyl cinnamal, glyceryl linoleate, glyceryl oleate, glyceryl linolenate, parfum/fragrance (f.i.l. c37037/1/.', 'arginine, hydrolyzed wheat protein', 'assets/images/products/P033.png', 'https://www.watsons.co.id/id/l-oreal-l-oreal-total-repair-5-hair-spa-mask-200ml/p/BP_48665', '2026-01-09'),
(34, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P034', 'Hair Mask Pro Keratin Hair Repair Tube ', 'Ellips', 3, 58500, 120, 'g', 'aqua cetearyl alcohol dimethicone dimethiconol cetyl ester amodimethicone cyclotetrasiloxane trideceth12 cetrimonium chloride cyclopentasiloxane sodium benzoate dimethyl palmitamine steartrimonium chloride isopropyl alcohol potato starch modified fragrance phenoxyethanol methylparaben ethylparaben butylparaben propylparaben lactic acid panthenol simmondsia chinensis seed oil tocopheryl acetate soybean glycine soja oil retinyl palmitate ascorbyl palmitate.', 'lactic acid, panthenol, retinyl palmitate, tocopheryl acetate', 'assets/images/products/P034.png', 'https://www.watsons.co.id/id/ellips-hair-mask-pro-keratin-hair-repair-tube-120g/p/BP_72506', '2026-01-09'),
(35, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P035', 'Kerastase Chronologiste Hair Oil ', 'Kerastase', 6, 1200000, 75, 'ml', 'isododecane, caprylic/capric triglyceride, dimethicone, dicaprylyl ether, dimethiconol, trimethylsiloxysilicate, parfum / fragrance, linalool, argania spinosa kernel oil, helianthus annuus seed oil / sunflower seed oil, limonene, citronellol, jasminum grandiflorum flower extract / jasmine flower extract, tocopherol, geraniol, benzyl alcohol, benzyl benzoate, commiphora myrrha resin extract', 'argania spinosa kernel oil, tocopherol', 'assets/images/products/P035.png', 'https://www.tokopedia.com/kerastaseofficial/kerastase-chronologiste-hair-oil-75ml-hair-perfume-in-oil-parfum-rambut-dan-serum-untuk-rambut-rapuh-kusam-1730674859546937228?extParam=src%3Dshop%26whid%3D13679389&aff_unique_id=&channel=others&chain_key=', '2026-01-09'),
(36, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P036', 'Kerastase Serum Potentialiste ', 'Kerastase', 11, 770000, 90, 'ml', 'aqua / water / eau, alcohol denat., bifida ferment lysate, ascorbyl glucoside, aminomethyl propanol, peg-40 hydrogenated castor oil, carbomer, mannose, polysorbate 21, alpha-glucan oligosaccharide, phenoxyethanol, glycerin, pentylene glycol, polymnia sonchifolia root juice, faex extract / yeast extract / extrait de levure, sodium benzoate, maltodextrin, limonene, geraniol, hexyl cinnamal, benzyl benzoate, benzyl alcohol, lactobacillus, linalool, citral, parfum / fragrance.', '', 'assets/images/products/P036.png', 'https://www.tokopedia.com/kerastaseofficial/kerastase-serum-potentialiste-90ml-scalp-barrier-serum-serum-untuk-keseimbangan-microbiome-di-kulit-kepala-mengandung-10-bifidus-probiotic-prebiotic-1-vitamin-c-1729961148801648524?extParam=whid%3D13679389%26src%3Dshop&aff_unique_id=&channel=others&chain_key=', '2026-01-09'),
(37, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P037', 'Kerastase Bain Nutri Genesis ', 'Kerastase', 1, 998000, 500, 'ml', 'aqua (water / eau), sodium laureth sulfate, ammonium lauryl sulfate, cocamidopropyl betaine, sodium chloride, parfum (fragrance), glycol distearate, cocamide mea, laureth-7, citric acid, sodium benzoate, sodium hydroxide, polyquaternium-10, peg-4 rapeseedamide, menthol, guar hydroxypropyltrimonium chloride, caffeine, arginine, serine, hydrolyzed keratin, hydrolyzed wheat protein, tocopherol (vitamin e), linalool, hexyl cinnamal, benzyl salicylate, limonene, geraniol, ci 17200 (red 33).', 'arginine, caffeine, hydrolyzed keratin, hydrolyzed wheat protein, keratin, menthol, tocopherol', 'assets/images/products/P037.png', 'https://www.tokopedia.com/kerastaseofficial/kerastase-bain-nutri-genesis-500ml-anti-hair-fall-shampoo-thick-hair-shampoo-untuk-rambut-rontok-patah-helaian-tebal-1730357209723602828?extParam=src%3Dshop%26whid%3D13679389&aff_unique_id=&channel=others&chain_key=', '2026-01-09'),
(38, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P038', 'SDB Heat Protection Spray ', 'Sdb', 8, 65490, 100, 'ml', 'aqua (water), cyclopentasiloxane, dimethicone, cyclohexasiloxane,hydrolyzed keratin, collagen, panthenol,glycerin, polyquaternium-7, peg-12 dimethicone,phenoxyethanol, ethylhexylglycerin,disodium edta, citric acid,parfum (fragrance).', 'hydrolyzed keratin, keratin, panthenol', 'assets/images/products/P038.png', 'https://www.tokopedia.com/nimetolshop/sdb-heat-protection-spray-100ml-keratin-collagen-melindungi-rambut-rusak-kusut-catok-hair-dryer-1730888079183414903?extParam=ivf%3Dfalse%26keyword%3Dheat+protectant%26search_id%3D20260109111329357A6FDF7642BF2E6BEZ%26src%3Dsearch&t_id=1767957222016&t_st=1&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-01-09'),
(39, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P039', 'SCHWARZKOPF PROFESSIONAL OSIS+ Flatliner', 'Osis+', 8, 65490, 200, 'ml', 'aqua (water, eau), alcohol denat, propylene glycol, polyurethane-48, peg-60 hydrogenated castor oil, sodium benzoate, parfum (fragrance), bis-isobutyl peg/​ppg-20/​35/​amodimethicone copolymer, cetyl ethylhexanoate, lactic acid, polysorbate 80, butylene glycol, methylpropanediol, gluconolactone, hydrolyzed keratin, linalool, methyl benzoate.', 'hydrolyzed keratin, keratin, lactic acid', 'assets/images/products/P039.png', 'https://www.tokopedia.com/bandaneirastore/schwarzkopf-professional-osis-flatliner-heat-protection-spray-no-bonus-bf1e8?extParam=ivf%3Dfalse%26keyword%3Dheat+protectant%26search_id%3D20260109111329357A6FDF7642BF2E6BEZ%26src%3Dsearch%26whid%3D6198&t_id=1767957222016&t_st=2&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-01-09'),
(40, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P040', 'Makarizo Advisor Hair Recovery Vitamax', 'Makarizo', 8, 35000, 28, 'mLx', 'cyclotetrasiloxane, cyclopentasiloxane, dimethiconol, phenyl trimethicone, tocopheryl acetate, perfume, hydrolyzed silk pg-propyl, hydrogenated soybean oil, retinyl palmitate, ascorbyl palmitate.', 'hydrolyzed silk, retinyl palmitate, tocopheryl acetate', 'assets/images/products/P040.png', 'https://www.tokopedia.com/makarizo-advisor/makarizo-advisor-hair-recovery-vitamax-8mlx3-vitamin-rambut-hair-vitamin-serum-rambut-hair-serum-heat-protectant-perawatan-haircare-melembutkan-1733752031937398034?extParam=ivf%3Dfalse%26keyword%3Dheat+protectant%26search_id%3D20260109111329357A6FDF7642BF2E6BEZ%26src%3Dsearch&t_id=1767957222016&t_st=3&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-01-09'),
(41, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P041', 'Voluminous & Grow Scalp Treatment Hair Tonic Serum', 'Hairmony', 5, 102860, 100, 'mL', 'water, alcohol denat, propylene glycol, glicerine, panax ginseng root extract, peg-40 hydrogenated castor oil, phenoxyethanol, butylene glycol, menthol, panthenol, ammonium acryloyldimethyltaurate/vp copolymer, arthemisia vulgaris extract, natrium edta, allantoin, ethylhexylglycerin, sophora flavescens root extract, capsicum anuum fruit extract, lycium chinense fruit extract, camellia cinesis leaf extract, angelca gigas root extract, angelca dahurica root extract, rubus coreanus fruit extract, morus alba root extract, pinus palustris leaf extract, lithospermum erythrorhizon root extract, polygonum ultifloronum root extract, citric acid, salicylic acid, sodium benzoate, potassium sorbate.', 'allantoin, menthol, panax ginseng root extract, panthenol, salicylic acid', 'assets/images/products/P041.png', 'https://www.sociolla.com/hair-tonic/75578-voluminous-and-grow-scalp-treatment-hair-tonic-serum', '2026-01-28'),
(42, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P042', 'Kundal Scalp Care and Caffeine Shampoo', 'Kundal', 1, 169500, 500, 'mL', '1,2-hexanediol, allantoin, alpha-isomethyl ionone, angelica gigas extract, aqua, asarum sieboldii root extract, betaine, butylene glycol, caffeine, camellia japonica leaf extract, camellia sinensis leaf extract, caprylyl glycol, carthamus tinctorius flower extract, ceratonia siliqua fruit extract, citric acid, coco-betaine, coco-glucoside, cordyceps sinensis extract, coumarin, decyl glucoside, dioscorea japonica root extract, diospyros kaki fruit extract, dipotassium glycyrrhizate, dipropylene glycol, fragrance (parfum) components and finished fragrances, ginkgo biloba leaf extract, glycerin, glycine max seed extract, glycyrrhiza glabra root extract, guar hydroxypropyltrimonium chloride, hexyl cinnamal, hydrolyzed collagen, hydroxyacetophenone, hydroxycitronellal, linalool, lithospermum erythrorhizon root extract, lycium chinense fruit extract, menthol, morus alba bark extract, niacinamide, paeonia lactiflora root extract, panax ginseng root extract, panthenol, polygonum multiflorum root extract, portulaca oleracea extract, propylene glycol laurate, rheum palmatum root extract, salicylic acid, sodium chloride, sodium coco-sulfate, sodium gluconate, sophora flavescens root extract, thuja occidentalis leaf extract, ulmus davidiana root extract, ziziphus jujuba fruit extract.', 'allantoin, caffeine, camellia sinensis leaf extract, glycyrrhiza glabra root extract, menthol, niacinamide, panax ginseng root extract, panthenol, polygonum multiflorum root extract, salicylic acid', 'assets/images/products/P042.png', 'https://www.sociolla.com/shampoo/70784-kundal-scalp-care-and-caffeine-shampoo', '2026-01-28'),
(43, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P043', 'Euphoria Perfume Silky Conditioner', 'Hairoic', 2, 34048, 180, 'gr', 'hair moisturizing agent, vitamin e, vitamin c (citrus sinensis peel extract), vitamin b5 (panthenol), glycerin, aloe vera extract, allantoin, hair & scalp nutrition, vitamin e, vitamin b5 (panthenol), niacinamide, soothing agent, allantoin, aloe vera extract, vitamin b5 (panthenol), triple scalp barrier protection, blooming fragrance.', 'allantoin, niacinamide, panthenol', 'assets/images/products/P043.png', 'https://www.sociolla.com/conditioner/91174-euphoria-perfume-silky-conditioner', '2026-01-28'),
(44, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P044', 'Orange Flower Color Protect Hair Mask', 'Dancoly', 3, 251100, 500, 'gr', 'aqua/water, citrus aurantium amara flower extract, vitis vinifera (grape) seed oil, pelargonium graveolens (geranium) extract, glyceryl stearates, dimethicone/peg-10/15 crosspolymer, dimethicone/silsesquioxane copolymer, polyoxyethylene cetyl-stearyl ether, simmondsia chinensis (jojoba) oil peg-8 esters, rosa rugosa flower extract, peg-4 sorbitan stearate, hyaluronic acid, hydroxypropyl guar, phenoxyethanol.', '', 'assets/images/products/P044.png', 'https://www.sociolla.com/hair-mask/9720-orange-flower-color-protect-hair-mask', '2026-01-28'),
(45, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P045', 'Hair Loss Shampoo', 'Dancoly', 1, 303400, 530, 'gr', 'water, decyl glucoside, lauryl glucoside, sodium cocoyl glutamate, cocodimonium hydroxypropyl hydrolyzed wheat protein, sophora flavescens root extract, capsicum annuum extract, lycium chinense fruit extract, camellia sinensis leaf extract, angelica gigas root extract, angelica dahurica root extract, rubus coreanus fruit extract, morus alba root extract, pinus palustris leaf extract, lithospermum officinale root extract, polygonum multiflorum root extract, menthol, propylene glycol, salicylic acid, dexpanthenol, rosmarinus officinalis (rosemary) leaf oil, lavandula angustifolia (lavender) oil, ocimum basilicum (basil) oil, salvia sclarea (clary) oil, pelargonium graveolens flower oil, citrus grandis (grapefruit) peel oil, citrus limon (lemon) peel oil, citrus aurantium dulcis (orange) peel oil, citrus aurantium bergamia (bergamot) fruit oil, sodium hyaluronate, niacinamide, citric acid, 1,2-hexanediol, caprylyl glycol, polyquaternium-10, disodium edta, limonene.', 'camellia sinensis leaf extract, hydrolyzed wheat protein, menthol, niacinamide, panthenol, polygonum multiflorum root extract, salicylic acid', 'assets/images/products/P045.png', 'https://www.sociolla.com/shampoo/59448-lador-hair-loss-shampoo?size=530ml', '2026-01-28'),
(46, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P046', 'Hair Tonic Biotin Hairfall Control ', 'Dove', 5, 47000, 75, 'ml', 'water, oleth-20, phenoxyethanol, glycerin, caprylyl glycol, perfume, disodium edta, zinc sulfate heptahydrate, hydrolyzed yeast protein, urea, sodium benzoate, disodium phosphate, sodium hydroxide, potassium sorbate, biotin, citric acid, ceramide ng.', 'biotin', 'assets/images/products/P046.png', 'https://www.watsons.co.id/id/dove-hair-tonic-biotin-hairfall-control-75ml/p/BP_64363', '2026-01-31'),
(47, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P047', 'Hair Energy Aloe & Melon', 'Makarizo', 9, 120600, 500, 'g', 'water, cetearyl alcohol, paraffinum liquidum, ethylhexyl palmitate, propylene glycol, cetyl esters, cetrimonium chloride, fragrance, behentrimonium chloride, amodimethicone, ceteareth-20, bis (13-15 alkoxy) pg amodimethicone, aloe barbadensis leaf extract, dmdm hydantoin, panthenyl ethyl ether, c14-15 alcohols, steartrimonium chloride, trideceth-12, trideceth-10, menthol, cl 47005, cl 42090, phenoxyethanol, butylene glycol, menthyl lactate, lactic acid, iodopropynyl butylcarbamate, passiflora edulis seed oil, isotridecanol, cyclotetrasiloxane, oryza sativa (rice) bran oil, hydrolyzed keratin, magnesium nitrate, euterpe oleracea fruit oil, methylchloroisothiazolinone, magnesium chloride, citrus aurantifolia (lime) fruit extract, methylisothiazolinone, persea gratissima fruit extract, trigonella foenum-graecum seed extract, cucumis melo (melon) fruit extract.', 'hydrolyzed keratin, keratin, lactic acid, menthol', 'assets/images/products/P047.png', 'https://www.watsons.co.id/id/makarizo-hair-energy-aloe-melon-500g/p/BP_47079', '2026-01-31'),
(48, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P048', 'Grace and Glow Hair Vitamin Mist ', 'Grace And Glow', 10, 34500, 100, 'ml', 'water, glyserine, peg-40 hydrogenated castor oil, fragrance, phenoxyethanol, silk extract, chlorphenesin, panthenol, ethylhexylglycerin, disodium edta, butylene glycol, propylene glycol, anthemis nobilis flower extract, sclerocarya birrea fruit extract, butyrospermum parkii (shea) butter, olea europea fruit oil, helianthus annuus (sunflower oil) hydroxyacetophenone, calendula officinalis flower extract, hydrolyzed keratin.', 'hydrolyzed keratin, keratin, panthenol', 'assets/images/products/P048.png', 'https://www.tokopedia.com/graceandglowofficial/grace-and-glow-hair-vitamin-mist-silk-protect-daisy-peony-blush-haircare-perawatan-treatment-rambut-spray-untuk-melembutkan-rambut-kering-dan-bercabang-with-argan-oil-1729432845638928652?extParam=ivf%3Dfalse%26keyword%3D%09hair+mist%26search_id%3D2026013111594637BC2F75BF1BCF2F95EG%26src%3Dsearch&t_id=1769860690089&t_st=3&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-01-31'),
(49, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P049', 'Real Argan Repairing Shampoo', 'Rated Green', 1, 89100, 100, 'ml', 'water, disodium laureth sulfosuccinate,cocamidopropyl betaine, lauramide mipa, sodium cocoyl isethionate, argania spinosa kernel oil, quillaja saponaria bark extract, coco-glucoside, sodium chloride, citric acid, sorbeth-30 tetraoleate, decyl glucoside, polyquaternium-10, trihydroxystearin, polyquaternium-22, caprylic/capric triglyceride, sodium citrate, caprylyl glycol, ethylhexylglycerin, soyamidopropylamine oxide, sodium phytate, sorbitan laurate, 1,2-hexanediol, glycolipids, tocopherol, betaine, panthenol, butylene glycol, acetyl hexapeptide-8, ascorbic acid polypeptide, acetyl octapeptide-3, acetyl tetrapeptide-2, acetyl tetrapeptide-3, acetyl tetrapeptide-5, acetyl tetrapeptide-9, carnosine, copper tripeptide-1, nonapeptide-1, palmitoyl pentapeptide-4, palmitoyl tripeptide-1, palmitoyl tripeptide-5, alcohol denat., cetearyl alcohol, sodium benzoate, potassium sorbate, fragrance(parfum).', 'argania spinosa kernel oil, ascorbic acid, copper tripeptide-1, panthenol, tocopherol', 'assets/images/products/P049.png', 'https://www.sociolla.com/shampoo/79402-real-argan-repairing-shampoo?size=100ml', '2026-01-31'),
(50, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P050', 'Real Argan Smoothing Hair Serum', 'Rated Green', 11, 231200, 150, 'ml', 'cyclopentasiloxane, dimethiconol, dimethicone, argania spinosa kernel oil, c12-15 alkyl benzoate, water, glycolipids, alcohol denat., fragrance (parfum).', 'argania spinosa kernel oil', 'assets/images/products/P050.png', 'https://www.sociolla.com/hair-serum/69202-real-argan-smoothing-hair-serum', '2026-01-31'),
(51, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P051', 'MISSDAISY Perfume Hair Mask', 'Miss Daisy', 3, 289000, 250, 'ml', 'aqua, cetearyl alcohol, brassicamidopropyl dimethylamine, dimethicone, amodimethicone, cetearaeth-7, ceteareth-25, cyclopentasiloxane, fragrance, behentrimonium chloride, dipropylene glycol, glycolic acid, simmondsia chinensis seed oil, squalane, butyrospermum parkii, argania spinosa kernel oil, phenoxyethanol, polyquaternium-7, guar hydroxypropyltrimonium chloride, c10-40 isoalkylamidopropylethyldimonium ethosulfate, o-cymen-5-ol, hyrdolyzed wheat protein, silk amino acids, ceramide np, ceramide ap, ceramide eop, phytoshingosine, cholesterol, sodium lauroyl lactylate, carbomer, xanthan gum, nicotiamide.', 'argania spinosa kernel oil, ceramide np', 'assets/images/products/P051.png', 'https://www.sociolla.com/hair-mask/76280-missdaisy-perfume-hair-mask-blackcurrant-and-vanilla-sugar', '2026-01-31'),
(52, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P052', 'MDrop Dead Growgeous', 'Wonderlux', 4, 166500, 75, 'ml', 'aqua, butylene glycol, 2,4-diamino-pyrimidine-3-oxide (cas no 74638-76-9)), ammonium polyacryloyldimethyl taurate, niacinamide, propanediol, oryza sativa bran water, glycerin, panthenol, zingiber officinale extract, phenoxyethanol, chlorphenesin, nasturtium officinale flower/leaf extract, ppg-26-buteth-26, peg-40 hydrogenated castor oil, aloe barbadensis extract, pisum sativum sprout extract, sodium benzoate, magnesium ascorbyl phosphate, hydrolyzed corn protein, glycine, apigenin, adenosine, serine, glutamic acid, oleanolic acid, aspartic acid, leucine active ingredient 0.00071, biotinoyl tripeptide-1, alanine, arginine, tyrosine, phenylalanine, threonine, proline, valine, isoleucine, carnitine.', 'adenosine, arginine, biotin, niacinamide, oleanolic acid, panthenol', 'assets/images/products/P052.png', 'https://www.sociolla.com/hair-serum/78251-drop-dead-growgeous-densifying-hair-scalp-serum', '2026-01-31'),
(53, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P053', 'Daikin Conditioner', 'Osweet Singapore', 2, 327999, 450, 'ml', 'hydrolyzed wheat protein, lactic acid, propylparaben, sodium lauroyl hydrolyzed silk, trideceth-12, aqua, behentrimonium chloride, cetearyl alcohol, cetrimonium chloride, cetyl alcohol, hydroxyethylcellulose, methylisothiazolinone, methylparaben, parfum, snail secretion filtrate, zingiber officinale extract, hyaluronic acid.', 'hydrolyzed silk, hydrolyzed wheat protein, lactic acid', 'assets/images/products/P053.png', 'https://www.sociolla.com/conditioner/58773-daikin-conditioner?size=450_ml', '2026-01-31'),
(54, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P054', 'Hair Mistion! Eternal Bloom', 'Wonderlux', 10, 327999, 50, 'ml', 'water, trideceth-9, fragnance (parfum) components and finished fragrance, peg-40 hydrogenated castor oil, propanediol, phenoxyethanol, caprylic/capric triglyceride,ethoxydiglycol, pentaclethra macroloba seed oil, polysorbate 20, sodium pca,chlorphenesin, d-panthenol, disodium edta, o-cymen-5-ol, hydroxypropylgluconamide, hydroxypropyl ammonium gluconate, polyquaternium-7, glycerin, magnolia officinalis bark extract, zingiber officinale root extract, hydrolyzed jojobaesters, tartaric acid, benzyl alcohol, sodium benzoate, potassium sorbate.', 'panthenol', 'assets/images/products/P054.png', 'https://www.sociolla.com/hair-mist/87300-eternal-bloom-smooth-nourishment-hair-mist', '2026-01-31'),
(55, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P055', 'Hair Volumizing Conditioner', 'Woshday', 2, 249000, 340, 'ml', 'water, cetearyl alcohol, cetyl alcohol, glycerin, isopropyl palmitate, fragrance, cetyl esters, behentrimonium chloride, brassicyl valinate esylate, stearamidopropyl dimethylamine, phenoxyethanol, brassica alcohol, citric acid, isopropyl alcohol, cetrimonium chloride, chlorphenesin, calcium gluconate, colloidal oatmeal, guar hydroxypropyltrimonium chloride, panthenol, simmondsia chinensis seed oil, vitis vinifera seed oil, lactic acid, leuconostoc/radish root ferment filtrate, dihydroxypropyl arginine hcl, polyquaternium-7, tocopheryl acetate, aloe barbadensis leaf juice, sodium benzoate, camellia sinensis leaf extract, potassium sorbate.', 'arginine, camellia sinensis leaf extract, lactic acid, panthenol, tocopheryl acetate', 'assets/images/products/P055.png', 'https://www.sociolla.com/conditioner/91716-hair-volumizing-conditioner', '2026-01-31'),
(56, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P056', 'Hair Oil with Peppermint', 'Tumbuh Lab', 6, 121500, 60, 'ml', 'virgin coconut oil, castor oil, rosemary essential oil, lavender essential oil, peppermint essential oil.', '', 'assets/images/products/P056.png', 'https://www.sociolla.com/hair-oil/75451-hair-oil-with-peppermint', '2026-01-31'),
(57, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P057', 'Hold My Strands! Hair Fall Treatment Scalp Serum', 'Wonderlux', 4, 166500, 75, 'ml', 'aqua, butylene glycol, tetrasodium, disuccinoyl cystine, propanediol, ammonium polyacryloyldimethyl taurate, hydroxypropylgluconamide, niacinamide, aloe barbadensis extract, oryza sativa bran water, hydroxypropylammonium gluconate, glycerin, ethanol, pathenol, chlorphenesin, phenoxyethanol, zingiber officinale extract, ppg-26-buteth-26, peg-40 hydrogenated castor oil, phyllanthus emblica fruit extract, bioflavonoids, glycine, apigenin, serine, glutamic acid, oleanolic acid, aspartic acid, leucine, biotinoyl tripeptide-1, alanine, lysine, arginine, tyrosine, phenylalanine, threonine, proline, valine, isoleucine, histidine.', 'arginine, biotin, niacinamide, oleanolic acid', 'assets/images/products/P057.png', 'https://www.sociolla.com/hair-serum/82735-hold-my-strands-hair-fall-treatment-scalp-serum', '2026-01-31'),
(58, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P058', 'Drop Dead Growgeous! Hair Densifying Conditioner', 'Wonderlux', 2, 62100, 160, 'ml', 'aqua, cetearyl alcohol, glycerin, mineral oil, fragrance (parfum) components and finished fragrances, stearamidopropyl dimethylamine, dimethiconol, behentrimonium chloride, dimethicone, propanediol, ceteareth-22, phenoxyethanol, cetrimonium chloride, hydrolyzed jojoba esters, citric acid, dipropylene glycol, amodimethicone, chlorphenesin, bisamino peg/ppg-41/3 aminoethyl pg-propyl dimethicone, laureth-4, laureth-5, laureth-23, peg-55 stearate, disodium edta, bht, xanthan gum, caprylyl glycol, butylene glycol, ci 19140, ci 42090, peg-26-buteth-26, peg-40 hydrogenated castor oil, magnesium ascorbyl phosphate, hydrolyzed corn protein, sodium benzoate, arginine, glycine, adenosine, serine, glutamic acid, aspartic acid, leucine, apigenin, alanine, lysine, tyrosine, phenylalanine, threonine, proline, valine, oleanolic acid, isoleucine, biotinoyl tripeptide-1, histidine, carnitine..', 'adenosine, arginine, biotin, oleanolic acid', 'assets/images/products/P058.png', 'https://www.sociolla.com/conditioner/92385-drop-dead-growgeous-hair-densifying-conditioner', '2026-01-31'),
(59, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P059', 'Pomelo Hair Tonic', 'Cocoon', 5, 114000, 140, 'ml', 'water, isododecane, c15-19 alkane, glycerin, citrus grandis peel oil, xylitylglucoside, anhydroxylitol, maltitol, xylitol, pelvetia canaliculata extract, propanediol, arginine, lactic acid, glycine soja germ extract, triticum vulgare germ extract, scutellaria baicalensis root extract, bisabolol, gluconolactone, calcium gluconate, panthenol, betaine, citrus aurantium dulcis peel oil, mentha piperita oil, sodium polyacrylate starch, glycereth-26, phenyl trimethicone, caprylyl methicone, trisodium ethylenediamine disuccinate, ethyhexylglycerin, bht, phenoxyethanol, sodium benzoate.', 'arginine, lactic acid, panthenol', 'assets/images/products/P059.png', 'https://www.sociolla.com/hair-serum/75608-pomelo-hair-tonic', '2026-01-31'),
(60, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P060', 'My Hair Recipe Essential Oil Serum', 'Innisfree', 6, 110400, 100, 'ml', 'cyclopentasiloxane, dimethiconol, octyldodecanol, camellia japonica seed oil, trisiloxane, fragrance / parfum, glycolipids, glycerin, water / aqua / eau, ceramide np, camellia japonica flower extract, phytosphingosine, hydrogenated lecithin,camellia japonica leaf extract.', 'ceramide np', 'assets/images/products/P060.png', 'https://www.sociolla.com/hair-oil/79102-my-hair-recipe-essential-oil-serum', '2026-01-31');
INSERT INTO `products` (`id`, `created_at`, `updated_at`, `product_id`, `name`, `brand`, `category_id`, `price`, `size`, `size_unit`, `ingredients`, `key_ingredients`, `image_url`, `source`, `collected_date`) VALUES
(61, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P061', 'OSweet Singapore Anti-Dandruff & Oil Control Shampoo', 'Osweet Singapore', 1, 241799, 300, 'ml', 'water, sodium lauryl alcohol polyether sulfate, essence, c8-c14 alkyl glucoside, octyl glucoside, bis aminopropyl polydimethylsiloxane, polydimethylsiloxane alcohol, cetyl alcohol, sodium stearoyl lactylate, cocamidopropyl pg dimethyl ammonium chloride, sorbitan tristearate, lysine thiazolidinecarboxylate, guar gum hydroxypropyl trimethyl ammonium chloride, allantoin, menthol, potassium cocoyl glycine potassium lauroyl sarcosine, glycerin, sodium lauryl ether sulfate, ethylene glycol distearate, polylysine, pyrrolidone ethanolamine salt, dichlorobenzyl alcohol, citric acid, silk fibroin, coconut amide dea, titanium dioxide, quaternary ammonium salt - 80, coconut glucoside, propylene glycol, sodium isostearyl lactylate, sodium lactate, polyquaternary ammonium salt - 7, benzyl alcohol, phenoxyethanol, sodium benzoate, methyl isothiazolinone.', 'allantoin, menthol', 'assets/images/products/P061.png', 'https://www.sociolla.com/shampoo/79044-o-sweet-singapore-anti-dandruff-and-oil-control-shampoo', '2026-01-31'),
(62, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P062', 'Argan Repair Hairmask', 'Dancoly', 3, 257140, 550, 'ml', 'no mineral oil/paraffin oil/vaseline, no propylene glycol, no animal testing, organic natural ingredients (89%), bpom, serta telah tersertifikasi gmp & fda.', '', 'assets/images/products/P062.png', 'https://www.sociolla.com/hair-mask/9718-argan-repair-hairmask-?size=550_gr', '2026-01-31'),
(63, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P063', 'Texture Experience Creambath Mint Sorbet Purifying & Refreshing Treatment', 'Makarizo Professional', 3, 92250, 200, 'ml', 'piroctone olamine, menthol, panthenol, hydrolyzed collagen.', 'menthol, panthenol, piroctone olamine', 'assets/images/products/P063.png', 'https://www.sociolla.com/hair-mask/28164-texture-experience-creambath-mint-sorbet-purifying-and-refreshing-treatment?size=200ml', '2026-01-31'),
(64, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P064', 'Ginseng & Chesnut Seed Extract Hair Tonic With Biotin & Panthenol', 'Votre Peau', 5, 112200, 100, 'ml', 'ekstrak ginseng, horse chestnut, retinyl palmitate, biotin, panthenol.', 'biotin, panthenol, retinyl palmitate', 'assets/images/products/P064.png', 'https://www.sociolla.com/hair-tonic/80556-ginseng-and-chesnut-seed-extract-hair-tonic-with-biotin-and-panthenol', '2026-01-31'),
(65, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P065', 'Dreamy Hour Perfume Hair Vitamin Mist', 'Hairoic', 10, 122400, 50, 'gr', 'itamin e, vitamin c (citrus sinensis peel extract), vitamin b5 (panthenol), glycerin, aloe vera extract, allantoin, niacinamide, triple shaft protection, dan blooming fragrance.', 'allantoin, niacinamide, panthenol', 'assets/images/products/P065.png', 'https://www.sociolla.com/hair-mist/91175-dreamy-hour-perfume-hair-vitamin-mist', '2026-01-31'),
(66, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P066', 'Amethyst Anti Dandruff Shampoo', 'Grace And Glow', 1, 77625, 400, 'ml', 'aqua, sodium laureth sulfate, glycerin, cocamidopropyl betaine, disodium lauroamphodiacetate, parfum, dimethicone, climbazole, sodium chloride, lactobacillus ferment, c12-13 alkyl lactate, citric acid, dichlorobenzyl alcohol, zinc gluconate, glycol distearate, disodium lauryl sulfosuccinate, cocamide dea, laureth-3, disodium edta, methylparaben, guar hydroxypropyltrimonium chloride, panthenol, hydrogenated castor oil, cocamide methyl mea, c12-13 alcohols, thuja orientalis extract, magnesium nitrate, hydrolyzed yeast extract, glucose, propylene glycol, phenoxyethanol, hydroxyacetophenone, 1,2-hexanediol, methylchloroisothiazolinone, lactic acid, lactococcus ferment lysate, magnesium chloride, ci 42090, sodium hyaluronate, methylisothiazolinone, ethylhexylglycerin, ci 16255.', 'climbazole, lactic acid, panthenol, zinc gluconate', 'assets/images/products/P066.png', 'https://www.sociolla.com/hair-mist/91175-dreamy-hour-perfume-hair-vitamin-mist', '2026-01-31'),
(67, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P067', 'Mielle Rosemary Mint Scalp Hair Strengthening Oil', 'Mielle', 6, 197000, 59, 'ml', 'soybean oil, castor seed oil, coconut oil, olive fruit oil, sweet almond oil, wheat germ oil, sunflower seed oil, grapeseed oil, jojoba seed oil, babassu seed oil, essential oil blend, rosemary leaf oil, peppermint oil, eucalyptus oil, biotin, horsetail extract, nettle leaf extract, chamomile flower extract.', 'biotin', 'assets/images/products/P067.png', 'https://www.tokopedia.com/beauty-change-storeid/mielle-rosemary-mint-scalp-hair-strengthening-oil-59ml-conditioner-dengan-biotin-untuk-rambut-kuat-berkilau-dan-kulit-kepala-sehat-1733558285217072601?extParam=ivf%3Dfalse%26keyword%3Dperawatan+rambut%26search_id%3D20260207122913577BCC914F9E553B9HOB%26src%3Dsearch&t_id=1770467395580&t_st=2&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-01-31'),
(68, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P068', 'Marula Oil Hair Serum', 'Dancoly', 11, 278100, 60, 'ml', 'helianthus annuus (sunflower) seed oil, cyclopentasiloxane, dimethicone/silsesquioxane copolymer, marula oil, macadamie ternifolia seed oil, parfum/fragrance.', '', 'assets/images/products/P068.png', 'https://www.sociolla.com/hair-serum/52711-marula-oil-hair-serum', '2026-01-31'),
(69, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P069', 'MK3 Repair & Revive Hair Mask Jar', 'Makarizo Professional', 3, 245880, 500, 'ml', 'aqua, cetearyl alcohol, glycerin, c12-15 alkyl benzoate, parfum, behentrimonium chloride, phenoxyethanol, cetrimonium chloride, panthenol, ethylhexylglycerin, sodium pca, ceteareth-20, sodium lactate, polysilicone-15, arginine, aspartic acid, pca, tetrasodium edta, argania spinosa kernel oil, cocos nucifera oil, glycine soja (soybean) oil, helianthus annuus seed oil, ethyl macadamiate, glycine, alanine, serine, valine, isoleucine, proline, threonine, actinidia chinensis (kiwi) fruit extract, histidine, phenylalanine, niacinamide, aesculus hippocastanum seed extract, yeast extract, ammonium glycyrrhizate, zinc gluconate, caffeine, tocopherol, biotin.', 'aesculus hippocastanum seed extract, argania spinosa kernel oil, arginine, biotin, caffeine, niacinamide, panthenol, tocopherol, zinc gluconate', 'assets/images/products/P069.png', 'https://www.sociolla.com/hair-serum/52711-marula-oil-hair-serum', '2026-01-31'),
(70, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P070', 'Wonder Hair Oil', 'La Dor', 6, 294000, 100, 'ml', 'cyclopentasiloxane, cyclohexasiloxane, isopropyl myristate, dimethicone, isododecane, c12-15 alkyl benzoate, hydrogenated ethylhexyl olivate, hydrogenated olive oil unsaponifiables, amodimethicone, persea gratissima (avocado) oil, argania spinosa kernel oil, tocopheryl acetate, moringa oleifera seed oil, camellia japonica seed oil, macadamia ternifolia seed oil, sclerocarya birrea seed oil, squalane, helianthus annuus (sunflower) seed oil, fragrance.', 'argania spinosa kernel oil, tocopheryl acetate', 'assets/images/products/P070.png', 'https://www.sociolla.com/hair-serum/52711-marula-oil-hair-serum', '2026-01-31'),
(71, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P071', 'Hair Mistl', 'Tumbuh Lab', 10, 117000, 100, 'ml', 'rosewater, rosemary essential oil, green tea essential oil, ylang ylang essential oil, cedarwood essential oil.', '', 'assets/images/products/P071.png', 'https://www.sociolla.com/hair-serum/52711-marula-oil-hair-serum', '2026-01-31'),
(72, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P072', 'BONVIE COCO Hair Oil Scalp & Hair Treatment', 'Bonvie', 6, 63000, 30, 'ml', 'coconut oil, kemiri, peppermint oil, tocopherol.', 'tocopherol', 'assets/images/products/P072.png', 'https://www.sociolla.com/hair-oil/86022-bonvie-coco-hair-oil-scalp-and-hair-treatment', '2026-01-31'),
(73, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P073', 'Conditioner with Cinnamon & Amino Acid', 'Ree Derma Wellness', 2, 130500, 250, 'ml', 'aqua, cetearyl alcohol, cetyl ester, behentrimonium chlroide, glycerine, lauryl acid, rosmarinus officinalis flower extract, glycine soja extract, eugenia carophyllus bud oil, phenoxyethanol, illicium verum extract, cinnamomum casia bark extract, isopropanol, sodium benzoate, myristic acid, pimpinella anisum fruit extract, cetrimonium chloride, niacinamide, palmitic acid, caprylic acid, lechitin, oleic acid, capric acid, lechitin, oleic acid, capric acid, l(+) lactic acid, arginine, stearic acid, linoleic acid, caproic acid, ethyl lauroyl arginate hcl, tetrasodium glutamate diacetate.', 'arginine, lactic acid, niacinamide', 'assets/images/products/P073.png', 'https://www.sociolla.com/conditioner/63188-conditioner-with-cinnamon-and-amino-acid', '2026-01-31'),
(74, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P074', 'MK3 Damage Repair Shampoo', 'Makarizo Professional', 1, 184464, 250, 'ml', 'aqua, sodium cocoyl isethionate, glycerin, cocamidopropyl betaine, sodium lauroyl sarcosinate, c15-19 alkane, parfum, peg-120 methyl glucose trioleate, acrylates/c10-30 alkyl acrylate crosspolymer, phenoxyethanol, polyquaternium-47, c12-15 alkyl benzoate, guar hydroxypropyltrimonium chloride, sodium hydroxide, peg-40 hydrogenated castor oil, panthenol, ethylhexylglycerin, sodium pca, sodium lactate, cocos nucifera oil, helianthus annuus seed oil, tetrasodium edta, ethyl macadamiate, arginine, aspartic acid, pca, glycine, alanine, serine, sodium benzoate, valine, isoleucine, proline, threonine, histidine, phenylalanine, niacinamide, aesculus hippocastanum seed extract, yeast extract, ammonium glycyrrhizate, methylchloroisothiazolinone, zinc gluconate, methylisothiazolinone, caffeine, tocopherol, biotin.', 'aesculus hippocastanum seed extract, arginine, biotin, caffeine, niacinamide, panthenol, tocopherol, zinc gluconate', 'assets/images/products/P074.png', 'https://www.sociolla.com/shampoo/84320-mk3-damage-repair-shampoo', '2026-01-31'),
(75, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P075', 'MK3 Repair and Revive Conditioner', 'Makarizo Professional', 2, 184464, 250, 'ml', 'aqua, cetearyl alcohol, glycerin, parfum, c12-15 alkyl benzoate, behentrimonium chloride, phenoxyethanol, cetrimonium chloride, ethylhexylglycerin, sodium pca, ceteareth-20, sodium lactate, polysilicone-15, arginine, aspartic acid, pca, tetrasodium edta, argania spinosa kernel oil, helianthus annuus seed oil, ethyl macadamiate, glycine, alanine, serine, valine, isoleucine, proline, threonine, histidine, phenylalanine, tocopherol.', 'argania spinosa kernel oil, arginine, tocopherol', 'assets/images/products/P075.png', 'https://www.sociolla.com/conditioner/84321-mk3-repair-and-revive-conditioner', '2026-01-31'),
(76, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P076', 'Diane Power Treatment Hair Mask ', 'Moist Diane', 3, 164000, 230, 'ml', 'aqua, stearyl alcohol, sorbitol, behentrimonium chloride, dimethicone, fragrance (parfum) components and finished fragrances, phenoxyethanol, isopropyl alcohol, hydroxyethylcellulose, quaternium-33, butylene glycol, arginine, glutamic acid, argania spinosa kernel oil, hydrolyzed collagen, hydrolyzed egg shell membrane, glycerin, alcohol, hydrolyzed milk protein, hydrolyzed keratin pg-propyl methylsilanediol, propylene glycol, laurdimonium hydroxypropyl hydrolyzed keratin, hydrolyzed keratin, hydrolyzed silk, keratin, polyquaternium-61, distearyldimonium chloride, cholesterol, ceramide ng, ceramide as, ceramide np, ceramide ap, ceramide eop, caramel.', 'argania spinosa kernel oil, arginine, ceramide np, hydrolyzed keratin, hydrolyzed silk, keratin', 'assets/images/products/P076.png', 'https://www.sociolla.com/hair-mask/80754-diane-power-treatment-hair-mask-230g', '2026-01-31'),
(77, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P077', 'Hijab Expert Hair Fall Treatment Shampoo', 'Safi', 1, 64900, 230, 'ml', 'water, sodium laureth sulfate, cocamidopropyl betaine, dimethiconol, glyceryl stearate, glycerin, panthenol, carbomer, sodium chloride, styrene/acrylates copolymer, guarhydroxypropyltrimonium chloride, sodium hydroxide, tetrasodium edta, peg-14m, charcoal powder, hydrolyzed wheat protein, nigella sativa (habbatus sauda) seed oil, fragrance, methylchloroisothiazolinone, methylisothiazolinone. climbazole, carbomer, menthol, styrene/acrylates copolymer, guar hydroxypropyltrimonium chloride, copolymer, guar hydroxypropyltrimonium chloride, silicone quaternium-16, peg-14m, sodium hydroxide, argania spinosa kernel oil, sodium chloride.', 'argania spinosa kernel oil, climbazole, hydrolyzed wheat protein, menthol, panthenol', 'assets/images/products/P077.png', 'https://www.sociolla.com/shampoo/25190-hijab-expert-hair-fall-treatment-shampoo?size=320_gr', '2026-01-31'),
(78, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P078', 'Deep Nourish Repair Hair Oil', 'Ree Derma Wellness', 6, 182600, 100, 'ml', 'lauric acid, olive (olea europaea) oil, myristic acid, palmitic acid, caprilyc acid, oleic acid, capric acid, stearic acid, linoleic acid, parfum, caproic acid, tocopheryl acetate, biotin, turmeric (curcuma longa) extract, isononyl isononanoate, isostearoyl hydrolyzed keratin.', 'biotin, hydrolyzed keratin, keratin, tocopheryl acetate', 'assets/images/products/P078.png', 'https://www.sociolla.com/hair-oil/75544-deep-nourish-repair-hair-oil', '2026-01-31'),
(79, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P079', 'Daeng Gi Meo Ri - Vitalizing Shampoo', 'Daeng Gi Meo Ri', 1, 199000, 300, 'ml', 'water (aqua), sodium laureth sulfate, cocamidopropyl betaine, sodium chloride, glycol distearate, cocamide mea, citric acid, polyquaternium-10, panthenol, salicylic acid, menthol, alcohol, peg-150 distearate, disodium edta, phenoxyethanol, fragrance (parfum), ginseng root extract, rehmannia chinensis root extract, houttuynia cordata extract, green tea extract, artemisia extract, cnidium officinale root extract.', 'menthol, panthenol, salicylic acid', 'assets/images/products/P079.png', 'https://www.tokopedia.com/daenggimeoriid/daeng-gi-meo-ri-vitalizing-shampoo-300ml-shampo-perawatan-rambut-rontok-kering-dan-ketombe-1729383425484752232?extParam=ivf%3Dfalse%26keyword%3Dperawatan+rambut%26search_id%3D20260207122913577BCC914F9E553B9HOB%26src%3Dsearch&t_id=1770467395580&t_st=3&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-01-31'),
(80, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P080', 'Perfumed Hair Oil Hinoki', 'La Dor', 6, 287000, 80, 'ml', 'cyclopentasiloxane, dimethicone, dimethiconol, c12-15 alkyl benzoat, cyclohexasiloxane, squalane, amodimethicone, persea gratissima (avocado) oil, argania spinosa kernel oil, tocopheryl acetate, camellia japonica seed oil, corylopsis coreana extract, water, lactobacillus/rice ferment, angelica koreana root extract, butylene glycol, 1,2-hexanediol, keratin, elastin, gelatin, fragrance, limonene, linalool, coumarin, citronellol, hydroxycitronellal.', 'argania spinosa kernel oil, keratin, tocopheryl acetate', 'assets/images/products/P080.png', 'https://www.sociolla.com/hair-oil/75977-lador-perfumed-hair-oil-hinoki?size=80ml', '2026-01-31'),
(81, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P081', 'MK3 Restructuring Serum Bottle', 'Makarizo Professional', 11, 217008, 50, 'ml', 'aqua, diglycerin, peg-40 hydrogenated castor oil, parfum, polyquaternium-47, cetrimonium chloride, phenoxyethanol, panthenol, actinidia chinensis (kiwi) fruit extract, ethylhexylglycerin, sodium pca, sodium lactate, arginine, tetrasodium edta, aspartic acid, pca, sodium benzoate, cocos nucifera oil, ethyl macadamiate, glycine, alanine, serine, valine, isoleucine, proline, threonine, histidine, phenylalanine, tocopherol, ci 42090.', 'arginine, panthenol, tocopherol', 'assets/images/products/P081.png', 'https://www.sociolla.com/hair-serum/84323-mk3-restructuring-serum-bottle', '2026-01-31'),
(82, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P082', 'Fino Premium Touch Hair Oil ', 'Fino', 6, 162000, 70, 'ml', 'hydrogenated polyisobutene, dimethiconol, isopropyl myristate, isododecane, polysilicone-13, perfume, squalane, lauroyl glutamic acid di(phytosteryl/octyldodecyl), lactic acid, hydrolysed conchiolin, dimethicone, tocopherol, water, amodimethicone, ppg -2-deceth-12, bg, glycerol, phenoxyethanol <m110970-202>.', 'lactic acid, tocopherol', 'assets/images/products/P082.png', 'https://www.tokopedia.com/fino-by-finetoday-official/fino-premium-touch-hair-oil-70ml-1731912727677142828?extParam=ivf%3Dfalse%26keyword%3Dhair+care%26search_id%3D2026020411191963923F49E52413393NHM%26src%3Dsearch&t_id=1770203980668&t_st=1&t_pp=search_result&t_efo=search_pure_goods_card&t_ef=goods_search&t_sm=&t_spt=search_result', '2026-02-04'),
(83, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P083', 'SELSUN YELLOW DOUBLE IMPACT SHAMPOO ', 'Selsun', 1, 39000, 50, 'ml', 'sodium laureth sulfate, aqua (water), glycol stearate, acrylates/vinyl neodecanoate crosspolymer, cocamide dea, acacia senegal gum, fragrance, selenium sulfide, zinc pyrithione, glyceryl ricinoleate, dmdm hydantoin, citric acid, sodium chloride, ci 15610.', '', 'assets/images/products/P083.png', 'https://www.tokopedia.com/apotek-taman-kedoya-by-goapotik/selsun-yellow-double-impact-shampoo-50-ml?t_id=1770203980668&t_st=5&t_pp=product_detail&t_efo=horizontal_goods_card&t_ef=goods_search&t_sm=rec_product_detail_outer_pdp_3_module&t_spt=product_detail', '2026-02-04'),
(84, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P084', 'Dove 1 Minute Super Conditioner - Intensive Damage Treatment ', 'Dove', 2, 22000, 170, 'ml', 'water, cetearyl alcohol, behentrimonium chloride, dipropylene glycol, glycerin, perfume, dimethicone, gluconolactone, trehalose, helianthus annuus (sunflower) seed oil, c10-40 isoalkylamidopropylethyldimonium ethosulfate, sodium sulfate, tocopheryl acetate, argania spinosa kernel oil, cocos nucifera (coconut) oil, prunus amygdalus dulcis (sweet almond) oil, mineral oil, amodimethicone, disodium edta, phenoxyethanol, cetrimonium chloride, peg-7 propylheptyl ether, magnesium nitrate, cyclotetrasiloxane, methylchloroisothiazolinone, magnesium chloride, methylarachidic acid, methylisothiazolinone, sodium chloride, acetic acid.', 'argania spinosa kernel oil, tocopheryl acetate', 'assets/images/products/P084.png', 'https://www.watsons.co.id/id/dove-dove-1-minute-super-conditioner-intensive-damage-treatment-170ml/p/BP_70286', '2026-02-04'),
(85, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P085', 'SELSUN COND NOURISHING ', 'Selsun', 2, 33300, 100, 'GR', 'selenium sulfide hydrolized protein prunus dulcis oil dan provitamin b5.', '', 'assets/images/products/P085.png', 'https://www.watsons.co.id/id/selsun-selsun-cond-nourishing-100gr/p/BP_70344', '2026-02-04'),
(86, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P086', 'Hair Tonic Micellar Hairfall Control ', 'Dove', 5, 46900, 75, 'ml', 'water, oleth-20, phenoxyethanol, glycerin, caprylyl glycol, perfume, disodium edta, zinc sulfate heptahydrate, hydrolyzed yeast protein, urea, sodium benzoate, disodium phosphate, sodium hydroxide, potassium sorbate, biotin, citric acid, ceramide ng.', 'biotin', 'assets/images/products/P086.png', 'https://www.watsons.co.id/id/dove-hair-tonic-micellar-hairfall-control-75ml/p/BP_64364', '2026-02-04'),
(87, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P087', 'Creambath Biotin Haifall Control ', 'Dove', 9, 73000, 300, 'g', 'water, cetearyl alcohol, behentrimonium chloride, glycerin, dimethicone, perfume , dipropylene glycol, citric acid, sodium benzoate, amodimethicone, sodium gluconate, sodium citrate, disodium edta, cetrimonium chloride, phenoxyethanol, peg-7 propylheptyl ether, zinc sulfate heptahydrate, ceramide ng, urea, hydrolyzed yeast protein, biotin, disodium phosphate, potassium sorbate.', 'biotin', 'assets/images/products/P087.png', 'https://www.watsons.co.id/id/dove-creambath-biotin-haifall-control-300g/p/BP_66723', '2026-02-04'),
(88, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P088', 'PRO-V Shampoo Anti Lepek', 'Pantene', 1, 28900, 135, 'ml', 'water, sodium laureth sulfate, cocamidopropyl betaine, sodium chloride, sodium xylenesulfonate, sodium citrate, fragrance, dimethiconol, citric acid, sodium benzoate, guar hydroxypropyltrimonium chloride, tetrasodium edta, panthenol, histidine, methylchloroisothiazolinone, methylisothiazolinone.', 'panthenol', 'assets/images/products/P088.png', 'https://www.watsons.co.id/id/pantene-pro-v-shampoo-anti-lepek-135ml/p/BP_73609', '2026-02-04'),
(89, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P089', 'Miracles Intensive Bond Repair Hair Mask', 'Pantene', 3, 88000, 300, 'ml', 'water (aqua), cetearyl alcohol, dimethicone, behentrimonium chloride, glycerin, fragrance (parfum), hydrolyzed keratin, panthenol, various oils (such as argan oil or coconut oil), preservatives and other conditioning agents.', 'hydrolyzed keratin, keratin, panthenol', 'assets/images/products/P089.png', 'https://www.watsons.co.id/id/pantene-miracles-intensive-bond-repair-hair-mask-300-ml/p/BP_67033', '2026-02-04'),
(90, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P090', 'Tresemme Conditioner For Bleached Hair Color Radiance & Repair', 'Tresemmé', 2, 99360, 250, 'ml', 'water, cetearyl alcohol, dimethicone, behentrimonium chloride, perfume, dipropylene glycol, strearamidopropyl dimethylamine, amodimethicone, sodium chloride, lactic acid disodium edta, phenoxyethanol, peg-7 propylheptyl ether, cetrimonium chloride, cyclotetrasiloxane, magnesium nitrate, helianthus annuus (sunflower) seed oil, glycine soja (soybean) phytoplacenta extract, sodium sulfate, methylchloroisothiazolinone, magnesium chloride, methylisothiazolinone, glycerin, acetic acid, calcium chloride, ci 60730.', 'lactic acid', 'assets/images/products/P090.png', 'https://www.sociolla.com/conditioner/48649-kem-xa-color-radiance-and-repair-toc-tay', '2026-02-04'),
(91, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P091', 'Hair Mask Pro Keratin Complex Hair Repair Tube', 'Ellips', 3, 56810, 120, 'g', 'aqua, cetearyl alcohol, dimethicone, cetyl esters, potato starch modified, steartrimonium chloride, amodimethicone, fragrance, dimethiconol, phenoxyethanol, benzyl alcohol, sodium benzoate, isopropyl alcohol, hydrolyzed vegetable protein, lactic acid, cyclotetrasiloxane, panthenol, simmondsia chinensis (jojoba) seed oil, cetrimonium chloride, tocopheryl acetate (vitamin e), cyclopentasiloxane, dimethyl palmitamine, soybean (glycine soja) oil, retinyl palmitate, ascorbyl palmitate.', 'lactic acid, panthenol, retinyl palmitate, tocopheryl acetate', 'assets/images/products/P091.png', 'https://www.sociolla.com/hair-mask/28614-hair-mask-pro-keratin-complex-hair-repair-tube', '2026-02-04'),
(92, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P092', 'Hair Xpert Oil Treatment For Hair Fall', 'Safi', 6, 64500, 100, 'ml', 'mineral oil', '', 'assets/images/products/P092.png', 'https://www.sociolla.com/shampoo/26645-veggie-pro-nourishing-shampoo', '2026-02-04'),
(93, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P093', 'Veggie Pro Nourishing Shampoo', 'The Bath Box', 1, 185000, 200, 'ml', 'water, cetyl alcohol, behentrimonium methosulfate, caprylic/capric triglyceride, honey, simmondsia chinensis (jojoba) seed oil, polyester-37, hydrolyzed vegetable protein pg-propyl silanetriol, hydrogenated polydecene, hydrolyzed vegetable protein, hydrolyzed pea protein, citrus sinensis peel oil (orange oil), rosmarinus officinalis leaf oil (rosemary oil), lavandula angustifolia oil (lavender oil), cananga odorata flower oil (ylang-ylang oil), pelargonium graveolens oil (geranium oil), butylene glycol, polyquaternium-37, polyquaternium-47, trisodium ethylenediamine disuccinate, trideceth-6, disodium edta, sodium benzoate, potassium sorbate, phenoxyethanol, ethylhexylglycerin, citric acid.', 'rosmarinus officinalis leaf oil', 'assets/images/products/P093.png', 'https://www.sociolla.com/shampoo/26645-veggie-pro-nourishing-shampoo', '2026-02-04'),
(94, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P094', 'Smooth Intense Hair Spa Mask', 'Loreal Paris', 3, 90000, 200, 'ml', 'aqua/water, cetearyl alcohol, behentrimonium chloride, glycerin, amodimethicone, cetyl esters, potato starch modified, isopropyl alcohol, phenoxyethanol, argania spinosa (argan) kernel oil, trideceth-6, chlorhexidine dihydrochloride, xylose, camelina sativa seed oil, limonene, linalool, benzyl alcohol, benzyl salicylate, alpha-isomethyl ionone, geraniol, cetrimonium chloride, butylphenyl methylpropional', '', 'assets/images/products/P094.png', 'https://www.sociolla.com/hair-mask/10237-smooth-intense-hair-spa-mask', '2026-02-04'),
(95, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P095', 'Calm & Cool Refresh Hair Oil', 'Ree Derma Wellness', 6, 209000, 100, 'ml', 'lauric acid, myristic acid, palmitic acid, caprylic acid, oleic acid, capric acid, stearic acid, linoleic acid, lavandula angustifolia oil, mentha piperita oil, eucalyptus radiata leaf/stem oil, caproic acid, zingiber cassumunar root oil.', '', 'assets/images/products/P095.png', 'https://www.sociolla.com/hair-oil/75541-calm-and-cool-refresh-hair-oil', '2026-02-04'),
(96, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P096', 'Clarify Cleanse Hair Oil', 'Ree Derma Wellness', 6, 220000, 100, 'ml', 'lauric acid, myristic acid, cinnamomum cassia bark, palmitic acid, caprilyc acid, oleic acid, capric acid, stearic acid, linoleic acid, cinnamomum cassia leaf oil, caproic acid, rosmarinus ocinalis flower oil, eugenia caryophyllus bud oil, foeniculum vulgare dulce fruit oil, illicium verum oil.', '', 'assets/images/products/P096.png', 'https://www.sociolla.com/hair-oil/75543-clarify-cleanse-hair-oil', '2026-02-04'),
(97, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P097', 'Nourishing Hair Serum', 'Djamujamu', 11, 175500, 45, 'ml', 'diethylhexyl carbonate, caprylic/capric triglyceride, oleyl erucate, argania spinosa kernel oil, prunus amygdalus dulcis oil, aleurites moluccanus seed oil, pelargonium graveolens flower oil, citrus limon fruit oil.', 'argania spinosa kernel oil', 'assets/images/products/P097.png', 'https://www.sociolla.com/hair-serum/74233-nourishing-hair-serum', '2026-02-04'),
(98, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P098', 'Black Bean Anti Hair Loss Shampoo', 'Nature Republic', 1, 265000, 300, 'ml', 'water, coco-betaine, tea-cocoyl glutamate, disodium laureth sulfosuccinate, sodium lauroyl methylaminopropionate, sodium lauroyl methyl isethionate, polyquaternium-10, caprylyl glycol, menthol , ppg-3 myristyl ether, rehmannia chinensis root extract, citrus nobilis (mandarin orange) peel extract, pentasodium pentetate, salicylic acid (hair conditioning), panthenol, mentha arvensis leaf oil, citrus aurantifolia (lime) oil, butylene glycol, mentha arvensis extract, niacinamide, 1,2-hexanediol, chrysanthemum zawadskii extract, glycyrrhiza glabra (licorice) root extract, lycium chinense fruit extract, biota orientalis leaf extract, acorus calamus root extract, morus alba bark extract, xanthium strumarium fruit extract, panax ginseng root extract, acacia senegal gum, peat water, glycerin, citric acid, hydroxypropyl methylcellulose, ethylhexylglycerin, centella asiatica leaf extract, glycine soja (soybean) seed extract, vaccinium angustifolium (blueberry) fruit extract, rubus fruticosus (blackberry) fruit extract, ribes nigrum (black currant) fruit extract, nigella sativa seed extract, oryza sativa (rice) extract, sesamum indicum (sesame) seed extract, salvia hispanica seed extract, potassium sorbate, hydrogenated lecithin, ethylhexylglycerin, ceramide np, propolis extract.', 'ceramide np, menthol, niacinamide, panax ginseng root extract, panthenol, salicylic acid', 'assets/images/products/P098.png', 'https://www.sociolla.com/hair-serum/74233-nourishing-hair-serum', '2026-02-04'),
(99, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P099', 'Extra Damage Repair Hair Mask', 'Moist Diane', 3, 105910, 150, 'gr', 'water, cetearyl alcohol, dimethicone, bis-behenyl/isostearyl/phytosteryl dimer dilinoleyl dimer dilinoleate, steartrimonium chloride, ethylhexyl palmitate, steardimonium hydroxypropyl hydrolyzed keratin, propanediol, quaternium-33, gamma-docosalactone, glucose, butylene glycol, hydroxyproline, prunus domestica seed extract or prunus domestica seed oil ,alanine, hydrolyzed honey protein, sodium hyaluronate, hydroxypropyltrimonium hyaluronate, sodium pca, keratin, hydrolyzed conchiolin protein, malus domestica fruit cell culture extract, rhododendron ferrugineum leaf cell culture extract, collagen, isomalt, hydrolyzed keratin, hydrolyzed hyaluronic acid, cetearamidoethyl diethonium hydrolyzed rice protein, panthenol, polyglyceryl-2 isostearate/dimer dilinoleate copolymer, isononyl isononanoate, isostearoyl hydrolyzed keratin, bis-ethoxydiglycol cyclohexane 1,4-dicarboxylate, pouteria sapota seed oil, shorea stenoptera seed butter, sclerocarya birrea seed oil, theobroma grandiflorum seed butter, mangifera indica (mango) seed oil, ceramide ng, argania spinosa kernel oil, glycine soja (soybean) sterols, ceramide 5, ceramide np, ceramide ap, ceramide eop, carapa guaianensis seed oil, adansonia digitata seed oil, opuntia ficus-indica seed oil, bis-(polyglyceryl-3 oxyphenylpropyl) dimethicone, sodium lactate, cholesterol, argania spinosa callus culture extract, peg-90m, xanthan gum, glyceryl tri-hydrogenated rosinate [c] hydrogenated glyceryl dehydroabietate/tetrahydroabietate, lecithin, dicocodimonium chloride, quaternium-18, behentrimonium chloride, isopropyl alcohol, propylene glycol, glycerin, lactic acid, tocopherol, disodium edta, phenoxyethanol, sodium benzoate, fragrance, caramel.', 'argania spinosa kernel oil, ceramide np, hydrolyzed keratin, keratin, lactic acid, panthenol, tocopherol', 'assets/images/products/P099.png', 'https://www.sociolla.com/hair-mask/64182-extra-damage-repair-hair-mask', '2026-02-04'),
(100, '2026-02-21 07:48:21', '2026-02-21 07:48:21', 'P100', 'Extra Smooth & Straight Hair Mask', 'Moist Diane', 3, 105910, 150, 'gr', 'aqua, cetearyl alcohol, dimethicone, glycerin, ethylhexyl palmitate, steartrimonium chloride, polyglyceryl-2 isostearate/dimer dilinoleate copolymer, fragrance (parfum) components and finished fragrances, dicocodimonium , chloride, phenoxyethanol, ppg-3 caprylyl ether, bis-(polyglyceryl-3 oxyphenylpropyl), dimethicone, behenyl alcohol, isopropyl alcohol, glucose, amodimethicone, caramel, disodium edta, peg-90m, lactic acid, sodium lactate, o-cymen-5-ol, sodium benzoate, acetyl cysteine, oenocarpus bataua fruit oil, propylene glycol, ascorbyl tetraisopalmitate, hydrolyzed keratin, glyoxylic acid, butylene glycol, alcohol, propanediol, schinziophyton rautanenii kernel oil, pouteria sapota seed oil, shorea stenoptera seed butter, chenopodium quinoa seed oil, isostearic acid, quaternium-18, sodium lauraminopropionate, hydroxypropyltrimonium hydrolyzed keratin, laurdimonium hydroxypropyl hydrolyzed keratin, cetearamidoethyl diethonium hydrolyzed rice protein, tocopherol, prunus domestica seed extract, sclerocarya birrea seed oil, theobroma grandiflorum seed butter, mangifera indica seed oil, carapa guaianensis seed oil, adansonia digitata seed oil, quaternium-33, citric acid, cholesterol, hydrolyzed silk pg-propyl methylsilanediol, behentrimonium chloride, hydrolyzed quinoa, gamma-docosalactone, ceramide ng, adansonia digitata seed oi, alcohol denat, isomalt, isostearoyl hydrolyzed collagen, terminalia ferdinandiana fruit extract, keratin, argania spinosa kernel oil, soybean ( glycine soja ) sterol, cellulose gum, ceramide as, hydrolyzed conchiolin protein, sodium bicarbonate, malus domestica fruit cell culture extract, benzyl alcohol, potassium sorbate, ceramide np, ceramide ap, xanthan gum, lecithin, argania spinosa callus culture extract, ceramide eop, gold, collagen, silver.', 'argania spinosa kernel oil, ceramide np, hydrolyzed keratin, hydrolyzed silk, keratin, lactic acid, tocopherol', 'assets/images/products/P100.png', 'https://www.sociolla.com/hair-mask/74478-extra-smooth-and-straight-hair-mask', '2026-02-04');

-- --------------------------------------------------------

--
-- Table structure for table `scalp_conditions`
--

CREATE TABLE `scalp_conditions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scalp_conditions`
--

INSERT INTO `scalp_conditions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Berminyak', '2026-02-14 10:31:21', '2026-02-14 10:31:21'),
(2, 'Iritasi', '2026-02-14 10:31:21', '2026-02-14 10:31:21'),
(3, 'Kering', '2026-02-14 10:31:21', '2026-02-14 10:31:21'),
(4, 'Normal', '2026-02-14 10:31:21', '2026-02-14 10:31:21'),
(9, 'Berminyak', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(10, 'Iritasi', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(11, 'Kering', '2026-02-21 07:30:37', '2026-02-21 07:30:37'),
(12, 'Normal', '2026-02-21 07:30:37', '2026-02-21 07:30:37');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('DExHAnHOCj6ITSAQf6GkTneK3HrOJECkLHwXbfpS', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36 Edg/145.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY256dXdMMWxiRlYyUGQ3dHFpdDdkcGRVMkFpWXJHbTI3RG5ES0RuZiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9nZXQtcHJvZHVjdHM/ZmlsdGVyPWFsbCI7czo1OiJyb3V0ZSI7czoxNToicHJvZHVjdHMuZmlsdGVyIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1771755968);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `profile_picture`) VALUES
(1, 'Long Widianto', 'longdev', 'long@mail.com', NULL, '$2y$12$ng6HYb2ylcSzJCpuo/aWRucLWUzOQ42GYkg5igSer9QY7cSIiDB5K', NULL, '2026-01-31 11:54:28', '2026-01-31 11:54:28', NULL),
(3, 'Livi Rivana Nosa', 'NAPIII', 'livirivananosa@gmail.com', NULL, '$2y$12$KMdH6RYa0Fa1iaXmCcLzKudXrT26m8zkZQtOS3W9RoLBw6d5najja', NULL, '2026-01-31 12:40:03', '2026-02-13 09:01:37', 'users/MgkiE9BX7ziGASBy1RW1nirsgOt6zMIiX8iS41tI.jpg'),
(4, 'Dwiki Widianto', 'Dwiki', 'dwikiwidianto7@gmail.com', NULL, '$2y$12$RQRtmaPqsMqrCkA2f4O33eXW8eNrxJsENTV1FTDZWGBX89eTvS2ji', NULL, '2026-01-31 12:41:03', '2026-02-13 08:25:28', 'users/nyfyRFlijyomvn5aGHm3PxQrCXKf0TiCQbS6QuOp.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hair_assessments`
--
ALTER TABLE `hair_assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hair_assessments_user_id_foreign` (`user_id`);

--
-- Indexes for table `hair_assessment_hair_problems`
--
ALTER TABLE `hair_assessment_hair_problems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hair_assessment_hair_problems_hair_assessment_id_foreign` (`hair_assessment_id`),
  ADD KEY `hair_assessment_hair_problems_hair_problem_id_foreign` (`hair_problem_id`);

--
-- Indexes for table `hair_assessment_scalp_conditions`
--
ALTER TABLE `hair_assessment_scalp_conditions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hair_assessment_scalp_conditions_hair_assessment_id_foreign` (`hair_assessment_id`),
  ADD KEY `hair_assessment_scalp_conditions_scalp_condition_id_foreign` (`scalp_condition_id`);

--
-- Indexes for table `hair_problems`
--
ALTER TABLE `hair_problems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_id_unique` (`product_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `scalp_conditions`
--
ALTER TABLE `scalp_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hair_assessments`
--
ALTER TABLE `hair_assessments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `hair_assessment_hair_problems`
--
ALTER TABLE `hair_assessment_hair_problems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hair_assessment_scalp_conditions`
--
ALTER TABLE `hair_assessment_scalp_conditions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hair_problems`
--
ALTER TABLE `hair_problems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `scalp_conditions`
--
ALTER TABLE `scalp_conditions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hair_assessments`
--
ALTER TABLE `hair_assessments`
  ADD CONSTRAINT `hair_assessments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hair_assessment_hair_problems`
--
ALTER TABLE `hair_assessment_hair_problems`
  ADD CONSTRAINT `hair_assessment_hair_problems_hair_assessment_id_foreign` FOREIGN KEY (`hair_assessment_id`) REFERENCES `hair_assessments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hair_assessment_hair_problems_hair_problem_id_foreign` FOREIGN KEY (`hair_problem_id`) REFERENCES `hair_problems` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hair_assessment_scalp_conditions`
--
ALTER TABLE `hair_assessment_scalp_conditions`
  ADD CONSTRAINT `hair_assessment_scalp_conditions_hair_assessment_id_foreign` FOREIGN KEY (`hair_assessment_id`) REFERENCES `hair_assessments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hair_assessment_scalp_conditions_scalp_condition_id_foreign` FOREIGN KEY (`scalp_condition_id`) REFERENCES `scalp_conditions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
