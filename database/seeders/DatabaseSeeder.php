<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Event;
use App\Models\Team;
use App\Models\Project;
use App\Models\Rubric;
use App\Models\RubricCriterion;
use App\Models\Evaluation;
use App\Models\EventSchedule;
use App\Models\Achievement;
use App\Models\Notification;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        echo "🌱 Iniciando seed...\n\n";

        $estudiantes = $this->createEstudiantes();
        $maestros = $this->createMaestros();
        $jueces = $this->createJueces();
        $admin = $this->createAdmin();
        echo "✅ Usuarios: " . count($estudiantes) . " estudiantes, " . count($maestros) . " maestros, " . count($jueces) . " jueces\n\n";

        $eventos = $this->createEventos();
        echo "✅ Eventos: " . count($eventos) . "\n\n";

        foreach($eventos as $evento) {
            $this->createEventSchedule($evento);
        }
        echo "✅ Cronogramas creados\n\n";

        $equipos = $this->createTeams($eventos, $estudiantes);
        echo "✅ Equipos: " . count($equipos) . "\n\n";

        $proyectos = $this->createProjects($equipos, $eventos);
        echo "✅ Proyectos: " . count($proyectos) . "\n\n";

        $rubricas = [];
        foreach($eventos as $evento) {
            $rubricas[] = $this->createRubrics($evento);
        }
        echo "✅ Rúbricas: " . count($rubricas) . "\n\n";

        $this->createEvaluations($proyectos, $jueces, $rubricas[0]);
        echo "✅ Evaluaciones creadas\n\n";

        $logros = $this->createAchievements();
        $this->assignAchievements($estudiantes[0], $logros);
        echo "✅ Logros creados\n\n";

        $this->createNotifications($estudiantes);
        echo "✅ Notificaciones creadas\n\n";

        echo "🎉 ¡COMPLETADO!\n";
        echo "📧 Login: carlos1@estudiante.com / password123\n";
    }

    private function createEstudiantes()
    {
        $nombres = ['Carlos', 'Ana', 'Luis', 'María', 'José', 'Sofía', 'Diego', 'Laura', 'Pedro', 'Carmen', 
                    'Miguel', 'Isabel', 'Fernando', 'Gabriela', 'Roberto', 'Patricia', 'Antonio', 'Alejandra', 
                    'Jorge', 'Daniela', 'Ricardo', 'Valeria', 'Andrés', 'Camila', 'Javier'];
        
        $apellidos = ['Méndez', 'García', 'Hernández', 'López', 'Ramírez', 'Torres', 'Morales', 'Sánchez', 'Flores', 'Ruiz'];
        $carreras = ['Ing. en Sistemas', 'Ing. Industrial', 'Ing. en Electrónica', 'Ing. en Gestión'];
        
        $users = [];
        for ($i = 0; $i < 25; $i++) {
            $nombre = $nombres[$i] . ' ' . $apellidos[$i % count($apellidos)];
            $email = strtolower(str_replace(' ', '', $nombres[$i])) . ($i + 1) . '@estudiante.com';
            $numeroControl = '20' . sprintf('%06d', 211234 + $i);
            
            $users[] = User::create([
                'id' => Str::uuid(),
                'email' => $email,
                'password' => Hash::make('password123'),
                'name' => $nombre,
                'numero_control' => $numeroControl,
                'user_type' => 'estudiante',
                'career' => $carreras[$i % count($carreras)],
                'semester' => (($i % 4) + 5),
                'is_active' => true,
            ]);
        }
        return $users;
    }

    private function createMaestros()
    {
        return [
            User::create(['id' => Str::uuid(), 'email' => 'juan@maestro.com', 'password' => Hash::make('password123'), 'name' => 'Dr. Juan Pérez', 'numero_control' => '10001234', 'user_type' => 'maestro', 'is_active' => true]),
            User::create(['id' => Str::uuid(), 'email' => 'roberto@maestro.com', 'password' => Hash::make('password123'), 'name' => 'M.C. Roberto González', 'numero_control' => '10001235', 'user_type' => 'maestro', 'is_active' => true]),
            User::create(['id' => Str::uuid(), 'email' => 'gabriela@maestro.com', 'password' => Hash::make('password123'), 'name' => 'Dra. Gabriela Martínez', 'numero_control' => '10001236', 'user_type' => 'maestro', 'is_active' => true]),
        ];
    }

    private function createJueces()
    {
        return [
            User::create(['id' => Str::uuid(), 'email' => 'maria@juez.com', 'password' => Hash::make('password123'), 'name' => 'Ing. María García', 'numero_control' => '30001234', 'user_type' => 'juez', 'is_active' => true]),
            User::create(['id' => Str::uuid(), 'email' => 'fernando@juez.com', 'password' => Hash::make('password123'), 'name' => 'Dr. Fernando Jiménez', 'numero_control' => '30001235', 'user_type' => 'juez', 'is_active' => true]),
            User::create(['id' => Str::uuid(), 'email' => 'patricia@juez.com', 'password' => Hash::make('password123'), 'name' => 'M.C. Patricia Rodríguez', 'numero_control' => '30001236', 'user_type' => 'juez', 'is_active' => true]),
        ];
    }

    private function createAdmin()
    {
        return User::create(['id' => Str::uuid(), 'email' => 'admin@eventec.com', 'password' => Hash::make('admin123'), 'name' => 'Administrador', 'numero_control' => '99999999', 'user_type' => 'admin', 'is_active' => true]);
    }

    private function createEventos()
    {
        $eventos = [
            ['title' => 'Hackathon de Innovación 2024', 'slug' => 'hackathon-innovacion-2024', 'description' => 'Desarrolla soluciones tecnológicas innovadoras en 48 horas.', 'short_description' => 'Hackathon de 48 horas', 'category' => 'Tecnología', 'event_type' => 'hackathon', 'status' => 'finished', 'cover_image_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80', 'registration_start_date' => '2024-11-01', 'registration_end_date' => '2024-12-15', 'event_start_date' => '2024-12-20', 'event_end_date' => '2024-12-22', 'min_team_size' => 2, 'max_team_size' => 4, 'max_teams' => 30, 'registered_teams_count' => 0, 'location' => 'Auditorio Principal', 'organizer_name' => 'Dpto. Sistemas', 'contact_email' => 'hackathon@tecnm.mx', 'is_published' => true],
            ['title' => 'Feria de Ciencias 2025', 'slug' => 'feria-ciencias-2025', 'description' => 'Presenta tu proyecto científico.', 'short_description' => 'Feria científica', 'category' => 'Ciencias', 'event_type' => 'fair', 'status' => 'open', 'cover_image_url' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=1200&q=80', 'registration_start_date' => '2024-12-01', 'registration_end_date' => '2025-02-28', 'event_start_date' => '2025-03-19', 'event_end_date' => '2025-03-20', 'min_team_size' => 2, 'max_team_size' => 4, 'max_teams' => 25, 'registered_teams_count' => 0, 'location' => 'Plaza Central', 'organizer_name' => 'Ciencias Básicas', 'contact_email' => 'feria@tecnm.mx', 'is_published' => true],
            ['title' => 'Concurso de Robótica 2025', 'slug' => 'robotica-2025', 'description' => 'Competencia de robots autónomos.', 'short_description' => 'Competencia robótica', 'category' => 'Robótica', 'event_type' => 'competition', 'status' => 'open', 'cover_image_url' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=1200&q=80', 'registration_start_date' => '2025-01-01', 'registration_end_date' => '2025-03-15', 'event_start_date' => '2025-04-10', 'event_end_date' => '2025-04-12', 'min_team_size' => 2, 'max_team_size' => 4, 'max_teams' => 20, 'registered_teams_count' => 0, 'location' => 'Laboratorio de Robótica', 'organizer_name' => 'Club de Robótica', 'contact_email' => 'robotica@tecnm.mx', 'is_published' => true],
            ['title' => 'Startup Weekend 2025', 'slug' => 'startup-weekend-2025', 'description' => 'Crea tu startup en 54 horas.', 'short_description' => 'Emprendimiento intensivo', 'category' => 'Negocios', 'event_type' => 'workshop', 'status' => 'upcoming', 'cover_image_url' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=1200&q=80', 'registration_start_date' => '2025-02-01', 'registration_end_date' => '2025-04-20', 'event_start_date' => '2025-05-15', 'event_end_date' => '2025-05-17', 'min_team_size' => 2, 'max_team_size' => 4, 'max_teams' => 15, 'registered_teams_count' => 0, 'location' => 'Incubadora de Negocios', 'organizer_name' => 'Centro de Emprendimiento', 'contact_email' => 'startup@tecnm.mx', 'is_published' => true],
            ['title' => 'IoT Challenge 2025', 'slug' => 'iot-challenge-2025', 'description' => 'Soluciones IoT para ciudades inteligentes.', 'short_description' => 'Desafío IoT', 'category' => 'Tecnología', 'event_type' => 'hackathon', 'status' => 'open', 'cover_image_url' => 'https://images.unsplash.com/photo-1558346490-a72e53ae2d4f?w=1200&q=80', 'registration_start_date' => '2025-01-15', 'registration_end_date' => '2025-03-30', 'event_start_date' => '2025-04-25', 'event_end_date' => '2025-04-27', 'min_team_size' => 2, 'max_team_size' => 4, 'max_teams' => 20, 'registered_teams_count' => 0, 'location' => 'Lab. Redes', 'organizer_name' => 'Dpto. Electrónica', 'contact_email' => 'iot@tecnm.mx', 'is_published' => true],
        ];

        return array_map(fn($e) => Event::create(array_merge(['id' => Str::uuid()], $e)), $eventos);
    }

    private function createEventSchedule($event)
    {
        EventSchedule::create(['id' => Str::uuid(), 'event_id' => $event->id, 'day' => 1, 'title' => 'Registro', 'description' => 'Llegada de participantes', 'start_time' => '09:00', 'end_time' => '10:00', 'order_index' => 1]);
    }

    private function createTeams($eventos, $estudiantes)
    {
        $nombres = ['Tech Innovators', 'Code Warriors', 'Digital Pioneers', 'Smart Solutions', 'Cyber Ninjas', 'Data Wizards', 'Cloud Masters', 'AI Builders', 'Future Coders', 'Quantum Leap', 'Byte Force', 'Logic Lords', 'Dev Dragons', 'Script Sages', 'Pixel Perfect', 'Algorithm Aces', 'Binary Beasts'];
        
        $equipos = [];
        $idx = 0;

        // 12 equipos para Hackathon
        for ($i = 0; $i < 12 && $idx < 24; $i++) {
            $teamId = Str::uuid();
            $team = Team::create(['id' => $teamId, 'name' => $nombres[$i], 'description' => 'Equipo innovador', 'event_id' => $eventos[0]->id, 'leader_id' => $estudiantes[$idx]->id, 'status' => 'active', 'invitation_code' => strtoupper(substr(md5($teamId), 0, 6)), 'members_count' => 2]);
            
            DB::table('team_members')->insert([
                ['id' => Str::uuid(), 'team_id' => $teamId, 'user_id' => $estudiantes[$idx]->id, 'role' => 'leader', 'joined_at' => now()],
                ['id' => Str::uuid(), 'team_id' => $teamId, 'user_id' => $estudiantes[$idx + 1]->id, 'role' => 'member', 'joined_at' => now()],
            ]);
            
            $eventos[0]->increment('registered_teams_count');
            $equipos[] = $team;
            $idx += 2;
        }

        // 5 equipos para Feria
        for ($i = 12; $i < 17 && $i < count($nombres); $i++) {
            $teamId = Str::uuid();
            $team = Team::create(['id' => $teamId, 'name' => $nombres[$i], 'description' => 'Equipo científico', 'event_id' => $eventos[1]->id, 'leader_id' => $estudiantes[$i - 12]->id, 'status' => 'active', 'invitation_code' => strtoupper(substr(md5($teamId), 0, 6)), 'members_count' => 2]);
            
            DB::table('team_members')->insert([
                ['id' => Str::uuid(), 'team_id' => $teamId, 'user_id' => $estudiantes[$i - 12]->id, 'role' => 'leader', 'joined_at' => now()],
                ['id' => Str::uuid(), 'team_id' => $teamId, 'user_id' => $estudiantes[$i - 11]->id, 'role' => 'member', 'joined_at' => now()],
            ]);
            
            $eventos[1]->increment('registered_teams_count');
            $equipos[] = $team;
        }

        return $equipos;
    }

    private function createProjects($equipos, $eventos)
    {
        $nombres = [['EcoTrack', 'Sistema de monitoreo ambiental'], ['SmartHealth', 'Telemedicina con IA'], ['EduConnect', 'Red social educativa'], ['AgriBot', 'Robot para agricultura'], ['CleanEnergy', 'Gestión energética solar'], ['SafeCity', 'Seguridad ciudadana'], ['FoodRescue', 'Contra desperdicio'], ['WaterSense', 'Calidad del agua'], ['MobiPark', 'Estacionamientos inteligentes'], ['RecycleAI', 'Clasificador reciclaje'], ['HealthMonitor', 'Monitoreo médico'], ['SmartFarm', 'Riego inteligente']];
        
        $proyectos = [];
        $idx = 0;
        
        foreach ($equipos as $equipo) {
            if ($equipo->event_id !== $eventos[0]->id || $idx >= count($nombres)) continue;
            
            $score = round(rand(700, 980) / 10, 1);
            $proyectos[] = Project::create(['id' => Str::uuid(), 'team_id' => $equipo->id, 'event_id' => $equipo->event_id, 'title' => $nombres[$idx][0], 'description' => $nombres[$idx][1], 'repository_url' => 'https://github.com/' . strtolower($nombres[$idx][0]), 'demo_url' => 'https://' . strtolower($nombres[$idx][0]) . '.demo.com', 'status' => 'evaluated', 'final_score' => $score, 'rank' => null]);
            $idx++;
        }

        foreach (collect($proyectos)->sortByDesc('final_score')->values() as $i => $p) {
            $p->update(['rank' => $i + 1]);
        }

        return $proyectos;
    }

    private function createRubrics($event)
    {
        $rubric = Rubric::create(['id' => Str::uuid(), 'event_id' => $event->id, 'name' => 'Rúbrica ' . $event->title, 'total_points' => 100, 'is_active' => true]);
        RubricCriterion::create(['id' => Str::uuid(), 'rubric_id' => $rubric->id, 'name' => 'Innovación', 'max_points' => 25, 'order_index' => 1]);
        return $rubric;
    }

    private function createEvaluations($proyectos, $jueces, $rubric)
    {
        foreach ($proyectos as $p) {
            if ($p->status === 'evaluated') {
                Evaluation::create(['id' => Str::uuid(), 'project_id' => $p->id, 'judge_id' => $jueces[0]->id, 'rubric_id' => $rubric->id, 'total_score' => $p->final_score, 'status' => 'completed', 'completed_at' => now()]);
            }
        }
    }

    private function createAchievements()
    {
        return [
            Achievement::create(['id' => Str::uuid(), 'name' => 'Primer Proyecto', 'icon' => 'trophy', 'points' => 10]),
            Achievement::create(['id' => Str::uuid(), 'name' => 'Ganador', 'icon' => 'star', 'points' => 50]),
        ];
    }

    private function assignAchievements($user, $achievements)
    {
        DB::table('user_achievements')->insert(['id' => Str::uuid(), 'user_id' => $user->id, 'achievement_id' => $achievements[1]->id, 'earned_at' => now()]);
    }

    private function createNotifications($estudiantes)
    {
        Notification::create(['id' => Str::uuid(), 'user_id' => $estudiantes[0]->id, 'type' => 'test', 'title' => 'Bienvenido', 'message' => 'Bienvenido al sistema', 'is_read' => false]);
    }
}
