# install composer
composer install

# install nodejs packages v16
npm install

# config mysql creds in run.php $config array

# create table
CREATE TABLE `test1` (
  `id` int NOT NULL AUTO_INCREMENT,
  `column1` varchar(255) DEFAULT NULL,
  `column2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4;

# add some row
INSERT INTO `test1` (column1, column2) VALUES("ExtId:341", "php");
INSERT INTO `test1` (column1, column2) VALUES("ExtId:341", "php");

# run nodejs server, the given url wasnt accessible
node server.js

# run php
php run.php
