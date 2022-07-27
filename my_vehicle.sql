-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8883
-- Generation Time: Jul 12, 2022 at 02:01 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `my_vehicle`
--

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

CREATE TABLE `registrations` (
  `id` int(50) NOT NULL,
  `registration_id` varchar(250) NOT NULL,
  `owner` varchar(250) NOT NULL,
  `car_brand` varchar(250) NOT NULL,
  `car_model` varchar(250) NOT NULL,
  `car_year` int(50) NOT NULL,
  `plate_number` varchar(250) NOT NULL,
  `chasis_no` varchar(250) NOT NULL,
  `car_condition` varchar(250) NOT NULL,
  `local_govt` varchar(250) NOT NULL,
  `state_allocated` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `registrations`
--

INSERT INTO `registrations` (`id`, `registration_id`, `owner`, `car_brand`, `car_model`, `car_year`, `plate_number`, `chasis_no`, `car_condition`, `local_govt`, `state_allocated`, `status`, `date`) VALUES
(1, 'JGSUVO3IYKA', 'Khalifa Adeboye', 'Toyota', 'Rav4', 2015, 'PVX - 391IX', '0092A', 'New', 'Abara', 'Lagos', 'Processing', '2022-07-11 16:50:58'),
(2, 'FE2YVJHQ971', 'Khalifa Adeboye', 'Toyota', 'Camry', 2018, 'VSU - 364VW', '09238', 'Used', 'Aba', 'Rivers', 'Processing', '2022-07-11 21:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(15) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `date_of_birth` date NOT NULL,
  `state_of_residence` varchar(250) NOT NULL,
  `phone` int(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `date_of_birth`, `state_of_residence`, `phone`, `address`, `password`, `date`) VALUES
(1, 'Khalifa', 'Adeboye', 'khalifa@gmail.com', '0000-00-00', 'Ogun state', 2147483647, 'No.15 St. Matthew street, Ikorodu', '$2y$10$7uTS3vpgsMAmPJ/s0ub5JutE2kjgwXUB6RL5ev0er0FiDwieyzY7O', '0000-00-00 00:00:00'),
(2, 'Wilson', 'Alvin', 'wills@gmail.com', '1998-05-12', 'Abuja', 807365241, 'Agbulegba 1st ajah street', '$2y$10$OXXbTcAexokCl2oykVHEdeFxqjO9yrxQQA0MmefBFB9Agm8RBDg0q', '2022-07-11 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registrations`
--
ALTER TABLE `registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registrations`
--
ALTER TABLE `registrations`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;