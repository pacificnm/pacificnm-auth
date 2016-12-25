-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2016 at 06:50 AM
-- Server version: 10.0.28-MariaDB-0+deb8u1
-- PHP Version: 5.6.27-0+deb8u1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_camper`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`A
--

CREATE TABLE IF NOT EXISTS `auth` (
`auth_id` int(20) NOT NULL,
  `acl_role_id` int(20) unsigned NOT NULL,
  `auth_email` varchar(200) NOT NULL,
  `auth_password` varchar(100) NOT NULL,
  `auth_name` varchar(100) NOT NULL,
  `auth_last_login` int(11) NOT NULL,
  `auth_last_ip` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
 ADD PRIMARY KEY (`auth_id`), ADD KEY `acl_role_id` (`acl_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
MODIFY `auth_id` int(20) NOT NULL AUTO_INCREMENT;SET FOREIGN_KEY_CHECKS=1;
