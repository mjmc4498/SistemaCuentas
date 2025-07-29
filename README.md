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

## Instalación

Este proyecto cuenta con un instalador web para simplificar el proceso de configuración inicial.

1.  **Sube los archivos:** Sube todos los archivos del proyecto a tu servidor de hosting.
2.  **Navega al instalador:** Abre tu navegador web y ve a la URL donde subiste los archivos, seguido de `/install.php`. Por ejemplo: `http://tudominio.com/install.php`.
3.  **Configuración de la Base de Datos:**
    *   **Host:** Generalmente `localhost`.
    *   **Nombre de la Base de Datos:** El nombre de la base de datos que creaste en tu hosting.
    *   **Usuario:** El usuario de la base de datos que creaste.
    *   **Contraseña:** La contraseña del usuario de la base de datos.
4.  **Creación de la Cuenta de Administrador:**
    *   **Nombre de Usuario:** Elige un nombre de usuario para la cuenta de administrador principal.
    *   **Email:** Introduce un correo electrónico válido para el administrador.
    *   **Contraseña:** Elige una contraseña segura.
5.  **Finalizar la Instalación:** Haz clic en el botón "Instalar". El script creará el archivo de configuración `.env`, importará la estructura de la base de datos y creará tu cuenta de administrador.
6.  **Seguridad:** Por motivos de seguridad, los archivos `install.php` y `InstallerController.php` se eliminarán automáticamente al finalizar la instalación.

Una vez completado, serás redirigido a la página de login, donde podrás iniciar sesión con la cuenta de administrador que acabas de crear.

## Uso

- **Login:** Accede a `views/login.php` para iniciar sesión.
- **Dashboard:** Una vez logueado, serás redirigido a tu dashboard personalizado según tu rol.
- **Gestión de Usuarios y Cuentas:** Los administradores pueden gestionar usuarios y cuentas desde los enlaces en su dashboard.

## Despliegue

Para desplegar esta aplicación en un servidor de hosting (cPanel, VPS, etc.), sigue estos pasos:

1.  **Sube los archivos:** Sube todos los archivos del proyecto a tu servidor.
2.  **Configura la Base de Datos:** Crea una base de datos y un usuario en tu servidor de hosting e importa el `schema.sql`.
3.  **Configura el archivo `.env`:** Crea un archivo `.env` en la raíz del proyecto y añade las credenciales de tu base de datos de producción. Asegúrate de que este archivo no sea accesible públicamente.
4.  **Permisos de Archivos:** Asegúrate de que los directorios que necesitan permisos de escritura (como `logs`) los tengan.
5.  **Apunta tu Dominio:** Configura tu dominio o subdominio para que apunte a la raíz del proyecto.

## Dependencias

- PHP 8.0 o superior
- Servidor de base de datos MySQL o MariaDB
- Servidor web (Apache, Nginx, etc.)
