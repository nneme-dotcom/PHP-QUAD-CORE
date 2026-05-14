-- ReparaYa - base de datos producto 2 (PHP-MVC)
-- Grupo PHP QUAD-CORE
-- Ampliaciones respecto a la base del consultor:
--   usuarios.apellidos, incidencias.franja_horaria, incidencias.telefono_contacto

DROP TABLE IF EXISTS incidencias;
DROP TABLE IF EXISTS tecnicos;
DROP TABLE IF EXISTS especialidades;
DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS gestoras;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) DEFAULT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'tecnico', 'particular', 'gestora', 'comunidad') NOT NULL DEFAULT 'particular',
    telefono VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE especialidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_especialidad VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tecnicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNIQUE,
    nombre_completo VARCHAR(100) NOT NULL,
    especialidad_id INT,
    disponible BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (especialidad_id) REFERENCES especialidades(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE gestoras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) DEFAULT NULL,
    telefono VARCHAR(20) DEFAULT NULL,
    comision_acumulada DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE incidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    localizador VARCHAR(16) NOT NULL UNIQUE,
    cliente_id INT NOT NULL,
    tecnico_id INT DEFAULT NULL,
    especialidad_id INT NOT NULL,
    gestora_id INT DEFAULT NULL,
    descripcion TEXT NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono_contacto VARCHAR(20) NOT NULL,
    fecha_servicio DATETIME NOT NULL,
    franja_horaria ENUM('manana','tarde') NOT NULL DEFAULT 'manana',
    tipo_urgencia ENUM('Estandar','Urgente') NOT NULL DEFAULT 'Estandar',
    precio_base DECIMAL(10, 2) DEFAULT NULL,
    comision DECIMAL(10, 2) DEFAULT NULL,
    estado ENUM('Pendiente','Asignada','Finalizada','Cancelada') NOT NULL DEFAULT 'Pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES usuarios(id),
    FOREIGN KEY (tecnico_id) REFERENCES tecnicos(id) ON DELETE SET NULL,
    FOREIGN KEY (especialidad_id) REFERENCES especialidades(id),
    FOREIGN KEY (gestora_id) REFERENCES gestoras(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos de prueba

INSERT INTO especialidades (nombre_especialidad) VALUES
('Fontaneria'),
('Electricidad'),
('Cerrajeria'),
('Climatizacion'),
('Carpinteria');

-- contraseña de todos los usuarios de prueba: reparaya123
INSERT INTO usuarios (nombre, apellidos, email, password, rol, telefono) VALUES
('Admin', 'ReparaYa',     'admin@reparaya.test',   '$2y$12$Z./sS3nHOBFQFnCVzaxqEuRszsMPJ.WZkvsYaXfpVvEW8O8pd/.Fa', 'admin',      '600000001'),
('Carlos','Tecnico Uno',  'carlos@reparaya.test',  '$2y$12$Z./sS3nHOBFQFnCVzaxqEuRszsMPJ.WZkvsYaXfpVvEW8O8pd/.Fa', 'tecnico',    '600000002'),
('Lucia', 'Tecnica Dos',  'lucia@reparaya.test',   '$2y$12$Z./sS3nHOBFQFnCVzaxqEuRszsMPJ.WZkvsYaXfpVvEW8O8pd/.Fa', 'tecnico',    '600000003'),
('Maria', 'Cliente Uno',  'maria@cliente.test',    '$2y$12$Z./sS3nHOBFQFnCVzaxqEuRszsMPJ.WZkvsYaXfpVvEW8O8pd/.Fa', 'particular', '600000004'),
('Pedro', 'Cliente Dos',  'pedro@cliente.test',    '$2y$12$Z./sS3nHOBFQFnCVzaxqEuRszsMPJ.WZkvsYaXfpVvEW8O8pd/.Fa', 'particular', '600000005'),
('Gestora', 'UNO',        'gestora@cliente.test',  '$2y$12$Z./sS3nHOBFQFnCVzaxqEuRszsMPJ.WZkvsYaXfpVvEW8O8pd/.Fa', 'gestora',    '600000006'),
('Comunidad', 'dos',      'comunidad@cliente.test','$2y$12$Z./sS3nHOBFQFnCVzaxqEuRszsMPJ.WZkvsYaXfpVvEW8O8pd/.Fa', 'comunidad',  '600000007');

INSERT INTO tecnicos (usuario_id, nombre_completo, especialidad_id, disponible) VALUES
(2, 'Carlos Tecnico Uno', 1, TRUE),
(3, 'Lucia Tecnica Dos',  2, TRUE);

INSERT INTO gestoras (nombre, email, telefono, comision_acumulada) VALUES
('Seguros HogarPlus', 'hogar@mail.com', '600000001', 100.00),
('Mantenimientos Express', 'mantenimiento@mail.com', '600000002', 200.00),
('Asistencia Global', 'asistencia@mail.com', '600000003', 300.00);

INSERT INTO incidencias (localizador, cliente_id, tecnico_id, especialidad_id, descripcion, direccion, telefono_contacto, fecha_servicio, franja_horaria, tipo_urgencia, estado) VALUES
('REP-2026-0001', 4, 1, 1, 'Fuga en el grifo de la cocina',              'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 3 DAY),  'manana', 'Estandar', 'Asignada'),
('REP-2026-0002', 5, NULL, 2, 'Cuadro electrico saltando sin parar',    'Av. Diagonal 45, Barcelona',    '600000005', DATE_ADD(NOW(), INTERVAL 1 DAY),  'tarde',  'Urgente',  'Pendiente'),
('REP-2026-0003', 4, 2, 2, 'Enchufe del salon sin corriente',           'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 5 DAY),  'tarde',  'Estandar', 'Asignada'),
('REP-2026-0004', 5, 1, 1, 'Tuberia de agua caliente rota',             'Av. Diagonal 45, Barcelona',    '600000005', DATE_ADD(NOW(), INTERVAL 2 DAY),  'manana', 'Urgente',  'Asignada'),
('REP-2026-0005', 4, NULL, 3, 'Cerradura principal atascada',           'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 7 DAY),  'tarde',  'Estandar', 'Pendiente'),
('REP-2026-0006', 5, 2, 4, 'Aire acondicionado no enfria',              'Av. Diagonal 45, Barcelona',    '600000005', DATE_ADD(NOW(), INTERVAL 4 DAY),  'manana', 'Estandar', 'Asignada'),
('REP-2026-0007', 4, 1, 5, 'Puerta de armario descuadrada',             'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 6 DAY),  'tarde',  'Estandar', 'Pendiente'),
('REP-2026-0008', 5, 2, 1, 'Cambiar sanitarios del bano',               'Av. Diagonal 45, Barcelona',    '600000005', DATE_SUB(NOW(), INTERVAL 3 DAY),  'manana', 'Estandar', 'Finalizada'),
('REP-2026-0009', 4, NULL, 2, 'Revision seguridad electrica',            'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 10 DAY), 'tarde',  'Urgente',  'Pendiente'),
('REP-2026-0010', 5, 1, 3, 'Instalar nuevas cerraduras inteligentes',   'Av. Diagonal 45, Barcelona',    '600000005', DATE_SUB(NOW(), INTERVAL 1 DAY),  'manana', 'Estandar', 'Finalizada');

-- Incidencia de gestora
INSERT INTO incidencias (localizador, cliente_id, tecnico_id, especialidad_id, gestora_id, descripcion, direccion, telefono_contacto, fecha_servicio, franja_horaria, tipo_urgencia, estado) VALUES
('REP-2026-0011', 4, NULL, 1, 1, 'Inundación por rotura de bajante principal', 'C/ Mayor 12, Madrid', '600000004', DATE_ADD(NOW(), INTERVAL 1 DAY), 'manana', 'Urgente', 'Pendiente');
