<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\GeneratedQuestion;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $domains = auth()->user()->domains()
            ->withCount(['concepts'])
            ->withCount(['concepts as to_review_count' => fn ($q) => $q->where('status', 'to_review')])
            ->withCount(['concepts as in_progress_count' => fn ($q) => $q->where('status', 'in_progress')])
            ->withCount(['concepts as mastered_count' => fn ($q) => $q->where('status', 'mastered')])
            ->get();

        $totalToReview = $domains->sum('to_review_count');
        $totalInProgress = $domains->sum('in_progress_count');
        $totalMastered = $domains->sum('mastered_count');
        $totalConcepts = $domains->sum('concepts_count');
        $totalArchived = Concept::onlyTrashed()
            ->whereHas('domain', fn ($q) => $q->where('user_id', auth()->id()))
            ->count();

        // Calculate mastery rate
        $masteryRate = $totalConcepts > 0 ? round(($totalMastered / $totalConcepts) * 100) : 0;

        // Get new concepts this week
        $newThisWeek = Concept::whereHas('domain', fn ($q) => $q->where('user_id', auth()->id()))
            ->where('created_at', '>=', now()->subDays(7))
            ->count();

        // Get AI questions generated count
        $questionsGenerated = GeneratedQuestion::whereHas('concept.domain', fn ($q) => $q->where('user_id', auth()->id()))->count();

        // Calculate days streak (simplified - you might want to implement a more complex logic)
        $daysStreak = 0;

        // Get recent AI generations
        $recentGenerations = GeneratedQuestion::whereHas('concept.domain', fn ($q) => $q->where('user_id', auth()->id()))
            ->latest()
            ->take(3)
            ->get()
            ->map(fn ($gen) => [
                'title' => $gen->concept?->title ?? 'AI Generated Question',
                'type' => $gen->concept?->domain?->name ?? 'General',
                'time' => $gen->created_at->diffForHumans(),
            ])
            ->toArray();

        $bestDomain = $domains
            ->filter(fn ($d) => $d->mastered_count > 0)
            ->sortByDesc('mastered_count')
            ->first();

        $worstDomain = $domains
            ->filter(fn ($d) => $d->to_review_count > 0)
            ->sortByDesc('to_review_count')
            ->first();

        // Prepare domain data with rates
        $bestDomainData = null;
        if ($bestDomain) {
            $bestDomainData = [
                'name' => $bestDomain->name,
                'rate' => $bestDomain->concepts_count > 0 ? round(($bestDomain->mastered_count / $bestDomain->concepts_count) * 100) : 0,
            ];
        }

        $worstDomainData = null;
        if ($worstDomain) {
            $worstDomainData = [
                'name' => $worstDomain->name,
                'rate' => $worstDomain->concepts_count > 0 ? round(($worstDomain->to_review_count / $worstDomain->concepts_count) * 100) : 0,
            ];
        }

        return view('dashboard', [
            'totalToReview' => $totalToReview,
            'totalInProgress' => $totalInProgress,
            'totalMastered' => $totalMastered,
            'totalConcepts' => $totalConcepts,
            'totalArchived' => $totalArchived,
            'masteryRate' => $masteryRate,
            'questionsGenerated' => $questionsGenerated,
            'daysStreak' => $daysStreak,
            'newThisWeek' => $newThisWeek,
            'conceptProgress' => round(($totalConcepts - $totalToReview) / max($totalConcepts, 1) * 100),
            'recentGenerations' => $recentGenerations,
            'bestDomain' => $bestDomainData,
            'worstDomain' => $worstDomainData,
            'domains' => $domains,
        ]);
    }
}
