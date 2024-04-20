-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 Eki 2023, 15:48:06
-- Sunucu sürümü: 10.4.28-MariaDB
-- PHP Sürümü: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `obs`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `t_class`
--

CREATE TABLE `t_class` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) NOT NULL,
  `class_teacher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `t_class`
--

INSERT INTO `t_class` (`id`, `class_name`, `class_teacher_id`) VALUES
(5, 'class 1 ', 8),
(7, 'CLASS2', 9);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `t_classes_student`
--

CREATE TABLE `t_classes_student` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `t_classes_student`
--

INSERT INTO `t_classes_student` (`id`, `student_id`, `class_id`) VALUES
(5, 3, 5),
(6, 5, 5),
(7, 15, 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `t_exam`
--

CREATE TABLE `t_exam` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_score` int(11) NOT NULL,
  `exam_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `t_exam`
--

INSERT INTO `t_exam` (`id`, `student_id`, `lesson_id`, `class_id`, `exam_score`, `exam_date`) VALUES
(5, 3, 7, 5, 69, '2023-10-13 23:05:26'),
(13, 5, 7, 5, 79, '2023-10-13 23:21:12'),
(14, 5, 9, 7, 99, '2023-10-14 07:40:38'),
(15, 15, 7, 5, 14, '2023-10-14 13:42:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `t_lesson`
--

CREATE TABLE `t_lesson` (
  `id` int(11) NOT NULL,
  `teacher_user_id` int(11) NOT NULL,
  `lesson_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `t_lesson`
--

INSERT INTO `t_lesson` (`id`, `teacher_user_id`, `lesson_name`) VALUES
(7, 8, 'ders2'),
(9, 9, 'DERS3');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `t_user`
--

CREATE TABLE `t_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `t_user`
--

INSERT INTO `t_user` (`id`, `name`, `surname`, `username`, `password`, `role`, `created_at`) VALUES
(3, 'ogrenci', '1', 'ogrenci1', '$argon2id$v=19$m=16384,t=4,p=2$dnBDQTAwZ05Fd1JUaGVCdw$WNzmMOjPT4wRUsC6Z5dMNdaWzdMXbQesV8tVOgEaNi0', 'student', '2023-10-12 08:23:33'),
(5, 'ogrenci', '2', 'ogrenci2', '$argon2id$v=19$m=65536,t=4,p=1$UHNpWWt0RVZCMzl1U1UxeA$i1OHEiolivuIxAQhfafLKqZh93COuih01IQJuf6S2Bo', 'student', '2023-10-13 21:34:11'),
(8, 'Öğretmen', '1', 'ogretmen', '$argon2id$v=19$m=65536,t=4,p=1$blNNR0FtOS9RU2U3Z0k1Vg$D8jnk6K3DfQepmQhHlfkIGlyaZ2JV/ueIGzcSiae5xc', 'teacher', '2023-10-14 12:42:57'),
(9, 'öğretmen', '2', 'deneme', '$argon2id$v=19$m=65536,t=4,p=1$VzBGZ1puNm5tTmNSS1FYbA$JAkYs/J8r2itcomiszVwEye6+g48selD/5AaGS3m+2Q', 'teacher', '2023-10-12 12:28:56'),
(14, 'admin', 'admin', 'admin', '$argon2id$v=19$m=65536,t=4,p=1$elpTblVoL3E3bW9nYWVIZQ$oahhoNsPMG7LY8hNDInt1qAsVmIVJKGPQFYOMJG1VCQ', 'admin', '2023-10-14 10:01:44'),
(15, 'ogrenci', 'ogrenci', 'ogrenci', '$argon2id$v=19$m=16384,t=4,p=2$aEw1QnQ5eklrQzFPenVwUw$Cdkp3GiAEi4fO2eum4oglxQ+P5oIbrWJJiLaibBktm0', 'student', '2023-10-14 12:48:30');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `t_class`
--
ALTER TABLE `t_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref t_users.id2` (`class_teacher_id`);

--
-- Tablo için indeksler `t_classes_student`
--
ALTER TABLE `t_classes_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref t_users.id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Tablo için indeksler `t_exam`
--
ALTER TABLE `t_exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref t_users.id4` (`student_id`),
  ADD KEY `lesson_id` (`lesson_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Tablo için indeksler `t_lesson`
--
ALTER TABLE `t_lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref t_users.id3` (`teacher_user_id`);

--
-- Tablo için indeksler `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `t_class`
--
ALTER TABLE `t_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `t_classes_student`
--
ALTER TABLE `t_classes_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `t_exam`
--
ALTER TABLE `t_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `t_lesson`
--
ALTER TABLE `t_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `t_user`
--
ALTER TABLE `t_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `t_class`
--
ALTER TABLE `t_class`
  ADD CONSTRAINT `ref t_users.id2` FOREIGN KEY (`class_teacher_id`) REFERENCES `t_user` (`id`);

--
-- Tablo kısıtlamaları `t_classes_student`
--
ALTER TABLE `t_classes_student`
  ADD CONSTRAINT `ref t_users.id` FOREIGN KEY (`student_id`) REFERENCES `t_user` (`id`),
  ADD CONSTRAINT `t_classes_student_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `t_class` (`id`);

--
-- Tablo kısıtlamaları `t_exam`
--
ALTER TABLE `t_exam`
  ADD CONSTRAINT `ref t_users.id4` FOREIGN KEY (`student_id`) REFERENCES `t_user` (`id`),
  ADD CONSTRAINT `t_exam_ibfk_1` FOREIGN KEY (`lesson_id`) REFERENCES `t_lesson` (`id`),
  ADD CONSTRAINT `t_exam_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `t_class` (`id`);

--
-- Tablo kısıtlamaları `t_lesson`
--
ALTER TABLE `t_lesson`
  ADD CONSTRAINT `ref t_users.id3` FOREIGN KEY (`teacher_user_id`) REFERENCES `t_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
