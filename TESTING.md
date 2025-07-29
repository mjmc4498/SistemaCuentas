# Guía de Pruebas Manuales

Esta guía describe los pasos para probar manualmente las funcionalidades clave de la aplicación.

## 1. Autenticación

### 1.1. Registro de Usuario
1.  Ve a `views/login.php`.
2.  Crea un nuevo usuario a través de la interfaz de gestión de usuarios (como admin).
3.  Verifica que el nuevo usuario puede iniciar sesión.
4.  Verifica que se envía un correo de bienvenida (revisa `logs/emails.log`).

### 1.2. Inicio y Cierre de Sesión
1.  Ve a `views/login.php`.
2.  Inicia sesión con un usuario válido.
3.  Verifica que eres redirigido al dashboard correcto según el rol.
4.  Cierra la sesión y verifica que eres redirigido a la página de login.

### 1.3. Recuperación de Contraseña
1.  Ve a `views/forgot_password.php`.
2.  Introduce el email de un usuario existente.
3.  Verifica que se envía un correo de recuperación (revisa `logs/emails.log`).
4.  Usa el enlace del correo para restablecer la contraseña.
5.  Verifica que puedes iniciar sesión con la nueva contraseña.

## 2. Roles y Permisos
1.  Inicia sesión como administrador.
2.  Ve a `views/manage_users.php`.
3.  Edita un usuario y cambia su rol.
4.  Inicia sesión como ese usuario y verifica que su dashboard y permisos han cambiado.
5.  Intenta acceder a una página para la que no tienes permisos (e.g., un vendedor intentando acceder a la gestión de usuarios) y verifica que se muestra un error de acceso denegado.

## 3. Gestión de Cuentas
1.  Inicia sesión como administrador o vendedor.
2.  Ve a `views/manage_accounts.php`.
3.  Crea, edita y elimina una cuenta.
4.  Usa los filtros y la barra de búsqueda para verificar que funcionan correctamente.

## 4. Compras
1.  Inicia sesión como cliente.
2.  Ve a `views/catalog.php`.
3.  Añade productos al carrito.
4.  Ve a `views/cart.php` y verifica que los productos están allí.
5.  Aplica un cupón de descuento.
6.  Procede al pago con los diferentes métodos.
7.  Verifica que la compra aparece en `views/purchase_history.php`.
