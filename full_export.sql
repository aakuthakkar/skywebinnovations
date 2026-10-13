SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';

-- Table: blog_posts
DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text,
  `content` text,
  `featured_image` varchar(255),
  `category` varchar(255),
  `tags` text,
  `is_published` varchar(255) NOT NULL,
  `published_at` varchar(255),
  `meta_title` varchar(255),
  `meta_description` text,
  `meta_keywords` text,
  `og_image` varchar(255),
  `author_id` int(11),
  `order` int(11) NOT NULL,
  `deleted_at` varchar(255),
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `category`, `tags`, `is_published`, `published_at`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `author_id`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES
('1', 'How to Choose the Right Technology Stack for Your Web Project', 'how-to-choose-right-technology-stack', 'Choosing the right technology stack is one of the most important decisions in web development. Here is a practical guide.', '<p>Choosing the right technology stack is one of the most important decisions you will make for your web project.</p>', NULL, 'Technology', '"[\"Web Development\",\"Technology\"]"', '1', '2026-10-04 08:14:30', 'How to Choose the Right Tech Stack', 'A practical guide to choosing the right technology stack for your web project.', NULL, NULL, NULL, '1', NULL, '2026-10-11 08:14:30', '2026-10-11 08:14:30'),
('2', 'Why Laravel Remains the Best PHP Framework in 2026', 'why-laravel-best-php-framework-2026', 'Laravel continues to dominate the PHP ecosystem. Here is why it remains the top choice.', '<p>Laravel has been the most popular PHP framework for several years running, and for good reason.</p>', NULL, 'Laravel', '"[\"Laravel\",\"PHP\"]"', '1', '2026-09-27 08:14:30', 'Why Laravel Remains the Best PHP Framework', 'Laravel continues to dominate the PHP ecosystem.', NULL, NULL, NULL, '2', NULL, '2026-10-11 08:14:30', '2026-10-11 08:14:30');

