# Proyecto de Gestión de Cuentas de Streaming

Este proyecto es una aplicación web para gestionar la venta de cuentas de streaming.

## Estructura del Proyecto

El proyecto sigue una estructura basada en el patrón Modelo-Vista-Controlador (MVC):

- `/controllers`: Contiene los controladores que manejan la lógica de la aplicación y las solicitudes de los usuarios.
- `/views`: Contiene las vistas, que son la representación de la interfaz de usuario (HTML).
- `/models`: Contiene los modelos, que interactúan con la base de datos y manejan la lógica de negocio.
- `/assets`: Contiene los archivos estáticos como CSS, JavaScript, imágenes, etc.
- `/includes`: Contiene archivos de inclusión, como la configuración de la base de datos.
- `/lang`: Contiene los archivos de traducción para el soporte multi-idioma.
- `/services`: Contiene servicios que pueden ser utilizados por los controladores, como la autenticación o el envío de correos.
- `/utils`: Contiene funciones de utilidad que pueden ser reutilizadas en todo el proyecto.

## Base de Datos

El esquema de la base de datos se define en el archivo `schema.sql`. Este archivo contiene las sentencias SQL para crear todas las tablas necesarias para el funcionamiento de la aplicación.

## Configuración

- **Conexión a la Base de Datos**: La configuración de la conexión a la base de datos se encuentra en `includes/database.php`. Debes modificar este archivo con las credenciales reales de tu base de datos.
- **Multi-idioma**: Los archivos de traducción se encuentran en el directorio `/lang`. Actualmente, se soportan inglés (`en.json`) y español (`es.json`).

## Dependencias

(Sección para futuras dependencias, como librerías de PHP o paquetes de JavaScript)
