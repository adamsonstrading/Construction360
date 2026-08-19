-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2026 at 03:28 PM
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
-- Database: `construction360`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `category` varchar(255) NOT NULL DEFAULT 'Uncategorized',
  `content` longtext NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL DEFAULT 'Construction 360',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `excerpt`, `category`, `content`, `image_url`, `author`, `meta_title`, `meta_description`, `meta_keywords`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'The Future of Integrated Design & Construction Management', 'future-integrated-design-construction-management', 'Discover how unifying structural engineering, architectural design, and digital project management reduces delivery times and eliminates costly design discrepancies.', 'Company', '<p class=\"mb-4\">In traditional construction, the separation between design planning and field execution is one of the primary drivers of budget overruns, delayed handovers, and structural deviations. When architects, structural engineers, and site developers operate in silos, miscommunications are inevitable.</p><p class=\"mb-4\">At <strong>Construction 360 Ltd</strong>, we solve this through a unified approach. By integrating structural calculations directly with real-time architectural blueprints and commercial contracting models, we create a seamless flow from paper to timber and steel. This 360-degree digital overview ensures that any modification requested by building control or site developers updates across all active project files instantaneously.</p><p class=\"mb-4\">Central to this model is our commitment to a digital-first communication channel. By routing all project briefs and architectural specifications through structured, immutable digital logs and decommissioning legacy telephone routes, we preserve an exact audit trail. This means no details are lost in casual conversation, safety margins are strictly maintained, and construction tolerances are met to the millimeter.</p>', 'images/blog_integrated.png', 'Construction 360 Editorial', 'The Future of Integrated Design & Construction Management | Construction 360', 'Learn how integrating architectural design with structural engineering under digital-first standards ensures seamless build handovers with zero errors.', 'integrated design, construction management, BIM, architectural precision, digital contracting', '2026-07-03 10:29:46', '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(2, 'Mastering Bespoke Glazing: A Guide to Modern Structural Glass', 'mastering-bespoke-glazing-guide-modern-structural-glass', 'An in-depth look at specifying high-performance double and triple glazing for modern residential extensions, from U-values to structural frame design.', 'Tips & Tricks', '<p class=\"mb-4\">Contemporary architectural design increasingly relies on structural glass to bridge the gap between interior comfort and outdoor natural light. Double-height rear extensions, minimal-profile sliding doors, and structural glass rooflights are highly sought after by homeowners seeking to modernize their properties.</p><p class=\"mb-4\">However, executing large-scale glazing installations is a complex engineering challenge. High-performance glass requires precise structural calculations to account for wind loads, building deflection, and thermal expansion. Additionally, maintaining low U-values—the measure of thermal transmittance—is critical for meeting building control insulation standards.</p><p class=\"mb-4\">We ensure all glazing installations use top-tier insulated glass units (IGUs) matched with custom-extruded aluminum frames. Upon completion, we provide FENSA certification and comprehensive structural warranties, ensuring your architectural centerpieces are as energy-efficient and secure as they are visually striking.</p>', 'images/blog_glazing.png', 'Lead Glazing Engineer', 'Bespoke Glazing & Modern Structural Glass Guide | Construction 360', 'Dive deep into structural glazing for residential home extensions, including thermal U-values, wind-load calculations, and FENSA certifications.', 'structural glass, glazing, FENSA compliance, U-values, home extensions', '2026-07-01 10:29:46', '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(3, 'Commercial Fit-Outs: Maximizing Workspace Efficiency and Compliance', 'commercial-fit-outs-maximizing-workspace-efficiency-compliance', 'How commercial developers navigate building control regulations, CSCS safety standards, and space optimization for modern corporate hubs.', 'Processes', '<p class=\"mb-4\">Refurbishing or fitting out a commercial space involves balancing human-centric design with strict regulatory compliance. Whether you are building out a modern co-working space, a high-traffic retail outlet, or a corporate headquarters, compliance with local fire codes, mechanical system regulations, and access guidelines is non-negotiable.</p><p class=\"mb-4\">Every successful fit-out begins with space optimization planning. This involves positioning HVAC ducting, acoustic partitions, and emergency escape routes cleanly without sacrificing floor space or natural light. To guarantee execution quality on site, every surveyor, structural builder, and technician we deploy is fully CSCS certified, ensuring safety guidelines are executed to the highest standards.</p><p class=\"mb-4\">By tracking and managing project timelines through centralized progress logs, commercial directors can view milestone check-offs in real time. This digital tracking minimizes overheads, eliminates contractor scheduling conflicts, and delivers a commercial environment tailored for operational excellence.</p>', 'images/blog_fitout.png', 'Project Management Lead', 'Commercial Fit-Outs & Workspace Compliance | Construction 360', 'Explore strategies for executing commercial renovations and workspace fit-outs aligned with fire codes, CSCS certification, and space efficiency.', 'commercial fit-out, office renovation, building control, CSCS, workspace design', '2026-06-28 10:29:46', '2026-07-03 10:29:46', '2026-07-03 10:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_queries`
--

CREATE TABLE `contact_queries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','reviewed','archived') NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_queries`
--

