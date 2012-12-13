
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `twitter_name` varchar(255) NOT NULL,
  `twitter_avatar` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `queue`;
CREATE TABLE `queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notified` tinyint NOT NULL,
  `accepted` tinyint NOT NULL,
  `playing` tinyint NOT NULL,
  `finished` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `games`;
CREATE TABLE `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p1_id` int(11) NOT NULL,
  `p2_id` int(11) NOT NULL,
  `p1_score` int(11) NOT NULL,
  `p2_score` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `finished` tinyint NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE USER 'pingpong'@'localhost' IDENTIFIED BY 'pongping';
GRANT ALL PRIVILEGES ON *.* TO 'pingpong'@'localhost' WITH GRANT OPTION;
