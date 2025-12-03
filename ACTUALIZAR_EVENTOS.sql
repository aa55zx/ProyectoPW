-- Script para actualizar las fechas de eventos existentes
UPDATE events SET 
    registration_start_date = date('now', '-60 days'),
    registration_end_date = date('now', '-35 days'),
    event_start_date = date('now', '-30 days'),
    event_end_date = date('now', '-28 days'),
    description = 'Desarrolla soluciones tecnológicas innovadoras en 48 horas. Trabaja en equipo para crear prototipos funcionales que resuelvan problemas reales.',
    location = 'Auditorio Principal - Instituto Tecnológico',
    organizer_name = 'Departamento de Sistemas Computacionales'
WHERE slug = 'hackathon-innovacion-2024';

UPDATE events SET 
    registration_start_date = date('now', '-10 days'),
    registration_end_date = date('now', '+30 days'),
    event_start_date = date('now', '+45 days'),
    event_end_date = date('now', '+46 days'),
    description = 'Presenta tu proyecto científico y compite con las mejores mentes del instituto. Categorías: Física, Química, Biología e Ingeniería.',
    short_description = 'Feria científica anual',
    location = 'Plaza Central y Laboratorios',
    organizer_name = 'División de Ciencias Básicas'
WHERE slug = 'feria-ciencias-2025';

UPDATE events SET 
    registration_start_date = date('now', '-5 days'),
    registration_end_date = date('now', '+25 days'),
    event_start_date = date('now', '+35 days'),
    event_end_date = date('now', '+37 days'),
    description = 'Competencia de robots autónomos. Demuestra tus habilidades en programación, electrónica y diseño mecánico.',
    short_description = 'Competencia robótica',
    location = 'Laboratorio de Robótica e Inteligencia Artificial',
    organizer_name = 'Club de Robótica - Mecatrónica'
WHERE slug = 'robotica-2025';

UPDATE events SET 
    registration_start_date = date('now', '+15 days'),
    registration_end_date = date('now', '+60 days'),
    event_start_date = date('now', '+75 days'),
    event_end_date = date('now', '+77 days'),
    description = 'Crea tu startup en 54 horas. Aprende sobre modelo de negocios, pitch, prototipado rápido y desarrollo de productos mínimos viables.',
    short_description = 'Emprendimiento intensivo',
    location = 'Incubadora de Negocios y Centro de Innovación',
    organizer_name = 'Centro de Emprendimiento e Innovación'
WHERE slug = 'startup-weekend-2025';

UPDATE events SET 
    registration_start_date = date('now', '-3 days'),
    registration_end_date = date('now', '+20 days'),
    event_start_date = date('now', '+28 days'),
    event_end_date = date('now', '+30 days'),
    description = 'Desarrolla soluciones IoT para ciudades inteligentes. Conecta dispositivos y crea sistemas innovadores para mejorar la calidad de vida urbana.',
    short_description = 'Desafío IoT',
    location = 'Laboratorio de Redes y Comunicaciones',
    organizer_name = 'Departamento de Ingeniería Electrónica',
    registered_teams_count = 1
WHERE slug = 'iot-challenge-2025';