-- Table: cache
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `value` text NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: cache_locks
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: contact_inquiries
DROP TABLE IF EXISTS `contact_inquiries`;
CREATE TABLE `contact_inquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `project_type` varchar(255) NOT NULL,
  `message` text,
  `status` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255),
  `ip_address` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: engagement_models
DROP TABLE IF EXISTS `engagement_models`;
CREATE TABLE `engagement_models` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `best_for` text,
  `features` text,
  `link_text` varchar(255),
  `is_featured` varchar(255) NOT NULL,
  `is_published` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `engagement_models` (`id`, `order`, `slug`, `name`, `description`, `best_for`, `features`, `link_text`, `is_featured`, `is_published`, `created_at`, `updated_at`) VALUES
('1', '1', 'fixed', 'Fixed-price project', 'Best for websites and well-defined builds.', 'Best for websites and well-defined builds.', '["Agreed scope, timeline and quote","Milestone-based payments","Post-launch support included"]', 'Discuss this model', '0', '1', '2026-10-11 08:14:27', '2026-10-11 08:55:49'),
('2', '2', 'team', 'Dedicated team', 'Best for SaaS and long-term product development.', 'Best for SaaS and long-term product development.', '["Designers and engineers focused on your product","Two-week sprints with live demos","Scale the team up or down monthly"]', 'Discuss this model', '1', '1', '2026-10-11 08:14:27', '2026-10-11 08:55:50'),
('3', '3', 'retainer', 'Monthly retainer', 'Best for ongoing improvements and maintenance.', 'Best for ongoing improvements and maintenance.', '["Reserved hours every month","Priority fixes and updates","Performance and security monitoring"]', 'Discuss this model', '0', '1', '2026-10-11 08:14:27', '2026-10-11 08:55:50');

-- Table: failed_jobs
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` text NOT NULL,
  `exception` text NOT NULL,
  `failed_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: faq_items
DROP TABLE IF EXISTS `faq_items`;
CREATE TABLE `faq_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text,
  `is_published` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faq_items` (`id`, `order`, `question`, `answer`, `is_published`, `created_at`, `updated_at`) VALUES
('1', '1', 'Do you work with clients in the US, Canada, Australia and New Zealand?', 'Yes. Most of our clients are based in the United States, Canada, Australia, New Zealand and the UK. We work remotely with clear processes, written documentation and scheduled calls in your business hours.', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('2', '2', 'How do you handle time zone differences?', 'We agree on a daily overlap window at the start of the project, run sprint demos in your working hours, and share written progress updates so nothing waits on a meeting.', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('3', '3', 'Who owns the code and intellectual property?', 'You do. All source code, designs and assets are transferred to you, and we sign an NDA before any project details are shared.', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('4', '4', 'How much does a website or digital product cost?', 'It depends on scope. After a free discovery call we send a fixed quote in USD with a timeline and milestones, so you know the cost before work begins.', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('5', '5', 'Which technologies do you use?', 'Laravel, PHP, Node.js, React, Next.js, Vue.js, Flutter, WordPress and Shopify, deployed on AWS or your preferred cloud. We recommend the stack that fits your product and team.', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('6', '6', 'Do you provide support after launch?', 'Yes. Every project includes post-launch support, and many clients continue with a monthly retainer for maintenance, monitoring and new features.', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27');

-- Table: footer_links
DROP TABLE IF EXISTS `footer_links`;
CREATE TABLE `footer_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `column_name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  `is_active` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `footer_links` (`id`, `label`, `url`, `column_name`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
('1', 'About Us', '#founder', 'site', '1', '1', '2026-10-11 08:14:29', '2026-10-11 08:14:29'),
('2', 'Services', '#services', 'site', '2', '1', '2026-10-11 08:14:29', '2026-10-11 08:14:29'),
('3', 'Process', '#engage', 'site', '3', '1', '2026-10-11 08:14:29', '2026-10-11 08:14:29'),
('4', 'Work', '#work', 'site', '4', '1', '2026-10-11 08:14:29', '2026-10-11 08:14:29'),
('5', 'Blog', '/blog', 'site', '5', '1', '2026-10-11 08:14:29', '2026-10-11 08:14:29'),
('6', 'Privacy Policy', '/privacy-policy', 'legal', '1', '1', '2026-10-11 08:14:29', '2026-10-11 08:14:29'),
('7', 'Terms of Service', '/terms-of-service', 'legal', '2', '1', '2026-10-11 08:14:29', '2026-10-11 08:14:29');

-- Table: job_batches
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` text NOT NULL,
  `options` text,
  `cancelled_at` int(11),
  `created_at` int(11) NOT NULL,
  `finished_at` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: jobs
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `queue` varchar(255) NOT NULL,
  `payload` text NOT NULL,
  `attempts` int(11) NOT NULL,
  `reserved_at` int(11),
  `available_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: migrations
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
('1', '0001_01_01_000000_create_users_table', '1'),
('2', '0001_01_01_000001_create_cache_table', '1'),
('3', '0001_01_01_000002_create_jobs_table', '1'),
('4', '2026_10_07_000001_create_services_table', '1'),
('5', '2026_10_07_000002_create_projects_table', '1'),
('6', '2026_10_07_000003_create_why_us_items_table', '1'),
('7', '2026_10_07_000004_create_process_steps_table', '1'),
('8', '2026_10_07_000005_create_engagement_models_table', '1'),
('9', '2026_10_07_000006_create_faq_items_table', '1'),
('10', '2026_10_07_000007_create_tech_stack_items_table', '1'),
('11', '2026_10_07_000008_create_settings_table', '1'),
('12', '2026_10_07_000009_create_contact_inquiries_table', '1'),
('13', '2026_10_09_000001_update_contact_inquiries_table', '1'),
('14', '2026_10_11_000001_create_pages_table', '1'),
('15', '2026_10_11_000002_create_blog_posts_table', '1'),
('16', '2026_10_11_000003_create_navigation_items_table', '1'),
('17', '2026_10_11_000004_create_footer_links_table', '1');

-- Table: navigation_items
DROP TABLE IF EXISTS `navigation_items`;
CREATE TABLE `navigation_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `label` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `parent_id` int(11),
  `order` int(11) NOT NULL,
  `is_active` varchar(255) NOT NULL,
  `target_blank` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `navigation_items` (`id`, `label`, `url`, `location`, `parent_id`, `order`, `is_active`, `target_blank`, `created_at`, `updated_at`) VALUES
