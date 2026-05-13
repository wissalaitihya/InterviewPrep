<?php

namespace App\Http\Controllers;

use App\Models\GeneratedQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiQuestionController extends Controller
{
    public function generate(int $domain, int $concept): RedirectResponse
    {
        $domain = auth()->user()->domains()->findOrFail($domain);
        $concept = $domain->concepts()->findOrFail($concept);

        $apiKey = config('services.groq.key');
        if (! $apiKey) {
            return redirect()->back()->with('error', 'Configuration IA manquante.');
        }

        $systemPrompt = 'Tu es un recruteur backend Laravel. Genere uniquement du JSON valide.';
        $userPrompt = sprintf(
            "Genere exactement 5 questions d'entretien techniques en francais pour ce concept.\nTitre: %s\nExplication: %s\nDifficulte: %s\nStatut de maitrise: %s\nFormat attendu: {\"questions\":[\"...\",\"...\",\"...\",\"...\",\"...\"]}",
            $concept->title,
            $concept->explanation,
            $concept->difficulty_label,
            $concept->status_label,
        );

        try {
            $response = Http::withToken($apiKey)
                ->timeout(30)
                ->post(config('services.groq.url'), [
                    'model' => config('services.groq.model'),
                    'messages' => [
                        ['role' => 'system', 'content' => $systemPrompt],
                        ['role' => 'user', 'content' => $userPrompt],
                    ],
                    'temperature' => 0.7,
                ]);
        } catch (\Exception $e) {
            Log::error('Groq API error: '.$e->getMessage());

            return redirect()->back()->with('error', 'Le service IA est indisponible. Reessayez plus tard.');
        }

        if (! $response->successful()) {
            Log::error('Groq API failed: '.$response->status().' - '.$response->body());

            return redirect()->back()->with('error', 'Le service IA est indisponible. Reessayez plus tard.');
        }

        $content = $response->json('choices.0.message.content');
        $data = json_decode(trim($content), true);

        if (! is_array($data) || ! isset($data['questions']) || ! is_array($data['questions'])) {
            return redirect()->back()->with('error', 'La reponse IA est invalide. Aucune generation n\'a ete sauvegardee.');
        }

        $questions = $data['questions'];
        if (count($questions) > 5) {
            $questions = array_slice($questions, 0, 5);
        }
        if (count($questions) < 5) {
            return redirect()->back()->with('error', 'Le nombre de questions generees est invalide.');
        }

        $concept->generatedQuestions()->create(['questions' => $questions]);

        return redirect()->back()->with('success', '5 questions generees avec succes.');
    }

    public function destroy(int $generation): RedirectResponse
    {
        $generation = GeneratedQuestion::with('concept.domain')
            ->findOrFail($generation);

        auth()->user()->domains()
            ->whereHas('concepts', fn ($q) => $q->where('id', $generation->concept_id))
            ->firstOrFail();

        $generation->delete();

        return redirect()->back()->with('success', 'Generation supprimee.');
    }
}
