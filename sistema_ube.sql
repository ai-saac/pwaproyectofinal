/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : sistema_ube

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 01/12/2023 02:40:18
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `year` int(11) NULL DEFAULT NULL,
  `genre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `state` tinyint(4) NULL DEFAULT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'book.jpg',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of books
-- ----------------------------
INSERT INTO `books` VALUES (3, 'LA CULPA ES DE LA VACA', 'CRPASP', 2021, 'AVENTURA', 3, 1, 'vaca.jpg');
INSERT INTO `books` VALUES (6, 'LA KATITA', 'CRIS', 1996, 'NOVELA', 9, 1, 'book.jpg');
INSERT INTO `books` VALUES (9, 'LA DIVINA COMEDIA', 'DANTE ELIGHIERI', 1996, 'AVENTURA', 5, 1, 'ladivinacomedia.jpeg');
INSERT INTO `books` VALUES (10, 'EL PRINCIPITO', 'JOSE ANDRADE', 1869, 'AVENTURA', 12, 1, 'principito.jpg');
INSERT INTO `books` VALUES (11, 'RELATIVIDAD', 'ALBERT EINSTEIN', 1789, 'FISICA', 5, 1, 'relatividad.jpg');
INSERT INTO `books` VALUES (12, 'COMO VEO EL MUNDO', 'ALBERT EINSTEIN', 1865, 'DRAMA', 9, 1, 'comoveoelmudo.jpg');
INSERT INTO `books` VALUES (13, 'HARRY POTHER (LA PIEDRA)', 'JK ROWLING', 1986, 'AVENTURA', 4, 1, 'harry.jpg');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrator');
INSERT INTO `roles` VALUES (2, 'Librarian');
INSERT INTO `roles` VALUES (3, 'Reader');

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `date_of_issue` date NULL DEFAULT NULL,
  `date_of_return` date NULL DEFAULT NULL,
  `lector_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `book_id`(`book_id`) USING BTREE,
  CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES (1, 1, 3, '2023-12-01', '2023-11-30', 2);
INSERT INTO `transactions` VALUES (2, 1, 6, '2023-12-01', '2023-12-16', 15);
INSERT INTO `transactions` VALUES (4, 1, 9, '2023-12-01', '2023-12-01', 19);
INSERT INTO `transactions` VALUES (5, 1, 12, '2023-12-01', '2023-12-01', 19);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `nombres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `apellidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `state` tinyint(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  INDEX `role_id`(`role_id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'cris', 'pcris.994@gmail.com', '$2y$10$.DtWJqNgKdybfgT4rou30e5w3r6MjHqziTOnbrZvev3dOW4TA3vkO', 1, 'CRISTIAN', 'PAZ', 1);
INSERT INTO `users` VALUES (2, 'pao', 'paola@gmail.com', '$2y$10$FJi16wGP0X4YUWGibWMSQ.zJrobXlFlLLEj0tGOzmgVRs5Lhgd84G', 3, 'PAOLA', 'PAZ', 1);
INSERT INTO `users` VALUES (3, 'byron', 'byron@gmail.com', '$2y$10$oMgw102A1Q4GtXV6mUuB.uqnBLyPqPy4g7ywfwDHLi3TfEwKkP8Ku', 1, 'BYRON', 'PAZ', 1);
INSERT INTO `users` VALUES (15, 'mary', 'mary@gmail.com', '$2y$10$KqLwuJhPDcrbAB/xWJdVJukNTfXsw2eikc2fMfWldDOVAb3dwA9b6', 3, 'MARIA', 'ANDRADE', 1);
INSERT INTO `users` VALUES (16, 'ari', 'ari@gmail.com', '$2y$10$q45dJdYeUPyov8wPOFmNaO2q3z5GF8/B9xfolt9uKpsZ.eNvcOjQ2', 2, 'ARIANA', 'PAZ', 1);
INSERT INTO `users` VALUES (17, 'victor', 'victor@gmail.com', '$2y$10$sXq06sZFEO71GS5KigQQ3.5v4jt/BJ.pT.T7UbkS5rF/Wcv1oHLIq', 2, 'VICTOR', 'PAZ', 1);
INSERT INTO `users` VALUES (19, 'jose', 'jose@gmail.com', '$2y$10$sz4cC8t8fVO9FVXNfNYRSuy2H4IW4nbUhmDdt17UPNMY5b/SL.hNq', 3, 'JOSE', 'PAZ', NULL);

SET FOREIGN_KEY_CHECKS = 1;
