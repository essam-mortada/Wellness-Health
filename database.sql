CREATE TABLE IF NOT EXISTS `migrations` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `migration` VARCHAR(255) NOT NULL,
    `batch` INT NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` DATETIME,
    PRIMARY KEY(`email`)
);

CREATE TABLE IF NOT EXISTS `sessions` (
    `id` VARCHAR(255) NOT NULL,
    `user_id` INT,
    `ip_address` VARCHAR(255),
    `user_agent` TEXT,
    `payload` TEXT NOT NULL,
    `last_activity` INT NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `cache` (
    `key` VARCHAR(255) NOT NULL,
    `value` TEXT NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY(`key`)
);

CREATE TABLE IF NOT EXISTS `cache_locks` (
    `key` VARCHAR(255) NOT NULL,
    `owner` VARCHAR(255) NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY(`key`)
);

CREATE TABLE IF NOT EXISTS `jobs` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `queue` VARCHAR(255) NOT NULL,
    `payload` TEXT NOT NULL,
    `attempts` INT NOT NULL,
    `reserved_at` INT,
    `available_at` INT NOT NULL,
    `created_at` INT NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `job_batches` (
    `id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `total_jobs` INT NOT NULL,
    `pending_jobs` INT NOT NULL,
    `failed_jobs` INT NOT NULL,
    `failed_job_ids` TEXT NOT NULL,
    `options` TEXT,
    `cancelled_at` INT,
    `created_at` INT NOT NULL,
    `finished_at` INT,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` TEXT NOT NULL,
    `exception` TEXT NOT NULL,
    `failed_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `products` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `price` FLOAT NOT NULL,
    `quantity` INT NOT NULL,
    `image` VARCHAR(255),
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `total_price` FLOAT NOT NULL,
    `status` VARCHAR(255) NOT NULL DEFAULT 'pending',
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `first_name` VARCHAR(255) NOT NULL,
    `last_name` VARCHAR(255) NOT NULL,
    `country` VARCHAR(255) NOT NULL,
    `street` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `payment` VARCHAR(255) NOT NULL,
    `delivery` FLOAT NOT NULL,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `order_items` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    `quantity` INT NOT NULL,
    `price` FLOAT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE,
    FOREIGN KEY(`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `users` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verified_at` DATETIME,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100),
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

CREATE TABLE IF NOT EXISTS `blogs` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `summary` VARCHAR(255) NOT NULL,
    `content` TEXT NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
);

INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1);
INSERT INTO `migrations` VALUES (2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO `migrations` VALUES (3,'0001_01_01_000002_create_jobs_table',1);

INSERT INTO `sessions` VALUES ('9cz3hKLR3kPJMZmQj259SooVo5IEsiiWepi8VBC3',NULL,'127.0.0.1','Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/12.0.0 Mobile/15A5370a Safari/602.1','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU1FLUmtnMFBYQURpQnJ4czhoaFpJMWxEbFp6S3BpbUw1Z3NPQWkwbCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaG9wIjt9czo0OiJjYXJ0IjthOjE6e2k6MzthOjU6e3M6NDoibmFtZSI7czoyODoiZ3JlZW4gY29mZmVlIGJ1bmRsZSAyIG1vbnRocyI7czoxMToiZGVzY3JpcHRpb24iO3M6NTA6ImdyZWVuIGNvZmZlIGdhbWRhIGZhc2hraCBidGtoc3MgYXd5IGh0a2ZlayBzaGFocmVuIjtzOjg6InF1YW50aXR5IjtpOjE7czo1OiJwcmljZSI7ZDo5MDA7czo1OiJpbWFnZSI7czoxNDoiMTcyMTM0ODA0NC5qcGciO319fQ==',1722612795);
INSERT INTO `sessions` VALUES ('Qv751ynANRZ3L8FQFYSeBvRtZGLr3fpaSIudayeB',NULL,'127.0.0.1','Mozilla/5.0 (iPhone; CPU iPhone OS 12_0 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/12.0.0 Mobile/15A5370a Safari/602.1','YTozOntzOjY6Il90b2tlbiI7czo0MDoiZktDRnNZMnR2b1hURDYwaE9PUW1WOVQzVFFDNkJYYUxHOVFXaHhVbSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1722637453);

INSERT INTO `products` VALUES (1,'green coffee','green coffe gamda fashkh btkhss awy',300.0,0,'1721348044.jpg','2024-07-17 16:09:02','2024-07-19 12:02:02');
INSERT INTO `products` VALUES (2,'baby blue coffee bundle 2 months','blue coffee 2 months',300.0,1,'1719797890407.jpg','2024-07-17 16:09:02','2024-07-19 12:02:02');
INSERT INTO `products` VALUES (3,'green coffee bundle 2 months','green coffee gamda fashkh btkhss awy 2 months',900.0,5,'1721348044.jpg','2024-07-18 23:54:02','2024-07-19 12:02:02');

INSERT INTO `orders` VALUES (1,139.0,'completed','2024-07-19 12:11:49','2024-07-19 12:11:49','marwan','mohamed','egypt','el-mhalla el-kobra','mushorp','00201062624873','marwanhamed@gmail.com','cash',20.0);

INSERT INTO `order_items` VALUES (1,1,1,1,59.0,'2024-07-19 12:11:49','2024-07-19 12:11:49');
INSERT INTO `order_items` VALUES (2,1,2,2,60.0,'2024-07-19 12:11:49','2024-07-19 12:11:49');

INSERT INTO `users` VALUES (1,'User1','user1@example.com',NULL,'$2y$10$3NV0wX2B8Q/Mb5Y6BlVoeOGCu1V8GkBt41mDSopTv1UOS6UhKJ8.O',NULL,'2024-07-19 11:10:30','2024-07-19 11:10:30');

INSERT INTO `blogs` VALUES (1,'Blog Title','This is a summary of the blog post.','This is the content of the blog post.','image.jpg','2024-07-19 11:10:30','2024-07-19 11:10:30');
