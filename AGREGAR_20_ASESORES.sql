-- Script para agregar 20 asesores a la base de datos
-- Ejecutar en Supabase SQL Editor o phpMyAdmin

INSERT INTO users (id, name, email, password, user_type, role, created_at, updated_at) VALUES
(gen_random_uuid(), 'Dr. Miguel Ángel Torres Ramírez', 'miguel.torres@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dra. Ana Patricia Hernández López', 'ana.hernandez@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Mtro. José Luis García Martínez', 'jose.garcia@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dra. Laura Elena Rodríguez Sánchez', 'laura.rodriguez@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dr. Roberto Carlos Díaz Pérez', 'roberto.diaz@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Mtra. María Fernanda Morales Cruz', 'maria.morales@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dr. Fernando Javier Ruiz Flores', 'fernando.ruiz@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dra. Gabriela Alejandra Méndez Castillo', 'gabriela.mendez@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Mtro. Daniel Arturo Jiménez Ramos', 'daniel.jimenez@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dra. Claudia Verónica Castro Delgado', 'claudia.castro@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dr. Héctor Manuel Ríos Ortega', 'hector.rios@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Mtra. Sofía Isabel Vargas Gutiérrez', 'sofia.vargas@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dr. Armando Javier Romero Silva', 'armando.romero@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dra. Patricia Guadalupe Salazar Méndez', 'patricia.salazar@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Mtro. Ricardo Enrique Navarro Vega', 'ricardo.navarro@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dra. Mónica Beatriz Reyes Aguilar', 'monica.reyes@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dr. Sergio Alberto Campos Martínez', 'sergio.campos@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Mtra. Diana Carolina Vázquez Pérez', 'diana.vazquez@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dr. Gustavo Adolfo Mendoza Juárez', 'gustavo.mendoza@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW()),
(gen_random_uuid(), 'Dra. Adriana Lizeth Fuentes Rojas', 'adriana.fuentes@maestro.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'maestro', 'asesor', NOW(), NOW());

-- Contraseña para todos los asesores: password
-- Pueden iniciar sesión con cualquier email de arriba y la contraseña: password
