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
        echo "✅ Usuarios creados\n\n";

        $eventos = $this->createEventos();
        echo "✅ Eventos creados\n\n";

        $this->createEventSchedule($eventos[0]);
        echo "✅ Cronograma creado\n\n";

        $equipos = $this->createTeams($eventos, $estudiantes);
        echo "✅ Equipos creados\n\n";

        $proyectos = $this->createProjects($equipos, $eventos);
        echo "✅ Proyectos creados\n\n";

        $rubrica = $this->createRubrics($eventos[0]);
        echo "✅ Rúbricas creadas\n\n";

        $this->createEvaluations($proyectos[0], $jueces[0], $rubrica);
        echo "✅ Evaluaciones creadas\n\n";

        $logros = $this->createAchievements();
        $this->assignAchievements($estudiantes[0], $logros);
        echo "✅ Logros creados\n\n";

        $this->createNotifications($estudiantes);
        echo "✅ Notificaciones creadas\n\n";

        echo "✨ ¡Seed completado!\n";
        echo "📧 Login: carlos@estudiante.com / password123\n";
    }

    private function createEstudiantes()
    {
        $data = [
            ['carlos@estudiante.com', 'Carlos Méndez', '20211234', 'Ing. en Sistemas', 6],
            ['ana@estudiante.com', 'Ana García', '20211235', 'Ing. en Sistemas', 6],
            ['luis@estudiante.com', 'Luis Hernández', '20211236', 'Ing. Industrial', 5],
            ['maria@estudiante.com', 'María López', '20211237', 'Ing. en Electrónica', 7],
            ['jose@estudiante.com', 'José Ramírez', '20211238', 'Ing. en Sistemas', 6],
            ['sofia@estudiante.com', 'Sofía Torres', '20211239', 'Ing. Industrial', 5],
            ['diego@estudiante.com', 'Diego Morales', '20211240', 'Ing. en Gestión', 4],
            ['laura@estudiante.com', 'Laura Sánchez', '20211241', 'Ing. en Sistemas', 8],
            ['pedro@estudiante.com', 'Pedro Flores', '20211242', 'Ing. en Electrónica', 6],
            ['carmen@estudiante.com', 'Carmen Ruiz', '20211243', 'Ing. en Gestión', 5],
        ];

        $users = [];
        foreach ($data as $d) {
            $users[] = User::create([
                'id' => Str::uuid(),
                'email' => $d[0],
                'password' => Hash::make('password123'),
                'name' => $d[1],
                'numero_control' => $d[2],
                'user_type' => 'estudiante',
                'career' => $d[3],
                'semester' => $d[4],
                'is_active' => true,
            ]);
        }
        return $users;
    }

    private function createMaestros()
    {
        $data = [
            ['juan@maestro.com', 'Dr. Juan Pérez', '10001234'],
            ['roberto@maestro.com', 'M.C. Roberto González', '10001235'],
            ['gabriela@maestro.com', 'Dra. Gabriela Martínez', '10001236'],
        ];

        $users = [];
        foreach ($data as $d) {
            $users[] = User::create([
                'id' => Str::uuid(),
                'email' => $d[0],
                'password' => Hash::make('password123'),
                'name' => $d[1],
                'numero_control' => $d[2],
                'user_type' => 'maestro',
                'is_active' => true,
            ]);
        }
        return $users;
    }

    private function createJueces()
    {
        $data = [
            ['maria@juez.com', 'Ing. María García', '30001234'],
            ['fernando@juez.com', 'Dr. Fernando Jiménez', '30001235'],
            ['patricia@juez.com', 'M.C. Patricia Rodríguez', '30001236'],
        ];

        $users = [];
        foreach ($data as $d) {
            $users[] = User::create([
                'id' => Str::uuid(),
                'email' => $d[0],
                'password' => Hash::make('password123'),
                'name' => $d[1],
                'numero_control' => $d[2],
                'user_type' => 'juez',
                'is_active' => true,
            ]);
        }
        return $users;
    }

    private function createAdmin()
    {
        return User::create([
            'id' => Str::uuid(),
            'email' => 'admin@eventec.com',
            'password' => Hash::make('admin123'),
            'name' => 'Administrador',
            'numero_control' => '99999999',
            'user_type' => 'admin',
            'is_active' => true,
        ]);
    }

    private function createEventos()
    {
        $eventos = [
            [
                'title' => 'Hackathon de Innovación 2024',
                'slug' => 'hackathon-innovacion-2024',
                'description' => 'Desarrolla soluciones tecnológicas innovadoras en 48 horas.',
                'short_description' => 'Hackathon de 48 horas',
                'category' => 'Tecnología',
                'event_type' => 'hackathon',
                'status' => 'open',
                'cover_image_url' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&q=80',
                'registration_start_date' => '2024-11-01',
                'registration_end_date' => '2024-12-15',
                'event_start_date' => '2025-01-14',
                'event_end_date' => '2025-01-16',
                'min_team_size' => 3,
                'max_team_size' => 5,
                'max_teams' => 30,
                'registered_teams_count' => 0,
                'location' => 'Auditorio Principal',
                'organizer_name' => 'Dpto. Sistemas',
                'contact_email' => 'hackathon@tecnm.mx',
                'is_published' => true,
            ],
            [
                'title' => 'Feria de Ciencias 2024',
                'slug' => 'feria-ciencias-2024',
                'description' => 'Presenta tu proyecto científico.',
                'short_description' => 'Feria científica',
                'category' => 'Ciencias',
                'event_type' => 'fair',
                'status' => 'open',
                'cover_image_url' => 'https://images.unsplash.com/photo-1532094349884-543bc11b234d?w=1200&q=80',
                'registration_start_date' => '2024-12-01',
                'registration_end_date' => '2025-02-28',
                'event_start_date' => '2025-03-19',
                'event_end_date' => '2025-03-20',
                'min_team_size' => 2,
                'max_team_size' => 4,
                'max_teams' => 25,
                'registered_teams_count' => 0,
                'location' => 'Plaza Central',
                'organizer_name' => 'Ciencias Básicas',
                'contact_email' => 'feria@tecnm.mx',
                'is_published' => true,
            ],
        ];

        $objs = [];
        foreach ($eventos as $e) {
            $objs[] = Event::create(array_merge(['id' => Str::uuid()], $e));
        }
        return $objs;
    }

    private function createEventSchedule($event)
    {
        EventSchedule::create([
            'id' => Str::uuid(),
            'event_id' => $event->id,
            'day' => 1,
            'title' => 'Registro',
            'description' => 'Llegada de participantes',
            'start_time' => '09:00',
            'end_time' => '10:00',
            'order_index' => 1,
        ]);
    }

    private function createTeams($eventos, $estudiantes)
    {
        $team1Id = Str::uuid();
        $team1 = Team::create([
            'id' => $team1Id,
            'name' => 'Tech Innovators',
            'description' => 'Equipo innovador',
            'event_id' => $eventos[0]->id,
            'leader_id' => $estudiantes[0]->id,
            'status' => 'active',
            'invitation_code' => strtoupper(substr(md5(rand()), 0, 6)),
            'members_count' => 3,
        ]);

        DB::table('team_members')->insert([
            ['id' => Str::uuid(), 'team_id' => $team1Id, 'user_id' => $estudiantes[0]->id, 'role' => 'leader', 'joined_at' => now()],
            ['id' => Str::uuid(), 'team_id' => $team1Id, 'user_id' => $estudiantes[1]->id, 'role' => 'member', 'joined_at' => now()],
            ['id' => Str::uuid(), 'team_id' => $team1Id, 'user_id' => $estudiantes[3]->id, 'role' => 'member', 'joined_at' => now()],
        ]);

        // Incrementar contador en el evento
        $eventos[0]->increment('registered_teams_count');

        $team2Id = Str::uuid();
        $team2 = Team::create([
            'id' => $team2Id,
            'name' => 'Green Coders',
            'description' => 'Desarrolladores sostenibles',
            'event_id' => $eventos[0]->id,
            'leader_id' => $estudiantes[2]->id,
            'status' => 'active',
            'invitation_code' => strtoupper(substr(md5(rand()), 0, 6)),
            'members_count' => 3,
        ]);

        DB::table('team_members')->insert([
            ['id' => Str::uuid(), 'team_id' => $team2Id, 'user_id' => $estudiantes[2]->id, 'role' => 'leader', 'joined_at' => now()],
            ['id' => Str::uuid(), 'team_id' => $team2Id, 'user_id' => $estudiantes[5]->id, 'role' => 'member', 'joined_at' => now()],
            ['id' => Str::uuid(), 'team_id' => $team2Id, 'user_id' => $estudiantes[6]->id, 'role' => 'member', 'joined_at' => now()],
        ]);

        // Incrementar contador en el evento
        $eventos[0]->increment('registered_teams_count');

        return [$team1, $team2];
    }

    private function createProjects($equipos, $eventos)
    {
        $project1 = Project::create([
            'id' => Str::uuid(),
            'team_id' => $equipos[0]->id,
            'event_id' => $eventos[0]->id,
            'title' => 'EcoTrack',
            'description' => 'Sistema de monitoreo ambiental',
            'status' => 'evaluated',
            'final_score' => 87.5,
            'rank' => 1,
        ]);
        return [$project1];
    }

    private function createRubrics($event)
    {
        $rubric = Rubric::create([
            'id' => Str::uuid(),
            'event_id' => $event->id,
            'name' => 'Rúbrica Hackathon',
            'total_points' => 100,
            'is_active' => true,
        ]);

        RubricCriterion::create([
            'id' => Str::uuid(),
            'rubric_id' => $rubric->id,
            'name' => 'Innovación',
            'max_points' => 25,
            'order_index' => 1,
        ]);
        return $rubric;
    }

    private function createEvaluations($project, $judge, $rubric)
    {
        Evaluation::create([
            'id' => Str::uuid(),
            'project_id' => $project->id,
            'judge_id' => $judge->id,
            'rubric_id' => $rubric->id,
            'total_score' => 87.5,
            'status' => 'completed',
            'completed_at' => now(),
        ]);
    }

    private function createAchievements()
    {
        $data = [
            ['Primer Proyecto', 'trophy', 10],
            ['Ganador', 'star', 50],
        ];

        $objs = [];
        foreach ($data as $d) {
            $objs[] = Achievement::create([
                'id' => Str::uuid(),
                'name' => $d[0],
                'icon' => $d[1],
                'points' => $d[2],
            ]);
        }
        return $objs;
    }

    private function assignAchievements($user, $achievements)
    {
        DB::table('user_achievements')->insert([
            ['id' => Str::uuid(), 'user_id' => $user->id, 'achievement_id' => $achievements[1]->id, 'earned_at' => now()],
        ]);
    }

    private function createNotifications($estudiantes)
    {
        Notification::create([
            'id' => Str::uuid(),
            'user_id' => $estudiantes[0]->id,
            'type' => 'test',
            'title' => 'Bienvenido',
            'message' => 'Bienvenido al sistema',
            'is_read' => false,
        ]);
    }
}
