CREATE TABLE usuarios (
    id_usuario INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR (255) NOT NULL,
    cargo VARCHAR (255) NOT NULL,
    email VARCHAR (255) NOT NULL UNIQUE KEY,
    contraseña TEXT NOT NULL,

    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR (11)
)ENGINE=InnoDB;
INSERT INTO usuarios (nombre,cargo,email,contraseña,fyh_creacion,estado) VALUES ('Juan Carlos','Administrador','juan@carlos.com','123456','2025-4-3 21:11:10','1')

CREATE TABLE roles (
    id_rol INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR (255) NOT NULL UNIQUE KEY,

    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR (11)
)ENGINE=InnoDB;
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES ('ADMINISTRADOR','2025-4-3 21:11:10','1');
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES ('TRABAJADOR','2025-4-3 21:11:10','1');