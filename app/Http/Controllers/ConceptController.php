<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConceptRequest;
use App\Http\Requests\UpdateConceptRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConceptController extends Controller
{
    public function index(Request $request, int $domain): View
    {
        $domain = auth()->user()->domains()->findOrFail($domain);

        $query = $domain->concepts();

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }
        if ($request->filled('difficulty')) {
            $query->where('difficulty', $request->input('difficulty'));
        }

        $concepts = $query->orderBy('title')->get();

        return view('concepts.index', [
            'domain' => $domain,
            'concepts' => $concepts,
        ]);
    }

    public function create(int $domain): View
    {
        $domain = auth()->user()->domains()->findOrFail($domain);

        return view('concepts.create', compact('domain'));
    }

    public function store(StoreConceptRequest $request, int $domain): RedirectResponse
    {
        $domain = auth()->user()->domains()->findOrFail($domain);

        $data = $request->validated();
        if (! isset($data['status'])) {
            $data['status'] = 'to_review';
        }
        $domain->concepts()->create($data);

        return redirect()->route('concepts.index', $domain->id)
            ->with('success', 'Concept cree.');
    }

    public function show(int $domain, int $concept): View
    {
        $domain = auth()->user()->domains()->findOrFail($domain);
        $concept = $domain->concepts()->with('generatedQuestions')->findOrFail($concept);

        return view('concepts.show', compact('domain', 'concept'));
    }

    public function edit(int $domain, int $concept): View
    {
        $domain = auth()->user()->domains()->findOrFail($domain);
        $concept = $domain->concepts()->findOrFail($concept);

        return view('concepts.edit', compact('domain', 'concept'));
    }

    public function update(UpdateConceptRequest $request, int $domain, int $concept): RedirectResponse
    {
        $domain = auth()->user()->domains()->findOrFail($domain);
        $concept = $domain->concepts()->findOrFail($concept);
        $concept->update($request->validated());

        return redirect()->route('concepts.show', [$domain->id, $concept->id])
            ->with('success', 'Concept mis a jour.');
    }

    public function destroy(int $domain, int $concept): RedirectResponse
    {
        $domain = auth()->user()->domains()->findOrFail($domain);
        $concept = $domain->concepts()->findOrFail($concept);
        $concept->delete();

        return redirect()->route('concepts.index', $domain->id)
            ->with('success', 'Concept archive.');
    }

    public function toggleStatus(int $domain, int $concept): RedirectResponse
    {
        $domain = auth()->user()->domains()->findOrFail($domain);
        $concept = $domain->concepts()->findOrFail($concept);

        $cycle = ['to_review', 'in_progress', 'mastered'];
        $next = $cycle[(array_search($concept->status, $cycle) + 1) % count($cycle)];
        $concept->update(['status' => $next]);

        return redirect()->back()->with('success', "Statut passe a : {$concept->status_label}");
    }

    public function restore(int $domain, int $concept): RedirectResponse
    {
        $domain = auth()->user()->domains()->findOrFail($domain);
        $concept = $domain->concepts()->onlyTrashed()->findOrFail($concept);
        $concept->restore();

        return redirect()->route('concepts.index', $domain->id)
            ->with('success', 'Concept restaure.');
    }

    public function archived(int $domain): View
    {
        $domain = auth()->user()->domains()->findOrFail($domain);
        $concepts = $domain->concepts()->onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        return view('concepts.archived', compact('domain', 'concepts'));
    }
}
