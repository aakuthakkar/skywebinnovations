-- Sky Web Innovations - Complete Database Export
-- Generated: 2026-10-12 12:14:54
-- Target: MySQL (skywotut_skyweb)

SET FOREIGN_KEY_CHECKS=0;

-- Table: blog_posts
CREATE TABLE IF NOT EXISTS `blog_posts` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` TEXT NOT NULL,
    `slug` TEXT NOT NULL,
    `excerpt` TEXT,
    `content` TEXT,
    `featured_image` TEXT,
    `category` TEXT,
    `tags` TEXT,
    `is_published` TEXT NOT NULL,
    `published_at` TIMESTAMP,
    `meta_title` TEXT,
    `meta_description` TEXT,
    `meta_keywords` TEXT,
    `og_image` TEXT,
    `author_id` INT,
    `order` INT NOT NULL DEFAULT '0',
    `deleted_at` TIMESTAMP,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    UNIQUE INDEX (`slug`),
    INDEX (`order`),
    INDEX (`category`),
    INDEX (`published_at`),
    INDEX (`slug`),
    INDEX (`is_published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `category`, `tags`, `is_published`, `published_at`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `author_id`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES (1, 'How to Choose the Right Technology Stack for Your Web Project', 'how-to-choose-right-technology-stack', 'Choosing the right technology stack is one of the most important decisions in web development. Here is a practical guide.', '<p>Choosing the right technology stack is one of the most important decisions you will make for your web project.</p>', NULL, 'Technology', '"[\"Web Development\",\"Technology\"]"', 1, '2026-10-04 08:14:30', 'How to Choose the Right Tech Stack', 'A practical guide to choosing the right technology stack for your web project.', NULL, NULL, NULL, 1, NULL, '2026-10-11 08:14:30', '2026-10-11 08:14:30');