INSERT INTO `contact_queries` (`id`, `name`, `email`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Shahid Rasheed', 'shahidrasheedsmm@gmail.com', 'Testing email', 'i am testing', 'new', '2026-08-12 10:09:18', '2026-08-12 10:09:18'),
(2, 'Hedda Benson', 'cunar@mailinator.com', 'Estimate · External Works', 'Expedita accusamus a\n\n—\nPhone: +44 (489) 376-1227\nService: External Works\nWhen to start: 6+ months\nApprox. budget: Prefer not to say\nBest day to call: Thursday\nBest time to call: Morning (9–12)', 'new', '2026-08-13 04:01:16', '2026-08-13 04:01:16'),
(3, 'Tamekah Parrish', 'tyzigyno@mailinator.com', 'Excepteur rerum quia', 'Sunt voluptates illo', 'new', '2026-08-13 04:15:46', '2026-08-13 04:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_06_15_000001_create_site_contents_table', 1),
(5, '2026_06_15_000002_create_services_table', 1),
(6, '2026_06_15_000003_create_contact_queries_table', 1),
(7, '2026_06_15_000004_create_blogs_table', 1),
(8, '2026_06_17_000001_create_projects_table', 2),
(9, '2026_06_17_000002_create_team_members_table', 2),
(10, '2026_06_17_094517_add_status_to_projects_table', 3),
(11, '2026_06_17_100000_add_category_to_blogs_table', 4),
(12, '2026_06_17_161152_sync_live_database_data', 5),
(13, '2026_06_24_000000_add_details_to_services_table', 6),
(14, '2026_06_30_082614_add_seo_fields_to_services_table', 7),
(15, '2026_07_02_000001_add_deliverables_to_services_table', 8),
(16, '2026_08_10_220000_create_partners_table', 9),
(17, '2026_08_12_000001_seed_homepage_dynamic_content', 10);

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `image_url` varchar(191) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `image_url`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'CHAS', 'images/partners/chas.png', 1, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(2, 'Constructionline', 'images/partners/constructionline.png', 2, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(3, 'NICEIC', 'images/partners/niceic.png', 3, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(4, 'Federation of Master Builders', 'images/partners/fmb.png', 4, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(5, 'TrustMark', 'images/partners/trustmark.png', 5, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(6, 'SafeContractor', 'images/partners/safecontractor.png', 6, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(7, 'Gas Safe Register', 'images/partners/gassafe.png', 7, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(8, 'NAPIT', 'images/partners/napit.png', 8, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(9, 'RIBA', 'images/partners/riba.svg', 9, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(10, 'ARB', 'images/partners/arb.png', 10, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(11, 'SMAS Worksafe', 'images/partners/smas.svg', 11, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(12, 'IWA', 'images/partners/iwa.png', 12, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(13, 'HomePro', 'images/partners/homepro.svg', 13, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(14, 'Freedom Homes Architects', 'images/partners/freedom-homes.svg', 14, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(15, 'Extension Plans', 'images/partners/extension-plans.svg', 15, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(16, 'Trusted Partner', 'images/partners/teal-house.svg', 16, '2026-08-10 12:07:23', '2026-08-10 12:07:23'),
(17, 'RAMs', 'images/partners/rams.svg', 17, '2026-08-10 12:07:23', '2026-08-10 12:07:23');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'completed',
  `description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `title`, `slug`, `category`, `status`, `description`, `image_url`, `location`, `year`, `display_order`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'Haydons road', 'haydons-road', 'Residential', 'under-construction', 'Ground-up construction of a purpose-built residential block of flats. Features optimized layouts, energy-efficient specifications, and strict compliance with building regulations Part B & L.', 'images/1786379250_webaliser-_TPTXZd9mOo-unsplash.jpg', 'London, Merton', '2026', 1, 'Modern Project', 'this is modern project', 'modern', '2026-07-03 10:29:46', '2026-08-12 10:27:34'),
(2, 'Streatham High road', 'streatham-high-road', 'Residential', 'under-construction', 'Conversion of a commercial retail unit into residential flats. Focuses on structural space planning, soundproofing, and modern interior design suitable for the Lambeth community.', 'images/1786379432_frames-for-your-heart-2d4lAQAlbDA-unsplash.jpg', 'London, Lambeth', '2026', 2, NULL, NULL, NULL, '2026-07-03 10:29:46', '2026-08-10 11:30:32'),
(3, 'Hinton', 'hinton', 'Residential', 'under-construction', 'Development of boutique residential units with modern steel-frame structure, triple glazing window specifications, and high-spec mechanical installations.', 'images/project_hinton.png', 'London, Lambeth', '2026', 3, NULL, NULL, NULL, '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(4, 'Hoxton', 'hoxton', 'Commercial', 'under-construction', 'CAT A & B office fit-out and commercial workspace conversion. Delivering raised flooring, acoustical partitions, and brand-sensitive interior finishes.', 'images/project_hoxton.png', 'London, Hackney', '2025', 4, NULL, NULL, NULL, '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(5, 'Sutherland House', 'sutherland-house', 'Commercial', 'under-construction', 'High-specification refurbishment of a heritage commercial building. Preserving historical facade while implementing modern interior space planning and mechanical extraction.', 'images/project_sutherland.png', 'London, Kensington and Chelsea', '2026', 5, NULL, NULL, NULL, '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(6, 'Gilsland Spa Hotel', 'gilsland-spa-hotel', 'Commercial', 'completed', 'Complete facilities management and external fabric maintenance for a landmark spa resort. Includes HVAC upgrade, brick pointing, and preventative upkeep cycles.', 'images/project_gilsland.png', 'Cumbria', '2024', 6, NULL, NULL, NULL, '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(7, 'Finchley High road', 'finchley-high-road', 'Residential', 'completed', 'A completed multi-unit residential apartment development. Delivered from ground-up foundations to zero-defect handovers with NHBC structural warranty.', 'images/project_finchley.png', 'London, Barnet', '2024', 7, NULL, NULL, NULL, '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(8, 'Belgravia House', 'belgravia-house', 'Residential', 'completed', 'A high-end residential HMO conversion. Transformed a Victorian building into high-spec flat units with fire compartmentation and integrated smart amenities.', 'images/project_belgravia.png', 'London, Wandsworth', '2025', 8, NULL, NULL, NULL, '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(9, 'Balham 176', 'balham-176', 'Residential', 'completed', 'Bespoke residential block of flats. Features custom-extruded aluminum window frames, double glazing, and high-spec kitchen and bathroom fit-outs.', 'images/project_balham.png', 'London, Wandsworth', '2025', 9, NULL, NULL, NULL, '2026-07-03 10:29:46', '2026-07-03 10:29:46');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `icon` varchar(255) NOT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `about` text DEFAULT NULL,
  `why_choose_us` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`why_choose_us`)),
  `services_offered` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`services_offered`)),
  `faqs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`faqs`)),
  `image_url` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `deliverables` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `icon`, `display_order`, `created_at`, `updated_at`, `about`, `why_choose_us`, `services_offered`, `faqs`, `image_url`, `meta_title`, `meta_description`, `meta_keywords`, `deliverables`) VALUES
(1, 'Pre-Construction', 'Detailed architectural drawings, feasibility studies, planning permissions, building regulations, and structural engineering to set a solid foundation for your project.', 'building-office-2', 1, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'Before ground breaking, every successful build relies on technical planning, architectural accuracy, and budget alignment. At Construction 360 Ltd, we coordinate your development\'s pre-construction phase, from bespoke architectural design and planning permissions to building regulations compliance and structural engineering. We align design intent with cost plans and site feasibility from day one to ensure your project starts.', '[{\"title\":\"Policy Expertise\",\"desc\":\"We navigate permitted development limits, building control, and planning policies across London and Essex.\"},{\"title\":\"Precise Visuals\",\"desc\":\"Our architectural design packages clearly communicate project feasibility and aesthetic value.\"},{\"title\":\"Cost Control\",\"desc\":\"Quantity surveying and financial planning are integrated early to prevent unexpected cost overruns.\"},{\"title\":\"Project Administration\",\"desc\":\"We manage tenders, health and safety (CDM), and pre-commencement planning approvals.\"}]', '[{\"title\":\"Architectural Services\",\"desc\":\"Bespoke design concepts, floor plans, and layout elevations.\",\"meta_title\":\"Architectural Services UK | Expert Building Design\",\"meta_description\":\"Professional architectural services for residential and commercial developments across the UK, from concept design to construction-ready plans.\",\"meta_keywords\":\"architecturalservicesuk, architectsuk, buildingdesignuk, propertydesignuk, constructiondesignuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Architectural Design\",\"desc\":\"Detailed interior and exterior spatial architectural designs.\",\"meta_title\":\"Architectural Design UK | Innovative Design Solutions\",\"meta_description\":\"Creative architectural design services delivering functional, compliant and sustainable buildings throughout the UK.\",\"meta_keywords\":\"architecturaldesignuk, buildingdesignuk, modernarchitectureuk, architecturalplansuk, designservicesuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Planning Permission\",\"desc\":\"Preparing and submitting full planning applications for local authority approval.\",\"meta_title\":\"Planning Permission UK | Planning Experts\",\"meta_description\":\"Expert planning permission services helping homeowners and developers secure approvals quickly across the UK.\",\"meta_keywords\":\"planningpermissionuk, planningconsultancyuk, planningapprovaluk, planningservicesuk, planningapplicationsuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Building Regulations\",\"desc\":\"Technical drawings and specification packages complying with building codes.\",\"meta_title\":\"Building Regulations UK | Compliance Experts\",\"meta_description\":\"Ensure your project complies with UK Building Regulations through professional design reviews and approvals.\",\"meta_keywords\":\"buildingregulationsuk, buildingcontroluk, constructioncomplianceuk, regulationsuk, buildingconsultancyuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Structural Engineering\",\"desc\":\"Calculation packages and steelwork connection details for structural safety.\",\"meta_title\":\"Structural Engineering UK | Structural Design Experts\",\"meta_description\":\"Reliable structural engineering services for residential, commercial and industrial construction projects.\",\"meta_keywords\":\"structuralengineeringuk, structuraldesignuk, buildingengineersuk, constructionengineeringuk, engineeringservicesuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Civil Engineering\",\"desc\":\"Below-ground drainage layouts, site levels, and structural calculations.\",\"meta_title\":\"Civil Engineering UK | Infrastructure Solutions\",\"meta_description\":\"Professional civil engineering services including drainage, highways and infrastructure design across the UK.\",\"meta_keywords\":\"civilengineeringuk, drainagedesignuk, infrastructureengineeringuk, siteengineeringuk, highwaysdesignuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Quantity Surveying\",\"desc\":\"Bills of Quantities, tender packages, and cost planning.\",\"meta_title\":\"Quantity Surveying UK | Cost Management Experts\",\"meta_description\":\"Expert quantity surveying services providing academic planning, budgeting and commercial advice.\",\"meta_keywords\":\"quantitysurveyinguk, costmanagementuk, constructioncostsuk, quantitysurveyorsuk, costplanninguk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Project Management\",\"desc\":\"Liaising with surveyors, design teams, and local authorities.\",\"meta_title\":\"Construction Project Management UK\",\"meta_description\":\"End-to-end construction project management delivering projects on time, within budget and to the highest standards.\",\"meta_keywords\":\"projectmanagementuk, constructionmanagementuk, buildingprojectsuk, projectconsultancyuk, constructionservicesuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Construction Management\",\"desc\":\"Detailed schedules and construction execution planning.\",\"meta_title\":\"Construction Management UK | Build Specialists\",\"meta_description\":\"Professional construction management services ensuring efficient planning, coordination and successful project delivery.\",\"meta_keywords\":\"constructionmanagementuk, constructionprojectsuk, buildingmanagementuk, sitemanagementuk, constructionconsultantsuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Building Consultancy\",\"desc\":\"Expert advice on structural design and site viability.\",\"meta_title\":\"Building Consultancy UK | Expert Property Advice\",\"meta_description\":\"Trusted building consultancy services offering technical advice, compliance support and construction expertise.\",\"meta_keywords\":\"buildingconsultancyuk, propertyconsultancyuk, constructionconsultancyuk, buildingexpertsuk, propertyadviceuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Site Surveys\",\"desc\":\"Comprehensive measured surveys of existing properties.\",\"meta_title\":\"Site Surveys UK | Professional Survey Services\",\"meta_description\":\"Accurate site surveys supporting planning, design and successful construction projects across the UK.\",\"meta_keywords\":\"sitesurveysuk, landsurveyuk, sitesurveyinguk, constructionsurveyuk, propertysurveyuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Land Surveying\",\"desc\":\"Determining boundary lines and site layouts for construction.\",\"meta_title\":\"Land Surveying UK | Accurate Survey Solutions\",\"meta_description\":\"Professional land surveying services providing precise measurements for planning and development projects.\",\"meta_keywords\":\"landsurveyinguk, landsurveyuk, propertysurveyuk, surveyingservicesuk, siteplanninguk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Topographical Surveys\",\"desc\":\"Mapping site terrain levels, contours, and physical features.\",\"meta_title\":\"Topographical Surveys UK | Expert Mapping\",\"meta_description\":\"Detailed topographical surveys for residential, commercial and infrastructure developments.\",\"meta_keywords\":\"topographicalsurveysuk, topographicalsurveyuk, landsurveyuk, mappingservicesuk, sitesurveysuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Ground Investigation\",\"desc\":\"Assessing geological soil profiles and load bearing capacity.\",\"meta_title\":\"Ground Investigation UK | Site Investigation Experts\",\"meta_description\":\"Comprehensive ground investigation services assessing soil and site conditions before construction begins.\",\"meta_keywords\":\"groundinvestigationuk, siteinvestigationuk, geotechnicaluk, constructionsiteuk, soilinvestigationuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Soil Testing\",\"desc\":\"Chemical and structural soil testing for foundations and piling.\",\"meta_title\":\"Soil Testing UK | Geotechnical Testing Services\",\"meta_description\":\"Professional soil testing services supporting safe foundations and compliant construction projects.\",\"meta_keywords\":\"soiltestinguk, geotechnicaltestinguk, groundtestinguk, constructiontestinguk, soilanalysisuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Cost Estimation\",\"desc\":\"Compiling accurate itemized estimates of building costs.\",\"meta_title\":\"Construction Cost Estimation UK\",\"meta_description\":\"Accurate construction cost estimation services for residential and commercial developments.\",\"meta_keywords\":\"costestimationuk, constructioncostsuk, buildingestimatesuk, projectbudgetuk, costconsultancyuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Cost Planning\",\"desc\":\"Developing budget limits and financial controls for development schemes.\",\"meta_title\":\"Cost Planning UK | Construction Budget Experts\",\"meta_description\":\"Strategic cost planning services helping developers maximise value while controlling project budgets.\",\"meta_keywords\":\"costplanninguk, constructionbudgetuk, quantitysurveyinguk, projectcostsuk, costmanagementuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Feasibility Studies\",\"desc\":\"Analyzing site constraints, policy limits, and development yields.\",\"meta_title\":\"Feasibility Studies UK | Development Analysis\",\"meta_description\":\"Professional feasibility studies evaluating technical, financial and planning viability of developments.\",\"meta_keywords\":\"feasibilitystudiesuk, developmentfeasibilityuk, propertyanalysisuk, siteappraisaluk, planningfeasibilityuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Planning Consultancy\",\"desc\":\"Strategic advice on planning regulations and permitted developments.\",\"meta_title\":\"Planning Consultancy UK | Planning Specialists\",\"meta_description\":\"Expert planning consultancy helping clients navigate planning policies and secure successful approvals.\",\"meta_keywords\":\"planningconsultancyuk, planningconsultantsuk, planningpermissionuk, planningadviceuk, developmentplanninguk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Building Control Consultancy\",\"desc\":\"Advising on accessibility, fire safety, and code compliance.\",\"meta_title\":\"Building Control Consultancy UK\",\"meta_description\":\"Building control consultancy ensuring compliance with UK Building Regulations from design to completion.\",\"meta_keywords\":\"buildingcontrolconsultancyuk, buildingcontroluk, buildingregulationsuk, constructioncomplianceuk, buildingconsultantsuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Principal Designer (CDM)\",\"desc\":\"Coordinating health and safety risks during design stages.\",\"meta_title\":\"CDM Principal Designer UK | Construction Safety\",\"meta_description\":\"Professional CDM Principal Designer services ensuring health and safety compliance throughout your project.\",\"meta_keywords\":\"principaldesigneruk, cdmuk, constructionhealthandsafetyuk, constructiondesignuk, cdmprincipaldesigneruk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"},{\"title\":\"Tender Management\",\"desc\":\"Drafting contract packages, managing builder bids, and contract award.\",\"meta_title\":\"Tender Management UK | Construction Procurement\",\"meta_description\":\"Professional tender management services helping clients achieve competitive pricing and quality contractors.\",\"meta_keywords\":\"tendermanagementuk, constructiontendersuk, procurementuk, constructionprocurementuk, tenderconsultancyuk\",\"deliverables\":\"Regulatory & Code Compliance, Quality Assured Craftsmanship, Experienced Civil Engineers, Comprehensive Sign-Off\"}]', '[{\"q\":\"How long does it take to secure planning permission?\",\"a\":\"Council determination typically takes 8 weeks for householders\\/minor works and 13 weeks for major schemes from the validation date.\"},{\"q\":\"What does a feasibility study cover?\",\"a\":\"It evaluates development yield, planning policy risks, utility constraints, and structural buildability to ensure your scheme is commercial.\"},{\"q\":\"Why is a soil test required?\",\"a\":\"Soil testing determines the soil\'s bearing capacity, moisture content, and depth, allowing structural engineers to design the correct foundation.\"},{\"q\":\"What is the role of the CDM Principal Designer?\",\"a\":\"They manage health and safety risks during the pre-construction phase, preparing the file to ensure the build remains safe.\"}]', 'images/services/pre-construction.jpg', 'Pre-Construction Services UK | Expert Planning & Design', 'Professional pre-construction services in the UK including planning, design, engineering, surveying and project consultancy for successful developments.', 'preconstructionuk, constructionplanninguk, propertydevelopmentuk, constructionconsultancyuk, preconstructionservicesuk', NULL),
(2, 'Site Preparation', 'Professional site clearance, demolition, strip outs, excavation, earthworks, leveling, and utility installation to prepare any plot for ground breaking.', 'map', 2, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'Transforming raw land or old structures into a builder-ready site requires heavy plant expertise and absolute precision. Construction 360 Ltd handles all aspects of site preparation, including land clearance, structural demolition, internal strip outs, earthworks, and service utility installations. We execute all works under strict environmental controls to prepare your plot safely for ground breaking.', '[{\"title\":\"Safe Demolition\",\"desc\":\"We execute structural demolition and strip outs following strict HSE guidelines and method statements.\"},{\"title\":\"High Precision\",\"desc\":\"Laser-guided excavation and site grading ensure site levels match architectural datum points.\"},{\"title\":\"Drainage Works\",\"desc\":\"We install pre-construction drainage infrastructure and connection channels early.\"},{\"title\":\"Utility Liaison\",\"desc\":\"We manage service trench installations and coordinate mains hookups with utility boards.\"}]', '[{\"title\":\"Site Clearance\",\"desc\":\"Removing obstacles, debris, and vegetative growth from the site.\",\"meta_title\":\"Site Clearance Services UK | Expert Site Clearing\",\"meta_description\":\"Reliable site clearance services across the UK, removing vegetation, waste and obstacles to prepare land for safe construction and development.\",\"meta_keywords\":\"siteclearanceuk, siteclearinguk, constructionclearanceuk, landpreparationuk, groundclearanceuk\"},{\"title\":\"Land Clearance\",\"desc\":\"Clearing larger plots and greenfield\\/brownfield sites.\",\"meta_title\":\"Land Clearance Services UK | Professional Land Clearing\",\"meta_description\":\"Expert land clearance services for residential, commercial and industrial developments, preparing sites efficiently and safely.\",\"meta_keywords\":\"landclearanceuk, landclearinguk, sitepreparationuk, propertydevelopmentuk, constructionservicesuk\"},{\"title\":\"Demolition\",\"desc\":\"Controlled structural demolition of residential and commercial units.\",\"meta_title\":\"Demolition Services UK | Safe Building Demolition\",\"meta_description\":\"Professional demolition services across the UK for residential, commercial and industrial properties with safe and compliant project delivery.\",\"meta_keywords\":\"demolitionuk, buildingdemolitionuk, demolitioncontractorsuk, constructiondemolitionuk, siteclearanceuk\"},{\"title\":\"Strip Out\",\"desc\":\"Removing internal partitions, finishes, and services prior to refurbishment.\",\"meta_title\":\"Strip Out Contractors UK | Internal Demolition Experts\",\"meta_description\":\"Specialist strip out services removing internal fixtures, fittings and finishes for refurbishment, renovation and redevelopment projects.\",\"meta_keywords\":\"stripoutuk, internaldemolitionuk, stripoutcontractorsuk, commercialstripoutuk, buildingrefurbishmentuk\"},{\"title\":\"Excavation\",\"desc\":\"Deep digging for foundations, drainage, and basements.\",\"meta_title\":\"Excavation Services UK | Ground Excavation Experts\",\"meta_description\":\"Professional excavation services for foundations, basements, drainage and infrastructure projects throughout the UK.\",\"meta_keywords\":\"excavationuk, groundexcavationuk, excavationservicesuk, constructionexcavationuk, foundationexcavationuk\"},{\"title\":\"Groundworks\",\"desc\":\"Initial sub-structural works including earth moving and pipe laying.\",\"meta_title\":\"Groundworks Contractors UK | Expert Groundworks\",\"meta_description\":\"Comprehensive groundworks services including foundations, drainage, excavation and site preparation across the UK.\",\"meta_keywords\":\"groundworksuk, groundworkcontractorsuk, constructiongroundworksuk, foundationsuk, sitepreparationuk\"},{\"title\":\"Earthworks\",\"desc\":\"Moving and reshaping soil levels to specification.\",\"meta_title\":\"Earthworks Services UK | Bulk Earthmoving Experts\",\"meta_description\":\"Professional earthworks services for site grading, excavation, embankments and large-scale construction developments.\",\"meta_keywords\":\"earthworksuk, earthmovinguk, sitegradinguk, constructionearthworksuk, groundengineeringuk\"},{\"title\":\"Site Levelling\",\"desc\":\"Grading the site to establish level construction platforms.\",\"meta_title\":\"Site Levelling Services UK | Ground Levelling Experts\",\"meta_description\":\"Accurate site levelling services creating stable, level ground ready for residential, commercial and infrastructure construction.\",\"meta_keywords\":\"sitelevellinguk, groundlevellinguk, sitegradinguk, constructionsiteuk, earthworksuk\"},{\"title\":\"Drainage Installation\",\"desc\":\"Laying foul water sewers and rainwater drainage channels.\",\"meta_title\":\"Drainage Installation UK | Drainage Solutions\",\"meta_description\":\"Professional drainage installation services including surface water, foul drainage and sustainable drainage systems across the UK.\",\"meta_keywords\":\"drainageinstallationuk, drainageservicesuk, drainagedesignuk, surfacedrainageuk, groundworksuk\"},{\"title\":\"Utility Installation\",\"desc\":\"Coordinating service duct runs for electric, water, and gas mains.\",\"meta_title\":\"Utility Installation Services UK | Infrastructure Experts\",\"meta_description\":\"Expert utility installation services including water, gas, electricity and telecom infrastructure for construction projects.\",\"meta_keywords\":\"utilityinstallationuk, utilitiesuk, infrastructureuk, constructionutilitiesuk, siteinfrastructureuk\"}]', '[{\"q\":\"Do you handle hazardous materials like asbestos during demolition?\",\"a\":\"Yes. We coordinate independent asbestos testing and handle fully certified removal and disposal before structural works begin.\"},{\"q\":\"What is a strip-out service?\",\"a\":\"A strip-out clears all non-structural components (partitions, carpets, wiring, plumbing) back to the masonry shell, preparing it for refurbishment.\"},{\"q\":\"How do you protect adjacent buildings during excavation?\",\"a\":\"We implement vibration sensors, dust sheets, and design temporary structural shoring to ensure complete stability.\"}]', 'images/services/site-preparation.jpg', 'Site Preparation Services UK | Groundworks & Clearance', 'Professional site preparation services across the UK including site clearance, excavation, drainage, utilities and groundworks for residential and commercial projects.', 'sitepreparationuk, groundworksuk, constructionsiteuk, siteclearanceuk, buildingpreparationuk', NULL),
(3, 'Foundations', 'Heavy substructure works including deep piling, concrete slab foundations, basement excavation, and ground beams built to support structural load.', 'shield-check', 3, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'A build is only as secure as the ground it rests upon. Our foundations team delivers heavy sub-structure concrete engineering for sites with complex structural requirements or challenging ground conditions. We specialize in deep piling systems, reinforced concrete slab foundations, ground beam installation, and waterproof basement constructions built to transfer structural loads safely.', '[{\"title\":\"Engineering Precision\",\"desc\":\"All foundation pours are executed exactly to structural calculations and inspected by building control.\"},{\"title\":\"Piling Capabilities\",\"desc\":\"Screw, mini, and bored piling options to resolve soft or shrinkable clay soil issues.\"},{\"title\":\"Waterproof Basements\",\"desc\":\"We design and construct below-ground basements with Type A, B, and C waterproofing to BS 8102 standards.\"},{\"title\":\"Certified Materials\",\"desc\":\"We use only high-specification reinforced steel and certified concrete mixes for maximum strength.\"}]', '[{\"title\":\"Foundations\",\"desc\":\"Construction of strip, trench fill, raft, or pad foundations.\",\"meta_title\":\"Foundation Construction UK | Strong Building Foundations\",\"meta_description\":\"Expert foundation construction services delivering safe, durable and engineered foundations tailored to residential, commercial and industrial building projects.\",\"meta_keywords\":\"foundationconstructionuk, buildingfoundationsuk, foundationcontractorsuk, structuralfoundationsuk, constructionservicesuk\"},{\"title\":\"Piling\",\"desc\":\"Bored, driven, or screw piling for low bearing capacity ground.\",\"meta_title\":\"Piling Contractors UK | Professional Piling Services\",\"meta_description\":\"Expert piling services across the UK providing reliable deep foundation solutions for residential, commercial and large-scale construction developments.\",\"meta_keywords\":\"pilinguk, pilingcontractorsuk, deepfoundationsuk, foundationengineeringuk, constructionpilinguk\"},{\"title\":\"Concrete Foundations\",\"desc\":\"Pouring reinforced concrete slabs and ground beams.\",\"meta_title\":\"Concrete Foundations UK | Strong Foundation Solutions\",\"meta_description\":\"High-quality concrete foundation services designed for long-lasting structural stability in residential, commercial and industrial construction projects.\",\"meta_keywords\":\"concretefoundationsuk, concreteconstructionuk, foundationbuildersuk, reinforcedconcreteuk, buildingfoundationsuk\"},{\"title\":\"Basement Construction\",\"desc\":\"Sub-ground excavation, retaining walls, and waterproofing.\",\"meta_title\":\"Basement Construction UK | Expert Basement Builders\",\"meta_description\":\"Professional basement construction services across the UK, creating durable, waterproof and structurally sound underground spaces for residential and commercial properties.\",\"meta_keywords\":\"basementconstructionuk, basementbuildersuk, undergroundconstructionuk, basementdevelopmentuk, propertyextensionsuk\"}]', '[{\"q\":\"What is piling and when is it required?\",\"a\":\"Piling involves driving or boring structural columns deep into the ground. It is required when topsoil is soft, clay is shrinkable, or structural loads are too high for standard foundations.\"},{\"q\":\"How do you guarantee a dry basement?\",\"a\":\"We combine waterproof concrete (Type B) with external tanking membranes (Type A) and cavity drain pumps (Type C) to prevent water ingress.\"},{\"q\":\"What inspection steps happen during a foundation pour?\",\"a\":\"Building Control checks excavation depth, reinforcement steel layouts, and tests concrete samples during the pour for quality compliance.\"}]', 'images/services/foundations.jpg', 'Foundations Services UK | Foundation Construction Experts', 'Discover comprehensive foundation services in the UK, including piling, concrete foundations and basement construction for residential, commercial and industrial developments.', 'foundationsuk, foundationservicesuk, foundationconstructionuk, constructionfoundationsuk, buildingfoundationsuk', NULL),
(4, 'Structural Works', 'Reinforced concrete frames, structural steelwork, masonry, blockwork, bricklaying, and timber framing engineered for maximum structural durability.', 'cube', 4, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'Erecting the load-bearing frame of a building demands qualified trades and meticulous coordination. Construction 360 Ltd delivers full-scale structural framing and masonry solutions. We construct reinforced concrete (RC) frames, erect multi-storey structural steel portals, lay facing brickwork, and assemble structural timber frame systems built to withstand the test of time.', '[{\"title\":\"Coded Welding\",\"desc\":\"Our site steelwork is assembled and welded by coded structural fabricators in compliance with building regulations.\"},{\"title\":\"RC Frame Expertise\",\"desc\":\"We build reinforced concrete structures with precision formwork and curing controls.\"},{\"title\":\"Premium Masonry\",\"desc\":\"External brickwork, blockwork, and decorative stonework executed to impeccable aesthetic standards.\"},{\"title\":\"Timber Craft\",\"desc\":\"Structural timber frame erection, joist layouts, and roof truss systems built by master carpenters.\"}]', '[{\"title\":\"Reinforced Concrete\",\"desc\":\"Constructing RC frames, columns, slabs, and retaining walls.\",\"meta_title\":\"Reinforced Concrete UK | Concrete Structure Experts\",\"meta_description\":\"Expert reinforced concrete services delivering strong, durable and compliant structural solutions for residential, commercial and industrial developments.\",\"meta_keywords\":\"reinforcedconcreteuk, concretestructuresuk, concreteconstructionuk, structuralconcreteuk, constructionservicesuk\"},{\"title\":\"Concrete Works\",\"desc\":\"Formwork, steel reinforcement installation, and concrete finishing.\",\"meta_title\":\"Concrete Works UK | Professional Concrete Contractors\",\"meta_description\":\"Comprehensive concrete works including slabs, columns, beams, foundations and structural concrete for construction projects across the UK.\",\"meta_keywords\":\"concreteworksuk, concretecontractorsuk, concreteconstructionuk, structuralconcreteuk, buildingcontractorsuk\"},{\"title\":\"Steel Frame Construction\",\"desc\":\"Erecting structural steel portals and multi-storey frames.\",\"meta_title\":\"Steel Frame Construction UK | Steel Building Experts\",\"meta_description\":\"Professional steel frame construction services providing durable, efficient and cost-effective structural solutions for commercial and residential buildings.\",\"meta_keywords\":\"steelframeconstructionuk, steelbuildingsuk, steelstructuresuk, constructionuk, commercialconstructionuk\"},{\"title\":\"Structural Steel\",\"desc\":\"Fabrication and installation of steel beams, columns, and splices.\",\"meta_title\":\"Structural Steel UK | Steel Fabrication & Installation\",\"meta_description\":\"Expert structural steel fabrication and installation services for commercial, industrial and residential construction projects across the UK.\",\"meta_keywords\":\"structuralsteeluk, steelfabricationuk, steelinstallationuk, steelconstructionuk, constructionengineeringuk\"},{\"title\":\"Bricklaying\",\"desc\":\"High-quality external facing brickwork and load-bearing walls.\",\"meta_title\":\"Bricklaying Services UK | Professional Bricklayers\",\"meta_description\":\"Skilled bricklaying services delivering high-quality walls, facades and structural brickwork for residential and commercial developments.\",\"meta_keywords\":\"bricklayinguk, bricklayersuk, brickworkuk, buildingconstructionuk, masonryservicesuk\"},{\"title\":\"Blockwork\",\"desc\":\"Internal partition load walls using dense or lightweight thermal blocks.\",\"meta_title\":\"Blockwork Services UK | Expert Blockwork Contractors\",\"meta_description\":\"Professional blockwork services providing durable structural walls and partitions for residential, commercial and industrial construction projects.\",\"meta_keywords\":\"blockworkuk, blockworkcontractorsuk, constructionblockworkuk, buildingservicesuk, masonryconstructionuk\"},{\"title\":\"Stonework\",\"desc\":\"Bespoke stone facades, walling, and decorative masonry arches.\",\"meta_title\":\"Stonework Services UK | Stone Masonry Specialists\",\"meta_description\":\"Expert stonework services delivering high-quality natural and engineered stone construction, restoration and architectural masonry across the UK.\",\"meta_keywords\":\"stoneworkuk, stonemasonryuk, stonemasonsuk, buildingstoneuk, constructionservicesuk\"},{\"title\":\"Timber Frame Construction\",\"desc\":\"Erecting pre-fabricated or site-built timber frames.\",\"meta_title\":\"Timber Frame Construction UK | Timber Building Experts\",\"meta_description\":\"Professional timber frame construction services creating sustainable, energy-efficient residential and commercial buildings across the UK.\",\"meta_keywords\":\"timberframeconstructionuk, timberbuildingsuk, timberconstructionuk, sustainableconstructionuk, woodframeuk\"},{\"title\":\"Masonry\",\"desc\":\"Traditional load-bearing block, brick, and stone structures.\",\"meta_title\":\"Masonry Services UK | Professional Masonry Contractors\",\"meta_description\":\"Comprehensive masonry services including brick, block and stone construction for durable residential and commercial building projects.\",\"meta_keywords\":\"masonryuk, masonryservicesuk, brickandblockuk, constructionmasonryuk, buildingcontractorsuk\"}]', '[{\"q\":\"What is the advantage of an RC (Reinforced Concrete) Frame?\",\"a\":\"RC frames offer exceptional load capacity, spans, sound insulation, and fire safety, making them ideal for multi-unit and commercial builds.\"},{\"q\":\"Do you fabricate your own structural steel beams?\",\"a\":\"Yes, we supply, fabricate, and install custom steel beams (RSJs), portal frames, and structural connections to detail.\"},{\"q\":\"Can you construct architectural timber frame buildings?\",\"a\":\"Yes. We erect modern timber frame systems that offer rapid construction speed and outstanding energy-efficiency values.\"}]', 'images/services/structural-works.png', 'Structural Works UK | Expert Construction Services', 'Professional structural works services across the UK including concrete, steel, masonry, brickwork and timber frame construction for residential and commercial projects.', 'structuralworksuk, constructionservicesuk, buildingstructureuk, structuralconstructionuk, commercialconstructionuk', NULL),
(5, 'Roofing & Building Envelope', 'High-performance roofing systems, flat roofs, pitched roof installations, sensitive structural roof repairs, and complete building envelope waterproofing.', 'home', 5, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'A property\'s external shell must provide total weather protection while maintaining high thermal performance. Our roofing and building envelope division specializes in flat and pitched roof installations, using modern slate, clay tiles, GRP fiberglass, and EPDM rubber membranes. We also coordinate insulation upgrades and structural roof timbers to secure a fully watertight, energy-efficient building envelope.', '[{\"title\":\"Watertight Guarantees\",\"desc\":\"We offer long-term warranties on our EPDM, GRP fiberglass, and pitched roof tiling installations.\"},{\"title\":\"Traditional Slating\",\"desc\":\"Expert tile and slate roofers capable of detailing complex valleys, dormers, and lead flashing.\"},{\"title\":\"Part L Compliance\",\"desc\":\"We integrate warm-roof insulation strategies to satisfy modern energy efficiency building codes.\"},{\"title\":\"Envelope Integrity\",\"desc\":\"We coordinate flashings, gutters, fascia boards, and cladding to protect your walls.\"}]', '[{\"title\":\"Roofing\",\"desc\":\"Complete roof installations for residential and commercial schemes.\",\"meta_title\":\"Roofing Services UK | Professional Roofing Contractors\",\"meta_description\":\"Expert roofing services for residential, commercial and industrial properties, delivering durable, weather-resistant roofing solutions across the UK.\",\"meta_keywords\":\"roofinguk, roofingcontractorsuk, roofinstallationuk, commercialroofinguk, buildingroofinguk\"},{\"title\":\"Flat Roofing\",\"desc\":\"EPDM rubber, GRP fiberglass, and torch-on felt installations.\",\"meta_title\":\"Flat Roofing UK | Flat Roof Installation & Repairs\",\"meta_description\":\"Professional flat roofing services including installation, maintenance and repairs for residential and commercial buildings throughout the UK.\",\"meta_keywords\":\"flatroofinguk, flatroofinstallationuk, flatroofrepairsuk, roofingcontractorsuk, commercialflatroofinguk\"},{\"title\":\"Pitched Roofing\",\"desc\":\"Slating, tiling, and timber roof truss erection.\",\"meta_title\":\"Pitched Roofing UK | Roof Installation Specialists\",\"meta_description\":\"Expert pitched roofing services providing durable tiled and slate roof installations, repairs and replacements across the UK.\",\"meta_keywords\":\"pitchedroofinguk, roofinstallationuk, tileroofinguk, slateroofinguk, pitchedroofrepairsuk\"},{\"title\":\"Roof Repairs\",\"desc\":\"Replacing broken slates, repairing lead valleys, and leaks.\",\"meta_title\":\"Roof Repairs UK | Fast & Reliable Roofing Repairs\",\"meta_description\":\"Professional roof repair services fixing leaks, storm damage and structural roofing issues for residential and commercial properties across the UK.\",\"meta_keywords\":\"roofrepairsuk, leakrepairsuk, stormdamageuk, structuralroofrepairsuk, fastroofrepairsuk\"},{\"title\":\"Roof Replacement\",\"desc\":\"Full strip-out and re-roofing including underlay and battens.\",\"meta_title\":\"Roof Replacement UK | New Roof Installation Experts\",\"meta_description\":\"Complete roof replacement services delivering durable, energy-efficient roofing systems for homes, commercial buildings and industrial properties.\",\"meta_keywords\":\"roofreplacementuk, newroofinstallationuk, roofreplacementservicesuk, residentialroofreplacementuk, commercialroofreplacementuk\"}]', '[{\"q\":\"Which is better for a flat roof: GRP Fiberglass or EPDM Rubber?\",\"a\":\"GRP is seamless, tough, and ideal for balconies\\/walkways. EPDM is flexible, synthetic rubber that handles thermal expansion perfectly and has an outstanding lifespan.\"},{\"q\":\"Do you install warm-roof or cold-roof insulation systems?\",\"a\":\"We install both. Warm-roof systems place insulation above the structural timber deck, preventing cold bridging and condensation issues.\"},{\"q\":\"What causes roof leaks and how are they repaired?\",\"a\":\"Cracked lead valleys, loose slates, or deteriorated flat roof joints. We locate the root cause, renew the membrane or tiles, and install code-compliant lead flashings.\"}]', 'images/services/roofing.jpg', 'Roofing & Building Envelope UK | Expert Roofing Services', 'Professional roofing and building envelope services across the UK, including roof installation, repairs, replacements and weatherproof building solutions.', 'roofinguk, buildingenvelopeuk, roofingservicesuk, constructionroofinguk, weatherproofinguk', NULL),
(6, 'MEP Services', 'Integrated Mechanical, Electrical, and Plumbing engineering layouts including full rewiring, smart building automation, plumbing installations, and HVAC servicing.', 'bolt', 6, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'Mechanical, Electrical, and Plumbing (MEP) systems are the vital services that bring buildings to life. At Construction 360 Ltd, our registered NICEIC electrical contractors and Gas Safe engineers deliver integrated MEP solutions. From full property rewires and smart home installations to central heating, HVAC ventilation, and renewable solar systems, we ensure complete compliance with BS regulations.', '[{\"title\":\"NICEIC Approved\",\"desc\":\"Our electrical division is NICEIC certified, providing full domestic and commercial installation certificates.\"},{\"title\":\"Gas Safe Registered\",\"desc\":\"Our plumbing team is Gas Safe certified, ensuring safe gas, boiler, and central heating installs.\"},{\"title\":\"Smart Integrations\",\"desc\":\"We install EV charge points, solar PV systems, battery banks, and secure CCTV access networks.\"},{\"title\":\"Climate Systems\",\"desc\":\"Integrated comfort cooling (AC), central heating, and mechanical ventilation heat recovery (MVHR).\"}]', '[{\"title\":\"Electrical Installation\",\"desc\":\"NICEIC certified power, sockets, distribution boards, and rewiring.\",\"meta_title\":\"Electrical Installation UK | Certified Electricians\",\"meta_description\":\"Professional electrical installation services for residential, commercial and industrial properties, delivering safe, reliable and compliant electrical systems.\",\"meta_keywords\":\"electricalinstallationuk, electricalservicesuk, electriciansuk, buildingelectricaluk, electricalcontractorsuk\"},{\"title\":\"Rewiring\",\"desc\":\"Replacing old wiring to comply with 18th Edition regulations.\",\"meta_title\":\"House Rewiring UK | Professional Rewiring Services\",\"meta_description\":\"Expert rewiring services upgrading outdated electrical systems to improve safety, efficiency and compliance for homes and commercial buildings.\",\"meta_keywords\":\"rewiringuk, houserewiringuk, electricalrewiringuk, electriciansuk, electricalupgradesuk\"},{\"title\":\"Lighting Installation\",\"desc\":\"Energy-efficient LED layouts, architectural lighting, and external setups.\",\"meta_title\":\"Lighting Installation UK | Indoor & Outdoor Lighting\",\"meta_description\":\"Professional lighting installation services providing energy-efficient indoor, outdoor and commercial lighting solutions across the UK.\",\"meta_keywords\":\"lightinginstallationuk, lightingservicesuk, ledlightinguk, commerciallightinguk, electricalservicesuk\"},{\"title\":\"Fire Alarm Installation\",\"desc\":\"Complying with BS 5839 fire detection requirements.\",\"meta_title\":\"Fire Alarm Installation UK | Fire Safety Systems\",\"meta_description\":\"Certified fire alarm installation services providing reliable fire detection and safety systems for residential and commercial properties.\",\"meta_keywords\":\"firealarminstallationuk, firesafetyuk, firealarmsystemsuk, buildingsafetyuk, electricalservicesuk\"},{\"title\":\"CCTV Installation\",\"desc\":\"Digital IP security cameras with remote access monitoring.\",\"meta_title\":\"CCTV Installation UK | Security Camera Systems\",\"meta_description\":\"Professional CCTV installation services delivering advanced surveillance and security solutions for homes, businesses and commercial premises.\",\"meta_keywords\":\"cctvinstallationuk, securitysystemsuk, cctvuk, commercialsecurityuk, homesecurityuk\"},{\"title\":\"Access Control\",\"desc\":\"Biometric scanners, keypads, and intercom door entry setups.\",\"meta_title\":\"Access Control Systems UK | Secure Entry Solutions\",\"meta_description\":\"Expert access control installation services providing secure entry systems for residential, commercial and industrial buildings across the UK.\",\"meta_keywords\":\"accesscontroluk, securityaccessuk, dooraccesssystemsuk, buildingsecurityuk, smartsecurityuk\"},{\"title\":\"Data Cabling\",\"desc\":\"Structured Cat6\\/Cat6a cabling runs and network setups.\",\"meta_title\":\"Data Cabling UK | Network Cabling Specialists\",\"meta_description\":\"Professional data cabling services delivering reliable structured cabling and network infrastructure for businesses and commercial buildings.\",\"meta_keywords\":\"datacablinguk, structuredcablinguk, networkcablinguk, itinfrastructureuk, commercialelectricaluk\"},{\"title\":\"EV Charger Installation\",\"desc\":\"Certified home and commercial electric vehicle chargers.\",\"meta_title\":\"EV Charger Installation UK | Home & Commercial EV Charging\",\"meta_description\":\"Certified EV charger installation services for homes, workplaces and commercial properties, supporting fast and efficient electric vehicle charging.\",\"meta_keywords\":\"evchargerinstallationuk, evcharginguk, electricvehiclecharginguk, homeevchargeruk, commercialevcharginguk\"},{\"title\":\"Solar Panel Installation\",\"desc\":\"Roof-mounted solar PV panels and battery storage.\",\"meta_title\":\"Solar Panel Installation UK | Renewable Energy Experts\",\"meta_description\":\"Professional solar panel installation services helping homes and businesses reduce energy costs with efficient renewable energy systems.\",\"meta_keywords\":\"solarpanelinstallationuk, solarenergyuk, renewableenergyuk, solarpoweruk, greensolutionsuk\"},{\"title\":\"Plumbing\",\"desc\":\"Water mains connections, piping layout runs, and drainage.\",\"meta_title\":\"Plumbing Services UK | Professional Plumbers\",\"meta_description\":\"Expert plumbing services for residential, commercial and industrial properties, delivering reliable installations, repairs and maintenance across the UK.\",\"meta_keywords\":\"plumbinguk, plumbingservicesuk, plumbersuk, commercialplumbinguk, buildingservicesuk\"},{\"title\":\"Heating Installation\",\"desc\":\"Boilers, underfloor heating, and radiator systems.\",\"meta_title\":\"Heating Installation UK | Energy-Efficient Heating Systems\",\"meta_description\":\"Professional heating installation services providing reliable, energy-efficient heating solutions for homes, businesses and commercial properties.\",\"meta_keywords\":\"heatinginstallationuk, heatingservicesuk, centralheatinguk, heatingengineersuk, buildingservicesuk\"},{\"title\":\"Gas Installation\",\"desc\":\"Gas Safe registered pipework, gas fires, and cookers.\",\"meta_title\":\"Gas Installation UK | Certified Gas Engineers\",\"meta_description\":\"Safe and compliant gas installation services delivered by qualified engineers for residential and commercial developments across the UK.\",\"meta_keywords\":\"gasinstallationuk, gasengineersuk, gasservicesuk, commercialgasuk, heatingservicesuk\"},{\"title\":\"Boiler Installation\",\"desc\":\"Combi, system, and heat-only boiler replacements.\",\"meta_title\":\"Boiler Installation UK | Expert Boiler Installers\",\"meta_description\":\"Professional boiler installation services supplying energy-efficient heating systems for homes, offices and commercial buildings throughout the UK.\",\"meta_keywords\":\"boilerinstallationuk, boilerservicesuk, gasboilersuk, heatingsystemsuk, boilerengineersuk\"},{\"title\":\"Bathroom Installation\",\"desc\":\"Sanitaryware connections, waste runs, and tiling.\",\"meta_title\":\"Bathroom Installation UK | Complete Bathroom Solutions\",\"meta_description\":\"Expert bathroom installation services delivering high-quality plumbing, fittings and modern bathroom renovations for homes and commercial properties.\",\"meta_keywords\":\"bathroominstallationuk, bathroomfittersuk, bathroomrenovationuk, plumbingservicesuk, homeimprovementuk\"},{\"title\":\"Drainage\",\"desc\":\"Internal soil stacks, waste pipes, and external gully traps.\",\"meta_title\":\"Drainage Services UK | Drainage Installation & Repairs\",\"meta_description\":\"Professional drainage services including installation, repairs and maintenance for residential, commercial and industrial construction projects.\",\"meta_keywords\":\"drainageuk, drainageservicesuk, drainageinstallationuk, drainagerepairsuk, groundworksuk\"},{\"title\":\"Water Supply Installation\",\"desc\":\"Boosted cold water systems and hot water cylinders.\",\"meta_title\":\"Water Supply Installation UK | Water Systems Experts\",\"meta_description\":\"Professional water supply installation services providing reliable pipework and water distribution systems for residential and commercial developments.\",\"meta_keywords\":\"watersupplyinstallationuk, waterservicesuk, waterpipeworkuk, plumbinginstallationuk, buildingservicesuk\"},{\"title\":\"HVAC Installation\",\"desc\":\"Comfort heating, ventilation, and air conditioning runs.\",\"meta_title\":\"HVAC Installation UK | Heating & Cooling Solutions\",\"meta_description\":\"Professional HVAC installation services delivering efficient heating, cooling and ventilation systems for residential, commercial and industrial buildings.\",\"meta_keywords\":\"hvacinstallationuk, hvacservicesuk, heatingandcoolinguk, buildingservicesuk, mechanicalservicesuk\"},{\"title\":\"Air Conditioning\",\"desc\":\"Split, multi-split, and VRF cooling system layouts.\",\"meta_title\":\"Air Conditioning Services UK | AC Installation Experts\",\"meta_description\":\"Expert air conditioning installation, maintenance and repair services providing energy-efficient climate control solutions across the UK.\",\"meta_keywords\":\"airconditioninguk, acinstallationuk, airconditioningservicesuk, coolingsystemsuk, hvacuk\"},{\"title\":\"Ventilation\",\"desc\":\"Extractor fans and Mechanical Ventilation Heat Recovery (MVHR) setups.\",\"meta_title\":\"Ventilation Services UK | Commercial & Residential Systems\",\"meta_description\":\"Professional ventilation services delivering fresh air, improved indoor air quality and compliant ventilation systems for all building types.\",\"meta_keywords\":\"ventilationuk, ventilationsystemsuk, indoorairqualityuk, buildingventilationuk, hvacservicesuk\"},{\"title\":\"Ductwork\",\"desc\":\"Metal and flexible ventilation duct runs for clean airflow.\",\"meta_title\":\"Ductwork Installation UK | Ventilation Duct Specialists\",\"meta_description\":\"Specialist ductwork installation services providing efficient air distribution systems for residential, commercial and industrial buildings.\",\"meta_keywords\":\"ductworkuk, ductworkinstallationuk, ventilationductworkuk, hvacductworkuk, mechanicalservicesuk\"}]', '[{\"q\":\"Do you issue building control certificates for electrical and gas works?\",\"a\":\"Yes. We issue NICEIC Electrical Installation Certificates and Gas Safe compliance notifications to verify all systems meet legal codes.\"},{\"q\":\"Why install an MVHR (Mechanical Ventilation Heat Recovery) system?\",\"a\":\"MVHR extracts warm damp air from kitchens\\/bathrooms, runs it through a heat exchanger to warm up incoming fresh outdoor air, improving air quality and cutting heating bills.\"},{\"q\":\"What is the benefit of underfloor heating (UFH)?\",\"a\":\"Wet UFH distributes heat evenly at a lower flow temperature, making it highly efficient when paired with modern boilers or heat pumps, while freeing up wall space.\"}]', 'images/services/mep.jpg', 'MEP Services UK | Mechanical, Electrical & Plumbing Experts', 'Comprehensive MEP services across the UK, including HVAC, air conditioning, ventilation and ductwork solutions for residential and commercial projects.', 'mepservicesuk, mechanicalelectricalplumbinguk, buildingservicesuk, constructionservicesuk, mepcontractorsuk', NULL);
INSERT INTO `services` (`id`, `title`, `description`, `icon`, `display_order`, `created_at`, `updated_at`, `about`, `why_choose_us`, `services_offered`, `faqs`, `image_url`, `meta_title`, `meta_description`, `meta_keywords`, `deliverables`) VALUES
(7, 'Interior Works', 'Bespoke drylining, partitions, plastering, custom joinery, flooring, suspended ceilings, and premium kitchen and bathroom fit-outs.', 'paint-brush', 7, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'Executing high-spec interior finishes requires meticulous attention to detail and coordinated trades. Our interior division delivers premium residential refurbishments and commercial fit-outs. We handle drylining, drywall partitioning, Level-5 plaster skimming, suspended ceilings, flooring, bespoke carpentry, and complete kitchen and bathroom installations.', '[{\"title\":\"Office & Retail Fit-Outs\",\"desc\":\"We create bespoke office, retail, and leisure spaces, managing partitions, lighting, and data layouts.\"},{\"title\":\"Impeccable Finishes\",\"desc\":\"Drylining, taping, jointing, and skimming executed to achieve smooth Level-5 finishes.\"},{\"title\":\"Master Carpentry\",\"desc\":\"Bespoke joinery, custom storage units, staircases, and premium door architraves.\"},{\"title\":\"Complete Kitchens\",\"desc\":\"Turnkey kitchen fit-outs including custom cabinetry, solid worktops, tiling, and appliances.\"}]', '[{\"title\":\"House Refurbishment\",\"desc\":\"Complete stripping, re-plastering, painting, and fitting.\",\"meta_title\":\"House Refurbishment UK | Home Renovation Specialists\",\"meta_description\":\"Professional house refurbishment services transforming homes with high-quality renovations, upgrades and modern interior improvements across the UK.\",\"meta_keywords\":\"houserefurbishmentuk, homerenovationuk, propertyrefurbishmentuk, homeimprovementuk, renovationservicesuk\"},{\"title\":\"Commercial Fit Out\",\"desc\":\"Turnkey layouts for commercial, retail, and leisure units.\",\"meta_title\":\"Commercial Fit Out UK | Business Interior Solutions\",\"meta_description\":\"Professional commercial fit out services creating functional, modern and tailored interiors for offices, retail spaces and commercial properties.\",\"meta_keywords\":\"commercialfitoutuk, commercialinteriorsuk, fitoutcontractorsuk, officefitoutuk, businessfitoutuk\"},{\"title\":\"Office Fit Out\",\"desc\":\"Modern workspaces, partitions, and technical floor power.\",\"meta_title\":\"Office Fit Out UK | Modern Workplace Solutions\",\"meta_description\":\"Expert office fit out services delivering productive, stylish and efficient workplace interiors tailored to your business needs.\",\"meta_keywords\":\"officefitoutuk, officeinteriorsuk, workplacedesignuk, officeconstructionuk, commercialfitoutuk\"},{\"title\":\"Shop Fit Out\",\"desc\":\"Retail display systems, counters, lighting, and signage.\",\"meta_title\":\"Shop Fit Out UK | Retail Interior Specialists\",\"meta_description\":\"Professional shop fit out services creating attractive, functional and customer-focused retail environments across the UK.\",\"meta_keywords\":\"shopfitoutuk, retailfitoutuk, shopinteriorsuk, retailconstructionuk, commercialinteriorsuk\"},{\"title\":\"Drylining\",\"desc\":\"Stud wall board framing, taping, and jointing.\",\"meta_title\":\"Drylining Services UK | Professional Drylining Contractors\",\"meta_description\":\"Expert drylining services delivering smooth wall systems, partitions and ceilings for residential and commercial construction projects.\",\"meta_keywords\":\"drylininguk, dryliningservicesuk, partitionsystemsuk, interiorconstructionuk, buildingservicesuk\"},{\"title\":\"Plastering\",\"desc\":\"Skimming, rendering, plaster boarding, and repairing cracks.\",\"meta_title\":\"Plastering Services UK | Professional Plasterers\",\"meta_description\":\"High-quality plastering services providing smooth, durable wall and ceiling finishes for homes, offices and commercial buildings.\",\"meta_keywords\":\"plasteringuk, plasterersuk, wallplasteringuk, ceilingplasteringuk, buildingfinishesuk\"},{\"title\":\"Suspended Ceilings\",\"desc\":\"Grid ceilings for offices and commercial applications.\",\"meta_title\":\"Suspended Ceilings UK | Ceiling Installation Experts\",\"meta_description\":\"Professional suspended ceiling installation services enhancing acoustics, lighting integration and interior aesthetics for commercial and residential spaces.\",\"meta_keywords\":\"suspendedceilingsuk, ceilinginstallationuk, commercialceilingsuk, interiorfitoutuk, ceilingsystemsuk\"},{\"title\":\"Partition Walls\",\"desc\":\"Metal stud and timber partition layouts for spatial separation.\",\"meta_title\":\"Partition Wall Installation UK | Interior Partition Systems\",\"meta_description\":\"Expert partition wall installation creating flexible, efficient and modern internal layouts for commercial and residential buildings.\",\"meta_keywords\":\"partitionwallsuk, partitioninstallationuk, officepartitionsuk, drylininguk, interiorworksuk\"},{\"title\":\"Painting & Decorating\",\"desc\":\"Airless spray painting, traditional brushwork, and wallpapers.\",\"meta_title\":\"Painting & Decorating UK | Professional Decorators\",\"meta_description\":\"Professional painting and decorating services delivering flawless interior and exterior finishes for homes, offices and commercial properties.\",\"meta_keywords\":\"paintinganddecoratinguk, decoratorsuk, paintingservicesuk, propertydecorationuk, interiorfinishesuk\"},{\"title\":\"Flooring\",\"desc\":\"Laying solid wood, engineered timber, LVT, and laminates.\",\"meta_title\":\"Flooring Services UK | Professional Floor Installation\",\"meta_description\":\"Comprehensive flooring services including hardwood, laminate, vinyl and commercial flooring installations across the UK.\",\"meta_keywords\":\"flooringuk, flooringservicesuk, floorinstallationuk, commercialflooringuk, residentialflooringuk\"},{\"title\":\"Floor Tiling\",\"desc\":\"Porcelain, ceramic, and natural stone floor tiling.\",\"meta_title\":\"Floor Tiling UK | Expert Tile Installation Services\",\"meta_description\":\"Professional floor tiling services providing durable and stylish tiled floors for kitchens, bathrooms and commercial properties.\",\"meta_keywords\":\"floortilinguk, tileinstallationuk, tilingservicesuk, floortilesuk, interiorflooringuk\"},{\"title\":\"Wall Tiling\",\"desc\":\"Kitchen splashbacks, bathrooms, and wet-room wall tiling.\",\"meta_title\":\"Wall Tiling UK | Professional Wall Tile Installers\",\"meta_description\":\"High-quality wall tiling services creating elegant and durable finishes for bathrooms, kitchens and commercial interiors.\",\"meta_keywords\":\"walltilinguk, walltilesuk, tilingservicesuk, bathroomtilinguk, kitchentilinguk\"},{\"title\":\"Joinery\",\"desc\":\"Bespoke storage units, wardrobes, and custom furniture.\",\"meta_title\":\"Joinery Services UK | Bespoke Woodwork Specialists\",\"meta_description\":\"Expert joinery services delivering bespoke doors, windows, cabinetry and custom woodwork for residential and commercial projects.\",\"meta_keywords\":\"joineryuk, joineryservicesuk, bespokejoineryuk, woodworkuk, customjoineryuk\"},{\"title\":\"Carpentry\",\"desc\":\"Hanging doors, architraves, skirting boards, and floor joists.\",\"meta_title\":\"Carpentry Services UK | Skilled Carpenters\",\"meta_description\":\"Professional carpentry services providing structural timber work, bespoke installations and interior wood finishing across the UK.\",\"meta_keywords\":\"carpentryuk, carpentersuk, woodworkinguk, timberconstructionuk, carpentryservicesuk\"},{\"title\":\"Kitchen Installation\",\"desc\":\"Fitting kitchen cabinets, worktops, sinks, and appliances.\",\"meta_title\":\"Kitchen Installation UK | Bespoke Kitchen Fitters\",\"meta_description\":\"Professional kitchen installation services delivering stylish, functional and high-quality fitted kitchens for homes and commercial spaces.\",\"meta_keywords\":\"kitcheninstallationuk, kitchenfittersuk, fittedkitchensuk, kitchenrenovationuk, homeimprovementuk\"},{\"title\":\"Bathroom Installation\",\"desc\":\"Fitting shower enclosures, baths, sinks, toilets, and tiling.\",\"meta_title\":\"Bathroom Installation UK | Expert Bathroom Fitters\",\"meta_description\":\"Complete bathroom installation services including plumbing, tiling and modern bathroom design for residential and commercial properties.\",\"meta_keywords\":\"bathroominstallationuk, bathroomfittersuk, bathroomrenovationuk, plumbingservicesuk, bathroomdesignuk\"},{\"title\":\"Staircase Installation\",\"desc\":\"Bespoke oak, timber, or metal staircase fabrication.\",\"meta_title\":\"Staircase Installation UK | Custom Staircase Solutions\",\"meta_description\":\"Professional staircase installation services creating durable, stylish and bespoke staircases for residential and commercial developments.\",\"meta_keywords\":\"staircaseinstallationuk, stairbuildersuk, bespokestaircasesuk, joineryuk, carpentryservicesuk\"}]', '[{\"q\":\"What is Level-5 plaster finish?\",\"a\":\"Level 5 is the premium standard of drywall finish. It includes a thin skim coat applied over the entire surface, eliminating any visible joint texture under light.\"},{\"q\":\"Do you manage office partitions and data cabling runs?\",\"a\":\"Yes. We install acoustic metal stud partitioning, glass walls, suspended ceilings, and coordinate structured data cables (Cat6) for office workspaces.\"},{\"q\":\"How long does a bathroom installation take?\",\"a\":\"An average high-spec bathroom fit-out takes 10 to 14 days, including stripping, plumbing adjustments, plastering, tanking, tiling, and fixture installs.\"}]', 'images/services/interior.jpg', 'Interior Works UK | Professional Fit Out & Finishing Services', 'Expert interior works across the UK, including refurbishment, fit outs, flooring, tiling, carpentry, decorating and bespoke interior finishing solutions.', 'interiorworksuk, interiorfitoutuk, buildinginteriorsuk, constructionservicesuk, refurbishmentuk', NULL),
(8, 'External Works', 'High-spec landscaping, garden designs, block paving, resin driveways, patios, tarmac surfacing, fencing, and decking for architectural properties.', 'sun', 8, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'The exterior layout of a property determines its curb appeal and complements its architectural design. Construction 360 Ltd delivers external works, including resin driveways, paved block layouts, natural stone patios, composite decking, boundaries, and full garden landscaping. We design and construct hard-wearing, permeable systems built to last.', '[{\"title\":\"Resin Bound Specialists\",\"desc\":\"We construct UV-stable, permeable resin-bound driveways that are SUDS compliant.\"},{\"title\":\"Sandstone & Porcelain Patios\",\"desc\":\"We lay natural stone and outdoor porcelain tiles over concrete bases for flat, secure patio layouts.\"},{\"title\":\"Soft & Hard Landscaping\",\"desc\":\"Laying premium turf, synthetic lawns, flower beds, and custom planting schemes.\"},{\"title\":\"Boundary Security\",\"desc\":\"Erecting high-spec timber paneling, composite fencing, automated gates, and brick walls.\"}]', '[{\"title\":\"Landscaping\",\"desc\":\"Soft and hard landscaping design and execution.\",\"meta_title\":\"Landscaping Services UK | Professional Landscape Contractors\",\"meta_description\":\"Expert landscaping services creating attractive, functional and sustainable outdoor spaces for residential, commercial and public developments.\",\"meta_keywords\":\"landscapinguk, landscapingservicesuk, landscapecontractorsuk, gardenlandscapinguk, outdoordesignuk\"},{\"title\":\"Garden Landscaping\",\"desc\":\"Creating lawns, flower beds, pathways, and water features.\",\"meta_title\":\"Garden Landscaping UK | Bespoke Garden Design\",\"meta_description\":\"Professional garden landscaping services transforming outdoor spaces with tailored planting, paving and garden design solutions across the UK.\",\"meta_keywords\":\"gardenlandscapinguk, gardendesignuk, landscapinguk, outdoorlivinguk, gardenconstructionuk\"},{\"title\":\"Block Paving\",\"desc\":\"Block paved driveways, pathways, and commercial parking areas.\",\"meta_title\":\"Block Paving UK | Driveways & Patio Specialists\",\"meta_description\":\"High-quality block paving services for driveways, patios and pathways, delivering durable and attractive outdoor surfaces throughout the UK.\",\"meta_keywords\":\"blockpavinguk, pavingcontractorsuk, drivewaypavinguk, patiopavinguk, landscapinguk\"},{\"title\":\"Driveways\",\"desc\":\"Excavation, base preparation, and surfacing for cars.\",\"meta_title\":\"Driveway Installation UK | Professional Driveway Contractors\",\"meta_description\":\"Expert driveway installation services providing block paving, resin, tarmac and bespoke driveway solutions for homes and businesses.\",\"meta_keywords\":\"drivewaysuk, drivewayinstallationuk, drivewaycontractorsuk, resindrivewaysuk, blockpavinguk\"},{\"title\":\"Patios\",\"desc\":\"Laying large format outdoor porcelain and sandstone slabs.\",\"meta_title\":\"Patio Installation UK | Garden Patio Specialists\",\"meta_description\":\"Professional patio installation services creating stylish and durable outdoor living spaces for residential and commercial properties.\",\"meta_keywords\":\"patiosuk, patioinstallationuk, gardenpatiosuk, outdoorlivinguk, landscapingservicesuk\"},{\"title\":\"Resin Driveways\",\"desc\":\"Permeable resin-bound aggregate driveway installations.\",\"meta_title\":\"Resin Driveways UK | Resin Bound Driveway Experts\",\"meta_description\":\"Premium resin driveway installation services delivering durable, low-maintenance and visually appealing surfaces across the UK.\",\"meta_keywords\":\"resindrivewaysuk, resinbounddrivewaysuk, drivewayinstallationuk, resinpavinguk, drivewaysuk\"},{\"title\":\"Tarmac Surfacing\",\"desc\":\"Hot rolled asphalt and tarmac for roads and driveways.\",\"meta_title\":\"Tarmac Surfacing UK | Tarmac Driveway Contractors\",\"meta_description\":\"Professional tarmac surfacing services for driveways, roads, car parks and commercial developments across the UK.\",\"meta_keywords\":\"tarmacsurfacinguk, tarmacdrivewaysuk, roadsurfacinguk, commercialsurfacinguk, drivewaycontractorsuk\"},{\"title\":\"Fencing\",\"desc\":\"Close board, panel, trellis, and security fencing.\",\"meta_title\":\"Fencing Services UK | Professional Fence Installation\",\"meta_description\":\"Reliable fencing installation services providing secure, durable and attractive boundary solutions for residential and commercial properties.\",\"meta_keywords\":\"fencinguk, fencingservicesuk, fenceinstallationuk, gardenfencinguk, propertyboundariesuk\"},{\"title\":\"Gates\",\"desc\":\"Wooden, metal, or automated security gate installations.\",\"meta_title\":\"Gate Installation UK | Residential & Commercial Gates\",\"meta_description\":\"Professional gate installation services offering secure and stylish entrance solutions for homes, businesses and industrial properties.\",\"meta_keywords\":\"gatesuk, gateinstallationuk, securitygatesuk, electricgatesuk, propertysecurityuk\"},{\"title\":\"Decking\",\"desc\":\"Composite, hardwood, and softwood timber decking.\",\"meta_title\":\"Decking Installation UK | Timber & Composite Decking\",\"meta_description\":\"Expert decking installation services creating beautiful outdoor living spaces with timber and composite decking solutions.\",\"meta_keywords\":\"deckinguk, deckinginstallationuk, compositedeckinguk, timberdeckinguk, gardenimprovementuk\"},{\"title\":\"Turfing\",\"desc\":\"Laying premium cultivated lawn turf over prepared topsoil.\",\"meta_title\":\"Turfing Services UK | Natural Lawn Installation\",\"meta_description\":\"Professional turfing services supplying and installing premium natural lawns for gardens, parks and commercial landscapes.\",\"meta_keywords\":\"turfinguk, lawninstallationuk, naturalturfuk, gardenservicesuk, landscapinguk\"},{\"title\":\"Artificial Grass\",\"desc\":\"Low-maintenance high-density synthetic grass installations.\",\"meta_title\":\"Artificial Grass Installation UK | Synthetic Turf Experts\",\"meta_description\":\"High-quality artificial grass installation services providing low-maintenance, realistic lawns for homes, schools and commercial spaces.\",\"meta_keywords\":\"artificialgrassuk, syntheticturfuk, artificialgrassinstallationuk, lowmaintenancegardensuk, landscapinguk\"}]', '[{\"q\":\"Is planning permission required for a new driveway?\",\"a\":\"You do not need planning permission if the driveway is permeable or if water drains to a border area. Non-permeable driveways over 5 sqm require permission.\"},{\"q\":\"What is the benefit of a resin-bound driveway?\",\"a\":\"It is highly permeable, which prevents standing water, resistant to weed growth, slip-resistant, and provides a smooth finish.\"},{\"q\":\"Does composite decking require maintenance?\",\"a\":\"No. Composite decking does not require sanding, staining, or sealing. It is rot-resistant and can be cleaned with simple soapy water.\"}]', 'images/services/external.jpg', 'External Works UK | Landscaping & Outdoor Construction', 'Professional external works services across the UK, including landscaping, paving, driveways, fencing, decking and outdoor construction for residential and commercial projects.', 'externalworksuk, landscapinguk, outdoorconstructionuk, propertyimprovementuk, constructionservicesuk', NULL),
(9, 'Civil Engineering', 'Highways construction, private car parks, drainage systems, utility connections, sewer installations, and bridge engineering.', 'globe-alt', 9, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'Infrastructure projects require deep excavation capabilities, structural validation, and highway authority coordination. Our civil engineering team executes road construction, car park surfacing, oil bypass interceptors, utility trenching, sewer main installations, and bridge structures. We coordinate Section 278 and Section 104 adoptions directly on your behalf.', '[{\"title\":\"Highway Approved\",\"desc\":\"NRSWA qualified operatives and supervisors licensed to execute works on public highways.\"},{\"title\":\"Deep Drainage Infrastructure\",\"desc\":\"Installing storm water retention tanks, concrete headwalls, and main sewer connections.\"},{\"title\":\"Heavy Car Parks\",\"desc\":\"Complete ground sub-base excavation, drainage, asphalt paving, and space markings.\"},{\"title\":\"Section Agreements\",\"desc\":\"We manage Section 278, Section 38, and Section 104 adoptions with councils and water boards.\"}]', '[{\"title\":\"Road Construction\",\"desc\":\"Excavating and laying sub-base, base, and hot tarmac for roads.\",\"meta_title\":\"Road Construction UK | Highway & Road Building Experts\",\"meta_description\":\"Expert road construction services delivering durable highways, access roads and infrastructure projects for residential, commercial and public developments across the UK.\",\"meta_keywords\":\"roadconstructionuk, highwayconstructionuk, roadbuildinguk, civilengineeringuk, infrastructureconstructionuk\"},{\"title\":\"Car Park Construction\",\"desc\":\"Full groundworks, paving, drainage, and layout markers.\",\"meta_title\":\"Car Park Construction UK | Commercial Parking Solutions\",\"meta_description\":\"Professional car park construction services including design, surfacing, drainage and line marking for commercial, residential and public sector developments.\",\"meta_keywords\":\"carparkconstructionuk, parkingconstructionuk, commercialconstructionuk, tarmacsurfacinguk, civilengineeringuk\"},{\"title\":\"Drainage Works\",\"desc\":\"Installing surface water retention systems and oil interceptors.\",\"meta_title\":\"Drainage Works UK | Professional Drainage Contractors\",\"meta_description\":\"Comprehensive drainage works including surface water, foul drainage and stormwater systems for residential, commercial and infrastructure projects.\",\"meta_keywords\":\"drainageworksuk, drainageservicesuk, stormwaterdrainageuk, civilengineeringuk, drainageinstallationuk\"},{\"title\":\"Utility Works\",\"desc\":\"Laying deep utility main ducts and connection junctions.\",\"meta_title\":\"Utility Works UK | Underground Utility Installation\",\"meta_description\":\"Professional utility works including water, gas, electricity and telecommunications infrastructure installation across the UK.\",\"meta_keywords\":\"utilityworksuk, utilityinstallationuk, undergroundutilitiesuk, infrastructureuk, civilengineeringuk\"},{\"title\":\"Bridge Construction\",\"desc\":\"Civil engineering concrete foundations and steel bridge spans.\",\"meta_title\":\"Bridge Construction UK | Structural Infrastructure Experts\",\"meta_description\":\"Expert bridge construction services delivering safe, durable and engineered bridge solutions for transport and infrastructure projects across the UK.\",\"meta_keywords\":\"bridgeconstructionuk, bridgeengineeringuk, civilengineeringuk, infrastructureprojectsuk, structuralengineeringuk\"},{\"title\":\"Sewer Installation\",\"desc\":\"Laying main trunk sewers and manhole installations.\",\"meta_title\":\"Sewer Installation UK | Sewer & Drainage Specialists\",\"meta_description\":\"Professional sewer installation services providing reliable foul water and drainage infrastructure for residential, commercial and industrial developments.\",\"meta_keywords\":\"sewerinstallationuk, sewerconstructionuk, drainageworksuk, utilityworksuk, civilengineeringuk\"}]', '[{\"q\":\"What is an S278 highway agreement?\",\"a\":\"A Section 278 agreement is a legal contract with the Highway Authority allowing developers to make permanent improvements to public roads.\"},{\"q\":\"What is an oil bypass interceptor?\",\"a\":\"It\'s a system installed in drainage networks for car parks and roads to filter and separate oil\\/fuel spills from stormwater before it enters rivers.\"},{\"q\":\"Are your engineers NRSWA qualified?\",\"a\":\"Yes. Our street works operatives and supervisors are fully certified under the New Roads and Street Works Act.\"}]', 'images/services/civil.jpg', 'Civil Engineering Services UK | Infrastructure & Groundworks Experts', 'Professional civil engineering services across the UK, delivering roads, drainage, utilities, bridges and infrastructure solutions for residential, commercial and public sector projects.', 'civilengineeringuk, infrastructureuk, constructionservicesuk, groundworksuk, civilcontractorsuk', NULL),
(10, 'Specialist Services', 'Specialized construction support including scaffolding, mobile crane hire, diamond drilling, concrete repairs, welding, and steel fabrication.', 'wrench', 10, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'High-spec builds often require specialized trade operations that demand certified tooling, rigger licensing, or advanced fabrication. Construction 360 Ltd provides scaffold assemblies, mobile crane lifts, core diamond drilling, concrete repairs, on-site structural welding, and custom metal fabrication.', '[{\"title\":\"Lifting Management\",\"desc\":\"We manage contract lift calculations, supplying cranes, qualified riggers, and lift plans.\"},{\"title\":\"Precision Drilling\",\"desc\":\"Vibration-free core diamond drilling and floor cutting through reinforced concrete walls.\"},{\"title\":\"Structural Welding\",\"desc\":\"Certified mobile welders for fabricating steel frame connections on site.\"},{\"title\":\"TG20 Scaffolding\",\"desc\":\"Erecting tube and fitting scaffolding under TG20 regulations with weekly safety sign-offs.\"}]', '[{\"title\":\"Scaffolding\",\"desc\":\"Erecting tube and fitting scaffolding, temporary roofs, and towers.\",\"meta_title\":\"Scaffolding Services UK | Safe Access Solutions\",\"meta_description\":\"Professional scaffolding services providing safe, reliable and fully compliant access systems for residential, commercial and industrial construction projects.\",\"meta_keywords\":\"scaffoldinguk, scaffoldingservicesuk, accesssolutionsuk, constructionscaffoldinguk, scaffoldingcontractorsuk\"},{\"title\":\"Crane Hire\",\"desc\":\"Coordinating crane hire and contract lifts with qualified riggers.\",\"meta_title\":\"Crane Hire UK | Lifting & Heavy Equipment Services\",\"meta_description\":\"Reliable crane hire services with certified operators for safe lifting, heavy construction and infrastructure projects throughout the UK.\",\"meta_keywords\":\"cranehireuk, liftingservicesuk, constructioncranesuk, heavyliftinguk, cranecontractorsuk\"},{\"title\":\"Waterproofing\",\"desc\":\"Structural concrete tanking and joint sealing.\",\"meta_title\":\"Waterproofing Services UK | Building Protection Experts\",\"meta_description\":\"Expert waterproofing solutions protecting basements, roofs, walls and structures from water ingress and moisture damage across the UK.\",\"meta_keywords\":\"waterproofinguk, buildingwaterproofinguk, basementwaterproofinguk, roofwaterproofinguk, constructionservicesuk\"},{\"title\":\"Concrete Repairs\",\"desc\":\"Remedying spalled concrete, rebar protection, and mortar repairs.\",\"meta_title\":\"Concrete Repairs UK | Structural Repair Specialists\",\"meta_description\":\"Professional concrete repair services restoring damaged concrete structures, improving durability and extending the lifespan of buildings and infrastructure.\",\"meta_keywords\":\"concreterepairsuk, structuralrepairsuk, concreterestorationuk, buildingrepairsuk, constructionmaintenanceuk\"},{\"title\":\"Concrete Cutting\",\"desc\":\"Precision floor sawing and wall cutting services.\",\"meta_title\":\"Concrete Cutting UK | Precision Concrete Cutting\",\"meta_description\":\"Specialist concrete cutting services using advanced equipment for accurate, safe and efficient cutting on construction and renovation projects.\",\"meta_keywords\":\"concretecuttinguk, diamondcuttinguk, constructioncuttinguk, structuralalterationsuk, buildingservicesuk\"},{\"title\":\"Diamond Drilling\",\"desc\":\"Precision core drilling through reinforced concrete walls.\",\"meta_title\":\"Diamond Drilling UK | Precision Core Drilling Experts\",\"meta_description\":\"Professional diamond drilling services providing precise openings for utilities, structural modifications and construction projects across the UK.\",\"meta_keywords\":\"diamonddrillinguk, coredrillinguk, constructiondrillinguk, concretecuttinguk, buildingservicesuk\"},{\"title\":\"Welding\",\"desc\":\"Structural steel MIG\\/TIG\\/ARC welding to code.\",\"meta_title\":\"Welding Services UK | Structural & Metal Welding Experts\",\"meta_description\":\"Expert welding services delivering high-quality structural, fabrication and repair solutions for residential, commercial and industrial projects.\",\"meta_keywords\":\"weldinguk, weldingservicesuk, structuralweldinguk, metalfabricationuk, construction\"},{\"title\":\"Metal Fabrication\",\"desc\":\"Custom brackets, balustrades, and structural steel connections.\",\"meta_title\":\"Metal Fabrication UK | Custom Metal Fabrication\",\"meta_description\":\"Professional metal fabrication services delivering custom steelwork, balustrades, brackets and structural metal connections across the UK.\",\"meta_keywords\":\"metalfabricationuk, steelworkuk, customfabricationuk, structuralmetaluk, weldinguk\"}]', '[{\"q\":\"What is a Contract Lift in crane operations?\",\"a\":\"A Contract Lift transfers the legal risk, planning, and lifting calculations to us. We provide the crane supervisor, operator, slinger, and full insurance.\"},{\"q\":\"Why use diamond drilling over normal drills?\",\"a\":\"It cuts cleanly through concrete and steel rebar with no percussion vibration, protecting the surrounding structure from fractures.\"},{\"q\":\"How do you check scaffold safety?\",\"a\":\"Scaffolds are inspected by competent, certified scaffold inspectors before first use, after any alterations or bad weather, and every 7 days.\"}]', 'images/services/specialist.jpg', 'Specialist Construction Services UK | Expert Building Solutions', 'Professional specialist construction services across the UK, including scaffolding, crane hire, waterproofing, concrete repairs, welding and metal fabrication.', 'specialistservicesuk, constructionservicesuk, specialistcontractorsuk, buildingservicesuk, constructionexpertsuk', NULL),
(11, 'Renovation & Property Improvements', 'Structural alterations, bespoke loft conversions, multi-storey house extensions, listed building restorations, and complete property renovations.', 'adjustments-horizontal', 11, '2026-07-03 10:29:46', '2026-08-19 07:58:23', 'Reconfiguring or extending existing buildings requires a developer capable of handling structural complexities. Our renovation and extensions division delivers premium home extensions, loft conversions, structural wall removals with steel insertions, garage conversions, and listed building restorations across Essex and London.', '[{\"title\":\"Structural steelwork\",\"desc\":\"We insert heavy steel columns and beams (RSJs) to safely remove internal load-bearing walls.\"},{\"title\":\"Loft Conversions\",\"desc\":\"Creating habitable bedrooms with Velux, Dormer, or Hip-to-Gable structural roof conversions.\"},{\"title\":\"Sensitive Heritage\",\"desc\":\"We restore listed and historical buildings using traditional materials like lime mortar.\"},{\"title\":\"Extensions Specialists\",\"desc\":\"Rear, side, and wrap-around extensions managed from structural foundation to completion.\"}]', '[{\"title\":\"Home Extensions\",\"desc\":\"Rear, side-return, and wrap-around multi-storey extensions.\",\"meta_title\":\"Home Extensions UK | House Extension Specialists\",\"meta_description\":\"Expert home extension services creating additional living space with bespoke designs and high-quality construction for properties across the UK.\",\"meta_keywords\":\"homeextensionsuk, houseextensionsuk, extensionbuildersuk, propertyextensionsuk, homeimprovementuk\"},{\"title\":\"Loft Conversions\",\"desc\":\"Dormer, hip-to-gable, L-shaped, and Velux loft conversions.\",\"meta_title\":\"Loft Conversions UK | Loft Conversion Experts\",\"meta_description\":\"Professional loft conversion services transforming unused attic space into stylish, functional rooms that add value to your property.\",\"meta_keywords\":\"loftconversionsuk, loftconversionuk, atticconversionuk, homeextensionsuk, propertyimprovementuk\"},{\"title\":\"Garage Conversions\",\"desc\":\"Converting garages into home offices, gyms, or annexes.\",\"meta_title\":\"Garage Conversions UK | Garage Conversion Specialists\",\"meta_description\":\"Transform your garage into a practical living space with expert garage conversion services for homes across the UK.\",\"meta_keywords\":\"garageconversionsuk, garageconversionuk, homeconversionuk, propertyrenovationuk, homeimprovementuk\"},{\"title\":\"House Renovation\",\"desc\":\"Modernizing layout plans, insulation, plumbing, and finishes.\",\"meta_title\":\"House Renovation UK | Complete Home Renovation Services\",\"meta_description\":\"Professional house renovation services delivering modern upgrades, structural improvements and bespoke interior transformations across the UK.\",\"meta_keywords\":\"houserenovationuk, homerenovationuk, propertyrenovationuk, buildingrenovationuk, homeimprovementuk\"},{\"title\":\"Property Refurbishment\",\"desc\":\"Updating structural components, services, and decorations.\",\"meta_title\":\"Property Refurbishment UK | Refurbishment Specialists\",\"meta_description\":\"Comprehensive property refurbishment services restoring and modernising residential and commercial properties throughout the UK.\",\"meta_keywords\":\"propertyrefurbishmentuk, buildingrefurbishmentuk, propertyrenovationuk, renovationservicesuk, constructionuk\"},{\"title\":\"Commercial Refurbishment\",\"desc\":\"Refurbishing commercial interiors, fronts, and building layout services.\",\"meta_title\":\"Commercial Refurbishment UK | Business Renovation Experts\",\"meta_description\":\"Professional commercial refurbishment services creating modern, functional and efficient business environments across the UK.\",\"meta_keywords\":\"commercialrefurbishmentuk, officerefurbishmentuk, commercialrenovationuk, fitoutuk, businessinteriorsuk\"},{\"title\":\"Structural Alterations\",\"desc\":\"Removing load bearing walls and inserting steel support beams.\",\"meta_title\":\"Structural Alterations UK | Building Modification Experts\",\"meta_description\":\"Expert structural alteration services including wall removals, reinforcements and layout modifications for residential and commercial properties.\",\"meta_keywords\":\"structuralalterationsuk, buildingalterationsuk, loadbearingwallremovaluk, structuralworksuk, constructionservicesuk\"},{\"title\":\"Listed Building Restoration\",\"desc\":\"Sensitive repairs using heritage-approved techniques and materials.\",\"meta_title\":\"Listed Building Restoration UK | Heritage Restoration Experts\",\"meta_description\":\"Specialist listed building restoration services preserving historic properties while meeting conservation standards and modern building requirements.\",\"meta_keywords\":\"listedbuildingrestorationuk, heritagerestorationuk, historicbuildingrepairsuk, conservationbuildinguk, listedpropertyrenovationuk\"}]', '[{\"q\":\"Can we build an extension under Permitted Development?\",\"a\":\"Yes. Single-storey rear extensions up to 3m (semi-detached) or 4m (detached) can often be built without planning, subject to height and material rules.\"},{\"q\":\"How do you support a floor when removing a load-bearing wall?\",\"a\":\"We install heavy-duty adjustable steel props (Acrows) and steel support needles (Strongboys) before removing the masonry and installing the new steel beam.\"},{\"q\":\"What is a Hip-to-Gable loft conversion?\",\"a\":\"It converts the sloping side roof (hip) into a vertical flat wall (gable), maximizing internal staircase access and head height.\"}]', 'images/services/renovation.jpg', 'Renovation & Property Improvements UK | Expert Building Solutions', 'Professional renovation and property improvement services across the UK, including extensions, conversions, refurbishments and structural alterations for homes and businesses.', 'renovationuk, propertyimprovementsuk, buildingrenovationuk, constructionservicesuk, propertyrefurbishmentuk', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('B5rkhy7YTagdAsr5oy0k7SnlHjtw6pj81OpmIB1E', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiU1gxUHRDT05Wa0Y1ZklQa0hkeGVwRUdhMWhCaHBiRVcxeDZvWGZzaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MS9zZXJ2aWNlcyI7czo1OiJyb3V0ZSI7czoxNDoic2VydmljZXMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1787136731),
('Ttht2nebQsQgJ1HyMUAV220jjObxKwzTJkRpjsMn', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkRVdGJwUnN2aktRN29kOUVqcVFYc29FQ0dwMHg1N2ZxQndjaHN4SCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODA4MSI7czo1OiJyb3V0ZSI7czo3OiJsYW5kaW5nIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1787146038);

-- --------------------------------------------------------

--
-- Table structure for table `site_contents`
--

CREATE TABLE `site_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_contents`
--

INSERT INTO `site_contents` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'seo_meta_title', 'Design-led construction for London', '2026-06-15 10:11:24', '2026-08-12 09:05:24'),
(2, 'seo_meta_description', 'Construction 360 Ltd delivers design, structural planning and premium builds as one accountable journey across London.', '2026-06-15 10:11:24', '2026-08-12 09:06:14'),
(3, 'seo_meta_keywords', 'construction, architectural builds, structural engineering, commercial fit-outs, extensions, renovations, glazing, Essex, London', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(4, 'hero_title', 'Design-led construction built with care Across the UK', '2026-06-15 10:11:24', '2026-08-13 04:33:21'),
(5, 'hero_subtitle', 'Construction 360 manages design, engineering and site delivery as one accountable journey — with transparent pricing, disciplined programmes, and finishes that stand up to inspection.', '2026-06-15 10:11:24', '2026-08-05 06:29:22'),
(6, 'about_text', 'Construction 360 Ltd (inspired by 360 Developments) is a leading construction specialist firm. We work alongside master architects, structural engineers, surveyors, and local building control officers to deliver premium quality builds across residential extensions, new home developments, and commercial fit-outs.', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(7, 'about_philosophy', 'Our operation is built on digital transparency, CSCS compliance, and zero telephone reliance. By routing all project briefs and engineering specifications electronically, we maintain a flawless audit trail, secure structural guarantees, and deliver project handovers that exceed architectural standards.', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(8, 'insurance_title', 'Comprehensive Insurance', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(9, 'insurance_text', 'Full peace of mind with £10,000,000 Employers Liability, £5,000,000 Public & Products Liability, and £500,000 Contract Works (Contractors All Risk) cover.', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(10, 'certificates_title', 'Building Control & Certificates', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(11, 'certificates_text', 'We issue all appropriate building control certificates on completion (including FENSA, plumbing, and electrical). All structural work is covered by our 10-year guarantee.', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(12, 'cscs_title', 'CSCS Compliance', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(13, 'cscs_text', 'All security surveyors, structural developers, and engineers have completed the Construction Skills Certification Scheme (CSCS) ensuring full safety compliance.', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(14, 'testimonial_1_quote', 'Reliable, careful and genuinely communicative. The finish exceeded what we expected for the programme we set.', '2026-06-15 10:11:24', '2026-08-05 05:36:15'),
(15, 'testimonial_1_author', 'Colin Ashworth', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(16, 'testimonial_1_role', 'Essex Homeowner', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(17, 'testimonial_2_quote', 'They took our commercial fit-out from drawing to opening day without drama — on time, within budget, and tightly controlled.', '2026-06-15 10:11:24', '2026-08-05 05:36:15'),
(18, 'testimonial_2_author', 'David Vance', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(19, 'testimonial_2_role', 'Director, Vanguard Retail Group', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(20, 'testimonial_3_quote', 'Our rear extension looks effortless now, but the structure and detailing behind it were handled with real expertise.', '2026-06-15 10:11:24', '2026-08-05 05:36:15'),
(21, 'testimonial_3_author', 'Eleanor Finch', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(22, 'testimonial_3_role', 'Residential Client, Chelmsford', '2026-06-15 10:11:24', '2026-06-15 10:11:24'),
(23, 'header_email', 'info@construction360.co', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(24, 'team_section_label', 'Leadership', '2026-06-16 10:42:20', '2026-08-05 05:36:15'),
(25, 'team_section_title', 'The people steering your build', '2026-06-16 10:42:20', '2026-08-05 05:36:15'),
(26, 'team_section_subtitle', 'Design partners, engineers and commercial leads working as one unit so decisions stay aligned from concept through construction.', '2026-06-16 10:42:20', '2026-08-05 05:36:15'),
(27, 'team_member_1_name', 'William Vance', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(28, 'team_member_1_role', 'Managing Director & Senior Coordinator', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(29, 'team_member_1_description', 'William oversees all site planning operations and client relationships, enforcing our paperless, digital-first correspondence log standards.', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(30, 'team_member_1_accreditations', 'CSCS Black Card, RICS Affiliate', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(31, 'team_member_2_name', 'Elena Rostova', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(32, 'team_member_2_role', 'Lead Structural Engineer', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(33, 'team_member_2_description', 'Elena leads all wind-load assessments, concrete framing calculations, and structural detailing to guarantee full building control approval.', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(34, 'team_member_2_accreditations', 'IStructE Member, MSc Civil Eng', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(35, 'team_member_3_name', 'Marcus Thorne', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(36, 'team_member_3_role', 'Project Estimator & Quantity Surveyor', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(37, 'team_member_3_description', 'Marcus compiles our Bill of Quantities (BoQ) surveys and coordinates logistics schedules to keep project execution within precise budget limits.', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(38, 'team_member_3_accreditations', 'RICS Certified, CSCS Card', '2026-06-16 10:42:20', '2026-06-16 10:42:20'),
(39, 'services_section_label', 'Engineering Capabilities', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(40, 'services_section_title', 'Technical Specialties & Solutions', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(41, 'services_section_subtitle', 'Our dynamic capabilities span full-spectrum general contracting and specialized structural analysis, tracked via absolute electronic coordination.', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(42, 'blog_section_label', 'Knowledge Base & Updates', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(43, 'blog_section_title', 'Latest from Construction 360', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(44, 'blog_section_subtitle', 'Explore insights, blueprints, design guidelines, and site developments from our structural and engineering experts.', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(45, 'contact_section_label', 'Tender Submission', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(46, 'contact_section_title', 'Submit Project Specifications', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(47, 'contact_section_subtitle', 'Ready to launch your project? Fill out the architectural brief below. Our structural coordinators compile specs and respond within 24 hours.', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(48, 'privacy_title', 'Privacy Policy & Correspondence Standards', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(49, 'privacy_notice', 'NOTICE: Construction 360 Ltd routes all customer correspondence through electronic mail logs to preserve exact structural requirements and specifications. We do not offer phone numbers or call centers. For direct email queries, reach us at <a href=\"mailto:info@construction360.co\" class=\"text-[#008080] hover:underline\">info@construction360.co</a>.', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(50, 'privacy_content', '1. Information We Collect\r\n\r\nWhen you submit a digital tender brief or contact us via our encrypted webforms, we collect your name, email address, project subject, and any blueprints or architectural specifications provided. This data is logged directly into our secure database to preserve structural requirements.\r\n\r\n2. Why We Restrict Voice Calls\r\n\r\nTo eliminate design discrepancies, wind-load calculation misunderstandings, and scheduling conflicts, Construction 360 Ltd has decommissioned all public telephone lines. Recording all client briefs in digital archives prevents verbal miscommunications and ensures building control documentation aligns perfectly with project instructions.\r\n\r\n3. Data Security & Encryption\r\n\r\nAll client specifications, blueprints, and personal details are encrypted in transit using Secure Sockets Layer (SSL) technology. Data is stored on secure servers with restricted access controls. We do not share your structural files or contact information with third-party marketers.\r\n\r\n4. Retention Policy\r\n\r\nBecause building control certificates (FENSA, gas safety, electrical) and structural works carry 10-year guarantees, we preserve correspondence logs and design calculations for a minimum of 10 years to protect contract warranties.\r\n\r\n5. Your Rights\r\n\r\nYou retain the right to request a copy of your archived project log, check the status of your query, or ask for the deletion of personal details once building control signs off and project warranties expire.', '2026-06-16 10:52:50', '2026-08-12 09:05:24'),
(51, 'terms_title', 'Terms & Conditions of Service', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(52, 'terms_notice', 'By filing a brief or engaging <strong>Construction 360 Ltd</strong>, clients agree that all communications, modifications, and instructions must be submitted electronically to <a href=\"mailto:info@construction360.co\" class=\"text-[#008080] hover:underline font-semibold font-sans\">info@construction360.co</a>. Verbal discussions, call requests, and telephone negotiations are explicitly excluded from the contract record.', '2026-06-16 10:52:50', '2026-06-16 12:29:40'),
(53, 'terms_content', '1. Scope & Tendering\r\n\r\nAll estimates, proposals, and project timelines are compiled based on the digital documents, CAD blueprints, and surveyor surveys submitted via our encrypted forms. Clients must ensure that all plans are correct, complete, and meet planning permission guidelines prior to submission.\r\n\r\n2. Milestone Inspections & Sign-offs\r\n\r\nWe work alongside local building control officers and structural engineers. At completion of each milestone stage (foundations, framing, structural glazing, mechanical fit-out, roofing), the client will receive digital progress summaries. Proceeding to the subsequent stage requires digital confirmation, preserving a transparent audit trail.\r\n\r\n3. Warranties & Guarantees\r\n\r\nAll structural works carry a 10-year guarantee against structural failure, provided no modifications have been made by non-CSCS contractors. FENSA glazing certifications, gas certificates, and electrical certifications are logged digitally and transferred on final handover.\r\n\r\n4. Liability & Assurances\r\n\r\nConstruction 360 Ltd maintains £10,000,000 Employers Liability, £5,000,000 Public Liability, and £500,000 Contractors All Risk coverage. Our liability for delay or design discrepancies is strictly limited to issues documented in the electronic audit logs.\r\n\r\n5. Exclusions & Legacy Channels\r\n\r\nWe enforce a strict paperless and telephone-free standard. Construction 360 Ltd is not liable for structural delays, plan deviations, or additional fees arising from instructions passed through unofficial legacy routes (such as voice calls, SMS, or verbal on-site instructions that were not logged via email).', '2026-06-16 10:52:50', '2026-08-12 09:05:24'),
(54, 'tendering_title', 'Official Tendering & Procurement Standards', '2026-06-16 10:52:50', '2026-06-16 10:52:50'),
(55, 'tendering_notice', '<strong>CRITICAL:</strong> Construction 360 Ltd enforces an <strong>electronic-only tendering standard</strong>. We have decommissioned all public telephone lines. All blueprints, specifications, and client inquiries must be submitted digitally via our encrypted forms or emailed to <a href=\"mailto:info@construction360.co\" class=\"text-teal-300 hover:underline font-bold font-sans\">info@construction360.co</a>.', '2026-06-16 10:52:50', '2026-06-16 12:29:40'),
(56, 'tendering_content', '1. Submission Formats\r\n\r\nTo facilitate rapid structural engineering assessments and quantity takeoff calculations, all project blueprints and schedules must be submitted in vector PDF format, dwg (AutoCAD), or rvt (Revit). Excel files or structured CSVs are required for complete Bill of Quantities (BoQ) uploads.\r\n\r\n2. Review SLA & Turnaround\r\n\r\nOnce a digital tender brief is logged via our system, a structural coordinator and site developer are assigned to review the specifications. Complete estimates, scheduling milestones, and preliminary structural feedback will be compiled and sent back to your corporate email within 24 business hours.\r\n\r\n3. Communication Auditing\r\n\r\nEvery modification, drawing correction, and schedule revision requested during the tendering phase must be logged electronically. This ensures that our onsite project managers, CSCS carpenters, bricklayers, and glazing engineers operate with the identical version-controlled spec sheet, eliminating costly re-works.\r\n\r\n4. Professional Ethics\r\n\r\nBy maintaining a paperless, digital tendering registry, we reduce project administration overheads by 15%, passing the savings directly back to our commercial and residential clients in competitive pricing schedules.', '2026-06-16 10:52:50', '2026-08-12 09:05:24'),
(57, 'social_facebook', 'https://www.facebook.com/people/Construction-360/61590797767639/', '2026-06-17 12:26:42', '2026-06-17 12:26:42'),
(58, 'social_instagram', 'https://www.instagram.com/Construction360.co', '2026-06-17 12:26:42', '2026-06-17 12:26:42'),
(59, 'social_linkedin', 'https://www.linkedin.com/company/construction-360', '2026-06-17 12:26:42', '2026-06-17 12:26:42'),
(60, 'site_logo', 'uploads/1781702803.png', '2026-06-17 12:26:42', '2026-06-17 12:26:43'),
(61, 'services_page_label', 'Services', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(62, 'services_page_title', 'Design to Deliver', '2026-07-03 10:29:23', '2026-08-19 08:25:21'),
(63, 'services_page_subtitle', 'We engage as early as possible in the lifecycle of a project to solve complex structural challenges, manage development risk, and exceed architectural standards.', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(64, 'service_about_label', 'ABOUT THE SERVICE', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(65, 'service_scopes_label', 'SCOPES & DELIVERABLES', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(66, 'service_scopes_title', 'Specialist Sub-Services', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(67, 'service_why_choose_us_label', 'CAPABILITIES', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(68, 'service_why_choose_us_title', 'Why Choose Us', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(69, 'service_faqs_label', 'COMMON INQUIRIES', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(70, 'service_faqs_title', 'Frequently Asked Questions', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(71, 'projects_page_label', 'PORTFOLIO', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(72, 'projects_page_title', 'Our Projects', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(73, 'projects_page_subtitle', 'A curated selection of our high-spec residential builds, commercial workspace designs, and structural renovations across London and Essex.', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(74, 'project_overview_title', 'Project Overview', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(75, 'project_scopes_title', 'Development Scopes', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(76, 'project_specifications_title', 'Project Specifications', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(77, 'project_related_label', 'PORTFOLIO', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(78, 'project_related_title', 'Related Projects', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(79, 'google_site_verification', 'RKr7Z5yGUbjxyvoUWYtvvx17blX28YkHUc2N-lDET68', '2026-07-03 10:29:23', '2026-07-03 10:29:23'),
(80, 'sectors_label', 'Where we work', '2026-07-03 10:29:46', '2026-08-05 05:36:15'),
(81, 'sectors_title', 'Build typologies we know deeply', '2026-07-03 10:29:46', '2026-08-05 05:36:15'),
(82, 'sectors_description', 'Whether you need a high-spec home extension, loft conversion, commercial fit-out or complex structural package, we bring the same exacting process to every sector we enter.', '2026-07-03 10:29:46', '2026-08-05 05:36:15'),
(83, 'sectors_list', '[{\"title\":\"New Builds\",\"icon\":\"home\",\"desc\":\"End-to-end design and construction of bespoke residential and commercial buildings.\"},{\"title\":\"House Extensions\",\"icon\":\"squares-plus\",\"desc\":\"Rear, side-return, and wrap-around multi-storey extensions.\"},{\"title\":\"Loft Conversions\",\"icon\":\"chevron-double-up\",\"desc\":\"Dormer, hip-to-gable, L-shaped, and Velux loft structural conversions.\"},{\"title\":\"Garage Conversions\",\"icon\":\"adjustments-horizontal\",\"desc\":\"Converting standard garages into premium insulated home offices or annexes.\"},{\"title\":\"Basement Conversions\",\"icon\":\"arrow-down-tray\",\"desc\":\"Sub-ground excavation, load calculations, and structural waterproofing.\"},{\"title\":\"Home Renovations\",\"icon\":\"sparkles\",\"desc\":\"Restoring and modernizing property layouts, services, and aesthetic finishes.\"},{\"title\":\"Property Refurbishments\",\"icon\":\"paint-brush\",\"desc\":\"Comprehensive updates to revitalize commercial and residential property spaces.\"},{\"title\":\"High-Rise Developments\",\"icon\":\"building-office\",\"desc\":\"Multi-storey concrete and steel framing solutions for urban developments.\"},{\"title\":\"Warehouses\",\"icon\":\"archive-box\",\"desc\":\"Bespoke steel-portal frame industrial buildings and storage facilities.\"},{\"title\":\"Mixed-Use Developments\",\"icon\":\"building-office-2\",\"desc\":\"Integrated developments combining commercial ground floors and upper residential units.\"},{\"title\":\"Modular Construction\",\"icon\":\"cube\",\"desc\":\"Modern methods of construction (MMC) utilizing precision off-site fabrication.\"}]', '2026-07-03 10:29:46', '2026-07-03 10:29:46'),
(84, 'about_heading', 'We create exceptional spaces designed to enhance the way people live, work and experience their surroundings', '2026-08-05 05:36:15', '2026-08-13 04:33:20'),
(85, 'about_vision', 'To set a clearer standard for design-led builds across London — where detail, honesty and long-term performance sit at the centre of every project.', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(86, 'about_mission', 'To guide clients from brief to completion with joined-up design, engineering and construction management that protects quality, budget and programme.', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(87, 'about_values', 'Integrity in every conversation, excellence in every trade, curiosity for better methods, and genuine partnership with the people we build for.', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(88, 'about_quote', 'Over a decade of disciplined delivery — premium finishes, transparent programmes, and accountable teams on every site.', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(89, 'services_label', 'What we do', '2026-08-05 05:36:15', '2026-08-05 07:34:29'),
(90, 'services_title', 'Principal contracting with a design-first mindset', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(91, 'projects_label', 'Real projects', '2026-08-05 05:36:15', '2026-08-05 07:24:37'),
(92, 'projects_title', 'Watch real projects come together', '2026-08-05 05:36:15', '2026-08-05 07:24:37'),
(93, 'assurances_label', 'Why clients stay', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(94, 'assurances_title', 'Standards you can verify, not just slogans', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(95, 'why_1_title', 'Disciplined delivery', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(96, 'why_1_text', 'Accredited processes and tightly managed programmes keep quality high and surprises rare from mobilisation to snag-free handover.', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(97, 'why_2_title', 'London & Essex focus', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(98, 'why_2_text', 'Local planning nuance, constrained sites and premium residential expectations are familiar territory — not a learning curve on your programme.', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(99, 'why_3_title', 'Finish obsession', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(100, 'why_3_text', 'We protect the detail that clients feel every day — junctions, levels, tolerances and trade coordination — because craftsmanship is the product.', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(101, 'why_4_title', 'Cost clarity', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(102, 'why_4_text', 'Transparent allowances, staged reporting and open conversations about scope keep you informed and in control of the investment.', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(103, 'testimonials_label', 'Client voices', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(104, 'testimonials_title', 'Trusted on the projects that matter', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(105, 'blog_label', 'Insights', '2026-08-05 05:36:15', '2026-08-05 05:36:15'),
(106, 'blog_title', 'Notes from the studio and site', '2026-08-05 05:36:16', '2026-08-05 05:36:16'),
(107, 'pre_footer_cta_title', 'Ready to build with clarity and craft?', '2026-08-05 05:36:16', '2026-08-05 05:36:16'),
(108, 'pre_footer_cta_subtitle', 'Tell us about your space, timeline, and ambitions. Our team will shape a clear pathway from first conversation to finished build.', '2026-08-05 05:36:16', '2026-08-05 05:36:16'),
(109, 'cta_get_free_quote_label', 'Book a consultation', '2026-08-05 05:36:16', '2026-08-05 05:36:16'),
(110, 'cta_submit_tender_label', 'Get Your Fixed-Price Quote', '2026-08-05 05:36:16', '2026-08-05 06:29:22'),
(111, 'cta_explore_services_label', 'Explore all services', '2026-08-05 05:36:16', '2026-08-05 07:34:29'),
(112, 'cta_ask_quote_label', 'Ask for a quote', '2026-08-05 05:36:16', '2026-08-05 05:36:16'),
(113, 'cta_explore_portfolio_label', 'View full portfolio', '2026-08-05 05:36:16', '2026-08-05 07:24:37'),
(114, 'cta_view_all_posts_label', 'View all insights', '2026-08-05 05:36:16', '2026-08-05 05:36:16'),
(115, 'footer_description', 'Construction 360 Ltd unites planning, design and site delivery into one accountable journey for homes and commercial spaces across London and Essex.', '2026-08-05 05:36:16', '2026-08-05 05:36:16'),
(116, 'hero_badge', 'London · Est. 2013 · Fixed prices', '2026-08-05 05:58:51', '2026-08-05 06:29:22'),
(117, 'hero_line_1', 'Design-led construction', '2026-08-05 05:58:51', '2026-08-05 06:29:22'),
(118, 'hero_line_2', 'built with care', '2026-08-05 05:58:51', '2026-08-05 06:29:22'),
(119, 'hero_line_3', 'Across the UK', '2026-08-05 05:58:51', '2026-08-13 04:33:20'),
(120, 'hero_line_4', NULL, '2026-08-05 05:58:51', '2026-08-13 04:33:20'),
(121, 'hero_float_badge', 'Free quote', '2026-08-05 05:58:51', '2026-08-05 05:58:51'),
(122, 'hero_float_badge_sub', '24h reply', '2026-08-05 05:58:51', '2026-08-05 05:58:51'),
(123, 'cta_book_consult_label', 'Book a Free Consultation', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(124, 'stat_1_value', '100+', '2026-08-05 06:29:22', '2026-08-13 04:33:20'),
(125, 'stat_1_label', 'Projects delivered', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(126, 'stat_2_value', '25+', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(127, 'stat_2_label', 'In-house specialists', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(128, 'stat_3_value', '12+', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(129, 'stat_3_label', 'Years of delivery', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(130, 'stat_4_value', '24h', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(131, 'stat_4_label', 'Quote response', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(132, 'hero_media_tag', 'Design & build — London & Essex', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(133, 'reviews_score_label', '4.9 from client reviews', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(134, 'reviews_link_label', 'Read all reviews', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(135, 'awards_label', 'Awards & recognition', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(136, 'awards_text', 'Accredited delivery partners recognised for quality craftsmanship, compliant programmes, and transparent client communication across London and Essex.', '2026-08-05 06:29:22', '2026-08-05 06:29:22'),
(137, 'projects_subtitle', 'See the work behind the finish — on-site progress, walkthroughs and delivery from start to handover.', '2026-08-05 07:24:37', '2026-08-05 07:24:37'),
(138, 'projects_reviews_badge', 'Trusted by homeowners across London & Essex', '2026-08-05 07:24:37', '2026-08-05 07:24:37'),
(139, 'client_stories_label', 'Client stories', '2026-08-05 07:24:37', '2026-08-05 07:24:37'),
(140, 'client_stories_title', 'Hear from our clients', '2026-08-05 07:24:37', '2026-08-05 07:24:37'),
(141, 'client_stories_link', 'View full case studies', '2026-08-05 07:24:37', '2026-08-05 07:24:37'),
(142, 'process_label', 'Our simple 6-step process', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(143, 'process_title', 'How your project works — start to finish', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(144, 'process_subtitle', 'Whether you need full design & build support or already have plans, we keep every stage clear and accountable.', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(145, 'process_caption_design', 'Full turnkey service — concept to completion', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(146, 'process_caption_build', 'You bring the plans — we deliver the build', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(147, 'process_cta', 'Start your project today', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(148, 'services_title_line1', 'One team.', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(149, 'services_title_line2', 'Every discipline.', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(150, 'services_subtitle', 'From pre-construction through structure, interiors and external works — one accountable team across every trade.', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(151, 'services_cta_prompt', 'Looking for something specific?', '2026-08-05 07:34:29', '2026-08-05 07:34:29'),
(152, 'partners_title', 'Our Trusted Partners', '2026-08-05 08:20:11', '2026-08-05 08:20:11'),
(153, 'partners_subtitle', 'Authorised suppliers', '2026-08-05 08:20:11', '2026-08-05 08:20:11'),
(154, 'about_page_title', NULL, '2026-08-11 07:10:36', '2026-08-13 04:33:21'),
(155, 'about_page_label', 'About Us', '2026-08-11 07:10:36', '2026-08-11 07:10:36'),
(156, 'header_phone', '+44 203 930 9629', '2026-08-11 08:26:47', '2026-08-11 08:26:47'),
(157, 'contact_address', '73 Thrale Road, London, England, SW16 1NU', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(158, 'contact_map_url', 'https://www.google.com/maps/search/?api=1&query=73+Thrale+Road,+London,+England,+SW16+1NU', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(159, 'social_whatsapp', 'https://wa.me/447500896792', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(160, 'about_vision_label', 'Our vision', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(161, 'about_mission_label', 'Our mission', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(162, 'about_values_label', 'Our values', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(163, 'marquee_text', 'Accreditations • Memberships • Incorporation 2013 • ISO 9001 Certified • ISO 14001 Certified • Fleet Operator Recognition Scheme • Federation of Master Builders • ConstructionLine Silver membership', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(164, 'filter_all_label', 'All Projects', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(165, 'filter_completed_label', 'Completed Projs.', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(166, 'filter_under_construction_label', 'Under Developm.', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(167, 'contact_page_title', 'Get in touch', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(168, 'contact_page_subtitle', 'Our global construction experts are here to help you in this ever-changing market.', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(169, 'contact_page_form_title', 'Leave a message', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(170, 'contact_support_email_label', 'Support email', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(171, 'contact_mobile_label', 'Mobile Number', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(172, 'contact_location_label', 'Location', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(173, 'about_page_subtitle', NULL, '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(174, 'about_label', 'Who we are', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(175, 'about_quote_author', NULL, '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(176, 'leadership_section_title', 'Our Leadership Team', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(177, 'digital_tenders_only_label', 'Digital Tenders Only', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(178, 'contact_map_embed_url', 'https://maps.google.com/maps?q=73%20Thrale%20Road,%20London,%20England,%20SW16%201NU&t=&z=15&ie=UTF8&iwloc=&output=embed', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(179, 'footer_company_registration', 'This Company is Registered in England and Wales. Company number 17277526', '2026-08-12 09:05:24', '2026-08-12 09:05:24'),
(180, 'hero_image', 'images/hero_construction.png', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(181, 'hero_video', 'con360.mp4', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(182, 'hero_watch_label', 'Watch Our Intro', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(183, 'hero_watch_sub', '60 sec overview', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(184, 'reviews_score', '4.9', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(185, 'reviews_score_sub', 'from client reviews', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(186, 'popular_paths_label', 'Start here', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(187, 'popular_paths_title', 'Popular project paths', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(188, 'popular_paths_link', 'All services →', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(189, 'about_learn_more_label', 'Learn more about us →', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(190, 'process_tab_design', 'Design & Build', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(191, 'process_tab_build', 'Build only', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(192, 'services_card_price_label', 'Enquire for pricing', '2026-08-12 09:38:25', '2026-08-12 09:38:25'),
(193, 'process_design_steps', '[{\"step\":\"01\",\"title\":\"Free consultation\",\"duration\":\"1 hour\",\"body\":\"We listen to your brief, budget and constraints, then outline the clearest path from idea to site.\",\"icon\":\"phone\"},{\"step\":\"02\",\"title\":\"Surveys & design\",\"duration\":\"2\\u20134 weeks\",\"body\":\"Measured surveys, design options and early engineering input so decisions are grounded and buildable.\",\"icon\":\"pencil\"},{\"step\":\"03\",\"title\":\"Planning & approvals\",\"duration\":\"4\\u201312 weeks\",\"body\":\"We manage planning, building control and partner submissions so permissions stay on the critical path.\",\"icon\":\"document\"},{\"step\":\"04\",\"title\":\"Costing & programme\",\"duration\":\"1\\u20132 weeks\",\"body\":\"Transparent budgets, procurement and a sequenced programme before any mobilisation begins.\",\"icon\":\"clipboard\"},{\"step\":\"05\",\"title\":\"Construction delivery\",\"duration\":\"Project based\",\"body\":\"Principal contracting with weekly reporting, quality checkpoints and accountable site leadership.\",\"icon\":\"building\"},{\"step\":\"06\",\"title\":\"Handover & aftercare\",\"duration\":\"Ongoing\",\"body\":\"Snag-free handover packs, warranties and a team that stays reachable after practical completion.\",\"icon\":\"check\"}]', '2026-08-12 09:40:44', '2026-08-12 09:40:44'),
(194, 'process_build_steps', '[{\"step\":\"01\",\"title\":\"Free consultation\",\"duration\":\"1 hour\",\"body\":\"Share your drawings and aspirations \\u2014 we confirm scope, risks and whether we are the right contractor.\",\"icon\":\"phone\"},{\"step\":\"02\",\"title\":\"Drawings & scope review\",\"duration\":\"3\\u20135 days\",\"body\":\"We stress-test your pack for buildability, packages and missing information before pricing.\",\"icon\":\"search\"},{\"step\":\"03\",\"title\":\"Fixed quotation\",\"duration\":\"1\\u20132 weeks\",\"body\":\"A clear tender with allowances, exclusions and a realistic programme you can take to decision.\",\"icon\":\"clipboard\"},{\"step\":\"04\",\"title\":\"Pre-start & mobilisation\",\"duration\":\"1\\u20132 weeks\",\"body\":\"Contracts, site logistics, temporary works and neighbour liaison so day one runs cleanly.\",\"icon\":\"document\"},{\"step\":\"05\",\"title\":\"Construction delivery\",\"duration\":\"Project based\",\"body\":\"Disciplined site delivery with scheduled updates, cost control and quality at every stage.\",\"icon\":\"building\"},{\"step\":\"06\",\"title\":\"Handover & aftercare\",\"duration\":\"Ongoing\",\"body\":\"Commissioning, certification and responsive aftercare when you need us after handover.\",\"icon\":\"check\"}]', '2026-08-12 09:40:44', '2026-08-12 09:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `accreditations` varchar(255) DEFAULT NULL,
  `display_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `role`, `description`, `image_url`, `accreditations`, `display_order`, `created_at`, `updated_at`) VALUES
(4, 'Jey Yogendra', 'Director', 'Jeyakanthan Yogendra is a highly experienced construction professional with more than 20 years of experience managing and delivering complex projects across the UK with a BSc (Hons) in Civil Engineering and a Postgraduate Diploma in Structural Engineering, he brings strong technical expertise and practical leadership to every project.\n\nHis experience covers a wide range of construction disciplines including reinforced concrete structures, post-tensioned slabs, groundworks, basements, top-down construction, bridges, tunnels, access shafts and landscaping.\n\nJeyakanthan is experienced in overseeing projects from initial tender and planning through to completion, with particular expertise in design coordination, programme management, cost control, health and safety, and quality assurance. His hands-on approach and focus on efficiency help ensure projects are delivered safely, on schedule, to a high standard and within budget.', 'images/team/jey-yogendra.png', NULL, 1, '2026-08-10 08:45:02', '2026-08-19 08:19:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Construction 360 Admin', 'admin@construction360.co', NULL, '$2y$12$KyYec1kCSWzSCojtts10K.zYrQZiDCPZEDUAccQ9m8BTQI8S3qT2e', 'TL8F2hp9e4HT9BhxehoS4MI0g1aVxcRVPhEU6ihucfIluCsdJUKpY0MxNapZ', '2026-06-15 10:11:24', '2026-07-03 10:29:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blogs_slug_unique` (`slug`);

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
-- Indexes for table `contact_queries`
--
ALTER TABLE `contact_queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_slug_unique` (`slug`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `site_contents`
--
ALTER TABLE `site_contents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_contents_key_unique` (`key`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_queries`
--
ALTER TABLE `contact_queries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `site_contents`
--
ALTER TABLE `site_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
