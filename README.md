# Conexion a MySQL con PHP

Proyecto de prueba para realizar operaciones CRUD de productos usando PHP, MySQL y JavaScript.

## Requisitos

- PHP 7.4 o superior con extension `mysqli`
- MySQL o MariaDB
- Navegador web

## Instalacion

1. Crea la base de datos y la tabla:

   ```bash
   mysql -u root -p < database.sql
   ```

2. Revisa los datos de conexion en `conexion.php`.

   Por defecto usa:

   ```text
   host: localhost
   usuario: root
   password: matematicas
   base de datos: empresa
   ```

   Tambien puedes configurar variables de entorno:

   ```text
   MYSQL_HOST
   MYSQL_USER
   MYSQL_PASSWORD
   MYSQL_DATABASE
   ```

3. Levanta el servidor local desde la carpeta del proyecto:

   ```bash
   php -S localhost:8000
   ```

4. Abre la aplicacion:

   ```text
   http://localhost:8000/index.html
   ```

## Archivos principales

- `index.html`: interfaz principal del CRUD.
- `main.js`: peticiones `fetch` hacia los endpoints PHP.
- `conexion.php`: conexion centralizada a MySQL.
- `datos.php`: lista productos en formato JSON.
- `insertar.php`: registra productos.
- `consultar.php`: busca un producto por id.
- `eliminar.php`: elimina un producto por id.
- `database.sql`: script para crear la base de datos y datos iniciales.

## Mejoras aplicadas

- Migracion completa a `mysqli`; se eliminaron usos de `mysql_*`.
- Consultas preparadas para insertar, consultar y eliminar productos.
- Respuestas JSON consistentes entre endpoints.
- Validacion basica de datos recibidos por `POST`.
- Correccion de nombres de campos entre frontend y backend.
- Esquema SQL actualizado a `utf8mb4` y base de datos `empresa`.
- Interfaz mas ordenada y responsive sin depender de Bootstrap remoto.

## Notas

Este proyecto es educativo. Para produccion conviene agregar autenticacion, manejo centralizado de errores, logs, proteccion CSRF y configuracion fuera del codigo fuente.
