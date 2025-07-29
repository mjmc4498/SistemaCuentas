-- Definición del esquema de la base de datos

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'vendedor', 'cliente') NOT NULL,
    estado ENUM('activo', 'inactivo', 'suspendido') NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de cuentas de streaming
CREATE TABLE cuentas_streaming (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plataforma VARCHAR(50) NOT NULL,
    login VARCHAR(100) NOT NULL,
    tipo_cuenta VARCHAR(50) NOT NULL,
    estado ENUM('disponible', 'vendida', 'mantenimiento') NOT NULL,
    fecha_adquisicion DATE,
    id_usuario_propietario INT,
    FOREIGN KEY (id_usuario_propietario) REFERENCES usuarios(id)
);

-- Tabla de ventas
CREATE TABLE ventas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_cuenta INT NOT NULL,
    id_vendedor INT NOT NULL,
    id_cliente INT NOT NULL,
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    precio DECIMAL(10, 2) NOT NULL,
    metodo_pago VARCHAR(50),
    FOREIGN KEY (id_cuenta) REFERENCES cuentas_streaming(id),
    FOREIGN KEY (id_vendedor) REFERENCES usuarios(id),
    FOREIGN KEY (id_cliente) REFERENCES usuarios(id)
);

-- Tabla de permisos (si se necesita un control de acceso más granular)
CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_permiso VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de roles_permisos (tabla intermedia para la relación muchos a muchos entre roles y permisos)
CREATE TABLE roles_permisos (
    rol ENUM('admin', 'vendedor', 'cliente') NOT NULL,
    id_permiso INT NOT NULL,
    PRIMARY KEY (rol, id_permiso),
    FOREIGN KEY (id_permiso) REFERENCES permisos(id)
);

-- Tabla de logs para auditoría
CREATE TABLE logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    accion VARCHAR(255) NOT NULL,
    fecha_hora TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);
