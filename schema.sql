-- Definición del esquema de la base de datos

-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'vendedor', 'cliente') NOT NULL,
    estado ENUM('activo', 'inactivo', 'suspendido') NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    password_reset_token VARCHAR(255) DEFAULT NULL,
    token_expiration DATETIME DEFAULT NULL,
    referrer_id INT DEFAULT NULL,
    referral_code VARCHAR(10) UNIQUE
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
    nombre_permiso VARCHAR(50) NOT NULL UNIQUE,
    descripcion VARCHAR(255)
);

-- Tabla de roles_permisos (tabla intermedia para la relación muchos a muchos entre roles y permisos)
CREATE TABLE roles_permisos (
    rol ENUM('admin', 'vendedor', 'cliente') NOT NULL,
    id_permiso INT NOT NULL,
    PRIMARY KEY (rol, id_permiso),
    FOREIGN KEY (id_permiso) REFERENCES permisos(id)
);

-- Tabla de usuario_permisos (para permisos específicos de usuario que sobreescriben los del rol)
CREATE TABLE usuario_permisos (
    id_usuario INT NOT NULL,
    id_permiso INT NOT NULL,
    PRIMARY KEY (id_usuario, id_permiso),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id),
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

-- Tabla de compras
CREATE TABLE compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_usuario INT NOT NULL,
    fecha_compra TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_venta) REFERENCES ventas(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Tabla de cupones
CREATE TABLE cupones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(50) NOT NULL UNIQUE,
    tipo_descuento ENUM('porcentaje', 'fijo') NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    fecha_expiracion DATE,
    usos_maximos INT,
    usos_actuales INT DEFAULT 0
);
