<?php

namespace Database\Seeders;

use App\Models\Concept;
use App\Models\Domain;
use Illuminate\Database\Seeder;

class ConceptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laravel = Domain::where('name', 'Laravel')->first();
        $php = Domain::where('name', 'PHP OOP')->first();
        $mysql = Domain::where('name', 'MySQL')->first();
        $api = Domain::where('name', 'API REST')->first();

        // Laravel concepts
        Concept::create([
            'domain_id' => $laravel->id,
            'title' => 'Eloquent N+1 Problem',
            'explanation' => 'Le problème N+1 survient quand on charge une relation dans une boucle sans eager loading. Chaque itération déclenche une nouvelle requête SQL.',
            'difficulty' => 'mid',
            'status' => 'to_review',
        ]);
        Concept::create([
            'domain_id' => $laravel->id,
            'title' => 'Service Container',
            'explanation' => 'Le Service Container de Laravel gère les dépendances et l\'injection de dépendances automatiquement via le binding et la résolution.',
            'difficulty' => 'senior',
            'status' => 'in_progress',
        ]);
        Concept::create([
            'domain_id' => $laravel->id,
            'title' => 'Middleware',
            'explanation' => 'Les middlewares filtrent les requêtes HTTP. Ils s\'exécutent avant ou après la logique du controller.',
            'difficulty' => 'junior',
            'status' => 'mastered',
        ]);

        // PHP OOP concepts
        Concept::create([
            'domain_id' => $php->id,
            'title' => 'Interfaces & Abstract Classes',
            'explanation' => 'Une interface définit un contrat que les classes doivent respecter. Une classe abstraite peut avoir des méthodes concrètes et abstraites.',
            'difficulty' => 'junior',
            'status' => 'mastered',
        ]);
        Concept::create([
            'domain_id' => $php->id,
            'title' => 'Traits',
            'explanation' => 'Les traits permettent de réutiliser des méthodes dans plusieurs classes sans héritage. Laravel les utilise massivement.',
            'difficulty' => 'mid',
            'status' => 'in_progress',
        ]);

        // MySQL concepts
        Concept::create([
            'domain_id' => $mysql->id,
            'title' => 'Index et performances',
            'explanation' => 'Les index accélèrent les requêtes SELECT mais ralentissent INSERT/UPDATE. À utiliser sur les colonnes fréquemment filtrées.',
            'difficulty' => 'mid',
            'status' => 'to_review',
        ]);
        Concept::create([
            'domain_id' => $mysql->id,
            'title' => 'Jointures SQL',
            'explanation' => 'INNER JOIN retourne les lignes communes. LEFT JOIN retourne toutes les lignes de gauche même sans correspondance.',
            'difficulty' => 'junior',
            'status' => 'mastered',
        ]);

        // API REST concepts
        Concept::create([
            'domain_id' => $api->id,
            'title' => 'Authentification JWT',
            'explanation' => 'JWT (JSON Web Token) est un standard pour sécuriser les échanges entre client et serveur via un token signé.',
            'difficulty' => 'senior',
            'status' => 'to_review',
        ]);
    }
}
