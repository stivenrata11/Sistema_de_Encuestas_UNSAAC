/*TABLA ROLES*/
CREATE TABLE roles (
    id_rol INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR (255) NOT NULL UNIQUE KEY,

    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR (11)
)ENGINE=InnoDB;
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES ('DIRECTOR','2025-4-3 21:11:10','1');
INSERT INTO roles (nombre_rol,fyh_creacion,estado) VALUES ('TRABAJADOR','2025-4-3 21:11:10','1');


/*TABLA USUARIOS*/
CREATE TABLE usuarios (
    id_usuario INT (11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombres VARCHAR (255) NOT NULL,
    rol_id INT (11) NOT NULL,
    email VARCHAR (255) NOT NULL UNIQUE KEY,
    password TEXT NOT NULL,

    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR (11)

    FOREIGN KEY (rol_id) REFERENCES roles(id_rol) on delete no action on update cascade 
)ENGINE=InnoDB;
INSERT INTO usuarios (nombres,rol_id,email,password,fyh_creacion,estado) VALUES ('Juan Carlos','1','juan@carlos.com','123456','2025-4-3 21:11:10','1')


/*TABLA FACULTADES*/
CREATE TABLE facultades (
    id_facultad INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_facultad VARCHAR(255) NOT NULL UNIQUE KEY,
    codigo_facultad VARCHAR(50) NOT NULL UNIQUE KEY,
    
    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR(11)
)ENGINE=InnoDB;

/*INSERTS DE EJEMPLO*/
INSERT INTO facultades (nombre_facultad, codigo_facultad, fyh_creacion, estado)
VALUES 
('Facultad de Ingeniería', 'FI001', '2025-04-03 21:11:10', '1');

INSERT INTO facultades (nombre_facultad, codigo_facultad, fyh_creacion, estado)
VALUES 
('Facultad de Ciencias', 'FC001', '2025-04-03 21:11:10', '1');


/*TABLA ESCUELAS PROFESIONALES*/
CREATE TABLE escuelas (
    id_escuela INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_escuela VARCHAR(255) NOT NULL,
    codigo_escuela VARCHAR(50) NOT NULL,
    facultad_id INT(11) NOT NULL,

    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR(11),

    FOREIGN KEY (facultad_id) REFERENCES facultades(id_facultad) 
        ON DELETE NO ACTION 
        ON UPDATE CASCADE
)ENGINE=InnoDB;

/*INSERTS DE EJEMPLO*/
INSERT INTO escuelas (nombre_escuela, codigo_escuela, facultad_id, fyh_creacion, estado)
VALUES 
('Ingeniería de Sistemas', 'IS001', 1, '2025-04-03 21:11:10', '1');

INSERT INTO escuelas (nombre_escuela, codigo_escuela, facultad_id, fyh_creacion, estado)
VALUES 
('Ingeniería Civil', 'IC001', 1, '2025-04-03 21:11:10', '1');

INSERT INTO escuelas (nombre_escuela, codigo_escuela, facultad_id, fyh_creacion, estado)
VALUES 
('Matemáticas', 'MA001', 2, '2025-04-03 21:11:10', '1');

INSERT INTO escuelas (nombre_escuela, codigo_escuela, facultad_id, fyh_creacion, estado)
VALUES 
('Física', 'FI001', 2, '2025-04-03 21:11:10', '1');


/*TABLA FORMATOS DE ENCUESTAS RELACIONADA CON ESCUELAS*/
CREATE TABLE encuestas (
    id_encuestas INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    escuela_id INT(11) NOT NULL, -- Relacionada con la escuela profesional
    nombre VARCHAR(255) NOT NULL,
    tipo VARCHAR(50) NOT NULL, -- Ej: PDF, DOCX, XLSX, GOOGLE_FORM
    url TEXT NOT NULL, -- Ruta del archivo o link del formulario
    observaciones TEXT,

    fyh_creacion DATETIME NULL,
    fyh_actualizacion DATETIME NULL,
    estado VARCHAR(11),

    FOREIGN KEY (escuela_id) REFERENCES escuelas(id_escuela)
        ON DELETE NO ACTION
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- Formato en PDF para Ingeniería de Sistemas
INSERT INTO encuestas (
    escuela_id, nombre, tipo, url, observaciones, fyh_creacion, estado
) VALUES (
    1, 'Formato de Encuesta Académica', 'PDF', '/uploads/formatos/IS2025.pdf',
    'Formato oficial aprobado por la facultad', '2025-04-14 12:00:00', '1'
);

-- Google Forms para Ingeniería Civil
INSERT INTO encuestas (
    escuela_id, nombre, tipo, url, observaciones, fyh_creacion, estado
) VALUES (
    2, 'Formulario Google Forms Infraestructura', 'GOOGLE_FORM', 'https://forms.gle/infraestructuraIC2025',
    'Link creado por el área de infraestructura', '2025-04-14 12:10:00', '1'
);
