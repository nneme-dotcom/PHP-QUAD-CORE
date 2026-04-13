-- =====================================================================
-- ReparaYa - Esquema completo
-- Grupo: PHP QUAD-CORE
-- Base original: bbddReparaYa.sql proporcionada por el consultor
-- Ampliaciones documentadas:
--   * usuarios.apellidos             -> separar nombre/apellidos para perfil
--   * incidencias.franja_horaria     -> manana | tarde
--   * incidencias.telefono_contacto  -> requerido por el enunciado
--   * incidencias.fecha_actualizacion -> trazabilidad
-- =====================================================================

DROP TABLE IF EXISTS incidencias;
DROP TABLE IF EXISTS tecnicos;
DROP TABLE IF EXISTS especialidades;
DROP TABLE IF EXISTS usuarios;

-- 1. USUARIOS
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(150) DEFAULT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- password_hash() de PHP
    rol ENUM('admin', 'tecnico', 'particular') NOT NULL DEFAULT 'particular',
    telefono VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. ESPECIALIDADES
CREATE TABLE especialidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_especialidad VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. TÉCNICOS
CREATE TABLE tecnicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT UNIQUE,
    nombre_completo VARCHAR(100) NOT NULL,
    especialidad_id INT,
    disponible BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL,
    FOREIGN KEY (especialidad_id) REFERENCES especialidades(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. INCIDENCIAS
CREATE TABLE incidencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    localizador VARCHAR(16) NOT NULL UNIQUE,
    cliente_id INT NOT NULL,
    tecnico_id INT DEFAULT NULL,
    especialidad_id INT NOT NULL,
    descripcion TEXT NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono_contacto VARCHAR(20) NOT NULL,
    fecha_servicio DATETIME NOT NULL,
    franja_horaria ENUM('manana','tarde') NOT NULL DEFAULT 'manana',
    tipo_urgencia ENUM('Estandar','Urgente') NOT NULL DEFAULT 'Estandar',
    estado ENUM('Pendiente','Asignada','Finalizada','Cancelada') NOT NULL DEFAULT 'Pendiente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES usuarios(id),
    FOREIGN KEY (tecnico_id) REFERENCES tecnicos(id) ON DELETE SET NULL,
    FOREIGN KEY (especialidad_id) REFERENCES especialidades(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================================
-- DATOS DE EJEMPLO (seeds)
-- =====================================================================

INSERT INTO especialidades (nombre_especialidad) VALUES
('Fontaneria'),
('Electricidad'),
('Cerrajeria'),
('Climatizacion'),
('Carpinteria');

-- Contraseñas de ejemplo: todas son "reparaya123"
-- Hash generado con password_hash('reparaya123', PASSWORD_DEFAULT)
INSERT INTO usuarios (nombre, apellidos, email, password, rol, telefono) VALUES
('Admin', 'ReparaYa',     'admin@reparaya.test',   '$2y$10$8K1p/a0dRh1.mF3WJJ4n4uX5kQv7HnG6L5WJh9q1xGz3yN0qPmJZi', 'admin',      '600000001'),
('Carlos','Tecnico Uno',  'carlos@reparaya.test',  '$2y$10$8K1p/a0dRh1.mF3WJJ4n4uX5kQv7HnG6L5WJh9q1xGz3yN0qPmJZi', 'tecnico',    '600000002'),
('Lucia', 'Tecnica Dos',  'lucia@reparaya.test',   '$2y$10$8K1p/a0dRh1.mF3WJJ4n4uX5kQv7HnG6L5WJh9q1xGz3yN0qPmJZi', 'tecnico',    '600000003'),
('Maria', 'Cliente Uno',  'maria@cliente.test',    '$2y$10$8K1p/a0dRh1.mF3WJJ4n4uX5kQv7HnG6L5WJh9q1xGz3yN0qPmJZi', 'particular', '600000004'),
('Pedro', 'Cliente Dos',  'pedro@cliente.test',    '$2y$10$8K1p/a0dRh1.mF3WJJ4n4uX5kQv7HnG6L5WJh9q1xGz3yN0qPmJZi', 'particular', '600000005');

INSERT INTO tecnicos (usuario_id, nombre_completo, especialidad_id, disponible) VALUES
(2, 'Carlos Tecnico Uno', 1, TRUE),
(3, 'Lucia Tecnica Dos',  2, TRUE);

INSERT INTO incidencias (localizador, cliente_id, tecnico_id, especialidad_id, descripcion, direccion, telefono_contacto, fecha_servicio, franja_horaria, tipo_urgencia, estado) VALUES
('REP-2026-0001', 4, 1, 1, 'Fuga en el grifo de la cocina',              'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 3 DAY),  'manana', 'Estandar', 'Asignada'),
('REP-2026-0002', 5, NULL, 2, 'Cuadro electrico saltando sin parar',    'Av. Diagonal 45, Barcelona',    '600000005', DATE_ADD(NOW(), INTERVAL 1 DAY),  'tarde',  'Urgente',  'Pendiente'),
('REP-2026-0003', 4, 2, 2, 'Enchufe del salon sin corriente',           'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 5 DAY),  'tarde',  'Estandar', 'Asignada'),
('REP-2026-0004', 5, 1, 1, 'Tuberia de agua caliente rota',             'Av. Diagonal 45, Barcelona',    '600000005', DATE_ADD(NOW(), INTERVAL 2 DAY),  'manana', 'Urgente',  'Asignada'),
('REP-2026-0005', 4, NULL, 3, 'Cerradura principal atascada',           'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 7 DAY),  'tarde',  'Estandar', 'Pendiente'),
('REP-2026-0006', 5, 2, 4, 'Aire acondicionado no enfria',              'Av. Diagonal 45, Barcelona',    '600000005', DATE_ADD(NOW(), INTERVAL 4 DAY),  'manana', 'Estandar', 'Asignada'),
('REP-2026-0007', 4, 1, 5, 'Puerta de armario descuadrada',             'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 6 DAY),  'tarde',  'Estandar', 'Pendiente'),
('REP-2026-0008', 5, 2, 1, 'Cambiar sanitarios del bano',               'Av. Diagonal 45, Barcelona',    '600000005', DATE_ADD(NOW() - INTERVAL 3 DAY), 'manana', 'Estandar', 'Finalizada'),
('REP-2026-0009', 4, NULL, 2, 'Revision seguridad electrica',            'C/ Mayor 12, Madrid',           '600000004', DATE_ADD(NOW(), INTERVAL 10 DAY), 'tarde',  'Urgente',  'Pendiente'),
('REP-2026-0010', 5, 1, 3, 'Instalar nuevas cerraduras inteligentes',   'Av. Diagonal 45, Barcelona',    '600000005', DATE_ADD(NOW() - INTERVAL 1 DAY), 'manana', 'Estandar', 'Finalizada');

-- Nota: como los hashes incluidos son ejemplos, ejecuta también este UPDATE
-- desde un script PHP local para regenerarlos con password_hash() real:
--   php sql/seed_passwords.php
