CREATE TABLE `guests` (
  `id` integer,
  `name` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `email` varchar(255),
  `options` json,
  `rating` float,
  PRIMARY KEY (`id`, `email`)
);

CREATE TABLE `owners` (
  `id` integer,
  `name` varchar(255),
  `username` varchar(255),
  `password` varchar(255),
  `email` varchar(255),
  `options` json,
  `rating` float,
  PRIMARY KEY (`id`, `email`)
);

CREATE TABLE `Publication` (
  `id` integer PRIMARY KEY,
  `price` integer,
  `ubication` varchar(255),
  `days_available` integer,
  `description` text,
  `rental_type` varchar(255),
  `num_rooms` integer,
  `pets` tinyint,
  `number_people` integer
);

CREATE TABLE `Publication_users` (
  `id` integer PRIMARY KEY,
  `owners_id` integer,
  `publication_id` integer
);

CREATE TABLE `pictures` (
  `id` integer PRIMARY KEY,
  `name` varchar(255),
  `type` varchar(255),
  `publication_id` integer
);

CREATE TABLE `publication_avaliable_days` (
  `id` integer PRIMARY KEY,
  `desde` datetime,
  `hasta` datetime,
  `estado` enum,
  `publication_id` integer
);

ALTER TABLE `pictures` ADD FOREIGN KEY (`id`) REFERENCES `Publication` (`id`);

CREATE TABLE `Publication_users_Publication` (
  `Publication_users_owners_id` integer,
  `Publication_id` integer,
  PRIMARY KEY (`Publication_users_owners_id`, `Publication_id`)
);

ALTER TABLE `Publication_users_Publication` ADD FOREIGN KEY (`Publication_users_owners_id`) REFERENCES `Publication_users` (`owners_id`);

ALTER TABLE `Publication_users_Publication` ADD FOREIGN KEY (`Publication_id`) REFERENCES `Publication` (`id`);

