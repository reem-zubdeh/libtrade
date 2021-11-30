
CREATE TABLE `books` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `image_filename` varchar(255) NOT NULL,
  PRIMARY KEY (`book_id`)
);

CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `location` varchar(255) NOT NULL,
  `image_filename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
);


CREATE TABLE `owned_books` (
  `owned_books_id` int NOT NULL AUTO_INCREMENT,
  `book_id` int NOT NULL,
  `user_id` int NOT NULL,
  `available` tinyint NOT NULL,
  `reading` tinyint NOT NULL,
  PRIMARY KEY (`owned_books_id`),
  KEY `owned_books_book_id_idx` (`book_id`),
  KEY `owned_books_user_id_idx` (`user_id`),
  CONSTRAINT `owned_books_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  CONSTRAINT `owned_books_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
);

CREATE TABLE `trades` (
  `trade_id` int NOT NULL AUTO_INCREMENT,
  `user1_id` int NOT NULL,
  `user2_id` int NOT NULL,
  `book1_id` int NOT NULL,
  `book2_id` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`trade_id`),
  KEY `trades_user1_id_idx` (`user1_id`),
  KEY `trades_user2_id_idx` (`user2_id`),
  KEY `trades_book1_id_idx` (`book1_id`),
  KEY `trades_book2_id_idx` (`book2_id`),
  CONSTRAINT `trades_book1_id` FOREIGN KEY (`book1_id`) REFERENCES `books` (`book_id`),
  CONSTRAINT `trades_book2_id` FOREIGN KEY (`book2_id`) REFERENCES `books` (`book_id`),
  CONSTRAINT `trades_user1_id` FOREIGN KEY (`user1_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `trades_user2_id` FOREIGN KEY (`user2_id`) REFERENCES `users` (`user_id`)
);

DROP TABLE IF EXISTS `updates`;
CREATE TABLE `updates` (
  `update_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `requesting_user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `requesting_book_id` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`update_id`),
  KEY `updates_user_id_idx` (`user_id`),
  KEY `updates_requesting_user_id_idx` (`requesting_user_id`),
  KEY `updates_book_id_idx` (`book_id`),
  KEY `updates_requesting_book_id_idx` (`requesting_book_id`),
  CONSTRAINT `updates_book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`),
  CONSTRAINT `updates_requesting_book_id` FOREIGN KEY (`requesting_book_id`) REFERENCES `books` (`book_id`),
  CONSTRAINT `updates_requesting_user_id` FOREIGN KEY (`requesting_user_id`) REFERENCES `users` (`user_id`),
  CONSTRAINT `updates_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
);
