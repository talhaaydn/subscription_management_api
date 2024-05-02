-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2024 at 12:11 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `subscription_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
                               `id` int(11) NOT NULL,
                               `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `callback_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                               `created_at` datetime NOT NULL,
                               `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`id`, `name`, `callback_url`, `created_at`, `updated_at`) VALUES
                                                                                         (1, 'App 1', 'http://127.0.0.1:8004/callback', '2024-04-27 16:44:26', NULL),
                                                                                         (2, 'App 2', 'http://127.0.0.1:8004/callback', '2024-04-29 12:47:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
                          `id` int(11) NOT NULL,
                          `application_id` int(11) DEFAULT NULL,
                          `language_id` int(11) DEFAULT NULL,
                          `uid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `operating_system` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
                          `created_at` datetime NOT NULL,
                          `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`id`, `application_id`, `language_id`, `uid`, `operating_system`, `created_at`, `updated_at`) VALUES
    (11, 1, 1, 'efc02af7-9b3b-4ca1-9953-a31421ad6db0', 'google', '2024-05-02 21:08:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device_token`
--

CREATE TABLE `device_token` (
                                `id` int(11) NOT NULL,
                                `device_id` int(11) DEFAULT NULL,
                                `client_token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `created_at` datetime NOT NULL,
                                `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_token`
--

INSERT INTO `device_token` (`id`, `device_id`, `client_token`, `created_at`, `updated_at`) VALUES
    (5, 11, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJhcHBsaWNhdGlvbklkIjoxLCJvcGVyYXRpbmdTeXN0ZW0iOiJnb29nbGUiLCJkZXZpY2VJZCI6MTF9.n78mrFbYW3n_XdEY49AYtd-lMF0e-pJ_5UOfBKOYYaA', '2024-05-02 21:08:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
                            `id` int(11) NOT NULL,
                            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `code` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `created_at` datetime NOT NULL,
                            `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
                                                                              (1, 'Turkish', 'tr', '2024-04-27 16:43:30', NULL),
                                                                              (2, 'English', 'en', '2024-04-27 16:43:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
                                `id` int(11) NOT NULL,
                                `device_id` int(11) DEFAULT NULL,
                                `state` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `receipt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `started_at` datetime NOT NULL,
                                `expired_at` datetime NOT NULL,
                                `created_at` datetime NOT NULL,
                                `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `device_id`, `state`, `receipt`, `started_at`, `expired_at`, `created_at`, `updated_at`) VALUES
    (9, 11, 'started', 'a21d4c87-3bb5-4174-8bf9-5bea7fa11bd1', '2024-05-02 21:08:22', '2024-06-02 03:08:22', '2024-05-02 21:08:22', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
    ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_92FB68E3E030ACD` (`application_id`),
  ADD KEY `IDX_92FB68E82F1BAF4` (`language_id`);

--
-- Indexes for table `device_token`
--
ALTER TABLE `device_token`
    ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_99B2415C94A4C7D4` (`device_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
    ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A3C664D394A4C7D4` (`device_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `device_token`
--
ALTER TABLE `device_token`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `device`
--
ALTER TABLE `device`
    ADD CONSTRAINT `FK_92FB68E3E030ACD` FOREIGN KEY (`application_id`) REFERENCES `application` (`id`),
  ADD CONSTRAINT `FK_92FB68E82F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`);

--
-- Constraints for table `device_token`
--
ALTER TABLE `device_token`
    ADD CONSTRAINT `FK_99B2415C94A4C7D4` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`);

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
    ADD CONSTRAINT `FK_A3C664D394A4C7D4` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`);