INSERT INTO `blog_posts` (`id`, `title`, `slug`, `excerpt`, `content`, `featured_image`, `category`, `tags`, `is_published`, `published_at`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `author_id`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES (2, 'Why Laravel Remains the Best PHP Framework in 2026', 'why-laravel-best-php-framework-2026', 'Laravel continues to dominate the PHP ecosystem. Here is why it remains the top choice.', '<p>Laravel has been the most popular PHP framework for several years running, and for good reason.</p>', NULL, 'Laravel', '"[\"Laravel\",\"PHP\"]"', 1, '2026-09-27 08:14:30', 'Why Laravel Remains the Best PHP Framework', 'Laravel continues to dominate the PHP ecosystem.', NULL, NULL, NULL, 2, NULL, '2026-10-11 08:14:30', '2026-10-11 08:14:30');

-- Table: cache
CREATE TABLE IF NOT EXISTS `cache` (
    `key` TEXT NOT NULL,
    `value` TEXT NOT NULL,
    `expiration` INT NOT NULL,
    UNIQUE INDEX (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
    `key` TEXT NOT NULL,
    `owner` TEXT NOT NULL,
    `expiration` INT NOT NULL,
    UNIQUE INDEX (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: contact_inquiries
CREATE TABLE IF NOT EXISTS `contact_inquiries` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `project_type` TEXT NOT NULL,
    `message` TEXT,
    `status` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    `ip_address` TEXT,
    INDEX (`created_at`),
    INDEX (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: engagement_models
CREATE TABLE IF NOT EXISTS `engagement_models` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order` INT NOT NULL DEFAULT '0',
    `slug` TEXT NOT NULL,
    `name` TEXT NOT NULL,
    `description` TEXT,
    `best_for` TEXT,
    `features` TEXT,
    `link_text` TEXT,
    `is_featured` TEXT NOT NULL,
    `is_published` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `engagement_models` (`id`, `order`, `slug`, `name`, `description`, `best_for`, `features`, `link_text`, `is_featured`, `is_published`, `created_at`, `updated_at`) VALUES (1, 1, 'fixed', 'Fixed-price project', 'Best for websites and well-defined builds.', 'Best for websites and well-defined builds.', '["Agreed scope, timeline and quote","Milestone-based payments","Post-launch support included"]', 'Discuss this model', 0, 1, '2026-10-11 08:14:27', '2026-10-11 08:55:49');
INSERT INTO `engagement_models` (`id`, `order`, `slug`, `name`, `description`, `best_for`, `features`, `link_text`, `is_featured`, `is_published`, `created_at`, `updated_at`) VALUES (2, 2, 'team', 'Dedicated team', 'Best for SaaS and long-term product development.', 'Best for SaaS and long-term product development.', '["Designers and engineers focused on your product","Two-week sprints with live demos","Scale the team up or down monthly"]', 'Discuss this model', 1, 1, '2026-10-11 08:14:27', '2026-10-11 08:55:50');
INSERT INTO `engagement_models` (`id`, `order`, `slug`, `name`, `description`, `best_for`, `features`, `link_text`, `is_featured`, `is_published`, `created_at`, `updated_at`) VALUES (3, 3, 'retainer', 'Monthly retainer', 'Best for ongoing improvements and maintenance.', 'Best for ongoing improvements and maintenance.', '["Reserved hours every month","Priority fixes and updates","Performance and security monitoring"]', 'Discuss this model', 0, 1, '2026-10-11 08:14:27', '2026-10-11 08:55:50');

-- Table: failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `uuid` TEXT NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` TEXT NOT NULL,
    `exception` TEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL,
    UNIQUE INDEX (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: faq_items
CREATE TABLE IF NOT EXISTS `faq_items` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order` INT NOT NULL DEFAULT '0',
    `question` TEXT NOT NULL,
    `answer` TEXT,
    `is_published` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `faq_items` (`id`, `order`, `question`, `answer`, `is_published`, `created_at`, `updated_at`) VALUES (1, 1, 'Do you work with clients in the US, Canada, Australia and New Zealand?', 'Yes. Most of our clients are based in the United States, Canada, Australia, New Zealand and the UK. We work remotely with clear processes, written documentation and scheduled calls in your business hours.', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `faq_items` (`id`, `order`, `question`, `answer`, `is_published`, `created_at`, `updated_at`) VALUES (2, 2, 'How do you handle time zone differences?', 'We agree on a daily overlap window at the start of the project, run sprint demos in your working hours, and share written progress updates so nothing waits on a meeting.', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `faq_items` (`id`, `order`, `question`, `answer`, `is_published`, `created_at`, `updated_at`) VALUES (3, 3, 'Who owns the code and intellectual property?', 'You do. All source code, designs and assets are transferred to you, and we sign an NDA before any project details are shared.', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `faq_items` (`id`, `order`, `question`, `answer`, `is_published`, `created_at`, `updated_at`) VALUES (4, 4, 'How much does a website or digital product cost?', 'It depends on scope. After a free discovery call we send a fixed quote in USD with a timeline and milestones, so you know the cost before work begins.', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `faq_items` (`id`, `order`, `question`, `answer`, `is_published`, `created_at`, `updated_at`) VALUES (5, 5, 'Which technologies do you use?', 'Laravel, PHP, Node.js, React, Next.js, Vue.js, Flutter, WordPress and Shopify, deployed on AWS or your preferred cloud. We recommend the stack that fits your product and team.', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `faq_items` (`id`, `order`, `question`, `answer`, `is_published`, `created_at`, `updated_at`) VALUES (6, 6, 'Do you provide support after launch?', 'Yes. Every project includes post-launch support, and many clients continue with a monthly retainer for maintenance, monitoring and new features.', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');

-- Table: footer_links
CREATE TABLE IF NOT EXISTS `footer_links` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `label` TEXT NOT NULL,
    `url` TEXT NOT NULL,
    `column_name` TEXT NOT NULL,
    `order` INT NOT NULL DEFAULT '0',
    `is_active` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    INDEX (`is_active`),
    INDEX (`order`),
    INDEX (`column_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `footer_links` (`id`, `label`, `url`, `column_name`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (1, 'About Us', '#founder', 'site', 1, 1, '2026-10-11 08:14:29', '2026-10-11 08:14:29');
INSERT INTO `footer_links` (`id`, `label`, `url`, `column_name`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (2, 'Services', '#services', 'site', 2, 1, '2026-10-11 08:14:29', '2026-10-11 08:14:29');
INSERT INTO `footer_links` (`id`, `label`, `url`, `column_name`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (3, 'Process', '#engage', 'site', 3, 1, '2026-10-11 08:14:29', '2026-10-11 08:14:29');
INSERT INTO `footer_links` (`id`, `label`, `url`, `column_name`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (4, 'Work', '#work', 'site', 4, 1, '2026-10-11 08:14:29', '2026-10-11 08:14:29');
INSERT INTO `footer_links` (`id`, `label`, `url`, `column_name`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (5, 'Blog', '/blog', 'site', 5, 1, '2026-10-11 08:14:29', '2026-10-11 08:14:29');
INSERT INTO `footer_links` (`id`, `label`, `url`, `column_name`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (6, 'Privacy Policy', '/privacy-policy', 'legal', 1, 1, '2026-10-11 08:14:29', '2026-10-11 08:14:29');
INSERT INTO `footer_links` (`id`, `label`, `url`, `column_name`, `order`, `is_active`, `created_at`, `updated_at`) VALUES (7, 'Terms of Service', '/terms-of-service', 'legal', 2, 1, '2026-10-11 08:14:29', '2026-10-11 08:14:29');

-- Table: job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
    `id` TEXT NOT NULL,
    `name` TEXT NOT NULL,
    `total_jobs` INT NOT NULL,
    `pending_jobs` INT NOT NULL,
    `failed_jobs` INT NOT NULL,
    `failed_job_ids` TEXT NOT NULL,
    `options` TEXT,
    `cancelled_at` INT,
    `created_at` INT NOT NULL,
    `finished_at` INT,
    UNIQUE INDEX (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: jobs
CREATE TABLE IF NOT EXISTS `jobs` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `queue` TEXT NOT NULL,
    `payload` TEXT NOT NULL,
    `attempts` INT NOT NULL,
    `reserved_at` INT,
    `available_at` INT NOT NULL,
    `created_at` INT NOT NULL,
    INDEX (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: navigation_items
CREATE TABLE IF NOT EXISTS `navigation_items` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `label` TEXT NOT NULL,
    `url` TEXT NOT NULL,
    `location` TEXT NOT NULL,
    `parent_id` INT,
    `order` INT NOT NULL DEFAULT '0',
    `is_active` TEXT NOT NULL,
    `target_blank` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    INDEX (`is_active`),
    INDEX (`order`),
    INDEX (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `navigation_items` (`id`, `label`, `url`, `location`, `parent_id`, `order`, `is_active`, `target_blank`, `created_at`, `updated_at`) VALUES (1, 'About', '#founder', 'header', NULL, 1, 1, 0, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `navigation_items` (`id`, `label`, `url`, `location`, `parent_id`, `order`, `is_active`, `target_blank`, `created_at`, `updated_at`) VALUES (2, 'Why Us', '#why', 'header', NULL, 2, 1, 0, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `navigation_items` (`id`, `label`, `url`, `location`, `parent_id`, `order`, `is_active`, `target_blank`, `created_at`, `updated_at`) VALUES (3, 'Services', '#services', 'header', NULL, 3, 1, 0, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `navigation_items` (`id`, `label`, `url`, `location`, `parent_id`, `order`, `is_active`, `target_blank`, `created_at`, `updated_at`) VALUES (4, 'Work', '#work', 'header', NULL, 4, 1, 0, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `navigation_items` (`id`, `label`, `url`, `location`, `parent_id`, `order`, `is_active`, `target_blank`, `created_at`, `updated_at`) VALUES (5, 'Process', '#engage', 'header', NULL, 5, 1, 0, '2026-10-11 08:14:29', '2026-10-11 08:14:29');

-- Table: pages
CREATE TABLE IF NOT EXISTS `pages` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `title` TEXT NOT NULL,
    `slug` TEXT NOT NULL,
    `content` TEXT,
    `excerpt` TEXT,
    `page_template` TEXT NOT NULL,
    `is_published` TEXT NOT NULL,
    `meta_title` TEXT,
    `meta_description` TEXT,
    `meta_keywords` TEXT,
    `og_image` TEXT,
    `featured_image` TEXT,
    `order` INT NOT NULL DEFAULT '0',
    `deleted_at` TIMESTAMP,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    UNIQUE INDEX (`slug`),
    INDEX (`order`),
    INDEX (`slug`),
    INDEX (`is_published`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `excerpt`, `page_template`, `is_published`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `featured_image`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES (1, 'About Us', 'about', '<p>Sky Web Innovations is a web development and digital product company helping businesses, startups, and agencies build reliable, scalable digital solutions.</p>', 'Learn about Sky Web Innovations — a web development and digital product company helping businesses build reliable, scalable digital solutions.', 'default', 1, 'About Sky Web Innovations | Web Development Company', 'Sky Web Innovations is a web development and digital product company helping businesses build reliable, scalable digital solutions.', NULL, NULL, NULL, 1, NULL, '2026-10-11 08:14:29', '2026-10-11 08:14:29');
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `excerpt`, `page_template`, `is_published`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `featured_image`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES (2, 'Privacy Policy', 'privacy-policy', '<p>This Privacy Policy describes how Sky Web Innovations collects, uses, and protects your personal information.</p>', 'Our privacy policy outlines how we collect, use, and protect your personal information.', 'default', 1, 'Privacy Policy | Sky Web Innovations', 'Learn how Sky Web Innovations collects, uses, and protects your personal information.', NULL, NULL, NULL, 2, NULL, '2026-10-11 08:14:29', '2026-10-11 08:14:29');
INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `excerpt`, `page_template`, `is_published`, `meta_title`, `meta_description`, `meta_keywords`, `og_image`, `featured_image`, `order`, `deleted_at`, `created_at`, `updated_at`) VALUES (3, 'Terms of Service', 'terms-of-service', '<p>By using the Sky Web Innovations website and services, you agree to the following terms and conditions.</p>', 'The terms and conditions for using Sky Web Innovations services.', 'default', 1, 'Terms of Service | Sky Web Innovations', 'Terms and conditions for using Sky Web Innovations services.', NULL, NULL, NULL, 3, NULL, '2026-10-11 08:14:29', '2026-10-11 08:14:29');

-- Table: password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
    `email` TEXT NOT NULL,
    `token` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    UNIQUE INDEX (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: process_steps
CREATE TABLE IF NOT EXISTS `process_steps` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order` INT NOT NULL DEFAULT '0',
    `number` TEXT NOT NULL,
    `title` TEXT NOT NULL,
    `description` TEXT,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `process_steps` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (1, 1, 1, 'Discovery', 'We understand your business, goals, requirements, and challenges.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `process_steps` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (2, 2, 2, 'Scope & Proposal', 'We define the project scope, deliverables, timeline, technology, and cost.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `process_steps` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (3, 3, 3, 'Design & Development', 'We design and build the solution with regular communication and progress updates.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `process_steps` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (4, 4, 4, 'Testing & Launch', 'We test everything, make final improvements, and prepare the project for launch.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `process_steps` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (5, 5, 5, 'Ongoing Support', 'After launch, we remain available for maintenance, improvements, and future development.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');

-- Table: projects
CREATE TABLE IF NOT EXISTS `projects` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order` INT NOT NULL DEFAULT '0',
    `title` TEXT NOT NULL,
    `description` TEXT,
    `category` TEXT NOT NULL,
    `tags` TEXT,
    `shot_label` TEXT,
    `tint` TEXT,
    `image` TEXT,
    `is_published` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `projects` (`id`, `order`, `title`, `description`, `category`, `tags`, `shot_label`, `tint`, `image`, `is_published`, `created_at`, `updated_at`) VALUES (1, 1, 'Fleet operations platform', 'Multi-tenant SaaS for logistics companies: live tracking, dispatch and automated invoicing.', 'SaaS', '["Laravel","Vue.js","AWS"]', 'Fleet operations platform', 'oklch(0.45 0.14 250 / 0.5)', NULL, 1, '2026-10-11 08:14:25', '2026-10-11 08:55:50');
INSERT INTO `projects` (`id`, `order`, `title`, `description`, `category`, `tags`, `shot_label`, `tint`, `image`, `is_published`, `created_at`, `updated_at`) VALUES (2, 2, 'Manufacturing group website', 'Multilingual corporate website with product catalogue, dealer locator and CMS.', 'Website', '["Next.js","Headless CMS"]', 'Manufacturing group website', 'oklch(0.45 0.14 250 / 0.5)', NULL, 1, '2026-10-11 08:14:25', '2026-10-11 08:55:50');
INSERT INTO `projects` (`id`, `order`, `title`, `description`, `category`, `tags`, `shot_label`, `tint`, `image`, `is_published`, `created_at`, `updated_at`) VALUES (3, 3, 'Clinic booking portal', 'Patient booking, doctor schedules and payments in one portal for a healthcare network.', 'Web App', '["React","Node.js","Stripe"]', 'Clinic booking portal', 'oklch(0.45 0.14 250 / 0.5)', NULL, 1, '2026-10-11 08:14:25', '2026-10-11 08:55:50');
INSERT INTO `projects` (`id`, `order`, `title`, `description`, `category`, `tags`, `shot_label`, `tint`, `image`, `is_published`, `created_at`, `updated_at`) VALUES (4, 4, 'D2C commerce storefront', 'Custom Shopify storefront with subscriptions and a fast, conversion-focused checkout.', 'E-commerce', '["Shopify","Liquid"]', 'D2C commerce storefront', 'oklch(0.45 0.14 250 / 0.5)', NULL, 1, '2026-10-11 08:14:26', '2026-10-11 08:55:50');

-- Table: seo_audits
CREATE TABLE IF NOT EXISTS `seo_audits` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `description` TEXT,
    `status` TEXT NOT NULL,
    `score` INT,
    `results` TEXT,
    `issues` TEXT,
    `summary` TEXT,
    `started_at` TIMESTAMP,
    `completed_at` TIMESTAMP,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    INDEX (`completed_at`),
    INDEX (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: seo_backlinks
CREATE TABLE IF NOT EXISTS `seo_backlinks` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `source_url` TEXT NOT NULL,
    `source_domain` TEXT NOT NULL,
    `target_url` TEXT NOT NULL,
    `anchor_text` TEXT,
    `link_type` TEXT NOT NULL,
    `domain_authority` INT,
    `page_authority` INT,
    `first_seen_at` DATE NOT NULL,
    `last_seen_at` DATE NOT NULL,
    `lost_at` DATE,
    `notes` TEXT,
    `is_active` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    INDEX (`is_active`),
    INDEX (`target_url`),
    INDEX (`source_domain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: seo_keyword_rankings
CREATE TABLE IF NOT EXISTS `seo_keyword_rankings` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `seo_keyword_id` INT NOT NULL,
    `position` INT,
    `search_engine` TEXT NOT NULL,
    `url` TEXT,
    `search_volume_snapshot` INT,
    `checked_at` DATE NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    INDEX (`seo_keyword_id`, `checked_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: seo_keywords
CREATE TABLE IF NOT EXISTS `seo_keywords` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `keyword` TEXT NOT NULL,
    `target_url` TEXT,
    `search_intent` TEXT NOT NULL,
    `search_volume` INT,
    `difficulty` INT,
    `cpc` TEXT,
    `current_position` INT,
    `target_position` INT,
    `previous_position` INT,
    `first_tracked_at` DATE,
    `last_checked_at` DATE,
    `tracking_frequency` TEXT NOT NULL,
    `notes` TEXT,
    `is_active` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    INDEX (`last_checked_at`),
    INDEX (`is_active`),
    INDEX (`keyword`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: seo_redirects
CREATE TABLE IF NOT EXISTS `seo_redirects` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `source_path` TEXT NOT NULL,
    `target_path` TEXT NOT NULL,
    `type` TEXT NOT NULL,
    `source_host` TEXT,
    `notes` TEXT,
    `is_active` TEXT NOT NULL,
    `hit_count` INT NOT NULL DEFAULT '0',
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    INDEX (`is_active`),
    UNIQUE INDEX (`source_path`, `source_host`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: services
CREATE TABLE IF NOT EXISTS `services` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order` INT NOT NULL DEFAULT '0',
    `name` TEXT NOT NULL,
    `description` TEXT,
    `slug` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    UNIQUE INDEX (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `services` (`id`, `order`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES (1, 1, 'Web Development', 'Business websites, corporate websites, landing pages, and custom web experiences designed around your goals.', 'web-development', '2026-10-11 08:14:25', '2026-10-11 08:14:25');
INSERT INTO `services` (`id`, `order`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES (2, 2, 'WordPress & WooCommerce', 'Custom WordPress websites, WooCommerce stores, redesigns, performance optimization, and ongoing maintenance.', 'wordpress-woocommerce', '2026-10-11 08:14:25', '2026-10-11 08:14:25');
INSERT INTO `services` (`id`, `order`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES (3, 3, 'Web Applications', 'Custom web applications built around your business processes, users, and operational requirements.', 'web-applications', '2026-10-11 08:14:25', '2026-10-11 08:14:25');
INSERT INTO `services` (`id`, `order`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES (4, 4, 'SaaS & MVP Development', 'From an initial idea to a working MVP, we help businesses and startups plan, build, and launch digital products.', 'saas-mvp-development', '2026-10-11 08:14:25', '2026-10-11 08:14:25');
INSERT INTO `services` (`id`, `order`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES (5, 5, 'Laravel & Backend Development', 'Custom Laravel applications, backend systems, admin panels, databases, and business logic.', 'laravel-backend-development', '2026-10-11 08:14:25', '2026-10-11 08:14:25');
INSERT INTO `services` (`id`, `order`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES (6, 6, 'API & Third-Party Integrations', 'Connect your website or application with APIs, payment gateways, CRMs, business tools, and other third-party platforms.', 'api-integrations', '2026-10-11 08:14:25', '2026-10-11 08:14:25');
INSERT INTO `services` (`id`, `order`, `name`, `description`, `slug`, `created_at`, `updated_at`) VALUES (7, 7, 'Maintenance & Technical Support', 'Ongoing website maintenance, performance improvements, security updates, technical SEO, troubleshooting, and feature enhancements.', 'maintenance-support', '2026-10-11 08:14:25', '2026-10-11 08:14:25');

-- Table: sessions
CREATE TABLE IF NOT EXISTS `sessions` (
    `id` TEXT NOT NULL,
    `user_id` INT,
    `ip_address` TEXT,
    `user_agent` TEXT,
    `payload` TEXT NOT NULL,
    `last_activity` INT NOT NULL,
    INDEX (`last_activity`),
    INDEX (`user_id`),
    UNIQUE INDEX (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Table: settings
CREATE TABLE IF NOT EXISTS `settings` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `key` TEXT NOT NULL,
    `value` TEXT,
    `type` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    UNIQUE INDEX (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (20, 'site_name', 'Sky Web Innovations', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (21, 'site_tagline', 'Website & product engineering', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (22, 'meta_title', 'Sky Web Innovations | Website, SaaS & Custom Software Development Company', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (23, 'meta_description', 'Sky Web Innovations designs and builds websites, custom web applications and SaaS products for businesses in the US, Canada, Australia, New Zealand and the UK.', 'textarea', '2026-10-11 08:14:23', '2026-10-11 08:14:23');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (24, 'meta_image', '/assets/og-image.jpg', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (25, 'contact_email', 'info@skywebinnovations.com', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (26, 'contact_phone', '+91 79909 03773', 'text', '2026-10-11 08:14:23', '2026-10-11 08:14:23');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (27, 'contact_phone_raw', +917990903773, 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (28, 'whatsapp_url', 'https://wa.me/917990903773', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (29, 'linkedin_url', 'https://www.linkedin.com/in/aakash-thakkar-a8b9a988/', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (30, 'founder_name', 'Aakash Thakkar', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (31, 'founder_title', 'Founder & Technology Lead', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (32, 'founder_quote', '"Every project starts with a conversation about the business. Then we build the technology that serves it."', 'textarea', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (33, 'meta_keywords', 'web development, custom software, SaaS, Laravel, React, web applications, website design, digital products, web agency', 'textarea', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (34, 'meta_author', 'Aakash Thakkar', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (35, 'ga_measurement_id', '', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (36, 'google_site_verification', 'Ztt5g2V-1OmuaGg-rGgwOlXQze_XpLRCk_dEk83oLMg', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (37, 'bing_site_verification', '', 'text', '2026-10-11 08:14:24', '2026-10-11 08:14:24');
INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES (38, 'twitter_handle', '@skywebinnovations', 'text', '2026-10-11 08:14:25', '2026-10-11 08:14:25');

-- Table: tech_stack_items
CREATE TABLE IF NOT EXISTS `tech_stack_items` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order` INT NOT NULL DEFAULT '0',
    `name` TEXT NOT NULL,
    `is_published` TEXT NOT NULL,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (1, 1, 'Laravel', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (2, 2, 'PHP', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (3, 3, 'React', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (4, 4, 'Next.js', 1, '2026-10-11 08:14:27', '2026-10-11 08:14:27');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (5, 5, 'Vue.js', 1, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (6, 6, 'Node.js', 1, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (7, 7, 'Flutter', 1, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (8, 8, 'WordPress', 1, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (9, 9, 'Shopify', 1, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (10, 10, 'MySQL', 1, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (11, 11, 'AWS', 1, '2026-10-11 08:14:28', '2026-10-11 08:14:28');
INSERT INTO `tech_stack_items` (`id`, `order`, `name`, `is_published`, `created_at`, `updated_at`) VALUES (12, 12, 'Docker', 1, '2026-10-11 08:14:28', '2026-10-11 08:14:28');

-- Table: users
CREATE TABLE IF NOT EXISTS `users` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `name` TEXT NOT NULL,
    `email` TEXT NOT NULL,
    `email_verified_at` TIMESTAMP,
    `password` TEXT NOT NULL,
    `remember_token` TEXT,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP,
    UNIQUE INDEX (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: why_us_items
CREATE TABLE IF NOT EXISTS `why_us_items` (
    `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `order` INT NOT NULL DEFAULT '0',
    `number` TEXT NOT NULL,
    `title` TEXT NOT NULL,
    `description` TEXT,
    `created_at` TIMESTAMP,
    `updated_at` TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `why_us_items` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (1, 1, 1, 'Business-First Approach', 'We start by understanding your business, goals, users, and challenges before deciding how to build the solution.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `why_us_items` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (2, 2, 2, 'Direct Communication', 'You communicate directly with the people working on your project, keeping decisions and communication simple.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `why_us_items` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (3, 3, 3, 'Clear Scope & Pricing', 'We define the project scope, deliverables, timeline, and pricing clearly before development begins.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `why_us_items` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (4, 4, 4, 'Right Technology', 'We choose technology based on your actual requirements, budget, performance needs, and future goals.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `why_us_items` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (5, 5, 5, 'Quality & Performance', 'We focus on clean development, performance, security, scalability, and maintainability.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');
INSERT INTO `why_us_items` (`id`, `order`, `number`, `title`, `description`, `created_at`, `updated_at`) VALUES (6, 6, 6, 'Long-Term Partnership', 'Our relationship does not end after launch. We continue supporting, maintaining, and improving your website or product.', '2026-10-11 08:14:26', '2026-10-11 08:14:26');

SET FOREIGN_KEY_CHECKS=1;
