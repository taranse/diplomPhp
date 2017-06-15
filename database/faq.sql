--
-- Скрипт сгенерирован Devart dbForge Studio for MySQL, Версия 7.2.63.0
-- Домашняя страница продукта: http://www.devart.com/ru/dbforge/mysql/studio
-- Дата скрипта: 15.06.2017 11:02:57
-- Версия сервера: 5.5.50
-- Версия клиента: 4.1
--


-- 
-- Отключение внешних ключей
-- 
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;

-- 
-- Установить режим SQL (SQL mode)
-- 
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 
-- Установка кодировки, с использованием которой клиент будет посылать запросы на сервер
--
SET NAMES 'utf8';

-- 
-- Установка базы данных по умолчанию
--
USE diplom;

--
-- Описание для таблицы block_words
--
DROP TABLE IF EXISTS block_words;
CREATE TABLE block_words (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  word VARCHAR(191) NOT NULL,
  author VARCHAR(191) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX block_words_word_unique (word)
)
ENGINE = INNODB
AUTO_INCREMENT = 1
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

--
-- Описание для таблицы migrations
--
DROP TABLE IF EXISTS migrations;
CREATE TABLE migrations (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  migration VARCHAR(191) NOT NULL,
  batch INT(11) NOT NULL,
  PRIMARY KEY (id)
)
ENGINE = INNODB
AUTO_INCREMENT = 6
AVG_ROW_LENGTH = 3276
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

--
-- Описание для таблицы password_resets
--
DROP TABLE IF EXISTS password_resets;
CREATE TABLE password_resets (
  email VARCHAR(191) NOT NULL,
  token VARCHAR(191) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  INDEX password_resets_email_index (email)
)
ENGINE = INNODB
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

--
-- Описание для таблицы questions
--
DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(191) NOT NULL,
  rubric VARCHAR(191) NOT NULL,
  alias VARCHAR(191) NOT NULL,
  text TEXT NOT NULL,
  state VARCHAR(191) NOT NULL,
  block VARCHAR(191) NOT NULL,
  author VARCHAR(191) NOT NULL,
  email VARCHAR(191) NOT NULL,
  answer TEXT DEFAULT NULL,
  admin VARCHAR(191) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX questions_name_unique (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

--
-- Описание для таблицы rubrics
--
DROP TABLE IF EXISTS rubrics;
CREATE TABLE rubrics (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(191) NOT NULL,
  alias VARCHAR(191) NOT NULL,
  author VARCHAR(191) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX rubrics_alias_unique (alias)
)
ENGINE = INNODB
AUTO_INCREMENT = 3
AVG_ROW_LENGTH = 8192
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

--
-- Описание для таблицы users
--
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(191) NOT NULL,
  `group` VARCHAR(191) NOT NULL,
  password VARCHAR(191) NOT NULL,
  remember_token VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP NULL DEFAULT NULL,
  updated_at TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE INDEX users_name_unique (name)
)
ENGINE = INNODB
AUTO_INCREMENT = 2
AVG_ROW_LENGTH = 16384
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- 
-- Вывод данных для таблицы block_words
--

-- Таблица diplom.block_words не содержит данных

-- 
-- Вывод данных для таблицы migrations
--
INSERT INTO migrations VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_04_18_201750_create_rubrics_table', 1),
(4, '2017_04_21_192926_create_questions_table', 1),
(5, '2017_05_21_142523_create-block-words-table', 2);

-- 
-- Вывод данных для таблицы password_resets
--

-- Таблица diplom.password_resets не содержит данных

-- 
-- Вывод данных для таблицы questions
--
INSERT INTO questions VALUES
(1, 'QWEqweq', '1', 'qweqweq', '<p>qweqweqwe</p>', '1', '0', 'qweqweqwe', 'qweqweqweb@bweqwe.ru', '<p>qqq</p>', '1', '2017-05-04 11:04:36', '2017-05-05 13:00:46');

-- 
-- Вывод данных для таблицы rubrics
--
INSERT INTO rubrics VALUES
(1, 'Вопросы по PHP', 'voprosi-po-php', '1', '2017-05-04 10:10:51', '2017-05-04 10:10:51'),
(2, 'Javascript специалисты', 'javascript-spicialisti', '1', '2017-05-04 10:37:48', '2017-05-04 10:37:48');

-- 
-- Вывод данных для таблицы users
--
INSERT INTO users VALUES
(1, 'admin', '1', '$2y$10$M5VwmFkcLjEx3wwIMUQsneTBcQIBTVnq3bawQhWD9rpKJYifeSjEa', 'V2EIxgzumOOd5QK0KZhUrecZJ90wNHfBq3AKW6o6uWiwjVdReyeTOrfqGtO5', NULL, NULL);

-- 
-- Восстановить предыдущий режим SQL (SQL mode)
-- 
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;

-- 
-- Включение внешних ключей
-- 
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;