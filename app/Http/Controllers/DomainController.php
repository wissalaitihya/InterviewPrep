<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDomainRequest;
use App\Http\Requests\UpdateDomainRequest;
use App\Models\Domain;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DomainController extends Controller
{
    public function index(): View
    {
        $domains = auth()->user()->domains()
            ->withCount('concepts')
            ->withCount(['concepts as mastered_concepts_count' => fn ($q) => $q->where('status', 'mastered')])
            ->get();

        return view('domains.index', compact('domains'));
    }

    public function create(): View
    {
        return view('domains.create');
    }

    public function store(StoreDomainRequest $request): RedirectResponse
    {
        auth()->user()->domains()->create($request->validated());

        return redirect()->route('domains.index')->with('success', 'Domaine cree avec succes.');
    }

    public function show(string $id): RedirectResponse
    {
        Domain::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return redirect()->route('domains.concepts.index', $id);
    }

    public function edit(string $id): View
    {
        $domain = Domain::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        return view('domains.edit', compact('domain'));
    }

    public function update(UpdateDomainRequest $request, string $id): RedirectResponse
    {
        $domain = Domain::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $domain->update($request->validated());

        return redirect()->route('domains.index')->with('success', 'Domaine mis a jour.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $domain = Domain::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $domain->delete();

        return redirect()->route('domains.index')->with('success', 'Domaine archive avec ses concepts.');
    }

    public function archived(): View
    {
        $domains = auth()->user()->domains()
            ->onlyTrashed()
            ->withCount('concepts')
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('domains.archived', compact('domains'));
    }

    public function restore(int $id): RedirectResponse
    {
        $domain = auth()->user()->domains()
            ->onlyTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $domain->restore();

        return redirect()->route('domains.index')->with('success', 'Domaine et ses concepts restores.');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        $domain = auth()->user()->domains()
            ->onlyTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $domain->forceDelete();

        return redirect()->route('domains.archived')->with('success', 'Domaine supprime definitivement.');
    }
}
