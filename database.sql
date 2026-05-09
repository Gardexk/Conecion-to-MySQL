CREATE DATABASE IF NOT EXISTS empresa
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE empresa;

CREATE TABLE IF NOT EXISTS productos (
  idpro INT NOT NULL,
  nombre VARCHAR(30) NOT NULL,
  precio DECIMAL(10, 2) NOT NULL,
  existencia INT NOT NULL,
  PRIMARY KEY (idpro)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO productos (idpro, nombre, precio, existencia) VALUES
(1, 'Galletas', 29.99, 20)
ON DUPLICATE KEY UPDATE
  nombre = VALUES(nombre),
  precio = VALUES(precio),
  existencia = VALUES(existencia);
