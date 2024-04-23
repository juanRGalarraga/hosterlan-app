CREATE TABLE `users` (
  `id` integer,
  `nombre` varchar(255),
  `apellido` varchar(255),
  `contraseña` varchar(255),
  `email` varchar(255),
  `opciones` json,
  PRIMARY KEY (`id`, `email`)
);

CREATE TABLE `publication` (
  `id` integer PRIMARY KEY,
  `precio` integer,
  `ubicacion` varchar(255),
  `dias_disponible` integer,
  `description` text,
  `tipo_alquiler` varchar(255),
  `num_habitaciones` integer,
  `mascotas` tinyint,
  `cant_personas` integer
);

CREATE TABLE `Publication_users` (
  `id` integer PRIMARY KEY,
  `users_id` integer,
  `publication_id` integer
);

CREATE TABLE `imagenes` (
  `id` integer PRIMARY KEY,
  `nombre` varchar(255),
  `type` string,
  `publication_id` integer
);
