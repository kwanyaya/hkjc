CREATE TABLE `hkjc_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT primary key,
  `uid` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `user_group` varchar(15) DEFAULT NULL,
  `phone` varchar(9) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  
  `game` JSON DEFAULT NULL, 
  
  `prize1` tinyint(1) DEFAULT 0 NOT NULL,
  `prize1_redeem_at` datetime DEFAULT NULL,

  `prize2` tinyint(1) DEFAULT 0 NOT NULL,
  `prize2_redeem_at` datetime DEFAULT NULL,

  `prizeg` tinyint(1) DEFAULT 0 NOT NULL,
  `prizeg_redeem_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `hkjc_game_count` (
  `group` int(11) NULL primary key,
  `count` int(11) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `hkjc_game_count`(`group`,`count`)VALUES
('11', '3000');
('12', '100');
('21', '3000');
('22', '200');
('31', '3000');
('32', '800');
('4', '3000');
('5', '300');