('1', 'About', '#founder', 'header', NULL, '1', '1', '0', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('2', 'Why Us', '#why', 'header', NULL, '2', '1', '0', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('3', 'Services', '#services', 'header', NULL, '3', '1', '0', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('4', 'Work', '#work', 'header', NULL, '4', '1', '0', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('5', 'Process', '#engage', 'header', NULL, '5', '1', '0', '2026-10-11 08:14:29', '2026-10-11 08:14:29');

-- Table: pages
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text,
  `excerpt` text,
  `page_template` varchar(255) NOT NULL,
  `is_published` varchar(255) NOT NULL,
  `meta_title` varchar(255),
  `meta_description` text,
  `meta_keywords` text,
  `og_image` varchar(255),
  `featured_image` varchar(255),
  `order` int(11) NOT NULL,
  `deleted_at` varchar(255),
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `excerpt`, `page_template`, `is_published`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `featured_image`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES
('1', 'About Us', 'about', '<p>Sky Web Innovations is a web development and digital product company helping businesses, startups, and agencies build reliable, scalable digital solutions.</p>', 'Learn about Sky Web Innovations — a web development and digital product company helping businesses build reliable, scalable digital solutions.', 'default', '1', 'About Sky Web Innovations | Web Development Company', 'Sky Web Innovations is a web development and digital product company helping businesses build reliable, scalable digital solutions.', NULL, NULL, NULL, '1', NULL, '2026-10-11 08:14:29', '2026-10-11 08:14:29'),
('2', 'Privacy Policy', 'privacy-policy', '<p>This Privacy Policy describes how Sky Web Innovations collects, uses, and protects your personal information.</p>', 'Our privacy policy outlines how we collect, use, and protect your personal information.', 'default', '1', 'Privacy Policy | Sky Web Innovations', 'Learn how Sky Web Innovations collects, uses, and protects your personal information.', NULL, NULL, NULL, '2', NULL, '2026-10-11 08:14:29', '2026-10-11 08:14:29'),
('3', 'Terms of Service', 'terms-of-service', '<p>By using the Sky Web Innovations website and services, you agree to the following terms and conditions.</p>', 'The terms and conditions for using Sky Web Innovations services.', 'default', '1', 'Terms of Service | Sky Web Innovations', 'Terms and conditions for using Sky Web Innovations services.', NULL, NULL, NULL, '3', NULL, '2026-10-11 08:14:29', '2026-10-11 08:14:29');

-- Table: password_reset_tokens
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `token` varchar(255) NOT NULL,
  `created_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: process_steps
DROP TABLE IF EXISTS `process_steps`;
CREATE TABLE `process_steps` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `process_steps` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES
('1', '1', '01', 'Discovery', 'We understand your business, goals, requirements, and challenges.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('2', '2', '02', 'Scope & Proposal', 'We define the project scope, deliverables, timeline, technology, and cost.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('3', '3', '03', 'Design & Development', 'We design and build the solution with regular communication and progress updates.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('4', '4', '04', 'Testing & Launch', 'We test everything, make final improvements, and prepare the project for launch.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('5', '5', '05', 'Ongoing Support', 'After launch, we remain available for maintenance, improvements, and future development.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');

-- Table: projects
DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `category` varchar(255) NOT NULL,
  `tags` text,
  `shot_label` varchar(255),
  `tint` varchar(255),
  `image` varchar(255),
  `is_published` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects` (`id`, `order`, `title`, `description`, `category`, `tags`, `shot_label`, `tint`, `image`, `is_published`, `created_at`, `updated_at`) VALUES
('1', '1', 'Fleet operations platform', 'Multi-tenant SaaS for logistics companies: live tracking, dispatch and automated invoicing.', 'SaaS', '["Laravel","Vue.js","AWS"]', 'Fleet operations platform', 'oklch(0.45 0.14 250 / 0.5)', NULL, '1', '2026-10-11 08:14:25', '2026-10-11 08:55:50'),
('2', '2', 'Manufacturing group website', 'Multilingual corporate website with product catalogue, dealer locator and CMS.', 'Website', '["Next.js","Headless CMS"]', 'Manufacturing group website', 'oklch(0.45 0.14 250 / 0.5)', NULL, '1', '2026-10-11 08:14:25', '2026-10-11 08:55:50'),
('3', '3', 'Clinic booking portal', 'Patient booking, doctor schedules and payments in one portal for a healthcare network.', 'Web App', '["React","Node.js","Stripe"]', 'Clinic booking portal', 'oklch(0.45 0.14 250 / 0.5)', NULL, '1', '2026-10-11 08:14:25', '2026-10-11 08:55:50'),
('4', '4', 'D2C commerce storefront', 'Custom Shopify storefront with subscriptions and a fast, conversion-focused checkout.', 'E-commerce', '["Shopify","Liquid"]', 'D2C commerce storefront', 'oklch(0.45 0.14 250 / 0.5)', NULL, '1', '2026-10-11 08:14:26', '2026-10-11 08:55:50');

-- Table: services
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `slug` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `services` (`id`, `order`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES
('1', '1', 'Web Development', 'Business websites, corporate websites, landing pages, and custom web experiences designed around your goals.', 'web-development', '2026-10-11 08:14:25', '2026-10-11 08:14:25'),
('2', '2', 'WordPress & WooCommerce', 'Custom WordPress websites, WooCommerce stores, redesigns, performance optimization, and ongoing maintenance.', 'wordpress-woocommerce', '2026-10-11 08:14:25', '2026-10-11 08:14:25'),
('3', '3', 'Web Applications', 'Custom web applications built around your business processes, users, and operational requirements.', 'web-applications', '2026-10-11 08:14:25', '2026-10-11 08:14:25'),
('4', '4', 'SaaS & MVP Development', 'From an initial idea to a working MVP, we help businesses and startups plan, build, and launch digital products.', 'saas-mvp-development', '2026-10-11 08:14:25', '2026-10-11 08:14:25'),
('5', '5', 'Laravel & Backend Development', 'Custom Laravel applications, backend systems, admin panels, databases, and business logic.', 'laravel-backend-development', '2026-10-11 08:14:25', '2026-10-11 08:14:25'),
('6', '6', 'API & Third-Party Integrations', 'Connect your website or application with APIs, payment gateways, CRMs, business tools, and other third-party platforms.', 'api-integrations', '2026-10-11 08:14:25', '2026-10-11 08:14:25'),
('7', '7', 'Maintenance & Technical Support', 'Ongoing website maintenance, performance improvements, security updates, technical SEO, troubleshooting, and feature enhancements.', 'maintenance-support', '2026-10-11 08:14:25', '2026-10-11 08:14:25');

-- Table: sessions
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_id` int(11),
  `ip_address` varchar(255),
  `user_agent` text,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Grqbhnn1Aq0njsBAoudp4g5gLlT0XR3UoTBeKUoj', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiR2tFVjFFMnZNc29WWkVscW9SZ1RXcVU3aUF3ZExiYWtqV0RYQ0V4eSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791706588'),
('G8G8ThgUimPQJFWdB10n4G33EQm90BMvhrAkKGnw', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNHdzdXJiUTlOZnBjMHB2bjd0bTVxU0pjaks4ZGFmRmlVOUU1R3JVcCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791706782'),
('DaWTGZv7ZGtD9Yn43iuuNAxzO74HcOjkxKy0khPp', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicEthRVR5WEYyQ0dEcmt0ckNpVzFSTTRiUHJsN0RSSmlEaU1NN3lXMyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791706949'),
('of072MUwmnbnpfo8S9KLK8bbbxYn0cDqvP9D72vN', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblEzYnNpTFBlR0hxdWZFMkU4SVRDajZBQzZUSmxObU5NREFXczIzSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791707033'),
('UfFEF2LfP0f3g7PkHBQznB6Xp7fzJGr0FiAa4fLZ', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZXRKdUl0aHhuYXBvNTlOdGhZZDl1TExXYjFwd3VVZFMxVERSTkNFaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791707293'),
('j9oiw1U1A7mW9MUCTZIjmb4lFBPFhQXiKK277kIW', NULL, '127.0.0.1', 'Symfony', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidEt3MGJwWWlNSWk5YUVjTTR6YUdHZ280cFBKYzBKSVNOd3hGM1htbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', '1791707313'),
('PlQ7iFftIZs3Qn3iraJA9jn3zGwS4zxtG7F8eX6u', NULL, '127.0.0.1', 'Symfony', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUFFSbHczbFpwb2FoOVF0ZE9PTEEwbFVnTkpHTUliQ29zY1JDUzNZdCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', '1791707344'),
('bv6Z2yrZxVHtPw5V19oFECeW9XusAUcnIo5cSHSh', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicWtJd1ExcXd5T3YzN21ocWVBcHB4YjhMQWpuVGx4UkhPSnFETHFmNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791707394'),
('YKxYfvCAsS4LXoYgY2d1gM9vZf3V1DFTrAe8VBhn', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMjc5RDZRSHI2Y3p2dUdsVHdWcmk5c29PamZqMjY5cmlQY0tSZXUzNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791707769'),
('fYKl8Rnqp1TV6wARtDcxX3gxvwojV8Pm1GbGyENC', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieXJyem9XdzhRaWw4Vmo3R0NOQmJHZnI0dUlFbW1ad0lKYlVWSm5lNSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791707829'),
('0jge3X2L6dNZnQJ6pf8S1BofrxG2vWqvLsBGyK5U', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY1pSUXhKbDJKUDRrMWFGNzlGMWJZbUtpRktwelJRS3JKTmlnd1ZISyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791708001'),
('X9xY3BFdTyNmB8Qu3pku4m6bfHoh4WsD63uib5tW', NULL, '127.0.0.1', 'Symfony', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNDA4RVNYSTYyWlpQSzJONm5DYmV1c01sek83MHd6c1QzNTdxUlhRNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY6Imh0dHA6Ly9sb2NhbGhvc3QiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', '1791708131'),
('3EITruwY81IIx7CKFdisJhEYz4nZrepwr0MJcYLK', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicFE5QWl4R0U2SE5UWU9KeDczd0J0ZEZLZ1IzdDVmaDFCc0piRUZXUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791708219'),
('n9t1CAeXv3yJPtvZWWV1c6F0M8lAfG0sLjWCZxy1', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiN1ZmeGZYV0VKcm8zSlYwTHFXNVdGdmFqSmNNWWNKOWxQWXJHbjlzTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791708392'),
('ECWF6RklfFSHFf3qEihb4hvrFkIOBglVYRq2PXHI', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiekFKWEJIV2lYTEswSG1TalVoRXJGd2dwUXZuQVRlMWQ2ZnVtTkRwZSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791708571'),
('nrWb7QSHVakiniB3xNx54OACIbYSJNS2WALQJ21q', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoia1ZIcnpBMWdSVWM4SXB6SmllaFNMQVMwSTFVQkxhWnNySklYZktlUCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791709004'),
('riNl7HU2Gll8RZb1GGj2x023C80llhyZ0yFKYolu', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVHUxWUpzSHNrdVdFTUdVWlM5d3hmOXRBTklhTzhJdm9URFlzTXlHcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791709024'),
('8acuLvFxgCPzOOs4UdKP8lmnxgEM85NzVwJn6ABf', NULL, '127.0.0.1', 'curl/8.19.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicks4eXA1ZjFTcnp5NTl4aVBycUl6YkthSzA5ZVExZTNxS1k4RjJjZyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', '1791710516');

-- Table: settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `key` varchar(255) NOT NULL,
  `value` text,
  `type` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
('20', 'site_name', 'Sky Web Innovations', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23'),
('21', 'site_tagline', 'Website & product engineering', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23'),
('22', 'meta_title', 'Sky Web Innovations | Website, SaaS & Custom Software Development Company', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23'),
('23', 'meta_description', 'Sky Web Innovations designs and builds websites, custom web applications and SaaS products for businesses in the US, Canada, Australia, New Zealand and the UK.', 'textarea', '2026-10-11 08:14:23', '2026-10-11 08:14:23'),
('24', 'meta_image', '/assets/og-image.jpg', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23'),
('25', 'contact_email', 'info@skywebinnovations.com', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23'),
('26', 'contact_phone', '+91 79909 03773', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23'),
('27', 'contact_phone_raw', '+917990903773', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('28', 'whatsapp_url', 'https://wa.me/917990903773', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('29', 'linkedin_url', 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('30', 'founder_name', 'Aakash Thakkar', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('31', 'founder_title', 'Founder & Technology Lead', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('32', 'founder_quote', '"Every project starts with a conversation about the business. Then we build the technology that serves it."', 'textarea', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('33', 'meta_keywords', 'web development, custom software, SaaS, Laravel, React, web applications, website design, digital products, web agency', 'textarea', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('34', 'meta_author', 'Aakash Thakkar', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('35', 'ga_measurement_id', '', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('36', 'google_site_verification', '', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('37', 'bing_site_verification', '', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24'),
('38', 'twitter_handle', '@skywebinnovations', 'text', '2026-10-11 08:14:25', '2026-10-11 08:14:25');

-- Table: tech_stack_items
DROP TABLE IF EXISTS `tech_stack_items`;
CREATE TABLE `tech_stack_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_published` varchar(255) NOT NULL,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES
('1', '1', 'Laravel', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('2', '2', 'PHP', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('3', '3', 'React', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('4', '4', 'Next.js', '1', '2026-10-11 08:14:27', '2026-10-11 08:14:27'),
('5', '5', 'Vue.js', '1', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('6', '6', 'Node.js', '1', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('7', '7', 'Flutter', '1', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('8', '8', 'WordPress', '1', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('9', '9', 'Shopify', '1', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('10', '10', 'MySQL', '1', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('11', '11', 'AWS', '1', '2026-10-11 08:14:28', '2026-10-11 08:14:28'),
('12', '12', 'Docker', '1', '2026-10-11 08:14:28', '2026-10-11 08:14:28');

-- Table: users
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` varchar(255),
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(255),
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: why_us_items
DROP TABLE IF EXISTS `why_us_items`;
CREATE TABLE `why_us_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `order` int(11) NOT NULL,
  `number` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `created_at` varchar(255),
  `updated_at` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `why_us_items` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES
('1', '1', '01', 'Business-First Approach', 'We start by understanding your business, goals, users, and challenges before deciding how to build the solution.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('2', '2', '02', 'Direct Communication', 'You communicate directly with the people working on your project, keeping decisions and communication simple.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('3', '3', '03', 'Clear Scope & Pricing', 'We define the project scope, deliverables, timeline, and pricing clearly before development begins.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('4', '4', '04', 'Right Technology', 'We choose technology based on your actual requirements, budget, performance needs, and future goals.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('5', '5', '05', 'Quality & Performance', 'We focus on clean development, performance, security, scalability, and maintainability.', '2026-10-11 08:14:26', '2026-10-11 08:14:26'),
('6', '6', '06', 'Long-Term Partnership', 'Our relationship does not end after launch. We continue supporting, maintaining, and improving your website or product.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');

ALTER TABLE `migrations` AUTO_INCREMENT = 18;
ALTER TABLE `settings` AUTO_INCREMENT = 39;
ALTER TABLE `services` AUTO_INCREMENT = 8;
ALTER TABLE `projects` AUTO_INCREMENT = 5;
ALTER TABLE `why_us_items` AUTO_INCREMENT = 7;
ALTER TABLE `process_steps` AUTO_INCREMENT = 6;
ALTER TABLE `engagement_models` AUTO_INCREMENT = 4;
ALTER TABLE `faq_items` AUTO_INCREMENT = 7;
ALTER TABLE `tech_stack_items` AUTO_INCREMENT = 13;
ALTER TABLE `navigation_items` AUTO_INCREMENT = 6;
ALTER TABLE `footer_links` AUTO_INCREMENT = 8;
ALTER TABLE `pages` AUTO_INCREMENT = 4;
ALTER TABLE `blog_posts` AUTO_INCREMENT = 3;

SET FOREIGN_KEY_CHECKS=1;

-- Export complete
